@extends('layouts.app')
@section('title', __('zatca::lang.zatca'))

@section('content')
@php
    $business_id = session('user.business_id');
    $settings = json_decode($business->zatca_settings, true);
    $pos_settings = json_decode($business->pos_settings, true);
@endphp


<style>
  .text-green  { color: green; }
  .text-orange { color: orange; }
  .text-red    { color: red; }
  .text-gray   { color: gray; }
  .text-primary {color: #FFB600 !important; }
</style>

<div class="main-container no-print">
  <div class="horizontal-scroll">
      @include('zatca::layouts.nav')
  </div>

  <div class="card-wrapper">
    <div class="overview-filter">
      <div class="title">
        <h1>@lang('zatca::lang.zatca')</h1>
        <p>@lang('zatca::lang.compliance_settings')</p>
      </div>
      <p id="zatca_status" class="m-0"></p>
    </div>
    <form action="{{ action([\Modules\Zatca\Http\Controllers\ZatcaController::class, 'posBussinesUpdate']) }}" method="POST">
      @csrf
      <div class="overview-filter" style="margin-top: 10px;">
          <div class="col-sm-3">
              <div class="form-group d-flex align-items-center">
                  <span class="check-icon">
                      @if (!empty($pos_settings['disable_discount']))
                          <i class="fas fa-check-circle text-primary"></i>
                      @else
                          <i class="fas fa-times-circle text-danger"></i>
                      @endif
                  </span>
                  <label class="ms-2">{{ __('lang_v1.disable_discount') }}</label>
              </div>
          </div>
  
          <div class="col-sm-3">
              <div class="form-group d-flex align-items-center">
                  <span class="check-icon">
                      @if (!empty($pos_settings['disable_order_tax']))
                          <i class="fas fa-check-circle text-primary"></i>
                      @else
                          <i class="fas fa-times-circle text-danger"></i>
                      @endif
                  </span>
                  <label class="ms-2">{{ __('lang_v1.disable_order_tax') }}</label>
              </div>
          </div>
  
          <div class="col-sm-4">
              <div class="form-group d-flex align-items-center">
                  <span class="check-icon">
                      @if ($business->default_sales_discount == 0)
                          <i class="fas fa-check-circle text-primary"></i>
                      @else
                          <i class="fas fa-times-circle text-danger"></i>
                      @endif
                  </span>
                  <label class="ms-2">{!! __('zatca::lang.set_default_sales_discount', ['discount' => ( @num_format($business->default_sales_discount) . '%')]) !!}</label>
              </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
                {!! Form::submit(__('zatca::lang.apply_setting'), [
                    'class' => 'btn btn-primary text-white btn-lg',
                ]) !!}
            </div>
            </div>
      </div>
  </form>
  
    <div class="clearfix" style="margin-top:10px;"></div>

    {{-- Tabs --}}
    <ul class="nav nav-tabs" role="tablist">
      @foreach ($business_locations as $i => $loc)
        @php $isConnected = (int) ($loc->zatcaSetting->is_connected ?? 0); @endphp
        <li class="{{ $i ? '' : 'active' }}">
          <a href="#loc_{{ $loc->id }}"
             data-toggle="tab"
             data-connected="{{ $isConnected }}">
             {{ $loc->name }}
          </a>
        </li>
      @endforeach
    </ul>
   
    {{-- Tab panes --}}
    <div class="tab-content">
      @foreach ($business_locations as $i => $loc)
        @php
          $settings = $loc->zatcaSetting ?? new \Modules\Zatca\Entities\ZatcaSetting;
          $info     = (object) ($loc->zatca_info ?: []);
        @endphp

        <div id="loc_{{ $loc->id }}" class="tab-pane {{ $i ? '' : 'active' }}">
          {!! Form::model($info, [
                'url'    => route('zatca.update', [$business_id, 'location' => $loc->id]),
                'method' => 'POST',
                'class'  => 'content'
          ]) !!}
          
          <input type="hidden" name="location_id" value="{{ $loc->id }}">

          <div id="tax_data_content" class="pos-tab-content">
            <div class="row">
              {{-- Tax labels & numbers --}}
              <div class="col-sm-4">
                <div class="form-group">
                  {!! Form::label('tax_label_1', __('zatca::lang.tax_name').':') !!}
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    {!! Form::text('tax_label_1', null, ['class'=>'form-control','required']) !!}
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  {!! Form::label('tax_number_1', __('zatca::lang.vat_no').':') !!}
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    {!! Form::text('tax_number_1', null, ['class'=>'form-control','required']) !!}
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  {!! Form::label('tax_label_2', __('zatca::lang.crn_name').':') !!}
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    {!! Form::text('tax_label_2', null, ['class'=>'form-control','required']) !!}
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  {!! Form::label('tax_number_2', __('zatca::lang.crn_no').':') !!}
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    {!! Form::text('tax_number_2', null, ['class'=>'form-control','required']) !!}
                  </div>
                </div>
              </div>

              {{-- Address + email --}}
              @php
                $addrFields = [
                  'city'               => 'business.city',
                  'country'            => 'business.country',
                  'postal_number'      => 'zatca::lang.postal_number',
                  'company_address'    => 'zatca::lang.company_address',
                  'street_name'        => 'zatca::lang.street_name',
                  'building_number'    => 'zatca::lang.building_number',
                  'plot_identification'=> 'zatca::lang.plot_identification',
                  'city_sub_division'  => 'zatca::lang.city_sub_division',
                  'businessCategory'   => 'zatca::lang.business_category',
                ];
              @endphp
              @foreach ($addrFields as $field => $label)
                @php
                  $attrs = ['class'=>'form-control','required'];
                  if ($field === 'postal_number') {
                    $attrs['type']      = 'text';
                    $attrs['pattern']   = '\d{5}';
                    $attrs['minlength'] = 5;
                    $attrs['maxlength'] = 5;
                  }
                  if ($field === 'building_number') {
                    $attrs['type']      = 'text';
                    $attrs['pattern']   = '\d{4}';
                    $attrs['minlength'] = 4;
                    $attrs['maxlength'] = 4;
                  }
                @endphp
                <div class="col-sm-4">
                  <div class="form-group">
                    {!! Form::label($field, __($label).':') !!}
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-info"></i></span>
                      {!! Form::text($field, null, $attrs) !!}
                    </div>
                  </div>
                </div>
              @endforeach

              {{-- Email --}}
              <div class="col-sm-4">
                <div class="form-group">
                  {!! Form::label('emailAddress', __('zatca::lang.email').':') !!}
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    {!! Form::email('emailAddress', null, ['class'=>'form-control','required']) !!}
                  </div>
                </div>
              </div>

              {{-- OTP --}}
              <div class="col-sm-4">
                <div class="form-group">
                  {!! Form::label('otp', __('zatca::lang.otp').':') !!}
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    {!! Form::text('otp', null, [
                         'class'=>'form-control',
                         'pattern'=>'\d{6}',
                         'minlength'=>6,
                         'maxlength'=>6,
                         'required',
                         'title'=>__('zatca::lang.min_req',['min'=>6])
                    ]) !!}
                  </div>
                </div>
              </div>

              {{-- Invoice type --}}
              <div class="col-sm-4">
                <div class="form-group">
                  {!! Form::label('invoicing_type', __('zatca::lang.invoicing_type').':') !!}
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-money-bill-alt"></i></span>
                    {!! Form::select('invoicing_type', [
                           '1000'=>__('zatca::lang.invoice_tax'),
                           '0100'=>__('zatca::lang.simplified_invoice'),
                           '1100'=>__('zatca::lang.both'),
                         ],
                         null,
                         ['class'=>'form-control','required']
                    ) !!}
                  </div>
                </div>
              </div>

              {{-- Environment --}}
              <div class="col-sm-4">
                <div class="form-group">
                  {!! Form::label('zatca_env', __('zatca::lang.zatca_env').':') !!}
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-globe"></i></span>
                    {!! Form::select('zatca_env', [
                           'local'      => __('zatca::lang.local'),
                           'simulation' => __('zatca::lang.simulation'),
                           'production' => __('zatca::lang.production'),
                         ],
                         $settings->zatca_env ?? 'simulation',
                         ['class'=>'form-control','required']
                    ) !!}
                  </div>
                </div>
              </div>

              {{-- Auto‑sync frequency --}}
              <div class="col-sm-4">
                <div class="form-group">
                  {!! Form::label('sync_frequency', __('zatca::lang.sync_frequency').':') !!}
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fas fa-sync"></i></span>
                    {!! Form::select('sync_frequency', [
                           'instant'               => __('zatca::lang.instant'),
                           'every_fifteen_minutes' => __('zatca::lang.every_fifteen_minutes'),
                           'every_thirty_minutes'  => __('zatca::lang.every_thirty_minutes'),
                           'hourly'                => __('zatca::lang.hourly'),
                           'hourly_at:15'          => __('zatca::lang.hourly_at_15'),
                           'daily'                 => __('zatca::lang.daily'),
                         ],
                         $info->sync_frequency ?? 'hourly',
                         [
                           'class'=>'form-control',
                           'id'   => "sync_frequency_{$loc->id}",
                           'disabled' => empty($info->enable_auto_sync)
                         ]
                    ) !!}
                  </div>
                </div>
              </div>
              <div class="clearfix" ></div>
              <div class="col-sm-4" data-toggle="tooltip"
                   title="@lang('zatca::lang.enable_auto_sync_tooltip')" data-html="true">
                <div class="form-group">
                  <div class="toggle-wrapper" style="display:flex;gap:10px;margin-top:1.5rem;">
                    <label class="switch" for="enable_auto_sync_{{ $loc->id }}">
                      {!! Form::checkbox('enable_auto_sync', 1,
                           !empty($info->enable_auto_sync),
                           ['id'=>"enable_auto_sync_{$loc->id}",'data-loc'=>$loc->id]) !!}
                      <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __('zatca::lang.enable_auto_sync') }}</p>
                  </div>
                </div>
              </div>

              {{--B2B B2C Print--}}
              <div class="col-sm-4" data-toggle="tooltip"
              title="@lang('zatca::lang.enable_auto_b2b_b2c_print_help')" data-html="true">
           <div class="form-group">
             <div class="toggle-wrapper" style="display:flex;gap:10px;margin-top:1.5rem;">
               <label class="switch" for="enable_auto_b2b_b2c_print_{{ $loc->id }}">
                 {!! Form::checkbox('enable_auto_b2b_b2c_print', 1,
                      !empty($info->enable_auto_b2b_b2c_print),
                      ['id'=>"enable_auto_b2b_b2c_print_{$loc->id}",'data-loc'=>$loc->id]) !!}
                 <div class="sliderCheckbox round"></div>
               </label>
               <p>{{ __('zatca::lang.enable_auto_b2b_b2c_print') }}</p>
             </div>
           </div>
         </div>

              {{-- Create keys --}}
              <div class="col-sm-4" data-toggle="tooltip"
                   title="@lang('zatca::lang.create_zatca_keys_tooltip')" data-html="true">
                <div class="form-group">
                  <div class="toggle-wrapper" style="display:flex;gap:10px;margin-top:1.5rem;">
                    <label class="switch" for="create_zatca_keys_{{ $loc->id }}">
                      <input
                        type="checkbox"
                        id="create_zatca_keys_{{ $loc->id }}"
                        data-route="{{ route('zatca.create_zatca_keys', ['location'=>$loc->id]) }}"
                      >
                      <div class="sliderCheckbox round"></div>
                    </label>
                    <p>@lang('zatca::lang.update_zatca_keys')</p>
                  </div>
                </div>
              </div>

              @if(auth()->user()->can('superadmin'))
                <div class="col-sm-12 auto_sync_cron" style="margin-top:25px;">
                  <p>
                    To <mark>Auto Sync</mark> invoices (Except instant) you must set up this cron job:<br>
                    <code>{{ $cron_job_command ?? '' }}</code>
                  </p>
                </div>
              @endif

              {{-- Save button --}}
              <div class="col-sm-12">
                <button class="btn btn-danger pull-right">
                  @lang('business.update_settings')
                </button>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection

