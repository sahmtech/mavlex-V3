<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Services\AppSettingsService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    protected $appSettingsService;

    public function __construct(AppSettingsService $appSettingsService)
    {
        $this->appSettingsService = $appSettingsService;
    }

    public function redirectToProvider($provider)
    {
        $social_logins = $this->appSettingsService->social_logins();
    
        if (isset($social_logins[$provider])) {
            config()->set("services.$provider", $social_logins[$provider]);
        } else {
            return redirect('/login')->withErrors("Social login for " . ucfirst($provider) . " is not configured.");
        }
    
        return Socialite::driver($provider)->redirect();
    }
    

   public function handleProviderCallback($provider)
{
    $social_logins = $this->appSettingsService->social_logins();
    if (isset($social_logins[$provider])) {
        config()->set("services.$provider", $social_logins[$provider]);
    } else {
        return redirect('/login')->withErrors("Social login for " . ucfirst($provider) . " is not configured.");
    }

     try {
        $social_user = Socialite::driver($provider)->user();
    } catch (\Exception $e) {
        \Log::error("Socialite error for provider {$provider}: " . $e->getMessage());
        return redirect('/login')->withErrors('Unable to login using ' . ucfirst($provider) . '. Please try again.');
    }

    $provider_email = strtolower(trim($social_user->getEmail()));
    $user = User::whereRaw('LOWER(email) = ?', [$provider_email])->first();

    if ($user) {
        if (!$user->provider || !$user->provider_id) {
            $user->update([
                'provider'    => $provider,
                'provider_id' => $social_user->getId(),
            ]);
        }
        
        Auth::login($user, true);
        $service    = app(\App\Services\AppSettingsService::class);
        $enable_2fa = $service->enable_2fa();
        $force_2fa  = $service->force_2fa();
        $force_date = $service->force_2fa_after_date();
        $force_otp_after_social = $service->force_otp_after_social();
        $allow_disable_2fa = $service->allow_disable_2fa();

          if ($enable_2fa && $force_otp_after_social) {
            if ($force_date !== null && \Carbon::now()->greaterThanOrEqualTo($force_date)) {
                $force_2fa = true;
            }
            if ($allow_disable_2fa && $user->disable_2fa_until && \Carbon\Carbon::now()->lt($user->disable_2fa_until && $user->two_factor_enabled)) {
             return redirect()->intended('/home');
            }
            if ($force_2fa || $user->two_factor_enabled || $force_otp_after_social) {
                Auth::logout();
                session()->put('2fa:user:id', $user->id);
                return redirect()->route('2fa.form_verify');
            }
        }

        return redirect()->intended('/home');
    } else {
        \Log::warning('No user found for email: ' . $provider_email);
        return redirect('/login')->withErrors('No record found for email: ' . $social_user->getEmail());
    }
}
}