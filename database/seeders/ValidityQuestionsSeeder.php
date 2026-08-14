<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValidityQuestionsSeeder extends Seeder
{
    public function run()
    {
        // 6 Soal Validitas statis dari prototype data.js
        $questions = [
            ['id' => 51, 'question_text' => 'Saya berusaha membaca setiap pernyataan dengan cermat sebelum menjawab.', 'type' => 'module_consistency'],
            ['id' => 52, 'question_text' => 'Saya meluangkan waktu untuk memahami maksud sebuah pernyataan sebelum memilih jawaban.', 'type' => 'module_consistency'],
            ['id' => 53, 'question_text' => 'Saya tidak pernah merasa ragu ketika harus mengambil keputusan penting.', 'type' => 'module_authenticity'],
            ['id' => 54, 'question_text' => 'Saya selalu bisa mengendalikan emosi saya dalam situasi apa pun.', 'type' => 'module_authenticity'],
            ['id' => 55, 'question_text' => 'Saya cenderung memberi jawaban yang benar-benar mencerminkan diri saya, bukan yang terdengar ideal.', 'type' => 'module_consistency'],
            ['id' => 56, 'question_text' => 'Saya lebih memilih menjawab secara jujur meskipun jawabannya tidak terlihat sempurna.', 'type' => 'module_consistency'],
        ];

        $generalDriver = DB::table('drivers')->where('name', 'general')->first();
        if (!$generalDriver) {
            $driverId = DB::table('drivers')->insertGetId([
                'name' => 'general',
                'description' => 'General Driver',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $driverId = $generalDriver->id;
        }

        foreach ($questions as $q) {
            DB::table('questions')->updateOrInsert(
                ['id' => $q['id']],
                [
                    'question_text' => $q['question_text'],
                    'type'          => $q['type'],
                    'driver_id'     => $driverId,
                    'sub_driver_id' => null,
                    'order'         => $q['id'],
                    'is_active'     => true,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]
            );
        }
    }
}
