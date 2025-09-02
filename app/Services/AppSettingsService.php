<?php

namespace App\Services;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AppSettingsService
{
    /**
     * @var AppSetting|null
     */
    protected $app_settings;

    /**
     * Construct the service and load the existing AppSetting
     * or create a default one if none exist, if the table is present.
     */
    public function __construct()
    {
        try {
            if (! \Schema::hasTable((new AppSetting)->getTable())) {
                $this->app_settings = null;
                return;
            }
        } catch (\Exception $e) {
            $this->app_settings = null;
            return;
        }

        $this->app_settings = AppSetting::first();

        if (! $this->app_settings) {
            $this->app_settings = AppSetting::create([
                'two_factor_settings' => [
                    'enable_2fa' => false,
                    'force_2fa' => false,
                    'recommend_2fa' => false,
                    'allow_disable_2fa' => false,
                    'disable_2fa_duration' => 30,
                    'disable_duration_unit' => 'minutes',
                    'force_2fa_after_date' => null,
                    'force_otp_after_social' => false,
                ],
                'theme_settings' => [
                    'enable_theme_change' => false,
                    'primary_color'       => '#FFB600',
                    'secondary_color'     => '#011530',
                    'body_color'          => '#F8F9FF',
                    'sidebar_text_color'  => '#FFFFFF',
                ],
                'maintenance_mode' => [
                    'enabled'        => false,
                    'enable_timer'   => false,
                    'duration'       => 60,
                    'duration_unit'  => 'minutes',
                    'started_at'     => null,
                    'end_time'       => null,
                ],
                'login_bg_image'                => false,
                'enable_custom_sidebar_logo'     => false,
                'header_language_change'         => false,
                'header_languages'               => [],
                'show_repair_status_login_screen' => false,
                'app_logo'                       => null,
                'enable_sidebar_dropdown'        => false,
                'business_settings_layout' => 'layout1',
                'storage_default_disk' => 'local',
                'enable_instant_pos' => false,
                'enable_instant_search' => false,
                'pos_cache_refresh_interval' => 'auto',
                'pos_max_cached_products' => 1000,

            ]);
        }
    }

    /**
     * Return the entire model instance or null if none/table doesn't exist.
     */
    public function all(): ?AppSetting
    {
        return $this->app_settings;
    }

    /***************************************************************************
     * GETTERS - They all safely check if app_settings is null or not.
     **************************************************************************/

    // ----------------- Two-Factor (2FA) Settings -----------------
    public function two_factor_settings(): array
    {
        return $this->app_settings
            ? ($this->app_settings->two_factor_settings ?? [])
            : [];
    }

    public function enable_2fa(): bool
    {
        return (bool) ($this->two_factor_settings()['enable_2fa'] ?? false);
    }

    public function force_2fa(): bool
    {
        return (bool) ($this->two_factor_settings()['force_2fa'] ?? false);
    }

    public function recommend_2fa(): bool
    {
        return (bool) ($this->two_factor_settings()['recommend_2fa'] ?? false);
    }

    public function allow_disable_2fa(): bool
    {
        return (bool) ($this->two_factor_settings()['allow_disable_2fa'] ?? false);
    }

    public function disable_2fa_duration(): int
    {
        return (int) ($this->two_factor_settings()['disable_2fa_duration'] ?? 30);
    }

    public function disable_2fa_unit(): string
    {
        return $this->two_factor_settings()['disable_duration_unit'] ?? 'minutes';
    }

    public function force_2fa_after_date(): ?string
    {
        return $this->two_factor_settings()['force_2fa_after_date'] ?? null;
    }

    public function force_otp_after_social(): ?string
    {
        return $this->two_factor_settings()['force_otp_after_social'] ?? null;
    }

    // ----------------- THEME / APPEARANCE -----------------
    public function theme_settings(): array
    {
        return $this->app_settings
            ? ($this->app_settings->theme_settings ?? [])
            : [];
    }

    public function primary_color(): string
    {
        return $this->theme_settings()['primary_color'] ?? '#FFB600';
    }

