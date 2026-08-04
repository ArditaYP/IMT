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
        Schema::create('assessment_answers', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke sesi asesmen dan soal
            $table->foreignId('user_assessment_id')
                ->constrained('user_assessments')
                ->cascadeOnDelete();

            $table->foreignId('question_id')
                ->constrained('questions')
                ->cascadeOnDelete();

            // Pilihan skor user: skala Likert 1-5 (atau 1-7 sesuai instrumen)
            $table->unsignedTinyInteger('score')->comment('Skor jawaban pilihan user (skala 1-5)');
            
            $table->timestamps();

            // Memastikan 1 pertanyaan hanya dijawab 1 kali dalam 1 sesi asesmen
            $table->unique(['user_assessment_id', 'question_id'], 'unique_user_assessment_question');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_answers');
    }
};
