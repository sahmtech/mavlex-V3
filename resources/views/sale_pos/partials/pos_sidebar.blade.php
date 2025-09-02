<style>
drawer-toggle {
    display: none;
}

.drawer-content label {
    cursor: pointer;
}

.drawer-toggle:checked + .drawer-content + .drawer-side .drawer-overlay {
    display: block;
}

.drawer-side {
    position: fixed;
    top: 0;
    bottom: 0;
    right: -100%;
    width: 20%;
    max-width: 400px;
    background-color: #fff;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
    overflow-y: auto;
    transition: right 0.3s ease;
    z-index: 1000;
}

.drawer-toggle:checked + .drawer-content + .drawer-side {
    right: 0;
}
html[dir="rtl"] .drawer-side {
    left: -100%; 
    right: auto; 
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5); 
}

html[dir="rtl"] .drawer-toggle:checked + .drawer-content + .drawer-side {
    left: 0;
    right: auto;
}

.drawer-menu {
    padding: 1rem;
    position: relative;
}

.card {
    border: 1px solid #ddd;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.card-body {
    padding: 1rem;
	border-radius: 20px;
}

.card-actions {
    text-align: center;
    margin-top: 0.5rem;
}


.main-category-div,
.product_category,
.product_brand_div
 {
    cursor: pointer;
}

@keyframes slideInFromRight {
    from {
        opacity: 0;
        transform: translateX(10px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.sub-category-dropdown {
    display: none;
    position: fixed;
    left: calc(61.5% - 5px); 
    margin-top: -45px;
    width: 50%;
    max-width: 300px;
    background: white;
    border: 2px solid #ddd;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    z-index: 1001; 
    opacity: 0;
    transform: translateX(10px); 
}

.drawer-menu .main-category-div:hover .sub-category-dropdown,
.drawer-menu .main-category-div:focus-within .sub-category-dropdown {
    display: block;
    animation: slideInFromRight 0.6s ease forwards;
}

@media (min-width: 576px) {
    .drawer-menu .row > .col-md-3,
    .drawer-menu .row > .col-md-4 {
        display: inline-block;
        width: 100%;
    }
}

@media (max-width: 575px) {
    .drawer-menu .row > .col-md-3,
    .drawer-menu .row > .col-md-4 {
        display: inline-block;
        width: 100%;
    }
}
.close-side-bar {
    position: absolute;
    top: 10px; 
    right: 10px; 
    background: none; 
    border: none; 
    font-size: 24px; 
    cursor: pointer;
    z-index: 1001; 
}

.close-side-bar i {
    color: #000;
}
</style>


<div class="row" id="featured_products_box" style="display: none;">
    @if (!empty($featured_products))
        @include('sale_pos.partials.featured_products')
    @endif
</div>
    
    <!-- Priduct Category -->
    <div class="selections">
	<div class="row">
            @if (!empty($categories))
                <div class="col-md-6" id="product_category_div">
                    <div class="drawer drawer-end">
                        <input id="category-drawer-toggle" type="checkbox" class="drawer-toggle hide">
                        <div class="drawer-content">
                            <!-- Page content here -->
                            <label for="category-drawer-toggle" class="btn btn-primary" >
                                @lang('category.category')
                            </label>
                        </div>
          <div class="drawer-side" id="category-drawer" style="z-index: 4000;">
                            <label for="category-drawer-toggle" aria-label="close sidebar" class="drawer-overlay overlay-category"></label>
                            <div class="drawer-menu bg-white">
                                <div class="align-items-center mb-4 " style="margin-bottom: 20px;">
                                    <button type="button" class="btn category-back back" style="display: none;">
                                        <img src="{{ asset('img/icons/back-icon.svg') }}" alt="">
                                    </button>
									<button type="button" class="close-side-bar-category close-side-bar">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </button>
                                    <h3 class="text-center category_heading mb-0" style="margin-top:5px;">@lang('category.category')</h3>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-xs-12 mb-3 main-category-div main-category no-print" data-value="all" data-parent="0">
                                        <div class="">
                                            <div class="card-body">
                                                <h4 class="m-0">All Categories</h4>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($categories as $category)
                                        <div class="col-md-3 main-category-div no-print" data-value="{{ $category['id'] }}" data-name="{{ $category['name'] }}" data-parent="1">
                                            <div class="">
                                                <div class="card-body">
                                                    
													<button type="button" class="main-category" data-value="{{ $category['id'] }}" data-parent="0">{{ $category['name'] }}@if (!empty($category['sub_categories']))  » @endif</button>
                                                    @if (!empty($category['sub_categories']))
                                                       
                                                        <div class="sub-category-dropdown ">
														<h3 class="text-center category_heading mb-0" style="margin-top:5px;"> {{ $category['name'] }} - @lang('category.sub_categories')</h3>
                                                            @foreach ($category['sub_categories'] as $sc)
															
                                                                <div class="product_category no-print" data-value="{{ $sc['id'] }}">
                                                                    <div class="card">
                                                                        <div class="card-body p-2">
                                                                            <h4 class="align-items-center">{{ $sc['name'] }}</h4>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
													
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (!empty($brands))
                <div class="col-md-6" id="product_brand_div">
                    <div class="drawer drawer-end">
                        <input id="brand-drawer-toggle" type="checkbox" class="drawer-toggle hide">
                        <div class="drawer-content">
                            <!-- Page content here -->
                            <label for="brand-drawer-toggle" class="btn btn-primary">
                                @lang('brand.brands')
                            </label>
							<div class="overlay-full" id="overlay-full"></div>
                        </div>
                        <div class="drawer-side" id="brand-drawer" style="z-index: 4000;">
                            <label for="brand-drawer-toggle" aria-label="close sidebar" class="drawer-overlay overlay-brand"></label>
                            <div class="drawer-menu bg-white">
                                <div class="mb-4" style="margin-bottom: 20px;">
								<button type="button" class="close-side-bar-brand close-side-bar">
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </button>
                                    <h3 class="text-center text-primary mb-4" >@lang('brand.brands')</h3>
                                    
                                </div>
                                <div class="row product_brand_div">
                                    @foreach ($brands as $key => $brand)
                                        <div class="col-md-4 product_brand no-print" data-value="{{ $key }}">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="align-items-center">{{ $brand }}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
		<div class="form-box hide" id="product_service_div">
			{!! Form::select('is_enabled_stock', ['' => __('messages.all'), 'product' => __('sale.product'), 'service' => __('lang_v1.service')], null, ['id' => 'is_enabled_stock', 'class' => 'select2', 'name' => null, 'style' => 'width:100% !important']) !!}
		</div>

		<div class="col-sm-4 @if (empty($featured_products)) hide @endif" id="feature_product_div">
        <button type="button" class="btn btn-primary btn-flat"
            id="show_featured_products">@lang('lang_v1.featured_products')</button>
    </div>
        
    </div>

    <!-- List of Products -->
    <!-- <div class="product-list"> TODO: Product list -->
	<div class="row">
        <input type="hidden" id="suggestion_page" value="1">
		
        <div class="col-md-12">
		<div class="eq-height-row" id="product_list_body"></div>
	</div>
		
		<div class="col-md-12 text-center" id="suggestion_page_loader" style="display: none;">
			<i class="fa fa-spinner fa-spin fa-2x"></i>
		</div>
    </div>               

