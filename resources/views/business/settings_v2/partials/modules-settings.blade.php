<div class="pos-tab-content">
    
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
</div>