<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailToken extends Model
{
    protected $fillable = [
        'status',
        'token',
        'business_id',
        'user_id',
        'otp',
        'otp_expires_at',
        'otp_attempts',
        'resend_count',       
        'last_resend_at'
    ];

    protected $casts = [
        'otp_expires_at' => 'datetime',
        'last_resend_at' => 'datetime',
    ];

    /**
     * Get the user that owns the email token.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function generateOtp()
{
    $this->otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $this->otp_expires_at = now()->addMinutes(10);
    $this->otp_attempts = 0;
    $this->last_resend_at = now();
    $this->save();

    return $this->otp;
}

    public function isOtpValid($otp)
    {
        return $this->otp === $otp 
            && $this->otp_expires_at > now() 
            && $this->otp_attempts < 3;
    }

    public function incrementOtpAttempts()
    {
        $this->increment('otp_attempts');
        
        if ($this->otp_attempts >= 3) {
            $this->otp = null;
            $this->otp_expires_at = null;
            $this->save();
        }
    }

    public function clearOtp()
    {
        $this->otp = null;
        $this->otp_expires_at = null;
        $this->otp_attempts = 0;
        $this->save();
    }
}
