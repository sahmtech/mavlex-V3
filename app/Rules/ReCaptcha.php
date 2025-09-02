<?php
  
namespace App\Rules;
  
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;
  
class ReCaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
          
    }
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $service = app(\App\Services\AppSettingsService::class);
        $recaptcha_settings = $service->google_recaptcha(); 
        $secret = $recaptcha_settings['google_recaptcha_secret'] ?? null;

        if (empty($secret)) {
            return false;
        }
        $response = Http::get('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => $secret,
            'response' => $value
        ]);

        $result = $response->json();

        return $result['success'] ?? false;
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The google recaptcha is required.';
    }
}