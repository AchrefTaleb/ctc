<?php


namespace App\Helpers;


use App\Mail;
use App\Subscription;
use Illuminate\Support\Carbon;

class mailOpening
{
    public $subscription;
    public $pages = -1;
    public $opening = -1;

    public function __construct(Subscription $subscription)
    {
        $opening = ($subscription->plan->opening_limit - Mail::where('created_at','>=',Carbon::now()->subMonth()->month)->where('open',true)->count());

        dd($opening);
    }

}
