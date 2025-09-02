@extends('crm::layouts.app')

@section('title', __('home.home'))

@section('content')
<div class="main-container">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
       @include('crm::layouts.partials.submenu.customer_nav')
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>{{ __('home.welcome_message', ['name' => Session::get('user.first_name')]) }}</h1>
                <p>{{__('crm::lang.crm')}}</p>
            </div>

        </div>
        <!-- End of Filter through table -->

            <div class="content">
            	<section class="content content-custom no-print">
					<div class="row row-custom">
						@if( $contact->type == 'supplier' || $contact->type == 'both')
					    	<div class="col-md-3 col-sm-6 col-xs-12 col-custom">
						      <div class="info-box info-box-new-style">
						        <span class="info-box-icon bg-aqua"><i class="ion ion-cash"></i></span>
						        <div class="info-box-content">
						          <span class="info-box-text fs-10">@lang('report.total_purchase')</span>
						          <span class="info-box-number display_currency" data-currency_symbol="true">
						          	{{ $contact->total_purchase }}
						          </span>
						        </div>
						      </div>
						    </div>

						    <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
						      <div class="info-box info-box-new-style">
						        <span class="info-box-icon bg-green">
						        	<i class="fas fa-money-check-alt"></i>
						        </span>
						        <div class="info-box-content">
						          <span class="info-box-text fs-10">@lang('contact.total_purchase_paid')</span>
						          <span class="info-box-number display_currency" data-currency_symbol="true">
						          	{{ $contact->purchase_paid }}
						          </span>
						        </div>
						      </div>
						    </div>

						    <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
						      <div class="info-box info-box-new-style">
						        <span class="info-box-icon bg-yellow">
						        	<i class="fas fa-money-check-alt"></i>
									<i class="fa fa-exclamation"></i>
						        </span>
						        <div class="info-box-content">
						          <span class="info-box-text fs-10">@lang('contact.total_purchase_due')</span>
						          <span class="info-box-number display_currency" data-currency_symbol="true">
						          	{{ $contact->total_purchase - $contact->purchase_paid }}
						          </span>
						        </div>
						      </div>
						    </div>
					    @endif

					    @if( $contact->type == 'customer' || $contact->type == 'both')
						    <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
						      <div class="info-box info-box-new-style">
						        <span class="info-box-icon bg-aqua">
						        	<i class="ion ion-ios-cart-outline"></i>
						        </span>
						        <div class="info-box-content">
						          <span class="info-box-text fs-10">@lang('report.total_sell')</span>
						          <span class="info-box-number display_currency" data-currency_symbol="true">
						          	{{ $contact->total_invoice }}
						          </span>
						        </div>
						      </div>
						    </div>

					        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
					          <div class="info-box info-box-new-style">
					            <span class="info-box-icon bg-green">
					              <i class="fas fa-money-check-alt"></i>
					            </span>
					            <div class="info-box-content">
					              <span class="info-box-text fs-10">
					                @lang('contact.total_sale_paid')
					              </span>
					              <span class="info-box-number display_currency" data-currency_symbol="true">
					              	{{ $contact->invoice_received }}
					              </span>
					            </div>
					          </div>
					        </div>

					        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
					          <div class="info-box info-box-new-style">
					            <span class="info-box-icon bg-yellow">
					              	<i class="fas fa-money-check-alt"></i>
									<i class="fa fa-exclamation"></i>
					            </span>
					            <div class="info-box-content">
					              <span class="info-box-text fs-10">
					                @lang('contact.total_sale_due')
					              </span>
					              <span class="info-box-number display_currency" data-currency_symbol="true">
					              	{{ $contact->total_invoice - $contact->invoice_received }}
					              </span>
					            </div>
					          </div>
					        </div>
							@if( in_array($contact->type, ['customer', 'both']) && session('business.enable_rp'))
							<div class="col-md-3 col-sm-6 col-xs-12 col-custom">
					          <div class="info-box info-box-new-style">
					            <span class="info-box-icon bg-green">
								<i class="fa fa-gift"></i>
					            </span>
					            <div class="info-box-content">
					              <span class="info-box-text fs-10">
								  {{session('business.rp_name')}}
					              </span>
					              <span class="info-box-number display_currency" >
								  {{$contact->total_rp ?? 0}}
					              </span>
					            </div>
					          </div>
					        </div>
							@endif
              
				        @endif

				        @if(!empty($contact->opening_balance) && $contact->opening_balance != '0.00')
					        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
					          <div class="info-box info-box-new-style">
					            <span class="info-box-icon bg-aqua">
					              <i class="fas fa-donate"></i>
					            </span>
					            <div class="info-box-content">
					              <span class="info-box-text fs-10">
					                @lang('lang_v1.opening_balance')
					              </span>
					              <span class="info-box-number display_currency" data-currency_symbol="true">
						            {{ $contact->opening_balance }}
						           </span>
					            </div>
					          </div>
					        </div>

					        <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
					          <div class="info-box info-box-new-style">
					            <span class="info-box-icon bg-yellow">
					              <i class="fas fa-donate"></i>
					              <i class="fa fa-exclamation"></i>
					            </span>
					            <div class="info-box-content">
					              <span class="info-box-text fs-10">
					                @lang('lang_v1.opening_balance_due')
					              </span>
					              <span class="info-box-number display_currency" data-currency_symbol="true">
						            {{ $contact->opening_balance - $contact->opening_balance_paid }}
						           </span>
					            </div>
					          </div>
					        </div>
					    @endif
				    </div>
				</section>
            </div>
    </div>
</div>


@endsection