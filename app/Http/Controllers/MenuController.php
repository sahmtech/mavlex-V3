<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Http\Request;
use App\Services\MenuEditorRenderer;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Utils\ModuleUtil;

class MenuController extends Controller
{
    protected $moduleUtil;
    
    public function __construct(ModuleUtil $moduleUtil)
    {
        $this->moduleUtil = $moduleUtil;
    }
    
    public function index()
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        try {
            set_time_limit(-1);
          
            $menu_items = MenuService::getAllItemsForEditor();
            
            $menus = $menu_items->groupBy('parent_id');
            
            $parents = $menu_items->pluck('label', 'id');
            $htmlTree = MenuEditorRenderer::html($menus, $parents);
           
            return view('menus.index', compact('htmlTree', 'menus'));
            
        } catch (\Exception $e) {
            Log::error('Menu index error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Unable to load menu items: ' . $e->getMessage());
        }
    }
    
   

    public function bulkSave(Request $request)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        
        try {
            $notAllowed = $this->moduleUtil->notAllowedInDemo();
            if (!empty($notAllowed)) {
                return $notAllowed;
            }
            
            $itemsJson = $request->input('items');
            if (empty($itemsJson)) {
                throw new \InvalidArgumentException('No items provided');
            }
            
            $items = json_decode($itemsJson, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \InvalidArgumentException('Invalid JSON data');
            }
            
            MenuService::bulkUpsert($items);
            
            return redirect()->back()->with('status', [
                'success' => 1,
                'msg' => __('lang_v1.success'),
            ]);
            
        } catch (\Exception $e) {
            Log::error('Bulk save error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('status', [
                'success' => 0,
                'msg' => __('messages.something_went_wrong') . ': ' . $e->getMessage(),
            ]);
        }
    }

    public function rebuild()
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        
        try {
            $notAllowed = $this->moduleUtil->notAllowedInDemo();
            if (!empty($notAllowed)) {
                return $notAllowed;
            }
            
            // Clear module cache to ensure proper module detection
            if (function_exists('opcache_reset')) {
                opcache_reset();
            }
            
            // Clear Laravel cache
            Artisan::call('cache:clear');
            
            // Clear config cache to ensure module configurations are refreshed
            Artisan::call('config:clear');
            
            // Run the menu seeder
            Artisan::call('db:seed', ['--class' => 'MenuSeeder', '--force' => true]);
            MenuService::flushMenus();
            
            return redirect()->back()->with('status', [
                'success' => 1,
                'msg' => __('settings.rebuilt_successfully'),
            ]);
            
        } catch (\Exception $e) {
            Log::error('Menu rebuild error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('status', [
                'success' => 0,
                'msg' => __('messages.something_went_wrong') . ': ' . $e->getMessage(),
            ]);
        }
    }

    private function validated(Request $r): array
    {
        return $r->validate([
            'parent_id'  => ['nullable', 'exists:menus,id', 'different:id'],
            'label'      => ['required', 'string', 'max:65535'], 
            'route'      => ['nullable', 'string', 'max:65535'],
            'url'        => ['nullable', 'string', 'max:65535'],
            'icon_type'  => ['required', 'in:svg,fa'],
            'icon_svg'   => ['nullable', 'string', 'max:4294967295'], 
            'icon_fa'    => ['nullable', 'string', 'max:65535'], 
            'permission' => ['nullable', 'string', 'max:65535'],
            'module'     => ['nullable', 'string', 'max:65535'],
            'extra'      => ['nullable', 'array', 'max:10000'], 
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active'  => ['boolean'],
        ]);
    }
        public function create()
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        return view('menus.create', [
            'menu'    => new Menu,
            'parents' => Menu::orderBy('label')->pluck('label', 'id'),
        ]);
    }

    public function store(Request $r)
    {
        if (!auth()->user()->can('superadmin')) {
            abort(403, 'Unauthorized action.');
        }
        $notAllowed = $this->moduleUtil->notAllowedInDemo();
        if (!empty($notAllowed)) {
            return $notAllowed;
        }

        $validatedData = $this->validated($r);
        
        try {
            Menu::create($validatedData);
            MenuService::flushMenus();
            
            return to_route('menus.index')->withSuccess(__('messages.saved'));
        } catch (\Exception $e) {
            Log::error('Menu creation failed', [
                'error' => $e->getMessage(),
                'data_size' => [
                    'icon_svg' => isset($validatedData['icon_svg']) ? strlen($validatedData['icon_svg']) : 0,
                    'extra' => isset($validatedData['extra']) ? json_encode($validatedData['extra']) : 0,
                ]
            ]);
            
            return redirect()->back()->withErrors(['general' => 'Failed to save menu: ' . $e->getMessage()])->withInput();
        }
    }
}
