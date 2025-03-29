<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    protected static function booted()
    {
        static::saving(function ($setting) {
            if (is_array($setting->value)) {
                $setting->value = json_encode($setting->value);
            }
        });
    }
}
