<?php

namespace App\Http\Middleware;

use Closure;
use File;
use Log;
use App\RequestLog;
use Carbon\Carbon;

class RequestLogger
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
        $ip_exclusion_list = array(
            '127.0.0.1', // localhost
            '86.40.66.133', // home IP
            '13.80.131.190', // monitor IP
            '94.237.42.145' // ploi ip
        );

        // Log::info('Azure HealthCheck REMOTE_ADDR : ' . $request->server('HTTP_USER_AGENT'));
        // Log::info($request->server('HTTP_USER_AGENT') === 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; AppInsights)');

        if (in_array($request->server('REMOTE_ADDR'), $ip_exclusion_list)) {
            return $next($request);
        }

        if($request->server('HTTP_USER_AGENT') === 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; AppInsights)'){
            return $next($request); // monitor from Azure App Insights
        }

        $requestlog = new RequestLog;
        // next is done becuase of hack on ip.php to read /ip route. /ip only sees request from local IP, and does not log it correctly. We get the ip from the /ip.1.1.1.1 route and overwrite it here
        $remote_addr = (\Request::segment(1) === 'ip' ? last(request()->segments()) : $request->server('REMOTE_ADDR') );
        $requestlog->user_agent = ($request->server('HTTP_USER_AGENT') ? $request->server('HTTP_USER_AGENT') : '');
        $requestlog->remote_addr = $remote_addr;
        $requestlog->request_uri = $request->getPathInfo();
        $requestlog->method = $request->method();
        $requestlog->requested_at = Carbon::createFromTimestamp($request->server('REQUEST_TIME'));

        $requestlog->save();

        return $next($request);
    }
}
