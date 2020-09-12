<?php

namespace App\Jobs;

use App\Helpers\stripeHelper;
use App\Mail\SubRemainderMail;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SubscriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subs = Subscription::all();

        $stripeHelper = new stripeHelper();

        foreach ($subs as  $sub)
        {
            $info = $stripeHelper->getSubscription($sub->stripe_id);

            $duration = $info->plan->interval_count;
            $date =  new Carbon($info->current_period_end);
            $diff = Carbon::now()->diff($date)->days;

            if($diff == 7)
            {
                Mail::to($sub->user->email)->send(new SubRemainderMail($sub->user,7));
            }

            if($diff == 15 && $duration >= 3)
            {
                Mail::to($sub->user->email)->send(new SubRemainderMail($sub->user,15));
            }

            if($diff == 30 && $duration >= 3)
            {
                Mail::to($sub->user->email)->send(new SubRemainderMail($sub->user,30));
            }

            if($diff == 60 && $duration >= 6)
            {
                Mail::to($sub->user->email)->send(new SubRemainderMail($sub->user,60));
            }
        }
    }
}
