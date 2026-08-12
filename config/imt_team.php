<?php

return [
    'drivers' => [
        'security' => [
            'name' => 'Security',
            'label' => 'SECURITY',
            'color' => '#2f6fed',
            'icon' => '1',
            'tagline' => 'The Stability Driver',
            'pitch' => 'Driver yang membuat tim ini memastikan segala sesuatu dipersiapkan dengan matang sebelum melangkah, bukan sekadar mengikuti arus.',
            'coreNeed' => 'Tim ini merasa paling stabil saat operasional dan arah perusahaan terasa bisa diprediksi serta terkendali.',
            'coreFear' => 'Perubahan mendadak yang datang tanpa peringatan dan membuat tim kehilangan pijakan, adalah hal yang paling ingin dihindari bersama.',
            'bands' => [
                'low' => ['title' => 'Pencari Tantangan', 'tags' => ['Fleksibel', 'Berani Ambil Risiko', 'Adaptif']],
                'mid' => ['title' => 'Perencana Seimbang', 'tags' => ['Terorganisir', 'Realistis', 'Tenang']],
                'high' => ['title' => 'Penjaga Stabilitas', 'tags' => ['Siap', 'Bertanggung Jawab', 'Konsisten']],
                'vhigh' => ['title' => 'Pengawal Ketahanan', 'tags' => ['Waspada', 'Teliti', 'Sangat Andal']],
            ],
            'team_desc' => 'Tim ini menghargai kejelasan, proses, dan perencanaan. Mereka bukan kelompok yang suka mengambil risiko tanpa perhitungan matang.',
            'team_weakness' => 'Tim berisiko kehilangan momentum karena terlalu lama merencanakan dan takut mengambil risiko di tengah ketidakpastian.',
            'team_strength' => 'Tim sangat handal dalam menjaga sistem, memastikan kualitas kerja tetap konsisten, dan menghindari kesalahan fatal.',
            'healthy' => [
                'desc' => 'Versi paling sehat, saat tim merencanakan dengan matang namun tetap bisa bergerak cepat.',
                'points' => [
                    'Tim memiliki proses yang jelas namun tidak birokratis.',
                    'Risiko dihitung, bukan dihindari sama sekali.',
                    'Anggota tim merasa aman untuk memberikan masukan.'
                ]
            ],
            'activated' => [
                'trigger' => 'Muncul saat tim dihadapkan pada proyek yang memiliki banyak risiko atau ketidakpastian.',
                'points' => [
                    'Tim mulai memperketat aturan dan pengawasan.',
                    'Banyak waktu dihabiskan untuk merumuskan rencana cadangan.'
                ]
            ],
            'stress' => [
                'desc' => 'Muncul saat situasi berubah terlalu cepat di luar kendali.',
                'points' => [
                    'Tim menjadi kaku dan menolak perubahan.',
                    'Inovasi terhenti karena ketakutan akan kegagalan.'
                ]
            ],
            'shadow' => [
                'desc' => 'Versi berlebihan, saat dorongan akan stabilitas berubah menjadi birokrasi yang melumpuhkan.',
                'points' => [
                    'Aturan menjadi lebih penting daripada hasil.',
                    'Keengganan ekstrem untuk mengambil keputusan tanpa data 100% lengkap.'
                ]
            ],
            'growth' => [
                'desc' => 'Bentuk paling matang, saat tim menyadari bahwa keamanan sejati berasal dari ketahanan beradaptasi.',
                'points' => [
                    'Tim membangun sistem yang lentur (agile).',
                    'Mengelola risiko sambil tetap terbuka pada eksperimen terkontrol.'
                ]
            ],
            'challenge' => [
                'title' => 'Belajar Menavigasi Ketidakpastian Tanpa Kehilangan Kendali',
                'lesson' => 'Inti tantangan tim ini bukan menghilangkan semua risiko, tapi belajar bahwa kemampuan beradaptasi adalah bentuk keamanan (security) yang paling kokoh di era yang cepat berubah.'
            ]
        ],
        
        'significance' => [
            'name' => 'Significance',
            'label' => 'SIGNIFICANCE',
            'color' => '#e8862e',
            'icon' => '2',
            'tagline' => 'The Achievement Driver',
            'pitch' => 'Driver yang mendorong tim ini mengejar hasil yang benar-benar bisa dibanggakan secara kolektif, bukan sekadar cukup.',
            'coreNeed' => 'Tim ini ingin tahu bahwa target yang mereka kerjakan benar-benar berdampak besar dan diakui secara luas.',
            'coreFear' => 'Bayangan menjadi tim yang biasa-biasa saja dan tidak memberikan prestasi yang membanggakan, cukup mengganggu dinamika kelompok.',
            'bands' => [
                'low' => ['title' => 'Jiwa Rendah Hati', 'tags' => ['Rendah Hati', 'Fokus', 'Autentik']],
                'mid' => ['title' => 'Pengejar Kualitas', 'tags' => ['Berstandar', 'Tekun', 'Seimbang']],
                'high' => ['title' => 'Pencapai Berdedikasi', 'tags' => ['Ambisius', 'Berorientasi Hasil', 'Percaya Diri']],
                'vhigh' => ['title' => 'Pengukir Legasi', 'tags' => ['Sangat Ambisius', 'Kompetitif', 'Berorientasi Legasi']],
            ],
            'team_desc' => 'Tim ini sangat termotivasi oleh pengakuan, pencapaian target tinggi, dan menjaga standar kualitas kerja.',
            'team_weakness' => 'Tim rentan terjebak persaingan internal dan mengorbankan kerja sama demi menonjolkan prestasi masing-masing.',
            'team_strength' => 'Tim tidak pernah puas dengan hasil biasa; mereka selalu mendorong batas untuk memberikan yang terbaik.',
            'healthy' => [
                'desc' => 'Versi paling sehat, saat tim mengejar keunggulan tanpa merendahkan pihak lain.',
                'points' => [
                    'Tim merayakan keberhasilan bersama.',
                    'Standar kualitas dijaga karena kebanggaan profesional, bukan sekadar pujian.',
                    'Anggota tim saling mengangkat, bukan saling bersaing.'
                ]
            ],
            'activated' => [
                'trigger' => 'Muncul saat tim diberikan target ambisius atau berada dalam kompetisi.',
                'points' => [
                    'Tim bekerja lebih keras dari biasanya untuk membuktikan diri.',
                    'Fokus bergeser sangat kuat pada hasil akhir (KPI).'
                ]
            ],
            'stress' => [
                'desc' => 'Muncul saat tim merasa upaya keras mereka tidak dihargai atau diakui.',
                'points' => [
                    'Moral menurun drastis jika merasa diremehkan.',
                    'Saling menyalahkan ketika target meleset.'
                ]
            ],
            'shadow' => [
                'desc' => 'Versi berlebihan, saat dorongan berprestasi berubah menjadi ego kolektif yang arogan.',
                'points' => [
                    'Menghalalkan segala cara untuk mencapai target (mengorbankan proses).',
                    'Mengabaikan tim/departemen lain demi terlihat menonjol sendiri.'
                ]
            ],
            'growth' => [
                'desc' => 'Bentuk paling matang, saat tim memahami bahwa nilai sejati mereka tidak selalu bergantung pada validasi eksternal.',
                'points' => [
                    'Fokus bergeser dari "terlihat hebat" menjadi "benar-benar berharga".',
                    'Mampu menerima masukan konstruktif tanpa merasa harga diri tim terserang.'
                ]
            ],
            'challenge' => [
                'title' => 'Mendefinisikan Ulang Makna Kesuksesan Sejati',
                'lesson' => 'Inti tantangan tim ini bukan bekerja lebih keras, tapi melepaskan ketergantungan pada validasi eksternal dan menemukan kebanggaan murni dari kualitas proses itu sendiri.'
            ]
        ],

        'connection' => [
            'name' => 'Connection',
            'label' => 'CONNECTION',
            'color' => '#3aa65a',
            'icon' => '3',
            'tagline' => 'The Relationship Driver',
            'pitch' => 'Driver yang membuat keharmonisan dan ikatan antar anggota tim terasa sama pentingnya dengan pencapaian bisnis apa pun.',
            'coreNeed' => 'Pekerjaan terasa jauh lebih utuh bagi tim ini ketika dibangun di atas kolaborasi, kepercayaan, dan saling pengertian.',
            'coreFear' => 'Terjadinya konflik terbuka, perpecahan, atau merasa ada sekat-sekat antar anggota tim adalah hal yang paling ditakuti.',
            'bands' => [
                'low' => ['title' => 'Penjelajah Mandiri', 'tags' => ['Mandiri', 'Objektif', 'Tenang Sendiri']],
                'mid' => ['title' => 'Pembangun Hubungan', 'tags' => ['Selektif', 'Stabil', 'Suportif']],
                'high' => ['title' => 'Penghubung Hangat', 'tags' => ['Empatik', 'Loyal', 'Suportif']],
                'vhigh' => ['title' => 'Pembangun Komunitas', 'tags' => ['Sangat Empatik', 'Penyatu', 'Peka Sosial']],
            ],
            'team_desc' => 'Tim ini memprioritaskan kebersamaan, rasa saling percaya, dan dukungan emosional dalam bekerja sehari-hari.',
            'team_weakness' => 'Tim cenderung menghindari konflik yang diperlukan, menahan kritik objektif agar tidak melukai perasaan kolega.',
            'team_strength' => 'Loyalitas dan kekompakan tim sangat tinggi; mereka selalu siap membantu satu sama lain di saat sulit.',
            'healthy' => [
                'desc' => 'Versi paling sehat, saat tim memiliki ikatan emosional yang kuat tanpa kehilangan objektivitas kerja.',
                'points' => [
                    'Komunikasi berlangsung jujur dan suportif.',
                    'Anggota tim merasa psikologisnya aman (psychological safety) untuk berbeda pendapat.',
                    'Empati digunakan untuk membangun kolaborasi nyata.'
                ]
            ],
            'activated' => [
                'trigger' => 'Muncul saat ada anggota tim yang mengalami kesulitan atau krisis.',
                'points' => [
                    'Seluruh anggota tim merapatkan barisan untuk memberi dukungan.',
                    'Fokus bergeser dari pekerjaan teknis ke pemulihan emosional kolega.'
                ]
            ],
            'stress' => [
                'desc' => 'Muncul saat terjadi konflik internal atau pergeseran kepemimpinan yang merusak keharmonisan.',
                'points' => [
                    'Timbulnya gosip dan klik-klikan di dalam tim.',
                    'Produktivitas terhenti karena anggota terlalu fokus pada ketegangan.'
                ]
            ],
            'shadow' => [
                'desc' => 'Versi berlebihan, saat dorongan keharmonisan berubah menjadi ketakutan kronis terhadap konflik.',
                'points' => [
                    'Kinerja buruk dari seseorang dibiarkan demi menjaga perasaan.',
                    'Groupthink: semua setuju hanya agar tidak ada yang berdebat.'
                ]
            ],
            'growth' => [
                'desc' => 'Bentuk paling matang, saat tim memahami bahwa konflik yang sehat adalah bentuk cinta dan kepedulian yang nyata.',
                'points' => [
                    'Berani memberikan masukan tegas tanpa takut hubungan rusak.',
                    'Memisahkan ikatan profesional dari ketergantungan emosional.'
                ]
            ],
            'challenge' => [
                'title' => 'Berani Membangun Kedekatan Melalui Kejujuran',
                'lesson' => 'Inti tantangan tim ini bukan mencari teman, tapi belajar bahwa kepercayaan (trust) sejati hanya bisa dibangun ketika tim berani berkonfrontasi demi kebaikan bersama.'
            ]
        ],

        'growth' => [
            'name' => 'Growth',
            'label' => 'GROWTH',
            'color' => '#7a5cc7',
            'icon' => '4',
            'tagline' => 'The Development Driver',
            'pitch' => 'Driver yang membuat tim ini gelisah kalau terlalu lama berada di zona yang itu-itu saja.',
            'coreNeed' => 'Tim ini merasa paling hidup ketika sedang mempelajari sesuatu yang baru dan menjadi organisasi yang lebih baik dari kemarin.',
            'coreFear' => 'Terjebak di tempat yang sama tanpa kemajuan, seolah waktu berhenti untuk tim ini, adalah ketakutan terbesar mayoritas anggota.',
            'bands' => [
                'low' => ['title' => 'Penikmat Rutinitas', 'tags' => ['Konsisten', 'Fokus', 'Praktis']],
                'mid' => ['title' => 'Pembelajar Praktis', 'tags' => ['Terbuka', 'Reflektif', 'Praktis']],
                'high' => ['title' => 'Pencari Wawasan', 'tags' => ['Penasaran', 'Berpikiran Terbuka', 'Adaptif']],
                'vhigh' => ['title' => 'Penjelajah Tanpa Batas', 'tags' => ['Sangat Adaptif', 'Visioner', 'Eksploratif']],
            ],
            'team_desc' => 'Tim yang secara alami senang belajar hal baru dan mengeksplorasi ide, bukan sekadar diam di tempat.',
            'team_weakness' => 'Tim sering kali gagal menyelesaikan proyek lama secara tuntas karena terlalu cepat tergiur oleh proyek/ide baru.',
            'team_strength' => 'Tim sangat mudah beradaptasi dengan perubahan pasar dan teknologi; inovasi mengalir secara natural.',
            'healthy' => [
                'desc' => 'Versi paling sehat, saat tim berkembang karena percaya selalu ada ruang jadi lebih baik.',
                'points' => [
                    'Tim terbuka terhadap ide baru.',
                    'Tim menikmati proses belajar bersama.',
                    'Tim mudah beradaptasi saat keadaan berubah.'
                ]
            ],
            'activated' => [
                'trigger' => 'Muncul saat tim menghadapi proyek baru atau peluang yang belum pernah dicoba.',
                'points' => [
                    'Tim banyak bertanya dan mencari wawasan baru.',
                    'Tim mengeksplorasi beberapa pendekatan sebelum memutuskan.'
                ]
            ],
            'stress' => [
                'desc' => 'Muncul saat kemajuan proyek terasa terlalu lambat atau penuh hambatan.',
                'points' => [
                    'Tim gelisah ketika tidak melihat kemajuan.',
                    'Fokus bergeser dari belajar menjadi kecemasan karena merasa tertinggal.'
                ]
            ],
            'shadow' => [
                'desc' => 'Versi berlebihan, saat dorongan berkembang berubah jadi ketidakpuasan terus-menerus.',
                'points' => [
                    'Tim jarang menuntaskan sesuatu sebelum pindah ke hal baru.',
                    'Stabilitas dikorbankan demi terus mencari tantangan.'
                ]
            ],
            'growth' => [
                'desc' => 'Bentuk paling matang, saat tim berkembang dengan sabar, bukan terburu-buru.',
                'points' => [
                    'Tim menikmati proses sekaligus hasilnya.',
                    'Tim menyeimbangkan eksperimen inovasi dengan konsistensi eksekusi.'
                ]
            ],
            'challenge' => [
                'title' => 'Belajar Menikmati Proses Bertumbuh Bersama',
                'lesson' => 'Inti tantangan tim ini bukan bergerak lebih cepat, tapi belajar menghargai kemajuan yang sudah dicapai sejauh ini sebelum melompat ke hal berikutnya.'
            ]
        ],

        'contribution' => [
            'name' => 'Contribution',
            'label' => 'CONTRIBUTION',
            'color' => '#1f8a6e',
            'icon' => '5',
            'tagline' => 'The Purpose Driver',
            'pitch' => 'Driver yang membuat tim ini merasa paling produktif saat usaha mereka benar-benar memberi manfaat nyata bagi lingkungan sekitar.',
            'coreNeed' => 'Tim ini merasa pekerjaannya paling berharga saat mereka tahu bahwa kontribusi kolektif mereka membantu banyak orang.',
            'coreFear' => 'Pikiran bahwa karya dan keberadaan organisasi ini tidak membuat perbedaan apa pun bagi masyarakat atau kolega adalah sesuatu yang mengganggu.',
            'bands' => [
                'low' => ['title' => 'Fokus Personal', 'tags' => ['Fokus Diri', 'Efisien', 'Berorientasi Tujuan']],
                'mid' => ['title' => 'Pemberi Manfaat', 'tags' => ['Peduli', 'Kolaboratif', 'Seimbang']],
                'high' => ['title' => 'Kontributor Terpercaya', 'tags' => ['Berdampak', 'Membantu', 'Penuh Tujuan']],
                'vhigh' => ['title' => 'Pembawa Dampak', 'tags' => ['Sangat Berdampak', 'Berorientasi Layanan', 'Visioner Sosial']],
            ],
            'team_desc' => 'Tim ini digerakkan oleh panggilan (purpose) dan peduli pada seberapa besar dampak pekerjaan mereka bagi orang lain.',
            'team_weakness' => 'Tim rentan mengalami burnout karena terlalu banyak mengambil tanggung jawab orang lain (over-functioning).',
            'team_strength' => 'Tim tidak pernah pelit dalam berbagi ilmu dan tenaga; mereka selalu berpikir untuk kepentingan yang lebih besar (bigger picture).',
            'healthy' => [
                'desc' => 'Versi paling sehat, saat tim melayani tujuan besar tanpa mengorbankan kesejahteraan mereka sendiri.',
                'points' => [
                    'Tim proaktif memberikan solusi yang berdampak luas.',
                    'Energi difokuskan pada karya-karya bermakna.',
                    'Anggota saling menginspirasi melalui tindakan nyata.'
                ]
            ],
            'activated' => [
                'trigger' => 'Muncul saat tim melihat adanya kebutuhan mendesak atau klien yang benar-benar butuh bantuan.',
                'points' => [
                    'Tim segera mengesampingkan kepentingan pribadi demi menolong.',
                    'Aksi solidaritas dan inisiatif meningkat tajam.'
                ]
            ],
            'stress' => [
                'desc' => 'Muncul saat tim merasa pengorbanan mereka dimanfaatkan atau tidak berujung pada dampak yang diharapkan.',
                'points' => [
                    'Tim merasa lelah secara emosional (compassion fatigue).',
                    'Muncul rasa frustrasi karena merasa "hanya kita yang peduli".'
                ]
            ],
            'shadow' => [
                'desc' => 'Versi berlebihan, saat dorongan berkontribusi berubah menjadi sindrom penyelamat (savior complex).',
                'points' => [
                    'Mencampuri urusan departemen lain atas nama "membantu".',
                    'Mengabaikan KPI utama tim sendiri karena terlalu sibuk mengurus pekerjaan sosial/eksternal.'
                ]
            ],
            'growth' => [
                'desc' => 'Bentuk paling matang, saat tim memahami bahwa kontribusi terbaik berasal dari kapasitas yang terjaga.',
                'points' => [
                    'Mampu berkata "tidak" pada permintaan yang berada di luar kapasitas inti mereka.',
                    'Membangun sistem pemberdayaan (empowerment) agar orang lain mandiri, bukan malah terus dibantu.'
                ]
            ],
            'challenge' => [
                'title' => 'Menetapkan Batas Sehat dalam Berkarya',
                'lesson' => 'Inti tantangan tim ini bukan mencari siapa lagi yang harus diselamatkan, tapi memastikan piala kalian sendiri terisi penuh sebelum menuangkannya untuk orang lain.'
            ]
        ],
    ]
];
