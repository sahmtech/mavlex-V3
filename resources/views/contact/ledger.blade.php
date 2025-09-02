<!-- app css -->
@if(!empty($for_pdf))
	<link rel="stylesheet" href="{{ asset('css/app.css?v='.$asset_v) }}">
@endif
<div class="clearfix"></div>
<div class="customer-account-summary">
<div class="head">
    <h6>@lang('lang_v1.account_summary')</h6>
    <span>{{$ledger_details['start_date']}} @lang('lang_v1.to') {{$ledger_details['end_date']}}</span>
</div>

<div class="full-summary">
    <div class="details">
        <div class="item">
            <span>@lang('lang_v1.to'):</span>
			@php
				if ($contact->contact_type == 'business') {
					$contact_name = $contact->supplier_business_name;
				} else {
					$contact_name = $contact->name;
				}

			@endphp
            <strong>{{$contact_name}}</strong> 
        </div>

        @if(!empty($contact->email))
	    	<div class="item">
	    		<span>@lang('business.email'):</span>
	    		<strong>{{$contact->email}}</strong>
	    	</div> 
	@endif

        <div class="item"> 
            <span>@lang('contact.mobile'):</span>

            <strong>{{$contact->mobile}}</strong>
        </div>

        @if(!empty($contact->tax_number))
        	<div class="item">
        		<span>@lang('contact.tax_no'):</span>
        		<strong>{{$contact->tax_number}}</strong>
        	</div>
        @endif
    </div>

    <div class="balance-info">
        <div class="item">
            <span>@lang('lang_v1.opening_balance')</span>
            <strong>@format_currency($ledger_details['beginning_balance'])</strong>
        </div>
        @if( $contact->type == 'supplier' || $contact->type == 'both')
			<div class="item">
				<span>@lang('report.total_purchase')</span>
				<strong>@format_currency($ledger_details['total_purchase'])</strong>
			</div>
		@endif

		@if( $contact->type == 'customer' || $contact->type == 'both')
	        <div class="item">
	            <span>@lang('lang_v1.total_invoice')</span>
	            <strong>@format_currency($ledger_details['total_invoice'])</strong>
	        </div>
        @endif
	<div class="item">
		<span>@lang('sale.total_paid')</span>
		<strong>@format_currency($ledger_details['total_paid'])</strong>
	</div>
	<div class="item">
		<span>@lang('lang_v1.advance_balance')</span>
		<strong>@format_currency($contact->balance)</strong>
	</div>
	<div class="item">
		<strong>@lang('lang_v1.balance_due')</strong>
		<strong>@format_currency($ledger_details['balance_due'])</strong>
	</div>
    </div>
</div>
</div>
<br>
<span>@lang('lang_v1.ledger_table_heading', ['start_date' => $ledger_details['start_date'], 'end_date' => $ledger_details['end_date']])</span>
<table class="table table-striped @if(!empty($for_pdf)) table-pdf td-border @endif general-table" id="ledger_table">
	<thead>
		<tr class="row-border blue-heading">
			<th width="13%" class="text-center">@lang('lang_v1.date')</th>
			<th width="9%" class="text-center">@lang('purchase.ref_no')</th>
			<th width="8%" class="text-center">@lang('lang_v1.type')</th>
			<th width="10%" class="text-center">@lang('sale.location')</th>
			<th width="15%" class="text-center">@lang('sale.payment_status')</th>
			{{--<th width="10%" class="text-center">@lang('sale.total')</th>--}}
			<th width="10%" class="text-center">@lang('account.debit')</th>
			<th width="5%" class="text-center">@lang('account.credit')</th>
			<th width="5%" class="text-center">@lang('lang_v1.balance')</th>
			<th width="5%" class="text-center">@lang('account.advance')</th>
			<th width="15%" class="text-center">@lang('lang_v1.payment_method')</th>
			<th width="5%" class="text-center">@lang('report.others')</th>
		</tr>
	</thead>
	<tbody>
		@foreach($ledger_details['ledger'] as $data)
			<tr @if(!empty($for_pdf) && $loop->iteration % 2 == 0) class="odd" @endif>
				<td class="row-border">{{@format_datetime($data['date'])}}</td>
				<td>{{$data['ref_no']}}</td>
				<td>{{$data['type']}}</td>
				<td>{{$data['location']}}</td>
				<td>{{$data['payment_status']}}</td>
				{{--<td class="ws-nowrap align-right">@if($data['total'] !== '') @format_currency($data['total']) @endif</td>--}}
				<td class="ws-nowrap align-right">@if($data['debit'] != '') @format_currency($data['debit']) @endif</td>
				<td class="ws-nowrap align-right">@if($data['credit'] != '') @format_currency($data['credit']) @endif</td>
				<td class="ws-nowrap align-right">{{$data['balance']}}</td>
				<td class="ws-nowrap align-right">@if($data['advance'] != '') @format_currency($data['advance']) @endif</td>
				<td>{{$data['payment_method']}}</td>
				<td>{!! $data['others'] !!}</td>
			</tr>
		@endforeach
	</tbody>
</table>