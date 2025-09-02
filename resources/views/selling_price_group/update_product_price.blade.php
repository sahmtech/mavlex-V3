@extends('layouts.app')
@section('title', __('lang_v1.update_product_price'))

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
                <h1>@lang( 'lang_v1.update_product_price' )</h1>
                <p>@lang( 'sale.products' )</p>
            </div>

            <div class="filter">
                <div class="new-user">
                    <a href="{{action('SellingPriceGroupController@export')}}" class="btn btn-primary" style="width: 100%;">@lang('lang_v1.export_product_prices')</a>
                    </div>
                   
            </div>
                
        </div>
        <!-- End of Filter through table -->

        <div class="content">

    @if (session('notification') || !empty($notification))
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @if(!empty($notification['msg']))
                        {{$notification['msg']}}
                    @elseif(session('notification.msg'))
                        {{ session('notification.msg') }}
                    @endif
                </div>
            </div>  
        </div>     
    @endif
    @component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.import_export_product_price')])
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::open(['url' => action('SellingPriceGroupController@import'), 'method' => 'post', 'enctype' => 'multipart/form-data' ]) !!}
                    <div class="form-group">
                        {!! Form::label('name', __( 'product.file_to_import' ) . ':') !!}
                        {!! Form::file('product_group_prices', ['required' => 'required']); !!}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">@lang('messages.submit')</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-sm-12">
                    <h4>@lang('lang_v1.instructions'):</h4>
                    <ol>
                        <li>@lang('lang_v1.price_import_instruction_1')</li>
                        <li>@lang('lang_v1.price_import_instruction_2')</li>
                        <li>@lang('lang_v1.price_import_instruction_3')</li>
                        <li>@lang('lang_v1.price_import_instruction_4')</li>
                    </ol>
                    
                </div>
            </div>
    @endcomponent
    

        </div>
    </div>
</div>

<!-- /.content -->
@stop
