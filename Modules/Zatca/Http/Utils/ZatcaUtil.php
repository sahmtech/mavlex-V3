<?php

namespace Modules\Zatca\Http\Utils;

use App\Models\TaxRate;
use Carbon\Carbon;
use App\Models\Transaction;
use Modules\Zatca\Classes\TaxCategoryCode;
use App\Utils\Util;
use Modules\Zatca\Classes\Objects\Setting;
use Modules\Zatca\Classes\PaymentType;
use Modules\Zatca\Classes\Objects\Invoice;
use Modules\Zatca\Zatca;
use Modules\Zatca\Classes\Objects\Seller;
use Modules\Zatca\Classes\Objects\Client;
use Modules\Zatca\Classes\Invoices\B2B;
use Modules\Zatca\Classes\Invoices\B2C;
use Modules\Zatca\Classes\Objects\InvoiceItem;
use Illuminate\Support\Facades\Log;
use App\Models\Business;
use App\Models\BusinessLocation;


class ZatcaUtil extends Util
{
    /**
     * Return the ZATCA info array that is now stored on the outlet (location).
     *
     * @param  \App\Models\Transaction  $transaction
     * @return array
     */
    public function locationInfo(Transaction $transaction): array
    {
        $loc = $transaction->location ?? null;
        return is_array($loc?->zatca_info) ? $loc->zatca_info : [];
    }

    public function InvoiceItems($transaction)
    {
        $items_before_tax = $items_tax = $items_after_tax = 0;
        $invoiceItems = [];
        $order_tax = $transaction->tax_amount ?? 0.0;
        $order_tax_rate = $transaction->tax ? (float) $transaction->tax->amount : 0.0;
        
        if ($transaction->invoice_type == 388) {
            $total_price = 0;
            $total_discount = 0;
            foreach ($transaction->sell_lines as $item) {
                $total_price += ($item->unit_price_before_discount ?? 0) * ($item->quantity ?? 1);
            }

            foreach ($transaction->sell_lines as $item) {
                $price = round(($item->unit_price_before_discount ?? 0) * ($item->quantity ?? 1), 2);
                $item_proportion = $total_price > 0 ? $price / $total_price : 0;
                $item_order_tax = round($order_tax * $item_proportion, 2);
                $price_tax = round(($item->item_tax * $item->quantity ?? 0) + $item_order_tax, 2);

                $item_tax_rate = $item->line_tax ? (float) $item->line_tax->amount : 0;
                $tax_rate = $item_tax_rate > 0 ? $item_tax_rate : $order_tax_rate;
                $total = round($price + $price_tax, 2);
                if (($item->line_discount_type ?? '') === 'percentage') {
                    $item_discount = round((($item->line_discount_amount ?? 0) / 100) * $price, 2);
                } else {
                    $item_discount = round(($item->line_discount_amount ?? 0) * ($item->quantity ?? 1), 2);
                }                

                if (($price_tax == 0.0) && ($tax_rate == 0.0)) {
                    $taxCategoryCode = TaxCategoryCode::OUT_OF_SCOPE;
                } else {
                    $taxCategoryCode = TaxCategoryCode::STANDARD_RATE;
                }

                $invoiceItems[] = new InvoiceItem(
                    $item->product->id ?? 0,
                    $item->product->name ?? 'Unknown Product',
                    $item->quantity ?? 1,
                    $price,
                    $item_discount,
                    $price_tax,
                    $tax_rate,
                    $total,
                    ($item_discount ?? 0.00) > 0 ? 'General Discount' : null,
                    $taxCategoryCode,
                   
                );
                $discount = $item_discount;
                $price_after_discount = $price - $discount;
                $items_after_tax_discount = $total - $discount;
                $total_discount += $discount;
                $items_before_tax += $price_after_discount ;
                $items_tax += $price_tax;
                $items_after_tax += $items_after_tax_discount;


            }
        } elseif ($transaction->invoice_type == 383) {
            $parent_sell = $transaction->return_parent_id ? Transaction::find($transaction->return_parent_id) : null;
            $lines = $parent_sell->sell_lines;
            $total_price = 0;
            $total_discount= 0;
            
            foreach ($lines as $item) {
                $total_price += ($item->unit_price_before_discount ?? 0) * ($item->quantity_returned ?? 1);
            }

            foreach ($lines as $item) {
                $price = round(($item->unit_price_before_discount ?? 0) * ($item->quantity_returned ?? 1), 2);
                $item_proportion = $total_price > 0 ? $price / $total_price : 0;
                $item_order_tax = round($order_tax * $item_proportion, 2);
                $price_tax = round(($item->item_tax ?? 0) + $item_order_tax, 2);
                $item_tax_rate = 0;
                if (($item->line_discount_type ?? '') === 'percentage') {
                    $item_discount = round((($item->line_discount_amount ?? 0) / 100) * $price, 2);
                } else {
                    $item_discount = round(($item->line_discount_amount ?? 0) * ($item->quantity ?? 1), 2);
                }
                if ($item->tax_id) {
                    $item_tax_model = TaxRate::find($item->tax_id);
                    if ($item_tax_model) {
                        $item_tax_rate = (float) $item_tax_model->amount;
                    }
                }

                $tax_rate = $item_tax_rate > 0 ? $item_tax_rate : $order_tax_rate;
                $total = round($price + $price_tax, 2);

                if (($price_tax == 0.0) && ($tax_rate == 0.0)) {
                    $taxCategoryCode = TaxCategoryCode::OUT_OF_SCOPE;
                } else {
                    $taxCategoryCode = TaxCategoryCode::STANDARD_RATE;
                }
                $invoiceItems[] = new InvoiceItem(
                    $item->product->id ?? 0,
                    $item->product->name ?? 'Unknown Product',
                    $item->quantity_returned ?? 1,
                    $price,
                    $item_discount,
                    $price_tax,
                    $tax_rate,
                    $total,
                    ($item_discount ?? 0.00) > 0 ? 'General Discount' : null,
                    $taxCategoryCode,
                );

                $discount = $item_discount;
                $price_after_discount = $price - $discount;
                $items_after_tax_discount = $total - $discount;
                $total_discount += $discount;
                $items_before_tax += $price_after_discount ;
                $items_tax += $price_tax;
                $items_after_tax += $items_after_tax_discount;
               
            }
        }
        return [
            'items_before_tax' => $items_before_tax,
            'items_tax' => $items_tax,
            'items_after_tax' => $items_after_tax,
            'invoice_items' => $invoiceItems,
            'total_item_discount' => $total_discount,
        ];
    }



