<?php

return [

    'app_settings' => 'Application Settings',
    'manage_app_settings' => 'Manage Application Settings',
    'tab_2fa' => '2FA',
    'tab_theme' => 'Appearance',
    'tab_login_page' => 'Login Page',
    'tab_sidebar' => 'Sidebar',
    'tab_language' => 'Language',
    'tab_repair_status' => 'Repair Status',
    'tab_pos' => 'POS',
    'tab_logo' => 'Logo',
    // Buttons
    'update_settings' => 'Update Settings',

    'enable_custom_bg_image_for_login' => 'Enable Custom Login Background',
    'enable_custom_bg_image_for_login_tooltip' => 'Set a custom background image for the login page.',

    'enable_custom_sidebar_logo' => 'Allow Custom Sidebar Logo',
    'enable_custom_sidebar_logo_tooltip' => 'Permit businesses to use a custom logo in the sidebar.',

    // language.blade.php
    'header_language_change' => 'Header Language Change',
    'header_language_change_tooltip' => 'Allow users to switch the language from the main header.',
    'header_languages_label' => 'Header Languages',
    'header_languages_label_tooltip' => 'Select which languages to display in the header.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'Show Repair Status on Login Screen',

    // 2fa.blade.php
    'enable_2fa' => 'Enable 2FA',
    'enable_2fa_tooltip' => 'Activate Two-Factor Authentication for the app.',

    'force_2fa' => 'Force 2FA',
    'force_2fa_tooltip' => 'Users must set up Two-Factor Authentication before they can use the app.',

    'recommend_2fa' => 'Recommend 2FA',
    'recommend_2fa_tooltip' => 'A one-time modal appears at login to encourage users to enable 2FA.',

    'allow_disable_2fa' => 'Allow Temporarily Disabling 2FA',
    'allow_disable_2fa_tooltip' => 'Permit users to temporarily disable 2FA until a specified time.',

    'disable_2fa_duration_label' => 'Disable 2FA Duration',
    'disable_2fa_duration_label_tooltip' => 'Define the period during which 2FA can remain disabled.',

    'disable_2fa_unit_label' => 'Disable 2FA Unit',

    'force_2fa_after_date_label' => 'Force 2FA After Date',
    'force_2fa_after_date_label_tooltip' => 'After this date, all users must enable 2FA. The enforced date is also shown in the 2FA recommendation modal.',

    'primary_color_label' => 'Primary Color',
    'primary_color_label_tooltip' => 'Select the default primary color for the application. This color will be used by businesses that do not set their own theme.',
    'secondary_color_label' => 'Secondary Color',
    'secondary_color_label_tooltip' => 'Select the default secondary color for the application. This color will be used by businesses that do not set their own theme.',
    //ToDO translate
    'body_color_label' => 'Body Color',
    'sidebar_text_color_label' => 'Sidebar Text Color',
    'body_color_label_tooltip' => 'Select the Default Body color for the application, Experimental feature may be removed in future',
    'sidebar_text_color_label_tooltip' => 'Select the Default Sidebar Text Color for the application now you can choose dark color for light secondary color',

    'allow_theme_change' => 'Allow Theme Change',
    'allow_theme_change_tooltip' => 'Enable businesses to customize their own theme colors. When enabled, businesses without custom colors will use the default colors set here by the superadmin.',

    'login_bg_image_label' => 'Login Background Image',
    'login_bg_image_label_tooltip' => 'Uploading a new image will replace the existing background.',

    'logo_dark_tooltip'  => 'Change the application default dark logo, will be used on light mode.',
    'logo_light_tooltip' => 'Change the application default light logo, will be used on dark mode.',
    'favicon_tooltip' => 'Recommended dimensions: 32x32px. This icon appears in browser tabs and bookmarks.',
    'upload_favicon' => 'Upload Favicon',

    //Fonts
    'tab_fonts' => 'Fonts',
    'english_font'            => 'English Font',
    'arabic_font'             => 'Arabic Font',
    'custom_font_placeholder' => 'Enter a custom font name...',
    'select_font'             => 'Select a font...',
    'or'                      => 'or',
    'font_help_text'          => 'Choose from the list or enter your custom font.',
    'english_font_tooltip'  => 'Enter a custom font name or choose one from the list. You can find font names at :url',
    'arabic_font_tooltip'   => 'Enter a custom font name or choose one from the list. You can find font names at :url',

    //Recaptcha:
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha'              => 'Enable Google reCAPTCHA',
    'enable_recaptcha_tooltip'      => 'Toggle to enable reCAPTCHA protection. Get your site key and secret from :url',
    'enable_recaptcha_text'         => 'Enable reCAPTCHA',
    'google_recaptcha_key'          => 'Google reCAPTCHA Site Key',
    'google_recaptcha_secret'       => 'Google reCAPTCHA Secret Key',
    'google_recaptcha_key_placeholder'    => 'Enter your Google reCAPTCHA Site key',
    'google_recaptcha_secret_placeholder' => 'Enter your Google reCAPTCHA secret Key',
    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'Enable Two-Factor Authentication',
    'modal_enable_2fa_desc' => 'We recommend enabling Two-Factor Authentication (2FA) to enhance the security of your account.',
    'enable_now_button' => 'Enable Now',
    'maybe_later_button' => 'Maybe Later',
    'close_aria_label' => 'Close',

    // 2FA Verify page
    'one_time_password_heading' => 'One-Time Password',
    'one_time_password_label' => 'One-Time Password',
    'enter_2fa_code_placeholder' => 'Enter 2FA code',
    'disable_2fa_for' => 'Disable 2FA for :duration :unit',
    'verify_button' => 'Verify',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'Two-Factor Authentication',
    'google_auth_app_desc' => 'Google Authenticator app',
    'configured_status' => 'Configured',
    'needs_configuration_status' => 'Needs Configuration',
    'two_factor_scan_or_enter_msg' => 'Please scan the QR code below using your Google Authenticator app or enter the secret manually, then enter the generated code.',
    'your_secret_key_msg' => 'Your secret key (if you need to enter it manually):',

    // 2FA field labels
    'one_time_password_label' => 'One-Time Password',
    'enter_2fa_code_placeholder' => 'Enter 2FA code',
    '2fa_will_be_forced_after_date' => '2FA will be forced after :date.',

    // Buttons
    '2fa' => '2FA',
    'verify_button' => 'Verify',

    'confirm_access_recovery_codes' => 'Confirm Access',
    're_authenticate_message'       => 'You must re-authenticate to access Setup or 2FA Recovery Codes.',
    'choose_method'                 => 'Choose method:',
    'one_time_password'             => 'One-Time Password (OTP)',
    'password'                      => 'Password',
    'enter_code_or_password'        => 'Enter Code / Password:',
    'confirm'                       => 'Confirm',

    '2fa_recovery_codes'           => '2FA Recovery Codes',
    'recovery_codes_description'   => 'These codes let you log in if you lose access to your authenticator device. Each code can only be used once.',
    'regenerate_codes'             => 'Regenerate Codes',
    'copy'                         => 'Copy',
    'copy_all'                     => 'Copy All',
    'no_recovery_codes_available'  => 'No recovery codes available. You can generate new ones below.',
    'copied'                       => 'Code copied to clipboard!',
    'all_codes_copied'             => 'All recovery codes copied to clipboard!',
    'supported_app'                => 'Supported Apps',
    'supported_apps' => [
        'Authy'                    => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP'                  => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator'     => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator'  => ['Windows Phone'],
        'LastPass Authenticator'   => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password'                => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    //social logins:
    'social_login_settings'       => 'Social Login Settings',
    'social_login_settings_help'  => 'Enter your social login credentials.',
    'client_id'                   => 'Client ID',
    'client_secret'               => 'Client Secret',
    'redirect_url'                => 'Redirect URL',
    'enter_client_id'             => 'Enter :provider Client ID',
    'enter_client_secret'         => 'Enter :provider Client Secret',
    'enter_redirect_url'          => 'Enter :provider Redirect URL',
    'enable_social_login' => 'Enable Social Login',
    'tab_social' => 'Social Logins',
    'or_login_with' => 'Or Login with',
    'force_otp_after_social_login' => 'Force OTP after Social Login',
    'force_otp_after_social_login_tooltip' => 'If enabled, users who sign in using social logins will be required to verify an OTP.',

    //Lock Users:
    'locked_until' => 'Locked Until',
    'locked_users' => 'Locked Users',
    'view_locked_users' => 'View Locked Users',
    'tab_login_security' => 'Login Security',
    'unlock' => 'Unlock',
    'enable_user_lock_label' => 'Enable User Lock',
    'enable_user_lock_tooltip' => 'Enable/disable user lock after failed login attempts.',
    'max_login_attempts_label' => 'Maximum Login Attempts',
    'max_login_attempts_tooltip' => 'Number of attempts allowed before user is locked out.',
    'lock_duration_label' => 'Lock Duration',
    'lock_duration_tooltip' => 'Amount of time the user is locked out (in numbers).',
    'lock_duration_unit_label' => 'Lock Duration Unit',
    'lock_duration_unit_tooltip' => 'Choose the time unit for lock duration: minutes, hours, days, etc.',
    'account_locked_for_time_unit' => 'Your account is locked for :time :unit.',
    'user_unlocked_message' => 'User unlocked successfully!',

    //Verify email:
    'verify_email_address_title' => 'Verify Your Email Address',
    'fresh_verification_sent' => 'A fresh verification link has been sent to your email address.',
    'verify_email_before_proceeding' => 'Before proceeding, please check your email for a verification link.',
    'did_not_receive_email' => 'If you did not receive the email',
    'click_here_request_another' => 'click here to request another',
    'logout' => 'Logout',
    'force_email_verify' => 'Force Email Verification',
    'force_email_verify_tooltip' => 'If enabled, users must verify their email address before accessing the system.',

    //Reset Mapping
    'reset_purchase_sell_mapping'   => 'Reset Purchase-Sell Mapping',
    'select_business'               => 'Select Business:',
    'all_businesses'                => 'All Businesses',
    'chunk_size'                    => 'Chunk Size:',
    'reset_mapping'                 => 'Reset Mapping',
    'purchase_sell_mismatch_tooltip' => "Choose which business mappings need to be reset. If you've a large database, we recommend choosing individual businesses for resetting the mapping.",
    'chunk_size_tooltip'             => "Mapping will be reset in smaller chunks. For large datasets, choose a preferred chunk size. Active maintenance mode is recommended.",

    //Maintenance Mode
    'tab_maintenance_mode' => 'Maintenance Mode',
    'maintenance_mode'           => 'Maintenance mode',
    'maintenance_mode_tooltip'   => 'Put the application into maintenance (visitors will see the maintenance screen).',
    'enable_countdown'           => 'Enable countdown timer',
    'enable_timer_tooltip'       => 'Show a live countdown until maintenance ends.',
    'maintenance_duration'       => 'Duration',
    'maintenance_unit'           => 'Duration unit',
    'minutes'                    => 'Minutes',
    'hours'                      => 'Hours',
    'days'                       => 'Days',
    // Maintenance page
    'under_maintenance'              => 'Under maintenance',
    'maintenance_heading'            => 'We’re doing a bit of housekeeping.',
    'maintenance_subheading'         => 'Thank you for your patience!',
    'maintenance_back_in'            => 'We’ll be back in :time',
    'maintenance_back_no_timer'      => 'We’ll be back as soon as we finish our maintenance.',
    // Mapping reset page
    'mapping_reset_progress'     => 'Mapping Reset Progress',
    'mapping_reset_in_progress'  => 'Mapping reset is in progress',
    'batch_status'               => 'Batch Status',
    'refresh_status'             => 'Refresh Status',
    // Mapping reset result page & status
    'mapping_reset_result'       => 'Mapping Reset Result',
    'chunk_processing_status'    => 'Chunk Processing Status',

    // Table headers
    'business'                   => 'Business',
    'chunk_status'               => 'Chunk Status',
    'total_chunks'               => 'Total Chunks',
    'status'                     => 'Status',

    // Button
    'go_back'                    => 'Go Back',

        // ...
        'processed_jobs'           => 'Mapping Jobs',
        'processed_jobs_subtitle'  => 'All dispatched mapping batches',
        'uuid'                     => 'Batch UUID',
        'job_name'                 => 'Job Name',
        'chunk_size'               => 'Chunk Size',
        'completed_chunks'         => 'Chunks Done',
        'total_chunks'             => 'Total Chunks',
        'started_at'               => 'Started At',
        'finished_at'              => 'Last Updated',
        'business'                 => 'Business',
        'status'                   => 'Status',
        'all_businesses'           => 'All Businesses',
        'go_back'                  => 'Go Back',
        'view_rebuild_jobs' => 'View Stock Rebuild Jobs',
        'reset_mapping_instruction' => 
    "It’s recommended to set your queue driver to a real backend:\n".
    "→ In your .env file, set `QUEUE_CONNECTION=database`.\n\n".
    "Also enable Maintenance Mode (Application Settings → Maintenance Mode) while mapping is running to avoid duplicate or missed data.\n\n".
    "If you have a large database, resetting will take longer—consider resetting per business.\n\n".
    "Before you begin:\n".
    "• Take a full database backup.\n".
    "• Monitor the process via logs to catch any errors.",
    'recovery_codes_generated_successfully' => 'Recovery Codes Generated Successfully',
    'sync_disposable_list'   => 'Sync Disposable‐Email List',
    'sync_disposable_success' => 'Disposable‐email list updated.',
    'sync_disposable_failed'  => 'Failed to sync disposable list.',
    'temp_email_protection' => 'Prevent disposable e-mail addresses',
    'temp_email_protection_tooltip' => 'Block temporary/throw-away e-mail domains (e.g. Mailinator, 10MinuteMail).',
    'disposable_not_allowed' => 'Disposable email addresses are not allowed.',

    //3.3
    'enable_sidebar_dropdown'         => 'Enable Sidebar Dropdown',
    'enable_sidebar_dropdown_tooltip' => 'Collapse sub-menus into a clickable dropdown inside the sidebar.',
    //Custom Menu
     'menu'             => 'Menu',
    'menus_heading'    => 'Menus',
    'menus_description'=> 'Manage and organize your menu items.',
    'add_menu_item'    => 'Add Menu Item',
    'save_menu'        => 'Save Menu',
    'label'         => 'Label',
    'parent'        => 'Parent',
    'icon_type'     => 'Icon type',
    'svg'           => 'SVG',
    'fontawesome'   => 'FontAwesome',
    'svg_icon'      => 'SVG icon',
    'fa_class'      => 'FA class',
    'named_route'   => 'Named route',
    'absolute_url'  => 'Absolute URL',
    'permission'    => 'Permission',
    'module_flag'   => 'Module flag',
    'sort_order'    => 'Sort order',
    'active'        => 'Active?',
    'apply'         => 'Apply',
    'add_menu'      => 'Add Menu',
    'inactive' => 'Inactive',
    'flush_cache'   => 'Flush Cache',
    'reset_menu'  => 'Reset',
    'custom_menu' => 'Custom Sidebar Menu',
    
'rebuilt_successfully' => 'Rebuilt Successfully',

    'sidebar_layout'        => 'Sidebar Layout',
    'sidebar_layout_1'      => 'Layout 1 (Classic)',
    'sidebar_layout_2'      => 'Layout 2 (Compact)',
    'sidebar_layout_custom' => 'Custom Layout',

    'custom_sidebar_type'   => 'Custom Sidebar Type',
    'sidebar'               => 'Sidebar',
    'topbar'                => 'Topbar',
       'tab_business_settings'      => 'Business Settings',
    'business_settings_layout'   => 'Business Settings Layout',
    'layout_1'                   => 'Layout 1 – Classic Tabs',
    'layout_2'                   => 'Layout 2 – Modern Sidebar',

    //Themes:
    'predefined_theme_label'    => 'Predefined Theme',
    'predefined_theme_tooltip'  => 'Pick a ready-made color palette.',
    'select_theme'              => 'Select a theme',

    'theme_default'             => 'Default',


    //Migration Data
    'app_settings' => 'App Settings',
    'application_settings' => 'Application Settings',
    'storage_migration' => 'Storage Migration',
    'manage_uploads_data' => 'Manage your uploads data',

    'push' => 'push',
    'pull' => 'pull',
    'local' => 'local',
    'external_disk' => 'external disk',
    'duplicate_files_skipped_safe_to_resume' => 'Duplicate files are skipped. You can safely re-run to resume.',

    'direction' => 'Direction',
    'push_local_to_external' => 'push (local → external)',
    'pull_external_to_local' => 'pull (external → local)',

    'from_disk' => 'From disk',
    'to_disk' => 'To disk',

    'destination_visibility' => 'Destination visibility',
    'visibility_none_bucket_signed' => '(none / bucket policy / signed URLs)',
    'visibility_public_acl' => 'public (object ACL)',
    'visibility_private_acl' => 'private (object ACL)',

    'folders_to_include_optional' => 'Folders to include (optional)',
    'folders_include_tooltip' => 'Leave empty to include all folders under the uploads root.',
    'select_all' => 'Select all',
    'none' => 'None',
    'invert' => 'Invert',
    'no_suggestions_found' => 'No suggestions found.',

    'delete_source_after_copy' => 'Delete source after successful copy (move)',
    'dry_run_plan_only' => 'Dry-run (plan only)',
    'verbose_log_messages' => 'Verbose (log messages in status)',

    'execution' => 'Execution',
    'execution_tooltip_html' => 'Use <strong>Direct</strong> only for small moves (e.g., < 1000 files). For 5-10 GB, prefer the background job.',
    'pick_how_to_execute' => 'Pick how to execute the migration task.',
    'background_job_recommended' => 'Background job (recommended)',
    'run_direct_now' => 'Direct (run now)',

    'start_migration' => 'Start migration',
    'reset' => 'Reset',

    'progress' => 'Progress',
    'result' => 'Result',
    // JS strings
    'from' => 'From',
    'to' => 'To',
    'folders' => 'Folders',
    'total' => 'Total',
    'copied' => 'Copied',
    'skipped' => 'Skipped',
    'deleted' => 'Deleted',
    'failed' => 'Failed',
    'invalid_response' => 'Invalid response',
    'failed_to_start_migration' => 'Failed to start migration',
    'confirm_delete_source' => 'Are you sure you want to DELETE source files after copying? This cannot be undone.',

     'default_storage_disk' => 'Default storage disk',
    'default_storage_disk_help' => 'Choose where new files are saved by default. "public" = storage/app/public via /storage symlink. "local" = public/uploads.',

    's3_compatible_settings' => 'S3-compatible settings',
    'display_label_optional' => 'Display label (optional)',
    'placeholder_my_s3_provider' => 'My S3 provider',
    'display_only_admin_ui' => 'Only for display in the admin UI.',
    'access_key' => 'Access Key',
    'secret_key' => 'Secret Key',
    'region' => 'Region',
    'bucket' => 'Bucket',
    'endpoint' => 'Endpoint',
    'cdn_or_custom_domain_optional' => 'CDN / Custom Domain (optional)',

    'disable_http_verify' => 'Disable HTTP Verify',
    'disable_http_verify_help' => 'Off = TLS verification enabled. On = TLS verification disabled (disable only in localhost for testing).',

    'path_style_endpoint' => 'Path-style endpoint',

    'use_signed_urls' => 'Use signed URLs (keep bucket private)',
    'use_signed_urls_help' => 'Off = public URLs (bucket/CDN must allow public read). On = private with signed URLs.',

    'signed_url_ttl_minutes' => 'Signed URL TTL (minutes)',
    'tab_storage_settings' => 'Storage',
    'syncing' => 'Syncing...',

    // POS Settings
    'pos_performance_settings' => 'POS Performance Settings',
    'enable_instant_pos' => 'Enable Instant POS',
    'enable_instant_pos_tooltip' => 'Enables instant product addition without AJAX calls for better performance',
    'enable_instant_pos_help' => 'When enabled, Product Added from Product suggestions works instantly without server requests',
    
    'enable_instant_search' => 'Enable Instant Search',
    'enable_instant_search_tooltip' => 'Enables instant product search using cached data instead of AJAX',
    'enable_instant_search_help' => 'When enabled, product barcode scan works instantly without server requests',
    
    'pos_performance_info_title' => 'Performance Enhancement',
    'pos_performance_info_desc' => 'Instant POS features significantly improve performance by reducing server requests:',
    'instant_pos_benefit_1' => 'Products are added instantly without waiting for server response',
    'instant_pos_benefit_2' => 'Search results appear immediately as you type',
    'instant_pos_benefit_3' => 'Stock levels are automatically updated after each sale',
    'instant_pos_benefit_4' => 'Fetches complete products data on page load',
    
    'pos_cache_settings' => 'POS Cache Settings',
    'pos_cache_refresh_interval' => 'Cache Refresh Interval',
    'pos_cache_refresh_interval_tooltip' => 'How often to refresh the product cache',
    'pos_cache_refresh_interval_help' => 'Auto refreshes after each sale, manual intervals for backup refresh',
    'auto_refresh' => 'Auto (After Sales)',
    '30_minutes' => '30 Minutes',
    '60_minutes' => '60 Minutes',
    '2_hours' => '2 Hours',
    'manual_only' => 'Manual Only',
    
    'pos_max_cached_products' => 'Max Cached Products',
    'pos_max_cached_products_tooltip' => 'Maximum number of products to cache for instant access',
    'pos_max_cached_products_help' => 'Higher numbers improve coverage but use more memory. Select "Unlimited" to cache all products.',
    'unlimited' => 'Unlimited',
    
    // Loading messages
    'loading_products' => 'Loading Products...',
    'please_wait_while_products_load' => 'Please wait while products load',
    'loading_products_placeholder' => 'Loading products...',
    'updating_stock' => 'Updating stock...',
    'failed_to_load_cache' => 'Failed to load product cache. POS functionality may be limited.',

    // OTP Verification
    'otp_verification' => 'OTP Verification',
    'otp_verification_management' => 'OTP Verification Management',
    'manage_otp_verification_requests' => 'Manage OTP verification requests and view statistics',
    'active_otps' => 'Active OTPs',
    'unverified_users' => 'Unverified Users',
    'expired_otps' => 'Expired OTPs',
    'failed_attempts' => 'Failed Attempts',
    'pending_users' => 'Pending Users',
    'today_requests' => "Today's Requests",
    'high_retries' => 'High Retries',
    'user_info' => 'User Info',
    'otp_code' => 'OTP Code',
    'attempts' => 'Attempts',
    'resend_count' => 'Resend Count',
    'no_active_otp' => 'No Active OTP',
    'expired' => 'Expired',
    'active' => 'Active',
    'expires_in' => 'Expires in',
    'remaining' => 'remaining',
    'resends' => 'resends',
    'last' => 'Last',
    'updated' => 'Updated',
    'verify' => 'Verify',
    'manual_verify_email' => 'Manual Verify Email',
    'reset_otp' => 'Reset OTP',
    'manual_verify' => 'Manual Verify',
    'deactivate' => 'Deactivate',
    
    // JavaScript messages
    'confirm_reset_otp' => 'Are you sure you want to reset this OTP? The user will need to request a new one.',
    'failed_to_reset_otp' => 'Failed to reset OTP',
    'error_resetting_otp' => 'Error occurred while resetting OTP',
    'confirm_verify_unverified_user' => 'Are you sure you want to manually verify email for unverified user: :username?',
    'confirm_verify_user' => 'Are you sure you want to manually verify email for user: :username?',
    'user_verified_removed_from_list' => 'User email verified - user will no longer appear in unverified list',
    'failed_to_verify_user' => 'Failed to verify user',
    'error_verifying_user' => 'Error occurred while verifying user',
    'confirm_deactivate_token' => 'Are you sure you want to deactivate this OTP token?',
    'failed_to_deactivate_token' => 'Failed to deactivate token',
    'error_deactivating_token' => 'Error occurred while deactivating token',
    
    // Session Management
    'session_management' => 'Session Management',
    'manage_user_sessions_and_authentication' => 'Manage user sessions and authentication',
    'all_users' => 'All Users',
    'active_users' => 'Active Users',
    'locked_users' => 'Locked Users',
    'disabled_logins' => 'Disabled Logins',
    'active_sessions' => 'Active Sessions',
    'unique_users' => 'Unique Users',
    'active_businesses' => 'Active Businesses',
    'inactive_businesses' => 'Inactive Businesses',
    'user_info' => 'User Info',
    'session_info' => 'Session Info',
    'force_logout' => 'Force Logout',
    'lock_user' => 'Lock User',
    'unlock_user' => 'Unlock User',
    'lock_user_account' => 'Lock User Account',
    'lock_duration' => 'Lock Duration',
    'user_will_be_locked_for_selected_duration' => 'User will be locked for the selected duration',
    'minutes' => 'minutes',
    'hour' => 'hour',
    'hours' => 'hours',
    'deactivate_user' => 'Deactivate User',
    'activate_user' => 'Activate User',
    'block_login' => 'Block Login',
    'allow_login' => 'Allow Login',
    'deactivate_business' => 'Deactivate Business',
    'activate_business' => 'Activate Business',
    'login_allowed' => 'Login Allowed',
    'login_blocked' => 'Login Blocked',
    'temporary_lock' => 'Temporary Lock',
    'user_locked_successfully' => 'User locked for :duration minutes',
    'user_unlocked_successfully' => 'User unlocked successfully',
    'user_activated_successfully' => 'User activated successfully',
    'user_deactivated_successfully' => 'User deactivated successfully',
    'login_permission_granted' => 'Login permission granted',
    'login_permission_revoked' => 'Login permission revoked',
    'business_activated_successfully' => 'Business activated successfully',
    'business_deactivated_successfully' => 'Business deactivated successfully',
    'user_logged_out_successfully' => 'User logged out successfully',
    'failed_to_lock_user' => 'Failed to lock user',
    'failed_to_unlock_user' => 'Failed to unlock user',
    'failed_to_update_user_status' => 'Failed to update user status',
    'failed_to_update_login_permission' => 'Failed to update login permission',
    'failed_to_update_business_status' => 'Failed to update business status',
    'failed_to_logout_user' => 'Failed to logout user',
    'error_locking_user' => 'Error occurred while locking user',
    'error_unlocking_user' => 'Error occurred while unlocking user',
    'error_updating_user_status' => 'Error occurred while updating user status',
    'error_updating_login_permission' => 'Error occurred while updating login permission',
    'error_updating_business_status' => 'Error occurred while updating business status',
    'error_logging_out_user' => 'Error occurred while logging out user',
    'confirm_force_logout' => 'Are you sure you want to force logout user: :username?',
    'confirm_lock_user' => 'Are you sure you want to lock user: :username for :duration minutes?',
    'confirm_unlock_user' => 'Are you sure you want to unlock user: :username?',
    'confirm_toggle_user_status' => 'Are you sure you want to :action user: :username?',
    'confirm_toggle_login_permission' => 'Are you sure you want to :action for user: :username?',
    'confirm_toggle_business_status' => 'Are you sure you want to :action business: :business?',
    'activate' => 'activate',
    'deactivate' => 'deactivate',
    
    // Additional settings for new features
    'active_businesses' => 'Active Businesses',
    'inactive_businesses' => 'Inactive Businesses',
    'active_sessions' => 'Active Sessions',
    'sessions' => 'Sessions',
    'manage_user_sessions_and_authentication' => 'Manage user sessions and authentication',
    'custom_duration' => 'Custom Duration',
    'custom_duration_minutes' => 'Custom Duration (Minutes)',
    'enter_minutes' => 'Enter minutes',
    'enter_custom_duration_help' => 'Enter the number of minutes to lock the user (1-10080 minutes / 7 days max)',
    'please_enter_valid_duration' => 'Please enter a valid duration in minutes',
    'activate_business' => 'Activate Business',
    'deactivate_business' => 'Deactivate Business',
    'activate_user' => 'Activate User',
    'deactivate_user' => 'Deactivate User',
    
    // Instant POS Button Strings
    'refresh_pos_cache' => 'Refresh Cache',
    'instant_pos_enabled' => 'Instant POS Enabled',
    'instant_pos_disabled' => 'Instant POS Disabled',
    'disable_instant_pos' => 'Disable Instant POS',
    
    ];