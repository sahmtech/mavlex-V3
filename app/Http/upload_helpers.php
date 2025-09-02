<?php

use App\Services\Uploads;

if (! function_exists('upload_asset')) {
    function upload_asset(string $path): string
    {
        if ($path === '') return $path;

        if (preg_match('~^https?://~i', $path)) {
            return $path;
        }

        $path = ltrim(str_replace('\\', '/', $path), '/'); 
        if (! str_starts_with($path, 'uploads/')) {
            return asset($path);
        }

        $rest  = substr($path, strlen('uploads/'));  
        $first = strtok($rest, '/');                 
        $file  = ltrim(substr($rest, strlen($first)), '/'); 

        static $map = null;
        if ($map === null) {
            $map = collect((array) config('uploads', []))
                ->mapWithKeys(fn ($cfg, $bucket) => [trim($cfg['prefix'] ?? '', '/') => $bucket])
                ->all();
        }

        $bucket = $map[$first] ?? null;
        if (! $bucket) {
            return asset($path);
        }

        return Uploads::url($bucket, $file) ?: asset($path);
    }
}
