<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Utils\ModuleUtil;

class MenuService
{
    private static int $maxDepth = 10;

    private static bool $cachingEnabled = false;

    /**
     * Process the extra field and convert it to proper JSON format
     */
    private static function processExtraField($extra): ?string
    {
        if (empty($extra)) {
            return null;
        }

        if (is_array($extra)) {
            return json_encode($extra);
        }

        if (is_string($extra)) {
            $conditions = [];

            $parts = preg_split('/[,|]/', $extra);

            foreach ($parts as $part) {
                $part = trim($part);
                if (empty($part)) continue;

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
                            $conditions[] = [
                                'type' => 'raw',
                                'condition' => $part
                            ];
                    }
                } else {
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

    public static function sidebar(int $userId): Collection
    {

        if ($userId === 0) {
            return self::getAllItemsForEditor();
        }
        return self::remember("sidebar_$userId", 1800, fn() => self::tree($userId));
    }


    private static function tree(int $userId): Collection
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user) {
            return collect();
        }

        $bizId = (int) session('user.business_id', 0);
        $moduleUtil = app(ModuleUtil::class);
        $isSuper = $user->can('superadmin');

        $allMenuItems = self::getAllItemsForEditor();

        $perm = self::remember(
            "perm_" . $user->id,
            900,
            fn() => $user->getAllPermissions()->pluck('name')->flip()->all()
        );

        [$folders, $installed] = self::remember(
            'mod_maps',
            3600,
            function () use ($moduleUtil) {
                return self::getModuleMaps($moduleUtil);
            }
        );

        $allowModule = static function ($slug) use ($folders, $installed, $moduleUtil, $bizId, $isSuper): bool {
            if (blank($slug)) return true;
            $low = strtolower($slug);
            $studly = Str::studly(Str::snake($slug));
            if (! isset($folders[$studly])) {
                return in_array($low, session('business.enabled_modules') ?? [], true);
            }
            if (!isset($installed[$low])) return false;
            return $isSuper || $moduleUtil->moduleSidebar($bizId, Str::studly($low));
        };

        $allowPerm = static function ($expr) use ($perm, $isSuper, $user, $bizId): bool {
            if ($isSuper || blank($expr)) return true;

            // Split by pipe (|) or comma (,) for OR conditions
            foreach (explode('|', str_replace(',', '|', $expr)) as $condition) {
                $condition = trim($condition);

                // Check if it's a role-based condition
                if (strpos($condition, 'role:') === 0) {
                    // Extract role name after "role:"
                    $roleName = substr($condition, 5);

                    // Handle business-specific admin roles
                    if (strpos($roleName, 'Admin#') === 0) {
                        // This is already in the format we want
                        if ($user->hasRole($roleName)) {
                            return true;
                        }
                    } elseif ($roleName === 'Admin') {
                        // Convert generic "Admin" to business-specific admin role
                        if ($user->hasRole('Admin#' . $bizId)) {
                            return true;
                        }
                    } else {
                        // Check any other role as-is
                        if ($user->hasRole($roleName)) {
                            return true;
                        }
                    }
                }
                // Check if it's an @role syntax (alternative syntax)
                elseif (strpos($condition, '@') === 0) {
                    $roleName = substr($condition, 1);

                    if ($roleName === 'Admin') {
                        // Business-specific admin check
                        if ($user->hasRole('Admin#' . $bizId)) {
                            return true;
                        }
                    } else {
                        if ($user->hasRole($roleName)) {
                            return true;
                        }
                    }
                }
                // Otherwise, treat it as a permission
                else if (isset($perm[$condition])) {
                    return true;
                }
            }

            return false;
        };

        $allowExtra = static function ($extra) use ($bizId): bool {
            if (empty($extra)) return true;

            if (is_string($extra)) {
                $extraData = json_decode($extra, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return self::checkLegacyExtraConditions($extra, $bizId);
                }
                $extra = $extraData;
            }

            if (!is_array($extra) || empty($extra['conditions'])) {
                return true;
            }

            $operator = $extra['operator'] ?? 'AND';
            $results = [];

            foreach ($extra['conditions'] as $condition) {
                $results[] = self::checkExtraCondition($condition, $bizId);
            }

            if ($operator === 'OR') {
                return in_array(true, $results, true);
            } else { // AND
                return !in_array(false, $results, true);
            }
        };

        return $allMenuItems->where('is_active', true)
            ->filter(fn($m) => $allowModule($m->module ?? null))
            ->filter(fn($m) => $allowPerm($m->permission ?? null))
            ->filter(fn($m) => $allowExtra($m->extra ?? null))
            ->sortBy('sort_order')
            ->groupBy('parent_id');
    }

