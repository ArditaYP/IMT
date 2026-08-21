<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>IMT Discovery — Temukan 5 Human Drivers & Motivasi Sejati Anda</title>
<meta name="description" content="IMT Discovery adalah tes psikometri yang mengungkap 5 Human Drivers, arketipe, dan skor DQ (Driver Quotient) — kecerdasan mengelola motivasi diri — dengan laporan interpretasi otomatis dalam hitungan menit. Untuk individu & tim korporasi.">
<meta name="keywords" content="tes kepribadian, tes motivasi, IMT Discovery, DQ Driver Quotient, Driver Intelligence, psikometri, assessment korporasi, tes karyawan">
<link rel="canonical" href="https://imtdiscovery.id/">
<meta property="og:title" content="IMT Discovery — Temukan Apa yang Benar-Benar Menggerakkan Anda">
<meta property="og:description" content="Tes psikometri 5 Human Drivers + skor DQ (Driver Quotient). Laporan interpretasi otomatis, personal & korporasi.">
<meta property="og:type" content="website">
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"Product",
  "name":"IMT Discovery",
  "description":"Tes psikometri 5 Human Drivers dengan skor DQ (Driver Quotient) dan laporan interpretasi otomatis.",
  "brand":"IMT",
  "offers":{"@type":"AggregateOffer","lowPrice":"99000","highPrice":"499000","priceCurrency":"IDR"}
}
</script>
<script type="application/ld+json">
{
  "@context":"https://schema.org",
  "@type":"FAQPage",
  "mainEntity":[
    {"@type":"Question","name":"Apakah IMT Discovery valid secara ilmiah?","acceptedAnswer":{"@type":"Answer","text":"Instrumen ini disusun mengacu pada prinsip-prinsip psikometri yang sama dengan tes assessment internasional, meliputi reliabilitas konsistensi internal (Cronbach's alpha) dan validitas konstruk melalui uji coba dan telaah konten. Hasilnya bersifat deskriptif, memetakan pola motivasi, bukan diagnosis klinis."}},
    {"@type":"Question","name":"Bagaimana IMT Discovery mendeteksi jawaban asal-klik atau tidak jujur?","acceptedAnswer":{"@type":"Answer","text":"Tes menyisipkan pernyataan pemeriksa konsistensi dan keaslian jawaban, serta memantau kecepatan menjawab untuk mendeteksi careless responding, sejalan dengan praktik umum tes self-report internasional."}},
    {"@type":"Question","name":"Apa itu Driver Intelligence (DI) dan skor DQ?","acceptedAnswer":{"@type":"Answer","text":"DI adalah kerangka 5 dimensi (Awareness, Insight, Regulation, Development, Transformation) yang mengukur kesadaran dan kecakapan mengelola motivasi diri. DQ adalah skor gabungan kelima dimensi tersebut, ditampilkan dalam persentase."}},
    {"@type":"Question","name":"Apakah ada jawaban benar atau salah?","acceptedAnswer":{"@type":"Answer","text":"Tidak ada. Setiap pernyataan mengukur kecenderungan pribadi pada skala 1-7, dijawab berdasarkan kebiasaan nyata, bukan jawaban ideal."}},
    {"@type":"Question","name":"Apakah IMT Discovery pengganti tes psikologi klinis?","acceptedAnswer":{"@type":"Answer","text":"Bukan. IMT Discovery adalah alat pengembangan diri dan profesional, bukan instrumen diagnostik klinis dan tidak menggantikan evaluasi psikolog atau psikiater berlisensi."}},
    {"@type":"Question","name":"Bagaimana data dan jawaban saya dijaga kerahasiaannya?","acceptedAnswer":{"@type":"Answer","text":"Jawaban dan laporan bersifat pribadi, tidak dibagikan ke pihak ketiga tanpa izin, dan dikelola sejalan dengan UU No. 27/2022 tentang Pelindungan Data Pribadi."}}
  ]
}
</script>
<link rel="icon" type="image/png" href="<?php echo e(asset('assets/img/favicon.png')); ?>">
<link rel="apple-touch-icon" href="<?php echo e(asset('assets/img/apple-touch-icon.png')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/style.css')); ?>">
</head>
<body>

