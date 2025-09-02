<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use App\Utils\ModuleUtil;
use App\Utils\BusinessUtil;
use Illuminate\Http\Request;
use App\Utils\RestaurantUtil;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Superadmin\Entities\Package;
use Modules\Superadmin\Entities\Subscription;

class AdminSubscriptionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AdminSubscriptionController
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new business/business as well as their
    | validation and creation.
    |
    */

    /**
     * All Utils instance.
     *
     */
    protected $businessUtil;
    protected $restaurantUtil;
    protected $moduleUtil;
    protected $mailDrivers;

    /**
     * Constructor
     *
     * @param ProductUtils $product
     * @return void
     */
    public function __construct(BusinessUtil $businessUtil, RestaurantUtil $restaurantUtil, ModuleUtil $moduleUtil)
    {
        $this->businessUtil = $businessUtil;
        $this->moduleUtil = $moduleUtil;
        
    }

    /**
     * Enter details for subscriptions
     * @return object
     */
    private function _add_subscription($business_id, $package, $gateway, $payment_transaction_id, $user_id, $is_superadmin = false, $status, $payment_source = false)
    {
        if (!is_object($package)) {
            $package = Package::active()->find($package);
        }

        $subscription = ['business_id' => $business_id,
                        'package_id' => $package->id,
                        'paid_via' =>  $payment_transaction_id,
                        'payment_transaction_id' => $payment_transaction_id
                    ];

            $dates = $this->_get_package_dates($business_id, $package);

            $subscription['start_date'] = $dates['start'];
            $subscription['end_date'] = $dates['end'];
            $subscription['trial_end_date'] = $dates['trial'];
            $subscription['status'] = $status;
        
        
        $subscription['package_price'] = $package->price;
        $subscription['package_details'] = [
                'location_count' => $package->location_count,
                'user_count' => $package->user_count,
                'product_count' => $package->product_count,
                'invoice_count' => $package->invoice_count,
                'name' => $package->name
            ];
        //Custom permissions.
        if (!empty($package->custom_permissions)) {
            foreach ($package->custom_permissions as $name => $value) {
                $subscription['package_details'][$name] = $value;
            }
        }
        
        $subscription['created_id'] = $user_id;
        $subscription = Subscription::create($subscription);

        $paymentMeta = array(
            "package_id"=>$package->id, 
            "business_id"=>$business_id
        );

        if ($payment_source == 'web') {
            Earning::agentEarnings( $paymentMeta );
        }

        
        return $subscription;
    }
    /**
     * The function returns the start/end/trial end date for a package.
     *
     * @param int $business_id
     * @param object $package
     *
     * @return array
     */
    private function _get_package_dates($business_id, $package)
    {
        $output = ['start' => '', 'end' => '', 'trial' => ''];

        //calculate start date
        $start_date = Subscription::end_date($business_id);
        $output['start'] = $start_date->toDateString();

        //Calculate end date
        if ($package->interval == 'days') {
            $output['end'] = $start_date->addDays($package->interval_count)->toDateString();
        } elseif ($package->interval == 'months') {
            $output['end'] = $start_date->addMonths($package->interval_count)->toDateString();
        } elseif ($package->interval == 'years') {
            $output['end'] = $start_date->addYears($package->interval_count)->toDateString();
        }
        
        $output['trial'] = $start_date->addDays($package->trial_days);

        return $output;
    }


    public function adminGetPackage()
    {
        $data =  Package::active()->orderby('sort_order')->get();

        if (count($data)) {
            // code...
            return [
                'status'=>true,
                'message'=>'Packages Found',
                'data'=>$data
            ];
        }
    }

   

    public function adminUpdatePackage(Request $request)
    {
        $validator = $request->validate([
            'business_id' => 'required',
            'package_id'=>'required',
            'payment_transaction_id'=>'required',
        ]); 

        $package = Package::active()->find($request->package_id);

        if(empty($package)){
            return [
                'status'=>true,
                'message'=>'Package not found'
            ];
        }

        $business = DB::table('business')
                    ->leftjoin('users', 'users.id', 'business.owner_id')
                    ->where('business.id', $request->business_id)
                    ->select(
                        'users.id As user_id',
                        'business.id AS business_id'
                    )
                    ->first();

        if (empty($business)) {
            // code...
            return [
                'status'=>false,
                'message'=>'Business not found'
            ];
        }


        $status = (isset($request->status)) ? $request->status : "approved";
        
        $subscription = $this->_add_subscription(
            $business->business_id, 
            $package, 
            'Admin-Applied-Package', 
            $request->payment_transaction_id, 
            $business->user_id, 
            $is_superadmin = false,
            $status,
            $request->payment_source
        );

        return [
            'status'=>true,
            'message'=>'Package Added to Business',
            'data'=> $subscription
        ];
    }
}
