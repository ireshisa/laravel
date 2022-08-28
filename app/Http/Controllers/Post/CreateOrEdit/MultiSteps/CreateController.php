<?php

/**
//
 */

namespace App\Http\Controllers\Post\CreateOrEdit\MultiSteps;


use App\Mail\Followmail;
use App\Mail\Alertmail;
use Illuminate\Support\Facades\Mail;

use App\Helpers\ArrayHelper;
use App\Helpers\Ip;
use App\Helpers\UrlGen;
use App\Http\Controllers\Post\CreateOrEdit\Traits\AutoRegistrationTrait;
use App\Http\Controllers\Post\CreateOrEdit\MultiSteps\Traits\EditTrait;
use App\Http\Controllers\Auth\Traits\VerificationTrait;
use App\Http\Controllers\Traits\BuyPackage;
use App\Http\Requests\PostRequest;
use App\Http\Requests\Request;
use App\Models\Company;
use App\Models\Gender;
use App\Models\Permission;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Category;
use App\Models\Package;
use App\Models\City;
use App\Models\SalaryType;
use App\Models\SaveCandidate;
use App\Models\Teamsize;
use App\Models\User;
use App\Http\Controllers\FrontController;
use App\Models\Scopes\VerifiedScope;
use App\Models\Scopes\ReviewedScope;
use App\Notifications\PostActivated;
use App\Notifications\PostNotification;
use App\Notifications\PostReviewed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use App\Models\SubAdmin1;
use Torann\LaravelMetaTags\Facades\MetaTag;
use App\Helpers\Localization\Helpers\Country as CountryLocalizationHelper;
use App\Helpers\Localization\Country as CountryLocalization;
use Illuminate\Support\Facades\DB;

class CreateController extends FrontController
{
	use EditTrait, VerificationTrait, AutoRegistrationTrait, BuyPackage;

	public $data;
	public $packages;

	/**
	 * CreateController constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		// Check if guests can post Ads
		if (config('settings.single.guests_can_post_ads') != '1') {
			$this->middleware('auth')->only(['getForm', 'postForm']);
		}

		// From Laravel 5.3.4 or above
		$this->middleware(function ($request, $next) {
			$this->commonQueries();

			return $next($request);
		});
	}

	/**
	 * Common Queries
	 */
	public function commonQueries()
	{
		// References
		$data = [];
		$this->packages = Package::trans()->applyCurrency()->with('currency')->orderBy('lft')->get();
		// Get Countries
		$data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries());
		view()->share('countries', $data['countries']);

		// Get Categories
		$cacheId = 'categories.parentId.0.with.children' . config('app.locale');
		$data['categories'] = Cache::remember($cacheId, $this->cacheExpiration, function () {
			$categories = Category::trans()->where('parent_id', 0)->with([
				'children' => function ($query) {
					$query->trans();
				},
			])->orderBy('lft')->get();

			return $categories;
		});
		view()->share('categories', $data['categories']);

		// Get Post Types
		$cacheId = 'postTypes.all.' . config('app.locale');
		$data['postTypes'] = Cache::remember($cacheId, $this->cacheExpiration, function () {
			$postTypes = PostType::trans()->orderBy('lft')->get();

			return $postTypes;
		});
		view()->share('postTypes', $data['postTypes']);

		// Get Salary Types
		$cacheId = 'salaryTypes.all.' . config('app.locale');
		$data['salaryTypes'] = Cache::remember($cacheId, $this->cacheExpiration, function () {
			$salaryTypes = SalaryType::trans()->orderBy('lft')->get();

			return $salaryTypes;
		});
		view()->share('salaryTypes', $data['salaryTypes']);

		if (auth()->check()) {
			// Get all the User's Companies
			$data['companies'] = Company::where('user_id', auth()->user()->id)->take(100)->orderByDesc('id')->get();
			view()->share('companies', $data['companies']);

			// Get the User's latest Company
			if ($data['companies']->has(0)) {
				$data['postCompany'] = $data['companies']->get(0);
				view()->share('postCompany', $data['postCompany']);
			}
		}

		// Count Packages
		$data['countPackages'] = Package::trans()->applyCurrency()->count();
		view()->share('countPackages', $data['countPackages']);

		//sector
		$cats = Cache::remember($cacheId, $this->cacheExpiration, function () {
			$cats = Category::trans()->orderBy('lft')->get();
			return $cats;
		});
		if ($cats->count() > 0) {
			$cats = collect($cats)->keyBy('tid');
		}
		view()->share('cats', $cats);

		//teamsize
		$data['teamsize'] = Teamsize::get();
		view()->share('teamsize', $data['teamsize']);

