<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\User;
use App\Utils\ModuleUtil;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Jobs\SendBusinessOwnerEmailVerificaton;
use Illuminate\Support\Facades\Queue;
use App\Models\EmailToken;
use Illuminate\Support\Facades\RateLimiter;
use EragLaravelDisposableEmail\Rules\DisposableEmailRule;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Services\AppSettingsService;
class UserController extends Controller
{
    use VerifiesEmails;
    /*
    |--------------------------------------------------------------------------
    | UserController
    |--------------------------------------------------------------------------
    |
    | This controller handles the manipualtion of user
    |
    */

    /**
     * All Utils instance.
     *
     */
    protected $moduleUtil;
    protected $util;

    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct(ModuleUtil $moduleUtil, Util $util)
    {
        $this->moduleUtil = $moduleUtil;
        $this->util = $util;
    }

    /**
     * Shows profile of logged in user
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile()
    {
        $user_id = request()->session()->get('user.id');
        $user = User::where('id', $user_id)->with(['media'])->first();
        $config_languages = config('constants.langs');
        $languages = [];
        foreach ($config_languages as $key => $value) {
            $languages[$key] = $value['full_name'];
        }

        return view('user.profile', compact('user', 'languages'));
    }

    /**
     * updates user profile
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        //Disable in demo
        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        try {
            $user_id = $request->session()->get('user.id');
            $input = $request->only([
                'surname',
                'first_name',
                'last_name',
                'email',
                'language',
                'marital_status',
                'blood_group',
                'contact_number',
                'fb_link',
                'twitter_link',
                'social_media_1',
                'social_media_2',
                'permanent_address',
                'current_address',
                'guardian_name',
                'custom_field_1',
                'custom_field_2',
                'custom_field_3',
                'custom_field_4',
                'id_proof_name',
                'id_proof_number',
                'gender',
                'family_number',
                'alt_number'
            ]);

            if (!empty($request->input('dob'))) {
                $input['dob'] = $this->moduleUtil->uf_date($request->input('dob'));
            }
            if (!empty($request->input('bank_details'))) {
                $input['bank_details'] = json_encode($request->input('bank_details'));
            }

            $user = User::find($user_id);
            $user->update($input);

            Media::uploadMedia($user->business_id, $user, request(), 'profile_photo', true);

            //update session
            $input['id'] = $user_id;
            $business_id = request()->session()->get('user.business_id');
            $input['business_id'] = $business_id;
            session()->put('user', $input);

            $output = [
                'success' => 1,
                'msg' => __('lang_v1.profile_updated_successfully')
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong')
            ];
        }
        return redirect('user/profile')->with('status', $output);
    }

    /**
     * updates user password
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        //Disable in demo
        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        try {
            $user_id = $request->session()->get('user.id');
            $user = User::where('id', $user_id)->first();

            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
                $user->save();
                $output = [
                    'success' => 1,
                    'msg' => __('lang_v1.password_updated_successfully')
                ];
            } else {
                $output = [
                    'success' => 0,
                    'msg' => __('lang_v1.u_have_entered_wrong_password')
                ];
            }
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong')
            ];
        }
        return redirect('user/profile')->with('status', $output);
    }

    public function updatePhoneNumber(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->update([
            'contact_no' => "234" . substr($request->contact_number, 1)
        ]);

        if ($user) {
            # code...
            $output = [
                'success' => 1,
                'msg' => 'Phone number update successful'
            ];
        } else {
            # code...
            $output = [
                'success' => 0,
                'msg' => 'Phone number update failed'
            ];
        }

        auth()->user()->generateCode();

        return $output;
    }

    public function UpdateBusinessEmailAndSendVerification(Request $request)
    {
        if (empty($request->email)) {
            # code...
            $output = [
                'success' => 0,
                'msg' => 'Enter Email Address'
            ];

            return $output;
        }


        $user = User::where('id', Auth::user()->business_owner->user_id)->update([
            'email' => $request->email
        ]);

        $token = $this->util->generateToken();

        EmailToken::create([
            'token' => $token,
            'user_id' => Auth::user()->business_owner->user_id,
            'business_id' => Auth::user()->business_owner->business_id,
            'status' => 'active'
        ]);

        Queue::push(new SendBusinessOwnerEmailVerificaton(Auth::user()->business_owner, $token));

        $output = [
            'success' => 1,
            'msg' => 'Verification link sent. '
        ];

        return $output;
    }

    public function getIsEmailVerified()
    {
        if (User::where('id', Auth::user()->business_owner->user_id)->whereNull('email_verified_at')->exists()) {
            $output = [
                'success' => 0,
                'msg' => 'Not Verified.'
            ];
        } else {
            $output = [
                'success' => 1,
                'msg' => 'Verified.'
            ];
        }



        return $output;
    }

    public function verifyEmail(Request $request)
    {
        if (empty($request->email)) {
            # code...
            $output = [
                'success' => 0,
                'msg' => 'Enter Email Address'
            ];

            return $output;
        }

        $user = User::where('id', Auth::user()->business_owner->user_id)->update([
            'email' => $request->email
        ]);

        $token = $this->util->generateToken();

        EmailToken::create([
            'token' => $token,
            'user_id' => Auth::user()->business_owner->user_id,
            'business_id' => Auth::user()->business_owner->business_id,
            'status' => 'active'
        ]);

        Queue::push(new SendBusinessOwnerEmailVerificaton(Auth::user()->business_owner, $token));

        $output = [
            'success' => 1,
            'msg' => 'Verification link sent. '
        ];

        return $output;
    }

    public function get_lang(Request $request)
{
    if (! $request->ajax()) {
        return redirect()->route('home');
    }
    $current_lang = session('user.language') ?: 'en';
    $langs = config('constants.langs');
    return view('layouts.partials.lang_dropdown', compact('current_lang', 'langs'))->render();
}

public function update_lang(Request $request)
{
     //Disable in demo
     $notAllowed = $this->moduleUtil->notAllowedInDemo();
     if (!empty($notAllowed)) {
         return $notAllowed;
     }
    $lang = $request->get('lang');
    $user_id = $request->session()->get('user.id');
    $user = User::find($user_id);

    if ($user) {
        $user->language = $lang;
        $user->save();
        session()->put('user.language', $lang);
    }
    return redirect()->back();
}

public function updateEmail(Request $request)
{ 
    $service = app(AppSettingsService::class);
       
    $emailRules = [
        'required',
        'email',
        Rule::unique('users', 'email')->ignore($request->user()->id),
    ];

    if ($service->temp_email_protection()) {
        $emailRules[] = 'disposable_email';
    }

    $request->validate([
        'email' => $emailRules,
    ]);

    $user = \Auth::user();
    $lockoutDuration = 60; // seconds
    $now = now();
    $lockoutUntil = session('lockout_until', $now);
    
    // Check if we're still in the lockout period
    if ($now->lt($lockoutUntil)) {
        return redirect()->back()->with([
            'status'  => __('messages.please_wait_before_resending'),
            'lockout' => $lockoutUntil->diffInSeconds($now)
        ]);
    }
    
    try {
        $user->update([
            'email' => $request->email,
            'email_verified_at' => null,
        ]);

        // Send the verification email
        // $user->sendEmailVerificationNotification();
        session(['lockout_until' => now()->addSeconds($lockoutDuration)]);

        $output = [
            'success' => 1,
            'msg'     => __('lang_v1.profile_updated_successfully'),
        ];
    } catch (\Exception $e) {
        \Log::emergency("File:" . $e->getFile() . " Line:" . $e->getLine() . " Message:" . $e->getMessage());
        $output = [
            'success' => 0,
            'msg'     => __('messages.something_went_wrong'),
        ];
    }

    return redirect()->back()->with([
        'status'  => $output['msg'],
        'lockout' => session('lockout_until') ? session('lockout_until')->diffInSeconds(now()) : 0,
    ]);
}

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
public function show(Request $request)
{
    $user = $request->user();
    $key = 'send_verification_email_' . $user->id;
    $lockout = RateLimiter::availableIn($key);

    if ($user->hasVerifiedEmail()) {
        return redirect($this->redirectPath());
    }

    // Check for existing active OTP
    $emailToken = EmailToken::where('user_id', $user->id)
        ->where('business_id', $user->business_id)
        ->where('status', 'active')
        ->first();

    $otpStatus = [
        'exists' => false,
        'expired' => false,
        'expires_at' => null,
        'remaining_attempts' => 0,
        'resend_count' => 0,
        'last_resend_at' => null,
    ];

    if ($emailToken) {
        // Always pass resend tracking data
        $otpStatus['resend_count'] = $emailToken->resend_count ?: 0;
        $otpStatus['last_resend_at'] = $emailToken->last_resend_at;
        
        // Only set OTP data if OTP exists
        if ($emailToken->otp) {
            $otpStatus['exists'] = true;
            $otpStatus['expired'] = $emailToken->otp_expires_at < now();
            $otpStatus['expires_at'] = $emailToken->otp_expires_at;
            $otpStatus['remaining_attempts'] = max(0, 3 - $emailToken->otp_attempts);
        }
    }

    return view('auth.verify', compact('lockout', 'otpStatus'));
}

    /**
     * Resend the email verification notification with rate limiting.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        $user = $request->user();
        $service = app(\App\Services\AppSettingsService::class);

        if ($service->temp_email_protection() 
            && DisposableEmailRule::isDisposable($user->email)
        ) {
            return back()->withErrors([
                'email' => __('Disposable email addresses are not allowed.')
            ]);
        }
        $key = 'send_verification_email_' . $user->id;
        $maxAttempts = 4;
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            if (RateLimiter::availableIn($key) < 86400) {
                RateLimiter::clear($key);
                RateLimiter::hit($key, 86400); 
            }
            return redirect()->back()->with('lockout', RateLimiter::availableIn($key));
        }
        $attempts = RateLimiter::attempts($key);
        $lockoutMap = [
            0 => 60,  
            1 => 120,  
            2 => 300,  
            3 => 900, 
        ];
        $decaySeconds = $lockoutMap[$attempts] ?? 60;
        RateLimiter::hit($key, $decaySeconds);
        $user->sendEmailVerificationNotification();
        return redirect()->back()->with('resent', true);
    }
    
    
}
