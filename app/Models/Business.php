<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Business extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'woocommerce_api_settings'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['woocommerce_api_settings'];

    /**
     * Returns the date formats
     */
    public static function date_formats()
    {
        return [
            'd-m-Y' => 'dd-mm-yyyy',
            'm-d-Y' => 'mm-dd-yyyy',
            'd/m/Y' => 'dd/mm/yyyy',
            'm/d/Y' => 'mm/dd/yyyy',
            'Y/m/d' => 'yyyy/mm/dd',
            'Y-m-d' => 'yyyy-mm-dd'
        ];
    }

    /**
     * Get the owner details
     */
    public function owner()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'owner_id');
    }

    /**
     * Get the Business currency.
     */
    public function currency()
    {
        return $this->belongsTo(\App\Models\Currency::class);
    }

    /**
     * Get the Business currency.
     */
    public function locations()
    {
        return $this->hasMany(\App\Models\BusinessLocation::class);
    }

    /**
     * Get the Business invoice scheme.
     */
    public function invoice_scheme()
    {
        return $this->belongsTo(\App\Models\InvoiceScheme::class)->withDefault(['prefix' => '']);
    }

    /**
     * Get the Business printers.
     */
    public function printers()
    {
        return $this->hasMany(\App\Models\Printer::class);
    }

    /**
     * Get the Business subscriptions.
     */
    public function subscriptions()
    {
        return $this->hasMany('\Modules\Superadmin\Entities\Subscription');
    }

    /**
     * Creates a new business based on the input provided.
     *
     * @return object
     */
    public static function create_business($details)
    {
        $business = Business::create($details);
        return $business;
    }

    /**
     * Updates a business based on the input provided.
     * @param int $business_id
     * @param array $details
     *
     * @return object
     */
    public static function update_business($business_id, $details)
    {
        if (!empty($details)) {
            Business::where('id', $business_id)
                ->update($details);
        }
    }

    public function getBusinessAddressAttribute()
    {
        $location = $this->locations->first();
        $address = $location->landmark . ', ' . $location->city .
            ', ' . $location->state . '<br>' . $location->country . ', ' . $location->zip_code;

        return $address;
    }

    public function getBusinesPartners($partner_id = null, $business_id = null)
    {
        return Business::join('users', 'users.id', '=', 'business.owner_id')
            ->where('users.partner_id', $partner_id)
            ->whereNotNull('users.partner_id')
            ->when($business_id, function ($query, $business_id) {
                return $query->where('users.business_id', $business_id);
            })
            ->with('subscriptions') // Include the "subscription" relationship
            ->select(
                'business.id AS id',
                'business.name AS business_name',
                'users.first_name AS owner_name',
                'users.contact_no AS owner_no',
                'users.contact_no',
                'users.email AS email',
                'users.partner_id',
                'business.id AS bid',
            )
            ->get();

        return $query;
    }

    public function getGetInactiveBusiness($partner_id)
    {
        return \DB::table('users')
            ->join('business', 'business.owner_id', '=', 'users.id')
            ->leftJoin('transaction_payments', function ($join) {
                $join->on('transaction_payments.business_id', '=', 'business.id')
                    ->where('transaction_payments.created_at', '>=', Carbon::now()->subDays(7));
            })
            ->where('users.partner_id', $partner_id)
            ->whereNotNull('users.partner_id')
            ->whereNull('transaction_payments.id')
            ->groupBy('business.id')
            ->select(
                'users.id',
                'users.first_name',
                'users.first_name AS owner_name',
                'business.name',
                'business.name AS business_name',
                'users.contact_no',
                'users.contact_no AS owner_no',
                'users.partner_id',
                'business.id AS bid',
                'users.email',
            )
            ->get();
    }

    public function getRenewalBusiness($partner_id)
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $currentDay = Carbon::now()->day;

        return \DB::table('users')
            ->leftJoin('subscriptions', 'subscriptions.business_id', 'users.business_id')
            ->leftJoin('business', 'business.id', 'users.business_id')
            ->leftJoin('packages', 'packages.id', 'subscriptions.package_id')
            ->where('users.partner_id', $partner_id)
            ->whereNotNull('users.partner_id')

            ->where(function ($query) use ($currentYear, $currentMonth, $currentDay) {
                $query->whereYear('subscriptions.end_date', $currentYear)
                    ->whereMonth('subscriptions.end_date', $currentMonth)
                    ->where(function ($query) use ($currentDay) {
                        $query->whereDay('subscriptions.end_date', '>=', $currentDay)
                            ->orWhere(function ($query) use ($currentDay) {
                                $query->whereDay('subscriptions.end_date', '<=', $currentDay)
                                    ->where(function ($query) use ($currentDay) {
                                        $query->whereBetween('subscriptions.end_date', [
                                            Carbon::now()->subDays(3)->startOfDay(),
                                            Carbon::now()->subDays(3)->setHour(23)->setMinute(59)->setSecond(59)
                                        ])->orWhereBetween('subscriptions.end_date', [
                                            Carbon::now()->subDays(7)->startOfDay(),
                                            Carbon::now()->subDays(7)->setHour(23)->setMinute(59)->setSecond(59)
                                        ])->orWhereBetween('subscriptions.end_date', [
                                            Carbon::now()->subDays(14)->startOfDay(),
                                            Carbon::now()->subDays(14)->setHour(23)->setMinute(59)->setSecond(59)
                                        ])->orWhereBetween('subscriptions.end_date', [
                                            Carbon::now()->subDays(31)->startOfDay(),
                                            Carbon::now()->subDays(31)->setHour(23)->setMinute(59)->setSecond(59)
                                        ]);
                                    });
                            });
                    });
            })
            ->select(
                'users.business_id',
                'users.id',
                'users.first_name',
                'business.name AS business_name',
                'users.contact_no',
                'users.partner_id',
                'users.email',
                'subscriptions.start_date',
                'subscriptions.end_date',
                'subscriptions.package_price',
                'packages.name',
                'subscriptions.status',
                'subscriptions.created_at',
                \DB::raw("DATEDIFF(CURDATE(), subscriptions.end_date) AS days")
            )
            ->latest()
            ->groupBy('owner_id')
            ->get();
    }

    public function getTopRankingBusiness($partner_id)
    {
        return \DB::table('business')
            ->leftjoin('users', 'users.id', 'business.owner_id')
            ->leftJoin('transaction_payments', 'transaction_payments.business_id', 'business.id')
            ->where('users.partner_id', $partner_id)
            ->whereBetween('transaction_payments.created_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->whereNotNull('users.partner_id')
            ->select(
                'business.name',
                'business.created_at',
                'business.updated_at',
                'users.first_name',
                'users.last_name',
                'users.partner_id',
                'users.email',
                'users.username',
                'users.contact_no',
                'business.id AS bid',
                'users.id AS uid',
                \DB::raw('COUNT(transaction_payments.id) as transaction_count')
            )
            ->groupBy('business.id')
            ->orderByDesc('transaction_count')
            ->get();
    }

    /**
     * Get the Business latest subscription.
     */
    public function latestSubscription()
    {
        return $this->hasOne('\Modules\Superadmin\Entities\Subscription')->latest();
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'ref_no_prefixes' => 'array',
            'enabled_modules' => 'array',
            'email_settings' => 'array',
            'sms_settings' => 'array',
            'common_settings' => 'array',
            'weighing_scale_setting' => 'array',
            'enable_instant_pos' => 'boolean'
        ];
    }

    //Zatca Code
    // public function getCompanyAttribute()
    // {
    //     $zatca = $this->settings;

    //     return [
    //         'vat_number' => $zatca->tax_number_1,
    //         'vat_name' => $zatca->tax_label_1,
    //         'commercial_registration_number' => $zatca->tax_number_2,
    //         'tax_label_2' => $zatca->tax_label_2,
    //         'street_name' => $zatca->street_name ?? null,
    //         'building_number' => $zatca->building_number ?? null,
    //         'plot_identification' => $zatca->plot_identification ?? null,
    //         'city_sub_division' => $zatca->city_sub_division ?? null,
    //         'city' => $zatca->city ?? 'Khobar',
    //         'postal_number' => $zatca->postal_number ?? '31952',
    //         'invoice_type' => $zatca->invoice_issue_type ?? '1100',
    //         'registeredAddress' => $zatca->company_address ?? null,
    //         'businessCategory' => $zatca->businessCategory ?? 'IT',
    //         'egs_serial_number' => $zatca->egs_serial_number ?? '1-ASC|2-V01|3-1234567890',
    //         'commonName' => $this->name,
    //         'organizationalUnitName' => $this->name,
    //         'organizationName' => $this->name,
    //         'countryName' => 'SA',
    //         'emailAddress' => $this->email ?? 'it@example.sa',
    //         'is_phase_two' => $zatca->is_phase_two ?? false,
    //         'is_production' => $zatca->is_production ?? false,
    //         'otp' => $zatca->otp ?? null,
    //     ];
    // }
        //Zatca Code
        public function getCompanyAttribute()
        {
            $location   = $this->locations()->first();
            $info       = $location->zatca_info ?? [];
        
            return [
                'vat_number'                     => $info['tax_number_1']      ?? null,
                'vat_name'                       => $info['tax_label_1']       ?? null,
                'commercial_registration_number' => $info['tax_number_2']      ?? null,
                'tax_label_2'                    => $info['tax_label_2']       ?? null,
                'street_name'                    => $info['street_name']       ?? null,
                'building_number'                => $info['building_number']   ?? null,
                'plot_identification'            => $info['plot_identification']?? null,
                'city_sub_division'              => $info['city_sub_division'] ?? null,
                'city'                           => $info['city']              ?? null,
                'postal_number'                  => $info['postal_number']     ?? null,
                'invoice_type'                   => $info['invoice_issue_type']?? '1100',
                'registeredAddress'              => $info['company_address']   ?? null,
                'businessCategory'               => $info['businessCategory']  ?? null,
                'egs_serial_number'              => $location->location_id     ?? '',
                'commonName'                     => $info['tax_label_2']       ?? null,
                'organizationalUnitName'         => $info['tax_label_2']       ?? null,
                'organizationName'               => $info['tax_label_2']       ?? null,
                'countryName'                    => 'SA',
                'emailAddress'                   => $info['email']    ?? 'it@example.sa',
                'otp'                            => $info['otp']   ?? null,
    
                'is_phase_two'  => optional($location->zatcaSetting)->is_phase_two,
                'is_production' => optional($location->zatcaSetting)->zatca_env === 'production',
            ];
        }

    public function settings()
    {
        if (class_exists(\Modules\Zatca\Entities\ZatcaSetting::class)) {
            return $this->hasOne(\Modules\Zatca\Entities\ZatcaSetting::class, 'business_id');
        }
    }
    public function getLightLogoAttribute()
    {
        $logoData = json_decode($this->logo, true);
        return $logoData['light'] ?? null;
    }

    public function getDarkLogoAttribute()
    {
        $logoData = json_decode($this->logo, true);
        return $logoData['dark'] ?? null;
    }
}
