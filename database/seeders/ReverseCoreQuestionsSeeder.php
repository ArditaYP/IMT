<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Driver;
use App\Models\SubDriver;

class ReverseCoreQuestionsSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            // SECURITY
            ['driver' => 'Security', 'sub' => 'Stability', 'text' => 'Saya benci merencanakan masa depan keuangan atau karier, dan lebih suka membiarkan semuanya mengalir begitu saja.'],
            ['driver' => 'Security', 'sub' => 'Certainty', 'text' => 'Saya sering kali langsung melompat ke dalam situasi baru tanpa memikirkan atau mencari tahu risikonya terlebih dahulu.'],
            ['driver' => 'Security', 'sub' => 'Trustworthiness', 'text' => 'Tidak masalah bagi saya jika janji yang saya buat tidak ditepati, selama saya punya alasan yang bagus pada saat itu.'],
            ['driver' => 'Security', 'sub' => 'Authenticity', 'text' => 'Saya sering berpura-pura menyetujui sesuatu yang tidak saya percayai, hanya agar lingkungan sekitar saya tidak terganggu.'],
            ['driver' => 'Security', 'sub' => 'Resilience', 'text' => 'Saat rencana saya gagal, saya butuh waktu yang sangat lama untuk bisa kembali fokus dan mencoba hal lain.'],
            
            // SIGNIFICANCE
            ['driver' => 'Significance', 'sub' => 'Recognition', 'text' => 'Saya merasa sangat tidak nyaman dan ingin bersembunyi ketika orang lain secara terbuka memuji hasil kerja keras saya.'],
            ['driver' => 'Significance', 'sub' => 'Achievement', 'text' => 'Saya tidak tertarik menetapkan target besar; mencapai hasil rata-rata saja sudah lebih dari cukup bagi saya.'],
            ['driver' => 'Significance', 'sub' => 'Self-Worth', 'text' => 'Saya sangat bergantung pada pujian orang lain untuk merasa berharga, dan merasa terpuruk jika tidak ada yang memuji.'],
            ['driver' => 'Significance', 'sub' => 'Competence', 'text' => 'Saya lebih memilih pekerjaan yang tidak menuntut keahlian apa pun, asalkan saya bisa bersantai.'],
            ['driver' => 'Significance', 'sub' => 'Confidence', 'text' => 'Saya selalu meragukan kemampuan saya sendiri setiap kali dihadapkan pada tugas yang belum pernah saya lakukan.'],
            
            // CONNECTION
            ['driver' => 'Connection', 'sub' => 'Belonging', 'text' => 'Saya merasa bekerja sendiri jauh lebih menyenangkan daripada harus merasa menjadi bagian dari sebuah kelompok atau tim.'],
            ['driver' => 'Connection', 'sub' => 'Trust', 'text' => 'Saya pada dasarnya selalu menaruh rasa curiga pada niat orang lain, bahkan kepada mereka yang sudah saya kenal.'],
            ['driver' => 'Connection', 'sub' => 'Empathy', 'text' => 'Menurut saya, memahami perasaan atau masalah emosional orang lain bukanlah tanggung jawab saya sama sekali.'],
            ['driver' => 'Connection', 'sub' => 'Intimacy', 'text' => 'Saya menjaga jarak dengan semua orang dan memastikan tidak ada percakapan yang masuk terlalu dalam secara personal.'],
            ['driver' => 'Connection', 'sub' => 'Acceptance', 'text' => 'Saya merasa sangat sulit menerima atau bekerja sama dengan orang yang pandangannya berbeda dengan saya.'],
            
            // GROWTH
            ['driver' => 'Growth', 'sub' => 'Curiosity', 'text' => 'Saya sama sekali tidak tertarik mencari tahu bagaimana sesuatu bekerja selama hal tersebut tidak langsung menguntungkan saya.'],
            ['driver' => 'Growth', 'sub' => 'Learning', 'text' => 'Membaca buku atau mencari ilmu baru setelah lulus dari sekolah/kuliah terasa membuang-buang waktu bagi saya.'],
            ['driver' => 'Growth', 'sub' => 'Adaptability', 'text' => 'Saya sangat terpukul dan menolak keras setiap kali ada perubahan mendadak pada cara saya biasa bekerja.'],
            ['driver' => 'Growth', 'sub' => 'Mastery', 'text' => 'Saya selalu mencari cara untuk menyelesaikan pekerjaan seadanya dan secepat mungkin tanpa mempedulikan kualitasnya.'],
            ['driver' => 'Growth', 'sub' => 'Self-Expansion', 'text' => 'Keluar dari zona nyaman adalah hal bodoh; saya akan selalu memilih hal-hal yang sudah sangat saya kuasai.'],
            
            // CONTRIBUTION
            ['driver' => 'Contribution', 'sub' => 'Service', 'text' => 'Saya tidak akan pernah secara sukarela menawarkan bantuan kecuali saya diinstruksikan atau digaji untuk melakukannya.'],
            ['driver' => 'Contribution', 'sub' => 'Value Creation', 'text' => 'Tujuan utama pekerjaan saya hanyalah mencari uang, saya tidak peduli apakah hasil kerja saya berguna bagi orang lain atau tidak.'],
            ['driver' => 'Contribution', 'sub' => 'Influence', 'text' => 'Saya tidak tertarik untuk memberikan pengaruh atau mengajak orang lain bertindak lebih baik; itu urusan mereka sendiri.'],
            ['driver' => 'Contribution', 'sub' => 'Stewardship', 'text' => 'Dampak jangka panjang bagi lingkungan atau masyarakat bukanlah urusan saya, yang penting proyek saat ini cepat selesai.'],
            ['driver' => 'Contribution', 'sub' => 'Legacy', 'text' => 'Saya sama sekali tidak peduli tentang apa yang akan orang ingat tentang saya setelah saya pergi atau pensiun nanti.']
        ];

        // Mulai order dari 100 agar ditempatkan di akhir. Order bisa diubah di admin.
        $currentOrder = 100;
        $insertData = [];

        foreach ($questions as $q) {
            $driver = Driver::where('name', $q['driver'])->first();
            $subDriver = SubDriver::where('name', $q['sub'])->first();

            if ($driver && $subDriver) {
                $insertData[] = [
                    'driver_id' => $driver->id,
                    'sub_driver_id' => $subDriver->id,
                    'question_text' => $q['text'],
                    'type' => 'reverse core',
                    'order' => $currentOrder++,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('questions')->insert($insertData);
    }
}
