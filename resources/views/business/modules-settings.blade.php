@extends('layouts.app')
@section('title', __('business.business_settings'))

@section('content')

<div class="main-container no-print">
<div class="horizontal-scroll">
    <div class="storys-container">
    @include('layouts.partials.sub_menu.misc', ['link_class' => 'sub-menu-item'])
</div>
    </div>
    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('lang_v1.modules')</h1>
                <p>@lang('business.settings')</p>
            </div>

            <div class="filter">
                
            </div>
        </div>

        <div class="content">
            {!! Form::open(['url' => action('BusinessController@postBusinessSettings'), 'method' => 'post', 'id' => 'bussiness_edit_form',
           'files' => true ]) !!}
            {!! Form::hidden('is_modules_setting', 1) !!}
            <div class="row">
                <div class="col-sm-12">
                    @if(!empty($modules))
                        <h4>@lang('lang_v1.enable_disable_modules')</h4>
                        @foreach($modules as $k => $v)
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                                        <label class="switch" for="{{ $v['name'] }}">
                                            {!! Form::checkbox('enabled_modules[]', $k,  in_array($k, $enabled_modules) , 
                                        ['id' => $v['name']]); !!}
                                            <div class="sliderCheckbox round"></div>
                                        </label>
                                        <p>{{$v['name']}}</p>@if(!empty($v['tooltip'])) @show_tooltip($v['tooltip']) @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-danger pull-right" type="submit">@lang('business.update_settings')</button>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
        
    </div>
</div>

@stop
@section('javascript')
<script type="text/javascript">
    __page_leave_confirmation('#bussiness_edit_form');
</script>
@endsection