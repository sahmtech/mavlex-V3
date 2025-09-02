<?php

use Illuminate\Support\Facades\Route;
use Modules\Superadmin\Http\Controllers\SubscriptionController;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountReportsController;
use App\Http\Controllers\AccountTypeController;
// use App\Http\Controllers\Auth;
use App\Http\Controllers\BackUpController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessLocationController;
use App\Http\Controllers\CashRegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CombinedPurchaseReturnController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerGroupController;
use App\Http\Controllers\DashboardConfiguratorController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\DocumentAndNoteController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GroupTaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportOpeningStockController;
use App\Http\Controllers\ImportProductsController;
use App\Http\Controllers\ImportSalesController;
use App\Http\Controllers\Install;
use App\Http\Controllers\InvoiceLayoutController;
use App\Http\Controllers\InvoiceSchemeController;
use App\Http\Controllers\LabelsController;
use App\Http\Controllers\LedgerDiscountController;
use App\Http\Controllers\LocationSettingsController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationTemplateController;
use App\Http\Controllers\OpeningStockController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseRequisitionController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Restaurant;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesCommissionAgentController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\SellingPriceGroupController;
use App\Http\Controllers\SellPosController;
use App\Http\Controllers\SellReturnController;
use App\Http\Controllers\StockAdjustmentController;
use App\Http\Controllers\StockTransferController;
use App\Http\Controllers\TaxonomyController;
use App\Http\Controllers\TaxRateController;
use App\Http\Controllers\TransactionPaymentController;
use App\Http\Controllers\TypesOfServiceController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariationTemplateController;
use App\Http\Controllers\WarrantyController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\CustomerDisplayController;
use App\Http\Controllers\AdvancePaymentController;
use App\Http\Controllers\DiscrepanciesController;
use App\Http\Controllers\StockRebuildController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\SocialController;
use App\Models\JobBatch;
use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\StorageMigrationController;
use App\Http\Controllers\Auth\SessionManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|---------------------------------------t-----------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

include_once 'install_r.php';
Route::get('redirect-login', [App\Http\Controllers\Auth\LoginController::class, 'redirectLogin']);

Route::middleware('guest')->group(function () {
    Route::get('2fa/verify', [TwoFactorController::class, 'otp_verify_form'])->name('2fa.form_verify');
    Route::post('2fa/verify', [TwoFactorController::class, 'otp_verify'])->name('2fa.verify');
});

// Email Verification Routes
Route::get('login/{provider}', [SocialController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [SocialController::class, 'handleProviderCallback'])->name('social.callback');
Route::get('/email-verification/{token}', [App\Http\Controllers\EmailTokenVerificationController::class, 'VerifyBusinessOwnerEmail'])->name('email.verification.link');

// OTP-based email verification routes
Route::post('/otp/send', [App\Http\Controllers\EmailTokenVerificationController::class, 'sendOtp'])->name('otp.send');
Route::post('/otp/verify', [App\Http\Controllers\EmailTokenVerificationController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp/resend', [App\Http\Controllers\EmailTokenVerificationController::class, 'resendOtp'])->name('otp.resend');
  
Route::middleware(['setData'])->group(function () {
    Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'redirectToLogin']);
    Route::get('/admin-force/{token}', [App\Http\Controllers\LoginBusinessController::class, 'tokenLogin']);
    if (app(App\Services\AppSettingsService::class)->force_email_verify()) {
        Auth::routes(['verify' => true]);
    } else {
        Auth::routes();
    }
    Route::get('/email/verify', [App\Http\Controllers\UserController::class, 'show'])
    ->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\UserController::class, 'verify'])
    ->name('verification.verify');
    Route::post('/email/resend', [App\Http\Controllers\UserController::class, 'resend'])
    ->name('verification.resend');
    
    Route::get('/maintainance', [App\Http\Controllers\LoginBusinessController::class, 'dd'])->name('maintainance');
    Route::get('/user/is-email-verified', [App\Http\Controllers\UserController::class, 'getIsEmailVerified']);
    Route::post('/user/verify-email', [App\Http\Controllers\UserController::class, 'verifyEmail']);
    Route::get('/business/register', [App\Http\Controllers\BusinessController::class, 'getRegister'])->name('business.getRegister');
    Route::post('/business/register', [App\Http\Controllers\BusinessController::class, 'postRegister'])->name('business.postRegister');
    Route::post('/business/get_states', [App\Http\Controllers\BusinessController::class, 'getStates']);
    Route::post('/onboard/business', [App\Http\Controllers\BusinessController::class, 'OnboardBusiness'])->name('business.OnboardBusiness');
    Route::post('/business/register/check-username', [App\Http\Controllers\BusinessController::class, 'postCheckUsername'])->name('business.postCheckUsername');
    Route::post('/business/register/check-username2', [App\Http\Controllers\BusinessController::class, 'postCheckUsername2'])->name('business.postCheckUsername2');
    Route::post('/business/register/check-email', [App\Http\Controllers\BusinessController::class, 'postCheckEmail'])->name('business.postCheckEmail');
    Route::get('/invoice/payment-success', [App\Http\Controllers\SellController::class, 'paymentSuccess'])->name('invoice.payment_success');
    Route::get('/invoice/payment-failed', [App\Http\Controllers\SellController::class, 'paymentFailed'])->name('invoice.payment_failed');
    Route::get('/invoice/{token}', [App\Http\Controllers\SellPosController::class, 'showInvoice'])->name('show_invoice');
    Route::get('/quote/{token}', [App\Http\Controllers\SellPosController::class, 'showInvoice'])->name('show_quote');
    //New Business Onboarding
    // Route::post('/business/type', [App\Http\Controllers\OTPController::class, 'set_business_type'])->name('business.set_business_type');
    // Route::get('/business/onboard', [App\Http\Controllers\OnboardController::class, 'Businness'])->name('business.onboard');
    // Route::get('/business/scale', [App\Http\Controllers\OnboardController::class, 'BusinnessScale'])->name('business.scale');
    // Route::get('/business/scale/existing', [App\Http\Controllers\OnboardController::class, 'BusinnessScaleExisting'])->name('business.scale.exsiting');
    // Route::get('/business/contact/existing', [App\Http\Controllers\OnboardController::class, 'BusinnessPhoneValidationExisting'])->name('business.otp.exsiting');
    // Route::post('/business/contact/validate', [App\Http\Controllers\OnboardController::class, 'BusinnessPhoneValidation'])->name('business.otp.validateexsiting');

});

$middleware = ['setData','auth','force.2fa','SetSessionData','language','CheckUserLogin','timezone'];

if (app(App\Services\AppSettingsService::class)->force_email_verify())  {
    $middleware[] = 'verified';
}
Route::post('/settings/sync-disposable', [AppSettingsController::class, 'syncDisposable'])->name('settings.syncDisposable')
     ->middleware(['auth', 'can:superadmin']);
Route::middleware(['auth'])->post('/update-email', [App\Http\Controllers\UserController::class, 'updateEmail'])->name('user.updateEmail');

