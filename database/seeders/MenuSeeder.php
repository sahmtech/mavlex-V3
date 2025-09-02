<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Nwidart\Modules\Facades\Module;

class MenuSeeder extends Seeder
{
    private $currentId = 1;

    public function run(): void
    {
        DB::table('menus')->truncate();

        $mainMenus = config('menu', []);

        foreach ($mainMenus as $menu) {
            $this->processMenuItem($menu);
        }

        $this->processModuleMenus();
    }

    private function processModuleMenus(): void
    {
        $processedModules = [];
        
        try {
            $modules = Module::allEnabled();

            foreach ($modules as $module) {
                $moduleName = $module->getName();
                
                $menuConfigPath = '';
                if (function_exists('module_path')) {
                    $menuConfigPath = module_path($moduleName, 'Config/menu.php');
                } else {
                    $menuConfigPath = $module->getPath() . '/Config/menu.php';
                }

                if (File::exists($menuConfigPath)) {
                    $this->processModuleMenuConfig($menuConfigPath, $moduleName);
                    $processedModules[] = $moduleName;
                }
            }
        } catch (\Exception $e) {
            $modulesPath = base_path('Modules');
            if (File::isDirectory($modulesPath)) {
                $moduleDirectories = File::directories($modulesPath);
                
                foreach ($moduleDirectories as $moduleDir) {
                    $moduleName = basename($moduleDir);
                    
                    if (in_array($moduleName, $processedModules)) {
                        continue;
                    }
                    
                    $moduleJsonPath = $moduleDir . '/module.json';
                    $menuConfigPath = $moduleDir . '/Config/menu.php';
                    
                    if (File::exists($moduleJsonPath) && File::exists($menuConfigPath)) {
                        $moduleConfig = json_decode(File::get($moduleJsonPath), true);
                        
                        if (isset($moduleConfig['active']) && $moduleConfig['active']) {
                            $this->processModuleMenuConfig($menuConfigPath, $moduleName);
                        }
                    }
                }
            }
        }
    }

    private function processModuleMenuConfig(string $menuConfigPath, string $moduleName): void
    {
        $moduleMenus = include $menuConfigPath;

        if (is_array($moduleMenus)) {
            foreach ($moduleMenus as $menu) {
                if (!isset($menu['module'])) {
                    $menu['module'] = $moduleName;
                }

                $this->processMenuItem($menu);
            }
        }
    }

    private function processMenuItem(array $item, ?int $parentId = null): int
    {
        $children = $item['children'] ?? [];
        unset($item['children']);
        $item['parent_id'] = $parentId;
        $item['is_active'] = $item['is_active'] ?? true;
        $item['sort_order'] = $item['sort_order'] ?? 0;
        $currentId = $this->currentId++;
        $extraJson = $this->processExtraField($item['extra'] ?? null);

        // Insert the menu item
        DB::table('menus')->insert([
            'id' => $currentId,
            'parent_id' => $item['parent_id'],
            'label' => $item['label'],
            'route' => $item['route'] ?? null,
            'url' => $item['url'] ?? null,
            'icon_type' => $item['icon_type'] ?? 'svg',
            'icon_svg' => $item['icon_svg'] ?? null,
            'icon_fa' => $item['icon_fa'] ?? null,
            'permission' => $item['permission'] ?? null,
            'module' => $item['module'] ?? null,
            'extra' => $extraJson,
            'sort_order' => $item['sort_order'],
            'is_active' => $item['is_active'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Process children recursively
        foreach ($children as $child) {
            $this->processMenuItem($child, $currentId);
        }

        return $currentId;
    }

    private function processExtraField($extra): ?string
    {
        if (empty($extra)) {
            return null;
        }

        if (is_array($extra)) {
            return json_encode($extra);
        }
        if (is_string($extra)) {
            $conditions = [];

            // Split by comma or pipe for multiple conditions
            $parts = preg_split('/[,|]/', $extra);

            foreach ($parts as $part) {
                $part = trim($part);
                if (empty($part)) continue;

                // Parse different condition types
                if (strpos($part, ':') !== false) {
                    [$type, $key] = explode(':', $part, 2);

                    switch (strtolower($type)) {
                        case 'cs':
                            $conditions[] = [
                                'type' => 'common_settings',
                                'key' => $key,
                                'operator' => 'not_empty'
                            ];
                            break;

                        case 'ps':
                            $conditions[] = [
                                'type' => 'pos_settings',
                                'key' => $key,
                                'operator' => 'equals',
                                'value' => '1'
                            ];
                            break;

                        case 'env':
                            $conditions[] = [
                                'type' => 'environment',
                                'key' => $key,
                                'operator' => 'not_empty'
                            ];
                            break;

                        case 'session':
                            $conditions[] = [
                                'type' => 'session',
                                'key' => $key,
                                'operator' => 'not_empty'
                            ];
                            break;

                        case 'config':
                            $conditions[] = [
                                'type' => 'config',
                                'key' => $key,
                                'operator' => 'not_empty'
                            ];
                            break;

                        default:
                            // Unknown type, store as-is for backward compatibility
                            $conditions[] = [
                                'type' => 'raw',
                                'condition' => $part
                            ];
                    }
                } else {
                    // No colon, treat as raw condition
                    $conditions[] = [
                        'type' => 'raw',
                        'condition' => $part
                    ];
                }
            }

            return json_encode([
                'conditions' => $conditions,
                'operator' => 'AND' // All conditions must be true
            ]);
        }

        return null;
    }
}
