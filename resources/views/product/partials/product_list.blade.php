@php 
    $colspan = 4;
    $custom_labels = json_decode(session('business.custom_labels'), true);
@endphp
<div class="table-responsive">
    <table class="table table-bordered table-striped ajax_view max-table hide-footer" id="product_table">
        <thead>
            <tr>
                <th><input type="checkbox" id="select-all-row" data-table-id="product_table"></th>
                <th>@lang('messages.action')</th>
                <th>@lang('product.sku')</th>
                <th>&nbsp;</th>
                <th>@lang('sale.product')</th>
                <th>@lang('purchase.business_location') @show_tooltip(__('lang_v1.product_business_location_tooltip'))</th>
                @can('view_purchase_price')
                    @php 
                        $colspan++;
                    @endphp
                    <th>@lang('lang_v1.unit_perchase_price')</th>
                @endcan
                @can('access_default_selling_price')
                    @php 
                        $colspan++;
                    @endphp
                    <th>@lang('lang_v1.selling_price')</th>
                @endcan
                <th>@lang('report.current_stock')</th>
                <th>@lang('product.brand')</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="{{$colspan}}">
                <div style="display: flex; width: 50%; float: left;">
                        @can('product.update')
                        
                            @if(config('constants.enable_product_bulk_edit'))
                                &nbsp;
                                {!! Form::open(['url' => action('ProductController@bulkEdit'), 'method' => 'post', 'id' => 'bulk_edit_form' ]) !!}
                                {!! Form::hidden('selected_products', null, ['id' => 'selected_products_for_edit']); !!}
                                <button type="submit" class="btn btn-xs btn-warning edit-selected" id="edit-selected" style="background-color: #d58512; border-color: #985f0d;"> <i class="fa fa-edit"></i>{{__('lang_v1.bulk_edit')}}</button>
                                {!! Form::close() !!}
                            @endif
                            &nbsp;
                            <button type="button" class="btn btn-xs btn-danger update_product_location remove_from_location" data-type="remove">@lang('lang_v1.remove_from_location')</button>
                            &nbsp;
                            <button type="button" class="btn btn-xs bg-navy update_product_location" data-type="add">@lang('lang_v1.add_to_location')</button>
                        @endcan
                    
                    &nbsp;
                    
                    @if($is_woocommerce)
                        <button type="button" class="btn btn-xs btn-warning toggle_woocomerce_sync">
                            @lang('lang_v1.woocommerce_sync')
                        </button>
                    @endif
                    </div>

                    <div style="display: flex;  justify-content: right;">
                    
                    {!! Form::open(['url' => action('ProductController@massDeactivate'), 'method' => 'post', 'id' => 'mass_deactivate_form' ]) !!}
                    {!! Form::hidden('selected_products', null, ['id' => 'selected_products']); !!}
                    {!! Form::submit(__('lang_v1.deactivate_selected'), array('class' => 'btn btn-xs bg-navy', 'id' => 'deactivate-selected')) !!}
                    {!! Form::close() !!} @show_tooltip(__('lang_v1.deactive_product_tooltip'))
                    &nbsp;

                    @can('product.delete')
                        {!! Form::open(['url' => action('ProductController@massDestroy'), 'method' => 'post', 'id' => 'mass_delete_form' ]) !!}
                        {!! Form::hidden('selected_rows', null, ['id' => 'selected_rows']); !!}
                        {!! Form::submit(__('lang_v1.delete_selected'), array('class' => 'btn btn-xs btn-danger', 'id' => 'delete-selected')) !!}
                        {!! Form::close() !!}
                    @endcan
                    
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>