@if($__is_zatca_enabled)
@php
    $default = [
        'invoice_heading_en' => '',
        'invoice_heading_not_paid_en' => '',
        'invoice_heading_paid_en' => '',
        'proforma_heading_en' => '',
        'quotation_heading_en' => '',
        'sales_order_heading_en' => '',
        'invoice_no_prefix_en' => '',
        'quotation_no_prefix_en' => '',
        'date_label_en' => '',
        'due_date_label_en' => '',
        'sales_person_label_en' => '',
        'commission_agent_label_en' => '',
        'customer_label_en' => '',
        'client_id_label_en' => '',
        'client_tax_label_en' => '',
        'table_product_label_en' => '',
        'table_qty_label_en' => '',
        'table_unit_price_label_en' => '',
        'table_subtotal_label_en' => '',
        'cat_code_label_en' => '',
        'total_quantity_label_en' => '',
        'item_discount_label_en' => '',
        'item_tax_value_label_en' => '',
        'sub_total_label_en' => '',
        'discount_label_en' => '',
        'tax_label_en' => '',
        'total_label_en' => '',
        'total_items_label_en' => '',
        'round_off_label_en' => '',
        'total_due_label_en' => '',
        'paid_label_en' => '',
        'prev_bal_label_en' => ''
    ];

    if(!empty($edit_il)){
        $default = [
            'invoice_heading_en' => $module_info['zatca']['invoice_heading_en'] ?? '',
            'invoice_heading_not_paid_en' => $module_info['zatca']['invoice_heading_not_paid_en'] ?? '',
            'invoice_heading_paid_en' => $module_info['zatca']['invoice_heading_paid_en'] ?? '',
            'proforma_heading_en' => $module_info['zatca']['proforma_heading_en'] ?? '',
            'quotation_heading_en' => $module_info['zatca']['quotation_heading_en'] ?? '',
            'sales_order_heading_en' => $module_info['zatca']['sales_order_heading_en'] ?? '',
            'invoice_no_prefix_en' => $module_info['zatca']['invoice_no_prefix_en'] ?? '',
            'quotation_no_prefix_en' => $module_info['zatca']['quotation_no_prefix_en'] ?? '',
            'date_label_en' => $module_info['zatca']['date_label_en'] ?? '',
            'due_date_label_en' => $module_info['zatca']['due_date_label_en'] ?? '',
            'sales_person_label_en' => $module_info['zatca']['sales_person_label_en'] ?? '',
            'commission_agent_label_en' => $module_info['zatca']['commission_agent_label_en'] ?? '',
            'customer_label_en' => $module_info['zatca']['customer_label_en'] ?? '',
            'client_id_label_en' => $module_info['zatca']['client_id_label_en'] ?? '',
            'client_tax_label_en' => $module_info['zatca']['client_tax_label_en'] ?? '',
            'table_product_label_en' => $module_info['zatca']['table_product_label_en'] ?? '',
            'table_qty_label_en' => $module_info['zatca']['table_qty_label_en'] ?? '',
            'table_unit_price_label_en' => $module_info['zatca']['table_unit_price_label_en'] ?? '',
            'table_subtotal_label_en' => $module_info['zatca']['table_subtotal_label_en'] ?? '',
            'cat_code_label_en' => $module_info['zatca']['cat_code_label_en'] ?? '',
            'total_quantity_label_en' => $module_info['zatca']['total_quantity_label_en'] ?? '',
            'item_discount_label_en' => $module_info['zatca']['item_discount_label_en'] ?? '',
            'item_tax_value_label_en' => $module_info['zatca']['item_tax_value_label_en'] ?? '',
            'sub_total_label_en' => $module_info['zatca']['sub_total_label_en'] ?? '',
            'discount_label_en' => $module_info['zatca']['discount_label_en'] ?? '',
            'tax_label_en' => $module_info['zatca']['tax_label_en'] ?? '',
            'total_label_en' => $module_info['zatca']['total_label_en'] ?? '',
            'total_items_label_en' => $module_info['zatca']['total_items_label_en'] ?? '',
            'round_off_label_en' => $module_info['zatca']['round_off_label_en'] ?? '',
            'total_due_label_en' => $module_info['zatca']['total_due_label_en'] ?? '',
            'paid_label_en' => $module_info['zatca']['paid_label_en'] ?? '',
            'prev_bal_label_en' => $module_info['zatca']['prev_bal_label_en'] ?? ''
        ];
    }
