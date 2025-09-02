@extends('layouts.app')
@section('title', __('product.add_new_product'))

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
    @php
    $form_class = empty($duplicate_product) ? 'create' : '';
    @endphp
    {!! Form::open(['url' => action('ProductController@store'), 'method' => 'post',
    'id' => 'product_add_form','class' => 'product_form ' . $form_class, 'files' => true ]) !!}

    <!-- Filter through table -->
    <div class="overview-filter">
      <div class="title">
        <h1>@lang( 'product.add_new_product' )</h1>
        <p>@lang( 'lang_v1.manage_products' )</p>
      </div>

      <div class="filter">

        <div class="form-group" style="display: flex; gap: 10px;">
          <div class="toggle-wrapper" style="display: flex; gap: 10px;">
            <label class="switchBtn" for="enable_stock">
              {!! Form::checkbox('enable_stock', 1, !empty($duplicate_product) ? $duplicate_product->enable_stock : true, ['class' => 'manage_stock_class', 'id' => 'enable_stock']); !!}
              <div class="sliderCheckbox round"></div>
            </label>
            <p>@lang('product.manage_stock')</p>
          </div>

          <div class="toggle-wrapper" style="display: flex; gap: 10px;">
            <label class="switchBtn" for="not_for_selling">
              {!! Form::checkbox('not_for_selling', 1, !(empty($duplicate_product)) ? $duplicate_product->not_for_selling : false, ['id' => 'not_for_selling']); !!}
              <div class="sliderCheckbox round"></div>
            </label>
            <p>@lang('lang_v1.not_for_selling')</p>
          </div>
        </div>

      </div>

    </div>
    <!-- End of Filter through table -->

    <div class="content">
      <!-- Product Information Accordion-->
      <div class="accordionItem">
        <!-- Accordion Title -->
        <div class="accordionTitle is-open">
          <h2 class="">@lang('lang_v1.product_information')</h2>
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>

        <div class="accordionContent">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-box">
                {!! Form::label('name', __('product.product_name') . ':*') !!}
                {!! Form::text('name', !empty($duplicate_product->name) ? $duplicate_product->name : null, ['class' => 'form-control', 'required',
                'placeholder' => __('product.product_name')]); !!}
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('sku', __('product.sku') . ':') !!}
                {!! Form::text('sku', null, ['class' => 'form-control',
                'placeholder' => __('product.sku')]); !!}
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('type', __('product.product_type') . ':*') !!}
                {!! Form::select('type', $product_types, !empty($duplicate_product->type) ? $duplicate_product->type : null, ['class' => 'form-control select2',
                'required', 'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add', 'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0']); !!}
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('unit_id', __('product.unit') . ':*') !!}
                <div class="input-group">
                  {!! Form::select('unit_id', $units, !empty($duplicate_product->unit_id) ? $duplicate_product->unit_id : session('business.default_unit'), ['class' => 'form-control select2', 'required']); !!}
                  <span class="input-group-btn">
                    <button type="button" @if(!auth()->user()->can('unit.create')) disabled @endif class="btn btn-default bg-white btn-flat btn-modal" data-href="{{action('UnitController@create', ['quick_add' => true])}}" title="@lang('unit.add_unit')" data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-sm-6 @if(!session('business.enable_sub_units')) hide @endif">
              <div class="form-group">
                {!! Form::label('sub_unit_ids', __('lang_v1.related_sub_units') . ':') !!} @show_tooltip(__('lang_v1.sub_units_tooltip'))
                <div class="input-group col-sm-12">
                  {!! Form::select('sub_unit_ids[]', [], !empty($duplicate_product->sub_unit_ids) ? $duplicate_product->sub_unit_ids : null, ['class' => 'form-control select2', 'multiple', 'id' => 'sub_unit_ids']); !!}
                </div>
              </div>
            </div>
            @if(!empty($common_settings['enable_secondary_unit']))
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('secondary_unit_id', __('lang_v1.secondary_unit') . ':') !!} @show_tooltip(__('lang_v1.secondary_unit_help'))
                {!! Form::select('secondary_unit_id', $units, !empty($duplicate_product->secondary_unit_id) ? $duplicate_product->secondary_unit_id : null, ['class' => 'form-control select2']); !!}
            </div>
        </div>
        @endif

            <div class="col-sm-6 @if(!session('business.enable_brand')) hide @endif">
              <div class="form-group">
                {!! Form::label('brand_id', __('product.brand') . ':') !!}
                <div class="input-group">
                  {!! Form::select('brand_id', $brands, !empty($duplicate_product->brand_id) ? $duplicate_product->brand_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
                  <span class="input-group-btn">
                    <button type="button" @if(!auth()->user()->can('brand.create')) disabled @endif class="btn btn-default bg-white btn-flat btn-modal" data-href="{{action('BrandController@create', ['quick_add' => true])}}" title="@lang('brand.add_brand')" data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-sm-6 @if(!session('business.enable_category')) hide @endif">
              <div class="form-group">
                {!! Form::label('category_id', __('product.category') . ':') !!}
                {!! Form::select('category_id', $categories, !empty($duplicate_product->category_id) ? $duplicate_product->category_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
              </div>
            </div>

            <div class="col-sm-6 @if(!(session('business.enable_category') && session('business.enable_sub_category'))) hide @endif">
              <div class="form-group">
                {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                {!! Form::select('sub_category_id', $sub_categories, !empty($duplicate_product->sub_category_id) ? $duplicate_product->sub_category_id : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
              </div>
            </div>

            @php
            $default_location = null;
            if(count($business_locations) == 1){
            $default_location = array_key_first($business_locations->toArray());
            }
            @endphp
            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('product_locations', __('business.business_locations') . ':') !!}
                {!! Form::select('product_locations[]', $business_locations, $default_location, ['class' => 'form-control select2', 'multiple', 'id' => 'product_locations']); !!}
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('weight', __('lang_v1.weight') . ':') !!}
                {!! Form::text('weight', !empty($duplicate_product->weight) ? $duplicate_product->weight : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.weight')]); !!}
              </div>
            </div>
           

            <div class="col-sm-6 @if(!empty($duplicate_product) && $duplicate_product->enable_stock == 0) hide @endif" id="alert_quantity_div">
              <div class="form-group">
                {!! Form::label('alert_quantity', __('product.alert_quantity') . ':') !!}
                {!! Form::text('alert_quantity', !empty($duplicate_product->alert_quantity) ? @format_quantity($duplicate_product->alert_quantity) : null , ['class' => 'form-control input_number',
                'placeholder' => __('product.alert_quantity'), 'min' => '0']); !!}
              </div>
            </div>
            
            @if(!empty($common_settings['enable_product_warranty']))
            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('warranty_id', __('lang_v1.warranty') . ':') !!}
                {!! Form::select('warranty_id', $warranties, null, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); !!}
              </div>
            </div>
            @endif
            <!-- include module fields -->
            @if(!empty($pos_module_data))
            @foreach($pos_module_data as $key => $value)
            @if(!empty($value['view_path']))
            @includeIf($value['view_path'], ['view_data' => $value['view_data']])
            @endif
            @endforeach
            @endif

          </div>
        </div>
      </div>
        <div class="clearfix"></div>
        <!-- Product image and description -->
        @if(session('business.enable_product_description') || session('business.enable_product_image'))
        <div class="accordionItem">
          <!-- Accordion Title -->
          <div class="accordionTitle is-open">
            <h2 class="">@lang('lang_v1.product_description')</h2>

            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>

          <div class="accordionContent">
            <div class="row">
              <div class="col-sm-12 @if(!session('business.enable_product_description')) hide @endif">
                <div class="form-group">
                  {!! Form::label('product_description', __('lang_v1.product_description') . ':') !!}
                  {!! Form::textarea('product_description', !empty($duplicate_product->product_description) ? $duplicate_product->product_description : null, ['class' => 'form-control']); !!}
                </div>
              </div>
              <div class="col-sm-6  @if(!session('business.enable_product_image')) hide @endif">
                <div class="form-group">
                  {!! Form::label('image', __('lang_v1.product_image') . ':') !!}
                  {!! Form::file('image', ['id' => 'upload_image', 'accept' => 'image/*']); !!}
                  <small>
                    <p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]) <br> @lang('lang_v1.aspect_ratio_should_be_1_1')</p>
                  </small>
                </div>
              </div>
              <div class="col-sm-6  @if(!session('business.enable_product_image')) hide @endif">
                <div class="form-group">
                  {!! Form::label('product_brochure', __('lang_v1.product_brochure') . ':') !!}
                  {!! Form::file('product_brochure', ['id' => 'product_brochure', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); !!}
                  <small>
                    <p class="help-block">
                      @lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                      @includeIf('components.document_help_text')
                    </p>
                  </small>
                </div>
              </div>

            </div>
          </div>
        </div>
        @endif

      <!-- Racks Accordion -->
      @if(session('business.enable_product_expiry') || session('business.enable_racks') || session('business.enable_row') || session('business.enable_position') || session('business.enable_preparation_time_in_minutes'))

      <div class="accordionItem">
        <!-- Accordion Title -->
        <div class="accordionTitle is-open">
          <h2 class="">@lang('lang_v1.sr_no_racks')</h2>
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>

        <div class="accordionContent">
          <div class="row">
            @if(session('business.enable_product_expiry'))
            @if(session('business.expiry_type') == 'add_expiry')
            @php
            $expiry_period = 12;
            $hide = true;
            @endphp
            @else
            @php
            $expiry_period = null;
            $hide = false;
            @endphp
            @endif
            <div class="col-sm-6 @if($hide) hide @endif">
              <div class="form-group">
                <div class="multi-input">
                  {!! Form::label('expiry_period', __('product.expires_in') . ':') !!}<br>
                  {!! Form::text('expiry_period', !empty($duplicate_product->expiry_period) ? @num_format($duplicate_product->expiry_period) : $expiry_period, ['class' => 'form-control pull-left input_number',
                  'placeholder' => __('product.expiry_period'), 'style' => 'width:60%;']); !!}
                  {!! Form::select('expiry_period_type', ['months'=>__('product.months'), 'days'=>__('product.days'), '' =>__('product.not_applicable') ], !empty($duplicate_product->expiry_period_type) ? $duplicate_product->expiry_period_type : 'months', ['class' => 'form-control select2 pull-left', 'style' => 'width:40%;', 'id' => 'expiry_period_type']); !!}
                </div>
              </div>
            </div>
            @endif

            <div class="col-sm-6  @if(!session('business.enable_product_description')) hide @endif">
              <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                  <label class="switch" for="enable_sr_no">
                    {!! Form::checkbox('enable_sr_no', 1, !(empty($duplicate_product)) ? $duplicate_product->enable_sr_no : false, ['id' => 'enable_sr_no']); !!}
                    <div class="sliderCheckbox round"></div>
                  </label>
                  <p>@lang('lang_v1.enable_imei_or_sr_no')</p>
                </div>
              </div>
            </div>

            @if(session('business.enable_racks') || session('business.enable_row') || session('business.enable_position'))
            <div class="col-sm-6  @if(!session('business.enable_product_description')) hide @endif">
              <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                  <label class="switch" for="show_racks">
                    {!! Form::checkbox('show_racks', 1, !(empty($duplicate_product)) ? $duplicate_product->show_racks : false, ['id' => 'show_racks']); !!}
                    <div class="sliderCheckbox round"></div>
                  </label>
                  <p>@lang('lang_v1.show_racks')</p>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <!-- Rack, Row & position number -->
            <div class="show_racks hide">
              <div class="col-md-12">
                <h4>@lang('lang_v1.rack_details'):
                  @show_tooltip(__('lang_v1.tooltip_rack_details'))
                </h4>
              </div>
              @foreach($business_locations as $id => $location)
              <div class="col-sm-3">
                <div class="form-group">
                  {!! Form::label('rack_' . $id, $location . ':') !!}

                  @if(session('business.enable_racks'))
                  {!! Form::text('product_racks[' . $id . '][rack]', !empty($rack_details[$id]['rack']) ? $rack_details[$id]['rack'] : null, ['class' => 'form-control', 'id' => 'rack_' . $id,
                  'placeholder' => __('lang_v1.rack')]); !!}
                  @endif

                  @if(session('business.enable_row'))
                  {!! Form::text('product_racks[' . $id . '][row]', !empty($rack_details[$id]['row']) ? $rack_details[$id]['row'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.row')]); !!}
                  @endif

                  @if(session('business.enable_position'))
                  {!! Form::text('product_racks[' . $id . '][position]', !empty($rack_details[$id]['position']) ? $rack_details[$id]['position'] : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.position')]); !!}
                  @endif
                </div>
              </div>
              @endforeach
              @endif
            </div>
            @if(session('business.enable_preparation_time_in_minutes'))
            <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('preparation_time_in_minutes', __('lang_v1.preparation_time_in_minutes') . ':') !!}
                {!! Form::number('preparation_time_in_minutes', !empty($duplicate_product->preparation_time_in_minutes) ? $duplicate_product->preparation_time_in_minutes : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.preparation_time_in_minutes')]); !!}
            </div>
          </div>
        @endif
          </div>
        </div>
      </div>
      @endif
      <div class="clearfix"></div>
      <!-- custom Feilds Labels -->
      @php
      $custom_labels = json_decode(session('business.custom_labels'), true);
      $product_custom_fields = !empty($custom_labels['product']) ? $custom_labels['product'] : [];
      $product_cf_details = !empty($custom_labels['product_cf_details']) ? $custom_labels['product_cf_details'] : [];
      @endphp

      @if(!empty(array_filter($product_custom_fields)))
      <div class="accordionItem">
        <!-- Accordion Title -->
        <div class="accordionTitle is-open">
          <h2 class="">@lang('lang_v1.custom_labels')</h2>

          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="accordionContent">
          <!--custom fields-->
          @foreach($product_custom_fields as $index => $cf)
          @if(!empty($cf))
          @php
          $db_field_name = 'product_custom_field' . $loop->iteration;
          $cf_type = !empty($product_cf_details[$loop->iteration]['type']) ? $product_cf_details[$loop->iteration]['type'] : 'text';
          $dropdown = !empty($product_cf_details[$loop->iteration]['dropdown_options']) ? explode(PHP_EOL, $product_cf_details[$loop->iteration]['dropdown_options']) : [];
          @endphp
          <div class="col-sm-3">
            <div class="form-group">
              {!! Form::label($db_field_name, $cf . ':') !!}

              @if(in_array($cf_type, ['text', 'date']))

              <input type="{{$cf_type}}" name="{{$db_field_name}}" id="{{$db_field_name}}" value="{{!empty($duplicate_product->$db_field_name) ? $duplicate_product->$db_field_name : null}}" class="form-control" placeholder="{{$cf}}">

              @elseif($cf_type == 'dropdown')
              {!! Form::select($db_field_name, $dropdown, !empty($duplicate_product->$db_field_name) ? $duplicate_product->$db_field_name : null, ['placeholder' => $cf, 'class' => 'form-control select2']); !!}
              @endif
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
      @endif

      <div class="clearfix"></div>
<!-- Pricing Accordion -->
      <div class="accordionItem">
        <!-- Accordion Title -->
        <div class="accordionTitle is-open">
          <h2 class="">@lang('lang_v1.pricing')</h2>

          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>

        <div class="accordionContent">

          <div class="col-sm-12">
            <div class="form-group">
              <div class="toggle-wrapper">
                <label class="switchBtn" for="taxable">
                  {!! Form::checkbox('taxable', 1, false,
                  ['id' => 'taxable']); !!}
                  <span class="slider"></span>
                </label>
                <p>@lang('lang_v1.taxable') ?</p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 hide is_taxable_div">

              <div class="form-group">
                {!! Form::label('tax', __('product.applicable_tax') . ':') !!}
                {!! Form::select('tax', $taxes, !empty($duplicate_product->tax) ? $duplicate_product->tax : null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'style' => 'width: 100%'], $tax_attributes); !!}
              </div>
            </div>

            <div class="col-sm-6 hide is_taxable_div">
              <div class="form-group">
                {!! Form::label('tax_type', __('product.selling_price_tax_type') . ':*') !!}
                {!! Form::select('tax_type', ['inclusive' => __('product.inclusive'), 'exclusive' => __('product.exclusive')], !empty($duplicate_product->tax_type) ? $duplicate_product->tax_type : 'exclusive',
                ['class' => 'form-control select2', 'required', 'style' => 'width: 100%']); !!}
              </div>
            </div>

            <div class="form-group col-sm-12" id="product_form_part">
              @include('product.partials.single_product_form_part', ['profit_percent' => $default_profit_percent])
            </div>

            <input type="hidden" id="variation_counter" value="1">
            <input type="hidden" id="default_profit_percent" value="{{ $default_profit_percent }}">

          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <input type="hidden" name="submit_type" id="submit_type">
          <div class="text-center">
            <div class="btn-group">
              @can('product.opening_stock')
              <button id="opening_stock_button" @if(!empty($duplicate_product) && $duplicate_product->enable_stock == 0) disabled @endif type="submit" value="submit_n_add_opening_stock" class="btn btn-default-submit submit_product_form">@lang('lang_v1.save_n_add_opening_stock')</button>
              @endcan

              @if($selling_price_group_count)
              <button type="submit" value="submit_n_add_selling_prices" class="btn btn-default-submit submit_product_form">@lang('lang_v1.save_n_add_selling_price_group_prices')</button>
              @endif
              <button type="submit" value="submit" style="" class="btn btn-primary submit_product_form">@lang('messages.save')</button>
            </div>

          </div>
        </div>
      </div>

    {!! Form::close() !!}
  </div>
</div>
</div>


@endsection

@section('javascript')
@php $asset_v = env('APP_VERSION'); @endphp
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>

<script type="text/javascript">
  $(document).ready(function() {

    $("#taxable").click(function() {
      var checked = $(this).is(':checked');
      if (checked) {
        $('div.is_taxable_div').removeClass('hide');
        $('div.not_taxable_div').addClass('hide');
        $('input#single_dp').val(0);
        $('input#single_ds').val(0);
        // $('input#profit_percent2').val(0);
        $('input#single_dpp').val(0);
        $('input#single_dpp_inc_tax').val(0);
        $('input#single_dsp').val(0);
        $('input#single_dsp_inc_tax').val(0);
        //$('input#profit_percent').val(0);

      } else {
        $('div.is_taxable_div').addClass('hide');
        $('div.not_taxable_div').removeClass('hide');
        $('input#single_dp').val(0);
        $('input#single_ds').val(0);
        // $('input#profit_percent2').val(0);
        $('input#single_dpp').val(0);
        $('input#single_dpp_inc_tax').val(0);
        $('input#single_dsp').val(0);
        $('input#single_dsp_inc_tax').val(0);
        // $('input#profit_percent').val(0);
        if ($('select#type').val() != 'single') {
          $('div.is_taxable_div').removeClass('hide');
          $('div.not_taxable_div').addClass('hide');
        }
        $('select#tax').val('').trigger('change');
      }
    });

    $("#show_racks").click(function() {
      var checked = $(this).is(':checked');
      if (checked) {
        $('div.show_racks').removeClass('hide');
      } else {
        $('div.show_racks').addClass('hide');
      }
    });

    __page_leave_confirmation('#product_add_form');
    onScan.attachTo(document, {
      suffixKeyCodes: [13], // enter-key expected at the end of a scan
      reactToPaste: true, // Compatibility to built-in scanners in paste-mode (as opposed to keyboard-mode)
      onScan: function(sCode, iQty) {
        $('input#sku').val(sCode);
      },
      onScanError: function(oDebug) {
        console.log(oDebug);
      },
      minLength: 2,
      ignoreIfFocusOn: ['input', '.form-control']
      // onKeyDetect: function(iKeyCode){ // output all potentially relevant key events - great for debugging!
      //     console.log('Pressed: ' + iKeyCode);
      // }
    });
  });
</script>
@endsection