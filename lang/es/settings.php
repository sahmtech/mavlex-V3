<?php

return [
    'app_settings' => 'Configuración de la Aplicación',
    'manage_app_settings' => 'Administrar Configuración de la Aplicación',
    'tab_2fa' => '2FA',
    'tab_theme' => 'Apariencia',
    'tab_login_page' => 'Página de Inicio de Sesión',
    'tab_sidebar' => 'Barra Lateral',
    'tab_language' => 'Idioma',
    'tab_repair_status' => 'Estado de Reparación',
    'tab_logo' => 'Logo',
    // Buttons
    'update_settings' => 'Actualizar Configuración',

    'enable_custom_bg_image_for_login' => 'Habilitar Fondo Personalizado para Inicio de Sesión',
    'enable_custom_bg_image_for_login_tooltip' => 'Establecer una imagen de fondo personalizada para la página de inicio de sesión.',

    'enable_custom_sidebar_logo' => 'Permitir Logo Personalizado en la Barra Lateral',
    'enable_custom_sidebar_logo_tooltip' => 'Permite a las empresas usar un logo personalizado en la barra lateral.',

    // language.blade.php
    'header_language_change' => 'Cambio de Idioma en la Cabecera',
    'header_language_change_tooltip' => 'Permitir a los usuarios cambiar el idioma en la cabecera principal.',
    'header_languages_label' => 'Idiomas en la Cabecera',
    'header_languages_label_tooltip' => 'Seleccione los idiomas que se mostrarán en la cabecera.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'Mostrar Estado de Reparación en la Pantalla de Inicio de Sesión',

    // 2fa.blade.php
    'enable_2fa' => 'Habilitar 2FA',
    'enable_2fa_tooltip' => 'Activar la Autenticación de Dos Factores (2FA) para la aplicación.',

    'force_2fa' => 'Forzar 2FA',
    'force_2fa_tooltip' => 'Los usuarios deben configurar 2FA antes de poder usar la aplicación.',

    'recommend_2fa' => 'Recomendar 2FA',
    'recommend_2fa_tooltip' => 'Muestra una ventana emergente única al iniciar sesión para alentar a los usuarios a habilitar 2FA.',

    'allow_disable_2fa' => 'Permitir Deshabilitar 2FA Temporalmente',
    'allow_disable_2fa_tooltip' => 'Permite a los usuarios deshabilitar 2FA temporalmente durante un tiempo definido.',

    'disable_2fa_duration_label' => 'Duración para Deshabilitar 2FA',
    'disable_2fa_duration_label_tooltip' => 'Definir el período durante el cual 2FA puede permanecer deshabilitado.',

    'disable_2fa_unit_label' => 'Unidad de Duración para Deshabilitar 2FA',

    'force_2fa_after_date_label' => 'Forzar 2FA Después de la Fecha',
    'force_2fa_after_date_label_tooltip' => 'Después de esta fecha, todos los usuarios deberán habilitar 2FA. Esta fecha también se muestra en la ventana de recomendación de 2FA.',

    'primary_color_label' => 'Color Primario',
    'primary_color_label_tooltip' => 'Seleccione el color primario predeterminado de la aplicación. Se usará para las empresas que no definan sus propios colores.',
    'secondary_color_label' => 'Color Secundario',
    'secondary_color_label_tooltip' => 'Seleccione el color secundario predeterminado de la aplicación. Se usará para las empresas que no definan sus propios colores.',

    'allow_theme_change' => 'Permitir Cambio de Tema',
    'allow_theme_change_tooltip' => 'Permite que las empresas personalicen los colores de su tema. Si no definen colores propios, se usarán los colores predeterminados establecidos aquí.',

    'login_bg_image_label' => 'Imagen de Fondo para Inicio de Sesión',
    'login_bg_image_label_tooltip' => 'Al subir una nueva imagen se reemplaza el fondo actual.',

    'logo_dark_tooltip' => 'Cambiar el logo oscuro predeterminado de la aplicación (se usa en modo claro).',
    'logo_light_tooltip' => 'Cambiar el logo claro predeterminado de la aplicación (se usa en modo oscuro).',
    'favicon_tooltip' => 'Dimensiones recomendadas: 32×32 px. Este ícono aparece en las pestañas y marcadores del navegador.',
    'upload_favicon' => 'Subir Favicon',

    // Fonts
    'tab_fonts' => 'Fuentes',
    'english_font' => 'Fuente en Inglés',
    'arabic_font' => 'Fuente en Árabe',
    'custom_font_placeholder' => 'Ingrese un nombre de fuente personalizado...',
    'select_font' => 'Seleccionar fuente...',
    'or' => 'o',
    'font_help_text' => 'Elija de la lista o ingrese su propia fuente.',
    'english_font_tooltip' => 'Ingrese un nombre de fuente personalizado o seleccione una de la lista. Puede encontrar nombres de fuentes en: :url',
    'arabic_font_tooltip' => 'Ingrese un nombre de fuente personalizado o seleccione una de la lista. Puede encontrar nombres de fuentes en: :url',

    // Recaptcha
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha' => 'Habilitar Google reCAPTCHA',
    'enable_recaptcha_tooltip' => 'Activar para habilitar la protección reCAPTCHA. Obtenga la clave del sitio y el secreto en: :url',
    'enable_recaptcha_text' => 'Habilitar reCAPTCHA',
    'google_recaptcha_key' => 'Clave del Sitio (Site Key) de Google reCAPTCHA',
    'google_recaptcha_secret' => 'Clave Secreta (Secret Key) de Google reCAPTCHA',
    'google_recaptcha_key_placeholder' => 'Ingrese su Google reCAPTCHA Site Key',
    'google_recaptcha_secret_placeholder' => 'Ingrese su Google reCAPTCHA Secret Key',

    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'Habilitar Autenticación de Dos Factores',
    'modal_enable_2fa_desc' => 'Recomendamos habilitar la Autenticación de Dos Factores (2FA) para mejorar la seguridad de su cuenta.',
    'enable_now_button' => 'Habilitar Ahora',
    'maybe_later_button' => 'Quizá Más Tarde',
    'close_aria_label' => 'Cerrar',

    // 2FA Verify page
    'one_time_password_heading' => 'Contraseña de Único Uso',
    'one_time_password_label' => 'Contraseña de Único Uso',
    'enter_2fa_code_placeholder' => 'Ingrese el código 2FA',
    'disable_2fa_for' => 'Deshabilitar 2FA por :duration :unit',
    'verify_button' => 'Verificar',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'Autenticación de Dos Factores (2FA)',
    'google_auth_app_desc' => 'Aplicación Google Authenticator',
    'configured_status' => 'Configurado',
    'needs_configuration_status' => 'Necesita Configuración',
    'two_factor_scan_or_enter_msg' => 'Por favor, escanee el código QR con la aplicación Google Authenticator o ingrese la clave manualmente, luego introduzca el código generado.',
    'your_secret_key_msg' => 'Su clave secreta (para introducir manualmente si es necesario):',

    // 2FA field labels
    'one_time_password_label' => 'Contraseña de Único Uso',
    'enter_2fa_code_placeholder' => 'Ingrese el código 2FA',
    '2fa_will_be_forced_after_date' => '2FA será obligatorio después de :date.',

    // Buttons
    '2fa' => '2FA',
    'verify_button' => 'Verificar',

    'confirm_access_recovery_codes' => 'Confirmar Acceso',
    're_authenticate_message' => 'Debe reautenticarse para acceder a la Configuración o los Códigos de Recuperación de 2FA.',
    'choose_method' => 'Elija un método:',
    'one_time_password' => 'Contraseña de Único Uso (OTP)',
    'password' => 'Contraseña',
    'enter_code_or_password' => 'Ingrese el código o la contraseña:',
    'confirm' => 'Confirmar',

    '2fa_recovery_codes' => 'Códigos de Recuperación 2FA',
    'recovery_codes_description' => 'Estos códigos le permiten iniciar sesión si pierde el acceso a su aplicación de autenticación. Cada código solo puede usarse una vez.',
    'regenerate_codes' => 'Regenerar Códigos',
    'copy' => 'Copiar',
    'copy_all' => 'Copiar Todo',
    'no_recovery_codes_available' => 'No hay códigos de recuperación disponibles. Puede generar nuevos códigos a continuación.',
    'copied' => '¡Código copiado al portapapeles!',
    'all_codes_copied' => '¡Todos los códigos de recuperación fueron copiados al portapapeles!',
    'supported_app' => 'Aplicaciones Soportadas',
    'supported_apps' => [
        'Authy' => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP' => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator' => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator' => ['Windows Phone'],
        'LastPass Authenticator' => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password' => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    // Social logins:
    'social_login_settings' => 'Configuración de Inicio de Sesión Social',
    'social_login_settings_help' => 'Ingrese sus credenciales de inicio de sesión social.',
    'client_id' => 'ID de Cliente (Client ID)',
    'client_secret' => 'Secreto de Cliente (Client Secret)',
    'redirect_url' => 'URL de Redirección (Redirect URL)',
    'enter_client_id' => 'Ingrese el Client ID para :provider',
    'enter_client_secret' => 'Ingrese el Client Secret para :provider',
    'enter_redirect_url' => 'Ingrese el Redirect URL para :provider',
    'enable_social_login' => 'Habilitar Inicio de Sesión Social',
    'tab_social' => 'Inicios de Sesión Social',
    'or_login_with' => 'O iniciar sesión con',
    'force_otp_after_social_login' => 'Forzar OTP después del Inicio de Sesión Social',
    'force_otp_after_social_login_tooltip' => 'Si está habilitado, los usuarios que inicien sesión mediante redes sociales deberán verificar un código OTP.',

    //Lock Users:
    'locked_until' => 'Bloqueado hasta',
    'locked_users' => 'Usuarios Bloqueados',
    'view_locked_users' => 'Ver Usuarios Bloqueados',
    'tab_login_security' => 'Seguridad de Inicio de Sesión',
    'unlock' => 'Desbloquear',
    'enable_user_lock_label' => 'Habilitar Bloqueo de Usuario',
    'enable_user_lock_tooltip' => 'Habilitar/Deshabilitar el bloqueo del usuario después de varios intentos de inicio de sesión fallidos.',
    'max_login_attempts_label' => 'Máximo de Intentos de Inicio de Sesión',
    'max_login_attempts_tooltip' => 'Número de intentos permitidos antes de bloquear al usuario.',
    'lock_duration_label' => 'Duración del Bloqueo',
    'lock_duration_tooltip' => 'La cantidad de tiempo (en números) que el usuario permanecerá bloqueado.',
    'lock_duration_unit_label' => 'Unidad de Duración del Bloqueo',
    'lock_duration_unit_tooltip' => 'Elija la unidad de tiempo para la duración del bloqueo: minutos, horas, días, etc.',
    'account_locked_for_time_unit' => 'Su cuenta está bloqueada por :time :unit.',
    'user_unlocked_message' => '¡Usuario desbloqueado con éxito!',

    //Verify email:
    'verify_email_address_title' => 'Verifique su Dirección de Correo',
    'fresh_verification_sent' => 'Se ha enviado un nuevo enlace de verificación a su correo electrónico.',
    'verify_email_before_proceeding' => 'Antes de continuar, por favor revise su correo electrónico para encontrar el enlace de verificación.',
    'did_not_receive_email' => 'Si no ha recibido el correo electrónico',
    'click_here_request_another' => 'haga clic aquí para solicitar otro',
    'logout' => 'Cerrar sesión',
    'force_email_verify' => 'Forzar Verificación de Correo',
    'force_email_verify_tooltip' => 'Si está habilitado, los usuarios deben verificar su dirección de correo antes de acceder al sistema.',
    // Reset Mapping
    'reset_purchase_sell_mapping'     => 'Restablecer asignación de compra-venta',
    'select_business'                 => 'Seleccionar negocio:',
    'all_businesses'                  => 'Todos los negocios',
    'chunk_size'                      => 'Tamaño de lote:',
    'reset_mapping'                   => 'Restablecer asignación',
    'purchase_sell_mismatch_tooltip'  => 'Seleccione las asignaciones de negocio que desea restablecer. Si tiene una base de datos grande, recomendamos elegir negocios individuales para restablecer la asignación.',
    'chunk_size_tooltip'              => 'La asignación se restablecerá en lotes más pequeños. Para conjuntos de datos grandes, elija un tamaño de lote apropiado. Se recomienda activar el modo de mantenimiento.',

    // Maintenance Mode
    'tab_maintenance_mode'            => 'Modo de mantenimiento',
    'maintenance_mode'                => 'Modo de mantenimiento',
    'maintenance_mode_tooltip'        => 'Poner la aplicación en mantenimiento (los visitantes verán la pantalla de mantenimiento).',
    'enable_countdown'                => 'Habilitar cuenta regresiva',
    'enable_timer_tooltip'            => 'Mostrar una cuenta regresiva en vivo hasta que termine el mantenimiento.',
    'maintenance_duration'            => 'Duración',
    'maintenance_unit'                => 'Unidad de duración',
    'minutes'                         => 'Minutos',
    'hours'                           => 'Horas',
    'days'                            => 'Días',

    // Maintenance page
    'under_maintenance'               => 'En mantenimiento',
    'maintenance_heading'             => 'Estamos realizando tareas de mantenimiento.',
    'maintenance_subheading'          => '¡Gracias por su paciencia!',
    'maintenance_back_in'             => 'Volveremos en :time',
    'maintenance_back_no_timer'       => 'Volveremos tan pronto como finalicemos el mantenimiento.',

    // Mapping reset page
    'mapping_reset_progress'          => 'Progreso de restablecimiento de asignación',
    'mapping_reset_in_progress'       => 'Se está restableciendo la asignación',
    'batch_status'                    => 'Estado del lote',
    'refresh_status'                  => 'Actualizar estado',

    // Mapping reset result & status
    'mapping_reset_result'            => 'Resultado del restablecimiento de asignación',
    'chunk_processing_status'         => 'Estado de procesamiento de lotes',

    // Table headers
    'business'                        => 'Negocio',
    'chunk_status'                    => 'Estado del lote',
    'total_chunks'                    => 'Lotes totales',
    'status'                          => 'Estado',

    // Button
    'go_back'                         => 'Volver',

    // Mapping Jobs
    'processed_jobs'                  => 'Tareas de asignación',
    'processed_jobs_subtitle'         => 'Todos los lotes de asignación enviados',
    'uuid'                            => 'UUID del lote',
    'job_name'                        => 'Nombre de la tarea',
    'completed_chunks'                => 'Lotes completados',
    'started_at'                      => 'Iniciado el',
    'finished_at'                     => 'Última actualización',
    'view_rebuild_jobs'               => 'Ver tareas de reconstrucción de inventario',

    // Detailed instruction
    'reset_mapping_instruction'       =>
        "Se recomienda configurar el controlador de colas en un backend real:\n" .
        "→ En su archivo .env, establezca `QUEUE_CONNECTION=database`.\n\n" .
        "También active el modo de mantenimiento (Configuración de la aplicación → Modo de mantenimiento) mientras se ejecuta el restablecimiento de asignación para evitar datos duplicados o perdidos.\n\n" .
        "Si tiene una base de datos grande, el restablecimiento tardará más: considere hacerlo por cada negocio.\n\n" .
        "Antes de comenzar:\n" .
        "• Haga una copia de seguridad completa de la base de datos.\n" .
        "• Monitoree el proceso a través de los registros para detectar errores.",

    'recovery_codes_generated_successfully' => 'Códigos de recuperación generados con éxito',

    // Disposable-email sync
    'sync_disposable_list'            => 'Sincronizar lista de correos desechables',
    'sync_disposable_success'         => 'Lista de correos desechables actualizada.',
    'sync_disposable_failed'          => 'Error al sincronizar la lista de correos desechables.',

    // Temporary-email protection
    'temp_email_protection'           => 'Prevenir direcciones de correo desechables',
    'temp_email_protection_tooltip'   => 'Bloquear dominios de correo temporales/desechables (p. ej., Mailinator, 10MinuteMail).',
    'disposable_not_allowed'          => 'No se permiten direcciones de correo desechables.',

      // 3.3
    'enable_sidebar_dropdown'         => 'Habilitar menú desplegable en la barra lateral',
    'enable_sidebar_dropdown_tooltip' => 'Contrae los submenús en un desplegable clicable dentro de la barra lateral.',
    // Custom Menu
    'menu'               => 'Menú',
    'menus_heading'      => 'Menús',
    'menus_description'  => 'Administra y organiza los elementos del menú.',
    'add_menu_item'      => 'Añadir elemento de menú',
    'save_menu'          => 'Guardar menú',
    'label'              => 'Etiqueta',
    'parent'             => 'Padre',
    'icon_type'          => 'Tipo de icono',
    'svg'                => 'SVG',
    'fontawesome'        => 'FontAwesome',
    'svg_icon'           => 'Icono SVG',
    'fa_class'           => 'Clase FA',
    'named_route'        => 'Ruta nombrada',
    'absolute_url'       => 'URL absoluta',
    'permission'         => 'Permiso',
    'module_flag'        => 'Indicador de módulo',
    'sort_order'         => 'Orden de clasificación',
    'active'             => '¿Activo?',
    'apply'              => 'Aplicar',
    'add_menu'           => 'Añadir menú',
    'inactive'           => 'Inactivo',
    'flush_cache'        => 'Vaciar caché',
    'reset_menu'         => 'Restablecer',
    'custom_menu'        => 'Menú lateral personalizado',

    'rebuilt_successfully' => 'Reconstruido correctamente',

    'sidebar_layout'        => 'Diseño de la barra lateral',
    'sidebar_layout_1'      => 'Diseño 1 (Clásico)',
    'sidebar_layout_2'      => 'Diseño 2 (Compacto)',
    'sidebar_layout_custom' => 'Diseño personalizado',

    'custom_sidebar_type'   => 'Tipo de barra lateral personalizada',
    'sidebar'               => 'Barra lateral',
    'topbar'                => 'Barra superior',

    'tab_business_settings'    => 'Configuración del negocio',
    'business_settings_layout' => 'Diseño de configuración del negocio',
    'layout_1'                => 'Diseño 1 – Pestañas clásicas',
    'layout_2'                => 'Diseño 2 – Barra lateral moderna',

    // Themes
    'predefined_theme_label'   => 'Tema predefinido',
    'predefined_theme_tooltip' => 'Elige una paleta de colores predefinida.',
    'select_theme'             => 'Seleccionar tema',
    'theme_default'            => 'Predeterminado',

    // Migration Data
    'app_settings'            => 'Configuración de la aplicación',
    'application_settings'    => 'Configuraciones de la aplicación',
    'storage_migration'       => 'Migración de almacenamiento',
    'manage_uploads_data'     => 'Gestiona tus datos de cargas',

    'push'  => 'push',
    'pull'  => 'pull',
    'local' => 'local',
    'external_disk' => 'disco externo',
    'duplicate_files_skipped_safe_to_resume' => 'Los archivos duplicados se omiten. Puedes volver a ejecutar con seguridad para reanudar.',

    'direction'              => 'Dirección',
    'push_local_to_external' => 'push (local → externo)',
    'pull_external_to_local' => 'pull (externo → local)',

    'from_disk' => 'Desde disco',
    'to_disk'   => 'A disco',

    'destination_visibility'        => 'Visibilidad de destino',
    'visibility_none_bucket_signed' => '(ninguna / política del bucket / URLs firmadas)',
    'visibility_public_acl'         => 'público (ACL del objeto)',
    'visibility_private_acl'        => 'privado (ACL del objeto)',

    'folders_to_include_optional' => 'Carpetas a incluir (opcional)',
    'folders_include_tooltip'     => 'Déjalo vacío para incluir todas las carpetas bajo la raíz de uploads.',
    'select_all'                  => 'Seleccionar todo',
    'none'                        => 'Ninguno',
    'invert'                      => 'Invertir',
    'no_suggestions_found'        => 'No se encontraron sugerencias.',

    'delete_source_after_copy' => 'Eliminar origen después de copiar correctamente (mover)',
    'dry_run_plan_only'        => 'Simulación (solo plan)',
    'verbose_log_messages'     => 'Detallado (mensajes de registro en el estado)',

    'execution'                    => 'Ejecución',
    'execution_tooltip_html'       => 'Usa <strong>Directo</strong> solo para movimientos pequeños (p. ej., < 1000 archivos). Para 5-10 GB, se recomienda el trabajo en segundo plano.',
    'pick_how_to_execute'          => 'Elige cómo ejecutar la tarea de migración.',
    'background_job_recommended'   => 'Trabajo en segundo plano (recomendado)',
    'run_direct_now'               => 'Directo (ejecutar ahora)',

    'start_migration' => 'Iniciar migración',
    'reset'           => 'Restablecer',

    'progress' => 'Progreso',
    'result'   => 'Resultado',

    // JS Strings
    'from'                    => 'Desde',
    'to'                      => 'A',
    'folders'                 => 'Carpetas',
    'total'                   => 'Total',
    'copied'                  => 'Copiados',
    'skipped'                 => 'Omitidos',
    'deleted'                 => 'Eliminados',
    'failed'                  => 'Fallidos',
    'invalid_response'        => 'Respuesta inválida',
    'failed_to_start_migration'=> 'Error al iniciar la migración',
    'confirm_delete_source'   => '¿Seguro que deseas ELIMINAR los archivos de origen después de copiarlos? Esta acción no se puede deshacer.',

    'default_storage_disk'      => 'Disco de almacenamiento predeterminado',
    'default_storage_disk_help' => 'Elige dónde se guardan los nuevos archivos por defecto. "public" = storage/app/public vía enlace simbólico /storage. "local" = public/uploads.',

    's3_compatible_settings'     => 'Configuración compatible con S3',
    'display_label_optional'     => 'Etiqueta para mostrar (opcional)',
    'placeholder_my_s3_provider' => 'Mi proveedor S3',
    'display_only_admin_ui'      => 'Solo se muestra en la IU de administración.',
    'access_key'                 => 'Clave de acceso',
    'secret_key'                 => 'Clave secreta',
    'region'                     => 'Región',
    'bucket'                     => 'Bucket',
    'endpoint'                   => 'Endpoint',
    'cdn_or_custom_domain_optional' => 'CDN / Dominio personalizado (opcional)',

    'disable_http_verify'      => 'Desactivar verificación HTTP',
    'disable_http_verify_help' => 'Off = verificación TLS habilitada. On = verificación TLS deshabilitada (solo en localhost para pruebas).',

    'path_style_endpoint' => 'Endpoint estilo path',

    'use_signed_urls'      => 'Usar URLs firmadas (mantener bucket privado)',
    'use_signed_urls_help' => 'Off = URLs públicas (el bucket/CDN debe permitir lectura pública). On = privado con URLs firmadas.',

    'signed_url_ttl_minutes' => 'TTL de URL firmada (minutos)',
    'tab_storage_settings'   => 'Almacenamiento',
    'syncing'               => 'Sincronizando…',

    // POS Settings
    'pos_performance_settings'   => 'Configuración de rendimiento del POS',
    'enable_instant_pos'         => 'Habilitar POS instantáneo',
    'enable_instant_pos_tooltip' => 'Permite añadir productos instantáneamente sin llamadas AJAX para un mejor rendimiento',
    'enable_instant_pos_help'    => 'Cuando está habilitado, los productos se añaden al POS al instante usando datos en caché en lugar de solicitudes al servidor',

    'enable_instant_search'            => 'Habilitar búsqueda instantánea',
    'enable_instant_search_tooltip'    => 'Permite la búsqueda instantánea usando datos en caché en lugar de AJAX',
    'enable_instant_search_help'       => 'Cuando está habilitado, la búsqueda funciona instantáneamente sin solicitudes al servidor',

    'pos_performance_info_title' => 'Mejora de rendimiento',
    'pos_performance_info_desc'  => 'Las funciones de POS instantáneo mejoran significativamente el rendimiento al reducir las solicitudes al servidor:',
    'instant_pos_benefit_1'      => 'Los productos se añaden al instante sin esperar la respuesta del servidor',
    'instant_pos_benefit_2'      => 'Los resultados de búsqueda aparecen inmediatamente mientras escribes',
    'instant_pos_benefit_3'      => 'Los niveles de stock se actualizan automáticamente después de cada venta',
    'instant_pos_benefit_4'      => 'Funciona offline-first y luego se sincroniza con el servidor',

    'pos_cache_settings'                    => 'Configuración de caché del POS',
    'pos_cache_refresh_interval'            => 'Intervalo de actualización de caché',
    'pos_cache_refresh_interval_tooltip'    => 'Con qué frecuencia actualizar la caché de productos',
    'pos_cache_refresh_interval_help'       => 'Se actualiza automáticamente después de cada venta; intervalos manuales para actualizaciones de respaldo',
    'auto_refresh'                          => 'Auto (después de ventas)',
    '30_minutes'                            => '30 minutos',
    '60_minutes'                            => '60 minutos',
    '2_hours'                               => '2 horas',
    'manual_only'                           => 'Solo manual',

    'pos_max_cached_products'         => 'Máximo de productos en caché',
    'pos_max_cached_products_tooltip' => 'Número máximo de productos que se guardarán en caché para acceso instantáneo',
    'pos_max_cached_products_help'    => 'Números más altos mejoran la cobertura pero usan más memoria. Selecciona "Ilimitado" para almacenar todos los productos.',
    'unlimited'                       => 'Ilimitado',

    // Loading Messages
    'loading_products'                 => 'Cargando productos…',
    'please_wait_while_products_load'  => 'Por favor espera mientras se cargan los productos',
    'loading_products_placeholder'     => 'Cargando productos…',
    'updating_stock'                   => 'Actualizando stock…',
    'failed_to_load_cache'             => 'No se pudo cargar la caché de productos. La funcionalidad del POS puede ser limitada.',

    // Verificación OTP
    'otp_verification' => 'Verificación OTP',
    'otp_verification_management' => 'Gestión de Verificación OTP',
    'manage_otp_verification_requests' => 'Gestionar solicitudes de verificación OTP y ver estadísticas',
    'active_otps' => 'OTPs Activos',
    'unverified_users' => 'Usuarios No Verificados',
    'expired_otps' => 'OTPs Expirados',
    'failed_attempts' => 'Intentos Fallidos',
    'pending_users' => 'Usuarios Pendientes',
    'today_requests' => 'Solicitudes de Hoy',
    'high_retries' => 'Reintentos Altos',
    'user_info' => 'Información del Usuario',
    'otp_code' => 'Código OTP',
    'attempts' => 'Intentos',
    'resend_count' => 'Contador de Reenvíos',
    'no_active_otp' => 'Sin OTP Activo',
    'expired' => 'Expirado',
    'active' => 'Activo',
    'expires_in' => 'Expira en',
    'remaining' => 'restante',
    'resends' => 'reenvíos',
    'last' => 'Último',
    'updated' => 'Actualizado',
    'verify' => 'Verificar',
    'manual_verify_email' => 'Verificar Email Manualmente',
    'reset_otp' => 'Reiniciar OTP',
    'manual_verify' => 'Verificación Manual',
    'deactivate' => 'Desactivar',
    
    // Mensajes JavaScript
    'confirm_reset_otp' => '¿Estás seguro de que quieres reiniciar este OTP? El usuario tendrá que solicitar uno nuevo.',
    'failed_to_reset_otp' => 'Error al reiniciar OTP',
    'error_resetting_otp' => 'Error al reiniciar OTP',
    'confirm_verify_unverified_user' => '¿Estás seguro de que quieres verificar manualmente el email del usuario no verificado: :username?',
    'confirm_verify_user' => '¿Estás seguro de que quieres verificar manualmente el email del usuario: :username?',
    'user_verified_removed_from_list' => 'Email del usuario verificado - el usuario ya no aparecerá en la lista de no verificados',
    'failed_to_verify_user' => 'Error al verificar usuario',
    'error_verifying_user' => 'Error al verificar usuario',
    'confirm_deactivate_token' => '¿Estás seguro de que quieres desactivar este token OTP?',
    'failed_to_deactivate_token' => 'Error al desactivar token',
    'error_deactivating_token' => 'Error al desactivar token',

    // Gestión de Sesiones
    'session_management' => 'Gestión de Sesiones',
    'manage_user_sessions_and_authentication' => 'Gestionar sesiones de usuario y autenticación',
    'all_users' => 'Todos los Usuarios',
    'active_users' => 'Usuarios Activos',
    'locked_users' => 'Usuarios Bloqueados',
    'disabled_logins' => 'Inicios de Sesión Deshabilitados',
    'active_sessions' => 'Sesiones Activas',
    'unique_users' => 'Usuarios Únicos',
    'active_businesses' => 'Negocios Activos',
    'inactive_businesses' => 'Negocios Inactivos',
    'user_info' => 'Información del Usuario',
    'session_info' => 'Información de la Sesión',
    'force_logout' => 'Forzar Cierre de Sesión',
    'lock_user' => 'Bloquear Usuario',
    'unlock_user' => 'Desbloquear Usuario',
    'lock_user_account' => 'Bloquear Cuenta de Usuario',
    'lock_duration' => 'Duración del Bloqueo',
    'user_will_be_locked_for_selected_duration' => 'El usuario será bloqueado por la duración seleccionada',
    'minutes' => 'minutos',
    'hour' => 'hora',
    'hours' => 'horas',
    'deactivate_user' => 'Desactivar Usuario',
    'activate_user' => 'Activar Usuario',
    'block_login' => 'Bloquear Inicio de Sesión',
    'allow_login' => 'Permitir Inicio de Sesión',
    'deactivate_business' => 'Desactivar Negocio',
    'activate_business' => 'Activar Negocio',
    'login_allowed' => 'Inicio de Sesión Permitido',
    'login_blocked' => 'Inicio de Sesión Bloqueado',
    'temporary_lock' => 'Bloqueo Temporal',
    'user_locked_successfully' => 'Usuario bloqueado por :duration minutos',
    'user_unlocked_successfully' => 'Usuario desbloqueado exitosamente',
    'user_activated_successfully' => 'Usuario activado exitosamente',
    'user_deactivated_successfully' => 'Usuario desactivado exitosamente',
    'login_permission_granted' => 'Permiso de inicio de sesión concedido',
    'login_permission_revoked' => 'Permiso de inicio de sesión revocado',
    'business_activated_successfully' => 'Negocio activado exitosamente',
    'business_deactivated_successfully' => 'Negocio desactivado exitosamente',
    'user_logged_out_successfully' => 'Usuario desconectado exitosamente',
    'failed_to_lock_user' => 'Error al bloquear usuario',
    'failed_to_unlock_user' => 'Error al desbloquear usuario',
    'failed_to_update_user_status' => 'Error al actualizar el estado del usuario',
    'failed_to_update_login_permission' => 'Error al actualizar el permiso de inicio de sesión',
    'failed_to_update_business_status' => 'Error al actualizar el estado del negocio',
    'failed_to_logout_user' => 'Error al cerrar sesión del usuario',
    'error_locking_user' => 'Error al bloquear el usuario',
    'error_unlocking_user' => 'Error al desbloquear el usuario',
    'error_updating_user_status' => 'Error al actualizar el estado del usuario',
    'error_updating_login_permission' => 'Error al actualizar el permiso de inicio de sesión',
    'error_updating_business_status' => 'Error al actualizar el estado del negocio',
    'error_logging_out_user' => 'Error al cerrar la sesión del usuario',
    'confirm_force_logout' => '¿Estás seguro de que quieres forzar el cierre de sesión del usuario: :username?',
    'confirm_lock_user' => '¿Estás seguro de que quieres bloquear al usuario: :username por :duration minutos?',
    'confirm_unlock_user' => '¿Estás seguro de que quieres desbloquear al usuario: :username?',
    'confirm_toggle_user_status' => '¿Estás seguro de que quieres :action al usuario: :username?',
    'confirm_toggle_login_permission' => '¿Estás seguro de que quieres :action para el usuario: :username?',
    'confirm_toggle_business_status' => '¿Estás seguro de que quieres :action el negocio: :business?',
    'activate' => 'activar',
    'deactivate' => 'desactivar',
    
    // Instant POS Button Strings
    'refresh_pos_cache' => 'Actualizar Caché',
    'instant_pos_enabled' => 'TPV Instantáneo Activado',
    'instant_pos_disabled' => 'TPV Instantáneo Desactivado',
    'disable_instant_pos' => 'Desactivar TPV Instantáneo',
];
