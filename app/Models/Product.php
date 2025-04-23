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
                return asset($path);
            });
        }
        return collect([]);
    }

    // Document file name helper
    public static function generateDocumentFileName($originalName)
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);
        $timestamp = now()->format('Ymd_His');

        // Create a clean base filename (remove special characters)
        $cleanBaseName = Str::slug($baseName);

        // Generate new filename: original-name_YYYYMMDD_HHMMSS.extension
        return "{$cleanBaseName}_{$timestamp}.{$extension}";
    }

    // Get original document name (remove timestamp)
    public function getOriginalDocumentName($storedFileName)
    {
        // Extract the base name without the timestamp suffix
        $extension = pathinfo($storedFileName, PATHINFO_EXTENSION);
        $baseName = pathinfo($storedFileName, PATHINFO_FILENAME);

        // Remove the timestamp portion (_YYYYMMDD_HHMMSS)
        $originalName = preg_replace('/_\d{8}_\d{6}$/', '', $baseName);

        return $originalName . '.' . $extension;
    }

    // Document URLs accessor with original names
    public function getDocumentUrlsAttribute()
    {
        if ($this->documents) {
            return collect($this->documents)->map(function($document) {
                $path = 'storage/' . $document;
                $originalName = $this->getOriginalDocumentName(basename($document));

                return [
                    'url' => asset($path),
                    'path' => $document,
                    'original_name' => $originalName,
                    'extension' => pathinfo($document, PATHINFO_EXTENSION),
                    'size' => file_exists(public_path($path)) ? filesize(public_path($path)) : 0
                ];
            });
        }
        return collect([]);
    }
}
