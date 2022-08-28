<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Traits\BuyPackage;
use App\Models\User;
use App\Helpers\UrlGen;
use App\Models\Message;
use App\Models\Package;
use App\Notifications\ReplySent;
use App\Http\Requests\ReplyMessageRequest;
use Illuminate\Support\Facades\Auth;
use Torann\LaravelMetaTags\Facades\MetaTag;

class PackageController extends AccountBaseController
{
use BuyPackage;
    public function index()
    {


        $user = User::with('purchasedPackage')->findOrFail(Auth::user()->id);

        $package = null;
        if (count($user->purchasedPackage) > 0) {
            $package = $user->purchasedPackage[0];

        }
        $packageData = $this->showPackages($user);
        $showPackages = $packageData['showPackages'];
        $packages = $packageData['packages'];

        return view('account.package', ['packages' => $packages,'package'=>$package]);
    }
}