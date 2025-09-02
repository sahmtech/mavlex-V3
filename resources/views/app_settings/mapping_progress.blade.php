@extends('layouts.app')

@section('title', __('settings.mapping_reset_progress'))

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
                <h3>@lang('settings.mapping_reset_in_progress')</h3>
            </div>
            <div class="filter">
                <div class="mt-3">
                    <a href="{{ route('stock.rebuild.form') }}" class="btn btn-primary">
                        @lang('settings.refresh_status')
                    </a>
                </div>
            </div>
        </div>
        <div class="main-container">
            <p class="mt-2 text-center">
                <strong>@lang('settings.batch_status'): </strong>
                <span id="chunk-status">0/{{ $batch->total_chunks }}</span>
            </p>

            <div class="progress mb-2" style="height: 25px;">
                <div id="progress-bar"
                     class="progress-bar progress-bar-striped progress-bar-animated"
                     style="width:0%">0%</div>
            </div>

            {{-- Elapsed time --}}
            <p class="mb-1 text-muted text-center">
                <strong>@lang('settings.elapsed_time'):</strong>
                <span id="time-elapsed">—</span>
            </p>
            {{-- Remaining estimate --}}
            <p class="mb-0 text-muted text-center">
                <strong>@lang('settings.estimate_left'):</strong>
                <span id="time-estimate">—</span>
            </p>
        </div>
    </div>
</div>

<script>
    const batchUuid = "{{ $batch->uuid }}";
    const resultUrl = "{{ route('stock.rebuild.result', ['uuid' => $batch->uuid]) }}";

    function formatTime(sec) {
        sec = Math.max(0, Math.round(sec));
        const h = Math.floor(sec / 3600);
        sec %= 3600;
        const m = Math.floor(sec / 60);
        const s = sec % 60;
        return `${h}h ${m}m ${s}s`;
    }

    // Poll every 3 seconds
    const poller = setInterval(updateProgress, 3000);
    updateProgress();

    function updateProgress() {
        fetch('/job-progress/' + batchUuid)
          .then(r => r.json())
          .then(data => {
            const done  = data.completed_chunks;
            const total = data.total_chunks;
            const pct   = total ? Math.floor(done / total * 100) : 0;

            // progress bar
            document.getElementById('progress-bar').style.width = pct + '%';
            document.getElementById('progress-bar').innerText = pct + '%';
            document.getElementById('chunk-status').innerText = `${done}/${total}`;

            if (done > 0) {
                const startedAt    = new Date(data.created_at);
                const now          = new Date();
                const elapsedSec   = (now - startedAt) / 1000;
                const avgPerItem   = elapsedSec / done;
                const remainingSec = avgPerItem * (total - done);

                document.getElementById('time-elapsed').innerText  = formatTime(elapsedSec);
                document.getElementById('time-estimate').innerText = formatTime(remainingSec);
            }

            if (data.status === 'completed') {
                clearInterval(poller);
                window.location = resultUrl;
            }
          })
          .catch(console.error);
    }
</script>
@endsection