Route::middleware($middleware)->group(function() {

    //Menu Rotes
    Route::get('/app/menus/',[\App\Http\Controllers\MenuController::class, 'index'])->name('menus.index');
    Route::get('/app/menus/create',[\App\Http\Controllers\MenuController::class, 'create'])->name('menus.create');
    Route::post('/app/menus/',[\App\Http\Controllers\MenuController::class, 'store'])->name('menus.store');
    Route::post('/app/menus/bulk-save',[\App\Http\Controllers\MenuController::class, 'bulkSave'])->name('menus.bulk_save');
    Route::get('/app/menus/create-modal', [\App\Http\Controllers\MenuController::class, 'create'])->name('menus.modal');
    Route::post('/app/menus/rebuild', [\App\Http\Controllers\MenuController::class, 'rebuild'])->name('menus.rebuild');

   //2fa Routes
   Route::post('2fa/setup', [TwoFactorController::class, 'otp_verify'])->name('2fa.setup_verify');
   Route::get('2fa/confirm', [TwoFactorController::class, 'reauth_form'])->name('2fa.reauth-form');
   Route::post('2fa/confirm', [TwoFactorController::class, 'reauth_confirmation'])->name('2fa.reauth_verify');

   Route::middleware('re-auth')->group(function () {
   Route::get('2fa/setup', [TwoFactorController::class, 'setup_2fa_form'])->name('2fa.setup_form');
   Route::get('2fa/show-recovery-codes', [TwoFactorController::class, 'recovery_code_index'])->name('2fa.recovery_code_index');
   Route::post('2fa/recovery-codes/regenerate', [TwoFactorController::class, 'regenerate_recovery_codes'])->name('2fa.regenerate_recovery_codes');
    });
  
    Route::get('app/settings', [\App\Http\Controllers\AppSettingsController::class, 'index'])->name('app.settings.index');
    Route::post('app/settings', [\App\Http\Controllers\AppSettingsController::class, 'update'])->name('app.settings.update');
    Route::get('/app/locked-users-data', [App\Http\Controllers\AppSettingsController::class, 'lockedUsersData'])->name('admin.locked_users_data');
    Route::get('/app/locked-users', [App\Http\Controllers\AppSettingsController::class, 'lockedUsers'])->name('admin.locked_users');
    Route::post('/app/locked-users/{user}', [App\Http\Controllers\AppSettingsController::class, 'unlockUser'])->name('admin.unlock_user');
    
    // OTP Verification Admin Routes
    Route::get('/app/otp-verification', [App\Http\Controllers\Auth\OtpVerificationController::class, 'index'])->name('admin.otp.index');
    Route::get('/app/otp-verification/data', [App\Http\Controllers\Auth\OtpVerificationController::class, 'getData'])->name('admin.otp.data');
    Route::get('/app/otp-verification/stats', [App\Http\Controllers\Auth\OtpVerificationController::class, 'getStats'])->name('admin.otp.stats');
    Route::post('/app/otp-verification/reset', [App\Http\Controllers\Auth\OtpVerificationController::class, 'resetOtp'])->name('admin.otp.reset');
    Route::post('/app/otp-verification/verify', [App\Http\Controllers\Auth\OtpVerificationController::class, 'manualVerify'])->name('admin.otp.verify');
    Route::post('/app/otp-verification/deactivate', [App\Http\Controllers\Auth\OtpVerificationController::class, 'deactivateToken'])->name('admin.otp.deactivate');
    
    Route::get('app/migration', [StorageMigrationController::class, 'index'])->name('storage.migration.index');
    Route::post('app/migration/run', [StorageMigrationController::class, 'run'])->name('storage.migration.run');
    Route::get('app/migration/status/{id}', [StorageMigrationController::class, 'status'])->name('storage.migration.status');
    
// Superadmin Session & User Management
    Route::get('app/session-management', [SessionManagementController::class, 'index'])->name('session-management.index');
    Route::get('/app/session-management/data', [SessionManagementController::class, 'getData'])->name('session-management.data');
    Route::get('/app/session-management/stats', [SessionManagementController::class, 'getStats'])->name('session-management.stats');
    // Actions
    Route::post('/app/session-management/force-logout', [SessionManagementController::class, 'forceLogout'])->name('session-management.force-logout');
    Route::post('/app/session-management/lock-user', [SessionManagementController::class, 'lockUser'])->name('session-management.lock-user');
    Route::post('/app/session-management/unlock-user', [SessionManagementController::class, 'unlockUser'])->name('session-management.unlock-user');
    Route::post('/app/session-management/toggle-status', [SessionManagementController::class, 'toggleUserStatus'])->name('session-management.toggle-status');
    Route::post('/app/session-management/toggle-login', [SessionManagementController::class, 'toggleLoginPermission'])->name('session-management.toggle-login');
    Route::post('/app/session-management/toggle-business', [SessionManagementController::class, 'toggleBusinessStatus'])->name('session-management.toggle-business');


    // Route::get('/terms-of-service', [App\Http\Controllers\TermsOfServiceController::class, 'index']);
    // Route::post('/terms-of-service', [App\Http\Controllers\TermsOfServiceController::class, 'store']);
    Route::get('service-staff-availability', [SellPosController::class, 'showServiceStaffAvailibility']);
    Route::get('pause-resume-service-staff-timer/{user_id}', [SellPosController::class, 'pauseResumeServiceStaffTimer']);
    Route::get('mark-as-available/{user_id}', [SellPosController::class, 'markAsAvailable']);
    Route::resource('purchase-requisition', PurchaseRequisitionController::class)->except(['edit', 'update']);
    Route::post('/get-requisition-products', [PurchaseRequisitionController::class, 'getRequisitionProducts'])->name('get-requisition-products');
    Route::get('get-purchase-requisitions/{location_id}', [PurchaseRequisitionController::class, 'getPurchaseRequisitions']);
    Route::get('get-purchase-requisition-lines/{purchase_requisition_id}', [PurchaseRequisitionController::class, 'getPurchaseRequisitionLines']);

    Route::get('/redis-init', [App\Http\Controllers\RedisCachingControrller::class, 'CacheInit']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/get-totals', [App\Http\Controllers\HomeController::class, 'getTotals']);
    Route::get('/home/analytics-data', [App\Http\Controllers\HomeController::class, 'getAnalyticsData']);
    Route::get('/home/product-stock-alert', [App\Http\Controllers\HomeController::class, 'getProductStockAlert']);
    Route::get('/home/purchase-payment-dues', [App\Http\Controllers\HomeController::class, 'getPurchasePaymentDues']);
    Route::get('/home/sales-payment-dues', [App\Http\Controllers\HomeController::class, 'getSalesPaymentDues']);
    Route::post('/attach-medias-to-model', [App\Http\Controllers\HomeController::class, 'attachMediasToGivenModel'])->name('attach.medias.to.model');
    Route::get('/calendar', [App\Http\Controllers\HomeController::class, 'getCalendar'])->name('calendar');
    Route::post('/request-account', [App\Http\Controllers\HomeController::class, 'requestAccount']);
    Route::get('/get-wallet-account-balance', [App\Http\Controllers\HomeController::class, 'getWalletAccountBalance']);
    Route::post('/test-email', [App\Http\Controllers\BusinessController::class, 'testEmailConfiguration']);
    Route::post('/test-sms', [App\Http\Controllers\BusinessController::class, 'testSmsConfiguration']);
    Route::get('/business/settings', [App\Http\Controllers\BusinessController::class, 'getSettings'])->name('business.getSettings');
    Route::get('/calendar', [HomeController::class, 'getCalendar'])->name('calendar');

    Route::get('regenerate', [Install\ModulesController::class, 'regenerate']);
    Route::post('upload-module', [Install\ModulesController::class, 'uploadModule']);
    Route::delete('manage-modules/destroy/{module_name}', [Install\ModulesController::class, 'destroy']);
    Route::resource('manage-modules', Install\ModulesController::class)->only(['index', 'update']);
    Route::get('/sign-in-as-user/{id}', [ManageUserController::class, 'signInAsUser'])->name('sign-in-as-user');

    /*******************************************/
    //Route::get('/business/settings_v2', [BusinessController::class, 'getBusinessSettings'])->name('business.getBusinessSettings');
    //Route::post('/business/update', [BusinessController::class, 'postBusinessSettings'])->name('business.postBusinessSettings');
    /********************************************/
    Route::get('/business/business-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getBusinessSettings');
    Route::get('/business/reward-points-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getRewardPointsSettings');
    Route::get('/business/tax-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getTaxSettings');
    Route::get('/business/product-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getProductSettings');
    Route::get('/business/contact-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getContactSettings');
    Route::get('/business/sales-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getSalesSettings');
    Route::get('/business/pos-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getPosSettings');
    Route::get('/business/purchases-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getPurchaseSettings');
    Route::get('/business/stock-transfer-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getStockTransferSettings');
    Route::get('/business/apperance-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getApperanceSettings');
    Route::get('/business/prefixes-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getPrefixSettings');
    Route::get('/business/email-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getEmailSettings');
    Route::get('/business/sms-settings2', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getSmsSettings');
    Route::get('/business/sms-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.SmsSettings');
    Route::get('/business/sms-settings/create', [App\Http\Controllers\BusinessController::class, 'createSmsSettings'])->name('business.createSmsSettings');
    Route::post('/business/sms-settings/store', [App\Http\Controllers\BusinessController::class, 'storeSmsSettings'])->name('business.storeSmsSettings');
    Route::get('/business/modules-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getModulesSettings');
    Route::get('/business/custom-label-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getCustomLabelSettings');
    Route::post('/business/set/defualt', [App\Http\Controllers\BusinessController::class, 'DefaultSenderID']);
    Route::get('/business/dashboard-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getDashboardSettings');
    Route::get('/business/restaurant-settings', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getRestaurantSettings');
    Route::get('/business/customer-display', [App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])->name('business.getCustomerDisplay');

    /********************************************/
    Route::post('/business/update', [App\Http\Controllers\BusinessController::class, 'postBusinessSettings'])->name('business.postBusinessSettings');
    Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'getProfile'])->name('user.getProfile');
    Route::post('/user/update', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::post('/user/update-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.updatePassword');
    Route::post('/user/update-contact', [App\Http\Controllers\UserController::class, 'updatePhoneNumber'])->name('user.updatePhoneNumber');
    //Update Business Email for verification
    Route::post('/user/update-business-owner-email', [App\Http\Controllers\UserController::class, 'UpdateBusinessEmailAndSendVerification'])->name('user.UpdateBusinessEmailAndSendVerification');
    Route::get('/user/get-lang', [App\Http\Controllers\UserController::class, 'get_lang'])->name('user.get_lang');
    Route::get('/user/update-lang', [App\Http\Controllers\UserController::class, 'update_lang'])->name('user.update_lang');
    Route::resource('brands', App\Http\Controllers\BrandController::class);
    // Route::resource('payment-account', 'PaymentAccountController');
    // Route::resource('payment-account', [App\Http\Controllers\PaymentAccountController]);

    Route::resource('tax-rates', App\Http\Controllers\TaxRateController::class);
    Route::resource('units', App\Http\Controllers\UnitController::class);

    Route::post('check-mobile', [App\Http\Controllers\ContactController::class, 'checkMobile']);
    Route::get('/get-contact-due/{contact_id}', [App\Http\Controllers\ContactController::class, 'getContactDue']);
    Route::get('/contacts/payments/{contact_id}', [App\Http\Controllers\ContactController::class, 'getContactPayments']);
    Route::get('/contacts/map', [App\Http\Controllers\ContactController::class, 'contactMap']);
    Route::get('/contacts/update-status/{id}', [App\Http\Controllers\ContactController::class, 'updateStatus']);
    Route::get('/contacts/stock-report/{supplier_id}', [App\Http\Controllers\ContactController::class, 'getSupplierStockReport']);
    Route::get('/contacts/ledger', [App\Http\Controllers\ContactController::class, 'getLedger']);
    Route::post('/contacts/send-ledger', [App\Http\Controllers\ContactController::class, 'sendLedger']);
    Route::get('/contacts/import', [App\Http\Controllers\ContactController::class, 'getImportContacts'])->name('contacts.import');
    Route::post('/contacts/import', [App\Http\Controllers\ContactController::class, 'postImportContacts']);
    Route::post('/contacts/check-contacts-id', [App\Http\Controllers\ContactController::class, 'checkContactId']);
    Route::get('/contacts/customers', [App\Http\Controllers\ContactController::class, 'getCustomers']);
    Route::resource('contacts', App\Http\Controllers\ContactController::class);

    Route::get('taxonomies-ajax-index-page', [App\Http\Controllers\TaxonomyController::class, 'getTaxonomyIndexPage']);
    Route::resource('taxonomies', App\Http\Controllers\TaxonomyController::class);

    Route::resource('variation-templates', App\Http\Controllers\VariationTemplateController::class);
    Route::get('/products/download-excel', [ProductController::class, 'downloadExcel']);
    Route::get('/products/stock-history/{id}', [App\Http\Controllers\ProductController::class, 'productStockHistory']);
    Route::get('/delete-media/{media_id}', [App\Http\Controllers\ProductController::class, 'deleteMedia']);
    Route::post('/products/mass-deactivate', [App\Http\Controllers\ProductController::class, 'massDeactivate']);
    Route::get('/products/activate/{id}', [App\Http\Controllers\ProductController::class, 'activate']);
    Route::get('/products/view-product-group-price/{id}', [App\Http\Controllers\ProductController::class, 'viewGroupPrice']);
    Route::get('/products/add-selling-prices/{id}', [App\Http\Controllers\ProductController::class, 'addSellingPrices']);
    Route::post('/products/save-selling-prices', [App\Http\Controllers\ProductController::class, 'saveSellingPrices']);
    Route::post('/products/mass-delete', [App\Http\Controllers\ProductController::class, 'massDestroy']);
    Route::get('/products/view/{id}', [App\Http\Controllers\ProductController::class, 'view']);
    Route::get('/products/list', [App\Http\Controllers\ProductController::class, 'getProducts']);
    Route::get('/products/list-no-variation', [App\Http\Controllers\ProductController::class, 'getProductsWithoutVariations']);
    Route::post('/products/bulk-edit', [App\Http\Controllers\ProductController::class, 'bulkEdit']);
    Route::post('/products/bulk-update', [App\Http\Controllers\ProductController::class, 'bulkUpdate']);
    Route::post('/products/bulk-update-location', [App\Http\Controllers\ProductController::class, 'updateProductLocation']);
    Route::get('/products/get-product-to-edit/{product_id}', [App\Http\Controllers\ProductController::class, 'getProductToEdit']);

    Route::post('/products/get_sub_categories', [App\Http\Controllers\ProductController::class, 'getSubCategories']);
    Route::get('/products/get_sub_units', [App\Http\Controllers\ProductController::class, 'getSubUnits']);
    Route::post('/products/product_form_part', [App\Http\Controllers\ProductController::class, 'getProductVariationFormPart']);
    Route::post('/products/get_product_variation_row', [App\Http\Controllers\ProductController::class, 'getProductVariationRow']);
    Route::post('/products/get_variation_template', [App\Http\Controllers\ProductController::class, 'getVariationTemplate']);
    Route::get('/products/get_variation_value_row', [App\Http\Controllers\ProductController::class, 'getVariationValueRow']);
    Route::post('/products/check_product_sku', [App\Http\Controllers\ProductController::class, 'checkProductSku']);
    Route::post('/products/validate_variation_skus', [ProductController::class, 'validateVaritionSkus']); //validates multiple skus at once
    Route::get('/products/quick_add', [App\Http\Controllers\ProductController::class, 'quickAdd']);
    Route::post('/products/save_quick_product', [App\Http\Controllers\ProductController::class, 'saveQuickProduct']);
    Route::get('/products/get-combo-product-entry-row', [App\Http\Controllers\ProductController::class, 'getComboProductEntryRow']);
    Route::post('/products/toggle-woocommerce-sync', [App\Http\Controllers\ProductController::class, 'toggleWooCommerceSync']);
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::post('/import-purchase-products', [App\Http\Controllers\PurchaseController::class, 'importPurchaseProducts']);
    Route::post('/purchases/update-status', [App\Http\Controllers\PurchaseController::class, 'updateStatus']);
    Route::get('/purchases/get_products', [PurchaseController::class, 'getProducts']);
    Route::get('/purchases/get_suppliers', [App\Http\Controllers\PurchaseController::class, 'getSuppliers']);
    Route::post('/purchases/get_purchase_entry_row', [App\Http\Controllers\PurchaseController::class, 'getPurchaseEntryRow']);
    Route::post('/purchases/check_ref_number', [App\Http\Controllers\PurchaseController::class, 'checkRefNumber']);
    Route::resource('purchases', App\Http\Controllers\PurchaseController::class)->except(['show']);
    Route::get('/toggle-subscription/{id}', [App\Http\Controllers\SellPosController::class, 'toggleRecurringInvoices']);
    Route::post('/sells/pos/get-types-of-service-details', [App\Http\Controllers\SellPosController::class, 'getTypesOfServiceDetails']);
    Route::get('/sells/subscriptions', [App\Http\Controllers\SellPosController::class, 'listSubscriptions']);
    Route::get('/sells/duplicate/{id}', [App\Http\Controllers\SellController::class, 'duplicateSell']);
    Route::get('/sells/drafts', [App\Http\Controllers\SellController::class, 'getDrafts']);
    Route::get('/sells/convert-to-draft/{id}', [App\Http\Controllers\SellPosController::class, 'convertToInvoice']);
    Route::get('/sells/convert-to-proforma/{id}', [App\Http\Controllers\SellPosController::class, 'convertToProforma']);
    Route::get('/sells/quotations', [App\Http\Controllers\SellController::class, 'getQuotations']);
    Route::get('/sells/draft-dt', [App\Http\Controllers\SellController::class, 'getDraftDatables']);
    Route::get('/sells/draft-dt', [App\Http\Controllers\SellController::class, 'getDraftDatables']);
    Route::get('/sells/preview/{id}', [App\Http\Controllers\SellController::class, 'previewInvoice'])->name('preview_invoice');
    Route::get('/sells/customize', [App\Http\Controllers\SellController::class, 'customize'])->name('customize_invoice');
    Route::post('/sells/customize', [App\Http\Controllers\SellController::class, 'storeCustomize'])->name('store_customize_invoice');
    Route::resource('sells', App\Http\Controllers\SellController::class)->except(['show']);
    Route::get('/import-sales', [App\Http\Controllers\ImportSalesController::class, 'index']);
    Route::post('/import-sales/preview', [App\Http\Controllers\ImportSalesController::class, 'preview']);
    Route::post('/import-sales', [App\Http\Controllers\ImportSalesController::class, 'import']);
    Route::get('/revert-sale-import/{batch}', [App\Http\Controllers\ImportSalesController::class, 'revertSaleImport']);

    Route::get('/sells/pos/get_product_row/{variation_id}/{location_id}', [App\Http\Controllers\SellPosController::class, 'getProductRow']);
    Route::get('/price-check/get_product_row/{variation_id}/{location_id}', [App\Http\Controllers\PriceCheckController::class, 'getProductRow']);

    Route::post('/sells/pos/get_payment_row', [App\Http\Controllers\SellPosController::class, 'getPaymentRow']);

    Route::post('/sells/pos/get-reward-details', [App\Http\Controllers\SellPosController::class, 'getRewardDetails']);
    Route::get('/sells/pos/get-recent-transactions', [App\Http\Controllers\SellPosController::class, 'getRecentTransactions']);
    Route::get('/sells/pos/get-product-suggestion', [App\Http\Controllers\SellPosController::class, 'getProductSuggestion']);
    Route::get('/sells/pos/get-product-data-for-instant-row', [App\Http\Controllers\SellPosController::class, 'getProductDataForInstantRow']);
    Route::get('/sells/pos/get-featured-products/{location_id}', [App\Http\Controllers\SellPosController::class, 'getFeaturedProducts']);
    Route::get('/reset-mapping', [App\Http\Controllers\SellController::class, 'resetMapping']);
    //Dark Mode
    Route::post('/toggle-dark-mode', [DarkModeController::class, 'toggle'])->name('toggle-dark-mode');
    //Customer Display:
    Route::get('pos/customer-display', function () {
        return view('customer_display.index');
    })->name('customer-display');
    //Price Check:
    Route::get('pos/price-check', [App\Http\Controllers\PriceCheckController::class, 'index'])->name('price-check');
    Route::resource('pos', App\Http\Controllers\SellPosController::class);
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::resource('users', App\Http\Controllers\ManageUserController::class);
    Route::resource('group-taxes', App\Http\Controllers\GroupTaxController::class);
    Route::get('/barcodes/set_default/{id}', [App\Http\Controllers\BarcodeController::class, 'setDefault']);
    Route::resource('barcodes', App\Http\Controllers\BarcodeController::class);

    //Invoice schemes..
    Route::get('/invoice-schemes/set_default/{id}', [App\Http\Controllers\InvoiceSchemeController::class, 'setDefault']);
    Route::resource('invoice-schemes', App\Http\Controllers\InvoiceSchemeController::class);

    //Print Labels
    Route::get('/labels/show', [App\Http\Controllers\LabelsController::class, 'show']);
    Route::get('/labels/add-product-row', [App\Http\Controllers\LabelsController::class, 'addProductRow']);
    Route::get('/labels/preview', [App\Http\Controllers\LabelsController::class, 'preview']);

    //Reports...
    // Stock Rebuilding
    Route::get('/stock-rebuild', [StockRebuildController::class, 'index'])->name('stock_rebuild.index');
    Route::get('/stock-rebuild/do', [StockRebuildController::class, 'remapStock'])->name('stock_rebuild.remap');
    //TODO :: Feature UnderDevelopment
    // Route::get('/stock-rebuild/reset-mapping/', [StockRebuildController::class, 'showResetMappingForm'])->name('stock.rebuild.form');
    // Route::post('/stock-rebuild/reset-mapping/reset', [StockRebuildController::class, 'resetMapping'])->name('stock.rebuild.reset');
    // Route::get('/job-progress/{uuid}', function ($uuid) {
    //     $batch = JobBatch::where('uuid', $uuid)->firstOrFail();
    //     return response()->json($batch);
    // });
    // Route::get('stock-rebuild/reset-mapping/result/{uuid}', [StockRebuildController::class, 'mappingResult'])->name('stock.rebuild.result');
    // Route::get('stock-rebuild/jobs', [StockRebuildController::class, 'processedJobs'])->name('stock.rebuild.jobs');
    
    //Reports
    Route::get('/reports/gst-sales-report', [ReportController::class, 'gstSalesReport']);
    Route::get('/reports/gst-purchase-report', [ReportController::class, 'gstPurchaseReport']);
    Route::get('/reports/get-stock-by-sell-price', [App\Http\Controllers\ReportController::class, 'getStockBySellingPrice']);
    Route::get('/reports/purchase-report', [App\Http\Controllers\ReportController::class, 'purchaseReport']);
    Route::get('/reports/sale-report', [App\Http\Controllers\ReportController::class, 'saleReport']);
    Route::get('/reports/service-staff-report', [App\Http\Controllers\ReportController::class, 'getServiceStaffReport']);
    Route::get('/reports/service-staff-line-orders', [App\Http\Controllers\ReportController::class, 'serviceStaffLineOrders']);
    Route::get('/reports/table-report', [App\Http\Controllers\ReportController::class, 'getTableReport']);
    Route::get('/reports/profit-loss', [App\Http\Controllers\ReportController::class, 'getProfitLoss']);
    Route::get('/reports/get-opening-stock', [App\Http\Controllers\ReportController::class, 'getOpeningStock']);
    Route::get('/reports/purchase-sell', [App\Http\Controllers\ReportController::class, 'getPurchaseSell']);
    Route::get('/reports/customer-supplier', [App\Http\Controllers\ReportController::class, 'getCustomerSuppliers']);
    Route::get('/reports/stock-report', [App\Http\Controllers\ReportController::class, 'getStockReport']);
    Route::get('/reports/stock-details', [App\Http\Controllers\ReportController::class, 'getStockDetails']);
    Route::get('/reports/tax-report', [App\Http\Controllers\ReportController::class, 'getTaxReport']);
    Route::get('/reports/tax-details', [App\Http\Controllers\ReportController::class, 'getTaxDetails']);
    Route::get('/reports/trending-products', [App\Http\Controllers\ReportController::class, 'getTrendingProducts']);
    Route::get('/reports/expense-report', [App\Http\Controllers\ReportController::class, 'getExpenseReport']);
    Route::get('/reports/stock-adjustment-report', [App\Http\Controllers\ReportController::class, 'getStockAdjustmentReport']);
    Route::get('/reports/register-report', [App\Http\Controllers\ReportController::class, 'getRegisterReport']);
    Route::get('/reports/sales-representative-report', [App\Http\Controllers\ReportController::class, 'getSalesRepresentativeReport']);
    Route::get('/reports/sales-representative-total-expense', [App\Http\Controllers\ReportController::class, 'getSalesRepresentativeTotalExpense']);
    Route::get('/reports/sales-representative-total-sell', [App\Http\Controllers\ReportController::class, 'getSalesRepresentativeTotalSell']);
    Route::get('/reports/sales-representative-total-commission', [App\Http\Controllers\ReportController::class, 'getSalesRepresentativeTotalCommission']);
    Route::get('/reports/stock-expiry', [App\Http\Controllers\ReportController::class, 'getStockExpiryReport']);
    Route::get('/reports/stock-expiry-edit-modal/{purchase_line_id}', [App\Http\Controllers\ReportController::class, 'getStockExpiryReportEditModal']);
    Route::post('/reports/stock-expiry-update', [App\Http\Controllers\ReportController::class, 'updateStockExpiryReport'])->name('updateStockExpiryReport');
    Route::get('/reports/customer-group', [App\Http\Controllers\ReportController::class, 'getCustomerGroup']);
    Route::get('/reports/product-purchase-report', [App\Http\Controllers\ReportController::class, 'getproductPurchaseReport']);
    Route::get('/reports/product-sell-grouped-by', [App\Http\Controllers\ReportController::class, 'productSellReportBy']);
    Route::get('/reports/product-sell-report', [App\Http\Controllers\ReportController::class, 'getproductSellReport']);
    Route::get('/reports/product-sell-report-with-purchase', [App\Http\Controllers\ReportController::class, 'getproductSellReportWithPurchase']);
    Route::get('/reports/product-sell-grouped-report', [App\Http\Controllers\ReportController::class, 'getproductSellGroupedReport']);
    Route::get('/reports/lot-report', [App\Http\Controllers\ReportController::class, 'getLotReport']);
    Route::get('/reports/purchase-payment-report', [App\Http\Controllers\ReportController::class, 'purchasePaymentReport']);
    Route::get('/reports/sell-payment-report', [App\Http\Controllers\ReportController::class, 'sellPaymentReport']);
    Route::get('/reports/product-stock-details', [App\Http\Controllers\ReportController::class, 'productStockDetails']);
    Route::get('/reports/adjust-product-stock', [App\Http\Controllers\ReportController::class, 'adjustProductStock']);
    Route::get('/reports/get-profit/{by?}', [App\Http\Controllers\ReportController::class, 'getProfit']);
    Route::get('/reports/items-report', [App\Http\Controllers\ReportController::class, 'itemsReport']);
    Route::get('/reports/get-stock-value', [App\Http\Controllers\ReportController::class, 'getStockValue']);
    Route::get('/reports/sms-history', [App\Http\Controllers\ReportController::class, 'getSmsHistory']);
    Route::get('business-location/activate-deactivate/{location_id}', [App\Http\Controllers\BusinessLocationController::class, 'activateDeactivateLocation']);

    //Business Location Settings...
    Route::prefix('business-location/{location_id}')->name('location.')->group(function () {
        Route::get('settings', [App\Http\Controllers\LocationSettingsController::class, 'index'])->name('settings');
        Route::post('settings', [App\Http\Controllers\LocationSettingsController::class, 'updateSettings'])->name('settings_update');
    });

    //Business Locations...
    Route::post('business-location/check-location-id', [App\Http\Controllers\BusinessLocationController::class, 'checkLocationId']);
    Route::resource('business-location', App\Http\Controllers\BusinessLocationController::class);

    //Invoice layouts..
    Route::resource('invoice-layouts', App\Http\Controllers\InvoiceLayoutController::class);

    Route::post('get-expense-sub-categories', [App\Http\Controllers\ExpenseCategoryController::class, 'getSubCategories']);

    //Expense Categories...
    Route::resource('expense-categories', App\Http\Controllers\ExpenseCategoryController::class);

    //Expenses...
    Route::resource('expenses', App\Http\Controllers\ExpenseController::class);
    Route::get('import-expense', [ExpenseController::class, 'importExpense']);
    Route::post('store-import-expense', [ExpenseController::class, 'storeExpenseImport']);


    //Transaction payments...
    // Route::get('/payments/opening-balance/{contact_id}', [App\Http\Controllers\TransactionPaymentController::class, 'getOpeningBalancePayments']);
    Route::get('/payments/show-child-payments/{payment_id}', [App\Http\Controllers\TransactionPaymentController::class, 'showChildPayments']);
    Route::get('/payments/view-payment/{payment_id}', [App\Http\Controllers\TransactionPaymentController::class, 'viewPayment']);
    Route::get('/payments/add_payment/{transaction_id}', [App\Http\Controllers\TransactionPaymentController::class, 'addPayment']);
    Route::get('/payments/pay-contact-due/{contact_id}', [App\Http\Controllers\TransactionPaymentController::class, 'getPayContactDue']);
    Route::post('/payments/pay-contact-due', [App\Http\Controllers\TransactionPaymentController::class, 'postPayContactDue']);
    Route::resource('payments', App\Http\Controllers\TransactionPaymentController::class);

    //Printers...
    Route::resource('printers', App\Http\Controllers\PrinterController::class);

    Route::get('/stock-adjustments/remove-expired-stock/{purchase_line_id}', [App\Http\Controllers\StockAdjustmentController::class, 'removeExpiredStock']);
    Route::post('/stock-adjustments/get_product_row', [App\Http\Controllers\StockAdjustmentController::class, 'getProductRow']);
    Route::resource('stock-adjustments', App\Http\Controllers\StockAdjustmentController::class);

    Route::get('/cash-register/register-details', [App\Http\Controllers\CashRegisterController::class, 'getRegisterDetails']);
    Route::get('/cash-register/close-register/{id?}', [App\Http\Controllers\CashRegisterController::class, 'getCloseRegister']);
    Route::post('/cash-register/close-register', [App\Http\Controllers\CashRegisterController::class, 'postCloseRegister']);
    Route::resource('cash-register', App\Http\Controllers\CashRegisterController::class);

    //Import products
    Route::get('/import-products', [App\Http\Controllers\ImportProductsController::class, 'index']);
    Route::post('/import-products/store', [App\Http\Controllers\ImportProductsController::class, 'store']);

    //Sales Commission Agent
    Route::resource('sales-commission-agents', App\Http\Controllers\SalesCommissionAgentController::class);

    //Stock Transfer
    Route::get('stock-transfers/print/{id}', [App\Http\Controllers\StockTransferController::class, 'printInvoice']);
    Route::post('stock-transfers/update-status/{id}', [App\Http\Controllers\StockTransferController::class, 'updateStatus']);
    Route::resource('stock-transfers', App\Http\Controllers\StockTransferController::class);

    Route::get('/opening-stock/add/{product_id}', [App\Http\Controllers\OpeningStockController::class, 'add']);
    Route::post('/opening-stock/save', [App\Http\Controllers\OpeningStockController::class, 'save']);

    //Customer Groups
    Route::resource('customer-group', App\Http\Controllers\CustomerGroupController::class);

    //Import opening stock
    Route::get('/import-opening-stock', [App\Http\Controllers\ImportOpeningStockController::class, 'index']);
    Route::post('/import-opening-stock/store', [App\Http\Controllers\ImportOpeningStockController::class, 'store']);

    //Sell return

    Route::resource('sell-return', App\Http\Controllers\SellReturnController::class);
    Route::get('validate-invoice-to-return/{invoice_no}', [SellReturnController::class, 'validateInvoiceToReturn']);
    Route::get('sell-return/get-product-row', [App\Http\Controllers\SellReturnController::class, 'getProductRow']);
    Route::get('/sell-return/print/{id}', [App\Http\Controllers\SellReturnController::class, 'printInvoice']);
    Route::get('/sell-return/add/{id}', [App\Http\Controllers\SellReturnController::class, 'add']);
    // service staff replacement
    Route::get('validate-invoice-to-service-staff-replacement/{invoice_no}', [SellPosController::class, 'validateInvoiceToServiceStaffReplacement']);
    Route::put('change-service-staff/{id}', [SellPosController::class, 'change_service_staff'])->name('change_service_staff');

    //Backup
    Route::get('backup/download/{file_name}', [BackUpController::class, 'download']);
    Route::get('backup/{id}/delete', [BackUpController::class, 'delete'])->name('delete_backup');
    Route::resource('backup', BackUpController::class)->only('index', 'create', 'store');

    Route::get('update-product-price', [SellingPriceGroupController::class, 'updateProductPrice'])->name('update-product-price');
    Route::get('selling-price-group/activate-deactivate/{id}', [App\Http\Controllers\SellingPriceGroupController::class, 'activateDeactivate']);
       Route::get('export-product-price', [SellingPriceGroupController::class, 'export']);
    Route::post('import-product-price', [SellingPriceGroupController::class, 'import']);
    Route::resource('selling-price-group', App\Http\Controllers\SellingPriceGroupController::class);

    Route::resource('notification-templates', App\Http\Controllers\NotificationTemplateController::class)->only(['index', 'store']);
    Route::get('notification/get-template/{transaction_id}/{template_for}', [App\Http\Controllers\NotificationController::class, 'getTemplate']);
    Route::post('notification/send', [App\Http\Controllers\NotificationController::class, 'send']);

    Route::post('/purchase-return/update', [App\Http\Controllers\CombinedPurchaseReturnController::class, 'update']);
    Route::get('/purchase-return/edit/{id}', [App\Http\Controllers\CombinedPurchaseReturnController::class, 'edit']);
    Route::post('/purchase-return/save', [App\Http\Controllers\CombinedPurchaseReturnController::class, 'save']);
    Route::post('/purchase-return/get_product_row', [App\Http\Controllers\CombinedPurchaseReturnController::class, 'getProductRow']);
    Route::get('/purchase-return/create', [App\Http\Controllers\CombinedPurchaseReturnController::class, 'create']);
    Route::get('/purchase-return/add/{id}', [App\Http\Controllers\PurchaseReturnController::class, 'add']);
    Route::resource('/purchase-return', App\Http\Controllers\PurchaseReturnController::class)->except(['create']);

    Route::get('/discount/activate/{id}', [App\Http\Controllers\DiscountController::class, 'activate']);
    Route::post('/discount/mass-deactivate', [App\Http\Controllers\DiscountController::class, 'massDeactivate']);
    Route::resource('discount', App\Http\Controllers\DiscountController::class);

    //Filters
    Route::get('sells-filter', [App\Http\Controllers\SellController::class, 'filter']);
    Route::get('sells-return-filter', [App\Http\Controllers\SellReturnController::class, 'filter']);
    Route::get('purchase-filter', [App\Http\Controllers\PurchaseController::class, 'filter']);
    Route::get('purchase-order-filter', [App\Http\Controllers\PurchaseOrderController::class, 'filter']);
    Route::get('product-filter', [App\Http\Controllers\ProductController::class, 'filter']);
    Route::get('contact-filter', [App\Http\Controllers\ContactController::class, 'filter']);
    Route::get('expense-filter', [App\Http\Controllers\ExpenseController::class, 'filter']);
    Route::get('report-filter', [App\Http\Controllers\ReportController::class, 'filter']);
    Route::get('account-filter', [App\Http\Controllers\AccountController::class, 'filter']);

    //Invoices
    Route::get('/sells/payments', [App\Http\Controllers\SellController::class, 'getPayments']);
    Route::resource('invoice-notes', App\Http\Controllers\InvoiceNoteController::class)->except(['index', 'update']);
    Route::resource('invoice-reminders', App\Http\Controllers\InvoiceReminderController::class)->only(['create', 'store']);
    Route::post('/sells/mark-as-sent', [App\Http\Controllers\SellController::class, 'markAsSent'])->name('sell.mark_as_sent');
    Route::get('/sells/duplicate-invoice/{id}', [App\Http\Controllers\SellPosController::class, 'duplicateInvoice']);

    Route::group(['prefix' => 'account'], function () {
        Route::resource('/account', App\Http\Controllers\AccountController::class);
        Route::get('/fund-transfer/{id}', [App\Http\Controllers\AccountController::class, 'getFundTransfer']);
        Route::post('/fund-transfer', [App\Http\Controllers\AccountController::class, 'postFundTransfer']);
        Route::get('/deposit/{id}', [App\Http\Controllers\AccountController::class, 'getDeposit']);
        Route::post('/deposit', [App\Http\Controllers\AccountController::class, 'postDeposit']);
        Route::get('/close/{id}', [App\Http\Controllers\AccountController::class, 'close']);
        Route::get('/activate/{id}', [App\Http\Controllers\AccountController::class, 'activate']);
        Route::get('/delete-account-transaction/{id}', [App\Http\Controllers\AccountController::class, 'destroyAccountTransaction']);
        Route::get('/edit-account-transaction/{id}', [App\Http\Controllers\AccountController::class, 'editAccountTransaction']);
        Route::post('/update-account-transaction/{id}', [App\Http\Controllers\AccountController::class, 'updateAccountTransaction']);
        Route::get('/get-account-balance/{id}', [App\Http\Controllers\AccountController::class, 'getAccountBalance']);
        Route::get('/balance-sheet', [App\Http\Controllers\AccountReportsController::class, 'balanceSheet']);
        Route::get('/trial-balance', [App\Http\Controllers\AccountReportsController::class, 'trialBalance']);
        Route::get('/payment-account-report', [App\Http\Controllers\AccountReportsController::class, 'paymentAccountReport']);
        Route::get('/link-account/{id}', [App\Http\Controllers\AccountReportsController::class, 'getLinkAccount']);
        Route::post('/link-account', [App\Http\Controllers\AccountReportsController::class, 'postLinkAccount']);
        Route::get('/cash-flow', [App\Http\Controllers\AccountController::class, 'cashFlow']);
    });

    Route::resource('account-types', App\Http\Controllers\AccountTypeController::class);

    //Restaurant module
    Route::group(['prefix' => 'modules'], function () {
        Route::resource('tables', App\Http\Controllers\Restaurant\TableController::class);
        Route::resource('modifiers', App\Http\Controllers\Restaurant\ModifierSetsController::class);

        //Map modifier to products
        Route::get('/product-modifiers/{id}/edit', [App\Http\Controllers\Restaurant\ProductModifierSetController::class, 'edit']);
        Route::post('/product-modifiers/{id}/update', [App\Http\Controllers\Restaurant\ProductModifierSetController::class, 'update']);
        Route::get('/product-modifiers/product-row/{product_id}', [App\Http\Controllers\Restaurant\ProductModifierSetController::class, 'product_row']);

        Route::get('/add-selected-modifiers', [App\Http\Controllers\Restaurant\ProductModifierSetController::class, 'add_selected_modifiers']);

        Route::get('/kitchen', [App\Http\Controllers\Restaurant\KitchenController::class, 'index']);
        Route::get('/kitchen/mark-as-cooked/{id}', [App\Http\Controllers\Restaurant\KitchenController::class, 'markAsCooked']);
        Route::post('/refresh-orders-list', [App\Http\Controllers\Restaurant\KitchenController::class, 'refreshOrdersList']);
        Route::post('/refresh-line-orders-list', [App\Http\Controllers\Restaurant\KitchenController::class, 'refreshLineOrdersList']);

        Route::get('/orders', [App\Http\Controllers\Restaurant\OrderController::class, 'index']);
        Route::get('/orders/mark-as-served/{id}', [App\Http\Controllers\Restaurant\OrderController::class, 'markAsServed']);
        Route::get('/data/get-pos-details', [App\Http\Controllers\Restaurant\DataController::class, 'getPosDetails']);
        Route::get('/orders/mark-line-order-as-served/{id}', [App\Http\Controllers\Restaurant\OrderController::class, 'markLineOrderAsServed']);
        Route::get('/print-line-order', [App\Http\Controllers\Restaurant\OrderController::class, 'printLineOrder']);
    });

    Route::get('bookings/get-todays-bookings', [App\Http\Controllers\Restaurant\BookingController::class, 'getTodaysBookings']);
    Route::resource('bookings', App\Http\Controllers\Restaurant\BookingController::class);

    Route::resource('types-of-service', App\Http\Controllers\TypesOfServiceController::class);
    Route::get('sells/edit-shipping/{id}', [App\Http\Controllers\SellController::class, 'editShipping']);
    Route::put('sells/update-shipping/{id}', [App\Http\Controllers\SellController::class, 'updateShipping']);
    Route::get('shipments', [App\Http\Controllers\SellController::class, 'shipments']);

    Route::resource('warranties', App\Http\Controllers\WarrantyController::class);
    Route::resource('dashboard-configurator', App\Http\Controllers\DashboardConfiguratorController::class)->only(['edit', 'update']);
    Route::get('view-media/{model_id}', [App\Http\Controllers\SellController::class, 'viewMedia']);

    //common controller for document & note
    Route::get('get-document-note-page', [App\Http\Controllers\DocumentAndNoteController::class, 'getDocAndNoteIndexPage']);
    Route::post('post-document-upload', [App\Http\Controllers\DocumentAndNoteController::class, 'postMedia']);
    Route::resource('note-documents', App\Http\Controllers\DocumentAndNoteController::class);
    Route::resource('purchase-order', App\Http\Controllers\PurchaseOrderController::class);
    Route::get('get-purchase-orders/{contact_id}', [App\Http\Controllers\PurchaseOrderController::class, 'getPurchaseOrders']);
    Route::get('get-purchase-order-lines/{purchase_order_id}', [App\Http\Controllers\PurchaseController::class, 'getPurchaseOrderLines']);
    Route::get('edit-purchase-orders/{id}/status', [App\Http\Controllers\PurchaseOrderController::class, 'getEditPurchaseOrderStatus']);
    Route::put('update-purchase-orders/{id}/status', [App\Http\Controllers\PurchaseOrderController::class, 'postEditPurchaseOrderStatus']);
    Route::resource('sales-order', App\Http\Controllers\SalesOrderController::class)->only(['index']);
    Route::get('get-sales-orders/{customer_id}', [App\Http\Controllers\SalesOrderController::class, 'getSalesOrders']);
    Route::get('get-sales-order-lines', [App\Http\Controllers\SellPosController::class, 'getSalesOrderLines']);
    Route::get('edit-sales-orders/{id}/status', [App\Http\Controllers\SalesOrderController::class, 'getEditSalesOrderStatus']);
    Route::put('update-sales-orders/{id}/status', [App\Http\Controllers\SalesOrderController::class, 'postEditSalesOrderStatus']);
    Route::get('reports/activity-log', [App\Http\Controllers\ReportController::class, 'activityLog']);
    Route::get('user-location/{latlng}', [App\Http\Controllers\HomeController::class, 'getUserLocation']);
});

Route::middleware(['setData', 'auth', 'SetSessionData', 'language', 'timezone'])->group(function () {
    Route::get('/load-more-notifications', [App\Http\Controllers\HomeController::class, 'loadMoreNotifications']);
    Route::get('/get-total-unread', [App\Http\Controllers\HomeController::class, 'getTotalUnreadNotifications']);
    Route::get('/purchases/print/{id}', [App\Http\Controllers\PurchaseController::class, 'printInvoice']);
    Route::get('/purchases/{id}', [App\Http\Controllers\PurchaseController::class, 'show']);
    Route::get('/download-purchase-order/{id}/pdf', [App\Http\Controllers\PurchaseOrderController::class, 'downloadPdf'])->name('purchaseOrder.downloadPdf');
    Route::get('/sells/{id}', [App\Http\Controllers\SellController::class, 'show']);
    Route::get('/sells/{transaction_id}/print', [App\Http\Controllers\SellPosController::class, 'printInvoice'])->name('sell.printInvoice');
    Route::get('/download-sells/{transaction_id}/pdf', [App\Http\Controllers\SellPosController::class, 'downloadPdf'])->name('sell.downloadPdf');
    Route::get('/download-quotation/{id}/pdf', [App\Http\Controllers\SellPosController::class, 'downloadQuotationPdf'])->name('quotation.downloadPdf');
    Route::get('/download-packing-list/{id}/pdf', [App\Http\Controllers\SellPosController::class, 'downloadPackingListPdf'])->name('packing.downloadPdf');
    Route::get('/sells/invoice-url/{id}', [App\Http\Controllers\SellPosController::class, 'showInvoiceUrl']);
    Route::get('/show-notification/{id}', [App\Http\Controllers\HomeController::class, 'showNotification']);
    
   

//POS 2.1 routes:
    //Route::get('pos/payment/{id}', [SellPosController::class, 'edit'])->name('edit-pos-payment');
    //Modules:
    // Route::resource('advance-payments', [App\Http\Controllers\AdvancePaymentController::class]);
    // Route::get('/get-advance-payments', [App\Http\Controllers\AdvancePaymentController::class, 'getAdvancePayments']);
    // route::get('/advance-payments/{id}/print', [App\Http\Controllers\AdvancePaymentController::class, 'print'])->name('advance_payments.print');

    // // NEW ROUTES
    // Route::post('/subscription/pay-now', [SubscriptionController::class, 'payNow']);
    // Route::post('/subscription/confirm-payment', [SubscriptionController::class, 'confirmPayment'])->name('payment.confirm');
    // NEW ROUTES
});

//common route
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});


