<?php

return [

    'app_settings' => 'إعدادات التطبيق',
    'manage_app_settings' => 'إدارة إعدادات التطبيق',
    'tab_2fa' => 'المصادقة الثنائية (2FA)',
    'tab_theme' => 'المظهر',
    'tab_login_page' => 'صفحة تسجيل الدخول',
    'tab_sidebar' => 'الشريط الجانبي',
    'tab_language' => 'اللغة',
    'tab_repair_status' => 'حالة الإصلاح',
    'tab_logo' => 'الشعار',
    // Buttons
    'update_settings' => 'تحديث الإعدادات',

    'enable_custom_bg_image_for_login' => 'تمكين خلفية مخصصة لتسجيل الدخول',
    'enable_custom_bg_image_for_login_tooltip' => 'تعيين صورة خلفية مخصصة لصفحة تسجيل الدخول.',

    'enable_custom_sidebar_logo' => 'السماح بشعار مخصص في الشريط الجانبي',
    'enable_custom_sidebar_logo_tooltip' => 'السماح للمؤسسات باستخدام شعار مخصص في الشريط الجانبي.',

    // language.blade.php
    'header_language_change' => 'تغيير اللغة من الرأس',
    'header_language_change_tooltip' => 'السماح للمستخدمين بتبديل اللغة من الرأس الرئيسي.',
    'header_languages_label' => 'اللغات في الرأس',
    'header_languages_label_tooltip' => 'اختر اللغات التي سيتم عرضها في الرأس.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'عرض حالة الإصلاح في شاشة تسجيل الدخول',

    // 2fa.blade.php
    'enable_2fa' => 'تمكين المصادقة الثنائية (2FA)',
    'enable_2fa_tooltip' => 'تفعيل المصادقة الثنائية للتطبيق.',

    'force_2fa' => 'فرض المصادقة الثنائية',
    'force_2fa_tooltip' => 'يجب على المستخدمين إعداد المصادقة الثنائية قبل استخدام التطبيق.',

    'recommend_2fa' => 'التوصية بالمصادقة الثنائية',
    'recommend_2fa_tooltip' => 'سيظهر إشعار مرة واحدة عند تسجيل الدخول لتشجيع المستخدمين على تفعيل المصادقة الثنائية.',

    'allow_disable_2fa' => 'السماح بالتعطيل المؤقت للمصادقة الثنائية',
    'allow_disable_2fa_tooltip' => 'السماح للمستخدمين بتعطيل المصادقة الثنائية مؤقتًا حتى وقت محدد.',

    'disable_2fa_duration_label' => 'مدة تعطيل المصادقة الثنائية',
    'disable_2fa_duration_label_tooltip' => 'حدد الفترة الزمنية التي يمكن فيها تعطيل المصادقة الثنائية.',

    'disable_2fa_unit_label' => 'وحدة مدة تعطيل المصادقة الثنائية',

    'force_2fa_after_date_label' => 'فرض المصادقة الثنائية بعد تاريخ محدد',
    'force_2fa_after_date_label_tooltip' => 'بعد هذا التاريخ، يجب على جميع المستخدمين تمكين المصادقة الثنائية. سيظهر هذا التاريخ أيضًا في إشعار التوصية بالمصادقة الثنائية.',

    'primary_color_label' => 'اللون الأساسي',
    'primary_color_label_tooltip' => 'اختر اللون الأساسي الافتراضي للتطبيق. سيتم استخدامه للمؤسسات التي لا تختار ألوانًا خاصة بها.',
    'secondary_color_label' => 'اللون الثانوي',
    'secondary_color_label_tooltip' => 'اختر اللون الثانوي الافتراضي للتطبيق. سيتم استخدامه للمؤسسات التي لا تختار ألوانًا خاصة بها.',

    'allow_theme_change' => 'السماح بتغيير المظهر',
    'allow_theme_change_tooltip' => 'تمكين المؤسسات من تخصيص ألوان المظهر. عند التمكين، ستستخدم المؤسسات التي لا تملك ألوانًا مخصصة الألوان الافتراضية المحددة هنا بواسطة المشرف العام.',

    'login_bg_image_label' => 'صورة خلفية تسجيل الدخول',
    'login_bg_image_label_tooltip' => 'سيؤدي تحميل صورة جديدة إلى استبدال الخلفية الحالية.',

    'logo_dark_tooltip'  => 'تغيير الشعار الداكن الافتراضي للتطبيق (الوضع الفاتح).',
    'logo_light_tooltip' => 'تغيير الشعار الفاتح الافتراضي للتطبيق (الوضع الداكن).',
    'favicon_tooltip' => 'الأبعاد الموصى بها: 32×32 بكسل. يظهر هذا الرمز في علامات التبويب والإشارات المرجعية في المتصفح.',
    'upload_favicon' => 'تحميل أيقونة Favicon',

    // Fonts
    'tab_fonts' => 'الخطوط',
    'english_font' => 'الخط الإنجليزي',
    'arabic_font' => 'الخط العربي',
    'custom_font_placeholder' => 'أدخل اسم خط مخصص...',
    'select_font' => 'اختر خطًا...',
    'or' => 'أو',
    'font_help_text' => 'اختر من القائمة أو أدخل خطك المخصص.',
    'english_font_tooltip' => 'أدخل اسم خط مخصص أو اختر من القائمة. ابحث عن أسماء الخطوط في :url',
    'arabic_font_tooltip' => 'أدخل اسم خط مخصص أو اختر من القائمة. ابحث عن أسماء الخطوط في :url',

    //Recaptcha:
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha' => 'تمكين Google reCAPTCHA',
    'enable_recaptcha_tooltip' => 'قم بالتبديل لتمكين حماية reCAPTCHA. احصل على مفاتيحك من :url',
    'enable_recaptcha_text' => 'تفعيل reCAPTCHA',
    'google_recaptcha_key' => 'مفتاح موقع Google reCAPTCHA',
    'google_recaptcha_secret' => 'المفتاح السري لـ Google reCAPTCHA',
    'google_recaptcha_key_placeholder' => 'أدخل مفتاح موقع Google reCAPTCHA',
    'google_recaptcha_secret_placeholder' => 'أدخل المفتاح السري لـ Google reCAPTCHA',

    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'تفعيل المصادقة الثنائية',
    'modal_enable_2fa_desc' => 'نوصي بتفعيل المصادقة الثنائية (2FA) لتعزيز أمان حسابك.',
    'enable_now_button' => 'تفعيل الآن',
    'maybe_later_button' => 'ربما لاحقًا',
    'close_aria_label' => 'إغلاق',

    // 2FA Verify page
    'one_time_password_heading' => 'كلمة المرور لمرة واحدة',
    'one_time_password_label' => 'كلمة المرور لمرة واحدة',
    'enter_2fa_code_placeholder' => 'أدخل رمز المصادقة الثنائية',
    'disable_2fa_for' => 'تعطيل المصادقة الثنائية لمدة :duration :unit',
    'verify_button' => 'تحقق',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'المصادقة الثنائية',
    'google_auth_app_desc' => 'تطبيق Google Authenticator',
    'configured_status' => 'مُعد',
    'needs_configuration_status' => 'غير مُعد',
    'two_factor_scan_or_enter_msg' => 'يرجى مسح رمز الاستجابة السريعة أدناه باستخدام Google Authenticator أو إدخال المفتاح يدويًا، ثم إدخال الرمز المولد.',
    'your_secret_key_msg' => 'مفتاحك السري (لإدخاله يدويًا عند الحاجة):',

    // 2FA field labels
    'one_time_password_label' => 'كلمة المرور لمرة واحدة',
    'enter_2fa_code_placeholder' => 'أدخل رمز المصادقة الثنائية',
    '2fa_will_be_forced_after_date' => 'سيتم فرض المصادقة الثنائية بعد :date.',

    // Buttons
    '2fa' => 'المصادقة الثنائية (2FA)',
    'verify_button' => 'تحقق',

    'confirm_access_recovery_codes' => 'تأكيد الوصول',
    're_authenticate_message' => 'يجب إعادة المصادقة للوصول إلى الإعدادات أو رموز الاسترداد للمصادقة الثنائية.',
    'choose_method' => 'اختر الطريقة:',
    'one_time_password' => 'كلمة مرور لمرة واحدة (OTP)',
    'password' => 'كلمة المرور',
    'enter_code_or_password' => 'أدخل الرمز / كلمة المرور:',
    'confirm' => 'تأكيد',

    '2fa_recovery_codes' => 'رموز الاسترداد للمصادقة الثنائية',
    'recovery_codes_description' => 'تتيح لك هذه الرموز تسجيل الدخول إذا فقدت الوصول إلى جهاز المصادقة. يمكن استخدام كل رمز مرة واحدة فقط.',
    'regenerate_codes' => 'إعادة إنشاء الرموز',
    'copy' => 'نسخ',
    'copy_all' => 'نسخ الكل',
    'no_recovery_codes_available' => 'لا توجد رموز استرداد متاحة. يمكنك إنشاء رموز جديدة أدناه.',
    'copied' => 'تم نسخ الرمز إلى الحافظة!',
    'all_codes_copied' => 'تم نسخ جميع رموز الاسترداد إلى الحافظة!',
    'supported_app' => 'التطبيق المدعوم',
    'supported_apps' => [
        'Authy' => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP' => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator' => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator' => ['Windows Phone'],
        'LastPass Authenticator' => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password' => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    // Social logins:
    'social_login_settings' => 'إعدادات تسجيل الدخول عبر الشبكات الاجتماعية',
    'social_login_settings_help' => 'أدخل بيانات اعتماد تسجيل الدخول الاجتماعي الخاصة بك.',
    'client_id' => 'معرف العميل (Client ID)',
    'client_secret' => 'سر العميل (Client Secret)',
    'redirect_url' => 'عنوان إعادة التوجيه (Redirect URL)',
    'enter_client_id' => 'أدخل معرف العميل لـ :provider',
    'enter_client_secret' => 'أدخل سر العميل لـ :provider',
    'enter_redirect_url' => 'أدخل عنوان إعادة التوجيه لـ :provider',
    'enable_social_login' => 'تمكين تسجيل الدخول عبر الشبكات الاجتماعية',
    'tab_social' => 'تسجيل الدخول الاجتماعي',
    'or_login_with' => 'أو سجّل الدخول باستخدام',
    'force_otp_after_social_login' => 'فرض رمز مرة واحدة بعد تسجيل الدخول الاجتماعي',
    'force_otp_after_social_login_tooltip' => 'إذا تم التفعيل، سيُطلب من المستخدمين الذين يسجلون الدخول عبر الشبكات الاجتماعية إدخال رمز مرة واحدة (OTP).',

    //Lock Users:
    'locked_until' => 'مغلق حتى',
    'locked_users' => 'المستخدمون المقفلون',
    'view_locked_users' => 'عرض المستخدمين المقفلين',
    'tab_login_security' => 'أمان تسجيل الدخول',
    'unlock' => 'إلغاء القفل',
    'enable_user_lock_label' => 'تمكين قفل المستخدم',
    'enable_user_lock_tooltip' => 'تمكين/تعطيل قفل المستخدم بعد محاولات تسجيل دخول فاشلة.',
    'max_login_attempts_label' => 'الحد الأقصى لمحاولات تسجيل الدخول',
    'max_login_attempts_tooltip' => 'عدد المحاولات المسموح بها قبل قفل المستخدم.',
    'lock_duration_label' => 'مدة القفل',
    'lock_duration_tooltip' => 'المدة الزمنية التي سيتم قفل المستخدم خلالها (أرقام).',
    'lock_duration_unit_label' => 'وحدة مدة القفل',
    'lock_duration_unit_tooltip' => 'اختر الوحدة الزمنية لمدة القفل: دقائق، ساعات، أيام... إلخ.',
    'account_locked_for_time_unit' => 'تم قفل حسابك لمدة :time :unit.',
    'user_unlocked_message' => 'تم إلغاء قفل المستخدم بنجاح!',

    //Verify email:
    'verify_email_address_title' => 'تحقق من بريدك الإلكتروني',
    'fresh_verification_sent' => 'تم إرسال رابط تحقق جديد إلى بريدك الإلكتروني.',
    'verify_email_before_proceeding' => 'قبل المتابعة، يُرجى التحقق من بريدك الإلكتروني للعثور على رابط التحقق.',
    'did_not_receive_email' => 'إذا لم يصلك البريد الإلكتروني',
    'click_here_request_another' => 'انقر هنا لطلب رابط جديد',
    'logout' => 'تسجيل الخروج',
    'force_email_verify' => 'فرض التحقق من البريد الإلكتروني',
    'force_email_verify_tooltip' => 'إذا تم التمكين، يجب على المستخدمين التحقق من بريدهم الإلكتروني قبل الوصول إلى النظام.',



        // Reset Mapping
        'reset_purchase_sell_mapping'   => 'إعادة تعيين تطابق الشراء-البيع',
        'select_business'               => 'اختر النشاط التجاري:',
        'all_businesses'                => 'جميع الأنشطة التجارية',
        'chunk_size'                    => 'حجم الدُفعة:',
        'reset_mapping'                 => 'إعادة تعيين التطابق',
        'purchase_sell_mismatch_tooltip' => 'اختر التطابقات التجارية التي تحتاج لإعادة التعيين. إذا كان لديك قاعدة بيانات كبيرة، نوصي بإعادة التعيين لكل نشاط تجاري على حدة.',
        'chunk_size_tooltip'             => 'سيتم إعادة التعيين على دفعات أصغر. لبيانات كبيرة، اختر حجم دُفعة مناسب. يُفضل تفعيل وضع الصيانة.',
    
        // Maintenance Mode
        'tab_maintenance_mode'       => 'وضع الصيانة',
        'maintenance_mode'           => 'وضع الصيانة',
        'maintenance_mode_tooltip'   => 'وضع التطبيق في الصيانة (سيشاهد الزوار شاشة الصيانة).',
        'enable_countdown'           => 'تفعيل عدّاد تنازلي',
        'enable_timer_tooltip'       => 'عرض عد تنازلي مباشر حتى انتهاء الصيانة.',
        'maintenance_duration'       => 'المدة',
        'maintenance_unit'           => 'وحدة المدة',
        'minutes'                    => 'دقائق',
        'hours'                      => 'ساعات',
        'days'                       => 'أيام',
    
        // Maintenance page
        'under_maintenance'          => 'قيد الصيانة',
        'maintenance_heading'        => 'نقوم ببعض أعمال الصيانة.',
        'maintenance_subheading'     => 'شكرًا لصبرك!',
        'maintenance_back_in'        => 'سنعود بعد :time',
        'maintenance_back_no_timer'  => 'سنعود فور انتهائنا من الصيانة.',
    
        // Mapping reset page
        'mapping_reset_progress'     => 'تقدم إعادة التطابق',
        'mapping_reset_in_progress'  => 'جاري إعادة التطابق',
        'batch_status'               => 'حالة الدُفعة',
        'refresh_status'             => 'تحديث الحالة',
    
        // Mapping reset result & status
        'mapping_reset_result'       => 'نتيجة إعادة التطابق',
        'chunk_processing_status'    => 'حالة معالجة الدُفعات',
    
        // Table headers
        'business'                   => 'النشاط التجاري',
        'chunk_status'               => 'حالة الدُفعة',
        'total_chunks'               => 'إجمالي الدُفعات',
        'status'                     => 'الحالة',
    
        // Buttons
        'go_back'                    => 'رجوع',
    
        // Jobs
        'processed_jobs'             => 'مهام التطابق',
        'processed_jobs_subtitle'    => 'جميع دفعات إعادة التطابق المُرسلة',
        'uuid'                       => 'معرّف الدُفعة (UUID)',
        'job_name'                   => 'اسم المهمة',
        'completed_chunks'           => 'الدُفعات المنجزة',
        'started_at'                 => 'بدأ في',
        'finished_at'                => 'آخر تحديث',
        'view_rebuild_jobs'          => 'عرض مهام إعادة بناء المخزون',
    
        // Detailed instruction
        'reset_mapping_instruction'  => "يوصى بتعيين موصل قائمة الانتظار إلى مصدر حقيقي:\n".
                                        "→ في ملف .env، ضع `QUEUE_CONNECTION=database`.\n\n".
                                        "كما يُفضل تفعيل وضع الصيانة (إعدادات التطبيق → وضع الصيانة) أثناء تشغيل إعادة التطابق لتجنب البيانات المكررة أو المفقودة.\n\n".
                                        "إذا كانت قاعدة بياناتك كبيرة، سيستغرق إعادة التعيين وقتًا أطول—فكر في إعادة التعيين لكل نشاط تجاري على حدة.\n\n".
                                        "قبل البدء:\n".
                                        "• قم بعمل نسخة احتياطية كاملة لقاعدة البيانات.\n".
                                        "• راقب العملية عبر السجلات لاكتشاف أي أخطاء.",
    
        'recovery_codes_generated_successfully' => 'تم إنشاء رموز الاسترداد بنجاح',
    
        // Disposable‐email sync
        'sync_disposable_list'      => 'مزامنة قائمة البريد المؤقت',
        'sync_disposable_success'   => 'تم تحديث قائمة البريد المؤقت بنجاح.',
        'sync_disposable_failed'    => 'فشل في مزامنة قائمة البريد المؤقت.',
    
        // Temporary‐email protection
        'temp_email_protection'          => 'منع عناوين البريد المؤقتة',
        'temp_email_protection_tooltip'  => 'حظر مجالات البريد المؤقت (مثل Mailinator، 10MinuteMail).',
        'disposable_not_allowed'         => 'عناوين البريد المؤقتة غير مسموح بها.',

        // 3.3
    'enable_sidebar_dropdown'         => 'تفعيل قائمة جانبية منسدلة',
    'enable_sidebar_dropdown_tooltip' => 'طي القوائم الفرعية داخل الشريط الجانبي في قائمة منسدلة قابلة للنقر.',
    // Custom Menu
    'menu'                => 'القائمة',
    'menus_heading'       => 'القوائم',
    'menus_description'   => 'إدارة عناصر القائمة وتنظيمها.',
    'add_menu_item'       => 'إضافة عنصر قائمة',
    'save_menu'           => 'حفظ القائمة',
    'label'               => 'التسمية',
    'parent'              => 'الأصل',
    'icon_type'           => 'نوع الأيقونة',
    'svg'                 => 'SVG',
    'fontawesome'         => 'فونت أوسم',
    'svg_icon'            => 'أيقونة SVG',
    'fa_class'            => 'فئة FA',
    'named_route'         => 'مسار مُسمّى',
    'absolute_url'        => 'رابط مطلق',
    'permission'          => 'صلاحية',
    'module_flag'         => 'علم الوحدة',
    'sort_order'          => 'ترتيب الفرز',
    'active'              => 'نشط؟',
    'apply'               => 'تطبيق',
    'add_menu'            => 'إضافة قائمة',
    'inactive'            => 'غير نشط',
    'flush_cache'         => 'مسح الكاش',
    'reset_menu'          => 'إعادة تعيين',
    'custom_menu'         => 'قائمة جانبية مخصصة',
    'rebuilt_successfully'=> 'أُعيد البناء بنجاح',

    'sidebar_layout'        => 'تخطيط الشريط الجانبي',
    'sidebar_layout_1'      => 'التخطيط 1 (كلاسيكي)',
    'sidebar_layout_2'      => 'التخطيط 2 (مضغوط)',
    'sidebar_layout_custom' => 'تخطيط مخصص',

    'custom_sidebar_type'   => 'نوع الشريط الجانبي المخصص',
    'sidebar'               => 'شريط جانبي',
    'topbar'                => 'شريط علوي',

    'tab_business_settings'   => 'إعدادات العمل',
    'business_settings_layout'=> 'تخطيط إعدادات العمل',
    'layout_1'               => 'التخطيط 1 – تبويبات كلاسيكية',
    'layout_2'               => 'التخطيط 2 – شريط جانبي حديث',

    // Themes
    'predefined_theme_label'   => 'سمة جاهزة',
    'predefined_theme_tooltip' => 'اختر لوحة ألوان جاهزة.',
    'select_theme'             => 'اختر سمة',
    'theme_default'            => 'افتراضي',

    // Migration Data
    'app_settings'                       => 'إعدادات التطبيق',
    'application_settings'               => 'إعدادات التطبيق',
    'storage_migration'                  => 'ترحيل التخزين',
    'manage_uploads_data'                => 'إدارة بيانات التحميلات',

    'push'                               => 'دفع',
    'pull'                               => 'سحب',
    'local'                              => 'محلي',
    'external_disk'                      => 'قرص خارجي',
    'duplicate_files_skipped_safe_to_resume' => 'تم تخطي الملفات المكررة. يمكنك إعادة التشغيل بأمان للاستئناف.',

    'direction'                  => 'الاتجاه',
    'push_local_to_external'     => 'دفع (محلي → خارجي)',
    'pull_external_to_local'     => 'سحب (خارجي → محلي)',

    'from_disk' => 'من قرص',
    'to_disk'   => 'إلى قرص',

    'destination_visibility'        => 'رؤية الوجهة',
    'visibility_none_bucket_signed' => '(بدون / سياسة الحاوية / روابط موقّعة)',
    'visibility_public_acl'         => 'عام (ACL للكائن)',
    'visibility_private_acl'        => 'خاص (ACL للكائن)',

    'folders_to_include_optional' => 'المجلدات المراد تضمينها (اختياري)',
    'folders_include_tooltip'     => 'اتركه فارغًا لتضمين جميع المجلدات تحت جذر التحميلات.',
    'select_all'                  => 'تحديد الكل',
    'none'                        => 'لا شيء',
    'invert'                      => 'عكس',
    'no_suggestions_found'        => 'لم يتم العثور على اقتراحات.',

    'delete_source_after_copy' => 'حذف المصدر بعد النسخ الناجح (نقل)',
    'dry_run_plan_only'        => 'تشغيل تجريبي (خطة فقط)',
    'verbose_log_messages'     => 'تفصيلي (رسائل السجل في الحالة)',

    'execution'                    => 'التنفيذ',
    'execution_tooltip_html'       => 'استخدم <strong>مباشر</strong> فقط للعمليات الصغيرة (مثال: < 1000 ملف). للمساحات 5-10 جيجابايت، يُفضّل المهمة الخلفية.',
    'pick_how_to_execute'          => 'اختر كيفية تنفيذ مهمة الترحيل.',
    'background_job_recommended'   => 'مهمة خلفية (موصى به)',
    'run_direct_now'               => 'مباشر (تشغيل الآن)',

    'start_migration' => 'بدء الترحيل',
    'reset'           => 'إعادة تعيين',

    'progress' => 'التقدم',
    'result'   => 'النتيجة',

    // JS strings
    'from'                    => 'من',
    'to'                      => 'إلى',
    'folders'                 => 'المجلدات',
    'total'                   => 'الإجمالي',
    'copied'                  => 'تم النسخ',
    'skipped'                 => 'تم التخطي',
    'deleted'                 => 'تم الحذف',
    'failed'                  => 'فشل',
    'invalid_response'        => 'استجابة غير صالحة',
    'failed_to_start_migration'=> 'فشل في بدء الترحيل',
    'confirm_delete_source'   => 'هل أنت متأكد أنك تريد حــذف ملفات المصدر بعد النسخ؟ هذا الإجراء لا يمكن التراجع عنه.',

    'default_storage_disk'       => 'قرص التخزين الافتراضي',
    'default_storage_disk_help'  => 'اختر أين يتم حفظ الملفات الجديدة افتراضيًا. "public" = ‎storage/app/public‎ عبر الرابط الرمزي /storage. "local" = ‎public/uploads‎.',

    's3_compatible_settings'     => 'إعدادات متوافقة مع ‎S3',
    'display_label_optional'     => 'تسمية العرض (اختياري)',
    'placeholder_my_s3_provider' => 'مزود S3 الخاص بي',
    'display_only_admin_ui'      => 'للعرض في واجهة المشرف فقط.',
    'access_key'                 => 'مفتاح الوصول',
    'secret_key'                 => 'المفتاح السري',
    'region'                     => 'المنطقة',
    'bucket'                     => 'حاوية',
    'endpoint'                   => 'نقطة النهاية',
    'cdn_or_custom_domain_optional' => 'CDN / نطاق مخصص (اختياري)',

    'disable_http_verify'      => 'تعطيل التحقق TLS',
    'disable_http_verify_help' => 'إيقاف = تحقق TLS مفعّل. تشغيل = تحقق TLS معطَّل (فقط في localhost للاختبار).',

    'path_style_endpoint'      => 'نقطة نهاية بأسلوب المسار',

    'use_signed_urls'          => 'استخدام روابط موقّعة (إبقاء الحاوية خاصة)',
    'use_signed_urls_help'     => 'إيقاف = روابط عامة (يجب أن تسمح الحاوية / CDN بالقراءة العامة). تشغيل = خاصة مع روابط موقّعة.',

    'signed_url_ttl_minutes' => 'مدة صلاحية الرابط الموقّع (دقائق)',
    'tab_storage_settings'   => 'التخزين',
    'syncing'               => 'جارٍ المزامنة...',

    // POS Settings
    'pos_performance_settings'         => 'إعدادات أداء POS',
    'enable_instant_pos'               => 'تفعيل Instant POS',
    'enable_instant_pos_tooltip'       => 'يُمكّن إضافة المنتجات فورًا بدون مكالمات AJAX لتحسين الأداء',
    'enable_instant_pos_help'          => 'عند التفعيل، تُضاف المنتجات فورًا باستخدام بيانات مخزّنة مؤقتًا بدلاً من طلبات الخادم',
    'enable_instant_search'            => 'تفعيل البحث الفوري',
    'enable_instant_search_tooltip'    => 'يُمكّن البحث الفوري باستخدام البيانات المخزّنة مؤقتًا بدلاً من AJAX',
    'enable_instant_search_help'       => 'عند التفعيل، يعمل البحث فورًا بدون طلبات للخادم',

    'pos_performance_info_title' => 'تحسين الأداء',
    'pos_performance_info_desc'  => 'تُحسّن ميزات Instant POS الأداء بشكل كبير عبر تقليل طلبات الخادم:',
    'instant_pos_benefit_1'      => 'تُضاف المنتجات فورًا دون انتظار استجابة الخادم',
    'instant_pos_benefit_2'      => 'تظهر نتائج البحث فور الكتابة',
    'instant_pos_benefit_3'      => 'يتم تحديث المخزون تلقائيًا بعد كل عملية بيع',
    'instant_pos_benefit_4'      => 'يعمل دون اتصال أولًا، ثم يزامن مع الخادم',

    'pos_cache_settings'                    => 'إعدادات كاش POS',
    'pos_cache_refresh_interval'            => 'فاصل تحديث الكاش',
    'pos_cache_refresh_interval_tooltip'    => 'عدد مرات تحديث كاش المنتجات',
    'pos_cache_refresh_interval_help'       => 'يتم التحديث التلقائي بعد كل عملية بيع، وفواصل يدوية للتحديث الاحتياطي',
    'auto_refresh'                          => 'تلقائي (بعد البيع)',
    '30_minutes'                            => '30 دقيقة',
    '60_minutes'                            => '60 دقيقة',
    '2_hours'                               => 'ساعتان',
    'manual_only'                           => 'يدوي فقط',

    'pos_max_cached_products'         => 'أقصى عدد للمنتجات في الكاش',
    'pos_max_cached_products_tooltip' => 'الحد الأقصى للمنتجات في الكاش للوصول الفوري',
    'pos_max_cached_products_help'    => 'الأعداد الكبيرة تُحسّن التغطية لكنها تستهلك ذاكرة أكثر. اختر "غير محدود" لتخزين كل المنتجات.',
    'unlimited'                       => 'غير محدود',

    // Loading messages
    'loading_products'                 => 'جارٍ تحميل المنتجات...',
    'please_wait_while_products_load'  => 'يرجى الانتظار حتى يتم تحميل المنتجات',
    'loading_products_placeholder'     => 'تحميل المنتجات...',
    'updating_stock'                   => 'جارٍ تحديث المخزون...',
    'failed_to_load_cache'             => 'فشل تحميل كاش المنتجات. قد تكون وظائف POS محدودة.',

    // OTP Verification
    'otp_verification' => 'التحقق من رمز OTP',
    'otp_verification_management' => 'إدارة التحقق من رمز OTP',
    'manage_otp_verification_requests' => 'إدارة طلبات التحقق من رمز OTP وعرض الإحصائيات',
    'active_otps' => 'رموز OTP النشطة',
    'unverified_users' => 'المستخدمون غير المتحققون',
    'expired_otps' => 'رموز OTP المنتهية الصلاحية',
    'failed_attempts' => 'المحاولات الفاشلة',
    'pending_users' => 'المستخدمون المعلقون',
    'today_requests' => 'طلبات اليوم',
    'high_retries' => 'إعادة المحاولة الكثيرة',
    'user_info' => 'معلومات المستخدم',
    'otp_code' => 'رمز OTP',
    'attempts' => 'المحاولات',
    'resend_count' => 'عدد الإرسال المتكرر',
    'no_active_otp' => 'لا يوجد رمز OTP نشط',
    'expired' => 'منتهي الصلاحية',
    'active' => 'نشط',
    'expires_in' => 'ينتهي في',
    'remaining' => 'متبقي',
    'resends' => 'إعادة الإرسال',
    'last' => 'آخر',
    'updated' => 'تم التحديث',
    'verify' => 'تحقق',
    'manual_verify_email' => 'التحقق اليدوي من البريد الإلكتروني',
    'reset_otp' => 'إعادة تعيين رمز OTP',
    'manual_verify' => 'التحقق اليدوي',
    'deactivate' => 'إلغاء التفعيل',

    // JavaScript messages for OTP verification
    'confirm_reset_otp' => 'هل أنت متأكد من أنك تريد إعادة تعيين رمز OTP هذا؟ سيحتاج المستخدم إلى طلب رمز جديد.',
    'failed_to_reset_otp' => 'فشل في إعادة تعيين رمز OTP',
    'error_resetting_otp' => 'حدث خطأ أثناء إعادة تعيين رمز OTP',
    'confirm_verify_unverified_user' => 'هل أنت متأكد من أنك تريد التحقق اليدوي من البريد الإلكتروني للمستخدم غير المتحقق: :username؟',
    'confirm_verify_user' => 'هل أنت متأكد من أنك تريد التحقق اليدوي من البريد الإلكتروني للمستخدم: :username؟',
    'user_verified_removed_from_list' => 'تم التحقق من البريد الإلكتروني للمستخدم - لن يظهر المستخدم في قائمة غير المتحققين',
    'failed_to_verify_user' => 'فشل في التحقق من المستخدم',
    'error_verifying_user' => 'حدث خطأ أثناء التحقق من المستخدم',
    'confirm_deactivate_token' => 'هل أنت متأكد من أنك تريد إلغاء تفعيل رمز OTP هذا؟',
    'failed_to_deactivate_token' => 'فشل في إلغاء تفعيل الرمز',
    'error_deactivating_token' => 'حدث خطأ أثناء إلغاء تفعيل الرمز',
    
    // Session Management
    'session_management' => 'إدارة الجلسات',
    'manage_user_sessions_and_authentication' => 'إدارة جلسات المستخدمين والمصادقة',
    'all_users' => 'جميع المستخدمين',
    'active_users' => 'المستخدمين النشطين',
    'locked_users' => 'المستخدمين المحظورين',
    'disabled_logins' => 'تسجيلات الدخول المعطلة',
    'active_sessions' => 'الجلسات النشطة',
    'unique_users' => 'المستخدمين الفريدين',
    'active_businesses' => 'الأعمال النشطة',
    'inactive_businesses' => 'الأعمال غير النشطة',
    'user_info' => 'معلومات المستخدم',
    'session_info' => 'معلومات الجلسة',
    'force_logout' => 'إجبار تسجيل الخروج',
    'lock_user' => 'حظر المستخدم',
    'unlock_user' => 'إلغاء حظر المستخدم',
    'lock_user_account' => 'حظر حساب المستخدم',
    'lock_duration' => 'مدة الحظر',
    'user_will_be_locked_for_selected_duration' => 'سيتم حظر المستخدم للمدة المختارة',
    'minutes' => 'دقائق',
    'hour' => 'ساعة',
    'hours' => 'ساعات',
    'deactivate_user' => 'إلغاء تنشيط المستخدم',
    'activate_user' => 'تنشيط المستخدم',
    'block_login' => 'حظر تسجيل الدخول',
    'allow_login' => 'السماح بتسجيل الدخول',
    'deactivate_business' => 'إلغاء تنشيط النشاط التجاري',
    'activate_business' => 'تنشيط النشاط التجاري',
    'login_allowed' => 'تسجيل الدخول مسموح',
    'login_blocked' => 'تسجيل الدخول محظور',
    'temporary_lock' => 'حظر مؤقت',
    'user_locked_successfully' => 'تم حظر المستخدم لمدة :duration دقيقة',
    'user_unlocked_successfully' => 'تم إلغاء حظر المستخدم بنجاح',
    'user_activated_successfully' => 'تم تنشيط المستخدم بنجاح',
    'user_deactivated_successfully' => 'تم إلغاء تنشيط المستخدم بنجاح',
    'login_permission_granted' => 'تم منح إذن تسجيل الدخول',
    'login_permission_revoked' => 'تم إلغاء إذن تسجيل الدخول',
    'business_activated_successfully' => 'تم تنشيط النشاط التجاري بنجاح',
    'business_deactivated_successfully' => 'تم إلغاء تنشيط النشاط التجاري بنجاح',
    'user_logged_out_successfully' => 'تم تسجيل خروج المستخدم بنجاح',
    'failed_to_lock_user' => 'فشل في حظر المستخدم',
    'failed_to_unlock_user' => 'فشل في إلغاء حظر المستخدم',
    'failed_to_update_user_status' => 'فشل في تحديث حالة المستخدم',
    'failed_to_update_login_permission' => 'فشل في تحديث إذن تسجيل الدخول',
    'failed_to_update_business_status' => 'فشل في تحديث حالة النشاط التجاري',
    'failed_to_logout_user' => 'فشل في تسجيل خروج المستخدم',
    'error_locking_user' => 'حدث خطأ أثناء حظر المستخدم',
    'error_unlocking_user' => 'حدث خطأ أثناء إلغاء حظر المستخدم',
    'error_updating_user_status' => 'حدث خطأ أثناء تحديث حالة المستخدم',
    'error_updating_login_permission' => 'حدث خطأ أثناء تحديث إذن تسجيل الدخول',
    'error_updating_business_status' => 'حدث خطأ أثناء تحديث حالة النشاط التجاري',
    'error_logging_out_user' => 'حدث خطأ أثناء تسجيل خروج المستخدم',
    'confirm_force_logout' => 'هل أنت متأكد أنك تريد إجبار تسجيل خروج المستخدم: :username؟',
    'confirm_lock_user' => 'هل أنت متأكد أنك تريد حظر المستخدم: :username لمدة :duration دقيقة؟',
    'confirm_unlock_user' => 'هل أنت متأكد أنك تريد إلغاء حظر المستخدم: :username؟',
    'confirm_toggle_user_status' => 'هل أنت متأكد أنك تريد :action المستخدم: :username؟',
    'confirm_toggle_login_permission' => 'هل أنت متأكد أنك تريد :action للمستخدم: :username؟',
    'confirm_toggle_business_status' => 'هل أنت متأكد أنك تريد :action النشاط التجاري: :business؟',
    'activate' => 'تنشيط',
    'deactivate' => 'إلغاء تنشيط',

    // Additional settings for new features
    'active_businesses' => 'الأعمال النشطة',
    'inactive_businesses' => 'الأعمال غير النشطة',
    'active_sessions' => 'الجلسات النشطة',
    'sessions' => 'الجلسات',
    'manage_user_sessions_and_authentication' => 'إدارة جلسات المستخدمين والمصادقة',
    
    // Instant POS Button Strings
    'refresh_pos_cache' => 'تحديث التخزين المؤقت',
    'instant_pos_enabled' => 'تم تمكين نقطة البيع الفورية',
    'instant_pos_disabled' => 'تم تعطيل نقطة البيع الفورية',
    'disable_instant_pos' => 'تعطيل نقطة البيع الفورية',
    ];
    
