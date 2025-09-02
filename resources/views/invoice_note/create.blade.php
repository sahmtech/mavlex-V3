<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
  
      {!! Form::open(['url' => action('InvoiceNoteController@store'), 'method' => 'post', 'id' => 'invoice_note_add_form']) !!}
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">@lang( 'lang_v2.notes' )</h3>
        <p>@lang( 'lang_v2.invoices' )</p>
      </div>
  
      <div class="modal-body">
        <div class="row">
          @if(!empty($sell->payment_status) && $sell->payment_status != 'paid')
          <span class="invoice-status__not-paid ">{{ __('lang_v1.' . $sell->payment_status) }}</span>
          @else
          <span class="invoice-status__paid">@lang('lang_v1.paid')</span>
          @endif
          <br /><br />
				<div>
					<div class="form-box">
						<textarea
							name="description"
							id="note_description"
							cols="30"
							rows="10"
							placeholder="Start Typing"
							style="font-family: inherit"></textarea>
						<input type="hidden" name="transaction_id" value="{{ $sell->id }}" />
						<input type="hidden" name="note_id" id="note_id" value="" />

						<div style="display: flex; justify-content: flex-end">
							<button class="primary-btn">
								<i class="fa fa-plus"></i>
								<span class="note_btn">Add Note</span>
							</button>
						</div>
					</div>

					<table class="general-table" style="margin-top: 20px">
						<thead>
							<tr>
								<th>@lang('lang_v1.added_by')</th>
								<th>@lang('lang_v1.description')</th>
								<th>@lang('lang_v1.date')</th>
								<th></th>
							</tr>
						</thead>

						<tbody id="table_data">
							@foreach($sell->notes as $note)
								<tr>
									<td>{{ $note->created_user->user_full_name }}</td>
									<td>{{ $note->description }}</td>
									<td>{{ $note->date }}</td>
									<td>
										<div class="invoice-table-options">
											<button type="button" data-href="{{action('InvoiceNoteController@edit', [$note->id])}}" class="edit_invoice_note">
												<img src="{{ asset('img/icons/edit.svg') }}" alt="" />
											</button>

											<button type="button" data-href="{{action('InvoiceNoteController@destroy', [$note->id])}}" class="delete_invoice_note">
												<img src="{{ asset('img/icons/delete.svg') }}" alt="" />
											</button>
										</div>
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