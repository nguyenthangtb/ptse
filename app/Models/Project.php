<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'client',
        'location',
        'image',
        'gallery',
        'short_description',
        'description',
        'solution',
        'results',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'solution_id',
        'is_featured',
        'is_active',
        'completion_date',
        'testimonials',
        'order',
        'status',

    ];

    protected $casts = [
        'gallery' => 'array',
        'completion_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Generate slug before saving
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            if (!$project->slug) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    // // Solution relationship
    // public function solution()
    // {
    //     return $this->belongsTo(Solution::class);
    // }

    // Comments relationship
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Scope a query to only include active projects.
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured projects.
     */
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    /**
     * Scope a query to only include completed projects.
     */
    public function scopeCompleted(Builder $query): void
    {
        $query->where('status', 'Completed');
    }

    /**
     * Scope a query to only include ongoing projects.
     */
    public function scopeOngoing(Builder $query): void
    {
        $query->where('status', 'Ongoing');
    }
}
