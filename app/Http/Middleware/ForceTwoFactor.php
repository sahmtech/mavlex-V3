<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\AppSettingsService;

class ForceTwoFactor
{
    /**
     * The AppSettingsService instance.
     */
    protected $settings_service;

    public function __construct(AppSettingsService $settings_service)
    {
        $this->settings_service = $settings_service;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        if (!$this->settings_service->enable_2fa()) {
            return $next($request);
        }

        $force_2fa = $this->settings_service->force_2fa();
        $force_date = $this->settings_service->force_2fa_after_date();

        if ($force_date !== null && Carbon::now()->greaterThanOrEqualTo($force_date)) {
            $force_2fa = true;
        }

        if (!$force_2fa) {
            return $next($request);
        }

        if ($user->disable_2fa_until && Carbon::now()->lt(Carbon::parse($user->disable_2fa_until))) {
            return $next($request);
        }

        if (!$user->two_factor_enabled && !$request->is('2fa/*')) {
            return redirect()->route('2fa.setup_form');
        }

        return $next($request);
    }
}
