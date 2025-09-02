<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Rules\ReCaptcha;
use App\Models\System;
use App\Services\AppSettingsService;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * All Utils instance.
     *
     */
    protected $businessUtil;
    protected $moduleUtil;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BusinessUtil $businessUtil, ModuleUtil $moduleUtil)
    {
        $this->middleware('guest')->except('logout');
        $this->businessUtil = $businessUtil;
        $this->moduleUtil = $moduleUtil;
    }

    public function showLoginForm()
    {
        $layout_setting = System::where('key', 'login_layout')->first();
        $layout = $layout_setting ? (int) $layout_setting->value : 0;
        if ($layout === 0) {
            return view('auth.login');
        }
        return view("loginlayouts::login{$layout}.login");
    }
    /**
     * Change authentication from email to username
     *
     * @return void
     */
    public function username()
    {
        return 'username';
    }

    public function logout()
    {
        $this->businessUtil->activityLog(auth()->user(), 'logout');

        request()->session()->flush();
        \Auth::logout();
        return redirect('/login');
    }

    /**
     * The user has been authenticated.
     * Check if the business is active or not.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {

        $service = app(AppSettingsService::class);
       
        if ($service->force_email_verify() && !$user->hasVerifiedEmail()) {
            return redirect('/email/verify');
        }
        if ($user->locked_until && now()->lt($user->locked_until)) {
            $duration = $service->user_lock_time();
            $unit = $service->user_lock_duration_unit();
            throw ValidationException::withMessages([
                $this->username() => [
                    __('settings.account_locked_for_time_unit', [
                        'time' => $duration,
                        'unit' => $unit
                    ])
                ],
            ]);
        }
        $this->businessUtil->activityLog($user, 'login', null, [], false, $user->business_id);
        if (!$user->business->is_active) {
            \Auth::logout();
            return redirect('/login')
                ->with(
                    'status',
                    ['success' => 0, 'msg' => __('lang_v1.business_inactive')]
                );
        } elseif ($user->status != 'active') {
            \Auth::logout();
            return redirect('/login')
                ->with(
                    'status',
                    ['success' => 0, 'msg' => __('lang_v1.user_inactive')]
                );
        } elseif (!$user->allow_login) {
            \Auth::logout();
            return redirect('/login')
                ->with(
                    'status',
                    ['success' => 0, 'msg' => __('lang_v1.login_not_allowed')]
                );
        } elseif (($user->user_type == 'user_customer') && !$this->moduleUtil->hasThePermissionInSubscription($user->business_id, 'crm_module')) {
            \Auth::logout();
            return redirect('/login')
                ->with(
                    'status',
                    ['success' => 0, 'msg' => __('lang_v1.business_dont_have_crm_subscription')]
                );
        }
        $user->update(['failed_attempts' => 0, 'locked_until' => null]);
        $enable_2fa = $service->enable_2fa();
        $force_2fa = $service->force_2fa();
        $force_date = $service->force_2fa_after_date();
        $allow_disable_2fa = $service->allow_disable_2fa();

        if (!$enable_2fa) {
            return redirect()->intended($this->redirectTo());
        }

        if ($force_date !== null && \Carbon::now()->greaterThanOrEqualTo($force_date)) {
            $force_2fa = true;
        }
        if ($allow_disable_2fa && $user->disable_2fa_until && \Carbon\Carbon::now()->lt($user->disable_2fa_until)) {
            return redirect()->intended($this->redirectTo());
        }
        if ($force_2fa) {
            if (!$user->two_factor_enabled) {
                return redirect()->route('2fa.setup_form');
            }
            \Auth::logout();
            $request->session()->put('2fa:user:id', $user->id);
            return redirect()->route('2fa.form_verify');
        }
        if ($user->two_factor_enabled) {
            \Auth::logout();
            $request->session()->put('2fa:user:id', $user->id);
            return redirect()->route('2fa.form_verify');
        }
        return redirect()->intended($this->redirectTo());
    }


    protected function redirectTo()
    {
        $user = \Auth::user();
        if (!$user->can('dashboard.data') && $user->can('sell.create')) {
            return '/pos/create';
        }

        if ($user->user_type == 'user_customer') {
            return 'contact/contact-dashboard';
        }

        return '/home';
    }

    public function redirectToLogin()
    {
        return redirect('/login');
    }

    public function redirectLogin(Request $request)
    {

        $login = \Auth::guard()->attempt($request->only('username', 'password'));

        if ($login) {
            return redirect('/home');
        } else {
            return redirect('/login');
        }
    }
    public function validateLogin(Request $request)
    {
        $appSettings = app(AppSettingsService::class);

        if ($appSettings->google_recaptcha()['enable_recaptcha']) {
            $this->validate($request, [
                $this->username() => 'required|string',
                'password' => 'required|string',
                'g-recaptcha-response' => ['required', new ReCaptcha]
            ]);
        } else {
            $this->validate($request, [
                $this->username() => 'required|string',
                'password' => 'required|string',
            ]);
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $service = app(AppSettingsService::class);
        $user = User::where('username', $request->username)->first();
    
        if ($user && $service->user_lock_enabled()) {
            $user->increment('failed_attempts');
    
            if ($user->failed_attempts >= $service->user_lock_max_attempts()) {
                $duration = $service->user_lock_time();
                $unit = $service->user_lock_duration_unit();
                $interval_str = "{$duration} {$unit}";
                $locked_until = now()->add(
                    \Carbon\CarbonInterval::createFromDateString($interval_str)
                );
    
                $user->update(['locked_until' => $locked_until]);
                throw ValidationException::withMessages([
                    $this->username() => [
                        __('settings.account_locked_for_time_unit', [
                            'time' => $duration,
                            'unit' => $unit
                        ])
                    ],
                ]);
            }
        }
    
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
    
    protected function attemptLogin(Request $request)
    {
    $user = User::where($this->username(), $request->{$this->username()})->first();
    $service = app(AppSettingsService::class);
     if ($user && $user->locked_until && now()->lt($user->locked_until)) {
        $duration = $service->user_lock_time();
        $unit = $service->user_lock_duration_unit();

        throw ValidationException::withMessages([
            $this->username() => [
                __('settings.account_locked_for_time_unit', [
                    'time' => $duration,
                    'unit' => $unit
                ])
            ],
        ]);
    }

    return $this->guard()->attempt(
        $this->credentials($request),
        $request->filled('remember')
    );
}



}
