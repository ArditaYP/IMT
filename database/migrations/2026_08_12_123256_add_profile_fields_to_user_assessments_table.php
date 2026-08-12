<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('user_assessments', function (Blueprint $table) {
            $table->string('email')->nullable()->after('name');
            $table->string('dob')->nullable()->after('email');
            $table->string('job')->nullable()->after('dob');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_assessments', function (Blueprint $table) {
            $table->dropColumn(['email', 'dob', 'job']);
        });
    }
};
