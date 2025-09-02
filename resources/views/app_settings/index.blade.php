@extends('layouts.app')
@section('title', __('settings.app_settings'))


@section('content')
<style>
    .secondary-color-icon {
        color: var(--secondary-color) !important
    }
</style>
<div class="main-container no-print">
    <!-- Sub Menu (optional) -->
    <div class="horizontal-scroll">
        <div class="storys-container">
            @include('layouts.partials.sub_menu.app_settings', ['link_class' => 'sub-menu-item'])
        </div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter Section -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('settings.app_settings')</h1>
                <p>@lang('settings.manage_app_settings')</p>
            </div>
            <div class="filter">

            </div>
        </div>
        <section class="content settings">
            @include('layouts.partials.search_settings')
            <div class="clearfix"></div>
            <hr>
            {!! Form::open(['url' => route('app.settings.update'), 'method' => 'POST', 'id' => 'app_settings_form',
            'files' => true]) !!}
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-xs-12 pos-tab-container tabs">
                        <!-- Left side menu -->
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pos-tab-menu">
                            <div class="list-group">
                                <a href="#" class="list-group-item active" data-target="#tab_2fa">
                                    <i class="secondary-color-icon fa fa-shield-alt"></i> @lang('settings.tab_2fa')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_theme">
                                    <i class="secondary-color-icon fa fa-palette"></i> @lang('settings.tab_theme')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_login_page">
                                    <i class="secondary-color-icon fa fa-sign-in-alt"></i>
                                    @lang('settings.tab_login_page')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_sidebar">
                                    <i class="secondary-color-icon fa fa-bars"></i> @lang('settings.tab_sidebar')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_language">
                                    <i class="secondary-color-icon fa fa-language"></i> @lang('settings.tab_language')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_repair_status">
                                    <i class="secondary-color-icon fa fa-wrench"></i>
                                    @lang('settings.tab_repair_status')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_logo">
                                    <i class="secondary-color-icon fa fa-image"></i> @lang('settings.tab_logo')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_fonts">
                                    <i class="secondary-color-icon fa fa-font"></i> @lang('settings.tab_fonts')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_recaptcha">
                                    <i class="secondary-color-icon fa fa-shield-alt"></i>
                                    @lang('settings.tab_recaptcha')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_social">
                                    <i class="secondary-color-icon fas fa-share-alt"></i> @lang('settings.tab_social')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_login_security">
                                    <i class="secondary-color-icon fa fa-user-lock"></i>
                                    @lang('settings.tab_login_security')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_maintenance_mode">
                                    <i class="secondary-color-icon fa fa-tools"></i>
                                    @lang('settings.tab_maintenance_mode')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_pos">
                                    <i class="secondary-color-icon fa fa-cash-register"></i>
                                    @lang('settings.tab_pos')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_business_settings">
                                    <i class="secondary-color-icon fa fa-cogs secondary-color" style=""></i>
                                    @lang('settings.tab_business_settings')
                                </a>
                                <a href="#" class="list-group-item" data-target="#tab_storage_settings">
                                    <i class="secondary-color-icon fa fa-database secondary-color"></i>
                                    @lang('settings.tab_storage_settings')
                                </a>
                            </div>
                        </div>

                        <!-- Right side tab content -->
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 pos-tab tab-content-wrapper">
                            <!-- Tab 2FA -->
                            <div class="pos-tab-content active" id="tab_2fa">
                                @include('app_settings.partials.2fa')
                            </div>
                            <!-- Tab Theme -->
                            <div class="pos-tab-content" id="tab_theme">
                                @include('app_settings.partials.theme')
                            </div>
                            <!-- Tab Login Page -->
                            <div class="pos-tab-content" id="tab_login_page">
                                @include('app_settings.partials.login_page')
                            </div>
                            <!-- Tab Sidebar -->
                            <div class="pos-tab-content" id="tab_sidebar">
                                @include('app_settings.partials.sidebar')
                            </div>
                            <!-- Tab Logo -->
                            <div class="pos-tab-content" id="tab_logo">
                                @include('app_settings.partials.logo')
                            </div>
                            <!-- Tab Language -->
                            <div class="pos-tab-content" id="tab_language">
                                @include('app_settings.partials.language')
                            </div>
                            <!-- Tab Fonts-->
                            <div class="pos-tab-content" id="tab_fonts">
                                @include('app_settings.partials.fonts')
                            </div>
                            <!-- Google Recaptcha -->
                            <div class="pos-tab-content" id="tab_recaptcha">
                                @include('app_settings.partials.google_recaptcha')
                            </div>
                            <div class="pos-tab-content" id="tab_social">
                                @include('app_settings.partials.social_logins')
                            </div>
                            <div class="pos-tab-content" id="tab_login_security">
                                @include('app_settings.partials.login_security')
                            </div>
                            <div class="pos-tab-content" id="tab_maintenance_mode">
                                @include('app_settings.partials.maintenance_mode')
                            </div>
                            <!-- Tab Repair Status -->
                            <div class="pos-tab-content" id="tab_repair_status">
                                @include('app_settings.partials.repair_status')
                            </div>
                            <!-- Tab POS -->
                            <div class="pos-tab-content" id="tab_pos">
                                @include('app_settings.partials.pos')
                            </div>
                            <!--Business Settings-->
                            <div class="pos-tab-content" id="tab_business_settings">
                                @include('app_settings.partials.business_settings')
                            </div>
                            <div class="pos-tab-content" id="tab_storage_settings">
                                @include('app_settings.partials.storage')
                            </div>
                        </div>
                    </div>
                    <!-- end pos-tab-container -->
                </div>
            </div>

            <!-- Save Button -->
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button class="btn btn-primary btn-big save-btn" type="submit">
                        <i class="fa fa-save"></i> @lang('settings.update_settings')
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </section>
    </div>
</div>
@stop

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('.pos-tab-menu .list-group a').click(function(e){
            e.preventDefault();
            $('.pos-tab-menu .list-group a').removeClass('active');
            $(this).addClass('active');
            $('.pos-tab .pos-tab-content').removeClass('active');
            let target = $(this).data('target');
            $(target).addClass('active');
        });

        __page_leave_confirmation('#app_settings_form');
        //Recaptcha
        (function(){
    var $enable = $('#google_recaptcha_enable');
    var $key = $('input[name="google_recaptcha[google_recaptcha_key]"]');
    var $secret = $('input[name="google_recaptcha[google_recaptcha_secret]"]');

    function toggle_required(){
        var is_enabled = $enable.is(':checked');
        $key.prop('required', is_enabled);
        $secret.prop('required', is_enabled);
    }

    toggle_required();
    $enable.on('change', toggle_required);
})();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var sidebar_layout        = document.getElementById('sidebar_layout');
    var sidebar_dropdown_wrap = document.querySelector('.sidebar-dropdown-wrapper');
    var custom_type_wrap      = document.querySelector('.custom-sidebar-type-wrapper');

    function toggle_sidebar_fields() {
        var layout = sidebar_layout.value;
        sidebar_dropdown_wrap.style.display = (layout === 'layout1') ? '' : 'none';
        custom_type_wrap.style.display = (layout === 'custom') ? '' : 'none';
    }

    toggle_sidebar_fields();
    sidebar_layout.addEventListener('change', toggle_sidebar_fields);
});
</script>

@endsection