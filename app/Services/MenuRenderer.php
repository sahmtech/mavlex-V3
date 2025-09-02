<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

class MenuRenderer
{
    public static function html(Collection $menus): string
    {
        return self::nodeList($menus, null);
    }

    private static function nodeList(Collection $menus, $parentId): string
    {
        $key  = self::key($parentId);
        $html = '';

        foreach ($menus->get($key, []) as $m) {
            $id   = $m->id ?? null;
            $has  = $menus->has(self::key($id));
            $url  = self::url($m->route ?? null, $m->url ?? null);
            $icon = self::icon($m);
            $lbl  = self::label($m->label ?? '');

            $html .= '<li class="nav-item' . ($has ? ' toogle-sidebar-submenu' : '') . '">'
                   .   '<a class="nav-link" href="' . self::escAttr($url) . '">'
                   .       $icon . '<h3>' . $lbl . '</h3>'
                   .       ($has ? '<span class="chevron dropdown-indicator">▾</span>' : '')
                   .   '</a>';

            if ($has) {
                $html .= '<ul class="side-submenu">'
                       .   self::nodeList($menus, $id)
                       . '</ul>';
            }

            $html .= '</li>';
        }

        return $html;
    }

    private static function key($v): string
    {
        return ($v === null || $v === '') ? '' : (string) $v;
    }

    private static function label(string $v): string
    {
        return e($v !== '' && Lang::has($v) ? __($v) : ($v ?: 'Untitled'));
    }

    private static function url(?string $route, ?string $url): string
    {
        if ($route && Route::has($route)) return route($route);
        if (!$url) return '#';
        if ($url[0] === '/') return $url;

        $p = @parse_url($url);
        if (!$p || empty($p['scheme'])) return '#';
        $s = strtolower($p['scheme']);
        return in_array($s, ['http', 'https'], true) ? $url : '#';
    }

    private static function icon(object $m): string
    {
        if (($m->icon_type ?? 'fa') === 'svg') {
            $svg = self::safeSvg((string) ($m->icon_svg ?? ''));
            return $svg !== '' ? $svg : '';
        }

        $cls = self::safeFa((string) ($m->icon_fa ?? ''));
        return '<i class="' . self::escAttr($cls) . ' tw-size-5"></i>';
    }

    private static function safeFa(string $c): string
    {
        return ($c !== '' && preg_match('/^[a-z0-9\- ]+$/i', $c)) ? $c : 'fa fa-circle';
    }

    private static function safeSvg(string $svg): string
    {
        if ($svg === '') return '';
        if (stripos($svg, '<script') !== false) return '';
        if (preg_match('/on\w+=/i', $svg)) return '';
        if (preg_match('/(?:javascript:|data:(?!image))/i', $svg)) return '';
        if (!str_contains($svg, '<svg')) return '';

        if (!preg_match('/\bwidth=|height=/i', $svg)) {
            $svg = preg_replace('/<svg\b/i', '<svg width="20" height="20"', $svg, 1);
        }
        return $svg;
    }

    private static function escAttr(string $v): string
    {
        return htmlspecialchars($v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
