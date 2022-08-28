<?php

namespace App\Http\Controllers\Account;

use App\Models\ReportNoShow;
use App\Models\User;
use App\Helpers\UrlGen;
use App\Models\Message;
use App\Models\Meetings;
use App\Models\Applicants;
use App\Models\Notification as UserNotification;
use App\Notifications\CandidateHired;
use App\Notifications\CandidateRejected;
use App\Notifications\ReplySent;
use App\Notifications\ReportNotification;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReplyMessageRequest;
use App\Http\Requests\MeetingRequest;
use Illuminate\Support\Facades\Notification;
use Torann\LaravelMetaTags\Facades\MetaTag;
use Illuminate\Http\Request;
use App\Notifications\InterviewNotification;
use Carbon\Carbon;

class MeetingController extends AccountBaseController {
    public function __construct()
    {
        parent::__construct();
        view()->share('pagePath','meetings');
        $this->perPage = (is_numeric(config('settings.listing.items_per_page'))) ? config('settings.listing.items_per_page') : $this->perPage;

    }

    public function index() {
        $date = Carbon::now();
       // view()->share('pagePath', 'meetings');
      $mettings = Meetings::with('report')->where('candidate_id', auth()->user()->id)->orWhere('my_id', auth()->user()->id)->where('status_id',0)->paginate($this->perPage);

        return view('account.meetings', ['meetings' => $mettings])->with('date', $date);
    }

    public function create() {

        //$candidates = User::verified()->where('user_type_id', 2)->get();
      //  $candidates = Message::with('fromUser')->where('user_type_id', 2)->get();

        $posts = auth()->user()->myCompaniesPosts;
        //dd($candidates);
        // Meta Tags
        MetaTag::set('title', t('Create a new meeting'));
        MetaTag::set('description', t('Create a new meeting - :app_name', ['app_name' => config('settings.app.app_name')]));
        //dd($posts);
        return view('account.meeting.create', ['posts' => $posts]);
    }

    public function reportNoShow(Request $request)
    {
        $result =ReportNoShow::updateOrCreate($request->except(['_token']));
        flash("Your Report is sucessfully sent to the Administrator. We will reach you soon.")->success();
        $meeting = Meetings::with('employer','post')->findOrFail($request->meeting_id);
        $details = new \stdClass();
        $details->title = $meeting->title;
        $details->comments = $meeting->comments;
        $details->employer_name = $meeting->employer->name;
        $details->candidate_name = $meeting->candidate->name;
        $details->post_title = $meeting->post->title;
        $details->venue = $meeting->m_location;
        $details->comments = $request->comments;
        $details->date = date('j,D M Y H:i',strtotime($meeting->m_date.' '.$meeting->m_from)). ' - '. $meeting->m_to;
        $users = User::role('super-admin')->get();
       // dd($users);
       Notification::send($users,new ReportNotification($details));
        return redirect()->back();
    }