    public function InvoiceSettings(Business $business, Transaction $transaction = null, int $location_id = null): ?Setting
    {
        $location = $transaction ? $transaction->location : BusinessLocation::find($location_id);

        if (! $location || ! is_array($location->zatca_info)) {
            return null;
        }
        $info = $location->zatca_info;
        if (empty($info['otp']) || empty($info['invoicing_type'])) {
            return null;
        }
        $company = is_array($business->company)
            ? $business->company
            : (array) $business->company;

        return new Setting(
            (string) $info['otp'],
            (string) ($info['emailAddress'] ?? $company['emailAddress'] ?? ''),
            (string) ($company['commonName'] ?? ''),
            (string) ($company['organizationalUnitName'] ?? ''),
            (string) ($company['organizationName'] ?? ''),
            (string) ($info['tax_number_1'] ?? ''),
            (string) ($info['company_address'] ?? $company['registeredAddress'] ?? ''),
            (string) ($info['businessCategory'] ?? ''),
            null,
            (string) ($info['tax_number_2'] ?? ''),
            $info['invoicing_type'],
            (string) ($info['countryName'] ?? 'SA')
        );
    }

    public function Invoice($transaction, $items)
    {
        $invoiceType = $transaction->invoice_type;
        $paymentType = PaymentType::MULTIPLE;
        $invoice_discount = $transaction->discount_amount;
       
        $items_before_tax = isset($items['items_before_tax']) ? (float) $items['items_before_tax'] : 0.00;
        $items_tax = isset($items['items_tax']) ? (float) $items['items_tax'] : 0.00;
        $items_after_tax = isset($items['items_after_tax']) ? (float) $items['items_after_tax'] : 0.00;
        $items_discount = isset($items['total_item_discount']) ? (float) $items['total_item_discount'] : 0.00;
        $invoiceItems = isset($items['invoice_items']) ? $items['invoice_items'] : [];
        $items_after_tax_discount = $items_after_tax - $items_discount;
        return new Invoice(
            $transaction->id,
            $transaction->invoice_no,
            $transaction->uuid ? $transaction->uuid : self::uuid(),
            Carbon::parse($transaction->created_at)->format('Y-m-d'),
            Carbon::parse($transaction->created_at)->format('H:i:s'),
            $invoiceType,
            $paymentType,
            $items_before_tax,
            $items_discount,
            $items_tax,
            $items_after_tax,
            $invoiceItems,  
            $transaction->hash,
            $transaction->return_parent_id ?? null,
            null,
            'cash,visa',
            'SAR',
            15,
            null,
            $invoice_discount,
        );
    }


    public function Seller(?Setting $settings, Transaction $transaction): ?Seller
    {
        if (!$settings) {
            return null;
        }

        $info     = $this->locationInfo($transaction);
        $business = $transaction->business;

        return new Seller(
            $settings->registrationNumber,
            (string) ($info['street_name']          ?? ''),
            (string) ($info['building_number']      ?? ''),
            (string) ($info['plot_identification']  ?? ''),
            (string) ($info['city_sub_division']    ?? ''),
            (string) ($info['city']                 ?? ''),
            (string) ($info['postal_number']        ?? ''),

            $settings->taxNumber,
            $settings->organizationName,
            $business->settings->private_key       ?? '',
            $business->settings->cert_production   ?? '',
            $business->settings->secret_production ?? ''
        );
    }

