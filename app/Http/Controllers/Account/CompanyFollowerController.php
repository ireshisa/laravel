<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyFollower;

class CompanyFollowerController extends AccountBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function follow($id) {
        $company = Company::findOrFail($id);
        $following = CompanyFollower::where('user_id', auth()->user()->id)->where('company_id', $id);
        if (!$following->count()) {
            CompanyFollower::create([
                "user_id" => auth()->user()->id,
                "company_id" => $id
            ]);
        }
        flash("You are now Following the ".$company->name)->success();
        return redirect()->back();
    }

    public function unfollow($id) {
        $following = CompanyFollower::where('user_id', auth()->user()->id)->where('company_id', $id)->first();
        $company = Company::findorFail($id);
        if ($following) {
           $following->delete();
            flash("You are Now Stopped Following the ".$company->name)->success();
        }

        return redirect()->back();
    }
}
