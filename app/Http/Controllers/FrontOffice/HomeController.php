<?php

namespace App\Http\Controllers\FrontOffice;

use App\Helpers\stripeHelper;
use App\Http\Controllers\Controller;
use App\Subscription;
use Illuminate\Http\Request;
use App\Mail;
use App\Request as Req;
use Carbon\Carbon;

class   HomeController extends Controller
{


    public function index()
    {
        $stripeHelper = new stripeHelper();
        $sub = Subscription::where('user_id',auth()->user()->id)->first();

        $res = $stripeHelper->getSubscription($sub->stripe_id);
        dd($res);

        $nb_mails = Mail::where('user_id',auth()->user()->id)->get()->count();
        $nb_mails_today = Mail::where('user_id',auth()->user()->id)->whereDate('created_at', Carbon::today())->get()->count();
        $nb_requests = Req::where('user_id',auth()->user()->id)->where('status','approved')->get()->count();
        $nb_notseen = Mail::where('user_id',auth()->user()->id)->where('open',false)->get()->count();


        return view('FrontOffice.pages.home.home',[
            'nb_mails' => $nb_mails,
            'nb_mails_today' => $nb_mails_today,
            'nb_requests' => $nb_requests,
            'nb_notseen' => $nb_notseen,
        ]);
    }
}
