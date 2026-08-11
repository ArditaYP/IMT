<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Driver;
use App\Models\SubDriver;

class AdditionalCoreQuestionsSeeder extends Seeder
{
    public function run()
    {
        // 1. Menghapus soal-soal validitas (module_consistency, module_authenticity, dll)
        Question::whereIn('type', [
            'authenticity', 
            'consistency', 
            'module_authenticity', 
            'module_consistency'
        ])->delete();

        // Bisa juga menghapus soal dengan driver = 'general' jika ada yang lolos
        Question::whereHas('driver', function ($q) {
            $q->where('name', 'general');
        })->delete();

        // 2. Menambahkan 10 Soal Core Baru untuk menyamaratakan sub-driver
        $newQuestions = [
            // SECURITY
            ['driver' => 'Security', 'sub' => 'authenticity', 'text' => 'Saya merasa bebas mengekspresikan pendapat dan perasaan asli saya tanpa takut dihakimi oleh lingkungan sekitar.'],
            ['driver' => 'Security', 'sub' => 'resilience', 'text' => 'Ketika menghadapi kegagalan yang berat, saya mampu segera memulihkan mental dan mencari jalan keluar yang baru.'],
            
            // SIGNIFICANCE
            ['driver' => 'Significance', 'sub' => 'competence', 'text' => 'Saya selalu meluangkan waktu untuk mengasah keahlian teknis saya agar hasil kerja saya diakui sebagai yang terbaik.'],
            ['driver' => 'Significance', 'sub' => 'confidence', 'text' => 'Saya merasa sangat yakin dengan kemampuan saya untuk memimpin dan mengambil keputusan dalam situasi yang penuh ketidakpastian.'],
            
            // CONNECTION
            ['driver' => 'Connection', 'sub' => 'intimacy', 'text' => 'Saya selalu membangun hubungan yang mendalam dan saling percaya dengan orang-orang terdekat saya.'],
            ['driver' => 'Connection', 'sub' => 'acceptance', 'text' => 'Saya mampu menerima kelemahan dan perbedaan pendapat orang lain tanpa berusaha menghakimi atau mengubah mereka.'],
            
            // GROWTH
            ['driver' => 'Growth', 'sub' => 'mastery', 'text' => 'Saya sangat termotivasi untuk menguasai suatu bidang secara mendalam hingga menjadi pakar di bidang tersebut.'],
            ['driver' => 'Growth', 'sub' => 'self_expansion', 'text' => 'Saya selalu mencari pengalaman baru yang memaksa saya keluar dari zona nyaman demi memperluas wawasan saya.'],
            
            // CONTRIBUTION
            ['driver' => 'Contribution', 'sub' => 'stewardship', 'text' => 'Saya merasa memiliki tanggung jawab moral untuk menjaga dan merawat lingkungan serta komunitas tempat saya berada.'],
            ['driver' => 'Contribution', 'sub' => 'legacy', 'text' => 'Saya selalu berpikir tentang dampak jangka panjang dari tindakan saya dan warisan apa yang akan saya tinggalkan untuk generasi mendatang.'],
        ];

        // Dapatkan max order saat ini agar soal baru ditaruh di paling belakang
        $maxOrder = Question::max('order') ?? 50;

        foreach ($newQuestions as $q) {
            $driver = Driver::where('name', $q['driver'])->first();
            $subDriver = SubDriver::where('name', $q['sub'])->first();

            if ($driver && $subDriver) {
                $maxOrder++;
                Question::create([
                    'question_text' => $q['text'],
                    'driver_id'     => $driver->id,
                    'sub_driver_id' => $subDriver->id,
                    'type'          => 'core',
                    'order'         => $maxOrder,
                    'is_active'     => true,
                ]);
            }
        }
    }
}
