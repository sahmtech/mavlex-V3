<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ReAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user->two_factor_enabled) {
            return $next($request);
        }
        if (!(session()->has('recovery_confirmed') || session()->has('setup_confirmed'))) {
            return redirect()->route('2fa.reauth-form', ['redirect' => $request->fullUrl()]);
        }
        // Otherwise, proceed
        return $next($request);
    }
}
