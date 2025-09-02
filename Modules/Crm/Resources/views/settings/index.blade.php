@extends('layouts.app')
@section('title', __('messages.settings'))
@section('content')
<div class="main-container">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
       @include('crm::layouts.nav')
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('messages.settings')</h1>
                <p>{{__('crm::lang.crm')}}</p>
            </div>

        </div>
        <!-- End of Filter through table -->

                       <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(['url' => action('\Modules\Crm\Http\Controllers\CrmSettingsController@updateSettings'), 'method' => 'post']) !!}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <p>@lang('crm::lang.enable_order_request') @show_tooltip(__('crm::lang.enable_order_request_help'))</p>
                                <div class="toggle-wrapper d-flex gap-2 mt-4">
                                    <label class="switch" for="enable_order_request">
                                        {!! Form::checkbox('enable_order_request', 1, !empty($crm_settings['enable_order_request']), ['id' => 'enable_order_request']) !!}
                                        <div class="sliderCheckbox round"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('order_request_prefix', __('crm::lang.order_request_prefix') . ':') !!}
                                    {!! Form::text('order_request_prefix', $crm_settings['order_request_prefix'] ?? null, ['class' => 'form-control','placeholder' => __( 'crm::lang.order_request_prefix' )]); !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">@lang( 'messages.update' )</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
    </div>
</div>

@stop
@section('javascript')
@endsection