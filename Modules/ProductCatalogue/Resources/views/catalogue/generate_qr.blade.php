@extends('layouts.app')
@section('title', __( 'productcatalogue::lang.catalogue_qr' ))

@section('content')
@php
$lightLogo = $business->light_logo;
$darkLogo = $business->dark_logo;
@endphp
<!-- Content Header (Page header) -->
 <!-- Main content -->
 <div class="main-container">
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        @include('productcatalogue::layouts.nav')
    </div>
    <div class="setting-card-wrapper">
<section class="content-header">
    <h1>@lang( 'productcatalogue::lang.catalogue_qr' )</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-7">
    	@component('components.widget', ['class' => 'box-solid'])
            <div class="form-group">
                {!! Form::label('location_id', __('purchase.business_location').':') !!}
                {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); !!}
            </div>
            <div class="form-group">
                {!! Form::label('color', __('productcatalogue::lang.qr_code_color').':') !!}
                {!! Form::text('color', '#000000', ['class' => 'form-control']); !!}
            </div>
            <div class="form-group">
                {!! Form::label('title', __('productcatalogue::lang.title').':') !!}
                {!! Form::text('title', $business->name, ['class' => 'form-control']); !!}
            </div>
            <div class="form-group">
                {!! Form::label('subtitle', __('productcatalogue::lang.subtitle').':') !!}
                {!! Form::text('subtitle', __('productcatalogue::lang.product_catalogue'), ['class' => 'form-control']); !!}
            </div>
            <div class="form-group">
                <p>@lang('productcatalogue::lang.show_business_logo_on_qrcode')</p>
                <div class="toggle-wrapper d-flex gap-2 mt-4">
                    <label class="switch" for="show_logo">
                        {!! Form::checkbox('add_logo', 1, true, ['id' => 'show_logo']) !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <p>@lang('productcatalogue::lang.hide_out_of_stock_products')</p>
                <div class="toggle-wrapper d-flex gap-2 mt-4">
                    <label class="switch" for="hide_out_of_stock">
                        {!! Form::checkbox('hide_out_of_stock', 1, false, ['id' => 'hide_out_of_stock']) !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                </div>
            </div>
            
            <button type="button" class="btn btn-primary" id="generate_qr">@lang( 'productcatalogue::lang.generate_qr' )</button>
        @endcomponent
        @component('components.widget', ['class' => 'box-solid'])
            <div class="row">
                <div class="col-md-12">
                    <strong>@lang('lang_v1.instruction'):</strong>
                    <table class="table table-striped">
                        <tr>
                            <td>1</td>
                            <td>@lang( 'productcatalogue::lang.catalogue_instruction_1' )</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>@lang( 'productcatalogue::lang.catalogue_instruction_2' )</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>@lang( 'productcatalogue::lang.catalogue_instruction_3' )</td>
                        </tr>
                    </table>
                </div>
            </div>
        @endcomponent
        </div>
        <div class="col-md-5">
            @component('components.widget', ['class' => 'box-solid'])

                <div class="text-center">
                    <div id="qrcode"></div>
                    <span id="catalogue_link"></span>
                    <br>
                    <a href="#" class="btn btn-success hide" id="download_image">@lang( 'productcatalogue::lang.download_image' )</a>
                </div>
            @endcomponent
        </div>
    </div>
</section>
    </div>
 </div>
@stop
@section('javascript')
<script src="{{ asset('modules/productcatalogue/plugins/easy.qrcode.min.js') }}"></script>
<script type="text/javascript">
    (function($) {
        "use strict";

    $(document).ready( function(){
        $('#color').colorpicker();
        
        // Load hide out of stock setting when location is selected
        $('#location_id').change(function() {
            if ($(this).val()) {
                loadHideOutOfStockSetting($(this).val());
            }
        });
        
        // Save setting to database when checkbox changes
        $(document).on('change', '#hide_out_of_stock', function() {
            if ($('#location_id').val()) {
              saveHideOutOfStockSetting($('#location_id').val(), $(this).is(':checked'));
            } else {
                alert('Please select a business location first');
                $(this).prop('checked', false); // Turn off the slider
            }
        });
    });
    
    $(document).on('click', '#generate_qr', function(e){
        $('#qrcode').html('');
        if ($('#location_id').val()) {
            var link = "{{url('catalogue/' . session('business.id'))}}/" + $('#location_id').val();
            var color = '#000000';
            if ($('#color').val().trim() != '') {
                color = $('#color').val();
            }
            var opts = {
                text: link,
                margin: 4,
                width: 256,
                height: 256,
                quietZone: 20,
                colorDark: color,
                colorLight: "#ffffffff", 
            }

            if ($('#title').val().trim() !== '') {
                opts.title = $('#title').val();
                opts.titleFont = "bold 18px Arial";
                opts.titleColor = "#004284";
                opts.titleBackgroundColor = "#ffffff";
                opts.titleHeight = 60;
                opts.titleTop = 20;
            }

            if ($('#subtitle').val().trim() !== '') {
                opts.subTitle = $('#title').val();
                opts.subTitleFont = "14px Arial";
                opts.subTitleColor = "#4F4F4F";
                opts.subTitleTop = 40;
            }

            if ($('#show_logo').is(':checked')) {
                opts.logo = "{{asset( 'uploads/business_logos/' . $darkLogo)}}";
            }

            new QRCode(document.getElementById("qrcode"), opts);
            $('#catalogue_link').html('<a target="_blank" href="'+ link +'">Link</a>');
            $('#download_image').removeClass('hide');
            $('#qrcode').find('canvas').attr('id', 'qr_canvas')

            
        } else {
            alert("{{__('productcatalogue::lang.select_business_location')}}")
        }
    });
    // Function to load hide out of stock setting from database
    function loadHideOutOfStockSetting(locationId) {
        $.get('{{ url("product-catalogue/get-location-setting") }}/' + locationId)
            .done(function(response) {
                if (response.hide_out_of_stock_products !== undefined) {
                    $('#hide_out_of_stock').prop('checked', response.hide_out_of_stock_products);
                  }
            })
            .fail(function(xhr, status, error) {
                 });
    }
    
    // Function to save hide out of stock setting to database
    function saveHideOutOfStockSetting(locationId, hideOutOfStock) {
        $.post('{{ url("product-catalogue/update-hide-out-of-stock") }}', {
            _token: '{{ csrf_token() }}',
            location_id: locationId,
            hide_out_of_stock: hideOutOfStock ? 1 : 0
        })
        .done(function(response) {
            if (response.success) {
                toastr.success('Setting saved successfully');
            }
        })
        .fail(function(xhr, status, error) {
            toastr.error('Failed to save setting');
        });
    }
    
    })(jQuery);

    $('#download_image').click(function(e) {
        e.preventDefault();
        var link = document.createElement('a');
        link.download = 'qrcode.png';
        link.href = document.getElementById('qr_canvas').toDataURL()
        link.click();
    });
</script>
@endsection