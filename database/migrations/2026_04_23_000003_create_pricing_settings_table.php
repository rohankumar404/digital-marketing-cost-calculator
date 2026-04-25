<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pricing_settings', function (Blueprint $table) {
            $table->id();

            // e.g. 'SEO', 'PPC', 'Social Media', 'Email Marketing', 'Content Marketing'
            $table->string('service_name');

            // e.g. 'cost_per_keyword', 'base_monthly_fee', 'cost_per_click', 'platform_multiplier'
            $table->string('key_name');

            // Stored as string to support both numeric values and special strings (e.g. multiplier maps)
            $table->string('value');

            $table->timestamps();

            // Ensure each service/key pair is unique so updates are unambiguous
            $table->unique(['service_name', 'key_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_settings');
    }
};
