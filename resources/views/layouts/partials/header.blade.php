@inject('request', 'Illuminate\Http\Request')
<!-- Main Header -->
@php
    $is_mobile = isMobile();
@endphp

<div class="topbar no-print">

    <button id="menu-btn" style="display: none;">
        Menu
    </button>
    <div class="welcome-message">
        @php
            $is_custom_topbar = ($sidebar_layout === 'custom' && $custom_sidebar_type === 'topbar');
        @endphp
        @if ($is_custom_topbar)
            <div style="margin-left: 3.188rem;">
                @include('layouts.partials.logo')
            </div>
        @else
        <button id="toggle-sidebar" class="toggle-sidebar">
            <img src="{{ asset('img/icons/menu-flex.svg?v=' . $asset_v) }}" alt="">
        </button>
        {{-- @if (Module::has('Superadmin'))
            @includeIf('superadmin::layouts.partials.active_subscription')
        @endif --}}
    @endif
        @if (!empty(session('previous_user_id')) && !empty(session('previous_username')))
            <a href="{{ route('sign-in-as-user', session('previous_user_id')) }}"
                class="btn btn-round btn-danger m-8 btn-sm mt-10"><i class="fas fa-undo"></i> @lang('lang_v1.back_to_username', ['username' => session('previous_username')])</a>
        @endif
    </div>

    <button class="item display-mobile-only" id="menuBtn">
        <img src="{{ asset('img/icons/menu-flex.svg?v=' . $asset_v) }}" alt="">
    </button>

    <div class="top-right pull-right">
        <!-- Pos Button -->
        <div class="topbar-sub-menu-wrap" id="homeSubMenu">
            <div class="topbar-sub-menu">

                @if (Module::has('Essentials'))
                    @includeIf('essentials::layouts.partials.header_part')
                @endif
                @if (Module::has('Repair'))
                    @includeIf('repair::layouts.partials.header')
                @endif
                <a href="{{ route('calendar') }}" class="sub-menu-link">
                    <img src="{{ asset('img/icons/calender.svg?v=' . $asset_v) }}" width="15px" alt="">
                    <span>@lang('lang_v1.calendar')</span>
                </a>

                @if (Module::has('Essentials'))
                    <a class="btn btn-modal sub-menu-link" href="#"
                        data-href="{{ action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'create']) }}"
                        data-container="#task_modal" role="menuitem" tabindex="-1">
                        <img src="{{ asset('img/icons/todo.svg?v=' . $asset_v) }}" width="15px" alt="">
                        <span>@lang('essentials::lang.add_to_do')</span>
                    </a>
                @endif

                @if ($is_mobile)
                    <div class="form-check form-switch dark-mode-button pull-right mobile-toggle">

                        <input class="form-check-input" type="checkbox" id="dark-mode-toggle">
                        <label class="form-check-label" for="dark-mode-toggle">
                            <span class="toggle-icon sun-icon">☀️</span>
                            <span class="toggle-icon moon-icon">🌙</span>
                        </label>
                    </div>
                    <a class="sub-menu-link">
                        <img src="{{ asset('img/icons/theme.svg?v=' . $asset_v) }}" style="width: 15px; height:15px"
                            alt="">
                        <span>@lang('lang_v1.theme')</span>
                    </a>
                @endif
            </div>
        </div>
            @if (!$is_mobile)
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="dark-mode-toggle">
                        <label class="form-check-label" for="dark-mode-toggle">
                            <span class="toggle-icon sun-icon">☀️</span>
                            <span class="toggle-icon moon-icon">🌙</span>
                        </label>
                    </div>
                @endif
        @if (in_array('pos_sale', $enabled_modules))
            @can('sell.create')
                <a href="{{ action('SellPosController@create') }}" title="@lang('sale.pos_sale')" data-toggle="tooltip"
                    data-placement="bottom" class="pos">
                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15 21.5V16.1C15 15.5399 15 15.2599 14.891 15.046C14.7951 14.8578 14.6422 14.7049 14.454 14.609C14.2401 14.5 13.9601 14.5 13.4 14.5H10.6C10.0399 14.5 9.75992 14.5 9.54601 14.609C9.35785 14.7049 9.20487 14.8578 9.10899 15.046C9 15.2599 9 15.5399 9 16.1V21.5M3 7.5C3 9.15685 4.34315 10.5 6 10.5C7.65685 10.5 9 9.15685 9 7.5C9 9.15685 10.3431 10.5 12 10.5C13.6569 10.5 15 9.15685 15 7.5C15 9.15685 16.3431 10.5 18 10.5C19.6569 10.5 21 9.15685 21 7.5M6.2 21.5H17.8C18.9201 21.5 19.4802 21.5 19.908 21.282C20.2843 21.0903 20.5903 20.7843 20.782 20.408C21 19.9802 21 19.4201 21 18.3V6.7C21 5.5799 21 5.01984 20.782 4.59202C20.5903 4.21569 20.2843 3.90973 19.908 3.71799C19.4802 3.5 18.9201 3.5 17.8 3.5H6.2C5.0799 3.5 4.51984 3.5 4.09202 3.71799C3.71569 3.90973 3.40973 4.21569 3.21799 4.59202C3 5.01984 3 5.57989 3 6.7V18.3C3 19.4201 3 19.9802 3.21799 20.408C3.40973 20.7843 3.71569 21.0903 4.09202 21.282C4.51984 21.5 5.07989 21.5 6.2 21.5Z"
                            stroke="#fff" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span>@lang('lang_v1.pos')</span>
                </a>
            @endcan
        @endif

        <div class="options">
            @if(!empty($app_settings->header_language_change) && $app_settings->header_language_change === true)
            @include('layouts.partials.lang_dropdown')
            @endif  
            <button class="item" onclick="toggleHomeMenu(event)">
                <img src="{{ asset('img/icons/plus-circle.svg?v=' . $asset_v) }}" alt="" width="35px">
            </button>
            <button class="item notification__icon__wrapper load_notifications" onclick="notificationOpen(event)"
                id="show_unread_notifications">
                <img src="{{ asset('img/icons/notification.svg?v=' . $asset_v) }}" alt="">
                <div class="notification__count">{{ auth()->user()->unreadNotifications->count() }}</div>
            </button>

            <button class="item" onclick="toggleMenu(event)">
                <img src="{{ asset('img/icons/user-profile.png?v=' . $asset_v) }}" alt="" width="35px">

            </button>
        </div>

        <!-- Sub Menu -->
        <div class="topbar-sub-menu-wrap" id="subMenu">
            <div class="topbar-sub-menu">
                <a href="{{ action('UserController@getProfile') }}" class="sub-menu-link">
                    <img src="{{ asset('img/icons/profile-icon.svg?v=' . $asset_v) }}" alt="">
                    <span>@lang('lang_v1.profile')</span>
                </a>
                @canany('user.view', 'user.create', 'roles.view')
                    <a href="{{ action('ManageUserController@index') }}" class="sub-menu-link">
                        <img src="{{ asset('img/icons/user-role.svg?v=' . $asset_v) }}" alt="">
                        <span>@lang('user.user_management')</span>
                    </a>
                @endcanany

                @if (auth()->user()->can('business_settings.access'))
                    <a href="{{ action('BusinessLocationController@index') }}" class="sub-menu-link">
                        <img src="{{ asset('img/icons/business-location.svg') }}" alt="">
                        <span>@lang('business.business_locations')</span>
                    </a>
                @endif
                @canany(['tax_rate.view', 'tax_rate.create'])
                    <a href="{{ action('TaxRateController@index') }}" class="sub-menu-link">
                        <img src="{{ asset('img/icons/tax.svg?v=' . $asset_v) }}" alt="">
                        <span>@lang('tax_rate.tax_rates')</span>
                    </a>
                @endcanany

                @php
                $is_superadmin = auth()->user()->can('superadmin');
                @endphp
                 @if ($is_superadmin)
                <a href="{{ route('app.settings.index') }}" class="sub-menu-link">
                    <img src="{{ asset('img/icons/settings.svg?v=' . $asset_v) }}" alt="" width="14px">
                    <span>@lang('settings.app_settings')</span>
                </a>
                @endif
                @if (auth()->user()->can('business_settings.access') ||
                        auth()->user()->can('barcode_settings.access') ||
                        auth()->user()->can('invoice_settings.access') ||
                        auth()->user()->can('tax_rate.view') ||
                        auth()->user()->can('tax_rate.create'))
                    <a href="{{ action('BusinessController@getSettings') }}" class="sub-menu-link">
                        <img src="{{ asset('img/icons/settings.svg?v=' . $asset_v) }}" alt="" width="14px">
                        <span>@lang('lang_v1.settings')</span>
                    </a>
                    <a href="{{ url('business/modules-settings') }}" class="sub-menu-link">
                        <img src="{{ asset('img/icons/modules-settings.png?v=' . $asset_v) }}" alt="">
                        <span>@lang('lang_v1.modules')</span>
                    </a>
                @endif

                @if ($is_superadmin)
                    <a href="{{ url('/manage-modules') }}" class="sub-menu-link">
                        <img src="{{ asset('img/icons/modules-settings.png?v=' . $asset_v) }}" alt="">
                        <span>@lang('lang_v1.premium_modules')</span>
                    </a>
                @endif

                @if (in_array('types_of_service', $enabled_modules) && auth()->user()->can('access_types_of_service'))
                    <a href="{{ action('TypesOfServiceController@index') }}" class="sub-menu-link">
                        <img src="{{ asset('img/icons/modules-settings.png?v=' . $asset_v) }}" alt="">
                        <span>@lang('lang_v1.types_of_service')</span>
                    </a>
                @endif
                @if (in_array('modifiers', $enabled_modules) &&
                        (auth()->user()->can('product.view') || auth()->user()->can('product.create')))
                    <a href="{{ action('Restaurant\ModifierSetsController@index') }}" class="sub-menu-link">
                        <img src="{{ asset('img/icons/modules-settings.png?v=' . $asset_v) }}" alt="">
                        <span>@lang('restaurant.modifiers')</span>
                    </a>
                @endif
                @if (Module::has('Superadmin'))
                    @if (auth()->user()->can('access_package_subscriptions'))
                        <a href="{{ url('subscription') }}" class="sub-menu-link">
                            <img src="{{ asset('img/icons/subscription-payment.svg?v=' . $asset_v) }}"
                                alt="">
                            <span>@lang('lang_v1.subscription')</span>
                        </a>
                    @endif
                @endif
                @php
                    $is_admin = auth()
                        ->user()
                        ->hasRole('Admin#' . session('business.id'))
                        ? true
                        : false;
                @endphp
                @if ($is_admin)
                    <a href="{{ action('ReportController@activityLog') }}" class="sub-menu-link">
                        <img src="{{ asset('img/icons/activity-log.svg?v=' . $asset_v) }}" alt="">
                        <span>@lang('lang_v1.activity_log')</span>
                    </a>
                @endif

                <a href="{{ action('Auth\LoginController@logout') }}" class="sub-menu-link">
                    <img src="{{ asset('img/icons/log-out-04.svg?v=' . $asset_v) }}" alt="" width="14px">
                    <span>@lang('lang_v1.sign_out')</span>
                </a>

            </div>
        </div>
        <!-- End of Submenu -->

        @include('layouts.partials.header-notifications')

    </div>
</div>
