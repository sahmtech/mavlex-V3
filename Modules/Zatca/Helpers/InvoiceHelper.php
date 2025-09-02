<?php

namespace Modules\Zatca\Helpers;

use Modules\Zatca\Classes\TaxCategoryCode;
use Modules\Zatca\Classes\Objects\InvoiceItem;
use ReflectionClass;

class InvoiceHelper
{
    /**
     * get tax sub total groups.
     *
     * @param  array<\Modules\Zatca\Classes\Objects\InvoiceItem> $item
     * @return array
     */
    public static function getTaxSubTotalGroups(array $invoiceItems): array
    {
        // for tax category codes...
        $taxCategoryGroups = [];

        // get all tax percentages from the invoice items...
        $taxPercentages = array_unique(array_column($invoiceItems, 'tax_percent'));

        // generate groups by tax category codes...
        foreach((new ReflectionClass(TaxCategoryCode::class))->getConstants() as $taxCategoryCode) {

            // generate groups by tax percentage...
            foreach($taxPercentages as $taxPercentage) {

                // check exempt tax category code and eleminate none zero tax percentage...
                if($taxCategoryCode === TaxCategoryCode::STANDARD_RATE && $taxPercentage === 0.0) {
                    continue;
                }

                // check exempt tax category code and eleminate none zero tax percentage...
                if(self::isExemptTaxCategoryCode($taxCategoryCode) && $taxPercentage !== 0.0) {
                    continue;
                }

                $taxPercentage = (float) $taxPercentage;

                // filter invoice items and get only taxable...
                $taxableItems = array_values(
                    array_filter(
                        $invoiceItems,
                        function(InvoiceItem $item) use ($taxCategoryCode, $taxPercentage) {
                            return $item->tax_category_code === $taxCategoryCode &&
                            $item->tax_percent === $taxPercentage;
                        }
                    )
                );

                if(count($taxableItems) > 0) {
                    $taxCategoryGroups[] = [
                        'tax_category_code' => $taxCategoryCode,
                        'tax_percentage' => $taxPercentage,
                        'tax_exemption_code' => $taxableItems[0]->tax_exemption_code ?? ConfigHelper::get("zatca.exemptions.$taxCategoryCode.code"),
                        'tax_exemption_reason' => $taxableItems[0]->tax_exemption_reason ?? ConfigHelper::get("zatca.exemptions.$taxCategoryCode.reason"),
                        'list_items' => array_values($taxableItems),
                    ];
                }

            }

        }

        return $taxCategoryGroups;
    }

    /**
     * get sub total sum.
     *
     * @param  array<\Modules\Zatca\Classes\Objects\InvoiceItem> $item
     * @param  string $keyName
     * @return float
     */
    public static function getTaxSubTotalSum(array $invoiceItems, string $keyName): float
    {
        // get taxable amounts in an array...
        return (float) array_sum(
            array_map(
                function($item) use ($keyName) {
                    return $item->{$keyName};
                },
                $invoiceItems
            )
        );
    }

    public static function isExemptTaxCategoryCode(string $taxCategoryCode)
    {
        return in_array($taxCategoryCode, [TaxCategoryCode::ZERO_RATE, TaxCategoryCode::EXEMPT, TaxCategoryCode::OUT_OF_SCOPE]);
    }

    /**
     * get the signing time.
     *
     * @param  object $invoice
     * @return string
     */
    public function getSigningTime(object $invoice): string
    {
        // TODO : must send the date of signing time when post simplified invoice.
        return "{$invoice->invoice_date}T{$invoice->invoice_time}Z";
    }

    /**
     * get the timestamp of invoice.
     *
     * @param  object $invoice
     * @return string
     */
    public function getTimestamp(object $invoice): string
    {
        return "{$invoice->invoice_date}T{$invoice->invoice_time}Z";
    }

    /**
     * get the hashed certificate in base64 format.
     * note : certificate parameter is in base64 format.
     *
     * @param  mixed $certificate
     * @return string
     */
    public function getHashedCertificate(string $certificate): string
    {
        $certificate = base64_decode($certificate);

        $certificate = hash('sha256', $certificate, false);

        return base64_encode($certificate);
    }

    /**
     * get the certificate signature from certificate output.
     *
     * @param  mixed $certificate_output
     * @return string
     */
    public function getCertificateSignature(array $certificate_output): string
    {
        $signature = unpack('H*', $certificate_output['signature'])['1'];

        return pack('H*', substr($signature, 2));
    }
}
