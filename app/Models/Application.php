<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'career_id',
        'name',
        'email',
        'phone',
        'resume',
        'cover_letter',
        'linkedin',
        'status',
        'notes',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Get the career that the application belongs to.
     */
    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    /**
     * Get the resume URL attribute.
     *
     * @return string|null
     */
    public function getResumeUrlAttribute()
    {
        if ($this->resume) {
            return asset('storage/' . $this->resume);
        }

        return null;
    }

    /**
     * Get the resume filename attribute.
     *
     * @return string|null
     */
    public function getResumeFilenameAttribute()
    {
        if ($this->resume) {
            return pathinfo($this->resume, PATHINFO_BASENAME);
        }

        return null;
    }
}
