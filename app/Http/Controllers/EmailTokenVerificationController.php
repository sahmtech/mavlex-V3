<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailToken;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class EmailTokenVerificationController extends Controller
{
    public function VerifyBusinessOwnerEmail(Request $request, $token)
    {
        $data = EmailToken::where('token', $token)
            ->where('status', 'active')
            ->first();

        if (!empty($data)) {
            $user = User::where('id', $data->user_id)->update([
                'email_verified_at' => date('Y-m-d H:i:s')
            ]);

            $data->status = 'inactive';
            $data->save();

            return view('email_verification/index');
        }

        abort(404);
    }

    public function sendOtp(Request $request)
    {
        return $this->handleOtpSend($request, true);
    }

    public function resendOtp(Request $request)
    {
        return $this->handleOtpSend($request, false);
    }

    private function handleOtpSend(Request $request, bool $isInitialSend)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'business_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $user = User::findOrFail($request->user_id);

        $emailToken = EmailToken::firstOrCreate(
            [
                'user_id' => $request->user_id,
                'business_id' => $request->business_id,
            ],
            [
                'token' => uniqid(),
                'status' => 'active',
                'resend_count' => 0,
                'last_resend_at' => now(),
            ]
        );

        if ($emailToken->status !== 'active') {
            $emailToken->status = 'active';
            $emailToken->resend_count = 0;
            $emailToken->last_resend_at = now();
            $emailToken->save();
        }

        $resendCount = $emailToken->resend_count;
        $lastResend = $emailToken->last_resend_at;

        $delays = [
            1 => 60,   // After 1st resend → wait 60s
            2 => 120,  // After 2nd resend → wait 120s
            3 => 300,  // After 3rd resend → wait 5 min
        ];

        // Max 4 attempts total (1 send + 3 resends)
        if ($resendCount >= 4) {
            return response()->json([
                'error' => 'Maximum OTP requests reached. Please try again later.'
            ], 429);
        }

        if ($lastResend && $resendCount > 0 && isset($delays[$resendCount])) {
            $earliestResend = $lastResend->copy()->addSeconds($delays[$resendCount]);
            if (now()->lt($earliestResend)) {
                $secondsLeft = abs($earliestResend->diffInSeconds(now()));
                return response()->json([
                    'error' => "Please wait " . max(1, $secondsLeft) . " seconds before requesting again.",
                    'retry_after' => max(1, $secondsLeft)
                ], 429);
            }
        }

        $otp = $emailToken->generateOtp();
        $emailToken->resend_count += 1;
        $emailToken->last_resend_at = now();
        $emailToken->save();

        try {
            Mail::send('emails.otp_verification', ['otp' => $otp, 'user' => $user], function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Email Verification OTP ' . ($isInitialSend ? '(Send)' : '(Resend)'));
                $message->from(config('mail.from.address'), config('mail.from.name'));
            });


            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully',
                'resend_count' => $emailToken->resend_count,
                'expires_at' => $emailToken->otp_expires_at
            ]);
        } catch (\Exception $e) {
            \Log::error('OTP send failed', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Failed to send OTP. Please try again later.'
            ], 500);
        }
    }
    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'business_id' => 'required',
            'otp' => 'required|digits:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Invalid OTP format'], 400);
        }

        $emailToken = EmailToken::where('user_id', $request->user_id)
            ->where('business_id', $request->business_id)
            ->where('status', 'active')
            ->first();

        if (!$emailToken) {
            return response()->json(['error' => 'No active verification found'], 404);
        }

        if (!$emailToken->isOtpValid($request->otp)) {
            $emailToken->incrementOtpAttempts();

            $remainingAttempts = max(0, 3 - $emailToken->otp_attempts);

            return response()->json([
                'error' => 'Invalid or expired OTP',
                'remaining_attempts' => $remainingAttempts
            ], 400);
        }

        // Verify email
        User::where('id', $request->user_id)->update([
            'email_verified_at' => now()
        ]);

        $emailToken->status = 'inactive';
        $emailToken->clearOtp();
        $emailToken->resend_count = 0;
        $emailToken->last_resend_at = null;
        $emailToken->save();

        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully'
        ]);
    }
}
