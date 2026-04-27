<?php

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        return Cache::rememberForever("setting.$key", function () use ($key, $default) {
            $setting = GeneralSetting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }
}

if (!function_exists('get_currencies')) {
    function get_currencies()
    {
        return Cache::rememberForever("all_currencies", function () {
            return \App\Models\Currency::all();
        });
    }
}