    /**
     * Extract module maps logic into separate method
     */
    private static function getModuleMaps($moduleUtil): array
    {
        $fold = [];
        $inst = [];
        try {
            foreach (\Nwidart\Modules\Facades\Module::all() as $m) {
                $fold[$m->getName()] = true;
                if ($moduleUtil->isModuleInstalled($m->getName())) {
                    $inst[strtolower($m->getLowerName())] = true;
                }
            }
        } catch (\Exception $e) {
            Log::warning('Error loading modules', ['error' => $e->getMessage()]);
        }
        return [$fold, $inst];
    }

    /**
     * Modified remember function that can bypass caching
     */
    private static function remember(string $key, int $seconds, \Closure $cb)
    {
        if (!self::$cachingEnabled) {
            return $cb();
        }

        if (!Cache::getStore() instanceof \Illuminate\Cache\TaggableStore) {
            return Cache::remember($key, $seconds, $cb);
        }
        return Cache::tags('menus')->remember($key, $seconds, $cb);
    }

    public static function getAllItemsForEditor(): Collection
    {
        try {
            $dbItems = collect();
            $useDatabase = self::isDatabaseAvailable();

            if ($useDatabase) {
                $dbItems = collect(
                    DB::table('menus')
                        ->orderBy('sort_order')
                        ->orderBy('id')
                        ->get()
                )->keyBy('id');
            }

            $coreItems = collect(config('menu', []))->keyBy('id');
            $moduleUtil = app(ModuleUtil::class);
            $bizId = (int) session('user.business_id', 0);

            $moduleItems = $bizId ? $moduleUtil->sidebarItems($bizId)->keyBy('id') : collect();

            $defaultItems = $coreItems->merge($moduleItems)->keyBy('id');

            if ($useDatabase) {
                $defaultItems->each(function ($item, $id) use (&$dbItems) {
                    if (!is_null($id) && is_numeric($id) && !$dbItems->has($id)) {
                        $item = (object) array_merge(['is_active' => true], (array) $item);
                        $dbItems->put($id, $item);
                    }
                });
                $finalItems = $dbItems;
            } else {
                $finalItems = $defaultItems->map(function ($item, $id) {
                    return (object) array_merge([
                        'id' => $id,
                        'is_active' => true,
                        'sort_order' => 0,
                    ], (array) $item);
                });
            }

            $cleanedItems = $finalItems->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'parent_id' => $item->parent_id ?? null,
                    'label' => $item->label ?? 'Untitled',
                    'route' => $item->route ?? null,
                    'url' => $item->url ?? null,
                    'icon_type' => $item->icon_type ?? 'fa',
                    'icon_svg' => $item->icon_svg ?? null,
                    'icon_fa' => $item->icon_fa ?? null,
                    'permission' => $item->permission ?? null,
                    'module' => $item->module ?? null,
                    'extra' => $item->extra ?? null,
                    'sort_order' => (int) ($item->sort_order ?? 0),
                    'is_active' => (bool) ($item->is_active ?? true),
                ];
            })->filter(function ($item) {
                if (is_null($item->id) || !is_numeric($item->id)) {
                    return false;
                }
                return true;
            });

            self::validateMenuStructure($cleanedItems);

            return $cleanedItems->sortBy('sort_order')->values();
        } catch (\Exception $e) {
            Log::error('Error loading menu items', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return self::getRecoveryMenuItems();
        }
    }

    private static function getRecoveryMenuItems(): Collection
    {
        try {
            if (self::isDatabaseAvailable()) {
                $items = collect(
                    DB::table('menus')
                        ->where('is_active', true)
                        ->whereNull('parent_id')
                        ->orderBy('sort_order')
                        ->get()
                )->map(function ($item) {
                    return (object) [
                        'id' => $item->id,
                        'parent_id' => null,
                        'label' => $item->label ?? 'Menu Item',
                        'route' => $item->route ?? null,
                        'url' => $item->url ?? null,
                        'icon_type' => 'fa',
                        'icon_fa' => 'fa-circle',
                        'icon_svg' => null,
                        'permission' => $item->permission ?? null,
                        'module' => $item->module ?? null,
                        'extra' => null,
                        'sort_order' => (int) ($item->sort_order ?? 0),
                        'is_active' => true,
                    ];
                });

                if ($items->count() > 0) {
                    return $items;
                }
            }

            $configItems = collect(config('menu', []))
                ->filter(function ($item) {
                    return ($item['is_active'] ?? true) && empty($item['parent_id']);
                })
                ->map(function ($item, $id) {
                    return (object) [
                        'id' => $id,
                        'parent_id' => null,
                        'label' => $item['label'] ?? 'Menu Item',
                        'route' => $item['route'] ?? null,
                        'url' => $item['url'] ?? null,
                        'icon_type' => 'fa',
                        'icon_fa' => $item['icon_fa'] ?? 'fa-circle',
                        'icon_svg' => null,
                        'permission' => $item['permission'] ?? null,
                        'module' => $item['module'] ?? null,
                        'extra' => null,
                        'sort_order' => (int) ($item['sort_order'] ?? 0),
                        'is_active' => true,
                    ];
                });

            return $configItems;
        } catch (\Exception $e) {
            Log::error('Menu recovery failed', ['error' => $e->getMessage()]);
            return collect();
        }
    }

    private static function validateMenuStructure(Collection $items): void
    {
        $parentMap = [];
        foreach ($items as $item) {
            $parentMap[$item->id] = $item->parent_id;
        }

        foreach ($items as $item) {
            if ($item->parent_id && self::hasCircularReference($item->id, $parentMap)) {

                self::fixCircularReference($item->id, $parentMap);
            }
        }
    }

    private static function hasCircularReference($itemId, $parentMap, $visited = []): bool
    {
        if (in_array($itemId, $visited)) {
            return true;
        }

        if (!isset($parentMap[$itemId]) || $parentMap[$itemId] === null) {
            return false;
        }

        $visited[] = $itemId;

        return self::hasCircularReference($parentMap[$itemId], $parentMap, $visited);
    }

    private static function getCircularPath($itemId, $parentMap): array
    {
        $path = [];
        $current = $itemId;

        while ($current && !in_array($current, $path) && count($path) < self::$maxDepth) {
            $path[] = $current;
            $current = $parentMap[$current] ?? null;
        }

        if ($current) {
            $path[] = $current;
        }

        return $path;
    }

    private static function fixCircularReference($itemId, &$parentMap): void
    {
        try {
            DB::table('menus')
                ->where('id', $itemId)
                ->update(['parent_id' => null]);

            $parentMap[$itemId] = null;
        } catch (\Exception $e) {
            Log::error('Failed to fix circular reference', [
                'item_id' => $itemId,
                'error' => $e->getMessage()
            ]);
        }
    }

    public static function bulkUpsert(array $rows): void
    {
        if (!self::isDatabaseAvailable()) {
            throw new \Exception('Database is not available. Cannot save menu items.');
        }

        DB::beginTransaction();
        try {
            foreach ($rows as $r) {
                if (!isset($r['id'])) {
                    throw new \InvalidArgumentException('Menu item ID is required');
                }

                $updateData = [
                    'parent_id' => $r['parent_id'] ?: null,
                    'sort_order' => $r['sort_order'] ?? 0,
                    'updated_at' => now(),
                ];

                if (isset($r['data']) && is_array($r['data'])) {
                    if (isset($r['data']['extra'])) {
                        $r['data']['extra'] = self::processExtraField($r['data']['extra']);
                    }
                    $updateData = array_merge($updateData, $r['data']);
                }

                DB::table('menus')
                    ->where('id', $r['id'])
                    ->update($updateData);
            }

            DB::commit();
            self::flushMenus();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk upsert failed', [
                'error' => $e->getMessage(),
                'data' => $rows
            ]);
            throw $e;
        }
    }

    /**
     * Save default config items to database
     */
    public static function saveDefaultItemsToDatabase(): array
    {
        if (!self::isDatabaseAvailable()) {
            throw new \Exception('Database is not available. Cannot save default items.');
        }

        $results = ['created' => 0, 'updated' => 0, 'errors' => []];

        DB::beginTransaction();
        try {
            $coreItems = collect(config('menu', []));
            $moduleUtil = app(ModuleUtil::class);
            $bizId = (int) session('user.business_id', 0);
            $moduleItems = $bizId ? $moduleUtil->sidebarItems($bizId) : collect();

            $allDefaultItems = $coreItems->merge($moduleItems);

            foreach ($allDefaultItems as $id => $item) {
                if (!is_numeric($id)) {
                    continue;
                }

                try {
                    $itemArray = is_array($item) ? $item : (array) $item;

                    $menuData = [
                        'id' => $id,
                        'parent_id' => $itemArray['parent_id'] ?? null,
                        'label' => $itemArray['label'] ?? 'Untitled',
                        'route' => $itemArray['route'] ?? null,
                        'url' => $itemArray['url'] ?? null,
                        'icon_type' => $itemArray['icon_type'] ?? 'fa',
                        'icon_svg' => $itemArray['icon_svg'] ?? null,
                        'icon_fa' => $itemArray['icon_fa'] ?? null,
                        'permission' => $itemArray['permission'] ?? null,
                        'module' => $itemArray['module'] ?? null,
                        'extra' => $itemArray['extra'] ?? null,
                        'sort_order' => (int) ($itemArray['sort_order'] ?? 0),
                        'is_active' => (bool) ($itemArray['is_active'] ?? true),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    $exists = DB::table('menus')->where('id', $id)->exists();

                    if ($exists) {
                        unset($menuData['created_at']);
                        DB::table('menus')->where('id', $id)->update($menuData);
                        $results['updated']++;
                    } else {
                        DB::table('menus')->insert($menuData);
                        $results['created']++;
                    }
                } catch (\Exception $e) {
                    $results['errors'][] = "Item ID {$id}: " . $e->getMessage();
                    Log::error('Failed to save menu item', [
                        'id' => $id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            DB::commit();
            self::flushMenus();
        } catch (\Exception $e) {
            DB::rollBack();
            $results['errors'][] = 'Transaction failed: ' . $e->getMessage();
            Log::error('Failed to save default menu items', ['error' => $e->getMessage()]);
            throw $e;
        }

        return $results;
    }

    /**
     * Check if database and menus table are available
     */
    private static function isDatabaseAvailable(): bool
    {
        try {
            DB::connection()->getPdo();

            return DB::getSchemaBuilder()->hasTable('menus');
        } catch (\Exception $e) {
            Log::debug('Database/table not available', ['error' => $e->getMessage()]);
            return false;
        }
    }

    /**
     * Check a single extra condition
     */
    private static function checkExtraCondition(array $condition, int $bizId): bool
    {
        $type = $condition['type'] ?? 'raw';
        $key = $condition['key'] ?? '';
        $operator = $condition['operator'] ?? 'not_empty';
        $value = $condition['value'] ?? null;

        switch ($type) {
            case 'common_settings':
                $commonSettings = session('business.common_settings', []);
                return self::evaluateCondition($commonSettings[$key] ?? null, $operator, $value);

            case 'pos_settings':
                $posSettings = session('business.pos_settings', []);
                return self::evaluateCondition($posSettings[$key] ?? null, $operator, $value);

            case 'environment':
                $envValue = env($key);
                return self::evaluateCondition($envValue, $operator, $value);

            case 'session':
                $sessionValue = session($key);
                return self::evaluateCondition($sessionValue, $operator, $value);

            case 'config':
                $configValue = config($key);
                return self::evaluateCondition($configValue, $operator, $value);

            case 'raw':
            default:
                // Fallback for legacy conditions
                return self::checkLegacyExtraConditions($condition['condition'] ?? '', $bizId);
        }
    }

    /**
     * Evaluate a condition based on operator
     */
    private static function evaluateCondition($actualValue, string $operator, $expectedValue = null): bool
    {
        switch ($operator) {
            case 'not_empty':
                return !empty($actualValue);

            case 'empty':
                return empty($actualValue);

            case 'equals':
                return $actualValue == $expectedValue;

            case 'not_equals':
                return $actualValue != $expectedValue;

            case 'strict_equals':
                return $actualValue === $expectedValue;

            case 'contains':
                return is_string($actualValue) && str_contains($actualValue, $expectedValue);

            case 'starts_with':
                return is_string($actualValue) && str_starts_with($actualValue, $expectedValue);

            case 'ends_with':
                return is_string($actualValue) && str_ends_with($actualValue, $expectedValue);

            case 'in_array':
                return is_array($actualValue) && in_array($expectedValue, $actualValue);

            case 'greater_than':
                return is_numeric($actualValue) && $actualValue > $expectedValue;

            case 'less_than':
                return is_numeric($actualValue) && $actualValue < $expectedValue;

            default:
                return !empty($actualValue);
        }
    }

    /**
     * Handle legacy string-based extra conditions for backward compatibility
     */
    private static function checkLegacyExtraConditions(string $extra, int $bizId): bool
    {
        if (empty($extra)) return true;

        $parts = preg_split('/[,|]/', $extra);

        foreach ($parts as $part) {
            $part = trim($part);
            if (empty($part)) continue;

            if (strpos($part, ':') !== false) {
                [$type, $key] = explode(':', $part, 2);

                switch (strtolower($type)) {
                    case 'cs':
                        $commonSettings = session('business.common_settings', []);
                        if (!empty($commonSettings[$key])) {
                            return true;
                        }
                        break;

                    case 'ps':
                        $posSettings = session('business.pos_settings', []);
                        if (!empty($posSettings[$key]) && $posSettings[$key] == '1') {
                            return true;
                        }
                        break;

                    case 'env':
                        if (!empty(env($key))) {
                            return true;
                        }
                        break;

                    case 'session':
                        if (!empty(session($key))) {
                            return true;
                        }
                        break;

                    case 'config':
                        if (!empty(config($key))) {
                            return true;
                        }
                        break;
                }
            }
        }

        return false; // None of the conditions matched
    }
    public static function flushMenus(): void
    {
        try {
            if (Cache::getStore() instanceof \Illuminate\Cache\TaggableStore) {
                Cache::tags('menus')->flush();
            } else {
                $patterns = ['sidebar_*', 'perm_*', 'mod_maps'];
                foreach ($patterns as $pattern) {
                    if (method_exists(Cache::getStore(), 'forget')) {
                        Cache::forget($pattern);
                    }
                }
                Cache::flush();
            }
        } catch (\Exception $e) {
            Log::warning('Cache flush failed', ['error' => $e->getMessage()]);
        }
    }
}
