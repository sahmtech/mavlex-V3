<?php

return [

    'app_settings' => 'Configurações do Aplicativo',
    'manage_app_settings' => 'Gerenciar Configurações do Aplicativo',
    'tab_2fa' => '2FA',
    'tab_theme' => 'Aparência',
    'tab_login_page' => 'Página de Login',
    'tab_sidebar' => 'Barra Lateral',
    'tab_language' => 'Idioma',
    'tab_repair_status' => 'Status de Reparo',
    'tab_logo' => 'Logo',
    // Buttons
    'update_settings' => 'Atualizar Configurações',

    'enable_custom_bg_image_for_login' => 'Ativar Fundo Personalizado para Login',
    'enable_custom_bg_image_for_login_tooltip' => 'Defina uma imagem de fundo personalizada para a página de login.',

    'enable_custom_sidebar_logo' => 'Permitir Logo Personalizado na Barra Lateral',
    'enable_custom_sidebar_logo_tooltip' => 'Permite que as empresas usem um logotipo personalizado na barra lateral.',

    // language.blade.php
    'header_language_change' => 'Alterar Idioma no Cabeçalho',
    'header_language_change_tooltip' => 'Permitir que os usuários troquem o idioma a partir do cabeçalho principal.',
    'header_languages_label' => 'Idiomas no Cabeçalho',
    'header_languages_label_tooltip' => 'Selecione quais idiomas serão exibidos no cabeçalho.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'Exibir Status de Reparo na Tela de Login',

    // 2fa.blade.php
    'enable_2fa' => 'Ativar 2FA',
    'enable_2fa_tooltip' => 'Ative a Autenticação de Dois Fatores (2FA) para o aplicativo.',

    'force_2fa' => 'Forçar 2FA',
    'force_2fa_tooltip' => 'Os usuários devem configurar o 2FA antes de poderem usar o aplicativo.',

    'recommend_2fa' => 'Recomendar 2FA',
    'recommend_2fa_tooltip' => 'Aparece um modal único no login para incentivar os usuários a habilitarem o 2FA.',

    'allow_disable_2fa' => 'Permitir Desativar 2FA Temporariamente',
    'allow_disable_2fa_tooltip' => 'Permitir que os usuários desativem temporariamente o 2FA até um horário específico.',

    'disable_2fa_duration_label' => 'Duração para Desativar o 2FA',
    'disable_2fa_duration_label_tooltip' => 'Defina o período durante o qual o 2FA pode permanecer desativado.',

    'disable_2fa_unit_label' => 'Unidade para Desativar o 2FA',

    'force_2fa_after_date_label' => 'Forçar 2FA Após Data',
    'force_2fa_after_date_label_tooltip' => 'Após esta data, todos os usuários devem habilitar o 2FA. A data também é exibida no modal de recomendação do 2FA.',

    'primary_color_label' => 'Cor Primária',
    'primary_color_label_tooltip' => 'Selecione a cor primária padrão do aplicativo. Essa cor será usada por empresas que não definirem cores personalizadas.',
    'secondary_color_label' => 'Cor Secundária',
    'secondary_color_label_tooltip' => 'Selecione a cor secundária padrão do aplicativo. Essa cor será usada por empresas que não definirem cores personalizadas.',

    'allow_theme_change' => 'Permitir Alteração de Tema',
    'allow_theme_change_tooltip' => 'Permitir que as empresas personalizem as próprias cores do tema. Quando ativado, empresas sem cores personalizadas usarão as cores padrão definidas aqui pelo superadmin.',

    'login_bg_image_label' => 'Imagem de Fundo para Login',
    'login_bg_image_label_tooltip' => 'Fazer upload de uma nova imagem substituirá o fundo atual.',

    'logo_dark_tooltip'  => 'Altere o logotipo escuro padrão do aplicativo, usado no modo claro.',
    'logo_light_tooltip' => 'Altere o logotipo claro padrão do aplicativo, usado no modo escuro.',
    'favicon_tooltip' => 'Dimensões recomendadas: 32×32 px. Este ícone aparece nas abas do navegador e favoritos.',
    'upload_favicon' => 'Enviar Favicon',

    // Fonts
    'tab_fonts' => 'Fontes',
    'english_font'            => 'Fonte em Inglês',
    'arabic_font'             => 'Fonte em Árabe',
    'custom_font_placeholder' => 'Insira o nome de uma fonte personalizada...',
    'select_font'             => 'Selecione uma fonte...',
    'or'                      => 'ou',
    'font_help_text'          => 'Escolha da lista ou insira sua própria fonte.',
    'english_font_tooltip'  => 'Insira o nome de uma fonte personalizada ou escolha uma da lista. Você pode encontrar nomes de fontes em: :url',
    'arabic_font_tooltip'   => 'Insira o nome de uma fonte personalizada ou escolha uma da lista. Você pode encontrar nomes de fontes em: :url',

    //Recaptcha:
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha'              => 'Ativar Google reCAPTCHA',
    'enable_recaptcha_tooltip'      => 'Alternar para ativar a proteção reCAPTCHA. Obtenha sua chave e segredo em: :url',
    'enable_recaptcha_text'         => 'Ativar reCAPTCHA',
    'google_recaptcha_key'          => 'Chave do Site (Site Key) do Google reCAPTCHA',
    'google_recaptcha_secret'       => 'Chave Secreta (Secret Key) do Google reCAPTCHA',
    'google_recaptcha_key_placeholder'    => 'Insira sua Chave do Site do Google reCAPTCHA',
    'google_recaptcha_secret_placeholder' => 'Insira sua Chave Secreta do Google reCAPTCHA',

    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'Ativar Autenticação de Dois Fatores',
    'modal_enable_2fa_desc' => 'Recomendamos ativar o 2FA para aprimorar a segurança da sua conta.',
    'enable_now_button' => 'Ativar Agora',
    'maybe_later_button' => 'Talvez Depois',
    'close_aria_label' => 'Fechar',

    // 2FA Verify page
    'one_time_password_heading' => 'Senha de Uso Único (OTP)',
    'one_time_password_label' => 'Senha de Uso Único (OTP)',
    'enter_2fa_code_placeholder' => 'Insira o código 2FA',
    'disable_2fa_for' => 'Desativar 2FA por :duration :unit',
    'verify_button' => 'Verificar',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'Autenticação de Dois Fatores (2FA)',
    'google_auth_app_desc' => 'App Google Authenticator',
    'configured_status' => 'Configurado',
    'needs_configuration_status' => 'Necessita Configuração',
    'two_factor_scan_or_enter_msg' => 'Por favor, escaneie o QR code abaixo usando o aplicativo Google Authenticator ou insira a chave manualmente, em seguida insira o código gerado.',
    'your_secret_key_msg' => 'Sua chave secreta (se precisar inserir manualmente):',

    // 2FA field labels
    'one_time_password_label' => 'Senha de Uso Único (OTP)',
    'enter_2fa_code_placeholder' => 'Insira o código 2FA',
    '2fa_will_be_forced_after_date' => 'O 2FA será forçado após :date.',

    // Buttons
    '2fa' => '2FA',
    'verify_button' => 'Verificar',

    'confirm_access_recovery_codes' => 'Confirmar Acesso',
    're_authenticate_message'       => 'Você deve se autenticar novamente para acessar a Configuração ou os Códigos de Recuperação de 2FA.',
    'choose_method'                 => 'Escolha o método:',
    'one_time_password'             => 'Senha de Uso Único (OTP)',
    'password'                      => 'Senha',
    'enter_code_or_password'        => 'Insira o Código / Senha:',
    'confirm'                       => 'Confirmar',

    '2fa_recovery_codes'           => 'Códigos de Recuperação 2FA',
    'recovery_codes_description'   => 'Estes códigos permitem que você faça login caso perca o acesso ao seu dispositivo autenticador. Cada código só pode ser usado uma vez.',
    'regenerate_codes'             => 'Regenerar Códigos',
    'copy'                         => 'Copiar',
    'copy_all'                     => 'Copiar Todos',
    'no_recovery_codes_available'  => 'Não há códigos de recuperação disponíveis. Você pode gerar novos abaixo.',
    'copied'                       => 'Código copiado para a área de transferência!',
    'all_codes_copied'             => 'Todos os códigos de recuperação foram copiados!',
    'supported_app'                => 'Apps Suportados',
    'supported_apps' => [
        'Authy' => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP' => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator' => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator' => ['Windows Phone'],
        'LastPass Authenticator' => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password' => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    //social logins:
    'social_login_settings'       => 'Configurações de Login Social',
    'social_login_settings_help'  => 'Insira suas credenciais de login social.',
    'client_id'                   => 'Client ID',
    'client_secret'               => 'Client Secret',
    'redirect_url'                => 'URL de Redirecionamento (Redirect URL)',
    'enter_client_id'             => 'Insira o Client ID de :provider',
    'enter_client_secret'         => 'Insira o Client Secret de :provider',
    'enter_redirect_url'          => 'Insira o Redirect URL de :provider',
    'enable_social_login' => 'Ativar Login Social',
    'tab_social' => 'Logins Sociais',
    'or_login_with' => 'Ou faça login com',
    'force_otp_after_social_login' => 'Forçar OTP após Login Social',
    'force_otp_after_social_login_tooltip' => 'Se ativado, usuários que fizerem login usando redes sociais terão que verificar um OTP.',

    //Lock Users:
    'locked_until' => 'Bloqueado Até',
    'locked_users' => 'Usuários Bloqueados',
    'view_locked_users' => 'Ver Usuários Bloqueados',
    'tab_login_security' => 'Segurança de Login',
    'unlock' => 'Desbloquear',
    'enable_user_lock_label' => 'Ativar Bloqueio de Usuário',
    'enable_user_lock_tooltip' => 'Ativar/desativar bloqueio de usuário após tentativas de login falhas.',
    'max_login_attempts_label' => 'Máximo de Tentativas de Login',
    'max_login_attempts_tooltip' => 'Quantidade de tentativas permitidas antes de o usuário ser bloqueado.',
    'lock_duration_label' => 'Duração do Bloqueio',
    'lock_duration_tooltip' => 'Período de tempo (em números) que o usuário permanece bloqueado.',
    'lock_duration_unit_label' => 'Unidade de Duração do Bloqueio',
    'lock_duration_unit_tooltip' => 'Escolha a unidade de tempo para a duração do bloqueio: minutos, horas, dias etc.',
    'account_locked_for_time_unit' => 'Sua conta está bloqueada por :time :unit.',
    'user_unlocked_message' => 'Usuário desbloqueado com sucesso!',

    //Verify email:
    'verify_email_address_title' => 'Verifique Seu Endereço de Email',
    'fresh_verification_sent' => 'Um novo link de verificação foi enviado para seu endereço de email.',
    'verify_email_before_proceeding' => 'Antes de prosseguir, verifique seu email para o link de verificação.',
    'did_not_receive_email' => 'Se você não recebeu o email',
    'click_here_request_another' => 'clique aqui para solicitar outro',
    'logout' => 'Sair',
    'force_email_verify' => 'Forçar Verificação de Email',
    'force_email_verify_tooltip' => 'Se ativado, os usuários devem verificar seu endereço de email antes de acessar o sistema.',

      // Reset Mapping
      'reset_purchase_sell_mapping'     => 'Reiniciar mapeamento compra-venda',
      'select_business'                 => 'Selecionar empresa:',
      'all_businesses'                  => 'Todas as empresas',
      'chunk_size'                      => 'Tamanho do lote:',
      'reset_mapping'                   => 'Reiniciar mapeamento',
      'purchase_sell_mismatch_tooltip'  => 'Escolha quais mapeamentos de empresa devem ser reiniciados. Se você tiver um banco de dados grande, recomendamos reiniciar por empresa.',
      'chunk_size_tooltip'              => 'O mapeamento será reiniciado em lotes menores. Para grandes conjuntos de dados, escolha um tamanho de lote apropriado. Recomenda-se ativar o modo de manutenção.',
  
      // Maintenance Mode
      'tab_maintenance_mode'            => 'Modo de manutenção',
      'maintenance_mode'                => 'Modo de manutenção',
      'maintenance_mode_tooltip'        => 'Coloca a aplicação em modo de manutenção (os visitantes verão a tela de manutenção).',
      'enable_countdown'                => 'Ativar contagem regressiva',
      'enable_timer_tooltip'            => 'Exibe uma contagem regressiva ao vivo até o fim da manutenção.',
      'maintenance_duration'            => 'Duração',
      'maintenance_unit'                => 'Unidade de duração',
      'minutes'                         => 'Minutos',
      'hours'                           => 'Horas',
      'days'                            => 'Dias',
  
      // Maintenance page
      'under_maintenance'               => 'Em manutenção',
      'maintenance_heading'             => 'Estamos realizando manutenção.',
      'maintenance_subheading'          => 'Obrigado pela sua paciência!',
      'maintenance_back_in'             => 'Voltamos em :time',
      'maintenance_back_no_timer'       => 'Voltamos assim que concluir a manutenção.',
  
      // Mapping reset page
      'mapping_reset_progress'          => 'Progresso de reinício de mapeamento',
      'mapping_reset_in_progress'       => 'Reinício de mapeamento em andamento',
      'batch_status'                    => 'Status do lote',
      'refresh_status'                  => 'Atualizar status',
  
      // Mapping reset result & status
      'mapping_reset_result'            => 'Resultado do reinício de mapeamento',
      'chunk_processing_status'         => 'Status de processamento do lote',
  
      // Table headers
      'business'                        => 'Empresa',
      'chunk_status'                    => 'Status do lote',
      'total_chunks'                    => 'Total de lotes',
      'status'                          => 'Status',
  
      // Button
      'go_back'                         => 'Voltar',
  
      // Mapping Jobs
      'processed_jobs'                  => 'Tarefas de mapeamento',
      'processed_jobs_subtitle'         => 'Todos os lotes de mapeamento enviados',
      'uuid'                            => 'UUID do lote',
      'job_name'                        => 'Nome da tarefa',
      'completed_chunks'                => 'Lotes concluídos',
      'started_at'                      => 'Iniciado em',
      'finished_at'                     => 'Última atualização',
      'view_rebuild_jobs'               => 'Ver tarefas de reconstrução de estoque',
  
      // Detailed instruction
      'reset_mapping_instruction'       =>
          "Recomendamos configurar o driver de fila para um backend real:\n"
          ."→ No seu .env, defina `QUEUE_CONNECTION=database`.\n\n"
          ."Também ative o modo de manutenção (Configurações da aplicação → Modo de manutenção) durante o reinício para evitar dados duplicados ou perdidos.\n\n"
          ."Se seu banco de dados for grande, o reinício levará mais tempo—considere reiniciar por empresa.\n\n"
          ."Antes de começar:\n"
          ."• Faça backup completo do banco de dados.\n"
          ."• Monitore o processo pelos logs para capturar erros.",
  
      'recovery_codes_generated_successfully' => 'Códigos de recuperação gerados com sucesso',
  
      // Disposable-email sync
      'sync_disposable_list'            => 'Sincronizar lista de e-mails descartáveis',
      'sync_disposable_success'         => 'Lista de e-mails descartáveis atualizada.',
      'sync_disposable_failed'          => 'Falha ao sincronizar lista de e-mails descartáveis.',
  
      // Temporary-email protection
      'temp_email_protection'           => 'Bloquear endereços de e-mail descartáveis',
      'temp_email_protection_tooltip'   => 'Bloqueia domínios de e-mail temporários/descartáveis (ex.: Mailinator, 10MinuteMail).',
      'disposable_not_allowed'          => 'Endereços de e-mail descartáveis não são permitidos.',

      // 3.3
    'enable_sidebar_dropdown'         => 'Ativar dropdown na barra lateral',
    'enable_sidebar_dropdown_tooltip' => 'Recolhe os sub-menus num dropdown clicável dentro da barra lateral.',
    // Custom Menu
    'menu'               => 'Menu',
    'menus_heading'      => 'Menus',
    'menus_description'  => 'Gerir e organizar os itens de menu.',
    'add_menu_item'      => 'Adicionar item de menu',
    'save_menu'          => 'Guardar menu',
    'label'              => 'Rótulo',
    'parent'             => 'Pai',
    'icon_type'          => 'Tipo de ícone',
    'svg'                => 'SVG',
    'fontawesome'        => 'FontAwesome',
    'svg_icon'           => 'Ícone SVG',
    'fa_class'           => 'Classe FA',
    'named_route'        => 'Rota nomeada',
    'absolute_url'       => 'URL absoluto',
    'permission'         => 'Permissão',
    'module_flag'        => 'Sinalizador de módulo',
    'sort_order'         => 'Ordem',
    'active'             => 'Ativo?',
    'apply'              => 'Aplicar',
    'add_menu'           => 'Adicionar menu',
    'inactive'           => 'Inativo',
    'flush_cache'        => 'Limpar cache',
    'reset_menu'         => 'Repor',
    'custom_menu'        => 'Menu lateral personalizado',

    'rebuilt_successfully' => 'Reconstruído com sucesso',

    'sidebar_layout'        => 'Layout da barra lateral',
    'sidebar_layout_1'      => 'Layout 1 (Clássico)',
    'sidebar_layout_2'      => 'Layout 2 (Compacto)',
    'sidebar_layout_custom' => 'Layout personalizado',

    'custom_sidebar_type'   => 'Tipo de barra lateral personalizada',
    'sidebar'               => 'Barra lateral',
    'topbar'                => 'Barra superior',

    'tab_business_settings'    => 'Definições de negócio',
    'business_settings_layout' => 'Layout das definições de negócio',
    'layout_1'                => 'Layout 1 – Separadores clássicos',
    'layout_2'                => 'Layout 2 – Barra lateral moderna',

    // Themes
    'predefined_theme_label'   => 'Tema predefinido',
    'predefined_theme_tooltip' => 'Escolha uma paleta de cores pronta.',
    'select_theme'             => 'Selecionar tema',
    'theme_default'            => 'Padrão',

    // Migration Data
    'app_settings'         => 'Definições da aplicação',
    'application_settings' => 'Configurações da aplicação',
    'storage_migration'    => 'Migração de armazenamento',
    'manage_uploads_data'  => 'Gerir dados de uploads',

    'push'  => 'push',
    'pull'  => 'pull',
    'local' => 'local',
    'external_disk' => 'disco externo',
    'duplicate_files_skipped_safe_to_resume' =>
        'Ficheiros duplicados ignorados. Pode relançar em segurança para retomar.',

    'direction'              => 'Direção',
    'push_local_to_external' => 'push (local → externo)',
    'pull_external_to_local' => 'pull (externo → local)',

    'from_disk' => 'Do disco',
    'to_disk'   => 'Para o disco',

    'destination_visibility'        => 'Visibilidade de destino',
    'visibility_none_bucket_signed' => '(nenhuma / política do bucket / URLs assinadas)',
    'visibility_public_acl'         => 'público (ACL do objeto)',
    'visibility_private_acl'        => 'privado (ACL do objeto)',

    'folders_to_include_optional' => 'Pastas a incluir (opcional)',
    'folders_include_tooltip'     => 'Deixe em branco para incluir todas as pastas na raiz de uploads.',
    'select_all'                  => 'Selecionar tudo',
    'none'                        => 'Nenhum',
    'invert'                      => 'Inverter',
    'no_suggestions_found'        => 'Nenhuma sugestão encontrada.',

    'delete_source_after_copy' => 'Apagar origem após cópia bem-sucedida (mover)',
    'dry_run_plan_only'        => 'Simulação (apenas plano)',
    'verbose_log_messages'     => 'Detalhado (mensagens de log no estado)',

    'execution'                    => 'Execução',
    'execution_tooltip_html'       =>
        'Use <strong>Direto</strong> apenas para movimentos pequenos (ex.: &lt; 1000 ficheiros). ' .
        'Para 5–10 GB, prefira a tarefa em segundo plano.',
    'pick_how_to_execute'          => 'Escolha como executar a tarefa de migração.',
    'background_job_recommended'   => 'Tarefa em segundo plano (recomendado)',
    'run_direct_now'               => 'Direto (executar agora)',

    'start_migration' => 'Iniciar migração',
    'reset'           => 'Repor',

    'progress' => 'Progresso',
    'result'   => 'Resultado',

    // JS strings
    'from'                    => 'De',
    'to'                      => 'Para',
    'folders'                 => 'Pastas',
    'total'                   => 'Total',
    'copied'                  => 'Copiados',
    'skipped'                 => 'Ignorados',
    'deleted'                 => 'Eliminados',
    'failed'                  => 'Falhados',
    'invalid_response'        => 'Resposta inválida',
    'failed_to_start_migration'=> 'Falha ao iniciar a migração',
    'confirm_delete_source'   =>
        'Tem a certeza de que pretende APAGAR os ficheiros de origem após a cópia? ' .
        'Esta ação é irreversível.',

    'default_storage_disk'      => 'Disco de armazenamento predefinido',
    'default_storage_disk_help' =>
        'Escolha onde novos ficheiros são guardados por predefinição. ' .
        '"public" = storage/app/public via symlink /storage; "local" = public/uploads.',

    's3_compatible_settings'     => 'Definições compatíveis com S3',
    'display_label_optional'     => 'Rótulo de exibição (opcional)',
    'placeholder_my_s3_provider' => 'O meu fornecedor S3',
    'display_only_admin_ui'      => 'Apenas para exibição na área de admin.',
    'access_key'                 => 'Access Key',
    'secret_key'                 => 'Secret Key',
    'region'                     => 'Região',
    'bucket'                     => 'Bucket',
    'endpoint'                   => 'Endpoint',
    'cdn_or_custom_domain_optional' => 'CDN / Domínio personalizado (opcional)',

    'disable_http_verify'      => 'Desativar verificação TLS',
    'disable_http_verify_help' =>
        'Off = verificação TLS ativa. On = verificação desativada (apenas em localhost para testes).',

    'path_style_endpoint' => 'Endpoint em estilo path',

    'use_signed_urls'      => 'Usar URLs assinadas (manter bucket privado)',
    'use_signed_urls_help' =>
        'Off = URLs públicas (bucket/CDN deve permitir leitura pública). ' .
        'On = privado com URLs assinadas.',

    'signed_url_ttl_minutes' => 'TTL das URLs assinadas (minutos)',
    'tab_storage_settings'   => 'Armazenamento',
    'syncing'               => 'A sincronizar…',

    // POS Settings
    'pos_performance_settings'   => 'Definições de desempenho POS',
    'enable_instant_pos'         => 'Ativar POS instantâneo',
    'enable_instant_pos_tooltip' => 'Adiciona produtos instantaneamente sem AJAX, melhorando desempenho',
    'enable_instant_pos_help'    =>
        'Quando ativado, os produtos são adicionados no POS usando dados em cache em vez de pedidos ao servidor.',

    'enable_instant_search'            => 'Ativar pesquisa instantânea',
    'enable_instant_search_tooltip'    => 'Pesquisa produtos a partir do cache em vez de AJAX',
    'enable_instant_search_help'       =>
        'Quando ativado, a pesquisa apresenta resultados imediatamente, sem pedidos ao servidor.',

    'pos_performance_info_title' => 'Melhoria de desempenho',
    'pos_performance_info_desc'  => 'O POS instantâneo melhora o desempenho ao reduzir pedidos ao servidor:',
    'instant_pos_benefit_1'      => 'Produtos adicionados imediatamente, sem tempo de espera',
    'instant_pos_benefit_2'      => 'Resultados de pesquisa surgem instantaneamente enquanto digita',
    'instant_pos_benefit_3'      => 'Stocks atualizados automaticamente após cada venda',
    'instant_pos_benefit_4'      => 'Funciona offline-first e sincroniza depois com o servidor',

    'pos_cache_settings'                    => 'Definições de cache do POS',
    'pos_cache_refresh_interval'            => 'Intervalo de atualização do cache',
    'pos_cache_refresh_interval_tooltip'    => 'Frequência de atualização do cache de produtos',
    'pos_cache_refresh_interval_help'       =>
        'Atualiza automaticamente após cada venda; intervalos manuais servem de apoio.',
    'auto_refresh'                          => 'Automático (após vendas)',
    '30_minutes'                            => '30 minutos',
    '60_minutes'                            => '60 minutos',
    '2_hours'                               => '2 horas',
    'manual_only'                           => 'Apenas manual',

    'pos_max_cached_products'         => 'Máx. de produtos em cache',
    'pos_max_cached_products_tooltip' => 'Número máximo de produtos a manter em cache',
    'pos_max_cached_products_help'    =>
        'Números maiores aumentam cobertura mas consomem mais memória. ' .
        'Selecione "Ilimitado" para manter todos os produtos em cache.',
    'unlimited'                       => 'Ilimitado',

    // Loading messages
    'loading_products'                 => 'A carregar produtos…',
    'please_wait_while_products_load'  => 'Por favor aguarde enquanto os produtos são carregados',
    'loading_products_placeholder'     => 'A carregar produtos…',
    'updating_stock'                   => 'A atualizar stock…',
    'failed_to_load_cache'             => 'Falha ao carregar o cache de produtos. ' .
                                          'A funcionalidade do POS pode ficar limitada.',

    // OTP Verification
    'otp_verification' => 'Verificação OTP',
    'otp_verification_management' => 'Gestão de Verificação OTP',
    'manage_otp_verification_requests' => 'Gerir solicitações de verificação OTP e visualizar estatísticas',
    'active_otps' => 'OTPs Ativos',
    'unverified_users' => 'Utilizadores Não Verificados',
    'expired_otps' => 'OTPs Expirados',
    'failed_attempts' => 'Tentativas Falhadas',
    'pending_users' => 'Utilizadores Pendentes',
    'today_requests' => 'Solicitações de Hoje',
    'high_retries' => 'Muitas Tentativas',
    'user_info' => 'Informações do Utilizador',
    'otp_code' => 'Código OTP',
    'attempts' => 'Tentativas',
    'resend_count' => 'Contador de Reenvios',
    'no_active_otp' => 'Nenhum OTP Ativo',
    'expired' => 'Expirado',
    'active' => 'Ativo',
    'expires_in' => 'Expira em',
    'remaining' => 'restante',
    'resends' => 'reenvios',
    'last' => 'Último',
    'updated' => 'Atualizado',
    'verify' => 'Verificar',
    'manual_verify_email' => 'Verificar E-mail Manualmente',
    'reset_otp' => 'Repor OTP',
    'manual_verify' => 'Verificar Manualmente',
    'deactivate' => 'Desativar',

    // JavaScript messages
    'confirm_reset_otp' => 'Tem certeza de que quer repor este OTP? O utilizador precisará solicitar um novo.',
    'failed_to_reset_otp' => 'Falha ao repor OTP',
    'error_resetting_otp' => 'Erro ocorrido ao repor OTP',
    'confirm_verify_unverified_user' => 'Tem certeza de que quer verificar manualmente o e-mail do utilizador não verificado: :username?',
    'confirm_verify_user' => 'Tem certeza de que quer verificar manualmente o e-mail do utilizador: :username?',
    'user_verified_removed_from_list' => 'E-mail do utilizador verificado - o utilizador não aparecerá mais na lista de não verificados',
    'failed_to_verify_user' => 'Falha ao verificar utilizador',
    'error_verifying_user' => 'Erro ocorrido ao verificar utilizador',
    'confirm_deactivate_token' => 'Tem certeza de que quer desativar este token OTP?',
    'failed_to_deactivate_token' => 'Falha ao desativar token',
    'error_deactivating_token' => 'Erro ocorrido ao desativar token',

    // Session Management
    'session_management' => 'Gestão de Sessões',
    'manage_user_sessions_and_authentication' => 'Gerenciar sessões de usuário e autenticação',
    'all_users' => 'Todos os Usuários',
    'active_users' => 'Usuários Ativos',
    'locked_users' => 'Usuários Bloqueados',
    'disabled_logins' => 'Logins Desabilitados',
    'active_sessions' => 'Sessões Ativas',
    'unique_users' => 'Usuários Únicos',
    'active_businesses' => 'Negócios Ativos',
    'inactive_businesses' => 'Negócios Inativos',
    'user_info' => 'Info do Usuário',
    'session_info' => 'Info da Sessão',
    'force_logout' => 'Forçar Logout',
    'lock_user' => 'Bloquear Usuário',
    'unlock_user' => 'Desbloquear Usuário',
    'lock_user_account' => 'Bloquear Conta do Usuário',
    'lock_duration' => 'Duração do Bloqueio',
    'user_will_be_locked_for_selected_duration' => 'O usuário será bloqueado pela duração selecionada',
    'minutes' => 'minutos',
    'hour' => 'hora',
    'hours' => 'horas',
    'deactivate_user' => 'Desativar Usuário',
    'activate_user' => 'Ativar Usuário',
    'block_login' => 'Bloquear Login',
    'allow_login' => 'Permitir Login',
    'deactivate_business' => 'Desativar Negócio',
    'activate_business' => 'Ativar Negócio',
    'login_allowed' => 'Login Permitido',
    'login_blocked' => 'Login Bloqueado',
    'temporary_lock' => 'Bloqueio Temporário',
    'user_locked_successfully' => 'Usuário bloqueado por :duration minutos',
    'user_unlocked_successfully' => 'Usuário desbloqueado com sucesso',
    'user_activated_successfully' => 'Usuário ativado com sucesso',
    'user_deactivated_successfully' => 'Usuário desativado com sucesso',
    'login_permission_granted' => 'Permissão de login concedida',
    'login_permission_revoked' => 'Permissão de login revogada',
    'business_activated_successfully' => 'Negócio ativado com sucesso',
    'business_deactivated_successfully' => 'Negócio desativado com sucesso',
    'user_logged_out_successfully' => 'Usuário desconectado com sucesso',
    'failed_to_lock_user' => 'Falha ao bloquear usuário',
    'failed_to_unlock_user' => 'Falha ao desbloquear usuário',
    'failed_to_update_user_status' => 'Falha ao atualizar status do usuário',
    'failed_to_update_login_permission' => 'Falha ao atualizar permissão de login',
    'failed_to_update_business_status' => 'Falha ao atualizar status do negócio',
    'failed_to_logout_user' => 'Falha ao desconectar usuário',
    'error_locking_user' => 'Erro ao bloquear usuário',
    'error_unlocking_user' => 'Erro ao desbloquear usuário',
    'error_updating_user_status' => 'Erro ao atualizar status do usuário',
    'error_updating_login_permission' => 'Erro ao atualizar permissão de login',
    'error_updating_business_status' => 'Erro ao atualizar status do negócio',
    'error_logging_out_user' => 'Erro ao desconectar usuário',
    'confirm_force_logout' => 'Tem certeza de que quer forçar logout do usuário: :username?',
    'confirm_lock_user' => 'Tem certeza de que quer bloquear o usuário: :username por :duration minutos?',
    'confirm_unlock_user' => 'Tem certeza de que quer desbloquear o usuário: :username?',
    'confirm_toggle_user_status' => 'Tem certeza de que quer :action o usuário: :username?',
    'confirm_toggle_login_permission' => 'Tem certeza de que quer :action para o usuário: :username?',
    'confirm_toggle_business_status' => 'Tem certeza de que quer :action o negócio: :business?',
    'activate' => 'ativar',
    'deactivate' => 'desativar',
    
    // Instant POS Button Strings
    'refresh_pos_cache' => 'Atualizar Cache',
    'instant_pos_enabled' => 'PDV Instantâneo Ativado',
    'instant_pos_disabled' => 'PDV Instantâneo Desativado',
    'disable_instant_pos' => 'Desativar POS Instantâneo',
];
