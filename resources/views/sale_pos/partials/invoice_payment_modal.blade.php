<div class="modal fade" id="successfull_invoice_payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" style="display: block; text-align: center;" id="myModalLabel">@lang( 'lang_v1.your_payment_was_successful' )</h4>
        </div>
        <div class="modal-body" style="text-align: center;">
            <div class="image">
                <img src="{{ asset('img/icons/success-icon.svg') }}" alt="" />
            </div>
            <br>
          {{--<span>Recurring Payment? <a href="#">Add a reminder</a> </span>--}}
        </div>
        <div class="modal-footer  options-btn">
          <button type="button" id="print_invoice" class="primary-btn">@lang( 'lang_v1.print_invoice' )</button>
          <button type="button" class="secondary-btn" data-dismiss="modal">@lang('messages.close')</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="failed_invoice_payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" style="display: block; text-align: center;" id="myModalLabel">Payment Failed</h4>
        </div>
        <div class="modal-body" style="text-align: center;">
            <div class="image">
                <img src="{{ asset('img/icons/payment-failed.svg') }}" alt="" />
            </div>
            <br>
            <span>Sorry, We could not process Your Payment</span>
        </div>
        <div class="modal-footer options-btn">
          <button type="button" class="secondary-btn" data-dismiss="modal">Proceed to Dashboard</button>
          <button type="button" id="print_invoice" class="primary-btn">Retry</button>
        </div>
      </div>
    </div>
  </div>