@endphp
@component('components.widget', ['class' => 'box-solid', 'title' => __('zatca::lang.zatca_module_en')])
<div class="col-sm-12 text-center d-grid gap-3 btn-success hidden_en_input">
    <h4 class="text-dark">{{__('zatca::lang.zatca_module_en')}}</h4>
</div>

<!-- Start input English -->
<div class="hidden_en_input">
    <!-- Invoice Headings -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][invoice_heading_en]', __('invoice.invoice_heading') . __('zatca::lang.for_en'). ':' ) !!}
            {!! Form::text('module_info[zatca][invoice_heading_en]', $default['invoice_heading_en'], ['class' => 'form-control',
              'placeholder' => __('invoice.invoice_heading'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][invoice_heading_not_paid_en]', __('invoice.invoice_heading_not_paid') . __('zatca::lang.for_en'). ':' ) !!}
            {!! Form::text('module_info[zatca][invoice_heading_not_paid_en]', $default['invoice_heading_not_paid_en'], ['class' => 'form-control',
              'placeholder' => __('invoice.invoice_heading_not_paid'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][invoice_heading_paid_en]', __('invoice.invoice_heading_paid') . __('zatca::lang.for_en'). ':' ) !!}
            {!! Form::text('module_info[zatca][invoice_heading_paid_en]', $default['invoice_heading_paid_en'], ['class' => 'form-control',
              'placeholder' => __('invoice.invoice_heading_paid'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <!-- Proforma Heading -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][proforma_heading_en]', __('lang_v1.proforma_heading') . __('zatca::lang.for_en'). ':' ) !!}
            @show_tooltip(__('lang_v1.tooltip_proforma_heading'))
            {!! Form::text('module_info[zatca][proforma_heading_en]', $default['proforma_heading_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.proforma_heading'). __('zatca::lang.for_en'), 'id' => 'proforma_heading_en' ]); !!}
        </div>
    </div>
    <!-- Quotation Heading -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][quotation_heading_en]', __('lang_v1.quotation_heading'). __('zatca::lang.for_en') . ':' ) !!}
            @show_tooltip(__('lang_v1.tooltip_quotation_heading'))
            {!! Form::text('module_info[zatca][quotation_heading_en]', $default['quotation_heading_en'], ['class' => 'form-control', 'placeholder' => __('lang_v1.quotation_heading') . __('zatca::lang.for_en')]); !!}
        </div>
    </div>
    <!-- Sales Order Heading -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][sales_order_heading_en]', __('lang_v1.sales_order_heading') . __('zatca::lang.for_en'). ':' ) !!}
            {!! Form::text('module_info[zatca][sales_order_heading_en]', $default['sales_order_heading_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.sales_order_heading'). __('zatca::lang.for_en'), 'id' => 'sales_order_heading_en' ]); !!}
        </div>
    </div>
    <!-- Invoice No Prefix -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][invoice_no_prefix_en]', __('invoice.invoice_no_prefix') . __('zatca::lang.for_en'). ':' ) !!}
            {!! Form::text('module_info[zatca][invoice_no_prefix_en]', $default['invoice_no_prefix_en'], ['class' => 'form-control',
              'placeholder' => __('invoice.invoice_no_prefix') . __('zatca::lang.for_en')]); !!}
        </div>
    </div>
    <!-- Quotation No Prefix -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][quotation_no_prefix_en]', __('lang_v1.quotation_no_prefix') . __('zatca::lang.for_en'). ':' ) !!}
            {!! Form::text('module_info[zatca][quotation_no_prefix_en]', $default['quotation_no_prefix_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.quotation_no_prefix') . __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <!-- Date Labels -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][date_label_en]', __('lang_v1.date_label'). __('zatca::lang.for_en') . ':' ) !!}
            {!! Form::text('module_info[zatca][date_label_en]', $default['date_label_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.date_label') . __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <!-- Due Date Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][due_date_label_en]', __('lang_v1.due_date_label') . __('zatca::lang.for_en') . ':' ) !!}
            {!! Form::text('module_info[zatca][due_date_label_en]', $default['due_date_label_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.due_date_label') . __('zatca::lang.for_en'), 'id' => 'due_date_label_en' ]); !!}
        </div>
    </div>
</div>
<!-- Sales Person and Commission Agent Labels -->
<div class="col-sm-3 hidden_en_input">
    <div class="form-group">
        {!! Form::label('module_info[zatca][sales_person_label_en]', __('lang_v1.sales_person_label') . __('zatca::lang.for_en'). ':' ) !!}
        {!! Form::text('module_info[zatca][sales_person_label_en]', $default['sales_person_label_en'], ['class' => 'form-control',
        'placeholder' => __('lang_v1.sales_person_label'). __('zatca::lang.for_en') ]); !!}
    </div>
</div>
<div class="col-sm-3 hidden_en_input">
    <div class="form-group">
        {!! Form::label('module_info[zatca][commission_agent_label_en]', __('lang_v1.commission_agent_label') . __('zatca::lang.for_en'). ':' ) !!}
        {!! Form::text('module_info[zatca][commission_agent_label_en]', $default['commission_agent_label_en'], ['class' => 'form-control',
        'placeholder' => __('lang_v1.commission_agent_label') . __('zatca::lang.for_en')]); !!}
    </div>
</div>
<!-- Customer Labels -->
<div class="col-sm-3 hidden_en_input">
    <div class="form-group">
        {!! Form::label('module_info[zatca][customer_label_en]', __('invoice.customer_label') .  __('zatca::lang.for_en').':' ) !!}
        {!! Form::text('module_info[zatca][customer_label_en]', $default['customer_label_en'], ['class' => 'form-control',
          'placeholder' => __('invoice.customer_label') . __('zatca::lang.for_en') ]); !!}
    </div>
</div>
<div class="col-sm-3 hidden_en_input">
    <div class="form-group">
        {!! Form::label('module_info[zatca][client_id_label_en]', __('lang_v1.client_id_label') . __('zatca::lang.for_en').':' ) !!}
        {!! Form::text('module_info[zatca][client_id_label_en]', $default['client_id_label_en'], ['class' => 'form-control',
          'placeholder' => __('lang_v1.client_id_label'). __('zatca::lang.for_en') ]); !!}
    </div>
</div>
<div class="col-sm-3 hidden_en_input">
    <div class="form-group">
        {!! Form::label('module_info[zatca][client_tax_label_en]', __('lang_v1.client_tax_label') .  __('zatca::lang.for_en').':' ) !!}
        {!! Form::text('module_info[zatca][client_tax_label_en]', $default['client_tax_label_en'], ['class' => 'form-control',
        'placeholder' => __('lang_v1.client_tax_label') . __('zatca::lang.for_en')]); !!}
    </div>
</div>
<div class="col-sm-12 text-center d-grid gap-3 btn-warning hidden_en_input ">
    <h4 class="text-dark">{{__('zatca::lang.zatca_module_en')}}</h4>
</div>
<!-- Start input English -->
<div class="hidden_en_input">  
    <!-- Table Labels -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][table_product_label_en]', __('lang_v1.product_label') . __('zatca::lang.for_en'). ':' ) !!}
            {!! Form::text('module_info[zatca][table_product_label_en]', $default['table_product_label_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.product_label'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][table_qty_label_en]', __('lang_v1.qty_label') . __('zatca::lang.for_en'). ':' ) !!}
            {!! Form::text('module_info[zatca][table_qty_label_en]', $default['table_qty_label_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.qty_label'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][table_unit_price_label_en]', __('lang_v1.unit_price_label'). __('zatca::lang.for_en') . ':' ) !!}
            {!! Form::text('module_info[zatca][table_unit_price_label_en]', $default['table_unit_price_label_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.unit_price_label'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][table_subtotal_label_en]', __('lang_v1.subtotal_label') . __('zatca::lang.for_en') . ':' ) !!}
            {!! Form::text('module_info[zatca][table_subtotal_label_en]', $default['table_subtotal_label_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.subtotal_label'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <!-- Category Code Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][cat_code_label_en]', __('lang_v1.cat_code_label') . __('zatca::lang.for_en'). ':' ) !!}
            {!! Form::text('module_info[zatca][cat_code_label_en]', $default['cat_code_label_en'], ['class' => 'form-control', 'placeholder' => 'HSN or Category Code other lang' ]); !!}
        </div>
    </div>
    <!-- Total Quantity Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][total_quantity_label_en]', __('lang_v1.total_quantity_label') . __('zatca::lang.for_en'). ':' ) !!}
            {!! Form::text('module_info[zatca][total_quantity_label_en]', $default['total_quantity_label_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.total_quantity_label'). __('zatca::lang.for_en'), 'id' => 'total_quantity_label_en' ]); !!}
        </div>
    </div>
    <!-- Item Discount Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][item_discount_label_en]', __('lang_v1.item_discount_label') . __('zatca::lang.for_en'). ':' ) !!}
            {!! Form::text('module_info[zatca][item_discount_label_en]', $default['item_discount_label_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.item_discount_label'). __('zatca::lang.for_en'), 'id' => 'item_discount_label_en' ]); !!}
        </div>
    </div>
    <!-- Item Tax Value Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][item_tax_value_label_en]', __('zatca::lang.item_tax_value_label') . __('zatca::lang.for_en'). ':' ) !!}
            {!! Form::text('module_info[zatca][item_tax_value_label_en]', $default['item_tax_value_label_en'], ['class' => 'form-control',
              'placeholder' => __('zatca::lang.item_tax_value_label'). __('zatca::lang.for_en'), 'id' => 'item_tax_value_label_en' ]); !!}
        </div>
    </div>
</div>
<!-- End input English -->
<div class="col-sm-12 text-center d-grid gap-3 btn-info hidden_en_input">
    <h4 class="text-dark">{{__('zatca::lang.zatca_module_en')}}</h4>
</div>
<!-- Start input English -->
<div class="hidden_en_input" >
    <!-- Subtotal Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][sub_total_label_en]', __('invoice.sub_total_label') .  __('zatca::lang.for_en') . ':' ) !!}
            {!! Form::text('module_info[zatca][sub_total_label_en]', $default['sub_total_label_en'], ['class' => 'form-control',
              'placeholder' => __('invoice.sub_total_label') . __('zatca::lang.for_en')]); !!}
        </div>
    </div>
    <!-- Discount Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][discount_label_en]', __('invoice.discount_label') .  __('zatca::lang.for_en') . ':' ) !!}
            {!! Form::text('module_info[zatca][discount_label_en]', $default['discount_label_en'], ['class' => 'form-control',
              'placeholder' => __('invoice.discount_label') . __('zatca::lang.for_en')]); !!}
        </div>
    </div>
    <!-- Tax Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][tax_label_en]', __('invoice.tax_label') .  __('zatca::lang.for_en') . ':' ) !!}
            {!! Form::text('module_info[zatca][tax_label_en]', $default['tax_label_en'], ['class' => 'form-control',
              'placeholder' => __('invoice.tax_label'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <!-- Total Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][total_label_en]', __('invoice.total_label') .  __('zatca::lang.for_en') . ':' ) !!}
            {!! Form::text('module_info[zatca][total_label_en]', $default['total_label_en'], ['class' => 'form-control',
              'placeholder' => __('invoice.total_label'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <!-- Total Items Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][total_items_label_en]', __('lang_v1.total_items_label') .  __('zatca::lang.for_en') . ':' ) !!}
            {!! Form::text('module_info[zatca][total_items_label_en]', $default['total_items_label_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.total_items_label') . __('zatca::lang.for_en'), 'id' => 'total_items_label' ]); !!}
        </div>
    </div>
    <!-- Round Off Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][round_off_label_en]', __('lang_v1.round_off_label') .  __('zatca::lang.for_en') . ':' ) !!}
            {!! Form::text('module_info[zatca][round_off_label_en]', $default['round_off_label_en'], ['class' => 'form-control',
              'placeholder' => __('lang_v1.round_off_label'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <!-- Total Due Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][total_due_label_en]', __('invoice.total_due_label') . ' (' . __('lang_v1.current_sale') . ')' . __('zatca::lang.for_en') .':' ) !!}
            {!! Form::text('module_info[zatca][total_due_label_en]', $default['total_due_label_en'], ['class' => 'form-control',
              'placeholder' => __('invoice.total_due_label'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <!-- Paid Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][paid_label_en]', __('invoice.paid_label') .  __('zatca::lang.for_en') . ':' ) !!}
            {!! Form::text('module_info[zatca][paid_label_en]', $default['paid_label_en'], ['class' => 'form-control',
              'placeholder' => __('invoice.paid_label'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- Previous Balance Label -->
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('module_info[zatca][prev_bal_label_en]', __('invoice.total_due_label') . ' (' . __('lang_v1.all_sales') . ')'. __('zatca::lang.for_en') .':' ) !!}
            {!! Form::text('module_info[zatca][prev_bal_label_en]', $default['prev_bal_label_en'], ['class' => 'form-control',
              'placeholder' => __('invoice.total_due_label'). __('zatca::lang.for_en') ]); !!}
        </div>
    </div>
</div>
<!-- End input English -->
@endcomponent
@endif
