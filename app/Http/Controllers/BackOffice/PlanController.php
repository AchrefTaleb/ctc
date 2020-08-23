<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Plan;
use App\User;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Plan as pln;

class PlanController extends Controller
{


    public  function list()
    {
        $plans = Plan::all();

        return view('BackOffice.pages.plan.list',[
            'plans' => $plans,
        ]);
    }


    public function add_plans()
    {
        $key = env("STRIPE_KEY","sk_test_51HGpAqEWB4pgk6TUZBTpg6AECUsetgplbeJOUN5ahd8qF4y8Vs2wCtokc0EoFhu8ofgXo0KkQhB22SCAjNzlJfmP00RtgrOQ4M");

        $stripe = Stripe::setApiKey($key);

        $plnans = Plan::all();

        foreach ($plnans as $item)
        {
            if($item->stripe_id == null)
            {
                $res = Pln::create([
                   // 'billing_scheme' => 'tiered',
                    'usage_type' => 'licensed',
                    'tiers_mode' => 'volume',
                    'currency' => 'EUR',
                    'interval' => 'month',
                    'product' => ['name' => $item->name],
                    'amount' => $item->price * 100,

                ]);

                $item->stripe_id = $res->id;
                $item->save();
            }
        }
    }

    public function createCustomPlan()
    {
        $this->authorize('plan-custom-create', Plan::class);

       $clients = User::role('client')->get();

        return view('BackOffice.pages.plan.custom',
            [
              'clients' => $clients,
            ]
        );
    }

    public function storeCustomPlan(Request $request)
    {
        $key = env("STRIPE_KEY","sk_test_51HGpAqEWB4pgk6TUZBTpg6AECUsetgplbeJOUN5ahd8qF4y8Vs2wCtokc0EoFhu8ofgXo0KkQhB22SCAjNzlJfmP00RtgrOQ4M");

        $stripe = Stripe::setApiKey($key);

            $this->validate($request,[
                'name' => 'required',
                'opening_limit' => 'required',
                'pages' => 'required',
                'family_name' => 'required',
                'type' => 'required',
                'price' => 'required',
                'description' => 'required',
                'note' => 'required'

            ]);
            $plan = new Plan();

            $plan->name = $request->post('name');
            $plan->opening_limit = $request->post('opening_limit');
            $plan->pages = $request->post('pages');
            $plan->family_name = $request->post('family_name');
            $plan->type = $request->post('type');
            $plan->price = $request->post('price');
            $plan->description = $request->post('description');
            $plan->note = $request->post('note');
            if($request->post('type') == 'professional'){
                $this->validate($request,[
                   'user' => 'required'
                ]);

                $plan->user_id = $request->post('user');
            }

            $plan->save();

            if($plan){
                $res = Pln::create([
                    // 'billing_scheme' => 'tiered',
                    'usage_type' => 'licensed',
                    'tiers_mode' => 'volume',
                    'currency' => 'EUR',
                    'interval' => 'month',
                    'product' => ['name' => $plan->name],
                    'amount' => $plan->price * 100,

                ]);

                $plan->stripe_id = $res->id;
                $plan->save();
            }

            return back()->with('success','Votre plan a été enregistré!');

    }
}
