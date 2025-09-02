@extends('layouts.app')

@section('title', __('settings.app_settings'))

@section('content')
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
                <h1>@lang('settings.reset_purchase_sell_mapping')</h1>
                <p>@lang('settings.manage_app_settings')</p>
            </div>
            <div class="filter">
                <div class="mb-3">
                    <a href="{{ route('stock.rebuild.jobs') }}"
                       class="btn btn-primary">
                        @lang('settings.view_rebuild_jobs')
                    </a>
                </div>
            </div>
        </div>

        <div class="content">
            {{-- Instruction block --}}
            <p class="help-block"><i>@lang('settings.reset_mapping_instruction')</i></p>

            {{-- Only business selector now --}}
            {!! Form::open(['route' => 'stock.rebuild.reset', 'method' => 'post']) !!}
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('business_id', __('settings.select_business')) !!}
                        @show_tooltip(__('settings.purchase_sell_mismatch_tooltip'))
                        <select name="business_id" id="business_id" class="form-control">
                            <option value="all">@lang('settings.all_businesses')</option>
                            @foreach($businesses as $business)
                                <option value="{{ $business->id }}">{{ $business->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-danger pull-right" type="submit">
                            @lang('settings.reset_mapping')
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
