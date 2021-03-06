<?php

namespace App\Http\Controllers\FrontOffice;

use App\Client;
use App\Helpers\stripeHelper;
use App\Http\Controllers\Controller;
use App\Plan;
use App\promo;
use App\Request as Req;
use App\Subscription;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SubscriptionController extends Controller
{


    public function index()
    {
        if(!auth()->user()->contract){
          //  return redirect()->route('frontoffice.subscription.contract');
        }
        $plans = Plan::where('user_id',auth()->user()->id)->get();

        if(count($plans) <= 0) {
            $plans = Plan::where('type','standard')->where('status',true)->get();
        }
        $value = Cookie::get('plan');
        if($value)
        {
            $plans = Plan::where('id',$value)->get();
        }




        return view('FrontOffice.pages.subscription.index',[
            "plans" => $plans,
        ]);
    }

    public function checkout(Request $request)
    {
        $this->validate($request,[
            'plan' => "required",
            'option' => "required"
        ]);

        $plan = Plan::find($request->post('plan'));


        return view('FrontOffice.pages.subscription.checkout',[
            "plan" => $plan,
            "option" => $request->post('option')
        ]);
    }

    public function charge(Request $request)
    {
        $this->validate($request,[
            'stripeToken' => "required",
            'plan' => "required",
            'cgvu' => "required",
            'contract_date' => "required"
        ]);
        $promo = null;
        if($request->post('promo')){
            $promo = promo::where('promo_code',$request->post('promo'))->first();
            if(!$promo || (now()->diffInMonths($promo->created_at) > $promo->months)){
                $promo = null;
            }
        }

        $plan = Plan::findOrFail($request->post('plan'));

        $stripeHelper = new stripeHelper();

       $res =  $stripeHelper->addCard(auth()->user(),$request->post('stripeToken'));

       $option = $request->post('option').'_stripe_id';
        if(!($res instanceof Exception))
        {
            $p = [
                [
                    'plan' => $plan->$option,
                    'quantity' => 1,
                ]
            ];
           $res =  $stripeHelper->addSubscription(auth()->user(),$p,$promo->stripe_id ?? null);

            if(!($res instanceof Exception))
            {
                $sub = new Subscription();

                $sub->user_id = auth()->user()->id;
                $sub->stripe_id = $res->id;
                $sub->commitment = (int)str_replace('m','',$request->post('option'));
                $sub->plan_id = $plan->id;
                $sub->status = 1;

                $sub->save();
                $user = auth()->user();
                $user->contract_start = $request->post('date_contract');
                $user->save();
                return redirect()->route('frontoffice.home')->with('success','Inscription réussite!');
            }else{

                return back()->with('error','Un problème est survenu!');
            }
        }
        return back()->with('error','Un problème est survenu!');
    }

    public function user_plan()
    {
        $subscription = Client::find(auth()->user()->id)->subscription;
        $stripHelper = new stripeHelper();

        $res = $stripHelper->getAllInvoices(auth()->user());

        return view('FrontOffice.pages.subscription.subscription',[
            'subscription' => $subscription,
            'invoices' => $res->data,
        ]);
    }

    public function getReduction(Request $request)
    {
        $promo = promo::wherePromo_code($request->post('code'))->first();

        if($promo &&(now()->diffInMonths($promo->created_at) < $promo->months) ){
            return response()->json($promo->reduction,200);
        }
        return response()->json(0,200);
    }


    public function contract(){

        if(auth()->user()->contract){
            return redirect()->route('frontoffice.subscription.create');
        }
        return view('FrontOffice.pages.subscription.contract');
    }
}