    public function secondary_color(): string
    {
        return $this->theme_settings()['secondary_color'] ?? '#011530';
    }

    public function sidebar_text_color(): string
    {
        return $this->theme_settings()['sidebar_text_color'] ?? '#FFF';
    }

    public function body_color(): string
    {
        return $this->theme_settings()['body_color'] ?? '#F8F9FF';
    }

    public function enable_theme_change(): bool
    {
        return (bool) ($this->theme_settings()['enable_theme_change'] ?? false);
    }

    // ----------------- LOGIN PAGE -----------------
    public function login_bg_image(): bool
    {
        return $this->app_settings
            ? (bool) $this->app_settings->login_bg_image
            : false;
    }

    public function login_bg_image_url(): ?string
    {
        return $this->app_settings
            ? $this->app_settings->login_bg_image_url
            : null;
    }

    // ----------------- SIDEBAR -----------------
    public function enable_custom_sidebar_logo(): bool
    {
        return $this->app_settings
            ? (bool) $this->app_settings->enable_custom_sidebar_logo
            : false;
    }

    public function enable_sidebar_dropdown(): bool
    {
        return $this->app_settings
            ? (bool) $this->app_settings->enable_sidebar_dropdown
            : false;
    }

    // ----------------- LANGUAGE SETTINGS -----------------
    public function header_language_change(): bool
    {
        return $this->app_settings
            ? (bool) $this->app_settings->header_language_change
            : false;
    }

    public function header_languages(): array
    {
        return $this->app_settings
            ? ($this->app_settings->header_languages ?? [])
            : [];
    }

    // ----------------- REPAIR STATUS -----------------
    public function show_repair_status_login_screen(): bool
    {
        return $this->app_settings
            ? (bool) $this->app_settings->show_repair_status_login_screen
            : false;
    }

    // ----------------- FONTS -----------------
    public function fonts(): array
    {
        return $this->app_settings
            ? ($this->app_settings->fonts ?? [
                'english' => 'Roboto',
                'arabic'  => 'Cairo',
            ])
            : [
                'english' => 'Roboto',
                'arabic'  => 'Cairo',
            ];
    }

    // ----------------- GOOGLE RECAPTCHA -----------------
    public function google_recaptcha(): array
    {
        return $this->app_settings
            ? ($this->app_settings->google_recaptcha ?? [
                'enable_recaptcha'       => false,
                'google_recaptcha_key'   => '',
                'google_recaptcha_secret' => '',
            ])
            : [
                'enable_recaptcha'       => false,
                'google_recaptcha_key'   => '',
                'google_recaptcha_secret' => '',
            ];
    }

    // ----------------- SOCIAL LOGINS -----------------
    public function social_logins(): array
    {
        if (! $this->app_settings) {
            return [];
        }
        if (! $this->app_settings->social_logins) {
            return [];
        }
        return json_decode($this->app_settings->social_logins, true) ?: [];
    }

    // ----------------- USER LOCK -----------------
    public function user_lock(): array
    {
        if (! $this->app_settings) {
            return [
                'enabled'       => false,
                'max_attempts'  => 4,
                'lock_time'     => 20,
                'duration_unit' => 'minutes',
            ];
        }
        return $this->app_settings->user_lock ?? [
            'enabled'       => false,
            'max_attempts'  => 4,
            'lock_time'     => 20,
            'duration_unit' => 'minutes',
        ];
    }

    public function user_lock_enabled(): bool
    {
        return (bool) $this->user_lock()['enabled'];
    }

    public function user_lock_max_attempts(): int
    {
        return (int) $this->user_lock()['max_attempts'];
    }

    public function user_lock_time(): int
    {
        return (int) $this->user_lock()['lock_time'];
    }

    public function user_lock_duration_unit(): string
    {
        return $this->user_lock()['duration_unit'] ?? 'minutes';
    }

    // ----------------- FORCE EMAIL VERIFY -----------------
    public function force_email_verify(): bool
    {
        return $this->app_settings ? (bool) $this->app_settings->force_email_verify : false;
    }