    public function getCandidates($postId) {
        $candidates = Message::with('fromUser','toUser')->where('post_id',$postId)->where('is_approved',1)->get();
        if (count($candidates) > 0)
        {
            return response()->json(["code"=>"success","data"=>$candidates]);
        }
        return response()->json(["code"=>"error","data"=>null,"message"=>"There are No Candidates applied to this Job to date"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeetingRequest $request) {
        //dd($request->all());
        $userId = auth()->user() ? auth()->user()->id : null;
        $data = [
            "my_id" => $userId,
            "title" => $request->subject,
            "candidate_id" => $request->candidate_id,
            "m_date" => new \Date($request->input('date')),
            "m_from" => $request->m_from,
            "m_to" => $request->m_to,
            "m_location" => request()->filled('m_location') ? $request->m_location : null,
            "post_id" => request()->filled('post_id') ? $request->post_id : null,
            "message" => request()->filled('message') ? $request->message : null,
        ];

        $meeting = Meetings::create($data);
        $notification = new \stdClass();
        $notification->details = $meeting;
        $notification->subject = "Interview Meeting Scheduled - ";
        $notification->type="scheduled";
        $candidate = User::find($meeting->candidate_id);
        $employer = User::with('myCompanies')->findOrFail(\auth()->user()->id);
        if ($candidate) {
            $noti = "An Interview Has Been Scheduled By the Employer(".$employer->name.") at ".$meeting->m_location.",".date('d-m-Y',strtotime($meeting->m_date))." ".$meeting->m_from." - ".$meeting->m_to;
            UserNotification::create(["notification"=>$noti,"to_user_id"=>$request->input('candidate_id'),"type"=>"success","created_by"=>\auth()->user()->id,"url"=>url('/account/meetings')]);
            $candidate->notify(new InterviewNotification($notification));
        }
        
        flash("Your meeting have been successfully created. Thank you!")->success();
        return redirect('account/meetings');
    }

    public function shedule(Request $request) {
        //dd($request->all());
        if ($request->filled('entries')) {
            foreach ($request->input('entries') as $entry) {
                $meeting = Meetings::findOrFail($entry);
                $meeting->m_date = new \Date($request->input('date'));
                $meeting->m_from = $request->input('m_from');
                $meeting->m_to = $request->input('m_to');
                $meeting->m_location = $request->input('m_location');
                $meeting->load('post');
                $meeting->load('candidate');
                $meeting->save();
                $notification = new \stdClass();
                $notification->details = $meeting;
                $notification->subject = "Interview Meeting Scheduled - ";
                $notification->type="scheduled";
                $candidate = User::find($meeting->candidate_id);
                $employer = User::findOrFail(\auth()->user()->id);
                if ($candidate) {
                    $noti = "An Interview Has Been Scheduled By the Employer(".$employer->name.") at ".$meeting->m_location.",".date('d-m-Y',strtotime($meeting->m_date))." ".$meeting->m_from." - ".$meeting->m_to;
                    \App\Models\Notification::create(["notification"=>$noti,"to_user_id"=>$request->input('candidate_id'),"type"=>"success","created_by"=>\auth()->user()->id,"url"=>url('/account/meetings')]);
                    $candidate->notify(new InterviewNotification($notification));
                }
            }

            flash(t("Meetings have been scheduled"))->success();
        }
        return redirect()->back();
    }

    public function getMeeting($id)
    {
        $meeting = Meetings::findOrFail($id);
        return response()->json($meeting);
    }

    public function setStatus(Request $request)
    {
        $meeting = Meetings::findOrFail($request->meeting_id);
        $meeting->status_id = $request->status_id;
        if ($request->has('message'))
        {
            $meeting->reject_message = $request->message;
        }

        $meeting->load('post.company','candidate','post');
        //return response()->json($meeting);
        $details = new \stdClass();
        $details->name = $meeting->candidate->name;
        $details->employer = $meeting->company->name;
        $details->job =$meeting->title;
        
        // return response()->json($details);
        if ($request->has('message'))
        {
           $details->message = $request->message;
        }
        $candidate = User::findOrFail($meeting->candidate_id);
       //dd($details);


        if ($meeting->status_id == 1)
        {
            $candidate->notify(new CandidateHired($details));
            flash("Candidate Hired Successfully. A Confirmation Email is sent to the Candidate's Email Address")->success();
  $notification= "Your have been selected by the Employer(".$meeting->post->company->name.") for the Post of ".$meeting->post->title;
            $conn = UserNotification::create(["notification"=>$notification,"to_user_id"=>$meeting->candidate_id,"type"=>"success","created_by"=>\auth()->user()->id,"url"=>url('/account/pending')]);


        }
        else {
           
            $candidate->notify(new CandidateRejected($details));
            flash("Candidate is Rejected in this interview.")->success();
            $notification= "Your have been rejected by the Employer(".$meeting->company->name.") for the Post of ".$meeting->title;
            $conn = UserNotification::create(["notification"=>$notification,"to_user_id"=>$meeting->candidate_id,"type"=>"success","created_by"=>\auth()->user()->id,"url"=>url('/account/pending')]);
        }
        $meeting->save();
        if ($request->ajax())
        {
            return response()->json(true);
        }
        else
        {
            return back();

        }
    }

    public function destroy(Request $request)
    {
        $id_array = $request->entries;
        Meetings::whereIn('id',$id_array)->delete();
       
        flash(count($id_array)." Meetings  deleted Successfully")->success();
        
        



        return redirect()->back();
    }

    public function edit($id)
    {
        $posts = auth()->user()->myCompaniesPosts;


        // Get the Company
        $meeting = Meetings::find($id);
        $candidate = User::find($meeting->candidate_id);

        // Meta Tags
        MetaTag::set('title', t('Edit the Company'));
        MetaTag::set('description', t('Edit the Company - :app_name', ['app_name' => config('settings.app.app_name')]));


        return view('account.meeting.edit', ['posts' => $posts, 'meeting' => $meeting, 'candidate' => $candidate]);
    }

    public function update($id, MeetingRequest $request)
    {
        $meeting = Meetings::where('id', $id)->where('my_id', auth()->user()->id)->firstOrFail();

        // Get Meeting Info
        $meetingInfo = $request->all();
        if (!isset($meetingInfo['my_id']) || empty($meetingInfo['my_id'])) {
            $meetingInfo += ['my_id' => auth()->user()->id];
        }

        // Make an Update
       // dd($meetingInfo);
        $meeting->update($meetingInfo);
        $meeting->update(["m_date"=>new \Date($meetingInfo["date"])]);
        $meeting->load('post');
        $meeting->load('candidate');
        flash(("Your meeting details has updated successfully."))->success();
        $notification = new \stdClass();
        $notification->details = $meeting;
        //   $notification->title = $meeting->title;
        $notification->subject = "Interview Meeting Re-Scheduled - ";
        $notification->type="re-scheduled";
        $candidate = User::find($meeting->candidate_id);
        $employer = User::findOrFail(\auth()->user()->id);
        if ($candidate) {
            $noti = "An Interview Has Been Re-Scheduled By the Employer(".$employer->name.") at ".$meeting->m_location.",".date('d-m-Y',strtotime($meeting->m_date))." ".$meeting->m_from." - ".$meeting->m_to;
            \App\Models\Notification::create(["notification"=>$noti,"to_user_id"=>$request->input('candidate_id'),"type"=>"success","created_by"=>\auth()->user()->id,"url"=>url('/account/meetings')]);
            $candidate->notify(new InterviewNotification($notification));
        }
        

        // Redirection
        return redirect()->back();
    }

}
