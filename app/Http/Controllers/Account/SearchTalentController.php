<?php

namespace App\Http\Controllers\Search;

use App\Helpers\Search;
use App\Http\Controllers\Search\Traits\PreSearchTrait;
use App\Http\Controllers\Traits\BuyPackage;
use App\Models\Category;
use App\Models\Notification;
use App\Models\SaveCandidate;
use App\Models\SubAdmin1;
use App\Models\User;
use App\Models\Message;
use App\Models\PostType;
use App\Notifications\ConnectStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use phpseclib\Crypt\Base;
use Torann\LaravelMetaTags\Facades\MetaTag;
use App\Models\Review;
use App\Models\Post;

class SearchTalentController extends BaseController
{
    use PreSearchTrait, BuyPackage;
   public $perPage = 10;
    public $isIndexSearch = true;

    protected $cat = null;
    protected $subCat = null;
    protected $city = null;
    protected $admin = null;


    protected $filters = [
        'salary_from' => [
            'field' => 'salary',
            'condition' => '>=',
        ],
        'salary_to' => [
            'field' => 'salary',
            'condition' => '<=',
        ],
        'age_from' => [
            'field' => 'age',
            'condition' => '>=',
        ],
        'age_to' => [
            'field' => 'age',
            'condition' => '<=',
        ],
        'age' => [
            'field' => 'age',
            'condition' => '>=',
            'condition2' => '<',
        ],
        'gender' => [
            'field' => 'gender',
            'condition' => '=',
        ],
        'experience' => [
            'field' => 'experience',
            'condition' => '=',
        ],
        'sector' => [
            'field' => 'sector_id',
            'condition' => '=',
        ],
        'qualifications' => [
            'field' => 'qualifications',
            'condition' => 'LIKE',
        ],
        'skills' => [
            'field' => 'skills',
            'condition' => 'LIKE',
        ],
        'date_posted' => [
            'field' => 'created_at',
            'condition' => '>=',
        ],
    ];


    public function getJsonTalents(Request $request)
    {
       // dd($request);

        $users = $this->getUsers($request);
        $saved_candidates =[];
        if (auth()->check())
        {
            $saved_candidates = SaveCandidate::where('user_id',auth()->user()->id)->get()->pluck('candidate_id')->toArray();

        }
        $html= view('customs.talents.ajax-index',compact('users'))->with('saved',$saved_candidates)->render();
        return response()->json($html,'200');
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //age
        //gender
        //location
        //sector_id
        //qualifications
        //experience
        //salary
        //skills

        $users = $this->getUsers($request);
        $saved_candidates =[];
        if (auth()->check())
        {
            $saved_candidates = SaveCandidate::where('user_id',auth()->user()->id)->get()->pluck('candidate_id')->toArray();

        }
        //dd($saved_candidates);

        $count =  User::where('user_type_id', 2)->count();
        $sectors = Category::get();
        $postTypes = PostType::get();
       // dd($sectors);
        $provinces = SubAdmin1::orderBy('name','asc')->get();
        $result = User::with('post_type_id','sector_id')->where('is_filled',0);
        $reviews = User::with(['reviews'])->where('is_filled',0);


        // Get Titles
        $title = $this->getTitle();
        $this->getBreadcrumb();
        $this->getHtmlTitle();

        // Meta Tags
        MetaTag::set('title', 'Talents');
        MetaTag::set('description', $title);


        return view('customs.talents.index')->with('users', $users)->with('saved',$saved_candidates)->with('count', $count)->with('categories',$sectors)->with('provinces', $provinces)->with('post_types', $postTypes)->with('result', $result)->with('reviews', $reviews);        


    }

