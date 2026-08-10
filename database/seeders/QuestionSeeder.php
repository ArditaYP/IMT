<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\SubDriver;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('questions')->truncate();
        DB::table('sub_drivers')->truncate();
        DB::table('drivers')->truncate();
        Schema::enableForeignKeyConstraints();

        // 1. Seed Drivers & Dummy Sub-Drivers
        $driverNames = ['security', 'significance', 'connection', 'growth', 'contribution'];
        $driversMap = [];

        foreach ($driverNames as $name) {
            $driver = Driver::create(['name' => $name]);
            
            // Create dummy sub-drivers
            $sub1 = SubDriver::create(['driver_id' => $driver->id, 'name' => ucfirst($name) . ' - Aspek 1']);
            $sub2 = SubDriver::create(['driver_id' => $driver->id, 'name' => ucfirst($name) . ' - Aspek 2']);
            
            $driversMap[$name] = [
                'id' => $driver->id,
                'sub_ids' => [$sub1->id, $sub2->id]
            ];
        }

        // 2. Map old questions to new format
        $oldQuestions = [
            // =========================================================================
            // SIKLUS 1 (Soal 1 - 5)
            // =========================================================================
            [
                'question_text'   => 'Saya merasa jauh lebih tenang, fokus, dan produktif ketika segala sesuatunya memiliki rencana terstruktur, aturan yang jelas, dan risiko yang terkendali.',
                'driver'          => 'security',
                'type'            => 'normal',
                'order'           => 1,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Mendapatkan apresiasi nyata dan diakui atas keunikan serta keunggulan hasil karya saya adalah pendorong utama motivasi saya.',
                'driver'          => 'significance',
                'type'            => 'normal',
                'order'           => 2,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Bagi saya, kedekatan emosional, rasa saling percaya, dan kehangatan dalam hubungan personal jauh lebih berharga dibanding sekadar pencapaian individual.',
                'driver'          => 'connection',
                'type'            => 'normal',
                'order'           => 3,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya selalu merasa terdorong untuk terus belajar, menantang batas kemampuan diri, dan menolak berpuas diri dalam zona nyaman.',
                'driver'          => 'growth',
                'type'            => 'normal',
                'order'           => 4,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Kepuasan terbesar saya tercapai ketika waktu dan energi yang saya miliki memberikan manfaat nyata yang mengubah kehidupan orang lain menjadi lebih baik.',
                'driver'          => 'contribution',
                'type'            => 'normal',
                'order'           => 5,
                'is_active'       => true,
            ],

            // =========================================================================
            // SIKLUS 2 (Soal 6 - 10)
            // =========================================================================
            [
                'question_text'   => 'Sebelum mengambil keputusan penting atau memulai langkah baru, saya selalu memastikan ada fondasi dan kejelasan yang cukup aman terlebih dahulu.',
                'driver'          => 'security',
                'type'            => 'normal',
                'order'           => 6,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya terdorong untuk mencapai standar prestasi yang tinggi dan menciptakan karya bernilai yang membanggakan.',
                'driver'          => 'significance',
                'type'            => 'normal',
                'order'           => 7,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya merasa paling berenergi ketika bisa bekerja sama, saling mendukung, dan merasa diterima seutuhnya dalam sebuah lingkungan atau tim.',
                'driver'          => 'connection',
                'type'            => 'normal',
                'order'           => 8,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya sangat antusias ketika menemukan wawasan, ide, atau pengalaman baru yang memperluas cara pandang dan keterampilan saya.',
                'driver'          => 'growth',
                'type'            => 'normal',
                'order'           => 9,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya selalu tergerak untuk menolong, melayani, atau membimbing sesama demi kebaikan dan dampak positif yang lebih luas.',
                'driver'          => 'contribution',
                'type'            => 'normal',
                'order'           => 10,
                'is_active'       => true,
            ],

            // =========================================================================
            // SIKLUS 3 (Soal 11 - 15)
            // =========================================================================
            [
                'question_text'   => 'Saya sangat menghargai prediktabilitas dan konsistensi, sehingga saya cenderung menghindari situasi yang spekulatif atau serba mendadak tanpa persiapan matang.',
                'driver'          => 'security',
                'type'            => 'normal',
                'order'           => 11,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya merasa sangat termotivasi ketika apa yang saya kerjakan memiliki pengaruh positif yang signifikan dan membedakan saya dari standar rata-rata.',
                'driver'          => 'significance',
                'type'            => 'normal',
                'order'           => 12,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya secara alami sangat peka terhadap perasaan orang lain dan berusaha menciptakan lingkungan yang harmonis, suportif, serta bebas konflik.',
                'driver'          => 'connection',
                'type'            => 'normal',
                'order'           => 13,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya mudah merasa jenuh jika harus terus-menerus melakukan rutinitas yang monoton tanpa ada tantangan pembelajaran baru yang memicu inovasi.',
                'driver'          => 'growth',
                'type'            => 'normal',
                'order'           => 14,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya merasa hidup saya bermakna ketika apa yang saya miliki—baik ilmu, waktu, maupun tenaga—dapat dibagikan untuk meringankan beban orang lain.',
                'driver'          => 'contribution',
                'type'            => 'normal',
                'order'           => 15,
                'is_active'       => true,
            ],

            // =========================================================================
            // SIKLUS 4 (Soal 16 - 20)
            // =========================================================================
            [
                'question_text'   => 'Membangun stabilitas jangka panjang dan sistem yang terpercaya adalah prioritas utama bagi saya dalam bekerja dan menjalani kehidupan.',
                'driver'          => 'security',
                'type'            => 'normal',
                'order'           => 16,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya memiliki dorongan kuat untuk meninggalkan jejak warisan (legacy) dan pencapaian yang bernilai tinggi dalam perjalanan hidup saya.',
                'driver'          => 'significance',
                'type'            => 'normal',
                'order'           => 17,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Menjaga keakraban, rasa saling memiliki, dan membangun komunitas yang saling peduli adalah hal yang sangat membahagiakan bagi saya.',
                'driver'          => 'connection',
                'type'            => 'normal',
                'order'           => 18,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Bagi saya, hidup adalah proses transformasi berkelanjutan di mana saya harus terus mengevolusi diri menjadi versi yang jauh lebih baik setiap harinya.',
                'driver'          => 'growth',
                'type'            => 'normal',
                'order'           => 19,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya terdorong untuk berkontribusi pada misi sosial atau kemanusiaan yang lebih besar melampaui kepentingan diri saya sendiri.',
                'driver'          => 'contribution',
                'type'            => 'normal',
                'order'           => 20,
                'is_active'       => true,
            ],
            // =========================================================================
            // SIKLUS 5 (Contoh Soal Reverse - ID 21-25)
            // =========================================================================
            [
                'question_text'   => 'Saya merasa sangat bosan dan terkekang jika terlalu banyak aturan, prosedur, atau rencana tetap dalam hidup saya.',
                'driver'          => 'security',
                'type'            => 'reverse',
                'order'           => 21,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Bagi saya, pengakuan dari orang lain sama sekali tidak penting selama saya sendiri merasa puas dengan hasil kerja saya.',
                'driver'          => 'significance',
                'type'            => 'reverse',
                'order'           => 22,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya lebih suka bekerja dan menyelesaikan masalah sepenuhnya sendirian tanpa harus melibatkan emosi atau pendapat orang lain.',
                'driver'          => 'connection',
                'type'            => 'reverse',
                'order'           => 23,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Saya merasa sangat nyaman dengan cara kerja saya saat ini dan tidak merasa perlu repot-repot mempelajari skill atau metode baru.',
                'driver'          => 'growth',
                'type'            => 'reverse',
                'order'           => 24,
                'is_active'       => true,
            ],
            [
                'question_text'   => 'Tanggung jawab utama saya adalah memastikan kesuksesan diri sendiri terlebih dahulu; mengurus masalah orang lain hanya akan menguras energi saya.',
                'driver'          => 'contribution',
                'type'            => 'reverse',
                'order'           => 25,
                'is_active'       => true,
            ],
        ];

        foreach ($oldQuestions as $index => $q) {
            $driverKey = $q['driver'];
            $map = $driversMap[$driverKey];
            
            // Assign dummy sub_driver alternately
            $subDriverId = $map['sub_ids'][$index % 2]; 

            Question::create([
                'question_text' => $q['question_text'],
                'driver_id'     => $map['id'],
                'sub_driver_id' => $subDriverId,
                'type'          => $q['type'],
                'order'         => $q['order'],
                'is_active'     => $q['is_active'],
            ]);
        }
    }
}

