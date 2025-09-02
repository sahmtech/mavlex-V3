@extends('layouts.app')

@section('title', __('essentials::lang.messages'))

@section('content')
<div class="main-container">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        @include('essentials::layouts.nav_essentials')
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('essentials::lang.messages')</h1>
                <p>{{__('essentials::lang.essentials')}}</p>
            </div>

            <div class="filter">
                 
            </div>
        </div>

        <div class="content">
        	<div class="box box-solid">	<div class="box-body" id="chat-box" style="height: 70vh; overflow-y: scroll;">
		@can('essentials.view_message')
		  @foreach($messages as $message)
		  	@include('essentials::messages.message_div')
		  @endforeach
	  	@endcan
	</div>
	<!-- /.chat -->
	@can('essentials.create_message')
	<div class="box-footer">
		{!! Form::open(['url' => action([\Modules\Essentials\Http\Controllers\EssentialsMessageController::class, 'store']), 'method' => 'post', 'id' => 'add_essentials_msg_form']) !!}
			<div class="input-group">
		  		{!! Form::textarea('message', null, ['class' => 'form-control', 'required', 'id' => 'chat-msg', 'placeholder' => __('essentials::lang.type_message'), 'rows' => 1]); !!}
		  		<div class="input-group-addon" 
		  		style="width: 137px;padding: 0;border: none;">
		  			{!! Form::select('location_id',$business_locations,  null, ['class' => 'form-control', 'placeholder' => __('lang_v1.select_location'), 'style' => 'width: 100%;' ]); !!}
		  		</div>
		  		<div class="input-group-btn">
		  			<button type="submit" class="btn btn-success pull-right ladda-button" data-style="expand-right">
		  				<span class="ladda-label"><i class="fa fa-plus"></i></span>
		  			</button>
		  		</div>
			</div>
		  {!! Form::close() !!}
	</div>
	@endcan
	</div>
	<!-- /.box (chat box) -->
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){
		scroll_down_chat_div();
		$('#chat-msg').focus();
		$('form#add_essentials_msg_form').submit(function(e) {
			e.preventDefault();
			var msg = $('#chat-msg').val().trim();
			if(msg) {
				var data = $(this).serialize();
				var ladda = Ladda.create(document.querySelector('.ladda-button'));
				ladda.start();
				$.ajax({
					url: "{{action([\Modules\Essentials\Http\Controllers\EssentialsMessageController::class, 'store'])}}",
					data: data,
					method: 'post',
					dataType: "json",
					success: function(result){
						ladda.stop();
						if(result.html) {
							$('div#chat-box').append(result.html);
							scroll_down_chat_div();
							$('#chat-msg').val('').focus();
						}
					}
				});
			}
		});

		$(document).on('click', 'a.chat-delete', function(e) {
			e.preventDefault();
			swal({
	          title: LANG.sure,
	          icon: "warning",
	          buttons: true,
	          dangerMode: true,
	        }).then((willDelete) => {
	            if (willDelete) {
	            	var chat_item = $(this).closest('.post');
					$.ajax({
						url: $(this).attr('href'),
						method: 'DELETE',
						dataType: "json",
						success: function(result){
							if(result.success == true){
								toastr.success(result.msg);
								chat_item.remove();
							} else {
								toastr.error(result.msg);
							}
						}
					});
	            }
	        });
		});
		var chat_refresh_interval = "{{config('essentials::config.chat_refresh_interval', 20)}}";
		chat_refresh_interval = parseInt(chat_refresh_interval) * 1000;
		setInterval(function(){ getNewMessages() }, chat_refresh_interval);
	});

	function scroll_down_chat_div() {
		var chat_box    = $('#chat-box');
		var height = chat_box[0].scrollHeight;
		chat_box.scrollTop(height);
	}

	function getNewMessages() {
		var last_chat_time =  $('div.msg-box').length ? $('div.msg-box:last').data('delivered-at') : '';
		$.ajax({
            url: "{{action([\Modules\Essentials\Http\Controllers\EssentialsMessageController::class, 'getNewMessages'])}}?last_chat_time=" + last_chat_time,
            dataType: 'html',
            global: false,
            success: function(result) {
            	if(result.trim() != ''){
            		$('div#chat-box').append(result);
					scroll_down_chat_div();
            	}
            },
        });
	}
</script>
@endsection