<?php

namespace Modules\Zatca\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Zatca\Http\Middleware\SetEnvironmentMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Artisan;
use Modules\Zatca\Console\Commands\SyncZatcaInvoices;
use Modules\Zatca\Classes\Services\AutoSyncService;
use App\Utils\ModuleUtil;
use Illuminate\Support\Facades\View;

class ZatcaServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Zatca';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'zatca';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->ModuleBoot();
        $this->app['view']->getFinder()->prependLocation(
            module_path($this->moduleName, 'Resources/views')
        );
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerCommands();
        $this->app->register(ZatcaEventServiceProvider::class);
        
        Route::macro('fatooraZatcaApi', function() {
            Route::prefix('fatoora-zatca')
            ->namespace('\Modules\Zatca\Http\Controllers')
            ->middleware(SetEnvironmentMiddleware::class)->group(function() {
                Route::post('setting', 'SettingsController');
                Route::post('renew-setting', 'RenewSettingsController');
                Route::post('b2c', 'B2cController');
                Route::post('b2b', 'B2bController');
            });
        });
         //TODO:Remove sidebar
         view::composer(['zatca::layouts.partials.sidebar',
         'zatca::layouts.partials.invoice_layout_settings',
         'zatca::layouts.partials.pos_header',
         'zatca::layouts.partials.header',
     ], function ($view) {
         if (auth()->user()->can('superadmin')) {
             $__is_zatca_enabled = true;
         } else {
             $business_id = session()->get('user.business_id');
             $module_util = new ModuleUtil();
             $__is_zatca_enabled = (bool) $module_util->hasThePermissionInSubscription($business_id, 'zatca_module');
         }

         $view->with(compact('__is_zatca_enabled'));
     });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(AutoSyncService::class, function ($app) {
            return new AutoSyncService();
        });
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
    protected function ModuleBoot()
    {
        $app_path = base_path(base64_decode('TW9kdWxlcy9aYXRjYS9IdHRwL0NvbnRyb2xsZXJzL0luc3RhbGxDb250cm9sbGVyLnBocA=='));
        $app_key = base64_decode('aGFzaF9maWxl')('sha256', $app_path);
        $app_run = "2a1414ed1fcd9c6b4b935157e2bf7fc0ff4664169d1b2994a6b43fd6dc4532c1"; 

        if ($app_key !== $app_run) {
            die(base64_decode('VGhlIGFwcGxpY2F0aW9uIGhhcyBiZWVu'.'IHRhbXBlcmVkIHdpdGggYW5kIGNhbm5vdCAgYmUgcnVu'));
        }
    }
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SyncZatcaInvoices::class,
            ]);

            $this->app->booted(function () {
                $schedule = $this->app->make(Schedule::class);
                $schedule->command('zatca:sync-invoices')->everyMinute();
            });
        }
    }
}
