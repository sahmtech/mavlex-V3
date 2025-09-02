<?php

namespace Modules\Zatca\Classes\Services\Invoice;

use Modules\Zatca\Classes\Actions\GetXmlFileAction;
use Modules\Zatca\Classes\TaxCategoryCode;
use Modules\Zatca\Helpers\InvoiceHelper;
use Modules\Zatca\Classes\Objects\InvoiceItem;
use Modules\Zatca\Transformers\PriceFormat;
use Illuminate\Support\Facades\Log;
class XmlInvoiceItemsService
{
    /**
     * the invoice data.
     *
     * @var object
     */
    protected $invoice;

    /**
     * the invoice items.
     *
     * @var array
     */
    protected $invoiceItems;

    /**
     * __construct
     *
     * @param  object $invoice
     * @return void
     */
    public function __construct(object $invoice)
    {
        $this->invoice      = $invoice;

        $this->invoiceItems = array_values($invoice->invoice_items);
    }

    /**
     * generate the xml of invoice items.
     *
     * @param  string $invoice_content
     * @return void
     */
    public function generate(string &$invoice_content): void
    {
        $invoice_content = str_replace('SET_TAX_TOTALS', $this->getTaxTotalXmlContent(), $invoice_content);
        $discount = $this->invoice->discount ?? 0;
      
        $invoice_content = str_replace(
            'TOTAL_TAX_AMOUNT',
            PriceFormat::transform($this->invoice->tax),
            $invoice_content
        );
        
       
        // <cac:LegalMonetaryTotal>
        $invoice_content = str_replace(
            'SET_LINE_EXTENSION_AMOUNT',
            PriceFormat::transform($this->invoice->total - $this->invoice->tax ),
            $invoice_content
        );
        $invoice_content = str_replace(
            'SET_NET_TOTAL',
            PriceFormat::transform($this->invoice->total),
            $invoice_content
        );
        

        // TODO : handle multiple taxes & discounts. (must edit invoice_items).
        $invoice_content = str_replace('SET_INVOICE_LINES', $this->getInvoiceLineXmlContent(), $invoice_content);
        
        // dd($this->getInvoiceLineXmlContent());
        // dd($invoice_content);
    }

    /**
     * get the tax total xml content.
     *
     * @return string
     */
    protected function getTaxTotalXmlContent(): string
    {
        $xml = GetXmlFileAction::handle('xml_tax_totals');

        $totalTax = PriceFormat::transform($this->invoice->tax);

        $xml = str_replace("SET_TAX_AMOUNT", $totalTax, $xml);

        $xml = str_replace("SET_TAX_LINES", $this->getTaxSubtotalXmlContent(), $xml);

        return $xml;
    }

    /**
     * get the tax subtotal items xml content.
     *
     * @return string
     */
    protected function getTaxSubtotalXmlContent(): string
    {
        $taxSubtotalXml = '';

        foreach(InvoiceHelper::getTaxSubTotalGroups($this->invoiceItems) as $group) {
            $taxSubtotalXmlItem = GetXmlFileAction::handle('xml_tax_line');
            $taxSubtotalXmlItem = str_replace(
                'INVOICE_TAXABLE_AMOUNT',
                PriceFormat::transform(
                    InvoiceHelper::getTaxSubTotalSum($group['list_items'], 'sub_total')
                ),
                $taxSubtotalXmlItem
            );

            $taxSubtotalXmlItem = str_replace(
                'INVOICE_TOTAL_TAX',
                PriceFormat::transform(
                    InvoiceHelper::getTaxSubTotalSum($group['list_items'], 'tax')
                ),
                $taxSubtotalXmlItem
            );

            $taxSubtotalXmlItem = str_replace(
                'INVOICE_TAX_CODE',
                $group['tax_category_code'],
                $taxSubtotalXmlItem
            );

            $taxSubtotalXmlItem = str_replace(
                'INVOICE_TAX_PERCENT',
                PriceFormat::transform(
                    $group['tax_percentage']
                ),
                $taxSubtotalXmlItem
            );

            $exemptionReasonAndCodeXml = '';

            // add reason and code for exemption tax category...
            if(InvoiceHelper::isExemptTaxCategoryCode($group['tax_category_code'])) {

                $exemptionCode = $group['tax_exemption_code'];
                $exemptionReason = $group['tax_exemption_reason'];

                $exemptionReasonAndCodeXml = "\n" . GetXmlFileAction::handle('xml_tax_exemption_reason');

                $exemptionReasonAndCodeXml = str_replace(
                    'INVOICE_TAX_EXEMPTION_REASON_CODE',
                    $exemptionCode,
                    $exemptionReasonAndCodeXml
                );

                $exemptionReasonAndCodeXml = str_replace(
                    'INVOICE_TAX_EXEMPTION_REASON',
                    $exemptionReason,
                    $exemptionReasonAndCodeXml
                );

            }

            $taxSubtotalXmlItem = str_replace(
                'SET_EXEMPTION_REASON_AND_CODE',
                $exemptionReasonAndCodeXml,
                $taxSubtotalXmlItem
            );

            $taxSubtotalXml .= $taxSubtotalXmlItem;

            $taxSubtotalXml = rtrim($taxSubtotalXml, '\n');

        }

        return $taxSubtotalXml;
    }

