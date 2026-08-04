<?php

namespace Tests\Feature;

use App\Models\Question;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    /**
     * Test Landing page returns 200 OK.
     */
    public function test_landing_page_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test Interactive Test page returns 200 OK.
     */
    public function test_halaman_ujian_is_accessible(): void
    {
        $response = $this->get('/tes');
        $response->assertStatus(200);
    }

    /**
     * Test Submit Assessment Test redirects to Report page.
     */
    public function test_submit_test_calculates_and_redirects(): void
    {
        $questions = Question::all();
        $answers = [];
        foreach ($questions as $q) {
            $answers[$q->id] = 4; // Skor setuju (4)
        }

        $payload = [
            'participant_name' => 'Budi Pratama',
            'answers'          => $answers,
        ];

        $response = $this->post('/tes/submit', $payload);
        $response->assertStatus(302); // Redirects to /laporan/{id}
    }

    /**
     * Test Report page returns 200 OK.
     */
    public function test_laporan_page_is_accessible(): void
    {
        $response = $this->get('/laporan/1');
        $response->assertStatus(200);
    }
}
