@extends('layouts.app')
@section('title', __('barcode.print_labels'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.product', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang( 'sale.products' )</h1>
                <p>@lang('barcode.print_labels')</p>
            </div>

        </div>
        <!-- End of Filter through table -->

            <div class="content no-print">
            	{!! Form::open(['url' => '#', 'method' => 'post', 'id' => 'preview_setting_form', 'onsubmit' => 'return false']) !!}
            	<div class="overview-filter" style="border: none;">
                    <div class="filter">
                        <div class="search">
                            {!! Form::text('search_product', null, ['id' => 'search_product_for_label', 'placeholder' => __('lang_v1.enter_product_name_to_print_labels'), 'autofocus']); !!}
                            <img src="{{ asset('img/icons/search-icon.svg') }}" alt="">
                        </div>

                    </div>
                </div>

                <table class="max-table" style="margin-bottom: 20px;" id="product_table">
                    <thead>
                        <tr>
                            <th>@lang( 'barcode.products' )</th>
							<th>@lang( 'barcode.no_of_labels' )</th>
							@if(request()->session()->get('business.enable_lot_number') == 1)
								<th>@lang( 'lang_v1.lot_number' )</th>
							@endif
							@if(request()->session()->get('business.enable_product_expiry') == 1)
								<th>@lang( 'product.exp_date' )</th>
							@endif
							<th>@lang('lang_v1.packing_date')</th>
							<th>@lang('lang_v1.selling_price_group')</th>
                        </tr>
                    </thead>
                    <tbody>
						@include('labels.partials.show_table_rows', ['index' => 0])
					</tbody>
                </table>

                <!-- Accordion -->
                    <div class="accordionItem">
                        <!-- Accordion Title -->
                        <div class="accordionTitle is-open">
                            <h2 class=""> @lang( 'barcode.information_to_show_on_label' )</h2>

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        
                        <!-- Personal Information -->
                      <div class="accordionContent">
                        <div class="modalThreeGrid">
                            <div class="form-box">
                                <div class="toggle-wrapper">
                                    <label class="switchBtn">
                                        <input type="checkbox" checked name="print[name]" value="1">
                                        <span class="slider"></span>
                                    </label>

                                    <p>@lang( 'barcode.print_name' )</p>
                                </div>
                                <input type="text" name="print[name_size]" 
									value="15" placeholder="@lang( 'lang_v1.size' )">
                            </div>

                            <div class="form-box">
                                <div class="toggle-wrapper">
                                    <label class="switchBtn">
                                        <input type="checkbox" checked name="print[variations]" value="1">
                                        <span class="slider"></span>
                                    </label>

                                    <p>@lang( 'barcode.print_variations' )</p>
                                </div>
                                <input type="text" 
									name="print[variations_size]" 
									value="17" placeholder="@lang( 'lang_v1.size' )">
                            </div>

                            <div class="form-box">
                                <div class="toggle-wrapper">
                                    <label class="switchBtn">
                                    	<input type="checkbox" checked name="print[price]" value="1" id="is_show_price">
                                        <span class="slider"></span>
                                    </label>

                                    <p>@lang( 'barcode.print_price' )</p>
                                </div>
                                <input type="text" 
									name="print[price_size]" 
									value="17" placeholder="@lang( 'lang_v1.size' )">
                            </div>

                            <div class="form-box">
                                <div class="" id="price_type_div">

                                <div class="form-group">
                                    {!! Form::label('print[price_type]', @trans( 'barcode.show_price' ) . ':') !!}
                                    {!! Form::select('print[price_type]', ['inclusive' => __('product.inc_of_tax'), 'exclusive' => __('product.exc_of_tax')], 'inclusive', ['class' => 'form-control']); !!}
                                </div>
                            </div>
                            </div>

                            <div class="form-box">
                                <div class="toggle-wrapper">
                                    <label class="switchBtn">
                                    	<input type="checkbox" checked name="print[business_name]" value="1">
                                        <span class="slider"></span>
                                    </label>

                                    <p>@lang( 'barcode.print_business_name' )</p>
                                </div>
                                <input type="text" placeholder="@lang( 'lang_v1.size' )"
									name="print[business_name_size]" 
									value="20">
                            </div>

                            <div class="form-box">
                                <div class="toggle-wrapper">
                                    <label class="switchBtn">
                                        <input type="checkbox" checked name="print[packing_date]" value="1">
                                        <span class="slider"></span>
                                    </label>

                                    <p>@lang( 'lang_v1.print_packing_date' )</p>
                                </div>
                                <input type="text" placeholder="@lang( 'lang_v1.size' )"
									name="print[packing_date_size]" 
									value="12">
                            </div>

                            @if(request()->session()->get('business.enable_product_expiry') == 1)
	                            <div class="form-box">
	                                <div class="toggle-wrapper">
	                                    <label class="switchBtn">
	                                        <input type="checkbox" checked name="print[exp_date]" value="1"> 
	                                        <span class="slider"></span>
	                                    </label>

	                                    <p>@lang( 'lang_v1.print_exp_date' )</p>
	                                </div>
	                                <input type="text" placeholder="@lang( 'lang_v1.size' )" 
										name="print[exp_date_size]" 
										value="12">
	                            </div>
                            @endif

                            @if(request()->session()->get('business.enable_lot_number') == 1)
                            <div class="form-box">
                                <div class="toggle-wrapper">
                                    <label class="switchBtn">
                                        <input type="checkbox" checked name="print[lot_number]" value="1">
                                        <span class="slider"></span>
                                    </label>

                                    <p>@lang( 'lang_v1.print_lot_number' )</p>
                                </div>
                                <input type="text" placeholder="@lang( 'lang_v1.size' )" 
										name="print[lot_number_size]" 
										value="12">
                            </div>
                          	@endif

                          
                        </div>
                      </div>
                      <!-- End of Personal Information -->
                    </div>
                <!-- End of Accordion -->

                <!-- Accordion -->
                    <div class="accordionItem">
                        <!-- Accordion Title -->
                        <div class="accordionTitle is-open">
                            <h2 class="">@lang( 'barcode.barcode_settings' )</h2>

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 9L12 15L18 9" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        
                        <!-- Roles and Permission -->
                      <div class="accordionContent">
                        <div class="modalTwoGrid">
                            <div class="form-box">
                                {!! Form::select('barcode_setting', $barcode_settings, !empty($default) ? $default->id : null); !!}
                            </div>


                        </div>
                      </div>
                      <!-- End Roles and Permission -->
                    </div>
                <!-- End of Accordion -->

               {!! Form::close() !!}
            </div>

        <div class="footer">
            
           
                 <div class="new-user">
                   
                </div>

                <div class="new-user">
                     <button type="button" id="labels_preview">
                    @lang( 'barcode.preview' )</button>
                    
                </div>
            
        </div>
        
    </div>

</div>




<!-- Preview section-->
<div id="preview_box">
</div>

@stop
@section('javascript')
	<script src="{{ asset('js/labels.js?v=' . $asset_v) }}"></script>
@endsection
