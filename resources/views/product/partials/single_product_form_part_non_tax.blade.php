@if(!session('business.enable_price_tax')) 
  @php
    $default = 0;
    $class = '';
  @endphp
@else
  @php
    $default = 0;
    $class = '';
  @endphp
@endif
<div class="col-sm-12 {{$class}}">
  
  <div class="sub-heading-title">
      <h3>@lang('product.default_purchase_price')</h3>
  </div>
  <br>
  
  <div class="col-sm-6">
    <div class="form-group">
      {!! Form::label('single_dp', trans('product.default_purchase_price') . ':*') !!}

      {!! Form::text('single_dp', $default, ['class' => 'form-control dpp input_number', 'placeholder' => __('product.default_purchase_price'), 'required', 'id' => 'single_dp']); !!}
    </div>
  </div>
  <div class="col-sm-6">
    
  </div>

  <div class="clearfix"></div>

  <div class="sub-heading-title">
      <h3>@lang('product.profit_percent') @show_tooltip(__('tooltip.profit_percent'))</h3>
  </div>
  <br>
 

  <div class="col-sm-6">
    <div class="form-group">
      {!! Form::label('profit_percent', '') !!}
      {!! Form::text('profit_percent2', @num_format($profit_percent), ['class' => 'form-control  input_number', 'id' => 'profit_percent2', 'required']); !!}
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="col-sm-6">
      <div class="sub-heading-title">
          <h3>@lang('product.default_selling_price')</h3>
      </div>
      <br>

      <div class="form-group">
        {!! Form::label('single_ds', trans('product.default_selling_price')) !!}
        {!! Form::text('single_ds', $default, ['class' => 'form-control  dsp input_number', 'placeholder' => __('product.default_selling_price'), 'id' => 'single_ds', 'required']); !!}

        
      </div>
  </div>

</div>