		//genders
		$data['genders'] = Gender::trans()->get();
		view()->share('genders', $data['genders']);

		// Count Payment Methods
		$data['countPaymentMethods'] = $this->countPaymentMethods;

		// Save common's data
		$this->data = $data;
	}

	/**
	 * New Post's Form.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function getForm()
	{


		// Check if the form type is 'Single Step Form', and make redirection to it (permanently).
		if (config('settings.single.publication_form_type') == '2') {
			return redirect(lurl('create'), 301)->header('Cache-Control', 'no-store, no-cache, must-revalidate');
		}

		// Only Admin users and Employers/Companies can post ads
		if (auth()->check()) {
			if (!in_array(auth()->user()->user_type_id, [1])) {
				return redirect()->intended(config('app.locale') . '/account');
			}
		}

		// Check possible Update
		if (!empty($tmpToken)) {

			session()->keep(['message']);
			//dd($tmpToken);
			return $this->getUpdateForm($tmpToken);
		}

		// Meta Tags
		MetaTag::set('title', getMetaTag('title', 'create'));
		MetaTag::set('description', strip_tags(getMetaTag('description', 'create')));
		MetaTag::set('keywords', getMetaTag('keywords', 'create'));
		$admin_divs = SubAdmin1::all();
		// dd($admin_divs);
		// Create
		return view('post.createOrEdit.multiSteps.create')->with('admin_divs', $admin_divs);
	}

	/**
	 * Store a new Post.
	 *
	 * @param null $tmpToken
	 * @param PostRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function postForm($tmpToken = null, PostRequest $request)
	{
		//	    dd($request->all());
		//return $request;
		// Check possible update
		if (!empty($tmpToken)) {
			session()->keep(['message']);

			return $this->postUpdateForm($tmpToken, $request);
		}

		// Get the Post's City
		$city = City::find($request->input('city_id', 0));
		if (empty($city)) {
			flash(t("Posting Ads was disabled for this time. Please try later. Thank you."))->error();

			return back()->withInput($request->except('company.logo'));
		}

		// Conditions to Verify User's Email or Phone
		if (auth()->check()) {
			$emailVerificationRequired = config('settings.mail.email_verification') == 1 && $request->filled('email') && $request->input('email') != auth()->user()->email;
			$phoneVerificationRequired = config('settings.sms.phone_verification') == 1 && $request->filled('phone') && $request->input('phone') != auth()->user()->phone;
		} else {
			$emailVerificationRequired = config('settings.mail.email_verification') == 1 && $request->filled('email');
			$phoneVerificationRequired = config('settings.sms.phone_verification') == 1 && $request->filled('phone');
		}

		// Get or Create Company
		if ($request->filled('company_id') && !empty($request->input('company_id'))) {
			// Get the User's Company
			$company = Company::where('id', $request->input('company_id'))->where('user_id', auth()->user()->id)->first();
		} else {
			$companyInfo = [
				"name" => $request->input('name'),
				"description" => $request->input('description'),
			];
			if (!isset($companyInfo['country_code']) || empty($companyInfo['country_code'])) {
				$companyInfo += ['country_code' => config('country.code')];
			}

			// Logged Users
			if (auth()->check()) {
				if (!isset($companyInfo['user_id']) || empty($companyInfo['user_id'])) {
					$companyInfo += ['user_id' => auth()->user()->id];
				}

				// Store the User's Company
				$company = new Company($companyInfo);
				$company->save();


				// Save the Company's Logo
				if ($request->hasFile('logo')) {
					$company->logo = $request->file('logo');
					$company->save();
				}
			} else {
				// Guest Users
				$company = ArrayHelper::toObject($companyInfo);
			}
		}

		// Return error if company is not set
		if (empty($company)) {
			flash(t("Please select a company or 'New Company' to create one."))->error();

			return back()->withInput($request->except('company.logo'));
		}

		// New Post
		$post = new Post();
		$input = $request->only($post->getFillable());
		foreach ($input as $key => $value) {
			$post->{$key} = $value;
		}

		$post->description = $request->input('description');
		$post->country_code = config('country.code');
		$post->user_id = (auth()->check()) ? auth()->user()->id : 0;
		$post->company_id = (isset($company->id)) ? $company->id : 0;
		$post->company_name = (isset($company->name)) ? $company->name : null;
		$post->logo = (isset($company->logo)) ? $company->logo : null;
		$post->company_description = (isset($company->description)) ? $company->description : null;
		$post->negotiable = $request->input('negotiable');
		$post->phone_hidden = $request->input('phone_hidden');
		$post->lat = $city->latitude;
		$post->lon = $city->longitude;
		$post->ip_addr = Ip::get();
		// 		$post->tmp_token = md5(microtime() . mt_rand(100000, 999999));
		$post->tmp_token = null;
		$post->verified_email = 1;
		$post->verified_phone = 1;
		$post->reviewed = 0;
				$post->gender_id = $request->input('gender_id');

		// Email verification key generation
		if ($emailVerificationRequired) {
			$post->email_token = md5(microtime() . mt_rand());
			$post->verified_email = 0;
		}

		// Mobile activation key generation
		if ($phoneVerificationRequired) {
			$post->phone_token = mt_rand(100000, 999999);
			$post->verified_phone = 0;
		}
		// Save
		$post->save();
		$this->sendmailtofloowers($post->id);
		$this->sendmailtoalert($post->id);

		// Save ad Id in session (for next steps)
		session(['tmpPostId' => $post->id]);

		// Auto-Register the Author
		$user = $this->register($post);

		// Save Logo (for Guest Users)
		if (!auth()->check()) {
			if ($request->hasFile('company.logo')) {
				$post->logo = $request->file('company.logo');
				$post->save();
			}
		}

		// The Post's creation message
		if (getSegment(2) == 'create') {
			session()->flash('message', t('Your ad has been created.'));
		}

		// Get Next URL

		// 		if (
		// 			isset($this->data['countPackages']) &&
		// 			isset($this->data['countPaymentMethods'])
		// 		)
		//        if (
		//            isset($this->data['countPackages']) &&
		//            !isset($buyPackages)
		//        ) {
		// 			$nextStepUrl = config('app.locale') . '/posts/create/' . $post->tmp_token . '/payment';
		$request->session()->flash('message', t('Your Job Post has been created.'));
		flash(t('Your Job Post has been created.'))->success();
		$nextStepUrl = config('app.locale') . '/posts/finish';

		//        } else {
		// 			$request->session()->flash('message', t('Your ad has been created.'));
		// 			$nextStepUrl = config('app.locale') . '/posts/create/' . $post->tmp_token . '/finish';
		// 		}

		// Send Admin Notification Email
		if (config('settings.mail.admin_notification') == 1) {
			try {
				// Get all admin users
				$admins = User::permission(Permission::getStaffPermissions())->get();
				if ($admins->count() > 0) {
					Notification::send($admins, new PostNotification($post));
					/*
 					foreach ($admins as $admin) {
 						Notification::route('mail', $admin->email)->notify(new PostNotification($post));
 					}
 					*/
				}
			} catch (\Exception $e) {
				flash($e->getMessage())->error();
			}
		}

		// Send Verification Link or Code
		if ($emailVerificationRequired || $phoneVerificationRequired) {

			// Save the Next URL before verification
			session(['itemNextUrl' => $nextStepUrl]);

			// Email
			if ($emailVerificationRequired) {
				// Send Verification Link by Email
				$this->sendVerificationEmail($post);

				// Show the Re-send link
				$this->showReSendVerificationEmailLink($post, 'post');
			}

			// Phone
			if ($phoneVerificationRequired) {
				// Send Verification Code by SMS
				$this->sendVerificationSms($post);

				// Show the Re-send link
				$this->showReSendVerificationSmsLink($post, 'post');

				// Go to Phone Number verification
				$nextStepUrl = config('app.locale') . '/verify/post/phone/';
			}

			// Send Confirmation Email or SMS,
			// When User clicks on the Verification Link or enters the Verification Code.
			// Done in the "app/Observers/PostObserver.php" file.

		} else {

			// Send Confirmation Email or SMS
			if (config('settings.mail.confirmation') == 1) {
				try {
					//if (config('settings.single.posts_review_activation') == 1) {
					$post->notify(new PostActivated($post));
					//} else {
					//	$post->notify(new PostReviewed($post));
					//}
				} catch (\Exception $e) {
					flash($e->getMessage())->error();
				}
			}
		}

		// Redirection
		return redirect($nextStepUrl);
	}

	/**
	 * Confirmation
	 *
	 * @param $tmpToken
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	 */
	public function finish()
	{

		// Keep Success Message for the page refreshing
		session()->keep(['message']);
		$posts = Post::findOrFail(session()->get('tmpPostId'));
		$gender_ids  = Gender::all()->pluck('id');
		$post_type_ids  = PostType::all()->pluck('id');

		$candidates = User::with(['postType', 'sector', 'endorsements', 'city', 'reviews'])->where('user_type_id', 2)->whereIn('post_type_id', $post_type_ids)->where('sector_id', $posts->category_id)->whereIn('gender_id', $gender_ids);



if($posts->gender_id ==3){
    // 		$gender_id_post=$posts->gender_id;
    // 	$candidates->whereIn('gender_id', $gender_ids);
}else
{
    		$gender_id_post=$posts->gender_id;
    			$candidates->where('gender_id', $gender_id_post);
}

		if ($posts->qualifications != null) {
			$candidates->where('qualification', $posts->qualification);
		}

		if ($posts->salary_max != null) {
			$candidates->where('salary', '<=', $posts->salary_max);
		}
		$candidates =  $candidates->paginate(10);
		$saved_candidates = [];
		if (auth()->check()) {
			$saved_candidates = SaveCandidate::where('user_id', auth()->user()->id)->get()->pluck('candidate_id')->toArray();
		}
		//dd($candidates);
		//		if (!session()->has('message')) {
		//			return redirect(config('app.locale') . '/');
		//		}
		//		return view('customs.talents.post-talents',["users"=>$candidates,'saved'=>$saved_candidates]);
		// Clear the steps wizard


		// Redirect to the Post,
		// - If User is logged
		// - Or if Email and Phone verification option is not activated
		//		if (auth()->check() || (config('settings.mail.email_verification') != 1 && config('settings.sms.phone_verification') != 1)) {
		//			if (!empty($post)) {
		//				flash(session('message'))->success();
		//
		//				return redirect(UrlGen::postUri($post));
		//			}
		//		}
		//		dd(session()->all());
		// Meta Tags
		$user = User::with('purchasedPackage')->findOrFail(Auth::user()->id);
		$packageData = $this->showPackages($user);
		$showPackages = $packageData['showPackages'];
		$packages = $packageData['packages'];
		MetaTag::set('title', session('message'));
		MetaTag::set('description', session('message'));
		// 		if (Request::segment(2) == "finished" && !$showPackages)
		if (session()->has('tmpPostId')) {
			// Get the Post
			//			$post = Post::withoutGlobalScopes([VerifiedScope::class, ReviewedScope::class])->where('id', session('tmpPostId'))->where('tmp_token', $tmpToken)->first();
			//			if (empty($post)) {
			//				abort(404);
			//			}
			//
			//			// Apply finish actions
			//			$post->tmp_token = null;
			//			$post->save();
			// session()->forget('tmpPostId');
		}
		//        dd($user);
		return view('post.createOrEdit.multiSteps.finish', ['packages' => $packages, 'showPackages' => $showPackages, "users" => $candidates, 'saved' => $saved_candidates]);
	}

	public function showMatched()
	{
	    die("Asd");
		session()->keep(['message']);
		$posts = Post::findOrFail(session()->get('tmpPostId'));
		$gender_ids  = Gender::all()->pluck('id');
	
		$post_type_ids  = PostType::all()->pluck('id');

		$candidates = User::with(['postType', 'sector', 'endorsements', 'city', 'reviews'])->where('user_type_id', 2)->whereIn('post_type_id', $post_type_ids)->where('sector_id', $posts->category_id);



if($posts->gender_id ==3){
    // 		$gender_id_post=$posts->gender_id;
    // 	$candidates->whereIn('gender_id', $gender_ids);
}else
{
    		$gender_id_post=$posts->gender_id;
    			$candidates->where('gender_id', $gender_id_post);
}
		if ($posts->qualifications != null) {
			$candidates->where('qualification', $posts->qualification);
		}

		if ($posts->salary_max != null) {
			$candidates->where('salary', '<=', $posts->salary_max);
		}
		$candidates =  $candidates->paginate(10);
		$saved_candidates = [];
		if (auth()->check()) {
			$saved_candidates = SaveCandidate::where('user_id', auth()->user()->id)->get()->pluck('candidate_id')->toArray();
		}
		return view('post.createOrEdit.multiSteps.show_candids', ["users" => $candidates, 'saved' => $saved_candidates]);
	}



	// send mail after the post job ()
	public function sendmailtofloowers($id=219)
	{
		//   Mail::to('1997529iresh@gmail.com')->send(new Followmail("this"));
		$user_id = auth()->user()->id;
		$user = DB::table('companies')->where('user_id', $user_id)->first();
		$company_id = $user->id;
		$company_name = $user->name;
		$data['company_id'] = $company_id;
		$data['company_name'] = $company_name;
 	$data['company_postid'] = $id;

		//get followowers list 
		$followers = DB::table('company_followers')
			->join('users', 'users.id', '=', 'company_followers.user_id')
			->select('users.*')
			->where('company_followers.company_id', $company_id)->get();
		foreach ($followers as $follower) {
			echo $follower->email;
			$data['firstname'] = $follower->firstname;
			// send emai to followeers 
			Mail::to($follower->email)->send(new Followmail($data));
		}
		//get followowers list  

	}








	// send mail after the post job ()$postID = 197
	public function sendmailtoalert($postID = 227)
	{
 	$data['company_postid'] = $postID;
		if ($postID == null) {
		} else {
			$user_id = auth()->user()->id;
			$user = DB::table('companies')->where('user_id', $user_id)->first();
			$company_id = $user->id;
			$company_name = $user->name;
			$data['company_id'] = $company_id;
			$data['company_name'] = $company_name;
			$data['post_id'] = $postID;
			$post = DB::table('posts')->where('id', $postID)->first();
			$category_id = $post->category_id;
			$post_type_id = $post->post_type_id;
			$salary_min = $post->salary_min;
			$salary_max = $post->salary_max;
			$sallary = $salary_min . "-" . $salary_max;
			$experience = $post->experience;
			$qualification = $post->qualification;
			$city_id = $post->city_id;
			$gender_id = $post->gender_id;


			if (!empty($category_id)) {
				$category = DB::table('categories')->where('id', $category_id)->first();
				$category_name = $category->name;
			}
			if (!empty($post_type_id)) {
				$post = DB::table('post_types')->where('id', $post_type_id)->first();
				$post_type_name = $post->name;
			}

			if (!empty($city_id)) {
				$cities = DB::table('cities')->where('id', $city_id)->first();
				$cities_name = $cities->name;
			}

			//get alert list 
			$alerts = DB::table('job_alerts')
				->join('users', 'users.id', '=', 'job_alerts.user_id')
				->select('*','job_alerts.qualifications as qualifications','job_alerts.name as alertsname','job_alerts.experience as experience', 'job_alerts.email as alertmail','job_alerts.city_id as city_id1')->get();

			$faind = 0;
			foreach ($alerts as $alert) {

				$usernamer = $alert->name;
				$data['firstname'] = $usernamer;
		        $data['alertname'] =  $alert->alertsname;
				// if ($category_name == $alert->categories && $post_type_name == $alert->types && $sallary == $alert->salary && $experience == $alert->experience  && $qualification == $alert->qualifications && $city_id == $alert->city_id
				//  && $gender_id == $alert->gender ) {
				// 	$faind = 1;
				// }
				 $catagorymatch=0; $typesmatch=0;  $experiencematch=0;  
				 $qualificationmatch=0;  $city_idmatch=0;
				 $gendermatch=0;
				
				if($category_name == $alert->categories || empty($alert->categories)  )
				{
				    $catagorymatch=1;
				}
				
				if($post_type_name == $alert->types || empty($alert->types )  )
				{
				    $typesmatch=1;
				}
				
				
		
				
				if( $alert->experience == 'None')
				{
				     $aexperience='none';
				}else
				{
				     $aexperience=$alert->experience;
				}
				
				
				if($experience == $aexperience || empty($alert->experience)  )
				{
				    $experiencematch=1;
				}
				
				if($qualification == $alert->qualifications || empty($alert->qualifications) || $qualification=="none" )
				{
				    $qualificationmatch=1;
				}
				
	
				
				if($city_id == $alert->city_id1 || empty($alert->city_id1)  )
				{
				    $city_idmatch=1;
				}
				
				
				if($gender_id == 1 )
				{
				    $gender="male";
				}
				
					if($gender_id == 2 )
				{
				    $gender="female";
				}

			if($gender_id == 3 )
				{
				    $gender="any";
				}
				
					if($gender== $alert->gender || empty($alert->gender) || $gender=="any"  )
				{
				    $gendermatch=1;
				}
				
				
				if($catagorymatch==1 && $typesmatch==1 && $experiencematch==1 && $qualificationmatch==1 && $city_idmatch==1 && $gendermatch==1)
				{
				    	echo $faind = 1;
				}
				
				
				
                echo "$category_name == $alert->categories-------$catagorymatch --<br>";
                echo "$post_type_name == $alert->types-------$typesmatch .<br>";
                echo "$experience == $aexperience-------$experiencematch --.<br>";
                echo "$qualification == $alert->qualifications-------$qualificationmatch .<br>";
                echo "$city_id == $alert->city_id1-------$city_idmatch .<br>";
                    echo "$gender == $alert->gender-------$gendermatch .<br>";
             	echo ($alert->alertmail)."  <br>";


				if ($faind == 1) {
					//    send email to alert 
					Mail::to($alert->alertmail)->send(new Alertmail($data));
					echo ($alert->alertmail)." send <br>";
				}
				
					echo "<br><br><br>";
				$faind=0;
			}
		}
	}
}
