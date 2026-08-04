<?php

namespace Database\Seeders;

use App\Models\UserAssessment;
use Illuminate\Database\Seeder;

class UserAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserAssessment::updateOrCreate(
            ['id' => 1],
            [
                'name'               => 'Budi Pratama',
                'security_score'     => 65.00,
                'significance_score' => 88.00,
                'connection_score'   => 54.00,
                'growth_score'       => 92.50,
                'contribution_score' => 70.00,
                'archetype_name'     => 'The Ambitious Pioneer (Growth & Significance)',
            ]
        );
    }
}
