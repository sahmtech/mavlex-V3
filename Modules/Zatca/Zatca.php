<?php

namespace Modules\Zatca;

use Modules\Zatca\Classes\DocumentType;
use Modules\Zatca\Classes\Objects\Client;
use Modules\Zatca\Classes\Objects\Invoice;
use Modules\Zatca\Classes\Objects\Seller;
use Modules\Zatca\Classes\Objects\Setting;
use Modules\Zatca\Classes\Services\ReportInvoiceService;
use Modules\Zatca\Classes\Services\Settings\RenewCert509Service;
use Modules\Zatca\Classes\Services\SettingService;

class Zatca
{
    /**
     * generate zatca setting.
     *
     * @param  \Modules\Zatca\Classes\Objects\Setting $setting
     * @return object
     */
    public static function generateZatcaSetting(Setting $setting): object
    {
        return (new SettingService($setting))->generate();
    }

    /**
     * renew zatca setting
     *
     * @param  string $otp
     * @param  object $setting
     * @return object
     */
    public static function renewZatcaSetting(string $otp, object $setting): object
    {
        return (new RenewCert509Service)->renew($otp, $setting);
    }

    /**
     * report standard invoice compilance.
     *
     * @param  \Modules\Zatca\Classes\Objects\Seller    $seller
     * @param  \Modules\Zatca\Classes\Objects\Invoice   $invoice
     * @param  \Modules\Zatca\Classes\Objects\Client    $client
     * @return array
     */
    public static function reportStandardInvoiceCompliance(Seller $seller, Invoice $invoice, Client $client): array
    {
        return (new ReportInvoiceService($seller, $invoice, $client))->test(DocumentType::STANDARD);
    }

    /**
     * report standard invoice production.
     *
     * @param  \Modules\Zatca\Classes\Objects\Seller    $seller
     * @param  \Modules\Zatca\Classes\Objects\Invoice   $invoice
     * @param  \Modules\Zatca\Classes\Objects\Client    $client
     * @return array
     */
    public static function reportStandardInvoice(Seller $seller, Invoice $invoice, Client $client): array
    {
        return (new ReportInvoiceService($seller, $invoice, $client))->clearance();
    }

    /**
     * report simplified invoice compliance.
     *
     * @param  \Modules\Zatca\Classes\Objects\Seller    $seller
     * @param  \Modules\Zatca\Classes\Objects\Invoice   $invoice
     * @param  \Modules\Zatca\Classes\Objects\Client    $client
     * @return array
     */
    public static function reportSimplifiedInvoiceCompliance(Seller $seller, Invoice $invoice, Client $client = null): array
    {
        return (new ReportInvoiceService($seller, $invoice, $client))->test(DocumentType::SIMPILIFIED);
    }

    /**
     * report simplified invoice production.
     *
     * @param  \Modules\Zatca\Classes\Objects\Seller    $seller
     * @param  \Modules\Zatca\Classes\Objects\Invoice   $invoice
     * @param  \Modules\Zatca\Classes\Objects\Client    $client
     * @return array
     */
    public static function reportSimplifiedInvoice(Seller $seller, Invoice $invoice, Client $client = null): array
    {
        return (new ReportInvoiceService($seller, $invoice, $client))->reporting();
    }

    /**
     * calculate simplified invoice.
     *
     * @param  \Modules\Zatca\Classes\Objects\Seller    $seller
     * @param  \Modules\Zatca\Classes\Objects\Invoice   $invoice
     * @param  \Modules\Zatca\Classes\Objects\Client    $client
     * @return array
     */
    public static function calculateSimplifiedInvoice(Seller $seller, Invoice $invoice, Client $client = null): array
    {
        return (new ReportInvoiceService($seller, $invoice, $client))->calculate(DocumentType::SIMPILIFIED);
    }
}