    /**
     * get the invoice lines xml content.
     *
     * @return string
     */
    protected function getInvoiceLineXmlContent(): string
    {
        $invoiceLineXml = '';

        foreach($this->invoiceItems as $index => $item) {

            $xml = GetXmlFileAction::handle('xml_line_item');
            $xml = str_replace('ITEM_ID', $item->id, $xml);
            $xml = str_replace('ITEM_QTY', $item->quantity, $xml);
            $xml = str_replace('UNIT_CODE', $item->unit_code, $xml);
            $itemNetPrice = ($item->price - $item->discount) / $item->quantity;
            $xml = str_replace('ITEM_NET_PRICE', PriceFormat::transform($itemNetPrice), $xml);
            $xml = str_replace('ITEM_NAME', $item->product_name, $xml);
            $xml = str_replace('ITEM_NET_AMOUNT', PriceFormat::transform($item->sub_total), $xml);
            $xml = str_replace('ITEM_TOTAL_TAX', PriceFormat::transform($item->tax), $xml);
            $xml = str_replace('ITEM_TOTAL_INCLUDE_TAX', PriceFormat::transform($item->total), $xml);

            $isLastItem = $index == count($this->invoiceItems);

            $xml = str_replace(
                'ITEM_TAX_CATEGORY',
                $this->getClassifiedTaxCategoryXmlContent($item, $isLastItem),
                $xml
            );
            $xml = str_replace(
                'ITEM_DISCOUNT',
                $this->getAllowanceChargeXmlContent($item, $isLastItem),
                $xml
            );

            $invoiceLineXml .= $xml;

        }

        $invoiceLineXml = rtrim($invoiceLineXml, '\n');

        return $invoiceLineXml;
    }

    /**
     * get the classified tax category xml content.
     *
     * @param  \Modules\Zatca\Classes\Objects\InvoiceItem    $item
     * @param  bool     $new_line
     * @return string
     */
    protected function getClassifiedTaxCategoryXmlContent(InvoiceItem $item, bool $new_line): string
    {
        $xml = GetXmlFileAction::handle('xml_line_item_tax_category');

        $xml = str_replace(
            'TAX_CATEGORY_ID',
            $item->tax_category_code,
            $xml
        );

        $xml = str_replace(
            'PERCENT_VALUE',
            PriceFormat::transform($item->tax_percent),
            $xml
        );

        $xml .= $new_line ? '\n' : '';

        return $xml;
    }

    /**
     * get the discount items xml content.
     *
     * @param  \Modules\Zatca\Classes\Objects\InvoiceItem    $item
     * @param  bool     $new_line
     * @return string
     */
    protected function getAllowanceChargeXmlContent(InvoiceItem $item, bool $new_line): string
    {
            $xml = GetXmlFileAction::handle('xml_line_item_discount');

            $xml  = str_replace(
                'ITEM_DISCOUNT_REASON',
                $item->discount > 0 ? ($item->discount_reason ?? 'Discount') : '',
                $xml
            );

            $xml = str_replace(
                'ITEM_DISCOUNT_VALUE',
                PriceFormat::transform($item->discount),
                $xml
            );

            $xml .= $new_line ? '\n' : '';

        return $xml;
    }


}
