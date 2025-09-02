<?php

return [

    'app_settings' => 'Applicatie-instellingen',
    'manage_app_settings' => 'Applicatie-instellingen beheren',
    'tab_2fa' => '2FA',
    'tab_theme' => 'Weergave',
    'tab_login_page' => 'Inlogpagina',
    'tab_sidebar' => 'Zijbalk',
    'tab_language' => 'Taal',
    'tab_repair_status' => 'Reparatiestatus',
    'tab_logo' => 'Logo',
    // Buttons
    'update_settings' => 'Instellingen bijwerken',

    'enable_custom_bg_image_for_login' => 'Aangepaste achtergrond voor inloggen inschakelen',
    'enable_custom_bg_image_for_login_tooltip' => 'Stel een aangepaste achtergrondafbeelding in voor de inlogpagina.',

    'enable_custom_sidebar_logo' => 'Aangepast zijbalklogo toestaan',
    'enable_custom_sidebar_logo_tooltip' => 'Sta bedrijven toe een aangepast logo in de zijbalk te gebruiken.',

    // language.blade.php
    'header_language_change' => 'Taal wijzigen in de kop',
    'header_language_change_tooltip' => 'Gebruikers toestaan om vanuit de hoofdkop de taal te wijzigen.',
    'header_languages_label' => 'Talen in de kop',
    'header_languages_label_tooltip' => 'Selecteer welke talen in de kop moeten worden weergegeven.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'Reparatiestatus weergeven op inlogscherm',

    // 2fa.blade.php
    'enable_2fa' => '2FA inschakelen',
    'enable_2fa_tooltip' => 'Schakel tweefactorauthenticatie (2FA) in voor de app.',

    'force_2fa' => '2FA verplichten',
    'force_2fa_tooltip' => 'Gebruikers moeten 2FA instellen voordat zij de app kunnen gebruiken.',

    'recommend_2fa' => '2FA aanbevelen',
    'recommend_2fa_tooltip' => 'Er verschijnt bij het inloggen eenmalig een venster om gebruikers aan te moedigen 2FA in te schakelen.',

    'allow_disable_2fa' => 'Tijdelijk uitschakelen van 2FA toestaan',
    'allow_disable_2fa_tooltip' => 'Sta gebruikers toe 2FA tijdelijk uit te schakelen tot een bepaalde tijd.',

    'disable_2fa_duration_label' => 'Duur van uitschakelen 2FA',
    'disable_2fa_duration_label_tooltip' => 'Bepaal de periode waarin 2FA uitgeschakeld kan blijven.',

    'disable_2fa_unit_label' => 'Eenheid voor uitschakelen 2FA',

    'force_2fa_after_date_label' => '2FA verplichten na datum',
    'force_2fa_after_date_label_tooltip' => 'Na deze datum moeten alle gebruikers 2FA inschakelen. Deze datum wordt ook getoond in het aanbevelingsvenster van 2FA.',

    'primary_color_label' => 'Primaire kleur',
    'primary_color_label_tooltip' => 'Selecteer de standaard primaire kleur voor de applicatie. Deze kleur wordt gebruikt door bedrijven die geen eigen themakleuren instellen.',
    'secondary_color_label' => 'Secundaire kleur',
    'secondary_color_label_tooltip' => 'Selecteer de standaard secundaire kleur voor de applicatie. Deze kleur wordt gebruikt door bedrijven die geen eigen themakleuren instellen.',

    'allow_theme_change' => 'Wijziging van thema toestaan',
    'allow_theme_change_tooltip' => 'Sta bedrijven toe hun eigen themakleuren aan te passen. Als ze geen kleuren instellen, zullen ze de standaardkleuren gebruiken zoals hier ingesteld door de superadmin.',

    'login_bg_image_label' => 'Achtergrondafbeelding voor inloggen',
    'login_bg_image_label_tooltip' => 'Door een nieuwe afbeelding te uploaden wordt de bestaande achtergrond vervangen.',

    'logo_dark_tooltip'  => 'Wijzig het standaard donkere logo van de applicatie, gebruikt in de lichte modus.',
    'logo_light_tooltip' => 'Wijzig het standaard lichte logo van de applicatie, gebruikt in de donkere modus.',
    'favicon_tooltip' => 'Aanbevolen afmetingen: 32×32 px. Dit pictogram verschijnt in browsertabbladen en bladwijzers.',
    'upload_favicon' => 'Favicon uploaden',

    // Fonts
    'tab_fonts' => 'Lettertypen',
    'english_font'            => 'Engels Lettertype',
    'arabic_font'             => 'Arabisch Lettertype',
    'custom_font_placeholder' => 'Voer een aangepaste lettertype naam in...',
    'select_font'             => 'Selecteer een lettertype...',
    'or'                      => 'of',
    'font_help_text'          => 'Kies uit de lijst of voer uw eigen lettertype in.',
    'english_font_tooltip'  => 'Voer een aangepaste lettertypenaam in of kies er een uit de lijst. Je kunt lettertypen vinden op: :url',
    'arabic_font_tooltip'   => 'Voer een aangepaste lettertypenaam in of kies er een uit de lijst. Je kunt lettertypen vinden op: :url',

    //Recaptcha:
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha'              => 'Google reCAPTCHA inschakelen',
    'enable_recaptcha_tooltip'      => 'Schakel in om reCAPTCHA-beveiliging te activeren. Haal uw sleutel en secret op bij: :url',
    'enable_recaptcha_text'         => 'reCAPTCHA inschakelen',
    'google_recaptcha_key'          => 'Google reCAPTCHA Site Key',
    'google_recaptcha_secret'       => 'Google reCAPTCHA Secret Key',
    'google_recaptcha_key_placeholder'    => 'Voer uw Google reCAPTCHA Site key in',
    'google_recaptcha_secret_placeholder' => 'Voer uw Google reCAPTCHA Secret Key in',
    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'Tweefactorauthenticatie inschakelen',
    'modal_enable_2fa_desc' => 'We raden aan om 2FA in te schakelen om de veiligheid van uw account te verbeteren.',
    'enable_now_button' => 'Nu inschakelen',
    'maybe_later_button' => 'Misschien later',
    'close_aria_label' => 'Sluiten',

    // 2FA Verify page
    'one_time_password_heading' => 'Eenmalig wachtwoord',
    'one_time_password_label' => 'Eenmalig wachtwoord',
    'enter_2fa_code_placeholder' => 'Voer 2FA-code in',
    'disable_2fa_for' => 'Schakel 2FA uit voor :duration :unit',
    'verify_button' => 'Verifiëren',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'Tweefactorauthenticatie (2FA)',
    'google_auth_app_desc' => 'Google Authenticator-app',
    'configured_status' => 'Geconfigureerd',
    'needs_configuration_status' => 'Moet worden geconfigureerd',
    'two_factor_scan_or_enter_msg' => 'Scan de QR-code met de Google Authenticator-app of voer de geheime sleutel handmatig in, en voer vervolgens de gegenereerde code in.',
    'your_secret_key_msg' => 'Uw geheime sleutel (als u deze handmatig moet invoeren):',

    // 2FA field labels
    'one_time_password_label' => 'Eenmalig wachtwoord',
    'enter_2fa_code_placeholder' => 'Voer 2FA-code in',
    '2fa_will_be_forced_after_date' => '2FA wordt verplicht na :date.',

    // Buttons
    '2fa' => '2FA',
    'verify_button' => 'Verifiëren',

    'confirm_access_recovery_codes' => 'Toegang Bevestigen',
    're_authenticate_message'       => 'U moet zich opnieuw authenticeren om Setup of 2FA-herstelcodes te bereiken.',
    'choose_method'                 => 'Kies een methode:',
    'one_time_password'             => 'Eenmalig wachtwoord (OTP)',
    'password'                      => 'Wachtwoord',
    'enter_code_or_password'        => 'Voer code / wachtwoord in:',
    'confirm'                       => 'Bevestigen',

    '2fa_recovery_codes'           => '2FA-herstelcodes',
    'recovery_codes_description'   => 'Met deze codes kunt u inloggen als u de toegang tot uw authenticatie-app verliest. Elke code kan slechts één keer worden gebruikt.',
    'regenerate_codes'             => 'Codes opnieuw genereren',
    'copy'                         => 'Kopiëren',
    'copy_all'                     => 'Alles kopiëren',
    'no_recovery_codes_available'  => 'Er zijn geen herstelcodes beschikbaar. U kunt hieronder nieuwe codes genereren.',
    'copied'                       => 'Code naar klembord gekopieerd!',
    'all_codes_copied'             => 'Alle herstelcodes zijn gekopieerd naar het klembord!',
    'supported_app'                => 'Ondersteunde apps',
    'supported_apps' => [
        'Authy' => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP' => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator' => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator' => ['Windows Phone'],
        'LastPass Authenticator' => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password' => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    //social logins:
    'social_login_settings'       => 'Instellingen voor social login',
    'social_login_settings_help'  => 'Voer uw social login-gegevens in.',
    'client_id'                   => 'Client-ID',
    'client_secret'               => 'Client-Secret',
    'redirect_url'                => 'Redirect-URL',
    'enter_client_id'             => 'Voer :provider Client ID in',
    'enter_client_secret'         => 'Voer :provider Client Secret in',
    'enter_redirect_url'          => 'Voer :provider Redirect URL in',
    'enable_social_login'         => 'Social Login inschakelen',
    'tab_social'                  => 'Social Logins',
    'or_login_with'               => 'Of inloggen met',
    'force_otp_after_social_login' => 'OTP verplichten na Social Login',
    'force_otp_after_social_login_tooltip' => 'Als dit is ingeschakeld, moeten gebruikers die inloggen met social accounts een OTP verifiëren.',

    //Lock Users:
    'locked_until' => 'Vergrendeld tot',
    'locked_users' => 'Vergrendelde gebruikers',
    'view_locked_users' => 'Vergrendelde gebruikers bekijken',
    'tab_login_security' => 'Login-beveiliging',
    'unlock' => 'Deblokkeren',
    'enable_user_lock_label' => 'Gebruikersvergrendeling inschakelen',
    'enable_user_lock_tooltip' => 'Gebruikersvergrendeling in-/uitschakelen na mislukte inlogpogingen.',
    'max_login_attempts_label' => 'Maximaal aantal inlogpogingen',
    'max_login_attempts_tooltip' => 'Aantal toegestane pogingen voordat een gebruiker wordt vergrendeld.',
    'lock_duration_label' => 'Vergrendelingsduur',
    'lock_duration_tooltip' => 'Hoelang (in cijfers) de gebruiker wordt vergrendeld.',
    'lock_duration_unit_label' => 'Eenheid voor vergrendelingsduur',
    'lock_duration_unit_tooltip' => 'Kies de tijdeenheid voor vergrendeling: minuten, uren, dagen, enz.',
    'account_locked_for_time_unit' => 'Uw account is vergrendeld voor :time :unit.',
    'user_unlocked_message' => 'Gebruiker succesvol gedeblokkeerd!',

    //Verify email:
    'verify_email_address_title' => 'Verifieer uw e-mailadres',
    'fresh_verification_sent' => 'Er is een nieuwe verificatielink naar uw e-mailadres verzonden.',
    'verify_email_before_proceeding' => 'Controleer uw e-mail op een verificatielink voordat u verdergaat.',
    'did_not_receive_email' => 'Als u de e-mail niet hebt ontvangen',
    'click_here_request_another' => 'klik hier om een nieuwe aan te vragen',
    'logout' => 'Uitloggen',
    'force_email_verify' => 'Verplicht e-mailverificatie',
    'force_email_verify_tooltip' => 'Als dit is ingeschakeld, moeten gebruikers hun e-mailadres verifiëren voordat ze toegang tot het systeem krijgen.',

    // Reset Mapping
    'reset_purchase_sell_mapping'     => 'Reset aankoop-verkoop mapping',
    'select_business'                 => 'Selecteer bedrijf:',
    'all_businesses'                  => 'Alle bedrijven',
    'chunk_size'                      => 'Chunkgrootte:',
    'reset_mapping'                   => 'Mapping resetten',
    'purchase_sell_mismatch_tooltip'  => 'Kies welke bedrijfs-mappings gereset moeten worden. Bij grote databases raden we aan per bedrijf te resetten.',
    'chunk_size_tooltip'              => 'De mapping wordt in kleinere delen gereset. Voor grote datasets kiest u een geschikte chunkgrootte. Actieve onderhoudsmodus aanbevolen.',

    // Maintenance Mode
    'tab_maintenance_mode'            => 'Onderhoudsmodus',
    'maintenance_mode'                => 'Onderhoudsmodus',
    'maintenance_mode_tooltip'        => 'Zet de applicatie in onderhoudsmodus (bezoekers zien dan het onderhoudsscherm).',
    'enable_countdown'                => 'Countdown inschakelen',
    'enable_timer_tooltip'            => 'Toon een live aftelklok tot het einde van de onderhoudsperiode.',
    'maintenance_duration'            => 'Duur',
    'maintenance_unit'                => 'Tijdeenheid',
    'minutes'                         => 'Minuten',
    'hours'                           => 'Uren',
    'days'                            => 'Dagen',

    // Maintenance page
    'under_maintenance'               => 'Onderhoud',
    'maintenance_heading'             => 'We voeren onderhoud uit.',
    'maintenance_subheading'          => 'Bedankt voor uw geduld!',
    'maintenance_back_in'             => 'We zijn terug over :time',
    'maintenance_back_no_timer'       => 'We zijn terug zodra het onderhoud is voltooid.',

    // Mapping reset page
    'mapping_reset_progress'          => 'Voortgang mapping-reset',
    'mapping_reset_in_progress'       => 'Mapping-reset in uitvoering',
    'batch_status'                    => 'Batchstatus',
    'refresh_status'                  => 'Status vernieuwen',

    // Mapping reset result & status
    'mapping_reset_result'            => 'Resultaat mapping-reset',
    'chunk_processing_status'         => 'Status verwerking chunks',

    // Table headers
    'business'                        => 'Bedrijf',
    'chunk_status'                    => 'Chunkstatus',
    'total_chunks'                    => 'Totaal aantal chunks',
    'status'                          => 'Status',

    // Button
    'go_back'                         => 'Ga terug',

    // Mapping Jobs
    'processed_jobs'                  => 'Mappingtaken',
    'processed_jobs_subtitle'         => 'Alle verzonden mappingbatches',
    'uuid'                            => 'Batch-UUID',
    'job_name'                        => 'Taaknaam',
    'chunk_size'                      => 'Chunkgrootte',
    'completed_chunks'                => 'Verwerkte chunks',
    'total_chunks'                    => 'Totaal aantal chunks',
    'started_at'                      => 'Gestart op',
    'finished_at'                     => 'Laatst bijgewerkt',
    'all_businesses'                  => 'Alle bedrijven',
    'view_rebuild_jobs'               => 'Bekijk voorraad-rebuildtaken',

    // Detailed instruction
    'reset_mapping_instruction'       =>
        "Het wordt aanbevolen uw queue-driver in te stellen op een echte backend:\n"
        . "→ Stel in uw .env-bestand `QUEUE_CONNECTION=database` in.\n\n"
        . "Schakel tijdens de mapping ook de onderhoudsmodus in "
        . "(Applicatie-instellingen → Onderhoudsmodus) om dubbele of missende data te voorkomen.\n\n"
        . "Bij grote databases duurt resetten langer—overweeg per bedrijf te resetten.\n\n"
        . "Vooraf:\n"
        . "• Maak een volledige back-up van de database.\n"
        . "• Bewaak het proces via logs om eventuele fouten te detecteren.",

    'recovery_codes_generated_successfully' => 'Herstelcodes succesvol gegenereerd',

    // Disposable-email sync
    'sync_disposable_list'             => 'Synchroniseer disposable-e-maillijst',
    'sync_disposable_success'          => 'Disposable-e-maillijst bijgewerkt.',
    'sync_disposable_failed'           => 'Synchronisatie disposable-e-maillijst mislukt.',

    // Temporary-email protection
    'temp_email_protection'            => 'Blokkeer tijdelijke e-mailadressen',
    'temp_email_protection_tooltip'    => 'Blokkeer tijdelijke/wegwerp e-maildomeinen (bijv. Mailinator, 10MinuteMail).',
    'disposable_not_allowed'           => 'Tijdelijke e-mailadressen zijn niet toegestaan.',
    // 3.3
    'enable_sidebar_dropdown'         => 'Sidebar-dropdown inschakelen',
    'enable_sidebar_dropdown_tooltip' => 'Vouw sub-menu’s samen tot een aanklikbare dropdown in de sidebar.',
    // Custom Menu
    'menu'               => 'Menu',
    'menus_heading'      => 'Menu’s',
    'menus_description'  => 'Beheer en organiseer je menu-items.',
    'add_menu_item'      => 'Menu-item toevoegen',
    'save_menu'          => 'Menu opslaan',
    'label'              => 'Label',
    'parent'             => 'Bovenliggend',
    'icon_type'          => 'Icontype',
    'svg'                => 'SVG',
    'fontawesome'        => 'FontAwesome',
    'svg_icon'           => 'SVG-icoon',
    'fa_class'           => 'FA-klasse',
    'named_route'        => 'Genoemde route',
    'absolute_url'       => 'Absolute URL',
    'permission'         => 'Permissie',
    'module_flag'        => 'Module-vlag',
    'sort_order'         => 'Sorteervolgorde',
    'active'             => 'Actief?',
    'apply'              => 'Toepassen',
    'add_menu'           => 'Menu toevoegen',
    'inactive'           => 'Inactief',
    'flush_cache'        => 'Cache legen',
    'reset_menu'         => 'Resetten',
    'custom_menu'        => 'Aangepast sidebar-menu',

    'rebuilt_successfully' => 'Succesvol opnieuw opgebouwd',

    'sidebar_layout'        => 'Sidebar-layout',
    'sidebar_layout_1'      => 'Layout 1 (Klassiek)',
    'sidebar_layout_2'      => 'Layout 2 (Compact)',
    'sidebar_layout_custom' => 'Aangepaste layout',

    'custom_sidebar_type'   => 'Aangepast sidebartype',
    'sidebar'               => 'Sidebar',
    'topbar'                => 'Topbar',

    'tab_business_settings'    => 'Bedrijfsinstellingen',
    'business_settings_layout' => 'Layout bedrijfsinstellingen',
    'layout_1'                => 'Layout 1 – Klassieke tabbladen',
    'layout_2'                => 'Layout 2 – Moderne sidebar',

    // Themes
    'predefined_theme_label'   => 'Vooraf ingestelde thema’s',
    'predefined_theme_tooltip' => 'Kies een kant-en-klare kleurenpalet.',
    'select_theme'             => 'Selecteer thema',
    'theme_default'            => 'Standaard',

    // Migration Data
    'app_settings'         => 'App-instellingen',
    'application_settings' => 'Applicatie-instellingen',
    'storage_migration'    => 'Storage-migratie',
    'manage_uploads_data'  => 'Beheer je upload-gegevens',

    'push'  => 'push',
    'pull'  => 'pull',
    'local' => 'lokaal',
    'external_disk' => 'externe schijf',
    'duplicate_files_skipped_safe_to_resume'
        => 'Dubbele bestanden overgeslagen. Je kunt veilig opnieuw uitvoeren om te hervatten.',

    'direction'              => 'Richting',
    'push_local_to_external' => 'push (lokaal → extern)',
    'pull_external_to_local' => 'pull (extern → lokaal)',

    'from_disk' => 'Van schijf',
    'to_disk'   => 'Naar schijf',

    'destination_visibility'        => 'Zichtbaarheid doel',
    'visibility_none_bucket_signed' => '(geen / bucket-beleid / ondertekende URL’s)',
    'visibility_public_acl'         => 'publiek (object-ACL)',
    'visibility_private_acl'        => 'privé (object-ACL)',

    'folders_to_include_optional' => 'Mappen om op te nemen (optioneel)',
    'folders_include_tooltip'     => 'Laat leeg om alle mappen onder uploads op te nemen.',
    'select_all'                  => 'Alles selecteren',
    'none'                        => 'Geen',
    'invert'                      => 'Omkeren',
    'no_suggestions_found'        => 'Geen suggesties gevonden.',

    'delete_source_after_copy' => 'Bron verwijderen na succesvol kopiëren (verplaatsen)',
    'dry_run_plan_only'        => 'Testuitvoering (alleen plan)',
    'verbose_log_messages'     => 'Uitgebreid (logdetails in status)',

    'execution'                    => 'Uitvoering',
    'execution_tooltip_html'
        => 'Gebruik <strong>Direct</strong> alleen voor kleine verplaatsingen (bijv. < 1000 bestanden). Voor 5–10 GB is een achtergrondtaak beter.',
    'pick_how_to_execute'          => 'Kies hoe je de migratie wilt uitvoeren.',
    'background_job_recommended'   => 'Achtergrondtaak (aanbevolen)',
    'run_direct_now'               => 'Direct uitvoeren',

    'start_migration' => 'Migratie starten',
    'reset'           => 'Reset',

    'progress' => 'Voortgang',
    'result'   => 'Resultaat',

    // JS strings
    'from'                    => 'Van',
    'to'                      => 'Naar',
    'folders'                 => 'Mappen',
    'total'                   => 'Totaal',
    'copied'                  => 'Gekopieerd',
    'skipped'                 => 'Overgeslagen',
    'deleted'                 => 'Verwijderd',
    'failed'                  => 'Mislukt',
    'invalid_response'        => 'Ongeldig antwoord',
    'failed_to_start_migration'=> 'Starten van migratie mislukt',
    'confirm_delete_source'
        => 'Weet je zeker dat je de bron na kopiëren wilt VERWIJDEREN? Dit kan niet ongedaan worden gemaakt.',

    'default_storage_disk'      => 'Standaard storage-schijf',
    'default_storage_disk_help'
        => 'Waar nieuwe bestanden standaard worden opgeslagen. "public" = storage/app/public via /storage-symlink. "local" = public/uploads.',

    's3_compatible_settings'     => 'S3-compatibele instellingen',
    'display_label_optional'     => 'Weergavelabel (optioneel)',
    'placeholder_my_s3_provider' => 'Mijn S3-provider',
    'display_only_admin_ui'      => 'Alleen zichtbaar in de admin-UI.',
    'access_key'                 => 'Access-key',
    'secret_key'                 => 'Secret-key',
    'region'                     => 'Regio',
    'bucket'                     => 'Bucket',
    'endpoint'                   => 'Endpoint',
    'cdn_or_custom_domain_optional' => 'CDN / Eigen domein (optioneel)',

    'disable_http_verify'      => 'TLS-verificatie uitschakelen',
    'disable_http_verify_help' => 'Uit = TLS actief. Aan = uitschakelen (alleen lokaal voor testen).',

    'path_style_endpoint' => 'Path-style endpoint',

    'use_signed_urls'      => 'Ondertekende URL’s gebruiken (bucket privé)',
    'use_signed_urls_help' => 'Uit = publieke URL’s. Aan = privé met ondertekende URL’s.',

    'signed_url_ttl_minutes' => 'TTL ondertekende URL (minuten)',
    'tab_storage_settings'   => 'Storage',
    'syncing'               => 'Synchroniseren…',

    // POS Settings
    'pos_performance_settings'   => 'POS-prestatie-instellingen',
    'enable_instant_pos'         => 'Instant POS inschakelen',
    'enable_instant_pos_tooltip' => 'Voegt producten direct toe zonder AJAX-calls voor betere performance',
    'enable_instant_pos_help'
        => 'Wanneer ingeschakeld, worden producten direct via cache toegevoegd in plaats van via serververzoeken.',

    'enable_instant_search'            => 'Instant zoeken inschakelen',
    'enable_instant_search_tooltip'    => 'Zoekt direct via cache in plaats van AJAX',
    'enable_instant_search_help'       => 'Wanneer ingeschakeld, verschijnen zoekresultaten onmiddellijk zonder serververzoek.',

    'pos_performance_info_title' => 'Prestatie-verbetering',
    'pos_performance_info_desc'
        => 'Instant POS verbetert de performance aanzienlijk door minder serververzoeken:',
    'instant_pos_benefit_1'      => 'Producten worden direct toegevoegd zonder wachttijd',
    'instant_pos_benefit_2'      => 'Zoekresultaten verschijnen meteen tijdens het typen',
    'instant_pos_benefit_3'      => 'Voorraad niveaus worden automatisch bijgewerkt na elke verkoop',
    'instant_pos_benefit_4'      => 'Werkt offline-first en synchroniseert later met de server',

    'pos_cache_settings'                    => 'POS-cache-instellingen',
    'pos_cache_refresh_interval'            => 'Cache-refresh-interval',
    'pos_cache_refresh_interval_tooltip'    => 'Hoe vaak de productcache wordt vernieuwd',
    'pos_cache_refresh_interval_help'       => 'Automatisch na elke verkoop; handmatige intervallen als back-up',
    'auto_refresh'                          => 'Auto (na verkoop)',
    '30_minutes'                            => '30 minuten',
    '60_minutes'                            => '60 minuten',
    '2_hours'                               => '2 uur',
    'manual_only'                           => 'Alleen handmatig',

    'pos_max_cached_products'         => 'Max gecachte producten',
    'pos_max_cached_products_tooltip' => 'Maximum aantal producten in cache voor directe toegang',
    'pos_max_cached_products_help'
        => 'Hoger getal = betere dekking maar meer geheugen. Kies “Onbeperkt” om alles te cachen.',
    'unlimited'                       => 'Onbeperkt',

    // Loading messages
    'loading_products'                => 'Producten laden…',
    'please_wait_while_products_load' => 'Even geduld, producten worden geladen',
    'loading_products_placeholder'    => 'Producten laden…',
    'updating_stock'                  => 'Voorraad bijwerken…',
    'failed_to_load_cache'            => 'Productcache laden mislukt. POS-functionaliteit kan beperkt zijn.',

    // OTP Verification
    'otp_verification' => 'OTP-verificatie',
    'otp_verification_management' => 'OTP-verificatiebeheer',
    'manage_otp_verification_requests' => 'Beheer OTP-verificatieverzoeken en bekijk statistieken',
    'active_otps' => 'Actieve OTPs',
    'unverified_users' => 'Niet-geverifieerde gebruikers',
    'expired_otps' => 'Verlopen OTPs',
    'failed_attempts' => 'Mislukte pogingen',
    'pending_users' => 'Wachtende gebruikers',
    'today_requests' => 'Verzoeken van vandaag',
    'high_retries' => 'Veel herhalingen',
    'user_info' => 'Gebruikersinformatie',
    'otp_code' => 'OTP-code',
    'attempts' => 'Pogingen',
    'resend_count' => 'Aantal herverzendingen',
    'no_active_otp' => 'Geen actieve OTP',
    'expired' => 'Verlopen',
    'active' => 'Actief',
    'expires_in' => 'Verloopt over',
    'remaining' => 'resterend',
    'resends' => 'herverzendingen',
    'last' => 'Laatste',
    'updated' => 'Bijgewerkt',
    'verify' => 'Verifiëren',
    'manual_verify_email' => 'Handmatige e-mailverificatie',
    'reset_otp' => 'OTP opnieuw instellen',
    'manual_verify' => 'Handmatige verificatie',
    'deactivate' => 'Deactiveren',

    // JavaScript messages
    'confirm_reset_otp' => 'Weet je zeker dat je deze OTP wilt resetten? De gebruiker moet een nieuwe aanvragen.',
    'failed_to_reset_otp' => 'OTP resetten mislukt',
    'error_resetting_otp' => 'Fout opgetreden bij het resetten van OTP',
    'confirm_verify_unverified_user' => 'Weet je zeker dat je de e-mail handmatig wilt verifiëren voor niet-geverifieerde gebruiker: :username?',
    'confirm_verify_user' => 'Weet je zeker dat je de e-mail handmatig wilt verifiëren voor gebruiker: :username?',
    'user_verified_removed_from_list' => 'Gebruikers-e-mail geverifieerd - gebruiker zal niet meer in niet-geverifieerde lijst verschijnen',
    'failed_to_verify_user' => 'Gebruiker verifiëren mislukt',
    'error_verifying_user' => 'Fout opgetreden bij het verifiëren van gebruiker',
    'confirm_deactivate_token' => 'Weet je zeker dat je dit OTP-token wilt deactiveren?',
    'failed_to_deactivate_token' => 'Token deactiveren mislukt',
    'error_deactivating_token' => 'Fout opgetreden bij het deactiveren van token',

    // Session Management
    'session_management' => 'Sessiebeheer',
    'manage_user_sessions_and_authentication' => 'Beheer gebruikerssessies en authenticatie',
    'all_users' => 'Alle Gebruikers',
    'active_users' => 'Actieve Gebruikers',
    'locked_users' => 'Vergrendelde Gebruikers',
    'disabled_logins' => 'Uitgeschakelde Logins',
    'active_sessions' => 'Actieve Sessies',
    'unique_users' => 'Unieke Gebruikers',
    'active_businesses' => 'Actieve Bedrijven',
    'inactive_businesses' => 'Inactieve Bedrijven',
    'user_info' => 'Gebruikersinfo',
    'session_info' => 'Sessie-info',
    'force_logout' => 'Geforceerde Uitlog',
    'lock_user' => 'Gebruiker Vergrendelen',
    'unlock_user' => 'Gebruiker Ontgrendelen',
    'lock_user_account' => 'Gebruikersaccount Vergrendelen',
    'lock_duration' => 'Vergrendelingsduur',
    'user_will_be_locked_for_selected_duration' => 'Gebruiker wordt vergrendeld voor de geselecteerde duur',
    'minutes' => 'minuten',
    'hour' => 'uur',
    'hours' => 'uren',
    'deactivate_user' => 'Gebruiker Deactiveren',
    'activate_user' => 'Gebruiker Activeren',
    'block_login' => 'Login Blokkeren',
    'allow_login' => 'Login Toestaan',
    'deactivate_business' => 'Bedrijf Deactiveren',
    'activate_business' => 'Bedrijf Activeren',
    'login_allowed' => 'Login Toegestaan',
    'login_blocked' => 'Login Geblokkeerd',
    'temporary_lock' => 'Tijdelijke Vergrendeling',
    'user_locked_successfully' => 'Gebruiker vergrendeld voor :duration minuten',
    'user_unlocked_successfully' => 'Gebruiker succesvol ontgrendeld',
    'user_activated_successfully' => 'Gebruiker succesvol geactiveerd',
    'user_deactivated_successfully' => 'Gebruiker succesvol gedeactiveerd',
    'login_permission_granted' => 'Login toestemming verleend',
    'login_permission_revoked' => 'Login toestemming ingetrokken',
    'business_activated_successfully' => 'Bedrijf succesvol geactiveerd',
    'business_deactivated_successfully' => 'Bedrijf succesvol gedeactiveerd',
    'user_logged_out_successfully' => 'Gebruiker succesvol uitgelogd',
    'failed_to_lock_user' => 'Gebruiker vergrendelen mislukt',
    'failed_to_unlock_user' => 'Gebruiker ontgrendelen mislukt',
    'failed_to_update_user_status' => 'Gebruikersstatus bijwerken mislukt',
    'failed_to_update_login_permission' => 'Login toestemming bijwerken mislukt',
    'failed_to_update_business_status' => 'Bedrijfsstatus bijwerken mislukt',
    'failed_to_logout_user' => 'Gebruiker uitloggen mislukt',
    'error_locking_user' => 'Fout bij vergrendelen gebruiker',
    'error_unlocking_user' => 'Fout bij ontgrendelen gebruiker',
    'error_updating_user_status' => 'Fout bij bijwerken gebruikersstatus',
    'error_updating_login_permission' => 'Fout bij bijwerken login toestemming',
    'error_updating_business_status' => 'Fout bij bijwerken bedrijfsstatus',
    'error_logging_out_user' => 'Fout bij uitloggen gebruiker',
    'confirm_force_logout' => 'Weet je zeker dat je gebruiker wilt uitloggen: :username?',
    'confirm_lock_user' => 'Weet je zeker dat je gebruiker wilt vergrendelen: :username voor :duration minuten?',
    'confirm_unlock_user' => 'Weet je zeker dat je gebruiker wilt ontgrendelen: :username?',
    'confirm_toggle_user_status' => 'Weet je zeker dat je gebruiker wilt :action: :username?',
    'confirm_toggle_login_permission' => 'Weet je zeker dat je :action wilt voor gebruiker: :username?',
    'confirm_toggle_business_status' => 'Weet je zeker dat je bedrijf wilt :action: :business?',
    'activate' => 'activeren',
    'deactivate' => 'deactiveren',
    
    // Instant POS Button Strings
    'refresh_pos_cache' => 'Cache Vernieuwen',
    'instant_pos_enabled' => 'Instant POS Ingeschakeld',
    'instant_pos_disabled' => 'Instant POS Uitgeschakeld',
    'disable_instant_pos' => 'Directe POS Uitschakelen',
];
