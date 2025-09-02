<?php

namespace Modules\Zatca\Http\Middleware;

use Closure;
use App\Models\Business; 

class SetEnvironmentMiddleware
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
        $business_id = $request->session()->get('user.business_id');

        $business = Business::find($business_id);

        if ($business) {
            config()->set('zatca.app.environment', $business->zatca_env ?? 'simulation');
        }

        return $next($request);
    }
}
