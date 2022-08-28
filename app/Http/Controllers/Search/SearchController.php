<?php
/**
//
 */

namespace App\Http\Controllers\Search;

use App\Helpers\Search;
use App\Http\Controllers\Search\Traits\PreSearchTrait;
use App\Models\Category;
use App\Models\PostType;
use App\Models\SavedPost;
use App\Models\SubAdmin1;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\JobAlert;
use App\Models\Post;
use Illuminate\Support\Str;
use Torann\LaravelMetaTags\Facades\MetaTag;

class SearchController extends BaseController
{
	use PreSearchTrait;
	
	public $isIndexSearch = true;
	
	protected $cat = null;
	protected $subCat = null;
	protected $city = null;
	protected $admin = null;
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */

	public function index(Request $request)
	{
		view()->share('isIndexSearch', $this->isIndexSearch);

        $result = Post::with('category','company','city','salaryType')->where('is_filled',0);

        $provinces = SubAdmin1::orderBy('name','asc')->get();

        if ($request->filled('date_posted') && strtolower($request->date_posted) !== 'all')
        {
            $v = $request->date_posted;
            $date = null;
            if (Str::contains($v,'h'))
            {
                $date = Carbon::now()->subHours(explode('h',$v)[0])->format('Y-m-d H:i');
            }
            else
            {
                $date = Carbon::now()->subDays(explode('d',$v)[0])->format('Y-m-d H:i');
            }

            $result->where('created_at','>=',$date);
        }

        if ($request->filled('city') && $request->city !== '')
        {
            $result->where('city_id', '=', $request->city);
        }

        if ($request->filled('types') && $request->types != "all")
        {
            $result->whereIn('post_type_id',explode(",",$request->types));
        }

        if ($request->filled('salary') && $request->salary != 'all')
        {
            $singleArray = explode(',',$request->salary);
            $min = -1;
            $max = -1;
            foreach ($singleArray as $single)
            {
                $splitted = explode('-',$single);
                if ($min == -1)
                {
                    $min = $splitted[0];
                    $max = $splitted[1];
                }


                else if (count($splitted) == 2) {
                    if ($splitted[0] < $min)
                    {
                        $min = $splitted[0];
                    }
                    else if ($splitted[1] > $max)
                    {
                        $max = $splitted[1];
                    }
                }

            }


            $result->where('salary_min','>=',$min)->where('salary_max','<=',$max);
        }

        if ($request->filled('category_id'))
        {
            $v = explode(',',$request->category_id);

            $result->whereIn('category_id',$v);
        }

        if ($request->filled('search'))
        {
            $result->where('title','LIKE','%'.$request->search.'%');
        }

		$result= $result->orderByDesc('id')->paginate(5);

        /*-----------------------------------*/

		$categories = Category::where('parent_id',0)->orderBy('id','asc')->get();

		// Pre-Search
		if (request()->filled('c')) {
			if (request()->filled('sc')) {
				$this->getCategory(request()->get('c'), request()->get('sc'));
			} else {
				$this->getCategory(request()->get('c'));
			}
		}

		if (request()->filled('l') || request()->filled('location')) {
			$city = $this->getCity(request()->get('l'), request()->get('location'));
		}

		if (request()->filled('r') && !request()->filled('l')) {
			$admin = $this->getAdmin(request()->get('r'));
		}
		
		// Pre-Search values
		$preSearch = [
			'city'  => (isset($city) && !empty($city)) ? $city : null,
			'admin' => (isset($admin) && !empty($admin)) ? $admin : null,
		];
		
		// Search
		$search = new Search($preSearch);
		$data = $search->fechAll();
		
		// Export Search Result
		view()->share('count', $data['count']);
		view()->share('paginator', $data['paginator']);
		
		// Get Titles
		$title = $this->getTitle();
		$this->getBreadcrumb();
		$this->getHtmlTitle();
		
		// Meta Tags
		MetaTag::set('title', $title);
		MetaTag::set('description', $title);
		$alertId = request()->filled('alert-id') ? request()->get('alert-id') : null;
        $alertName = null;
        $alertEmail = null;
        $notifyType = null;
        $savedPosts = [];
		if (!empty($alertId) && auth()->check())
        {
            $alert = JobAlert::where('id',$alertId)->where('user_id',auth()->user()->id)->first();

            if (!empty($alert))
            {
                $alertEmail = $alert->email;
                $alertName = $alert->name;
                $notifyType = $alert->period;
            }
            else {
                $alert = null;
                flash("You don't have the access to the Following Alert")->error();
            }
        }
		else if(auth()->check() && auth()->user()->user_type_id == 2) {
            $alertEmail = auth()->user()->email;
            $savedPosts = SavedPost::where('user_id',auth()->user()->id)->get()->pluck('post_id')->toArray();
            $alert = JobAlert::where('user_id',auth()->user()->id)->orderBy('id','desc')->first();
            if (!empty($alert))
            {
                $alertName = $alert->name;
                $notifyType = $alert->period;
            }
        }

        view()->share('saved',$savedPosts);

        /*$alertName = request()->filled('name') ? request()->get('name') : "";
        $alertEmail = request()->filled('email') ? request()->get('email') : ((auth()->user()->email && auth()->user()->user_type_id == 1)?? '');
        $notifyType = request()->filled('notify-type') ? request()->get('notify-type') : "";
        */
        $data = ['alertName' => $alertName, 'alert_id'=>$alertId,'alertEmail' => $alertEmail,'notifyType'=>$notifyType,'results'=>$result,'categories'=>$categories];

        // if ($request->ajax())
        // {
        //     return view('search.ajax-jobs', $data)->render();
        // }
        // else
        // {
            $data["post_types"] = PostType::all();

            return view('search.serp', $data)->with('provinces', $provinces);
        // }
    }
    
    
    