    // ----------------- Temp Email Protection -----------------
    public function temp_email_protection(): bool
    {
        return $this->app_settings ? (bool) $this->app_settings->temp_email_protection : false;
    }

    // --------------- MAINTENANCE MODE -----------------
    public function maintenance_mode(): array
    {
        return $this->app_settings ? ($this->app_settings->maintenance_mode ?? []) : [];
    }
    public function maintenance_enabled(): bool
    {
        return (bool) ($this->maintenance_mode()['enabled'] ?? false);
    }
    public function maintenance_duration(): int
    {
        return (int) ($this->maintenance_mode()['duration'] ?? 60);
    }
    public function maintenance_duration_unit(): string
    {
        return $this->maintenance_mode()['duration_unit'] ?? 'minutes';
    }
    public function maintenance_timer_enabled(): bool
    {
        return (bool) ($this->maintenance_mode()['enable_timer'] ?? true);
    }
    public function maintenance_end_time(): ?\Carbon
    {
        $et = $this->maintenance_mode()['end_time'] ?? null;
        return $et ? \Carbon::parse($et) : null;
    }
    public function maintenance_seconds_left(): int
    {
        if (! $this->maintenance_enabled() || ! $this->maintenance_timer_enabled()) {
            return 0;
        }
        $end = $this->maintenance_end_time();
        return $end ? max(0, now()->diffInSeconds($end, false)) : 0;
    }
    private function calculateEndTime($startedAt, int $duration, string $unit): string
    {
        $sec = $duration * [
            'minutes' => 60,
            'hours'   => 3600,
            'days'    => 86400,
        ][$unit] ?? 60;

        return \Carbon::parse($startedAt)->addSeconds($sec)->utc()->toIso8601String();
    }
    public function disableMaintenance(): void
    {
        if (! $this->app_settings) {
            return;
        }
        $m               = $this->maintenance_mode();
        $m['enabled']    = false;
        $m['started_at'] = null;
        $m['end_time']   = null;

        $this->app_settings->maintenance_mode = $m;
        $this->app_settings->save();
    }

    /**
     *  Check if timer has expired; if so, turn maintenance off.
     */
    public function autoDisableIfTimerExpired(): void
    {
        if (
            $this->maintenance_enabled() &&
            $this->maintenance_timer_enabled() &&
            $this->maintenance_seconds_left() <= 0
        ) {
            $this->disableMaintenance();
        }
    }
    //Sidebar Layour
    public function sidebar_layout(): string
    {
        return $this->app_settings->sidebar_layout ?? 'layout1';
    }

    public function custom_sidebar_type(): string
    {
        return $this->app_settings->custom_sidebar_type ?? 'sidebar';
    }

    public function business_settings_layout(): string
    {
        return $this->app_settings->business_settings_layout ?? 'layout1';
    }

    /* STORAGE */
    public function storage_default_disk(): ?string
    {
        return $this->app_settings?->storage_default_disk ?: null;
    }

    /* POS SETTINGS */
    public function enable_instant_pos(): bool
    {
        return $this->app_settings ? (bool) $this->app_settings->enable_instant_pos : false;
    }

    public function enable_instant_search(): bool
    {
        return $this->app_settings ? (bool) $this->app_settings->enable_instant_search : false;
    }

    public function pos_cache_refresh_interval(): string
    {
        return $this->app_settings ? ($this->app_settings->pos_cache_refresh_interval ?? 'auto') : 'auto';
    }

    public function pos_max_cached_products(): int
    {
        return $this->app_settings ? (int) ($this->app_settings->pos_max_cached_products ?? 1000) : 1000;
    }

    public function storage_disks(): array
    {
        if (! $this->app_settings) {
            return [];
        }
        return (array) ($this->app_settings->storage_disks ?? []);
    }

