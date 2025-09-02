<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
class RedisCachingControrller extends Controller
{
    public function ReportLocation( $business_id, $logged_user)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $location = \DB::table('business_locations')
            ->where('business_id',$business_id )
            ->select('id')
            ->get();

        foreach ($location as $key) {
            # code...

            Artisan::call('redis:report_cache',[
                'businessid' => $business_id, 
                'start_date' => date('Y-m-d',strtotime(date('Y-01-01'))),
                'end_date' => date('Y-m-d',strtotime(date('Y-12-31'))),
                'location_id' => '',
                'user_id' => $logged_user ,
            ]);


            Artisan::call('redis:report_cache',[
                'businessid' => $business_id, 
                'start_date' => date('Y-m-d',strtotime(date('Y-01-01'))),
                'end_date' => date('Y-m-d',strtotime(date('Y-12-31'))),
                'location_id' => $key->id,
                'user_id' => $logged_user ,
            ]);

            $data = [
                //Today
                [
                    'businessid' => $business_id, 
                    'start_date' => date('Y-m-d'),
                    'end_date' => date('Y-m-d'),
                    'location_id' => $key->id,
                    'user_id' => $logged_user ,
                ],
                //Yesterday
                [
                    'businessid' => $business_id, 
                    'start_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 day')),
                    'end_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 day')),
                    'location_id' => $key->id,
                    'user_id' => $logged_user ,
                ],
                //7 Days Ago
                [
                    'businessid' => $business_id, 
                    'start_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' - 7 day')),
                    'end_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' - 7 day')),
                    'location_id' => $key->id,
                    'user_id' => $logged_user ,
                ],
                //1 Months
                [
                    'businessid' => $business_id, 
                    'start_date' => date('Y-m-01'),
                    'end_date' => date('Y-m-31'),
                    'location_id' => $key->id,
                    'user_id' => $logged_user ,
                ],
                //Last Month
                [
                    'businessid' => $business_id, 
                    'start_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 month')),
                    'end_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 month')),
                    'location_id' => $key->id,
                    'user_id' => $logged_user ,
                ],
                //This months Last year
                [
                    'businessid' => $business_id, 
                    'start_date' => date('Y-m-01'),
                    'end_date' => date('Y-m-31'),
                    'location_id' => $key->id,
                    'user_id' => $logged_user ,
                ],
                //This Year
                [
                    'businessid' => $business_id, 
                    'start_date' => date('Y-m-01'),
                    'end_date' => date('Y-12-31'),
                    'location_id' => $key->id,
                    'user_id' => $logged_user ,
                ],

                //Last year

                [
                    'businessid' => $business_id, 
                    'start_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 year')),
                    'end_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' - 1 year')),
                    'location_id' => $key->id,
                    'user_id' => $logged_user ,
                ],

                [
                    'businessid' => $business_id, 
                    'start_date' => date('Y-01-01'),
                    'end_date' => date('Y-12-31'),
                    'location_id' => $key->id,
                    'user_id' => $logged_user ,
                ],

                [
                    'businessid' => $business_id, 
                    'start_date' => date('Y-m-d',strtotime(date('Y-01-01'))),
                    'end_date' => date('Y-m-d',strtotime(date('Y-12-31'))),
                    'location_id' => $key->id,
                    'user_id' => $logged_user ,
                ],

                // [
                //     'businessid' => $business_id, 
                //     'start_date' => date('Y-m-d',strtotime(date('Y-01-01'))),
                //     'end_date' => date('Y-m-d',strtotime(date('Y-12-31'))),
                //     'location_id' => $key->id,
                //     'user_id' => $logged_user ,
                // ],

            ];

            foreach ($data as $data_list) {
                # code...
                Artisan::call('redis:report_cache',$data_list);
            }
        }
    }


    public function CacheInit(Request $request)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $business_id = $request->session()->get('user.business_id');
        $logged_user = request()->session()->get('user.id');
        return$this->ReportLocation($business_id, $logged_user);

    }
}
