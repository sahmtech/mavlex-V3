<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Lignes de langue pour les infobulles
    |--------------------------------------------------------------------------
    |
    | Les lignes de langue suivantes sont utilisées pour divers textes d\'aide.
    |
    */

    'product_stock_alert' => "Produits avec un stock faible. <small class='text-muted'>Basé sur la quantité d\'alerte de produit définie dans l\'écran d\'ajout de produit.Achetez ces produits avant que le stock ne s\'épuise.</small>",
    'payment_dues' => "Paiement en attente pour les achats. <small class='text-muted'>Basé sur les conditions de paiement du fournisseur. Affichage des paiements à effectuer dans 7 jours ou moins.</small>",
    'input_tax' => 'Taxe totale collectée pour les ventes dans la période sélectionnée.',
    'output_tax' => 'Taxe totale payée pour les achats dans la période sélectionnée.',
    'tax_overall' => 'Différence entre la taxe totale collectée et la taxe totale payée dans la période sélectionnée.',
    'purchase_due' => 'Montant total impayé pour les achats.',
    'sell_due' => 'Montant total à recevoir des ventes',
    'over_all_sell_purchase' => '- valeur = Montant à payer + valeur = Montant à recevoir',
    'no_of_products_for_trending_products' => 'Nombre de produits tendance à comparer dans le graphique ci-dessous.',
    'top_trending_products' => "Produits les plus vendus de votre magasin. <small class='text-muted'>Appliquez des filtres pour connaître les produits tendance pour des catégories, marques, emplacements commerciaux spécifiques, etc.</small>",
    'sku' => "Identifiant de produit unique ou Unité de Gestion de Stock Laissez vide pour générer automatiquement un SKU.<small class='text-muted'>Vous pouvez modifier le préfixe SKU dans les paramètres de l\'entreprise.</small>",
    'enable_stock' => "Activer ou désactiver la gestion des stocks pour un produit. <small class='text-muted'>La gestion des stocks doit être désactivée principalement pour les services. Exemple : Coiffure, Réparation, etc.</small>",
    'alert_quantity' => "Recevez une alerte lorsque le stock du produit atteint ou descend en dessous de la quantité spécifiée.<small class='text-muted'>Les produits avec un faible stock seront affichés dans le tableau de bord - section Alerte de Stock de Produit.</small>",
    'product_type' => '<b>Produit unique</b> : Produit sans variations.<b>Produit variable</b> : Produit avec des variations telles que taille, couleur, etc.<b>Produit combiné</b> : Une combinaison de plusieurs produits, également appelé produit en lot.',
    'profit_percent' => "Marge bénéficiaire par défaut pour le produit. <small class='text-muted'>(<i>Vous pouvez gérer la marge bénéficiaire par défaut dans les paramètres de l\'entreprise.</i>)</small>",
    'pay_term' => "Paiements à effectuer pour les achats/ventes dans la période donnée.<small class='text-muted'>Tous les paiements à venir ou échus seront affichés dans le tableau de bord - section Paiements échus</small>",
    'order_status' => 'Les produits de cet achat ne seront disponibles à la vente que si le <b>Statut de la Commande</b> est <b>Articles Reçus</b>.',
    'purchase_location' => 'Emplacement commercial où le produit acheté sera disponible à la vente.',
    'sale_location' => 'Emplacement commercial à partir duquel vous souhaitez vendre',
    'sale_discount' => "Définir 'Remise de Vente Par Défaut' pour toutes les ventes dans les paramètres de l\'entreprise. Cliquez sur l\'icône de modification ci-dessous pour ajouter/mettre à jour la remise.",
    'sale_tax' => "Définir 'Taxe de Vente Par Défaut' pour toutes les ventes dans les paramètres de l\'entreprise. Cliquez sur l\'icône de modification ci-dessous pour ajouter/mettre à jour la Taxe de Commande.",
    'default_profit_percent' => "Marge bénéficiaire par défaut d\'un produit. <small class='text-muted'>Utilisée pour calculer le prix de vente basé sur le prix d\'achat saisi.Vous pouvez modifier cette valeur pour les produits individuels lors de l\'ajout.</small>",
    'fy_start_month' => 'Mois de début de l\'année financière pour votre entreprise',
    'business_tax' => 'Numéro de taxe enregistré pour votre entreprise.',
    'invoice_scheme' => "Le schéma de facture signifie le format de numérotation des factures. Sélectionnez le schéma à utiliser pour cet emplacement commercial<small class='text-muted'><i>Vous pouvez ajouter un nouveau Schéma de Facture</b> dans les paramètres de facture</i></small>",
    'invoice_layout' => "Disposition de la facture à utiliser pour cet emplacement commercial <small class='text-muted'>(<i>Vous pouvez ajouter une nouvelle <b>Disposition de Facture</b> dans <b>Les Paramètres de Facture</b></i>)</small>",
    'invoice_scheme_name' => 'Donnez un nom court et significatif au Schéma de Facture.',
    'invoice_scheme_prefix' => 'Préfixe pour un Schéma de Facture. Un préfixe peut être un texte personnalisé ou l\'année en cours. Ex : #XXXX0001, #2018-0002',
    'invoice_scheme_start_number' => "Numéro de départ pour la numérotation des factures. <small class='text-muted'>Vous pouvez le définir à 1 ou à tout autre numéro à partir duquel la numérotation débutera.</small>",
    'invoice_scheme_count' => 'Nombre total de factures générées pour le Schéma de Facture',
    'invoice_scheme_total_digits' => 'Longueur du numéro de facture excluant le préfixe de facture',
    'tax_groups' => 'Taux de taxe de groupe - définis ci-dessus, à utiliser en combinaison dans les sections Achat/Vente.',
    'unit_allow_decimal' => "Les décimales vous permettent de vendre les produits connexes en fractions.",
    'print_label' => 'Ajouter des produits -> Choisir les informations à afficher dans les étiquettes -> Sélectionner les paramètres de code-barres -> Prévisualiser les étiquettes -> Imprimer',
    'expense_for' => 'Choisissez l\'utilisateur auquel la dépense est liée. <i>(Optionnel)</i> <small>Exemple : Salaire d\'un employé.</small>',
    'all_location_permission' => 'Si <b>Tous les Emplacements</b> est sélectionné, ce rôle aura la permission d\'accéder à tous les emplacements commerciaux',
    'dashboard_permission' => 'Si non coché, seul le message de bienvenue sera affiché sur l\' accueil.',
    'access_locations_permission' => 'Choisissez tous les emplacements auxquels ce rôle peut accéder. Toutes les données pour l\'emplacement sélectionné ne seront affichées qu\'à l\'utilisateur.<small>Par exemple : Vous pouvez utiliser cela pour définir <i>Gestionnaire de Magasin / Caissier / Gestionnaire de Stock / Responsable de Succursale, </i> d\'une localité particulière.</small>',
    'print_receipt_on_invoice' => 'Activer ou désactiver l\'impression automatique de la facture lors de la finalisation',
    'receipt_printer_type' => "<i>Impression basée sur le navigateur</i> : Affiche la boîte de dialogue d\'impression du navigateur avec un aperçu de la facture <i>Utiliser l\'imprimante de reçus configurée</i> : Sélectionnez une imprimante de reçus / thermique configurée pour l\'impression",
    'adjustment_type' => '<i>Normal</i>: Ajustement pour des raisons normales comme des fuites, des dommages, etc. <i>Anormal</i>: Ajustement pour des raisons telles que incendie, accident, etc.',
    'total_amount_recovered' => 'Montant récupéré de l\'assurance ou de la vente de déchets ou autres',
    'express_checkout' => 'Marquer comme complètement payé et valider',
    'total_card_slips' => 'Nombre total de paiements par carte utilisés dans ce registre',
    'total_cheques' => 'Nombre total de chèques utilisés dans ce registre',
    'capability_profile' => "Le support des commandes et des pages de code varie selon les fabricants et les modèles d\'imprimantes. Si vous n\'êtes pas sûr, il est recommandé d\'utiliser le Profil de Capacité 'simple'",
    'purchase_different_currency' => 'Sélectionnez cette option si vous achetez dans une devise différente de celle de votre entreprise',
    'currency_exchange_factor' => "1 Devise d\'Achat = ? Devise de Base <small class='text-muted'>Vous pouvez activer/désactiver 'Achat dans une autre devise' dans les paramètres de l\'entreprise.</small>",
    'accounting_method' => 'Méthode comptable',
    'transaction_edit_days' => 'Nombre de jours à partir de la Date de Transaction pendant lesquels une transaction peut être éditée.',
    'stock_expiry_alert' => "Liste des stocks expirant dans :days jours <small class='text-muted'>Vous pouvez définir le nombre de jours dans les paramètres de l\'entreprise </small>",
    'sub_sku' => "Le SKU est optionnel. <small>Laissez-le vide pour générer automatiquement le SKU.<small>",
    'shipping' => "Définissez les détails d\'expédition et les frais d\'expédition. Cliquez sur l\'icône de modification ci-dessous pour ajouter/met à jour les détails et frais d\'expédition."
];