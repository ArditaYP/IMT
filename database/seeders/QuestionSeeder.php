<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengisi 20 butir pertanyaan instrumen asesmen IMT Discovery (4 butir per Driver).
     */
    public function run(): void
    {
        $questions = [
            // =========================================================================
            // SIKLUS 1 (Soal 1 - 5)
            // =========================================================================
            [
                'id'              => 1,
                'question_text'   => 'Saya merasa jauh lebih tenang, fokus, dan produktif ketika segala sesuatunya memiliki rencana terstruktur, aturan yang jelas, dan risiko yang terkendali.',
                'driver'          => 'security',
                'reverse_scoring' => false,
                'order'           => 1,
                'is_active'       => true,
            ],
            [
                'id'              => 2,
                'question_text'   => 'Mendapatkan apresiasi nyata dan diakui atas keunikan serta keunggulan hasil karya saya adalah pendorong utama motivasi saya.',
                'driver'          => 'significance',
                'reverse_scoring' => false,
                'order'           => 2,
                'is_active'       => true,
            ],
            [
                'id'              => 3,
                'question_text'   => 'Bagi saya, kedekatan emosional, rasa saling percaya, dan kehangatan dalam hubungan personal jauh lebih berharga dibanding sekadar pencapaian individual.',
                'driver'          => 'connection',
                'reverse_scoring' => false,
                'order'           => 3,
                'is_active'       => true,
            ],
            [
                'id'              => 4,
                'question_text'   => 'Saya selalu merasa terdorong untuk terus belajar, menantang batas kemampuan diri, dan menolak berpuas diri dalam zona nyaman.',
                'driver'          => 'growth',
                'reverse_scoring' => false,
                'order'           => 4,
                'is_active'       => true,
            ],
            [
                'id'              => 5,
                'question_text'   => 'Kepuasan terbesar saya tercapai ketika waktu dan energi yang saya miliki memberikan manfaat nyata yang mengubah kehidupan orang lain menjadi lebih baik.',
                'driver'          => 'contribution',
                'reverse_scoring' => false,
                'order'           => 5,
                'is_active'       => true,
            ],

            // =========================================================================
            // SIKLUS 2 (Soal 6 - 10)
            // =========================================================================
            [
                'id'              => 6,
                'question_text'   => 'Sebelum mengambil keputusan penting atau memulai langkah baru, saya selalu memastikan ada fondasi dan kejelasan yang cukup aman terlebih dahulu.',
                'driver'          => 'security',
                'reverse_scoring' => false,
                'order'           => 6,
                'is_active'       => true,
            ],
            [
                'id'              => 7,
                'question_text'   => 'Saya terdorong untuk mencapai standar prestasi yang tinggi dan menciptakan karya bernilai yang membanggakan.',
                'driver'          => 'significance',
                'reverse_scoring' => false,
                'order'           => 7,
                'is_active'       => true,
            ],
            [
                'id'              => 8,
                'question_text'   => 'Saya merasa paling berenergi ketika bisa bekerja sama, saling mendukung, dan merasa diterima seutuhnya dalam sebuah lingkungan atau tim.',
                'driver'          => 'connection',
                'reverse_scoring' => false,
                'order'           => 8,
                'is_active'       => true,
            ],
            [
                'id'              => 9,
                'question_text'   => 'Saya sangat antusias ketika menemukan wawasan, ide, atau pengalaman baru yang memperluas cara pandang dan keterampilan saya.',
                'driver'          => 'growth',
                'reverse_scoring' => false,
                'order'           => 9,
                'is_active'       => true,
            ],
            [
                'id'              => 10,
                'question_text'   => 'Saya selalu tergerak untuk menolong, melayani, atau membimbing sesama demi kebaikan dan dampak positif yang lebih luas.',
                'driver'          => 'contribution',
                'reverse_scoring' => false,
                'order'           => 10,
                'is_active'       => true,
            ],

            // =========================================================================
            // SIKLUS 3 (Soal 11 - 15)
            // =========================================================================
            [
                'id'              => 11,
                'question_text'   => 'Saya sangat menghargai prediktabilitas dan konsistensi, sehingga saya cenderung menghindari situasi yang spekulatif atau serba mendadak tanpa persiapan matang.',
                'driver'          => 'security',
                'reverse_scoring' => false,
                'order'           => 11,
                'is_active'       => true,
            ],
            [
                'id'              => 12,
                'question_text'   => 'Saya merasa sangat termotivasi ketika apa yang saya kerjakan memiliki pengaruh positif yang signifikan dan membedakan saya dari standar rata-rata.',
                'driver'          => 'significance',
                'reverse_scoring' => false,
                'order'           => 12,
                'is_active'       => true,
            ],
            [
                'id'              => 13,
                'question_text'   => 'Saya secara alami sangat peka terhadap perasaan orang lain dan berusaha menciptakan lingkungan yang harmonis, suportif, serta bebas konflik.',
                'driver'          => 'connection',
                'reverse_scoring' => false,
                'order'           => 13,
                'is_active'       => true,
            ],
            [
                'id'              => 14,
                'question_text'   => 'Saya mudah merasa jenuh jika harus terus-menerus melakukan rutinitas yang monoton tanpa ada tantangan pembelajaran baru yang memicu inovasi.',
                'driver'          => 'growth',
                'reverse_scoring' => false,
                'order'           => 14,
                'is_active'       => true,
            ],
            [
                'id'              => 15,
                'question_text'   => 'Saya merasa hidup saya bermakna ketika apa yang saya miliki—baik ilmu, waktu, maupun tenaga—dapat dibagikan untuk meringankan beban orang lain.',
                'driver'          => 'contribution',
                'reverse_scoring' => false,
                'order'           => 15,
                'is_active'       => true,
            ],

            // =========================================================================
            // SIKLUS 4 (Soal 16 - 20)
            // =========================================================================
            [
                'id'              => 16,
                'question_text'   => 'Membangun stabilitas jangka panjang dan sistem yang terpercaya adalah prioritas utama bagi saya dalam bekerja dan menjalani kehidupan.',
                'driver'          => 'security',
                'reverse_scoring' => false,
                'order'           => 16,
                'is_active'       => true,
            ],
            [
                'id'              => 17,
                'question_text'   => 'Saya memiliki dorongan kuat untuk meninggalkan jejak warisan (legacy) dan pencapaian yang bernilai tinggi dalam perjalanan hidup saya.',
                'driver'          => 'significance',
                'reverse_scoring' => false,
                'order'           => 17,
                'is_active'       => true,
            ],
            [
                'id'              => 18,
                'question_text'   => 'Menjaga keakraban, rasa saling memiliki, dan membangun komunitas yang saling peduli adalah hal yang sangat membahagiakan bagi saya.',
                'driver'          => 'connection',
                'reverse_scoring' => false,
                'order'           => 18,
                'is_active'       => true,
            ],
            [
                'id'              => 19,
                'question_text'   => 'Bagi saya, hidup adalah proses transformasi berkelanjutan di mana saya harus terus mengevolusi diri menjadi versi yang jauh lebih baik setiap harinya.',
                'driver'          => 'growth',
                'reverse_scoring' => false,
                'order'           => 19,
                'is_active'       => true,
            ],
            [
                'id'              => 20,
                'question_text'   => 'Saya terdorong untuk berkontribusi pada misi sosial atau kemanusiaan yang lebih besar melampaui kepentingan diri saya sendiri.',
                'driver'          => 'contribution',
                'reverse_scoring' => false,
                'order'           => 20,
                'is_active'       => true,
            ],
        ];

        // Kosongkan dan isi ulang dengan 20 butir pertanyaan bersih
        DB::table('questions')->truncate();
        
        foreach ($questions as $q) {
            Question::create($q);
        }
    }
}
