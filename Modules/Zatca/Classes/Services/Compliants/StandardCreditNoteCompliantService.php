<?php

namespace Modules\Zatca\Classes\Services\Compliants;

use Modules\Zatca\Classes\Objects\Setting;
use Modules\Zatca\Classes\Objects\Seller;
use Modules\Zatca\Classes\InvoiceType;
use Modules\Zatca\Classes\PaymentType;
use Modules\Zatca\Classes\Objects\InvoiceItem;
use Modules\Zatca\Classes\Objects\Invoice;
use Modules\Zatca\Classes\Objects\Client;
use Modules\Zatca\Zatca;

class StandardCreditNoteCompliantService
{
    public static function verify(Setting $setting, $privateKey, $certificate, $secret)
    {
        $seller  = new Seller(
            $setting->registrationNumber, 'King Abdulaziz Road', '1234', '1234', 'Al Amal', 'Riyadh', '12643',
            $setting->taxNumber, $setting->organizationName, $privateKey, $certificate, $secret
        );

        $invoiceType = InvoiceType::CREDIT_NOTE;
        $paymentType = PaymentType::CASH;

        $invoiceItems = [
            new InvoiceItem(1, 'Product One', 1, 50, 0, 7.5, 15, 57.5),
        ];

        $invoice = new Invoice(
            1, 'INV100', '42156fac-991b-4a12-a6f0-54c024edd29e', '2023-11-20', '20:24:00',
            $invoiceType, $paymentType, 50, 0, 7.5, 57.5, $invoiceItems, NULL, 1, NULL, null, 'SAR', 15, '2023-11-21'
        );

        $client  = new Client(
            'Salon X', '300385711800003', '12345', 'King Abdulaziz Road', 'C23', '1234', '123', 'Riyadh'
        );

        return Zatca::reportStandardInvoiceCompliance($seller, $invoice, $client);
    }
}
