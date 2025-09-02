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
    </div>
    <button class="item display-mobile-only" id="menuBtn">
        <img src="{{ asset('img/icons/menu-flex.svg?v=' . $asset_v) }}" alt="">
    </button>
    <div class="top-right pull-right">

        <div class="topbar-sub-menu-wrap" id="homeSubMenu">
            <div class="topbar-sub-menu">

                @if($is_mobile)

                <div class="form-check form-switch dark-mode-button pull-right mobile-toggle">

                    <input class="form-check-input" type="checkbox" id="dark-mode-toggle">
                    <label class="form-check-label" for="dark-mode-toggle">
                        <span class="toggle-icon sun-icon">☀️</span>
                        <span class="toggle-icon moon-icon">🌙</span>
                    </label>
                </div>
                <a class="sub-menu-link">
                    <img src="{{ asset('img/icons/theme.svg?v=' . $asset_v) }}" style="width: 15px; height:15px" alt="">
                    <span>@lang('lang_v1.theme')</span>

                </a>
                @endif
            </div>
        </div>


        @if(!$is_mobile)
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="dark-mode-toggle">
            <label class="form-check-label" for="dark-mode-toggle">
                <span class="toggle-icon sun-icon">☀️</span>
                <span class="toggle-icon moon-icon">🌙</span>
            </label>
        </div>
        @endif

        <div class="options">
            @if($is_mobile)
            <button class="item" onclick="toggleHomeMenu(event)">
                <img src="{{ asset('img/icons/plus-circle.svg?v=' . $asset_v) }}" alt="" width="35px">
            </button>
            @endif
            <button class="item notification__icon__wrapper load_notifications" onclick="notificationOpen(event)" id="show_unread_notifications">
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
                <a href="{{action([\Modules\Crm\Http\Controllers\ManageProfileController::class, 'getProfile'])}}" class="sub-menu-link">
                    <img src="{{ asset('img/icons/profile-icon.svg?v=' . $asset_v) }}" alt="">
                    <span>@lang('lang_v1.profile')</span>
                </a>

                <a href="{{action('Auth\LoginController@logout')}}" class="sub-menu-link">
                    <img src="{{ asset('img/icons/log-out-04.svg?v=' . $asset_v) }}" alt="" width="14px">
                    <span>@lang('lang_v1.sign_out')</span>
                </a>

            </div>
        </div>
        <!-- End of Submenu -->

        @include('layouts.partials.header-notifications')

    </div>

</div>