<nav class="nav">
  <div class="nav-inner">
    <div class="nav-brand-wrapper">
      <div class="brand"><img class="brand-icon" src="<?php echo e(asset('assets/img/logo-icon.png')); ?>" alt="IMT Discovery"> IMT DISCOVERY</div>
      
      <!-- Hamburger Menu for Mobile -->
      <button class="hamburger" id="hamburger-btn" aria-label="Menu">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
      </button>
    </div>

    <div class="nav-menu" id="nav-menu">
      <div class="nav-links">
      <a href="#drivers">5 Drivers</a>
      <a href="#how">Cara Kerja</a>
      <a href="#pricing">Harga</a>
      <a href="#faq">FAQ</a>
      <a href="team.html">Untuk Tim/Korporasi</a>
    </div>
    <div class="nav-cta" style="display: flex; align-items: center; gap: 12px;">
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('pilih-tes')); ?>" class="btn btn-primary">Mulai Tes</a>
        
        <style>
          .user-dropdown-btn { display: flex; align-items: center; gap: 6px; padding: 10px 20px; font-size: 15px; border-radius: 999px; }
          .user-dropdown-menu { display: none; position: absolute; right: 0; top: 100%; margin-top: 10px; background: #fff; border: 1px solid var(--border); border-radius: 16px; box-shadow: var(--shadow-lg); min-width: 200px; z-index: 50; padding: 8px 0; overflow: hidden; }
          .user-dropdown-item { display: block; padding: 12px 20px; font-size: 15px; color: var(--navy); font-weight: 500; text-decoration: none; text-align: left; background: none; border: none; width: 100%; cursor: pointer; transition: background 0.15s ease, color 0.15s ease; }
          .user-dropdown-item:hover { background: #f4f6fb; color: var(--blue); }
          .user-dropdown-item.danger { color: #ef4444; }
          .user-dropdown-item.danger:hover { background: #fef2f2; color: #dc2626; }
        </style>

        <div class="dropdown" style="position: relative;">
          <button onclick="toggleDropdown()" class="btn btn-ghost user-dropdown-btn">
            <?php echo e(strtok(auth()->user()->name, ' ')); ?>

            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
          </button>
          <div id="userDropdown" class="user-dropdown-menu">
            <a href="<?php echo e(route('dashboard')); ?>" class="user-dropdown-item" style="border-bottom: 1px solid #f0f2f8;">Dashboard</a>
            <a href="<?php echo e(route('profile.edit')); ?>" class="user-dropdown-item" style="border-bottom: 1px solid #f0f2f8;">Profil Saya</a>
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin: 0;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="user-dropdown-item danger">Keluar</button>
            </form>
          </div>
        </div>
      <?php else: ?>
        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-ghost">Masuk</a>
        <a href="<?php echo e(route('pilih-tes')); ?>" class="btn btn-primary">Mulai Tes</a>
      <?php endif; ?>
      </div> <!-- nav-cta -->
    </div> <!-- end nav-menu -->
  </div>
</nav>

<header class="hero">
  <div class="container">
    <div class="eyebrow">✦ SETELAH IQ DAN EQ, KENALI DQ ANDA</div>
    <h1>Penghambat Anda Bukan dari Luar.<br><span>Tapi dari Dalam Diri Sendiri.</span></h1>
    <p class="lead">Mungkin Anda belum sadar, apa yang selama ini menghambat, baik untuk diri sendiri maupun tim. IMT Discovery menemukan 5 Human Drivers dan mengukur Driver Quotient (DQ) Anda, untuk menemukan apa yang belum pernah benar-benar Anda sadari.</p>
    <div class="hero-ctas">
      <a href="<?php echo e(route('pilih-tes')); ?>" class="btn btn-primary">Mulai Tes Sekarang</a>
      <a href="<?php echo e(route('pilih-tes')); ?>" class="btn btn-dark">Tes untuk Tim/Korporasi</a>
    </div>
    <div class="trust-row">
      <span>⭐ <b>4.9/5</b> dari 1.200+ pengguna</span>
      <span>🔬 <b>Berbasis</b> psikometri modern</span>
      <span>⏱️ <b>±15-20 menit</b> pengerjaan</span>
      <span>📄 <b>Laporan PDF</b> instan setelah bayar</span>
    </div>
  </div>
</header>

<section id="drivers">
  <div class="container">
    <div class="section-head">
      <div class="kicker">Kerangka IMT</div>
      <h2>5 Human Drivers yang membentuk setiap keputusan Anda</h2>
      <p>Setiap orang digerakkan oleh kombinasi unik dari lima kebutuhan psikologis inti. IMT Discovery mengukur kelimanya dan menerjemahkannya menjadi arketipe motivasi Anda.</p>
    </div>
    <div class="grid grid-5" id="driver-grid"></div>
  </div>
</section>

<div style="background:#f4f6fb; border-top:1px solid var(--border); border-bottom:1px solid var(--border); padding:13px 0;">
  <div class="container" style="display:flex; align-items:center; justify-content:center; gap:12px; flex-wrap:wrap; text-align:center;">
    <span style="font-size:13px; color:var(--muted);">🎓 Kerangka IMT Discovery disusun berdasarkan 18+ tahun pengalaman lapangan Coach Wira (bersertifikasi NLP, EQ &amp; CBT) — Motivator Bali Learning Center.</span>
    <a href="about.html" style="font-size:13px; font-weight:700; color:var(--blue); white-space:nowrap; text-decoration:none;">Selengkapnya →</a>
  </div>
</div>

<section style="background:var(--navy); color:#fff;">
  <div class="container" style="display:grid; grid-template-columns:1fr 1fr; gap:50px; align-items:center;">
    <div>
      <div class="kicker" style="color:var(--orange);">Keunggulan Kami</div>
      <h2 style="font-size:32px; font-weight:800; margin:10px 0 16px;">DQ (Driver Quotient) — angka baru setelah IQ dan EQ</h2>
      <p style="color:#c7cde0; line-height:1.7; font-size:15.5px;">Anda sudah tahu IQ (kecerdasan kognitif) dan EQ (kecerdasan emosional). <b style="color:#fff;">DQ mengukur seberapa sadar dan cakap Anda mengelola motivasi diri</b> — dibangun dari kerangka ilmiah Driver Intelligence (DI). Berbeda dari tes kepribadian statis, DQ menambahkan dimensi kesadaran diri, regulasi emosi, dan kapasitas berkembang ke dalam profil motivasi Anda. Hasilnya: wawasan yang bukan cuma "siapa Anda", tapi "bagaimana Anda bisa tumbuh".</p>
      <ul style="list-style:none; padding:0; margin-top:22px; font-size:14.5px; color:#dde3f2;">
        <li style="display:flex; align-items:flex-start; gap:13px; padding:9px 0;">
          <span style="flex-shrink:0; width:26px; height:26px; border-radius:50%; background:var(--blue); color:#fff; font-weight:800; font-size:12.5px; display:flex; align-items:center; justify-content:center;">1</span>
          <span><b style="color:#fff;">Awareness</b> — Bukan sekadar tebak-tebak kepribadian. Anda akhirnya tahu persis apa yang diam-diam menggerakkan setiap keputusan Anda selama ini.</span>
        </li>
        <li style="display:flex; align-items:flex-start; gap:13px; padding:9px 0;">
          <span style="flex-shrink:0; width:26px; height:26px; border-radius:50%; background:var(--orange); color:#fff; font-weight:800; font-size:12.5px; display:flex; align-items:center; justify-content:center;">2</span>
          <span><b style="color:#fff;">Insight</b> — Tiba-tiba semua masuk akal: kenapa Anda bereaksi seperti itu, dan kenapa pola yang sama terus berulang.</span>
        </li>
        <li style="display:flex; align-items:flex-start; gap:13px; padding:9px 0;">
          <span style="flex-shrink:0; width:26px; height:26px; border-radius:50%; background:var(--green); color:#fff; font-weight:800; font-size:12.5px; display:flex; align-items:center; justify-content:center;">3</span>
          <span><b style="color:#fff;">Regulation</b> — Saat orang lain panik, Anda tetap bisa mengarahkan diri sendiri — bukan dikendalikan tekanan.</span>
        </li>
        <li style="display:flex; align-items:flex-start; gap:13px; padding:9px 0;">
          <span style="flex-shrink:0; width:26px; height:26px; border-radius:50%; background:var(--purple); color:#fff; font-weight:800; font-size:12.5px; display:flex; align-items:center; justify-content:center;">4</span>
          <span><b style="color:#fff;">Development</b> — Bukan cuma kenal diri sendiri, tapi tahu persis dari mana harus mulai untuk jadi lebih baik.</span>
        </li>
        <li style="display:flex; align-items:flex-start; gap:13px; padding:9px 0;">
          <span style="flex-shrink:0; width:26px; height:26px; border-radius:50%; background:var(--teal); color:#fff; font-weight:800; font-size:12.5px; display:flex; align-items:center; justify-content:center;">5</span>
          <span><b style="color:#fff;">Transformation</b> — Titik di mana Anda berhenti sekadar bereaksi, dan mulai benar-benar memegang kendali atas hidup Anda.</span>
        </li>
      </ul>
    </div>
    <div style="background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.12); border-radius:20px; padding:34px; text-align:center;">
      <div style="font-size:13px; letter-spacing:2px; color:var(--orange); font-weight:700; margin-bottom:10px;">CONTOH SKOR ANDA</div>
      <div style="font-size:56px; font-weight:800; color:#fff;">DQ 82</div>
      <div style="font-size:14px; color:#c7cde0; margin-top:10px;">Radar profil 5 Drivers + skor DQ ditampilkan otomatis di laporan Anda</div>
    </div>
  </div>
</section>

<section id="how">
  <div class="container">
    <div class="section-head">
      <div class="kicker">Cara Kerja</div>
      <h2>Dari mengisi tes sampai punya laporan PDF — sepenuhnya otomatis</h2>
    </div>
    <div class="grid grid-3">
      <div class="card"><div class="driver-chip" style="background:var(--blue);">1</div><h3>Isi Tes 15-20 Menit</h3><p>Pernyataan singkat mengukur kekuatan 5 Human Drivers Anda, dilengkapi pemeriksaan validitas jawaban. Tidak ada jawaban benar/salah.</p></div>
      <div class="card"><div class="driver-chip" style="background:var(--orange);">2</div><h3>Bayar Sekali, Aman</h3><p>Checkout instan via QRIS, Virtual Account, atau e-wallet. Transaksi diproses otomatis.</p></div>
      <div class="card"><div class="driver-chip" style="background:var(--green);">3</div><h3>Unduh Laporan PDF</h3><p>Interpretasi personal Anda — arketipe, radar 5 drivers, kekuatan, dan langkah pengembangan — langsung tersedia.</p></div>
    </div>
  </div>
</section>

<section style="background:#f4f6fb;">
  <div class="container">
    <div class="section-head">
      <div class="kicker">Testimoni</div>
      <h2>Dipercaya individu & tim di berbagai industri</h2>
    </div>
    <div class="grid grid-3">
      <div class="card"><p>"Laporannya jelas dan langsung terasa 'kena'. Saya jadi paham kenapa saya selalu butuh rencana yang matang sebelum bertindak."</p><h3 style="margin-top:16px;">— Ketut S., Entrepreneur</h3></div>
      <div class="card"><p>"Kami pakai untuk onboarding tim leadership. Hasilnya membantu kami memetakan gaya kerja tiap orang dengan cepat."</p><h3 style="margin-top:16px;">— HR Manager, Perusahaan Retail</h3></div>
      <div class="card"><p>"Beda dari tes kepribadian lain — skor DQ-nya kasih insight yang bisa langsung dipraktikkan."</p><h3 style="margin-top:16px;">— Ni Made H., Konsultan</h3></div>
    </div>
  </div>
</section>

<section id="pricing">
  <div class="container">
    <div class="section-head">
      <div class="kicker">Harga</div>
      <h2>Pilih paket yang sesuai kebutuhan Anda</h2>
      <p>Harga promo untuk 100 pengguna pertama bulan ini.</p>
    </div>
    <div class="grid grid-3">
      <div class="price-card">
        <h3>Personal Basic</h3>
        <div class="price">Rp99.000 <small>/ tes</small></div>
        <ul>
          <li>Tes 5 Human Drivers lengkap</li>
          <li>Laporan PDF ringkasan</li>
          <li>Radar profil visual</li>
          <li>Akses dashboard pribadi</li>
        </ul>
        <a href="<?php echo e(route('assessment.test')); ?>" class="btn btn-ghost btn-block">Mulai Tes</a>
      </div>
      <div class="price-card featured">
        <div class="badge">PALING POPULER</div>
        <h3>Personal Discovery+</h3>
        <div class="price">Rp199.000 <small>/ tes</small></div>
        <ul>
          <li>Semua di paket Basic</li>
          <li>Skor DQ (Driver Quotient)</li>
          <li>Development Path per driver</li>
          <li>Konsultasi hasil 1x (chat)</li>
        </ul>
        <a href="<?php echo e(route('assessment.test')); ?>" class="btn btn-primary btn-block">Mulai Tes</a>
      </div>
      <div class="price-card">
        <h3>Tim / Korporasi</h3>
        <div class="price">Mulai Rp79rb <small>/ orang</small></div>
        <ul>
          <li>Minimal 10 peserta</li>
          <li>Dashboard admin & agregat tim</li>
          <li>Laporan per individu + insight tim</li>
          <li>Onboarding & dukungan khusus</li>
        </ul>
        <a href="team.html" class="btn btn-ghost btn-block">Lihat Detail</a>
      </div>
    </div>
  </div>
</section>

<section id="faq" style="background:#f4f6fb;">
  <div class="container">
    <div class="section-head">
      <div class="kicker">Pertanyaan Umum</div>
      <h2>Yang paling sering ditanyakan sebelum mulai tes</h2>
      <p>Termasuk bagaimana IMT Discovery menjaga standar psikometri, akurasi, dan kerahasiaan data Anda.</p>
    </div>
    <div class="faq-list">

      <details class="faq-item">
        <summary>Apakah IMT Discovery valid secara ilmiah?</summary>
        <div class="faq-a">
          <span class="faq-badge">VALIDITAS &amp; RELIABILITAS</span><br>
          Instrumen ini disusun mengacu pada prinsip-prinsip psikometri yang sama dengan tes assessment internasional (seperti DISC, Hogan, atau CliftonStrengths) — meliputi reliabilitas konsistensi internal (Cronbach's alpha) dan validitas konstruk melalui uji coba dan telaah konten oleh tim penyusun. Karena ini tes self-report berbasis kecenderungan (bukan tes kognitif dengan jawaban benar/salah), hasilnya bersifat deskriptif: memetakan pola motivasi Anda, bukan memberi diagnosis atau "vonis" kepribadian yang tetap.
        </div>
      </details>

      <details class="faq-item">
        <summary>Bagaimana IMT Discovery mendeteksi jawaban asal-klik atau tidak jujur?</summary>
        <div class="faq-a">
          <span class="faq-badge">KONTROL KUALITAS JAWABAN</span><br>
          Di dalam tes disisipkan beberapa pernyataan tersembunyi yang berfungsi sebagai pemeriksa konsistensi (parafrase dari pernyataan lain) dan pemeriksa keaslian jawaban (pernyataan absolut yang secara realistis jarang 100% berlaku pada siapa pun). Sistem juga memantau kecepatan menjawab — jika beberapa jawaban diberikan secara berturut-turut dalam waktu kurang dari 1 detik, Anda akan diingatkan untuk membaca lebih cermat. Pendekatan ini sejalan dengan praktik umum dalam tes self-report internasional untuk mendeteksi <i>social-desirability bias</i> dan <i>careless responding</i>. Hasilnya ditampilkan sebagai skor "Konsistensi Jawaban" di laporan Anda.
        </div>
      </details>

      <details class="faq-item">
        <summary>Apa itu Driver Intelligence (DI) dan skor DQ?</summary>
        <div class="faq-a">
          Driver Intelligence (DI) adalah kerangka 5 dimensi yang mengukur seberapa sadar dan cakap Anda mengelola motivasi diri — Awareness, Insight, Regulation, Development, dan Transformation. DQ (Driver Quotient) adalah skor gabungan dari kelima dimensi ini, ditampilkan dalam bentuk persentase di laporan Anda. Berbeda dari tes kepribadian statis yang hanya memberi "label", DQ menunjukkan sejauh mana Anda mampu mengarahkan driver Anda secara sehat dan produktif.
        </div>
      </details>

      <details class="faq-item">
        <summary>Apakah ada jawaban benar atau salah?</summary>
        <div class="faq-a">
          Tidak ada. Setiap pernyataan mengukur kecenderungan pribadi Anda pada skala 1–7 (Sangat Tidak Setuju – Sangat Setuju). Jawablah berdasarkan bagaimana Anda biasanya bersikap, bukan bagaimana Anda "seharusnya" bersikap — jawaban yang paling jujur akan memberi hasil yang paling akurat.
        </div>
      </details>

      <details class="faq-item">
        <summary>Apakah hasil tes ini bisa berubah dari waktu ke waktu?</summary>
        <div class="faq-a">
          Driver inti Anda relatif stabil, namun skor DQ dan cara Anda mengelola driver tersebut bisa berkembang seiring pengalaman, refleksi, dan usaha sadar untuk bertumbuh. Kami menyarankan mengulang tes setiap 6–12 bulan untuk melihat perkembangan Anda, terutama setelah momen-momen penting dalam hidup atau karier.
        </div>
      </details>

      <details class="faq-item">
        <summary>Apakah IMT Discovery pengganti tes psikologi klinis?</summary>
        <div class="faq-a">
          <span class="faq-badge">BATASAN PENGGUNAAN</span><br>
          Bukan. IMT Discovery adalah alat pengembangan diri dan profesional untuk memahami motivasi — bukan instrumen diagnostik klinis dan tidak dimaksudkan untuk menilai, mendiagnosis, atau menggantikan evaluasi kondisi kesehatan mental. Jika Anda memiliki kekhawatiran terkait kesehatan mental, sebaiknya berkonsultasi dengan psikolog atau psikiater berlisensi.
        </div>
      </details>

      <details class="faq-item">
        <summary>Bagaimana data dan jawaban saya dijaga kerahasiaannya?</summary>
        <div class="faq-a">
          Jawaban dan laporan Anda bersifat pribadi dan tidak dibagikan ke pihak ketiga tanpa izin Anda. Untuk paket tim/korporasi, admin hanya dapat melihat data agregat dan laporan individu peserta yang memang menjadi bagian dari program tersebut. Pengelolaan data mengikuti prinsip kerahasiaan sejalan dengan UU No. 27/2022 tentang Pelindungan Data Pribadi.
        </div>
      </details>

      <details class="faq-item">
        <summary>Apa bedanya IMT Discovery dengan DISC, MBTI, atau tes kepribadian lain?</summary>
        <div class="faq-a">
          Tes seperti DISC atau MBTI umumnya memetakan gaya perilaku atau preferensi kepribadian. IMT Discovery berangkat dari pertanyaan yang lebih mendasar: <i>apa yang menggerakkan perilaku itu?</i> — dengan mengukur 5 kebutuhan psikologis inti (Human Drivers) di baliknya, ditambah lapisan Driver Intelligence yang menilai seberapa sadar dan matang Anda mengelola driver tersebut. Keduanya bisa saling melengkapi, bukan saling menggantikan.
        </div>
      </details>

      <details class="faq-item">
        <summary>Apakah cocok digunakan untuk rekrutmen atau evaluasi kinerja karyawan?</summary>
        <div class="faq-a">
          IMT Discovery paling tepat digunakan untuk pengembangan diri, coaching, onboarding, dan memahami dinamika tim — bukan sebagai satu-satunya dasar keputusan perekrutan atau promosi. Sejalan dengan pedoman penggunaan tes yang berlaku umum secara internasional (a.l. ITC Guidelines on Test Use), hasil tes psikometri apa pun sebaiknya dikombinasikan dengan wawancara, rekam jejak kerja, dan metode evaluasi lain — tidak berdiri sendiri.
        </div>
      </details>

    </div>
    <p class="faq-note">IMT Discovery dirancang dengan mengacu pada prinsip-prinsip psikometri yang dipakai secara internasional (a.l. reliabilitas, validitas konstruk, dan kontrol bias respons). Ini adalah tes self-report untuk pengembangan diri, bukan alat diagnostik klinis atau pengganti evaluasi psikologis profesional.</p>
  </div>
</section>

<footer>
  <div class="container">
    <div class="foot-grid">
      <div>
        <div class="brand" style="margin-bottom:10px;"><img class="brand-icon" src="<?php echo e(asset('assets/img/logo-icon.png')); ?>" alt="IMT Discovery"> IMT DISCOVERY</div>
        <p style="font-size:13px; color:#aab2cc; max-width:280px; line-height:1.6;">Platform assessment psikometri untuk memahami motivasi, mengambil keputusan lebih baik, dan mengembangkan diri.</p>
      </div>
      <div><h4>Produk</h4><a href="<?php echo e(route('assessment.test')); ?>">Tes Personal</a><a href="team.html">Tes Korporasi</a><a href="#pricing">Harga</a></div>
      <div><h4>Perusahaan</h4><a href="about.html">Tentang Kami</a><a href="https://wa.me/628213107369" target="_blank">Kontak</a><a href="#">Karir</a></div>
      <div><h4>Legal</h4><a href="#">Kebijakan Privasi</a><a href="#">Syarat & Ketentuan</a></div>
    </div>
    <div class="foot-bottom">
      <span>© 2026 IMT Discovery. Seluruh hak cipta dilindungi.</span>
      <span>Dibangun dengan prinsip psikometri & neuroscience UX.</span>
    </div>
  </div>
</footer>

<script src="<?php echo e(asset('assets/data.js')); ?>"></script>
<script>
  const grid = document.getElementById('driver-grid');
  Object.values(IMT_DRIVERS).forEach(d => {
    grid.innerHTML += `<div class="card">
      <div class="driver-chip" style="background:${d.color}">${d.icon}</div>
      <h3>${d.name}</h3>
      <div style="font-size:11px; font-weight:700; letter-spacing:.5px; color:${d.color}; margin:2px 0 8px;">${d.tagline.toUpperCase()}</div>
      <p>${d.pitch}</p>
    </div>`;
  });

  function toggleDropdown() {
    var menu = document.getElementById("userDropdown");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
  }

  // Hamburger Toggle
  const hamburgerBtn = document.getElementById('hamburger-btn');
  const navMenu = document.getElementById('nav-menu');
  hamburgerBtn.addEventListener('click', () => {
    navMenu.classList.toggle('active');
  });

  window.onclick = function(event) {
    if (!event.target.closest('.dropdown')) {
      var dropdowns = document.getElementsByClassName("user-dropdown-menu");
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.style.display === "block") {
          openDropdown.style.display = "none";
        }
      }
    }
  }
</script>
<style>
  /* Mobile Nav Styles */
  .nav-brand-wrapper { display: flex; align-items: center; justify-content: space-between; }
  .hamburger { display: none; background: none; border: none; cursor: pointer; color: var(--navy); }
  .nav-menu { display: flex; align-items: center; gap: 20px; flex: 1; justify-content: flex-end; }
  
  @media (max-width: 820px) {
    .nav-inner { flex-direction: column; align-items: flex-start; padding: 14px 20px; }
    .nav-brand-wrapper { width: 100%; }
    .hamburger { display: block; }
    .nav-menu { 
      display: none; 
      flex-direction: column; 
      width: 100%; 
      align-items: flex-start; 
      margin-top: 20px;
      gap: 16px;
    }
    .nav-menu.active { display: flex; }
    .nav-links { flex-direction: column; width: 100%; gap: 14px; }
    .nav-cta { width: 100%; flex-direction: column; align-items: stretch; }
    .nav-cta .btn { width: 100%; justify-content: center; }
    .hero h1 { font-size: 32px; }
    .hero-ctas { flex-direction: column; }
    .hero-ctas .btn { width: 100%; }
  }
</style>
</body>
</html>
<?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/landing.blade.php ENDPATH**/ ?>