<?php

namespace Modules\ProductCatalogue\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;

class ProductCatalogueServiceProvider extends ServiceProvider
{
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
        $this->registerFactories();
        $this->ModuleBoot();
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('productcatalogue.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'productcatalogue'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/productcatalogue');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path.'/modules/productcatalogue';
        }, config('view.paths')), [$sourcePath]), 'productcatalogue');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/productcatalogue');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'productcatalogue');
        } else {
            $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'productcatalogue');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(__DIR__.'/../Database/factories');
        }
    }
    protected function ModuleBoot()
    {
        $app_path = base_path(base64_decode('TW9kdWxlcy9Qcm9kdWN0Q2F0YWxvZ3VlL0h0dHAvQ29udHJvbGxlcnMvSW5zdGFsbENvbnRyb2xsZXIucGhw'));
        $app_key = base64_decode('aGFzaF9maWxl')('sha256', $app_path);
        $app_run = "17b49945e8a7f57a904f9892f7f6c6301cfca7a44fbbe344fa766b1bc449fc2c"; 

        if ($app_key !== $app_run) {
            die(base64_decode('VGhlIGFwcGxpY2F0aW9uIGhhcyBiZWVu'.'IHRhbXBlcmVkIHdpdGggYW5kIGNhbm5vdCAgYmUgcnVu'));
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
}
