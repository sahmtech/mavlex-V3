@extends('layouts.auth')
@section('title', __('auth.verify_email_address'))

@section('content')

<style>

    .verify-container {
        background: #ffffff;
        backdrop-filter: blur(10px);
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        max-width: 480px;
        width: 100%;
        padding: 2.5rem;
        text-align: center;
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: transform 0.3s ease;
    }

    .verify-container:hover {
        transform: translateY(-5px);
    }

    .verify-title {
        font-size: 1.8rem;
        margin-bottom: 1rem;
        font-weight: 700;
        color:var(--secondary-color)
    }

    .verify-subtitle {
        font-size: 1rem;
        color: #bbb;
        margin-bottom: 2rem;
    }

    .email-display {
        border: 1px solid var(--secondary-color);
        border-radius: 12px;
        padding: 1rem;
        margin: 1.5rem 0;
        font-size: 1.1rem;
        color: var(--secondary-color);
        font-weight: 500;
        word-break: break-all;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .input-group {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .otp-input {
        width: 45px;
        height: 55px;
        text-align: center;
        font-size: 1.5rem;
        font-weight: 600;
        border: 2px solid var(--primary-color);
        border-radius: 12px;
        background: transparent;
        color: var(--secondary-color);
        transition: all 0.2s ease;
    }

    .otp-input:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(3, 169, 244, 0.2);
        outline: none;
    }

    .otp-input.filled {
        background:color-mix(in srgb, var(--primary-color) 20%, white 80%);
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .btn-link {
        background: none;
        color: var(--primary-color);
        text-decoration: underline;
        font-size: 0.9rem;
        padding: 0;
    }

    .timer {
        font-weight: 600;
        color: #ff9800;
        font-size: 1.1rem;
    }

    .alert {
        padding: 1rem;
        margin: 1rem 0;
        border-radius: 8px;
        font-size: 0.95rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .alert.show {
        opacity: 1;
    }

    .alert-success {
        background: rgba(76, 175, 80, 0.2);
        border: 1px solid #4caf50;
        color: #c8e6c9;
    }

    .alert-danger {
        background: rgba(244, 67, 54, 0.2);
        border: 1px solid #f44336;
        color: #ffcdd2;
    }

    .alert-warning {
        background: rgba(255, 193, 7, 0.2);
        border: 1px solid #ffc107;
        color: #fff8e1;
    }

    .alert-info {
        background: rgba(33, 150, 243, 0.2);
        border: 1px solid #2196f3;
        color: #bbdefb;
    }

    .logout-button {
        display: inline-block;
        background: #c62828;
        color: white;
        text-decoration: none;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        margin-top: 1.5rem;
        font-size: 0.9rem;
        font-weight: 500;
        transition: background 0.3s ease;
    }

    .resend-disabled {
        color: #777;
        cursor: not-allowed;
    }

    .change-email-form {
        margin: 1.5rem 0;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        border: 1px dashed #555;
    }

    .has-error .form-control {
        border-color: #f44336;
    }

    .help-block {
        font-size: 0.85rem;
        color: #f44336;
        text-align: left;
        margin-top: 0.5rem;
    }
    .verify-form{
        margin-bottom:10px;
    }
</style>

<div class="verify-container">
    <h2 class="verify-title">
        <i class="fas fa-envelope-open-text"></i> @lang('auth.verify_your_email')
    </h2>
    <p class="verify-subtitle">@lang('auth.verification_code_sent_message')</p>

    <div class="email-display">
        <strong>{{ auth()->user()->email }}</strong>
    </div>

    <form id="change-email-form" action="{{ route('user.updateEmail') }}" method="POST" class="change-email-form">
        @csrf
        <div class="input-group">
            <input
                id="email_address"
                type="email"
                name="email"
                class="form-control"
                value="{{ old('email', auth()->user()->email) }}"
                placeholder="@lang('auth.enter_new_email')"
                maxlength="100"
            >
            <button
                type="submit"
                class="btn btn-primary new_email_verification"
                title="@lang('auth.change_email')"
                @if(isset($lockout) && $lockout > 0) disabled @endif
>@lang('auth.change_email')
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
        @error('email')
            <span class="help-block">{{ $message }}</span>
        @enderror
    </form>

    <div id="otp-alert-container"></div>

    <div id="otp-section" style="display: none;">
        <p>@lang('auth.enter_6_digit_code')</p>
        <form id="otp-form" class="mb-3">
            @csrf
            <input type="hidden" id="user_id" value="{{ auth()->id() }}">
            <input type="hidden" id="business_id" value="{{ auth()->user()->business_id }}">

            <div class="input-group mb-3 verify-form">
                <input type="text" class="otp-input" data-index="0" maxlength="1" inputmode="numeric" pattern="[0-9]">
                <input type="text" class="otp-input" data-index="1" maxlength="1" inputmode="numeric" pattern="[0-9]">
                <input type="text" class="otp-input" data-index="2" maxlength="1" inputmode="numeric" pattern="[0-9]">
                <input type="text" class="otp-input" data-index="3" maxlength="1" inputmode="numeric" pattern="[0-9]">
                <input type="text" class="otp-input" data-index="4" maxlength="1" inputmode="numeric" pattern="[0-9]">
                <input type="text" class="otp-input" data-index="5" maxlength="1" inputmode="numeric" pattern="[0-9]">
            </div>

            <button type="submit" class="btn btn-primary">@lang('auth.verify_code')</button>
        </form>

        <div class="mb-3">
            <span class="timer" id="otp-timer"></span>
        </div>

        

        <p class="text-muted small" id="attempts-info"></p>
    </div>

<button type="button" class="btn btn-primary" id="otp-action-btn">
    <i class="fas fa-paper-plane"></i> @lang('auth.send_verification_code')
</button>

    <a href="{{ route('logout') }}" class="logout-button"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        @lang('auth.logout')
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
<script>
window.otpStatus = @json($otpStatus);
window.lockoutTime = {{ $lockout ?? 0 }};
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const otpForm = document.getElementById('otp-form');
    const otpInputs = document.querySelectorAll('.otp-input');
const actionBtn = document.getElementById('otp-action-btn');
    const otpTimer = document.getElementById('otp-timer');
    const alertContainer = document.getElementById('otp-alert-container');
    const otpSection = document.getElementById('otp-section');
    const attemptsInfo = document.getElementById('attempts-info');
    const changeEmailBtn = document.querySelector('.new_email_verification');

    let otpTimeLeft = 0;
    let timerInterval = null;
    let isOnCooldown = false;

    const PROGRESSIVE_DELAYS = {
        1: 60,
        2: 120,
        3: 300,
        4: 600
    };

function initializePage() {
    const inCooldown = checkInitialCooldown();
    
    if (window.otpStatus && window.otpStatus.exists && !window.otpStatus.expired && window.otpStatus.remaining_attempts > 0) {
        showOtpSection();
        initializeTimerOnLoad();
        
        if (!inCooldown) {
            updateActionButton(0);
        }
    } else {
        if (!inCooldown) {
            updateActionButton();
        }
    }
}

initializePage();
    
    if (window.lockoutTime > 0) {
        const changeEmailBtn = document.querySelector('.new_email_verification');
        if (changeEmailBtn) {
            changeEmailBtn.disabled = true;
            let timeLeft = window.lockoutTime;
            const lockoutInterval = setInterval(() => {
                changeEmailBtn.innerHTML = `<i class="fas fa-sync-alt"></i> ${timeLeft}s`;
                if (timeLeft <= 0) {
                    clearInterval(lockoutInterval);
                    changeEmailBtn.disabled = false;
                    changeEmailBtn.innerHTML = `<i class="fas fa-sync-alt"></i>`;
                } else {
                    timeLeft--;
                }
            }, 1000);
        }
    }

    function updateActionButton(secondsLeft = null) {
    if (secondsLeft === null) {
        actionBtn.innerHTML = '<i class="fas fa-paper-plane"></i> @lang('auth.send_verification_code')';
        actionBtn.disabled = false;
        actionBtn.classList.remove('resend-disabled');
    } else if (secondsLeft > 0) {
        actionBtn.innerHTML = `@lang('auth.resend_in') ${secondsLeft}s...`;
        actionBtn.disabled = true;
        actionBtn.classList.add('resend-disabled');
    } else {
        actionBtn.innerHTML = '@lang('auth.resend_otp')';
        actionBtn.disabled = false;
        actionBtn.classList.remove('resend-disabled');
    }
}
    
    function showOtpSection() {
        otpSection.style.display = 'block';
        if (otpInputs[0]) otpInputs[0].focus();
    }

    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length === 1 && index < 5) {
                otpInputs[index + 1].focus();
            }
            this.classList.add('filled');
        });

        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && !this.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });

        input.addEventListener('paste', function (e) {
            e.preventDefault();
            const pasted = e.clipboardData.getData('text').replace(/\D/g, '').slice(0, 6);
            if (pasted.length === 6) {
                otpInputs.forEach((inp, i) => {
                    inp.value = pasted[i];
                    inp.classList.add('filled');
                });
                otpInputs[5].focus();
            }
        });
    });

    function updateTimer() {
        const min = Math.floor(otpTimeLeft / 60);
        const sec = (otpTimeLeft % 60).toString().padStart(2, '0');
        otpTimer.textContent = `@lang('auth.expires_in') ${min}:${sec}`;

        if (otpTimeLeft <= 0) {
            clearInterval(timerInterval);
            otpTimer.textContent = '@lang('auth.code_expired')';
            if (otpForm.querySelector('button')) {
                otpForm.querySelector('button').disabled = true;
            }
            showAlert('@lang('auth.code_expired_resend')', 'warning');
        }
        otpTimeLeft--;
    }
    function initializeTimerOnLoad() {
    const expiresAt = window.otpStatus?.expires_at;
    const isExpired = window.otpStatus?.expired;

    if (!expiresAt || isExpired) {
        return;
    }

    const expiresDate = new Date(expiresAt);
    const now = new Date();
    const remainingSeconds = Math.floor((expiresDate - now) / 1000);

    if (remainingSeconds > 0) {
        otpTimeLeft = remainingSeconds;
        showOtpSection();
        if (actionBtn) actionBtn.style.display = 'inline';

        if (timerInterval) clearInterval(timerInterval);
        timerInterval = setInterval(updateTimer, 1000);
        updateTimer();

        if (otpForm && otpForm.querySelector('button')) {
            otpForm.querySelector('button').disabled = false;
        }

        if (otpInputs[0]) otpInputs[0].focus();
    } else {
        showAlert('@lang('auth.code_expired_request_new')', 'warning');
        if (otpForm && otpForm.querySelector('button')) {
            otpForm.querySelector('button').disabled = true;
        }
    }
}

