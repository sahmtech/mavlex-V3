<?php
use Modules\Zatca\Classes\Exemptions\Exempt;
use Modules\Zatca\Classes\Exemptions\ZeroRate;
use Modules\Zatca\Classes\Exemptions\OutOfScope;
use Modules\Zatca\Classes\TaxCategoryCode;
return [
    'name' => 'Zatca',
    'module_version' => '1.8',
    'pid' => 16,
    'lic1' => 'aHR0cHM6Ly9sLmJhcmRwb3MuY29tL2FwaS90eXBlXzE=',
    'lic3' => '',
    'portals' => [
        'local' => 'https://gw-fatoora.zatca.gov.sa/e-invoicing/developer-portal',
        'simulation' => 'https://gw-fatoora.zatca.gov.sa/e-invoicing/simulation',
        'production' => 'https://gw-fatoora.zatca.gov.sa/e-invoicing/core',
    ],

//    'app' => [
//        'environment' => env('ZATCA_ENVIRONMENT', 'local'),
//    ],

    'exemptions' => [
        TaxCategoryCode::ZERO_RATE => [
            'code' => ZeroRate::EXPORT_OF_GOODS,
            'reason' => 'Export of goods', // Exemptions related to zero-rated goods
        ],
        TaxCategoryCode::EXEMPT => [
            'code' => Exempt::MEDICAL_INSURANCE,
            'reason' => 'Financial services as mentioned in Article 29 of the VAT Regulations', // Related to exempt financial services
        ],
        TaxCategoryCode::OUT_OF_SCOPE => [
            'code' => OutOfScope::DEFAULT_CODE,
            'reason' => 'Exempt from VAT and outside the scope of taxation', // Exempt from VAT
        ],
    ],
];
