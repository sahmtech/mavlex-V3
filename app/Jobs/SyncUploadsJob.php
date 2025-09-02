<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


class SyncUploadsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 0;
    public int $tries = 1;

    public function __construct(
        public string $id,
        public string $fromDisk,
        public string $toDisk,
        public array $onlyFolders = [],
        public bool $deleteSource = false,
        public ?string $visibility = null, // null|public|private
        public bool $dryRun = false,
        public bool $verbose = false
    ) {}

    public function handle(): void
    {
        $key = "uploads_sync:{$this->id}";

        $update = function (array $patch) use ($key) {
            $curr = Cache::get($key, []);
            $next = array_merge($curr, $patch);
            Cache::put($key, $next, now()->addHours(2));
        };

        try {
            $all = Storage::disk($this->fromDisk)->allFiles('');

            if ($this->onlyFolders) {
                $prefixes = array_map(fn($p) => rtrim($p, '/') . '/', $this->onlyFolders);
                $files = array_values(array_filter($all, function ($path) use ($prefixes) {
                    foreach ($prefixes as $pre) {
                        if (str_starts_with($path, $pre)) return true;
                    }
                    return false;
                }));
            } else {
                $files = $all;
            }

            $total = count($files);
            $update(['total' => $total, 'message' => "Found {$total} files…"]);

            $copied = $skipped = $deleted = $failed = 0;

            foreach ($files as $srcKey) {
                $dstKey = $srcKey;

                try {
                    if (Storage::disk($this->toDisk)->exists($dstKey)) {
                        $skipped++;
                        $update(['copied' => $copied, 'skipped' => $skipped, 'deleted' => $deleted, 'failed' => $failed, 'message' => "Skipping {$dstKey} (exists)"]);
                        continue;
                    }

                    if ($this->dryRun) {
                        $copied++;
                        $update(['copied' => $copied, 'message' => "Would copy {$srcKey}"]);
                        continue;
                    }

                    $read = Storage::disk($this->fromDisk)->readStream($srcKey);
                    if (!$read) {
                        $failed++;
                        $update(['failed' => $failed, 'message' => "Read failed: {$srcKey}"]);
                        continue;
                    }

                    $opts = [];
                    if ($this->visibility && in_array($this->visibility, ['public', 'private'], true)) {
                        $opts['visibility'] = $this->visibility;
                    }

                    $ok = Storage::disk($this->toDisk)->put($dstKey, $read, $opts);
                    if (is_resource($read)) fclose($read);

                    if (!$ok) {
                        $failed++;
                        $update(['failed' => $failed, 'message' => "Write failed: {$dstKey}"]);
                        continue;
                    }

                    $copied++;
                    $update(['copied' => $copied, 'message' => "Copied {$srcKey}"]);

                    if ($this->deleteSource) {
                        try {
                            Storage::disk($this->fromDisk)->delete($srcKey);
                            $deleted++;
                            $update(['deleted' => $deleted, 'message' => "Deleted source {$srcKey}"]);
                        } catch (\Throwable $e) {
                            // ignore delete errors
                        }
                    }
                } catch (\Throwable $e) {
                    $failed++;
                    $update(['failed' => $failed, 'message' => "Error: {$e->getMessage()}"]);
                }
            }

            $update(['done' => true, 'message' => "Done. Copied {$copied}, skipped {$skipped}, deleted {$deleted}, failed {$failed}."]);
        } catch (\Throwable $e) {
            $update(['done' => true, 'message' => "Aborted: {$e->getMessage()}"]);
        }
    }
}
