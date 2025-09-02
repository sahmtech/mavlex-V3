<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action('BusinessController@storeSmsSettings'), 'method' => 'post', 'id' => 'sms_settings_add_form' ]) !!}

    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">SMS Sender ID</h4>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            {!! Form::label('senderID', 'Sender ID:*') !!}
              {!! Form::text('senderID', null, ['class' => 'form-control', 'required', 'placeholder' => 'Sender ID' ]); !!}
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            {!! Form::label('description', 'Description:*') !!}
              {!! Form::text('description', null, ['class' => 'form-control', 'required', 'placeholder' => 'Description']); !!}
          </div>
        </div>


      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Request</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->