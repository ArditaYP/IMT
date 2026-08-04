<?php

use App\Enums\DriverType;
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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question_text');
            $table->string('driver', 30)->index()->comment('Driver: security, significance, connection, growth, contribution');
            $table->boolean('reverse_scoring')->default(false)->comment('Apakah skor dibalik (1->5, 5->1)');
            $table->unsignedInteger('order')->default(0)->comment('Urutan tampilan pertanyaan');
            $table->boolean('is_active')->default(true)->comment('Status aktif pertanyaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
