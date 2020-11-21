<?php

namespace App\Http\Middleware;

use App\Client;
use Closure;

class SubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Client::find(auth()->user()->id);
       // dd($user->subscription);
        if(!$user->subscription || !$user->subscription->status){
          //  if($user->contract){
                return redirect()->route('frontoffice.subscription.create');
        //    }else{
          //      return redirect()->route('frontoffice.subscription.contract');
          //  }

        }
        return $next($request);
    }
}
