<?php

return [

    'app_settings' => 'Cilësimet e Aplikacionit',
    'manage_app_settings' => 'Menaxho Cilësimet e Aplikacionit',
    'tab_2fa' => '2FA',
    'tab_theme' => 'Pamja',
    'tab_login_page' => 'Faqja e Hyrjes',
    'tab_sidebar' => 'Shiriti Anësor',
    'tab_language' => 'Gjuha',
    'tab_repair_status' => 'Statusi i Riparimit',
    'tab_logo' => 'Logo',
    // Buttons
    'update_settings' => 'Përditëso Cilësimet',

    'enable_custom_bg_image_for_login' => 'Aktivizo Sfondin e Personalizuar për Hyrje',
    'enable_custom_bg_image_for_login_tooltip' => 'Vendos një imazh sfondi të personalizuar për faqen e hyrjes.',

    'enable_custom_sidebar_logo' => 'Lejo Logo të Personalizuar në Shiriti Anësor',
    'enable_custom_sidebar_logo_tooltip' => 'Lejon bizneset të përdorin një logo të personalizuar në shiritin anësor.',

    // language.blade.php
    'header_language_change' => 'Ndërrimi i Gjuhës në Header',
    'header_language_change_tooltip' => 'Lejo përdoruesit të ndryshojnë gjuhën nga header-i kryesor.',
    'header_languages_label' => 'Gjuhët në Header',
    'header_languages_label_tooltip' => 'Zgjidh cilat gjuhë do të shfaqen në header.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'Shfaq Statusin e Riparimit në Ekranin e Hyrjes',

    // 2fa.blade.php
    'enable_2fa' => 'Aktivizo 2FA',
    'enable_2fa_tooltip' => 'Aktivizo Autentikimin me Dy Faktorë (2FA) për aplikacionin.',

    'force_2fa' => 'Detyro 2FA',
    'force_2fa_tooltip' => 'Përdoruesit duhet të konfigurojnë 2FA para se të përdorin aplikacionin.',

    'recommend_2fa' => 'Rekomando 2FA',
    'recommend_2fa_tooltip' => 'Një modal i vetëm do të shfaqet gjatë hyrjes për të inkurajuar përdoruesit të aktivizojnë 2FA.',

    'allow_disable_2fa' => 'Lejo Çaktivizimin e Përkohshëm të 2FA',
    'allow_disable_2fa_tooltip' => 'Lejon përdoruesit të çaktivizojnë përkohësisht 2FA deri në një kohë të caktuar.',

    'disable_2fa_duration_label' => 'Kohëzgjatja e Çaktivizimit të 2FA',
    'disable_2fa_duration_label_tooltip' => 'Përcakto periudhën në të cilën 2FA mund të mbetet i çaktivizuar.',

    'disable_2fa_unit_label' => 'Njesia e Çaktivizimit të 2FA',

    'force_2fa_after_date_label' => 'Detyro 2FA pas Datës',
    'force_2fa_after_date_label_tooltip' => 'Pas kësaj date, të gjithë përdoruesit duhet të aktivizojnë 2FA. Kjo datë gjithashtu shfaqet në modalin e rekomandimit të 2FA.',

    'primary_color_label' => 'Ngjyra Primare',
    'primary_color_label_tooltip' => 'Zgjidh ngjyrën primare të paracaktuar për aplikacionin. Kjo ngjyrë do të përdoret nga bizneset që nuk vendosin tema të tyre.',
    'secondary_color_label' => 'Ngjyra Sekondare',
    'secondary_color_label_tooltip' => 'Zgjidh ngjyrën sekondare të paracaktuar për aplikacionin. Kjo ngjyrë do të përdoret nga bizneset që nuk vendosin tema të tyre.',

    'allow_theme_change' => 'Lejo Ndryshimin e Temave',
    'allow_theme_change_tooltip' => 'Lejon bizneset të personalizojnë ngjyrat e tyre të temës. Kur aktivohet, bizneset pa ngjyra të personalizuara do të përdorin ato parazgjedhura që vendosen këtu nga superadministratori.',

    'login_bg_image_label' => 'Imazhi i Sfondit për Hyrje',
    'login_bg_image_label_tooltip' => 'Ngarkimi i një imazhi të ri do të zëvendësojë sfondin ekzistues.',

    'logo_dark_tooltip'  => 'Ndrysho logon e errët (dark) të paracaktuar të aplikacionit, e përdorur në modalitetin e ndritshëm.',
    'logo_light_tooltip' => 'Ndrysho logon e ndritshme (light) të paracaktuar të aplikacionit, e përdorur në modalitetin e errët.',
    'favicon_tooltip' => 'Përmasat e rekomanduara: 32×32 px. Ky ikonë shfaqet në skedat e shfletuesit dhe faqeruajtëse (bookmarks).',
    'upload_favicon' => 'Ngarko Favicon',

    // Fonts
    'tab_fonts' => 'Shkrimet (Fontet)',
    'english_font'            => 'Shkrimi Anglisht',
    'arabic_font'             => 'Shkrimi Arabisht',
    'custom_font_placeholder' => 'Vendos një emër shkrimi të personalizuar...',
    'select_font'             => 'Zgjidh një shkrim...',
    'or'                      => 'ose',
    'font_help_text'          => 'Zgjidh nga lista ose vendos shkrimin tënd personal.',
    'english_font_tooltip'  => 'Vendos një emër shkrimi të personalizuar ose zgjidh një nga lista. Mund të gjesh emra shkrimesh në: :url',
    'arabic_font_tooltip'   => 'Vendos një emër shkrimi të personalizuar ose zgjidh një nga lista. Mund të gjesh emra shkrimesh në: :url',

    //Recaptcha:
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha'              => 'Aktivizo Google reCAPTCHA',
    'enable_recaptcha_tooltip'      => 'Ndrysho këtë parametër për të aktivizuar mbrojtjen reCAPTCHA. Merr çelësin e faqes dhe sekretn te: :url',
    'enable_recaptcha_text'         => 'Aktivizo reCAPTCHA',
    'google_recaptcha_key'          => 'Google reCAPTCHA Site Key',
    'google_recaptcha_secret'       => 'Google reCAPTCHA Secret Key',
    'google_recaptcha_key_placeholder'    => 'Vendos Google reCAPTCHA Site Key tuaj',
    'google_recaptcha_secret_placeholder' => 'Vendos Google reCAPTCHA Secret Key tuaj',

    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'Aktivizo Autentikimin me Dy Faktorë (2FA)',
    'modal_enable_2fa_desc' => 'Ne rekomandojmë aktivizimin e 2FA për të rritur sigurinë e llogarisë suaj.',
    'enable_now_button' => 'Aktivizo Tani',
    'maybe_later_button' => 'Ndoshta Më Vonë',
    'close_aria_label' => 'Mbyll',

    // 2FA Verify page
    'one_time_password_heading' => 'Fjalëkalim Një-Herësh (OTP)',
    'one_time_password_label' => 'Fjalëkalim Një-Herësh',
    'enter_2fa_code_placeholder' => 'Vendos kodin 2FA',
    'disable_2fa_for' => 'Çaktivizo 2FA për :duration :unit',
    'verify_button' => 'Verifiko',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'Autentikim me Dy Faktorë (2FA)',
    'google_auth_app_desc' => 'Aplikacioni Google Authenticator',
    'configured_status' => 'I konfiguruar',
    'needs_configuration_status' => 'Ka nevojë për konfigurim',
    'two_factor_scan_or_enter_msg' => 'Ju lutemi skanoni QR kodin më poshtë me aplikacionin Google Authenticator ose futni manualisht sekretin, pastaj vendosni kodin e gjeneruar.',
    'your_secret_key_msg' => 'Çelësi juaj sekret (nëse duhet ta futni manualisht):',

    // 2FA field labels
    'one_time_password_label' => 'Fjalëkalim Një-Herësh',
    'enter_2fa_code_placeholder' => 'Vendos kodin 2FA',
    '2fa_will_be_forced_after_date' => '2FA do të bëhet i detyrueshëm pas :date.',

    // Buttons
    '2fa' => '2FA',
    'verify_button' => 'Verifiko',

    'confirm_access_recovery_codes' => 'Konfirmo Aksessin',
    're_authenticate_message'       => 'Duhet të rivërtetoheni për të pasur akses te Cilësimet ose Kodet e Rikuperimit 2FA.',
    'choose_method'                 => 'Zgjidh metodën:',
    'one_time_password'             => 'Fjalëkalim Një-Herësh (OTP)',
    'password'                      => 'Fjalëkalimi',
    'enter_code_or_password'        => 'Fut Kodin / Fjalëkalimin:',
    'confirm'                       => 'Konfirmo',

    '2fa_recovery_codes'           => 'Kodet e Rikuperimit 2FA',
    'recovery_codes_description'   => 'Këto kode ju lejojnë të identifikoheni nëse humbisni aksesin në aplikacionin autentikues. Secili kod mund të përdoret vetëm një herë.',
    'regenerate_codes'             => 'Rigjenero Kodet',
    'copy'                         => 'Kopjo',
    'copy_all'                     => 'Kopjo Të Gjitha',
    'no_recovery_codes_available'  => 'Nuk ka kode rikuperimi në dispozicion. Mund të gjeneroni kodet e reja më poshtë.',
    'copied'                       => 'Kodi u kopjua në clipboard!',
    'all_codes_copied'             => 'Të gjitha kodet e rikuperimit u kopjuan në clipboard!',
    'supported_app'                => 'Aplikacione të Mbështetura',
    'supported_apps' => [
        'Authy' => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP' => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator' => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator' => ['Windows Phone'],
        'LastPass Authenticator' => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password' => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    //social logins:
    'social_login_settings'       => 'Cilësimet e Login Social',
    'social_login_settings_help'  => 'Vendos kredencialet e tua për login social.',
    'client_id'                   => 'ID e Klientit (Client ID)',
    'client_secret'               => 'Sekreti i Klientit (Client Secret)',
    'redirect_url'                => 'URL e Ridrejtimit (Redirect URL)',
    'enter_client_id'             => 'Vendos :provider Client ID',
    'enter_client_secret'         => 'Vendos :provider Client Secret',
    'enter_redirect_url'          => 'Vendos :provider Redirect URL',
    'enable_social_login' => 'Aktivizo Login Social',
    'tab_social' => 'Logine Sociale',
    'or_login_with' => 'Ose Hyr me',
    'force_otp_after_social_login' => 'Detyro OTP pas Login Social',
    'force_otp_after_social_login_tooltip' => 'Nëse aktivizohet, përdoruesit që hyjnë përmes rrjeteve sociale do të duhet të verifikojnë një OTP.',

    //Lock Users:
    'locked_until' => 'Bllokuar deri më',
    'locked_users' => 'Përdorues të Bllokuar',
    'view_locked_users' => 'Shiko Përdoruesit e Bllokuar',
    'tab_login_security' => 'Siguria e Hyrjes',
    'unlock' => 'Zhblloko',
    'enable_user_lock_label' => 'Aktivizo Bllokimin e Përdoruesve',
    'enable_user_lock_tooltip' => 'Aktivizo/çaktivizo bllokimin e përdoruesit pas dështimeve të shumta të hyrjes.',
    'max_login_attempts_label' => 'Numri Maksimal i Përpjekjeve të Hyrjes',
    'max_login_attempts_tooltip' => 'Numri i përpjekjeve të lejuara para se përdoruesi të bllokohet.',
    'lock_duration_label' => 'Kohëzgjatja e Bllokimit',
    'lock_duration_tooltip' => 'Kohëzgjatja (si numra) për të cilën përdoruesi mbetet i bllokuar.',
    'lock_duration_unit_label' => 'Njesia e Kohëzgjatjes së Bllokimit',
    'lock_duration_unit_tooltip' => 'Zgjidh njësinë kohore për kohëzgjatjen e bllokimit: minuta, orë, ditë, etj.',
    'account_locked_for_time_unit' => 'Llogaria juaj është bllokuar për :time :unit.',
    'user_unlocked_message' => 'Përdoruesi u zhbllokua me sukses!',

    //Verify email:
    'verify_email_address_title' => 'Verifiko Adresën e Email-it',
    'fresh_verification_sent' => 'Një link i ri verifikimi u dërgua në adresën tuaj të email-it.',
    'verify_email_before_proceeding' => 'Para se të vazhdoni, ju lutemi kontrolloni email-in tuaj për linkun e verifikimit.',
    'did_not_receive_email' => 'Nëse nuk e keni marrë email-in',
    'click_here_request_another' => 'klikoni këtu për të kërkuar një tjetër',
    'logout' => 'Dil',
    'force_email_verify' => 'Detyro Verifikimin e Email-it',
    'force_email_verify_tooltip' => 'Nëse aktivizohet, përdoruesit duhet të verifikojnë adresën e email-it përpara aksesit në sistem.',

        // Reset Mapping
        'reset_purchase_sell_mapping'    => 'Rivendos hartimin Blerje-Shitje',
        'select_business'                => 'Zgjidhni biznesin:',
        'all_businesses'                 => 'Të gjitha bizneset',
        'chunk_size'                     => 'Madhësia e grupit:',
        'reset_mapping'                  => 'Rivendos hartimin',
        'purchase_sell_mismatch_tooltip' => 'Zgjidhni hartimet e biznesit që duhen rivendosur. Nëse keni një bazë të dhënash të madhe, rekomandojmë rivendosje për secilin biznes veçmas.',
        'chunk_size_tooltip'             => 'Hartimi do të rivendoset në grupe më të vogla. Për dataset-e të mëdha, zgjidhni madhësinë e duhur të grupit. Rekomandohet të aktivizoni modalitetin e mirëmbajtjes.',
    
        // Maintenance Mode
        'tab_maintenance_mode'       => 'Modaliteti i mirëmbajtjes',
        'maintenance_mode'           => 'Modaliteti i mirëmbajtjes',
        'maintenance_mode_tooltip'   => 'Vendosni aplikacionin në modalitet mirëmbajtjeje (vizitorët do të shohin ekranin e mirëmbajtjes).',
        'enable_countdown'           => 'Aktivizo kohëmatësin e zbritjes',
        'enable_timer_tooltip'       => 'Shfaqni një kohëmatës në kohë reale deri në fund të mirëmbajtjes.',
        'maintenance_duration'       => 'Kohëzgjatja',
        'maintenance_unit'           => 'Njësia e kohëzgjatjes',
        'minutes'                    => 'Minuta',
        'hours'                      => 'Orë',
        'days'                       => 'Ditë',
    
        // Maintenance page
        'under_maintenance'          => 'Nën mirëmbajtje',
        'maintenance_heading'        => 'Po bëjmë disa punë mirëmbajtjeje.',
        'maintenance_subheading'     => 'Faleminderit për durimin tuaj!',
        'maintenance_back_in'        => 'Do të kthehemi pas :time',
        'maintenance_back_no_timer'  => 'Do të kthehemi sapo të përfundojë mirëmbajtja.',
    
        // Mapping reset page
        'mapping_reset_progress'     => 'Progresi i rivendosjes së hartimit',
        'mapping_reset_in_progress'  => 'Rivendosja e hartimit po vazhdon',
        'batch_status'               => 'Statusi i grupit',
        'refresh_status'             => 'Rifresko statusin',
    
        // Mapping reset result & status
        'mapping_reset_result'       => 'Rezultati i rivendosjes së hartimit',
        'chunk_processing_status'    => 'Statusi i përpunimit të grupeve',
    
        // Table headers
        'business'                   => 'Biznes',
        'chunk_status'               => 'Statusi i grupit',
        'total_chunks'               => 'Numri total i grupeve',
        'status'                     => 'Statusi',
    
        // Button
        'go_back'                    => 'Kthehu',
    
        // Mapping Jobs
        'processed_jobs'             => 'Detyrat e hartimit',
        'processed_jobs_subtitle'    => 'Të gjitha grupet e hartimit të dërguara',
        'uuid'                       => 'UUID i grupit',
        'job_name'                   => 'Emri i detyrës',
        'completed_chunks'           => 'Grupet e përfunduara',
        'started_at'                 => 'Filluar më',
        'finished_at'                => 'Përditësimi i fundit',
        'view_rebuild_jobs'          => 'Shiko detyrat e rindërtimit të stokut',
    
        // Detailed instruction
        'reset_mapping_instruction'  => "Rekomandohet të konfiguroni driver-in e radhës në një backend real:\n"
            . "→ Në skedarin .env, vendosni `QUEUE_CONNECTION=database`.\n\n"
            . "Gjithashtu aktivizoni modalitetin e mirëmbajtjes (Cilësimet e aplikacionit → Modaliteti i mirëmbajtjes) gjatë rivendosjes së hartimit për të shmangur të dhëna të dyfishta ose të humbura.\n\n"
            . "Nëse baza e të dhënave është e madhe, rivendosja do të zgjasë më gjatë—mendoni ta bëni për secilin biznes veçmas.\n\n"
            . "Para se të filloni:\n"
            . "• Bëni një backup të plotë të bazës së të dhënave.\n"
            . "• Monitoroni procesin përmes log-eve për të kapur gabimet.",
    
        'recovery_codes_generated_successfully' => 'Kodet e rikuperimit u krijuan me sukses',
    
        // Disposable-email sync
        'sync_disposable_list'       => 'Sinkronizo listën e email-eve të përkohshëm',
        'sync_disposable_success'    => 'Lista e email-eve të përkohshëm u përditësua.',
        'sync_disposable_failed'     => 'Dështoi sinkronizimi i listës së email-eve të përkohshëm.',
    
        // Temporary-email protection
        'temp_email_protection'          => 'Parandaloni adresat e përkohshëm të email-it',
        'temp_email_protection_tooltip'  => 'Bllokoni domenet e email-eve të përkohshëm (p.sh. Mailinator, 10MinuteMail).',
        'disposable_not_allowed'         => 'Adresat e përkohshëm të email-it nuk lejohen.',

       // 3.3
    'enable_sidebar_dropdown'         => 'Aktivo menunë rënëse në shiritin anësor',
    'enable_sidebar_dropdown_tooltip' => 'Palos nënnenu-t në një menu rënëse të klikueshme brenda shiritit anësor.',
    // Custom Menu
    'menu'               => 'Menu',
    'menus_heading'      => 'Menutë',
    'menus_description'  => 'Menaxho dhe organizo elementët e menysë.',
    'add_menu_item'      => 'Shto element menuje',
    'save_menu'          => 'Ruaj menunë',
    'label'              => 'Etiketë',
    'parent'             => 'Prind',
    'icon_type'          => 'Lloji i ikonës',
    'svg'                => 'SVG',
    'fontawesome'        => 'FontAwesome',
    'svg_icon'           => 'Ikonë SVG',
    'fa_class'           => 'Klasë FA',
    'named_route'        => 'Rrugë e emërtuar',
    'absolute_url'       => 'URL absolute',
    'permission'         => 'Leje',
    'module_flag'        => 'Flamur moduli',
    'sort_order'         => 'Renditje',
    'active'             => 'Aktive?',
    'apply'              => 'Zbato',
    'add_menu'           => 'Shto menu',
    'inactive'           => 'Joaktive',
    'flush_cache'        => 'Pastro cache-n',
    'reset_menu'         => 'Rivendos',
    'custom_menu'        => 'Menu anësore e personalizuar',

    'rebuilt_successfully' => 'Rindërtuar me sukses',

    'sidebar_layout'        => 'Pamja e shiritit anësor',
    'sidebar_layout_1'      => 'Pamja 1 (Klasike)',
    'sidebar_layout_2'      => 'Pamja 2 (Kompakte)',
    'sidebar_layout_custom' => 'Pamje e personalizuar',

    'custom_sidebar_type'   => 'Lloji i shiritit anësor',
    'sidebar'               => 'Shirit anësor',
    'topbar'                => 'Shirit sipëror',

    'tab_business_settings'    => 'Cilësimet e biznesit',
    'business_settings_layout' => 'Pamja e cilësimeve',
    'layout_1'                => 'Pamja 1 – Skeda klasike',
    'layout_2'                => 'Pamja 2 – Shirit modern',

    // Themes
    'predefined_theme_label'   => 'Temë e paracaktuar',
    'predefined_theme_tooltip' => 'Zgjidh një paletë ngjyrash të gatshme.',
    'select_theme'             => 'Zgjidh temë',
    'theme_default'            => 'Parazgjedhje',

    // Migration Data
    'app_settings'         => 'Cilësimet e aplikacionit',
    'application_settings' => 'Konfigurimi i aplikacionit',
    'storage_migration'    => 'Migrimi i ruajtjes',
    'manage_uploads_data'  => 'Menaxho të dhënat e ngarkimeve',

    'push'  => 'push',
    'pull'  => 'pull',
    'local' => 'lokale',
    'external_disk' => 'disk i jashtëm',
    'duplicate_files_skipped_safe_to_resume' =>
        'Skedarët e dyfishuar u kapërcyen. Mund të rifilloni pa problem.',

    'direction'              => 'Drejtim',
    'push_local_to_external' => 'push (lokale → jashtë)',
    'pull_external_to_local' => 'pull (jashtë → lokale)',

    'from_disk' => 'Nga disku',
    'to_disk'   => 'Në disk',

    'destination_visibility'        => 'Shikueshmëria e destinacionit',
    'visibility_none_bucket_signed' => '(asnjë / rregullore bucket / URL të nënshkruara)',
    'visibility_public_acl'         => 'publike (ACL objekti)',
    'visibility_private_acl'        => 'private (ACL objekti)',

    'folders_to_include_optional' => 'Dosjet për t’u përfshirë (opsionale)',
    'folders_include_tooltip'     => 'Lëreni bosh për të përfshirë të gjitha dosjet nën uploads.',
    'select_all'                  => 'Përzgjidh të gjitha',
    'none'                        => 'Asnjë',
    'invert'                      => 'Përmbys',
    'no_suggestions_found'        => 'Nuk u gjetën sugjerime.',

    'delete_source_after_copy' => 'Fshi burimin pas kopjimit (lëvizje)',
    'dry_run_plan_only'        => 'Prove (vetëm plan)',
    'verbose_log_messages'     => 'Detajuar (mesazhe log)',

    'execution'                    => 'Ekzekutim',
    'execution_tooltip_html'       =>
        'Përdor <strong>Direkt</strong> vetëm për lëvizje të vogla (< 1000 file). ' .
        'Për 5–10 GB përdor detyrë në sfond.',
    'pick_how_to_execute'          => 'Zgjidh si do të ekzekutohet migrimi.',
    'background_job_recommended'   => 'Detyrë në sfond (e rekomanduar)',
    'run_direct_now'               => 'Direkt (ekzekuto tani)',

    'start_migration' => 'Fillo migrimin',
    'reset'           => 'Rivendos',

    'progress' => 'Progres',
    'result'   => 'Rezultat',

    // JS strings
    'from'                    => 'Nga',
    'to'                      => 'Në',
    'folders'                 => 'Dosje',
    'total'                   => 'Totali',
    'copied'                  => 'Kopjuar',
    'skipped'                 => 'Kapërcyer',
    'deleted'                 => 'Fshirë',
    'failed'                  => 'Dështuar',
    'invalid_response'        => 'Përgjigje e pavlefshme',
    'failed_to_start_migration'=> 'Nuk u nis migrimi',
    'confirm_delete_source'   =>
        'Je i sigurt që do të FSHISH skedarët e burimit pas kopjimit? ' .
        'Ky veprim është i pakthyeshëm.',

    'default_storage_disk'      => 'Disku i parazgjedhur i ruajtjes',
    'default_storage_disk_help' =>
        '"public" = storage/app/public përmes symlink /storage; "local" = public/uploads.',

    's3_compatible_settings'     => 'Cilësimet e pajtueshme S3',
    'display_label_optional'     => 'Etiketë shfaqjeje (opsionale)',
    'placeholder_my_s3_provider' => 'Ofruesi im S3',
    'display_only_admin_ui'      => 'Vetëm për shfaqje në panelin admin.',
    'access_key'                 => 'Access Key',
    'secret_key'                 => 'Secret Key',
    'region'                     => 'Rajon',
    'bucket'                     => 'Bucket',
    'endpoint'                   => 'Endpoint',
    'cdn_or_custom_domain_optional' => 'CDN / Domen i personalizuar (opsionale)',

    'disable_http_verify'      => 'Çaktivizo verifikimin TLS',
    'disable_http_verify_help' =>
        'Off = verifikim TLS aktiv. On = çaktivizuar (vetëm lokalisht).',

    'path_style_endpoint' => 'Endpoint stil “path”',

    'use_signed_urls'      => 'Përdor URL të nënshkruara (bucket privat)',
    'use_signed_urls_help' =>
        'Off = URL publike. On = private me URL të nënshkruara.',

    'signed_url_ttl_minutes' => 'TTL e URL-ve të nënshkruara (min)',
    'tab_storage_settings'   => 'Ruajtje',
    'syncing'               => 'Sinkronizim…',

    // POS Settings
    'pos_performance_settings'   => 'Cilësimet e performancës POS',
    'enable_instant_pos'         => 'Aktivo POS instant',
    'enable_instant_pos_tooltip' => 'Shton produktet menjëherë pa thirrje AJAX, për performancë më të mirë',
    'enable_instant_pos_help'    =>
        'Kur është aktiv, produktet shtohen nga cache-i, jo nga serveri.',

    'enable_instant_search'            => 'Aktivo kërkimin instant',
    'enable_instant_search_tooltip'    => 'Kërkim nga cache pa AJAX',
    'enable_instant_search_help'       =>
        'Kur aktivizohet, kërkimi jep rezultate menjëherë.',

    'pos_performance_info_title' => 'Përmirësim performance',
    'pos_performance_info_desc'  => 'POS instant redukton thirrjet në server dhe përshpejton punën:',
    'instant_pos_benefit_1'      => 'Produktet shtohen pa pritje',
    'instant_pos_benefit_2'      => 'Rezultatet e kërkimit shfaqen menjëherë',
    'instant_pos_benefit_3'      => 'Stoku përditësohet automatikisht pas çdo shitjeje',
    'instant_pos_benefit_4'      => 'Punon offline-first dhe sinkronizohet më pas',

    'pos_cache_settings'                    => 'Cilësimet e cache-it POS',
    'pos_cache_refresh_interval'            => 'Intervali i rifreskimit të cache-it',
    'pos_cache_refresh_interval_tooltip'    => 'Sa shpesh rifreskohet cache-i i produkteve',
    'pos_cache_refresh_interval_help'       =>
        'Rifreskohet automatikisht pas çdo shitjeje; mund të vendosësh intervale manuale.',
    'auto_refresh'                          => 'Auto (pas shitjes)',
    '30_minutes'                            => '30 minuta',
    '60_minutes'                            => '60 minuta',
    '2_hours'                               => '2 orë',
    'manual_only'                           => 'Vetëm manual',

    'pos_max_cached_products'         => 'Nr. maks. i produkteve në cache',
    'pos_max_cached_products_tooltip' => 'Limiti i produkteve të ruajtura në cache',
    'pos_max_cached_products_help'    =>
        'Numër më i lartë = mbulim më i mirë por përdor më shumë memorie. ' .
        'Zgjidh “Pa kufi” për t’i ruajtur të gjitha.',
    'unlimited'                       => 'Pa kufi',

    // Loading messages
    'loading_products'                => 'Po ngarkohen produktet…',
    'please_wait_while_products_load' => 'Ju lutemi prisni, po ngarkohen produktet',
    'loading_products_placeholder'    => 'Ngarkim produktesh…',
    'updating_stock'                  => 'Përditësim stoku…',
    'failed_to_load_cache'            => 'Cache-i i produkteve nuk u ngarkua. ' .
                                         'Funksionet POS mund të jenë të kufizuara.',

    // OTP Verification
    'otp_verification' => 'Verifikimi OTP',
    'otp_verification_management' => 'Menaxhimi i Verifikimit OTP',
    'manage_otp_verification_requests' => 'Menaxho kërkesat e verifikimit OTP dhe shiko statistikat',
    'active_otps' => 'OTP-të Aktive',
    'unverified_users' => 'Përdorues të Paverifikuar',
    'expired_otps' => 'OTP-të e Skaduara',
    'failed_attempts' => 'Përpjekje të Dështuara',
    'pending_users' => 'Përdorues në Pritje',
    'today_requests' => 'Kërkesat e Sotme',
    'high_retries' => 'Riprovojë të Shpeshta',
    'user_info' => 'Informacioni i Përdoruesit',
    'otp_code' => 'Kodi OTP',
    'attempts' => 'Përpjekje',
    'resend_count' => 'Numri i Ridërgimeve',
    'no_active_otp' => 'Nuk Ka OTP Aktive',
    'expired' => 'Skaduar',
    'active' => 'Aktiv',
    'expires_in' => 'Skadon në',
    'remaining' => 'të mbetura',
    'resends' => 'ridërgime',
    'last' => 'Fundit',
    'updated' => 'Përditësuar',
    'verify' => 'Verifiko',
    'manual_verify_email' => 'Verifikim Manual Email',
    'reset_otp' => 'Rivendos OTP',
    'manual_verify' => 'Verifikim Manual',
    'deactivate' => 'Deaktivizo',
    
    // JavaScript messages
    'confirm_reset_otp' => 'A jeni i sigurt që doni të rivendosni këtë OTP? Përdoruesi do të duhet të kërkojë një të ri.',
    'failed_to_reset_otp' => 'Rivendosja e OTP dështoi',
    'error_resetting_otp' => 'Ndodhi një gabim gjatë rivendosjes së OTP',
    'confirm_verify_unverified_user' => 'A jeni i sigurt që doni të verifikoni manualisht email-in për përdoruesin e paverifikuar: :username?',
    'confirm_verify_user' => 'A jeni i sigurt që doni të verifikoni manualisht email-in për përdoruesin: :username?',
    'user_verified_removed_from_list' => 'Email-i i përdoruesit u verifikua - përdoruesi nuk do të shfaqet më në listën e paverifikuarve',
    'failed_to_verify_user' => 'Verifikimi i përdoruesit dështoi',
    'error_verifying_user' => 'Ndodhi një gabim gjatë verifikimit të përdoruesit',
    'confirm_deactivate_token' => 'A jeni i sigurt që doni të deaktivizoni këtë token OTP?',
    'failed_to_deactivate_token' => 'Deaktivizimi i token-it dështoi',
    'error_deactivating_token' => 'Ndodhi një gabim gjatë deaktivizimit të token-it',

    // Session Management
    'session_management' => 'Menaxhimi i Sesioneve',
    'manage_user_sessions' => 'Menaxho sesionet e përdoruesve dhe sigurinë',
    'total_sessions' => 'Sesionet Totale',
    'active_users' => 'Përdorues Aktivë',
    'file_sessions' => 'Sesionet e Skedarëve',
    'database_sessions' => 'Sesionet e Bazës së të Dhënave',
    'session_actions' => 'Veprimet',
    'user_name' => 'Emri i Përdoruesit',
    'device_info' => 'Informacioni i Pajisjes',
    'ip_address' => 'Adresa IP',
    'last_activity' => 'Aktiviteti i Fundit',
    'session_id' => 'ID e Sesionit',
    'force_logout' => 'Detyro Dalje',
    'view_session_details' => 'Shiko Detajet e Sesionit',
    'invalidate_all_sessions' => 'Anulo Të Gjitha Sesionet',
    'filter_by_user' => 'Filtro sipas Përdoruesit',
    'filter_by_session_type' => 'Filtro sipas Llojit të Sesionit',
    'all_session_types' => 'Të Gjitha Llojet e Sesioneve',
    'confirm_force_logout' => 'A je i sigurt që dëshiron të detyrosh daljen e këtij sesioni? Përdoruesi do të duhet të hyjë përsëri.',
    'confirm_invalidate_all' => 'A je i sigurt që dëshiron të anullosh të gjitha sesionet e këtij përdoruesi? Të gjitha sesionet aktive do të mbyllen.',
    'session_invalidated' => 'Sesioni u anullua me sukses',
    'all_sessions_invalidated' => 'Të gjitha sesionet e përdoruesit u anulluan me sukses',
    'session_details' => 'Detajet e Sesionit',
    'session_data' => 'Të Dhënat e Sesionit',
    'user_agent' => 'Agjenti i Përdoruesit',
    'session_payload' => 'Ngarkesa e Sesionit',
    'created_at' => 'Krijuar më',
    'updated_at' => 'Përditësuar më',
    'expires_at' => 'Skadon më',
    'session_driver' => 'Drejtori i Sesionit',
    'unknown_device' => 'Pajisje e Panjohur',
    'unknown_browser' => 'Shfletues i Panjohur',
    'unknown_platform' => 'Platformë e Panjohur',
    'desktop' => 'Desktop',
    'mobile' => 'Mobil',
    'tablet' => 'Tablet',
    'current_session' => 'Sesioni Aktual',
    'other_sessions' => 'Sesione të Tjera',
    'session_location' => 'Vendndodhja e Sesionit',
    'refresh_sessions' => 'Rifresko Sesionet',
    'auto_refresh' => 'Rifreskim Automatik',
    'manual_refresh' => 'Rifreskim Manual',
    'bulk_actions' => 'Veprime Masive',
    'select_all_sessions' => 'Zgjidh Të Gjitha Sesionet',
    'logout_selected' => 'Dil të Zgjedhurit',
    'export_sessions' => 'Eksporto Sesionet',
    'session_statistics' => 'Statistikat e Sesioneve',
    'concurrent_sessions' => 'Sesione Njëkohësisht',
    'average_session_duration' => 'Kohëzgjatja Mesatare e Sesionit',
    'peak_concurrent_users' => 'Kulmi i Përdoruesve Njëkohësisht',
    'session_security' => 'Siguria e Sesioneve',
    'suspicious_activity' => 'Aktivitet i Dyshimtë',
    'multiple_ip_sessions' => 'Sesione me IP të Shumëfishta',
    'session_timeout' => 'Koha e Skadimit të Sesionit',
    'force_single_session' => 'Detyro Sesion të Vetëm',
    'session_encryption' => 'Enkriptimi i Sesionit',
    'secure_session_only' => 'Vetëm Sesione të Sigurta',

    // Instant POS Button Strings
    'refresh_pos_cache' => 'Rifresko Cache',
    'instant_pos_enabled' => 'POS i Menjëhershëm Aktivizuar',
    'instant_pos_disabled' => 'POS i Menjëhershëm Çaktivizuar',
    'disable_instant_pos' => 'Ç\'aktivizo POS të Menjëhershme',
];