    public function ajaxJobs(Request $request)
	{
		view()->share('isIndexSearch', $this->isIndexSearch);

        $result = Post::with('category','company','city','salaryType')->where('is_filled',0);

        $provinces = SubAdmin1::orderBy('name','asc')->get();

        if ($request->filled('date_posted') && strtolower($request->date_posted) !== 'all')
        {
            $v = $request->date_posted;
            $date = null;
            if (Str::contains($v,'h'))
            {
                $date = Carbon::now()->subHours(explode('h',$v)[0])->format('Y-m-d H:i');
            }
            else
            {
                $date = Carbon::now()->subDays(explode('d',$v)[0])->format('Y-m-d H:i');
            }

            $result->where('created_at','>=',$date);
        }

        if ($request->filled('city') && $request->city !== '')
        {
            $result->where('city_id', '=', $request->city);
        }

        if ($request->filled('types') && $request->types != "all")
        {
            $result->whereIn('post_type_id',explode(",",$request->types));
        }

        if ($request->filled('salary') && $request->salary != 'all')
        {
            $singleArray = explode(',',$request->salary);
            $min = -1;
            $max = -1;
            foreach ($singleArray as $single)
            {
                $splitted = explode('-',$single);
                if ($min == -1)
                {
                    $min = $splitted[0];
                    $max = $splitted[1];
                }


                else if (count($splitted) == 2) {
                    if ($splitted[0] < $min)
                    {
                        $min = $splitted[0];
                    }
                    else if ($splitted[1] > $max)
                    {
                        $max = $splitted[1];
                    }
                }

            }


            $result->where('salary_min','>=',$min)->where('salary_max','<=',$max);
        }

        if ($request->filled('category_id'))
        {
            $v = explode(',',$request->category_id);

            $result->whereIn('category_id',$v);
        }

        if ($request->filled('search'))
        {
            $result->where('title','LIKE','%'.$request->search.'%');
        }

		$result= $result->orderByDesc('id')->paginate(5);

        /*-----------------------------------*/

		$categories = Category::where('parent_id',0)->orderBy('id','asc')->get();

		// Pre-Search
		if (request()->filled('c')) {
			if (request()->filled('sc')) {
				$this->getCategory(request()->get('c'), request()->get('sc'));
			} else {
				$this->getCategory(request()->get('c'));
			}
		}

		if (request()->filled('l') || request()->filled('location')) {
			$city = $this->getCity(request()->get('l'), request()->get('location'));
		}

		if (request()->filled('r') && !request()->filled('l')) {
			$admin = $this->getAdmin(request()->get('r'));
		}
		
		// Pre-Search values
		$preSearch = [
			'city'  => (isset($city) && !empty($city)) ? $city : null,
			'admin' => (isset($admin) && !empty($admin)) ? $admin : null,
		];
		
		// Search
		$search = new Search($preSearch);
		$data = $search->fechAll();
		
		// Export Search Result
		view()->share('count', $data['count']);
		view()->share('paginator', $data['paginator']);
		
		// Get Titles
		$title = $this->getTitle();
		$this->getBreadcrumb();
		$this->getHtmlTitle();
		
		// Meta Tags
		MetaTag::set('title', $title);
		MetaTag::set('description', $title);
		$alertId = request()->filled('alert-id') ? request()->get('alert-id') : null;
        $alertName = null;
        $alertEmail = null;
        $notifyType = null;
        $savedPosts = [];
		if (!empty($alertId) && auth()->check())
        {
            $alert = JobAlert::where('id',$alertId)->where('user_id',auth()->user()->id)->first();

            if (!empty($alert))
            {
                $alertEmail = $alert->email;
                $alertName = $alert->name;
                $notifyType = $alert->period;
            }
            else {
                $alert = null;
                flash("You don't have the access to the Following Alert")->error();
            }
        }
		else if(auth()->check() && auth()->user()->user_type_id == 2) {
            $alertEmail = auth()->user()->email;
            $savedPosts = SavedPost::where('user_id',auth()->user()->id)->get()->pluck('post_id')->toArray();
            $alert = JobAlert::where('user_id',auth()->user()->id)->orderBy('id','desc')->first();
            if (!empty($alert))
            {
                $alertName = $alert->name;
                $notifyType = $alert->period;
            }
        }

        view()->share('saved',$savedPosts);

        /*$alertName = request()->filled('name') ? request()->get('name') : "";
        $alertEmail = request()->filled('email') ? request()->get('email') : ((auth()->user()->email && auth()->user()->user_type_id == 1)?? '');
        $notifyType = request()->filled('notify-type') ? request()->get('notify-type') : "";
        */
        $data = ['alertName' => $alertName, 'alert_id'=>$alertId,'alertEmail' => $alertEmail,'notifyType'=>$notifyType,'results'=>$result,'categories'=>$categories];

            return view('search.ajax-jobs', $data)->render();
        
        
    }
}
