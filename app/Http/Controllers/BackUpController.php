<?php

namespace App\Http\Controllers;

use App\Utils\Util;
use App\Services\AppSettingsService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Log;
use Storage;

class BackUpController extends Controller
{
    /**
     * All Utils instance.
     */
    protected $commonUtil;

    /**
     * App Settings Service instance.
     */
    protected $appSettingsService;

    public function __construct(Util $commonUtil, AppSettingsService $appSettingsService)
    {
        $this->commonUtil = $commonUtil;
        $this->appSettingsService = $appSettingsService;
    }

    /**
     * Get the configured backup disk from app settings or fallback to default backup config.
     */
    protected function getBackupDisk()
    {
        $this->appSettingsService->apply_storage_config(true);
        
        $configuredDisk = $this->appSettingsService->storage_default_disk();
        
        if ($configuredDisk) {
            return Storage::disk($configuredDisk);
        }
        
        // Fallback to original backup configuration
        return Storage::disk(config('backup.backup.destination.disks')[0]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! auth()->user()->can('backup')) {
            abort(403, 'Unauthorized action.');
        }

        $disk = $this->getBackupDisk();

        $files = $disk->files(config('backup.backup.name'));

        $backups = [];
        foreach ($files as $k => $f) {
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(str_replace('\\', '/', config('backup.backup.name')).'/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        $backups = array_reverse($backups);

        $cron_job_command = $this->commonUtil->getCronJobCommand();
        
        // $backup_clean_cron_job_command = $this->commonUtil->getBackupCleanCronJobCommand();

        return view('backup.index')
            ->with(compact('backups', 'cron_job_command'));
    }

    /**
     * Create a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->user()->can('backup')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            //Disable in demo
            $notAllowed = $this->commonUtil->notAllowedInDemo();
            if (! empty($notAllowed)) {
                return $notAllowed;
            }

            $this->appSettingsService->apply_storage_config(true);
            
            $configuredDisk = $this->appSettingsService->storage_default_disk();
            $diskToUse = $configuredDisk ?: config('backup.backup.destination.disks')[0];
            
            if ($configuredDisk) {
                Config::set('backup.backup.destination.disks', [$configuredDisk]);
                Log::info("BackupController -- Using configured disk: {$configuredDisk}");
            } else {
                Log::info("BackupController -- Using default backup disk: {$diskToUse}");
            }

            Artisan::call('backup:run');
            $output = Artisan::output();

            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n".$output);

            $output = ['success' => 1,
                'msg' => __('lang_v1.success'),
            ];
        } catch (Exception $e) {
            $output = ['success' => 0,
                'msg' => $e->getMessage(),
            ];
        }

        return back()->with('status', $output);
    }

    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        if (! auth()->user()->can('backup')) {
            abort(403, 'Unauthorized action.');
        }

        //Disable in demo
        if (config('app.env') == 'demo') {
            $output = ['success' => 0,
                'msg' => 'Feature disabled in demo!!',
            ];

            return back()->with('status', $output);
        }

        $file = config('backup.backup.name').'/'.$file_name;
        $disk = $this->getBackupDisk();
        if ($disk->exists($file)) {
            $fs = $disk->getDriver();
            $stream = $fs->readStream($file);
            //var_dump($fs->size($file));exit;

            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                'Content-Type' => $fs->mimeType($file),
                //'Content-Length' => $fs->getSize($file),
                'Content-disposition' => 'attachment; filename="'.basename($file).'"',
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        
        if (! auth()->user()->can('backup')) {
            abort(403, 'Unauthorized action.');
        }

        //Disable in demo
        if (config('app.env') == 'demo') {
            $output = ['success' => 0,
                'msg' => 'Feature disabled in demo!!',
            ];

            return back()->with('status', $output);
        }

        $disk = $this->getBackupDisk();
        if ($disk->exists(config('backup.backup.name').'/'.$file_name)) {
            $disk->delete(config('backup.backup.name').'/'.$file_name);

            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
}
