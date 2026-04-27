<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'tool_title' => 'Digital Marketing Cost Calculator',
            'tool_tagline' => 'Get a precise marketing budget and strategy in seconds.',
            'main_cta_text' => 'Book Free Strategy Call',
            'support_email' => 'hello@mapsily.com',
            'lead_notification_email' => 'leads@mapsily.com',
            'footer_copyright' => 'Mapsily. All rights reserved.',
            'primary_color' => '#85f43a',
            'background_color' => '#1a1a1a',
            'card_bg_color' => '#242424',
            'text_main_color' => '#ffffff',
            'text_muted_color' => '#888888',
            'default_currency' => 'USD',
        ];

        foreach ($settings as $key => $value) {
            \App\Models\GeneralSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
