<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Career extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    /**
     * The attributes that should be translatable.
     *
     * @var array
     */
    public $translatable = [
        'title',
        'short_description',
        'description',
        'requirements',
        'benefits',
        'location',
        'department',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'requirements',
        'benefits',
        'type',
        'location',
        'salary_min',
        'deadline',
        'image',
        'is_active',
        'department',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'deadline' => 'date',
        'is_active' => 'boolean',
    ];

    // Generate slug before saving
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($career) {
            if (!$career->slug) {
                $career->slug = Str::slug($career->title);
            }
        });
    }

    /**
     * Scope a query to only include active careers.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the applications for the career.
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Get the image URL attribute.
     *
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/careers/' . $this->image);
        }
        return null;
    }
}
