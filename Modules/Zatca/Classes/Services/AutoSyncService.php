<?php

namespace Modules\Zatca\Classes\Services;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Exception;
use Modules\Zatca\Http\Utils\ZatcaUtil;
use Modules\Zatca\Classes\Objects\Client;
use Modules\Zatca\Classes\Invoices\B2B;
use Modules\Zatca\Classes\Invoices\B2C;

class AutoSyncService
{
    protected ZatcaUtil $zatcaUtil;

    public function __construct()
    {
        $this->zatcaUtil = new ZatcaUtil();
    }

    /**
     * Send one invoice to ZATCA.
     *
     * @param  int  $transactionId
     * @return array{success:bool,msg:string}
     */
    public function sendInvoice(int $transactionId): array
    {
        $transaction = Transaction::find($transactionId);
        if (
            ! in_array($transaction->type, ['sell', 'sell_return'], true)
            || $transaction->status   !== 'final'
            || $transaction->is_suspend == 1
            || $transaction->is_running_order == 1
        ) {
            return [
                'success' => false,
            ];
        }
        if (!$transaction) {
            return [
                'success' => false,
                'msg'     => __('messages.transaction_not_found'),
            ];
        }
        if ($transaction->sent_to_zatca === 1) {
            return [
                'success' => false,
                'msg'     => __('zatca::lang.already_sent'),
            ];
        }

       $locationInfo = $this->zatcaUtil->locationInfo($transaction);
        
        if (empty($locationInfo['otp']) || empty($locationInfo['tax_number_1'])) {
            return [
                'success' => false,
                'msg'     => __('zatca::lang.verify_business_information'),
            ];
        }
        

        $cutOff = Carbon::now()->subHours(24);
        if (Carbon::parse($transaction->transaction_date)->lt($cutOff)) {
            return [
                'success' => false,
                'msg'     => __('zatca::lang.invoice_older_than_24_hours'),
            ];
        }

        try {
            $invoiceItems   = $this->zatcaUtil->InvoiceItems($transaction);
            $sellerSetting = $this->zatcaUtil->InvoiceSettings($transaction->business, $transaction);
            $sellerObject   = $this->zatcaUtil->Seller($sellerSetting, $transaction);
            $invoiceObject  = $this->zatcaUtil->Invoice($transaction, $invoiceItems);

            $contact         = $transaction->contact;
            $contactName     = $contact->contact_type === 'business' && $contact->supplier_business_name? $contact->supplier_business_name : $contact->name;
            $canSendAsB2B    = $contact && $contact->tax_number && $contactName && $contact->zip_code && $contact->city && $contact->address_line_1 && $contact->address_line_2;
            if ($canSendAsB2B) {
                $clientObject = new Client(
                    $contactName,
                    $contact->tax_number,
                    $contact->zip_code,
                    $contact->address_line_1,
                    $contact->address_line_2,
                    '0000',
                    '0000',
                    $contact->city
                );
                $zatcaResponse = B2B::make($sellerObject, $invoiceObject, $clientObject)->report();
            } else {
                $zatcaResponse = B2C::make($sellerObject, $invoiceObject)->report();
            }

            $transaction->sent_to_zatca = $zatcaResponse ? 1 : 2;
            $transaction->save();

            return [
                'success' => (bool) $zatcaResponse,
                'msg'     => $zatcaResponse
                                ? __('zatca::lang.successfully_sent_to_zatca')
                                : __('messages.something_went_wrong'),
            ];

        } catch (Exception $exception) {

            $transaction->sent_to_zatca = 2;
            $transaction->save();

            Log::error('[ZATCA] Send error: '.$exception->getMessage(), [
                'transaction_id' => $transactionId,
            ]);

            $message = __('messages.something_went_wrong');
            $apiBody = json_decode($exception->getMessage(), true);
            if (json_last_error() === JSON_ERROR_NONE
                && isset($apiBody['errors'][0]['message'])) {
                $message = $apiBody['errors'][0]['message'];
            }

            return ['success' => false, 'msg' => $message];
        }
    }
}
