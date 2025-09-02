@extends('layouts.app')
@section('title', __('business.business_settings'))

@section('content')

<div class="main-container no-print">

    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.setting', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('lang_v1.reward_point_settings')</h1>
                <p>@lang('business.settings')</p>
            </div>

            <div class="filter">

            </div>
        </div>
        <div class="content">
            {!! Form::open(['url' => action('BusinessController@postBusinessSettings'), 'method' => 'post', 'id' => 'bussiness_edit_form',
            'files' => true ]) !!}
            <div class="pos-tab-content">
                <div class="row well">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                                <label class="switch">
                                    <input type="checkbox" id="enable_rp_checkbox" {{ !empty($business->enable_rp) ? 'checked' : '' }} onchange="updateEnableRpValue()">
                                    <span class="sliderCheckbox round"></span>
                                </label>
                                <p>{{ __( 'lang_v1.enable_rp' ) }}</p>
                            </div>
                            <input type="hidden" name="enable_rp" id="enable_rp" value="{{ !empty($business->enable_rp) ? 1 : 0 }}">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('rp_name', __('lang_v1.rp_name') . ':') !!}
                            {!! Form::text('rp_name', $business->rp_name, ['class' => 'form-control','placeholder' => __('lang_v1.rp_name')]); !!}
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <h4>@lang('lang_v1.earning_points_setting'):</h4>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('amount_for_unit_rp', __('lang_v1.amount_for_unit_rp') . ':') !!} @show_tooltip(__('lang_v1.amount_for_unit_rp_tooltip'))
                            {!! Form::text( 'amount_for_unit_rp', number_format((float) $business->amount_for_unit_rp, 2, '.', ''), ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.amount_for_unit_rp')]) !!}

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('min_order_total_for_rp', __('lang_v1.min_order_total_for_rp') . ':') !!} @show_tooltip(__('lang_v1.min_order_total_for_rp_tooltip'))
                            {!! Form::text('min_order_total_for_rp', number_format((float) $business->min_order_total_for_rp, 2, '.', ''), ['class' => 'form-control', 'placeholder' => __('lang_v1.min_order_total_for_rp')]) !!}

                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('max_rp_per_order', __('lang_v1.max_rp_per_order') . ':') !!} @show_tooltip(__('lang_v1.max_rp_per_order_tooltip'))
                            {!! Form::number('max_rp_per_order', $business->max_rp_per_order, ['class' => 'form-control','placeholder' => __('lang_v1.max_rp_per_order')]); !!}
                        </div>
                    </div>
                </div>
                <div class="row well">
                    <div class="col-sm-12">
                        <h4>@lang('lang_v1.redeem_points_setting'):</h4>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('redeem_amount_per_unit_rp', __('lang_v1.redeem_amount_per_unit_rp') . ':') !!} @show_tooltip(__('lang_v1.redeem_amount_per_unit_rp_tooltip'))
                            {!! Form::text('redeem_amount_per_unit_rp', number_format((float) $business->redeem_amount_per_unit_rp, 2, '.', ''), ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.redeem_amount_per_unit_rp')]) !!}

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('min_order_total_for_redeem', __('lang_v1.min_order_total_for_redeem') . ':') !!} @show_tooltip(__('lang_v1.min_order_total_for_redeem_tooltip'))
                            {!! Form::text('min_order_total_for_redeem', number_format((float) $business->min_order_total_for_redeem, 2, '.', ''), ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.min_order_total_for_redeem')]) !!}

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('min_redeem_point', __('lang_v1.min_redeem_point') . ':') !!} @show_tooltip(__('lang_v1.min_redeem_point_tooltip'))
                            {!! Form::number('min_redeem_point', $business->min_redeem_point, ['class' => 'form-control','placeholder' => __('lang_v1.min_redeem_point')]); !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('max_redeem_point', __('lang_v1.max_redeem_point') . ':') !!} @show_tooltip(__('lang_v1.max_redeem_point_tooltip'))
                            {!! Form::number('max_redeem_point', $business->max_redeem_point, ['class' => 'form-control', 'placeholder' => __('lang_v1.max_redeem_point')]); !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {!! Form::label('rp_expiry_period', __('lang_v1.rp_expiry_period') . ':') !!} @show_tooltip(__('lang_v1.rp_expiry_period_tooltip'))
                            <div class="input-group">
                                {!! Form::number('rp_expiry_period', $business->rp_expiry_period, ['class' => 'form-control','placeholder' => __('lang_v1.rp_expiry_period')]); !!}
                                <span class="input-group-addon">-</span>
                                {!! Form::select('rp_expiry_type', ['month' => __('lang_v1.month'), 'year' => __('lang_v1.year')], $business->rp_expiry_type, ['class' => 'form-control']); !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-danger pull-right" type="submit">@lang('business.update_settings')</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

</div>

<script>
    function updateEnableRpValue() {
        const checkbox = document.getElementById('enable_rp_checkbox');
        const hiddenInput = document.getElementById('enable_rp');
        hiddenInput.value = checkbox.checked ? 1 : 0;
    }
</script>

@endsection