<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\UserAssessment;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ScoringTest extends TestCase
{
    use DatabaseTransactions;

    public function test_reverse_scoring_and_score_calculation(): void
    {
        $qSecurity = Question::create([
            'question_text'   => 'Saya membutuhkan kepastian finansial.',
            'driver'          => 'Security',
            'reverse_scoring' => false,
            'is_active'       => true,
            'order'           => 1001,
        ]);

        $qReverseGrowth = Question::create([
            'question_text'   => 'Saya tidak suka mempelajari hal-hal baru yang sulit.',
            'driver'          => 'Growth',
            'reverse_scoring' => true,
            'is_active'       => true,
            'order'           => 1002,
        ]);

        // User menjawab:
        // - Security: 5 (Sangat Setuju) -> nilai efektif 5 -> (5-1)/4 * 100 = 100%
        // - Growth (reverse): 5 (Sangat Setuju) -> nilai efektif (6 - 5) = 1 -> (1-1)/4 * 100 = 0%
        $payload = [
            'participant_name' => 'Siti Nurhaliza',
            'answers'          => [
                $qSecurity->id      => 5,
                $qReverseGrowth->id => 5,
            ],
        ];

        $response = $this->post('/tes/submit', $payload);
        $response->assertStatus(302);

        $saved = UserAssessment::where('name', 'Siti Nurhaliza')->latest()->first();
        $this->assertNotNull($saved);
        $this->assertEquals(100.00, $saved->security_score);
        $this->assertEquals(0.00, $saved->growth_score);
    }
}
