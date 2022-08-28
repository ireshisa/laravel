<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Search\BaseController;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyFollower;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CompanyController extends BaseController
{

    public function getCompany($id)
    {
        $company = Company::withCount('posts')->findOrFail($id);
        $following = null;
        if (auth()->user())
        {
            $following = CompanyFollower::where('user_id',auth()->user()->id)->where('company_id',$id)->first();

        }
        $showFollow=true;
        if ($following || auth()->guest())
        {
            $showFollow=false;
        }
        return view('search.company.single-company',compact('company','showFollow'));
    }


}