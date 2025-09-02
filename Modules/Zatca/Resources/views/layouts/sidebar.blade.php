@php
    $link = null;
    $label = __('zatca::lang.zatca');
        if (auth()->user()->can('zatca.sync_report')) {
            $link = route('zatca.sync_report');
        }
        elseif (auth()->user()->can('zatca.tax_report')) {
            $link = route('zatca.tax_report');
        }
        elseif (auth()->user()->can('zatca.settings')) {
            $link = route('zatca.settings');
        }
@endphp

@if($link)
    <a href="{{ $link }}" class="{{ request()->routeIs('*zatca*') ? 'active' : '' }}">
        <i class="fas fa-sync"></i>
        <h3>{{ $label }}</h3>
    </a>
@endif