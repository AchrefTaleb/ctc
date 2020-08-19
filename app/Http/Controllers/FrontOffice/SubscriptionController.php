<?php

namespace App\Http\Controllers\FrontOffice;

use App\Client;
use App\Helpers\stripeHelper;
use App\Http\Controllers\Controller;
use App\Plan;
use App\Request as Req;
use App\Subscription;
use Exception;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{


    public function index()
    {
        $plans = Plan::where('user_id',auth()->user()->id)->get();

        if(count($plans) <= 0) {
            $plans = Plan::where('type','standard')->where('status',true)->get();
        }




        return view('FrontOffice.pages.subscription.index',[
            "plans" => $plans,
        ]);
    }

    public function checkout(Request $request)
    {
        $this->validate($request,[
            'plan' => "required",
        ]);

        $plan = Plan::find($request->post('plan'));


        return view('FrontOffice.pages.subscription.checkout',[
            "plan" => $plan,
        ]);
    }

    public function charge(Request $request)
    {
        $this->validate($request,[
            'stripeToken' => "required",
            'plan' => "required",
        ]);

        $plan = Plan::findOrFail($request->post('plan'));

        $stripeHelper = new stripeHelper();

       $res =  $stripeHelper->addCard(auth()->user(),$request->post('stripeToken'));

        if(!($res instanceof Exception))
        {
            $p = [
                [
                    'plan' => $plan->stripe_id,
                    'quantity' => 1,
                ]
            ];
           $res =  $stripeHelper->addSubscription(auth()->user(),$p);
            if(!($res instanceof Exception))
            {
                $sub = new Subscription();

                $sub->user_id = auth()->user()->id;
                $sub->stripe_id = $res->id;
                $sub->plan_id = $plan->id;
                $sub->status = 1;

                $sub->save();

                return redirect()->route('frontoffice.home')->with('success','Inscription reussite!');
            }else{

                return back()->with('error','Un probleme occured!');
            }
        }

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
}