@extends('layouts.app')
@section('title', __('business.business_settings'))

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
                <h1>@lang('lang_v1.customer_display')</h1>
                <p>@lang('business.settings')</p>
            </div>

            <div class="filter">

            </div>
        </div>

        <div class="content">
            {!! Form::open(['url' => action('BusinessController@postBusinessSettings'), 'method' => 'post', 'id' =>
            'bussiness_edit_form',
            'files' => true ]) !!}
            <div class="col-sm-12" data-toggle="tooltip" data-placement="bottom"
                title="@lang('lang_v1.show_customer_display_tooltip')" data-html="true">
                <div class="form-group">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('pos_settings[show_customer_display]', 0) !!}
                        <label class="switch" for="show_customer_display">
                            {!! Form::checkbox('pos_settings[show_customer_display]', 1,
                            !empty($pos_settings['show_customer_display']) ,
                            [ 'id' => 'show_customer_display']); !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __( 'lang_v1.enable_customer_display_screen' ) }}</p>
                    </div>
                    <p class="help-block"><i> @lang('lang_v1.customer_display_instruction')</i></p>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    {!! Form::label('display_screen_heading', __('lang_v1.display_screen_heading') . ':') !!}
                    <p class="help-block"><i> @lang('lang_v1.display_screen_heading_instruction')</i></p>
                    {!! Form::textarea('pos_settings[display_screen_heading]',
                    isset($pos_settings['display_screen_heading']) ? $pos_settings['display_screen_heading'] : null,
                    ['class' => 'form-control', 'id' => 'display_screen_heading']); !!}

                </div>
            </div>
            @for ($i = 1; $i <= 10; $i++) @php $key="carousel_image_$i" ; $file=$pos_settings[$key] ?? null; $src=$file
                ? upload_asset("uploads/carousel_images/$file") : null; @endphp <div class="row align-items-center mb-3">

                <div class="col-sm-6">
                    {!! Form::label($key, __('lang_v1.carousel_image', ['number'=>$i])) !!}
                    {!! Form::file(
                    $key,
                    ['accept'=>'image/*',
                    'class'=>'carousel_image form-control-file',
                    'id'=>"file_$key"]
                    ) !!}
                    <small class="form-text text-muted">@lang('lang_v1.image_help')</small>
                </div>

                <div class="col-sm-3">
                    @if ($src)
                    <img src="{{ $src }}" class="img-thumbnail" style="width:90px;height:90px;object-fit:cover">
                    @endif
                </div>

                @if ($src)
                <div class="col-sm-3">
                    <div class="form-group">
                        @php $chkId = "remove_toggle_$key"; @endphp
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            <label class="switch" for="{{ $chkId }}">
                                {!! Form::checkbox("remove_$key", 1, false, ['class' => 'remove-toggle ','id'=>$chkId,
                                'data-target'=>"file_$key"]) !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __('lang_v1.remove') }}</p>
                        </div>
                    </div>
                </div>
                @endif

        </div>
        @endfor
    </div>
    <div class="row">
        <div class="col-sm-12 mobile">
            <button class="btn btn-danger pull-right" type="submit">@lang('business.update_settings')</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>

</div>

@stop
@section('javascript')
<script type="text/javascript">
    __page_leave_confirmation('#bussiness_edit_form');

$(function(){
    $('.remove-toggle').each(function () {
        toggleInputState(this);
    });

    $(document).on('change', '.remove-toggle', function () {
        toggleInputState(this);
    });

    function toggleInputState(checkbox){
        const $cb   = $(checkbox);
        const $file = $('#' + $cb.data('target'));
        $file.prop('disabled', $cb.is(':checked'));
        const $thumb = $cb.closest('.row').find('img.img-thumbnail');
        $thumb.css('opacity', $cb.is(':checked') ? .35 : 1);
    }
});

</script>
@endsection