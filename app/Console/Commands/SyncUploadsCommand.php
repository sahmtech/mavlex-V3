<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FilesystemException;

class SyncUploadsCommand extends Command
{
    protected $signature = 'bardpos:uploads:sync
        {direction : push (local->external) or pull (external->local)}
        {--from= : Source disk (default: local for push, default: current filesystems.default for pull)}
        {--to= : Destination disk (default: current filesystems.default for push, default: local for pull)}
        {--only= : Comma-separated subfolders to include (e.g. media,cms,business_logos). Omit = all under root}
        {--delete : Delete source object after successful copy}
        {--visibility= : public|private (set dest object ACL; omit to rely on bucket policy/signed URLs)}
        {--chunk=500 : Progress update interval (number of files processed per step)}
        {--dry-run : Plan only, don’t copy or delete}
        {--verbose : Print each copied/skipped path}';

    protected $description = 'Rsync-like sync of uploads between disks, both directions, without duplication.';

    public function handle(): int
    {
        $direction = strtolower($this->argument('direction'));
        if (!in_array($direction, ['push', 'pull'], true)) {
            $this->error('direction must be "push" (local->external) or "pull" (external->local)');
            return self::FAILURE;
        }

        $defaultExternal = config('filesystems.default');
        $from = $this->option('from') ?: ($direction === 'push' ? 'local' : $defaultExternal);
        $to   = $this->option('to')   ?: ($direction === 'push' ? $defaultExternal : 'local');

        if ($from === $to) {
            $this->error('Source and destination disks must differ.');
            return self::FAILURE;
        }

        $only = $this->option('only');
        $prefixes = [];
        if ($only) {
            $prefixes = array_values(array_filter(array_map(function ($p) {
                $p = trim($p);
                return $p === '' ? null : rtrim($p, '/') . '/';
            }, explode(',', $only))));
        }

        $delete     = (bool) $this->option('delete');
        $visibility = $this->option('visibility');
        if ($visibility && !in_array($visibility, ['public', 'private'], true)) {
            $this->error('--visibility must be public or private if provided.');
            return self::FAILURE;
        }

        $dry   = (bool) $this->option('dry-run');
        $vrb   = (bool) $this->option('verbose');
        $chunk = (int)  $this->option('chunk');

        $this->info("Sync uploads: {$from} -> {$to}" . ($dry ? ' (dry-run)' : ''));
        if ($prefixes) {
            $this->info('Only folders: ' . implode(', ', array_map(fn($p) => rtrim($p, '/'), $prefixes)));
        }

        $this->line('Scanning source file list…');
        try {
            $all = Storage::disk($from)->allFiles(''); // recursive from root
        } catch (\Throwable $e) {
            $this->error("Listing source files failed: " . $e->getMessage());
            return self::FAILURE;
        }

        if ($prefixes) {
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
        if ($total === 0) {
            $this->info('Nothing to sync.');
            return self::SUCCESS;
        }

        $bar = $this->output->createProgressBar($total);
        $bar->setFormat('verbose');
        $bar->start();

        $copied = 0;
        $skipped = 0;
        $deleted = 0;
        $failed = 0;

        foreach ($files as $i => $srcKey) {
            $dstKey = $srcKey;

            try {
                if (Storage::disk($to)->exists($dstKey)) {
                    $skipped++;
                    if ($vrb) $this->line("SKIP  {$dstKey}");
                } else {
                    if ($dry) {
                        $copied++;
                        if ($vrb) $this->line("WOULD COPY  {$srcKey} -> {$dstKey}");
                    } else {
                        $read = Storage::disk($from)->readStream($srcKey);
                        if (!$read) {
                            $failed++;
                            if ($vrb) $this->warn("READ FAIL  {$srcKey}");
                        } else {
                            $opts = [];
                            if ($visibility) $opts['visibility'] = $visibility;

                            $ok = Storage::disk($to)->put($dstKey, $read, $opts);
                            if (is_resource($read)) fclose($read);

                            if ($ok) {
                                $copied++;
                                if ($vrb) $this->line("COPY  {$srcKey} -> {$dstKey}");

                                if ($delete) {
                                    try {
                                        Storage::disk($from)->delete($srcKey);
                                        $deleted++;
                                        if ($vrb) $this->line("DEL   {$srcKey}");
                                    } catch (\Throwable $eDel) {
                                        if ($vrb) $this->warn("DEL FAIL {$srcKey}  ({$eDel->getMessage()})");
                                    }
                                }
                            } else {
                                $failed++;
                                if ($vrb) $this->warn("WRITE FAIL {$dstKey}");
                            }
                        }
                    }
                }
            } catch (FilesystemException|\Throwable $e) {
                $failed++;
                if ($vrb) $this->warn("ERROR {$srcKey}: " . $e->getMessage());
            }

            $bar->advance();

            if ($chunk > 0 && ($i + 1) % $chunk === 0) {
                $this->output->write("\n");
            }
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Summary: total={$total}, copied={$copied}, skipped={$skipped}, deleted={$deleted}, failed={$failed}");
        if ($failed > 0) {
            $this->warn('Some items failed. You can safely re-run; existing destination files will be skipped.');
        }

        return self::SUCCESS;
    }
}
