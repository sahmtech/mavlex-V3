@extends('layouts.app')
@section('title', __('crm::lang.proposal_template'))
@section('content')
<div class="main-container">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
       @include('crm::layouts.nav')
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('crm::lang.proposal_template')</h1>
                <p>{{__('crm::lang.crm')}}</p>
            </div>

            <div class="filter">
            <div class="new-user">
                	@if(empty($proposal_template) && auth()->user()->can('crm.add_proposal_template'))
			 			<a class="add-user-modal-btn" href="{{action('\Modules\Crm\Http\Controllers\ProposalTemplateController@create')}}">
			                	<i class="fa fa-plus"></i> @lang('messages.add')
			            </a>
		       		@endif
                </div> 
            </div>

        </div>
        <!-- End of Filter through table -->

      
                @if(!empty($proposal_template))
		        <div class="row">
		        	<div class="col-md-4 col-md-offset-4">
		        		<div class="box box-info box-solid">
		        			<div class="box-body">
		        				<strong>
		        					{{$proposal_template->subject}}
		        				</strong>
		        			</div>
		        			<div class="box-footer clearfix">
		        				<div class="row">
		        					@if(auth()->user()->can('crm.add_proposal_template'))
			        					<div class="col-md-4">
			        						<a href="{{action('\Modules\Crm\Http\Controllers\ProposalTemplateController@getEdit')}}" title="@lang('messages.edit')" class=" pull-left" data-toggle="tooltip" data-placement="bottom">
			        							<img src="{{ asset('img/icons/edit.svg') }}" alt="">
			        						</a>
			        					</div>
			        				@endif
			        				@can('crm.access_proposal')
			        					<div class="col-md-4">
			        						<a href="{{action('\Modules\Crm\Http\Controllers\ProposalTemplateController@getView')}}" title="@lang('messages.view')" data-toggle="tooltip" data-placement="bottom">
			        							<img src="{{ asset('img/icons/eye.svg') }}" alt="">
			        						</a>
			        					</div>
			        					<div class="col-md-4">
			        						<a href="{{action('\Modules\Crm\Http\Controllers\ProposalTemplateController@send')}}" class="pull-right" title="@lang('crm::lang.send')" data-toggle="tooltip" data-placement="bottom">
			        							<img src="{{ asset('img/icons/send-wishes.svg') }}" alt="">
			        						</a>
			        					</div>
			        				@endcan
		        				</div>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		    @else
		    	<div class="callout callout-info">
		            <h4>
		            	{{__('crm::lang.no_template_found')}}
		            </h4>
		        </div>
		    @endif

		    <div class="footer">
                <div class="pagination">
                    
                </div>

               
            </div>

		    
    </div>
</div>
@endsection