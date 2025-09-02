<?php

return [

    'app_settings' => 'Uygulama Ayarları',
    'manage_app_settings' => 'Uygulama Ayarlarını Yönet',
    'tab_2fa' => '2FA',
    'tab_theme' => 'Görünüm',
    'tab_login_page' => 'Giriş Sayfası',
    'tab_sidebar' => 'Kenar Çubuğu',
    'tab_language' => 'Dil',
    'tab_repair_status' => 'Onarım Durumu',
    'tab_logo' => 'Logo',
    // Buttons
    'update_settings' => 'Ayarları Güncelle',

    'enable_custom_bg_image_for_login' => 'Giriş için Özel Arka Planı Etkinleştir',
    'enable_custom_bg_image_for_login_tooltip' => 'Giriş sayfası için özel bir arka plan resmi ayarlayın.',

    'enable_custom_sidebar_logo' => 'Kenar Çubuğunda Özel Logo İzni Ver',
    'enable_custom_sidebar_logo_tooltip' => 'Firmaların kenar çubuğunda özel bir logo kullanmasına izin verir.',

    // language.blade.php
    'header_language_change' => 'Üst Menüde Dil Değiştirme',
    'header_language_change_tooltip' => 'Kullanıcıların ana üst menüden dil değiştirmesine izin ver.',
    'header_languages_label' => 'Üst Menü Dilleri',
    'header_languages_label_tooltip' => 'Üst menüde hangi dillerin görüneceğini seçin.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'Giriş Ekranında Onarım Durumunu Göster',

    // 2fa.blade.php
    'enable_2fa' => '2FA’yı Etkinleştir',
    'enable_2fa_tooltip' => 'Uygulama için İki Faktörlü Kimlik Doğrulamasını (2FA) etkinleştirin.',

    'force_2fa' => '2FA’yı Zorunlu Yap',
    'force_2fa_tooltip' => 'Kullanıcılar uygulamayı kullanmadan önce 2FA kurmak zorundadır.',

    'recommend_2fa' => '2FA Öner',
    'recommend_2fa_tooltip' => 'Girişte bir kereye mahsus açılan bir modal, kullanıcıları 2FA’yı etkinleştirmeye teşvik eder.',

    'allow_disable_2fa' => '2FA’yı Geçici Olarak Devre Dışı Bırakmaya İzin Ver',
    'allow_disable_2fa_tooltip' => 'Kullanıcıların belirli bir zamana kadar 2FA’yı geçici olarak devre dışı bırakabilmesine izin ver.',

    'disable_2fa_duration_label' => '2FA Devre Dışı Bırakma Süresi',
    'disable_2fa_duration_label_tooltip' => '2FA’nın devre dışı kalabileceği süreyi tanımlayın.',

    'disable_2fa_unit_label' => '2FA Devre Dışı Bırakma Birimi',

    'force_2fa_after_date_label' => 'Belirli Bir Tarihten Sonra 2FA Zorunlu',
    'force_2fa_after_date_label_tooltip' => 'Bu tarihten sonra tüm kullanıcılar 2FA’yı etkinleştirmelidir. Bu tarih ayrıca 2FA öneri modali içinde görüntülenir.',

    'primary_color_label' => 'Ana Renk',
    'primary_color_label_tooltip' => 'Uygulamanın varsayılan ana rengini seçin. Kendi renklerini belirlemeyen firmalar bu rengi kullanır.',
    'secondary_color_label' => 'İkincil Renk',
    'secondary_color_label_tooltip' => 'Uygulamanın varsayılan ikincil rengini seçin. Kendi renklerini belirlemeyen firmalar bu rengi kullanır.',

    'allow_theme_change' => 'Tema Değişikliğine İzin Ver',
    'allow_theme_change_tooltip' => 'Firmaların kendi tema renklerini özelleştirmesine izin ver. Eğer özel renk belirlemezlerse, buradaki varsayılan renkler kullanılır.',

    'login_bg_image_label' => 'Giriş Arka Plan Resmi',
    'login_bg_image_label_tooltip' => 'Yeni bir resim yüklemek, mevcut arka planı değiştirecektir.',

    'logo_dark_tooltip'  => 'Uygulamanın varsayılan koyu (dark) logosunu değiştirin, aydınlık mod için kullanılır.',
    'logo_light_tooltip' => 'Uygulamanın varsayılan aydınlık (light) logosunu değiştirin, koyu mod için kullanılır.',
    'favicon_tooltip' => 'Önerilen boyutlar: 32×32 piksel. Bu simge tarayıcı sekmelerinde ve yer imlerinde görüntülenir.',
    'upload_favicon' => 'Favicon Yükle',

    // Fonts
    'tab_fonts' => 'Yazı Tipleri',
    'english_font'            => 'İngilizce Yazı Tipi',
    'arabic_font'             => 'Arapça Yazı Tipi',
    'custom_font_placeholder' => 'Özel bir yazı tipi adı girin...',
    'select_font'             => 'Bir yazı tipi seçin...',
    'or'                      => 'veya',
    'font_help_text'          => 'Listeden seçin veya kendi özel yazı tipinizi girin.',
    'english_font_tooltip'  => 'Özel bir yazı tipi adı girin veya listeden birini seçin. Yazı tipi adlarını şurada bulabilirsiniz: :url',
    'arabic_font_tooltip'   => 'Özel bir yazı tipi adı girin veya listeden birini seçin. Yazı tipi adlarını şurada bulabilirsiniz: :url',

    //Recaptcha:
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha'              => 'Google reCAPTCHA’yı Etkinleştir',
    'enable_recaptcha_tooltip'      => 'reCAPTCHA korumasını etkinleştirmek için ayarı değiştirin. Site anahtarı (Site Key) ve gizli anahtarı (Secret) şuradan alın: :url',
    'enable_recaptcha_text'         => 'reCAPTCHA’yı Etkinleştir',
    'google_recaptcha_key'          => 'Google reCAPTCHA Site Key',
    'google_recaptcha_secret'       => 'Google reCAPTCHA Secret Key',
    'google_recaptcha_key_placeholder'    => 'Google reCAPTCHA Site Key’inizi girin',
    'google_recaptcha_secret_placeholder' => 'Google reCAPTCHA Secret Key’inizi girin',

    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'İki Faktörlü Kimlik Doğrulamayı (2FA) Etkinleştir',
    'modal_enable_2fa_desc' => 'Hesabınızın güvenliğini artırmak için 2FA’yı etkinleştirmenizi öneriyoruz.',
    'enable_now_button' => 'Şimdi Etkinleştir',
    'maybe_later_button' => 'Belki Sonra',
    'close_aria_label' => 'Kapat',

    // 2FA Verify page
    'one_time_password_heading' => 'Tek Seferlik Parola (OTP)',
    'one_time_password_label' => 'Tek Seferlik Parola',
    'enter_2fa_code_placeholder' => '2FA kodunu girin',
    'disable_2fa_for' => '2FA’yı :duration :unit devre dışı bırak',
    'verify_button' => 'Doğrula',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'İki Faktörlü Kimlik Doğrulama (2FA)',
    'google_auth_app_desc' => 'Google Authenticator uygulaması',
    'configured_status' => 'Yapılandırıldı',
    'needs_configuration_status' => 'Yapılandırma Gerekli',
    'two_factor_scan_or_enter_msg' => 'Lütfen aşağıdaki QR kodunu Google Authenticator uygulamasıyla tarayın veya “secret”ı elle girin, ardından üretilen kodu yazın.',
    'your_secret_key_msg' => 'Manuel olarak girmeniz gerekirse, sizin “secret key”iniz:',

    // 2FA field labels
    'one_time_password_label' => 'Tek Seferlik Parola',
    'enter_2fa_code_placeholder' => '2FA kodunu girin',
    '2fa_will_be_forced_after_date' => '2FA, :date tarihinden sonra zorunlu olacak.',

    // Buttons
    '2fa' => '2FA',
    'verify_button' => 'Doğrula',

    'confirm_access_recovery_codes' => 'Erişimi Onayla',
    're_authenticate_message'       => 'Ayarlar veya 2FA Kurtarma Kodlarına erişmek için yeniden kimlik doğrulaması yapmanız gerekir.',
    'choose_method'                 => 'Bir yöntem seçin:',
    'one_time_password'             => 'Tek Seferlik Parola (OTP)',
    'password'                      => 'Parola',
    'enter_code_or_password'        => 'Kod / Parola girin:',
    'confirm'                       => 'Onayla',

    '2fa_recovery_codes'           => '2FA Kurtarma Kodları',
    'recovery_codes_description'   => 'Bu kodlar, kimlik doğrulama uygulamanıza erişimi kaybettiğinizde giriş yapmanıza olanak tanır. Her kod yalnızca bir kez kullanılabilir.',
    'regenerate_codes'             => 'Kodları Yeniden Oluştur',
    'copy'                         => 'Kopyala',
    'copy_all'                     => 'Tümünü Kopyala',
    'no_recovery_codes_available'  => 'Hiç kurtarma kodu yok. Aşağıdan yeni kodlar oluşturabilirsiniz.',
    'copied'                       => 'Kod panoya kopyalandı!',
    'all_codes_copied'             => 'Tüm kurtarma kodları panoya kopyalandı!',
    'supported_app'                => 'Desteklenen Uygulamalar',
    'supported_apps' => [
        'Authy' => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP' => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator' => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator' => ['Windows Phone'],
        'LastPass Authenticator' => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password' => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    // social logins:
    'social_login_settings'       => 'Sosyal Giriş Ayarları',
    'social_login_settings_help'  => 'Sosyal giriş kimlik bilgilerinizi girin.',
    'client_id'                   => 'Client ID',
    'client_secret'               => 'Client Secret',
    'redirect_url'                => 'Redirect URL',
    'enter_client_id'             => ':provider Client ID girin',
    'enter_client_secret'         => ':provider Client Secret girin',
    'enter_redirect_url'          => ':provider Redirect URL girin',
    'enable_social_login' => 'Sosyal Girişi Etkinleştir',
    'tab_social' => 'Sosyal Girişler',
    'or_login_with' => 'Veya bunlarla giriş yap',
    'force_otp_after_social_login' => 'Sosyal Giriş Sonrası OTP Zorunlu',
    'force_otp_after_social_login_tooltip' => 'Eğer etkinse, sosyal girişle oturum açan kullanıcıların OTP doğrulaması yapması gerekir.',

    //Lock Users:
    'locked_until' => 'Şu Zamana Kadar Kilitli',
    'locked_users' => 'Kilitli Kullanıcılar',
    'view_locked_users' => 'Kilitli Kullanıcıları Gör',
    'tab_login_security' => 'Giriş Güvenliği',
    'unlock' => 'Kilidi Aç',
    'enable_user_lock_label' => 'Kullanıcı Kilitlemeyi Etkinleştir',
    'enable_user_lock_tooltip' => 'Birden çok başarısız giriş denemesinden sonra kullanıcı kilitlemeyi etkinleştir/devre dışı bırak.',
    'max_login_attempts_label' => 'Maksimum Giriş Deneme Sayısı',
    'max_login_attempts_tooltip' => 'Kullanıcının kilitlenmesinden önce izin verilen giriş denemesi sayısı.',
    'lock_duration_label' => 'Kilitlenme Süresi',
    'lock_duration_tooltip' => 'Kullanıcının kilitli kalacağı süre (sayı olarak).',
    'lock_duration_unit_label' => 'Kilitlenme Süre Birimi',
    'lock_duration_unit_tooltip' => 'Kilit süresi için zaman birimi seçin: dakika, saat, gün vb.',
    'account_locked_for_time_unit' => 'Hesabınız :time :unit boyunca kilitlenmiştir.',
    'user_unlocked_message' => 'Kullanıcının kilidi başarıyla açıldı!',

    //Verify email:
    'verify_email_address_title' => 'E-posta Adresinizi Doğrulayın',
    'fresh_verification_sent' => 'E-posta adresinize yeni bir doğrulama bağlantısı gönderildi.',
    'verify_email_before_proceeding' => 'Devam etmeden önce, lütfen doğrulama bağlantısı için e-postanızı kontrol edin.',
    'did_not_receive_email' => 'E-postayı almadıysanız',
    'click_here_request_another' => 'yeni bir tane talep etmek için buraya tıklayın',
    'logout' => 'Oturumu Kapat',
    'force_email_verify' => 'E-posta Doğrulamayı Zorunlu Yap',
    'force_email_verify_tooltip' => 'Eğer etkinse, kullanıcılar sisteme erişmeden önce e-posta adreslerini doğrulamalıdır.',

      // Reset Mapping
      'reset_purchase_sell_mapping'     => 'Satın alma-satış eşleştirmesini sıfırla',
      'select_business'                 => 'İşletme seçin:',
      'all_businesses'                  => 'Tüm işletmeler',
      'chunk_size'                      => 'Bölüm boyutu:',
      'reset_mapping'                   => 'Eşleştirmeyi sıfırla',
      'purchase_sell_mismatch_tooltip'  => 'Hangi işletme eşleştirmelerinin sıfırlanacağını seçin. Büyük bir veritabanınız varsa, eşleştirmeyi işletme bazında sıfırlamanızı öneririz.',
      'chunk_size_tooltip'              => 'Eşleştirme daha küçük bölümler halinde sıfırlanacak. Büyük veri kümeleri için uygun bölüm boyutunu seçin. Aktif bakım modunun etkinleştirilmesi önerilir.',
  
      // Maintenance Mode
      'tab_maintenance_mode'            => 'Bakım Modu',
      'maintenance_mode'                => 'Bakım modu',
      'maintenance_mode_tooltip'        => 'Uygulamayı bakım moduna alın (ziyaretçiler bakım ekranını görecek).',
      'enable_countdown'                => 'Geri sayımı etkinleştir',
      'enable_timer_tooltip'            => 'Bakım sonuna kadar canlı geri sayım göster.',
      'maintenance_duration'            => 'Süre',
      'maintenance_unit'                => 'Süre birimi',
      'minutes'                         => 'Dakika',
      'hours'                           => 'Saat',
      'days'                            => 'Gün',
  
      // Maintenance page
      'under_maintenance'               => 'Bakımda',
      'maintenance_heading'             => 'Bakım çalışmaları yapıyoruz.',
      'maintenance_subheading'          => 'Sabır gösterdiğiniz için teşekkürler!',
      'maintenance_back_in'             => ':time içinde geri döneceğiz',
      'maintenance_back_no_timer'       => 'Bakım tamamlandıktan sonra hemen geri döneceğiz.',
  
      // Mapping reset page
      'mapping_reset_progress'          => 'Eşleştirme sıfırlama ilerlemesi',
      'mapping_reset_in_progress'       => 'Eşleştirme sıfırlanıyor',
      'batch_status'                    => 'Bölüm durumu',
      'refresh_status'                  => 'Durumu yenile',
  
      // Mapping reset result & status
      'mapping_reset_result'            => 'Eşleştirme sıfırlama sonucu',
      'chunk_processing_status'         => 'Bölüm işleme durumu',
  
      // Table headers
      'business'                        => 'İşletme',
      'chunk_status'                    => 'Bölüm durumu',
      'total_chunks'                    => 'Toplam bölüm',
      'status'                          => 'Durum',
  
      // Button
      'go_back'                         => 'Geri dön',
  
      // Mapping Jobs
      'processed_jobs'                  => 'Eşleştirme işleri',
      'processed_jobs_subtitle'         => 'Tüm gönderilen eşleştirme bölümleri',
      'uuid'                            => 'Bölüm UUID',
      'job_name'                        => 'İş adı',
      'chunk_size'                      => 'Bölüm boyutu',
      'completed_chunks'                => 'Tamamlanan bölümler',
      'total_chunks'                    => 'Toplam bölüm',
      'started_at'                      => 'Başlangıç',
      'finished_at'                     => 'Son güncelleme',
      'view_rebuild_jobs'               => 'Stok yeniden oluşturma işlerini görüntüle',
  
      // Detailed instruction
      'reset_mapping_instruction'       => 
          "Kuyruk sürücünüzü gerçek bir backend'e ayarlamanız önerilir:\n"
          . "→ .env dosyanızda `QUEUE_CONNECTION=database` olarak ayarlayın.\n\n"
          . "Eşleştirme çalışırken, yinelenen veya eksik verileri önlemek için Bakım Modu'nu "
          . "(Uygulama Ayarları → Bakım Modu) etkinleştirin.\n\n"
          . "Büyük bir veritabanınız varsa, sıfırlama daha uzun sürecektir—işletme bazında sıfırlamayı düşünün.\n\n"
          . "Başlamadan önce:\n"
          . "• Tam bir veritabanı yedeği alın.\n"
          . "• Hataları yakalamak için süreci loglar üzerinden izleyin.",
  
      'recovery_codes_generated_successfully' => 'Kurtarma kodları başarıyla oluşturuldu',
  
      // Disposable-email sync
      'sync_disposable_list'            => 'Geçici e-posta listesini senkronize et',
      'sync_disposable_success'         => 'Geçici e-posta listesi güncellendi.',
      'sync_disposable_failed'          => 'Geçici e-posta listesi senkronizasyonu başarısız oldu.',
  
      // Temporary-email protection
      'temp_email_protection'           => 'Geçici e-posta adreslerini engelle',
      'temp_email_protection_tooltip'   => 'Mailinator, 10MinuteMail gibi geçici/e-atıl e-posta alan adlarını engelle.',
      'disposable_not_allowed'          => 'Tek kullanımlık e-posta adreslerine izin verilmiyor.',

     // 3.3
    'enable_sidebar_dropdown'         => 'Kenar çubuğu açılır menüsünü etkinleştir',
    'enable_sidebar_dropdown_tooltip' => 'Alt menüleri kenar çubuğu içinde tıklanabilir bir açılır menüye daraltır.',
    // Custom Menu
    'menu'               => 'Menü',
    'menus_heading'      => 'Menüler',
    'menus_description'  => 'Menü öğelerinizi yönetin ve düzenleyin.',
    'add_menu_item'      => 'Menü öğesi ekle',
    'save_menu'          => 'Menüyü kaydet',
    'label'              => 'Etiket',
    'parent'             => 'Üst',
    'icon_type'          => 'Simge türü',
    'svg'                => 'SVG',
    'fontawesome'        => 'FontAwesome',
    'svg_icon'           => 'SVG simgesi',
    'fa_class'           => 'FA sınıfı',
    'named_route'        => 'Adlandırılmış rota',
    'absolute_url'       => 'Mutlak URL',
    'permission'         => 'İzin',
    'module_flag'        => 'Modül bayrağı',
    'sort_order'         => 'Sıralama',
    'active'             => 'Aktif?',
    'apply'              => 'Uygula',
    'add_menu'           => 'Menü ekle',
    'inactive'           => 'Pasif',
    'flush_cache'        => 'Önbelleği temizle',
    'reset_menu'         => 'Sıfırla',
    'custom_menu'        => 'Özel kenar menü',

    'rebuilt_successfully' => 'Başarıyla yeniden oluşturuldu',

    'sidebar_layout'        => 'Kenar çubuğu düzeni',
    'sidebar_layout_1'      => 'Düzen 1 (Klasik)',
    'sidebar_layout_2'      => 'Düzen 2 (Kompakt)',
    'sidebar_layout_custom' => 'Özel düzen',

    'custom_sidebar_type'   => 'Özel kenar çubuğu türü',
    'sidebar'               => 'Kenar çubuğu',
    'topbar'                => 'Üst çubuk',

    'tab_business_settings'    => 'İşletme ayarları',
    'business_settings_layout' => 'İşletme ayarları düzeni',
    'layout_1'                => 'Düzen 1 – Klasik sekmeler',
    'layout_2'                => 'Düzen 2 – Modern kenar çubuğu',

    // Themes
    'predefined_theme_label'   => 'Hazır tema',
    'predefined_theme_tooltip' => 'Hazır bir renk paleti seçin.',
    'select_theme'             => 'Tema seç',
    'theme_default'            => 'Varsayılan',

    // Migration Data
    'app_settings'         => 'Uygulama ayarları',
    'application_settings' => 'Uygulama ayarları',
    'storage_migration'    => 'Depolama taşıma',
    'manage_uploads_data'  => 'Yüklemelerinizi yönetin',

    'push'  => 'it',
    'pull'  => 'çek',
    'local' => 'yerel',
    'external_disk' => 'harici disk',
    'duplicate_files_skipped_safe_to_resume' => 'Yinelenen dosyalar atlandı. Güvenle devam edebilirsiniz.',

    'direction'              => 'Yön',
    'push_local_to_external' => 'it (yerel → harici)',
    'pull_external_to_local' => 'çek (harici → yerel)',

    'from_disk' => 'Diskten',
    'to_disk'   => 'Diske',

    'destination_visibility'        => 'Hedef görünürlüğü',
    'visibility_none_bucket_signed' => '(yok / kova politikası / imzalı URL)',
    'visibility_public_acl'         => 'herkese açık (nesne ACL)',
    'visibility_private_acl'        => 'özel (nesne ACL)',

    'folders_to_include_optional' => 'Dahil edilecek klasörler (isteğe bağlı)',
    'folders_include_tooltip'     => 'Uploads altında tüm klasörleri dahil etmek için boş bırakın.',
    'select_all'                  => 'Tümünü seç',
    'none'                        => 'Hiçbiri',
    'invert'                      => 'Tersine çevir',
    'no_suggestions_found'        => 'Öneri bulunamadı.',

    'delete_source_after_copy' => 'Kopyalama sonrası kaynağı sil (taşı)',
    'dry_run_plan_only'        => 'Deneme çalıştırması (yalnızca plan)',
    'verbose_log_messages'     => 'Ayrıntılı (kayıt mesajları)',

    'execution'                    => 'Yürütme',
    'execution_tooltip_html'       => '<strong>Doğrudan</strong> seçeneğini yalnızca küçük işlemler (< 1000 dosya) için kullanın. 5–10 GB için arka plan işi önerilir.',
    'pick_how_to_execute'          => 'Taşıma işleminin nasıl çalıştırılacağını seçin.',
    'background_job_recommended'   => 'Arka plan işi (önerilir)',
    'run_direct_now'               => 'Doğrudan (şimdi çalıştır)',

    'start_migration' => 'Taşımayı başlat',
    'reset'           => 'Sıfırla',

    'progress' => 'İlerleme',
    'result'   => 'Sonuç',

    // JS strings
    'from'                    => 'Kimden',
    'to'                      => 'Kime',
    'folders'                 => 'Klasörler',
    'total'                   => 'Toplam',
    'copied'                  => 'Kopyalandı',
    'skipped'                 => 'Atlandı',
    'deleted'                 => 'Silindi',
    'failed'                  => 'Başarısız',
    'invalid_response'        => 'Geçersiz yanıt',
    'failed_to_start_migration'=> 'Taşıma başlatılamadı',
    'confirm_delete_source'   => 'Kopyalama sonrası KAYNAK dosyaları silmek istediğinize emin misiniz? Bu işlem geri alınamaz.',

    'default_storage_disk'      => 'Varsayılan depolama diski',
    'default_storage_disk_help' => '"public" = storage/app/public ( /storage bağlantısı); "local" = public/uploads.',

    's3_compatible_settings'     => 'S3 uyumlu ayarlar',
    'display_label_optional'     => 'Görüntü etiketi (isteğe bağlı)',
    'placeholder_my_s3_provider' => 'S3 sağlayıcım',
    'display_only_admin_ui'      => 'Yalnızca yönetici arayüzünde gösterilir.',
    'access_key'                 => 'Erişim anahtarı',
    'secret_key'                 => 'Gizli anahtar',
    'region'                     => 'Bölge',
    'bucket'                     => 'Kova',
    'endpoint'                   => 'Uç nokta',
    'cdn_or_custom_domain_optional' => 'CDN / Özel alan (isteğe bağlı)',

    'disable_http_verify'      => 'TLS doğrulamasını kapat',
    'disable_http_verify_help' => 'Kapalı = TLS etkin. Açık = yalnızca yerelde test için devre dışı.',

    'path_style_endpoint' => 'Yol stili uç nokta',

    'use_signed_urls'      => 'İmzalı URL kullan (kovayı özel tut)',
    'use_signed_urls_help' => 'Kapalı = herkese açık URL; Açık = imzalı özel URL.',

    'signed_url_ttl_minutes' => 'İmzalı URL süresi (dakika)',
    'tab_storage_settings'   => 'Depolama',
    'syncing'               => 'Senkronize ediliyor…',

    // POS Settings
    'pos_performance_settings'   => 'POS performans ayarları',
    'enable_instant_pos'         => 'Anında POS\'u etkinleştir',
    'enable_instant_pos_tooltip' => 'Ürünleri AJAX olmadan anında ekler, performansı artırır',
    'enable_instant_pos_help'    => 'Etkinleştirildiğinde ürünler sunucu isteği yerine önbellekten anında eklenir.',

    'enable_instant_search'            => 'Anında aramayı etkinleştir',
    'enable_instant_search_tooltip'    => 'Ürün araması önbellekten yapılır, AJAX kullanılmaz',
    'enable_instant_search_help'       => 'Etkinleştirildiğinde arama anında sonuç verir.',

    'pos_performance_info_title' => 'Performans artışı',
    'pos_performance_info_desc'  => 'Anında POS sunucu isteklerini azaltarak hızı artırır:',
    'instant_pos_benefit_1'      => 'Ürünler beklemeden eklenir',
    'instant_pos_benefit_2'      => 'Arama sonuçları anında görünür',
    'instant_pos_benefit_3'      => 'Stok seviyeleri her satıştan sonra otomatik güncellenir',
    'instant_pos_benefit_4'      => 'Önce çevrimdışı çalışır, sonra sunucuyla senkronize olur',

    'pos_cache_settings'                    => 'POS önbellek ayarları',
    'pos_cache_refresh_interval'            => 'Önbellek yenileme aralığı',
    'pos_cache_refresh_interval_tooltip'    => 'Ürün önbelleğinin ne sıklıkta yenileneceği',
    'pos_cache_refresh_interval_help'       => 'Her satış sonrası otomatik; yedek için manuel aralıklar.',
    'auto_refresh'                          => 'Otomatik (satış sonrası)',
    '30_minutes'                            => '30 dakika',
    '60_minutes'                            => '60 dakika',
    '2_hours'                               => '2 saat',
    'manual_only'                           => 'Yalnızca manuel',

    'pos_max_cached_products'         => 'Önbellekteki maksimum ürün',
    'pos_max_cached_products_tooltip' => 'Anlık erişim için ürün sınırı',
    'pos_max_cached_products_help'    => 'Yüksek sayı = daha iyi kapsama, daha fazla bellek. "Limitsiz" tümünü önbelleğe alır.',
    'unlimited'                       => 'Limitsiz',

    // Loading messages
    'loading_products'                => 'Ürünler yükleniyor…',
    'please_wait_while_products_load' => 'Lütfen bekleyin, ürünler yükleniyor',
    'loading_products_placeholder'    => 'Ürünler yükleniyor…',
    'updating_stock'                  => 'Stok güncelleniyor…',
    'failed_to_load_cache'            => 'Ürün önbelleği yüklenemedi. POS işlevi sınırlı olabilir.',

    // OTP Verification
    'otp_verification' => 'OTP Doğrulama',
    'otp_verification_management' => 'OTP Doğrulama Yönetimi',
    'manage_otp_verification_requests' => 'OTP doğrulama isteklerini yönetin ve istatistikleri görüntüleyin',
    'active_otps' => 'Aktif OTP\'ler',
    'unverified_users' => 'Doğrulanmamış Kullanıcılar',
    'expired_otps' => 'Süresi Dolmuş OTP\'ler',
    'failed_attempts' => 'Başarısız Denemeler',
    'pending_users' => 'Bekleyen Kullanıcılar',
    'today_requests' => 'Bugünün İstekleri',
    'high_retries' => 'Çok Tekrar',
    'user_info' => 'Kullanıcı Bilgisi',
    'otp_code' => 'OTP Kodu',
    'attempts' => 'Denemeler',
    'resend_count' => 'Yeniden Gönderme Sayısı',
    'no_active_otp' => 'Aktif OTP Yok',
    'expired' => 'Süresi Dolmuş',
    'active' => 'Aktif',
    'expires_in' => 'Süresi bitiyor',
    'remaining' => 'kalan',
    'resends' => 'yeniden göndermeler',
    'last' => 'Son',
    'updated' => 'Güncellendi',
    'verify' => 'Doğrula',
    'manual_verify_email' => 'Manuel E-posta Doğrulama',
    'reset_otp' => 'OTP Sıfırla',
    'manual_verify' => 'Manuel Doğrulama',
    'deactivate' => 'Devre Dışı Bırak',

    // JavaScript messages
    'confirm_reset_otp' => 'Bu OTP\'yi sıfırlamak istediğinizden emin misiniz? Kullanıcının yeni bir tane istemesi gerekecek.',
    'failed_to_reset_otp' => 'OTP sıfırlanamadı',
    'error_resetting_otp' => 'OTP sıfırlanırken hata oluştu',
    'confirm_verify_unverified_user' => 'Doğrulanmamış kullanıcının e-postasını manuel olarak doğrulamak istediğinizden emin misiniz: :username?',
    'confirm_verify_user' => 'Kullanıcının e-postasını manuel olarak doğrulamak istediğinizden emin misiniz: :username?',
    'user_verified_removed_from_list' => 'Kullanıcı e-postası doğrulandı - kullanıcı artık doğrulanmamış listede görünmeyecek',
    'failed_to_verify_user' => 'Kullanıcı doğrulanamadı',
    'error_verifying_user' => 'Kullanıcı doğrulanırken hata oluştu',
    'confirm_deactivate_token' => 'Bu OTP token\'ını devre dışı bırakmak istediğinizden emin misiniz?',
    'failed_to_deactivate_token' => 'Token devre dışı bırakılamadı',
    'error_deactivating_token' => 'Token devre dışı bırakılırken hata oluştu',

    // Session Management
    'session_management' => 'Oturum Yönetimi',
    'manage_user_sessions_and_authentication' => 'Kullanıcı oturumları ve kimlik doğrulamayı yönetin',
    'all_users' => 'Tüm Kullanıcılar',
    'active_users' => 'Aktif Kullanıcılar',
    'locked_users' => 'Kilitli Kullanıcılar',
    'disabled_logins' => 'Devre Dışı Girişler',
    'active_sessions' => 'Aktif Oturumlar',
    'unique_users' => 'Benzersiz Kullanıcılar',
    'active_businesses' => 'Aktif İşletmeler',
    'inactive_businesses' => 'Pasif İşletmeler',
    'user_info' => 'Kullanıcı Bilgisi',
    'session_info' => 'Oturum Bilgisi',
    'force_logout' => 'Zorla Çıkış',
    'lock_user' => 'Kullanıcıyı Kilitle',
    'unlock_user' => 'Kullanıcı Kilidini Aç',
    'lock_user_account' => 'Kullanıcı Hesabını Kilitle',
    'lock_duration' => 'Kilit Süresi',
    'user_will_be_locked_for_selected_duration' => 'Kullanıcı seçilen süre boyunca kilitlenecek',
    'minutes' => 'dakika',
    'hour' => 'saat',
    'hours' => 'saat',
    'deactivate_user' => 'Kullanıcıyı Devre Dışı Bırak',
    'activate_user' => 'Kullanıcıyı Etkinleştir',
    'block_login' => 'Girişi Engelle',
    'allow_login' => 'Girişe İzin Ver',
    'deactivate_business' => 'İşletmeyi Devre Dışı Bırak',
    'activate_business' => 'İşletmeyi Etkinleştir',
    'login_allowed' => 'Giriş İzinli',
    'login_blocked' => 'Giriş Engellenmiş',
    'temporary_lock' => 'Geçici Kilit',
    'user_locked_successfully' => 'Kullanıcı :duration dakika süreyle kilitlendi',
    'user_unlocked_successfully' => 'Kullanıcı kilidi başarıyla açıldı',
    'user_activated_successfully' => 'Kullanıcı başarıyla etkinleştirildi',
    'user_deactivated_successfully' => 'Kullanıcı başarıyla devre dışı bırakıldı',
    'login_permission_granted' => 'Giriş izni verildi',
    'login_permission_revoked' => 'Giriş izni iptal edildi',
    'business_activated_successfully' => 'İşletme başarıyla etkinleştirildi',
    'business_deactivated_successfully' => 'İşletme başarıyla devre dışı bırakıldı',
    'user_logged_out_successfully' => 'Kullanıcı başarıyla çıkış yaptı',
    'failed_to_lock_user' => 'Kullanıcı kilitlenemedi',
    'failed_to_unlock_user' => 'Kullanıcı kilidi açılamadı',
    'failed_to_update_user_status' => 'Kullanıcı durumu güncellenemedi',
    'failed_to_update_login_permission' => 'Giriş izni güncellenemedi',
    'failed_to_update_business_status' => 'İşletme durumu güncellenemedi',
    'failed_to_logout_user' => 'Kullanıcı çıkış yapamadı',
    'error_locking_user' => 'Kullanıcı kilitlenirken hata oluştu',
    'error_unlocking_user' => 'Kullanıcı kilidi açılırken hata oluştu',
    'error_updating_user_status' => 'Kullanıcı durumu güncellenirken hata oluştu',
    'error_updating_login_permission' => 'Giriş izni güncellenirken hata oluştu',
    'error_updating_business_status' => 'İşletme durumu güncellenirken hata oluştu',
    'error_logging_out_user' => 'Kullanıcı çıkış yaparken hata oluştu',
    'confirm_force_logout' => 'Kullanıcıyı zorla çıkış yapmaya zorlamak istediğinizden emin misiniz: :username?',
    'confirm_lock_user' => 'Kullanıcıyı :duration dakika süreyle kilitlemek istediğinizden emin misiniz: :username?',
    'confirm_unlock_user' => 'Kullanıcının kilidini açmak istediğinizden emin misiniz: :username?',
    'confirm_toggle_user_status' => 'Kullanıcıyı :action istediğinizden emin misiniz: :username?',
    'confirm_toggle_login_permission' => 'Kullanıcı için :action istediğinizden emin misiniz: :username?',
    'confirm_toggle_business_status' => 'İşletmeyi :action istediğinizden emin misiniz: :business?',
    'activate' => 'etkinleştir',
    'deactivate' => 'devre dışı bırak',
    
    // Instant POS Button Strings
    'refresh_pos_cache' => 'Önbelleği Yenile',
    'instant_pos_enabled' => 'Anında POS Etkinleştirildi',
    'instant_pos_disabled' => 'Anında POS Devre Dışı',
    'disable_instant_pos' => 'Anında POS\'u Devre Dışı Bırak',
];
