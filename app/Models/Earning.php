<?php

namespace App\Models;

use App\Models\Business;
use App\Models\AgentUserInfo;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Modules\Superadmin\Entities\Package;
use Modules\Superadmin\Entities\Subscription;

class Earning extends Model
{
    /**
     * @var $table
     */
    protected $table = 'earnings';
    
        
    /**
     * agentEarnings() Calculate Agent Commision and create an earning Record
     *
     * @param  mixed $data
     * @return void
     */
    public static function agentEarnings(array $data)
    {
        try {
            $business_id = data_get($data, 'business_id');
            $package_id = data_get($data, 'package_id');

            $packageList = Package::where('id', $package_id)->first();
            // Set default values for commission, package amount, status, and transaction type
            $commissionPercentage = 20;
            $packageAmount = $packageList->renewal_price;
            $status = "Unpaid";
            $transactionType = "Renewal";

            $countTransaction = Subscription::where('business_id', $business_id)
                                                    ->where('package_id', '!=', 1)
                                                    ->count();
          
            $agentEarning = Business::leftJoin('users', 'users.id', 'business.owner_id')
                        ->where('business.id', $business_id)
                        ->first();
                        
            if ($countTransaction === 0) {
                // Update commission, package amount, status, and transaction type for the first subscription
                $commissionPercentage = $agentEarning->agent_lead;
                $packageAmount = $packageList->price;
                $transactionType = "Sales";
            }

            if (!is_null($agentEarning->agent_referal_code)) {
                // Get the agent information based on the referral code
                $agent = AgentUserInfo::where('user_infos.referal_code', $agentEarning->agent_referal_code)
                        ->first();

                if (!empty($agent)) {
                    $amount = ($commissionPercentage * $packageAmount / 100);
                    self::insert([
                        'agent_id' => $agent->user_id,
                        'amount' => $amount,
                        'type' => $transactionType,
                        'transaction_type' => $transactionType,
                        'status' => $status,
                        'business_id' => $business_id,
                        'created_at' => date('Y-m-d'),
                        'updated_at' => date('Y-m-d'),
                    ]);
                }
            }
        } catch (\Throwable $e) {
            Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
        }
    }
}
