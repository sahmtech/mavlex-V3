<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <p>@lang('essentials::lang.calculate_sales_target_commission_without_tax') @show_tooltip(__('essentials::lang.calculate_sales_target_commission_without_tax_help'))</p>
                <div class="toggle-wrapper d-flex gap-2 mt-4">
                    <label class="switch" for="calculate_sales_target_commission_without_tax">
                        {!! Form::checkbox('calculate_sales_target_commission_without_tax', 1, !empty($settings['calculate_sales_target_commission_without_tax']) ? 1 : 0, ['id' => 'calculate_sales_target_commission_without_tax']) !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                </div>
            </div>
        </div>
        
    </div>
</div>