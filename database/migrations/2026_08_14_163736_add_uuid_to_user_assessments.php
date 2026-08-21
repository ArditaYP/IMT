<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_assessments', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->unique()->after('id');
        });

        // Generate UUID for existing records
        $assessments = \App\Models\UserAssessment::all();
        foreach ($assessments as $assessment) {
            $assessment->uuid = (string) Str::uuid();
            $assessment->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_assessments', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
