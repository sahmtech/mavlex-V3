@php
$transaction_types = [];
if(in_array($contact->type, ['both', 'supplier'])){
$transaction_types['purchase'] = __('lang_v1.purchase');
$transaction_types['purchase_return'] = __('lang_v1.purchase_return');
}

if(in_array($contact->type, ['both', 'customer'])){
$transaction_types['sell'] = __('sale.sale');
$transaction_types['sell_return'] = __('lang_v1.sell_return');
}

$transaction_types['opening_balance'] = __('lang_v1.opening_balance');
@endphp


<div class="card-wrapper" style="margin-bottom:30px;">

    <div class="overview-filter">
        <div class="title">
            <h2> @lang('lang_v1.ledger')</h2>
        </div>
        <div class="col-md-12">
            <div class="col-md-9 text-right">
                <button data-href="{{action('ContactController@getLedger')}}?contact_id={{$contact->id}}&action=pdf" class="btn btn-default btn-xs" id="print_ledger_pdf" data-toggle="tooltip" data-placement="top" title="Download PDF"><img src="{{ asset('img/icons/pdf.svg') }}" alt="pdf" width="20" height="20"></button>

                <button type="button" class="btn btn-default btn-xs" id="send_ledger" data-toggle="tooltip" data-placement="top" title="Send Email"><img src="{{ asset('img/icons/email.svg') }}" alt="email" width="18" height="18"></button>
            </div>
        </div>
        <div class="filter">

            <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                <img src="{{ asset('img/icons/filter.svg') }}" alt="">
               
            </a>
        </div>
    </div>

    @component('components.filters', ['title' => __('report.filters')])

    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('ledger_date_range', __('report.date_range') . ':') !!}
            {!! Form::text('ledger_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
        </div>
    </div>
    @endcomponent


    <div id="contact_ledger_div"></div>
</div>