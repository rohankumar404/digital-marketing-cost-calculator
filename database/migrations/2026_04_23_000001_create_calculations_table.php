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
        Schema::create('calculations', function (Blueprint $table) {
            $table->id();

            // Nullable so guest users can save calculations without an account
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->string('business_type');         // e.g. B2B, B2C, eCommerce
            $table->string('industry');              // e.g. Healthcare, SaaS, Retail
            $table->string('target_location');       // e.g. US, UK, Global
            $table->decimal('monthly_revenue', 15, 2)->nullable(); // Current monthly revenue
            $table->string('growth_stage');          // e.g. Startup, Growth, Enterprise

            $table->decimal('total_cost', 12, 2);   // Sum of all service costs
            $table->string('roi_range')->nullable(); // e.g. "3x – 5x" returned as a readable range

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculations');
    }
};
