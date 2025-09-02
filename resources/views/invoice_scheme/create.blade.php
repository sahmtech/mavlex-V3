<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('InvoiceSchemeController@store'), 'method' => 'post', 'id' => 'invoice_scheme_add_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang( 'invoice.add_invoice' )</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="option-div-group">
          <div class="col-sm-4">
            <div class="form-group">
              <div class="option-div">
                <h4>@lang('lang_v1.format')<br>XXXX <i class="fa fa-check-circle pull-right icon"></i></h4>
                {!! Form::radio('scheme_type', 'blank'); !!}
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <div class="option-div">
                <h4>@lang('lang_v1.format') <br>{{ date('Y') }}{{config('constants.invoice_scheme_separator')}}XXXX <i class="fa fa-check-circle pull-right icon"></i></h4>
                {!! Form::radio('scheme_type', 'year'); !!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>@lang('invoice.preview'):</label>
            <div id="preview_format">@lang('invoice.not_selected')</div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            {!! Form::label('name', __( 'invoice.name' ) . ':*') !!}
              {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'invoice.name' ) ]); !!}
          </div>
        </div>
        <div id="invoice_format_settings" class="hide">
        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('prefix', __( 'invoice.prefix' ) . ':') !!}
            <div class="input-group col-md-12 col-sm-12">
              <span class="input-group-addon">
                  <i class="fa fa-info"></i>
              </span>
                {!! Form::text('prefix', null, ['class' => 'form-control', 'placeholder' => '']); !!}
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('start_number', __( 'invoice.start_number' ) . ':') !!}
            <div class="input-group col-md-12 col-sm-12">
              <span class="input-group-addon">
                  <i class="fa fa-info"></i>
              </span>
                {!! Form::number('start_number', 1, ['class' => 'form-control', 'required', 'min' => 1 ]); !!}
            </div>
          </div>
        </div>
        <div class="clearfix">
        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::label('total_digits', __( 'invoice.total_digits' ) . ':') !!}
            <div class="input-group col-md-12 col-sm-12">
              <span class="input-group-addon">
                  <i class="fa fa-info"></i>
              </span>
              {!! Form::select('total_digits', ['4' => '4', '5' => '5', '6' => '6', '7' => '7', 
              '8' => '8', '9'=>'9', '10' => '10'], 4, ['class' => 'form-control', 'required']); !!}
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
              <p>@lang('barcode.set_as_default')</p>
              <div class="toggle-wrapper d-flex gap-2 mt-4">
                  <label class="switch" for="is_default">
                      {!! Form::checkbox('is_default', 1, false, ['id' => 'is_default']) !!}
                      <div class="sliderCheckbox round"></div>
                  </label>
              </div>
          </div>
      </div>
      
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->