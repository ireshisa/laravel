<?php

namespace App\Http\Controllers\Account;

use App\Models\Notification;
use App\Models\Review;
use App\Models\User;
use App\Models\ReportReview;
use App\Notifications\EmployerReviewed;
use App\Notifications\ReportReviewSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Torann\LaravelMetaTags\Facades\MetaTag;

class ReviewController extends AccountBaseController {

    private $perPage = 10;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->perPage = (is_numeric(config('settings.listing.items_per_page'))) ? config('settings.listing.items_per_page') : $this->perPage;
	}
	
	/**
	 * Conversations List
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		$data = [];
		
		// Set the Page Path
		view()->share('pagePath', 'reviews');
		
		// Get the Conversations
		$reviews = $this->reviews->paginate($this->perPage);
		// Meta Tags
		MetaTag::set('title', t('Reviews'));
		MetaTag::set('description', t('reviews on :app_name', ['app_name' => config('settings.app.app_name')]));
		//dd($reviews);
		return view('account.reviews',compact('reviews'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) {

        $user = User::findOrFail($id);
       $this->validate($request,['rating'=>'required'],['rating.required'=>'Rating is required']);

        $comment = $request->comment;
        $review = Review::with('report')->where("user_id", $user->id)->where("reviewer_id", auth()->user()->id)->first();
        if ($review) {
            $review->rating = $request->rating;
            $review->comment = $comment;
            $review->save();
        } else {
            Review::create([
                "user_id" => $user->id,
                "rating"=>$request->rating,
                "reviewer_id" => auth()->user()->id,
                "comment" => $comment,
            ]);
            $employer=User::with('myCompanies')->findOrFail(\auth()->user()->id);
            $mail = new \stdClass();
            

            $emp = User::with('myCompanies')->findOrFail(\auth()->user()->id);
            $mail->employer = $emp->myCompanies[0]->name;
            $mail->candidate = $user->name;
            $mail->stars = $request->rating;
            $mail->review = $comment;
            $mail->url = url('/search-talent/seeker/'.$user->id);
            // dd($mail);
            $notify = $emp->myCompanies[0]->name."(Employer) has been wrote a review about you";
            // $noti = new Notification();
            // $noti->notification = $noti;
            // $noti->url = url('/search-talent/seeker/'.$user->id;
            // $noti->
            Notification::create(["notification"=>$notify,"url"=>url('/search-talent/seeker/'.$user->id),"type"=>"success","to_user_id"=>$user->id,"created_b"=>\auth()->user()->id]);
            $user->notify(new EmployerReviewed($mail));

        }

        flash(t("Your review have been successfully updated. Thank you!"))->success();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review) {
        //
    }

    public  function reportReview(Request $request)
    {

        ReportReview::firstOrCreate(["comments"=>$request->comments,"review_id"=>$request->review_id,"candidate_id"=>Auth::user()->id,"review_status_id"=>"1"]);
       
        $review = Review::with('user')->findOrFail($request->review_id);
        
        $adminUsers = User::role('super-admin')->get();
        // dd($adminUsers);
        $mail= new \stdClass();
        $mail->comments = $request->comments;
        $mail->review = $review->comments;
        $mail->candidate_name = $review->user->name;
        foreach ($adminUsers as $adUser)
        {
            $mail->name= $adUser->name;
            $adUser->notify(new ReportReviewSent($mail));
        }

            flash("Your Report Submitted Successfully. Our Team will go through and Update You Soon.")->success();
       return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy($reviewId, $allreviewId = null) {
        // Get Entries ID

        $ids = [];
        if (request()->filled('entries')) {
            $ids = request()->input('entries');
        } else {
            if (!is_numeric($allreviewId) && $allreviewId <= 0) {
                $ids = [];
            } else {
                $ids[] = $allreviewId;
            }
        }

        $review = Review::where('id',$reviewId);
        $review->delete();
        flash("Entity has been deleted successfully.", ['entity' => t('message')])->success();

//        if(!empty('entries')) {
//        $checked = Request::input('entries',[]);
//        foreach ($checked as $id) {
//            Review::where("id",$id)->delete();
//        }
//        //Or as @Alex suggested
//        Review::whereIn($checked)->delete();
//
//        }
        // Delete
        $nb = 0;
        foreach ($ids as $item) {
            // Don't delete the main conversation
            if ($item == $reviewId) {
                continue;
            }
            // Get the message
            $message = Review::where('id', $reviewId)
                ->byUserId(auth()->user()->id)
                ->first();
            if (!empty($message)) {
                if (empty($message->deleted_by)) {
                    // Delete the Entry for current user
                    $message->deleted_by = auth()->user()->id;
                    $message->save();
                    $nb = 1;
                } else {
                    // If the 2nd user delete the Entry,
                    // Delete the Entry (definitely)
                    if ($message->deleted_by != auth()->user()->id) {
                        $nb = $message->delete();
                    }
                }
            }
        }

        // Confirmation
//        if ($nb == 0) {
//            flash(t("No deletion is done. Please try again."))->error();
//        } else {
//            $count = count($ids);
//            if ($count > 1) {
//                flash(t("x :entities has been deleted successfully.", ['entities' => t('messages'), 'count' => $count]))->success();
//            } else {
//                flash(t("1 :entity has been deleted successfully.", ['entity' => t('message')]))->success();
//            }
//        }

        return back();
    }

}
