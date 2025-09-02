@extends('layouts.app')

@section('title', __('settings.processed_jobs'))

@section('content')
<div class="main-container no-print">
    <!-- Sub Menu (optional) -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.app_settings', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter Section -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('settings.processed_jobs')</h1>
        <p>@lang('settings.processed_jobs_subtitle')</p>
            </div>
            <div class="filter">
                
            </div>
        </div>
    <div class="content">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>@lang('settings.uuid')</th>
            <th>@lang('settings.job_name')</th>
            <th>@lang('settings.business')</th>
            <th>@lang('settings.chunk_size')</th>
            <th>@lang('settings.completed_chunks')</th>
            <th>@lang('settings.total_chunks')</th>
            <th>@lang('settings.status')</th>
            <th>@lang('settings.started_at')</th>
            <th>@lang('settings.finished_at')</th>
          </tr>
        </thead>
        <tbody>
          @foreach($batches as $batch)
          <tr>
            <td>
                <a href="{{ route('stock.rebuild.result', ['uuid' => $batch->uuid]) }}">
                  {{ $batch->uuid }}
                </a>
              </td>
              
            <td>{{ $batch->job_name }}</td>
            <td>
              @if($batch->business_id === 'all')
                @lang('settings.all_businesses')
              @else
                {{ \App\Models\Business::find($batch->business_id)?->name ?? $batch->business_id }}
              @endif
            </td>
            <td>{{ $batch->chunk_size }}</td>
            <td>{{ $batch->completed_chunks }}</td>
            <td>{{ $batch->total_chunks }}</td>
            <td>
              <span class="badge
                {{ $batch->status === 'completed' ? 'bg-success' : ($batch->status === 'failed' ? 'bg-danger' : 'bg-secondary') }}">
                {{ ucfirst($batch->status) }}
              </span>
            </td>
            <td>{{ $batch->created_at->format('Y-m-d H:i') }}</td>
            <td>{{ $batch->updated_at->format('Y-m-d H:i') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('stock.rebuild.form') }}" class="btn btn-primary  pull-right">
                @lang('settings.go_back')
            </a>
        </div>
    </div>
    </div>
  </div>
</div>
@endsection
