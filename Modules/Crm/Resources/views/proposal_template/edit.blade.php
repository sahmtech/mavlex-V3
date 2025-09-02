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
	   		<small>@lang('messages.edit')</small></h1>
                <p>{{__('crm::lang.crm')}}</p>
            </div>

            <div class="filter">
                
            </div>

        </div>
        <!-- End of Filter through table -->

       
            <div class="content">
                {!! Form::open(['url' => action('\Modules\Crm\Http\Controllers\ProposalTemplateController@postEdit'), 'method' => 'post', 'id' => 'proposal_template_form', 'files' => true]) !!}
                @includeIf('crm::proposal_template.partials.template_form', ['proposal_template' => $proposal_template, 'attachments' => true])
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
                <button type="submit" class="btn btn-primary ladda-button pull-right m-5" data-style="expand-right">
                    <span class="ladda-label">@lang('messages.update')</span>
                </button>
            {!! Form::close() !!}
            </div>
    </div>
</div>
	
@endsection
@section('javascript')
<script type="text/javascript">
	$(function () {
		tinymce.init({
	        selector: 'textarea#proposal_email_body',
	        height: 350,
	    });

     	//initialize file input
        $('#attachments').fileinput({
            showUpload: false,
            showPreview: false,
            browseLabel: LANG.file_browse_label,
            removeLabel: LANG.remove
        });

        $('form#proposal_template_form').validate({
	        submitHandler: function(form) {
	            form.submit();
	            let ladda = Ladda.create(document.querySelector('.ladda-button'));
    			ladda.start();
	        }
	    });

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