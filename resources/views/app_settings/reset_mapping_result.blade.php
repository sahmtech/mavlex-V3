@extends('layouts.app')

@section('title', __('settings.mapping_reset_result'))

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
                <h1>@lang('settings.mapping_reset_result')</h1>
                <p>@lang('settings.chunk_processing_status')</p>
            </div>
            <div class="filter">
                
            </div>
        </div>
        <div class="content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>@lang('settings.business')</th>
                        <th>@lang('settings.chunk_status')</th>
                        <th>@lang('settings.total_chunks')</th>
                        <th>@lang('settings.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($progress as $chunk)
                    <tr>
                        <td>{{ $chunk['business'] }}</td>
                        <td>{{ $chunk['current_chunk'] }}</td>
                        <td>{{ $chunk['total_chunks'] }}</td>
                        <td><span class="badge bg-success">{{ $chunk['status'] }}</span></td>
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
