<?php

namespace App\Http\Middleware;

use Closure;

class SubscriptionMiddleware
{

    public function handle($request, Closure $next)
    {
        if(!auth()->guest() && !auth()->user()->subscribed('main') && !auth()->user()->onTrial() ){
            return redirect('profile/billing')->with(['alert' => 'You no longer have an active subscription. You will not be able to access trach.io until you sign up for a plan in the billing section.', 'alert_type' => 'warning']);
        }

        return $next($request);
    }
}
