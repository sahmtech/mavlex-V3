@extends('layouts.app')
@section('title', __('lang_v1.backup'))

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
        <h1>@lang('lang_v1.backup')</h1>
        <p>@lang( 'lang_v1.manage_your_backup') </p>
      </div>
      <div class="filter">
        <div class="new-user">
          <a href="{{ url('backup/create') }}" class="btn btn-block btn-primary" id="create-new-backup-button" >
            <i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">

      @if (session('notification') || !empty($notification))
      <div class="row">
        <div class="col-sm-12">
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            @if(!empty($notification['msg']))
            {{$notification['msg']}}
            @elseif(session('notification.msg'))
            {{ session('notification.msg') }}
            @endif
          </div>
        </div>
      </div>
      @endif

      <div class="row">
        <div class="col-sm-12">
          @component('components.widget', ['class' => 'box-primary'])
          @if (count($backups))
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>@lang('lang_v1.file')</th>
                <th>@lang('lang_v1.size')</th>
                <th>@lang('lang_v1.date')</th>
                <th>@lang('lang_v1.age')</th>
                <th>@lang('messages.actions')</th>
              </tr>
            </thead>
            <tbody>
              @foreach($backups as $backup)
              <tr>
                <td>{{ $backup['file_name'] }}</td>
                <td>{{ humanFilesize($backup['file_size']) }}</td>
                <td>
                  {{ Carbon::createFromTimestamp($backup['last_modified'])->toDateTimeString() }}
                </td>
                <td>
                  {{ Carbon::createFromTimestamp($backup['last_modified'])->diffForHumans(Carbon::now()) }}
                </td>
                <td>
                  <a class="tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline tw-dw-btn-accent"
                    href="{{action([\App\Http\Controllers\BackUpController::class, 'download'], [$backup['file_name']])}}"><i
                      class="fa fa-cloud-download"></i> @lang('lang_v1.download')</a>
                  <a class="tw-dw-btn tw-dw-btn-outline tw-dw-btn-xs tw-dw-btn-error link_confirmation" data-button-type="delete"
                    href="{{ route('delete_backup', $backup['file_name']) }}"><i class="fa fa-trash-o"></i>
                    @lang('messages.delete') </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          @else
          <div class="well">
            <h4>There are no backups</h4>
          </div>
          @endif
          <br>
          <strong>@lang('lang_v1.auto_backup_instruction'):</strong><br>
          <code>{{$cron_job_command}}</code> <br>
          @endcomponent
        </div>
      </div>

    </section>
  </div>
</div>

@endsection