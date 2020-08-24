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
                'm3_price' => 'required',
                'm6_price' => 'required',
                'm9_price' => 'required',
                'm12_price' => 'required',
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
            $plan->m3_price = $request->post('m3_price');
            $plan->m6_price = $request->post('m6_price');
            $plan->m9_price = $request->post('m9_price');
            $plan->m12_price = $request->post('m12_price');
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
                // 3m
                $res = Pln::create([
                    // 'billing_scheme' => 'tiered',
                    'usage_type' => 'licensed',
                    'tiers_mode' => 'volume',
                    'currency' => 'EUR',
                    'interval' => 'month',
                    'interval_count' => 3,
                    'product' => ['name' => $plan->name.' 3 mois'],
                    'amount' => $plan->m3_price * 100,

                ]);

                $plan->m3_stripe_id = $res->id;

                // 6m
                $res = Pln::create([
                    // 'billing_scheme' => 'tiered',
                    'usage_type' => 'licensed',
                    'tiers_mode' => 'volume',
                    'currency' => 'EUR',
                    'interval' => 'month',
                    'interval_count' => 6,
                    'product' => ['name' => $plan->name.' 6 mois'],
                    'amount' => $plan->m6_price * 100,

                ]);

                $plan->m6_stripe_id = $res->id;

                // 9m
                $res = Pln::create([
                    // 'billing_scheme' => 'tiered',
                    'usage_type' => 'licensed',
                    'tiers_mode' => 'volume',
                    'currency' => 'EUR',
                    'interval' => 'month',
                    'interval_count' => 9,
                    'product' => ['name' => $plan->name.' 9 mois'],
                    'amount' => $plan->m9_price * 100,

                ]);

                $plan->m9_stripe_id = $res->id;

                // 12m
                $res = Pln::create([
                    // 'billing_scheme' => 'tiered',
                    'usage_type' => 'licensed',
                    'tiers_mode' => 'volume',
                    'currency' => 'EUR',
                    'interval' => 'month',
                    'interval_count' => 12,
                    'product' => ['name' => $plan->name.' 12 mois'],
                    'amount' => $plan->m12_price * 100,

                ]);

                $plan->m12_stripe_id = $res->id;

                $plan->save();
            }

            return back()->with('success','Votre plan a été enregistré!');

    }
}
