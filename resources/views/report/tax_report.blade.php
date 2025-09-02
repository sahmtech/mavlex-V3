@extends('layouts.app')
@section('title', __( 'report.tax_report' ))

@section('content')
<div class="main-container">
               
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.report.expense-account', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="report-card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                 <h1>@lang( 'report.tax_report' )</h1>
                <p>@lang( 'report.reports' )</p>
            </div>


            <div class="filter">
                <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </a>
            </div>          
        </div>
        <!-- End of Filter through table -->
            @component('components.filters', ['title' => __('report.filters')])
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                        {!! Form::select('tax_report_location_id', $business_locations, null, ['class' => 'form-control select2', 'id' => 'tax_report_location_id', 'style' => 'width: 100%;']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('tax_report_contact_id', __( 'report.contact' ) . ':') !!}
                        {!! Form::select('tax_report_contact_id', $contact_dropdown, null , ['class' => 'form-control select2', 'id' => 'tax_report_contact_id', 'placeholder' => __('lang_v1.all'), 'style' => 'width: 100%;']); !!}
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('trending_product_date_range', __('report.date_range') . ':') !!}       
                        {!! Form::text('tax_report_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'tax_report_date_range', 'readonly']); !!}  
                </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary pull-right">@lang('report.apply_filters')</button>
                </div> 
                {!! Form::close() !!}
            @endcomponent
        <div class="overall">
            <strong>@lang('lang_v1.overall')</strong> <span> @lang('lang_v1.overall_tax_formula')</span>
        </div>
        
        <div class="sales-report-stats">
            <div class="item">
                <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                <div class="content">
                    <h3>@lang('lang_v1.overall')</h3>
                    <h1 class="tax_diff">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </h1>
                </div>
            </div>

            
            <!-- <div class="item">
                <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                <div class="content">
                    <h3>{{ __('report.input_tax') }}</h3>
                    <h1 class="input_tax">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </h1>
                </div>
            </div>

            <div class="item">
                <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                <div class="content">
                    <h3>{{ __('report.output_tax') }}</h3>
                    <h1 class="output_tax">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </h1>
                </div>
            </div>

            <div class="item">
                <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                <div class="content">
                    <h3>{{ __('lang_v1.expense_tax') }}</h3>
                    <h1 class="expense_tax">
                        <i class="fa fa-refresh fa-spin fa-fw"></i>
                    </h1>
                </div>
            </div> -->
        </div>

        <div class="overview-filter">
            <div>
                
            </div>

            <div class="filter">
                <div class="form-box" style="width: 210px;">
                    <select name="" id="taxType">
                        <option value="input_tax_tab">@lang('report.input_tax')</option>
                        <option value="output_tax_tab">@lang('report.output_tax')</option>
                        <option value="expense_tax_tab">@lang('lang_v1.expense_tax')</option>
                    </select>
                </div>
                
                <!-- Print button -->
                <button onclick="window.print();" class="report-print">
                    <img src="{{ asset('img/icons/printer.svg') }}" alt="">
                </button>
            </div>
        </div>

        <div class="content" id="input_tax_tab">
            <table class="report-table" id="input_tax_table">
                <thead>
                    <tr>
                        <th>@lang('messages.date')</th>
                        <th>@lang('purchase.ref_no')</th>
                        <th>@lang('purchase.supplier')</th>
                        <th>@lang('contact.tax_no')</th>
                        <th>@lang('sale.total_amount')</th>
                        <th>@lang('lang_v1.payment_method')</th>
                        <th>@lang('receipt.discount')</th>
                        @foreach($taxes as $tax)
                            <th>
                                {{$tax['name']}}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tfoot>
                    <tr class="footer-total">
                        <td colspan="4"><strong>@lang('sale.total'):</strong></td>
                        <td><span class="display_currency" id="sell_total" data-currency_symbol ="true"></span></td>
                        <td class="input_payment_method_count"></td>
                        <td>&nbsp;</td>
                        @foreach($taxes as $tax)
                            <td>
                                <span class="display_currency" id="total_input_{{$tax['id']}}" data-currency_symbol ="true"></span>
                            </td>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="one-table-grid" id="output_tax_tab" style="display: none;">
            <table class="report-table" id="output_tax_table">
                <thead>
                    <tr>
                        <th>@lang('messages.date')</th>
                        <th>@lang('sale.invoice_no')</th>
                        <th>@lang('contact.customer')</th>
                        <th>@lang('contact.tax_no')</th>
                        <th>@lang('sale.total_amount')</th>
                        <th>@lang('lang_v1.payment_method')</th>
                        <th>@lang('receipt.discount')</th>
                        @foreach($taxes as $tax)
                            <th>
                                {{$tax['name']}}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tfoot>
                    <tr class="footer-total">
                        <td colspan="4"><strong>@lang('sale.total'):</strong></td>
                        <td><span class="display_currency" id="purchase_total" data-currency_symbol ="true"></span></td>
                        <td class="output_payment_method_count"></td>
                        <td>&nbsp;</td>
                        @foreach($taxes as $tax)
                            <td>
                                <span class="display_currency" id="total_output_{{$tax['id']}}" data-currency_symbol ="true"></span>
                            </td>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="one-table-grid" id="expense_tax_tab" style="display: none;">
            <table class="report-table" id="expense_tax_table">
                <thead>
                    <tr>
                        <th>@lang('messages.date')</th>
                        <th>@lang('purchase.ref_no')</th>
                        <th>@lang('contact.tax_no')</th>
                        <th>@lang('sale.total_amount')</th>
                        <th>@lang('lang_v1.payment_method')</th>
                        @foreach($taxes as $tax)
                            <th>
                                {{$tax['name']}}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tfoot>
                    <tr class="footer-total">
                        <td colspan="3"><strong>@lang('sale.total'):</strong></td>
                        <td>
                            <span class="display_currency" id="expense_total" data-currency_symbol ="true"></span>
                        </td> 
                        <td class="expense_payment_method_count"></td>
                        @foreach($taxes as $tax)
                            <td>
                                <span class="display_currency" id="total_expense_{{$tax['id']}}" data-currency_symbol ="true"></span>
                            </td>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>
@stop
@section('javascript')
<script type="text/javascript">
$(document).ready(function() {
    $('#taxType').on('change', function() {
        var target = $(this).find(":selected").val();
        if (target == 'output_tax_tab') {
            $('#input_tax_tab').hide();
            $('#output_tax_tab').show();
            $('#expense_tax_tab').hide();
            if (typeof (output_tax_datatable) == 'undefined') {
                output_tax_datatable = $('#output_tax_table').DataTable({
                    processing: true,
                    serverSide: true,
                    aaSorting: [[0, 'desc']],
                    ajax: {
                        url: '/reports/tax-details',
                        data: function(d) {
                            d.type = 'sell';
                            d.location_id = $('#tax_report_location_id').val();
                            d.contact_id = $('#tax_report_contact_id').val();
                            var start = $('input#tax_report_date_range')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            var end = $('input#tax_report_date_range')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                            d.start_date = start;
                            d.end_date = end;
                        }
                    },
                    columns: [
                    { data: 'transaction_date', name: 'transaction_date' },
                    { data: 'invoice_no', name: 'invoice_no' },
                    { data: 'contact_name', name: 'c.name' },
                    { data: 'tax_number', name: 'c.tax_number' },
                    { data: 'total_before_tax', name: 'total_before_tax' },
                    { data: 'payment_methods', orderable: false, "searchable": false },
                    { data: 'discount_amount', name: 'discount_amount' },
                    @foreach($taxes as $tax)
                    { data: "tax_{{$tax['id']}}", searchable: false, orderable: false },
                    @endforeach
                ],
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(); 

                    var total_before_tax = 0;
                    var discount_amount = 0;
                    var total_taxes = {};
                    @foreach($taxes as $tax)
                        total_taxes['tax_{{$tax['id']}}'] = 0;
                    @endforeach

                    api.rows({ search: 'applied' }).every(function() {
                        var rowData = this.data();

                        var totalBeforeTaxValue = parseFloat($(rowData.total_before_tax).data('orig-value')) || 0;
                        if (!isNaN(totalBeforeTaxValue)) {
                            total_before_tax += totalBeforeTaxValue;
                        } 

                        var discountAmountValue = parseFloat(rowData.discount_amount) || 0;
                        if (!isNaN(discountAmountValue)) {
                            discount_amount += discountAmountValue;
                        } 

                        @foreach($taxes as $tax)
                        var taxValue = parseFloat($(rowData['tax_{{$tax['id']}}']).data('orig-value')) || 0;
                        if (!isNaN(taxValue)) {
                            total_taxes['tax_{{$tax['id']}}'] += taxValue; 
                        }
                        @endforeach
                    });
                    $(api.column(4).footer()).html('$' + total_before_tax.toFixed(2)); 
                    $(api.column(6).footer()).html('$' + discount_amount.toFixed(2)); 

                    @foreach($taxes as $tax)
                        $(api.column({{ $loop->index + 7 }}).footer()).html('$' + total_taxes['tax_{{$tax["id"]}}'].toFixed(2)); 
                    @endforeach

                    $('.output_payment_method_count').html(__count_status(data, 'payment_methods'));
                },          
                });
            }
        } else if (target == 'expense_tax_tab') {
            $('#input_tax_tab').hide();
            $('#output_tax_tab').hide();
            $('#expense_tax_tab').show();
            if (typeof (expense_tax_datatable) == 'undefined') {
                expense_tax_datatable = $('#expense_tax_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/reports/tax-details',
                        data: function(d) {
                            d.type = 'expense';
                            d.location_id = $('#tax_report_location_id').val();
                            d.contact_id = $('#tax_report_contact_id').val();
                            var start = $('input#tax_report_date_range')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            var end = $('input#tax_report_date_range')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                            d.start_date = start;
                            d.end_date = end;
                        }
                    },
                    columns: [
                    { data: 'transaction_date', name: 'transaction_date' },
                    { data: 'ref_no', name: 'ref_no' },
                    { data: 'tax_number', name: 'c.tax_number' },
                    { data: 'total_before_tax', name: 'total_before_tax' },
                    { data: 'payment_methods', orderable: false, searchable: false },
                    @foreach($taxes as $tax)
                    { data: "tax_{{$tax['id']}}", searchable: false, orderable: false },
                    @endforeach
                ],
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(); 

                    var total_before_tax = 0;
                    var total_taxes = {};
                    @foreach($taxes as $tax)
                        total_taxes['tax_{{$tax['id']}}'] = 0; 
                    @endforeach
                    api.rows({ search: 'applied' }).every(function() {
                        var rowData = this.data();
                        var totalBeforeTaxValue = parseFloat($(rowData.total_before_tax).data('orig-value')) || 0;
                        if (!isNaN(totalBeforeTaxValue)) {
                            total_before_tax += totalBeforeTaxValue;
                        } 

                        @foreach($taxes as $tax)
                        var taxValue = parseFloat($(rowData['tax_{{$tax['id']}}']).data('orig-value')) || 0;
                        if (!isNaN(taxValue)) {
                            total_taxes['tax_{{$tax['id']}}'] += taxValue;
                        } 
                        @endforeach
                    });

                    $(api.column(3).footer()).html('$' + total_before_tax.toFixed(2));

                    @foreach($taxes as $tax)
                        $(api.column({{ $loop->index + 5 }}).footer()).html('$' + total_taxes['tax_{{$tax["id"]}}'].toFixed(2));
                    @endforeach

                    $('.expense_payment_method_count').html(__count_status(data, 'payment_methods'));
                },

                            });
                        }
                    }
                });
                $('#tax_report_date_range').daterangepicker(
                    dateRangeSettings, 
                    function(start, end) {
                        $('#tax_report_date_range').val(
                            start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
                        );
                    }
                );

                input_tax_table = $('#input_tax_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/reports/tax-details',
                        data: function(d) {
                            d.type = 'purchase';
                            d.location_id = $('#tax_report_location_id').val();
                            d.contact_id = $('#tax_report_contact_id').val();
                            var start = $('input#tax_report_date_range')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            var end = $('input#tax_report_date_range')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                            d.start_date = start;
                            d.end_date = end;
                        }
                    },
                    columns: [
                    { data: 'transaction_date', name: 'transaction_date' },
                    { data: 'ref_no', name: 'ref_no' },
                    { data: 'contact_name', name: 'c.name' },
                    { data: 'tax_number', name: 'c.tax_number' },
                    { data: 'total_before_tax', name: 'total_before_tax' },
                    { data: 'payment_methods', orderable: false, searchable: false },
                    { data: 'discount_amount', name: 'discount_amount' },
                    @foreach($taxes as $tax)
                    { data: "tax_{{$tax['id']}}", searchable: false, orderable: false },
                    @endforeach
                ],
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();
                    var total_before_tax = 0;
                    var total_discount = 0;
                    var total_taxes = {};
                    @foreach($taxes as $tax)
                        total_taxes['tax_{{$tax['id']}}'] = 0;
                    @endforeach

                    api.rows({ search: 'applied' }).every(function() {
                        var rowData = this.data();
                        var totalBeforeTaxValue = parseFloat($(rowData.total_before_tax).data('orig-value')) || 0;
                        if (!isNaN(totalBeforeTaxValue)) {
                            total_before_tax += totalBeforeTaxValue;
                        }
                        
                        var discountAmountValue = parseFloat(rowData.discount_amount) || 0;
                        if (!isNaN(discountAmountValue)) {
                            total_discount += discountAmountValue;
                        }

                        @foreach($taxes as $tax)
                        var taxValue = parseFloat($(rowData['tax_{{$tax['id']}}']).data('orig-value')) || 0;
                        if (!isNaN(taxValue)) {
                            total_taxes['tax_{{$tax['id']}}'] += taxValue;
                        }
                        @endforeach
                    });

                    $(api.column(4).footer()).html('$' + total_before_tax.toFixed(2));
                    $(api.column(6).footer()).html('$' + total_discount.toFixed(2));
                    @foreach($taxes as $tax)
                        $(api.column({{ $loop->index + 7 }}).footer()).html('$' + total_taxes['tax_{{$tax['id']}}'].toFixed(2));
                    @endforeach

                    $('.input_payment_method_count').html(__count_status(data, 'payment_methods'));
                },
                        });
                        
                        
                        $('#tax_report_date_range, #tax_report_location_id, #tax_report_contact_id').change( function(){
                            if ($("#input_tax_tab").is(":visible")) {
                                input_tax_table.ajax.reload();
                            }
                            if ($("#output_tax_tab").is(":visible")) {
                                output_tax_datatable.ajax.reload();
                            }
                            if ($("#expense_tax_tab").is(":visible")) {
                                expense_tax_datatable.ajax.reload();
                            }
                        });
                    });
</script>
@if(!empty($tax_report_tabs))
    @foreach($tax_report_tabs as $key => $tabs)
        @foreach ($tabs as $index => $value)
            @if(!empty($value['module_js_path']))
                @include($value['module_js_path'])
            @endif
        @endforeach
    @endforeach
@endif
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection