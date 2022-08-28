<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Traits\BuyPackage;
use App\Models\User;
use App\Helpers\UrlGen;
use App\Models\Message;
use App\Models\Applicants;
use App\Notifications\ReplySent;
use App\Http\Requests\ReplyMessageRequest;
use Illuminate\Support\Facades\Auth;
use Torann\LaravelMetaTags\Facades\MetaTag;

class ApplicantsController extends AccountBaseController
{
    use BuyPackage;
    	public function __construct()
	{
		parent::__construct();
		
		$this->perPage = (is_numeric(config('settings.listing.items_per_page'))) ? config('settings.listing.items_per_page') : $this->perPage;
	}

    public function index()
    {


        //$applicants = Applicants::all();
        $packageInfo = $this->checkPackageExpiry();
        $applicants =  $this->pendingApplicants->whereIn('delete_request', ['0'])->paginate($this->perPage);
        $showApprove = $packageInfo['expiry'];
        $pagePath="pending-approval";
        if (!$showApprove)
        {
            flash($packageInfo['message'])->error();
        }
//        dd($applicants);
        return view('account.applicants', ['applicants' => $applicants,'showApprove'=>$showApprove,'pagePath'=>$pagePath]);
    }
    
    public function connected()
    {
        view()->share('pagePath', 'connected-companies');
        $applicants =  $this->connectedApplicants->paginate($this->perPage);


        return view('account.connected-company', ['applicants' => $applicants]);
    }
}