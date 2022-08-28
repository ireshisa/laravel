<?php
/**
//
 */

namespace App\Http\Controllers\Account;

use App\Http\Requests\ResumeRequest;
use App\Models\Category;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Torann\LaravelMetaTags\Facades\MetaTag;
use Auth;

class CoverController extends AccountBaseController
{
	private $perPage = 10;
	public $pagePath = 'resumes';
	
	public function __construct()
	{
		parent::__construct();
		
		$this->perPage = (is_numeric(config('settings.listing.items_per_page'))) ? config('settings.listing.items_per_page') : $this->perPage;
		
		view()->share('pagePath', $this->pagePath);
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
        $cacheId = 'categories.all.' . config('app.locale');
        $cats = Cache::remember($cacheId, $this->cacheExpiration, function () {
            $cats = Category::trans()->orderBy('lft')->get();
            return $cats;
        });
        if ($cats->count() > 0) {
            $cats = collect($cats)->keyBy('tid');
        }

		// Get all User's Resumes
		$resumes = $this->resumes->paginate($this->perPage);

		// Meta Tags
		MetaTag::set('title', t('My Coverletter'));
		MetaTag::set('description', t('My Resumes List - :app_name', ['app_name' => config('settings.app.app_name')]));
		
		return view('account.resume.cover_index')->with('resumes', $resumes)->with('cats', $cats);
	}
	
	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		// Meta Tags
		MetaTag::set('title', t('Create a resume'));
		MetaTag::set('description', t('Create a resume - :app_name', ['app_name' => config('settings.app.app_name')]));
		
		return view('account.resume.create');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param ResumeRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store(ResumeRequest $request)
	{
		// Create Resume
		$resumeInfo = [
			'country_code' => config('country.code'),
			'user_id'      => auth()->user()->id,
			'name'         => $request->input('resume.name'),
			'active'       => 1,
		];
		$resume = new Resume($resumeInfo);
		$resume->save();
		
		// Save the Resume's File
		if ($request->hasFile('resume.filename')) {
			$resume->filename = $request->file('resume.filename');
			$resume->save();
		}
		
		flash(t("Your resume has created successfully."))->success();
		
		return redirect(config('app.locale') . '/account/resumes');
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function show($id)
	{
		return redirect(config('app.locale') . '/account/resumes/' . $id . '/edit');
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $id
	 * @return $this
	 */
	public function edit($id)
	{
		// Get the Resume
		$resume = Resume::where('id', $id)->where('user_id', auth()->user()->id)->firstOrFail();
		
		// Meta Tags
		MetaTag::set('title', t('Edit the resume'));
		MetaTag::set('description', t('Edit the resume - :app_name', ['app_name' => config('settings.app.app_name')]));
		
		return view('account.resume.edit')->with('resume', $resume);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param $id
	 * @param ResumeRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update($id, ResumeRequest $request)
	{
		// Get Resume
		$resume = Resume::where('id', $id)->where('user_id', auth()->user()->id)->firstOrFail();
		
		$resume->name = $request->input('resume.name');
		$resume->save();
		
		// Save the Resume's File
		if ($request->hasFile('resume.filename')) {
			$resume->filename = $request->file('resume.filename');
			$resume->save();
		}
		
		// Message Notification & Redirection
		flash(t("Your resume has updated successfully."))->success();
		
		return redirect(config('app.locale') . '/account/resumes');
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param null $id
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function destroy($id = null)
	{
		// Get Entries ID
		$ids = [];
		if (request()->filled('entries')) {
			$ids = request()->input('entries');
		} else {
			if (!is_numeric($id) && $id <= 0) {
				$ids = [];
			} else {
				$ids[] = $id;
			}
		}
		
		// Delete
		$nb = 0;
		foreach ($ids as $item) {
			$resume = Resume::where('id', $item)->where('user_id', auth()->user()->id)->firstOrFail();
			if (!empty($resume)) {
				// Delete Entry
				$nb = $resume->delete();
			}
		}
		
		// Confirmation
		if ($nb == 0) {
			flash(t("No deletion is done. Please try again."))->error();
		} else {
			$count = count($ids);
			if ($count > 1) {
				flash(t("x :entities has been deleted successfully.", ['entities' => t('resumes'), 'count' => $count]))->success();
			} else {
				flash(t("1 :entity has been deleted successfully.", ['entity' => t('resume')]))->success();
			}
		}
		
		return redirect(config('app.locale') . '/account/resumes');
	}

    public function updateSkills(Request $request)
    {
        if(Auth::check()){
           $user = Auth::user();
            $user->age = $request->age;
            $user->gender = $request->gender;
            $user->location = $request->location;
            $user->sector_id = $request->sector_id;
            $user->qualifications = $request->qualifications;
            $user->experience = $request->experience;
            $user->salary = $request->salary;
            $user->skills= $request->skills;
             $user->extra_skills= $request->extra_skills;
            $user->extra_experiences= $request->experiences;
            $user->extra_educations= $request->extra_educations;

            $user->update();

            Auth::setUser($user);
        }

        flash('Details updated successfully')->success();

        return redirect('/account/cover');
	}
	
	public function resumeDownload()
	{
	       $data= Auth::user();
		return view('account.resume.cv_build',compact('data'));
	}
}
