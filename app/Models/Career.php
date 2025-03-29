<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Career extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'department',
        'location',
        'type',
        'short_description',
        'description',
        'requirements',
        'benefits',
        'salary_min',
        'salary_max',
        'deadline',
        'is_active'
    ];

    protected $casts = [
        'deadline' => 'date',
        'salary_min' => 'decimal:2',
        'salary_max' => 'decimal:2',
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

    // Scope for active jobs
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('deadline')
                    ->orWhere('deadline', '>=', now());
            });
    }

    // Get salary range
    public function getSalaryRangeAttribute()
    {
        if (!$this->salary_min && !$this->salary_max) {
            return 'Negotiable';
        }
        if (!$this->salary_max) {
            return 'From $' . number_format($this->salary_min);
        }
        if (!$this->salary_min) {
            return 'Up to $' . number_format($this->salary_max);
        }
        return '$' . number_format($this->salary_min) . ' - $' . number_format($this->salary_max);
    }
}
