@extends('layouts.app')
@section('title', __('lang_v1.'.$type.'s'))
@php
    $api_key = env('GOOGLE_MAP_API_KEY');
@endphp
@if(!empty($api_key))
    @section('css')
        <!-- @include('contact.partials.google_map_styles') -->
    @endsection
@endif
@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.contact', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('contact.contacts')</h1>
                <p>@lang( 'contact.manage_your_contact', ['contacts' =>  __('lang_v1.'.$type.'s') ])</p>
            </div>

            <div class="filter">
                <div class="new-user">
                    @if(auth()->user()->can('supplier.create') || auth()->user()->can('customer.create') || auth()->user()->can('supplier.view_own') || auth()->user()->can('customer.view_own'))
                            <button type="button" class="add-user-modal-btn btn-modal " 
                        data-href="{{action('ContactController@create', ['type' => $type])}}" 
                        data-container=".contact_modal">
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
                    @endif
                    
                </div>
            
                <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                        <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                       
                    </a>
            </div>
        </div>
        <!-- End of Filter through table -->
        @component('components.filters', ['title' => __('report.filters')])
        @if($type == 'customer')
        <div class="col-sm-3">
            <div class="form-group">
                <p><strong>@lang('lang_v1.sell_due')</strong></p>
                <div class="toggle-wrapper d-flex gap-2 mt-4">
                    <label class="switch" for="has_sell_due">
                        {!! Form::checkbox('has_sell_due', 1, false, ['id'=>'has_sell_due']) !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <p><strong>@lang('lang_v1.sell_return')</strong></p>
                <div class="toggle-wrapper d-flex gap-2 mt-4">
                    <label class="switch" for="has_sell_return">
                        {!! Form::checkbox('has_sell_return', 1, false, ['id'=>'has_sell_return']) !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                </div>
            </div>
        </div>
    @elseif($type == 'supplier')
        <div class="col-sm-3">
            <div class="form-group">
                <p><strong>@lang('report.purchase_due')</strong></p>
                <div class="toggle-wrapper d-flex gap-2 mt-4">
                    <label class="switch" for="has_purchase_due">
                        {!! Form::checkbox('has_purchase_due', 1, false, ['id'=>'has_purchase_due']) !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <p><strong>@lang('lang_v1.purchase_return')</strong></p>
                <div class="toggle-wrapper d-flex gap-2 mt-4">
                    <label class="switch" for="has_purchase_return">
                        {!! Form::checkbox('has_purchase_return', 1, false, ['id'=>'has_purchase_return']) !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                </div>
            </div>
        </div>
    @endif
    
    <div class="col-sm-3">
        <div class="form-group">
            <p><strong>@lang('lang_v1.advance_balance')</strong></p>
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <label class="switch" for="has_advance_balance">
                    {!! Form::checkbox('has_advance_balance', 1, false, ['id'=>'has_advance_balance']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
            </div>
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="form-group">
            <p><strong>@lang('lang_v1.opening_balance')</strong></p>
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <label class="switch" for="has_opening_balance">
                    {!! Form::checkbox('has_opening_balance', 1, false, ['id'=>'has_opening_balance']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
            </div>
        </div>
    </div>
    
    @if($type == 'customer')
        <div class="col-md-3">
            <div class="form-group">
                <label for="has_no_sell_from">@lang('lang_v1.has_no_sell_from'):</label>
                {!! Form::select('has_no_sell_from', ['one_month' => __('lang_v1.one_month'), 'three_months' => __('lang_v1.three_months'), 'six_months' => __('lang_v1.six_months'), 'one_year' => __('lang_v1.one_year')], null, ['class' => 'form-control', 'id' => 'has_no_sell_from', 'placeholder' => __('messages.please_select')]); !!}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="cg_filter">@lang('lang_v1.customer_group'):</label>
                {!! Form::select('cg_filter', $customer_groups, null, ['class' => 'form-control', 'id' => 'cg_filter']); !!}
            </div>
        </div>
    @endif

    <div class="col-md-3">
        <div class="form-group">
            <label for="status_filter">@lang('sale.status'):</label>
            {!! Form::select('status_filter', ['active' => __('business.is_active'), 'inactive' => __('lang_v1.inactive')], null, ['class' => 'form-control', 'id' => 'status_filter', 'placeholder' => __('lang_v1.none')]); !!}
        </div>
    </div>
    @endcomponent

            <div class="content">

                <input type="hidden" value="{{$type}}" id="contact_type">
                @if(auth()->user()->can('supplier.view') || auth()->user()->can('customer.view') || auth()->user()->can('supplier.view_own') || auth()->user()->can('customer.view_own'))
                    <div class="table-responsive">
                        <table class="table  max-table" id="contact_table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>@lang('messages.action')</th>
                                    <th>@lang('lang_v1.contact_id')</th>
                                    @if($type == 'supplier')
                                        <th>@lang('business.business_name')</th>
                                        <th>@lang('contact.name')</th>
                                        <th>@lang('business.email')</th>
                                        <th>@lang('contact.mobile')</th>
                                        <th>@lang('contact.total_purchase_due')</th>
                                        <th>@lang('lang_v1.total_purchase_return_due')</th>
                                    @elseif( $type == 'customer')
                                    <th>@lang('business.business_name')</th>
                                        <th>@lang('user.name')</th>
                                        <th>@lang('business.email')</th>
                                        <th>@lang('lang_v1.credit_limit')</th>
                                        @if($reward_enabled)
                                            <th id="rp_col">{{session('business.rp_name')}}</th>
                                        @endif
                                       <th>@lang('lang_v1.customer_group')</th>
                                        <th>@lang('contact.mobile')</th>
                                        <th>@lang('contact.total_sale_due')</th>
                                        <th>@lang('lang_v1.total_sell_return_due')</th>
                                    @endif
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="bg-gray font-17 text-center footer-total">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td
                                        @if($type == 'supplier')
                                            colspan="2"
                                        @elseif( $type == 'customer')
                                            @if($reward_enabled)
                                                colspan="3"
                                            @else
                                                colspan="4"
                                            @endif
                                        @endif>
                                            <strong>
                                                @lang('sale.total'):
                                            </strong>
                                    </td>
                                    <td class="footer_contact_due"></td>
                                    <td class="footer_contact_return_due"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @endif
            </div>
        <div class="modal fade contact_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
        </div>
        <div class="modal fade pay_contact_due_modal" tabindex="-1" role="dialog" 
            aria-labelledby="gridSystemModalLabel">
        </div>
        </div>

</div>

@stop
@section('javascript')

@if(!empty($api_key))
<script>
  // This example adds a search box to a map, using the Google Place Autocomplete
  // feature. People can enter geographical searches. The search box will return a
  // pick list containing a mix of places and predicted search terms.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  function initAutocomplete() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 10,
      mapTypeId: 'roadmap'
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            map.setCenter(initialLocation);
        });
    }


    // Create the search box and link it to the UI element.
    var input = document.getElementById('shipping_address');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
      searchBox.setBounds(map.getBounds());
    });

    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {
      var places = searchBox.getPlaces();

      if (places.length == 0) {
        return;
      }

      // Clear out the old markers.
      markers.forEach(function(marker) {
        marker.setMap(null);
      });
      markers = [];

      // For each place, get the icon, name and location.
      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }
        var icon = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25)
        };

        // Create a marker for each place.
        markers.push(new google.maps.Marker({
          map: map,
          icon: icon,
          title: place.name,
          position: place.geometry.location
        }));

        //set position field value
        var lat_long = [place.geometry.location.lat(), place.geometry.location.lng()]
        $('#position').val(lat_long);

        if (place.geometry.viewport) {
          // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
    });
  }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{$api_key}}&libraries=places"
     async defer></script>
<script type="text/javascript">
    $(document).on('shown.bs.modal', '.contact_modal', function(e) {
        initAutocomplete();
    });
</script>

  
@endif
@endsection
