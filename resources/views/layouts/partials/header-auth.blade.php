@inject('request', 'Illuminate\Http\Request')

<div class="header-auth">
	<!-- Language changer -->

	<div class="header-left">
		@include('layouts.partials.language_btn')

	</div>
	<div class="header-right">
		<div class="pull-right text-white">
			@if(!($request->segment(1) == 'business' && $request->segment(2) == 'register'))

			<!-- Register Url -->
			@if(config('constants.allow_registration'))
			@if (!($request->segment(1) == 'login'))
			<a href="{{ route('business.getRegister') }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif" class="btn btn-header-auth margin">{{ __('business.register') }}</a>
			@endif
			<!-- pricing url -->
			@if(Route::has('pricing') && config('app.env') != 'demo' && $request->segment(1) != 'pricing')
			<a href="{{ action('\Modules\Superadmin\Http\Controllers\PricingController@index') }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif " class="btn btn-header-auth margin">@lang('superadmin::lang.pricing')</a>
			@endif
			@endif
			@endif

			@if(!($request->is('/') || $request->segment(1) == 'login'))
			<a href="{{ action('Auth\LoginController@login') }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif" class="btn btn-header-auth margin">{{ __('business.sign_in') }}</a>
			@endif
			@if(config('constants.SHOW_REPAIR_STATUS_LOGIN_SCREEN') && Route::has('repair-status'))
			<a href="{{ action([\Modules\Repair\Http\Controllers\CustomerRepairStatusController::class, 'index']) }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif" class="btn btn-header-auth margin">
				@lang('repair::lang.repair_status')
			</a>
			@endif
			@if(Route::has('member_scanner'))
			<a class="btn btn-header-auth margin"
				href="{{ action([\Modules\Gym\Http\Controllers\MemberController::class, 'member_scanner']) }}">
				@lang('gym::lang.gym_member_profile')
			</a>
		@endif
		</div>
	</div>
	<div class="pull-right text-white header-auth-mobile">
		<!-- Menu button for small screens -->
		<div class="menu-button">
			<div class="hamburger-icon">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>

		<!-- Dropdown menu -->
		<div class="dropdown-menu">
			@if(!($request->is('/') || $request->segment(1) == 'login'))
    <a href="{{ action('Auth\LoginController@login') }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif">
        {{ __('business.sign_in') }}
    </a>
@endif

			@if(!($request->segment(1) == 'business' && $request->segment(2) == 'register'))
			<!-- Register Url -->
			@if(config('constants.allow_registration'))
			@if (!($request->segment(1) == 'login'))
			<a href="{{ route('business.getRegister') }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif"> {{ __('business.register') }}</a>
			@endif
			<!-- pricing url -->
			@if(Route::has('pricing') && config('app.env') != 'demo' && $request->segment(1) != 'pricing')
			<a href="{{ action('\Modules\Superadmin\Http\Controllers\PricingController@index') }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif">@lang('superadmin::lang.pricing')</a>
			@endif
			@endif
			@endif
			
			@if($app_settings && $app_settings->show_repair_status_login_screen && Route::has('repair-status'))
			<a href="{{ action([\Modules\Repair\Http\Controllers\CustomerRepairStatusController::class, 'index']) }}@if(!empty(request()->lang)){{ '?lang=' . request()->lang }}@endif">
				@lang('repair::lang.repair_status')
			</a>
		@endif
		
			
		</div>
	</div>
</div>