    public function storage_disk(string $name): array
    {
        $all = $this->storage_disks();
        return (array) ($all[$name] ?? []);
    }
public function set_storage_disks(array $disks): void
{
    if (! $this->app_settings) {
        return;
    }

    $normalized = [];
    foreach ($disks as $name => $cfg) {
        if (in_array($name, ['local', 'public'], true)) {
            continue;                
        }
        $normalized[$name] = $this->normalize_s3_compatible((array) $cfg);
    }

    $this->app_settings->storage_disks = $normalized;
    $this->app_settings->save();
}

public function upsert_storage_disk(string $name, array $config): void
{
    if (! $this->app_settings) {
        return;
    }
    if (in_array($name, ['local', 'public'], true)) {
        return;                     
    }

    $all        = $this->storage_disks();
    $all[$name] = $this->normalize_s3_compatible((array) $config);
    $this->app_settings->storage_disks = $all;
    $this->app_settings->save();
}

    /** Remove one disk. */
    public function remove_storage_disk(string $name): void
    {
        if (! $this->app_settings) {
            return;
        }
        $all = $this->storage_disks();
        unset($all[$name]);
        $this->app_settings->storage_disks = $all;
        $this->app_settings->save();
    }

    /** Set default disk. */
    public function set_storage_default_disk(?string $name): void
    {
        if (! $this->app_settings) {
            return;
        }
        $this->app_settings->storage_default_disk = $name ?: null;
        $this->app_settings->save();
    }

  public function apply_storage_config(bool $forget_existing = true): void
{
    $base         = require config_path('filesystems.php');
    $base_disks   = $base['disks'] ?? [];

    $db_disks = (array) $this->storage_disks();
    foreach (['local', 'public'] as $protected) {
        unset($db_disks[$protected]);
    }

    $merged = !empty($db_disks) ? array_replace_recursive($base_disks, $db_disks) : $base_disks;
    Config::set('filesystems.disks', $merged);

    $default = $this->storage_default_disk() ?: 'local';
    Config::set('filesystems.default', $default);

    foreach ($db_disks as $disk => $cfg) {
        $verify = ! (bool) data_get($cfg, 'disable_http_verify', false);
        Config::set("filesystems.disks.$disk.verify", $verify);
        Config::set("filesystems.disks.$disk.http.verify", $verify);
        Config::set("filesystems.disks.$disk.throw", true);

        if (!is_null(data_get($cfg, 'use_path_style_endpoint'))) {
            Config::set(
                "filesystems.disks.$disk.use_path_style_endpoint",
                (bool) data_get($cfg, 'use_path_style_endpoint')
            );
        }
    }

    if ($forget_existing) {
        $to_forget = array_unique(array_merge(array_keys($db_disks), [$default]));
        $manager   = app('filesystem');
        foreach ($to_forget as $disk_name) {
            try { $manager->forgetDisk($disk_name); } catch (\Throwable $e) {}
            try { Storage::forgetDisk($disk_name); } catch (\Throwable $e) {}
        }
    }
}



    public function build_runtime_disk(array $config)
    {
        $config = $this->normalize_s3_compatible($config);
        return Storage::build($config);
    }

    protected function normalize_s3_compatible(array $cfg): array
    {
        if (($cfg['driver'] ?? null) === 'local') {
            $cfg['throw'] = true;
            return $cfg;
        }

        $cfg['driver'] = $cfg['driver'] ?? 's3';
        $cfg['use_path_style_endpoint'] = !empty($cfg['use_path_style_endpoint']);
        $cfg['disable_http_verify']     = !empty($cfg['disable_http_verify']);
        $cfg['signed_urls']             = !empty($cfg['signed_urls']);

        $cfg['throw'] = true;
        return $cfg;
    }


