<?php

return [

    'app_settings' => 'Cài đặt Ứng dụng',
    'manage_app_settings' => 'Quản lý Cài đặt Ứng dụng',
    'tab_2fa' => '2FA',
    'tab_theme' => 'Giao Diện',
    'tab_login_page' => 'Trang Đăng Nhập',
    'tab_sidebar' => 'Thanh Bên',
    'tab_language' => 'Ngôn Ngữ',
    'tab_repair_status' => 'Trạng Thái Sửa Chữa',
    'tab_logo' => 'Logo',
    // Buttons
    'update_settings' => 'Cập Nhật Cài Đặt',

    'enable_custom_bg_image_for_login' => 'Bật Nền Tùy Chỉnh cho Trang Đăng Nhập',
    'enable_custom_bg_image_for_login_tooltip' => 'Chọn hình nền tùy chỉnh cho trang đăng nhập.',

    'enable_custom_sidebar_logo' => 'Cho Phép Logo Tùy Chỉnh ở Thanh Bên',
    'enable_custom_sidebar_logo_tooltip' => 'Cho phép doanh nghiệp sử dụng logo tùy chỉnh trên thanh bên.',

    // language.blade.php
    'header_language_change' => 'Đổi Ngôn Ngữ ở Đầu Trang',
    'header_language_change_tooltip' => 'Cho phép người dùng thay đổi ngôn ngữ từ thanh đầu trang chính.',
    'header_languages_label' => 'Ngôn Ngữ ở Đầu Trang',
    'header_languages_label_tooltip' => 'Chọn các ngôn ngữ sẽ hiển thị ở đầu trang.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'Hiển Thị Trạng Thái Sửa Chữa trên Màn Hình Đăng Nhập',

    // 2fa.blade.php
    'enable_2fa' => 'Bật 2FA',
    'enable_2fa_tooltip' => 'Kích hoạt Xác Thực Hai Yếu Tố (2FA) cho ứng dụng.',

    'force_2fa' => 'Bắt Buộc 2FA',
    'force_2fa_tooltip' => 'Người dùng phải thiết lập 2FA trước khi sử dụng ứng dụng.',

    'recommend_2fa' => 'Khuyến Nghị 2FA',
    'recommend_2fa_tooltip' => 'Xuất hiện một hộp thoại duy nhất khi đăng nhập để khuyến khích bật 2FA.',

    'allow_disable_2fa' => 'Cho Phép Tạm Tắt 2FA',
    'allow_disable_2fa_tooltip' => 'Cho phép người dùng tạm thời tắt 2FA đến một thời điểm nhất định.',

    'disable_2fa_duration_label' => 'Thời Lượng Tắt 2FA',
    'disable_2fa_duration_label_tooltip' => 'Xác định khoảng thời gian mà 2FA có thể tạm ngưng hoạt động.',

    'disable_2fa_unit_label' => 'Đơn Vị Thời Gian Tắt 2FA',

    'force_2fa_after_date_label' => 'Bắt Buộc 2FA Sau Ngày',
    'force_2fa_after_date_label_tooltip' => 'Sau ngày này, tất cả người dùng phải bật 2FA. Ngày áp dụng cũng hiển thị trong hộp thoại khuyến nghị 2FA.',

    'primary_color_label' => 'Màu Chính',
    'primary_color_label_tooltip' => 'Chọn màu chính mặc định cho ứng dụng. Màu này sẽ dùng cho các doanh nghiệp chưa đặt màu riêng.',
    'secondary_color_label' => 'Màu Phụ',
    'secondary_color_label_tooltip' => 'Chọn màu phụ mặc định cho ứng dụng. Màu này sẽ dùng cho các doanh nghiệp chưa đặt màu riêng.',

    'allow_theme_change' => 'Cho Phép Thay Đổi Giao Diện',
    'allow_theme_change_tooltip' => 'Cho phép doanh nghiệp tùy chỉnh màu giao diện riêng. Nếu không đặt màu riêng, họ sẽ dùng màu mặc định tại đây do superadmin thiết lập.',

    'login_bg_image_label' => 'Hình Nền Đăng Nhập',
    'login_bg_image_label_tooltip' => 'Tải lên hình mới sẽ thay thế hình nền hiện tại.',

    'logo_dark_tooltip'  => 'Thay đổi logo màu tối mặc định của ứng dụng, dùng khi giao diện sáng.',
    'logo_light_tooltip' => 'Thay đổi logo màu sáng mặc định của ứng dụng, dùng khi giao diện tối.',
    'favicon_tooltip' => 'Kích thước đề xuất: 32×32 px. Biểu tượng này xuất hiện ở tab trình duyệt và dấu trang.',
    'upload_favicon' => 'Tải Lên Favicon',

    // Fonts
    'tab_fonts' => 'Phông Chữ',
    'english_font'            => 'Phông Chữ Tiếng Anh',
    'arabic_font'             => 'Phông Chữ Tiếng Ả Rập',
    'custom_font_placeholder' => 'Nhập tên phông chữ tùy chỉnh...',
    'select_font'             => 'Chọn phông chữ...',
    'or'                      => 'hoặc',
    'font_help_text'          => 'Chọn từ danh sách hoặc nhập phông chữ tùy chỉnh.',
    'english_font_tooltip'  => 'Nhập tên phông chữ tùy chỉnh hoặc chọn trong danh sách. Bạn có thể tìm tên phông tại: :url',
    'arabic_font_tooltip'   => 'Nhập tên phông chữ tùy chỉnh hoặc chọn trong danh sách. Bạn có thể tìm tên phông tại: :url',

    //Recaptcha:
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha'              => 'Bật Google reCAPTCHA',
    'enable_recaptcha_tooltip'      => 'Chuyển để kích hoạt bảo vệ reCAPTCHA. Nhận site key và secret từ: :url',
    'enable_recaptcha_text'         => 'Bật reCAPTCHA',
    'google_recaptcha_key'          => 'Khóa Trang (Site Key) Google reCAPTCHA',
    'google_recaptcha_secret'       => 'Khóa Bí Mật (Secret Key) Google reCAPTCHA',
    'google_recaptcha_key_placeholder'    => 'Nhập Site Key cho Google reCAPTCHA',
    'google_recaptcha_secret_placeholder' => 'Nhập Secret Key cho Google reCAPTCHA',

    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'Bật Xác Thực Hai Yếu Tố (2FA)',
    'modal_enable_2fa_desc' => 'Chúng tôi khuyến nghị bạn bật 2FA để tăng cường bảo mật tài khoản.',
    'enable_now_button' => 'Bật Ngay',
    'maybe_later_button' => 'Để Sau',
    'close_aria_label' => 'Đóng',

    // 2FA Verify page
    'one_time_password_heading' => 'Mã Một Lần (OTP)',
    'one_time_password_label' => 'Mã Một Lần',
    'enter_2fa_code_placeholder' => 'Nhập mã 2FA',
    'disable_2fa_for' => 'Tắt 2FA trong :duration :unit',
    'verify_button' => 'Xác Thực',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'Xác Thực Hai Yếu Tố (2FA)',
    'google_auth_app_desc' => 'Ứng dụng Google Authenticator',
    'configured_status' => 'Đã Cấu Hình',
    'needs_configuration_status' => 'Cần Cấu Hình',
    'two_factor_scan_or_enter_msg' => 'Vui lòng quét mã QR bên dưới bằng ứng dụng Google Authenticator hoặc nhập “secret” thủ công, sau đó nhập mã đã được tạo.',
    'your_secret_key_msg' => 'Khóa bí mật của bạn (nếu cần nhập thủ công):',

    // 2FA field labels
    'one_time_password_label' => 'Mã Một Lần',
    'enter_2fa_code_placeholder' => 'Nhập mã 2FA',
    '2fa_will_be_forced_after_date' => '2FA sẽ được ép buộc sau :date.',

    // Buttons
    '2fa' => '2FA',
    'verify_button' => 'Xác Thực',

    'confirm_access_recovery_codes' => 'Xác Nhận Quyền Truy Cập',
    're_authenticate_message'       => 'Bạn phải xác thực lại để truy cập Cài Đặt hoặc Mã Khôi Phục 2FA.',
    'choose_method'                 => 'Chọn phương thức:',
    'one_time_password'             => 'Mã Một Lần (OTP)',
    'password'                      => 'Mật Khẩu',
    'enter_code_or_password'        => 'Nhập Mã / Mật Khẩu:',
    'confirm'                       => 'Xác Nhận',

    '2fa_recovery_codes'           => 'Mã Khôi Phục 2FA',
    'recovery_codes_description'   => 'Các mã này cho phép bạn đăng nhập nếu mất quyền truy cập vào ứng dụng xác thực. Mỗi mã chỉ dùng được một lần.',
    'regenerate_codes'             => 'Tạo Lại Mã',
    'copy'                         => 'Sao Chép',
    'copy_all'                     => 'Sao Chép Tất Cả',
    'no_recovery_codes_available'  => 'Không có mã khôi phục nào khả dụng. Bạn có thể tạo mã mới bên dưới.',
    'copied'                       => 'Đã sao chép mã vào bộ nhớ tạm!',
    'all_codes_copied'             => 'Tất cả mã khôi phục đã được sao chép vào bộ nhớ tạm!',
    'supported_app'                => 'Ứng Dụng Hỗ Trợ',
    'supported_apps' => [
        'Authy' => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP' => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator' => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator' => ['Windows Phone'],
        'LastPass Authenticator' => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password' => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    //social logins:
    'social_login_settings'       => 'Cài Đặt Đăng Nhập MXH',
    'social_login_settings_help'  => 'Nhập thông tin tài khoản đăng nhập mạng xã hội của bạn.',
    'client_id'                   => 'Client ID',
    'client_secret'               => 'Client Secret',
    'redirect_url'                => 'URL Chuyển Hướng (Redirect URL)',
    'enter_client_id'             => 'Nhập :provider Client ID',
    'enter_client_secret'         => 'Nhập :provider Client Secret',
    'enter_redirect_url'          => 'Nhập :provider Redirect URL',
    'enable_social_login'         => 'Bật Đăng Nhập MXH',
    'tab_social' => 'Đăng Nhập MXH',
    'or_login_with' => 'Hoặc Đăng Nhập Bằng',
    'force_otp_after_social_login' => 'Bắt Buộc OTP Sau Đăng Nhập MXH',
    'force_otp_after_social_login_tooltip' => 'Nếu bật, người dùng đăng nhập thông qua mạng xã hội phải xác thực OTP.',

    //Lock Users:
    'locked_until' => 'Bị Khóa Đến',
    'locked_users' => 'Người Dùng Bị Khóa',
    'view_locked_users' => 'Xem Người Dùng Bị Khóa',
    'tab_login_security' => 'Bảo Mật Đăng Nhập',
    'unlock' => 'Mở Khóa',
    'enable_user_lock_label' => 'Bật Tính Năng Khóa Người Dùng',
    'enable_user_lock_tooltip' => 'Bật/Tắt khóa người dùng sau nhiều lần đăng nhập sai.',
    'max_login_attempts_label' => 'Số Lần Đăng Nhập Sai Tối Đa',
    'max_login_attempts_tooltip' => 'Số lần nhập sai được phép trước khi người dùng bị khóa.',
    'lock_duration_label' => 'Thời Lượng Khóa',
    'lock_duration_tooltip' => 'Khoảng thời gian (đơn vị số) mà người dùng sẽ bị khóa.',
    'lock_duration_unit_label' => 'Đơn Vị Thời Gian Khóa',
    'lock_duration_unit_tooltip' => 'Chọn đơn vị thời gian khóa: phút, giờ, ngày v.v.',
    'account_locked_for_time_unit' => 'Tài khoản của bạn bị khóa trong :time :unit.',
    'user_unlocked_message' => 'Đã mở khóa người dùng thành công!',

    //Verify email:
    'verify_email_address_title' => 'Xác Thực Địa Chỉ Email',
    'fresh_verification_sent' => 'Một liên kết xác thực mới đã được gửi đến địa chỉ email của bạn.',
    'verify_email_before_proceeding' => 'Trước khi tiếp tục, hãy kiểm tra email để lấy liên kết xác thực.',
    'did_not_receive_email' => 'Nếu bạn không nhận được email',
    'click_here_request_another' => 'bấm vào đây để yêu cầu liên kết mới',
    'logout' => 'Đăng Xuất',
    'force_email_verify' => 'Bắt Buộc Xác Thực Email',
    'force_email_verify_tooltip' => 'Nếu bật, người dùng phải xác thực địa chỉ email trước khi truy cập hệ thống.',

        // Reset Mapping
        'reset_purchase_sell_mapping'     => 'Đặt lại ánh xạ mua-bán',
        'select_business'                 => 'Chọn doanh nghiệp:',
        'all_businesses'                  => 'Tất cả doanh nghiệp',
        'chunk_size'                      => 'Kích thước phân đoạn:',
        'reset_mapping'                   => 'Đặt lại ánh xạ',
        'purchase_sell_mismatch_tooltip'  => 'Chọn các ánh xạ doanh nghiệp cần đặt lại. Nếu bạn có cơ sở dữ liệu lớn, nên đặt lại theo từng doanh nghiệp riêng biệt.',
        'chunk_size_tooltip'              => 'Ánh xạ sẽ được đặt lại thành các phân đoạn nhỏ hơn. Với bộ dữ liệu lớn, hãy chọn kích thước phân đoạn phù hợp. Khuyến nghị bật chế độ bảo trì.',
    
        // Maintenance Mode
        'tab_maintenance_mode'            => 'Chế độ bảo trì',
        'maintenance_mode'                => 'Chế độ bảo trì',
        'maintenance_mode_tooltip'        => 'Đặt ứng dụng vào chế độ bảo trì (khách truy cập sẽ thấy màn hình bảo trì).',
        'enable_countdown'                => 'Bật đếm ngược',
        'enable_timer_tooltip'            => 'Hiển thị đếm ngược trực tiếp cho đến khi bảo trì kết thúc.',
        'maintenance_duration'            => 'Thời lượng',
        'maintenance_unit'                => 'Đơn vị thời gian',
        'minutes'                         => 'Phút',
        'hours'                           => 'Giờ',
        'days'                            => 'Ngày',
    
        // Maintenance page
        'under_maintenance'               => 'Đang bảo trì',
        'maintenance_heading'             => 'Chúng tôi đang thực hiện bảo trì.',
        'maintenance_subheading'          => 'Cảm ơn bạn đã kiên nhẫn!',
        'maintenance_back_in'             => 'Chúng tôi sẽ trở lại sau :time',
        'maintenance_back_no_timer'       => 'Chúng tôi sẽ trở lại ngay khi bảo trì xong.',
    
        // Mapping reset page
        'mapping_reset_progress'          => 'Tiến độ đặt lại ánh xạ',
        'mapping_reset_in_progress'       => 'Đang đặt lại ánh xạ',
        'batch_status'                    => 'Trạng thái lô',
        'refresh_status'                  => 'Làm mới trạng thái',
    
        // Mapping reset result & status
        'mapping_reset_result'            => 'Kết quả đặt lại ánh xạ',
        'chunk_processing_status'         => 'Trạng thái xử lý phân đoạn',
    
        // Table headers
        'business'                        => 'Doanh nghiệp',
        'chunk_status'                    => 'Trạng thái phân đoạn',
        'total_chunks'                    => 'Tổng phân đoạn',
        'status'                          => 'Trạng thái',
    
        // Button
        'go_back'                         => 'Quay lại',
    
        // Mapping Jobs
        'processed_jobs'                  => 'Các công việc ánh xạ',
        'processed_jobs_subtitle'         => 'Tất cả các lô ánh xạ đã gửi',
        'uuid'                            => 'UUID lô',
        'job_name'                        => 'Tên công việc',
        'completed_chunks'                => 'Phân đoạn hoàn thành',
        'started_at'                      => 'Bắt đầu lúc',
        'finished_at'                     => 'Cập nhật cuối',
        'view_rebuild_jobs'               => 'Xem công việc tái tạo kho',
    
        // Detailed instruction
        'reset_mapping_instruction'       =>
            "Khuyến nghị cấu hình driver hàng đợi sang backend thật:\n"
            . "→ Trong file .env, đặt `QUEUE_CONNECTION=database`.\n\n"
            . "Kích hoạt chế độ bảo trì (Cài đặt ứng dụng → Chế độ bảo trì) khi đặt lại ánh xạ để tránh dữ liệu trùng hoặc thiếu.\n\n"
            . "Với cơ sở dữ liệu lớn, việc đặt lại sẽ lâu hơn—hãy xem xét đặt lại theo từng doanh nghiệp.\n\n"
            . "Trước khi bắt đầu:\n"
            . "• Sao lưu toàn bộ cơ sở dữ liệu.\n"
            . "• Giám sát quá trình qua log để phát hiện lỗi.",
    
        'recovery_codes_generated_successfully' => 'Tạo mã khôi phục thành công',
    
        // Disposable-email sync
        'sync_disposable_list'            => 'Đồng bộ danh sách email dùng một lần',
        'sync_disposable_success'         => 'Cập nhật danh sách email dùng một lần thành công.',
        'sync_disposable_failed'          => 'Đồng bộ danh sách email dùng một lần thất bại.',
    
        // Temporary-email protection
        'temp_email_protection'           => 'Chặn email tạm thời',
        'temp_email_protection_tooltip'   => 'Chặn các miền email tạm thời/dùng một lần (ví dụ: Mailinator, 10MinuteMail).',
        'disposable_not_allowed'          => 'Không cho phép địa chỉ email dùng một lần.',

       // 3.3
    'enable_sidebar_dropdown'         => 'Bật menu thả xuống thanh bên',
    'enable_sidebar_dropdown_tooltip' => 'Thu gọn các menu con thành menu thả xuống có thể nhấp trong thanh bên.',
    // Custom Menu
    'menu'               => 'Menu',
    'menus_heading'      => 'Menu',
    'menus_description'  => 'Quản lý và sắp xếp các mục menu.',
    'add_menu_item'      => 'Thêm mục menu',
    'save_menu'          => 'Lưu menu',
    'label'              => 'Nhãn',
    'parent'             => 'Cha',
    'icon_type'          => 'Loại biểu tượng',
    'svg'                => 'SVG',
    'fontawesome'        => 'FontAwesome',
    'svg_icon'           => 'Biểu tượng SVG',
    'fa_class'           => 'Lớp FA',
    'named_route'        => 'Route đặt tên',
    'absolute_url'       => 'URL tuyệt đối',
    'permission'         => 'Quyền',
    'module_flag'        => 'Cờ mô-đun',
    'sort_order'         => 'Thứ tự sắp xếp',
    'active'             => 'Hoạt động?',
    'apply'              => 'Áp dụng',
    'add_menu'           => 'Thêm menu',
    'inactive'           => 'Không hoạt động',
    'flush_cache'        => 'Xoá bộ nhớ đệm',
    'reset_menu'         => 'Đặt lại',
    'custom_menu'        => 'Menu thanh bên tuỳ chỉnh',

    'rebuilt_successfully' => 'Xây dựng lại thành công',

    'sidebar_layout'        => 'Bố cục thanh bên',
    'sidebar_layout_1'      => 'Bố cục 1 (Cổ điển)',
    'sidebar_layout_2'      => 'Bố cục 2 (Gọn)',
    'sidebar_layout_custom' => 'Bố cục tuỳ chỉnh',

    'custom_sidebar_type' => 'Loại thanh bên tuỳ chỉnh',
    'sidebar'             => 'Thanh bên',
    'topbar'              => 'Thanh trên',

    'tab_business_settings'    => 'Cài đặt doanh nghiệp',
    'business_settings_layout' => 'Bố cục cài đặt doanh nghiệp',
    'layout_1'                => 'Bố cục 1 – Tab cổ điển',
    'layout_2'                => 'Bố cục 2 – Thanh bên hiện đại',

    // Themes
    'predefined_theme_label'   => 'Chủ đề định sẵn',
    'predefined_theme_tooltip' => 'Chọn bảng màu có sẵn.',
    'select_theme'             => 'Chọn chủ đề',
    'theme_default'            => 'Mặc định',

    // Migration Data
    'app_settings'         => 'Cài đặt ứng dụng',
    'application_settings' => 'Cài đặt ứng dụng',
    'storage_migration'    => 'Di chuyển lưu trữ',
    'manage_uploads_data'  => 'Quản lý dữ liệu tải lên',

    'push'  => 'push',
    'pull'  => 'pull',
    'local' => 'local',
    'external_disk' => 'ổ đĩa ngoài',
    'duplicate_files_skipped_safe_to_resume' =>
        'Tệp trùng lặp đã bị bỏ qua. Bạn có thể chạy lại để tiếp tục an toàn.',

    'direction'              => 'Hướng',
    'push_local_to_external' => 'push (local → external)',
    'pull_external_to_local' => 'pull (external → local)',

    'from_disk' => 'Từ đĩa',
    'to_disk'   => 'Đến đĩa',

    'destination_visibility'        => 'Khả năng hiển thị đích',
    'visibility_none_bucket_signed' => '(không / chính sách bucket / URL có chữ ký)',
    'visibility_public_acl'         => 'công khai (ACL đối tượng)',
    'visibility_private_acl'        => 'riêng tư (ACL đối tượng)',

    'folders_to_include_optional' => 'Thư mục bao gồm (tuỳ chọn)',
    'folders_include_tooltip'     => 'Để trống để bao gồm tất cả thư mục trong uploads.',
    'select_all'                  => 'Chọn tất',
    'none'                        => 'Không',
    'invert'                      => 'Đảo chọn',
    'no_suggestions_found'        => 'Không tìm thấy gợi ý.',

    'delete_source_after_copy' => 'Xoá nguồn sau khi sao chép thành công (di chuyển)',
    'dry_run_plan_only'        => 'Chạy thử (chỉ kế hoạch)',
    'verbose_log_messages'     => 'Chi tiết (bản ghi)',

    'execution'                    => 'Thực thi',
    'execution_tooltip_html'       =>
        'Chỉ dùng <strong>Trực tiếp</strong> cho khối nhỏ (ví dụ &lt; 1000 tệp). ' .
        'Với 5–10 GB hãy dùng job nền.',
    'pick_how_to_execute'          => 'Chọn cách chạy tác vụ di chuyển.',
    'background_job_recommended'   => 'Job nền (khuyên dùng)',
    'run_direct_now'               => 'Trực tiếp (chạy ngay)',

    'start_migration' => 'Bắt đầu di chuyển',
    'reset'           => 'Đặt lại',

    'progress' => 'Tiến độ',
    'result'   => 'Kết quả',

    // JS strings
    'from'                    => 'Từ',
    'to'                      => 'Đến',
    'folders'                 => 'Thư mục',
    'total'                   => 'Tổng',
    'copied'                  => 'Đã sao chép',
    'skipped'                 => 'Đã bỏ qua',
    'deleted'                 => 'Đã xoá',
    'failed'                  => 'Thất bại',
    'invalid_response'        => 'Phản hồi không hợp lệ',
    'failed_to_start_migration'=> 'Không thể bắt đầu di chuyển',
    'confirm_delete_source'   =>
        'Bạn có chắc muốn XOÁ tệp nguồn sau khi sao chép? Thao tác này không thể hoàn tác.',

    'default_storage_disk'      => 'Ổ lưu trữ mặc định',
    'default_storage_disk_help' =>
        '"public" = storage/app/public thông qua liên kết /symlink /storage. ' .
        '"local" = public/uploads.',

    's3_compatible_settings'     => 'Cài đặt tương thích S3',
    'display_label_optional'     => 'Nhãn hiển thị (tuỳ chọn)',
    'placeholder_my_s3_provider' => 'Nhà cung cấp S3 của tôi',
    'display_only_admin_ui'      => 'Chỉ hiển thị trong giao diện quản trị.',
    'access_key'                 => 'Access Key',
    'secret_key'                 => 'Secret Key',
    'region'                     => 'Vùng',
    'bucket'                     => 'Bucket',
    'endpoint'                   => 'Endpoint',
    'cdn_or_custom_domain_optional' => 'CDN / Tên miền tuỳ chỉnh (tuỳ chọn)',

    'disable_http_verify'      => 'Tắt xác minh TLS',
    'disable_http_verify_help' =>
        'Tắt = xác minh TLS bật. Bật = tắt xác minh TLS (chỉ localhost).',

    'path_style_endpoint' => 'Endpoint kiểu đường dẫn',

    'use_signed_urls'      => 'Dùng URL có chữ ký (bucket riêng tư)',
    'use_signed_urls_help' =>
        'Tắt = URL công khai (bucket/CDN cho phép đọc công khai). ' .
        'Bật = riêng tư với URL có chữ ký.',

    'signed_url_ttl_minutes' => 'Thời hạn URL có chữ ký (phút)',
    'tab_storage_settings'   => 'Lưu trữ',
    'syncing'               => 'Đang đồng bộ…',

    // POS Settings
    'pos_performance_settings'   => 'Cài đặt hiệu suất POS',
    'enable_instant_pos'         => 'Bật POS tức thì',
    'enable_instant_pos_tooltip' => 'Thêm sản phẩm ngay lập tức, không cần AJAX, tăng tốc độ',
    'enable_instant_pos_help'    =>
        'Khi bật, sản phẩm được thêm trực tiếp từ cache thay vì gửi yêu cầu đến máy chủ.',

    'enable_instant_search'            => 'Bật tìm kiếm tức thì',
    'enable_instant_search_tooltip'    => 'Tìm kiếm trực tiếp từ cache, không cần AJAX',
    'enable_instant_search_help'       =>
        'Khi bật, kết quả tìm kiếm hiển thị ngay lập tức mà không cần yêu cầu máy chủ.',

    'pos_performance_info_title' => 'Tăng cường hiệu suất',
    'pos_performance_info_desc'  => 'POS tức thì giảm yêu cầu máy chủ, tăng tốc quy trình:',
    'instant_pos_benefit_1'      => 'Thêm sản phẩm tức thì, không chờ phản hồi',
    'instant_pos_benefit_2'      => 'Kết quả tìm kiếm hiển thị ngay khi gõ',
    'instant_pos_benefit_3'      => 'Tồn kho tự động cập nhật sau mỗi giao dịch',
    'instant_pos_benefit_4'      => 'Hoạt động offline trước, sau đồng bộ với máy chủ',

    'pos_cache_settings'                    => 'Cài đặt cache POS',
    'pos_cache_refresh_interval'            => 'Khoảng làm mới cache',
    'pos_cache_refresh_interval_tooltip'    => 'Tần suất làm mới cache sản phẩm',
    'pos_cache_refresh_interval_help'       =>
        'Tự động sau mỗi bán; đặt khoảng thủ công để dự phòng.',
    'auto_refresh'                          => 'Tự động (sau bán)',
    '30_minutes'                            => '30 phút',
    '60_minutes'                            => '60 phút',
    '2_hours'                               => '2 giờ',
    'manual_only'                           => 'Chỉ thủ công',

    'pos_max_cached_products'         => 'Số sản phẩm cache tối đa',
    'pos_max_cached_products_tooltip' => 'Giới hạn sản phẩm lưu cache',
    'pos_max_cached_products_help'    =>
        'Số lớn = bao phủ tốt nhưng tốn RAM. Chọn “Không giới hạn” để cache tất cả.',
    'unlimited'                       => 'Không giới hạn',

    // Loading messages
    'loading_products'                => 'Đang tải sản phẩm…',
    'please_wait_while_products_load' => 'Vui lòng chờ, đang tải sản phẩm',
    'loading_products_placeholder'    => 'Đang tải sản phẩm…',
    'updating_stock'                  => 'Đang cập nhật tồn kho…',
    'failed_to_load_cache'            => 'Không tải được cache sản phẩm. Chức năng POS có thể bị hạn chế.',

    // OTP Verification
    'otp_verification' => 'Xác Thực OTP',
    'otp_verification_management' => 'Quản Lý Xác Thực OTP',
    'manage_otp_verification_requests' => 'Quản lý các yêu cầu xác thực OTP và xem thống kê',
    'active_otps' => 'OTP Đang Hoạt Động',
    'unverified_users' => 'Người Dùng Chưa Xác Thực',
    'expired_otps' => 'OTP Đã Hết Hạn',
    'failed_attempts' => 'Lần Thử Thất Bại',
    'pending_users' => 'Người Dùng Đang Chờ',
    'today_requests' => 'Yêu Cầu Hôm Nay',
    'high_retries' => 'Thử Lại Nhiều Lần',
    'user_info' => 'Thông Tin Người Dùng',
    'otp_code' => 'Mã OTP',
    'attempts' => 'Lần Thử',
    'resend_count' => 'Số Lần Gửi Lại',
    'no_active_otp' => 'Không Có OTP Hoạt Động',
    'expired' => 'Đã Hết Hạn',
    'active' => 'Đang Hoạt Động',
    'expires_in' => 'Hết hạn trong',
    'remaining' => 'còn lại',
    'resends' => 'gửi lại',
    'last' => 'Lần cuối',
    'updated' => 'Đã Cập Nhật',
    'verify' => 'Xác Thực',
    'manual_verify_email' => 'Xác Thực Email Thủ Công',
    'reset_otp' => 'Đặt Lại OTP',
    'manual_verify' => 'Xác Thực Thủ Công',
    'deactivate' => 'Vô Hiệu Hóa',
    
    // JavaScript messages
    'confirm_reset_otp' => 'Bạn có chắc chắn muốn đặt lại OTP này? Người dùng sẽ cần yêu cầu mã mới.',
    'failed_to_reset_otp' => 'Đặt lại OTP thất bại',
    'error_resetting_otp' => 'Đã xảy ra lỗi khi đặt lại OTP',
    'confirm_verify_unverified_user' => 'Bạn có chắc chắn muốn xác thực email thủ công cho người dùng chưa xác thực: :username?',
    'confirm_verify_user' => 'Bạn có chắc chắn muốn xác thực email thủ công cho người dùng: :username?',
    'user_verified_removed_from_list' => 'Email người dùng đã được xác thực - người dùng sẽ không còn xuất hiện trong danh sách chưa xác thực',
    'failed_to_verify_user' => 'Xác thực người dùng thất bại',
    'error_verifying_user' => 'Đã xảy ra lỗi khi xác thực người dùng',
    'confirm_deactivate_token' => 'Bạn có chắc chắn muốn vô hiệu hóa token OTP này?',
    'failed_to_deactivate_token' => 'Vô hiệu hóa token thất bại',
    'error_deactivating_token' => 'Đã xảy ra lỗi khi vô hiệu hóa token',

    // Session Management
    'session_management' => 'Quản Lý Phiên',
    'manage_user_sessions' => 'Quản lý phiên người dùng và bảo mật',
    'total_sessions' => 'Tổng Số Phiên',
    'active_users' => 'Người Dùng Đang Hoạt Động',
    'file_sessions' => 'Phiên File',
    'database_sessions' => 'Phiên Cơ Sở Dữ Liệu',
    'session_actions' => 'Hành Động',
    'user_name' => 'Tên Người Dùng',
    'device_info' => 'Thông Tin Thiết Bị',
    'ip_address' => 'Địa Chỉ IP',
    'last_activity' => 'Hoạt Động Cuối',
    'session_id' => 'ID Phiên',
    'force_logout' => 'Ép Buộc Đăng Xuất',
    'view_session_details' => 'Xem Chi Tiết Phiên',
    'invalidate_all_sessions' => 'Vô Hiệu Tất Cả Phiên',
    'filter_by_user' => 'Lọc theo Người Dùng',
    'filter_by_session_type' => 'Lọc theo Loại Phiên',
    'all_session_types' => 'Tất Cả Loại Phiên',
    'confirm_force_logout' => 'Bạn có chắc chắn muốn ép buộc đăng xuất phiên này? Người dùng sẽ cần đăng nhập lại.',
    'confirm_invalidate_all' => 'Bạn có chắc chắn muốn vô hiệu tất cả phiên của người dùng này? Tất cả phiên đang hoạt động sẽ bị đóng.',
    'session_invalidated' => 'Phiên đã được vô hiệu thành công',
    'all_sessions_invalidated' => 'Tất cả phiên của người dùng đã được vô hiệu thành công',
    'session_details' => 'Chi Tiết Phiên',
    'session_data' => 'Dữ Liệu Phiên',
    'user_agent' => 'User Agent',
    'session_payload' => 'Payload Phiên',
    'created_at' => 'Tạo Lúc',
    'updated_at' => 'Cập Nhật Lúc',
    'expires_at' => 'Hết Hạn Lúc',
    'session_driver' => 'Driver Phiên',
    'unknown_device' => 'Thiết Bị Không Xác Định',
    'unknown_browser' => 'Trình Duyệt Không Xác Định',
    'unknown_platform' => 'Nền Tảng Không Xác Định',
    'desktop' => 'Máy Tính',
    'mobile' => 'Di Động',
    'tablet' => 'Máy Tính Bảng',
    'current_session' => 'Phiên Hiện Tại',
    'other_sessions' => 'Phiên Khác',
    'session_location' => 'Vị Trí Phiên',
    'refresh_sessions' => 'Làm Mới Phiên',
    'auto_refresh' => 'Tự Động Làm Mới',
    'manual_refresh' => 'Làm Mới Thủ Công',
    'bulk_actions' => 'Hành Động Hàng Loạt',
    'select_all_sessions' => 'Chọn Tất Cả Phiên',
    'logout_selected' => 'Đăng Xuất Đã Chọn',
    'export_sessions' => 'Xuất Phiên',
    'session_statistics' => 'Thống Kê Phiên',
    'concurrent_sessions' => 'Phiên Đồng Thời',
    'average_session_duration' => 'Thời Lượng Phiên Trung Bình',
    'peak_concurrent_users' => 'Đỉnh Người Dùng Đồng Thời',
    'session_security' => 'Bảo Mật Phiên',
    'suspicious_activity' => 'Hoạt Động Đáng Ngờ',
    'multiple_ip_sessions' => 'Phiên Đa IP',
    'session_timeout' => 'Hết Thời Gian Phiên',
    'force_single_session' => 'Ép Buộc Phiên Đơn',
    'session_encryption' => 'Mã Hóa Phiên',
    'secure_session_only' => 'Chỉ Phiên Bảo Mật',

    // Instant POS Button Strings
    'refresh_pos_cache' => 'Làm Mới Cache',
    'instant_pos_enabled' => 'POS Tức Thì Đã Bật',
    'instant_pos_disabled' => 'POS Tức Thì Đã Tắt',
    'disable_instant_pos' => 'Tắt POS Tức thì',
];