    public function xml($transaction)
    {
        $business = $transaction->business;
        $items = $this->InvoiceItems($transaction);
        $settings = $this->InvoiceSettings($business, $transaction);
        $seller   = $this->Seller($settings, $transaction);
        $invoice = $this->Invoice($transaction, $items);

        $file_name = $business->company['vat_number'] . "_" . Carbon::parse($transaction->created_at)->format('Ymd') . "T" . Carbon::parse('2022-10-10 20:20:20')->format('his') . "_$transaction->id.xml";
        $contactName = ($transaction->contact->contact_type === 'business' && !empty($transaction->contact->supplier_business_name)) ? $transaction->contact->supplier_business_name : $transaction->contact->name;
        if (
            $transaction->contact->tax_number && $contactName
            && $transaction->contact->zip_code && $transaction->contact->city
            && $transaction->contact->address_line_2 && $transaction->contact->address_line_1
        ) {
            $client  = new Client(
                $contactName,
                $transaction->contact->tax_number,
                $transaction->contact->zip_code,
                $transaction->contact->address_line_1,
                $transaction->contact->address_line_2,
                '0000',
                '0000',
                $transaction->contact->city
            );
            $b2b = B2B::make($seller, $invoice, $client)->report();
            file_put_contents($file_name, $b2b->getXmlInvoice());
        } else {
            $b2c = (B2C::make($seller, $invoice)->calculate());
            file_put_contents($file_name, $b2c->getXmlInvoice());
        }
        return response()->download(public_path($file_name), $file_name, [
            'Content-Type' => 'application/xml',
        ])->deleteFileAfterSend(true);
    }


    public function QR(Transaction $transaction, $total_order_tax)
    {
        try {

            $zs = $transaction->location->zatcaSetting ?? null;
            if ($zs && $zs->is_connected) {
                $items    = $this->InvoiceItems($transaction);
                $settings = $this->InvoiceSettings($transaction->business, $transaction);
                $seller   = $this->Seller($settings, $transaction);
                $invoice  = $this->Invoice($transaction, $items);
                if ($seller && $invoice) {
                    $b2c = B2C::make($seller, $invoice)->calculate();
                    $qr   = $b2c->getQrImage();
                    return $qr;
                }
            }
            $info       = $transaction->location->zatca_info ?? [];
            $sellerName = $info['tax_label_2']  ?? $transaction->business->name;
            $sellerTax  = $info['tax_number_1'] ?? $transaction->business->tax_number_1;
            $amt        = round($transaction->final_total, 2);
            $date       = Carbon::parse($transaction->transaction_date)->toIso8601String();
            $s  = $this->toHex(1) . $this->toHex(strlen($sellerName)) . $sellerName;
            $s .= $this->toHex(2) . $this->toHex(strlen($sellerTax))    . $sellerTax;
            $s .= $this->toHex(3) . $this->toHex(strlen($date))         . $date;
            $s .= $this->toHex(4) . $this->toHex(strlen($amt))          . $amt;
            $s .= $this->toHex(5) . $this->toHex(strlen($total_order_tax)) . $total_order_tax;
            $b64 = base64_encode($s);
            return $b64;
        } catch (\Exception $e) {

            return null;
        }
    }





    protected function toHex($value)
    {
        return pack("H*", sprintf("%02X", $value));
    }

    private static function uuid(): string
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
       /**
 * Build and return the raw XML string for this transaction.
 */
public function buildXmlString(Transaction $transaction): string
{
    $business = $transaction->business;
    $items    = $this->InvoiceItems($transaction);
    $settings = $this->InvoiceSettings($business, $transaction);
    $seller   = $this->Seller($settings, $transaction);
    $invoice  = $this->Invoice($transaction, $items);

    $contact = $transaction->contact;
    $contactName = ($contact->contact_type === 'business' && $contact->supplier_business_name)
        ? $contact->supplier_business_name
        : $contact->name;

    if (
        $contact->tax_number && $contactName
        && $contact->zip_code && $contact->city
        && $contact->address_line_1 && $contact->address_line_2
    ) {
        $client = new Client(
            $contactName,
            $contact->tax_number,
            $contact->zip_code,
            $contact->address_line_1,
            $contact->address_line_2,
            '0000','0000',
            $contact->city
        );
        $b2b = B2B::make($seller, $invoice, $client)->report();
        return $b2b->getXmlInvoice();
    } else {
        $b2c = B2C::make($seller, $invoice)->calculate();
        return $b2c->getXmlInvoice();
    }
}
}
