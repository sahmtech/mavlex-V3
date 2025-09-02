<?php

namespace Modules\Zatca\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Zatca\Classes\InvoiceType;
use Modules\Zatca\Classes\PaymentType;
use Modules\Zatca\Classes\TaxCategoryCode;
use Modules\Zatca\Classes\Invoices\B2B;
use Modules\Zatca\Classes\Objects\Client;
use Modules\Zatca\Classes\Objects\Invoice;
use Modules\Zatca\Classes\Objects\InvoiceItem;
use Modules\Zatca\Classes\Objects\Seller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class B2bController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $this->handleValidation($request);

            // set seller information...
            $seller = new Seller(
                $request->input('seller.registration_number'),
                $request->input('seller.street_name'),
                $request->input('seller.building_number'),
                $request->input('seller.plot_identification'),
                $request->input('seller.city_sub_division'),
                $request->input('seller.city'),
                $request->input('seller.postal_number'),
                $request->input('seller.tax_number'),
                $request->input('seller.registration_name'),
                $request->input('seller.private_key'),
                $request->input('seller.certificate'),
                $request->input('seller.secret')
            );

            // set invoice items details...
            $invoiceItems = collect($request->input('invoice_items'))
            ->map(function($invoiceItem) {
                return new InvoiceItem(
                    $invoiceItem['id'],
                    $invoiceItem['product_name'],
                    $invoiceItem['quantity'],
                    $invoiceItem['price'],
                    $invoiceItem['discount'],
                    $invoiceItem['tax'],
                    $invoiceItem['tax_percent'],
                    $invoiceItem['total'],
                    $invoiceItem['discount_reason'],
                    $invoiceItem['tax_category_code'],
                    $invoiceItem['tax_exemption_reason'],
                    $invoiceItem['tax_exemption_code']
                );
            })
            ->toArray();

            // set invoice details...
            $invoice = new Invoice(
                $request->input('invoice.id'),
                $request->input('invoice.invoice_number'),
                $request->input('invoice.invoice_uuid'),
                $request->input('invoice.invoice_date'),
                $request->input('invoice.invoice_time'),
                $request->input('invoice.invoice_type'),
                $request->input('invoice.payment_type'),
                $request->input('invoice.price'),
                $request->input('invoice.discount'),
                $request->input('invoice.tax'),
                $request->input('invoice.total'),
                $invoiceItems,
                $request->input('invoice.previous_hash'),
                $request->input('invoice.invoice_billing_id'),
                $request->input('invoice.invoice_note'),
                $request->input('invoice.payment_note'),
                'SAR', 
                15, 
                $request->input('invoice.delivery_date')
            );

            // set client...
            $client  = new Client(
                $request->input('client.registration_name'),
                $request->input('client.tax_number'),
                $request->input('client.postal_number'),
                $request->input('client.street_name'),
                $request->input('client.building_number'),
                $request->input('client.plot_identification'),
                $request->input('client.city_subdivision_name'),
                $request->input('client.city'),
                $request->input('client.country')
            );

            // send the invoice to zatca... 
            $b2c = B2B::make($seller, $invoice, $client)->report();

            // return response...
            return response()->json(
                array_merge($b2c->getResult(), [
                    'qr' => $b2c->getQr(),
                ])
            );
        }
        catch(Exception $e) {
            if($e instanceof ValidationException) {
                return response()->json(['message' => $e->getMessage(), 'errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            return response()->json(['message' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

    }

    private function handleValidation(Request $request)
    {
        $this->validate(
            $request, 
            [
                // validate seller...
                'seller.registration_number' => 'required',
                'seller.street_name' => 'required',
                'seller.building_number' => 'required',
                'seller.plot_identification' => 'required',
                'seller.city_sub_division' => 'required',
                'seller.city' => 'required',
                'seller.postal_number' => 'required',
                'seller.tax_number' => 'required',
                'seller.registration_name' => 'required',
                'seller.private_key' => 'required',
                'seller.certificate' => 'required',
                'seller.secret' => 'required',
                // validate invoice items...
                'invoice_items' => 'required|array',
                'invoice_items.*.id' => 'required',
                'invoice_items.*.product_name' => 'required',
                'invoice_items.*.quantity' => 'required',
                'invoice_items.*.price' => 'required',
                'invoice_items.*.discount' => 'required',
                'invoice_items.*.tax' => 'required',
                'invoice_items.*.tax_percent' => 'required',
                'invoice_items.*.total' => 'required',
                'invoice_items.*.discount_reason' => 'nullable',
                'invoice_items.*.tax_category_code' => 'required|in:S,Z,E,O',
                'invoice_items.*.tax_exemption_reason' => 'nullable',
                'invoice_items.*.tax_exemption_code' => 'nullable',
                // validate invoice...
                'invoice.id' => 'required',
                'invoice.invoice_number' => 'required',
                'invoice.invoice_uuid' => 'required',
                'invoice.invoice_date' => 'required',
                'invoice.invoice_time' => 'required',
                'invoice.invoice_type' => 'required|in:388,383,381',
                'invoice.payment_type' => 'required|in:10,30,42,48,1',
                'invoice.price' => 'required',
                'invoice.discount' => 'required',
                'invoice.tax' => 'required',
                'invoice.total' => 'required',
                'invoice.previous_hash' => 'nullable',
                'invoice.invoice_billing_id' => 'nullable',
                'invoice.invoice_note' => 'nullable',
                'invoice.payment_note' => 'nullable',
                'invoice.delivery_date' => 'nullable',
                // validate client...
                'client.registration_name' => 'required',
                'client.tax_number' => 'required',
                'client.postal_number' => 'required',
                'client.street_name' => 'required',
                'client.building_number' => 'required',
                'client.plot_identification' => 'required',
                'client.city_subdivision_name' => 'required',
                'client.city' => 'required',
                'client.country' => 'required',
            ],
            [
                'invoice_items.*.tax_category_code.in' => [
                    'message' => 'validation.in',
                    'STANDARD_RATE' => TaxCategoryCode::STANDARD_RATE,
                    'ZERO_RATE' => TaxCategoryCode::ZERO_RATE,
                    'EXEMPT' => TaxCategoryCode::EXEMPT,
                    'OUT_OF_SCOPE' => TaxCategoryCode::OUT_OF_SCOPE,
                ],
                'invoice.invoice_type.in' => [
                    'message' => 'validation.in',
                    'TAX_INVOICE' => InvoiceType::TAX_INVOICE,
                    'REFUND_INVOICE|DEBIT_NOTE' => InvoiceType::DEBIT_NOTE,
                    'CREDIT_NOTE' => InvoiceType::CREDIT_NOTE,
                ],
                'invoice.payment_type.in' => [
                    'message' => 'validation.in',
                    'CASH' => PaymentType::CASH,
                    'CREDIT' => PaymentType::CREDIT,
                    'BANK_ACCOUNT' => PaymentType::BANK_ACCOUNT,
                    'BANK_CARD' => PaymentType::BANK_CARD,
                    'MULTIPLE' => PaymentType::MULTIPLE,
                ],
            ]
        );
    }
}
