<?php

return [
    'app_settings' => 'Anwendungseinstellungen',
    'manage_app_settings' => 'Anwendungseinstellungen verwalten',
    'tab_2fa' => '2FA',
    'tab_theme' => 'Design',
    'tab_login_page' => 'Login-Seite',
    'tab_sidebar' => 'Seitenleiste',
    'tab_language' => 'Sprache',
    'tab_repair_status' => 'Reparaturstatus',
    'tab_logo' => 'Logo',
    // Buttons
    'update_settings' => 'Einstellungen aktualisieren',

    'enable_custom_bg_image_for_login' => 'Benutzerdefinierten Hintergrund für Login aktivieren',
    'enable_custom_bg_image_for_login_tooltip' => 'Ein benutzerdefiniertes Hintergrundbild für die Login-Seite festlegen.',

    'enable_custom_sidebar_logo' => 'Benutzerdefiniertes Seitenleisten-Logo erlauben',
    'enable_custom_sidebar_logo_tooltip' => 'Erlaubt es Unternehmen, ein eigenes Logo in der Seitenleiste zu verwenden.',

    // language.blade.php
    'header_language_change' => 'Sprachwechsel in der Kopfzeile',
    'header_language_change_tooltip' => 'Ermöglicht Benutzern das Umschalten der Sprache in der Hauptkopfzeile.',
    'header_languages_label' => 'Sprachen in der Kopfzeile',
    'header_languages_label_tooltip' => 'Wählen Sie aus, welche Sprachen in der Kopfzeile angezeigt werden sollen.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'Reparaturstatus auf dem Login-Bildschirm anzeigen',

    // 2fa.blade.php
    'enable_2fa' => '2FA aktivieren',
    'enable_2fa_tooltip' => 'Zweistufige Authentifizierung (2FA) für die Anwendung aktivieren.',

    'force_2fa' => '2FA erzwingen',
    'force_2fa_tooltip' => 'Benutzer müssen 2FA einrichten, bevor sie die Anwendung verwenden können.',

    'recommend_2fa' => '2FA empfehlen',
    'recommend_2fa_tooltip' => 'Beim Login erscheint einmalig ein Hinweisfenster, das Benutzer zur Aktivierung von 2FA auffordert.',

    'allow_disable_2fa' => 'Vorübergehendes Deaktivieren von 2FA erlauben',
    'allow_disable_2fa_tooltip' => 'Erlaubt Benutzern, 2FA für einen festgelegten Zeitraum vorübergehend zu deaktivieren.',

    'disable_2fa_duration_label' => 'Dauer der Deaktivierung von 2FA',
    'disable_2fa_duration_label_tooltip' => 'Legen Sie den Zeitraum fest, in dem 2FA deaktiviert bleiben kann.',

    'disable_2fa_unit_label' => 'Einheit für Dauer der 2FA-Deaktivierung',

    'force_2fa_after_date_label' => '2FA nach einem bestimmten Datum erzwingen',
    'force_2fa_after_date_label_tooltip' => 'Nach diesem Datum müssen alle Benutzer 2FA aktivieren. Dieses Datum wird auch im Empfehlungshinweis für 2FA angezeigt.',

    'primary_color_label' => 'Primärfarbe',
    'primary_color_label_tooltip' => 'Wählen Sie die Standard-Primärfarbe der Anwendung. Sie wird für Unternehmen verwendet, die keine eigenen Farben festlegen.',
    'secondary_color_label' => 'Sekundärfarbe',
    'secondary_color_label_tooltip' => 'Wählen Sie die Standard-Sekundärfarbe der Anwendung. Sie wird für Unternehmen verwendet, die keine eigenen Farben festlegen.',

    'allow_theme_change' => 'Designänderung erlauben',
    'allow_theme_change_tooltip' => 'Ermöglicht Unternehmen die Anpassung eigener Designfarben. Haben sie keine eigenen Farben, verwenden sie die hier festgelegten Standardfarben.',

    'login_bg_image_label' => 'Login-Hintergrundbild',
    'login_bg_image_label_tooltip' => 'Durch das Hochladen eines neuen Bildes wird das aktuelle Hintergrundbild ersetzt.',

    'logo_dark_tooltip'  => 'Ändern Sie das dunkle Standardlogo der Anwendung (wird im hellen Modus genutzt).',
    'logo_light_tooltip' => 'Ändern Sie das helle Standardlogo der Anwendung (wird im dunklen Modus genutzt).',
    'favicon_tooltip' => 'Empfohlene Abmessungen: 32×32 px. Dieses Symbol wird in Browser-Tabs und Lesezeichen angezeigt.',
    'upload_favicon' => 'Favicon hochladen',

    // Fonts
    'tab_fonts' => 'Schriftarten',
    'english_font' => 'Englische Schriftart',
    'arabic_font' => 'Arabische Schriftart',
    'custom_font_placeholder' => 'Geben Sie einen benutzerdefinierten Schriftartnamen ein...',
    'select_font' => 'Schriftart auswählen...',
    'or' => 'oder',
    'font_help_text' => 'Wählen Sie aus der Liste oder geben Sie Ihre eigene Schriftart ein.',
    'english_font_tooltip' => 'Geben Sie einen benutzerdefinierten Schriftartnamen ein oder wählen Sie eine Schriftart aus der Liste. Schriftartnamen finden Sie unter :url',
    'arabic_font_tooltip' => 'Geben Sie einen benutzerdefinierten Schriftartnamen ein oder wählen Sie eine Schriftart aus der Liste. Schriftartnamen finden Sie unter :url',

    //Recaptcha:
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha' => 'Google reCAPTCHA aktivieren',
    'enable_recaptcha_tooltip' => 'Umschalten, um den reCAPTCHA-Schutz zu aktivieren. Site-Key und Secret von :url beziehen.',
    'enable_recaptcha_text' => 'reCAPTCHA aktivieren',
    'google_recaptcha_key' => 'Google reCAPTCHA Site-Key',
    'google_recaptcha_secret' => 'Google reCAPTCHA Secret-Key',
    'google_recaptcha_key_placeholder' => 'Geben Sie Ihren Google reCAPTCHA Site-Key ein',
    'google_recaptcha_secret_placeholder' => 'Geben Sie Ihren Google reCAPTCHA Secret-Key ein',

    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'Zweistufige Authentifizierung aktivieren',
    'modal_enable_2fa_desc' => 'Wir empfehlen, 2FA zu aktivieren, um die Sicherheit Ihres Kontos zu erhöhen.',
    'enable_now_button' => 'Jetzt aktivieren',
    'maybe_later_button' => 'Vielleicht später',
    'close_aria_label' => 'Schließen',

    // 2FA Verify page
    'one_time_password_heading' => 'Einmaliges Passwort',
    'one_time_password_label' => 'Einmaliges Passwort',
    'enter_2fa_code_placeholder' => 'Geben Sie den 2FA-Code ein',
    'disable_2fa_for' => '2FA für :duration :unit deaktivieren',
    'verify_button' => 'Überprüfen',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'Zweistufige Authentifizierung (2FA)',
    'google_auth_app_desc' => 'Google Authenticator-App',
    'configured_status' => 'Eingerichtet',
    'needs_configuration_status' => 'Nicht eingerichtet',
    'two_factor_scan_or_enter_msg' => 'Scannen Sie den QR-Code mit der Google Authenticator-App oder geben Sie den geheimen Schlüssel manuell ein und anschließend den generierten Code.',
    'your_secret_key_msg' => 'Ihr geheimer Schlüssel (für manuelle Eingabe, falls erforderlich):',

    // 2FA field labels
    'one_time_password_label' => 'Einmaliges Passwort',
    'enter_2fa_code_placeholder' => 'Geben Sie den 2FA-Code ein',
    '2fa_will_be_forced_after_date' => '2FA wird nach dem :date erzwungen.',

    // Buttons
    '2fa' => '2FA',
    'verify_button' => 'Überprüfen',

    'confirm_access_recovery_codes' => 'Zugang bestätigen',
    're_authenticate_message' => 'Sie müssen sich erneut authentifizieren, um auf Einstellungen oder 2FA-Wiederherstellungscodes zuzugreifen.',
    'choose_method' => 'Methode auswählen:',
    'one_time_password' => 'Einmaliges Passwort (OTP)',
    'password' => 'Passwort',
    'enter_code_or_password' => 'Code / Passwort eingeben:',
    'confirm' => 'Bestätigen',

    '2fa_recovery_codes' => '2FA-Wiederherstellungscodes',
    'recovery_codes_description' => 'Mit diesen Codes können Sie sich anmelden, falls Sie den Zugriff auf Ihre Authenticator-App verlieren. Jeder Code kann nur einmal verwendet werden.',
    'regenerate_codes' => 'Codes neu generieren',
    'copy' => 'Kopieren',
    'copy_all' => 'Alle kopieren',
    'no_recovery_codes_available' => 'Keine Wiederherstellungscodes verfügbar. Sie können unten neue Codes erstellen.',
    'copied' => 'Code in die Zwischenablage kopiert!',
    'all_codes_copied' => 'Alle Wiederherstellungscodes wurden kopiert!',
    'supported_app' => 'Unterstützte Apps',
    'supported_apps' => [
        'Authy' => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP' => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator' => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator' => ['Windows Phone'],
        'LastPass Authenticator' => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password' => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    // Social logins:
    'social_login_settings' => 'Einstellungen für Social Logins',
    'social_login_settings_help' => 'Geben Sie Ihre Anmeldedaten für Social Logins ein.',
    'client_id' => 'Client-ID',
    'client_secret' => 'Client-Secret',
    'redirect_url' => 'Weiterleitungs-URL (Redirect URL)',
    'enter_client_id' => 'Geben Sie die Client-ID für :provider ein',
    'enter_client_secret' => 'Geben Sie das Client-Secret für :provider ein',
    'enter_redirect_url' => 'Geben Sie die Weiterleitungs-URL für :provider ein',
    'enable_social_login' => 'Social Login aktivieren',
    'tab_social' => 'Social Logins',
    'or_login_with' => 'Oder anmelden mit',
    'force_otp_after_social_login' => 'OTP nach Social Login erzwingen',
    'force_otp_after_social_login_tooltip' => 'Wenn aktiviert, müssen Benutzer, die sich über Social Logins anmelden, einen Einmalcode (OTP) eingeben.',

    //Lock Users:
    'locked_until' => 'Gesperrt bis',
    'locked_users' => 'Gesperrte Benutzer',
    'view_locked_users' => 'Gesperrte Benutzer anzeigen',
    'tab_login_security' => 'Login-Sicherheit',
    'unlock' => 'Entsperren',
    'enable_user_lock_label' => 'Benutzersperre aktivieren',
    'enable_user_lock_tooltip' => 'Aktivieren/deaktivieren der Benutzersperre nach fehlgeschlagenen Login-Versuchen.',
    'max_login_attempts_label' => 'Maximale Login-Versuche',
    'max_login_attempts_tooltip' => 'Anzahl der Versuche, die erlaubt sind, bevor ein Benutzer gesperrt wird.',
    'lock_duration_label' => 'Sperrdauer',
    'lock_duration_tooltip' => 'Die Zeitspanne (Zahl), für die der Benutzer gesperrt bleibt.',
    'lock_duration_unit_label' => 'Einheit der Sperrdauer',
    'lock_duration_unit_tooltip' => 'Wählen Sie die Zeiteinheit für die Sperrdauer: Minuten, Stunden, Tage usw.',
    'account_locked_for_time_unit' => 'Ihr Konto ist für :time :unit gesperrt.',
    'user_unlocked_message' => 'Benutzer wurde erfolgreich entsperrt!',

    //Verify email:
    'verify_email_address_title' => 'Bestätigen Sie Ihre E-Mail-Adresse',
    'fresh_verification_sent' => 'Ein neuer Bestätigungslink wurde an Ihre E-Mail-Adresse gesendet.',
    'verify_email_before_proceeding' => 'Bevor Sie fortfahren, überprüfen Sie bitte Ihre E-Mails auf den Bestätigungslink.',
    'did_not_receive_email' => 'Wenn Sie die E-Mail nicht erhalten haben',
    'click_here_request_another' => 'klicken Sie hier, um einen weiteren Link anzufordern',
    'logout' => 'Abmelden',
    'force_email_verify' => 'E-Mail-Verifizierung erzwingen',
    'force_email_verify_tooltip' => 'Wenn aktiviert, müssen Benutzer ihre E-Mail-Adresse verifizieren, bevor sie Zugriff auf das System erhalten.',
     // Reset Mapping
     'reset_purchase_sell_mapping'   => 'Kauf-Verkauf-Zuordnung zurücksetzen',
     'select_business'               => 'Unternehmen auswählen:',
     'all_businesses'                => 'Alle Unternehmen',
     'chunk_size'                    => 'Chunk-Größe:',
     'reset_mapping'                 => 'Zuordnung zurücksetzen',
     'purchase_sell_mismatch_tooltip' =>
         'Wählen Sie die Unternehmenszuordnungen aus, die zurückgesetzt werden sollen. '
         . 'Bei großen Datenbanken empfehlen wir, die Zuordnung pro Unternehmen zurückzusetzen.',
     'chunk_size_tooltip'           =>
         'Die Zuordnung wird in kleineren Chargen zurückgesetzt. '
         . 'Für große Datensätze wählen Sie eine geeignete Chunk-Größe. '
         . 'Ein aktiver Wartungsmodus wird empfohlen.',
 
     // Maintenance Mode
     'tab_maintenance_mode'         => 'Wartungsmodus',
     'maintenance_mode'             => 'Wartungsmodus',
     'maintenance_mode_tooltip'     => 'Setzt die Anwendung in den Wartungsmodus (Besucher sehen dann die Wartungsseite).',
     'enable_countdown'             => 'Countdown aktivieren',
     'enable_timer_tooltip'         => 'Zeigt einen Live-Countdown bis Ende der Wartung an.',
     'maintenance_duration'         => 'Dauer',
     'maintenance_unit'             => 'Einheit der Dauer',
     'minutes'                      => 'Minuten',
     'hours'                        => 'Stunden',
     'days'                         => 'Tage',
 
     // Maintenance page
     'under_maintenance'            => 'Wartung läuft',
     'maintenance_heading'          => 'Wir führen gerade Wartungsarbeiten durch.',
     'maintenance_subheading'       => 'Vielen Dank für Ihre Geduld!',
     'maintenance_back_in'          => 'Wir sind in :time zurück',
     'maintenance_back_no_timer'    => 'Wir sind zurück, sobald die Wartung abgeschlossen ist.',
 
     // Mapping reset page
     'mapping_reset_progress'       => 'Fortschritt der Zuordnungsrücksetzung',
     'mapping_reset_in_progress'    => 'Zuordnungsrücksetzung läuft',
     'batch_status'                 => 'Stapel-Status',
     'refresh_status'               => 'Status aktualisieren',
 
     // Mapping reset result & status
     'mapping_reset_result'         => 'Ergebnis der Zuordnungsrücksetzung',
     'chunk_processing_status'      => 'Status der Chargenverarbeitung',
 
     // Table headers
     'business'                     => 'Unternehmen',
     'chunk_status'                 => 'Status der Chunks',
     'total_chunks'                 => 'Gesamtzahl der Chunks',
     'status'                       => 'Status',
 
     // Buttons
     'go_back'                      => 'Zurück',
 
     // Jobs
     'processed_jobs'               => 'Zuordnungsaufträge',
     'processed_jobs_subtitle'      => 'Alle versendeten Zuordnungsstapel',
     'uuid'                         => 'Stapel-UUID',
     'job_name'                     => 'Auftragsname',
     'completed_chunks'             => 'Abgeschlossene Chunks',
     'started_at'                   => 'Begonnen am',
     'finished_at'                  => 'Zuletzt aktualisiert',
     'view_rebuild_jobs'            => 'Bestands-Wiederherstellungsaufträge anzeigen',
 
     // Detailed instruction
     'reset_mapping_instruction'    =>
         "Es wird empfohlen, den Queue-Treiber auf eine echte Backend-Verbindung zu setzen:\n"
         . "→ In Ihrer .env-Datei `QUEUE_CONNECTION=database` festlegen.\n\n"
         . "Aktivieren Sie außerdem den Wartungsmodus (Anwendungseinstellungen → Wartungsmodus), "
         . "während die Zuordnungsrücksetzung läuft, um doppelte oder fehlende Daten zu vermeiden.\n\n"
         . "Bei großen Datenbanken dauert die Rücksetzung länger – ziehen Sie in Erwägung, "
         . "pro Unternehmen zurückzusetzen.\n\n"
         . "Bevor Sie beginnen:\n"
         . "• Erstellen Sie ein vollständiges Backup der Datenbank.\n"
         . "• Überwachen Sie den Vorgang in den Logs, um Fehler zu erkennen.",
 
     'recovery_codes_generated_successfully' => 'Wiederherstellungscodes erfolgreich erstellt',
 
     // Disposable-email sync
     'sync_disposable_list'       => 'Disposable-E-Mail-Liste synchronisieren',
     'sync_disposable_success'    => 'Disposable-E-Mail-Liste erfolgreich aktualisiert.',
     'sync_disposable_failed'     => 'Fehler beim Synchronisieren der Disposable-E-Mail-Liste.',
 
     // Temporary-email protection
     'temp_email_protection'          => 'Temporäre E-Mail-Adressen blockieren',
     'temp_email_protection_tooltip'  => 'Blockiert temporäre/Einweg-E-Mail-Domains (z. B. Mailinator, 10MinuteMail).',
     'disposable_not_allowed'         => 'Disposable-E-Mail-Adressen sind nicht erlaubt.',

 // 3.3
    'enable_sidebar_dropdown'         => 'Sidebar-Dropdown aktivieren',
    'enable_sidebar_dropdown_tooltip' => 'Untermenüs zu einem anklickbaren Dropdown in der Sidebar zusammenklappen.',
    // Custom Menu
    'menu'                => 'Menü',
    'menus_heading'       => 'Menüs',
    'menus_description'   => 'Menüeinträge verwalten und organisieren.',
    'add_menu_item'       => 'Menüeintrag hinzufügen',
    'save_menu'           => 'Menü speichern',
    'label'               => 'Bezeichnung',
    'parent'              => 'Übergeordnet',
    'icon_type'           => 'Icon-Typ',
    'svg'                 => 'SVG',
    'fontawesome'         => 'FontAwesome',
    'svg_icon'            => 'SVG-Icon',
    'fa_class'            => 'FA-Klasse',
    'named_route'         => 'Benannte Route',
    'absolute_url'        => 'Absolute URL',
    'permission'          => 'Berechtigung',
    'module_flag'         => 'Modul-Flag',
    'sort_order'          => 'Sortierreihenfolge',
    'active'              => 'Aktiv?',
    'apply'               => 'Anwenden',
    'add_menu'            => 'Menü hinzufügen',
    'inactive'            => 'Inaktiv',
    'flush_cache'         => 'Cache leeren',
    'reset_menu'          => 'Zurücksetzen',
    'custom_menu'         => 'Benutzerdefiniertes Sidebar-Menü',

    'rebuilt_successfully' => 'Erfolgreich neu aufgebaut',

    'sidebar_layout'        => 'Sidebar-Layout',
    'sidebar_layout_1'      => 'Layout 1 (klassisch)',
    'sidebar_layout_2'      => 'Layout 2 (kompakt)',
    'sidebar_layout_custom' => 'Benutzerdefiniertes Layout',

    'custom_sidebar_type'   => 'Benutzerdefinierter Sidebar-Typ',
    'sidebar'               => 'Sidebar',
    'topbar'                => 'Topbar',

    'tab_business_settings'   => 'Geschäftseinstellungen',
    'business_settings_layout'=> 'Layout der Geschäftseinstellungen',
    'layout_1'               => 'Layout 1 – Klassische Tabs',
    'layout_2'               => 'Layout 2 – Moderne Sidebar',

    // Themes
    'predefined_theme_label'   => 'Vordefiniertes Theme',
    'predefined_theme_tooltip' => 'Eine fertige Farbpalette wählen.',
    'select_theme'             => 'Theme auswählen',
    'theme_default'            => 'Standard',

    // Migration Data
    'app_settings'                       => 'App-Einstellungen',
    'application_settings'               => 'Anwendungseinstellungen',
    'storage_migration'                  => 'Speichermigration',
    'manage_uploads_data'                => 'Upload-Daten verwalten',

    'push'                               => 'Push',
    'pull'                               => 'Pull',
    'local'                              => 'Lokal',
    'external_disk'                      => 'Externer Datenträger',
    'duplicate_files_skipped_safe_to_resume' => 'Doppelte Dateien übersprungen. Sicher erneut ausführen, um fortzusetzen.',

    'direction'                  => 'Richtung',
    'push_local_to_external'     => 'Push (lokal → extern)',
    'pull_external_to_local'     => 'Pull (extern → lokal)',

    'from_disk' => 'Von Datenträger',
    'to_disk'   => 'Zu Datenträger',

    'destination_visibility'        => 'Sichtbarkeit des Ziels',
    'visibility_none_bucket_signed' => '(keine / Bucket-Richtlinie / signierte URLs)',
    'visibility_public_acl'         => 'öffentlich (Objekt-ACL)',
    'visibility_private_acl'        => 'privat (Objekt-ACL)',

    'folders_to_include_optional' => 'Einzuschließende Ordner (optional)',
    'folders_include_tooltip'     => 'Leer lassen, um alle Ordner unterhalb von uploads einzuschließen.',
    'select_all'                  => 'Alle auswählen',
    'none'                        => 'Keine',
    'invert'                      => 'Invertieren',
    'no_suggestions_found'        => 'Keine Vorschläge gefunden.',

    'delete_source_after_copy' => 'Quelle nach erfolgreichem Kopieren löschen (Verschieben)',
    'dry_run_plan_only'        => 'Trockenlauf (nur Plan)',
    'verbose_log_messages'     => 'Ausführlich (Logmeldungen im Status)',

    'execution'                    => 'Ausführung',
    'execution_tooltip_html'       => 'Nur <strong>Direkt</strong> für kleine Vorgänge (z. B. < 1000 Dateien). Für 5–10 GB ist der Hintergrund-Job besser.',
    'pick_how_to_execute'          => 'Ausführungsmethode für die Migration wählen.',
    'background_job_recommended'   => 'Hintergrund-Job (empfohlen)',
    'run_direct_now'               => 'Direkt (jetzt ausführen)',

    'start_migration' => 'Migration starten',
    'reset'           => 'Zurücksetzen',

    'progress' => 'Fortschritt',
    'result'   => 'Ergebnis',

    // JS Strings
    'from'                    => 'Von',
    'to'                      => 'Nach',
    'folders'                 => 'Ordner',
    'total'                   => 'Gesamt',
    'copied'                  => 'Kopiert',
    'skipped'                 => 'Übersprungen',
    'deleted'                 => 'Gelöscht',
    'failed'                  => 'Fehlgeschlagen',
    'invalid_response'        => 'Ungültige Antwort',
    'failed_to_start_migration'=> 'Migration konnte nicht gestartet werden',
    'confirm_delete_source'   => 'Quelle nach dem Kopieren wirklich LÖSCHEN? Dieser Vorgang kann nicht rückgängig gemacht werden.',

    'default_storage_disk'       => 'Standard-Speicher-Datenträger',
    'default_storage_disk_help'  => 'Speicherort für neue Dateien: „public“ = storage/app/public via /storage-Symlink, „local“ = public/uploads.',

    's3_compatible_settings'     => 'S3-kompatible Einstellungen',
    'display_label_optional'     => 'Anzeigebezeichnung (optional)',
    'placeholder_my_s3_provider' => 'Mein S3-Anbieter',
    'display_only_admin_ui'      => 'Nur zur Anzeige im Admin-Bereich.',
    'access_key'                 => 'Access Key',
    'secret_key'                 => 'Secret Key',
    'region'                     => 'Region',
    'bucket'                     => 'Bucket',
    'endpoint'                   => 'Endpoint',
    'cdn_or_custom_domain_optional' => 'CDN / Eigene Domain (optional)',

    'disable_http_verify'      => 'HTTP-Verifizierung deaktivieren',
    'disable_http_verify_help' => 'Aus = TLS-Verifizierung aktiv. Ein = deaktiviert (nur lokal testen).',

    'path_style_endpoint'      => 'Path-Style-Endpoint',

    'use_signed_urls'          => 'Signierte URLs verwenden (Bucket privat lassen)',
    'use_signed_urls_help'     => 'Aus = öffentliche URLs (Bucket/CDN erlaubt Public Read). Ein = privat mit signierten URLs.',

    'signed_url_ttl_minutes' => 'Gültigkeit der signierten URL (Minuten)',
    'tab_storage_settings'   => 'Speicher',
    'syncing'               => 'Synchronisiere …',

    // POS Settings
    'pos_performance_settings'         => 'POS-Leistungseinstellungen',
    'enable_instant_pos'               => 'Instant-POS aktivieren',
    'enable_instant_pos_tooltip'       => 'Produkte ohne AJAX-Aufruf sofort hinzufügen – bessere Performance',
    'enable_instant_pos_help'          => 'Aktiviert: Produkte werden aus dem Cache statt über Serveranfragen hinzugefügt.',
    'enable_instant_search'            => 'Instant-Suche aktivieren',
    'enable_instant_search_tooltip'    => 'Produktsuche aus Cache statt per AJAX',
    'enable_instant_search_help'       => 'Aktiviert: Suche zeigt sofortige Ergebnisse ohne Serverrequest',

    'pos_performance_info_title' => 'Leistungsverbesserung',
    'pos_performance_info_desc'  => 'Instant-POS reduziert Serveranfragen drastisch:',
    'instant_pos_benefit_1'      => 'Produkte werden sofort hinzugefügt',
    'instant_pos_benefit_2'      => 'Suchergebnisse erscheinen sofort',
    'instant_pos_benefit_3'      => 'Bestände aktualisieren sich nach jedem Verkauf automatisch',
    'instant_pos_benefit_4'      => 'Offline-first, dann Server-Sync',

    'pos_cache_settings'                    => 'POS-Cache-Einstellungen',
    'pos_cache_refresh_interval'            => 'Cache-Aktualisierungsintervall',
    'pos_cache_refresh_interval_tooltip'    => 'Häufigkeit der Cache-Aktualisierung',
    'pos_cache_refresh_interval_help'       => 'Automatisch nach jedem Verkauf; manuelle Intervalle als Backup',
    'auto_refresh'                          => 'Auto (nach Verkauf)',
    '30_minutes'                            => '30 Minuten',
    '60_minutes'                            => '60 Minuten',
    '2_hours'                               => '2 Stunden',
    'manual_only'                           => 'Nur manuell',

    'pos_max_cached_products'         => 'Max. gecachte Produkte',
    'pos_max_cached_products_tooltip' => 'Obergrenze der im Cache gespeicherten Produkte',
    'pos_max_cached_products_help'    => 'Mehr Produkte = bessere Abdeckung, aber höherer Speicherbedarf. „Unbegrenzt“ speichert alle.',
    'unlimited'                       => 'Unbegrenzt',

    // Loading Messages
    'loading_products'                => 'Produkte werden geladen …',
    'please_wait_while_products_load' => 'Bitte warten, Produkte werden geladen',
    'loading_products_placeholder'    => 'Lade Produkte …',
    'updating_stock'                  => 'Bestand wird aktualisiert …',
    'failed_to_load_cache'            => 'Produkt-Cache konnte nicht geladen werden. POS-Funktion eingeschränkt.',

    // OTP Verification (Einmalpasswort-Verifizierung)
    'otp_verification' => 'Einmalpasswort-Verifizierung',
    'otp_verification_management' => 'Einmalpasswort-Verifizierung verwalten',
    'manage_otp_verification_requests' => 'Einmalpasswort-Verifizierungsanfragen verwalten und Statistiken anzeigen',
    'active_otps' => 'Aktive Einmalpasswörter',
    'unverified_users' => 'Nicht verifizierte Benutzer',
    'expired_otps' => 'Abgelaufene Einmalpasswörter',
    'failed_attempts' => 'Fehlgeschlagene Versuche',
    'pending_users' => 'Wartende Benutzer',
    'today_requests' => 'Heutige Anfragen',
    'high_retries' => 'Viele Wiederholungsversuche',
    'user_info' => 'Benutzerinformationen',
    'otp_code' => 'Einmalpasswort-Code',
    'attempts' => 'Versuche',
    'resend_count' => 'Anzahl Wiederversendungen',
    'no_active_otp' => 'Kein aktives Einmalpasswort',
    'expired' => 'Abgelaufen',
    'active' => 'Aktiv',
    'expires_in' => 'Läuft ab in',
    'remaining' => 'verbleibend',
    'resends' => 'Wiederversendungen',
    'last' => 'Zuletzt',
    'updated' => 'Aktualisiert',
    'verify' => 'Verifizieren',
    'manual_verify_email' => 'E-Mail manuell verifizieren',
    'reset_otp' => 'Einmalpasswort zurücksetzen',
    'manual_verify' => 'Manuell verifizieren',
    'deactivate' => 'Deaktivieren',

    // JavaScript-Meldungen
    'confirm_reset_otp' => 'Sind Sie sicher, dass Sie dieses Einmalpasswort zurücksetzen möchten? Der Benutzer muss ein neues anfordern.',
    'failed_to_reset_otp' => 'Einmalpasswort-Zurücksetzung fehlgeschlagen',
    'error_resetting_otp' => 'Fehler beim Zurücksetzen des Einmalpassworts',
    'confirm_verify_unverified_user' => 'Sind Sie sicher, dass Sie die E-Mail für den nicht verifizierten Benutzer :username manuell verifizieren möchten?',
    'confirm_verify_user' => 'Sind Sie sicher, dass Sie die E-Mail für den Benutzer :username manuell verifizieren möchten?',
    'user_verified_removed_from_list' => 'Benutzer-E-Mail verifiziert - Benutzer wird nicht mehr in der Liste der nicht verifizierten Benutzer erscheinen',
    'failed_to_verify_user' => 'Benutzerverifizierung fehlgeschlagen',
    'error_verifying_user' => 'Fehler beim Verifizieren des Benutzers',
    'confirm_deactivate_token' => 'Sind Sie sicher, dass Sie dieses Einmalpasswort-Token deaktivieren möchten?',
    'failed_to_deactivate_token' => 'Token-Deaktivierung fehlgeschlagen',
    'error_deactivating_token' => 'Fehler beim Deaktivieren des Tokens',

    // Session-Verwaltung
    'session_management' => 'Session-Verwaltung',
    'manage_user_sessions_and_authentication' => 'Benutzersitzungen und Authentifizierung verwalten',
    'all_users' => 'Alle Benutzer',
    'active_users' => 'Aktive Benutzer',
    'locked_users' => 'Gesperrte Benutzer',
    'disabled_logins' => 'Deaktivierte Anmeldungen',
    'active_sessions' => 'Aktive Sitzungen',
    'unique_users' => 'Eindeutige Benutzer',
    'active_businesses' => 'Aktive Unternehmen',
    'inactive_businesses' => 'Inaktive Unternehmen',
    'user_info' => 'Benutzerinformationen',
    'session_info' => 'Sitzungsinformationen',
    'force_logout' => 'Abmeldung erzwingen',
    'lock_user' => 'Benutzer sperren',
    'unlock_user' => 'Benutzer entsperren',
    'lock_user_account' => 'Benutzerkonto sperren',
    'lock_duration' => 'Sperrdauer',
    'user_will_be_locked_for_selected_duration' => 'Der Benutzer wird für die ausgewählte Dauer gesperrt',
    'minutes' => 'Minuten',
    'hour' => 'Stunde',
    'hours' => 'Stunden',
    'deactivate_user' => 'Benutzer deaktivieren',
    'activate_user' => 'Benutzer aktivieren',
    'block_login' => 'Anmeldung blockieren',
    'allow_login' => 'Anmeldung erlauben',
    'deactivate_business' => 'Unternehmen deaktivieren',
    'activate_business' => 'Unternehmen aktivieren',
    'login_allowed' => 'Anmeldung erlaubt',
    'login_blocked' => 'Anmeldung blockiert',
    'temporary_lock' => 'Temporäre Sperrung',
    'user_locked_successfully' => 'Benutzer für :duration Minuten gesperrt',
    'user_unlocked_successfully' => 'Benutzer erfolgreich entsperrt',
    'user_activated_successfully' => 'Benutzer erfolgreich aktiviert',
    'user_deactivated_successfully' => 'Benutzer erfolgreich deaktiviert',
    'login_permission_granted' => 'Anmeldeberechtigung erteilt',
    'login_permission_revoked' => 'Anmeldeberechtigung entzogen',
    'business_activated_successfully' => 'Unternehmen erfolgreich aktiviert',
    'business_deactivated_successfully' => 'Unternehmen erfolgreich deaktiviert',
    'user_logged_out_successfully' => 'Benutzer erfolgreich abgemeldet',
    'failed_to_lock_user' => 'Benutzer konnte nicht gesperrt werden',
    'failed_to_unlock_user' => 'Benutzer konnte nicht entsperrt werden',
    'failed_to_update_user_status' => 'Benutzerstatus konnte nicht aktualisiert werden',
    'failed_to_update_login_permission' => 'Anmeldeberechtigung konnte nicht aktualisiert werden',
    'failed_to_update_business_status' => 'Unternehmensstatus konnte nicht aktualisiert werden',
    'failed_to_logout_user' => 'Benutzer konnte nicht abgemeldet werden',
    'error_locking_user' => 'Fehler beim Sperren des Benutzers',
    'error_unlocking_user' => 'Fehler beim Entsperren des Benutzers',
    'error_updating_user_status' => 'Fehler beim Aktualisieren des Benutzerstatus',
    'error_updating_login_permission' => 'Fehler beim Aktualisieren der Anmeldeberechtigung',
    'error_updating_business_status' => 'Fehler beim Aktualisieren des Unternehmensstatus',
    'error_logging_out_user' => 'Fehler beim Abmelden des Benutzers',
    'confirm_force_logout' => 'Sind Sie sicher, dass Sie die Abmeldung für Benutzer :username erzwingen möchten?',
    'confirm_lock_user' => 'Sind Sie sicher, dass Sie Benutzer :username für :duration Minuten sperren möchten?',
    'confirm_unlock_user' => 'Sind Sie sicher, dass Sie Benutzer :username entsperren möchten?',
    'confirm_toggle_user_status' => 'Sind Sie sicher, dass Sie Benutzer :username :action möchten?',
    'confirm_toggle_login_permission' => 'Sind Sie sicher, dass Sie die Anmeldung für Benutzer :username :action möchten?',
    'confirm_toggle_business_status' => 'Sind Sie sicher, dass Sie Unternehmen :business :action möchten?',
    'activate' => 'aktivieren',
    'deactivate' => 'deaktivieren',
    
    // Instant POS Button Strings
    'refresh_pos_cache' => 'Cache Aktualisieren',
    'instant_pos_enabled' => 'Instant-Kasse Aktiviert',
    'instant_pos_disabled' => 'Instant-Kasse Deaktiviert',
    'disable_instant_pos' => 'Sofort-POS deaktivieren',
];
