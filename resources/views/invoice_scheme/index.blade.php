@extends('layouts.app')
@section('title', __('invoice.invoice_settings'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.setting', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('invoice.invoice_design')</h1>
                <p>@lang('invoice.all_your_invoice_layouts')</p>
            </div>

            <div class="filter">
               
            </div>
        </div>

        <div class="content">
            <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">@lang('invoice.invoice_schemes')</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">@lang('invoice.invoice_layouts')</a></li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>@lang( 'invoice.all_your_invoice_schemes' )
                                     <button type="button" class="btn btn-primary btn-modal pull-right" data-href="{{action([\App\Http\Controllers\InvoiceSchemeController::class, 'create'])}}" data-container=".invoice_modal">
                                        <i class="fa fa-plus"></i> @lang( 'messages.add' )</button></h4>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="invoice_table">
                                        <thead>
                                            <tr>
                                                <th>@lang( 'invoice.name' ) @show_tooltip(__('tooltip.invoice_scheme_name'))</th>
                                                <th>@lang( 'invoice.prefix' ) @show_tooltip(__('tooltip.invoice_scheme_prefix'))</th>
                                                <th>@lang( 'invoice.number_type' ) @show_tooltip(__('invoice.number_type_tooltip'))</th>
                                                <th>@lang( 'invoice.start_number' ) @show_tooltip(__('tooltip.invoice_scheme_start_number'))</th>
                                                <th>@lang( 'invoice.invoice_count' ) @show_tooltip(__('tooltip.invoice_scheme_count'))</th>
                                                <th>@lang( 'invoice.total_digits' ) @show_tooltip(__('tooltip.invoice_scheme_total_digits'))</th>
                                                <th>@lang( 'messages.action' )</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                      <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                
                <div class="row">
                            <div class="col-md-12">
                            <a class="btn btn-primary pull-right" href="{{action([\App\Http\Controllers\InvoiceLayoutController::class, 'create'])}}">
                                        <i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
                            
                            </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <br>
                                <div class="row">
                    <div class="col-md-12">
                        @foreach( $invoice_layouts as $layout)
                        <div class="col-md-3">
                            <div class="icon-link">
                                <a href="{{action('InvoiceLayoutController@edit', [$layout->id])}}">
                                    <i class="fa fa-file-alt fa-4x"></i> 
                                    {{ $layout->name }}
                                </a>
                                @if( $layout->is_default )
                                    <span class="badge bg-green">@lang("barcode.default")</span>
                                @endif
                                @if($layout->locations->count())
                                    <span class="link-des">
                                    <b>@lang('invoice.used_in_locations'): </b><br>
                                    @foreach($layout->locations as $location)
                                        {{ $location->name }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                        &nbsp;
                                    @endforeach
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if( $loop->iteration % 4 == 0 )
                                    <div class="clearfix"></div>
                                @endif
                        @endforeach
                    </div>
                </div>
                <br>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
    </div>
    
    <div class="modal fade invoice_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal fade invoice_edit_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
        </div>
        
    </div>
</div>

@endsection
