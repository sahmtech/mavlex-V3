
  @php
    $uid = (string) \Illuminate\Support\Str::uuid();

    $isNew = ! $menu->exists;
  @endphp
<div class="modal fade" tabindex="-1" role="dialog" id="createMenuModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
 {{ __('settings.add_menu') }}
				</h4>
			</div>
			<div class="modal-body">
				<div class="row ">
{!! \LaravelLux\Html\FormFacade::open(['url'    => route('menus.store'),'method' => 'POST','class'  => 'p-3 create-menu-form']) !!}

<div class="row g-3 un-row">

    {{-- ── Label ─────────────────────────────── --}}
    <div class="col-sm-6">
        <div class="form-group">
           {!! Form::label('label', __('settings.label')) !!}
            {!! Form::text('label', old('label', $menu->label), [
                    'class'    => 'form-control',
                    'required' => true
            ]) !!}
        </div>
    </div>


    {{-- ── Icon type ─────────────────────────── --}}
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('icon_type', __('settings.icon_type')) !!}<br>
            {!! Form::select(
                    'icon_type',
                    ['svg'=>'SVG','fa'=>'FontAwesome'],
                    old('icon_type', $menu->icon_type ?? 'fa'),
                    ['class'=>'form-select icon-type-select width-100', 'data-target'=>$uid]
            ) !!}
        </div>
    </div>

    {{-- ── SVG vs. FA inputs ─────────────────── --}}
    <div class="col-sm-6 icon-svg-group {{ old('icon_type',$menu->icon_type)=='svg'?'':'hide' }}"
         data-uid="{{ $uid }}">
        <div class="form-group">
           {!! Form::label('icon_svg', __('settings.svg_icon')) !!}
            {!! Form::textarea('icon_svg', old('icon_svg',$menu->icon_svg), [
                    'class'=>'form-control','rows'=>1
            ]) !!}
        </div>
    </div>

    <div class="col-sm-6 icon-fa-group {{ old('icon_type',$menu->icon_type??'fa')=='fa'?'':'hide' }}"
         data-uid="{{ $uid }}">
        <div class="form-group">
            {!! Form::label('icon_fa', __('settings.fa_class')) !!}
            {!! Form::text('icon_fa', old('icon_fa',$menu->icon_fa), [
                    'class'=>'form-control'
            ]) !!}
        </div>
    </div>

    {{-- ── Quick text inputs (route, url, …) ─── --}}
    @foreach ([
       'route'      => __('settings.named_route'),
    'url'        => __('settings.absolute_url'),
    'permission' => __('settings.permission'),
    'module'     => __('settings.module_flag'),
] as $field => $label)
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label($field, $label) !!}
                {!! Form::text($field, old($field, $menu->$field), ['class'=>'form-control']) !!}
            </div>
        </div>
    @endforeach

    {{-- ── Active? toggle ─────────────────────── --}}
    <div class="col-sm-6">
        <div class="form-group">
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <p>{{ __('settings.active') }}</p>
                <label class="switch">
                    {!! Form::checkbox('is_active', 1, old('is_active', $menu->is_active ?? 1)) !!}
                    <span class="sliderCheckbox round"></span>
                </label>
            </div>
        </div>
    </div>

</div>{{-- /.row --}}

<hr class="my-4">

				</div>

			</div>
			<button type="submit" class="btn btn-primary" id="createMenuModalUpdate">
    {{ __('messages.update') }}
</button>
<button type="button" class="btn btn-default" data-dismiss="modal">
    {{ __('messages.cancel') }}
</button>

            {!! Form::close() !!}
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->