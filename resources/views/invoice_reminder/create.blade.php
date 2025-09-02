<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
  
      {!! Form::open(['url' => action('InvoiceReminderController@store'), 'method' => 'post', 'id' => 'invoice_reminder_add_form']) !!}
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">@lang( 'lang_v2.reminders' )</h3>
        <p>@lang( 'lang_v2.invoices' )</p>
      </div>
  
      <div class="modal-body">
        <div class="row">
          @if(!empty($sell->payment_status) && $sell->payment_status != 'paid')
          <span class="invoice-status__not-paid ">{{ __('lang_v1.' . $sell->payment_status) }}</span>
          @else
          <span class="invoice-status__paid">@lang( 'lang_v1.paid' )</span>
          @endif
          <button type="button" class="set-reminder" onclick="addReminderToggle()">
            Set Reminder
            <img src="{{ asset('img/icons/notification.svg') }}" alt="" />
        </button>
          <br/><br/>
				<div>
					<div class="invoice-reminder-form" id="reminder-form">
						<div class="form-box">
                            <div class="form-group">
                                {!! Form::label('date', __('lang_v2.date_to_be_notified') . ':*') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    {!! Form::text('date', null, ['class' => 'form-control date_to_notify', 'readonly', 'required']); !!}
                                </div>
                            </div>
						</div>

                        <div class="form-box">
                            <div class="form-group">
                                {!! Form::label('set_reminder_to', __('lang_v2.set_reminder_to') . ':') !!}
						        {!! Form::select('set_reminder_to', $commission_agent, null, ['class' => 'form-control select2', 'required' => 'required']); !!}
                            </div>
						</div>
						<br />

						<div class="form-box">
							<label for="">@lang( 'lang_v1.description' )</label>
							<textarea
								name="description"
								id="reminder_description"
								cols="30"
								rows="10"
								placeholder="Start typing"></textarea>
						</div>

						<div
							style="
								display: flex;
								align-items: center;
								gap: 16px;
								margin-top: 20px;
							">
                            <label class="switchBtn" for="send_email">
                                {!! Form::checkbox('send_email', 1, false, ['id' => 'send_email']); !!}
                                  <span class="slider"></span>
                            </label>
							<span>@lang( 'lang_v1.also_send_an_email_reminder' )</span>
						</div>
                        {!! Form::hidden('transaction_id', $sell->id); !!}
						<div
							style="
								display: flex;
								align-items: center;
								justify-content: center;
								gap: 24px;
							">
							<button type="button" data-dismiss="modal" class="secondary-btn">@lang( 'messages.cancel' )</button>
							<button class="primary-btn">@lang( 'messages.save' )</button>
						</div>
					</div>

					<table class="general-table" style="margin-top: 20px">
						<thead>
							<tr>
								<th>@lang( 'lang_v1.description' )</th>
								<th>@lang( 'lang_v1.date' )</th>
								<th>@lang( 'lang_v1.remind' )</th>
								<th>@lang( 'lang_v1.notified' )</th>
							</tr>
						</thead>

						<tbody id="table_data">
							@foreach($sell->reminders as $reminder)
								<tr>
									<td>{{ $reminder->description }}</td>
									<td>{{ $reminder->date }}</td>
                                    <td>{{ $reminder->created_user->user_full_name }}</td>
									<td>
                                        @if ($reminder->status == 1)
                                            <span class="label bg-light-green">@lang( 'lang_v1.sent' )</span>
                                        @else
                                            <span class="label bg-yellow">@lang( 'lang_v1.not_sent' )</span>
                                        @endif
                                        
                                    </td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
        </div>
      </div>
  
      {!! Form::close() !!}
  
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        const setReminderBtn = document.getElementById("set-reminder-btn");
        if (setReminderBtn) {
            setReminderBtn.addEventListener("click", addReminderToggle);
        }
    });

    function addReminderToggle() {
        const reminderForm = document.getElementById("reminder-form");
        if (reminderForm) {
            reminderForm.classList.toggle("show-reminder-form");
        }
    }
</script>