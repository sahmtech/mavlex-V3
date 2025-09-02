<?php

namespace App\Services;

use LaravelLux\Html\FormFacade as Form;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MenuEditorRenderer
{
    private static int $maxDepth = 10;
    private static array $processedItems = [];

    public static function html(Collection $groupedMenus, Collection $parents): string
    {
        try {
            self::$processedItems = [];

            $hasChildrenMap = [];
            foreach ($groupedMenus as $parentId => $items) {
                if ($parentId !== '' && $parentId !== null) {
                    $hasChildrenMap[$parentId] = true;
                }
            }

            $html = self::walk($groupedMenus, $parents, null, 0, $hasChildrenMap);

            if (empty($html)) {
                return '<li class="list-group-item text-muted">No menu items found</li>';
            }

            return $html;
        } catch (\Exception $e) {
            Log::error('Menu rendering error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return '<li class="list-group-item text-danger">Error loading menu items</li>';
        }
    }

    private static function walk(
        Collection $tree,
        Collection $parents,
        $parentId,
        int $depth = 0,
        array $hasChildrenMap = []
    ): string {
        if ($depth > self::$maxDepth) {

            return '';
        }

        $html = '';
        $lookupKey = $parentId === null ? '' : $parentId;
        $items = $tree->get($lookupKey, []);

        if (!is_iterable($items)) {

            return '';
        }

        foreach ($items as $m) {
            try {
                // Validate menu item
                if (!is_object($m) || !isset($m->id)) {
                    continue;
                }

                // Prevent infinite loops
                if (in_array($m->id, self::$processedItems)) {
                    continue;
                }

                self::$processedItems[] = $m->id;

                $rowId = 'item_' . $m->id;
                $uid = (string) Str::uuid();
                $hasKids = isset($hasChildrenMap[$m->id]);
                $indent = str_repeat('<span class="depth-dash">—</span>', $depth);

                // Icon preview
                $icon = self::renderIcon($m);

                // Build HTML
                $html .= '<li class="list-group-item" data-id="' . $m->id . '">';
                $html .= self::renderHeader($m, $rowId, $indent, $hasKids, $icon);
                $html .= self::renderForm($m, $rowId, $uid);

                // Children
                if ($hasKids) {
                    $html .= '<ol id="children-' . $rowId
                        . '" class="collapse list-group list-group-flush ms-3 child-list">';
                    $html .= self::walk($tree, $parents, $m->id, $depth + 1, $hasChildrenMap);
                    $html .= '</ol>';
                }

                $html .= '</li>';
            } catch (\Exception $e) {
                Log::error('Error rendering menu item', [
                    'item_id' => $m->id ?? 'unknown',
                    'error' => $e->getMessage()
                ]);
                continue;
            }
        }

        return $html;
    }

    private static function renderIcon($m): string
    {
        try {
            if (($m->icon_type ?? 'fa') === 'fa' && !empty($m->icon_fa)) {
                return '<i class="' . e($m->icon_fa) . ' tw-size-5"></i>';
            } elseif (($m->icon_type ?? 'fa') === 'svg' && !empty($m->icon_svg)) {
                return self::sanitizeSvg($m->icon_svg);
            }
        } catch (\Exception $e) {
            Log::warning('Error rendering icon', [
                'item_id' => $m->id ?? 'unknown',
                'error' => $e->getMessage()
            ]);
        }

        return '';
    }

    private static function sanitizeSvg(string $svg): string
    {
        $svg = preg_replace('/<script[^>]*>.*?<\/script>/is', '', $svg);
        $svg = preg_replace('/on\w+="[^"]*"/i', '', $svg);
        $svg = preg_replace('/javascript:/i', '', $svg);
        $svg = preg_replace('/data:(?!image)/i', '', $svg);

        if (strpos($svg, 'width=') === false) {
            $svg = str_replace('<svg', '<svg width="20" height="20"', $svg);
        }

        return $svg;
    }

    private static function renderHeader($m, string $rowId, string $indent, bool $hasKids, string $icon): string
    {
        $html = '<div class="row-item">';
        $html .= '<span class="handle"><i class="fa fa-bars"></i></span>';
        $html .= $indent;

        $html .= $hasKids
            ? '<button class="toggle-children btn p-0" data-bs-toggle="collapse"
                      data-bs-target="#children-' . $rowId . '">
                    <i class="fa fa-plus"></i>
               </button>'
            : '<span class="toggle-spacer"></span>';

        $html .= '<span class="icon-preview">' . $icon . '</span>';
        $html .= '<span class="flex-grow-1 d-flex align-items-center justify-between">';
        $html .= e(__($m->label ?? 'Untitled'));

        if (!($m->is_active ?? true)) {
            $html .= '<span class="badge bg-secondary ms-2" style="font-size: 0.75rem; margin-left:15px;">';
            $html .= __('settings.inactive');
            $html .= '</span>';
        }

        $html .= '</span>';
        $html .= '<button class="settings-toggle btn btn-sm text-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#c-' . $rowId . '">';
        $html .= '<i class="fa fa-cog"></i>';
        $html .= '</button>';
        $html .= '</div>';

        return $html;
    }

    private static function renderForm($m, string $rowId, string $uid): string
    {
        $html = '<div id="c-' . $rowId . '" class="collapse settings-form-wrapper">';
        $html .= '<div class="row g-3 un-row">';

        // Label field
        $html .= '<div class="col-sm-4"><div class="form-group">';
        $html .= Form::label('label', __('settings.label'));
        $html .= Form::text('label', $m->label ?? '', ['class' => 'form-control', 'required' => true]);
        $html .= '</div></div>';

        // Icon type selector
        $html .= '<div class="col-sm-4"><div class="form-group">';
        $html .= Form::label('icon_type', __('settings.icon_type'));
        $html .= '<br>';
        $html .= Form::select(
            'icon_type',
            ['svg' => __('settings.svg'), 'fa' => __('settings.fontawesome')],
            $m->icon_type ?? 'fa',
            ['class' => 'form-select icon-type-select width-100', 'data-target' => $uid]
        );
        $html .= '</div></div>';

        // Dynamic icon fields
        $iconType = $m->icon_type ?? 'fa';

        // SVG icon field
        $html .= '<div class="col-sm-4 icon-svg-group' . ($iconType === 'svg' ? '' : ' hide') . '" data-uid="' . $uid . '">';
        $html .= '<div class="form-group">';
        $html .= Form::label('icon_svg', __('settings.svg_icon'));
        $html .= Form::textarea('icon_svg', $m->icon_svg ?? '', ['class' => 'form-control', 'rows' => 1]);
        $html .= '</div></div>';

        // FA icon field
        $html .= '<div class="col-sm-4 icon-fa-group' . ($iconType === 'fa' ? '' : ' hide') . '" data-uid="' . $uid . '">';
        $html .= '<div class="form-group">';
        $html .= Form::label('icon_fa', __('settings.fa_class'));
        $html .= Form::text('icon_fa', $m->icon_fa ?? '', ['class' => 'form-control']);
        $html .= '</div></div>';

        // Additional fields
        $fields = [
            'route' => __('settings.named_route'),
            'url' => __('settings.absolute_url'),
            'permission' => __('settings.permission'),
            'extra' => __('settings.extra'),
            'module' => __('settings.module_flag'),
        ];

        foreach ($fields as $field => $label) {
            $html .= '<div class="col-sm-4"><div class="form-group">';
            $html .= Form::label($field, $label);
            $html .= Form::text($field, $m->$field ?? '', ['class' => 'form-control']);
            $html .= '</div></div>';
        }

        // Active checkbox
        $html .= '<div class="col-sm-4"><div class="form-group">';
        $html .= '<div class="toggle-wrapper d-flex gap-2 mt-4">';
        $html .= '<p>' . __('settings.active') . '</p>';
        $html .= '<label class="switch">';
        $html .= Form::checkbox('is_active', 1, (bool) ($m->is_active ?? false));
        $html .= '<span class="sliderCheckbox round"></span>';
        $html .= '</label></div></div></div>';

        // Apply button
        $html .= '<div class="col-sm-4"><div class="form-group">';
        $html .= '<button type="button" class="btn btn-primary settings-toggle me-2"';
        $html .= ' data-bs-toggle="collapse" data-bs-target="#c-' . $rowId . '">';
        $html .= __('settings.apply');
        $html .= '</button>';
        $html .= '</div></div>';

        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}
