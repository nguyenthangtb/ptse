<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
class Category extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['name', 'description', 'short_description', 'meta_title',
    'meta_description', 'meta_keywords'];

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'short_description',
        'parent_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Generate slug before saving
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            if (!$category->slug) {
                $title = $category->getTranslation('name', app()->getLocale(), false) ?? '';
                $category->slug = Str::slug($title);
            }
        });
    }

    // Parent category relationship
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Child categories relationship
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Products in this category
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        return asset('storage/' . $this->image);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }
}
