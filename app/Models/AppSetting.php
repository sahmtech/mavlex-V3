<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $table = 'app_settings';

    protected $fillable = [
        'two_factor_settings',
        'maintenance_mode',
        'theme_settings',
        'sidebar_text_color',
        'login_bg_image',
        'login_bg_image_url',
        'enable_custom_sidebar_logo',
        'header_language_change',
        'header_languages',
        'show_repair_status_login_screen',
        'app_logo',
        'fonts',
        'user_lock',
        'force_email_verify',
        'enable_sidebar_dropdown'
    ];

    protected $casts = [
        'two_factor_settings' => 'array',
        'theme_settings' => 'array',
        'login_bg_image' => 'boolean',
        'enable_custom_sidebar_logo' => 'boolean',
        'header_language_change' => 'boolean',
        'header_languages' => 'array',
        'show_repair_status_login_screen' => 'boolean',
        'fonts' => 'array',
        'google_recaptcha' => 'array',
        'user_lock' => 'array',
        'force_email_verify' => 'boolean',
        'maintenance_mode' => 'array',
        'temp_email_protection' => 'boolean',
        'enable_sidebar_dropdown' => 'boolean',
        'storage_disks' => 'encrypted:array',
    ];

    public function login_bg_image()
    {
        return (bool) $this->login_bg_image;
    }

}
