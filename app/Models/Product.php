<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'short_description',
        'description',
        'specifications',
        'gallery',
        'documents',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'category_id',
        'order',
        'is_featured',
        'is_active',
        'price',
    ];

    protected $casts = [
        'specifications' => 'array',
        'gallery' => 'array',
        'documents' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Generate slug before saving
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            if (!$product->slug) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    // Category relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Product views relationship
    public function views()
    {
        return $this->hasMany(ProductView::class);
    }

    // Comments relationship
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // Image URL accessor
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            $path = 'storage/products/' . $this->image;
            $fullPath = public_path($path);
            \Log::info('Image path check:', [
                'image_field' => $this->image,
                'constructed_path' => $path,
                'full_path' => $fullPath,
                'exists' => file_exists($fullPath)
            ]);
            return asset($path);
        }
        return null;
    }

    // Gallery URLs accessor
    public function getGalleryUrlsAttribute()
    {
        if ($this->gallery) {
            return collect($this->gallery)->map(function($image) {
                $path = 'storage/products/' . $image;
                $fullPath = public_path($path);
                \Log::info('Gallery image path check:', [
                    'image_name' => $image,
                    'constructed_path' => $path,
                    'full_path' => $fullPath,
                    'exists' => file_exists($fullPath)
                ]);
                return asset($path);
            });
        }
        return collect([]);
    }
}
