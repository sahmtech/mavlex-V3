<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Media extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['display_name', 'display_url'];

    public function mediable()
    {
        return $this->morphTo();
    }

    protected function diskKey(): ?string
    {
        if (!$this->file_name) return null;
        return 'media/' . ltrim($this->file_name, '/');
    }

    protected function isS3Like(): bool
    {
        $default = config('filesystems.default');
        return (config("filesystems.disks.$default.driver") === 's3');
    }

    public function getDisplayNameAttribute()
    {
        $array = explode('_', $this->file_name, 3);
        return !empty($array[2]) ? $array[2] : ($array[1] ?? $this->file_name);
    }

    public function getDisplayUrlAttribute()
    {
        $key = $this->diskKey();
        if (!$key) return null;

        $disk = config('filesystems.default');
        $cfg  = config("filesystems.disks.$disk", []);
        $driver = data_get($cfg, 'driver');
        $useSigned = (bool) data_get($cfg, 'signed_urls', false);
        $ttlMin    = (int)  data_get($cfg, 'signed_ttl', 10);

        try {
            if ($driver === 's3' && $useSigned) {
                return Storage::temporaryUrl($key, now()->addMinutes(max(1, $ttlMin)));
            }
            return Storage::url($key);
        } catch (\Throwable $e) {
            return upload_asset('uploads/media/' . rawurlencode($this->file_name));
        }
    }

    /**
     * Absolute local path (only meaningful for local driver).
     * Returns null for S3-like disks.
     */
    public function getDisplayPathAttribute()
    {
        $key = $this->diskKey();
        if (!$key) return null;

        try {
            return $this->isS3Like() ? null : Storage::path($key);
        } catch (\Throwable $e) {
            return public_path('uploads/media/' . rawurlencode($this->file_name));
        }
    }

    public function thumbnail($size = [60, 60], $class = null)
    {
        $url = $this->display_url;
        if (!$url) return '';

        $w = (int) ($size[0] ?? 60);
        $h = (int) ($size[1] ?? 60);

        return sprintf(
            '<img src="%s" width="%d" height="%d"%s>',
            e($url),
            $w,
            $h,
            $class ? ' class="' . e($class) . '"' : ''
        );
    }

    /** ------------------------
     *  Upload API
     *  ------------------------ */

    public static function uploadMedia($business_id, $model, $request, $file_input_name, $is_single = false, $model_media_type = null)
    {
        if (config('app.env') == 'demo') {
            return ['uploaded_files' => [], 'errors' => ['File uploads are disabled in demo mode.']];
        }

        $uploaded_files = [];
        $errors = [];
        $user = Auth::user();

        if ($request->hasFile($file_input_name)) {
            $files = $request->file($file_input_name);
            $files = is_array($files) ? $files : [$files];

            foreach ($files as $file) {
                if (self::isAllowedFile($file)) {
                    $uploaded_file = self::uploadFile($file);
                    if (!empty($uploaded_file)) {
                        $uploaded_files[] = $uploaded_file;
                    } else {
                        $errors[] = 'Failed to upload file: ' . $file->getClientOriginalName();
                    }
                } else {
                    $userInfo = $user ? 'User ID ' . $user->id . ' (' . $user->email . ')' : 'Guest User';
                    Log::warning("Disallowed file type attempted by {$userInfo}: " . $file->getClientOriginalName());
                    $errors[] = 'File type not allowed: ' . $file->getClientOriginalName();
                }
            }
        }

        // Base64 support (single)
        if ($request->filled($file_input_name) && !is_array($request->input($file_input_name))) {
            $base64_data = $request->input($file_input_name);
            $base64_array = explode(',', $base64_data);
            $base64_string = $base64_array[1] ?? $base64_array[0];

            if (self::is_base64($base64_string)) {
                $uploaded_file = self::uploadBase64Image($base64_string);
                if (!empty($uploaded_file)) {
                    $uploaded_files[] = $uploaded_file;
                } else {
                    $errors[] = 'Failed to upload base64 encoded image.';
                }
            } else {
                $errors[] = 'Invalid base64 encoded string.';
            }
        }

        if (!empty($uploaded_files)) {
            if ($is_single) {
                $uploaded_files = $uploaded_files[0];
            }
            self::attachMediaToModel($model, $business_id, $uploaded_files, $request, $model_media_type);
        }

        return ['uploaded_files' => $uploaded_files, 'errors' => $errors];
    }

    protected static function isAllowedFile($file)
    {
        $allowedExtensions = Config::get('constants.media_upload.allowed_extensions', []);
        $allowedMimeTypes  = Config::get('constants.media_upload.allowed_mime_types', []);
        $extension = strtolower($file->getClientOriginalExtension());
        $mimeType  = strtolower($file->getMimeType());

        return in_array($extension, $allowedExtensions) && in_array($mimeType, $allowedMimeTypes);
    }

    /**
     * Upload a file to the active disk under "media/{filename}".
     * Returns just the filename (DB format unchanged).
     */
    public static function uploadFile($file)
    {
        $file_name = null;
        $user = Auth::user();
        $userInfo = $user ? 'User ID ' . $user->id . ' (' . $user->email . ')' : 'Guest User';

        if (self::isAllowedFile($file) && $file->getSize() <= Config::get('constants.document_size_limit', 5000000)) {
            $originalName  = preg_replace('/[^A-Za-z0-9.\-_]/', '', $file->getClientOriginalName());
            $new_file_name = time() . '_' . mt_rand() . '_' . $originalName;
            $svc = app(\App\Services\AppSettingsService::class);
            $svc->apply_storage_config(true);

            if ($file->storeAs('media', $new_file_name)) {
                $file_name = $new_file_name;
            }
        } else {
            Log::warning("Attempted to upload disallowed file by {$userInfo}: " . $file->getClientOriginalName());
        }

        return $file_name;
    }

    public static function is_base64($s)
    {
        return (bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s);
    }

    /**
     * Upload a base64 image to the active disk (not the local filesystem).
     * Returns the stored filename.
     */
    public static function uploadBase64Image($base64_string)
    {
        $file_name = time() . '_' . mt_rand() . '_media.jpg';
        $key = 'media/' . $file_name;
        $binary = base64_decode($base64_string, true);

        if ($binary === false) {
            return null;
        }
        $ok = Storage::put($key, $binary);

        return $ok ? $file_name : null;
    }

    /**
     * Deletes the media object from the active disk; falls back to local legacy path if present.
     */
    public static function deleteMedia($business_id, $media_id)
    {
        $media = Media::where('business_id', $business_id)->findOrFail($media_id);
        $key = 'media/' . ltrim($media->file_name, '/');
        try {
            Storage::delete($key);
        } catch (\Throwable $e) {
        }
        $legacy = public_path('uploads/media/' . $media->file_name);
        if (is_file($legacy)) {
            @unlink($legacy);
        }

        $media->delete();
    }

    public function uploaded_by_user()
    {
        return $this->belongsTo(\App\Models\User::class, 'uploaded_by');
    }

    public static function attachMediaToModel($model, $business_id, $uploaded_files, $request = null, $model_media_type = null)
    {
        if (empty($uploaded_files)) return;

        if (is_array($uploaded_files)) {
            $media_obj = [];
            foreach ($uploaded_files as $value) {
                $media_obj[] = new \App\Models\Media([
                    'file_name'       => $value,
                    'business_id'     => $business_id,
                    'description'     => $request->description ?? null,
                    'uploaded_by'     => $request->uploaded_by ?? auth()->id(),
                    'model_media_type' => $model_media_type,
                ]);
            }
            $model->media()->saveMany($media_obj);
        } else {
            $model->media()->delete();

            $media_obj = new \App\Models\Media([
                'file_name'       => $uploaded_files,
                'business_id'     => $business_id,
                'description'     => $request->description ?? null,
                'uploaded_by'     => $request->uploaded_by ?? auth()->id(),
                'model_media_type' => $model_media_type,
            ]);
            $model->media()->save($media_obj);
        }
    }
}
