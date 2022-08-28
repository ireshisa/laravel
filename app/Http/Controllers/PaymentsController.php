<?php
namespace App\Http\Controllers;


use App\Models\Package;
use App\Models\User;
use App\Models\UserPayment;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentsController extends Controller {


    public function show(Request $request) {

        $packageArray = ["Free Trial","Bronze","Silver","Platinum"];

        /*$request->session()->push('package_id',$request->get('id'));
        if (Auth::user())
        {

            $data = Auth::user()->with('purchasedPackages')->get();
            //for
            return response()->json($data);
        }
        exit();
        if ($request->id > 1)
        {
        //    flash("You have Selected the  ".)

        }
*/
        return view('payment',['package_id'=>2]);
    }

    public function store(Request $request) {
        $package = Package::findorFail($request->package_id);
        return view('payment',['package_id'=>$package->id,'prices'=>$package->price,'short_name'=>$package->short_name]);
    }

    public function upgradePackage(Request $request) {
        $package = Package::findorFail($request->package_id);
        $user = User::with('purchasedPackage')->findOrFail(Auth::user()->id);
        if (isset($user->purchasedPackage) && count($user->purchasedPackage))
        {
            if ($request->package_id == 1)
            {
                return response()->json(["status"=>"error","title"=>"Trail Period Can be Used only Once","description"=>"Your Trail Period is Ended/Already Activate"]);
            }
            else
            {
                $package_expiry = $user->purchasedPackage[0]->pivot->expiry_date;
                $current_connects = $user->purchasedPackage[0]->pivot->available_connects;
                $current_connects = ($current_connects < 0)?0:$current_connects;
                $user->purchasedPackage()->sync([]);
                if ($package_expiry <= date('Y-m-d H:i:s'))
                {
                    $newExpiry =  Carbon::now()->addMonths($package->duration);
                    $current_connects  = 0;

                }
                else {
                    $newExpiry  = (new Carbon($package_expiry))->addMonths($package->duration);
                }
                $user->purchasedPackage()->sync([$package->id=>['available_connects'=>$current_connects+$package->connects,'expiry_date'=>$newExpiry]]);

            }
            UserPayment::create(['user_id'=>Auth::user()->id,'package_id'=>$package->id,'payment_ref'=>$request->payment_ref]);
            return response()->json(['status'=>'success','title'=>'Package Upgraded','description'=>$package->short_name. ' Package is Added Successfully']);
        }
        else {
            if ($request->package_id == 1)
            {
                $user->purchasedPackage()->sync([$package->id=>['available_connects'=>$package->connects,'expiry_date'=>Carbon::now()->addMonths($package->duration)]]);
                UserPayment::create(['user_id'=>Auth::user()->id,'package_id'=>1,'payment_ref'=>'Trial']);
                return response()->json(['status'=>'success','title'=>'Trial Period Activated','description'=>'Trial Period is Activated Successfully']);

            }
        }
        return response()->json(['status'=>'error','title'=>'Package Not Activated/Added','description'=>'There are some issues when Upgrading/Activating Package. Please Contact Us to Resolve this Issue']);




   }
}