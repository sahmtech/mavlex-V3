<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use App\Models\InvoiceReminder;
use App\Utils\ProductUtil;
use App\Utils\BusinessUtil;
use Illuminate\Http\Request;

class InvoiceReminderController extends Controller
{
    protected $productUtil;
    protected $businessUtil;

    /**
     * Constructor
     *
     * @param BusinessUtil $businessUtil
     * @param ProductUtil $productUtil
     * @return void
     */
    public function __construct(BusinessUtil $businessUtil, ProductUtil $productUtil)
    {
        $this->businessUtil = $businessUtil;
        $this->productUtil = $productUtil;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transaction_id = request()->input('transaction_id');
        $business_id = request()->session()->get('user.business_id');
        $business_details = $this->businessUtil->getDetails($business_id);
        $commsn_agnt_setting = $business_details->sales_cmsn_agnt;
        $commission_agent = [];
        if ($commsn_agnt_setting == 'user') {
            $commission_agent = User::forDropdown($business_id);
        } elseif ($commsn_agnt_setting == 'cmsn_agnt') {
            $commission_agent = User::saleCommissionAgentsDropdown($business_id);
        }
        $sell = Transaction::where('business_id', $business_id)
                    ->where('id', $transaction_id)
                    ->with('reminders')
                    ->firstOrFail();
                    
        return view('invoice_reminder.create', compact('sell', 'commission_agent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->only(['description', 'date', 'set_reminder_to', 'transaction_id', 'send_email']);
            $input['business_id'] = $request->session()->get('user.business_id');
            $input['created_by'] = auth()->user()->id;
            $input['date'] = $this->productUtil->uf_date($request->input('date'), true);
            $reminder = InvoiceReminder::create($input);

            $data = InvoiceReminder::where('id', $reminder->id)
                    ->with('created_user')
                    ->firstOrFail();
        
            $output = ['success' => true,
                            'msg' => __("lang_v2.reminder_added_success"),
                            'reminder' => $data
                        ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => false,
                            'msg' => __("messages.something_went_wrong"),
                            'reminder' => []
                        ];
        }

        return $output;
    }

}
