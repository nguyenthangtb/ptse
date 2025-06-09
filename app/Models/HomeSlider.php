<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class HomeSlider extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    public $translatable = ['title', 'subtitle', 'button_text'];

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'button_text',
        'button_url',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
