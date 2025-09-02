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
	   		<small>@lang('lang_v1.create')</small></h1>
                <p>{{__('crm::lang.crm')}}</p>
            </div>

        </div>
        <!-- End of Filter through table -->

            <div class="content">
            	<section class="content">
		
			{!! Form::open(['url' => action('\Modules\Crm\Http\Controllers\ProposalTemplateController@store'), 'method' => 'post', 'id' => 'proposal_template_form', 'files' => true]) !!}
				@includeIf('crm::proposal_template.partials.template_form', ['attachments' => true])
				<button type="submit" class="btn btn-primary ladda-button pull-right m-5" data-style="expand-right">
                    <span class="ladda-label">@lang('messages.save')</span>
                </button>
			{!! Form::close() !!}
	</section>
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
	});
</script>
@endsection