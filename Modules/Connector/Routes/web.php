<?php

$middleware = ['web', 'authh', 'auth', 'SetSessionData', 'language', 'timezone', 'CheckUserLogin','force.2fa'];

if (app(App\Services\AppSettingsService::class)->force_email_verify())  {
    $middleware[] = 'verified';
}

Route::middleware($middleware)->prefix('connector')->group(function () {
    Route::get('install', [Modules\Connector\Http\Controllers\InstallController::class, 'index']);
    Route::post('install', [Modules\Connector\Http\Controllers\InstallController::class, 'install']);
    Route::get('install/uninstall', [Modules\Connector\Http\Controllers\InstallController::class, 'uninstall']);
    Route::get('install/update', [Modules\Connector\Http\Controllers\InstallController::class, 'update']);
});

Route::middleware($middleware)->prefix('connector')->group(function () {
    Route::get('/api', [Modules\Connector\Http\Controllers\ConnectorController::class, 'index']);
    Route::resource('/client', 'Modules\Connector\Http\Controllers\ClientController');
});