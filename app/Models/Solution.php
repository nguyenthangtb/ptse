<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Storage;
class Solution extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['title', 'description', 'short_description', 'meta_title',
    'meta_description', 'meta_keywords'];

    protected $fillable = [
        'title',
        'slug',
        'image',
        'short_description',
        'description',
        'features',
        'benefits',
        'gallery',
        'documents',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'order',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'benefits' => 'array',
        'gallery' => 'array',
        'documents' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            $path = 'storage/solutions/' . $this->image;
            return asset($path);
        }
        return null;
    }

    // Generate slug before saving
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($solution) {
            if (!$solution->slug) {
                $title = $solution->getTranslation('title', app()->getLocale(), false) ?? '';
                $solution->slug = Str::slug($title);
            }
        });
    }

    // // Related projects
    // public function projects()
    // {
    //     return $this->hasMany(Project::class);
    // }

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

    /**
     * Scope a query to only include active solutions.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured solutions.
     */
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }
}
