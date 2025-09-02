<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FAQRCode\Google2FA;
use PragmaRX\Recovery\Recovery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Services\AppSettingsService;
use Illuminate\Support\Facades\Hash;

class TwoFactorController extends Controller
{
    /**
     * The AppSettingsService instance.
     */
    protected $settings_service;

    /**
     * Constructor injects the service that handles superadmin settings.
     */
    public function __construct(AppSettingsService $settings_service)
    {
        $this->settings_service = $settings_service;
    }


    /**
     * Display the 2FA setup form for authenticated users.
     */
    public function setup_2fa_form(Request $request)
    {
        $two_factor_settings = $this->settings_service->two_factor_settings();

        if (empty($two_factor_settings['enable_2fa'])) {
            abort(403, 'Unauthorized action.');
        }

        $user = Auth::user();
        if ($user->two_factor_enabled && !session()->has('setup_confirmed')) {
            return redirect()->route('2fa.reauth-form', ['source' => 'setup']);
        }
        $google2fa = new Google2FA();
        if (empty($user->google2fa_secret)) {
            $secret_key = $google2fa->generateSecretKey();
            $encrypted_secret = encrypt($secret_key);
            $user->update(['google2fa_secret' => $encrypted_secret]);
        } else {
            $secret_key = decrypt($user->google2fa_secret);
        }

        $qr_code_url = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $secret_key
        );

        return view('user.google2fa', compact('qr_code_url', 'secret_key'));
    }

    /**
     * Display the 2FA verification form for users logging in.
     */
    public function otp_verify_form(Request $request)
    {
        $user_id = $request->session()->get('2fa:user:id');
        if (!$user_id) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($user_id);
        $google2fa = new Google2FA();

        if (empty($user->google2fa_secret)) {
            $secret_key = $google2fa->generateSecretKey();
            $encrypted_secret = encrypt($secret_key);
            $user->update(['google2fa_secret' => $encrypted_secret]);
        } else {
            $secret_key = decrypt($user->google2fa_secret);
        }

        $qr_code_url = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $secret_key
        );

        return view('auth.2fa_otp', [
            'user' => $user,
            'secretKey' => $secret_key,
            'qrCodeUrl' => $qr_code_url
        ]);
    }

    /**
     * Verify the submitted 2FA code.
     */
    public function otp_verify(Request $request)
    {
        $request->validate([
            'one_time_password'  => 'required'
        ]);

        $user = Auth::check()
            ? Auth::user()
            : User::find($request->session()->get('2fa:user:id'));

        if (!$user) {
            return redirect()->route('login');
        }

        $google2fa = new Google2FA();
        $decrypted_secret = decrypt($user->google2fa_secret);

        $valid = $google2fa->verifyKey($decrypted_secret, $request->one_time_password);
        if (!$valid) {
            $valid = $this->recovery_code_used($user, $request->one_time_password);
        }
        if ($valid) {
            if (!$user->two_factor_enabled) {
                $user->two_factor_enabled = 1;
            }

            if ($request->has('disable_2fa_temporarily') && $this->settings_service->allow_disable_2fa()) {
                $duration = $this->settings_service->disable_2fa_duration();
                $unit = $this->settings_service->disable_2fa_unit();
                $disable_until = Carbon::now()->add($unit, (int) $duration);
                $user->disable_2fa_until = $disable_until;
            } else {
                $user->disable_2fa_until = null;
            }

            $user->save();
            if (!Auth::check()) {
                Auth::login($user);
            }

            $request->session()->forget('2fa:user:id');
            $request->session()->put('2fa_verified', true);
            if ($request->input('source') === 'setup') {
                return redirect()->route('2fa.recovery_code_index');
            }
            return redirect('/home');
        }

        return redirect()->back()->withErrors([
            'one_time_password' => 'The provided 2FA code is invalid.',
        ]);
    }


    public function recovery_code_generate(User $user)
    {
        $recovery = new Recovery();

        // For example, generate 10 codes
        // Each code can have blocks, chars, etc.
        $codes = $recovery
            ->setCount(12)   // how many codes
            ->setBlocks(3)   // how many blocks per code
            ->setChars(3)    // how many characters per block
            ->toArray();

        // $codes is an array of strings like ["ABCD-EFGH-IJKL", ...]
        // Save to the user table:
        $user->two_factor_recovery_codes = $codes;
        $user->save();

        return $codes;
    }
    protected function recovery_code_used(User $user, string $input): bool
    {
        $codes = $user->two_factor_recovery_codes ?? [];

        if (!in_array($input, $codes)) {
            return false;
        }
        $remaining = array_diff($codes, [$input]);
        $user->two_factor_recovery_codes = array_values($remaining);
        $user->save();

        return true;
    }

    public function recovery_code_index()
    {
        $two_factor_settings = $this->settings_service->two_factor_settings();
        $user = Auth::user();

        // Only allow access if 2FA is enabled globally and by the user.
        if (!($two_factor_settings['enable_2fa'] && $user->two_factor_enabled)) {
            abort(403, 'Unauthorized action.');
        }

        if (!session()->has('recovery_confirmed')) {
            return redirect()->route('2fa.reauth-form', ['source' => 'recovery']);
        }

        $codes = $user->two_factor_recovery_codes ?? [];
        return view('user.2fa_recovery_codes', compact('codes'));
    }

    public function regenerate_recovery_codes()
    {
        try {
            $user = Auth::user();

            if (!session()->has('recovery_confirmed')) {
                return redirect()->route('2fa.reauth-form', ['source' => 'recovery']);
            }

            $codes = $this->recovery_code_generate($user);

            $output = [
                'success' => 1,
                'msg' => __('settings.recovery_codes_generated_successfully')
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong')
            ];
        }
        return redirect()->route('2fa.recovery_code_index')->with('status', $output);
    }


    public function reauth_form(Request $request)
    {
        $source = $request->query('source', 'setup');
        return view('user.2fa_reauth', compact('source'));
    }
    public function reauth_confirmation(Request $request)
    {
        $request->validate([
            'confirm_method' => 'required|in:otp,password',
            'confirm_value'  => 'required',
            'source'         => 'required|in:setup,recovery'
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        if ($request->confirm_method === 'otp') {
            $google2fa = new Google2FA();
            $decrypted_secret = decrypt($user->google2fa_secret);
            $valid = $google2fa->verifyKey($decrypted_secret, $request->confirm_value);
            if (!$valid) {
                return back()->withErrors(['confirm_value' => 'Invalid OTP code.']);
            }
        } else {
            if (!Hash::check($request->confirm_value, $user->password)) {
                return back()->withErrors(['confirm_value' => 'Invalid password.']);
            }
        }

        if ($request->input('source') === 'recovery') {
            session(['recovery_confirmed' => true]);
            $codes = $user->two_factor_recovery_codes ?? [];
            return view('user.2fa_recovery_codes', compact('codes'));
        } elseif ($request->input('source') === 'setup') {
            session(['setup_confirmed' => true]);
            return redirect()->route('2fa.setup_form');
        }
    }
}
