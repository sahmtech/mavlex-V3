
<style>
  .payment-box-two h3 {
        font-size: 25px;
        margin-bottom: 20px;
        text-align: center;
        color: var(--secondary-color);
      }
      
      .payment-button-two {
        margin-top: 1.438rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
      }
      .payment-button-two .payment-button-item-two {
        background: var(--primary-color);
        border: none;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        font-weight: bold;
        line-height: 24px;
        height: 60px;
        border-radius: 5px;
        cursor: pointer;
        color: black;
      }
  </style>

<div class="modal fade" id="review_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <h2>Could you kindly spare a moment to rate the agent who assisted you during onboarding?</h2>
        <div class="payment-button-two">
          <a class="payment-button-item-two" href="{{session()->get('review_alert_link')}}" >Yes Please</a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
      </div>
    </div>
  </div>
</div>