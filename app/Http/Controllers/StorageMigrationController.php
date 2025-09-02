<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Jobs\SyncUploadsJob;
use App\Services\AppSettingsService;
use App\Actions\Storage\SyncUploadsAction;
use App\Utils\ModuleUtil;

class StorageMigrationController extends Controller
{
     protected $moduleUtil;
    
    public function __construct(ModuleUtil $moduleUtil)
    {
        $this->moduleUtil = $moduleUtil;
    }

    public function index(\App\Services\AppSettingsService $svc)
    {
         if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        $svc->apply_storage_config(true);

        $labels = (array) config('bardpos_storage.labels');
        if (empty($labels)) {
            $labels = [
                'local'   => 'local',
                's3'      => 'AWS S3',
                'wasabi'  => 'Wasabi',
                'r2'      => 'Cloudflare R2',
                'spaces'  => 'DigitalOcean Spaces',
                'minio'   => 'MinIO',
                'b2'      => 'Backblaze B2',
                'linode'  => 'Akamai/Linode',
                'vultr'   => 'Vultr',
                'idrive'  => 'IDrive e2',
                'ovh'     => 'OVHcloud',
                'scaleway' => 'Scaleway',
                'hetzner' => 'Hetzner',
                'exoscale' => 'Exoscale',
                'upcloud' => 'UpCloud',
                'ionos'   => 'IONOS',
                'dreamobjects' => 'DreamObjects',
                'yandex'  => 'Yandex Cloud',
                'selectel' => 'Selectel',
                'lyve'    => 'Seagate Lyve Cloud',
                'contabo' => 'Contabo',
                'custom'  => 'Custom (S3‑compatible)',
            ];
        }

        uksort($labels, function ($a, $b) use ($labels) {
            if ($a === 'local') return -1;
            if ($b === 'local') return 1;
            return strcasecmp($labels[$a], $labels[$b]);
        });

        $disks = array_keys($labels);

        try {
            $local_folders = collect(Storage::disk('local')->directories(''))
                ->map(fn($d) => trim($d, '/'))
                ->filter()
                ->values()
                ->all();
            if (empty($local_folders)) {
                $local_folders = [
                    'media',
                    'cms',
                    'business_logos',
                    'app_logos',
                    'BardPOS',
                    'bg_images',
                    'carousel_images',
                    'documents',
                    'img',
                    'invoice_logos',
                    'temp',
                ];
            }
        } catch (\Throwable $e) {
            $local_folders = [
                'media',
                'cms',
                'business_logos',
                'app_logos',
                'BardPOS',
                'bg_images',
                'carousel_images',
                'documents',
                'img',
                'invoice_logos',
                'temp',
            ];
        }

        $default_external = config('filesystems.default', 'local');

        return view('app_settings.storage_migration', [
            'disks'           => $disks,
            'disk_options'     => $labels,
            'local_folders'    => $local_folders,
            'default_external' => $default_external,
        ]);
    }


    public function run(Request $request, AppSettingsService $svc)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        $notAllowed = $this->moduleUtil->notAllowedInDemo();
            if (!empty($notAllowed)) {
                return $notAllowed;
            }
        $svc->apply_storage_config(true);

        $data = $request->validate([
            'direction'   => 'required|in:push,pull',
            'folders'     => 'array',
            'folders.*'   => 'string',
            'only'        => 'nullable|string',
            'visibility'  => 'nullable|in:public,private',
            'delete'      => 'sometimes|boolean',
            'dry_run'     => 'sometimes|boolean',
            'verbose'     => 'sometimes|boolean',
            'run_mode'    => 'nullable|in:job,direct',
            'from' => 'required|string|different:to',
            'to'   => 'required|string|different:from',

        ]);

        $direction = $data['direction'];
        $default_external = config('filesystems.default', 'local');

        $from = $data['from'] ?: ($direction === 'push' ? 'local' : $default_external);
        $to   = $data['to']   ?: ($direction === 'push' ? $default_external : 'local');

        if ($from === $to) {
            return response()->json(['ok' => false, 'error' => 'Source and destination disks must differ.'], 422);
        }

        $only = collect($data['folders'] ?? [])
            ->merge(collect(explode(',', (string)($data['only'] ?? '')))->map(fn($s) => trim($s))->filter())
            ->unique()
            ->values()
            ->all();

        $opts = [
            'delete'     => (bool)($data['delete'] ?? false),
            'visibility' => $data['visibility'] ?? null,
            'dry_run'    => (bool)($data['dry_run'] ?? false),
            'verbose'    => (bool)($data['verbose'] ?? false),
        ];

        $run_mode = $data['run_mode'] ?? 'job';

        if ($run_mode === 'direct') {
            $action = app(SyncUploadsAction::class);
            $summary = $action->execute(
                fromDisk: $from,
                toDisk: $to,
                onlyFolders: $only,
                deleteSource: $opts['delete'],
                visibility: $opts['visibility'],
                dryRun: $opts['dry_run'],
                verbose: $opts['verbose'],
                progress: null
            );

            return response()->json(['ok' => true, 'mode' => 'direct', 'summary' => $summary]);
        }

        $id = (string) \Illuminate\Support\Str::uuid();
        $statusKey = "uploads_sync:{$id}";

        \Cache::put($statusKey, [
            'id'       => $id,
            'from'     => $from,
            'to'       => $to,
            'only'     => $only,
            'started'  => now()->toIso8601String(),
            'total'    => 0,
            'copied'   => 0,
            'skipped'  => 0,
            'deleted'  => 0,
            'failed'   => 0,
            'done'     => false,
            'dry_run'  => $opts['dry_run'],
            'message'  => 'Starting…',
        ], now()->addHours(2));

        \App\Jobs\SyncUploadsJob::dispatch(
            id: $id,
            fromDisk: $from,
            toDisk: $to,
            onlyFolders: $only,
            deleteSource: $opts['delete'],
            visibility: $opts['visibility'],
            dryRun: $opts['dry_run'],
            verbose: $opts['verbose']
        );

        return response()->json(['ok' => true, 'mode' => 'job', 'id' => $id]);
    }

    public function status(string $id)
    {
        $status = Cache::get("uploads_sync:{$id}");
        if (!$status) {
            return response()->json(['ok' => false, 'error' => 'Not found'], 404);
        }
        return response()->json(['ok' => true, 'status' => $status]);
    }
}
