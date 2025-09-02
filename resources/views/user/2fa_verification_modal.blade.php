@php
    $two_factor_settings = $app_settings->two_factor_settings ?? [];
    $force_2fa_after_date = !empty($two_factor_settings['force_2fa_after_date']) ? \Carbon\Carbon::parse($two_factor_settings['force_2fa_after_date']) : null;
@endphp

<div class="modal fade" tabindex="-1" role="dialog" id="recommend2FAModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('settings.close_aria_label')">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">@lang('settings.modal_enable_2fa_title')</h4>
            </div>

            <div class="modal-body">
                <div class="modal__dialog-content">
                    <p>
                        @lang('settings.modal_enable_2fa_desc')
                    </p>
                    
                    @if($force_2fa_after_date && now()->lt($force_2fa_after_date))
                        <p class="text-danger">
                            @lang('settings.2fa_will_be_forced_after_date', [
                                'date' => $force_2fa_after_date->format('d-m-Y')
                            ])
                        </p>
                    @endif

                    <div class="text-center">
                        <a href="{{ route('2fa.setup_form') }}" class="btn btn-primary">
                            @lang('settings.enable_now_button')
                        </a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            @lang('settings.maybe_later_button')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@php session(['recommended_2fa' => true]); @endphp

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#recommend2FAModal').modal('show');
    });
</script>