// // RENEW ROUTES
// Route::prefix('utility')->group(function () {
//     Route::get('/payment-form/{transactionId}', [App\Http\Controllers\Utility\PaymentController::class, 'showPaymentForm'])->name('utility.payment.show-form');
//     Route::post('/confirm-payment', [App\Http\Controllers\Utility\PaymentController::class, 'confirmPayment']);
//     Route::get('/fetch-account/{transactionId}/{amount}/{description?}', [App\Http\Controllers\Utility\PaymentController::class, 'createInvoice'])->name('utility.payment.fetch-account');
//     Route::get('/ajax-fund-check/{ref}', [App\Http\Controllers\Utility\PaymentController::class, 'ajaxCheckFund'])->name('utility.payment.ajax-fund-check');

//     Route::get('/readme', function(){
//         return Illuminate\Mail\Markdown::parse(file_get_contents(base_path() . '/resources/views/payment/README.md'));
//     });
// });
// // RENEW ROUTES


// PRODUCT LINK ROUTE
// Route::get('/product-buy/{product_id}', [App\Http\Controllers\ProductBuyController::class, 'view'])->name('product-buy');
// Route::post('/product-buy-confirm', [App\Http\Controllers\ProductBuyController::class, 'viewDetails'])->name('product-buy-confirm');
// Route::post('/product-buy-pay', [App\Http\Controllers\ProductBuyController::class, 'payNow'])->name('product-buy-pay');
// Route::any('/product-buy-details', [App\Http\Controllers\ProductBuyController::class, 'payDetails'])->name('product-buy-details');
// PRODUCT LINK ROUTE
//,'middleware' => ['listedip']
//Route::group(['prefix' => 'api'], function () {
    //Route::post('/agent-business-onbording', [App\Http\Controllers\AgentOnboardingController::class, 'OnboardAgent']);

    /***
     * Onbording Partners Route
     **/
    // Route::get('/partners-packages', [App\Http\Controllers\PartnerOnboardingController::class, 'getPackage']);
    // Route::get('/partners-business-ids', [App\Http\Controllers\PartnerOnboardingController::class, 'getBusinessByPartnerId']);
    // Route::get('/partners-inactive-business/{partner_id}', [App\Http\Controllers\PartnerOnboardingController::class, 'GetInactiveBusiness']);
    // Route::get('/partners-renewal-business/{partner_id}', [App\Http\Controllers\PartnerOnboardingController::class, 'UpComingRenewal']);
    // Route::get('/partners-topranking-business/{partner_id}', [App\Http\Controllers\PartnerOnboardingController::class, 'getTopRankingBusiness']);
    // Route::post('/verify-username', [App\Http\Controllers\PartnerOnboardingController::class, 'usernameVerification']);
    // Route::post('/partners-create-business', [App\Http\Controllers\PartnerOnboardingController::class, 'createBusinessAndPackage']);
    // Route::post('/partners-update-business-package', [App\Http\Controllers\PartnerOnboardingController::class, 'updatePackage']);
    // Route::post('/partners-update-business-packagemeta', [App\Http\Controllers\PartnerOnboardingController::class, 'customisePackage']);

    /*****
    Admin Subscription Route

     *****/

    // Route::get('/admin-packages', [App\Http\Controllers\AdminSubscriptionController::class, 'adminGetPackage']);
    // Route::post('/admin-update-business-package', [App\Http\Controllers\AdminSubscriptionController::class, 'adminUpdatePackage']);

//});

/***
 * Customer Review
 **/
// Route::get('review/{business_id}/{link}', [App\Http\Controllers\AgentReviewController::class, 'Reviews'])->name('review_link');
// Route::post('review/store/{business_id}', [App\Http\Controllers\AgentReviewController::class, 'StoreReview'])->name('store_review');

//Auth::routes(['verify' => true]);
// Route::middleware(['EcomApi'])->prefix('api/ecom')->group(function () {
//     Route::get('products/{id?}', [App\Http\Controllers\ProductController::class, 'getProductsApi']);
//     Route::get('categories', [App\Http\Controllers\CategoryController::class, 'getCategoriesApi']);
//     Route::get('brands', [App\Http\Controllers\BrandController::class, 'getBrandsApi']);
//     Route::post('customers', [App\Http\Controllers\ContactController::class, 'postCustomersApi']);
//     Route::get('settings', [App\Http\Controllers\BusinessController::class, 'getEcomSettings']);
//     Route::get('variations', [App\Http\Controllers\ProductController::class, 'getVariationsApi']);
//     Route::post('orders', [App\Http\Controllers\SellPosController::class, 'placeOrdersApi']);
// });
