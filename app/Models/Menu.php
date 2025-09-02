<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;

class Menu extends Model
{
    protected $fillable = [
        'parent_id',
        'label',
        'route',
        'url',
        'icon_type',
        'icon_svg',
        'icon_fa',
        'permission',
        'module',
        'extra',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'extra' => 'array',
        'is_active' => 'bool',
    ];

    public function setExtraAttribute($value)
    {
        if ($value === '' || $value === null) {
            $this->attributes['extra'] = null;
        } else {
            $this->attributes['extra'] = is_array($value) ? json_encode($value) : $value;
        }
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }
    
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $menu) {
            if ($menu->id && $menu->parent_id == $menu->id) {
                $menu->parent_id = null;
            }
        });
    }

    public function isVisibleToCurrentUser(): bool
    {
        if (blank($this->permission)) {
            return true;
        }

        foreach (explode('|', $this->permission) as $perm) {
            if (Gate::allows(trim($perm))) return true;
        }
        return false;
    }

    public function scopeActive($q)
    {
        $q->where('is_active', true);
    }
}
