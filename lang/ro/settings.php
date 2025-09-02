<?php

return [

    'app_settings' => 'Setări ale Aplicației',
    'manage_app_settings' => 'Administrează Setările Aplicației',
    'tab_2fa' => '2FA',
    'tab_theme' => 'Aspect',
    'tab_login_page' => 'Pagină Login',
    'tab_sidebar' => 'Bară Laterală',
    'tab_language' => 'Limbă',
    'tab_repair_status' => 'Stare Reparație',
    'tab_logo' => 'Logo',
    // Buttons
    'update_settings' => 'Actualizează Setările',

    'enable_custom_bg_image_for_login' => 'Activează Fundal Personalizat pentru Login',
    'enable_custom_bg_image_for_login_tooltip' => 'Setează o imagine de fundal personalizată pentru pagina de login.',

    'enable_custom_sidebar_logo' => 'Permite Logo Personalizat în Bara Laterală',
    'enable_custom_sidebar_logo_tooltip' => 'Permite companiilor să folosească un logo personalizat în bara laterală.',

    // language.blade.php
    'header_language_change' => 'Schimbare Limbă în Antet',
    'header_language_change_tooltip' => 'Permite utilizatorilor să schimbe limba din antetul principal.',
    'header_languages_label' => 'Limbi în Antet',
    'header_languages_label_tooltip' => 'Selectează ce limbi vor fi afișate în antet.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'Afișează Starea de Reparație pe Ecranul de Login',

    // 2fa.blade.php
    'enable_2fa' => 'Activează 2FA',
    'enable_2fa_tooltip' => 'Activează Autentificarea în Doi Pași (2FA) pentru aplicație.',

    'force_2fa' => 'Obligă 2FA',
    'force_2fa_tooltip' => 'Utilizatorii trebuie să configureze 2FA înainte de a putea folosi aplicația.',

    'recommend_2fa' => 'Recomandă 2FA',
    'recommend_2fa_tooltip' => 'Apare o fereastră (modal) o singură dată la login pentru a încuraja activarea 2FA.',

    'allow_disable_2fa' => 'Permite Dezactivarea Temporară a 2FA',
    'allow_disable_2fa_tooltip' => 'Permite utilizatorilor să dezactiveze temporar 2FA până la un anumit moment.',

    'disable_2fa_duration_label' => 'Durata de Dezactivare 2FA',
    'disable_2fa_duration_label_tooltip' => 'Definește perioada în care 2FA poate rămâne dezactivat.',

    'disable_2fa_unit_label' => 'Unitatea de Dezactivare 2FA',

    'force_2fa_after_date_label' => 'Obligă 2FA după Dată',
    'force_2fa_after_date_label_tooltip' => 'După această dată, toți utilizatorii trebuie să activeze 2FA. Data impusă este afișată și în fereastra de recomandare 2FA.',

    'primary_color_label' => 'Culoare Primară',
    'primary_color_label_tooltip' => 'Selectează culoarea primară implicită a aplicației. Această culoare va fi folosită de companiile care nu își setează propriul design.',
    'secondary_color_label' => 'Culoare Secundară',
    'secondary_color_label_tooltip' => 'Selectează culoarea secundară implicită a aplicației. Această culoare va fi folosită de companiile care nu își setează propriile culori.',

    'allow_theme_change' => 'Permite Schimbarea Temelor',
    'allow_theme_change_tooltip' => 'Permite companiilor să își personalzeze culorile temei. Dacă nu setează culori personalizate, vor fi utilizate culorile implicite definite aici de superadmin.',

    'login_bg_image_label' => 'Imagine de Fundal pentru Login',
    'login_bg_image_label_tooltip' => 'Încărcarea unei noi imagini va înlocui fundalul existent.',

    'logo_dark_tooltip'  => 'Schimbă logo-ul întunecat implicit al aplicației, folosit în modul luminos.',
    'logo_light_tooltip' => 'Schimbă logo-ul luminos implicit al aplicației, folosit în modul întunecat.',
    'favicon_tooltip' => 'Dimensiuni recomandate: 32×32 px. Această iconiță apare în tab-urile browserului și în marcaje.',
    'upload_favicon' => 'Încarcă Favicon',

    // Fonts
    'tab_fonts' => 'Fonturi',
    'english_font'            => 'Font Englezesc',
    'arabic_font'             => 'Font Arabic',
    'custom_font_placeholder' => 'Introduceți un nume de font personalizat...',
    'select_font'             => 'Selectați un font...',
    'or'                      => 'sau',
    'font_help_text'          => 'Alege din listă sau introdu propriul font.',
    'english_font_tooltip'  => 'Introduceți un nume de font personalizat sau alegeți din listă. Puteți găsi nume de font pe: :url',
    'arabic_font_tooltip'   => 'Introduceți un nume de font personalizat sau alegeți din listă. Puteți găsi nume de font pe: :url',

    //Recaptcha:
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha'              => 'Activează Google reCAPTCHA',
    'enable_recaptcha_tooltip'      => 'Comută pentru a activa protecția reCAPTCHA. Obțineți cheia și secretul de la: :url',
    'enable_recaptcha_text'         => 'Activează reCAPTCHA',
    'google_recaptcha_key'          => 'Cheie Site (Site Key) Google reCAPTCHA',
    'google_recaptcha_secret'       => 'Cheie Secretă (Secret Key) Google reCAPTCHA',
    'google_recaptcha_key_placeholder'    => 'Introduceți Site Key pentru Google reCAPTCHA',
    'google_recaptcha_secret_placeholder' => 'Introduceți Secret Key pentru Google reCAPTCHA',

    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'Activează Autentificarea în Doi Pași (2FA)',
    'modal_enable_2fa_desc' => 'Recomandăm activarea 2FA pentru a spori securitatea contului.',
    'enable_now_button' => 'Activează Acum',
    'maybe_later_button' => 'Poate Mai Târziu',
    'close_aria_label' => 'Închide',

    // 2FA Verify page
    'one_time_password_heading' => 'Parolă Unică (OTP)',
    'one_time_password_label' => 'Parolă Unică',
    'enter_2fa_code_placeholder' => 'Introduceți codul 2FA',
    'disable_2fa_for' => 'Dezactivează 2FA pentru :duration :unit',
    'verify_button' => 'Verifică',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'Autentificare în Doi Pași (2FA)',
    'google_auth_app_desc' => 'Aplicația Google Authenticator',
    'configured_status' => 'Configurat',
    'needs_configuration_status' => 'Necesară Configurare',
    'two_factor_scan_or_enter_msg' => 'Scanați codul QR de mai jos cu aplicația Google Authenticator sau introduceți manual cheia, apoi introduceți codul generat.',
    'your_secret_key_msg' => 'Cheia dvs. secretă (dacă trebuie introdusă manual):',

    // 2FA field labels
    'one_time_password_label' => 'Parolă Unică',
    'enter_2fa_code_placeholder' => 'Introduceți codul 2FA',
    '2fa_will_be_forced_after_date' => '2FA va fi forțat după :date.',

    // Buttons
    '2fa' => '2FA',
    'verify_button' => 'Verifică',

    'confirm_access_recovery_codes' => 'Confirmă Accesul',
    're_authenticate_message'       => 'Trebuie să vă re-autentificați pentru a accesa Configurarea sau Codurile de Recuperare 2FA.',
    'choose_method'                 => 'Alegeți metoda:',
    'one_time_password'             => 'Parolă Unică (OTP)',
    'password'                      => 'Parolă',
    'enter_code_or_password'        => 'Introduceți Cod / Parolă:',
    'confirm'                       => 'Confirmă',

    '2fa_recovery_codes'           => 'Coduri de Recuperare 2FA',
    'recovery_codes_description'   => 'Aceste coduri vă permit să vă autentificați dacă pierdeți accesul la aplicația de autentificare. Fiecare cod poate fi folosit o singură dată.',
    'regenerate_codes'             => 'Regenerare Coduri',
    'copy'                         => 'Copiază',
    'copy_all'                     => 'Copiază Tot',
    'no_recovery_codes_available'  => 'Nu există coduri de recuperare disponibile. Puteți genera coduri noi mai jos.',
    'copied'                       => 'Cod copiat în clipboard!',
    'all_codes_copied'             => 'Toate codurile de recuperare au fost copiate în clipboard!',
    'supported_app'                => 'Aplicații Suportate',
    'supported_apps' => [
        'Authy' => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP' => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator' => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator' => ['Windows Phone'],
        'LastPass Authenticator' => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password' => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    // social logins:
    'social_login_settings'       => 'Setări de Login Social',
    'social_login_settings_help'  => 'Introduceți credențialele dvs. pentru login social.',
    'client_id'                   => 'Client ID',
    'client_secret'               => 'Client Secret',
    'redirect_url'                => 'URL de Redirecționare',
    'enter_client_id'             => 'Introduceți Client ID pentru :provider',
    'enter_client_secret'         => 'Introduceți Client Secret pentru :provider',
    'enter_redirect_url'          => 'Introduceți URL de Redirecționare pentru :provider',
    'enable_social_login'         => 'Activează Login Social',
    'tab_social' => 'Login-uri Sociale',
    'or_login_with' => 'Sau Login cu',
    'force_otp_after_social_login' => 'Obligă OTP după Login Social',
    'force_otp_after_social_login_tooltip' => 'Dacă este activat, utilizatorii care se autentifică prin login social vor fi nevoiți să verifice un OTP.',

    //Lock Users:
    'locked_until' => 'Blocat Până la',
    'locked_users' => 'Utilizatori Blocați',
    'view_locked_users' => 'Vezi Utilizatorii Blocați',
    'tab_login_security' => 'Securitatea Login-ului',
    'unlock' => 'Deblochează',
    'enable_user_lock_label' => 'Activează Blocarea Utilizatorului',
    'enable_user_lock_tooltip' => 'Activează/dezactivează blocarea utilizatorului după încercări eșuate de login.',
    'max_login_attempts_label' => 'Numărul Maxim de Încercări de Login',
    'max_login_attempts_tooltip' => 'Numărul de încercări permise înainte ca utilizatorul să fie blocat.',
    'lock_duration_label' => 'Durata Blocării',
    'lock_duration_tooltip' => 'Perioada de timp (în cifre) pentru care un utilizator rămâne blocat.',
    'lock_duration_unit_label' => 'Unitatea de Durată a Blocării',
    'lock_duration_unit_tooltip' => 'Alege unitatea de timp pentru perioada de blocare: minute, ore, zile etc.',
    'account_locked_for_time_unit' => 'Contul dvs. este blocat pentru :time :unit.',
    'user_unlocked_message' => 'Utilizator deblocat cu succes!',

    //Verify email:
    'verify_email_address_title' => 'Verifică Adresa de Email',
    'fresh_verification_sent' => 'Un nou link de verificare a fost trimis la adresa dvs. de email.',
    'verify_email_before_proceeding' => 'Înainte de a continua, verificați emailul pentru linkul de verificare.',
    'did_not_receive_email' => 'Dacă nu ați primit emailul',
    'click_here_request_another' => 'faceți clic aici pentru a solicita altul',
    'logout' => 'Deconectare',
    'force_email_verify' => 'Forțează Verificarea de Email',
    'force_email_verify_tooltip' => 'Dacă este activat, utilizatorii trebuie să își verifice adresa de email înainte de a avea acces la sistem.',

    // Reset Mapping
    'reset_purchase_sell_mapping'     => 'Resetați maparea cumpărare-vânzare',
    'select_business'                 => 'Selectați afacerea:',
    'all_businesses'                  => 'Toate afacerile',
    'chunk_size'                      => 'Dimensiune lot:',
    'reset_mapping'                   => 'Resetați maparea',
    'purchase_sell_mismatch_tooltip'  => 'Alegeți mapările de afaceri care trebuie resetate. Dacă aveți o bază de date mare, recomandăm resetarea pe fiecare afacere în parte.',
    'chunk_size_tooltip'              => 'Maparea va fi resetată în loturi mai mici. Pentru seturi de date mari, alegeți o dimensiune de lot potrivită. Modului de întreținere activă i se recomandă.',

    // Maintenance Mode
    'tab_maintenance_mode'            => 'Mod întreținere',
    'maintenance_mode'                => 'Mod întreținere',
    'maintenance_mode_tooltip'        => 'Pune aplicația în modul de întreținere (vizitatorii vor vedea ecranul de întreținere).',
    'enable_countdown'                => 'Activează numărătoare inversă',
    'enable_timer_tooltip'            => 'Afișează un cronometru live până la sfârșitul întreținerii.',
    'maintenance_duration'            => 'Durată',
    'maintenance_unit'                => 'Unitate durată',
    'minutes'                         => 'Minute',
    'hours'                           => 'Ore',
    'days'                            => 'Zile',

    // Maintenance page
    'under_maintenance'               => 'În întreținere',
    'maintenance_heading'             => 'Efectuăm unele lucrări de întreținere.',
    'maintenance_subheading'          => 'Vă mulțumim pentru răbdare!',
    'maintenance_back_in'             => 'Ne întoarcem în :time',
    'maintenance_back_no_timer'       => 'Ne întoarcem imediat ce întreținerea este finalizată.',

    // Mapping reset page
    'mapping_reset_progress'          => 'Progres resetare mapare',
    'mapping_reset_in_progress'       => 'Resetarea mapării este în desfășurare',
    'batch_status'                    => 'Stare lot',
    'refresh_status'                  => 'Reîmprospătează starea',

    // Mapping reset result & status
    'mapping_reset_result'            => 'Rezultatul resetării mapării',
    'chunk_processing_status'         => 'Starea procesării loturilor',

    // Table headers
    'business'                        => 'Afacere',
    'chunk_status'                    => 'Stare lot',
    'total_chunks'                    => 'Număr total de loturi',
    'status'                          => 'Stare',

    // Button
    'go_back'                         => 'Înapoi',

    // Mapping Jobs
    'processed_jobs'                  => 'Sarcini de mapare',
    'processed_jobs_subtitle'         => 'Toate loturile de mapare dispatch-ate',
    'uuid'                            => 'UUID lot',
    'job_name'                        => 'Nume sarcină',
    'completed_chunks'                => 'Loturi finalizate',
    'started_at'                      => 'Început la',
    'finished_at'                     => 'Ultima actualizare',
    'view_rebuild_jobs'               => 'Vizualizează sarcini reconstrucție stoc',

    // Detailed instruction
    'reset_mapping_instruction'       =>
        "Se recomandă setarea driver-ului cozii la un backend real:\n"
        . "→ În fișierul dumneavoastră .env, puneți `QUEUE_CONNECTION=database`.\n\n"
        . "Activați de asemenea modul de întreținere (Setări aplicație → Modul întreținere) "
        . "în timp ce se rulează resetarea mapării pentru a evita datele duplicate sau pierdute.\n\n"
        . "Dacă aveți o bază de date mare, resetarea va dura mai mult—luați în considerare resetarea pe afacere.\n\n"
        . "Înainte de a începe:\n"
        . "• Efectuați o copie de siguranță completă a bazei de date.\n"
        . "• Monitorizați procesul prin jurnale pentru a surprinde eventuale erori.",

    'recovery_codes_generated_successfully' => 'Codurile de recuperare generate cu succes',

    // Disposable-email sync
    'sync_disposable_list'            => 'Sincronizează lista de e-mailuri eliminate',
    'sync_disposable_success'         => 'Lista de e-mailuri eliminate a fost actualizată.',
    'sync_disposable_failed'          => 'Sincronizarea listei de e-mailuri eliminate a eșuat.',

    // Temporary-email protection
    'temp_email_protection'           => 'Protecție e-mailuri temporare',
    'temp_email_protection_tooltip'   => 'Blochează domeniile de e-mail temporare/eliminate (ex.: Mailinator, 10MinuteMail).',
    'disposable_not_allowed'          => 'E-mailurile eliminate nu sunt permise.',

    // 3.3
    'enable_sidebar_dropdown'         => 'Activează dropdown-ul din bara laterală',
    'enable_sidebar_dropdown_tooltip' => 'Restrânge sub-meniurile într-un dropdown clicabil în bara laterală.',
    // Custom Menu
    'menu'               => 'Meniu',
    'menus_heading'      => 'Meniuri',
    'menus_description'  => 'Administrează și organizează elementele de meniu.',
    'add_menu_item'      => 'Adaugă element',
    'save_menu'          => 'Salvează meniul',
    'label'              => 'Etichetă',
    'parent'             => 'Părinte',
    'icon_type'          => 'Tip pictogramă',
    'svg'                => 'SVG',
    'fontawesome'        => 'FontAwesome',
    'svg_icon'           => 'Pictogramă SVG',
    'fa_class'           => 'Clasă FA',
    'named_route'        => 'Rută denumită',
    'absolute_url'       => 'URL absolut',
    'permission'         => 'Permisiune',
    'module_flag'        => 'Indicator modul',
    'sort_order'         => 'Ordine sortare',
    'active'             => 'Activ?',
    'apply'              => 'Aplică',
    'add_menu'           => 'Adaugă meniu',
    'inactive'           => 'Inactiv',
    'flush_cache'        => 'Golește cache-ul',
    'reset_menu'         => 'Resetează',
    'custom_menu'        => 'Meniu lateral personalizat',

    'rebuilt_successfully' => 'Reconstruit cu succes',

    'sidebar_layout'        => 'Aspect bară laterală',
    'sidebar_layout_1'      => 'Aspect 1 (Clasic)',
    'sidebar_layout_2'      => 'Aspect 2 (Compact)',
    'sidebar_layout_custom' => 'Aspect personalizat',

    'custom_sidebar_type' => 'Tip bară laterală personalizată',
    'sidebar'             => 'Bară laterală',
    'topbar'              => 'Bară superioară',

    'tab_business_settings'    => 'Setări firmă',
    'business_settings_layout' => 'Aspect setări firmă',
    'layout_1'                => 'Aspect 1 – File clasice',
    'layout_2'                => 'Aspect 2 – Bară laterală modernă',

    // Themes
    'predefined_theme_label'   => 'Temă predefinită',
    'predefined_theme_tooltip' => 'Alege o paletă de culori predefinită.',
    'select_theme'             => 'Selectează tema',
    'theme_default'            => 'Implicită',

    // Migration Data
    'app_settings'         => 'Setări aplicație',
    'application_settings' => 'Configurări aplicație',
    'storage_migration'    => 'Migrare stocare',
    'manage_uploads_data'  => 'Gestionează fișierele încărcate',

    'push'  => 'push',
    'pull'  => 'pull',
    'local' => 'local',
    'external_disk' => 'disc extern',
    'duplicate_files_skipped_safe_to_resume'
        => 'Fișierele duplicat au fost omise. Poți relua în siguranță.',

    'direction'              => 'Direcție',
    'push_local_to_external' => 'push (local → extern)',
    'pull_external_to_local' => 'pull (extern → local)',

    'from_disk' => 'De pe disc',
    'to_disk'   => 'Pe disc',

    'destination_visibility'        => 'Vizibilitate destinație',
    'visibility_none_bucket_signed' => '(niciuna / politică bucket / URL-uri semnate)',
    'visibility_public_acl'         => 'public (ACL obiect)',
    'visibility_private_acl'        => 'privat (ACL obiect)',

    'folders_to_include_optional' => 'Dosare de inclus (opțional)',
    'folders_include_tooltip'     => 'Lasă gol pentru a include toate dosarele din uploads.',
    'select_all'                  => 'Selectează tot',
    'none'                        => 'Niciunul',
    'invert'                      => 'Inversează',
    'no_suggestions_found'        => 'Nu s-au găsit sugestii.',

    'delete_source_after_copy' => 'Șterge sursa după copiere reușită (mutare)',
    'dry_run_plan_only'        => 'Test (doar plan)',
    'verbose_log_messages'     => 'Detaliat (mesaje log)',

    'execution'                    => 'Execuție',
    'execution_tooltip_html' =>
        'Folosește <strong>Direct</strong> doar pentru mutări mici (ex.: &lt; 1 000 fișiere). ' .
        'Pentru 5–10 GB recomandăm jobul de fundal.',
    'pick_how_to_execute'          => 'Alege metoda de execuție.',
    'background_job_recommended'   => 'Job de fundal (recomandat)',
    'run_direct_now'               => 'Direct (execută acum)',

    'start_migration' => 'Pornește migrarea',
    'reset'           => 'Resetează',

    'progress' => 'Progres',
    'result'   => 'Rezultat',

    // JS strings
    'from'                    => 'Din',
    'to'                      => 'În',
    'folders'                 => 'Dosare',
    'total'                   => 'Total',
    'copied'                  => 'Copiate',
    'skipped'                 => 'Omise',
    'deleted'                 => 'Șterse',
    'failed'                  => 'Eșuate',
    'invalid_response'        => 'Răspuns invalid',
    'failed_to_start_migration'=> 'Nu s-a putut porni migrarea',
    'confirm_delete_source'   =>
        'Sigur dorești să ȘTERGI fișierele sursă după copiere? Acțiunea este ireversibilă.',

    'default_storage_disk'      => 'Disc implicit de stocare',
    'default_storage_disk_help' =>
        '"public" = storage/app/public prin symlink /storage. "local" = public/uploads.',

    's3_compatible_settings'     => 'Setări compatibile S3',
    'display_label_optional'     => 'Etichetă afișare (opțional)',
    'placeholder_my_s3_provider' => 'Furnizorul meu S3',
    'display_only_admin_ui'      => 'Se afișează doar în interfața de administrare.',
    'access_key'                 => 'Access Key',
    'secret_key'                 => 'Secret Key',
    'region'                     => 'Regiune',
    'bucket'                     => 'Bucket',
    'endpoint'                   => 'Endpoint',
    'cdn_or_custom_domain_optional' => 'CDN / Domeniu personalizat (opțional)',

    'disable_http_verify'      => 'Dezactivează verificarea TLS',
    'disable_http_verify_help' =>
        'Off = verificare TLS activă. On = dezactivată (doar local pentru test).',

    'path_style_endpoint' => 'Endpoint tip „path-style”',

    'use_signed_urls'      => 'Folosește URL-uri semnate (bucket privat)',
    'use_signed_urls_help' =>
        'Off = URL-uri publice. On = private cu URL-uri semnate.',

    'signed_url_ttl_minutes' => 'Durată URL semnat (minute)',
    'tab_storage_settings'   => 'Stocare',
    'syncing'               => 'Se sincronizează…',

    // POS Settings
    'pos_performance_settings'   => 'Setări performanță POS',
    'enable_instant_pos'         => 'Activează POS instant',
    'enable_instant_pos_tooltip' => 'Adaugă produse instant, fără apeluri AJAX, pentru viteză mai bună',
    'enable_instant_pos_help'    =>
        'Când este activ, produsele se adaugă din cache, nu prin solicitări la server.',

    'enable_instant_search'            => 'Activează căutare instant',
    'enable_instant_search_tooltip'    => 'Căutare din cache, fără AJAX',
    'enable_instant_search_help'       =>
        'Când este activă, căutarea returnează rezultatele imediat.',

    'pos_performance_info_title' => 'Îmbunătățire performanță',
    'pos_performance_info_desc'  => 'POS-ul instant reduce solicitările la server și accelerează fluxul:',
    'instant_pos_benefit_1'      => 'Produsele sunt adăugate fără a aștepta răspunsul serverului',
    'instant_pos_benefit_2'      => 'Rezultatele căutării apar imediat',
    'instant_pos_benefit_3'      => 'Stocurile se actualizează automat după fiecare vânzare',
    'instant_pos_benefit_4'      => 'Funcționează offline-first, apoi sincronizează cu serverul',

    'pos_cache_settings'                    => 'Setări cache POS',
    'pos_cache_refresh_interval'            => 'Interval reîmprospătare cache',
    'pos_cache_refresh_interval_tooltip'    => 'Frecvența de actualizare a cache-ului de produse',
    'pos_cache_refresh_interval_help'       =>
        'Se reîmprospătează automat după fiecare vânzare; intervale manuale ca rezervă.',
    'auto_refresh'                          => 'Auto (după vânzare)',
    '30_minutes'                            => '30 de minute',
    '60_minutes'                            => '60 de minute',
    '2_hours'                               => '2 ore',
    'manual_only'                           => 'Numai manual',

    'pos_max_cached_products'         => 'Nr. max. produse în cache',
    'pos_max_cached_products_tooltip' => 'Limita produselor stocate în cache',
    'pos_max_cached_products_help'    =>
        'Valori mai mari = acoperire mai bună, dar consumă memorie. „Nelimitat” = toate produsele.',
    'unlimited'                       => 'Nelimitat',

    // Loading messages
    'loading_products'                => 'Se încarcă produsele…',
    'please_wait_while_products_load' => 'Așteptați, se încarcă produsele',
    'loading_products_placeholder'    => 'Încărcare produse…',
    'updating_stock'                  => 'Actualizare stoc…',
    'failed_to_load_cache'            => 'Nu s-a putut încărca cache-ul. Funcțiile POS pot fi limitate.',

    // OTP Verification
    'otp_verification' => 'Verificare OTP',
    'otp_verification_management' => 'Gestionarea Verificării OTP',
    'manage_otp_verification_requests' => 'Gestionează cererile de verificare OTP și vizualizează statisticile',
    'active_otps' => 'OTP-uri Active',
    'unverified_users' => 'Utilizatori Neverificați',
    'expired_otps' => 'OTP-uri Expirate',
    'failed_attempts' => 'Încercări Eșuate',
    'pending_users' => 'Utilizatori în Așteptare',
    'today_requests' => 'Cereri de Astăzi',
    'high_retries' => 'Reîncercări Frecvente',
    'user_info' => 'Informații Utilizator',
    'otp_code' => 'Cod OTP',
    'attempts' => 'Încercări',
    'resend_count' => 'Număr de Retrimite',
    'no_active_otp' => 'Niciun OTP Activ',
    'expired' => 'Expirat',
    'active' => 'Activ',
    'expires_in' => 'Expiră în',
    'remaining' => 'rămase',
    'resends' => 'retrimite',
    'last' => 'Ultima',
    'updated' => 'Actualizat',
    'verify' => 'Verifică',
    'manual_verify_email' => 'Verificare Manuală Email',
    'reset_otp' => 'Resetare OTP',
    'manual_verify' => 'Verificare Manuală',
    'deactivate' => 'Dezactivează',
    
    // JavaScript messages
    'confirm_reset_otp' => 'Ești sigur că vrei să resetezi acest OTP? Utilizatorul va trebui să solicite unul nou.',
    'failed_to_reset_otp' => 'Resetarea OTP a eșuat',
    'error_resetting_otp' => 'A apărut o eroare la resetarea OTP',
    'confirm_verify_unverified_user' => 'Ești sigur că vrei să verifici manual email-ul pentru utilizatorul neverificat: :username?',
    'confirm_verify_user' => 'Ești sigur că vrei să verifici manual email-ul pentru utilizatorul: :username?',
    'user_verified_removed_from_list' => 'Email-ul utilizatorului a fost verificat - utilizatorul nu va mai apărea în lista celor neverificați',
    'failed_to_verify_user' => 'Verificarea utilizatorului a eșuat',
    'error_verifying_user' => 'A apărut o eroare la verificarea utilizatorului',
    'confirm_deactivate_token' => 'Ești sigur că vrei să dezactivezi acest token OTP?',
    'failed_to_deactivate_token' => 'Dezactivarea token-ului a eșuat',
    'error_deactivating_token' => 'A apărut o eroare la dezactivarea token-ului',

    // Session Management
    'session_management' => 'Gestionarea Sesiunilor',
    'manage_user_sessions' => 'Gestionează sesiunile utilizatorilor și securitatea',
    'total_sessions' => 'Total Sesiuni',
    'active_users' => 'Utilizatori Activi',
    'file_sessions' => 'Sesiuni Fișier',
    'database_sessions' => 'Sesiuni Bază de Date',
    'session_actions' => 'Acțiuni',
    'user_name' => 'Nume Utilizator',
    'device_info' => 'Informații Dispozitiv',
    'ip_address' => 'Adresa IP',
    'last_activity' => 'Ultima Activitate',
    'session_id' => 'ID Sesiune',
    'force_logout' => 'Forțează Deconectarea',
    'view_session_details' => 'Vezi Detaliile Sesiunii',
    'invalidate_all_sessions' => 'Invalidează Toate Sesiunile',
    'filter_by_user' => 'Filtrează după Utilizator',
    'filter_by_session_type' => 'Filtrează după Tipul Sesiunii',
    'all_session_types' => 'Toate Tipurile de Sesiuni',
    'confirm_force_logout' => 'Ești sigur că vrei să forțezi deconectarea acestei sesiuni? Utilizatorul va trebui să se conecteze din nou.',
    'confirm_invalidate_all' => 'Ești sigur că vrei să invalidezi toate sesiunile acestui utilizator? Toate sesiunile active vor fi închise.',
    'session_invalidated' => 'Sesiunea a fost invalidată cu succes',
    'all_sessions_invalidated' => 'Toate sesiunile utilizatorului au fost invalidate cu succes',
    'session_details' => 'Detaliile Sesiunii',
    'session_data' => 'Date Sesiune',
    'user_agent' => 'Agent Utilizator',
    'session_payload' => 'Conținut Sesiune',
    'created_at' => 'Creat la',
    'updated_at' => 'Actualizat la',
    'expires_at' => 'Expiră la',
    'session_driver' => 'Driver Sesiune',
    'unknown_device' => 'Dispozitiv Necunoscut',
    'unknown_browser' => 'Browser Necunoscut',
    'unknown_platform' => 'Platformă Necunoscută',
    'desktop' => 'Desktop',
    'mobile' => 'Mobil',
    'tablet' => 'Tabletă',
    'current_session' => 'Sesiunea Curentă',
    'other_sessions' => 'Alte Sesiuni',
    'session_location' => 'Locația Sesiunii',
    'refresh_sessions' => 'Reîmprospătează Sesiunile',
    'auto_refresh' => 'Reîmprospătare Automată',
    'manual_refresh' => 'Reîmprospătare Manuală',
    'bulk_actions' => 'Acțiuni în Grup',
    'select_all_sessions' => 'Selectează Toate Sesiunile',
    'logout_selected' => 'Deconectează Selecționate',
    'export_sessions' => 'Exportă Sesiunile',
    'session_statistics' => 'Statistici Sesiuni',
    'concurrent_sessions' => 'Sesiuni Simultane',
    'average_session_duration' => 'Durata Medie a Sesiunii',
    'peak_concurrent_users' => 'Vârful Utilizatorilor Simultani',
    'session_security' => 'Securitate Sesiuni',
    'suspicious_activity' => 'Activitate Suspectă',
    'multiple_ip_sessions' => 'Sesiuni de la IP-uri Multiple',
    'session_timeout' => 'Timeout Sesiune',
    'force_single_session' => 'Forțează o Singură Sesiune',
    'session_encryption' => 'Criptarea Sesiunii',
    'secure_session_only' => 'Doar Sesiuni Securizate',

    // Instant POS Button Strings
    'refresh_pos_cache' => 'Reîmprospătare Cache',
    'instant_pos_enabled' => 'POS Instantaneu Activat',
    'instant_pos_disabled' => 'POS Instantaneu Dezactivat',
    'disable_instant_pos' => 'Dezactivare POS Instant',
];
