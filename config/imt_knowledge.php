<?php

return [

    /*
    |--------------------------------------------------------------------------
    | IMT DISCOVERY OFFICIAL PSYCHOLOGICAL KNOWLEDGE BASE
    |--------------------------------------------------------------------------
    | 100% Verbatim & Sesuai dengan Dokumen Word IMT Discovery Interpretation Guide:
    | 1. Driver Security.docx
    | 2. Driver Significance.docx
    | 3. Driver Connection.docx
    | 4. Driver Growth.docx
    | 5. Driver Contribution
    |--------------------------------------------------------------------------
    */

    'drivers' => [

        // =========================================================================
        // 1. DRIVER 1 — SECURITY
        // =========================================================================
        'security' => [
            'name'                  => 'Security',
            'official_name'         => 'SECURITY',
            'tagline'               => 'Kebutuhan Stabilitas, Kepastian & Fondasi',
            'color'                 => '#2f6fed',
            'description'           => 'Security adalah Driver psikologis yang mendorong individu untuk menciptakan rasa aman, stabilitas, prediktabilitas, keandalan, dan ketahanan dalam kehidupannya. Individu dengan Driver Security yang kuat cenderung berusaha membangun fondasi yang kokoh sebelum mengambil risiko, membuat keputusan penting, atau memasuki situasi yang tidak pasti.',
            'core_need'             => 'Saya ingin merasa aman untuk menjalani hidup.',
            'core_fear'             => 'Saya kehilangan kendali, tidak memiliki fondasi yang aman, atau menghadapi ketidakpastian yang mengancam stabilitas hidup saya.',
            'composite_drivers'     => [
                'Resilience'       => 'Kemampuan bangkit dari kesulitan.',
                'Authenticity'     => 'Kemampuan hidup selaras dengan diri yang sejati.',
                'Trustworthiness'  => 'Kemampuan membangun kepercayaan dan integritas.',
                'Certainty'        => 'Kebutuhan terhadap kejelasan dan prediktabilitas.',
                'Stability'        => 'Kebutuhan terhadap keteraturan dan konsistensi.',
            ],
            'what_it_is_not'        => [
                'Bukan ketakutan',
                'Bukan kemalasan',
                'Bukan menolak perubahan',
                'Bukan tidak ambisius',
                'Bukan tidak berani mengambil risiko',
            ],
            'positive_traits'       => ['Konsisten', 'Dapat Diandalkan', 'Rasional', 'Bertanggung Jawab', 'Manajemen Risiko Matang'],
            'potential_blindspot'   => 'Terlalu berhati-hati, lambat mengambil keputusan (Over-analysis), atau cemas berlebihan terhadap perubahan mendadak.',
            'healthy_state'         => [
                'quote' => 'Saya membangun fondasi yang aman agar saya bisa bertumbuh dan mengambil risiko terukur dengan percaya diri.',
                'desc'  => 'Menciptakan stabilitas, kejelasan proses, konsistensi, dan manajemen risiko yang matang tanpa menghambat inovasi.',
            ],
            'shadow_state'          => [
                'quote' => 'Saya harus mengendalikan segalanya agar tidak ada hal buruk yang terjadi.',
                'desc'  => 'Terjebak dalam rasa takut akan ketidakpastian, penolakan terhadap perubahan, over-control, dan kecemasan berlebihan.',
            ],
            'core_challenge'        => 'Menjadi cukup aman untuk bertumbuh dan belajar bahwa tidak semua ketidakpastian berbahaya.',
            'key_question'          => 'Apakah saya mencari keamanan untuk membangun fondasi bertumbuh, atau untuk bersembunyi dari tantangan hidup?',
            'development_principle' => 'Security yang sehat bukan menciptakan kehidupan tanpa risiko, melainkan menciptakan fondasi yang cukup kuat untuk menghadapi risiko dengan tenang dan percaya diri.',
            
            'levels' => [
                1 => [
                    'name'              => 'The Drifter',
                    'level_label'       => 'Very Low Security',
                    'desc'              => 'Individu dengan skor sangat rendah menunjukkan kebutuhan yang rendah terhadap stabilitas, keteraturan, atau kepastian. Mereka cenderung spontan, fleksibel, mengikuti arus, dan hidup berdasarkan situasi saat ini.',
                    'characteristics'   => ['Spontan', 'Fleksibel', 'Mengikuti arus', 'Hidup berdasarkan situasi saat ini'],
                    'strengths'         => ['Mudah beradaptasi', 'Berani mengambil risiko', 'Tidak mudah terikat aturan', 'Terbuka terhadap perubahan'],
                    'risks'             => ['Sulit menjaga konsistensi', 'Kurang perencanaan', 'Mudah mengabaikan konsekuensi', 'Rentan keputusan impulsif', 'Sulit membangun fondasi jangka panjang'],
                    'development_focus' => 'Belajar membangun disiplin dan konsistensi.',
                ],
                2 => [
                    'name'              => 'The Adventurer',
                    'level_label'       => 'Low Security',
                    'desc'              => 'Memiliki kebutuhan keamanan yang relatif rendah tetapi masih mampu menjaga tanggung jawab dasar. Mereka menikmati fleksibilitas, inovasi, berani mencoba, dan perubahan.',
                    'characteristics'   => ['Adaptif', 'Inovatif', 'Berani mencoba', 'Cepat bergerak'],
                    'strengths'         => ['Adaptif', 'Inovatif', 'Berani mencoba hal baru', 'Cepat bergerak'],
                    'risks'             => ['Mudah bosan', 'Kurang memperhatikan detail', 'Kurang menyukai rutinitas'],
                    'development_focus' => 'Membangun sistem dan fondasi tanpa kehilangan fleksibilitas.',
                ],
                3 => [
                    'name'              => 'The Balancer',
                    'level_label'       => 'Moderate Security',
                    'desc'              => 'Zona optimal yang menyeimbangkan stabilitas, fleksibilitas, kepastian, dan perubahan secara rasional. Mampu membuat keputusan berbasis analisis yang terukur tanpa terhambat rasa takut.',
                    'characteristics'   => ['Adaptif sekaligus terstruktur', 'Rasional dalam mengambil keputusan', 'Tidak terlalu takut risiko', 'Tidak terlalu impulsif'],
                    'strengths'         => ['Adaptif sekaligus terstruktur', 'Rasional dalam mengambil keputusan', 'Menjaga keseimbangan risiko'],
                    'risks'             => ['Relatif kecil, biasanya hanya muncul dalam situasi tekanan tinggi.'],
                    'development_focus' => 'Mempertahankan keseimbangan dinamis.',
                ],
                4 => [
                    'name'              => 'The Guardian',
                    'level_label'       => 'High Security',
                    'desc'              => 'Memiliki kebutuhan yang tinggi terhadap keteraturan, kejelasan, dan fondasi yang kuat. Memastikan risiko telah dipahami dan dimitigasi sebelum mengambil tindakan nyata.',
                    'characteristics'   => ['Konsisten', 'Dapat diandalkan', 'Bertanggung jawab', 'Membangun sistem kuat', 'Menjaga keberlanjutan'],
                    'strengths'         => ['Sangat konsisten', 'Dapat diandalkan', 'Sangat bertanggung jawab', 'Membangun sistem yang kuat', 'Menjaga keberlanjutan'],
                    'risks'             => ['Terlalu berhati-hati', 'Lambat mengambil keputusan', 'Sulit menerima perubahan mendadak', 'Over-analysis'],
                    'development_focus' => 'Meningkatkan toleransi terhadap ketidakpastian dan perubahan.',
                ],
                5 => [
                    'name'              => 'The Protector',
                    'level_label'       => 'Very High Security',
                    'desc'              => 'Keamanan menjadi prioritas utama dalam hampir seluruh keputusan hidup. Sangat menghargai kontrol, kepastian, stabilitas, dan ahli dalam mengelola risiko jangka panjang.',
                    'characteristics'   => ['Sangat dapat dipercaya', 'Sangat konsisten', 'Sangat bertanggung jawab', 'Ahli mengelola risiko'],
                    'strengths'         => ['Sangat dapat dipercaya', 'Sangat konsisten', 'Sangat bertanggung jawab', 'Keahlian mitigasi risiko tingkat tinggi'],
                    'risks'             => ['Takut perubahan', 'Sulit keluar dari zona nyaman', 'Menolak eksperimen', 'Over-control', 'Kecemasan terhadap ketidakpastian'],
                    'development_focus' => 'Belajar bahwa tidak semua ketidakpastian berbahaya dan berani mengambil langkah bertumbuh.',
                ],
            ],
        ],

        // =========================================================================
        // 2. DRIVER 2 — SIGNIFICANCE
        // =========================================================================
        'significance' => [
            'name'                  => 'Significance',
            'official_name'         => 'SIGNIFICANCE',
            'tagline'               => 'Kebutuhan Makna Diri, Prestasi & Pengaruh',
            'color'                 => '#e8862e',
            'description'           => 'Significance adalah kebutuhan psikologis untuk merasa bahwa diri seseorang memiliki nilai, pencapaian, pengaruh, dan arti yang penting dalam kehidupannya maupun di mata orang lain. Mendorong individu untuk mencapai standar tinggi, menghasilkan karya membanggakan, mengembangkan kompetensi, dan meninggalkan warisan yang bermakna.',
            'core_need'             => 'Saya ingin hidup saya berarti dan menghasilkan sesuatu yang bernilai.',
            'core_fear'             => 'Saya tidak berarti, tidak terlihat, atau tidak meninggalkan dampak yang berharga.',
            'composite_drivers'     => [
                'Achievement'      => 'Kebutuhan untuk mencapai hasil yang bernilai.',
                'Recognition'      => 'Kebutuhan untuk dihargai dan diakui.',
                'Excellence'       => 'Dorongan untuk menghasilkan kualitas terbaik.',
                'Influence'        => 'Keinginan untuk memberikan pengaruh yang positif.',
                'Personal Legacy'  => 'Keinginan meninggalkan sesuatu yang membanggakan dan bermakna.',
            ],
            'what_it_is_not'        => [
                'Bukan kesombongan',
                'Bukan narsisme',
                'Bukan haus pujian',
                'Bukan selalu ingin menjadi pusat perhatian',
                'Bukan merasa lebih baik dari orang lain',
            ],
            'positive_traits'       => ['Ambisi Sehat', 'Standar Tinggi', 'Inspiratif', 'Fokus Hasil', 'Daya Dorong Tinggi'],
            'potential_blindspot'   => 'Perfeksionisme berlebihan, sulit merasa puas, atau terlalu mengukur nilai diri dari pencapaian eksternal.',
            'healthy_state'         => [
                'quote' => 'Saya mengejar keunggulan untuk mengekspresikan potensi terbaik saya dan memberi dampak positif bagi sekitar.',
                'desc'  => 'Mencapai prestasi tinggi dengan kerendahan hati, integritas, dan memberdayakan orang lain untuk turut berprestasi.',
            ],
            'shadow_state'          => [
                'quote' => 'Nilai diri saya ditentukan sepenuhnya oleh seberapa hebat pencapaian dan pengakuan yang saya dapatkan.',
                'desc'  => 'Terjebak dalam kehausan validasi, perfeksionisme ekstrem, persaingan tidak sehat, dan ketakutan terlihat tidak kompeten.',
            ],
            'core_challenge'        => 'Menemukan nilai diri yang berakar dari dalam diri, bukan sekadar dari pengakuan eksternal.',
            'key_question'          => 'Apakah saya mengejar pencapaian untuk membuktikan nilai diri saya, atau untuk mengekspresikan potensi terbaik yang saya miliki?',
            'development_principle' => 'Significance yang sehat berasal dari nilai diri yang autentik, bukan ketergantungan pada tepuk tangan orang lain.',

            'levels' => [
                1 => [
                    'name'              => 'The Observer',
                    'level_label'       => 'Very Low Significance',
                    'desc'              => 'Individu pada level ini tidak terlalu terdorong oleh pencapaian, pengakuan, prestasi, ataupun status. Mereka cenderung menerima kehidupan apa adanya dan jarang memiliki kebutuhan kuat untuk membuktikan kemampuan diri.',
                    'characteristics'   => ['Tidak terlalu kompetitif', 'Tidak mencari perhatian', 'Jarang menetapkan target ambisius', 'Mudah puas dengan kondisi saat ini'],
                    'strengths'         => ['Rendah ego', 'Tidak haus validasi', 'Mudah menerima keadaan', 'Tidak mudah terjebak dalam persaingan'],
                    'risks'             => ['Potensi diri tidak berkembang optimal', 'Kurang memiliki dorongan berprestasi', 'Mudah kehilangan arah pengembangan'],
                    'development_focus' => 'Belajar melihat bahwa mengembangkan diri dan mencapai sesuatu yang bermakna adalah bentuk tanggung jawab terhadap potensi yang dimiliki.',
                ],
                2 => [
                    'name'              => 'The Supporter',
                    'level_label'       => 'Low Significance',
                    'desc'              => 'Memiliki kebutuhan untuk berprestasi dan berkembang, namun lebih nyaman mendukung keberhasilan bersama daripada menjadi sosok di garis depan. Menghargai pencapaian tanpa menjadikannya ukuran utama nilai diri.',
                    'characteristics'   => ['Tidak terlalu membutuhkan pengakuan', 'Nyaman bekerja di balik layar', 'Menghindari persaingan yang tidak perlu', 'Fokus pada stabilitas'],
                    'strengths'         => ['Rendah konflik ego', 'Mudah bekerja sama', 'Tidak mudah terobsesi pada hasil', 'Cenderung lebih realistis'],
                    'risks'             => ['Kurang menonjolkan kemampuan', 'Melewatkan peluang pengembangan karier', 'Tidak percaya diri menunjukkan kontribusi'],
                    'development_focus' => 'Belajar mengakui pencapaian diri sendiri dan menghargai kompetensi yang dimiliki secara percaya diri.',
                ],
                3 => [
                    'name'              => 'The Builder',
                    'level_label'       => 'Moderate Significance',
                    'desc'              => 'Keseimbangan yang sehat antara kebutuhan untuk berprestasi dan kemampuan menerima diri apa adanya. Mampu menetapkan target, mengembangkan kompetensi, dan mencari kualitas terbaik tanpa kehilangan keseimbangan hidup.',
                    'characteristics'   => ['Menyukai kemajuan', 'Memiliki target yang realistis', 'Menghargai kompetensi', 'Tidak terlalu bergantung pada pengakuan'],
                    'strengths'         => ['Ambisi yang sehat', 'Keseimbangan antara prestasi dan kehidupan pribadi', 'Fokus pada pertumbuhan nyata'],
                    'risks'             => ['Kadang kurang agresif dalam mengambil peluang', 'Potensi kepemimpinan bisa kurang terlihat'],
                    'development_focus' => 'Terus mengembangkan kompetensi dan kontribusi tanpa kehilangan keseimbangan serta nilai-nilai pribadi.',
                ],
                4 => [
                    'name'              => 'The Achiever',
                    'level_label'       => 'High Significance',
                    'desc'              => 'Memiliki dorongan kuat untuk mencapai standar tinggi, menghasilkan karya terbaik, dan membangun reputasi yang positif. Menjadi penggerak perubahan, pencipta inovasi, dan role model bagi orang lain.',
                    'characteristics'   => ['Berorientasi pencapaian', 'Menetapkan standar tinggi', 'Menyukai tantangan', 'Termotivasi oleh kemajuan'],
                    'strengths'         => ['Ambisi yang produktif', 'Fokus pada hasil', 'Dorongan belajar tinggi', 'Kemampuan mendorong performa diri dan tim'],
                    'risks'             => ['Sulit merasa puas', 'Terlalu kritis terhadap diri sendiri', 'Cenderung bekerja berlebihan', 'Mengukur nilai diri berdasarkan pencapaian'],
                    'development_focus' => 'Belajar menghargai proses, bukan hanya hasil, serta membangun harga diri yang tidak sepenuhnya bergantung pada prestasi.',
                ],
                5 => [
                    'name'              => 'The Legacy Maker',
                    'level_label'       => 'Very High Significance',
                    'desc'              => 'Kebutuhan yang sangat kuat untuk menciptakan pengaruh, meninggalkan warisan, dan menghasilkan sesuatu yang akan dikenang jangka panjang. Memiliki visi besar melampaui kepentingan pribadi.',
                    'characteristics'   => ['Sangat berorientasi pencapaian', 'Memiliki visi besar', 'Ingin meninggalkan warisan', 'Mendorong diri secara intens'],
                    'strengths'         => ['Inspiratif', 'Visioner', 'Berani mengambil tantangan besar', 'Memiliki daya dorong luar biasa'],
                    'risks'             => ['Perfeksionisme berlebihan', 'Sulit menikmati pencapaian yang sudah diraih', 'Terlalu bergantung pada validasi eksternal', 'Rentan burnout'],
                    'development_focus' => 'Belajar menemukan nilai diri yang bersumber dari identitas, hubungan, dan kontribusi yang lebih luas.',
                ],
            ],
        ],

        // =========================================================================
        // 3. DRIVER 3 — CONNECTION
        // =========================================================================
        'connection' => [
            'name'                  => 'Connection',
            'official_name'         => 'CONNECTION',
            'tagline'               => 'Kebutuhan Relasi, Empati & Kebersamaan',
            'color'                 => '#3aa65a',
            'description'           => 'Connection adalah kebutuhan psikologis untuk merasa diterima, terhubung, dipercaya, dan memiliki hubungan yang bermakna dengan orang lain. Menjadi sumber empati, kolaborasi, dukungan emosional, dan kemampuan membangun komunitas yang kuat.',
            'core_need'             => 'Saya ingin merasa terhubung, diterima, dan memiliki hubungan yang bermakna dengan orang lain.',
            'core_fear'             => 'Saya ditolak, diabaikan, atau harus menghadapi hidup sendirian tanpa hubungan yang berarti.',
            'composite_drivers'     => [
                'Belonging'        => 'Kebutuhan merasa diterima dan menjadi bagian dari kelompok.',
                'Empathy'          => 'Kemampuan memahami dan merasakan perasaan orang lain.',
                'Trust'            => 'Kemampuan membangun dan menjaga rasa saling percaya.',
                'Collaboration'    => 'Dorongan untuk bekerja sama demi tujuan bersama.',
                'Community Building'=> 'Keinginan menciptakan lingkungan yang suportif dan harmonis.',
            ],
            'what_it_is_not'        => [
                'Bukan sekadar basa-basi sosial',
                'Bukan kelemahan emosional',
                'Bukan ketidakmampuan mandiri',
                'Bukan ketergantungan buta pada orang lain',
            ],
            'positive_traits'       => ['Empatik', 'Dapat Dipercaya', 'Kolaboratif', 'Peka Sosial', 'Perekat Komunitas'],
            'potential_blindspot'   => 'Sulit berkata tidak (people-pleasing), menghindari konflik penting, atau mengorbankan kebutuhan pribadi demi orang lain.',
            'healthy_state'         => [
                'quote' => 'Saya terhubung dengan orang lain secara autentik, saling mendukung, dan bertumbuh bersama.',
                'desc'  => 'Membangun empati, kerja sama erat, kepercayaan timbal balik, dan komunitas yang suportif.',
            ],
            'shadow_state'          => [
                'quote' => 'Saya harus selalu diterima dan menyenangkan semua orang agar tidak ditinggalkan.',
                'desc'  => 'People-pleasing, takut konflik, mengorbankan batasan pribadi, dan ketergantungan emosional pada validasi orang lain.',
            ],
            'core_challenge'        => 'Menjaga batasan pribadi yang sehat dan keberanian untuk bersikap jujur tanpa takut ditolak.',
            'key_question'          => 'Apakah saya membangun hubungan karena ingin terhubung secara autentik, atau karena takut ditolak dan sendirian?',
            'development_principle' => 'Keseimbangan diperlukan agar hubungan menjadi sumber kekuatan dan pertumbuhan, bukan sumber ketergantungan emosional.',

            'levels' => [
                1 => [
                    'name'              => 'The Lone Walker',
                    'level_label'       => 'Very Low Connection',
                    'desc'              => 'Memiliki kebutuhan yang sangat rendah terhadap kedekatan emosional dan hubungan interpersonal. Lebih nyaman mengandalkan diri sendiri dibanding bergantung pada dukungan orang lain.',
                    'characteristics'   => ['Sangat mandiri', 'Tidak terlalu membutuhkan dukungan emosional', 'Lebih nyaman bekerja sendiri', 'Jarang membagikan perasaan'],
                    'strengths'         => ['Mandiri secara emosional', 'Tidak mudah terpengaruh tekanan sosial', 'Mampu mengambil keputusan objektif'],
                    'risks'             => ['Sulit membangun kedekatan emosional', 'Terlihat dingin atau sulit didekati', 'Kehilangan manfaat dukungan sosial', 'Rentan terisolasi'],
                    'development_focus' => 'Belajar melihat bahwa membangun hubungan yang sehat adalah salah satu sumber kekuatan dan pertumbuhan manusia.',
                ],
                2 => [
                    'name'              => 'The Independent Companion',
                    'level_label'       => 'Low Connection',
                    'desc'              => 'Menghargai hubungan tetapi tidak menjadikannya sebagai pusat kehidupan. Selektif dalam membangun kedekatan dan lebih mengutamakan kualitas dibanding kuantitas.',
                    'characteristics'   => ['Menikmati hubungan sederhana', 'Tidak terlalu membutuhkan perhatian sosial', 'Cukup mandiri', 'Selektif', 'Nyaman menyendiri'],
                    'strengths'         => ['Keseimbangan antara kemandirian dan hubungan', 'Tidak mudah terpengaruh drama sosial', 'Stabil secara emosional', 'Menjaga batasan sehat'],
                    'risks'             => ['Sulit membuka diri secara mendalam', 'Hubungan dapat terlihat kurang hangat', 'Kadang dianggap kurang ekspresif'],
                    'development_focus' => 'Belajar membangun hubungan yang lebih terbuka dan autentik tanpa merasa kehilangan kemandirian pribadi.',
                ],
                3 => [
                    'name'              => 'The Relationship Builder',
                    'level_label'       => 'Moderate Connection',
                    'desc'              => 'Keseimbangan yang sehat antara kebutuhan akan hubungan dan kebutuhan akan kemandirian. Menikmati kedekatan dengan orang lain, tetapi tetap mampu berdiri sendiri ketika diperlukan.',
                    'characteristics'   => ['Menghargai hubungan sehat', 'Mampu membangun kepercayaan', 'Menikmati kolaborasi', 'Nyaman memberi & menerima dukungan'],
                    'strengths'         => ['Empati yang sehat', 'Mampu membangun kerja sama', 'Mudah dipercaya', 'Menciptakan hubungan stabil dan positif'],
                    'risks'             => ['Kadang menghindari konflik demi menjaga hubungan', 'Terlalu toleran terhadap perilaku tertentu', 'Sulit membuat keputusan yang mengecewakan orang lain'],
                    'development_focus' => 'Terus mengembangkan kemampuan membangun hubungan yang jujur, sehat, dan saling bertumbuh tanpa kehilangan keaslian diri.',
                ],
                4 => [
                    'name'              => 'The Connector',
                    'level_label'       => 'High Connection',
                    'desc'              => 'Memiliki kebutuhan kuat untuk membangun hubungan yang bermakna dan menjaga kedekatan. Memperoleh energi dari interaksi sosial positif dan menjadi perekat dalam tim dan komunitas.',
                    'characteristics'   => ['Sangat menghargai hubungan', 'Menikmati kolaborasi', 'Mudah membangun kepercayaan', 'Peduli kebutuhan emosional orang lain'],
                    'strengths'         => ['Empati tinggi', 'Keterampilan interpersonal kuat', 'Mampu membangun jaringan hubungan', 'Menjadi perekat dalam tim'],
                    'risks'             => ['Sulit mengatakan tidak', 'Terlalu memikirkan perasaan orang lain', 'Menghindari konflik yang perlu diselesaikan', 'Mengorbankan kebutuhan pribadi'],
                    'development_focus' => 'Belajar menjaga keseimbangan antara kepedulian terhadap orang lain dan penghargaan terhadap kebutuhan diri sendiri.',
                ],
                5 => [
                    'name'              => 'The Community Builder',
                    'level_label'       => 'Very High Connection',
                    'desc'              => 'Kebutuhan sangat kuat untuk menciptakan hubungan, komunitas, dan rasa kebersamaan. Melihat kehidupan melalui lensa hubungan manusia dan terpanggil membangun lingkungan yang harmonis.',
                    'characteristics'   => ['Sangat berorientasi pada hubungan', 'Menikmati membangun komunitas', 'Sangat peka dinamika sosial', 'Mencari kedekatan mendalam'],
                    'strengths'         => ['Membangun rasa kebersamaan yang kuat', 'Menciptakan lingkungan suportif', 'Menyatukan berbagai individu dan kelompok', 'Sumber dukungan emosional'],
                    'risks'             => ['Terlalu bergantung pada penerimaan sosial', 'Sulit menetapkan batasan pribadi', 'Mengorbankan kebutuhan sendiri demi hubungan', 'Rentan kelelahan emosional'],
                    'development_focus' => 'Belajar membangun hubungan yang sehat tanpa menjadikan penerimaan orang lain sebagai satu-satunya sumber nilai diri.',
                ],
            ],
        ],

        // =========================================================================
        // 4. DRIVER 4 — GROWTH
        // =========================================================================
        'growth' => [
            'name'                  => 'Growth',
            'official_name'         => 'GROWTH',
            'tagline'               => 'Kebutuhan Belajar, Inovasi & Pengembangan Diri',
            'color'                 => '#7a5cc7',
            'description'           => 'Growth adalah kebutuhan psikologis untuk terus belajar, berkembang, memperluas wawasan, meningkatkan kemampuan, dan menjadi versi diri yang lebih baik dari waktu ke waktu. Menjadi sumber inovasi, adaptabilitas, pembelajaran berkelanjutan, dan kemampuan menghadapi perubahan.',
            'core_need'             => 'Saya ingin terus berkembang, belajar, dan menjadi versi diri yang lebih baik.',
            'core_fear'             => 'Saya berhenti berkembang, tertinggal, atau terjebak dalam kehidupan yang stagnan.',
            'composite_drivers'     => [
                'Curiosity'            => 'Keinginan untuk memahami dan mengeksplorasi hal baru.',
                'Learning Orientation' => 'Kecenderungan untuk terus belajar dan berkembang.',
                'Adaptability'         => 'Kemampuan menyesuaikan diri terhadap perubahan.',
                'Self-Improvement'     => 'Dorongan untuk meningkatkan kualitas diri.',
                'Exploration'          => 'Keinginan untuk memperluas pengalaman, wawasan, dan kemungkinan.',
            ],
            'what_it_is_not'        => [
                'Bukan tidak pernah puas',
                'Bukan perfeksionisme',
                'Bukan selalu berpindah-pindah tujuan',
                'Bukan menolak stabilitas',
                'Bukan mengejar perubahan tanpa arah',
            ],
            'positive_traits'       => ['Inovatif', 'Cepat Belajar', 'Adaptif', 'Rasa Ingin Tahu Tinggi', 'Berpikir Visioner'],
            'potential_blindspot'   => 'Mudah bosan pada rutinitas, terlalu banyak memulai hal baru tanpa menuntaskan, atau sulit menikmati hasil saat ini.',
            'healthy_state'         => [
                'quote' => 'Saya terus belajar dan beradaptasi untuk memaksimalkan potensi diri dan memberikan dampak yang lebih baik.',
                'desc'  => 'Rasa ingin tahu tinggi, adaptif terhadap perubahan, continuous learning, dan inovasi terarah yang menghasilkan dampak nyata.',
            ],
            'shadow_state'          => [
                'quote' => 'Saya tidak pernah boleh puas atau berhenti, apa pun yang saya raih belum pernah cukup.',
                'desc'  => 'Restlessness, FOMO intelektual, melompat-lompat fokus tanpa menuntaskan, dan ketidakmampuan menikmati masa kini.',
            ],
            'core_challenge'        => 'Mengubah wawasan dan rasa ingin tahu menjadi tindakan nyata yang tuntas dan berkelanjutan.',
            'key_question'          => 'Apakah saya bertumbuh untuk menjadi versi terbaik diri saya, atau karena saya merasa tidak pernah cukup dengan diri saya saat ini?',
            'development_principle' => 'Tujuan IMT adalah menciptakan Growth yang sehat, berkelanjutan, dan terarah.',

            'levels' => [
                1 => [
                    'name'              => 'The Settler',
                    'level_label'       => 'Very Low Growth',
                    'desc'              => 'Memiliki kebutuhan yang rendah terhadap pembelajaran, eksplorasi, dan pengembangan diri. Merasa nyaman dengan apa yang sudah diketahui dan menyukai rutinitas familiar.',
                    'characteristics'   => ['Menyukai rutinitas yang familiar', 'Tidak terlalu tertarik pada hal baru', 'Jarang mencari tantangan pengembangan diri', 'Lebih nyaman cara terbukti'],
                    'strengths'         => ['Stabil dan konsisten', 'Tidak mudah terdistraksi tren baru', 'Fokus pada hal-hal yang sudah dikuasai', 'Praktis'],
                    'risks'             => ['Sulit beradaptasi dengan perubahan', 'Potensi diri berkembang lebih lambat', 'Kehilangan peluang pembelajaran', 'Mudah tertinggal'],
                    'development_focus' => 'Belajar melihat bahwa pertumbuhan tidak selalu perubahan besar, tetapi dapat dimulai dari rasa ingin tahu terhadap hal-hal kecil.',
                ],
                2 => [
                    'name'              => 'The Maintainer',
                    'level_label'       => 'Low Growth',
                    'desc'              => 'Cukup terbuka terhadap pembelajaran jika relevan dan dibutuhkan, namun lebih fokus mempertahankan apa yang sudah berjalan baik dibanding mengejar peluang baru.',
                    'characteristics'   => ['Terbuka terhadap pembelajaran jika relevan', 'Lebih suka perubahan bertahap', 'Tidak terlalu mencari pengalaman baru', 'Mengutamakan kenyamanan'],
                    'strengths'         => ['Realistis dan praktis', 'Tidak mudah terjebak perubahan yang tidak perlu', 'Stabil dalam proses', 'Mampu mempertahankan kualitas'],
                    'risks'             => ['Kurang proaktif dalam berkembang', 'Kehilangan kesempatan peningkatan diri', 'Mudah merasa cukup terlalu cepat', 'Adaptasi lebih lambat'],
                    'development_focus' => 'Belajar melihat bahwa pertumbuhan berkelanjutan memberikan lebih banyak pilihan, peluang, dan kualitas hidup.',
                ],
                3 => [
                    'name'              => 'The Learner',
                    'level_label'       => 'Moderate Growth',
                    'desc'              => 'Memiliki hubungan yang sehat dengan pembelajaran dan pengembangan diri. Menikmati proses belajar, terbuka terhadap perspektif baru, dan menjaga keseimbangan antara stabilitas dan pertumbuhan.',
                    'characteristics'   => ['Menikmati pembelajaran yang bermakna', 'Terbuka terhadap ide baru', 'Mampu beradaptasi', 'Pola pikir berkembang yang sehat'],
                    'strengths'         => ['Fleksibel dan adaptif', 'Terbuka terhadap masukan', 'Mampu belajar dari pengalaman', 'Keseimbangan stabilitas dan pertumbuhan'],
                    'risks'             => ['Kadang kurang agresif mengejar peluang', 'Potensi tertentu dapat berkembang lebih lambat', 'Tidak selalu keluar dari zona nyaman'],
                    'development_focus' => 'Terus mempertahankan rasa ingin tahu sambil mengubah wawasan menjadi tindakan nyata.',
                ],
                4 => [
                    'name'              => 'The Explorer',
                    'level_label'       => 'High Growth',
                    'desc'              => 'Memiliki kebutuhan kuat untuk terus berkembang, belajar, dan memperluas kemampuannya. Menjadi sumber ide baru, inovasi, dan melihat kehidupan sebagai perjalanan belajar tiada henti.',
                    'characteristics'   => ['Sangat ingin tahu', 'Menikmati tantangan baru', 'Aktif mencari wawasan', 'Terbuka terhadap perubahan', 'Orientasi pengembangan tinggi'],
                    'strengths'         => ['Adaptif terhadap perubahan', 'Cepat belajar', 'Inovatif dan kreatif', 'Mampu melihat peluang tersembunyi'],
                    'risks'             => ['Mudah bosan dengan rutinitas', 'Terlalu banyak memulai hal baru', 'Sulit bertahan pada proses monoton', 'Kurang fokus pada penyelesaian'],
                    'development_focus' => 'Belajar menggabungkan rasa ingin tahu dengan disiplin sehingga pertumbuhan menghasilkan hasil nyata.',
                ],
                5 => [
                    'name'              => 'The Evolutionary Thinker',
                    'level_label'       => 'Very High Growth',
                    'desc'              => 'Kebutuhan yang sangat kuat untuk bereksperimen, memperluas batas kemampuan, dan melihat setiap pengalaman sebagai kesempatan belajar. Pada kondisi sehat, menjadi visioner dan agen perubahan.',
                    'characteristics'   => ['Sangat haus pembelajaran', 'Menyukai eksplorasi ide', 'Rasa ingin tahu sangat tinggi', 'Cepat beradaptasi', 'Selalu mencari peluang baru'],
                    'strengths'         => ['Visioner dan inovatif', 'Mampu berkembang sangat cepat', 'Terbuka terhadap berbagai perspektif', 'Penggerak kemajuan'],
                    'risks'             => ['Sulit merasa cukup', 'Mudah kehilangan fokus', 'Terlalu banyak mengejar kemungkinan sekaligus', 'Rentan kelelahan mental'],
                    'development_focus' => 'Belajar menghargai proses dan pencapaian saat ini, serta menyeimbangkan eksplorasi masa depan dengan kehadiran penuh saat ini.',
                ],
            ],
        ],

        // =========================================================================
        // 5. DRIVER 5 — CONTRIBUTION
        // =========================================================================
        'contribution' => [
            'name'                  => 'Contribution',
            'official_name'         => 'CONTRIBUTION',
            'tagline'               => 'Kebutuhan Memberi Manfaat, Melayani & Berdampak',
            'color'                 => '#1f8a6e',
            'description'           => 'Contribution adalah kebutuhan psikologis untuk memberi manfaat, menolong, melayani, dan menciptakan dampak positif bagi kehidupan orang lain dan masyarakat. Menjadi sumber kedermawanan, tanggung jawab sosial, dan kepemimpinan yang melayani.',
            'core_need'             => 'Saya ingin hidup saya memberi manfaat dan nilai tambah bagi orang lain.',
            'core_fear'             => 'Saya hidup sia-sia, mementingkan diri sendiri, atau gagal membantu saat orang lain membutuhkan pertolongan saya.',
            'composite_drivers'     => [
                'Generosity'       => 'Dorongan untuk memberi dan berbagi sumber daya.',
                'Service'          => 'Keinginan untuk melayani dan memudahkan urusan orang lain.',
                'Social Responsibility' => 'Rasa tanggung jawab terhadap kesejahteraan komunitas.',
                'Mentorship'       => 'Keinginan membimbing dan memberdayakan potensi orang lain.',
                'Purpose Driven'   => 'Dorongan hidup yang berlandaskan pada misi yang lebih besar.',
            ],
            'what_it_is_not'        => [
                'Bukan pengorbanan diri yang merusak',
                'Bukan pencitraan moral',
                'Bukan merasa wajib menyelamatkan semua orang',
            ],
            'positive_traits'       => ['Tulus Melayani', 'Peduli Sesama', 'Tanggung Jawab Sosial', 'Kedermawanan', 'Memberdayakan'],
            'potential_blindspot'   => 'Terlalu membebani diri dengan masalah orang lain, sulit berkata tidak, atau mengabaikan kesehatan fisik dan mental sendiri.',
            'healthy_state'         => [
                'quote' => 'Saya memberi dengan tulus dan bijaksana untuk memberdayakan sesama.',
                'desc'  => 'Pelayanan tulus, pemberdayaan orang lain, dan kepedulian sosial yang bermakna dan berkelanjutan.',
            ],
            'shadow_state'          => [
                'quote' => 'Saya harus terus berkorban untuk orang lain hingga mengabaikan diri sendiri.',
                'desc'  => 'Martyr complex, pengabaian diri sendiri, kelelahan fisik/mental (burnout), dan memberi untuk mencari pengakuan moral.',
            ],
            'core_challenge'        => 'Memberi secara bijaksana dan berkelanjutan tanpa mengabaikan energi dan kapasitas diri sendiri.',
            'key_question'          => 'Apakah saya memberi untuk memberdayakan orang lain, atau untuk merasa dibutuhkan dan bernilai?',
            'development_principle' => 'Contribution yang sejati dimulai dari diri yang utuh, sehingga memberi menjadi luapan kelimpahan, bukan pengurasan diri.',

            'levels' => [
                1 => [
                    'name'              => 'The Self-Sustainer',
                    'level_label'       => 'Very Low Contribution',
                    'desc'              => 'Fokus utama berada pada pemenuhan kebutuhan dan tanggung jawab diri sendiri sebelum memikirkan kontribusi sosial bagi orang lain.',
                    'characteristics'   => ['Fokus mandiri', 'Praktis', 'Menjaga batasan energi pribadi'],
                    'strengths'         => ['Tanggung jawab pribadi kuat', 'Tidak mudah terbebani masalah orang lain'],
                    'risks'             => ['Terlihat kurang peduli', 'Melewatkan makna dari melayani sesama'],
                    'development_focus' => 'Mulai menyadari dampak positif dari tindakan kecil yang membantu orang di sekitar.',
                ],
                2 => [
                    'name'              => 'The Occasional Helper',
                    'level_label'       => 'Low Contribution',
                    'desc'              => 'Siap membantu ketika ada permintaan langsung atau situasi mendesak, namun tidak secara proaktif mencari ruang kontribusi sosial.',
                    'characteristics'   => ['Membantu saat dibutuhkan', 'Selektif dalam memberi', 'Menjaga energi'],
                    'strengths'         => ['Realistis dalam membantu', 'Tidak mudah mengalami kelelahan sosial'],
                    'risks'             => ['Kurang proaktif dalam kegiatan sosial bersama'],
                    'development_focus' => 'Menjadikan kontribusi sebagai bagian alami dari keseharian.',
                ],
                3 => [
                    'name'              => 'The Balanced Giver',
                    'level_label'       => 'Moderate Contribution',
                    'desc'              => 'Memberi dan berkontribusi secara proporsional dan bijaksana tanpa mengorbankan stabilitas dan kebutuhan pribadi.',
                    'characteristics'   => ['Peduli sesama', 'Tanggung jawab sosial seimbang', 'Membantu secara terukur'],
                    'strengths'         => ['Keseimbangan antara memberi dan menjaga diri', 'Konsisten dalam mendukung orang lain'],
                    'risks'             => ['Kadang ragu mengambil peran kontribusi yang lebih besar'],
                    'development_focus' => 'Memperluas dampak kontribusi melalui kolaborasi dengan pihak lain.',
                ],
                4 => [
                    'name'              => 'The Active Contributor',
                    'level_label'       => 'High Contribution',
                    'desc'              => 'Memiliki komitmen tinggi untuk memberi dampak positif, membimbing orang lain, dan aktif dalam inisiatif sosial dan pemberdayaan.',
                    'characteristics'   => ['Proaktif membantu', 'Pikiran berorientasi dampak', 'Suka membimbing'],
                    'strengths'         => ['Tulus melayani', 'Mampu menggerakkan kepedulian orang lain', 'Inspiratif'],
                    'risks'             => ['Terkadang melupakan batasan istirahat pribadi'],
                    'development_focus' => 'Menjaga keberlanjutan energi agar dapat terus memberi dalam jangka panjang.',
                ],
                5 => [
                    'name'              => 'The Purpose Pioneer',
                    'level_label'       => 'Very High Contribution',
                    'desc'              => 'Mendedikasikan hidup untuk misi yang lebih besar, transformasi masyarakat, dan meninggalkan warisan kemanusiaan yang abadi.',
                    'characteristics'   => ['Visioner kemanusiaan', 'Dedikasi tinggi', 'Fokus pada dampak jangka panjang'],
                    'strengths'         => ['Kepemimpinan transformasional yang melayani', 'Daya gerak sosial luar biasa'],
                    'risks'             => ['Rentan mengalami burnout akibat empati berlebih'],
                    'development_focus' => 'Menjaga keseimbangan antara melayani dunia dan merawat diri sendiri.',
                ],
            ],
        ],

    ],

    // =========================================================================
    // SYNERGY MATRIX (10 DUAL-DOMINANT ARCHETYPES)
    // =========================================================================
    'archetypes' => [

        // 1. Security + Growth (The Strategic Explorer)
        'Security_Growth' => [
            'name'                  => 'The Strategic Explorer',
            'combination'           => 'Security + Growth',
            'description'           => "Anda menyukai perkembangan dan perubahan, tetapi tidak menyukai perubahan yang sembrono. Anda ingin maju dan mengeksplorasi potensi baru, namun tetap memastikan setiap langkah yang diambil memiliki fondasi yang kuat, rencana yang jelas, dan risiko yang dapat dikelola.\n\nAnda sering ditemukan sebagai pemimpin perubahan yang realistis, inovator yang bertumbuh secara berkelanjutan, atau profesional yang haus belajar tanpa pernah kehilangan pijakan terhadap realitas dan stabilitas sistem.",
            'core_desire'           => 'Saya ingin terus berkembang dan berinovasi tanpa kehilangan stabilitas yang telah dibangun.',
            'core_fear'             => 'Terjebak dalam stagnasi atau mengambil langkah yang terlalu berisiko hingga merusak fondasi hidup.',
            'strengths'             => [
                ['title' => 'Continuous Improvement', 'desc' => 'Selalu mencari cara untuk meningkatkan kualitas hidup, sistem, dan diri sendiri secara bertahap dan konsisten.'],
                ['title' => 'Calculated Adaptability', 'desc' => 'Mampu beradaptasi terhadap perubahan tanpa kehilangan arah, kejelasan, atau stabilitas fondasi.'],
                ['title' => 'Sustainable Innovation', 'desc' => 'Mengembangkan ide-ide baru yang realistis, teruji, dan dapat diimplementasikan dalam jangka panjang.'],
                ['title' => 'Pragmatic Curiosity', 'desc' => 'Memiliki rasa ingin tahu yang tinggi terhadap hal-hal baru sambil tetap mempertimbangkan kelayakan praktisnya.'],
            ],
            'blindspots'            => [
                ['title' => 'Analysis Paralysis', 'desc' => 'Kecenderungan terlalu banyak menganalisis dan merencanakan sebelum berani mengambil tindakan nyata.'],
                ['title' => 'Comfort Zone Delay', 'desc' => 'Menggunakan alasan "mempersiapkan diri" untuk menunda langkah yang sebenarnya sudah siap diambil.'],
                ['title' => 'Over-Structuring', 'desc' => 'Membuat sistem atau aturan yang terlalu kaku sehingga memperlambat kelincahan proses eksplorasi.'],
                ['title' => 'Risk Overestimation', 'desc' => 'Melihat risiko lebih besar daripada peluang yang sebenarnya ada.'],
            ],
            'what_drives'           => [
                'Peluang belajar hal baru yang memiliki penerapan praktis',
                'Melihat progres nyata yang terukur dari waktu ke waktu',
                'Membangun sistem yang mendukung pengembangan berkelanjutan',
                'Lingkungan yang menghargai inovasi terencana',
            ],
            'what_drains'           => [
                'Rutinitas monoton yang tidak memberi ruang belajar',
                'Perubahan mendadak yang kacau tanpa rencana mitigasi',
                'Dipaksa mengambil keputusan penting tanpa data yang cukup',
                'Lingkungan yang resisten terhadap perbaikan sistemik',
            ],
            'leadership_style'      => [
                'title' => 'The Progressive Stabilizer',
                'desc'  => 'Memimpin dengan memberikan visi perkembangan yang jelas sambil memastikan tim memiliki landasan yang aman, terencana, dan terarah untuk mencapainya.',
            ],
            'communication_style'   => [
                'title' => 'Thoughtful & Structured',
                'desc'  => 'Berkomunikasi secara analitis, terbuka terhadap gagasan baru, namun selalu mencari kejelasan implementasi dan data pendukung.',
            ],
            'growth_path'           => 'Menyadari bahwa tindakan kecil yang nyata dan teruji lebih berharga daripada menunggu kesempurnaan perencanaan.',
            'synergy_summary'       => 'Kombinasi yang menghadirkan inovasi di atas fondasi yang kokoh—menjelajah masa depan tanpa melupakan stabilitas dasar.',
            'key_question'          => 'Apakah saya sedang mempersiapkan diri untuk berkembang, atau menggunakan persiapan sebagai alasan untuk tidak bergerak?',
        ],

        // 2. Growth + Security
        'Growth_Security' => [
            'name'                  => 'The Strategic Explorer',
            'combination'           => 'Growth + Security',
            'description'           => "Anda menyukai perkembangan dan perubahan, tetapi tidak menyukai perubahan yang sembrono. Anda ingin maju dan mengeksplorasi potensi baru, namun tetap memastikan setiap langkah yang diambil memiliki fondasi yang kuat, rencana yang jelas, dan risiko yang dapat dikelola.\n\nAnda sering ditemukan sebagai pemimpin perubahan yang realistis, inovator yang bertumbuh secara berkelanjutan, atau profesional yang haus belajar tanpa pernah kehilangan pijakan terhadap realitas dan stabilitas sistem.",
            'core_desire'           => 'Saya ingin terus berkembang dan berinovasi tanpa kehilangan stabilitas yang telah dibangun.',
            'core_fear'             => 'Terjebak dalam stagnasi atau mengambil langkah yang terlalu berisiko hingga merusak fondasi hidup.',
            'strengths'             => [
                ['title' => 'Continuous Improvement', 'desc' => 'Selalu mencari cara untuk meningkatkan kualitas hidup, sistem, dan diri sendiri secara bertahap dan konsisten.'],
                ['title' => 'Calculated Adaptability', 'desc' => 'Mampu beradaptasi terhadap perubahan tanpa kehilangan arah, kejelasan, atau stabilitas fondasi.'],
                ['title' => 'Sustainable Innovation', 'desc' => 'Mengembangkan ide-ide baru yang realistis, teruji, dan dapat diimplementasikan dalam jangka panjang.'],
                ['title' => 'Pragmatic Curiosity', 'desc' => 'Memiliki rasa ingin tahu yang tinggi terhadap hal-hal baru sambil tetap mempertimbangkan kelayakan praktisnya.'],
            ],
            'blindspots'            => [
                ['title' => 'Analysis Paralysis', 'desc' => 'Kecenderungan terlalu banyak menganalisis dan merencanakan sebelum berani mengambil tindakan nyata.'],
                ['title' => 'Comfort Zone Delay', 'desc' => 'Menggunakan alasan "mempersiapkan diri" untuk menunda langkah yang sebenarnya sudah siap diambil.'],
                ['title' => 'Over-Structuring', 'desc' => 'Membuat sistem atau aturan yang terlalu kaku sehingga memperlambat kelincahan proses eksplorasi.'],
            ],
            'what_drives'           => ['Peluang belajar terarah', 'Progres nyata terukur', 'Sistem yang adaptif'],
            'what_drains'           => ['Stagnasi tanpa arah', 'Kekacauan tanpa mitigasi risiko'],
            'leadership_style'      => ['title' => 'The Progressive Stabilizer', 'desc' => 'Memadukan visi kemajuan dengan pijakan langkah yang realistis.'],
            'communication_style'   => ['title' => 'Thoughtful & Structured', 'desc' => 'Analitis, solutif, dan berbasis data terpercaya.'],
            'growth_path'           => 'Mengambil aksi nyata terukur lebih cepat daripada menunggu kepastian 100%.',
            'synergy_summary'       => 'Inovasi dinamis yang berdiri di atas fondasi integritas dan keamanan yang kuat.',
            'key_question'          => 'Apakah persiapan saya saat ini mempercepat langkah, atau justru menahannya?',
        ],

        // 3. Security + Significance (The Structured Achiever)
        'Security_Significance' => [
            'name'                  => 'The Structured Achiever',
            'combination'           => 'Security + Significance',
            'description'           => "Anda didorong oleh ambisi tinggi untuk mencapai standar prestasi puncak dan reputasi terbaik, namun Anda membangunnya di atas kedisiplinan, keteraturan, dan mitigasi risiko yang sangat matang. Anda tidak menyukai spekulasi tanpa perhitungan.\n\nAnda sering menjadi arsitek eksekusi yang andal, profesional berintegritas tinggi, atau pemimpin yang mampu menciptakan mahakarya prestisius dengan konsistensi mutu yang tidak pernah goyah.",
            'core_desire'           => 'Mencapai kesuksesan yang diakui dengan fondasi reputasi dan stabilitas yang tidak tergoyahkan.',
            'core_fear'             => 'Mengalami kegagalan publik atau kehilangan kendali atas pencapaian yang telah dibangun.',
            'strengths'             => [
                ['title' => 'Flawless Execution', 'desc' => 'Mengeksekusi rencana dengan presisi tinggi dan komitmen mutu tanpa cela.'],
                ['title' => 'Risk-Managed Ambition', 'desc' => 'Mengejar target besar dengan perhitungan risiko yang matang dan teruji.'],
                ['title' => 'Enduring Reputation', 'desc' => 'Membangun citra profesional yang konsisten, kredibel, dan dapat diandalkan.'],
            ],
            'blindspots'            => [
                ['title' => 'Fear of Imperfection', 'desc' => 'Enggan mencoba hal baru karena takut merusak standar keberhasilan yang ada.'],
                ['title' => 'Over-Control', 'desc' => 'Sulit mendelegasikan tugas penting karena khawatir hasilnya tidak sesuai ekspektasi.'],
            ],
            'what_drives'           => ['Mencapai standar prestasi tinggi', 'Pengakuan atas kinerja terstruktur', 'Membangun warisan reputasi yang solid'],
            'what_drains'           => ['Lingkungan yang tidak profesional', 'Ketidakjelasan tanggung jawab', 'Keputusan spontan tanpa perhitungan'],
            'leadership_style'      => ['title' => 'The Authoritative Architect', 'desc' => 'Memimpin dengan keteladanan standar tinggi, keteraturan, dan akuntabilitas mutlak.'],
            'communication_style'   => ['title' => 'Precise & Professional', 'desc' => 'Jelas, tegas, berbasis fakta, dan berorientasi hasil.'],
            'growth_path'           => 'Memberi ruang bagi ketidaksempurnaan dan melihat kesalahan proses sebagai peluang belajar berharga.',
            'synergy_summary'       => 'Pencapaian tinggi yang kokoh dan berkelanjutan berkat kedisiplinan dan fondasi sistem yang matang.',
            'key_question'          => 'Apakah saya mengejar keunggulan untuk memberi dampak, atau semata-mata menjaga citra diri?',
        ],

        // 4. Significance + Security
        'Significance_Security' => [
            'name'                  => 'The Structured Achiever',
            'combination'           => 'Significance + Security',
            'description'           => "Anda didorong oleh ambisi tinggi untuk mencapai standar prestasi puncak dan reputasi terbaik, namun Anda membangunnya di atas kedisiplinan, keteraturan, dan mitigasi risiko yang sangat matang. Anda tidak menyukai spekulasi tanpa perhitungan.\n\nAnda sering menjadi arsitek eksekusi yang andal, profesional berintegritas tinggi, atau pemimpin yang mampu menciptakan mahakarya prestisius dengan konsistensi mutu yang tidak pernah goyah.",
            'core_desire'           => 'Mencapai kesuksesan yang diakui dengan fondasi reputasi dan stabilitas yang tidak tergoyahkan.',
            'core_fear'             => 'Mengalami kegagalan publik atau kehilangan kendali atas pencapaian yang telah dibangun.',
            'strengths'             => [
                ['title' => 'Flawless Execution', 'desc' => 'Mengeksekusi rencana dengan presisi tinggi dan komitmen mutu tanpa cela.'],
                ['title' => 'Risk-Managed Ambition', 'desc' => 'Mengejar target besar dengan perhitungan risiko yang matang dan teruji.'],
            ],
            'blindspots'            => [
                ['title' => 'Fear of Imperfection', 'desc' => 'Enggan mencoba hal baru karena takut merusak standar keberhasilan yang ada.'],
            ],
            'what_drives'           => ['Target tinggi terukur', 'Reputasi kredibel'],
            'what_drains'           => ['Ketidakpastian arah', 'Hasil kerja yang serampangan'],
            'leadership_style'      => ['title' => 'The Authoritative Architect', 'desc' => 'Memimpin dengan integritas tinggi dan standar mutu teruji.'],
            'communication_style'   => ['title' => 'Precise & Professional', 'desc' => 'Tegas, terstruktur, dan berbasis fakta.'],
            'growth_path'           => 'Belajar mendelegasikan wewenang dengan percaya dan toleran terhadap proses.',
            'synergy_summary'       => 'Kombinasi ambisi produktif dan kestabilan sistemik.',
            'key_question'          => 'Apakah standar tinggi saya membangun tim atau justru menciptakan kecemasan?',
        ],

        // 5. Significance + Growth (The Dynamic Pioneer)
        'Significance_Growth' => [
            'name'                  => 'The Dynamic Pioneer',
            'combination'           => 'Significance + Growth',
            'description'           => "Anda adalah sosok penakluk batas yang memadukan dorongan prestasi puncak dengan kehausan belajar tanpa henti. Anda selalu berada di garis depan inovasi, gemar memecahkan tantangan baru, dan menolak terjebak dalam status quo yang membosankan.\n\nAnda sering tampil sebagai pelopor transformasional, entrepreneur visioner, atau katalisator perubahan yang mampu menginspirasi lingkungan sekitar untuk melampaui batas kemampuan mereka.",
            'core_desire'           => 'Mencapai potensi tertinggi diri dan menciptakan mahakarya inovatif yang diakui dunia.',
            'core_fear'             => 'Menjadi medioker, tidak berkembang, atau kehilangan relevansi dalam kompetisi.',
            'strengths'             => [
                ['title' => 'Visionary Drive', 'desc' => 'Memiliki ambisi besar yang didukung oleh kecepatan belajar luar biasa.'],
                ['title' => 'Relentless Innovation', 'desc' => 'Tidak pernah puas dengan status quo dan selalu menciptakan standar baru.'],
                ['title' => 'High Inspiration', 'desc' => 'Mampu memotivasi orang lain untuk berani melampaui batas kemampuan mereka.'],
            ],
            'blindspots'            => [
                ['title' => 'Burnout Vulnerability', 'desc' => 'Mendorong diri dan tim terlalu keras tanpa memberi jeda istirahat yang cukup.'],
                ['title' => 'Achievement Addiction', 'desc' => 'Sulit menikmati pencapaian karena langsung mengejar target berikutnya.'],
            ],
            'what_drives'           => ['Tantangan kompleks baru', 'Peluang memimpin inovasi', 'Pengakuan atas terobosan besar'],
            'what_drains'           => ['Birokrasi lambat', 'Pekerjaan repetitif tanpa ruang kreasi', 'Lingkungan yang pasrah'],
            'leadership_style'      => ['title' => 'The Transformative Catalyst', 'desc' => 'Memimpin dengan energi tinggi, visi masa depan, dan standar keunggulan transformatif.'],
            'communication_style'   => ['title' => 'Inspirational & Direct', 'desc' => 'Penuh gairah, lugas, visioner, dan menantang status quo.'],
            'growth_path'           => 'Belajar mensyukuri dan merayakan setiap pencapaian saat ini sebelum beralih ke tantangan berikutnya.',
            'synergy_summary'       => 'Daya dorong luar biasa yang menggabungkan visi puncak dengan eksekusi pembelajaran cepat.',
            'key_question'          => 'Apakah saya mengejar tujuan ini demi esensi dampak atau demi kehausan validasi?',
        ],

        // 6. Growth + Significance
        'Growth_Significance' => [
            'name'                  => 'The Dynamic Pioneer',
            'combination'           => 'Growth + Significance',
            'description'           => "Anda adalah sosok penakluk batas yang memadukan dorongan prestasi puncak dengan kehausan belajar tanpa henti. Anda selalu berada di garis depan inovasi, gemar memecahkan tantangan baru, dan menolak terjebak dalam status quo yang membosankan.\n\nAnda sering tampil sebagai pelopor transformasional, entrepreneur visioner, atau katalisator perubahan yang mampu menginspirasi lingkungan sekitar untuk melampaui batas kemampuan mereka.",
            'core_desire'           => 'Mencapai potensi tertinggi diri dan menciptakan mahakarya inovatif yang diakui dunia.',
            'core_fear'             => 'Menjadi medioker, tidak berkembang, atau kehilangan relevansi dalam kompetisi.',
            'strengths'             => [
                ['title' => 'Visionary Drive', 'desc' => 'Memiliki ambisi besar yang didukung oleh kecepatan belajar luar biasa.'],
                ['title' => 'Relentless Innovation', 'desc' => 'Tidak pernah puas dengan status quo dan selalu menciptakan standar baru.'],
            ],
            'blindspots'            => [
                ['title' => 'Burnout Vulnerability', 'desc' => 'Mendorong diri dan tim terlalu keras tanpa jeda istirahat.'],
            ],
            'what_drives'           => ['Eksplorasi puncak', 'Standar keunggulan baru'],
            'what_drains'           => ['Stagnasi', 'Birokrasi kaku'],
            'leadership_style'      => ['title' => 'The Transformative Catalyst', 'desc' => 'Inspiratif, cepat, dan visioner.'],
            'communication_style'   => ['title' => 'Inspirational & Direct', 'desc' => 'Penuh energi dan menantang batas.'],
            'growth_path'           => 'Menemukan kedamaian batin dalam proses, bukan hanya dalam hasil akhir.',
            'synergy_summary'       => 'Kombinasi energi pembelajar dan penakluk puncak prestasi.',
            'key_question'          => 'Bagaimana saya bisa bertumbuh hebat tanpa mengorbankan ketenangan jiwa?',
        ],

        // 7. Significance + Connection (The Charismatic Influencer)
        'Significance_Connection' => [
            'name'                  => 'The Charismatic Influencer',
            'combination'           => 'Significance + Connection',
            'description'           => "Anda memadukan daya tarik relasional yang hangat dan empatik dengan visi pengaruh yang kuat. Anda memiliki kemampuan alami untuk memahami orang lain dan menggerakkan mereka menuju tujuan yang bermakna bersama.\n\nAnda sering tampil sebagai komunikator yang persuasif, pembangun jejaring strategis, atau pemimpin karismatik yang mampu menyatukan banyak hati untuk menciptakan dampak positif yang luas.",
            'core_desire'           => 'Membangun pengaruh positif yang luas sambil menjalin hubungan yang mendalam dan bermakna.',
            'core_fear'             => 'Ditolak oleh komunitas atau dipandang tidak memiliki nilai di mata orang lain.',
            'strengths'             => [
                ['title' => 'Magnetic Leadership', 'desc' => 'Menyatukan orang banyak di bawah visi bersama dengan karisma dan empati autentik.'],
                ['title' => 'High-Impact Networking', 'desc' => 'Membangun jejaring kolaborasi strategis yang saling menguntungkan dan penuh kepercayaan.'],
            ],
            'blindspots'            => [
                ['title' => 'Validation Sensitivity', 'desc' => 'Terlalu memikirkan opini publik dan penilaian orang lain terhadap dirinya.'],
            ],
            'what_drives'           => ['Membangun komunitas berdampak', 'Mendapat respek dari orang-orang hebat', 'Menginspirasi banyak orang'],
            'what_drains'           => ['Isolasi sosial', 'Konflik berkepanjangan', 'Lingkungan sinis dan tertutup'],
            'leadership_style'      => ['title' => 'The Charismatic Unifier', 'desc' => 'Memimpin dengan mendengarkan hati tim dan mengarahkan mereka menuju tujuan besar.'],
            'communication_style'   => ['title' => 'Warm, Engaging & Persuasive', 'desc' => 'Empatik, persuasif, menyentuh emosi, dan memberdayakan.'],
            'growth_path'           => 'Memperkuat integritas nilai pribadi agar tidak mudah goyah oleh pujian maupun kritik sosial.',
            'synergy_summary'       => 'Perpaduan kuat antara kehangatan interpersonal dan kepemimpinan yang berdampak luas.',
            'key_question'          => 'Apakah saya memimpin untuk melayani mereka atau untuk memuaskan ego pribadi?',
        ],

        // 8. Connection + Significance
        'Connection_Significance' => [
            'name'                  => 'The Charismatic Influencer',
            'combination'           => 'Connection + Significance',
            'description'           => "Anda memadukan daya tarik relasional yang hangat dan empatik dengan visi pengaruh yang kuat. Anda memiliki kemampuan alami untuk memahami orang lain dan menggerakkan mereka menuju tujuan yang bermakna bersama.\n\nAnda sering tampil sebagai komunikator yang persuasif, pembangun jejaring strategis, atau pemimpin karismatik yang mampu menyatukan banyak hati untuk menciptakan dampak positif yang luas.",
            'core_desire'           => 'Membangun pengaruh positif yang luas sambil menjalin hubungan yang mendalam dan bermakna.',
            'core_fear'             => 'Ditolak oleh komunitas atau dipandang tidak memiliki nilai di mata orang lain.',
            'strengths'             => [
                ['title' => 'Magnetic Leadership', 'desc' => 'Menyatukan orang banyak di bawah visi bersama dengan karisma dan empati autentik.'],
            ],
            'blindspots'            => [
                ['title' => 'Validation Sensitivity', 'desc' => 'Terlalu memikirkan opini publik dan penilaian orang lain terhadap dirinya.'],
            ],
            'what_drives'           => ['Pengaruh positif', 'Kolaborasi bermakna'],
            'what_drains'           => ['Pengabaian sosial', 'Lingkungan toksik'],
            'leadership_style'      => ['title' => 'The Charismatic Unifier', 'desc' => 'Menginspirasi dan membangun kohesi tim.'],
            'communication_style'   => ['title' => 'Warm, Engaging & Persuasive', 'desc' => 'Membangun kedekatan sekaligus memotivasi.'],
            'growth_path'           => 'Menjaga keberanian menetapkan keputusan tegas kendati tidak populer.',
            'synergy_summary'       => 'Kharisma hubungan yang membuahkan kepemimpinan berdampak nyata.',
            'key_question'          => 'Apakah saya berani berkata benar meskipun itu berisiko mengecewakan sebagian orang?',
        ],

        // 9. Connection + Growth (The Collaborative Catalyst)
        'Connection_Growth' => [
            'name'                  => 'The Collaborative Catalyst',
            'combination'           => 'Connection + Growth',
            'description'           => "Anda adalah pembelajar dan pemberdaya alami yang meyakini bahwa pertumbuhan terbaik adalah pertumbuhan yang diraih bersama-sama. Anda menikmati ekosistem yang suportif, dialog terbuka, dan kolaborasi yang memicu inovasi kolektif.\n\nAnda sering menjadi mentor yang menginspirasi, fasilitator komunitas, atau katalisator tim yang mampu membuka potensi tersembunyi rekan kerja melalui kehangatan dan rasa saling percaya.",
            'core_desire'           => 'Tumbuh bersama dalam komunitas yang saling mendukung, terbuka, dan penuh kasih.',
            'core_fear'             => 'Terjebak dalam lingkungan kompetitif yang dingin atau terisolasi dari proses belajar bersama.',
            'strengths'             => [
                ['title' => 'Collective Empowerment', 'desc' => 'Membantu orang lain menemukan dan memaksimalkan potensi terbaik mereka.'],
                ['title' => 'Open-Minded Co-Creation', 'desc' => 'Menggabungkan ide-ide dari berbagai latar belakang menjadi solusi inovatif bersama.'],
            ],
            'blindspots'            => [
                ['title' => 'Conflict Hesitation', 'desc' => 'Menunda memberikan masukan kritis karena khawatir melukai perasaan rekan kerja.'],
            ],
            'what_drives'           => ['Belajar dan berbagi ilmu bersama', 'Melihat pertumbuhan orang lain', 'Kolaborasi lintas disiplin'],
            'what_drains'           => ['Egosentrisme tim', 'Persaingan saling menjatuhkan', 'Ketertutupan terhadap ide baru'],
            'leadership_style'      => ['title' => 'The Facilitative Mentor', 'desc' => 'Memimpin dengan melayani, memfasilitasi dialog bermakna, dan membimbing pertumbuhan tiap individu.'],
            'communication_style'   => ['title' => 'Empathetic, Curious & Inclusive', 'desc' => 'Mendengarkan aktif, menghargai setiap sudut pandang, dan merangkul ide-ide baru.'],
            'growth_path'           => 'Memahami bahwa kejujuran dan masukan yang tegas (*radical candor*) adalah bentuk kepedulian tertinggi bagi pertumbuhan sejati.',
            'synergy_summary'       => 'Katalisator yang menghadirkan inovasi dan pembelajaran melalui kekuatan koneksi manusiawi.',
            'key_question'          => 'Apakah saya menahan masukan jujur demi kenyamanan sesaat, padahal itu penting bagi pertumbuhan mereka?',
        ],

        // 10. Growth + Connection
        'Growth_Connection' => [
            'name'                  => 'The Collaborative Catalyst',
            'combination'           => 'Growth + Connection',
            'description'           => "Anda adalah pembelajar dan pemberdaya alami yang meyakini bahwa pertumbuhan terbaik adalah pertumbuhan yang diraih bersama-sama. Anda menikmati ekosistem yang suportif, dialog terbuka, dan kolaborasi yang memicu inovasi kolektif.\n\nAnda sering menjadi mentor yang menginspirasi, fasilitator komunitas, atau katalisator tim yang mampu membuka potensi tersembunyi rekan kerja melalui kehangatan dan rasa saling percaya.",
            'core_desire'           => 'Tumbuh bersama dalam komunitas yang saling mendukung, terbuka, dan penuh kasih.',
            'core_fear'             => 'Terjebak dalam lingkungan kompetitif yang dingin atau terisolasi dari proses belajar bersama.',
            'strengths'             => [
                ['title' => 'Collective Empowerment', 'desc' => 'Membantu orang lain menemukan dan memaksimalkan potensi terbaik mereka.'],
            ],
            'blindspots'            => [
                ['title' => 'Conflict Hesitation', 'desc' => 'Menunda memberikan masukan kritis karena khawatir melukai perasaan rekan.'],
            ],
            'what_drives'           => ['Eksplorasi bersama', 'Pemberdayaan tim'],
            'what_drains'           => ['Lingkungan dingin dan individualis'],
            'leadership_style'      => ['title' => 'The Facilitative Mentor', 'desc' => 'Membimbing dan memberdayakan potensi kolektif.'],
            'communication_style'   => ['title' => 'Empathetic & Inclusive', 'desc' => 'Mendengarkan aktif dan merangkul ide baru.'],
            'growth_path'           => 'Berani memberikan feedback kritis yang konstruktif demi kebaikan bersama.',
            'synergy_summary'       => 'Pertumbuhan berkelanjutan yang berakar pada empati dan kerja sama.',
            'key_question'          => 'Bagaimana saya bisa menyeimbangkan kelembutan relasi dengan ketegasan pengembangan?',
        ],

    ],

];
