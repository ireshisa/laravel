<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use App\Helpers\UrlGen;
use App\Models\Message;
use App\Models\SaveCandidate;
use App\Models\Applicants;
use App\Notifications\ReplySent;
use App\Http\Requests\ReplyMessageRequest;
use Torann\LaravelMetaTags\Facades\MetaTag;

class SaveCandidateController extends AccountBaseController
{

    public function index()
    {


        $applicants = SaveCandidate::where('user_id',auth()->id())->orderBy('id','desc')->get();


        return view('account.save-applicant', ['applicants' => $applicants]);
    }
    
    
    
    public function destroy($id){
        
        
          $data=SaveCandidate::find($id);
          if(!empty($data)):
                $data->delete();
              endif;
        dd($data);
        return redirect()->route('save.candidate.list');
    }
}