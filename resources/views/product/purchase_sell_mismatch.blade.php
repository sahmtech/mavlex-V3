@extends('layouts.app')
@section('title', __('lang_v1.purchase_sell_mismatch'))

@section('content')
<div class="main-container no-print">

    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.product', ['link_class' => 'sub-menu-item'])
</div>
    </div>
    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>{{ __('lang_v1.purchase_sell_mismatch')}}</h1>
                <p>@lang('lang_v1.remap_purchase_sell')</p>
            </div>

            <div class="filter">
            </div>
        </div>
        <!-- End of Filter through table -->
        <div class="content">
            {!! Form::open(['url' => route('stock_rebuild.remap'), 'method' => 'get', 'id' => 'rebuild-form']) !!}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('variation_id', __('lang_v1.search_product') . ':') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            {!! Form::select('variation_id', [], null, ['class' => 'form-control','id' => 'variation_id','placeholder' => __('lang_v1.search_product_placeholder'),'required' ]) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('location_id', __('purchase.business_location').':') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            {!! Form::select('location_id', $locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'),'required']) !!}
                        </div>
                    </div>
                </div>
                <input type="hidden" name="business_id" value="{{ $business_id }}" />
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" id="build-remap-btn" class="btn btn-primary pull-right"> 
                        @lang('lang_v1.rebuild_mapping') 
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- Modal notifying user not to close window during rebuild -->
<div class="modal fade" id="processingModal" tabindex="-1" role="dialog" 
     aria-labelledby="processingModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="processingModalLabel">{{ __('lang_v1.processing') }}</h5>
      </div>
      <div class="modal-body">
        {{ __('lang_v1.do_not_close_window') }}
      </div>
    </div>
  </div>
</div>

@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        // Initialize select2 for the product search field
        $('#variation_id').select2({
            ajax: {
                url: '/purchases/get_products',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term, 
                    };
                },
                processResults: function (data) {
                    let results = [];
                    data.forEach(function (item) {
                        results.push({
                            id: item.variation_id,
                            text: item.text 
                        });
                    });
                    return { results: results };
                }
            },
            minimumInputLength: 1,
            placeholder: '{{ __("lang_v1.search_product_placeholder") }}'
        });

        // Show the processing modal on form submission
        $('#rebuild-form').on('submit', function(e) {
            $('#processingModal').modal('show');
        });
    });
</script>
@endsection
