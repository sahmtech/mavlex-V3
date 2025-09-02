<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Uploads
{
    protected static function cfg(string $bucket): array
    {
        $cfg = config("uploads.$bucket");
        if (!$cfg) {
            throw new \InvalidArgumentException("Unknown upload bucket [$bucket]");
        }
        return $cfg;
    }

    protected static function objectKey(string $bucket, string $file): string
    {
        $cfg    = self::cfg($bucket);
        $prefix = trim($cfg['prefix'] ?? '', '/');
        $path   = ltrim($file, '/');

        if ($prefix !== '' && !Str::startsWith($path, $prefix . '/')) {
            $path = $prefix . '/' . $path;
        }
        return $path;
    }

    public static function url(string $bucket, ?string $file): ?string
    {
        if (!$file) return null;

        $cfg  = self::cfg($bucket);
        $app  = app(\App\Services\AppSettingsService::class);
        $disk = ($cfg['disk'] ?? 'auto') === 'auto' ? ($app->storage_default_disk() ?: config('filesystems.default')) : $cfg['disk'];
        $diskCfg   = $app->storage_disk($disk);
        $driver    = config("filesystems.disks.$disk.driver", 'local');
        $key       = self::objectKey($bucket, $file);
        $bucketSigned = $cfg['signed_urls'] ?? null;
        $signed = is_bool($bucketSigned) ? $bucketSigned : (bool) data_get($diskCfg, 'signed_urls', false);
        $ttlMin = (int) ($cfg['signed_ttl'] ?? data_get($diskCfg, 'signed_ttl', 10));

        if ($driver !== 's3') {
            return Storage::disk($disk)->url($key);
        }

        if ($signed) {
            return Storage::disk($disk)->temporaryUrl($key, now()->addMinutes($ttlMin));
        }
        return Storage::disk($disk)->url($key);
    }
}
