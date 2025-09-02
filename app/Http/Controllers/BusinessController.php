<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessLocation;
use App\Models\BusinessType;
use App\Models\Country;
use App\Models\Currency;
use App\Notifications\TestEmailNotification;
use App\Models\State;
use App\Models\System;
use App\Models\TaxRate;
use App\Models\Unit;
use App\Models\User;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use App\Utils\RestaurantUtil;
use App\Models\WalletAccount;
use Carbon\Carbon;
use DateTimeZone;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;
use App\Services\AppSettingsService;
use EragLaravelDisposableEmail\Rules\DisposableEmailRule;
use Illuminate\Support\Str;
use App\Services\MenuService;

class BusinessController extends Controller
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
    protected $theme_colors;

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

        // $this->theme_colors = [
        //     'blue' => 'Blue',
        //     'black' => 'Black',
        //     'purple' => 'Purple',
        //     'green' => 'Green',
        //     'red' => 'Red',
        //     'yellow' => 'Yellow',
        //     'blue-light' => 'Blue Light',
        //     'black-light' => 'Black Light',
        //     'purple-light' => 'Purple Light',
        //     'green-light' => 'Green Light',
        //     'red-light' => 'Red Light',
        // ];

        $this->mailDrivers = [
            'smtp' => 'SMTP',
            // 'sendmail' => 'Sendmail',
            // 'mailgun' => 'Mailgun',
            // 'mandrill' => 'Mandrill',
            // 'ses' => 'SES',
            // 'sparkpost' => 'Sparkpost'
        ];
    }

    /**
     * Shows registration form
     *
     * @return \Illuminate\Http\Response
     */


    public function getRegister()
    {
        if (!config('constants.allow_registration')) {
            return redirect('/');
        }


        $currencies = $this->businessUtil->allCurrencies();
        $timezone_list = $this->businessUtil->allTimeZones();
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = __('business.months.' . $i);
        }
        $accounting_methods = $this->businessUtil->allAccountingMethods();
        $package_id = request()->package;
        $system_settings = System::getProperties(['superadmin_enable_register_tc', 'superadmin_register_tc'], true);

        $layout_record = System::where('key', 'login_layout')->first();
        $layout = $layout_record ? (int) $layout_record->value : 0;
        if ($layout === 0) {
            return view('business.register', compact(
                'currencies',
                'timezone_list',
                'months',
                'accounting_methods',
                'package_id',
                'system_settings'
            ));
        } else {
            $viewName = "loginlayouts::login{$layout}.register";

            return view($viewName, compact(
                'currencies',
                'timezone_list',
                'months',
                'accounting_methods',
                'package_id',
                'system_settings'
            ));
        }
    }


    /**
     * Handles the registration of a new business and it's owner
     *
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        if (!config('constants.allow_registration')) {
            return redirect('/');
        }
        $service = app(AppSettingsService::class);
        $temp_email_protection = $service->temp_email_protection();
        $email_rules = [
            'sometimes',
            'nullable',
            'email',
            'max:255',
            'unique:users,email',
        ];
        if ($temp_email_protection) {
            $email_rules[] = 'disposable_email';
        }

        try {
            $validator = $request->validate(
                [
                    'name' => 'required|max:255',
                    'currency_id' => 'required|numeric',
                    'country' => 'required|max:255',
                    'state' => 'required|max:255',
                    'city' => 'required|max:255',
                    'zip_code' => 'required|max:255',
                    'landmark' => 'required|max:255',
                    'time_zone' => 'required|max:255',
                    'surname' => 'max:10',
                    'email'           => $email_rules,
                    //'email' => 'sometimes|nullable|email|unique:users|max:255',
                    'first_name' => 'required|max:255',
                    'username' => 'required|min:4|max:255|unique:users',
                    'password' => 'required|min:4|max:255',
                    'fy_start_month' => 'required',
                    'accounting_method' => 'required',
                ],
                [
                    'name.required' => __('validation.required', ['attribute' => __('business.business_name')]),
                    'name.currency_id' => __('validation.required', ['attribute' => __('business.currency')]),
                    'country.required' => __('validation.required', ['attribute' => __('business.country')]),
                    'state.required' => __('validation.required', ['attribute' => __('business.state')]),
                    'city.required' => __('validation.required', ['attribute' => __('business.city')]),
                    'zip_code.required' => __('validation.required', ['attribute' => __('business.zip_code')]),
                    'landmark.required' => __('validation.required', ['attribute' => __('business.landmark')]),
                    'time_zone.required' => __('validation.required', ['attribute' => __('business.time_zone')]),
                    'email.email' => __('validation.email', ['attribute' => __('business.email')]),
                    'email.email' => __('validation.unique', ['attribute' => __('business.email')]),
                    'first_name.required' => __('validation.required', ['attribute' => __('business.first_name')]),
                    'username.required' => __('validation.required', ['attribute' => __('business.username')]),
                    'username.min' => __('validation.min', ['attribute' => __('business.username')]),
                    'password.required' => __('validation.required', ['attribute' => __('business.username')]),
                    'password.min' => __('validation.min', ['attribute' => __('business.username')]),
                    'fy_start_month.required' => __('validation.required', ['attribute' => __('business.fy_start_month')]),
                    'accounting_method.required' => __('validation.required', ['attribute' => __('business.accounting_method')]),
                ]
            );

            DB::beginTransaction();

            //Create owner.
            $owner_details = $request->only(['surname', 'first_name', 'last_name', 'username', 'email', 'password', 'language']);

            $owner_details['language'] = empty($owner_details['language']) ? config('app.locale') : $owner_details['language'];

            $user = User::create_user($owner_details);

            $business_details = $request->only(['name', 'start_date', 'currency_id', 'time_zone']);
            $business_details['fy_start_month'] = 1;

            $business_location = $request->only(['name', 'country', 'state', 'city', 'zip_code', 'landmark', 'website', 'mobile', 'alternate_number']);

            //Create the business
            $business_details['owner_id'] = $user->id;
            if (!empty($business_details['start_date'])) {
                $business_details['start_date'] = Carbon::createFromFormat(config('constants.default_date_format'), $business_details['start_date'])->toDateString();
            }

            //upload logo
            $logo_name = $this->businessUtil->uploadFile($request, 'business_logo', 'business_logos', 'image');
            if (!empty($logo_name)) {
                $business_details['logo'] = $logo_name;
            }

            //default enabled modules
            $business_details['enabled_modules'] = ['purchases', 'add_sale', 'pos_sale', 'stock_transfers', 'stock_adjustment', 'expenses'];

            $business = $this->businessUtil->createNewBusiness($business_details);

            //Update user with business id
            $user->business_id = $business->id;
            $user->save();

            $this->businessUtil->newBusinessDefaultResources($business->id, $user->id);
            $new_location = $this->businessUtil->addLocation($business->id, $business_location);

            //create new permission with the new location
            Permission::create(['name' => 'location.' . $new_location->id]);

            DB::commit();

            //Module function to be called after after business is created
            if (config('app.env') != 'demo') {
                $this->moduleUtil->getModuleData('after_business_created', ['business' => $business]);
            }

            //Process payment information if superadmin is installed & package information is present
            $is_installed_superadmin = $this->moduleUtil->isSuperadminInstalled();
            $package_id = $request->get('package_id', null);
            if ($is_installed_superadmin && !empty($package_id) && (config('app.env') != 'demo')) {
                $package = \Modules\Superadmin\Entities\Package::find($package_id);
                if (!empty($package)) {
                    Auth::login($user);
                    return redirect()->route('register-pay', ['package_id' => $package_id]);
                }
            }
            //Flush Menus 
            MenuService::flushMenus();

            $output = [
                'success' => 1,
                'msg' => __('business.business_created_succesfully'),
            ];

            return redirect('login')->with('status', $output);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];

            return back()->with('status', $output)->withInput();
        }
    }

    /**
     * Handles the validation username
     *
     * @return \Illuminate\Http\Response
     */
    public function postCheckUsername(Request $request)
    {
        $username = $request->input('username');

        if (!empty($request->input('username_ext'))) {
            $username .= $request->input('username_ext');
        }

        $count = User::where('username', $username)->count();

        if ($count == 0) {
            echo "true";
            exit;
        } else {
            echo "false";
            exit;
        }
    }

    /**
     * Handles the validation username
     *
     * @return \Illuminate\Http\Response
     */
    public function postCheckUsername2(Request $request)
    {
        $username = $request->input('username');

        if (!empty($request->input('username_ext'))) {
            $username .= $request->input('username_ext');
        }

        $count = User::where('username', $username)->count();

        if ($count == 0) {
            echo "true";
            exit;
        } else {
            echo "false";
            exit;
        }
    }

    public function getSettings(Request $request, AppSettingsService $appSettings)
    {
        return $this->getBusinessSettings($request, $appSettings);
    }

    /**
     * Shows business settings form
     *
     * @return \Illuminate\Http\Response
     */
    public function getBusinessSettings(Request $request,  AppSettingsService $appSettings)
    {
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
        $timezone_list = [];
        foreach ($timezones as $timezone) {
            $timezone_list[$timezone] = $timezone;
        }

        $business_id = request()->session()->get('user.business_id');
        $business = Business::where('id', $business_id)->first();
        $business_locations = BusinessLocation::where('business_id', $business_id)->pluck('name', 'id')->toArray();

        $currencies = $this->businessUtil->allCurrencies();
        $tax_details = TaxRate::forBusinessDropdown($business_id);
        $tax_rates = $tax_details['tax_rates'];

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = __('business.months.' . $i);
        }

        $accounting_methods = [
            'fifo' => __('business.fifo'),
            'lifo' => __('business.lifo'),
        ];
        $commission_agent_dropdown = [
            '' => __('lang_v1.disable'),
            'logged_in_user' => __('lang_v1.logged_in_user'),
            'user' => __('lang_v1.select_from_users_list'),
            'cmsn_agnt' => __('lang_v1.select_from_commisssion_agents_list'),
        ];

        $units_dropdown = Unit::forDropdown($business_id, true);
        $barcodes_dropdown = $this->businessUtil->barcode_types();

        $date_formats = Business::date_formats();

        $shortcuts = json_decode($business->keyboard_shortcuts, true);

        $pos_settings = empty($business->pos_settings) ? $this->businessUtil->defaultPosSettings() : json_decode($business->pos_settings, true);
        $dashboard_settings = empty($business->dashboard_settings) ? $this->businessUtil->defaultDashboardSettings() : json_decode($business->dashboard_settings, true);
        $restaurant_settings = empty($business->restaurant_settings) ? $this->businessUtil->defaultRestaurantSettings() : json_decode($business->restaurant_settings, true);

        $email_settings = empty($business->email_settings) ? $this->businessUtil->defaultEmailSettings() : $business->email_settings;

        $sms_settings = empty($business->sms_settings) ? $this->businessUtil->defaultSmsSettings() : $business->sms_settings;

        $modules = $this->moduleUtil->availableModules();

        // $theme_colors = $this->theme_colors;

        $mail_drivers = $this->mailDrivers;

        $allow_superadmin_email_settings = System::getProperty('allow_email_settings_to_businesses');

        $custom_labels = !empty($business->custom_labels) ? json_decode($business->custom_labels, true) : [];

        $common_settings = !empty($business->common_settings) ? $business->common_settings : [];

        $weighing_scale_setting = !empty($business->weighing_scale_setting) ? $business->weighing_scale_setting : [];
        // Decode the JSON theme_color; use defaults if not set
        $theme_colors = !empty($business->theme_color) ? json_decode($business->theme_color, true) : [];

        $primary_color = $theme_colors['primary'] ?? '#FFB600';
        $secondary_color = $theme_colors['secondary'] ?? '#011530';
        $body_color = $theme_colors['body_color'] ?? '#FFFFFF';
        $sidebar_text_color = $theme_colors['sidebar_text_color'] ?? '#FFFFFF';

        $segment = Str::after($request->path(), 'business/');
        $enabled_modules = !empty($business->enabled_modules) ? $business->enabled_modules : [];

        $data = compact(
            'business',
            'business_locations',
            'currencies',
            'tax_rates',
            'timezone_list',
            'months',
            'accounting_methods',
            'commission_agent_dropdown',
            'units_dropdown',
            'barcodes_dropdown',
            'date_formats',
            'shortcuts',
            'pos_settings',
            'dashboard_settings',
            'restaurant_settings',
            'modules',
            'enabled_modules',
            'theme_colors',
            'email_settings',
            'sms_settings',
            'mail_drivers',
            'allow_superadmin_email_settings',
            'custom_labels',
            'common_settings',
            'weighing_scale_setting',
            'primary_color',
            'secondary_color',
            'body_color',
            'sidebar_text_color'
        );
        $layout = $appSettings->business_settings_layout();
        if ($layout === 'layout2') {
            return view('business.settings_v2.index', $data);
        }
        $segment = $request->segment(2) ?: 'settings';

        $segmentMap = [
            'settings' => 'settings',
        ];
        $slug = $segmentMap[$segment] ?? $segment;

        $view = "business.$slug";

        if (! view()->exists($view)) {
            abort(404, "View [$view] not found");
        }

        return view($view, $data);
    }

    /**
     * Updates business settings
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postBusinessSettings(Request $request)
    {
        if (!auth()->user()->can('business_settings.access')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $notAllowed = $this->businessUtil->notAllowedInDemo();
            if (!empty($notAllowed)) {
                return $notAllowed;
            }

            $business_details = $request->only([
                'name',
                'start_date',
                'currency_id',
                'tax_label_1',
                'tax_number_1',
                'tax_label_2',
                'tax_number_2',
                'default_profit_percent',
                'default_sales_tax',
                'default_sales_discount',
                'sell_price_tax',
                'sku_prefix',
                'time_zone',
                'fy_start_month',
                'accounting_method',
                'transaction_edit_days',
                'sales_cmsn_agnt',
                'item_addition_method',
                'currency_symbol_placement',
                'on_product_expiry',
                'stop_selling_before',
                'default_unit',
                'expiry_type',
                'date_format',
                'time_format',
                'ref_no_prefixes',
                'theme_color',
                'email_settings',
                'sms_settings',
                'rp_name',
                'amount_for_unit_rp',
                'min_order_total_for_rp',
                'max_rp_per_order',
                'product_link_location',
                'redeem_amount_per_unit_rp',
                'min_order_total_for_redeem',
                'min_redeem_point',
                'max_redeem_point',
                'rp_expiry_period',
                'rp_expiry_type',
                'custom_labels',
                'weighing_scale_setting',
                'common_settings',
                'code_label_1',
                'code_1',
                'code_label_2',
                'code_2',
                'product_barcode_type',
                'enable_rp',
                'enable_tooltip',
                'theme_color',
                'logo',
                'currency_precision',
                'quantity_precision',
                'stock_expiry_alert_days',
                'enable_brand',
                'enable_category',
                'enable_sub_category',
                'enable_price_tax',
                'enable_racks',
                'enable_row',
                'enable_position',
                'enable_sub_units',
                'enable_product_image',
                'enable_product_description',
                'enable_preparation_time_in_minutes',
                'enable_inline_tax',
                'enable_purchase_status',
                'enable_lot_number',
                'ep_unit_cost_before_discount',
                'ep_sub_total',
                'ep_unit_selling_price',
                'ep_unit_cost_price_after_tax',
                'ep_payment_info',
                'ep_net_total_amount',
                'ep_discount',
                'ep_purchase_tax',
                'ep_additional_shipping_charges',
                'ep_purchase_total',
                'ep_shipping_details',
                'ep_unit_cost_price_before_tax',
                'ep_sub_total_before_tax',
                'ep_reference',
                'ep_pay_term',
                'ep_additional_expenses',
                'enable_editing_product_from_purchase',
                'es_unit_price',
                'es_sub_total',
                'es_net_total_amount',
                'es_additional_shipping_charges',
                'es_purchase_total',
                'es_approved_by',
                'enable_product_expiry',
                'enable_instant_pos'
            ]);


            $business_details['enable_rp'] = $request->input('enable_rp') == 1 ? 1 : 0;
            $business_details['enable_instant_pos'] = $request->input('enable_instant_pos') == 1 ? 1 : 0;

            // $business_details['amount_for_unit_rp'] = !empty($business_details['amount_for_unit_rp']) ? $this->businessUtil->num_uf($business_details['amount_for_unit_rp']) : 1;
            // $business_details['min_order_total_for_rp'] = !empty($business_details['min_order_total_for_rp']) ? $this->businessUtil->num_uf($business_details['min_order_total_for_rp']) : 1;
            // $business_details['redeem_amount_per_unit_rp'] = !empty($business_details['redeem_amount_per_unit_rp']) ? $this->businessUtil->num_uf($business_details['redeem_amount_per_unit_rp']) : 1;
            // $business_details['min_order_total_for_redeem'] = !empty($business_details['min_order_total_for_redeem']) ? $this->businessUtil->num_uf($business_details['min_order_total_for_redeem']) : 1;

            $business_details['default_profit_percent'] = !empty($business_details['default_profit_percent']) ? $this->businessUtil->num_uf($business_details['default_profit_percent']) : 0;

            $business_details['default_sales_discount'] = !empty($business_details['default_sales_discount']) ? $this->businessUtil->num_uf($business_details['default_sales_discount']) : 0;

            if (!empty($business_details['start_date'])) {
                $business_details['start_date'] = $this->businessUtil->uf_date($business_details['start_date']);
            }

            $business_details['enable_tooltip'] = $request->input('enable_tooltip') == 1 ? 1 : 0;

            //Check for Purchase currency
            if ($request->input('purchase_in_diff_currency') == 1) {
                $business_details['purchase_in_diff_currency'] = 1;
                $business_details['purchase_currency_id'] = $request->input('purchase_currency_id');
                $business_details['p_exchange_rate'] = $request->input('p_exchange_rate');
            } else {
                $business_details['purchase_in_diff_currency'] = 0;
                $business_details['purchase_currency_id'] = null;
                $business_details['p_exchange_rate'] = 1;
            }
            $business_id = request()->session()->get('user.business_id');
            $business = Business::where('id', $business_id)->first();

            // Upload light logo
            $logoLight = $this->businessUtil->uploadFile($request, 'business_logo_light', 'business_logos', 'image');

            // Upload dark logo
            $logoDark = $this->businessUtil->uploadFile($request, 'business_logo_dark', 'business_logos', 'image');

            if (!empty($logoLight) || !empty($logoDark)) {
                $logoData = json_decode($business->logo, true) ?? [];

                if (!empty($logoLight)) {
                    $logoData['light'] = $logoLight;
                }

                if (!empty($logoDark)) {
                    $logoData['dark'] = $logoDark;
                }
                $business_details['logo'] = json_encode($logoData);
            }

            if ($request->has('is_tax_setting')) {
                $checkboxes = [
                    'enable_inline_tax',
                ];
                foreach ($checkboxes as $value) {
                    $business_details[$value] = $request->input($value) == 1 ? 1 : 0;
                }
            }
            // STOCK TRANSFER
            if ($request->boolean('is_stock_transfer_setting')) {
                $sflags = [
                    'es_unit_price',
                    'es_sub_total',
                    'es_net_total_amount',
                    'es_additional_shipping_charges',
                    'es_purchase_total',
                    'es_approved_by',
                ];
                foreach ($sflags as $k) {
                    $business_details[$k] = $request->boolean($k) ? 1 : 0;
                }
            }
            if ($request->has('is_product_setting')) {
                $business_details['enable_product_expiry'] = $request->input('enable_product_expiry') == 1 ? 1 : 0;

                if (!empty($business_details['on_product_expiry']) && $business_details['on_product_expiry'] == 'keep_selling') {
                    $business_details['stop_selling_before'] = null;
                }

                $business_details['stock_expiry_alert_days'] = !empty($request->input('stock_expiry_alert_days')) ? $request->input('stock_expiry_alert_days') : 30;

                $checkboxes = [
                    'enable_brand',
                    'enable_category',
                    'enable_sub_category',
                    'enable_price_tax',
                    'enable_racks',
                    'enable_row',
                    'enable_position',
                    'enable_sub_units',
                    'enable_product_image',
                    'enable_product_description',
                    'enable_preparation_time_in_minutes',
                ];
                foreach ($checkboxes as $value) {
                    $business_details[$value] = $request->input($value) == 1 ? 1 : 0;
                }
            }
            if ($request->input('is_purchase_setting') == 1) {
                $checkboxes = [
                    'enable_editing_product_from_purchase',
                    'enable_purchase_status',
                    'enable_lot_number',
                    'ep_unit_cost_before_discount',
                    'ep_sub_total',
                    'ep_unit_selling_price',
                    'ep_unit_cost_price_after_tax',
                    'ep_payment_info',
                    'ep_net_total_amount',
                    'ep_discount',
                    'ep_purchase_tax',
                    'ep_additional_shipping_charges',
                    'ep_purchase_total',
                    'ep_shipping_details',
                    'ep_unit_cost_price_before_tax',
                    'ep_sub_total_before_tax',
                    'ep_reference',
                    'ep_pay_term',
                    'ep_additional_expenses',
                ];

                foreach ($checkboxes as $key) {
                    $business_details[$key] = $request->boolean($key) ? 1 : 0;
                }

                $existing_common = $business->common_settings ?? [];
                $incoming_common = $request->input('common_settings', []);

                $existing_common['enable_purchase_order'] =
                    !empty($incoming_common['enable_purchase_order']) ? 1 : 0;

                $existing_common['enable_purchase_requisition'] =
                    !empty($incoming_common['enable_purchase_requisition']) ? 1 : 0;

                $business_details['common_settings'] = $existing_common;
            }
            if ($request->input('is_pos_setting') == 1) {
                // code...
            }

            //Update business settings
            if (!empty($business_details['logo'])) {
                $business->logo = $business_details['logo'];
            } else {
                unset($business_details['logo']);
            }

            //System settings
            if ($request->has('shortcuts')) {
                $shortcuts = $request->input('shortcuts');
                $business_details['keyboard_shortcuts'] = json_encode($shortcuts);
            }


            $pre_busines_detail = $this->businessUtil->getDetails($business_id);

            $pre_pos_setting = json_decode(optional($pre_busines_detail)->pos_settings, true);
            if (!is_array($pre_pos_setting)) {
                $pre_pos_setting = [];
            }

            $incoming = $request->input('pos_settings', []);
            if (!is_array($incoming)) {
                $incoming = [];
            }
            $pos_bool_keys = [
                'enable_msp',
                'allow_overselling',
                'enable_sales_order',
                'is_pay_term_required',
                'is_commission_agent_required',
                'disable_pay_checkout',
                'disable_draft',
                'disable_express_checkout',
                'hide_product_suggestion',
                'hide_recent_trans',
                'disable_discount',
                'disable_order_tax',
                'is_pos_subtotal_editable',
                'disable_suspend',
                'enable_transaction_date',
                'inline_service_staff',
                'is_service_staff_required',
                'disable_credit_sale_button',
                'show_invoice_scheme',
                'show_invoice_layout',
                'print_on_suspend',
                'show_pricing_on_product_sugesstion',
                'show_product_qty',
                'show_price_check',
                'enable_weighing_scale',
                'disable_currency_exchange',
            ];

            foreach ($pos_bool_keys as $k) {
                if ($request->has("pos_settings.$k")) {
                    $incoming[$k] = $request->boolean("pos_settings.$k") ? "1" : "0";
                }
            }
            if ($request->has('pos_settings.amount_rounding_method')) {
                $incoming['amount_rounding_method'] = $request->filled('pos_settings.amount_rounding_method')
                    ? $request->input('pos_settings.amount_rounding_method')
                    : null;
            }

            $pos_settings = array_merge($pre_pos_setting, $incoming);

            for ($i = 1; $i <= 10; $i++) {
                $key       = "carousel_image_$i";
                $removeKey = "remove_$key";

                if ($request->boolean($removeKey)) {
                    if (!empty($pre_pos_setting[$key])) {
                       $disk = (new AppSettingsService)->storage_default_disk();
                        \Storage::disk($disk)->delete('carousel_images/' . $pre_pos_setting[$key]);
                    }
                    unset($pos_settings[$key]);
                    continue;
                }

                if ($request->hasFile($key)) {
                    if (!empty($pre_pos_setting[$key])) {
                        $disk = (new AppSettingsService)->storage_default_disk();
                        \Storage::disk($disk)->delete('carousel_images/' . $pre_pos_setting[$key]);
                    }
                    $pos_settings[$key] = $this->businessUtil->uploadFile($request, $key, 'carousel_images', 'image');
                    continue;
                }
            }

            // Ensure defaults exist
            foreach ((array) $this->businessUtil->defaultPosSettings() as $k => $v) {
                if (!array_key_exists($k, $pos_settings)) {
                    $pos_settings[$k] = $v;
                }
            }
            $business_details['pos_settings'] = json_encode($pos_settings);

            if ($request->has('dashboard_settings')) {
                //dashboard_settings
                $dashboard_settings = $request->input('dashboard_settings');
                $default_dashboard_settings = $this->businessUtil->defaultDashboardSettings();
                foreach ($default_dashboard_settings as $key => $value) {
                    if (!isset($dashboard_settings[$key])) {
                        $dashboard_settings[$key] = $value;
                    }
                }
                $business_details['dashboard_settings'] = json_encode($dashboard_settings);
            }
            if ($request->has('restaurant_settings')) {
                //restaurant_settings
                $restaurant_settings = $request->input('restaurant_settings');
                $default_restaurant_settings = $this->businessUtil->defaultRestaurantSettings();
                foreach ($default_restaurant_settings as $key => $value) {
                    if (!isset($restaurant_settings[$key])) {
                        $restaurant_settings[$key] = $value;
                    }
                }
                $business_details['restaurant_settings'] = json_encode($restaurant_settings);
            }

            if ($request->has('custom_labels')) {
                $business_details['custom_labels'] = json_encode($business_details['custom_labels']);
            }

            if ($request->has('common_settings')) {
                $business_details['common_settings'] = !empty($request->input('common_settings')) ? $request->input('common_settings') : [];
            }

            if ($request->boolean('is_modules_setting')) {
                $business_details['enabled_modules'] = $request->input('enabled_modules', []);
            }

            //Theme Colors
            if ($request->has('primary_color') && $request->has('secondary_color') && $request->has('body_color') && $request->has('sidebar_text_color')) {
                $business_details['theme_color'] = json_encode([
                    'primary'   => $request->input('primary_color'),
                    'secondary' => $request->input('secondary_color'),
                    'body_color' => $request->input('body_color'),
                    'sidebar_text_color' => $request->input('sidebar_text_color'),
                ]);
            }
            $business->fill($business_details);
            $business->save();
            //update session data
            $request->session()->put('business', $business);

            //Update Currency details
            $currency = Currency::find($business->currency_id);
            $request->session()->put('currency', [
                'id' => $currency->id,
                'code' => $currency->code,
                'symbol' => $currency->symbol,
                'thousand_separator' => $currency->thousand_separator,
                'decimal_separator' => $currency->decimal_separator,
            ]);

            //update current financial year to session
            $financial_year = $this->businessUtil->getCurrentFinancialYear($business->id);
            $request->session()->put('financial_year', $financial_year);

            //Flush Menus 
            MenuService::flushMenus();
            $output = [
                'success' => 1,
                'msg' => __('business.settings_updated_success'),
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
        return redirect()->back()->with('status', $output);
    }

    /**
     * Handles the validation email
     *
     * @return \Illuminate\Http\Response
     */
    public function postCheckEmail(Request $request)
    {
        $email = $request->input('email');
        $service = app(AppSettingsService::class);

        if (
            $service->temp_email_protection()
            && DisposableEmailRule::isDisposable($email)
        ) {
            echo json_encode(__('settings.disposable_not_allowed'));
            exit;
        }
        $query = User::where('email', $email);

        if (!empty($request->input('user_id'))) {
            $user_id = $request->input('user_id');
            $query->where('id', '!=', $user_id);
        }

        $exists = $query->exists();
        if (!$exists) {
            echo "true";
            exit;
        } else {
            echo "false";
            exit;
        }
    }

    public function getEcomSettings()
    {
        try {
            $api_token = request()->header('API-TOKEN');
            $api_settings = $this->moduleUtil->getApiSettings($api_token);

            $settings = Business::where('id', $api_settings->business_id)
                ->value('ecom_settings');

            $settings_array = !empty($settings) ? json_decode($settings, true) : [];

            if (!empty($settings_array['slides'])) {
                foreach ($settings_array['slides'] as $key => $value) {
                    $settings_array['slides'][$key]['image_url'] = !empty($value['image']) ? upload_asset('uploads/img/' . $value['image']) : '';
                }
            }
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            return $this->respondWentWrong($e);
        }

        return $this->respond($settings_array);
    }

    /**
     * Handles the testing of email configuration
     *
     * @return \Illuminate\Http\Response
     */
    public function testEmailConfiguration(Request $request)
    {
        try {
            $email_settings = $request->input();

            $data['email_settings'] = $email_settings;
            \Notification::route('mail', $email_settings['mail_from_address'])
                ->notify(new TestEmailNotification($data));

            $output = [
                'success' => 1,
                'msg' => __('lang_v1.email_tested_successfully'),
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            $output = [
                'success' => 0,
                'msg' => $e->getMessage(),
            ];
        }

        return $output;
    }

    /**
     * Handles the testing of sms configuration
     *
     * @return \Illuminate\Http\Response
     */
    public function testSmsConfiguration(Request $request)
    {
        try {
            $sms_settings = $request->input();

            $data = [
                'sms_settings' => $sms_settings,
                'mobile_number' => $sms_settings['test_number'],
                'sms_body' => 'This is a test SMS',
            ];
            if (! empty($sms_settings['test_number'])) {
                $response = $this->businessUtil->sendSms($data);
            } else {
                $response = __('lang_v1.test_number_is_required');
            }

            $output = [
                'success' => 1,
                'msg' => $response,
            ];
        } catch (\Exception $e) {
            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());
            $output = [
                'success' => 0,
                'msg' => $e->getMessage(),
            ];
        }

        return $output;
    }




    public function OnboardBusinessType() {}

    public function OnboardBusinessAPI(Request $request)
    {
        $validator = $request->validate([
            'first_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'business_type' => 'required',
            'contact_no' => 'required|max:11|min:11',
            'landmark' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
        ]);

        try {

            DB::beginTransaction();
            //code...
            $partner_id = $request->filled('partner_id') ? $request->partner_id : null;
            $referal_code = $request->filled('referal_code') ? $request->referal_code : null;

            $user = User::create([
                'first_name' => $request->first_name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => \Hash::make('password'),
                'contact_no' => "234" . substr($request->contact_no, 1),
                'agent_referal_code' => $referal_code,
                'partner_id' => $partner_id,
            ]);

            //MAke Modififcation to Business  Input

            $business_details = $request->only(['name', 'start_date', 'currency_id', 'time_zone']);

            $business_details['fy_start_month'] = 1;

            $business_details['start_date'] = date("m/d/Y");

            $business_details['currency_id'] = 2;
            $business_details['time_zone'] = "Asia/Karachi";

            $business_details['accounting_method'] = "fifo";

            //Make Modification to Location Input
            $business_location = $request->only(['name', 'country', 'state', 'city', 'landmark', 'website', 'mobile', 'alternate_number']);

            $business_location['country'] = "Nigeria";

            $business_location['zip_code'] = "000000";

            //Create the business
            $business_details['owner_id'] = $user->id;
            if (!empty($business_details['start_date'])) {
                $business_details['start_date'] = Carbon::createFromFormat(config('constants.default_date_format'), $business_details['start_date'])->toDateString();
            }

            //default enabled modules
            $business_details['enabled_modules'] = ['purchases', 'add_sale', 'pos_sale', 'stock_transfers', 'stock_adjustment', 'expenses'];

            $business = $this->businessUtil->createNewBusiness($business_details);

            //Update user with business id
            $user->business_id = $business->id;
            $user->username = $request->username;
            $user->save();

            //Board Business To BardPOS
            BusinessType::create([
                'business_id' => $business->id,
                'business_type' => $request->business_type,
                'sms_verification' => 1,
                'user_id' => $user->id,
            ]);

            $this->businessUtil->newBusinessDefaultResources($business->id, $user->id);
            $new_location = $this->businessUtil->addLocation($business->id, $business_location);

            //create new permission with the new location
            Permission::create(['name' => 'location.' . $new_location->id]);
            DB::commit();

            //Module function to be called after after business is created
            if (config('app.env') != 'demo') {
                $this->moduleUtil->getModuleData('after_business_created', ['business' => $business]);
            }

            //Process payment information if superadmin is installed & package information is present
            $is_installed_superadmin = $this->moduleUtil->isSuperadminInstalled();
            $package_id = $request->get('package_id', null);
            if ($is_installed_superadmin && !empty($package_id) && (config('app.env') != 'demo')) {
                $package = \Modules\Superadmin\Entities\Package::find($package_id);
                if (!empty($package)) {
                    Auth::login($user);
                    return redirect()->route('register-pay', ['package_id' => $package_id]);
                }
            }

            return [
                'status' => true,
                'message' => 'Business Created Successfully',
                'data' => [
                    'business_id' => $business->id,
                    'users' => $user,
                    'business' => $business,
                    'request_payload' => $request->all(),
                ],
            ];
        } catch (\Throwable $e) {
            //throw $th;
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            return [
                'status' => false,
                'message' => 'Business Creation Failed',
            ];
        }
    }

    public function OnboardBusiness(Request $request)
    {

        $validator = $request->validate(
            [
                'name' => 'required|max:255',
                'state' => 'required|max:255',
                'city' => 'required|max:255',
                'country' => 'required',
                'landmark' => 'required|max:255',

            ]
        );

        try {
            //code...
            if (Auth::user()) { // Check is user logged in

                $user = User::where('id', Auth::user()->id)->first();

                DB::beginTransaction();

                //MAke Modififcation to Business  Input

                $business_details = $request->only(['name', 'start_date', 'currency_id', 'time_zone']);

                $business_details['fy_start_month'] = 1;

                $business_details['start_date'] = date("m/d/Y");

                $business_details['time_zone'] = "Asia/Karachi";

                $business_details['accounting_method'] = "fifo";

                //Make Modification to Location Input
                $business_location = $request->only(['name', 'country', 'state', 'city', 'landmark', 'website', 'mobile', 'alternate_number']);

                $business_location['zip_code'] = "000000";

                //Create the business
                $business_details['owner_id'] = $user->id;
                if (!empty($business_details['start_date'])) {
                    $business_details['start_date'] = Carbon::createFromFormat(config('constants.default_date_format'), $business_details['start_date'])->toDateString();
                }

                //default enabled modules
                $business_details['enabled_modules'] = ['purchases', 'add_sale', 'pos_sale', 'stock_transfers', 'stock_adjustment', 'expenses'];

                $business = $this->businessUtil->createNewBusiness($business_details);

                //Update user with business id
                $user->business_id = $business->id;
                $user->save();

                $this->businessUtil->newBusinessDefaultResources($business->id, $user->id);
                $new_location = $this->businessUtil->addLocation($business->id, $business_location);

                //create new permission with the new location
                Permission::create(['name' => 'location.' . $new_location->id]);
                DB::commit();

                //Module function to be called after after business is created
                if (config('app.env') != 'demo') {
                    $this->moduleUtil->getModuleData('after_business_created', ['business' => $business]);
                }

                //Process payment information if superadmin is installed & package information is present
                $is_installed_superadmin = $this->moduleUtil->isSuperadminInstalled();
                $package_id = $user->registration_package_id;
                if ($is_installed_superadmin && !empty($package_id) && (config('app.env') != 'demo')) {
                    $package = \Modules\Superadmin\Entities\Package::find($package_id);
                    if (!empty($package)) {
                        Auth::login($user);
                        return redirect()->route('register-pay', ['package_id' => $package_id]);
                    }
                }

                $output = [
                    'success' => 1,
                    'msg' => __('business.business_created_succesfully'),
                ];

                return redirect('home')->with('status', $output);
            } else {
                return [
                    'status' => false,
                    'message' => 'Not Authorized',
                ];
            }
        } catch (\Throwable $e) {
            //throw $th;
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];

            return back()->with('status', $output)->withInput();
        }
    }


    /**
     * Get states list for a country.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getStates(Request $request)
    {
        if (!empty($request->input('country_id'))) {
            $country = $request->input('country_id');
            $country_id = Country::where('name', $country)->first(['id']);
            $states = State::where('country_id', $country_id->id)
                ->select(['name', 'id'])
                ->get();
            $html = '<option value="">None</option>';
            if (!empty($states)) {
                foreach ($states as $state) {
                    $html .= '<option value="' . $state->name . '">' . $state->name . '</option>';
                }
            }
            echo $html;
            exit;
        }
    }
}
