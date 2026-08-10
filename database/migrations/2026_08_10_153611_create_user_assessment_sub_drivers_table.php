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
        Schema::create('user_assessment_sub_drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_assessment_id')->constrained('user_assessments')->onDelete('cascade');
            $table->foreignId('sub_driver_id')->constrained('sub_drivers')->onDelete('cascade');
            $table->integer('score')->default(0)->comment('Score from 0 to 100');
            $table->timestamps();
            
            // Prevent duplicate entries for same sub driver on same assessment
            $table->unique(['user_assessment_id', 'sub_driver_id'], 'user_assessment_sub_driver_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_assessment_sub_drivers');
    }
};
