<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get a config value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        $config = static::where('key', $key)->where('is_active', true)->first();

        if (!$config) {
            return $default;
        }

        return trim($config->value);
    }

    /**
     * Set a config value
     *
     * @param string $key
     * @param mixed $value
     * @return WebsiteConfig
     */
    public static function set(string $key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => trim($value)]
        );
    }
}
