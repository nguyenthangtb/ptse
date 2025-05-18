<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;
class Service extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title', 'description'];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'video_url',
        'thumbnail',
        'status',
        'order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
        'images' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($service) {
            if (!$service->slug) {
                $title = $service->getTranslation('title', app()->getLocale(), false) ?? '';
                $service->slug = Str::slug($title);
            }
        });
    }


    // Lấy YouTube Video ID từ URL
    public function getYoutubeIdAttribute()
    {
        if (empty($this->video_url)) {
            return null;
        }

        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->video_url, $matches);

        return isset($matches[1]) ? $matches[1] : null;
    }

    // Lấy Embed URL cho video
    public function getEmbedUrlAttribute()
    {
        $youtube_id = $this->youtube_id;

        if (!$youtube_id) {
            return null;
        }

        return "https://www.youtube.com/embed/{$youtube_id}";
    }

    public function getImageAttribute()
    {
        if ($this->images) {
            $path = 'storage/services/' . $this->images;
            return asset($path);
        }
        return null;
    }

    // Scope cho các video đang hoạt động
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope sắp xếp theo thứ tự
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
