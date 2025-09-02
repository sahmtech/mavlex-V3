@extends('layouts.blank')
@section('title', __( 'lang_v1.price_checker'))
@section('content')

<div class="main-container no-print">
    <div class="card-wrapper">
            @component('components.widget', ['class' => 'box-warning'])
            @slot('header')
            <div class="overview-filter">
            <div class="title">
           
                <h1>@lang('lang_v1.price_checker')</h1>
                <p>@lang('lang_v1.scan_to_check_price')</p>
            </div>
            <div class="filter ">
            <div class="form-group location-group">
                <label class="location-label">@lang('sale.location'):</label>
                <div class="location-select">
                    @if(empty($transaction->location_id))
                    @if(count($business_locations) > 1)
                    {!! Form::select('select_location_id', $business_locations, $default_location->id ?? null , [
                    'class' => 'form-control input-sm',
                    'id' => 'select_location_id',
                    'required',
                    'autofocus'
                    ], $bl_attributes) !!}
                    @else
                    {{$default_location->name}}
                    @endif
                    @else
                    {{$transaction->location->name}}
                    @endif
                </div>
            </div>
            </div>
            </div>
            @endslot
            {!! Form::open(['url' => action('SellPosController@store'), 'method' => 'post', 'id' => 'add_pos_sell_form']) !!}
            {!! Form::hidden('location_id', $default_location->id ?? null, [
            'id' => 'location_id',
            'data-receipt_printer_type' => !empty($default_location->receipt_printer_type)
            ? $default_location->receipt_printer_type
            : 'browser',
            'data-default_payment_accounts' => $default_location->default_payment_accounts ?? '',
            ]) !!}
        <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat" data-toggle="modal" data-target="#configure_search_modal" title="{{__('lang_v1.configure_product_search')}}"><i class="fa fa-barcode"></i></button>
                            </div>
                            {!! Form::text('search_product', null, ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'), 'disabled' => is_null($default_location)? true : false, 'autofocus' => is_null($default_location)? false : true, ]); !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div id="product-details" class="col-sm-12">
                        <!-- Product details will be inserted here by JavaScript -->
                    </div>
                </div>
                {!! Form::close() !!}
                @endcomponent
            </div>
        </div>
    </div>
</div>
    </div>

@stop

@section('javascript')
<script src="{{ asset('js/price_check.js?v=' . $asset_v) }}"></script>

@endsection

<style>
    .card-wrapper {
       
        height: calc(100vh - 40px);
        width: auto !important;
        margin: 20px !important;
    }

    .product-card {
        display: flex;
        align-items: center;
        margin: 20px 0;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background: #fff;
    }

    .product-image {
        width: 100px;
        height: 100px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        margin-right: 20px;
    }

    .product-info {
        flex: 1;
    }

    .product-info h1 {
        margin: 0;
        font-size: 24px;
    }

    .product-info h3 {
        margin: 5px 0;
        font-size: 18px;
    }

    .product-info p {
        margin: 5px 0;
        font-size: 16px;
    }

    .heading {
        font-size: 24px;
        margin: 5px;
    }

    .price {
        font-size: 24px;
        margin: 5px;
    }

    .price-bottom {
        font-size: 36px;
        font-weight: bold;
        color: darkolivegreen;
        text-align: left;
    }

    .location-group {
        display: flex;
        align-items: center;
    }

    .location-label {
        margin-right: 10px;
        font-weight: bold;
    }

    .location-select .form-control {
        display: inline-block;
        width: auto;
        vertical-align: middle;
    }


    @media (max-width: 768px) {
        .card-wrapper {
            padding: 50px;
            height: calc(100vh - 40px);
            width: 90% !important;
            margin: 20px;
        }

        .product-card {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .product-image {
            margin-bottom: 15px;
            width: 80px;
            height: 80px;
        }

        .price-bottom {
            text-align: center;
            font-size: 24px;
            margin-top: 10px;
        }

        .heading,
        .price {
            font-size: 18px;
        }

        .location-group {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .location-label {
            margin: 5px 0;
        }

        .location-select {
            width: 100%;
            text-align: center;
        }

        .location-select .form-control {
            width: 100%;
        }
    }
</style>