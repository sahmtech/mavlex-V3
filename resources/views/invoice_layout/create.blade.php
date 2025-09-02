@extends('layouts.app')
@section('title', __('invoice.add_invoice_layout'))

@section('content')
    <style type="text/css">
        .inline-tooltip {
            display: inline-block !important;
        }
    </style>
    @php
        $custom_labels = json_decode(session('business.custom_labels'), true);
        $product_custom_fields = [];
        $contact_custom_fields = [];
        $location_custom_fields = [];
    @endphp

    <div class="main-container no-print">
        <!-- Sub Menu -->
        <div class="horizontal-scroll">
            <div class="storys-container">
    @include('layouts.partials.sub_menu.setting', ['link_class' => 'sub-menu-item'])
</div>
        </div>
        <div class="setting-card-wrapper">
            <div class="overview-filter">
                <div class="title">
                    <h1>@lang('invoice.add_invoice_layout')</h1>
                    <p>@lang('invoice.manage_your_invoices')</p>
                </div>
            </div>
            {!! Form::open([
                'url' => action('InvoiceLayoutController@store'),
                'method' => 'post',
                'id' => 'add_invoice_layout_form',
                'files' => true,
            ]) !!}

            <div class="setting-two-grid">
                <div class="form-box">
                    {!! Form::label('name', __('invoice.layout_name') . ':*') !!}
                    {!! Form::text('name', null, [
                        'class' => 'form-control',
                        'required',
                        'placeholder' => __('invoice.layout_name'),
                    ]) !!}
                </div>
                <div class="form-group">
                    <span class="inline-tooltip">
                        {!! Form::label('design', __('lang_v1.design') . ':*') !!}
                    </span>
                    <span class="inline-tooltip">
                        @show_tooltip(__('lang_v1.used_for_browser_based_printing'))
                    </span>
                    {!! Form::select('design', $designs, 'classic', ['class' => 'form-control']) !!}
                </div>
            </div>
            <!-- Tax Table-->
            <div class="setting-two-grid hide" id="columnize-taxes">
                <div class="form-box">
                    <span class="inline-tooltip">
                        <input type="text" class="form-control" name="table_tax_headings[]" required
                            placeholder="tax 1 name" disabled>
                    </span>
                    <span class="inline-tooltip">
                        @show_tooltip(__('lang_v1.tooltip_columnize_taxes_heading'))
                    </span>
                </div>
                <div class="form-box">
                    <input type="text" class="form-control" name="table_tax_headings[]" placeholder="tax 2 name"
                        disabled>
                </div>
                <div class="form-box">
                    <input type="text" class="form-control" name="table_tax_headings[]" placeholder="tax 3 name"
                        disabled>
                </div>
                <div class="form-box">
                    <input type="text" class="form-control" name="table_tax_headings[]" placeholder="tax 4 name"
                        disabled>
                </div>
            </div>
            <!-- Logo -->
            <div class="setting-two-grid hide-for-letterhead">
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="show_logo" class="switchBtn">
                        {!! Form::checkbox('show_logo', 1, false, ['id' => 'show_logo']) !!}
                        <span class="slider"></span>
                    </label>
                    <p>@lang('invoice.show_logo')</p>
                </div>
                <div class="form-box">
                    {!! Form::label('logo', __('invoice.invoice_logo') . ':') !!}
                    {!! Form::file('logo', ['accept' => 'image/*']) !!}
                </div>
            </div>

            <div class="clearfix"></div>
            <!--Letter Head -->
            <div class="setting-two-grid">
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="show_letter_head" class="switchBtn">
                        {!! Form::checkbox('show_letter_head', 1, false, ['id' => 'show_letter_head']) !!}
                        <span class="slider"></span>
                    </label>
                    <p>@lang('lang_v1.show_letter_head')</p>
                </div>
                <div class="col-sm-6 letter_head_input hide">
                    <div class="form-group">
                        {!! Form::label('letter_head', __('lang_v1.letter_head') . ':') !!}
                        {!! Form::file('letter_head', ['accept' => 'image/*']) !!}
                    </div>
                </div>
            </div>

            <div class="setting-one-grid hide-for-letterhead">
                <div class="form-box">
                    {!! Form::label('header_text', __('invoice.header_text') . ':') !!}
                    {!! Form::textarea('header_text', null, [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.header_text'),
                        'rows' => 3,
                    ]) !!}
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="setting-three-grid hide-for-letterhead">
                <div class="form-box">
                    {!! Form::label('sub_heading_line1', __('lang_v1.sub_heading_line', ['_number_' => 1]) . ':') !!}
                    {!! Form::text('sub_heading_line1', null, [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 1]),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('sub_heading_line2', __('lang_v1.sub_heading_line', ['_number_' => 2]) . ':') !!}
                    {!! Form::text('sub_heading_line2', null, [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 2]),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('sub_heading_line3', __('lang_v1.sub_heading_line', ['_number_' => 3]) . ':') !!}
                    {!! Form::text('sub_heading_line3', null, [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 3]),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('sub_heading_line4', __('lang_v1.sub_heading_line', ['_number_' => 4]) . ':') !!}
                    {!! Form::text('sub_heading_line4', null, [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 4]),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('sub_heading_line5', __('lang_v1.sub_heading_line', ['_number_' => 5]) . ':') !!}
                    {!! Form::text('sub_heading_line5', null, [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 5]),
                    ]) !!}
                </div>
            </div>
            <br>
            <hr>
            <div class="setting-three-grid">
                <div class="form-box">
                    {!! Form::label('invoice_heading', __('invoice.invoice_heading') . ':') !!}
                    {!! Form::text('invoice_heading', 'Invoice', [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.invoice_heading'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('invoice_heading_not_paid', __('invoice.invoice_heading_not_paid') . ':') !!}
                    {!! Form::text('invoice_heading_not_paid', null, [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.invoice_heading_not_paid'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('invoice_heading_paid', __('invoice.invoice_heading_paid') . ':') !!}
                    {!! Form::text('invoice_heading_paid', null, [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.invoice_heading_paid'),
                    ]) !!}
                </div>
                <div class="form-box">
                    <span class="inline-tooltip">
                        {!! Form::label('proforma_heading', __('lang_v1.proforma_heading') . ':') !!}
                    </span>
                    <span class="inline-tooltip">
                        @show_tooltip(__('lang_v1.tooltip_proforma_heading'))
                    </span>
                    {!! Form::text('common_settings[proforma_heading]', __('lang_v1.proforma_invoice'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.proforma_heading'),
                        'id' => 'proforma_heading',
                    ]) !!}
                </div>
                <div class="form-box">
                    <span class="inline-tooltip">
                        {!! Form::label('quotation_heading', __('lang_v1.quotation_heading') . ':') !!}
                    </span>
                    <span class="inline-tooltip">
                        @show_tooltip(__('lang_v1.tooltip_quotation_heading'))
                    </span>
                    {!! Form::text('quotation_heading', __('lang_v1.quotation'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.quotation_heading'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('sales_order_heading', __('lang_v1.sales_order_heading') . ':') !!}
                    {!! Form::text('common_settings[sales_order_heading]', __('lang_v1.sales_order'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.sales_order_heading'),
                        'id' => 'sales_order_heading',
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('invoice_no_prefix', __('invoice.invoice_no_prefix') . ':') !!}
                    {!! Form::text('invoice_no_prefix', __('sale.invoice_no'), [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.invoice_no_prefix'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('quotation_no_prefix', __('lang_v1.quotation_no_prefix') . ':') !!}
                    {!! Form::text('quotation_no_prefix', __('lang_v1.quotation_no'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.quotation_no_prefix'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('date_label', __('lang_v1.date_label') . ':') !!}
                    {!! Form::text('date_label', __('lang_v1.date'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.date_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('due_date_label', __('lang_v1.due_date_label') . ':') !!}
                    {!! Form::text('common_settings[due_date_label]', __('lang_v1.due_date'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.due_date_label'),
                        'id' => 'due_date_label',
                    ]) !!}
                </div>
                <div class="form-box">
                    <span class="inline-tooltip">
                        {!! Form::label('date_time_format', __('lang_v1.date_time_format') . ':') !!}
                    </span>
                    <span class="inline-tooltip">
                        @show_tooltip(__('lang_v1.date_time_format_help'))
                    </span>
                    {!! Form::text('date_time_format', null, [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.date_time_format'),
                    ]) !!}
                </div>
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="show_due_date" class="switchBtn">
                        {!! Form::checkbox('common_settings[show_due_date]', 1, false, ['id' => 'show_due_date']) !!}
                        <span class="slider"></span>
                    </label>
                    <p>@lang('lang_v1.show_due_date')</p>
                </div>
            </div>
            <br>
            <hr>

            <div class="setting-three-grid">
                <div class="form-box">
                    {!! Form::label('sales_person_label', __('lang_v1.sales_person_label') . ':') !!}
                    {!! Form::text('sales_person_label', null, [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.sales_person_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('commission_agent_label', __('lang_v1.commission_agent_label') . ':') !!}
                    {!! Form::text('commission_agent_label', __('lang_v1.commission_agent'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.commission_agent_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_business_name" class="switchBtn">
                            {!! Form::checkbox('show_business_name', 1, false, ['id' => 'show_business_name']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('invoice.show_business_name')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_location_name" class="switchBtn">
                            {!! Form::checkbox('show_location_name', 1, true, ['id' => 'show_location_name']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('invoice.show_location_name')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_sales_person" class="switchBtn">
                            {!! Form::checkbox('show_sales_person', 1, false, ['id' => 'show_sales_person']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_sales_person')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_commission_agent" class="switchBtn">
                            {!! Form::checkbox('show_commission_agent', 1, false, ['id' => 'show_commission_agent']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_commission_agent')</p>
                    </div>
                </div>
            </div>
            <!--Customer Details-->
            <hr>
            <div class="clearfix"></div>
            <h4>@lang('lang_v1.fields_for_customer_details'):</h4>
            <div class="setting-three-grid">
                <div class="form-box">
                    {!! Form::label('customer_label', __('invoice.customer_label') . ':') !!}
                    {!! Form::text('customer_label', __('contact.customer'), [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.customer_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('client_id_label', __('lang_v1.client_id_label') . ':') !!}
                    {!! Form::text('client_id_label', null, [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.client_id_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('client_tax_label', __('lang_v1.client_tax_label') . ':') !!}
                    {!! Form::text('client_tax_label', null, [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.client_tax_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_customer" class="switchBtn">
                            {!! Form::checkbox('show_customer', 1, true, ['id' => 'show_customer']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('invoice.show_customer')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_client_id" class="switchBtn">
                            {!! Form::checkbox('show_client_id', 1, false, ['id' => 'show_client_id']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_client_id')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_reward_point" class="switchBtn">
                            {!! Form::checkbox('show_reward_point', 1, false, ['id' => 'show_reward_point']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_reward_point')</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="contact_custom_field1" class="switchBtn">
                            {!! Form::checkbox('contact_custom_fields[]', 'custom_field1', false, ['id' => 'contact_custom_field1']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>{{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="contact_custom_field2" class="switchBtn">
                            {!! Form::checkbox('contact_custom_fields[]', 'custom_field2', false, ['id' => 'contact_custom_field2']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>{{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="contact_custom_field3" class="switchBtn">
                            {!! Form::checkbox('contact_custom_fields[]', 'custom_field3', false, ['id' => 'contact_custom_field3']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>{{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="contact_custom_field4" class="switchBtn">
                            {!! Form::checkbox('contact_custom_fields[]', 'custom_field4', false, ['id' => 'contact_custom_field4']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>{{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}</p>
                    </div>
                </div>
            </div>

            <!-- Location Details / hide on letter head-->
            <div class="hide-for-letterhead">
                <hr>
                <h4>@lang('invoice.fields_to_be_shown_in_address'):</h4>
                <div class="clearfix"></div>
                <div class="setting-three-grid">
                    <div class="form-box">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                            <label for="show_landmark" class="switchBtn">
                                {!! Form::checkbox('show_landmark', 1, true, ['id' => 'show_landmark']) !!}
                                <span class="slider"></span>
                            </label>
                            <p>@lang('business.landmark')</p>
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                            <label for="show_city" class="switchBtn">
                                {!! Form::checkbox('show_city', 1, true, ['id' => 'show_city']) !!}
                                <span class="slider"></span>
                            </label>
                            <p>@lang('business.city')</p>
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                            <label for="show_state" class="switchBtn">
                                {!! Form::checkbox('show_state', 1, true, ['id' => 'show_state']) !!}
                                <span class="slider"></span>
                            </label>
                            <p>@lang('business.state')</p>
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                            <label for="show_country" class="switchBtn">
                                {!! Form::checkbox('show_country', 1, true, ['id' => 'show_country']) !!}
                                <span class="slider"></span>
                            </label>
                            <p>@lang('business.country')</p>
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                            <label for="show_zip_code" class="switchBtn">
                                {!! Form::checkbox('show_zip_code', 1, true, ['id' => 'show_zip_code']) !!}
                                <span class="slider"></span>
                            </label>
                            <p>@lang('business.zip_code')</p>
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                            <label for="custom_field1" class="switchBtn">
                                {!! Form::checkbox('location_custom_fields[]', 'custom_field1', false, ['id' => 'custom_field1']) !!}
                                <span class="slider"></span>
                            </label>
                            <p>{{ $custom_labels['location']['custom_field_1'] ?? __('lang_v1.location_custom_field1') }}
                            </p>
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                            <label for="custom_field2" class="switchBtn">
                                {!! Form::checkbox('location_custom_fields[]', 'custom_field2', false, ['id' => 'custom_field2']) !!}
                                <span class="slider"></span>
                            </label>
                            <p>{{ $custom_labels['location']['custom_field_2'] ?? __('lang_v1.location_custom_field2') }}
                            </p>
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                            <label for="custom_field3" class="switchBtn">
                                {!! Form::checkbox('location_custom_fields[]', 'custom_field3', false, ['id' => 'custom_field3']) !!}
                                <span class="slider"></span>
                            </label>
                            <p>{{ $custom_labels['location']['custom_field_3'] ?? __('lang_v1.location_custom_field3') }}
                            </p>
                        </div>
                    </div>
                    <div class="form-box">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                            <label for="custom_field4" class="switchBtn">
                                {!! Form::checkbox('location_custom_fields[]', 'custom_field4', false, ['id' => 'custom_field4']) !!}
                                <span class="slider"></span>
                            </label>
                            <p>{{ $custom_labels['location']['custom_field_4'] ?? __('lang_v1.location_custom_field4') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <h3>@lang('invoice.fields_to_shown_for_communication')</h3>
            <div class="setting-three-grid">
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="show_mobile_number" class="switchBtn">
                        {!! Form::checkbox('show_mobile_number', 1, true, ['id' => 'show_mobile_number']) !!}
                        <span class="slider"></span>
                    </label>
                    <p>@lang('invoice.show_mobile_number')</p>
                </div>
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="show_alternate_number" class="switchBtn">
                        {!! Form::checkbox('show_alternate_number', 1, false, ['id' => 'show_alternate_number']) !!}
                        <span class="slider"></span>
                    </label>
                    <p>@lang('invoice.show_alternate_number')</p>
                </div>
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="show_email" class="switchBtn">
                        {!! Form::checkbox('show_email', 1, false, ['id' => 'show_email']) !!}
                        <span class="slider"></span>
                    </label>
                    <p>@lang('invoice.show_email')</p>
                </div>
            </div>
            <hr>
            <h3>@lang('invoice.fields_to_shown_for_tax')</h3>
            <div class="setting-three-grid">
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="show_tax_1" class="switchBtn">
                        {!! Form::checkbox('show_tax_1', 1, true, ['id' => 'show_tax_1']) !!}
                        <span class="slider"></span>
                    </label>
                    <p>@lang('invoice.show_tax_1')</p>
                </div>
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="show_tax_2" class="switchBtn">
                        {!! Form::checkbox('show_tax_2', 1, false, ['id' => 'show_tax_2']) !!}
                        <span class="slider"></span>
                    </label>
                    <p>@lang('invoice.show_tax_2')</p>
                </div>
            </div>
            <br>
            <hr>
            <!-- Product Details-->
            <h3>@lang('lang_v1.product_label'):</h3>
            <div class="setting-three-grid">
                <div class="form-box">
                    {!! Form::label('table_product_label', __('lang_v1.product_label') . ':') !!}
                    {!! Form::text('table_product_label', __('sale.product'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.product_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('table_qty_label', __('lang_v1.qty_label') . ':') !!}
                    {!! Form::text('table_qty_label', __('lang_v1.quantity'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.qty_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('table_unit_price_label', __('lang_v1.unit_price_label') . ':') !!}
                    {!! Form::text('table_unit_price_label', __('sale.unit_price'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.unit_price_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('table_subtotal_label', __('lang_v1.subtotal_label') . ':') !!}
                    {!! Form::text('table_subtotal_label', __('sale.subtotal'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.subtotal_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('cat_code_label', __('lang_v1.cat_code_label') . ':') !!}
                    {!! Form::text('cat_code_label', 'HSN', ['class' => 'form-control', 'placeholder' => 'HSN or Category Code']) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('total_quantity_label', __('lang_v1.total_quantity_label') . ':') !!}
                    {!! Form::text('common_settings[total_quantity_label]', 'Total Quantity', [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.total_quantity_label'),
                        'id' => 'total_quantity_label',
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('item_discount_label', __('lang_v1.item_discount_label') . ':') !!}
                    {!! Form::text('common_settings[item_discount_label]', 'Discount', [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.item_discount_label'),
                        'id' => 'item_discount_label',
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('discounted_unit_price_label', __('lang_v1.discounted_unit_price_label') . ':') !!}
                    {!! Form::text('common_settings[discounted_unit_price_label]', null, [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.discounted_unit_price_label'),
                        'id' => 'discounted_unit_price_label',
                    ]) !!}
                </div>
            </div>
            <br>
            <h4>@lang('lang_v1.product_details_to_be_shown'):</h4>
            <div class="setting-three-grid">
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_brand" class="switchBtn">
                            {!! Form::checkbox('show_brand', 1, false, ['id' => 'show_brand']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_brand')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_sku" class="switchBtn">
                            {!! Form::checkbox('show_sku', 1, false, ['id' => 'show_sku']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_sku')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_cat_code" class="switchBtn">
                            {!! Form::checkbox('show_cat_code', 1, false, ['id' => 'show_cat_code']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_cat_code')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_sale_description" class="switchBtn">
                            {!! Form::checkbox('show_sale_description', 1, false, ['id' => 'show_sale_description']) !!}
                            <span class="slider"></span>
                        </label>
                        <p class="inline-tooltip">
                            @lang('lang_v1.show_sale_description')
                            @show_tooltip(__('lang_v1.product_imei_or_sn'))
                        </p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="common_settings_show_product_description" class="switchBtn">
                            {!! Form::checkbox('common_settings[show_product_description]', 1, false, [
                                'id' => 'common_settings_show_product_description',
                            ]) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_product_description')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="product_custom_field1" class="switchBtn">
                            {!! Form::checkbox(
                                'product_custom_fields[]',
                                'product_custom_field1',
                                in_array('product_custom_field1', $product_custom_fields),
                                ['id' => 'product_custom_field1'],
                            ) !!}
                            <span class="slider"></span>
                        </label>
                        <p>{{ $custom_labels['product']['custom_field_1'] ?? __('lang_v1.product_custom_field1') }}</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="product_custom_field2" class="switchBtn">
                            {!! Form::checkbox(
                                'product_custom_fields[]',
                                'product_custom_field2',
                                in_array('product_custom_field2', $product_custom_fields),
                                ['id' => 'product_custom_field2'],
                            ) !!}
                            <span class="slider"></span>
                        </label>
                        <p>{{ $custom_labels['product']['custom_field_2'] ?? __('lang_v1.product_custom_field2') }}</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="product_custom_field3" class="switchBtn">
                            {!! Form::checkbox(
                                'product_custom_fields[]',
                                'product_custom_field3',
                                in_array('product_custom_field3', $product_custom_fields),
                                ['id' => 'product_custom_field3'],
                            ) !!}
                            <span class="slider"></span>
                        </label>
                        <p>{{ $custom_labels['product']['custom_field_3'] ?? __('lang_v1.product_custom_field3') }}</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="product_custom_field4" class="switchBtn">
                            {!! Form::checkbox(
                                'product_custom_fields[]',
                                'product_custom_field4',
                                in_array('product_custom_field4', $product_custom_fields),
                                ['id' => 'product_custom_field4'],
                            ) !!}
                            <span class="slider"></span>
                        </label>
                        <p>{{ $custom_labels['product']['custom_field_4'] ?? __('lang_v1.product_custom_field4') }}</p>
                    </div>
                </div>

                @if (request()->session()->get('business.enable_product_expiry') == 1)
                    <div class="form-box">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                            <label for="show_expiry" class="switchBtn">
                                {!! Form::checkbox('show_expiry', 1, false, ['id' => 'show_expiry']) !!}
                                <span class="slider"></span>
                            </label>
                            <p>@lang('lang_v1.show_product_expiry')</p>
                        </div>
                    </div>
                @endif

                @if (request()->session()->get('business.enable_lot_number') == 1)
                    <div class="form-box">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                            <label for="show_lot" class="switchBtn">
                                {!! Form::checkbox('show_lot', 1, false, ['id' => 'show_lot']) !!}
                                <span class="slider"></span>
                            </label>
                            <p>@lang('lang_v1.show_lot_number')</p>
                        </div>
                    </div>
                @endif

                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_image" class="switchBtn">
                            {!! Form::checkbox('show_image', 1, false, ['id' => 'show_image']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_product_image')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="common_settings_show_warranty_name" class="switchBtn">
                            {!! Form::checkbox('common_settings[show_warranty_name]', 1, false, [
                                'id' => 'common_settings_show_warranty_name',
                            ]) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_warranty_name')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="common_settings_show_warranty_exp_date" class="switchBtn">
                            {!! Form::checkbox('common_settings[show_warranty_exp_date]', 1, false, [
                                'id' => 'common_settings_show_warranty_exp_date',
                            ]) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_warranty_exp_date')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="common_settings_show_warranty_description" class="switchBtn">
                            {!! Form::checkbox('common_settings[show_warranty_description]', 1, false, [
                                'id' => 'common_settings_show_warranty_description',
                            ]) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_warranty_description')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="common_settings_show_base_unit_details" class="switchBtn">
                            {!! Form::checkbox('common_settings[show_base_unit_details]', 1, false, [
                                'id' => 'common_settings_show_base_unit_details',
                            ]) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.show_base_unit_details')</p>
                    </div>
                </div>
            </div>
            <hr>
            <!--Invoice Total Details-->
            <h4>@lang('lang_v1.invoice_total_labels'):</h4>
            <div class="setting-three-grid">
                <div class="form-box">
                    {!! Form::label('sub_total_label', __('invoice.sub_total_label') . ':') !!}
                    {!! Form::text('sub_total_label', __('sale.subtotal'), [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.sub_total_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('discount_label', __('invoice.discount_label') . ':') !!}
                    {!! Form::text('discount_label', __('sale.discount'), [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.discount_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('tax_label', __('invoice.tax_label') . ':') !!}
                    {!! Form::text('tax_label', __('sale.tax'), [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.tax_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('total_label', __('invoice.total_label') . ':') !!}
                    {!! Form::text('total_label', __('sale.total'), [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.total_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('total_items_label', __('lang_v1.total_items_label') . ':') !!}
                    {!! Form::text('common_settings[total_items_label]', null, [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.total_items_label'),
                        'id' => 'total_items_label',
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('round_off_label', __('lang_v1.round_off_label') . ':') !!}
                    {!! Form::text('round_off_label', __('lang_v1.round_off'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.round_off_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('total_due_label', __('invoice.total_due_label') . ' (' . __('lang_v1.current_sale') . '):') !!}
                    {!! Form::text('total_due_label', __('report.total_due'), [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.total_due_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('paid_label', __('invoice.paid_label') . ':') !!}
                    {!! Form::text('paid_label', __('sale.total_paid'), [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.paid_label'),
                    ]) !!}
                </div>



                <div class="form-box">
                    {!! Form::label('prev_bal_label', __('invoice.total_due_label') . ' (' . __('lang_v1.all_sales') . '):') !!}
                    {!! Form::text('prev_bal_label', null, [
                        'class' => 'form-control',
                        'placeholder' => __('invoice.total_due_label'),
                    ]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('change_return_label', __('lang_v1.change_return_label') . ':') !!} @show_tooltip(__('lang_v1.change_return_help'))
                    {!! Form::text('change_return_label', __('lang_v1.change_return'), [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.change_return_label'),
                    ]) !!}
                </div>


                <div class="form-box">
                    {!! Form::label('word_format', __('lang_v1.word_format') . ':') !!}
                    {!! Form::select(
                        'common_settings[num_to_word_format]',
                        ['international' => __('lang_v1.international'), 'indian' => __('lang_v1.indian')],
                        'international',
                        ['class' => 'form-control', 'id' => 'word_format'],
                    ) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('tax_summary_label', __('lang_v1.tax_summary_label') . ':') !!}
                    {!! Form::text('common_settings[tax_summary_label]', 'Tax Summary:', [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.tax_summary_label'),
                        'id' => 'tax_summary_label',
                    ]) !!}
                </div>
            </div>
            <br>
            <h4>@lang('lang_v1.fields_to_be_shown'):</h4>
            <div class="setting-three-grid">
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_payments" class="switchBtn">
                            {!! Form::checkbox('show_payments', 1, true, ['id' => 'show_payments']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('invoice.show_payments')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_barcode" class="switchBtn">
                            {!! Form::checkbox('show_barcode', 1, false, ['id' => 'show_barcode']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('invoice.show_barcode')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_previous_bal" class="switchBtn">
                            {!! Form::checkbox('show_previous_bal', 1, false, ['id' => 'show_previous_bal']) !!}
                            <span class="slider"></span>
                        </label>
                        <p class="inline-tooltip">
                            @lang('lang_v1.show_previous_bal_due')
                            @show_tooltip(__('lang_v1.previous_bal_due_help'))
                        </p>
                    </div>
                </div>
                <div class="form-box @if ('classic' != 'slim') hide @endif" id="hide_price_div">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="hide_price" class="switchBtn">
                            {!! Form::checkbox('common_settings[hide_price]', 1, false, ['id' => 'hide_price']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.hide_all_prices')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="show_total_in_words" class="switchBtn">
                            {!! Form::checkbox('common_settings[show_total_in_words]', 1, false, ['id' => 'show_total_in_words']) !!}
                            <span class="slider"></span>
                        </label>
                        <p class="inline-tooltip">
                            @lang('lang_v1.show_total_in_words')
                            @show_tooltip(__('lang_v1.show_in_word_help'))
                        </p>
                    </div>
                </div>
            </div>
            <hr>

            <!--Footer Text-->
            <div class="col-sm-12">
                <div class="col-sm-6 hide">
                    <div class="form-group">
                        {!! Form::label('highlight_color', __('invoice.highlight_color') . ':') !!}
                        {!! Form::text('highlight_color', null, [
                            'class' => 'form-control',
                            'placeholder' => __('invoice.highlight_color'),
                        ]) !!}
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 hide">
                    <hr>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        {!! Form::label('footer_text', __('invoice.footer_text') . ':') !!}
                        {!! Form::textarea('footer_text', null, [
                            'class' => 'form-control',
                            'placeholder' => __('invoice.footer_text'),
                            'rows' => 3,
                        ]) !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <br>
                        <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                            <label for="is_default" class="switchBtn">
                                {!! Form::checkbox('is_default', 1, false, ['id' => 'is_default']) !!}
                                <span class="slider"></span>
                            </label>
                            <p>@lang('barcode.set_as_default')</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <!--QR Code -->
            <h3>@lang('lang_v1.qr_code')</h3>
            <div class="setting-three-grid">
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="show_qr_code" class="switchBtn">
                        {!! Form::checkbox('show_qr_code', 1, false, ['id' => 'show_qr_code']) !!}
                        <span class="slider"></span>
                    </label>
                    <p>@lang('lang_v1.show_qr_code')</p>
                </div>
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="show_qr_code_label" class="switchBtn">
                        {!! Form::checkbox('common_settings[show_qr_code_label]', 1, false, ['id' => 'show_qr_code_label']) !!}
                        <span class="slider"></span>
                    </label>
                    <p>@lang('lang_v1.show_labels')</p>
                </div>
                <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                    <label for="zatca_qr" class="switchBtn">
                        {!! Form::checkbox('common_settings[zatca_qr]', 1, false, ['id' => 'zatca_qr']) !!}
                        <span class="slider"></span>
                    </label>
                    <p class="inline-tooltip">
                        @lang('lang_v1.zatca_qr')
                        @show_tooltip(__('lang_v1.zatca_qr_help'))
                    </p>
                </div>
            </div>
            <div class="clearfix"></div>
            <h4>@lang('lang_v1.fields_to_be_shown'):</h4>
            @php
                $qr_code_fields = [];
            @endphp
            <div class="setting-three-grid">
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="qr_code_fields_business_name" class="switchBtn">
                            {!! Form::checkbox('qr_code_fields[]', 'business_name', false, ['id' => 'qr_code_fields_business_name']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('business.business_name')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="qr_code_fields_address" class="switchBtn">
                            {!! Form::checkbox('qr_code_fields[]', 'address', false, ['id' => 'qr_code_fields_address']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.business_location_address')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="qr_code_fields_tax_1" class="switchBtn">
                            {!! Form::checkbox('qr_code_fields[]', 'tax_1', false, ['id' => 'qr_code_fields_tax_1']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.business_tax_1')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="qr_code_fields_tax_2" class="switchBtn">
                            {!! Form::checkbox('qr_code_fields[]', 'tax_2', false, ['id' => 'qr_code_fields_tax_2']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.business_tax_2')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="qr_code_fields_invoice_no" class="switchBtn">
                            {!! Form::checkbox('qr_code_fields[]', 'invoice_no', false, ['id' => 'qr_code_fields_invoice_no']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('sale.invoice_no')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="qr_code_fields_invoice_datetime" class="switchBtn">
                            {!! Form::checkbox('qr_code_fields[]', 'invoice_datetime', false, ['id' => 'qr_code_fields_invoice_datetime']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.invoice_datetime')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="qr_code_fields_subtotal" class="switchBtn">
                            {!! Form::checkbox('qr_code_fields[]', 'subtotal', false, ['id' => 'qr_code_fields_subtotal']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('sale.subtotal')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="qr_code_fields_total_amount" class="switchBtn">
                            {!! Form::checkbox('qr_code_fields[]', 'total_amount', false, ['id' => 'qr_code_fields_total_amount']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.total_amount_with_tax')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="qr_code_fields_total_tax" class="switchBtn">
                            {!! Form::checkbox('qr_code_fields[]', 'total_tax', false, ['id' => 'qr_code_fields_total_tax']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.total_tax')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="qr_code_fields_customer_name" class="switchBtn">
                            {!! Form::checkbox('qr_code_fields[]', 'customer_name', false, ['id' => 'qr_code_fields_customer_name']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('sale.customer_name')</p>
                    </div>
                </div>
                <div class="form-box">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px;">
                        <label for="qr_code_fields_invoice_url" class="switchBtn">
                            {!! Form::checkbox('qr_code_fields[]', 'invoice_url', false, ['id' => 'qr_code_fields_invoice_url']) !!}
                            <span class="slider"></span>
                        </label>
                        <p>@lang('lang_v1.view_invoice_url')</p>
                    </div>
                </div>
            </div>

            <!-- Include modules if available -->
            @if (!empty($enabled_modules) && in_array('types_of_service', $enabled_modules))
                <hr>
                @include('types_of_service.invoice_layout_settings')
            @endif

            @if (!empty($enabled_modules) && (in_array('tables', $enabled_modules) || in_array('service_staff', $enabled_modules)))
                <hr>
                @include('restaurant.partials.invoice_layout')
            @endif

            @if (Module::has('Repair'))
                @include('repair::layouts.partials.invoice_layout_settings')
            @endif

            @if (Module::has('CurrencyExchangeRate'))
                @include('currencyexchangerate::layouts.partials.invoice_layout_settings')
            @endif

            @if (Module::has('Zatca'))
                <div class="hidden_en_input">
                    <hr>
                    @include('zatca::layouts.partials.invoice_layout_settings')
                </div>
            @endif

            <hr>
            <div class="clearfix"></div>
            <!-- Credit Note -->
            <h3>@lang('lang_v1.layout_credit_note'):</h3>
            <div class="setting-three-grid">
                <div class="form-box">
                    {!! Form::label('cn_heading', __('lang_v1.cn_heading') . ':') !!}
                    {!! Form::text('cn_heading', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.cn_heading')]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('cn_no_label', __('lang_v1.cn_no_label') . ':') !!}
                    {!! Form::text('cn_no_label', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.cn_no_label')]) !!}
                </div>
                <div class="form-box">
                    {!! Form::label('cn_amount_label', __('lang_v1.cn_amount_label') . ':') !!}
                    {!! Form::text('cn_amount_label', null, [
                        'class' => 'form-control',
                        'placeholder' => __('lang_v1.cn_amount_label'),
                    ]) !!}
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary btn-big">@lang('messages.save')</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('javascript')
    <script type="text/javascript">
        __page_leave_confirmation('#add_invoice_layout_form');
        document.addEventListener('DOMContentLoaded', function() {
            const showLetterHeadCheckbox = document.getElementById('show_letter_head');

            function letterHeadChanged() {
                if (showLetterHeadCheckbox.checked) {
                    document.querySelectorAll('.hide-for-letterhead').forEach(element => {
                        element.classList.add('hide');
                    });
                    document.querySelectorAll('.letter_head_input').forEach(element => {
                        element.classList.remove('hide');
                    });
                } else {
                    document.querySelectorAll('.hide-for-letterhead').forEach(element => {
                        element.classList.remove('hide');
                    });
                    document.querySelectorAll('.letter_head_input').forEach(element => {
                        element.classList.add('hide');
                    });
                }
            }
            showLetterHeadCheckbox.addEventListener('change', letterHeadChanged);
            letterHeadChanged(); // Initial check
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var select_value = $("#design option:selected").val();
            if (select_value == 'elegant_ar_en') {
                $(".hidden_en_input").show();
            } else {
                $(".hidden_en_input").hide();
            }
        });
        $("#design").on("change", function() {
            var select_value = $("#design option:selected").val();
            if (select_value == 'elegant_ar_en') {
                $(".hidden_en_input").show();
            } else {
                $(".hidden_en_input").hide();
            }
        });
    </script>
@endsection
