@php
$business = auth()->user()->business;
$lightLogo = $business->light_logo;
$darkLogo = $business->dark_logo;
$app_logo = $app_settings->app_logo ? json_decode($app_settings->app_logo, true) : [];
$app_logo_light = $app_logo['light'] ?? null;
$app_logo_dark = $app_logo['dark'] ?? null;
if ($app_settings->enable_custom_sidebar_logo && !empty($darkLogo)) {
    $dark_logo_src = upload_asset('uploads/business_logos/' . $darkLogo);
} elseif (!empty($app_logo_dark)) {
    $dark_logo_src = upload_asset('uploads/app_logos/' . $app_logo_dark);
} else {
    $dark_logo_src = '';
    $dark_hidden = true;
}
if ($app_settings->enable_custom_sidebar_logo && !empty($lightLogo)) {
    $light_logo_src = upload_asset('uploads/business_logos/' . $lightLogo);
} elseif (!empty($app_logo_light)) {
    $light_logo_src = upload_asset('uploads/app_logos/' . $app_logo_light);
} else {
    $light_logo_src = '';
    $light_hidden = true;
}
@endphp

@if(!isset($dark_hidden))
<img src="{{ $dark_logo_src }}" alt="logo" width="140px" class="light-mode-logo">
@else
<h3 class="light-mode-logo">{{ config('app.name', 'BardPOS') }}</h3>
@endif
@if(!isset($light_hidden))
<img src="{{ $light_logo_src }}" alt="logo" width="140px" class="dark-mode-logo">
@else
<h3 class="dark-mode-logo">{{ config('app.name', 'BardPOS') }}</h3>
@endif