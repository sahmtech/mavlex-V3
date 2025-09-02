<?php

namespace Modules\Zatca\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Business;
use App\Models\BusinessLocation;
use Modules\Zatca\Zatca;
use App\Models\Transaction;
use Carbon\Carbon;
use Modules\Zatca\Entities\ZatcaSetting;
use Modules\Zatca\Classes\Services\AutoSyncService;
use Modules\Zatca\Http\Utils\ZatcaUtil;
use App\Utils\BusinessUtil;
use App\Utils\TransactionUtil;
use App\Utils\ModuleUtil;
use Modules\Zatca\Helpers\CurrentTransaction;
use Illuminate\Support\Facades\Log;


class ZatcaController extends Controller
{
    protected $zatcaUtil;
    protected $transactionUtil;
    protected $businessUtil;
    protected $autoSyncService;
    protected $moduleUtil;
    

    public function __construct(AutoSyncService $autoSyncService , BusinessUtil $businessUtil , TransactionUtil $transactionUtil, ModuleUtil $moduleUtil)
    {
        $this->businessUtil = $businessUtil;
        $this->zatcaUtil = new ZatcaUtil();
        $this->autoSyncService = $autoSyncService;
        $this->transactionUtil = $transactionUtil;
        $this->moduleUtil = $moduleUtil;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $business_id = session()->get('user.business_id');
    
        // all outlets + their ZATCA record (if any)
        $business_locations = BusinessLocation::with('zatcaSetting')
            ->where('business_id', $business_id)
            //->orderByDesc('is_default')           // default first
            ->orderBy('name')
            ->get();
    
        $cron_job_command = $this->moduleUtil->getCronJobCommand();
        $business         = Business::findOrFail($business_id);
    
        return view('zatca::zatca_settings.index', compact(
            'business', 'cron_job_command', 'business_locations'
        ));
    }
    
    


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('zatca::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('zatca::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('zatca::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }



    /**
     * Print invoice to as xml.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function print_xml($id)
    {
        $transaction = Transaction::find($id);
        return (new ZatcaUtil())->xml($transaction);
    }

    /**
     * Send invoice to zatca.
     *
     * @return \Illuminate\Http\Response
     */

    public function SendToZatca($id)
    {
        CurrentTransaction::setTransactionId($id);
        $response = $this->autoSyncService->sendInvoice($id);

        if ($response['success']) {
            $output = [
                'success' => true,
                'msg' => $response['msg'],
            ];
        } else {
            $output = [
                'success' => false,
                'msg' => $response['msg'],
            ];
        }

        return back()->with('status', $output);
    }

    public function zatca_keys(Request $request, $location_id)
    {
        $request->validate([
            'location_id'      => 'required|integer|exists:business_locations,id',
            'otp'              => 'required|digits:6',
            'tax_number_1'     => 'required|string',
            'tax_number_2'     => 'required|string',
            'city'             => 'required|string',
            'postal_number'    => 'required|string|size:5',
            'company_address'  => 'required|string',
            'businessCategory' => 'required|string',
            'invoicing_type'   => 'required|in:1000,0100,1100',
            'emailAddress'     => 'required|email',
        ]);
    
        $business_id = $request->session()->get('user.business_id');
        $business = Business::findOrFail($business_id);
        $location = BusinessLocation::where('business_id', $business_id)
                                    ->where('id', $location_id)
                                    ->firstOrFail();
        $zs = $location->zatcaSetting ?: new ZatcaSetting(['business_id' => $business_id, 'location_id' => $location_id, ]);
    
        $settingObj = (new ZatcaUtil)->InvoiceSettings($business, $transaction = null, $location_id);
        if (! $settingObj) {
            return response()->json([
                'success' => false,
                'msg'     => __('zatca::lang.verify_business_information'),
            ], 422);
        }
    
        $result = Zatca::generateZatcaSetting($settingObj);
        $zs->private_key       = $result->private_key;
        $zs->cert_production   = $result->cert_production;
        $zs->secret_production = $result->secret_production;
        $zs->is_connected      = 1;
        $zs->save();
    
        return response()->json([
            'success' => true,
            'msg'     => __('zatca::lang.successfully_generated'),
        ]);
    }
    

/**
 * Create / update ZATCA settings for a single outlet (location).
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int                       $business_id
 * @return \Illuminate\Http\RedirectResponse
 */
public function updateZatcaDetails(Request $request, $business_id)
{
    $additional_output = null;

    try {
       $business  = Business::findOrFail($business_id);

        $location_id = $request->input('location_id');
        $location    = BusinessLocation::where('business_id', $business_id)
                        ->where('id', $location_id)
                        ->firstOrFail();

        $settings = $location->zatcaSetting ?: new ZatcaSetting(['business_id' => $business_id, 'location_id' => $location_id,]);
        $info = $request->only([
            'country','city', 'postal_number', 'street_name', 'building_number',
            'plot_identification', 'city_sub_division',
            'enable_auto_sync', 'sync_frequency',
            'invoice_issue_type', 'company_address', 'businessCategory',
            'tax_number_1', 'tax_label_1', 'tax_number_2', 'tax_label_2',
            'otp','invoicing_type','emailAddress','enable_auto_b2b_b2c_print'
        ]);

        $settingData = $request->only([
            'private_key', 'public_key',
            'csr_request', 'cnf', 'cert_compliance', 'secret_compliance',
            'csid_id_compliance', 'cert_production', 'secret_production',
            'csid_id_production', 'zatca_env',
        ]);

        $info['enable_auto_sync'] = $request->boolean('enable_auto_sync');

        $location->zatca_info = $info;
        $location->save();

        $settings->fill($settingData)->save();

        if ($request->boolean('create_zatca_keys')) {

            $request->validate([
                'otp'             => 'required',
                'tax_number_1'    => 'required',
                'tax_number_2'    => 'required',
                'city'            => 'required',
                'postal_number'   => 'required',
                'company_address' => 'required',
                'businessCategory'=> 'required',
                'invoicing_type'  => 'required',
                'emailAddress' => 'required',
            ]);

            $respData = $this->zatca_keys($request)->getData(true);

            $additional_output = [
                'status' => $respData['success'] ? 'success' : 'error',
                'msg'    => $respData['msg']      ?? '',
            ];
        }

        $output = [
            'success' => 1,
            'msg'     => __('business.settings_updated_success'),
        ];

    } catch (\Throwable $e) {

        \Log::emergency(
            "ZATCA update failed: {$e->getMessage()} @ {$e->getFile()}:{$e->getLine()}"
        );

        $output = [
            'success' => 0,
            'msg'     => __('messages.something_went_wrong'),
        ];
    }
    return redirect('zatca/settings')
            ->with('status', $output)
            ->with('success_page', $additional_output);
}

  
    


public function syncAll(Request $request)
{
    $request->validate([
        'location_id' => 'required|integer|exists:business_locations,id',
    ]);

    $business_id = $request->session()->get('user.business_id');
    $location_id = $request->input('location_id');
    $zs = ZatcaSetting::where('business_id', $business_id)
            ->where('location_id', $location_id)
            ->first();

    if (! $zs || $zs->is_connected != 1) {
        return response()->json([
            'success' => false,
            'message' => __('zatca::lang.business_not_connected')
        ], 403);
    }

    $cutoff = Carbon::now()->subHours(24);
    $txns = Transaction::where('business_id', $business_id)
            ->where('location_id', $location_id)
            ->whereIn('sent_to_zatca', [0, 2])
                ->whereIn('type', ['sell', 'sell_return'])
                ->where('status', 'final')
                ->where('is_suspend', 0)
                ->where('is_running_order', 0)
                ->where('transaction_date', '>=', $cutoff)
                ->get();
    if ($txns->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => __('zatca::lang.no_invoices_to_sync')
        ]);
    }

    $syncLogs    = [];
    $success     = 0;
    $failed      = 0;
    foreach ($txns as $txn) {
        try {
            $res = $this->autoSyncService->sendInvoice($txn->id);

            if ($res['success']) {
                $txn->sent_to_zatca = 1;
                $success++;
                $status = 'Success';
            } else {
                $txn->sent_to_zatca = 2;
                $failed++;
                $status = 'Error';
            }

            $txn->save();

            $syncLogs[] = [
                'invoice_no' => $txn->invoice_no,
                'status'     => $status,
                'message'    => $res['msg'],
            ];
        } catch (\Exception $e) {
            $txn->sent_to_zatca = 2;
            $txn->save();
            $failed++;

            \Log::error('ZATCA SyncAll Exception for txn '.$txn->id.': '.$e->getMessage());

            $syncLogs[] = [
                'invoice_no' => $txn->invoice_no,
                'status'     => 'Exception',
                'message'    => $e->getMessage(),
            ];
        }
    }

    return response()->json([
        'success'       => true,
        'message'       => __('zatca::lang.sync_completed', ['success' => $success, 'failed' => $failed]),
        'syncLogs'      => $syncLogs,
    ]);
}
    protected function _receiptContent($business_id, $location_id, $transaction_id)
    {
        $business_details = $this->businessUtil->getDetails($business_id);
        $location_details = BusinessLocation::find($location_id);
        $invoice_layout = $this->businessUtil->invoiceLayout($business_id, $location_details->invoice_layout_id);
        $receipt_details = $this->transactionUtil->getReceiptDetails($transaction_id, $location_id, $invoice_layout, $business_details, $location_details, 'browser');

        $currency_details = [
            'symbol' => $business_details->currency_symbol,
            'thousand_separator' => $business_details->thousand_separator,
            'decimal_separator' => $business_details->decimal_separator,
        ];
        $receipt_details->currency = $currency_details;

        $output['html_content'] = view('zatca::zatca.receipts.elegant_ar_en', compact('receipt_details'))->render();

        return $output;
    }

    
    /**
 * Download PDF/A-3 for a given transaction, with embedded ZATCA XML.
 */
public function downloadA3Pdf($id)
{
    if (! auth()->user()->can('print_invoice')) {
        abort(403, 'Unauthorized action.');
    }

    $business_id       = session('user.business_id');
    $transactionUtil   = new TransactionUtil();
    $receipt_contents  = $transactionUtil->getPdfContentsForGivenTransaction($business_id, $id);
    $receipt_details   = $receipt_contents['receipt_details'];
    $location_details  = $receipt_contents['location_details'];
    $transaction       = Transaction::where('business_id', $business_id)
                                    ->findOrFail($id);

    $body = view('sale_pos.receipts.download_a3_pdf')
        ->with(compact(
            'receipt_details',
            'location_details',
            'transactionUtil',
            'transaction'
        ))
        ->render();

    $mpdf = new \Mpdf\Mpdf([
        'tempDir'  => storage_path('tempdir'),
        'PDFA'     => true,
        'PDFAauto' => true,
        'mode'     => 'utf-8',
        'format'   => [350, 435],
        'fontDir'  => [public_path('fonts/Almarai')],
        'fontdata' => [
            'almarai' => [
                'R'          => 'Almarai-Regular.ttf',
                'B'          => 'Almarai-Bold.ttf',
                'I'          => 'Almarai-Light.ttf',
                'BI'         => 'Almarai-ExtraBold.ttf',
                'useOTL'     => 0xFF,
                'useKashida' => 75,
            ],
        ],
    ]);

    $mpdf->SetDirectionality(app()->getLocale() === 'ar' ? 'rtl' : 'ltr');
    $mpdf->autoScriptToLang = true;
    $mpdf->autoLangToFont   = true;
    $mpdf->SetTitle('INVOICE-' . $receipt_details->invoice_no);
    $mpdf->SetAuthor(config('app.name'));
    $mpdf->SetCreator('Laravel ZATCA Generator');
    $mpdf->SetSubject('ZATCA E-Invoice');
    // $mpdf->useSubstitutions = true;
    // $mpdf->SetWatermarkText($receipt_details->business_name, 0.1);
    // $mpdf->showWatermarkText = true;

    $mpdf->WriteHTML($body);

    if ($transaction->sent_to_zatca) {
        $xmlString = $this->zatcaUtil->buildXmlString($transaction);

        $safeInvoiceNo = str_replace(['/', '\\'], '_', $transaction->invoice_no);
        $fileName = $safeInvoiceNo . '.xml';
        $dir      = public_path('uploads/temp/zatca');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $xmlPath  = "$dir/$fileName";
        
        file_put_contents($xmlPath, $xmlString);

        $mpdf->SetAssociatedFiles([[
            'path'           => $xmlPath,
            'name'           => $fileName,
            'description'    => 'ZATCA E-Invoice XML',
            'mime'           => 'application/xml',
            'AFRelationship' => 'Data',
        ]]);
    }

    $pdfContent = $mpdf->Output('', 'S');

    if (! empty($xmlPath) && file_exists($xmlPath)) {
        @unlink($xmlPath);
    }

    return response($pdfContent, 200)
        ->header('Content-Type', 'application/pdf')
        ->header(
            'Content-Disposition',
            'inline; filename="INVOICE-' . $transaction->invoice_no . '.pdf"'
        );
}
    public function posBussinesUpdate(Request $request){
        
        $business_id = session()->get('user.business_id');
    
        try {
            $business = Business::find($business_id);
            $pos_settings = json_decode($business->pos_settings, true) ?? [];
    
            $pos_settings['disable_discount'] = 1;
            $pos_settings['disable_order_tax'] = 1;
    
            Business::where('id', $business_id)
                ->update(['default_sales_discount' => 0, 'pos_settings' => json_encode($pos_settings)]);
                
            request()->session()->regenerate();
            $output = ['success' => true,
                'msg' => __('lang_v1.updated_success'),
            ];
    
        } catch (\Exception $e) {
            \Log::error('Error updating pos settings: ' . $e->getMessage());
    
            $output = ['success' => false,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
    
        return redirect()->back()->with(['status' => $output]);
        }

}
