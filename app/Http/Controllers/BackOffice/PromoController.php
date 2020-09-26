<?php

namespace App\Http\Controllers\BackOffice;

use App\Helpers\stripeHelper;
use App\Http\Controllers\Controller;
use App\promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function list()
    {
        $promo = promo::where('stripe_id','!=', null)->get();
        $promos = $promo->filter(function ($value) {
            return now()->diffInMonths($value->created_at) < $value->months;
        });

        return view('BackOffice.pages.promo.list',[
        'promos' => $promos,
        ]);
    }



    public function addPromo()
    {
        return view('BackOffice.pages.promo.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'code' => 'required', // code_promo
            'months' => 'required',
            'reduction' => 'required'
        ]);

         $stripeHelper = new stripeHelper();

        $stripe_id = $stripeHelper->addPromo(
             $request->post('reduction'),
             $request->post('months'),
             $request->post('code')
         );

        if($stripe_id){
            $promo = new promo();
            $promo->promo_code = $request->post('code');
            $promo->months = $request->post('months');
            $promo->reduction = $request->post('reduction');
            $promo->stripe_id = $stripe_id;

            $promo->save();

            return back()->with('success','Votre plan a été enregistré!');
        }

        return back()->with('error','Un problème est survenu!');
    }
}
