<div class="pos-tab-content">
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {{-- Hidden field ensures a 0 is sent if checkbox is unchecked --}}
                        {!! Form::hidden('dashboard_settings[disable_performance]', 0) !!}
                        <label class="switch" for="disable_performance">
                            {!! Form::checkbox('dashboard_settings[disable_performance]', 1, $dashboard_settings['disable_performance'], ['id' => 'disable_performance']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __('lang_v1.disable_performance') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('dashboard_settings[disable_sales_due]', 0) !!}
                        <label class="switch" for="disable_sales_due">
                            {!! Form::checkbox('dashboard_settings[disable_sales_due]', 1, $dashboard_settings['disable_sales_due'], ['id' => 'disable_sales_due']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __('lang_v1.disable_sales_due') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('dashboard_settings[disable_purchase_due]', 0) !!}
                        <label class="switch" for="disable_purchase_due">
                            {!! Form::checkbox('dashboard_settings[disable_purchase_due]', 1, $dashboard_settings['disable_purchase_due'], ['id' => 'disable_purchase_due']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __('lang_v1.disable_purchase_due') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('dashboard_settings[disable_stock_alert]', 0) !!}
                        <label class="switch" for="disable_stock_alert">
                            {!! Form::checkbox('dashboard_settings[disable_stock_alert]', 1, $dashboard_settings['disable_stock_alert'], ['id' => 'disable_stock_alert']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __('lang_v1.disable_stock_alert') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('dashboard_settings[disable_stock_expiry]', 0) !!}
                        <label class="switch" for="disable_stock_expiry">
                            {!! Form::checkbox('dashboard_settings[disable_stock_expiry]', 1, $dashboard_settings['disable_stock_expiry'], ['id' => 'disable_stock_expiry']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __('lang_v1.disable_stock_expiry') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('dashboard_settings[disable_sales_order]', 0) !!}
                        <label class="switch" for="disable_sales_order">
                            {!! Form::checkbox('dashboard_settings[disable_sales_order]', 1, $dashboard_settings['disable_sales_order'], ['id' => 'disable_sales_order']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __('lang_v1.disable_sales_order') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('dashboard_settings[disable_purchase_order]', 0) !!}
                        <label class="switch" for="disable_purchase_order">
                            {!! Form::checkbox('dashboard_settings[disable_purchase_order]', 1, $dashboard_settings['disable_purchase_order'], ['id' => 'disable_purchase_order']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __('lang_v1.disable_purchase_order') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('dashboard_settings[disable_pending_shipments]', 0) !!}
                        <label class="switch" for="disable_pending_shipments">
                            {!! Form::checkbox('dashboard_settings[disable_pending_shipments]', 1, $dashboard_settings['disable_pending_shipments'], ['id' => 'disable_pending_shipments']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __('lang_v1.disable_pending_shipments') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('dashboard_settings[disable_payment_recover]', 0) !!}
                        <label class="switch" for="disable_payment_recover">
                            {!! Form::checkbox('dashboard_settings[disable_payment_recover]', 1, $dashboard_settings['disable_payment_recover'], ['id' => 'disable_payment_recover']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __('lang_v1.disable_payment_recover') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('dashboard_settings[disable_fy_sales_chart]', 0) !!}
                        <label class="switch" for="disable_fy_sales_chart">
                            {!! Form::checkbox('dashboard_settings[disable_fy_sales_chart]', 1, $dashboard_settings['disable_fy_sales_chart'], ['id' => 'disable_fy_sales_chart']) !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __('lang_v1.disable_fy_sales_chart') }}</p>
                    </div>
                </div>
            </div>

            
                <!-- Sell Return Widget -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                      {!! Form::hidden('dashboard_settings[disable_sell_return_widget]', 0) !!}
                      <label class="switch" for="disable_sell_return_widget">
                        {!! Form::checkbox('dashboard_settings[disable_sell_return_widget]', 1, $dashboard_settings['disable_sell_return_widget'] ?? 0, ['id' => 'disable_sell_return_widget']) !!}
                        <div class="sliderCheckbox round"></div>
                      </label>
                      <p>{{ __('lang_v1.disable_sell_return_widget') }}</p>
                    </div>
                  </div>
                </div>
              
                <!-- Purchase Return Widget -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                      {!! Form::hidden('dashboard_settings[disable_purchase_return_widget]', 0) !!}
                      <label class="switch" for="disable_purchase_return_widget">
                        {!! Form::checkbox('dashboard_settings[disable_purchase_return_widget]', 1, $dashboard_settings['disable_purchase_return_widget'] ?? 0, ['id' => 'disable_purchase_return_widget']) !!}
                        <div class="sliderCheckbox round"></div>
                      </label>
                      <p>{{ __('lang_v1.disable_purchase_return_widget') }}</p>
                    </div>
                  </div>
                </div>
              
                <!-- Expense Widget -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                      {!! Form::hidden('dashboard_settings[disable_expense_widget]', 0) !!}
                      <label class="switch" for="disable_expense_widget">
                        {!! Form::checkbox('dashboard_settings[disable_expense_widget]', 1, $dashboard_settings['disable_expense_widget'] ?? 0, ['id' => 'disable_expense_widget']) !!}
                        <div class="sliderCheckbox round"></div>
                      </label>
                      <p>{{ __('lang_v1.disable_expense_widget') }}</p>
                    </div>
                  </div>
                </div>
              
                <!-- Total Purchase Widget -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                      {!! Form::hidden('dashboard_settings[disable_total_purchase_widget]', 0) !!}
                      <label class="switch" for="disable_total_purchase_widget">
                        {!! Form::checkbox('dashboard_settings[disable_total_purchase_widget]', 1, $dashboard_settings['disable_total_purchase_widget'] ?? 0, ['id' => 'disable_total_purchase_widget']) !!}
                        <div class="sliderCheckbox round"></div>
                      </label>
                      <p>{{ __('lang_v1.disable_total_purchase_widget') }}</p>
                    </div>
                  </div>
                </div>
              
                <!-- Purchase Due Widget -->
                <div class="col-sm-4">
                  <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                      {!! Form::hidden('dashboard_settings[disable_purchase_due_widget]', 0) !!}
                      <label class="switch" for="disable_purchase_due_widget">
                        {!! Form::checkbox('dashboard_settings[disable_purchase_due_widget]', 1, $dashboard_settings['disable_purchase_due_widget'] ?? 0, ['id' => 'disable_purchase_due_widget']) !!}
                        <div class="sliderCheckbox round"></div>
                      </label>
                      <p>{{ __('lang_v1.disable_purchase_due_widget') }}</p>
                    </div>
                  </div>
                </div>
</div>
              