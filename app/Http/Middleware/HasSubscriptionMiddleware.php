<?php

namespace App\Http\Middleware;

use App\Client;
use Closure;

class HasSubscriptionMiddleware
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
        if($user->subscription && $user->subscription->status){
            return redirect()->route('frontoffice.home');
        }
        return $next($request);
    }
}
