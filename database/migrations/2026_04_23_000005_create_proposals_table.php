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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete(); // Delete proposal record when user is deleted

            $table->foreignId('calculation_id')
                  ->constrained('calculations')
                  ->cascadeOnDelete(); // Delete proposal record when parent calculation is deleted

            // Relative path to the generated PDF/DOCX stored on disk
            // e.g. 'proposals/user_5/proposal_2026-04-23.pdf'
            $table->string('file_path');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
