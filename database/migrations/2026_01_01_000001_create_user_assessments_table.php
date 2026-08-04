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
        Schema::create('user_assessments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Nama peserta asesmen');
            
            // Skor 5 Human Drivers (0-100)
            $table->decimal('security_score', 5, 2)->default(0.00);
            $table->decimal('significance_score', 5, 2)->default(0.00);
            $table->decimal('connection_score', 5, 2)->default(0.00);
            $table->decimal('growth_score', 5, 2)->default(0.00);
            $table->decimal('contribution_score', 5, 2)->default(0.00);
            
            // Kolom Archetype hasil asesmen
            $table->string('archetype_name')->nullable()->comment('Nama Archetype dari kombinasi driver');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_assessments');
    }
};
