<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

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
    ];

    // Tự động tạo slug
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
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
