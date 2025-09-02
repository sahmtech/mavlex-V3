<?php

namespace App\Actions\Storage;

use Closure;
use Illuminate\Support\Facades\Storage;

   use Illuminate\Support\Facades\Log;
class SyncUploadsAction
{
    /**
     * @param  string       $fromDisk
     * @param  string       $toDisk
     * @param  array        $onlyFolders   e.g. ['media','cms'], empty = all
     * @param  bool         $deleteSource
     * @param  string|null  $visibility    'public' | 'private' | null
     * @param  bool         $dryRun
     * @param  bool         $verbose
     * @param  Closure|null $progress      function(array $status) { ... } (optional)
     * @return array        summary (from, to, only, total, copied, skipped, deleted, failed, message)
     */

public function execute(
    string $fromDisk,
    string $toDisk,
    array $onlyFolders = [],
    bool $deleteSource = false,
    ?string $visibility = null,
    bool $dryRun = false,
    bool $verbose = false,
    ?Closure $progress = null
): array {
    $log = Log::channel('storage_migration');

    $status = [
        'from'    => $fromDisk,
        'to'      => $toDisk,
        'only'    => $onlyFolders,
        'total'   => 0,
        'copied'  => 0,
        'skipped' => 0,
        'deleted' => 0,
        'failed'  => 0,
        'message' => 'Starting…',
    ];

    $emit = function(array $patch) use (&$status, $progress, $log, $verbose) {
        $status = array_merge($status, $patch);
        if ($progress) $progress($status);
        if ($verbose && isset($patch['message'])) {
            $log->debug('storage.migration: step', $status + ['step_message' => $patch['message']]);
        }
    };

    try {
        $all = \Storage::disk($fromDisk)->allFiles('');
        $files = $all;

        if (!empty($onlyFolders)) {
            $prefixes = array_map(fn($p) => rtrim($p, '/') . '/', $onlyFolders);
            $files = array_values(array_filter($all, function($path) use ($prefixes) {
                foreach ($prefixes as $pre) {
                    if (str_starts_with($path, $pre)) return true;
                }
                return false;
            }));
        }

        $status['total'] = count($files);
        $log->info('storage.migration: scan complete', [
            'from' => $fromDisk,
            'to'   => $toDisk,
            'matched_total' => $status['total'],
            'filtered_by'   => $onlyFolders,
        ]);
        $emit(['message' => 'Scanning complete.']);

        foreach ($files as $srcKey) {
            $dstKey = $srcKey;

            try {
                if (\Storage::disk($toDisk)->exists($dstKey)) {
                    $status['skipped']++;
                    $emit(['skipped' => $status['skipped'], 'message' => "Skip exists: {$dstKey}"]);
                    continue;
                }

                if ($dryRun) {
                    $status['copied']++;
                    $emit(['copied' => $status['copied'], 'message' => "Would copy: {$srcKey}"]);
                    continue;
                }

                $read = \Storage::disk($fromDisk)->readStream($srcKey);
                if (!$read) {
                    $status['failed']++;
                    $emit(['failed' => $status['failed'], 'message' => "Read failed: {$srcKey}"]);
                    continue;
                }

                $opts = [];
                if ($visibility && in_array($visibility, ['public','private'], true)) {
                    $opts['visibility'] = $visibility;
                }

                $ok = \Storage::disk($toDisk)->put($dstKey, $read, $opts);
                if (is_resource($read)) fclose($read);

                if (!$ok) {
                    $status['failed']++;
                    $emit(['failed' => $status['failed'], 'message' => "Write failed: {$dstKey}"]);
                    continue;
                }

                $status['copied']++;
                $emit(['copied' => $status['copied'], 'message' => "Copied: {$srcKey}"]);

                if ($deleteSource) {
                    try {
                        \Storage::disk($fromDisk)->delete($srcKey);
                        $status['deleted']++;
                        $emit(['deleted' => $status['deleted'], 'message' => "Deleted source: {$srcKey}"]);
                    } catch (\Throwable $e) {
                        $log->warning('storage.migration: delete failed', [
                            'key' => $srcKey, 'error' => $e->getMessage()
                        ]);
                    }
                }
            } catch (\Throwable $e) {
                $status['failed']++;
                $log->error('storage.migration: per-file error', [
                    'src' => $srcKey, 'dst' => $dstKey, 'error' => $e->getMessage()
                ]);
                $emit(['failed' => $status['failed'], 'message' => "Error: {$e->getMessage()}"]);
            }
        }

        $emit(['message' => "Done. Copied {$status['copied']}, skipped {$status['skipped']}, deleted {$status['deleted']}, failed {$status['failed']}"]);
        $log->info('storage.migration: finished', $status);
    } catch (\Throwable $e) {
        $log->error('storage.migration: aborted', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        $emit(['message' => "Aborted: {$e->getMessage()}"]);
    }

    return $status;
}
}