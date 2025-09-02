<div class="pos-tab-content active">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name',__('business.business_name') . ':*') !!}
                        {!! Form::text('name', $business->name, ['class' => 'form-control', 'required',
                        'placeholder' => __('business.business_name')]); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('start_date', __('business.start_date') . ':') !!}
                        {!! Form::text('start_date', @format_date($business->start_date), ['class' => 'form-control start-date-picker','placeholder' => __('business.start_date'), 'readonly']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('default_profit_percent', __('business.default_profit_percent') . ':*') !!} @show_tooltip(__('tooltip.default_profit_percent'))
                        {!! Form::text('default_profit_percent', @num_format($business->default_profit_percent), ['class' => 'form-control input_number']); !!}
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('currency_id', __('business.currency') . ':') !!}
                        {!! Form::select('currency_id', $currencies, $business->currency_id, ['class' => 'form-control select2','placeholder' => __('business.currency'), 'required']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('currency_symbol_placement', __('lang_v1.currency_symbol_placement') . ':') !!}
                        {!! Form::select('currency_symbol_placement', ['before' => __('lang_v1.before_amount'), 'after' => __('lang_v1.after_amount')], $business->currency_symbol_placement, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('time_zone', __('business.time_zone') . ':') !!}
                        {!! Form::select('time_zone', $timezone_list, $business->time_zone, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('currency_precision', __('lang_v1.currency_precision') . ':*') !!} @show_tooltip(__('lang_v1.currency_precision_help'))
                        {!! Form::select('currency_precision', [0 =>0, 1=>1, 2=>2, 3=>3,4=>4], $business->currency_precision, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('quantity_precision', __('lang_v1.quantity_precision') . ':*') !!} @show_tooltip(__('lang_v1.quantity_precision_help'))
                        {!! Form::select('quantity_precision', [0 =>0, 1=>1, 2=>2, 3=>3,4=>4], $business->quantity_precision, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="clearfix"></div>

            
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('fy_start_month', __('business.fy_start_month') . ':') !!} @show_tooltip(__('tooltip.fy_start_month'))
                        {!! Form::select('fy_start_month', $months, $business->fy_start_month, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('accounting_method', __('business.accounting_method') . ':*') !!}
                        @show_tooltip(__('tooltip.accounting_method'))
                        {!! Form::select('accounting_method', $accounting_methods, $business->accounting_method, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('transaction_edit_days', __('business.transaction_edit_days') . ':*') !!}
                        @show_tooltip(__('tooltip.transaction_edit_days'))
                        {!! Form::number('transaction_edit_days', $business->transaction_edit_days, ['class' => 'form-control','placeholder' => __('business.transaction_edit_days'), 'required']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('date_format', __('lang_v1.date_format') . ':*') !!}
                        {!! Form::select('date_format', $date_formats, $business->date_format, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('time_format', __('lang_v1.time_format') . ':*') !!}
                        {!! Form::select('time_format', [12 => __('lang_v1.12_hour'), 24 => __('lang_v1.24_hour')], $business->time_format, ['class' => 'form-control select2', 'required']); !!}
                    </div>
                </div>
                <div class="clearfix"></div>
                @if(!empty($app_settings->enable_custom_sidebar_logo) && $app_settings->enable_custom_sidebar_logo === true)
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('business_logo_light', __('lang_v1.upload_light_logo') . ':') !!}
                            @show_tooltip(__('lang_v1.logo_help_light'))
                            {!! Form::file('business_logo_light', ['accept' => 'image/*']) !!}
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('business_logo_dark', __('lang_v1.upload_dark_logo') . ':') !!}
                            @show_tooltip(__('lang_v1.logo_help_dark'))
                            {!! Form::file('business_logo_dark', ['accept' => 'image/*']) !!}
                        </div>
                    </div>
                    
                @endif


            </div>
             {{-- code --}}
            <div class="row hide">
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('code_label_1', __('lang_v1.code_1_name') . ':') !!}
                        {!! Form::text('code_label_1', $business->code_label_1, ['class' => 'form-control']); !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('code_1', __('lang_v1.code_1') . ':') !!}
                        {!! Form::text('code_1', $business->code_1, ['class' => 'form-control']); !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('code_label_2', __('lang_v1.code_2_name') . ':') !!}
                        {!! Form::text('code_label_2', $business->code_label_2, ['class' => 'form-control']); !!}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('code_2', __('lang_v1.code_2') . ':') !!}
                        {!! Form::text('code_2', $business->code_2, ['class' => 'form-control']); !!}
                    </div>
                </div>
            </div>
      
    


</div>
