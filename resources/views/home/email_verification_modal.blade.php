<div class="modal fade" tabindex="-1" role="dialog" id="email_verification_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">@lang('lang_v1.please_verify_email')</h4>
      </div>

      <div class="modal-body">

        <div class="modal__dialog-content">
            <div class="form-box">
                <input id="email_adddress" placeholder="Enter Email Address" type="email" value="{{auth()->user()->email}}">
                <button class="btn verify-btn email_verification">@lang('lang_v1.continue')</button>
            </div>
        </div>
        
      </div>  
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="email_verified_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">@lang('lang_v1.please_verify_email')</h4>
      </div>

      <div class="modal-body">

        <div class="modal__dialog-content">
            <div class="email-sent-content">
                <div class="image">
                    <img src="{{ asset('img/icons/mail.png') }}" alt="" />
                </div>

                <p>
                @lang('lang_v1.email_sent_text')
                </p>

                <div class="resend-mail">
                @lang('lang_v1.email_not_recieved') <button id="resend-email">@lang('lang_v1.resend')</button>
                </div>
            </div>
        </div>
        
      </div>  
    </div>
  </div>
</div>

