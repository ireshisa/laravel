<?php

namespace App\Http\Controllers;

use App\Helpers\Localization\Country as CountryLocalization;
use App\Helpers\Localization\Helpers\Country as CountryLocalizationHelper;
use App\Http\Controllers\Traits\BuyPackage;
use App\Models\Package;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Torann\LaravelMetaTags\Facades\MetaTag;
class PricingController extends Controller
{
    use BuyPackage;
    public function index(){
        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries());
        $packages = null;
        if (Auth::check())
        {
            $user = User::with('purchasedPackage')->findOrFail(Auth::user()->id);

            $packageInfo = $this->showPackages($user);
            $packages = $packageInfo['packages'];

        }
        else
        {
            $packages =  Package::trans()->applyCurrency()->with('currency')->orderBy('lft')->get();
        }
          // Meta Tags
        MetaTag::set('title', t('Pricing'));
        MetaTag::set('description', t('Pricing - :app_name', ['app_name' => config('settings.app.app_name')]));

        return view('customs.pricing.index',compact('packages'))->with('countries', $data['countries']);
    }
}
