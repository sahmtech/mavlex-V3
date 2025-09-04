@extends('layouts.app')
@section('title', __('product.edit_product'))

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
    {!! Form::open(['url' => action('ProductController@update' , [$product->id] ), 'method' => 'PUT', 'id' => 'product_add_form',
    'class' => 'product_form', 'files' => true ]) !!}
    <input type="hidden" id="product_id" value="{{ $product->id }}">
    <!-- Filter through table -->
    <div class="overview-filter">
      <div class="title">
        <h1>@lang( 'product.edit_product' )</h1>
        <p>@lang( 'lang_v1.manage_products' )</p>
      </div>

      <div class="filter">
        <div class="form-group " style="display: flex; gap: 10px;">
          <div class="toggle-wrapper" style="display: flex; gap: 10px;">
            <label class="switch" for="enable_stock">
              {!! Form::checkbox('enable_stock', 1,$product->enable_stock, ['class' => 'manage_stock_class', 'id' => 'enable_stock']); !!}
              <div class="sliderCheckbox round"></div>
            </label>
            <p>@lang('product.manage_stock')</p>
          </div>

          <div class="toggle-wrapper" style="display: flex; gap: 10px;">
            <label class="switch" for="not_for_selling">
              {!! Form::checkbox('not_for_selling', 1, $product->not_for_selling, ['id' => 'not_for_selling']); !!}
              <div class="sliderCheckbox round"></div>
            </label>
            <p>@lang('lang_v1.not_for_selling')</p>
          </div>
        </div>
      </div>

    </div>
    <!-- End of Filter through table -->

    <div class="content">
      <!-- Product Information Accordion -->
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
              <div class="form-group">
                {!! Form::label('name', __('product.product_name') . ':*') !!}
                {!! Form::text('name', $product->name, ['class' => 'form-control', 'required',
                'placeholder' => __('product.product_name')]); !!}
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('sku', __('product.sku') . ':*') !!} @show_tooltip(__('tooltip.sku'))
                {!! Form::text('sku', $product->sku, ['class' => 'form-control',
                'placeholder' => __('product.sku'), 'required']); !!}
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('type', __('product.product_type') . ':*') !!} @show_tooltip(__('tooltip.product_type'))
                {!! Form::select('type', $product_types, $product->type, ['class' => 'form-control',
                'required','disabled', 'data-action' => 'edit', 'data-product_id' => $product->id ]); !!}
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('unit_id', __('product.unit') . ':*') !!}
                <div class="input-group">
                  {!! Form::select('unit_id', $units, $product->unit_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'required' ]); !!}
                  <span class="input-group-btn">
                    <button type="button" @if(!auth()->user()->can('unit.create')) disabled @endif class="btn btn-default bg-white btn-flat quick_add_unit btn-modal" data-href="{{action('UnitController@create', ['quick_add' => true])}}" title="@lang('unit.add_unit')" data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-sm-6 @if(!session('business.enable_sub_units')) hide @endif">
              <div class="form-group">
                {!! Form::label('sub_unit_ids', __('lang_v1.related_sub_units') . ':') !!} @show_tooltip(__('lang_v1.sub_units_tooltip'))

                <select name="sub_unit_ids[]" class="form-control select2" multiple id="sub_unit_ids">
                  @foreach($sub_units as $sub_unit_id => $sub_unit_value)
                  <option value="{{$sub_unit_id}}" @if(is_array($product->sub_unit_ids) &&in_array($sub_unit_id, $product->sub_unit_ids)) selected
                    @endif
                    >{{$sub_unit_value['name']}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            @if(!empty($common_settings['enable_secondary_unit']))
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('secondary_unit_id', __('lang_v1.secondary_unit') . ':') !!} @show_tooltip(__('lang_v1.secondary_unit_help'))
                        {!! Form::select('secondary_unit_id', $units, $product->secondary_unit_id, ['class' => 'form-control select2']); !!}
                    </div>
                </div>
            @endif

            <div class="col-sm-6 @if(!session('business.enable_brand')) hide @endif">
              <div class="form-group">
                {!! Form::label('brand_id', __('product.brand') . ':') !!}
                <div class="input-group">
                  {!! Form::select('brand_id', $brands, $product->brand_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
                  <span class="input-group-btn">
                    <button type="button" @if(!auth()->user()->can('brand.create')) disabled @endif class="btn btn-default bg-white btn-flat btn-modal" data-href="{{action('BrandController@create', ['quick_add' => true])}}" title="@lang('brand.add_brand')" data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-sm-6 @if(!session('business.enable_category')) hide @endif">
              <div class="form-group">
                {!! Form::label('category_id', __('product.category') . ':') !!}
                {!! Form::select('category_id', $categories, $product->category_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
              </div>
            </div>

            <div class="col-sm-6 @if(!(session('business.enable_category') && session('business.enable_sub_category'))) hide @endif">
              <div class="form-group">
                {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                {!! Form::select('sub_category_id', $sub_categories, $product->sub_category_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); !!}
              </div>
            </div>

            <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('product_locations', __('business.business_locations') . ':') !!} @show_tooltip(__('lang_v1.product_location_help'))
            {!! Form::select('product_locations[]', $business_locations, $product->product_locations->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple', 'id' => 'product_locations']) !!}
        </div>
    </div>

            <div class="col-sm-6" id="alert_quantity_div" @if(!$product->enable_stock) style="display:none" @endif>
              <div class="form-group">
                {!! Form::label('alert_quantity', __('product.alert_quantity') . ':') !!} @show_tooltip(__('tooltip.alert_quantity'))
                {!! Form::text('alert_quantity', @format_quantity($product->alert_quantity), ['class' => 'form-control input_number',
                'placeholder' => __('product.alert_quantity') , 'min' => '0']); !!}
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
              {!! Form::label('weight',  __('lang_v1.weight') . ':') !!}
            {!! Form::text('weight', $product->weight, ['class' => 'form-control', 'placeholder' => __('lang_v1.weight')]); !!}</div>
            </div>
            @if(!empty($common_settings['enable_product_warranty']))
            <div class="col-sm-6">
              <div class="form-group">
                {!! Form::label('warranty_id', __('lang_v1.warranty') . ':') !!}
                {!! Form::select('warranty_id', $warranties, $product->warranty_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); !!}
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
                {!! Form::textarea('product_description', $product->product_description, ['class' => 'form-control']); !!}
              </div>
            </div>
            <div class="col-sm-6 @if(!session('business.enable_product_image')) hide @endif">
              <div class="form-group">
                {!! Form::label('image', __('lang_v1.product_image') . ':') !!}
                {!! Form::file('image', ['id' => 'upload_image', 'accept' => 'image/*']); !!}
                <small>
                  <p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]). @lang('lang_v1.aspect_ratio_should_be_1_1') @if(!empty($product->image)) <br> @lang('lang_v1.previous_image_will_be_replaced') @endif</p>
                </small>
              </div>
            </div>
          </div>
          <div class="col-sm-6 @if(!session('business.enable_product_image')) hide @endif">
            <div class="form-group">
              {!! Form::label('product_brochure', __('lang_v1.product_brochure') . ':') !!}
              {!! Form::file('product_brochure', ['id' => 'product_brochure', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); !!}
              <small>
                <p class="help-block">
                  @lang('lang_v1.previous_file_will_be_replaced')<br>
                  @lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)])
                  @includeIf('components.document_help_text')
                </p>
              </small>
            </div>
          </div>
        </div>
      </div>
      @endif
      <div class="clearfix"></div>

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
                  @php
                  $disabled = false;
                  $disabled_period = false;
                  if( empty($product->expiry_period_type) || empty($product->enable_stock) ){
                  $disabled = true;
                  }
                  if( empty($product->enable_stock) ){
                  $disabled_period = true;
                  }
                  @endphp
                  {!! Form::label('expiry_period', __('product.expires_in') . ':') !!}<br>
                  {!! Form::text('expiry_period', @num_format($product->expiry_period), ['class' => 'form-control pull-left input_number',
                  'placeholder' => __('product.expiry_period'), 'style' => 'width:60%;', 'disabled' => $disabled]); !!}
                  {!! Form::select('expiry_period_type', ['months'=>__('product.months'), 'days'=>__('product.days'), '' =>__('product.not_applicable') ], $product->expiry_period_type, ['class' => 'form-control pull-left', 'style' => 'width:40%;', 'id' => 'expiry_period_type', 'disabled' => $disabled_period]); !!}
                </div>
              </div>
            </div>
            @endif
            <div class="col-sm-6 @if(!session('business.enable_product_description')) hide @endif">
              <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                  <label class="switch" for="enable_sr_no">
                    {!! Form::checkbox('enable_sr_no', 1, $product->enable_sr_no, ['id' => 'enable_sr_no']); !!}
                    <div class="sliderCheckbox round"></div>
                  </label>
                  <p>@lang('lang_v1.enable_imei_or_sr_no')</p>
                </div>
              </div>
            </div>
          
            <!-- Rack, Row & position number -->
            @if(session('business.enable_racks') || session('business.enable_row') || session('business.enable_position'))
            <div class="col-md-12">
              <h4>@lang('lang_v1.rack_details'):
                @show_tooltip(__('lang_v1.tooltip_rack_details'))
              </h4>
            </div>
            @foreach($business_locations as $id => $location)
            <div class="col-sm-3">
              <div class="form-group">
                {!! Form::label('rack_' . $id, $location . ':') !!}


                @if(!empty($rack_details[$id]))
                @if(session('business.enable_racks'))
                {!! Form::text('product_racks_update[' . $id . '][rack]', $rack_details[$id]['rack'], ['class' => 'form-control', 'id' => 'rack_' . $id]); !!}
                @endif

                @if(session('business.enable_row'))
                {!! Form::text('product_racks_update[' . $id . '][row]', $rack_details[$id]['row'], ['class' => 'form-control']); !!}
                @endif

                @if(session('business.enable_position'))
                {!! Form::text('product_racks_update[' . $id . '][position]', $rack_details[$id]['position'], ['class' => 'form-control']); !!}
                @endif
                @else
                {!! Form::text('product_racks[' . $id . '][rack]', null, ['class' => 'form-control', 'id' => 'rack_' . $id, 'placeholder' => __('lang_v1.rack')]); !!}

                {!! Form::text('product_racks[' . $id . '][row]', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.row')]); !!}

                {!! Form::text('product_racks[' . $id . '][position]', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.position')]); !!}
                @endif

              </div>
            </div>
            @endforeach
            @endif
            @if(session('business.enable_preparation_time_in_minutes'))
            <div class="col-sm-6">
            <div class="form-group">
            {!! Form::label('preparation_time_in_minutes',  __('lang_v1.preparation_time_in_minutes') . ':') !!}
            {!! Form::number('preparation_time_in_minutes', $product->preparation_time_in_minutes, ['class' => 'form-control', 'placeholder' => __('lang_v1.preparation_time_in_minutes')]); !!}
           </div>
           </div>
           @endif
            @include('layouts.partials.module_form_part')
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
                            <input type="{{$cf_type}}" name="{{$db_field_name}}" id="{{$db_field_name}}" 
                            value="{{$product->$db_field_name}}" class="form-control" placeholder="{{$cf}}">
                        @elseif($cf_type == 'dropdown')
                            {!! Form::select($db_field_name, $dropdown, $product->$db_field_name, ['placeholder' => $cf, 'class' => 'form-control select2']); !!}
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


          <div class="row">
            <div class="col-sm-3 @if(!session('business.enable_price_tax')) hide @endif">
              <div class="form-group">
                {!! Form::label('tax', __('product.applicable_tax') . ':') !!}
                {!! Form::select('tax', $taxes, $product->tax, ['placeholder' => __('messages.please_select'), 'class' => 'form-control'], $tax_attributes); !!}
              </div>
            </div>

            <div class="col-sm-3 @if(!session('business.enable_price_tax')) hide @endif">
              <div class="form-group">
                {!! Form::label('tax_type', __('product.selling_price_tax_type') . ':*') !!}
                {!! Form::select('tax_type',['inclusive' => __('product.inclusive'), 'exclusive' => __('product.exclusive')], $product->tax_type,
                ['class' => 'form-control', 'required']); !!}
              </div>
            </div>

              <!-- tax 2 row -->
            <div class="col-sm-3  is_taxable_div">
              <div class="form-group">
                {!! Form::label('tax_2', __('product.applicable_extra_tax') . ':') !!}
                {!! Form::select('tax_2', $taxes,  $product->tax_2, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'style' => 'width: 100%'], $tax_attributes); !!}
              </div>
            </div>

            <div class="col-sm-3  is_taxable_div" >
              <div class="form-group">
                {!! Form::label('tax_2_type', __('product.selling_price_tax_type') . ':*') !!}
                {!! Form::select('tax_2_type', ['inclusive' => __('product.inclusive'), 'exclusive' => __('product.exclusive')], !empty($duplicate_product->tax_type) ? $duplicate_product->tax_type : 'exclusive',
                ['class' => 'form-control select2', 'required', 'style' => 'width: 100%']); !!}
              </div>
            </div>
          
            <div class="clearfix"></div>


            <div class="form-group col-sm-12" id="product_form_part"></div>
            <input type="hidden" id="variation_counter" value="0">
            <input type="hidden" id="default_profit_percent" value="{{ $default_profit_percent }}">
          </div>
        </div>
      </div>

      <div class="row">
        <input type="hidden" name="submit_type" id="submit_type">
        <div class="col-sm-12">
          <div class="text-center">
            <div class="btn-group">
              @can('product.opening_stock')
              <button type="submit" @if(empty($product->enable_stock)) disabled="true" @endif id="opening_stock_button" value="update_n_edit_opening_stock" class="btn bg-navy submit_product_form">@lang('lang_v1.update_n_edit_opening_stock')</button>
              @endif

              @if($selling_price_group_count)
              <button type="submit" value="submit_n_add_selling_prices" class="btn btn-warning submit_product_form">@lang('lang_v1.save_n_add_selling_price_group_prices')</button>
              @endif

              <button type="submit" value="submit" class="btn bg-navy submit_product_form">@lang('messages.update')</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
<!-- /.content -->

@endsection

@section('javascript')
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    __page_leave_confirmation('#product_add_form');

  });
</script>
@endsection