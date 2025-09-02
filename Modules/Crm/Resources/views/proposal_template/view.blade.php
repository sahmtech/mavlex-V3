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
                <h1>@lang('crm::lang.proposal_template')
	   	<small>@lang('messages.view')</small></h1>
                <p>{{__('crm::lang.crm')}}</p>
            </div>

        </div>
        <!-- End of Filter through table -->

	            <div class="content">
	            	<section class="content">
						<div class="box-header with-border">
							<div class="box-tools pull-right">
								@if(auth()->user()->can('crm.add_proposal_template'))
			    					<a href="{{action('\Modules\Crm\Http\Controllers\ProposalTemplateController@getEdit')}}" class="add-user-modal-btn" title="@lang('messages.edit')" data-toggle="tooltip" data-placement="bottom">
			    						<img src="{{ asset('img/icons/edit.svg') }}" alt="plus">
			    						
			    					</a>
			    				@endif
			    				@can('crm.access_proposal')
			    					<a href="{{action('\Modules\Crm\Http\Controllers\ProposalTemplateController@send')}}" class="add-user-modal-btn" title="@lang('crm::lang.send')" data-toggle="tooltip" data-placement="bottom">
			    						<img src="{{ asset('img/icons/send-wishes.svg') }}" alt="plus">
			    						
			    					</a>
			    				@endcan
							</div>
			            </div>
			            <div class="box-body">
			            	<div class="row">
			            		<div class="col-md-12">
									<p>
										<strong>{{__('crm::lang.subject')}}:</strong> {{$proposal_template->subject}}
									</p>
								</div>
							</div>
							<div class="row mt-10">
								<div class="col-md-12">
									<p>
										<strong>{{__('crm::lang.email_body')}}:</strong> {!!$proposal_template->body!!}
									</p>
								</div>
							</div>
							@if($proposal_template->media->count() > 0)
								<hr>
								<div class="row">
									<div class="col-md-6">
										<h4>
											{{__('crm::lang.attachments')}}
										</h4>
										@includeIf('crm::proposal_template.partials.attachment', ['medias' => $proposal_template->media])
									</div>
								</div>
							@endif
						</div>
					</section>
	            </div>
	       
    </div>
</div>

	
@endsection
@section('javascript')
<script type="text/javascript">
	$(function () {
	    $(document).on('click', 'a.delete_attachment', function (e) {
            e.preventDefault();
            var url = $(this).data('href');
            var this_btn = $(this);
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        dataType: 'json',
                        success: function(result) {
                            if(result.success == true){
			                    this_btn.closest('tr').remove();
			                    toastr.success(result.msg);
			                } else {
			                    toastr.error(result.msg);
			                }
                        }
                    });
                }
            });
        });
	});
</script>
@endsection