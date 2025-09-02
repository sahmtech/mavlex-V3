<?php
namespace App\Providers;

use App\Models\AppSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class StorageSettingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        try {
            if (!Schema::hasTable((new AppSetting)->getTable())) {
                return;
            }
            
            $settings = AppSetting::query()->first();

            if (!$settings) {
                return;
            }

            $dbDisks = (array) $settings->storage_disks ?? [];
            if (!empty($dbDisks)) {
                $merged = array_replace(config('filesystems.disks', []), $dbDisks);
                Config::set('filesystems.disks', $merged);
            }

            if (!empty($settings->storage_default_disk)) {
                Config::set('filesystems.default', $settings->storage_default_disk);
            }
        } catch (\Exception $e) {
            return;
        }
    }
}