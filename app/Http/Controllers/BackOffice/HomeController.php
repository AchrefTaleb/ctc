<?php

namespace App\Http\Controllers\BackOffice;

use App\Client;
use App\Http\Controllers\Controller;
use App\Mail;
use App\Request as Req;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index()
   {
       $nb_clients = User::role('client')->count();
       $nb_clients_today = Client::whereDate('created_at', Carbon::today())->get()->count();

       $nb_mails = Mail::all()->count();
       $nb_mails_today = Mail::whereDate('created_at', Carbon::today())->get()->count();

       $nb_requests = Req::all()->count();
       $nb_requested = Req::where('status','requested')->get()->count();
       $requesteds = Req::where('status','requested')->get();
       $executed= Req::where('status','executed')->get();
       $nb_requested_today = Req::where('status','requested')->whereDate('created_at', Carbon::today())->get()->count();
       $nb_approved = Req::where('status','approved')->get()->count();
       $nb_executed = Req::where('status','executed')->get()->count();
       $nb_sent = Req::where('status','sent')->get()->count();
       $nb_canceled = Req::where('status','canceled')->get()->count();


       return view('BackOffice.pages.home.index',[
           'nb_clients' => $nb_clients,
           'nb_clients_today' => $nb_clients_today,
           'nb_mails' => $nb_mails,
           'nb_mails_today' => $nb_mails_today,
           'nb_requests' => $nb_requests,
           'nb_requested_today' => $nb_requested_today,
           'nb_requested' => $nb_requested,
           'requesteds' => $requesteds,
           'nb_approved' => $nb_approved,
           'nb_executed' => $nb_executed,
           'nb_sent' => $nb_sent,
           'nb_canceled' => $nb_canceled,
           'executed' => $executed

       ]);
   }
}
