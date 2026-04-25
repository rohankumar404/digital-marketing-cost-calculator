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
        Schema::create('usage_limits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete(); // Remove usage record when user is deleted

            // Number of calculations the user has run (used for free-tier throttling)
            $table->unsignedInteger('usage_count')->default(0);

            // Tracks the most recent calculation time for rate-limit windows
            $table->timestamp('last_used_at')->nullable();

            $table->timestamps();

            // One row per user
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usage_limits');
    }
};
