@extends('layouts.app')
@section('title', __('settings.2fa_recovery_codes'))
@section('content')
<div class="main-container no-print">
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.user', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('settings.2fa_recovery_codes')</h1>
                <p>@lang('settings.recovery_codes_description')</p>
            </div>
            <div class="filter text-center">
                <div class="new-user">
                    <form action="{{ route('2fa.regenerate_recovery_codes') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning" title="@lang('settings.regenerate_codes')">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <section class="content">
           

            <div class="recovery-codes-container text-center">
                @if(!empty($codes))
                    <button id="copy-all" class="btn btn-sm btn-outline-info mb-3" title="@lang('settings.copy_all')">
                        <i class="fas fa-copy"></i> <i class="fas fa-layer-group"></i>
                    </button>

                    <div class="row justify-content-center">
                        @foreach($codes as $code)
                            <div class="col-md-4 col-sm-6 col-12 text-center mb-3">
                                <span class="recovery-code  p-2 border" style="font-size: 1.5em;">
                                    {{ $code }}
                                </span>
                                <button type="button" class="btn btn-sm btn-outline-secondary copy-code" data-code="{{ $code }}" title="@lang('settings.copy')">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>@lang('settings.no_recovery_codes_available')</p>
                @endif
            </div>
        </section>
    </div>
</div>
@endsection


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Copy individual recovery code
    var copyButtons = document.querySelectorAll('.copy-code');
    copyButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var code = this.getAttribute('data-code');
            navigator.clipboard.writeText(code).then(function() {
                toastr.success('@lang("settings.copied")');
            }, function(err) {
                console.error('Could not copy text: ', err);
                toastr.error('Error copying code.');
            });
        });
    });

    // Copy all recovery codes at once
    var copyAllButton = document.getElementById('copy-all');
    if (copyAllButton) {
        copyAllButton.addEventListener('click', function() {
            var codes = [];
            document.querySelectorAll('.recovery-code').forEach(function(span) {
                codes.push(span.innerText.trim());
            });
            var codesText = codes.join("\n");
            navigator.clipboard.writeText(codesText).then(function() {
                toastr.success('@lang("settings.all_codes_copied")');
            }, function(err) {
                console.error('Could not copy all codes: ', err);
                toastr.error('Error copying all codes.');
            });
        });
    }
});
</script>
