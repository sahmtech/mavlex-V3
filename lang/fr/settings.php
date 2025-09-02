<?php

return [
    'app_settings' => 'Paramètres de l’Application',
    'manage_app_settings' => 'Gérer les Paramètres de l’Application',
    'tab_2fa' => '2FA',
    'tab_theme' => 'Apparence',
    'tab_login_page' => 'Page de Connexion',
    'tab_sidebar' => 'Barre Latérale',
    'tab_language' => 'Langue',
    'tab_repair_status' => 'Statut de Réparation',
    'tab_logo' => 'Logo',
    // Buttons
    'update_settings' => 'Mettre à jour les Paramètres',

    'enable_custom_bg_image_for_login' => 'Activer l’Arrière-plan Personnalisé pour la Connexion',
    'enable_custom_bg_image_for_login_tooltip' => 'Définir une image d’arrière-plan personnalisée pour la page de connexion.',

    'enable_custom_sidebar_logo' => 'Autoriser un Logo Personnalisé dans la Barre Latérale',
    'enable_custom_sidebar_logo_tooltip' => 'Permettre aux entreprises d’utiliser un logo personnalisé dans la barre latérale.',

    // language.blade.php
    'header_language_change' => 'Changement de Langue dans l’En-tête',
    'header_language_change_tooltip' => 'Permettre aux utilisateurs de changer la langue depuis l’en-tête principal.',
    'header_languages_label' => 'Langues dans l’En-tête',
    'header_languages_label_tooltip' => 'Sélectionnez les langues à afficher dans l’en-tête.',

    // repair_status.blade.php
    'show_repair_status_login_screen' => 'Afficher le Statut de Réparation sur l’Écran de Connexion',

    // 2fa.blade.php
    'enable_2fa' => 'Activer 2FA',
    'enable_2fa_tooltip' => 'Activer l’authentification à deux facteurs (2FA) pour l’application.',

    'force_2fa' => 'Forcer 2FA',
    'force_2fa_tooltip' => 'Les utilisateurs doivent configurer 2FA avant d’utiliser l’application.',

    'recommend_2fa' => 'Recommander 2FA',
    'recommend_2fa_tooltip' => 'Une fenêtre s’affiche une seule fois à la connexion pour encourager l’activation de 2FA.',

    'allow_disable_2fa' => 'Permettre la Désactivation Temporaire de 2FA',
    'allow_disable_2fa_tooltip' => 'Autoriser les utilisateurs à désactiver temporairement 2FA pendant une durée définie.',

    'disable_2fa_duration_label' => 'Durée de Désactivation de 2FA',
    'disable_2fa_duration_label_tooltip' => 'Définir la période pendant laquelle 2FA peut rester désactivée.',

    'disable_2fa_unit_label' => 'Unité de Durée pour la Désactivation de 2FA',

    'force_2fa_after_date_label' => 'Forcer 2FA Après une Date Spécifique',
    'force_2fa_after_date_label_tooltip' => 'Après cette date, tous les utilisateurs devront activer 2FA. La date sera également affichée dans la fenêtre de recommandation de 2FA.',

    'primary_color_label' => 'Couleur Principale',
    'primary_color_label_tooltip' => 'Choisissez la couleur principale par défaut de l’application. Elle est utilisée pour les entreprises qui ne définissent pas leurs propres couleurs.',
    'secondary_color_label' => 'Couleur Secondaire',
    'secondary_color_label_tooltip' => 'Choisissez la couleur secondaire par défaut de l’application. Elle est utilisée pour les entreprises qui ne définissent pas leurs propres couleurs.',

    'allow_theme_change' => 'Autoriser le Changement de Thème',
    'allow_theme_change_tooltip' => 'Permettre aux entreprises de personnaliser les couleurs de leur thème. Si elles n’en définissent pas, elles utiliseront les couleurs par défaut indiquées ici.',

    'login_bg_image_label' => 'Image d’Arrière-plan de Connexion',
    'login_bg_image_label_tooltip' => 'En téléversant une nouvelle image, vous remplacerez l’arrière-plan actuel.',

    'logo_dark_tooltip'  => 'Modifier le logo sombre par défaut de l’application (utilisé en mode clair).',
    'logo_light_tooltip' => 'Modifier le logo clair par défaut de l’application (utilisé en mode sombre).',
    'favicon_tooltip' => 'Dimensions recommandées : 32×32 px. Cette icône apparaît dans les onglets et favoris du navigateur.',
    'upload_favicon' => 'Téléverser un Favicon',

    // Fonts
    'tab_fonts' => 'Polices',
    'english_font' => 'Police Anglaise',
    'arabic_font' => 'Police Arabe',
    'custom_font_placeholder' => 'Entrez un nom de police personnalisé...',
    'select_font' => 'Sélectionner une police...',
    'or' => 'ou',
    'font_help_text' => 'Choisissez dans la liste ou entrez votre propre police.',
    'english_font_tooltip' => 'Entrez un nom de police personnalisé ou sélectionnez-en un dans la liste. Vous pouvez trouver des noms de polices sur :url',
    'arabic_font_tooltip' => 'Entrez un nom de police personnalisé ou sélectionnez-en un dans la liste. Vous pouvez trouver des noms de polices sur :url',

    //Recaptcha:
    'tab_recaptcha' => 'reCAPTCHA',
    'enable_recaptcha' => 'Activer Google reCAPTCHA',
    'enable_recaptcha_tooltip' => 'Basculer pour activer la protection reCAPTCHA. Obtenez votre clé et secret sur :url',
    'enable_recaptcha_text' => 'Activer reCAPTCHA',
    'google_recaptcha_key' => 'Clé de Site Google reCAPTCHA',
    'google_recaptcha_secret' => 'Clé Secrète Google reCAPTCHA',
    'google_recaptcha_key_placeholder' => 'Entrez votre Google reCAPTCHA Site Key',
    'google_recaptcha_secret_placeholder' => 'Entrez votre Google reCAPTCHA Secret Key',

    // 2FA Recommendation Modal
    'modal_enable_2fa_title' => 'Activer l’Authentification à Deux Facteurs',
    'modal_enable_2fa_desc' => 'Nous vous recommandons d’activer 2FA pour renforcer la sécurité de votre compte.',
    'enable_now_button' => 'Activer Maintenant',
    'maybe_later_button' => 'Peut-être Plus Tard',
    'close_aria_label' => 'Fermer',

    // 2FA Verify page
    'one_time_password_heading' => 'Mot de Passe à Usage Unique',
    'one_time_password_label' => 'Mot de Passe à Usage Unique',
    'enter_2fa_code_placeholder' => 'Entrez le code 2FA',
    'disable_2fa_for' => 'Désactiver 2FA pour :duration :unit',
    'verify_button' => 'Vérifier',

    // 2FA Verification (2fa_verify.blade.php)
    'two_factor_auth_title' => 'Authentification à Deux Facteurs (2FA)',
    'google_auth_app_desc' => 'Application Google Authenticator',
    'configured_status' => 'Configuré',
    'needs_configuration_status' => 'Non Configuré',
    'two_factor_scan_or_enter_msg' => 'Veuillez scanner le code QR ci-dessous avec Google Authenticator ou entrer la clé manuellement, puis saisir le code généré.',
    'your_secret_key_msg' => 'Votre clé secrète (si vous devez la saisir manuellement) :',

    // 2FA field labels
    'one_time_password_label' => 'Mot de Passe à Usage Unique',
    'enter_2fa_code_placeholder' => 'Entrez le code 2FA',
    '2fa_will_be_forced_after_date' => '2FA sera obligatoire après :date.',

    // Buttons
    '2fa' => '2FA',
    'verify_button' => 'Vérifier',

    'confirm_access_recovery_codes' => 'Confirmer l’Accès',
    're_authenticate_message' => 'Vous devez vous réauthentifier pour accéder aux Paramètres ou aux Codes de Récupération 2FA.',
    'choose_method' => 'Choisir la méthode :',
    'one_time_password' => 'Mot de Passe à Usage Unique (OTP)',
    'password' => 'Mot de Passe',
    'enter_code_or_password' => 'Entrez le code ou le mot de passe :',
    'confirm' => 'Confirmer',

    '2fa_recovery_codes' => 'Codes de Récupération 2FA',
    'recovery_codes_description' => 'Ces codes vous permettent de vous connecter si vous perdez l’accès à votre application d’authentification. Chaque code ne peut être utilisé qu’une seule fois.',
    'regenerate_codes' => 'Régénérer les Codes',
    'copy' => 'Copier',
    'copy_all' => 'Tout Copier',
    'no_recovery_codes_available' => 'Aucun code de récupération disponible. Vous pouvez générer de nouveaux codes ci-dessous.',
    'copied' => 'Code copié dans le presse-papiers !',
    'all_codes_copied' => 'Tous les codes de récupération ont été copiés !',
    'supported_app' => 'Applications Prises en Charge',
    'supported_apps' => [
        'Authy' => ['iOS', 'Android', 'Chrome', 'OS X'],
        'FreeOTP' => ['iOS', 'Android', 'Pebble'],
        'Google Authenticator' => ['iOS', 'Android', 'Windows Store'],
        'Microsoft Authenticator' => ['Windows Phone'],
        'LastPass Authenticator' => ['iOS', 'Android', 'OS X', 'Windows'],
        '1Password' => ['iOS', 'Android', 'OS X', 'Windows'],
    ],

    // Social logins:
    'social_login_settings' => 'Paramètres de Connexion Sociale',
    'social_login_settings_help' => 'Entrez vos identifiants pour la connexion sociale.',
    'client_id' => 'ID Client',
    'client_secret' => 'Secret Client',
    'redirect_url' => 'URL de Redirection (Redirect URL)',
    'enter_client_id' => 'Entrez l’ID Client pour :provider',
    'enter_client_secret' => 'Entrez le Secret Client pour :provider',
    'enter_redirect_url' => 'Entrez l’URL de Redirection pour :provider',
    'enable_social_login' => 'Activer la Connexion Sociale',
    'tab_social' => 'Connexions Sociales',
    'or_login_with' => 'Ou se connecter avec',
    'force_otp_after_social_login' => 'Forcer le OTP après la Connexion Sociale',
    'force_otp_after_social_login_tooltip' => 'Si activé, les utilisateurs qui se connectent via les réseaux sociaux devront saisir un code OTP.',

    //Lock Users:
    'locked_until' => 'Verrouillé jusqu’à',
    'locked_users' => 'Utilisateurs Verrouillés',
    'view_locked_users' => 'Voir les Utilisateurs Verrouillés',
    'tab_login_security' => 'Sécurité de Connexion',
    'unlock' => 'Déverrouiller',
    'enable_user_lock_label' => 'Activer le Verrouillage Utilisateur',
    'enable_user_lock_tooltip' => 'Activer/désactiver le verrouillage de l’utilisateur après des tentatives de connexion échouées.',
    'max_login_attempts_label' => 'Nombre Maximum de Tentatives de Connexion',
    'max_login_attempts_tooltip' => 'Le nombre de tentatives autorisées avant de verrouiller l’utilisateur.',
    'lock_duration_label' => 'Durée du Verrouillage',
    'lock_duration_tooltip' => 'Durée (en chiffres) pendant laquelle l’utilisateur reste verrouillé.',
    'lock_duration_unit_label' => 'Unité de la Durée de Verrouillage',
    'lock_duration_unit_tooltip' => 'Choisissez l’unité de temps pour la durée de verrouillage : minutes, heures, jours, etc.',
    'account_locked_for_time_unit' => 'Votre compte est verrouillé pendant :time :unit.',
    'user_unlocked_message' => 'Utilisateur déverrouillé avec succès !',

    //Verify email:
    'verify_email_address_title' => 'Vérifiez Votre Adresse E-mail',
    'fresh_verification_sent' => 'Un nouveau lien de vérification a été envoyé à votre adresse e-mail.',
    'verify_email_before_proceeding' => 'Avant de continuer, veuillez vérifier votre e-mail pour le lien de vérification.',
    'did_not_receive_email' => 'Si vous n’avez pas reçu l’e-mail',
    'click_here_request_another' => 'cliquez ici pour en demander un autre',
    'logout' => 'Déconnexion',
    'force_email_verify' => 'Forcer la Vérification de l’E-mail',
    'force_email_verify_tooltip' => 'Si activé, les utilisateurs doivent vérifier leur adresse e-mail avant d’accéder au système.',
    // Reset Mapping
    'reset_purchase_sell_mapping'     => 'Réinitialiser le mappage achat-vente',
    'select_business'                 => 'Sélectionner l’entreprise :',
    'all_businesses'                  => 'Toutes les entreprises',
    'chunk_size'                      => 'Taille du lot :',
    'reset_mapping'                   => 'Réinitialiser le mappage',
    'purchase_sell_mismatch_tooltip'  => 'Choisissez les mappages d’entreprise à réinitialiser. Si vous avez une grande base de données, nous recommandons de réinitialiser le mappage par entreprise.',
    'chunk_size_tooltip'              => 'Le mappage sera réinitialisé en plus petits lots. Pour les gros ensembles de données, choisissez une taille de lot appropriée. Le mode maintenance actif est recommandé.',

    // Maintenance Mode
    'tab_maintenance_mode'            => 'Mode maintenance',
    'maintenance_mode'                => 'Mode maintenance',
    'maintenance_mode_tooltip'        => 'Met l’application en mode maintenance (les visiteurs verront l’écran de maintenance).',
    'enable_countdown'                => 'Activer le compte à rebours',
    'enable_timer_tooltip'            => 'Afficher un compte à rebours en direct jusqu’à la fin de la maintenance.',
    'maintenance_duration'            => 'Durée',
    'maintenance_unit'                => 'Unité de durée',
    'minutes'                         => 'Minutes',
    'hours'                           => 'Heures',
    'days'                            => 'Jours',

    // Maintenance page
    'under_maintenance'               => 'En maintenance',
    'maintenance_heading'             => 'Nous effectuons quelques opérations de maintenance.',
    'maintenance_subheading'          => 'Merci de votre patience !',
    'maintenance_back_in'             => 'Nous serons de retour dans :time',
    'maintenance_back_no_timer'       => 'Nous serons de retour dès la fin de la maintenance.',

    // Mapping reset page
    'mapping_reset_progress'          => 'Progression de la réinitialisation du mappage',
    'mapping_reset_in_progress'       => 'Réinitialisation du mappage en cours',
    'batch_status'                    => 'Statut de la lot',
    'refresh_status'                  => 'Rafraîchir le statut',

    // Mapping reset result & status
    'mapping_reset_result'            => 'Résultat de la réinitialisation du mappage',
    'chunk_processing_status'         => 'Statut du traitement des lots',

    // Table headers
    'business'                        => 'Entreprise',
    'chunk_status'                    => 'Statut du lot',
    'total_chunks'                    => 'Nombre total de lots',
    'status'                          => 'Statut',

    // Button
    'go_back'                         => 'Retour',

    // Mapping Jobs
    'processed_jobs'                  => 'Tâches de mappage',
    'processed_jobs_subtitle'         => 'Tous les lots de mappage envoyés',
    'uuid'                            => 'UUID du lot',
    'job_name'                        => 'Nom de la tâche',
    'completed_chunks'                => 'Lots terminés',
    'started_at'                      => 'Commencé le',
    'finished_at'                     => 'Dernière mise à jour',
    'view_rebuild_jobs'               => 'Voir les tâches de reconstruction de stock',

    // Detailed instruction
    'reset_mapping_instruction'       =>
        "Il est recommandé de configurer votre driver de file d’attente sur un back-end réel :\n" .
        "→ Dans votre fichier .env, définissez `QUEUE_CONNECTION=database`.\n\n" .
        "Activez également le mode maintenance (Paramètres de l’application → Mode maintenance) pendant l’exécution de la réinitialisation du mappage pour éviter les doublons ou les données manquantes.\n\n" .
        "Si vous avez une grande base de données, la réinitialisation prendra plus de temps : envisagez de réinitialiser par entreprise.\n\n" .
        "Avant de commencer :\n" .
        "• Effectuez une sauvegarde complète de la base de données.\n" .
        "• Surveillez le processus via les journaux pour détecter d’éventuelles erreurs.",

    'recovery_codes_generated_successfully' => 'Codes de récupération générés avec succès',

    // Disposable-email sync
    'sync_disposable_list'            => 'Synchroniser la liste des e-mails jetables',
    'sync_disposable_success'         => 'Liste des e-mails jetables mise à jour.',
    'sync_disposable_failed'          => 'Échec de la synchronisation de la liste des e-mails jetables.',

    // Temporary-email protection
    'temp_email_protection'           => 'Blocage des e-mails jetables',
    'temp_email_protection_tooltip'   => 'Bloquer les domaines d’e-mails temporaires/jetables (p. ex. Mailinator, 10MinuteMail).',
    'disposable_not_allowed'          => 'Les adresses e-mail jetables ne sont pas autorisées.',

        // 3.3
    'enable_sidebar_dropdown'         => 'Activer le menu déroulant latéral',
    'enable_sidebar_dropdown_tooltip' => 'Réduit les sous-menus dans un déroulant cliquable à l’intérieur de la barre latérale.',
    // Custom Menu
    'menu'               => 'Menu',
    'menus_heading'      => 'Menus',
    'menus_description'  => 'Gérer et organiser vos éléments de menu.',
    'add_menu_item'      => 'Ajouter un élément',
    'save_menu'          => 'Enregistrer le menu',
    'label'              => 'Libellé',
    'parent'             => 'Parent',
    'icon_type'          => 'Type d’icône',
    'svg'                => 'SVG',
    'fontawesome'        => 'FontAwesome',
    'svg_icon'           => 'Icône SVG',
    'fa_class'           => 'Classe FA',
    'named_route'        => 'Route nommée',
    'absolute_url'       => 'URL absolue',
    'permission'         => 'Permission',
    'module_flag'        => 'Indicateur de module',
    'sort_order'         => 'Ordre de tri',
    'active'             => 'Actif ?',
    'apply'              => 'Appliquer',
    'add_menu'           => 'Ajouter un menu',
    'inactive'           => 'Inactif',
    'flush_cache'        => 'Vider le cache',
    'reset_menu'         => 'Réinitialiser',
    'custom_menu'        => 'Menu latéral personnalisé',

    'rebuilt_successfully' => 'Reconstruit avec succès',

    'sidebar_layout'        => 'Disposition de la barre latérale',
    'sidebar_layout_1'      => 'Disposition 1 (Classique)',
    'sidebar_layout_2'      => 'Disposition 2 (Compacte)',
    'sidebar_layout_custom' => 'Disposition personnalisée',

    'custom_sidebar_type'   => 'Type de barre latérale personnalisée',
    'sidebar'               => 'Barre latérale',
    'topbar'                => 'Barre supérieure',

    'tab_business_settings'    => 'Paramètres d’entreprise',
    'business_settings_layout' => 'Disposition des paramètres',
    'layout_1'                => 'Disposition 1 – Onglets classiques',
    'layout_2'                => 'Disposition 2 – Barre latérale moderne',

    // Themes
    'predefined_theme_label'   => 'Thème prédéfini',
    'predefined_theme_tooltip' => 'Choisissez une palette de couleurs prête à l’emploi.',
    'select_theme'             => 'Sélectionner un thème',
    'theme_default'            => 'Par défaut',

    // Migration Data
    'app_settings'         => 'Paramètres de l’app',
    'application_settings' => 'Paramètres de l’application',
    'storage_migration'    => 'Migration du stockage',
    'manage_uploads_data'  => 'Gérer vos données de téléchargement',

    'push'  => 'push',
    'pull'  => 'pull',
    'local' => 'local',
    'external_disk' => 'disque externe',
    'duplicate_files_skipped_safe_to_resume' => 'Les fichiers en double sont ignorés. Vous pouvez relancer pour reprendre en toute sécurité.',

    'direction'              => 'Direction',
    'push_local_to_external' => 'push (local → externe)',
    'pull_external_to_local' => 'pull (externe → local)',

    'from_disk' => 'Depuis le disque',
    'to_disk'   => 'Vers le disque',

    'destination_visibility'        => 'Visibilité de destination',
    'visibility_none_bucket_signed' => '(aucune / politique du bucket / URL signées)',
    'visibility_public_acl'         => 'public (ACL objet)',
    'visibility_private_acl'        => 'privé (ACL objet)',

    'folders_to_include_optional' => 'Dossiers à inclure (optionnel)',
    'folders_include_tooltip'     => 'Laisser vide pour inclure tous les dossiers sous uploads.',
    'select_all'                  => 'Tout sélectionner',
    'none'                        => 'Aucun',
    'invert'                      => 'Inverser',
    'no_suggestions_found'        => 'Aucune suggestion trouvée.',

    'delete_source_after_copy' => 'Supprimer la source après copie réussie (déplacer)',
    'dry_run_plan_only'        => 'Simulation (plan seulement)',
    'verbose_log_messages'     => 'Verbeux (messages de log dans le statut)',

    'execution'                    => 'Exécution',
    'execution_tooltip_html'       => 'Utiliser <strong>Direct</strong> uniquement pour de petites opérations (ex. < 1000 fichiers). Pour 5-10 Go, privilégier la tâche en arrière-plan.',
    'pick_how_to_execute'          => 'Choisissez la méthode d’exécution de la migration.',
    'background_job_recommended'   => 'Tâche en arrière-plan (recommandé)',
    'run_direct_now'               => 'Direct (exécuter maintenant)',

    'start_migration' => 'Démarrer la migration',
    'reset'           => 'Réinitialiser',

    'progress' => 'Progression',
    'result'   => 'Résultat',

    // JS strings
    'from'     => 'De',
    'to'       => 'À',
    'folders'  => 'Dossiers',
    'total'    => 'Total',
    'copied'   => 'Copiés',
    'skipped'  => 'Ignorés',
    'deleted'  => 'Supprimés',
    'failed'   => 'Échoués',
    'invalid_response'         => 'Réponse invalide',
    'failed_to_start_migration'=> 'Échec du démarrage de la migration',
    'confirm_delete_source'    => 'Êtes-vous sûr de vouloir SUPPRIMER la source après la copie ? Cette action est irréversible.',

    'default_storage_disk'      => 'Disque de stockage par défaut',
    'default_storage_disk_help' => 'Choisissez où les nouveaux fichiers sont enregistrés. « public » = storage/app/public via le lien symbolique /storage. « local » = public/uploads.',

    's3_compatible_settings'     => 'Paramètres compatibles S3',
    'display_label_optional'     => 'Libellé d’affichage (optionnel)',
    'placeholder_my_s3_provider' => 'Mon fournisseur S3',
    'display_only_admin_ui'      => 'Affichage uniquement dans l’interface admin.',
    'access_key'                 => 'Clé d’accès',
    'secret_key'                 => 'Clé secrète',
    'region'                     => 'Région',
    'bucket'                     => 'Bucket',
    'endpoint'                   => 'Endpoint',
    'cdn_or_custom_domain_optional' => 'CDN / Domaine personnalisé (optionnel)',

    'disable_http_verify'      => 'Désactiver la vérification TLS',
    'disable_http_verify_help' => 'Off = vérification TLS activée. On = désactivée (uniquement en local).',

    'path_style_endpoint' => 'Endpoint style path',

    'use_signed_urls'      => 'Utiliser des URL signées (bucket privé)',
    'use_signed_urls_help' => 'Off = URL publiques (bucket/CDN doit autoriser la lecture). On = privé avec URL signées.',

    'signed_url_ttl_minutes' => 'Durée de vie URL signée (minutes)',
    'tab_storage_settings'   => 'Stockage',
    'syncing'               => 'Synchronisation…',

    // POS Settings
    'pos_performance_settings'   => 'Paramètres de performance POS',
    'enable_instant_pos'         => 'Activer le POS instantané',
    'enable_instant_pos_tooltip' => 'Permet l’ajout instantané de produits sans appels AJAX pour de meilleures performances',
    'enable_instant_pos_help'    => 'Une fois activé, les produits sont ajoutés instantanément à partir du cache plutôt que via le serveur',

    'enable_instant_search'            => 'Activer la recherche instantanée',
    'enable_instant_search_tooltip'    => 'Permet la recherche instantanée depuis le cache au lieu d’AJAX',
    'enable_instant_search_help'       => 'Une fois activé, la recherche fonctionne instantanément sans requêtes serveur',

    'pos_performance_info_title' => 'Amélioration des performances',
    'pos_performance_info_desc'  => 'Les fonctions POS instantané améliorent fortement les performances en réduisant les requêtes serveur :',
    'instant_pos_benefit_1'      => 'Les produits s’ajoutent immédiatement sans attente',
    'instant_pos_benefit_2'      => 'Les résultats de recherche apparaissent instantanément',
    'instant_pos_benefit_3'      => 'Les stocks se mettent à jour automatiquement après chaque vente',
    'instant_pos_benefit_4'      => 'Fonctionne en mode hors-ligne d’abord, puis se synchronise',

    'pos_cache_settings'                    => 'Paramètres du cache POS',
    'pos_cache_refresh_interval'            => 'Intervalle de rafraîchissement du cache',
    'pos_cache_refresh_interval_tooltip'    => 'Fréquence de mise à jour du cache produits',
    'pos_cache_refresh_interval_help'       => 'Rafraîchit automatiquement après chaque vente ; intervalles manuels en secours',
    'auto_refresh'                          => 'Auto (après vente)',
    '30_minutes'                            => '30 minutes',
    '60_minutes'                            => '60 minutes',
    '2_hours'                               => '2 heures',
    'manual_only'                           => 'Manuel uniquement',

    'pos_max_cached_products'         => 'Max produits en cache',
    'pos_max_cached_products_tooltip' => 'Nombre maximal de produits mis en cache pour un accès instantané',
    'pos_max_cached_products_help'    => 'Plus haut = meilleure couverture mais plus de mémoire. « Illimité » pour tout mettre en cache.',
    'unlimited'                       => 'Illimité',

    // Loading messages
    'loading_products'                => 'Chargement des produits…',
    'please_wait_while_products_load' => 'Veuillez patienter pendant le chargement des produits',
    'loading_products_placeholder'    => 'Chargement des produits…',
    'updating_stock'                  => 'Mise à jour du stock…',
    'failed_to_load_cache'            => 'Échec du chargement du cache produits. Les fonctions POS peuvent être limitées.',

    // Vérification OTP
    'otp_verification' => 'Vérification OTP',
    'otp_verification_management' => 'Gestion de la Vérification OTP',
    'manage_otp_verification_requests' => 'Gérer les demandes de vérification OTP et voir les statistiques',
    'active_otps' => 'OTP Actifs',
    'unverified_users' => 'Utilisateurs Non Vérifiés',
    'expired_otps' => 'OTP Expirés',
    'failed_attempts' => 'Tentatives Échouées',
    'pending_users' => 'Utilisateurs en Attente',
    'today_requests' => "Demandes d'Aujourd'hui",
    'high_retries' => 'Reprises Élevées',
    'user_info' => "Infos de l'Utilisateur",
    'otp_code' => 'Code OTP',
    'attempts' => 'Tentatives',
    'resend_count' => 'Nb de Renvois',
    'no_active_otp' => 'Aucun OTP Actif',
    'expired' => 'Expiré',
    'active' => 'Actif',
    'expires_in' => 'Expire dans',
    'remaining' => 'restant',
    'resends' => 'renvois',
    'last' => 'Dernier',
    'updated' => 'Mis à jour',
    'verify' => 'Vérifier',
    'manual_verify_email' => 'Vérifier Email Manuellement',
    'reset_otp' => 'Réinitialiser OTP',
    'manual_verify' => 'Vérification Manuelle',
    'deactivate' => 'Désactiver',
    
    // Messages JavaScript
    'confirm_reset_otp' => 'Êtes-vous sûr de vouloir réinitialiser cet OTP ? L\'utilisateur devra en demander un nouveau.',
    'failed_to_reset_otp' => 'Échec de la réinitialisation OTP',
    'error_resetting_otp' => 'Erreur lors de la réinitialisation OTP',
    'confirm_verify_unverified_user' => 'Êtes-vous sûr de vouloir vérifier manuellement l\'email de l\'utilisateur non vérifié : :username ?',
    'confirm_verify_user' => 'Êtes-vous sûr de vouloir vérifier manuellement l\'email de l\'utilisateur : :username ?',
    'user_verified_removed_from_list' => 'Email de l\'utilisateur vérifié - l\'utilisateur n\'apparaîtra plus dans la liste des non vérifiés',
    'failed_to_verify_user' => 'Échec de la vérification de l\'utilisateur',
    'error_verifying_user' => 'Erreur lors de la vérification de l\'utilisateur',
    'confirm_deactivate_token' => 'Êtes-vous sûr de vouloir désactiver ce token OTP ?',
    'failed_to_deactivate_token' => 'Échec de la désactivation du token',
    'error_deactivating_token' => 'Erreur lors de la désactivation du token',

    // Gestion des Sessions
    'session_management' => 'Gestion des Sessions',
    'manage_user_sessions_and_authentication' => "Gérer les sessions utilisateur et l'authentification",
    'all_users' => 'Tous les Utilisateurs',
    'active_users' => 'Utilisateurs Actifs',
    'locked_users' => 'Utilisateurs Verrouillés',
    'disabled_logins' => 'Connexions Désactivées',
    'active_sessions' => 'Sessions Actives',
    'unique_users' => 'Utilisateurs Uniques',
    'active_businesses' => 'Entreprises Actives',
    'inactive_businesses' => 'Entreprises Inactives',
    'user_info' => 'Infos Utilisateur',
    'session_info' => 'Infos Session',
    'force_logout' => 'Forcer la Déconnexion',
    'lock_user' => "Verrouiller l'Utilisateur",
    'unlock_user' => "Déverrouiller l'Utilisateur",
    'lock_user_account' => 'Verrouiller le Compte Utilisateur',
    'lock_duration' => 'Durée de Verrouillage',
    'user_will_be_locked_for_selected_duration' => "L'utilisateur sera verrouillé pour la durée sélectionnée",
    'minutes' => 'minutes',
    'hour' => 'heure',
    'hours' => 'heures',
    'deactivate_user' => "Désactiver l'Utilisateur",
    'activate_user' => "Activer l'Utilisateur",
    'block_login' => 'Bloquer la Connexion',
    'allow_login' => 'Autoriser la Connexion',
    'deactivate_business' => "Désactiver l'Entreprise",
    'activate_business' => "Activer l'Entreprise",
    'login_allowed' => 'Connexion Autorisée',
    'login_blocked' => 'Connexion Bloquée',
    'temporary_lock' => 'Verrouillage Temporaire',
    'user_locked_successfully' => 'Utilisateur verrouillé pour :duration minutes',
    'user_unlocked_successfully' => 'Utilisateur déverrouillé avec succès',
    'user_activated_successfully' => 'Utilisateur activé avec succès',
    'user_deactivated_successfully' => 'Utilisateur désactivé avec succès',
    'login_permission_granted' => 'Permission de connexion accordée',
    'login_permission_revoked' => 'Permission de connexion révoquée',
    'business_activated_successfully' => 'Entreprise activée avec succès',
    'business_deactivated_successfully' => 'Entreprise désactivée avec succès',
    'user_logged_out_successfully' => 'Utilisateur déconnecté avec succès',
    'failed_to_lock_user' => 'Échec du verrouillage utilisateur',
    'failed_to_unlock_user' => 'Échec du déverrouillage utilisateur',
    'failed_to_update_user_status' => 'Échec de la mise à jour du statut utilisateur',
    'failed_to_update_login_permission' => 'Échec de la mise à jour de la permission de connexion',
    'failed_to_update_business_status' => "Échec de la mise à jour du statut d'entreprise",
    'failed_to_logout_user' => 'Échec de la déconnexion utilisateur',
    'error_locking_user' => "Erreur lors du verrouillage de l'utilisateur",
    'error_unlocking_user' => "Erreur lors du déverrouillage de l'utilisateur",
    'error_updating_user_status' => 'Erreur lors de la mise à jour du statut utilisateur',
    'error_updating_login_permission' => 'Erreur lors de la mise à jour de la permission de connexion',
    'error_updating_business_status' => "Erreur lors de la mise à jour du statut d'entreprise",
    'error_logging_out_user' => "Erreur lors de la déconnexion de l'utilisateur",
    'confirm_force_logout' => "Êtes-vous sûr de vouloir forcer la déconnexion de l'utilisateur : :username ?",
    'confirm_lock_user' => "Êtes-vous sûr de vouloir verrouiller l'utilisateur : :username pour :duration minutes ?",
    'confirm_unlock_user' => "Êtes-vous sûr de vouloir déverrouiller l'utilisateur : :username ?",
    'confirm_toggle_user_status' => "Êtes-vous sûr de vouloir :action l'utilisateur : :username ?",
    'confirm_toggle_login_permission' => "Êtes-vous sûr de vouloir :action pour l'utilisateur : :username ?",
    'confirm_toggle_business_status' => "Êtes-vous sûr de vouloir :action l'entreprise : :business ?",
    'activate' => 'activer',
    'deactivate' => 'désactiver',

    // Additional settings for new features
    'active_businesses' => 'Entreprises Actives',
    'inactive_businesses' => 'Entreprises Inactives',
    'active_sessions' => 'Sessions Actives',
    'sessions' => 'Sessions',
    'manage_user_sessions_and_authentication' => "Gérer les sessions utilisateur et l'authentification",
    
    // Instant POS Button Strings
    'refresh_pos_cache' => 'Actualiser le Cache',
    'instant_pos_enabled' => 'PDV Instantané Activé',
    'instant_pos_disabled' => 'PDV Instantané Désactivé',
    'disable_instant_pos' => 'Désactiver le PDV Instantané',
];
