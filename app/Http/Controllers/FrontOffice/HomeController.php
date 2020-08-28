<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail;
use App\Request as Req;
use Carbon\Carbon;

class   HomeController extends Controller
{


    public function index()
    {
        $nb_mails = Mail::all()->count();
        $nb_mails_today = Mail::whereDate('created_at', Carbon::today())->get()->count();


        return view('FrontOffice.pages.home.home',[
            'nb_mails' => $nb_mails,
            'nb_mails_today' => $nb_mails_today
        ]);
    }
}
