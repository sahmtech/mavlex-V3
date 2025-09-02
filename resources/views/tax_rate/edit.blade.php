<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('TaxRateController@update', [$tax_rate->id]), 'method' => 'PUT', 'id' => 'tax_rate_edit_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'tax_rate.edit_taxt_rate' )</h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        {!! Form::label('name', __( 'tax_rate.name' ) . ':*') !!}
          {!! Form::text('name', $tax_rate->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'tax_rate.name' )]); !!}
      </div>

      <div class="form-group">
        {!! Form::label('amount', __( 'tax_rate.rate' ) . ':*') !!} @show_tooltip(__('lang_v1.tax_exempt_help'))
          {!! Form::text('amount', $tax_rate->amount, ['class' => 'form-control input_number', 'required']); !!}
      </div>
 <div class="form-group">
        {!! Form::label('min_amount', __( 'tax_rate.min_amount' ) . ':') !!} @show_tooltip(__('lang_v1.min_amount_tax_help'))
          {!! Form::text('min_amount', $tax_rate->min_amount, ['class' => 'form-control input_number']); !!}
      </div>
     
      <div class="form-group">
        <p>@lang('lang_v1.for_tax_group_only') @show_tooltip(__('lang_v1.for_tax_group_only_help'))</p>
        <div class="toggle-wrapper d-flex gap-2 mt-4">
            <label class="switch" for="for_tax_group">
                {!! Form::checkbox('for_tax_group', 1, !empty($tax_rate->for_tax_group), ['id' => 'for_tax_group']) !!}
                <div class="sliderCheckbox round"></div>
            </label>
        </div>
    </div>
    

    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->