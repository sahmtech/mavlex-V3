<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use App\Utils\RestaurantUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Models\BusinessType;


class AgentOnboardingController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | BusinessController
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
        
        $this->theme_colors = [
            'blue' => 'Blue',
            'black' => 'Black',
            'purple' => 'Purple',
            'green' => 'Green',
            'red' => 'Red',
            'yellow' => 'Yellow',
            'blue-light' => 'Blue Light',
            'black-light' => 'Black Light',
            'purple-light' => 'Purple Light',
            'green-light' => 'Green Light',
            'red-light' => 'Red Light',
        ];

        $this->mailDrivers = [
                'smtp' => 'SMTP',
                // 'sendmail' => 'Sendmail',
                // 'mailgun' => 'Mailgun',
                // 'mandrill' => 'Mandrill',
                // 'ses' => 'SES',
                // 'sparkpost' => 'Sparkpost'
            ];
    }


    public function OnboardAgent(Request $request)
    {        
        $validator = $request->validate([
            'first_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'business_type'=>'required',
            'agent_lead'=>'required',
            'contact_no'=>'required|max:11|min:11',
            'password'=>'required|min:6',
            'landmark' => 'required|max:255',
            'username'=>'required|max:255|unique:users',
        ]); 

        try {

            DB::beginTransaction();
            //code...
            $referal_code = $request->filled('referal_code') ? $request->referal_code : null;

            $user = User::create([
                'first_name'=>$request->first_name,
                'email'=>$request->email,
                'username'=>$request->username,
                'password'=>\Hash::make($request->password),
                'contact_no'=>"234".substr($request->contact_no, 1),
                'agent_referal_code'=>$referal_code,
                'agent_lead'=>$request->agent_lead,
            ]);
            

            //MAke Modififcation to Business  Input

            $business_details = $request->only(['name', 'start_date', 'currency_id', 'time_zone']);

            $business_details['fy_start_month'] = 1;

            $business_details['start_date'] = date("m/d/Y");

            $business_details['currency_id'] = 2; 

            $business_details['time_zone'] = "Asia/karachi"; 

            $business_details['accounting_method'] = "fifo";

            //Make Modification to Location Input
            $business_location = $request->only(['name', 'country', 'state', 'city', 'landmark', 'website', 'mobile', 'alternate_number']);

            $business_location['country'] = "Nigeria";
            
            $business_location['zip_code'] = "000000";

            //Create the business
            $business_details['owner_id'] =  $user->id;
            if (!empty($business_details['start_date'])) {
                $business_details['start_date'] = Carbon::createFromFormat(config('constants.default_date_format'), $business_details['start_date'])->toDateString();
            }
            
            //default enabled modules
            $business_details['enabled_modules'] = ['purchases','add_sale','pos_sale','stock_transfers','stock_adjustment','expenses'];
            
            $business = $this->businessUtil->createNewBusiness($business_details);

            //Update user with business id
            $user->business_id = $business->id;
            $user->username = $request->username;
            $user->save();

            //Board Business To BardPOS
            BusinessType::create([
                'business_id'=>$business->id,
                'business_type'=>$request->business_type,
                'sms_verification'=>1,
                'user_id'=>$user->id
            ]);

            $this->businessUtil->newBusinessDefaultResources($business->id, $user->id);
            $new_location = $this->businessUtil->addLocation($business->id, $business_location);

            //create new permission with the new location
            Permission::create(['name' => 'location.' . $new_location->id ]);
            DB::commit();

            //Module function to be called after after business is created
            if (config('app.env') != 'demo') {
                $this->moduleUtil->getModuleData('after_business_created', ['business' => $business]);
            }

            //Process payment information if superadmin is installed & package information is present
            // $is_installed_superadmin = $this->moduleUtil->isSuperadminInstalled();
            // $package_id = $request->get('package_id', null);
            // if ($is_installed_superadmin && !empty($package_id) && (config('app.env') != 'demo')) {
            //     $package = \Modules\Superadmin\Entities\Package::find($package_id);
            //     if (!empty($package)) {
            //         Auth::login($user);
            //         return redirect()->route('register-pay', ['package_id' => $package_id]);
            //     }
            // }

            return [
                'status'=>true,
                'message'=>'Business Created Successfully',
                'data'=>[
                    'business_id'=>$business->id,
                    'users'=>$user,
                    'business'=>$business,
                    'request_payload'=>$request->all()
                ]
            ];

        } catch (\Throwable $e) {
            //throw $th;
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

            return [
                'status'=>false,
                'message'=>'Business Creation Failed'
            ];

        }
        
        
    }
}
