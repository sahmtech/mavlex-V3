<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('VariationTemplateController@update', [$variation->id]), 'method' => 'PUT', 'id' => 'variation_edit_form', 'class' => 'form-horizontal' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">@lang('lang_v1.edit_variation')</h4>
      <p>@lang( 'sale.products' )</p>
    </div>

    <div class="modal-body">
      <div class="form-group">
        {!! Form::label('name',__('lang_v1.variation_name') . ':*', ['class' => 'col-sm-3 control-label']) !!}

        <div class="col-sm-9">
          {!! Form::text('name', $variation->name, ['class' => 'form-control', 'required', 'placeholder' => __('lang_v1.variation_name')]); !!}
        </div>
      </div>
<div class="form-group">
    <label class="col-sm-3 control-label">@lang('lang_v1.add_variation_values'):*</label>
    <div class="col-sm-9">
        <div class="input-group">
            @php $first = $variation->values->first(); @endphp
            {!! Form::text('edit_variation_values['.$first->id.']', $first->name, ['class'=>'form-control','required']) !!}
            <span class="input-group-btn">
                <button type="button" id="add_variation_values" class="btn btn-default"><i class="fa fa-plus"></i></button>
            </span>
        </div>
    </div>
</div>

      <div id="variation_values">
        @foreach( $variation->values as $attr)
          @if( !$loop->first )
            <div class="form-group">
              <div class="col-sm-7 col-sm-offset-3">
                {!! Form::text('edit_variation_values[' . $attr->id . ']', $attr->name, ['class' => 'form-control', 'required']); !!}
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang('messages.update')</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->