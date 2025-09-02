<?php

namespace App\Http\Controllers;

use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use App\Utils\BusinessUtil;
use Illuminate\Http\Request;
use App\Models\BusinessLocation;
use App\Utils\TransactionUtil;
use App\Utils\ContactUtil;
use App\Models\TaxRate;

class PriceCheckController extends Controller
{
    protected $productUtil;
    protected $businessUtil;
    protected $moduleUtil;
    protected $transactionUtil;
    protected $contactUtil;

    public function __construct(
        ProductUtil $productUtil,
        BusinessUtil $businessUtil,
        ModuleUtil $moduleUtil,
        TransactionUtil $transactionUtil,
        ContactUtil $contactUtil
    ) {

        $this->productUtil = $productUtil;
        $this->businessUtil = $businessUtil;
        $this->moduleUtil = $moduleUtil;
        $this->transactionUtil = $transactionUtil;
        $this->contactUtil = $contactUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $business_id = $request->session()->get('user.business_id');

        if (!(auth()->user()->can('superadmin') || auth()->user()->can('sell.create') || ($this->moduleUtil->hasThePermissionInSubscription($business_id, 'repair_module') && auth()->user()->can('repair.create')))) {
            abort(403, 'Unauthorized action.');
        }

        if (!$this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse(action('HomeController@index'));
        }

        $business_locations = BusinessLocation::forDropdown($business_id, false, true);
        $bl_attributes = $business_locations['attributes'];
        $business_locations = $business_locations['locations'];

        if (empty($default_location)) {
            foreach ($business_locations as $id => $name) {
                $default_location = BusinessLocation::findOrFail($id);
                break;
            }
        }

        return view('price_check.index')
            ->with(compact('business_locations', 'bl_attributes', 'default_location'));
    }
    private function getSellLineRow($variation_id, $location_id, $quantity, $row_count, $is_direct_sell, $so_line = null)
{
    $business_id = request()->session()->get('user.business_id');

    $product = $this->productUtil->getDetailsFromVariation($variation_id, $business_id, $location_id, false);

    if (!$product) {
        return [
            'success' => false,
            'msg' => __('lang_v1.product_not_found')
        ];
    }

   
    $output = [
        'success'      => true,
        'html_content' => view('price_check.product_row', compact('product'))->render()
    ];

    return $output;
}

public function getProductRow($variation_id, $location_id)
{
    $output = [];

    try {
        $quantity  = request()->get('quantity', 1);
        $row_count = request()->get('product_row', 0);
        $row_count = $row_count + 1;

        $output = $this->getSellLineRow($variation_id, $location_id, $quantity, $row_count, false);
    } catch (\Exception $e) {
        \Log::emergency("File:" . $e->getFile() . " Line:" . $e->getLine() . " Message:" . $e->getMessage());
        $output['success'] = false;
        $output['msg'] = __('lang_v1.item_out_of_stock');
    }

    return $output;
}
}