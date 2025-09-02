<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AppSettingsService;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class AppSettingsController extends Controller
{
    protected $service;
    protected $businessUtil;
    protected $moduleUtil;
    public function __construct(AppSettingsService $service, BusinessUtil $businessUtil, ModuleUtil $moduleUtil)
    {
        $this->service = $service;
        $this->businessUtil = $businessUtil;
        $this->moduleUtil = $moduleUtil;
    }

    public function index()
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        $settings = $this->service->all();
        return view('app_settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        try {
            $notAllowed = $this->businessUtil->notAllowedInDemo();
            if (!empty($notAllowed)) {
                return $notAllowed;
            }
            $request->validate([
                'login_bg_image_file' => 'nullable|image|max:2048',
                'app_logo_light' => 'nullable|image|max:2048',
                'app_logo_dark' => 'nullable|image|max:2048',
                'app_favicon' => 'nullable|image|max:1024',
            ]);

            $data = $request->all();

            if ($request->hasFile('login_bg_image_file')) {
                $bg_filename = $this->businessUtil->uploadFile($request, 'login_bg_image_file', 'bg_images', 'image');
                if (!empty($bg_filename)) {
                    $data['login_bg_image_url'] = $bg_filename;
                }
            }
            if ($request->hasFile('app_logo_light')) {
                $logo_light = $this->businessUtil->uploadFile($request, 'app_logo_light', 'app_logos', 'image');
                if (!empty($logo_light)) {
                    $data['app_logo_light'] = $logo_light;
                }
            }
            if ($request->hasFile('app_logo_dark')) {
                $logo_dark = $this->businessUtil->uploadFile($request, 'app_logo_dark', 'app_logos', 'image');
                if (!empty($logo_dark)) {
                    $data['app_logo_dark'] = $logo_dark;
                }
            }
            if ($request->hasFile('app_favicon')) {
                $favicon = $this->businessUtil->uploadFile($request, 'app_favicon', 'app_logos', 'image');
                if (!empty($favicon)) {
                    $data['app_favicon'] = $favicon;
                }
            }

            $this->service->update($data);

            $output = [
                'success' => 1,
                'msg' => __('business.settings_updated_success'),
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
        return redirect()->back()->with('status', $output);
    }

    public function lockedUsers()
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        return view('app_settings.locked_users');
    }

    public function lockedUsersData()
{
    if (!auth()->user()->can('superadmin')) {
        abort(403, 'Unauthorized action.');
    }
    $is_superadmin = $this->moduleUtil->isModuleInstalled('Superadmin');
    $query = User::with('business')
        ->whereNotNull('locked_until')
        ->where('locked_until', '>', Carbon::now())
        ->select([ 'id', 'username', 'business_id', 'locked_until',
            DB::raw("CONCAT(COALESCE(surname, ''), ' ', COALESCE(first_name, ''), ' ', COALESCE(last_name, '')) as full_name")
        ]);

        return DataTables::of($query)
        ->editColumn('locked_until', function ($row) {
            return $row->locked_until ? $row->locked_until->format('Y-m-d H:i:s') : '';
        })
        ->addColumn('business_name', function ($row) {
            return optional($row->business)->name;
        })
        ->addColumn('action', function ($row) use ($is_superadmin) {
            $unlock_form = '<form action="' . route('admin.unlock_user', $row->id) . '" method="POST" style="display:inline;">' . csrf_field() . '<button type="submit" class="btn btn-sm btn-danger">' . __('settings.unlock') . '</button></form>';
            $update_password_btn = '';
            if ($is_superadmin) {
                $update_password_btn = '<button type="button" ' . 'class="btn btn-xs btn-primary update_user_password" ' . 'data-user_id="' . $row->id . '" ' . 'data-user_name="' . $row->full_name . '">' . __('superadmin::lang.update_password') . '</button>';
               
            }
           
            return $unlock_form . ' ' . $update_password_btn;
        })
        ->rawColumns(['action'])
        ->make(true);
}

    public function unlockUser(User $user)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        try {
            $notAllowed = $this->businessUtil->notAllowedInDemo();
            if (!empty($notAllowed)) {
                return $notAllowed;
            }
            $user->update([
                'failed_attempts' => 0,
                'locked_until' => null
            ]);

            $output = [
                'success' => 1,
                'msg' => __('settings.user_unlocked_message'),
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }
        return redirect()->back()->with('status', $output);
    }
    public function syncDisposable(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        \Artisan::call('erag:sync-disposable-email-list');
        return response()->json([
           'success' => true,
           'message' => __('settings.sync_disposable_success'),
        ]);
    }
    
}
