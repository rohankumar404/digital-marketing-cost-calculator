<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['code' => 'USD', 'symbol' => '$', 'rate' => 1.0000, 'is_default' => true],
            ['code' => 'INR', 'symbol' => '₹', 'rate' => 83.2000, 'is_default' => false],
            ['code' => 'EUR', 'symbol' => '€', 'rate' => 0.9200, 'is_default' => false],
            ['code' => 'GBP', 'symbol' => '£', 'rate' => 0.7900, 'is_default' => false],
            ['code' => 'AED', 'symbol' => 'د.إ', 'rate' => 3.6700, 'is_default' => false],
        ];

        foreach ($currencies as $currency) {
            \App\Models\Currency::updateOrCreate(['code' => $currency['code']], $currency);
        }
    }
}