@section('javascript')
<script>
$(function(){
  $('[id^=create_zatca_keys_]').on('change', function(){
    const cb   = this;
    const form = cb.form;
    const $btn = $(form).find('button[type=submit]');

    if (cb.checked) {
      if (! form.checkValidity()) {
        form.reportValidity();
        cb.checked = false;
        return;
      }
      $btn.prop('disabled', true);
      $.post(cb.dataset.route, $(form).serialize())
        .done(res => {
          toastr[res.success ? 'success' : 'error'](res.msg);
          location.reload();
        })
        .fail(xhr => {
          toastr.error(xhr.responseJSON?.msg || 'Error');
          location.reload();
        });
    }
  });

  $('[id^=enable_auto_sync_]').on('change', function(){
    const id = $(this).data('loc');
    $('#sync_frequency_'+id).prop('disabled', ! this.checked);
  });

  function renderStatus(connected) {
    $('#zatca_status').html(
      "@lang('zatca::lang.status') " +
      (connected
        ? "<span class='text-success'>@lang('zatca::lang.connected')</span>"
        : "<span class='text-warning'>@lang('zatca::lang.ready_to_connect')</span>")
    );
  }
  renderStatus($('.nav-tabs li.active a').data('connected'));
  $('.nav-tabs a[data-toggle="tab"]').on('shown.bs.tab', function(e){
    renderStatus($(e.target).data('connected'));
  });
});
</script>
@endsection
