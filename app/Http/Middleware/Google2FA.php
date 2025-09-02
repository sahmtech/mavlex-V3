<?php
namespace App\Http\Middleware;

use Closure;

class Google2FA
{
    public function handle($request, Closure $next)
    {
        if (!session('2fa_verified')) {
            return redirect()->route('2fa.index'); // Route to prompt for 2FA
        }
        return $next($request);
    }
}
