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
        Schema::table('user_assessments', function (Blueprint $table) {
            if (!Schema::hasColumn('user_assessments', 'ai_narasi')) {
                $table->json('ai_narasi')->nullable()->after('archetype_name')->comment('Hasil narasi psikologi dari AI');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_assessments', function (Blueprint $table) {
            if (Schema::hasColumn('user_assessments', 'ai_narasi')) {
                $table->dropColumn('ai_narasi');
            }
        });
    }
};
