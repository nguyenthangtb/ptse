<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'template',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'order',
        'show_in_menu',
        'is_active'
    ];

    protected $casts = [
        'show_in_menu' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Generate slug before saving
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($page) {
            if (!$page->slug) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    // Scope for menu items
    public function scopeInMenu($query)
    {
        return $query->where('show_in_menu', true)->where('is_active', true);
    }

    // Scope for active pages
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
