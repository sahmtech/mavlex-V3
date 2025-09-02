<?php

namespace Modules\Zatca\Classes\Objects;

use Modules\Zatca\Classes\InvoiceReportType;
use Modules\Zatca\Helpers\EgsSerialNumber;


class Setting
{
    public $otp;

    public $emailAddress;

    public $commonName;

    public $organizationalUnitName;

    public $organizationName;

    public $taxNumber;

    public $registeredAddress;

    public $businessCategory;

    public $egsSerialNumber;

    public $registrationNumber;

    /**
     * the invoice type
     * 0100 for Simplified Tax Invoice|Simplified Debit Note|Simplified Credit Note
     * 1000 for Standard Tax Invoice|Standard Debit Note|Standard Credit Note.
     * 1100 for all six sample invoices.
     *
     * @var Modules\Zatca\Classes\InvoiceReportType
     */
    public $invoiceType;

    /**
     * the country is default SA.
     *
     * @var string
     */
    public $countryName;

    public function __construct(
        string $otp,
        string $emailAddress,
        string $commonName,
        string $organizationalUnitName,
        string $organizationName,
        string $taxNumber,
        string $registeredAddress,
        string $businessCategory,
        string $egsSerialNumber = NULL,
        string $registrationNumber,
        string $invoiceType = InvoiceReportType::BOTH,
        string $countryName = 'SA'
    ) {
        $this->otp                          = $otp;
        $this->emailAddress                 = $emailAddress;
        $this->commonName                   = $commonName;
        $this->organizationalUnitName       = $organizationalUnitName;
        $this->organizationName             = $organizationName;
        $this->taxNumber                    = $taxNumber;
        $this->registeredAddress            = $registeredAddress;
        $this->businessCategory             = $businessCategory;
        $this->egsSerialNumber              = $egsSerialNumber ?? EgsSerialNumber::generate();
        $this->registrationNumber           = $registrationNumber;
        $this->invoiceType                  = $invoiceType;
        $this->countryName                  = $countryName;
    }
}
