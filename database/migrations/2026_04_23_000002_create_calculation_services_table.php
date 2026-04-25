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
        Schema::create('calculation_services', function (Blueprint $table) {
            $table->id();

            $table->foreignId('calculation_id')
                  ->constrained('calculations')
                  ->cascadeOnDelete(); // Remove services when parent calculation is deleted

            $table->string('service_name');          // e.g. SEO, PPC, Social Media, Email Marketing
            $table->json('inputs');                  // Flexible JSON: keywords, budget, platforms, etc.
            $table->decimal('estimated_cost', 12, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculation_services');
    }
};
