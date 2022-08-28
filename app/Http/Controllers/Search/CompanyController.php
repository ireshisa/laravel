<?php
/**
//
 */

namespace App\Http\Controllers\Search;

use App\Helpers\Search;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\SubAdmin1;
use App\Models\Teamsize;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Torann\LaravelMetaTags\Facades\MetaTag;
use App\Models\CompanyFollower;

class CompanyController extends BaseController
{
	private $perPage = 10;
	public $isCompanySearch = true;
	public $company;
    protected $filters = [
        'date_posted' => [
            'field' => 'created_at',
            'condition' => '>=',
        ],

        'category_id' => [
            'field' => 'sector_id',
            'condition' => '=',
        ],
        'team_size' => [
            'field' => 'teamsize_id',
            'condition' => '=',
        ],
        'year_found' => [
            'field' => 'yearfound',
            'condition' => '>=',
        ]
    ];

	
	public function __construct(Request $request)
	{
		parent::__construct($request);
		
		$this->perPage = (is_numeric(config('settings.listing.items_per_page'))) ? config('settings.listing.items_per_page') : $this->perPage;
	}
	
	/**
	 * Listing of Companies
	 *
	 * @return $this
	 */

	public function getCompaniesAjax(Request $request)
    {
        $data = $this->getCompanies($request);
//return response()->json($data);
        $html = view('search.company.company',['companies'=>$data])->render();

        return response()->json($html);
    }

    private function getCompanies($request)
    {
        $companies = Company::whereHas('posts', function($query) {
            $query->currentCountry();
        })->with('city','followers','sector','teamSize')->withCount(['posts' => function($query) {
            $query->currentCountry();
        }]);

        foreach ($this->filters as $filter => $options)
        {
            if ($value = $request->{$filter})
            {

                if ($filter == "date_posted")
                {
                    $splitted_d = explode('d', $value);
                    $splitted_h = explode('h', $value);
                    $date = null;
                    if ($value !== 'all')
                    {
                        if (count($splitted_h) > 1) {
                            $date = Carbon::now()->subHours($splitted_h[0])->format('Y-m-d H:i:s');
                        } else {
                            $date = Carbon::now()->subDays($splitted_d[0])->format('Y-m-d H:i:s');
                        }

                        $companies->whereHas('posts',function ($q) use($options,$date)
                        {
                            $q->where($options['field'], $options['condition'],$date);
                        });

                    }
                }
                else if ($filter == "year_found")
                {
                    $companies->whereRaw("CAST(yearfound AS SIGNED) " . $options['condition'] . "?", [(int) $value]);
                }
                else if ($filter == "year_found")
                {
                    $companies->whereRaw("CAST(yearfound AS SIGNED) " . $options['condition'] . "?", [(int) $value]);
                }
                else
                {

                    $splittedArr = explode(',', $value);

                    $companies->whereIn($options['field'], $splittedArr);

                }

            }
        }
        if ($request->filled('province'))
        {
            if ($request->filled('city'))
            {
                $explode = explode(',',$request->city);
                $companies->whereIn('city_id',$explode);
            }
            else {
                $cites = City::where('subadmin1_code',$request->province)->get()->pluck('id');

                $companies->whereIn('city_id',$cites);
            }
        }
        if ($request->filled('search'))
        {
            $companies->where('name','LIKE',"%".$request->search."%");

        }

        // Apply search filter
//		if (Input::filled('q')) {
//			$keywords = rawurldecode(Input::get('q'));
//			$companies = $companies->where('name', 'LIKE', '%' . $keywords . '%')->whereOr('description', 'LIKE', '%' . $keywords . '%');
//		}


        // Get Companies List with pagination
        $companies = $companies->orderByDesc('id')->paginate($this->perPage);
       // dd($companies);
        return $companies;
    }
	public function index(Request $request)
	{
		// Get Companies List
	    $companies = $this->getCompanies($request);

        $provinces = SubAdmin1::orderBy('name','asc')->get();
        $teamSizes = Teamsize::orderBy('name','asc')->get();
        $sectors = Category::orderBy('name', 'asc')->get();

        if ($request->filled('search'))
        {

        }
		// Meta Tags
		MetaTag::set('title', t('Companies List'));
		MetaTag::set('description', t('Companies List - :app_name', ['app_name' => config('settings.app.app_name')]));
		
		return view('search.company.index')->with('companies', $companies)->with('provinces',$provinces)->with('teamSizes', $teamSizes)->with('categories', $sectors);
	}

    public function getCompany($id)
    {
        $company = Company::findOrFail($id)->withCount('posts')->first();
    }
	
	/**
	 * Show a Company profiles (with its Jobs ads)
	 *
	 * @param $countryCode
	 * @param null $companyId
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function profile($countryCode, $companyId = null)
    {
		// Check multi-countries site parameters
		if (!config('settings.seo.multi_countries_urls')) {
			$companyId = $countryCode;
		}
		
		// Get Company
		$this->company = Company::findOrFail($companyId);
	
		// Get the Company's Jobs
		$data = $this->jobs($this->company->id);
		
		// Check if user following company
		$following = CompanyFollower::where('user_id', (auth()->user()?auth()->user()->id:0))->where('company_id', $this->company->id);
		
		// Share the Company's info with the view
		$data['company'] = $this->company;
		$data['isFollowing'] = $following->count() ? true : false;
	
		return view('search.company.profile', $data);
    }
	
	/**
	 * Get the Company Jobs ads
	 *
	 * @param $companyId
	 * @return array
	 */
	private function jobs($companyId)
	{
		view()->share('isCompanySearch', $this->isCompanySearch);
		
		// Search
		$search = new Search();
		$data = $search->setCompany($companyId)->setRequestFilters()->fetch();
		
		// Get Titles
		$bcTab = $this->getBreadcrumb();
		$htmlTitle = $this->getHtmlTitle();
		view()->share('bcTab', $bcTab);
		view()->share('htmlTitle', $htmlTitle);
		
		// Meta Tags
		$title = $this->getTitle();
		MetaTag::set('title', $title);
		MetaTag::set('description', $title);
		
		// Translation vars
		view()->share('uriPathCompanyId', $companyId);
		
		return $data;
	}
}
