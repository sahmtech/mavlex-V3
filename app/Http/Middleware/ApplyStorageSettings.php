<?php
namespace App\Http\Middleware;

use App\Services\AppSettingsService;
use Closure;
use Illuminate\Http\Request;

class ApplyStorageSettings
{
    public function __construct(private AppSettingsService $svc) {}

    public function handle(Request $request, Closure $next, ...$disks)
    {
        $this->svc->apply_storage_config(true);
       
        return $next($request);
    }
}
