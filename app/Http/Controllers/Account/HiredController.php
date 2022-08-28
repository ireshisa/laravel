<?php

namespace App\Http\Controllers\Account;

use App\Models\User;
use App\Helpers\UrlGen;
use App\Models\Message;
use App\Models\Hired;
use App\Notifications\ReplySent;
use App\Http\Requests\ReplyMessageRequest;
use Torann\LaravelMetaTags\Facades\MetaTag;

class HiredController extends AccountBaseController
{

    public function index()
    {


        $applicants = $this->hired->get();

        $applicants->load('candidate','post');

        return view('account.hired', ['applicants' => $applicants]);
    }
}



