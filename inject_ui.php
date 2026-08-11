<?php
$file = 'resources/views/laporan.blade.php';
$content = file_get_contents($file);

$css = <<<CSS

    /* ---- DQ Section ---- */
    .dq-box {
      background: var(--navy);
      color: #fff;
      border-radius: 8px;
      padding: 24px;
      margin: 20px 30px;
    }
    .dq-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 20px;
    }
    .dq-title {
      color: var(--orange);
      font-size: 14px;
      letter-spacing: 1.5px;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .dq-desc {
      font-size: 12px;
      line-height: 1.6;
      color: #c7cde0;
      max-width: 70%;
      margin-top: 8px;
    }
    .dq-score-block {
      text-align: right;
    }
    .dq-score-block h2 {
      font-size: 36px;
      margin: 0;
      line-height: 1;
    }
    .dq-score-block span {
      color: var(--orange);
      font-size: 10px;
      letter-spacing: 1px;
      font-weight: 700;
    }
    .dq-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 16px;
    }
    .dq-card {
      background: rgba(255, 255, 255, 0.05);
      border-radius: 8px;
      padding: 16px;
      text-align: center;
      display: flex;
      flex-direction: column;
    }
    .dq-card h3 {
      font-size: 24px;
      margin: 0 0 4px;
    }
    .dq-card span {
      font-size: 10px;
      letter-spacing: 1px;
      color: #aab2cc;
      text-transform: uppercase;
    }
    .dq-text {
      font-size: 11px;
      line-height: 1.6;
      color: #dde3f2;
      margin-top: 12px;
      text-align: left;
    }

    /* ---- Sub Composite ---- */
    .sub-composite-box {
      border: 1px solid #e7e9f2;
      border-radius: 8px;
      padding: 20px;
      margin: 0 30px 24px;
      display: flex;
      gap: 16px;
      align-items: center;
      background: var(--card);
    }
    .sub-icon {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: #fdf5eb;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
    }
    .sub-content h4 {
      color: var(--orange);
      font-size: 11px;
      letter-spacing: 1.5px;
      margin: 0 0 4px;
    }
    .sub-content h2 {
      font-size: 18px;
      color: var(--navy);
      margin: 0 0 6px;
    }
    .sub-content p {
      font-size: 13px;
      margin: 0;
      color: var(--text);
    }

    /* ---- Development Path ---- */
    .dev-path-box {
      border: 1px solid #e7e9f2;
      border-radius: 8px;
      margin: 0 30px 24px;
      overflow: hidden;
      background: var(--card);
    }
    .dev-path-header {
      background: var(--navy);
      color: #fff;
      padding: 12px 20px;
      font-size: 13px;
      letter-spacing: 1px;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .dev-path-body {
      padding: 24px;
    }
    .dev-steps {
      display: flex;
      justify-content: space-between;
      position: relative;
      margin-top: 30px;
      margin-bottom: 24px;
    }
    .dev-steps::before {
      content: "";
      position: absolute;
      top: 16px;
      left: 5%;
      right: 5%;
      height: 8px;
      background: linear-gradient(to right, #d1493a, #e8862e, #f2c94c, #5aab52, #2f6fed);
      border-radius: 4px;
      z-index: 1;
    }
    .dev-step {
      z-index: 2;
      text-align: center;
      width: 20%;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .dev-step-icon {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: #fff;
      border: 2px solid #5aab52;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #5aab52;
      font-weight: bold;
      margin-bottom: 8px;
    }
    .dev-step.active .dev-step-icon {
      background: #e8862e;
      border-color: #fce8d5;
      color: #fff;
      box-shadow: 0 0 0 4px #fdf5eb;
    }
    .dev-step span {
      font-size: 11px;
      font-weight: 700;
      color: var(--navy);
    }
    .dev-focus {
      background: #f8f9fd;
      border: 1px solid #eef0f7;
      border-radius: 6px;
      padding: 16px;
      font-size: 12px;
      color: var(--text);
      margin-bottom: 20px;
    }
    .dev-focus b {
      color: var(--navy);
    }
    .dev-formula-box {
      background: #f8f9fd;
      border: 1px solid #eef0f7;
      border-radius: 6px;
      padding: 16px;
      text-align: center;
      margin-bottom: 20px;
    }
    .dev-formula {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      font-size: 12px;
      font-weight: 700;
      flex-wrap: wrap;
    }
    .dev-chip {
      background: #fff;
      border: 1px solid #dfe3ef;
      padding: 8px 16px;
      border-radius: 4px;
      color: var(--navy);
    }
    .dev-chip.final {
      background: var(--navy);
      color: #fff;
      border-color: var(--navy);
    }
    .dev-cards {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }
    .dev-card {
      background: #f8f9fd;
      border: 1px solid #eef0f7;
      border-radius: 6px;
      padding: 16px;
    }
    .dev-card.warning {
      background: #fff8ec;
      border-color: #f2dfb8;
    }
    .dev-card h4 {
      margin: 0 0 8px;
      font-size: 11px;
      letter-spacing: 1px;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .dev-card p {
      margin: 0;
      font-size: 12.5px;
      line-height: 1.6;
    }
CSS;

$htmlDQ = <<<HTML

    <!-- DQ SECTION -->
    <div class="dq-box">
      <div class="dq-header">
        <div>
          <div class="dq-title">⚡ DQ — DRIVER QUOTIENT</div>
          <div class="dq-desc">DQ mengukur seberapa jauh Anda mampu mengenali, memahami, mengelola, mengembangkan, dan mengarahkan driver Anda sendiri — lima kemampuan di bawah ini yang bisa terus tumbuh seiring waktu, bukan angka tetap sejak lahir.</div>
        </div>
        <div class="dq-score-block">
          <h2>{{ round(\$dqScore) }}%</h2>
          <span>DQ SCORE</span>
        </div>
      </div>
      
      <div class="dq-grid">
        <div class="dq-card">
          <h3>{{ round(\$dqScore) }}%</h3>
          <span>AWARENESS</span>
          <div class="dq-text">{{ \$ai_narasi['dq_interpretations']['awareness'] ?? 'Anda memiliki kesadaran yang sangat kuat terhadap apa yang menggerakkan Anda.' }}</div>
        </div>
        <div class="dq-card">
          <h3>{{ round(\$dqScore) }}%</h3>
          <span>INSIGHT</span>
          <div class="dq-text">{{ \$ai_narasi['dq_interpretations']['insight'] ?? 'Anda memiliki pemahaman tajam tentang mengapa Anda bereaksi seperti itu dalam berbagai situasi.' }}</div>
        </div>
        <div class="dq-card">
          <h3>{{ round(\$dqScore) }}%</h3>
          <span>REGULATION</span>
          <div class="dq-text">{{ \$ai_narasi['dq_interpretations']['regulation'] ?? 'Anda cukup terampil menjaga driver Anda tetap bekerja secara sehat, bahkan ketika berada di bawah tekanan.' }}</div>
        </div>
        <div class="dq-card">
          <h3>{{ round(\$dqScore) }}%</h3>
          <span>DEVELOPMENT</span>
          <div class="dq-text">{{ \$ai_narasi['dq_interpretations']['development'] ?? 'Anda secara aktif membangun kebiasaan yang memperkuat sisi positif driver Anda.' }}</div>
        </div>
        <div class="dq-card">
          <h3>{{ round(\$dqScore) }}%</h3>
          <span>TRANSFORMATION</span>
          <div class="dq-text">{{ \$ai_narasi['dq_interpretations']['transformation'] ?? 'Anda menggunakan driver Anda secara sadar untuk menciptakan perubahan bermakna bagi diri Anda dan orang lain.' }}</div>
        </div>
      </div>
    </div>

    <!-- SUB COMPOSITE -->
    <div class="sub-composite-box">
      <div class="sub-icon">🤝</div>
      <div class="sub-content">
        <h4>KUALITAS TERSEMBUNYI ANDA - SUB COMPOSITE</h4>
        <h2>Value Creation</h2>
        <p>Anda lebih tertarik menciptakan sesuatu yang benar-benar terpakai, bukan cuma terlihat bagus.</p>
      </div>
    </div>
HTML;

$htmlDevPath = <<<HTML

    <!-- JALUR PERKEMBANGAN ANDA -->
    <div class="dev-path-box">
      <div class="dev-path-header">
        🧭 JALUR PERKEMBANGAN ANDA — Driver Development Path™
      </div>
      <div class="dev-path-body">
        <p style="font-size:12.5px; color:var(--muted); margin:0 0 16px; line-height:1.6;">
          Bagian ini punya dua lapis. <b>Pertama</b>, seberapa jauh Anda sudah mengenali & mengelola driver Anda secara umum (dihitung dari skor DQ Anda). <b>Kedua</b>, jalur pengembangan yang spesifik untuk driver dominan Anda — <b>{{ strtoupper(\$primaryDriver) }}</b> — lengkap dengan tujuan, pertanyaan refleksi, dan tantangan nyata untuk mulai bertumbuh.
        </p>
        
        <div style="font-size:11px; font-weight:700; color:var(--orange); letter-spacing:1px; margin-top:24px;">TAHAP KESADARAN ANDA SAAT INI <span style="float:right; background:var(--navy); color:#fff; padding:2px 8px; border-radius:4px;">DQ {{ round(\$dqScore) }}</span></div>
        
        <div class="dev-steps">
          <div class="dev-step">
            <div class="dev-step-icon">✓</div>
            <span>Unaware</span>
          </div>
          <div class="dev-step">
            <div class="dev-step-icon">✓</div>
            <span>Aware</span>
          </div>
          <div class="dev-step">
            <div class="dev-step-icon">✓</div>
            <span>Understanding</span>
          </div>
          <div class="dev-step">
            <div class="dev-step-icon">✓</div>
            <span>Managing</span>
          </div>
          <div class="dev-step active">
            <div class="dev-step-icon">🎯</div>
            <span>Transforming</span>
          </div>
        </div>
        
        <div class="dev-focus">
          Fokus pengembangan Anda saat ini: <b>Transformasi dan aktualisasi potensi.</b><br>
          <span style="color:var(--muted); margin-top:4px; display:block;">Driver ini sudah menjadi kekuatan yang Anda pakai secara sadar untuk membangun hidup yang Anda inginkan — bukan lagi sesuatu yang diam-diam mengendalikan Anda.</span>
        </div>
        
        <div style="font-size:11px; font-weight:700; color:var(--orange); letter-spacing:1px; margin-top:30px; margin-bottom:12px; border-bottom:1px solid #eef0f7; padding-bottom:8px;">JALUR PENGEMBANGAN {{ strtoupper(\$primaryDriver) }} ANDA</div>
        
        <div class="dev-focus" style="background:#f8f9fd;">
          Mengembangkan {{ ucfirst(\$primaryDriver) }} bukan berarti harus berlebihan. Tujuannya adalah menciptakan dampak yang benar-benar berkelanjutan, tanpa kehilangan keseimbangan hidup Anda sendiri.
        </div>
        
        <p style="font-size:12px; color:var(--text); margin-bottom:12px;">Tiga hal ini, kalau tumbuh bersamaan, yang membawa Anda ke bentuk tertinggi driver ini:</p>
        
        <div class="dev-formula-box">
          <div class="dev-formula">
            <div class="dev-chip">Purpose</div> + 
            <div class="dev-chip">Healthy Responsibility</div> + 
            <div class="dev-chip">Sustainable Service</div> ➔ 
            <div class="dev-chip final">Sustainable {{ ucfirst(\$primaryDriver) }}™</div>
          </div>
        </div>
        
        <div class="dev-cards">
          <div class="dev-card">
            <h4 style="color:var(--muted);">💭 PERTANYAAN REFLEKSI</h4>
            <p>Apakah Anda bertindak kali ini karena punya ruang untuk itu, atau karena merasa bersalah kalau menolak?</p>
          </div>
          <div class="dev-card warning">
            <h4 style="color:#8a5a12;">🎯 TANTANGAN MINGGU INI</h4>
            <p>Minggu ini, coba tolak satu hal yang sebenarnya di luar kapasitas Anda, dan perhatikan bagaimana rasanya.</p>
          </div>
        </div>
        
      </div>
    </div>
HTML;

if (strpos($content, '.dq-box') === false) {
    // Inject CSS
    $content = str_replace('</style>', $css . "\n  </style>", $content);
    // Inject DQ HTML before bottom-grid
    $content = str_replace('<!-- BOTTOM GRID -->', $htmlDQ . "\n\n    <!-- BOTTOM GRID -->", $content);
    // Inject Dev Path HTML before footer
    $content = str_replace('<!-- FOOTER -->', $htmlDevPath . "\n\n    <!-- FOOTER -->", $content);
    file_put_contents($file, $content);
    echo "Injected missing UI sections!";
} else {
    echo "UI sections already exist.";
}