function showResendCooldown(seconds) {
    let timeLeft = seconds;
    isOnCooldown = true;
    updateActionButton(timeLeft);

    const timer = setInterval(() => {
        timeLeft--;
        if (timeLeft <= 0) {
            clearInterval(timer);
            isOnCooldown = false;
            updateActionButton(0);
        } else {
            updateActionButton(timeLeft);
        }
    }, 1000);
}
    function checkInitialCooldown() {
        if (!window.otpStatus || !window.otpStatus.resend_count || window.otpStatus.resend_count === 0) {
            return false;
        }
        
        const resendCount = window.otpStatus.resend_count;
        const lastResendStr = window.otpStatus.last_resend_at;

        if (!lastResendStr) {
            return false;
        }

        if (resendCount >= 4) {
            updateActionButton();
            actionBtn.disabled = true;
            actionBtn.innerHTML = '@lang('auth.maximum_attempts_reached')';
            isOnCooldown = true;
            return true;
        }

        const lastResend = new Date(lastResendStr);
        const delay = PROGRESSIVE_DELAYS[resendCount];

        if (!delay) {
            return false;
        }

        const earliestResend = new Date(lastResend.getTime() + delay * 1000);
        const now = new Date();

        if (now < earliestResend) {
            const secondsLeft = Math.ceil((earliestResend - now) / 1000);
            isOnCooldown = true;
            showResendCooldown(secondsLeft);
            return true;
        }
        
        return false;
    }

   async function sendOtp() {
    if (isOnCooldown) return;

    isOnCooldown = true;
    actionBtn.disabled = true;
    actionBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> @lang('auth.sending')';

    try {
        const formData = {
            user_id: document.getElementById('user_id').value,
            business_id: document.getElementById('business_id').value,
            _token: document.querySelector('input[name="_token"]').value
        };

        const response = await fetch('/otp/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(formData)
        });

        if (response.status === 429) {
            const data = await response.json();
            const seconds = data.retry_after || 60;
            showResendCooldown(seconds);
            return;
        }

        const data = await response.json();

        if (data.success) {
            window.otpStatus = {
                ...window.otpStatus,
                exists: true,
                expired: false,
                expires_at: data.expires_at,
                resend_count: data.resend_count || 0,
                last_resend_at: new Date().toISOString(),
                remaining_attempts: 3
            };

            showAlert('@lang('auth.verification_code_sent')', 'success');
            showOtpSection();
            otpTimeLeft = 600;
            if (timerInterval) clearInterval(timerInterval);
            timerInterval = setInterval(updateTimer, 1000);
            updateTimer();
            if (otpForm && otpForm.querySelector('button')) {
                otpForm.querySelector('button').disabled = false;
            }
            attemptsInfo.textContent = '';

            const currentCount = window.otpStatus.resend_count;
            const nextDelay = PROGRESSIVE_DELAYS[currentCount] || 600;
            showResendCooldown(nextDelay);

        } else {
            showAlert(data.error || '@lang('auth.failed_to_send_code')', 'danger');
            updateActionButton();
        }
    } catch (err) {
        showAlert('@lang('auth.network_error')', 'danger');
        updateActionButton();
    } finally {
        isOnCooldown = false;
    }
}
    
    otpForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const otp = Array.from(otpInputs).map(i => i.value).join('');
        if (otp.length !== 6 || !/^\d{6}$/.test(otp)) {
            return showAlert('@lang('auth.enter_valid_code')', 'warning');
        }

        const verifyBtn = otpForm.querySelector('button');
        verifyBtn.disabled = true;
        verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> @lang('auth.verifying')';

        try {
            const formData = {
                otp,
                user_id: document.getElementById('user_id').value,
                business_id: document.getElementById('business_id').value,
                _token: document.querySelector('input[name="_token"]').value
            };

            const response = await fetch('/otp/verify', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(formData)
            });

            const data = await response.json();

            if (data.success) {
                showAlert('@lang('auth.email_verified_successfully')', 'success');
                setTimeout(() => window.location.href = '/home', 2000);
            } else {
                showAlert(data.error || '@lang('auth.invalid_code')', 'danger');
                if (data.remaining_attempts !== undefined) {
                    attemptsInfo.textContent = `@lang('auth.remaining_attempts') ${data.remaining_attempts}`;
                }
            }
        } catch (err) {
            showAlert('@lang('auth.verification_failed')', 'danger');
        } finally {
            verifyBtn.disabled = false;
            verifyBtn.innerHTML = '@lang('auth.verify_code')';
        }
    });

actionBtn?.addEventListener('click', sendOtp);
    function showAlert(message, type) {
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} show`;
        alert.innerHTML = `
            ${message}
            <button type="button" class="close" onclick="this.parentElement.remove()">&times;</button>
        `;
        alertContainer.innerHTML = '';
        alertContainer.appendChild(alert);
        setTimeout(() => alert.remove(), 5000);
    }
});
</script>

@endsection