<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingSetting extends Model
{
    protected $fillable = [
        'service_name',
        'key_name',
        'value',
    ];

    // -------------------------------------------------------------------------
    // Convenience helpers
    // -------------------------------------------------------------------------

    /**
     * Retrieve the value for a specific service + key combination.
     *
     * Usage:
     *   $costPerKeyword = PricingSetting::findSetting('SEO', 'cost_per_keyword');
     *
     * @param  string  $service  e.g. 'SEO', 'PPC'
     * @param  string  $key      e.g. 'cost_per_keyword', 'base_monthly_fee'
     * @return string|null
     */
    public static function findSetting(string $service, string $key): ?string
    {
        return static::where('service_name', $service)
            ->where('key_name', $key)
            ->value('value');
    }

    /**
     * Retrieve all settings for a given service as a key => value array.
     *
     * Usage:
     *   $seoSettings = PricingSetting::forService('SEO');
     *
     * @param  string  $service
     * @return array<string, string>
     */
    public static function forService(string $service): array
    {
        return static::where('service_name', $service)
            ->pluck('value', 'key_name')
            ->toArray();
    }
}