    /***************************************************************************
     * UPDATE 
     **************************************************************************/
    public function update(array $data): void
    {
        if (! $this->app_settings) {
            return;
        }

        // 1) TWO FACTOR
        $two_factor = $this->two_factor_settings();
        $two_factor['enable_2fa']               = $data['two_factor_settings']['enable_2fa']               ?? false;
        $two_factor['force_2fa']                = $data['two_factor_settings']['force_2fa']                ?? false;
        $two_factor['recommend_2fa']            = $data['two_factor_settings']['recommend_2fa']            ?? false;
        $two_factor['allow_disable_2fa']        = $data['two_factor_settings']['allow_disable_2fa']        ?? false;
        $two_factor['disable_2fa_duration']     = $data['two_factor_settings']['disable_2fa_duration']     ?? 30;
        $two_factor['disable_duration_unit']    = $data['two_factor_settings']['disable_duration_unit']    ?? 'minutes';
        $two_factor['force_2fa_after_date']     = $data['two_factor_settings']['force_2fa_after_date']     ?? null;
        $two_factor['force_otp_after_social']   = $data['two_factor_settings']['force_otp_after_social']   ?? null;
        $this->app_settings->two_factor_settings = $two_factor;

        // 2) THEME
        $theme = $this->theme_settings();
        $theme['primary_color']     = $data['theme_settings']['primary_color']     ?? '#FFB600';
        $theme['secondary_color']   = $data['theme_settings']['secondary_color']   ?? '#011530';
        $theme['body_color']        = $data['theme_settings']['body_color']        ?? '#F8F9FF';
        $theme['sidebar_text_color'] = $data['theme_settings']['sidebar_text_color'] ?? '#FFFFF';
        $this->app_settings->theme_settings = $theme;
       

        // 3) LOGIN PAGE
        $this->app_settings->login_bg_image = $data['login_bg_image'] ?? false;
        if (! empty($data['login_bg_image_url'])) {
            $this->app_settings->login_bg_image_url = $data['login_bg_image_url'];
        }
        //Allow Theme Change(Businesses)
        $this->app_settings->enable_theme_change = $data['enable_theme_change'] ?? false;
        
        // 4) SIDEBAR
        $this->app_settings->enable_custom_sidebar_logo = $data['enable_custom_sidebar_logo'] ?? false;
        $this->app_settings->enable_sidebar_dropdown    = $data['enable_sidebar_dropdown']    ?? false;
        $this->app_settings->sidebar_layout             = $data['sidebar_layout']             ?? 'layout1';
        $this->app_settings->custom_sidebar_type        = $data['custom_sidebar_type']        ?? 'sidebar';

        // 5) LANGUAGE
        $this->app_settings->header_language_change = $data['header_language_change'] ?? false;
        $this->app_settings->header_languages       = $data['header_languages']       ?? [];

        // 6) REPAIR
        $this->app_settings->show_repair_status_login_screen = $data['show_repair_status_login_screen'] ?? false;

        // 7) FONTS
        if (isset($data['fonts'])) {
            $this->app_settings->fonts = $data['fonts'];
        }

        // 8) APP LOGO
        $logo_data = json_decode($this->app_settings->app_logo, true) ?? [];
        if (! empty($data['app_logo_light'])) {
            $logo_data['light'] = $data['app_logo_light'];
        }
        if (! empty($data['app_logo_dark'])) {
            $logo_data['dark'] = $data['app_logo_dark'];
        }
        if (! empty($data['app_favicon'])) {
            $logo_data['favicon'] = $data['app_favicon'];
        }
        if (! empty($logo_data)) {
            $this->app_settings->app_logo = json_encode($logo_data);
        }

        // GOOGLE RECAPTCHA
        if (isset($data['google_recaptcha'])) {
            $default_recaptcha = [
                'enable_recaptcha'       => false,
                'google_recaptcha_key'   => '',
                'google_recaptcha_secret' => '',
            ];
            $google_recaptcha = array_merge($default_recaptcha, $data['google_recaptcha']);
            $this->app_settings->google_recaptcha = $google_recaptcha;
        }

        // SOCIAL LOGINS
        if (isset($data['social_logins'])) {
            $this->app_settings->social_logins = $data['social_logins'];
        }

        // USER LOCK
        if (isset($data['user_lock'])) {
            $user_lock = $this->user_lock();
            $user_lock['enabled']       = ! empty($data['user_lock']['enabled']);
            $user_lock['max_attempts']  = (int) ($data['user_lock']['max_attempts'] ?? 4);
            $user_lock['lock_time']     = (int) ($data['user_lock']['lock_time']    ?? 20);
            $user_lock['duration_unit'] = $data['user_lock']['duration_unit']       ?? 'minutes';
            $this->app_settings->user_lock = $user_lock;
        }

        // FORCE EMAIL VERIFY
        if (isset($data['force_email_verify'])) {
            $this->app_settings->force_email_verify = (bool) $data['force_email_verify'];
        } else {
            $this->app_settings->force_email_verify = false;
        }
        // TEMP EMAIL PROTECTION
        if (isset($data['temp_email_protection'])) {
            $this->app_settings->temp_email_protection = (bool) $data['temp_email_protection'];
        } else {
            $this->app_settings->temp_email_protection = false;
        }
        // BUSINESS SETTINGS LAYOUT
        $this->app_settings->business_settings_layout = $data['business_settings_layout'] ?? 'layout1';

        //MAINTENANCE MODE
        if (array_key_exists('maintenance_mode', $data)) {
            $current  = $this->maintenance_mode();
            $incoming = array_merge($current, $data['maintenance_mode']);
            $incoming['enabled']      = ! empty($incoming['enabled']);
            $incoming['enable_timer'] = ! empty($incoming['enable_timer']);
            $prevOn = (bool) ($current['enabled'] ?? false);
            $nowOn  = (bool) $incoming['enabled'];
            $incoming['duration']      = (int)    ($incoming['duration']      ?? 60);
            $incoming['duration_unit'] = (string) ($incoming['duration_unit'] ?? 'minutes');
            if (! $prevOn && $nowOn) {
                $incoming['started_at'] = now()->utc()->toIso8601String();
            }
            if ($nowOn) {
                $incoming['end_time'] = $this->calculateEndTime(
                    $incoming['started_at'] ?? now()->utc(),
                    $incoming['duration'],
                    $incoming['duration_unit']
                );
            }
            if ($prevOn && ! $nowOn) {
                $incoming['started_at'] = $incoming['end_time'] = null;
            }
            $this->app_settings->maintenance_mode = $incoming;
        }

        //Storage 
        if (array_key_exists('storage_default_disk', $data)) {
            $this->app_settings->storage_default_disk = $data['storage_default_disk'] ?: null;
        }
        
        /**
         * Inside update(): filter out protected disks before saving.
         */
        if (array_key_exists('storage_disks', $data) && is_array($data['storage_disks'])) {
            $incoming = [];
            foreach ($data['storage_disks'] as $name => $cfg) {
                if (in_array($name, ['local', 'public'], true)) {
                    continue;                // never persist built-ins
                }
                $incoming[$name] = $this->normalize_s3_compatible((array) $cfg);
            }
            $this->app_settings->storage_disks = $incoming;
        }

        // // storage_disks
        // if (array_key_exists('storage_disks', $data) && is_array($data['storage_disks'])) {
        //     $incoming = [];
        //     foreach ($data['storage_disks'] as $name => $cfg) {
        //         $incoming[$name] = $this->normalize_s3_compatible((array) $cfg);
        //     }
        //     $this->app_settings->storage_disks = $incoming;
        // }

        // POS SETTINGS
        if (isset($data['enable_instant_pos'])) {
            $this->app_settings->enable_instant_pos = (bool) $data['enable_instant_pos'];
        } else {
            $this->app_settings->enable_instant_pos = false;
        }
        
        if (isset($data['enable_instant_search'])) {
            $this->app_settings->enable_instant_search = (bool) $data['enable_instant_search'];
        } else {
            $this->app_settings->enable_instant_search = false;
        }
        
        if (isset($data['pos_cache_refresh_interval'])) {
            $this->app_settings->pos_cache_refresh_interval = $data['pos_cache_refresh_interval'];
        }
        
        if (isset($data['pos_max_cached_products'])) {
            $this->app_settings->pos_max_cached_products = (int) $data['pos_max_cached_products'];
        }

        //save after all updates
        $this->app_settings->save();
        $this->apply_storage_config(true);
    }
}
