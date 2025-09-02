@extends('layouts.app')

@section('title', __('lang_v1.invoice_preview'))


@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
    	<div class="storys-container">
    @include('layouts.partials.sub_menu.invoice', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <div class="invoice-card-wrapper">
      {!! Form::open(['url' => action('NotificationController@send'), 'method' => 'post', 'id' => 'send_notification_form' ]) !!}
        <div class="invoice-preview-grid">
            <div class="invoice-container-preview">
                <h1 class="invoice-id">#{{ $sell->invoice_no }}</h1>

                <div class="invoice-date-status">
                    <div class="invoice-date">
                        <div class="item">
                            <span>@lang('messages.date')</span>
                            <p>{{ @format_date($sell->transaction_date) }}</p>
                        </div>
                    </div>

                    <div class="invoice-status">
                        <h5>@lang('lang_v2.status')</h5>
                        @if(!empty($sell->payment_status) && $sell->payment_status != 'paid')
                        <span class="not-paid">{{ __('lang_v1.' . $sell->payment_status) }}</span>
                        @else
                        <span class="paid">@lang('lang_v1.paid')</span>
                        @endif
                    </div>
                </div>

                <div class="invoice-bill-info">
                    <div class="company-address">
                        <h3>{{ $sell->contact->name }}</h3>
                        <span>
                        
                        @if($sell->contact->mobile)
                            {{__('contact.mobile')}}: {{ $sell->contact->mobile }}
                        @endif
                        @if($sell->contact->alternate_number)
                        ,
                            {{__('contact.alternate_contact_number')}}: {{ $sell->contact->alternate_number }}
                        @endif
                        @if($sell->contact->address_line_1)
                         <br>
                            {{ $sell->contact->address_line_1 }}
                        @endif
                        @if($sell->contact->landline)
                         ,
                            {{__('contact.landline')}}: {{ $sell->contact->landline }}
                        @endif

                        
                        </span>
                       
                    </div>

                    <div class="bill-address">
                        <h3>@lang('lang_v2.bill_to')</h3>
                        @if(!empty($sell->billing_address()))
                        <span>{{$sell->billing_address()}}</span>
                        @endif
                        
                    </div>
                </div>
                <div class="table-responsive" style="min-height: .01%; max-height:600px; overflow-x: auto; overflow-y:auto">
                @include('sale_pos.partials.sale_line_details')
                </div>
                @php
                      $total_paid = 0;
                    @endphp
                    @if($sell->type != 'sales_order')
                    @foreach($sell->payment_lines as $payment_line)
                    @php
                      if($payment_line->is_return == 1){
                        $total_paid -= $payment_line->amount;
                      } else {
                        $total_paid += $payment_line->amount;
                      }
                    @endphp
                    
                  @endforeach
                    
                    @endif

                <div class="pricing-table-wrapper">
                    <table class="pricing-table">
                        <tbody>
                            <tr>
                                <td>{{ __('sale.total') }}</td>
                                <td><span class="display_currency pull-right" data-currency_symbol="true">{{ $sell->total_before_tax }}</span></td>
                              </tr>
                              <tr>
                                <td>{{ __('sale.discount') }}<b>(-)</b></td>
                                <td><div class="pull-right"><span class="display_currency" @if( $sell->discount_type == 'fixed') data-currency_symbol="true" @endif>{{ $sell->discount_amount }}</span> @if( $sell->discount_type == 'percentage') {{ '%'}} @endif</span></div></td>
                              </tr>
                             
                              <tr>
                                 <td>{{ __('sale.order_tax') }}<b>(+)</b></td>
                                <td class="text-right">
                                  @if(!empty($order_taxes))
                                    @foreach($order_taxes as $k => $v)
                                      <strong><small>{{$k}}</small></strong> - <span class="display_currency pull-right" data-currency_symbol="true">{{ $v }}</span><br>
                                    @endforeach
                                  @else
                                  0.00
                                  @endif
                                </td>
                              </tr>
                              @if(!empty($line_taxes))
                              <tr>
                                <td>{{ __('lang_v1.line_taxes') }}</td>
                                <td class="text-right">
                                  @if(!empty($line_taxes))
                                    @foreach($line_taxes as $k => $v)
                                      <strong><small>{{$k}}</small></strong> - <span class="display_currency pull-right" data-currency_symbol="true">{{ $v }}</span><br>
                                    @endforeach
                                  @else
                                  0.00
                                  @endif
                                </td>
                              </tr>
                              @endif
                              
                  
                             
                              <tr>
                                <td>{{ __('lang_v1.round_off') }}</td>
                                <td><span class="display_currency pull-right" data-currency_symbol="true">{{ $sell->round_off_amount }}</span></td>
                              </tr>
                              <td>{{ __('lang_v1.shipping_charges') }}</td>
                        <td><span class="display_currency pull-right" data-currency_symbol="true">{{ $sell->shipping_charges }}</span></td>
                        </tr>
                              <tr>
                                <td>{{ __('sale.total_payable') }}</td>
                                <td><span class="display_currency pull-right" data-currency_symbol="true">{{ $sell->final_total }}</span></td>
                              </tr>
                              @if($sell->type != 'sales_order')
                              <tr>
                                <td>{{ __('sale.total_paid') }}</td>
                                <td><span class="display_currency pull-right" data-currency_symbol="true" >{{ $total_paid }}</span></td>
                              </tr>
                              <tr>
                                <td>{{ __('sale.total_remaining') }}</td>
                                <td>
                                  <!-- Converting total paid to string for floating point substraction issue -->
                                  @php
                                    $total_paid = (string) $total_paid;
                                  @endphp
                                  <span class="display_currency pull-right" data-currency_symbol="true" >{{ $sell->final_total - $total_paid }}</span></td>
                              </tr>
                              @endif
                        </tbody>
                      </table>
                    
                </div>

                <div class="invoice-message">
                    <b>@lang('brand.note')</b>

                    <p>
                        @if($sell->additional_notes)
                        {!! nl2br($sell->additional_notes) !!}
                      @else
                        --
                      @endif
                    </p>
                </div>
            </div>

            <div>
                <div class="invoice-options-box">
                    <div class="head">
                      <span class="invoice-status-{{ $sell->status }}">{{ ucfirst($sell->status) }}</span>
  
                      <div class="options">
                        <a href="{{ $url . '?print_on_load=true' }}" target="_blank" class="invoice-btn"><img src="{{ asset('img/icons/file.svg') }}" alt="" /></a>

                        <button class="invoice-btn">
                        @lang('lang_v1.send_mail')
                            <img src="{{ asset('img/icons/email.svg') }}" alt="" />
                        </button>
  
                        <div class="invoice-dropdown-wrapper">
                          <button type="button" class="invoice-btn" id="invoice-btn">
                          @lang('messages.action')
                            <img src="{{ asset('img/icons/chevron-bottom.svg') }}" alt="" />
                          </button>
  
                          <div class="invoice-dropdown" id="invoice-dropdown">
                            <a href="{{ $url }}" target="_blank" class="">@lang('lang_v1.view_as_customer')</a>
                            <button type="button" class="btn-modal" 
                            data-href="{{action('InvoiceNoteController@create', 'transaction_id=' . $sell->id)}}" 
                            data-container=".create_note_modal">
                            @lang('lang_v1.add_note')
                          </button>
                          <button type="button" class="btn-modal" 
                            data-href="{{action('InvoiceReminderController@create', 'transaction_id=' . $sell->id)}}" 
                            data-container=".create_reminder_modal">
                            @lang('lang_v1.set_reminder')
                          </button>
  
                            <hr style="border: 0.1px solid #d2d5da" ; />
  
                            <button type="button" id="mark_as_sent">@lang('lang_v1.mark_as_sent')</button>
                            <a href="{{action('SellPosController@duplicateInvoice', $sell->id)}}">@lang('lang_v1.duplicate')</a>
                            @if ($sell->payment_status == 'due')
                              <button type="button" id="delete_invoice" style="color: #dc2626;">@lang('messages.delete')</button>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="content">
                        <h3>@lang('lang_v1.amount_due') </h3>
                        <h1 class="display_currency" data-currency_symbol="true" >{{ $sell->final_total - $total_paid }}</h1>
                        {{--<p>Due on July 30, 2023</p>--}}

                        <div class="payment">
                            <p>@lang('lang_v1.already_paid_click_to_record_payment')</p>

                            <a href="{{ action('TransactionPaymentController@addPayment', [$sell->id]) }}" class="primary-btn add_payment_modal">@lang('lang_v1.record')</a>
                        </div>
                    </div>

                    <div class="bottom">
                        <span>@lang('lang_v1.also_attach_pdf_in_mail')</span>
                        <div>
                            <label class="switchBtn" for="attach_pdf">
                              {!! Form::checkbox('attach_pdf', 1, false, ['id' => 'attach_pdf']); !!}
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="invoice-link-box">
                    <h2 class="title">@lang('lang_v1.preview_invoice_link')</h2>

                    <div class="invoice-link-wrapper">
                        <input value="{{ $url }}" id="invoice_url" />
                        <button class="copy-btn" onclick="copyToClipboard();">
                            <img src="{{ asset('img/icons/copy.svg') }}" alt="" />
                            @lang('lang_v1.copy')
                        </button>
                    </div>
                </div>

                <button type="submit" class="send-invoice-btn" id="send_notification_btn">@lang('lang_v1.send_invoice')</button>

                <div class="invoice-options-btn-wrapper">
                    <a href="{{ $url }}" target="_blank">
                        <img src="{{ asset('img/icons/eye.png') }}" alt="" />
                        @lang('invoice.preview')
                    </a>

                    <a href="{{ route('sell.downloadPdf', [$sell->id]) }}" target="_blank">
                        <img src="{{ asset('img/icons/download.svg') }}" alt="" />
                        @lang('lang_v1.download')
                    </a>
                </div>
            </div>
        </div>
        
        {!! Form::hidden('notification_type[]', 'email'); !!}
        {!! Form::hidden('to_email', $sell->contact->email); !!}
        {!! Form::hidden('subject', 'Invoice'); !!}
        {!! Form::hidden('email_body', __('lang_v1.invoice_email_body')) !!}
        {!! Form::hidden('template_for', 'new_sale'); !!}
        {!! Form::hidden('transaction_id', $sell->id, ['id' => 'invoice_transaction_id']); !!}
        {!! Form::hidden('sms_body', ''); !!}
        {!! Form::hidden('whatsapp_text', ''); !!}
        {!! Form::close() !!}
    </div>
</div>

<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal fade create_note_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade create_reminder_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
@endsection

@section('javascript')

<script type="text/javascript">
    
    function copyToClipboard() {
      var temp = $("<input>");
      $("body").append(temp);
      temp.val($('#invoice_url').val()).select();
      document.execCommand("copy");
      temp.remove();
      alert("Copied to clipboard");
    }

    $('.create_reminder_modal').on('shown.bs.modal', function() {
        $('.create_reminder_modal')
            .find('.select2')
            .each(function() {
                __select2($(this));
            });
    });
  </script>
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#send_notification_form').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function(response) {
                    // Show success message on the page
                    var message = $('<div class="alert alert-success"></div>').text(response.msg);
                    form.prepend(message);
                    setTimeout(function() {
                        message.fadeOut();
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    // Show error message on the page
                    var response = JSON.parse(xhr.responseText);
                    var message = $('<div class="alert alert-danger"></div>').text(response.msg);
                    form.prepend(message);
                    setTimeout(function() {
                        message.fadeOut();
                    }, 3000);
                }
            });
        });
    });
</script>

@endsection

  