<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['title', 'content', 'excerpt', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $fillable = [
        'title',
        'content',
        'image',
        'date',
        'slug',
        'excerpt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
        'published_at'
    ];

    protected $casts = [
        'date' => 'datetime',
        'is_active' => 'boolean',
        'published_at' => 'datetime'
    ];

    // Generate slug before saving
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($news) {
            if (!$news->slug) {
                // Lấy title từ ngôn ngữ mặc định
                $title = $news->getTranslation('title', app()->getLocale(), false) ?? '';
                $news->slug = Str::slug($title);
            }
        });
    }

    // Comments relationship
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Scope a query to only include active news.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured news.
     */
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include published news.
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('published_at', '<=', now())
              ->where('is_active', true);
    }

    /**
     * Scope a query to order by published date.
     */
    public function scopeLatest(Builder $query): void
    {
        $query->orderBy('published_at', 'desc');
    }

    /**
     * Scope a query to only include news from a specific category.
     */
    public function scopeCategory(Builder $query, string $category): void
    {
        $query->where('category', $category);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            $path = 'storage/news/' . $this->image;
            return asset($path);
        }
        return null;
    }
}
