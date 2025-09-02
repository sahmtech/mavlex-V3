<?php

namespace App\Http\Middleware;

use App;
use Closure;
use App\Models\Business;
use App\Models\ProductReview;

use Illuminate\Support\Facades\Auth;

class SetSessionData
{



    /**
     * Checks if session data is set or not for a user. If data is not set then set it.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */


    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return $next($request);
        }

        if (\Cache::has('force_logged_out:' . $user->id) && $request->session()->has('user')) {
            \Auth::logout();
            \Session::invalidate();
            \Session::regenerateToken();

            // Clear all authentication cookies
            $response = redirect('/login')->with('message', 'Your session was terminated. Please wait before logging in again.');
            $response->withCookie(cookie()->forget('laravel_session'));
            $response->withCookie(cookie()->forget('remember_web_' . sha1('App\\Models\\User')));
            $response->withCookie(cookie()->forget('XSRF-TOKEN'));

            return $response;
        }

        if ($request->session()->has('user')) {
            $sessionToken = $request->session()->get('user_login_token');
            $dbToken = $user->login_token;
            if ($sessionToken != $dbToken) {
                \Auth::logout();
                \Session::invalidate();
                \Session::regenerateToken();

                // Clear all authentication cookies
                $response = redirect('/login')->with('message', 'Session terminated by admin.');
                $response->withCookie(cookie()->forget('laravel_session'));
                $response->withCookie(cookie()->forget('remember_web_' . sha1('App\\Models\\User')));
                $response->withCookie(cookie()->forget('XSRF-TOKEN'));

                return $response;
            }

            // Always update IP and User Agent for existing sessions
            $request->session()->put('client_ip', $request->ip());
            $request->session()->put('user_agent', $request->userAgent());

            return $next($request);
        }

        $request->session()->put('user_login_token', $user->login_token);
        $request->session()->put('user_login_token', $user->login_token);
        if (!$request->session()->has('user')) {
            $user = Auth::user();
            $session_data = [
                'id' => $user->id,
                'surname' => $user->surname,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'business_id' => $user->business_id,
                'language' => 'en',
                'registration_package_id' => $user->registration_package_id,
            ];
            $business = Business::where('id', $user->business_id)->first();
            // if (empty($business)) {
            //     return redirect()->route('business.onboard');
            // }
            // if (is_null($business->business_type) && $business->owner_id == Auth::user()->id) {
            //     return redirect()->route('business.scale');
            // }
            $currency = $business->currency;
            $currency_data = [
                'id' => $currency->id,
                'code' => $currency->code,
                'symbol' => $currency->symbol,
                'thousand_separator' => $currency->thousand_separator,
                'decimal_separator' => $currency->decimal_separator,
            ];
            $request->session()->put('user', $session_data);
            $request->session()->put('business', $business);
            $request->session()->put('currency', $currency_data);
            
            // Store IP and User Agent for session management
            $request->session()->put('client_ip', $request->ip());
            $request->session()->put('user_agent', $request->userAgent());


            $currentYear = date("Y");
            $financial_year = [
                "start" => $currentYear . "-01-01",
                "end" => $currentYear . "-12-31",
            ];

            $request->session()->put('financial_year', $financial_year);
            $timezone = $user->business->time_zone;
            config(['app.timezone' => $timezone]);
            date_default_timezone_set($timezone);
            //Set Local
            App::setLocale('en');

            //Set Review Notification
            if ($business->owner_id == Auth::user()->id && !is_null($user->agent_lead) && $user->rating == 0) {

                $review_link = ProductReview::where([
                    'business_id' => $user->business_id,
                    'status' => 'awaiting'
                ])->first();

                if ($review_link) {
                    $request->session()->put('review_alert', 1);
                    $link = route('review_link', ['business_id' => $user->business_id, 'link' => $review_link->link]);
                    $request->session()->put('review_alert_link', $link);
                }
            }
        }
        return $next($request);
    }
}
