<?php


namespace App\Http\Controllers\Traits;


use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait BuyPackage
{

    public function showPackages(User $user)
    {
        $buyPackages = false;
        $packages =  Package::trans()->applyCurrency()->with('currency')->orderBy('lft')->get();
        $enableTrial = true;
        if(isset($user->purchasedPackage) && count($user->purchasedPackage) > 0)
        {
            $enableTrial = false;
            if ($user->purchasedPackage[0]->pivot->expiry_date < date('Y-m-d H:i:s') || $user->purchasedPackage[0]->pivot->available_connects <= 0)
            {



                $buyPackages = true;
//                if ($user->purchasedPackage[0]->pivot->expiry_date < date('Y-m-d H:i:s'))
//                {
//                    session()->push('current_expiry',$user->purchasedPackage[0]->expiry_date);
//
//                }
//                     $user->purchasedPackage()->sync([$user->purchasedPackage[0]->id =>["available_connects"=>0]]);


            }

        }
        else {
            $buyPackages = true;

        }

        if (!$enableTrial)
        $packages= $packages->filter(function ($value, $key) {
            return $value->id != 1;
        });
        return ['showPackages'=>$buyPackages,'packages'=>$packages];
    }

    public function checkPackageExpiry($id=null)
    {
        $message = "";
        $packageIsNotExpired = true;
        $userId = (!empty($id) ?$id:auth()->user()->id);
        $user = User::with('purchasedPackage')->findOrFail($userId);

        if (isset($user->purchasedPackage) && count($user->purchasedPackage) > 0)
        {
            if ($user->purchasedPackage[0]->pivot->available_connects <= 0)
            {
                $packageIsNotExpired = false;
                $message = "You don't have sufficient Connects to Approve the Applicants. Please Buy/Upgrade Package";
            }
            else if ($user->purchasedPackage[0]->pivot->expiry_date < date('Y-m-d H:i:s'))
            {

                $packageIsNotExpired = false;
                $message = "Your Current Package is Expired. Please Buy/Upgrade Package to Approve Applicants";
            }

        }
        else {
            $packageIsNotExpired = false;

            $message = "Please Choose the Package in order to Get Connected with Applicants";
        }

        return ['expiry'=>$packageIsNotExpired,"message"=>$message];
    }

    public function deductConnect($id = null)
    {
        if (empty($id))
        {
            $user = User::with('purchasedPackage')->findOrFail(Auth::user()->id);

        }
        else {
            $user = User::with('purchasedPackage')->findOrFail($id);

        }

        $newConnects = $user->purchasedPackage[0]->pivot->available_connects - 1;
        $package_id = $user->purchasedPackage[0]->id;
        $expiry_date = $user->purchasedPackage[0]->pivot->expiry_date;
        $user->purchasedPackage()->sync([$package_id=>['available_connects'=>$newConnects,'expiry_date'=>$expiry_date]]);
    }
}