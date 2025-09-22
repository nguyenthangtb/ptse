<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;
class Introduce extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title', 'content', 'meta_title', 'meta_content', 'meta_keywords'];

    protected $table = 'introduce';

    protected $fillable = [
        'section',
        'title',
        'content',
        'meta_title',
        'meta_content',
        'meta_keywords',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($introduce) {
    //         if (!$introduce->slug) {
    //             $title = $introduce->getTranslation('title', app()->getLocale(), false) ?? '';
    //             $introduce->slug = Str::slug($title);
    //         }
    //     });
    // }
}
