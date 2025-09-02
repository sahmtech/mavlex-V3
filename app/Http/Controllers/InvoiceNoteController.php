<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\InvoiceNote;
use App\Utils\ModuleUtil;
use App\Utils\TransactionUtil;
use Illuminate\Http\Request;
class InvoiceNoteController extends Controller
{
    protected $transactionUtil;
    protected $moduleUtil;
    protected $notificationUtil;

    /**
     * Constructor
     *
     * @param TransactionUtil $transactionUtil
     * @return void
     */
    public function __construct(TransactionUtil $transactionUtil, ModuleUtil $moduleUtil)
    {
        $this->transactionUtil = $transactionUtil;
        $this->moduleUtil = $moduleUtil;
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
        $sell = Transaction::where('business_id', $business_id)
                    ->where('id', $transaction_id)
                    ->with('notes')
                    ->firstOrFail();
                    
        return view('invoice_note.create', compact('sell'));
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
            $input = $request->only(['description', 'transaction_id']);
            $input['business_id'] = $request->session()->get('user.business_id');
            $input['created_by'] = auth()->user()->id;
            $input['date'] = date('Y-m-d');

            if (!empty($request->input('note_id'))) {
                $note = InvoiceNote::where('id', $request->input('note_id'))->firstOrFail();
                $note->update($input);
                $msg = __("lang_v2.note_updated_success");
            } else {
                $note = InvoiceNote::create($input);
                $msg = __("lang_v2.note_added_success");
            }
        
            $data = InvoiceNote::where('id', $note->id)
                    ->with('created_user')
                    ->firstOrFail();
            $output = ['success' => true,
                            'msg' => $msg,
                            'note' => $data
                        ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => false,
                            'msg' => __("messages.something_went_wrong"),
                            'note' => []
                        ];
        }

        return $output;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $note = InvoiceNote::where('id', $id)
                    ->firstOrFail();
            $output = [
                        'success' => true,
                        'msg' => '',
                        'note' => $note
                    ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => false,
                            'msg' => __("messages.something_went_wrong"),
                            'note' => []
                        ];
        }

        return $output;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            try {
                $business_id = request()->session()->get('user.business_id');

                $invoice_note = InvoiceNote::where('business_id', $business_id)->findOrFail($id);
                $invoice_note->delete();

                $output = ['success' => true,
                            'msg' => __("lang_v2.note_deleted_success")
                            ];
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
                $output = ['success' => false,
                            'msg' => __("messages.something_went_wrong")
                        ];
            }

            return $output;
        }
    }

}
