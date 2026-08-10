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
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
            $table->foreignId('sub_driver_id')->nullable()->constrained('sub_drivers')->onDelete('cascade');
            $table->enum('type', ['normal', 'reverse'])->default('normal')->comment('Jenis pertanyaan: normal (1->1) atau reverse (1->5)');
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
