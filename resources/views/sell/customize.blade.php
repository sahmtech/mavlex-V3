<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
  
      {!! Form::open(['url' => action('SellController@storeCustomize'), 'method' => 'post', 'id' => 'customize_invoice_form']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Invoice Settings</h4>
      </div>
  
      <div class="modal-body">
        <div>
            <div class="form-box">
                {!! Form::label('logo', __('invoice.invoice_logo') . ':') !!}
                {!! Form::file('logo', ['accept' => 'image/*']); !!}
            </div>
        </div>

        <br />

        <div class="ContentTwoGrid">
            <div class="form-box">
                {!! Form::label('invoice_prefix', 'Invoice Prefix') !!}
              {!! Form::text('invoice_prefix', $customize_invoice["invoice_prefix"], ['class' => 'form-control', 'required', 'placeholder' => 'INV']); !!}
            </div>

            <div class="form-box">
                {!! Form::label('currency_id', __('business.currency') . ':') !!}
                {!! Form::select('currency_id', $currencies, $customize_invoice["currency_id"], ['placeholder' => __('business.currency'), 'class' => 'form-control',  'required']); !!}
            </div>

            <div class="form-box">
                {!! Form::label('auto_reminder', __('invoice.auto_reminder') . ':') !!}
                {!! Form::select('auto_reminder', [1 => 'Enabled', 0 => 'Disabled'], $customize_invoice["auto_reminder"], ['class' => 'form-control', 'placeholder' => __('invoice.auto_reminder'), 'required']); !!}
            </div>

            <div class="form-box">
                {!! Form::label('auto_due_date', __('invoice.auto_due_date') . ':') !!}
                {!! Form::text('auto_due_date', $customize_invoice["auto_due_date"], ['class' => 'form-control', 'required']); !!}
            </div>

            <div class="form-box">
                {!! Form::label('tax_rate_id', __('invoice.tax_rate') . ':*') !!}
                {!! Form::select('tax_rate_id', $taxes['tax_rates'], $customize_invoice["tax_rate_id"], ['placeholder' => __('messages.please_select'),'class' => 'form-control' ]); !!}
            </div>

            <div class="form-box">
                {!! Form::label('default_discount_type', __('invoice.default_discount_type') . ':*') !!}
                {!! Form::select('default_discount_type', ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], $customize_invoice["default_discount_type"], ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); !!}
            </div>
        </div>

        <br />

        <div class="ContentTwoGrid">
            <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                <label class="switchBtn" for="enable_sales_agent">
                    {!! Form::checkbox('enable_sales_agent', 1, $customize_invoice["enable_sales_agent"], ['id' => 'enable_sales_agent']); !!}
                    <div class="slider"></div>
                </label>
                <p>@lang('invoice.enable_sales_agent')</p>

            </div>
            

            <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                <label class="switchBtn" for="enable_commission_agent">
                    {!! Form::checkbox('enable_commission_agent', 1, $customize_invoice["enable_commission_agent"], ['id' => 'enable_commission_agent']); !!}
                    <div class="slider"></div>
                </label>
                <p>@lang('invoice.enable_commission_agent')</p>

            </div>
        </div>

        <br /><br />
        <div class="form-box">
            {!! Form::label('footer_text', __('invoice.footer_text') . ':*') !!}
            {!! Form::text('footer_text', $customize_invoice["footer_text"], ['class' => 'form-control', 'required',
          'placeholder' => __('invoice.footer_text')]); !!}
        </div>
        
      </div>
  
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
      </div>
  
      {!! Form::close() !!}
  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->