    /**
     * @param Request $request
     * @return mixed
     */
    protected function getUsers(Request $request)
    {
        $builder = User::where('user_type_id', 2)->latest();


        foreach ($this->filters as $filter => $options) {

            if ($value = $request->{$filter}) {

                $value = $options['condition'] == 'LIKE' ? $value . '%' : $value;

                if ($filter == "age")
                {

                    $splitted = explode('-',$value);

                    $builder->where($options['field'],$options['condition'],$splitted[0])->where($options['field'],$options['condition2'],$splitted[1]);

                }
                if ($filter == "experience")
                {

                    $splitted = explode('-',$value);

                    $builder->where($options['field'],$options['condition'],$splitted[0]);

                }
                if ($filter == "gender")
                {

                    $splitted = explode('-',$value);

                    $builder->where($options['field'],$options['condition'],$splitted[0]);

                }
                if($filter == "date_posted")
                {
                    $splitted_d = explode('d',$value);
                    $splitted_h = explode('h',$value);
                    $date = null;

                    if (count($splitted_h) > 1)
                    {
                        $date = Carbon::now()->subHours($splitted_h[0])->format('Y-m-d H:i:s');

                    }
                    else {
                        $date = Carbon::now()->subDays($splitted_d[0])->format('Y-m-d H:i:s');

                    }

                    $builder->where($options['field'], $options['condition'],$date);

                }

                else if (Str::contains($value,','))
                {
                    $splittedArr = explode(',',$value);
                    if ($filter == "qualifications")
                    {

                        $builder->whereJsonContains('extra_educations->title','/bsc.*|BSC.*/');

                    }
                    else {
                        $builder->whereIn($options['field'], $splittedArr);

                    }

                }
                else {
                    $builder->where($options['field'], $options['condition'], $value);

                }
            }
        }

        if ($request->q) {
         //   dd($request->location);
            $builder->where(function($query) use($request){
                $query->where('name', 'LIKE', $request->q . '%')
                    ->orWhere('skills', 'LIKE', $request->q . '%')
                    ->orWhere('qualifications', 'LIKE', $request->q . '%');
            });
        }

        if ($request->city) {
            //dd($request->location);
            $builder->where('city_id', 'LIKE', $request->city . '%');
        }

        if ($request->category_id){
            $builder->where('sector_id', 'LIKE', $request->category_id . '%');
        }


        if ($request->filled('types') && $request->types != "all")
        {
            $builder->where('post_type_id',$request->types);
        }

        return $builder->paginate($this->perPage);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            flash(t("User not found"))->error();

            return redirect('/search-talent');
        }
        $userReview = null;
        $jobs = null;
        $userReview = null;
        if (auth()->check()) {
            $userReview = User::with(['userReview' => function ($query) use ($id) {
                $query->where('user_id', $id);
            }])->findorFail(auth()->user()->id);
        }

        if (auth()->check() && auth()->user()->user_type_id == 1) {


            $post_ids = Message::whereIn('from_user_id', [$id, auth()->user()->id])->WhereIn('to_user_id', [$id, auth()->user()->id])->pluck('post_id');

            $jobs = Post::where('user_id', auth()->id())->get();
            $jobs = $jobs->whereNotIn('id', $post_ids->toArray());

        }

        $count = $user->endorsements()->count();
        $reviews = Review::with('report.status','reviewer.myCompanies')->where("user_id", $id)->orderBy('id', 'desc')->get();

        $showReviews = $reviews->take(10);
        $showReviews->load('reviewer');
        $averageRating = $reviews->avg('rating');
        $refereeData = null;
        $connection_id = null;
        $connection_connectId = null;
        $post_ids = null;
        if (auth()->check())
        {
            $connection_id = Message::whereIn('from_user_id', [auth()->user()->id])->get()->first();
        $connection_connectId = Message::whereIn('from_user_id', [$id, auth()->user()->id])->WhereIn('to_user_id', [$id, auth()->user()->id])->WhereIn('delete_request', ['0'])->first();

        $post_ids = Message::whereIn('from_user_id', [$id, auth()->user()->id])->WhereIn('to_user_id', [$id, auth()->user()->id])->pluck('post_id');
    }

