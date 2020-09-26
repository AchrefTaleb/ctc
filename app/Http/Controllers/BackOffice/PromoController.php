<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function list()
    {
        $promo = promo::all();
        $promos = $promo->filter(function ($value) {
            return now()->diffInMonths($value->created_at) < $value->months;
        });

        return view('BackOffice.pages.promo.list',[
        'promos' => $promos,
        ]);
    }
}
