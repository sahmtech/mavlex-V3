<?php

return [
    'app_settings' => 'Pengaturan Aplikasi',
    'manage_app_settings' => 'Kelola Pengaturan Aplikasi',
    'tab_2fa' => '2FA',
    'tab_theme' => 'Tampilan',
    'tab_login_page' => 'Halaman Login',
    'tab_sidebar' => 'Sidebar',
    'tab_language' => 'Bahasa',
    'tab_repair_status' => 'Status Perbaikan',
    'tab_logo' => 'Logo',
    // Buttons
    'update_settings' => 'Perbarui Pengaturan',

    'enable_custom_bg_image_for_login' => 'Aktifkan Latar Belakang Kustom untuk Login',
    'enable_custom_bg_image_for_login_tooltip' => 'Tetapkan gambar latar belakang kustom untuk halaman login.',

    'enable_custom_sidebar_logo' => 'Izinkan Logo Kustom di Sidebar',
    'enable_custom_sidebar_logo_tooltip' => 'Memungkinkan bisnis menggunakan logo kustom di sidebar.',

    // language.blade.php
    'header_language_change' => 'Ubah Bahasa di Header',
    'header_language_change_tooltip' => 'Izinkan pengguna mengganti bahasa dari header utama.',
    'header_languages_label' => 'Bahasa di Header',
    'header_languages_label_tooltip' => 'Pilih bahasa yang akan ditampilkan di header.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'Tampilkan Status Perbaikan di Layar Login',

    // 2fa.blade.php
    'enable_2fa' => 'Aktifkan 2FA',
    'enable_2fa_tooltip' => 'Aktifkan Autentikasi Dua Faktor (2FA) untuk aplikasi.',

    'force_2fa' => 'Wajibkan 2FA',
    'force_2fa_tooltip' => 'Pengguna harus menyiapkan 2FA sebelum bisa menggunakan aplikasi.',

    'recommend_2fa' => 'Sarankan 2FA',
    'recommend_2fa_tooltip' => 'Menampilkan pop-up satu kali saat login untuk mendorong pengguna mengaktifkan 2FA.',

    'allow_disable_2fa' => 'Izinkan Menonaktifkan 2FA Sementara',
    'allow_disable_2fa_tooltip' => 'Mengizinkan pengguna menonaktifkan 2FA sementara dalam jangka waktu tertentu.',

    'disable_2fa_duration_label' => 'Durasi Menonaktifkan 2FA',
    'disable_2fa_duration_label_tooltip' => 'Tentukan periode di mana 2FA dapat tetap nonaktif.',

    'disable_2fa_unit_label' => 'Satuan Durasi Nonaktif 2FA',

    'force_2fa_after_date_label' => 'Wajibkan 2FA Setelah Tanggal',
    'force_2fa_after_date_label_tooltip' => 'Setelah tanggal ini, semua pengguna harus mengaktifkan 2FA. Tanggal ini juga ditampilkan pada pop-up rekomendasi 2FA.',

    'primary_color_label' => 'Warna Utama',
    'primary_color_label_tooltip' => 'Pilih warna utama default aplikasi. Digunakan oleh bisnis yang tidak mengatur warna sendiri.',
    'secondary_color_label' => 'Warna Sekunder',
    'secondary_color_label_tooltip' => 'Pilih warna sekunder default aplikasi. Digunakan oleh bisnis yang tidak mengatur warna sendiri.',

    'allow_theme_change' => 'Izinkan Perubahan Tema',
    'allow_theme_change_tooltip' => 'Memungkinkan bisnis menyesuaikan warna tema mereka. Jika tidak diatur, bisnis akan menggunakan warna default yang ditentukan di sini.',

    'login_bg_image_label' => 'Gambar Latar Belakang Login',
    'login_bg_image_label_tooltip' => 'Mengunggah gambar baru akan mengganti latar belakang yang ada.',

    'logo_dark_tooltip'  => 'Ubah logo gelap default aplikasi (digunakan di mode terang).',
    'logo_light_tooltip' => 'Ubah logo terang default aplikasi (digunakan di mode gelap).',
    'favicon_tooltip' => 'Dimensi yang disarankan: 32×32 px. Ikon ini muncul di tab browser dan bookmark.',
    'upload_favicon' => 'Unggah Favicon',

    // Fonts
    'tab_fonts' => 'Font',
    'english_font' => 'Font Bahasa Inggris',
    'arabic_font' => 'Font Bahasa Arab',
    'custom_font_placeholder' => 'Masukkan nama font kustom...',
    'select_font' => 'Pilih font...',
    'or' => 'atau',
    'font_help_text' => 'Pilih dari daftar atau masukkan font kustom Anda.',
    'english_font_tooltip' => 'Masukkan nama font kustom atau pilih dari daftar. Anda dapat menemukan nama font di: :url',
    'arabic_font_tooltip' => 'Masukkan nama font kustom atau pilih dari daftar. Anda dapat menemukan nama font di: :url',

    //Recaptcha:
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha' => 'Aktifkan Google reCAPTCHA',
    'enable_recaptcha_tooltip' => 'Alihkan untuk mengaktifkan perlindungan reCAPTCHA. Dapatkan Site Key dan Secret dari: :url',
    'enable_recaptcha_text' => 'Aktifkan reCAPTCHA',
    'google_recaptcha_key' => 'Google reCAPTCHA Site Key',
    'google_recaptcha_secret' => 'Google reCAPTCHA Secret Key',
    'google_recaptcha_key_placeholder' => 'Masukkan Site Key Google reCAPTCHA Anda',
    'google_recaptcha_secret_placeholder' => 'Masukkan Secret Key Google reCAPTCHA Anda',

    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'Aktifkan Autentikasi Dua Faktor',
    'modal_enable_2fa_desc' => 'Kami menyarankan Anda mengaktifkan 2FA untuk meningkatkan keamanan akun Anda.',
    'enable_now_button' => 'Aktifkan Sekarang',
    'maybe_later_button' => 'Mungkin Nanti',
    'close_aria_label' => 'Tutup',

    // 2FA Verify page
    'one_time_password_heading' => 'One-Time Password',
    'one_time_password_label' => 'One-Time Password',
    'enter_2fa_code_placeholder' => 'Masukkan kode 2FA',
    'disable_2fa_for' => 'Nonaktifkan 2FA selama :duration :unit',
    'verify_button' => 'Verifikasi',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'Autentikasi Dua Faktor (2FA)',
    'google_auth_app_desc' => 'Aplikasi Google Authenticator',
    'configured_status' => 'Sudah Terkonfigurasi',
    'needs_configuration_status' => 'Belum Terkonfigurasi',
    'two_factor_scan_or_enter_msg' => 'Silakan pindai kode QR di bawah dengan Google Authenticator atau masukkan kuncinya secara manual, lalu masukkan kode yang dihasilkan.',
    'your_secret_key_msg' => 'Kunci rahasia Anda (untuk dimasukkan secara manual jika diperlukan):',

    // 2FA field labels
    'one_time_password_label' => 'One-Time Password',
    'enter_2fa_code_placeholder' => 'Masukkan kode 2FA',
    '2fa_will_be_forced_after_date' => '2FA akan diwajibkan setelah :date.',

    // Buttons
    '2fa' => '2FA',
    'verify_button' => 'Verifikasi',

    'confirm_access_recovery_codes' => 'Konfirmasi Akses',
    're_authenticate_message' => 'Anda harus melakukan autentikasi ulang untuk mengakses Pengaturan atau Kode Pemulihan 2FA.',
    'choose_method' => 'Pilih Metode:',
    'one_time_password' => 'One-Time Password (OTP)',
    'password' => 'Kata Sandi',
    'enter_code_or_password' => 'Masukkan kode / kata sandi:',
    'confirm' => 'Konfirmasi',

    '2fa_recovery_codes' => 'Kode Pemulihan 2FA',
    'recovery_codes_description' => 'Kode ini memungkinkan Anda masuk jika Anda kehilangan akses ke aplikasi autentikasi. Setiap kode hanya dapat digunakan satu kali.',
    'regenerate_codes' => 'Regenerasi Kode',
    'copy' => 'Salin',
    'copy_all' => 'Salin Semua',
    'no_recovery_codes_available' => 'Tidak ada kode pemulihan tersedia. Anda dapat membuat kode baru di bawah ini.',
    'copied' => 'Kode disalin ke clipboard!',
    'all_codes_copied' => 'Semua kode pemulihan telah disalin ke clipboard!',
    'supported_app' => 'Aplikasi yang Didukung',
    'supported_apps' => [
        'Authy' => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP' => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator' => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator' => ['Windows Phone'],
        'LastPass Authenticator' => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password' => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    // Social logins:
    'social_login_settings' => 'Pengaturan Login Sosial',
    'social_login_settings_help' => 'Masukkan kredensial login sosial Anda.',
    'client_id' => 'Client ID',
    'client_secret' => 'Client Secret',
    'redirect_url' => 'URL Redirect',
    'enter_client_id' => 'Masukkan Client ID untuk :provider',
    'enter_client_secret' => 'Masukkan Client Secret untuk :provider',
    'enter_redirect_url' => 'Masukkan Redirect URL untuk :provider',
    'enable_social_login' => 'Aktifkan Login Sosial',
    'tab_social' => 'Login Sosial',
    'or_login_with' => 'Atau login dengan',
    'force_otp_after_social_login' => 'Wajibkan OTP Setelah Login Sosial',
    'force_otp_after_social_login_tooltip' => 'Jika diaktifkan, pengguna yang login melalui sosial media akan diminta memasukkan kode OTP.',

    //Lock Users:
    'locked_until' => 'Terkunci Hingga',
    'locked_users' => 'Pengguna Terkunci',
    'view_locked_users' => 'Lihat Pengguna Terkunci',
    'tab_login_security' => 'Keamanan Login',
    'unlock' => 'Buka Kunci',
    'enable_user_lock_label' => 'Aktifkan Kunci Pengguna',
    'enable_user_lock_tooltip' => 'Aktifkan/Nonaktifkan penguncian pengguna setelah beberapa upaya login gagal.',
    'max_login_attempts_label' => 'Upaya Login Maksimum',
    'max_login_attempts_tooltip' => 'Jumlah upaya login yang diizinkan sebelum pengguna terkunci.',
    'lock_duration_label' => 'Durasi Penguncian',
    'lock_duration_tooltip' => 'Jumlah waktu (dalam angka) selama pengguna akan tetap terkunci.',
    'lock_duration_unit_label' => 'Satuan Durasi Penguncian',
    'lock_duration_unit_tooltip' => 'Pilih satuan waktu untuk durasi penguncian: menit, jam, hari, dll.',
    'account_locked_for_time_unit' => 'Akun Anda terkunci selama :time :unit.',
    'user_unlocked_message' => 'Pengguna berhasil dibuka kuncinya!',

    //Verify email:
    'verify_email_address_title' => 'Verifikasi Alamat Email Anda',
    'fresh_verification_sent' => 'Tautan verifikasi baru telah dikirim ke email Anda.',
    'verify_email_before_proceeding' => 'Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.',
    'did_not_receive_email' => 'Jika Anda tidak menerima email',
    'click_here_request_another' => 'klik di sini untuk meminta yang lain',
    'logout' => 'Keluar',
    'force_email_verify' => 'Wajibkan Verifikasi Email',
    'force_email_verify_tooltip' => 'Jika diaktifkan, pengguna harus memverifikasi email mereka sebelum mengakses sistem.',

     // Reset Mapping
     'reset_purchase_sell_mapping'     => 'Reset pemetaan pembelian-penjualan',
     'select_business'                 => 'Pilih Bisnis:',
     'all_businesses'                  => 'Semua Bisnis',
     'chunk_size'                      => 'Ukuran Chunk:',
     'reset_mapping'                   => 'Reset Pemetaan',
     'purchase_sell_mismatch_tooltip'  => 'Pilih pemetaan bisnis yang perlu di-reset. Jika Anda memiliki basis data besar, disarankan untuk mereset per bisnis.',
     'chunk_size_tooltip'              => 'Pemetaan akan di-reset dalam chunk yang lebih kecil. Untuk dataset besar, pilih ukuran chunk yang sesuai. Disarankan untuk mengaktifkan mode pemeliharaan.',
 
     // Maintenance Mode
     'tab_maintenance_mode'            => 'Mode Pemeliharaan',
     'maintenance_mode'                => 'Mode Pemeliharaan',
     'maintenance_mode_tooltip'        => 'Masukkan aplikasi ke mode pemeliharaan (pengunjung akan melihat layar pemeliharaan).',
     'enable_countdown'                => 'Aktifkan penghitung mundur',
     'enable_timer_tooltip'            => 'Tampilkan penghitung mundur langsung hingga pemeliharaan selesai.',
     'maintenance_duration'            => 'Durasi',
     'maintenance_unit'                => 'Unit Durasi',
     'minutes'                         => 'Menit',
     'hours'                           => 'Jam',
     'days'                            => 'Hari',
 
     // Maintenance page
     'under_maintenance'               => 'Sedang dalam pemeliharaan',
     'maintenance_heading'             => 'Kami sedang melakukan pemeliharaan.',
     'maintenance_subheading'          => 'Terima kasih atas kesabaran Anda!',
     'maintenance_back_in'             => 'Kami akan kembali dalam :time',
     'maintenance_back_no_timer'       => 'Kami akan kembali segera setelah pemeliharaan selesai.',
 
     // Mapping reset page
     'mapping_reset_progress'          => 'Progres Reset Pemetaan',
     'mapping_reset_in_progress'       => 'Reset pemetaan sedang berlangsung',
     'batch_status'                    => 'Status Batch',
     'refresh_status'                  => 'Segarkan Status',
 
     // Mapping reset result & status
     'mapping_reset_result'            => 'Hasil Reset Pemetaan',
     'chunk_processing_status'         => 'Status Pemrosesan Chunk',
 
     // Table headers
     'business'                        => 'Bisnis',
     'chunk_status'                    => 'Status Chunk',
     'total_chunks'                    => 'Total Chunk',
     'status'                          => 'Status',
 
     // Button
     'go_back'                         => 'Kembali',
 
     // Mapping Jobs
     'processed_jobs'                  => 'Tugas Pemetaan',
     'processed_jobs_subtitle'         => 'Semua batch pemetaan yang dikirim',
     'uuid'                            => 'UUID Batch',
     'job_name'                        => 'Nama Tugas',
     'completed_chunks'                => 'Chunk Selesai',
     'started_at'                      => 'Dimulai Pada',
     'finished_at'                     => 'Terakhir Diperbarui',
     'view_rebuild_jobs'               => 'Lihat Tugas Rebuild Stok',
 
     // Detailed instruction
     'reset_mapping_instruction'       => 
         "Disarankan untuk mengatur driver antrean Anda ke backend yang sebenarnya:\n" .
         "→ Di file .env Anda, atur `QUEUE_CONNECTION=database`.\n\n" .
         "Aktifkan juga Mode Pemeliharaan (Pengaturan Aplikasi → Mode Pemeliharaan) saat pemetaan berjalan untuk menghindari data duplikat atau terlewat.\n\n" .
         "Jika Anda memiliki basis data besar, reset akan memakan waktu lebih lama—pertimbangkan untuk mereset per bisnis.\n\n" .
         "Sebelum memulai:\n" .
         "• Buat cadangan lengkap basis data.\n" .
         "• Pantau proses melalui log untuk menangkap kesalahan.",
 
     'recovery_codes_generated_successfully' => 'Kode Pemulihan Berhasil Dihasilkan',
 
     // Disposable-email sync
     'sync_disposable_list'            => 'Sinkronkan Daftar Email Sekali Pakai',
     'sync_disposable_success'         => 'Daftar email sekali pakai diperbarui.',
     'sync_disposable_failed'          => 'Gagal menyinkronkan daftar email sekali pakai.',
 
     // Temporary-email protection
     'temp_email_protection'           => 'Lindungi dari email sekali pakai',
     'temp_email_protection_tooltip'   => 'Blokir domain email sementara/sekali pakai (mis. Mailinator, 10MinuteMail).',
     'disposable_not_allowed'          => 'Alamat email sekali pakai tidak diizinkan.',

     // 3.3
    'enable_sidebar_dropdown'         => 'Aktifkan Dropdown Sidebar',
    'enable_sidebar_dropdown_tooltip' => 'Satukan sub-menu ke dalam dropdown yang dapat diklik di sidebar.',
    // Custom Menu
    'menu'               => 'Menu',
    'menus_heading'      => 'Menu',
    'menus_description'  => 'Kelola dan atur item menu Anda.',
    'add_menu_item'      => 'Tambah Item Menu',
    'save_menu'          => 'Simpan Menu',
    'label'              => 'Label',
    'parent'             => 'Induk',
    'icon_type'          => 'Tipe Ikon',
    'svg'                => 'SVG',
    'fontawesome'        => 'FontAwesome',
    'svg_icon'           => 'Ikon SVG',
    'fa_class'           => 'Kelas FA',
    'named_route'        => 'Rute Bernama',
    'absolute_url'       => 'URL Absolut',
    'permission'         => 'Izin',
    'module_flag'        => 'Penanda Modul',
    'sort_order'         => 'Urutan',
    'active'             => 'Aktif?',
    'apply'              => 'Terapkan',
    'add_menu'           => 'Tambah Menu',
    'inactive'           => 'Nonaktif',
    'flush_cache'        => 'Bersihkan Cache',
    'reset_menu'         => 'Reset',
    'custom_menu'        => 'Menu Sidebar Kustom',

    'rebuilt_successfully' => 'Berhasil dibangun ulang',

    'sidebar_layout'        => 'Tata Letak Sidebar',
    'sidebar_layout_1'      => 'Layout 1 (Klasik)',
    'sidebar_layout_2'      => 'Layout 2 (Ringkas)',
    'sidebar_layout_custom' => 'Layout Kustom',

    'custom_sidebar_type'   => 'Tipe Sidebar Kustom',
    'sidebar'               => 'Sidebar',
    'topbar'                => 'Topbar',

    'tab_business_settings'    => 'Pengaturan Bisnis',
    'business_settings_layout' => 'Tata Letak Pengaturan Bisnis',
    'layout_1'                => 'Layout 1 – Tab Klasik',
    'layout_2'                => 'Layout 2 – Sidebar Modern',

    // Themes
    'predefined_theme_label'   => 'Tema Siap Pakai',
    'predefined_theme_tooltip' => 'Pilih palet warna siap pakai.',
    'select_theme'             => 'Pilih tema',
    'theme_default'            => 'Default',

    // Migration Data
    'app_settings'            => 'Pengaturan Aplikasi',
    'application_settings'    => 'Pengaturan Aplikasi',
    'storage_migration'       => 'Migrasi Penyimpanan',
    'manage_uploads_data'     => 'Kelola data unggahan Anda',

    'push'  => 'push',
    'pull'  => 'pull',
    'local' => 'lokal',
    'external_disk' => 'disk eksternal',
    'duplicate_files_skipped_safe_to_resume' => 'Berkas duplikat dilewati. Anda dapat menjalankan ulang untuk melanjutkan.',

    'direction'              => 'Arah',
    'push_local_to_external' => 'push (lokal → eksternal)',
    'pull_external_to_local' => 'pull (eksternal → lokal)',

    'from_disk' => 'Dari disk',
    'to_disk'   => 'Ke disk',

    'destination_visibility'        => 'Visibilitas tujuan',
    'visibility_none_bucket_signed' => '(tidak ada / kebijakan bucket / URL bertanda tangan)',
    'visibility_public_acl'         => 'publik (ACL objek)',
    'visibility_private_acl'        => 'privat (ACL objek)',

    'folders_to_include_optional' => 'Folder yang disertakan (opsional)',
    'folders_include_tooltip'     => 'Biarkan kosong untuk menyertakan semua folder di bawah uploads.',
    'select_all'                  => 'Pilih semua',
    'none'                        => 'Tidak ada',
    'invert'                      => 'Balikkan',
    'no_suggestions_found'        => 'Tidak ada saran ditemukan.',

    'delete_source_after_copy' => 'Hapus sumber setelah salin berhasil (pindah)',
    'dry_run_plan_only'        => 'Dry-run (hanya rencana)',
    'verbose_log_messages'     => 'Verbost (pesan log detail)',

    'execution'                    => 'Eksekusi',
    'execution_tooltip_html'       => 'Gunakan <strong>Langsung</strong> hanya untuk perpindahan kecil (mis. &lt; 1000 berkas). Untuk 5-10 GB gunakan pekerjaan latar belakang.',
    'pick_how_to_execute'          => 'Pilih cara menjalankan tugas migrasi.',
    'background_job_recommended'   => 'Pekerjaan latar belakang (disarankan)',
    'run_direct_now'               => 'Langsung (jalankan sekarang)',

    'start_migration' => 'Mulai migrasi',
    'reset'           => 'Reset',

    'progress' => 'Progres',
    'result'   => 'Hasil',

    // JS strings
    'from'                    => 'Dari',
    'to'                      => 'Ke',
    'folders'                 => 'Folder',
    'total'                   => 'Total',
    'copied'                  => 'Disalin',
    'skipped'                 => 'Dilewati',
    'deleted'                 => 'Dihapus',
    'failed'                  => 'Gagal',
    'invalid_response'        => 'Respons tidak valid',
    'failed_to_start_migration'=> 'Gagal memulai migrasi',
    'confirm_delete_source'   => 'Yakin ingin MENGHAPUS berkas sumber setelah disalin? Tindakan ini tidak dapat dibatalkan.',

    'default_storage_disk'      => 'Disk penyimpanan default',
    'default_storage_disk_help' => 'Tentukan lokasi penyimpanan berkas baru. "public" = storage/app/public via symlink /storage. "local" = public/uploads.',

    's3_compatible_settings'     => 'Pengaturan kompatibel S3',
    'display_label_optional'     => 'Label tampilan (opsional)',
    'placeholder_my_s3_provider' => 'Penyedia S3 saya',
    'display_only_admin_ui'      => 'Hanya untuk tampilan di UI admin.',
    'access_key'                 => 'Access Key',
    'secret_key'                 => 'Secret Key',
    'region'                     => 'Wilayah',
    'bucket'                     => 'Bucket',
    'endpoint'                   => 'Endpoint',
    'cdn_or_custom_domain_optional' => 'CDN / Domain kustom (opsional)',

    'disable_http_verify'      => 'Nonaktifkan verifikasi TLS',
    'disable_http_verify_help' => 'Off = verifikasi TLS aktif. On = dinonaktifkan (hanya di localhost).',

    'path_style_endpoint' => 'Endpoint gaya path',

    'use_signed_urls'      => 'Gunakan URL bertanda tangan (bucket privat)',
    'use_signed_urls_help' => 'Off = URL publik. On = privat dengan URL bertanda tangan.',

    'signed_url_ttl_minutes' => 'Masa berlaku URL bertanda tangan (menit)',
    'tab_storage_settings'   => 'Penyimpanan',
    'syncing'               => 'Sinkronisasi…',

    // POS Settings
    'pos_performance_settings'   => 'Pengaturan Performa POS',
    'enable_instant_pos'         => 'Aktifkan Instant POS',
    'enable_instant_pos_tooltip' => 'Tambah produk instan tanpa AJAX untuk performa lebih baik',
    'enable_instant_pos_help'    => 'Saat aktif, produk ditambahkan instan menggunakan data cache.',

    'enable_instant_search'            => 'Aktifkan Pencarian Instan',
    'enable_instant_search_tooltip'    => 'Cari produk instan menggunakan cache, bukan AJAX',
    'enable_instant_search_help'       => 'Saat aktif, pencarian berjalan instan tanpa permintaan server',

    'pos_performance_info_title' => 'Peningkatan Performa',
    'pos_performance_info_desc'  => 'Instant POS meningkatkan performa dengan mengurangi permintaan server:',
    'instant_pos_benefit_1'      => 'Produk langsung ditambahkan tanpa menunggu server',
    'instant_pos_benefit_2'      => 'Hasil pencarian muncul seketika',
    'instant_pos_benefit_3'      => 'Stok otomatis diperbarui setelah setiap penjualan',
    'instant_pos_benefit_4'      => 'Bekerja offline-first lalu sinkron dengan server',

    'pos_cache_settings'                    => 'Pengaturan Cache POS',
    'pos_cache_refresh_interval'            => 'Interval penyegaran cache',
    'pos_cache_refresh_interval_tooltip'    => 'Seberapa sering cache produk disegarkan',
    'pos_cache_refresh_interval_help'       => 'Otomatis setelah setiap penjualan; interval manual sebagai cadangan',
    'auto_refresh'                          => 'Otomatis (setelah penjualan)',
    '30_minutes'                            => '30 Menit',
    '60_minutes'                            => '60 Menit',
    '2_hours'                               => '2 Jam',
    'manual_only'                           => 'Manual saja',

    'pos_max_cached_products'         => 'Maks produk di cache',
    'pos_max_cached_products_tooltip' => 'Jumlah maksimum produk yang dicache',
    'pos_max_cached_products_help'    => 'Angka lebih tinggi = cakupan lebih baik tetapi pakai memori lebih. Pilih "Tak Terbatas" untuk semua.',
    'unlimited'                       => 'Tak Terbatas',

    // Loading messages
    'loading_products'                => 'Memuat produk…',
    'please_wait_while_products_load' => 'Harap tunggu, produk sedang dimuat',
    'loading_products_placeholder'    => 'Memuat produk…',
    'updating_stock'                  => 'Memperbarui stok…',
    'failed_to_load_cache'            => 'Gagal memuat cache produk. Fungsi POS mungkin terbatas.',

    // OTP Verification
    'otp_verification' => 'Verifikasi OTP',
    'otp_verification_management' => 'Manajemen Verifikasi OTP',
    'manage_otp_verification_requests' => 'Kelola permintaan verifikasi OTP dan lihat statistik',
    'active_otps' => 'OTP Aktif',
    'unverified_users' => 'Pengguna Belum Terverifikasi',
    'expired_otps' => 'OTP Kedaluwarsa',
    'failed_attempts' => 'Percobaan Gagal',
    'pending_users' => 'Pengguna Tertunda',
    'today_requests' => 'Permintaan Hari Ini',
    'high_retries' => 'Percobaan Ulang Tinggi',
    'user_info' => 'Info Pengguna',
    'otp_code' => 'Kode OTP',
    'attempts' => 'Percobaan',
    'resend_count' => 'Jumlah Kirim Ulang',
    'no_active_otp' => 'Tidak Ada OTP Aktif',
    'expired' => 'Kedaluwarsa',
    'active' => 'Aktif',
    'expires_in' => 'Kedaluwarsa dalam',
    'remaining' => 'tersisa',
    'resends' => 'kirim ulang',
    'last' => 'Terakhir',
    'updated' => 'Diperbarui',
    'verify' => 'Verifikasi',
    'manual_verify_email' => 'Verifikasi Email Manual',
    'reset_otp' => 'Reset OTP',
    'manual_verify' => 'Verifikasi Manual',
    'deactivate' => 'Nonaktifkan',
    
    // JavaScript messages
    'confirm_reset_otp' => 'Apakah Anda yakin ingin mereset OTP ini? Pengguna perlu meminta yang baru.',
    'failed_to_reset_otp' => 'Gagal mereset OTP',
    'error_resetting_otp' => 'Terjadi kesalahan saat mereset OTP',
    'confirm_verify_unverified_user' => 'Apakah Anda yakin ingin memverifikasi email secara manual untuk pengguna yang belum terverifikasi: :username?',
    'confirm_verify_user' => 'Apakah Anda yakin ingin memverifikasi email secara manual untuk pengguna: :username?',
    'user_verified_removed_from_list' => 'Email pengguna terverifikasi - pengguna tidak akan lagi muncul dalam daftar yang belum terverifikasi',
    'failed_to_verify_user' => 'Gagal memverifikasi pengguna',
    'error_verifying_user' => 'Terjadi kesalahan saat memverifikasi pengguna',
    'confirm_deactivate_token' => 'Apakah Anda yakin ingin menonaktifkan token OTP ini?',
    'failed_to_deactivate_token' => 'Gagal menonaktifkan token',
    'error_deactivating_token' => 'Terjadi kesalahan saat menonaktifkan token',

    // Session Management
    'session_management' => 'Manajemen Sesi',
    'manage_user_sessions' => 'Kelola sesi pengguna dan keamanan',
    'total_sessions' => 'Total Sesi',
    'active_users' => 'Pengguna Aktif',
    'file_sessions' => 'Sesi File',
    'database_sessions' => 'Sesi Database',
    'session_actions' => 'Aksi',
    'user_name' => 'Nama Pengguna',
    'device_info' => 'Info Perangkat',
    'ip_address' => 'Alamat IP',
    'last_activity' => 'Aktivitas Terakhir',
    'session_id' => 'ID Sesi',
    'force_logout' => 'Paksa Keluar',
    'view_session_details' => 'Lihat Detail Sesi',
    'invalidate_all_sessions' => 'Batalkan Semua Sesi',
    'filter_by_user' => 'Filter berdasarkan Pengguna',
    'filter_by_session_type' => 'Filter berdasarkan Tipe Sesi',
    'all_session_types' => 'Semua Tipe Sesi',
    'confirm_force_logout' => 'Apakah Anda yakin ingin memaksa keluar sesi ini? Pengguna akan diminta login ulang.',
    'confirm_invalidate_all' => 'Apakah Anda yakin ingin membatalkan semua sesi pengguna ini? Semua sesi aktif akan diakhiri.',
    'session_invalidated' => 'Sesi berhasil dibatalkan',
    'all_sessions_invalidated' => 'Semua sesi pengguna berhasil dibatalkan',
    'session_details' => 'Detail Sesi',
    'session_data' => 'Data Sesi',
    'user_agent' => 'User Agent',
    'session_payload' => 'Payload Sesi',
    'created_at' => 'Dibuat Pada',
    'updated_at' => 'Diperbarui Pada',
    'expires_at' => 'Berakhir Pada',
    'session_driver' => 'Driver Sesi',
    'unknown_device' => 'Perangkat Tidak Dikenal',
    'unknown_browser' => 'Browser Tidak Dikenal',
    'unknown_platform' => 'Platform Tidak Dikenal',
    'desktop' => 'Desktop',
    'mobile' => 'Mobile',
    'tablet' => 'Tablet',
    'current_session' => 'Sesi Saat Ini',
    'other_sessions' => 'Sesi Lainnya',
    'session_location' => 'Lokasi Sesi',
    'refresh_sessions' => 'Segarkan Sesi',
    'auto_refresh' => 'Penyegaran Otomatis',
    'manual_refresh' => 'Penyegaran Manual',
    'bulk_actions' => 'Aksi Massal',
    'select_all_sessions' => 'Pilih Semua Sesi',
    'logout_selected' => 'Keluar yang Dipilih',
    'export_sessions' => 'Ekspor Sesi',
    'session_statistics' => 'Statistik Sesi',
    'concurrent_sessions' => 'Sesi Bersamaan',
    'average_session_duration' => 'Durasi Rata-rata Sesi',
    'peak_concurrent_users' => 'Puncak Pengguna Bersamaan',
    'session_security' => 'Keamanan Sesi',
    'suspicious_activity' => 'Aktivitas Mencurigakan',
    'multiple_ip_sessions' => 'Sesi Multi-IP',
    'session_timeout' => 'Timeout Sesi',
    'force_single_session' => 'Paksa Sesi Tunggal',
    'session_encryption' => 'Enkripsi Sesi',
    'secure_session_only' => 'Hanya Sesi Aman',

    // Instant POS Button Strings
    'refresh_pos_cache' => 'Segarkan Cache',
    'instant_pos_enabled' => 'POS Instan Diaktifkan',
    'instant_pos_disabled' => 'POS Instan Dinonaktifkan',
    'disable_instant_pos' => 'Nonaktifkan POS Instan',
];
