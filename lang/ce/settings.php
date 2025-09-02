<?php

return [
    'app_settings' => 'Nastavení aplikace',
    'manage_app_settings' => 'Správa nastavení aplikace',
    'tab_2fa' => '2FA',
    'tab_theme' => 'Vzhled',
    'tab_login_page' => 'Přihlašovací stránka',
    'tab_sidebar' => 'Postranní panel',
    'tab_language' => 'Jazyk',
    'tab_repair_status' => 'Stav servisu',
    'tab_logo' => 'Logo',
    // Buttons
    'update_settings' => 'Aktualizovat nastavení',

    'enable_custom_bg_image_for_login' => 'Povolit vlastní pozadí pro přihlášení',
    'enable_custom_bg_image_for_login_tooltip' => 'Nastavení vlastního obrázku pozadí pro přihlašovací stránku.',

    'enable_custom_sidebar_logo' => 'Povolit vlastní logo v postranním panelu',
    'enable_custom_sidebar_logo_tooltip' => 'Umožnit firmám používat vlastní logo v postranním panelu.',

    // language.blade.php
    'header_language_change' => 'Změna jazyka v záhlaví',
    'header_language_change_tooltip' => 'Umožnit uživatelům přepínat jazyk v hlavním záhlaví.',
    'header_languages_label' => 'Jazyky v záhlaví',
    'header_languages_label_tooltip' => 'Vyberte, které jazyky se mají zobrazit v záhlaví.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'Zobrazit stav servisu na přihlašovací obrazovce',

    // 2fa.blade.php
    'enable_2fa' => 'Povolit 2FA',
    'enable_2fa_tooltip' => 'Aktivovat dvoufaktorové ověřování (2FA) pro aplikaci.',

    'force_2fa' => 'Vynutit 2FA',
    'force_2fa_tooltip' => 'Uživatelé musí nastavit 2FA před použitím aplikace.',

    'recommend_2fa' => 'Doporučit 2FA',
    'recommend_2fa_tooltip' => 'Při přihlášení se jednorázově zobrazí okno, které uživatele vyzve k aktivaci 2FA.',

    'allow_disable_2fa' => 'Povolit dočasné vypnutí 2FA',
    'allow_disable_2fa_tooltip' => 'Umožnit uživatelům dočasné vypnutí 2FA po stanovenou dobu.',

    'disable_2fa_duration_label' => 'Doba vypnutí 2FA',
    'disable_2fa_duration_label_tooltip' => 'Stanovte období, po které může být 2FA vypnuto.',

    'disable_2fa_unit_label' => 'Jednotka doby vypnutí 2FA',

    'force_2fa_after_date_label' => 'Vynutit 2FA po datu',
    'force_2fa_after_date_label_tooltip' => 'Po tomto datu budou muset všichni uživatelé aktivovat 2FA. Toto datum se zobrazí i v okně doporučení k 2FA.',

    'primary_color_label' => 'Primární barva',
    'primary_color_label_tooltip' => 'Vyberte výchozí primární barvu aplikace. Bude použita u firem, které si nenastaví vlastní motiv.',
    'secondary_color_label' => 'Sekundární barva',
    'secondary_color_label_tooltip' => 'Vyberte výchozí sekundární barvu aplikace. Bude použita u firem, které si nenastaví vlastní motiv.',

    'allow_theme_change' => 'Povolit změnu motivu',
    'allow_theme_change_tooltip' => 'Umožnit firmám přizpůsobit si vlastní barvy motivu. Pokud firma nemá vlastní barvy, použijí se zde nastavené výchozí.',

    'login_bg_image_label' => 'Obrázek pozadí přihlášení',
    'login_bg_image_label_tooltip' => 'Nahráním nového obrázku se nahradí stávající pozadí.',

    'logo_dark_tooltip' => 'Změna výchozího tmavého loga aplikace, bude použito v režimu světlého pozadí.',
    'logo_light_tooltip' => 'Změna výchozího světlého loga aplikace, bude použito v tmavém režimu.',
    'favicon_tooltip' => 'Doporučené rozměry: 32×32 px. Tato ikona se zobrazuje na kartách prohlížeče a v záložkách.',
    'upload_favicon' => 'Nahrát favicon',

    // Fonts
    'tab_fonts' => 'Písma',
    'english_font' => 'Anglické písmo',
    'arabic_font' => 'Arabské písmo',
    'custom_font_placeholder' => 'Zadejte název vlastního písma...',
    'select_font' => 'Vyberte písmo...',
    'or' => 'nebo',
    'font_help_text' => 'Vyberte ze seznamu nebo zadejte své vlastní písmo.',
    'english_font_tooltip' => 'Zadejte vlastní název písma nebo vyberte ze seznamu. Názvy písem najdete na :url',
    'arabic_font_tooltip' => 'Zadejte vlastní název písma nebo vyberte ze seznamu. Názvy písem najdete na :url',

    //Recaptcha:
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha' => 'Povolit Google reCAPTCHA',
    'enable_recaptcha_tooltip' => 'Přepnout pro zapnutí ochrany reCAPTCHA. Získejte klíč a tajný kód na :url',
    'enable_recaptcha_text' => 'Povolit reCAPTCHA',
    'google_recaptcha_key' => 'Klíč pro Google reCAPTCHA (Site Key)',
    'google_recaptcha_secret' => 'Tajný klíč pro Google reCAPTCHA (Secret Key)',
    'google_recaptcha_key_placeholder' => 'Zadejte svůj Google reCAPTCHA Site klíč',
    'google_recaptcha_secret_placeholder' => 'Zadejte svůj Google reCAPTCHA Secret klíč',

    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'Aktivujte dvoufaktorové ověřování',
    'modal_enable_2fa_desc' => 'Doporučujeme povolit 2FA pro zvýšení bezpečnosti vašeho účtu.',
    'enable_now_button' => 'Povolit nyní',
    'maybe_later_button' => 'Možná později',
    'close_aria_label' => 'Zavřít',

    // 2FA Verify page
    'one_time_password_heading' => 'Jednorázové heslo',
    'one_time_password_label' => 'Jednorázové heslo',
    'enter_2fa_code_placeholder' => 'Zadejte 2FA kód',
    'disable_2fa_for' => 'Vypnout 2FA na :duration :unit',
    'verify_button' => 'Ověřit',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'Dvoufaktorové ověřování (2FA)',
    'google_auth_app_desc' => 'aplikace Google Authenticator',
    'configured_status' => 'Nastaveno',
    'needs_configuration_status' => 'Vyžaduje nastavení',
    'two_factor_scan_or_enter_msg' => 'Naskenujte QR kód pomocí Google Authenticatoru nebo zadejte tajný klíč ručně. Poté vložte vygenerovaný kód.',
    'your_secret_key_msg' => 'Váš tajný klíč (pro ruční zadání, pokud je potřeba):',

    // 2FA field labels
    'one_time_password_label' => 'Jednorázové heslo',
    'enter_2fa_code_placeholder' => 'Zadejte 2FA kód',
    '2fa_will_be_forced_after_date' => '2FA bude vyžadováno po :date.',

    // Buttons
    '2fa' => '2FA',
    'verify_button' => 'Ověřit',

    'confirm_access_recovery_codes' => 'Potvrdit přístup',
    're_authenticate_message' => 'Musíte se znovu ověřit, abyste získali přístup k nastavení nebo kódy pro obnovu 2FA.',
    'choose_method' => 'Vyberte metodu:',
    'one_time_password' => 'Jednorázové heslo (OTP)',
    'password' => 'Heslo',
    'enter_code_or_password' => 'Zadejte kód / heslo:',
    'confirm' => 'Potvrdit',

    '2fa_recovery_codes' => 'Obnovovací kódy pro 2FA',
    'recovery_codes_description' => 'Tyto kódy vám umožní přihlásit se, pokud ztratíte přístup k ověřovací aplikaci. Každý kód lze použít jen jednou.',
    'regenerate_codes' => 'Znovu vygenerovat kódy',
    'copy' => 'Kopírovat',
    'copy_all' => 'Kopírovat vše',
    'no_recovery_codes_available' => 'Nejsou dostupné žádné kódy pro obnovu. Níže můžete vygenerovat nové.',
    'copied' => 'Kód zkopírován do schránky!',
    'all_codes_copied' => 'Všechny obnovovací kódy byly zkopírovány do schránky!',
    'supported_app' => 'Podporované aplikace',
    'supported_apps' => [
        'Authy' => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP' => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator' => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator' => ['Windows Phone'],
        'LastPass Authenticator' => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password' => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    // Social logins:
    'social_login_settings' => 'Nastavení sociálního přihlášení',
    'social_login_settings_help' => 'Zadejte přihlašovací údaje pro sociální sítě.',
    'client_id' => 'Client ID',
    'client_secret' => 'Client Secret',
    'redirect_url' => 'Přesměrování (Redirect URL)',
    'enter_client_id' => 'Zadejte Client ID pro :provider',
    'enter_client_secret' => 'Zadejte Client Secret pro :provider',
    'enter_redirect_url' => 'Zadejte Redirect URL pro :provider',
    'enable_social_login' => 'Povolit sociální přihlášení',
    'tab_social' => 'Sociální přihlášení',
    'or_login_with' => 'Nebo se přihlaste pomocí',
    'force_otp_after_social_login' => 'Vynutit OTP po sociálním přihlášení',
    'force_otp_after_social_login_tooltip' => 'Pokud je aktivováno, uživatelé, kteří se přihlašují pomocí sociálních sítí, musí ověřit jednorázový kód (OTP).',

    //Lock Users:
    'locked_until' => 'Uzamčeno do',
    'locked_users' => 'Uzamčení uživatelé',
    'view_locked_users' => 'Zobrazit uzamčené uživatele',
    'tab_login_security' => 'Zabezpečení přihlášení',
    'unlock' => 'Odemknout',
    'enable_user_lock_label' => 'Povolit uzamčení uživatele',
    'enable_user_lock_tooltip' => 'Povolit/zakázat uzamčení uživatele po neúspěšných pokusech o přihlášení.',
    'max_login_attempts_label' => 'Maximální počet pokusů o přihlášení',
    'max_login_attempts_tooltip' => 'Počet pokusů, které jsou povoleny před uzamčením uživatele.',
    'lock_duration_label' => 'Doba uzamčení',
    'lock_duration_tooltip' => 'Doba (v číslech), po kterou bude uživatel uzamčen.',
    'lock_duration_unit_label' => 'Jednotka doby uzamčení',
    'lock_duration_unit_tooltip' => 'Vyberte časovou jednotku pro dobu uzamčení: minuty, hodiny, dny apod.',
    'account_locked_for_time_unit' => 'Váš účet je uzamčen na :time :unit.',
    'user_unlocked_message' => 'Uživatel byl úspěšně odemknut!',

    //Verify email:
    'verify_email_address_title' => 'Ověřte svou e-mailovou adresu',
    'fresh_verification_sent' => 'Nový ověřovací odkaz byl odeslán na váš e-mail.',
    'verify_email_before_proceeding' => 'Než budete pokračovat, zkontrolujte prosím svůj e-mail, zda tam najdete ověřovací odkaz.',
    'did_not_receive_email' => 'Pokud jste neobdrželi e-mail',
    'click_here_request_another' => 'klikněte zde pro znovuzaslání odkazu',
    'logout' => 'Odhlásit se',
    'force_email_verify' => 'Vynutit ověření e-mailu',
    'force_email_verify_tooltip' => 'Pokud je aktivováno, musí uživatelé ověřit svou e-mailovou adresu před přístupem do systému.',
    // Reset Mapping
    'reset_purchase_sell_mapping'     => 'Obnovit mapování nákup–prodej',
    'select_business'                 => 'Vyberte podnik:',
    'all_businesses'                  => 'Všechny podniky',
    'chunk_size'                      => 'Velikost části:',
    'reset_mapping'                   => 'Obnovit mapování',
    'purchase_sell_mismatch_tooltip'  => 'Vyberte mapování podniků, která je třeba obnovit. '
                                         . 'Pokud máte velkou databázi, doporučujeme obnovit mapování po jednotlivých podnicích.',
    'chunk_size_tooltip'              => 'Mapování se obnoví v menších částech. '
                                         . 'Pro velké datové sady zvolte vhodnou velikost části. '
                                         . 'Doporučujeme aktivovat režim údržby.',

    // Maintenance Mode
    'tab_maintenance_mode'        => 'Režim údržby',
    'maintenance_mode'            => 'Režim údržby',
    'maintenance_mode_tooltip'    => 'Přepne aplikaci do režimu údržby (návštěvníci uvidí obrazovku údržby).',
    'enable_countdown'            => 'Povolit odpočet',
    'enable_timer_tooltip'        => 'Zobrazí živý odpočet do konce údržby.',
    'maintenance_duration'        => 'Doba trvání',
    'maintenance_unit'            => 'Jednotka trvání',
    'minutes'                     => 'Minuty',
    'hours'                       => 'Hodiny',
    'days'                        => 'Dny',

    // Maintenance page
    'under_maintenance'           => 'Probíhá údržba',
    'maintenance_heading'         => 'Provádíme údržbu.',
    'maintenance_subheading'      => 'Děkujeme za vaši trpělivost!',
    'maintenance_back_in'         => 'Vrátíme se za :time',
    'maintenance_back_no_timer'   => 'Vrátíme se hned po dokončení údržby.',

    // Mapping reset page
    'mapping_reset_progress'      => 'Průběh obnovy mapování',
    'mapping_reset_in_progress'   => 'Obnova mapování probíhá',
    'batch_status'                => 'Stav dávky',
    'refresh_status'              => 'Obnovit stav',

    // Mapping reset result & status
    'mapping_reset_result'        => 'Výsledek obnovy mapování',
    'chunk_processing_status'     => 'Stav zpracování části',

    // Table headers
    'business'                    => 'Podnik',
    'chunk_status'                => 'Stav části',
    'total_chunks'                => 'Celkový počet částí',
    'status'                      => 'Stav',

    // Button
    'go_back'                     => 'Zpět',

    // Mapping Jobs
    'processed_jobs'              => 'Úlohy mapování',
    'processed_jobs_subtitle'     => 'Všechny odeslané dávky mapování',
    'uuid'                        => 'UUID dávky',
    'job_name'                    => 'Název úlohy',
    'completed_chunks'            => 'Dokončené části',
    'started_at'                  => 'Začátek',
    'finished_at'                 => 'Poslední aktualizace',
    'view_rebuild_jobs'           => 'Zobrazit úlohy obnovy zásob',

    // Detailed instruction
    'reset_mapping_instruction'   => "Doporučujeme nastavit ovladač fronty na skutečné backendové řešení:\n"
                                     . "→ V souboru .env nastavte `QUEUE_CONNECTION=database`.\n\n"
                                     . "Aktivujte také režim údržby (Nastavení aplikace → Režim údržby) "
                                     . "během obnovy mapování, aby se zabránilo duplicitním nebo chybějícím datům.\n\n"
                                     . "Pokud máte velkou databázi, obnova potrvá déle – zvažte obnovu po jednotlivých podnicích.\n\n"
                                     . "Před zahájením:\n"
                                     . "• Proveďte úplnou zálohu databáze.\n"
                                     . "• Sledujte proces v logu a zachyťte případné chyby.",

    'recovery_codes_generated_successfully' => 'Kódy pro obnovení vygenerovány úspěšně',

    // Disposable-email sync
    'sync_disposable_list'        => 'Synchronizovat seznam jednorázových e-mailů',
    'sync_disposable_success'     => 'Seznam jednorázových e-mailů byl aktualizován.',
    'sync_disposable_failed'      => 'Synchronizace seznamu jednorázových e-mailů se nezdařila.',

    // Temporary-email protection
    'temp_email_protection'       => 'Ochrana proti jednorázovým e-mailům',
    'temp_email_protection_tooltip'=> 'Blokuje dočasné/jednorázové e-mailové domény (např. Mailinator, 10MinuteMail).',
    'disposable_not_allowed'      => 'Jednorázové e-mailové adresy nejsou povoleny.',

    // OTP Verification
    'otp_verification' => 'OTP верификаци',
    'otp_verification_management' => 'OTP верификацин менеджмент',
    'manage_otp_verification_requests' => 'OTP верификацин хьажориг харжа а, статистикаш хьажа а',
    'active_otps' => 'Жигара OTP',
    'unverified_users' => 'Бакъалла йоцу дехарша',
    'expired_otps' => 'Хан чекхвоцу OTP',
    'failed_attempts' => 'Кхечарче цечарна',
    'pending_users' => 'Хьулдар доьхуш йолу дехарша',
    'today_requests' => 'Тахана хьожургаш',
    'high_retries' => 'Дукха кхачарш',
    'user_info' => 'Дехаран хаам',
    'otp_code' => 'OTP код',
    'attempts' => 'Кхачарш',
    'resend_count' => 'Юха дехьанаш',
    'no_active_otp' => 'Жигара OTP яц',
    'expired' => 'Хан чекхвоьцу',
    'active' => 'Жигара',
    'expires_in' => 'Хан чекхвелла',
    'remaining' => 'даьлла',
    'resends' => 'юха дехьанаш',
    'last' => 'ТIаьхьарлера',
    'updated' => 'Керла хувцам',
    'verify' => 'Бакъалла',
    'manual_verify_email' => 'КеIа хана email бакъалла',
    'reset_otp' => 'OTP юхатасса',
    'manual_verify' => 'КеIа хана бакъалла',
    'deactivate' => 'Дlадайе',
    
    // JavaScript messages
    'confirm_reset_otp' => 'Хlара OTP юхатасса хьуна ху? Дехар юха хьожург дан деза.',
    'failed_to_reset_otp' => 'OTP юхатасса цекхечарна',
    'error_resetting_otp' => 'OTP юхатассехь гlалат дlавелира',
    'confirm_verify_unverified_user' => 'Бакъаллабоьцу дехарн :username email кеIа хана бакъалла ехха хьуна ху?',
    'confirm_verify_user' => 'Дехарн :username email кеIа хана бакъалла ехха хьуна ху?',
    'user_verified_removed_from_list' => 'Дехаран email бакъаллабан - дехар бакъаллабоцу дехаршан могlанехь гайта цалайта',
    'failed_to_verify_user' => 'Дехар бакъалла цекхечарна',
    'error_verifying_user' => 'Дехар бакъаллехь гlалат дlавелира',
    'confirm_deactivate_token' => 'Хlара OTP токен дlадайе хьуна ху?',
    'failed_to_deactivate_token' => 'Токен дlадайе цекхечарна',
    'error_deactivating_token' => 'Токен дlадайехь гlалат дlавелира',

    // Session Management
    'session_management' => 'Сессешан менеджмент',
    'manage_user_sessions' => 'Дехаршан сессеш харжа а, лорамаш хьажа а',
    'total_sessions' => 'Массо сессеш',
    'active_users' => 'Жигара дехарша',
    'file_sessions' => 'Файлан сессеш',
    'database_sessions' => 'Базан сессеш',
    'session_actions' => 'Кхочушдараш',
    'user_name' => 'Дехаран цlе',
    'device_info' => 'Техникийн хаам',
    'ip_address' => 'IP адрес',
    'last_activity' => 'Тlаьхьарлера болхболл',
    'session_id' => 'Сессен ID',
    'force_logout' => 'Зlамига арадахьар',
    'view_session_details' => 'Сессен хlотталаш хьажа',
    'invalidate_all_sessions' => 'Массо сессеш дlадайа',
    'filter_by_user' => 'Дехарца цуьнах леха',
    'filter_by_session_type' => 'Сессен типца цуьнах леха',
    'all_session_types' => 'Массо сессешан типаш',
    'confirm_force_logout' => 'Хlара сессе зlамига дlадайа хьуна ху? Дехар юха чувала алхха деза.',
    'confirm_invalidate_all' => 'Хlин дехаран массо сессеш дlадайа хьуна ху? Массо жигара сессеш чекхвелла.',
    'session_invalidated' => 'Сессе кхочушна дlадайина',
    'all_sessions_invalidated' => 'Дехаран массо сессеш кхочушна дlадайина',
    'session_details' => 'Сессен хlотталаш',
    'session_data' => 'Сессен хаам',
    'user_agent' => 'Пайдахочун агент',
    'session_payload' => 'Сессен пейлоуд',
    'created_at' => 'Кхоьллина',
    'updated_at' => 'Керла хувцина',
    'expires_at' => 'Чекхвела',
    'session_driver' => 'Сессен драйвер',
    'unknown_device' => 'Йоьвзаш йоцу техника',
    'unknown_browser' => 'Йоьвзаш йоцу браузер',
    'unknown_platform' => 'Йоьвзаш йоцу платформа',
    'desktop' => 'Декстоп',
    'mobile' => 'Мобильни',
    'tablet' => 'Планшет',
    'current_session' => 'Хlинцалера сессе',
    'other_sessions' => 'Кхин сессеш',
    'session_location' => 'Сессен меттиг',
    'refresh_sessions' => 'Сессеш керла дагалае',
    'auto_refresh' => 'Авто керладагалар',
    'manual_refresh' => 'КеIа хана керладагалар',
    'bulk_actions' => 'Дукха кхочушдараш',
    'select_all_sessions' => 'Массо сессеш харжа',
    'logout_selected' => 'Хержина арадахьар',
    'export_sessions' => 'Сессеш арадахьар',
    'session_statistics' => 'Сессешан статистикаш',
    'concurrent_sessions' => 'Цхаана хенахь сессеш',
    'average_session_duration' => 'Сессешан лакхара хан',
    'peak_concurrent_users' => 'Цхаана хенахь дехаршан къезиг',
    'session_security' => 'Сессешан лорам',
    'suspicious_activity' => 'Шубхали болх',
    'multiple_ip_sessions' => 'Дукха IP-н сессеш',
    'session_timeout' => 'Сессен хан чекхвар',
    'force_single_session' => 'Цхъа сессе хlокху',
    'session_encryption' => 'Сессен шифрованар',
    'secure_session_only' => 'Лорамна сессеш бен',

    // Instant POS Button Strings
    'refresh_pos_cache' => 'Кеш керла хьаде',
    'instant_pos_enabled' => 'Сиха POS чудала',
    'instant_pos_disabled' => 'Сиха POS дайина',
    'disable_instant_pos' => 'Disable Instant POS',
];
