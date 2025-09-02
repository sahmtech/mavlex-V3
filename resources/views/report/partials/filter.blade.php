<div class="modal-dialog" role="document">
	
	<div class="modal-content">
		@if($status == 'stock')
			{!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'stock_report_filter_form' ]) !!}
		@endif
		@if($status == 'trending')
			{!! Form::open(['url' => action('ReportController@getTrendingProducts'), 'method' => 'get' ]) !!}
		@endif
		@if($status == 'product_purchase')
			{!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'product_purchase_report_form' ]) !!}
		@endif

		@if($status == 'product_sell')
			{!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'product_sell_report_form' ]) !!}
		@endif

		@if($status == 'purchase_payment')
			{!! Form::open(['url' => '#', 'method' => 'get', 'id' => 'purchase_payment_report_form' ]) !!}
		@endif

		@if($status == 'sell_payment')
			{!! Form::open(['url' => '#', 'method' => 'get', 'id' => 'sell_payment_report_form' ]) !!}
		@endif

		@if($status == 'expense')
			{!! Form::open(['url' => action('ReportController@getExpenseReport'), 'method' => 'get' ]) !!}
		@endif

		@if($status == 'expiry')
			{!! Form::open(['url' => action('ReportController@getStockExpiryReport'), 'method' => 'get', 'id' => 'stock_report_filter_form' ]) !!}
		@endif
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">@lang('report.filters')</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				@if($status == 'stock')
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
	                        {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('category_id', __('category.category') . ':') !!}
	                        {!! Form::select('category', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
	                        {!! Form::select('sub_category', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('brand', __('product.brand') . ':') !!}
	                        {!! Form::select('brand', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('unit',__('product.unit') . ':') !!}
	                        {!! Form::select('unit', $units, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
	                    </div>
	                </div>
	                @if($show_manufacturing_data)
					<div class="col-sm-6">
						<div class="form-group">
							<p>{{ __('manufacturing::lang.only_mfg_products') }}</p>
							<div class="toggle-wrapper d-flex gap-2 mt-4">
								<label class="switch" for="only_mfg_products">
									{!! Form::checkbox('only_mfg', 1, false, ['id' => 'only_mfg_products']) !!}
									<div class="sliderCheckbox round"></div>
								</label>
							</div>
						</div>
					</div>
					
	                @endif
                @endif

                @if($status == 'trending')
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                            {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('category_id', __('product.category') . ':') !!}
                            {!! Form::select('category', $categories, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
                            {!! Form::select('sub_category', array(), null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('brand', __('product.brand') . ':') !!}
                            {!! Form::select('brand', $brands, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('unit', __('product.unit') . ':') !!}
                            {!! Form::select('unit', $units, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('trending_product_date_range',__('report.date_range') .  ':') !!}
                            {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'trending_product_date_range', 'readonly']); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('limit', __('lang_v1.no_of_products') . ':') !!} @show_tooltip(__('tooltip.no_of_products_for_trending_products'))
                            {!! Form::number('limit', 5, ['placeholder' => __('lang_v1.no_of_products'), 'class' => 'form-control', 'min' => 1]); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('product_type', __('product.product_type') . ':') !!}
                            {!! Form::select('product_type', ['single' => __('lang_v1.single'), 'variable' => __('lang_v1.variable'), 'combo' => __('lang_v1.combo')], request()->input('product_type'), ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
                        </div>
                    </div>
                @endif

                @if($status == 'item')
                	<div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('ir_supplier_id', __('purchase.supplier') . ':') !!}
                            {!! Form::select('ir_supplier_id', $suppliers, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all')]); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('ir_purchase_date_filter', __('purchase.purchase_date') . ':') !!}
                            {!! Form::text('ir_purchase_date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('ir_customer_id', __('contact.customer') . ':') !!}
                            {!! Form::select('ir_customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.all')]); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('ir_sale_date_filter', __('lang_v1.sell_date') . ':') !!}
                            {!! Form::text('ir_sale_date_filter', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('ir_location_id', __('purchase.business_location').':') !!}
                            {!! Form::select('ir_location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
                        </div>
                    </div>
                    @if(Module::has('Manufacturing'))
					<div class="col-sm-6">
						<div class="form-group">
							<p>@lang('manufacturing::lang.only_mfg_products')</p>
							<div class="toggle-wrapper d-flex gap-2 mt-4">
								<label class="switch" for="only_mfg_products">
									{!! Form::checkbox('only_mfg', 1, false, ['id' => 'only_mfg_products']) !!}
									<div class="sliderCheckbox round"></div>
								</label>
							</div>
						</div>
					</div>
					
                    @endif
                @endif

                @if($status == 'product_purchase')
		            <div class="col-md-6">
		                <div class="form-group">
			                {!! Form::label('search_product', __('lang_v1.search_product') . ':') !!}
			                <input type="hidden" value="" id="variation_id">
	                      	{!! Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'autofocus']); !!}
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                    {!! Form::label('supplier_id', __('purchase.supplier') . ':') !!}
		                    {!! Form::select('supplier_id', $suppliers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">
		                    {!! Form::label('location_id', __('purchase.business_location').':') !!}
		                    {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="form-group">

		                    {!! Form::label('product_pr_date_filter', __('report.date_range') . ':') !!}
		                    {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'product_pr_date_filter', 'readonly']); !!}
		                </div>
		            </div>
            
                @endif

                @if($status == 'product_sell')
              
	                <div class="col-md-6">
	                    <div class="form-group">
	                    	{!! Form::label('search_product', __('lang_v1.search_product') . ':') !!}
	                        {!! Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'autofocus']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('customer_id', __('contact.customer') . ':') !!}
	                        {!! Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('psr_customer_group_id', __( 'lang_v1.customer_group_name' ) . ':') !!}
	                        {!! Form::select('psr_customer_group_id', $customer_group, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'psr_customer_group_id']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('location_id', __('purchase.business_location').':') !!}
	                        {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('category_id', __('product.category') . ':') !!}
	                        {!! Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'psr_filter_category_id', 'placeholder' => __('lang_v1.all')]); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('brand_id', __('product.brand') . ':') !!}
	                        {!! Form::select('brand_id', $brands, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'psr_filter_brand_id', 'placeholder' => __('lang_v1.all')]); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('product_sr_date_filter', __('report.date_range') . ':') !!}
	                        {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'product_sr_date_filter', 'readonly']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    {!! Form::label('product_sr_start_time', __('lang_v1.time_range') . ':') !!}
	                    @php
	                        $startDay = Carbon\Carbon::now()->startOfDay();
	                        $endDay   = $startDay->copy()->endOfDay();
	                    @endphp
	                    <div class="form-group">
	                        {!! Form::text('start_time', @format_time($startDay), ['style' => __('lang_v1.select_a_date_range'), 'class' => 'form-control width-50 f-left', 'id' => 'product_sr_start_time']); !!}
	                        {!! Form::text('end_time', @format_time($endDay), ['class' => 'form-control width-50 f-left', 'id' => 'product_sr_end_time']); !!}
	                    </div>
	                </div>
                
                @endif

                @if($status == 'purchase_payment')
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('supplier_id', __('purchase.supplier') . ':') !!}
	                        {!! Form::select('supplier_id', $suppliers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('location_id', __('purchase.business_location').':') !!}
	                        {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('ppr_date_filter', __('report.date_range') . ':') !!}
	                        {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'ppr_date_filter', 'readonly']); !!}
	                    </div>
	                </div> 
                @endif

                @if($status == 'sell_payment')
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('customer_id', __('contact.customer') . ':') !!}
	                        {!! Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'required']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('location_id', __('purchase.business_location').':') !!}
	                        {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'required']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('payment_types', __('lang_v1.payment_method').':') !!}
	                        {!! Form::select('payment_types', $payment_types, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'required']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('customer_group_filter', __('lang_v1.customer_group').':') !!}
	                        {!! Form::select('customer_group_filter', $customer_group, null, ['class' => 'form-control select2']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">

	                        {!! Form::label('spr_date_filter', __('report.date_range') . ':') !!}
	                        {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'spr_date_filter', 'readonly']); !!}
	                    </div>
	                </div>
                @endif

                @if($status == 'expense')
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                            {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('category_id', __('category.category').':') !!}
                            {!! Form::select('category', $categories, null, ['placeholder' =>
                            __('report.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('trending_product_date_range', __('report.date_range') . ':') !!}
                            {!! Form::text('date_range', null , ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'trending_product_date_range', 'readonly']); !!}
                        </div>
                    </div>
                @endif

                @if($status == 'expiry')
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
	                        {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('category_id', __('product.category') . ':') !!}
	                        {!! Form::select('category', $categories, null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('sub_category_id', __('product.sub_category') . ':') !!}
	                        {!! Form::select('sub_category', array(), null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sub_category_id']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('brand', __('product.brand') . ':') !!}
	                        {!! Form::select('brand', $brands, null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('unit', __('product.unit') . ':') !!}
	                        {!! Form::select('unit', $units, null, ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('view_stock_filter', __('report.view_stocks') . ':') !!}
	                        {!! Form::select('view_stock_filter', $view_stock_filter, null, ['placeholder' => __('messages.all'), 'class' => 'form-control select2', 'style' => 'width:100%']); !!}
	                    </div>
	                </div>
	                @if(Module::has('Manufacturing'))
					<div class="col-sm-6">
						<div class="form-group">
							<p>@lang('manufacturing::lang.only_mfg_products')</p>
							<div class="toggle-wrapper d-flex gap-2 mt-4">
								<label class="switch" for="only_mfg_products">
									{!! Form::checkbox('only_mfg', 1, false, ['id' => 'only_mfg_products']) !!}
									<div class="sliderCheckbox round"></div>
								</label>
							</div>
						</div>
					</div>
					
	                @endif
                @endif
			</div>
			
		</div>
		<div class="modal-footer">
			@if($status == 'trending' || $status == 'expense')
				<button type="submit" class="btn btn-primary">@lang('messages.apply')</button>
			@else
				<button type="submit" class="btn btn-primary" data-dismiss="modal">@lang('messages.apply')</button>
			@endif
		    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
		</div>

		{!! Form::close() !!}
		
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->