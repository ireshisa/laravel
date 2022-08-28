<?php

namespace App\Http\Controllers\Account;

use App\Models\Endorsement;
use App\Models\User;
use Illuminate\Http\Request;

class EndorsementController extends AccountBaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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
        $endorsementCount =  Endorsement::where("user_id", $user->id)->get()->count();
//        dd($endorsementCount);
        $endorsement = Endorsement::where("user_id", $user->id)->where("endorser_id", auth()->user()->id)->first();
    //   dd($endorsement);
        if (empty($endorsement)) {
            Endorsement::create([
                "user_id" => $user->id,
                "endorser_id" => auth()->user()->id
            ]);
            $endorsementCount++;
            flash("You Have Successfully Endorsed ".$user->first_name.". Thank you!")->success();
        }
        else {
            flash("You Have Already Endorsed ".$user->first_name)->error();

        }

        return redirect()->back()->with('endorsementCount', $endorsementCount);
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
    public function destroy(Review $review) {
        //
    }

}