    //   dd($connection_connectId);
        return view('customs.talents.show', ['refereeData'=>$refereeData,'reviewData'=>null,'userReview'=>(!empty($userReview->userReview)?$userReview->userReview:null),'reviews' => $showReviews,'avg_rating'=>$averageRating,'jobs'=>$jobs, 'user' => $user, 'endorsementCount' => $count, 'connection_id' => $connection_id, 'post_id' => $post_ids, 'connection_connectId' => $connection_connectId]);
    }
    
    public function connect($id, Request $request)
    {
        
        // dd($request->all());
        $user = User::find($id);

        $jobs=Post::whereIn('id',$request->job_id)->get();


//        $existRequest=  Message::whereIn('from_user_id',[$id,auth()->user()->id])->whereIn('to_user_id',[$id,auth()->user()->id])->where('id',$jobs->post_id)->first();
//        if ($existRequest)
//        {
//            if ($existRequest->is_approved == 0)
//            {
//                if ($existRequest->from_user_id == auth()->user()->id)
//                flash("You have already Sent the Connection Request to ". $user->name." or ".$user->name." may have Send the Connection Request. But the Connection Request ")
//            }
//        }
        if(! $user){
            flash(t("User not found"))->error();

            return redirect('/search-talent');
        }

        $userConnect = User::with('userPackage')->findOrFail(auth()->user()->id);
        if ($userConnect->userPackage->available_connects -count($jobs) <= 0)
        {
            if (count($jobs) > 0)
            {
                flash("You have lack of connects to Get Connected with these Employees. Please Buy More Connects.")->error();

            }
            else {
                flash("You don't have sufficient connects to Get Connected with this Employee. Please Buy More Connects.")->error();

            }
            return back();
        }

//        else {
//            flash("You don't have sufficient connects to Get Connected with this Employee. Please Buy More Connects.")->error();
//
//        }




        for ($i=0; $i < count($jobs); $i++)
        {
		$message = new Message();
		$input = $request->only($message->getFillable());
		foreach ($input as $key => $value) {
			$message->{$key} = $value;
		}

		$message->from_user_id = auth()->check() ? auth()->user()->id : 0;
		$message->from_name = auth()->check() ? auth()->user()->name : NULL;
		$message->from_email = auth()->check() ? auth()->user()->email : NULL;
		$message->from_phone = auth()->check() ? auth()->user()->phone : NULL;
		$message->to_user_id = $user->id;
		$message->to_name = $user->name;
		$message->to_email = $user->email;
		$message->to_phone = $user->phone;
		$message->subject = "New Connection request";
		$message->message = auth()->user()->username . " Wants to connect with You";

		 
		$message->post_id=$jobs[$i]->id;
		$message->job_title=$jobs[$i]->title;
            $user = User::with('myCompanies')->findOrFail(auth()->user()->id);
            $notification = "New Connection request Received From ".$user->myCompanies[0]->name."(Employer) For the Job - ".$jobs[$i]->title;
		//$message->message = $request->input('message');
            if (count($jobs) > 0)
            {
                $msg = "";
                if (count($jobs) > 1)
                {
                    $msg = "Connection request sent successfully to " .$user->firstname." for ".count($jobs)." Jobs";
                }
                else {
                    $msg = "Connection request sent successfully to " .$user->firstname;

                }
                flash($msg)->success();
            }
		// Save
		    $message->save();
            Notification::create(["notification"=>$notification,"to_user_id"=>$message->to_user_id,"type"=>"success","created_by"=>\auth()->user()->id,"url"=>url('/account/pending')]);
            $user_to= User::findOrFail($message->to_user_id);
            $post = Post::findOrFail($message->post_id);
            $email = new \stdClass();
            $email->name= $user_to->name;
            $email->title = $post->title;

            $email->from_user = $user->myCompanies[0]->name;
            $email->type=2;
            $email->status = 1;
            $user->notify(new ConnectStatus($email));
}



		

        

        return back();
    }
}
