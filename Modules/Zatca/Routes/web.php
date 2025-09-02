<?php
use Modules\Zatca\Http\Controllers\ZatcaController;
use Modules\Zatca\Http\Controllers\InstallController;
use Modules\Zatca\Http\Controllers\ZatcaReportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$middleware = ['web', 'authh', 'auth', 'SetSessionData', 'language', 'timezone', 'CheckUserLogin','force.2fa'];

if (app(App\Services\AppSettingsService::class)->force_email_verify())  {
    $middleware[] = 'verified';
}
Route::middleware($middleware)->prefix('zatca')->group(function () {
    Route::get('install', [InstallController::class, 'index']);
    Route::post('install', [InstallController::class, 'install']);
    Route::get('install/uninstall', [InstallController::class, 'uninstall']);
    Route::get('install/update', [InstallController::class, 'update']);
    
Route::get('/invoice/print_xml/{id}', [ZatcaController::class, 'print_xml'])->name('print_xml');
Route::post('/zatca/create/zatca_keys/{location}', [ZatcaController::class, 'zatca_keys'])->name('zatca.create_zatca_keys');

Route::get('/sells/send_to_zatca/{id}', [ZatcaController::class, 'SendToZatca'])->name('send_to_zatca');
Route::post('/business/{business_id}/zatca', [ZatcaController::class, 'updateZatcaDetails'])->name('zatca.update');

Route::get('/settings', [ZatcaController::class, 'index'])->name('zatca.settings');
Route::get('/sync-report', [ZatcaReportController::class, 'get_zatca_sync_report'])->name('zatca.sync_report');
Route::get('/tax-report', [ZatcaReportController::class, 'get_zatca_tax_report'])->name('zatca.tax_report');
Route::post('/report/sync-all', [ZatcaController::class, 'syncAll'])->name('zatca.report.syncAll');
Route::get('/sell-print-pdf/{transaction_id}', [ZatcaController::class, 'downloadA3Pdf'])->name('zatca.downloadA3Pdf');
Route::post('pos-setting', [ZatcaController::class, 'posBussinesUpdate']);


});