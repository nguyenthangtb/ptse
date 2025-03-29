<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class Solution extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'short_description',
        'description',
        'features',
        'benefits',
        'gallery',
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
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Generate slug before saving
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($solution) {
            if (!$solution->slug) {
                $solution->slug = Str::slug($solution->title);
            }
        });
    }

    // Related projects
    public function projects()
    {
        return $this->hasMany(Project::class);
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
