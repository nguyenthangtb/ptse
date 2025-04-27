<?php

if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        return \App\Models\SystemSetting::get($key, $default);
    }
}

if (!function_exists('localized_url')) {
    function localized_url($locale)
    {
        $url = url()->current();
        $query = request()->query();
        $query['lang'] = $locale;

        return $url . '?' . http_build_query($query);
    }
}
