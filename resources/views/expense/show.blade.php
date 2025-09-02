@extends('layouts.app')
@section('title', 'Purchase Details')

@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          Purchase Details
          <small class="pull-right"><b>@lang('lang_v1.date'):</b> {{ date( 'd/m/Y', strtotime( $purchase->transaction_date ) ) }}</small>
        </h2>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <b>@lang('lang_v1.cn_no_label'):</b> #{{ $purchase->ref_no }}<br>
        <b>@lang('business.location'):</b> {{ $purchase->location->name }}<br>
        <b>@lang('lang_v2.status'):</b> {{ ucfirst( $purchase->status ) }}<br>
        <b>@lang('purchase.payment_status'):</b> {{ ucfirst( $purchase->payment_status ) }}<br>
      </div>
      <div class="col-sm-4">
        <b>@lang('purchase.supplier'):</b> {{ $purchase->contact->name }}<br>
        <b>@lang('lang_v1.business'):</b> {{ $purchase->contact->supplier_business_name }}<br>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-xs-12">
        <div class="table-responsive">
          <table class="table bg-gray">
            <tr class="bg-green">
              <th>#</th>
              <th>@lang('lang_v1.product')</th>
              <th>@lang('lang_v1.quantity')</th>
              <th>@lang('purchase.unit_cost_before_tax')</th>
              <th>@lang('purchase.subtotal_before_tax')</th>
              <th>@lang('lang_v1.tax')</th>
              <th>@lang('purchase.unit_cost_after_tax')</th>
              <th>@lang('purchase.unit_selling_price')</th>
              <th>@lang('sale.subtotal')</th>
            </tr>
            @php 
              $total_before_tax = 0.00;
            @endphp
            @foreach($purchase->purchase_lines as $purchase_line)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  {{ $purchase_line->product->name }}
                   @if( $purchase_line->product->type == 'variable')
                    - {{ $purchase_line->variations->product_variation->name}}
                    - {{ $purchase_line->variations->name}}
                   @endif
                </td>
                <td>{{ $purchase_line->quantity }}</td>
                <td><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->purchase_price }}</span></td>
                <td><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->quantity * $purchase_line->purchase_price }}</span></td>
                <td><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->item_tax }} </span> @if($purchase_line->tax_id) ( {{ $taxes[$purchase_line->tax_id]}} ) @endif</td>
                <td><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->purchase_price_inc_tax }}</span></td>
                <td><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->variations->default_sell_price }}</span></td>
                <td><span class="display_currency" data-currency_symbol="true">{{ $purchase_line->purchase_price_inc_tax * $purchase_line->quantity }}</span></td>
              </tr>
              @php 
                $total_before_tax += ($purchase_line->quantity * $purchase_line->purchase_price);
              @endphp
            @endforeach
          </table>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-xs-6">
        <p><b>@lang('purchase.shipping_details'):</b></p>
        <p class="well well-sm no-shadow bg-gray" style="border-radius: 0px;">
         {{ $purchase->shipping_details }}
        </p>
        <p><b>@lang('purchase.additional_notes'):</b></p>
        <p class="well well-sm no-shadow bg-gray" style="border-radius: 0px;">
         {{ $purchase->additional_notes }}
        </p>
      </div>
      <div class="col-xs-6">
        <div class="table-responsive">
          <table class="table bg-gray">
            <tr>
              <th>@lang('purchase.total_before_tax'): </th>
              <td></td>
              <td><span class="display_currency pull-right">{{ $total_before_tax }}</span></td>
            </tr>
            <tr>
              <th>@lang('purchase.total_after_tax'): </th>
              <td></td>
              <td><span class="display_currency pull-right">{{ $total_before_tax }}</span></td>
            </tr>
            <tr>
              <th>@lang('purchase.purchase_tax'):</th>
              <td><b>(+)</b></td>
              <td><span class="display_currency pull-right">{{ $purchase->tax_amount }}</span></td>
            </tr>
            <tr>
              <th>@lang('purchase.discount'):</th>
              <td><b>(-)</b></td>
              <td><span class="display_currency pull-right">{{ $purchase->discount_amount }}</span></td>
            </tr>
            @if( !empty( $purchase->shipping_charges ) )
              <tr>
                <th>@lang('purchase.ep_additional_shipping_charges'):</th>
                <td><b>(+)</b></td>
                <td><span class="display_currency pull-right" >{{ $purchase->shipping_charges }}</span></td>
              </tr>
            @endif
            <tr>
              <th>@lang('purchase.purchase_total'):</th>
              <td></td>
              <td><span class="display_currency pull-right" data-currency_symbol="true" >{{ $purchase->final_total }}</span></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
@endsection