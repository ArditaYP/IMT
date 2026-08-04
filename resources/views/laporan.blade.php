<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IMT Discovery™ — Laporan Personal {{ $assessment->participant_name ?? $assessment->name ?? 'Peserta' }}</title>
  <style>
    :root {
      --navy: #0d1b3e;
      --navy2: #14265a;
      --orange: #e8862e;
      --gold: #d99a2b;
      --blue: #2f6fed;
      --green: #3aa65a;
      --purple: #7a5cc7;
      --teal: #1f8a6e;
      --bg: #f4f6fb;
      --card: #ffffff;
      --text: #1c2333;
      --muted: #5b6273;
    }

    * {
      box-sizing: border-box;
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
      color-adjust: exact !important;
    }

    body {
      margin: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
      background: var(--bg);
      color: var(--text);
    }

    .page {
      max-width: 1100px;
      margin: 24px auto;
      background: var(--card);
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
    }

    .top-actions {
      display: flex;
      justify-content: flex-end;
      padding: 16px 30px 0;
    }

    .btn-print {
      background: var(--navy);
      color: #ffffff;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: background 0.2s;
    }

    .btn-print:hover {
      background: var(--navy2);
    }

    .grid-top {
      display: grid;
      grid-template-columns: 280px 1fr;
      gap: 20px;
      padding: 16px 30px 0;
    }

    .logo-block {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 6px;
    }

    .logo-block .star {
      color: var(--orange);
      font-size: 26px;
    }

    .logo-block .brand {
      font-weight: 800;
      letter-spacing: 2px;
      font-size: 20px;
    }

    .logo-sub {
      font-size: 10px;
      color: var(--muted);
      letter-spacing: 1px;
      margin-left: 36px;
    }

    .logo-sub b {
      color: var(--orange);
    }

    .report-title {
      margin-top: 18px;
      font-size: 13px;
      color: var(--muted);
      letter-spacing: 1px;
    }

    .report-title h2 {
      margin: 2px 0 14px;
      color: var(--navy);
      font-size: 18px;
    }

    .profile {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 14px;
    }

    .avatar {
      width: 64px;
      height: 64px;
      border-radius: 50%;
      background: linear-gradient(135deg, #4a8bc7, #1f3d5c);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-weight: 700;
      font-size: 18px;
      flex-shrink: 0;
    }

    .profile .name {
      font-size: 17px;
      font-weight: 700;
      color: var(--navy);
      line-height: 1.2;
    }

    .info-list {
      font-size: 12.5px;
      line-height: 2;
      color: var(--text);
    }

    .info-list div {
      display: flex;
      gap: 8px;
    }

    .info-list span.label {
      width: 110px;
      color: var(--muted);
    }

    .info-list span.val {
      font-weight: 600;
    }

    .about-box {
      background: var(--navy);
      color: #dde3f2;
      border-radius: 8px;
      padding: 16px;
      font-size: 12px;
      line-height: 1.6;
      margin: 16px 0;
    }

    .about-box h3 {
      color: var(--orange);
      font-size: 12.5px;
      margin: 0 0 8px;
      letter-spacing: 1px;
    }

    .about-box blockquote {
      margin: 12px 0 0;
      font-style: italic;
      color: #fff;
      border-left: 3px solid var(--orange);
      padding-left: 10px;
    }

    .right-col {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .row-2 {
      display: grid;
      grid-template-columns: 260px 1fr;
      gap: 16px;
    }

    .archetype-box {
      background: var(--navy);
      color: #fff;
      border-radius: 8px;
      padding: 20px;
    }

    .archetype-box .tag {
      color: var(--orange);
      font-size: 11px;
      letter-spacing: 2px;
      font-weight: 700;
    }

    .archetype-box h2 {
      margin: 6px 0 12px;
      font-size: 18px;
      color: #fff;
      line-height: 1.2;
    }

    .archetype-icon {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: rgba(232, 134, 46, 0.15);
      border: 2px solid var(--orange);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 26px;
      margin-bottom: 14px;
    }

    .archetype-box p {
      font-size: 12px;
      line-height: 1.6;
      color: #c7cde0;
    }

    .radar-box {
      background: var(--card);
      border: 1px solid #e7e9f2;
      border-radius: 8px;
      padding: 16px;
    }

    .radar-box h3 {
      text-align: center;
      color: var(--navy);
      font-size: 14px;
      letter-spacing: 1px;
      margin: 0 0 8px;
    }

    .legend-bands {
      display: flex;
      gap: 0;
      margin-top: 10px;
      border-radius: 6px;
      overflow: hidden;
      font-size: 10px;
      text-align: center;
    }

    .legend-bands div {
      padding: 6px 0;
      color: #fff;
      flex: 1;
    }

    .legend-bands .b1 {
      background: #d1493a;
    }

    .legend-bands .b2 {
      background: #e8862e;
    }

    .legend-bands .b3 {
      background: #5aab52;
    }

    .legend-bands .b4 {
      background: #2f6fed;
    }

    .legend-sub {
      display: flex;
      font-size: 10px;
      color: var(--muted);
      text-align: center;
      margin-top: 2px;
    }

    .legend-sub div {
      flex: 1;
    }

    .apa-artinya {
      background: #f8f9fd;
      border: 1px solid #e7e9f2;
      border-radius: 8px;
      padding: 16px;
    }

    .apa-artinya h3 {
      margin: 0 0 8px;
      color: var(--navy);
      font-size: 13px;
      letter-spacing: 1px;
    }

    .apa-artinya p {
      font-size: 12.5px;
      line-height: 1.7;
      color: var(--text);
      margin: 0;
    }

    .section-navy-header {
      background: var(--navy);
      color: #fff;
      padding: 10px 16px;
      border-radius: 8px 8px 0 0;
      font-size: 13px;
      letter-spacing: 1px;
      font-weight: 700;
    }

    .section-body {
      border: 1px solid #e7e9f2;
      border-top: none;
      border-radius: 0 0 8px 8px;
      padding: 16px;
      background: var(--card);
    }

    .bottom-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      padding: 24px 30px;
    }

    .driver-row {
      display: grid;
      grid-template-columns: 46px 1fr;
      gap: 12px;
      padding: 12px 0;
      border-bottom: 1px solid #eef0f7;
    }

    .driver-row:last-child {
      border-bottom: none;
    }

    .driver-icon {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      color: #fff;
      font-weight: 700;
    }

    .driver-score {
      font-size: 20px;
      font-weight: 800;
      margin-right: 8px;
    }

    .driver-name {
      font-size: 11px;
      letter-spacing: 1px;
      color: var(--muted);
      text-transform: uppercase;
      font-weight: 700;
    }

    .driver-desc {
      font-size: 12px;
      line-height: 1.55;
      color: var(--text);
      margin: 4px 0 8px;
    }

    .tags span {
      display: inline-block;
      font-size: 10px;
      background: #eef1fb;
      color: var(--navy);
      border-radius: 4px;
      padding: 2px 8px;
      margin-right: 4px;
      margin-bottom: 4px;
    }

    .tags .label {
      background: none;
      color: var(--muted);
      padding: 2px 4px 2px 0;
    }

    ul.check-list {
      list-style: none;
      margin: 0 0 14px;
      padding: 0;
    }

    ul.check-list li {
      font-size: 12.5px;
      line-height: 1.6;
      padding: 6px 0 6px 26px;
      position: relative;
    }

    ul.check-list li:before {
      content: "✓";
      position: absolute;
      left: 0;
      top: 6px;
      color: #2fa84f;
      font-weight: 800;
    }

    ul.check-list.growth li:before {
      content: "➤";
      color: var(--orange);
    }

    .insight-box {
      background: #fff8ec;
      border: 1px solid #f2dfb8;
      border-radius: 8px;
      padding: 14px 16px;
      margin-top: 10px;
    }

    .insight-box h4 {
      margin: 0 0 6px;
      color: #8a5a12;
      font-size: 12.5px;
    }

    .insight-box p {
      margin: 0;
      font-size: 12px;
      line-height: 1.6;
      color: #5b4222;
    }

    .action-box {
      background: #f8f9fd;
      border: 1px solid #e7e9f2;
      border-radius: 8px;
      padding: 14px 16px;
      margin-bottom: 14px;
    }

    .action-box h4 {
      margin: 0 0 8px;
      color: var(--navy);
      font-size: 12.5px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .energy-box {
      background: var(--navy);
      color: #fff;
      border-radius: 8px;
      padding: 16px;
    }

    .energy-box h4 {
      color: var(--orange);
      font-size: 12.5px;
      margin: 0 0 8px;
    }

    .energy-box p {
      font-size: 12px;
      line-height: 1.6;
      color: #dde3f2;
      margin: 0;
    }

    .footer {
      background: var(--navy);
      color: #fff;
      display: flex;
      justify-content: space-around;
      align-items: center;
      padding: 16px 20px;
      font-size: 11px;
      text-align: center;
      flex-wrap: wrap;
      gap: 10px;
    }

    .footer .flogo {
      font-weight: 800;
      color: var(--orange);
      font-size: 14px;
      letter-spacing: 1px;
    }

    .footer .fitem {
      max-width: 180px;
    }

    .footer .fitem b {
      display: block;
      margin-bottom: 2px;
    }

    .footer .fitem span {
      color: #aab2cc;
      font-size: 10px;
    }

    /* ---- Driver Dynamix section ---- */
    .section-wrap {
      padding: 0 30px 24px;
    }

    .dynamix-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 12px;
    }

    .dynamix-card {
      border: 1px solid #e7e9f2;
      border-radius: 8px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .dynamix-head {
      padding: 10px 12px;
      color: #fff;
      font-size: 11.5px;
      font-weight: 700;
      letter-spacing: .5px;
    }

    .dynamix-body {
      padding: 12px;
      font-size: 11px;
      line-height: 1.55;
      flex: 1;
    }

    .dynamix-body .state-label {
      font-weight: 700;
      font-size: 10.5px;
      text-transform: uppercase;
      letter-spacing: .5px;
      margin-bottom: 2px;
    }

    .dynamix-body .quote {
      font-style: italic;
      color: var(--muted);
      margin: 0 0 8px;
      font-size: 11px;
    }

    .dynamix-body .healthy {
      color: #1f8a52;
    }

    .dynamix-body .shadow {
      color: #c0392b;
    }

    .dynamix-body .block {
      margin-bottom: 10px;
    }

    .dynamix-body .challenge {
      background: #f8f9fd;
      border-radius: 6px;
      padding: 8px;
      font-size: 10.5px;
      color: var(--navy);
      margin-top: 4px;
    }

    @media (max-width:900px) {
      .dynamix-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    /* ---- Synergy Matrix section ---- */
    .synergy-hero {
      background: linear-gradient(135deg, var(--navy), #1c2f66);
      color: #fff;
      border-radius: 10px;
      padding: 24px;
      margin-bottom: 16px;
    }

    .synergy-hero .tag {
      color: var(--orange);
      font-size: 11px;
      letter-spacing: 2px;
      font-weight: 700;
    }

    .synergy-hero h2 {
      margin: 6px 0 12px;
      font-size: 22px;
    }

    .synergy-hero p {
      font-size: 12.5px;
      line-height: 1.7;
      color: #d3d9ef;
      margin: 0 0 12px;
    }

    .synergy-quote-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
      margin-top: 14px;
    }

    .synergy-quote {
      background: rgba(255, 255, 255, 0.06);
      border-left: 3px solid var(--orange);
      border-radius: 6px;
      padding: 10px 14px;
      font-size: 12px;
      line-height: 1.6;
    }

    .synergy-quote b {
      display: block;
      color: var(--orange);
      font-size: 10.5px;
      letter-spacing: 1px;
      margin-bottom: 4px;
      text-transform: uppercase;
    }

    .synergy-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
    }

    .synergy-panel {
      border: 1px solid #e7e9f2;
      border-radius: 8px;
      padding: 16px;
      background: var(--card);
    }

    .synergy-panel h4 {
      margin: 0 0 10px;
      color: var(--navy);
      font-size: 12.5px;
      letter-spacing: .5px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .synergy-panel ul {
      margin: 0;
      padding: 0 0 0 18px;
      font-size: 12px;
      line-height: 1.6;
    }

    .synergy-panel p {
      font-size: 12px;
      line-height: 1.65;
      margin: 0;
    }

    .strength-item {
      margin-bottom: 6px;
    }

    .strength-item b {
      color: var(--navy);
    }

    .synergy-full-wide {
      grid-column: 1 / -1;
    }

    .key-question-box {
      margin-top: 16px;
      background: #fff8ec;
      border: 1px solid #f2dfb8;
      border-radius: 8px;
      padding: 16px;
      text-align: center;
    }

    .key-question-box b {
      display: block;
      color: #8a5a12;
      font-size: 11px;
      letter-spacing: 1px;
      margin-bottom: 6px;
    }

    .key-question-box p {
      margin: 0;
      font-size: 13.5px;
      font-style: italic;
      color: #5b4222;
    }

    @media screen and (max-width:820px) {
      .grid-top {
        grid-template-columns: 1fr;
      }

      .row-2 {
        grid-template-columns: 1fr;
      }

      .bottom-grid {
        grid-template-columns: 1fr;
      }

      .synergy-grid {
        grid-template-columns: 1fr;
      }

      .synergy-quote-row {
        grid-template-columns: 1fr;
      }
    }

    @page {
      size: auto;
      margin: 10mm;
    }

    @media print {
      html, body {
        background: #f4f6fb !important;
        color: #1c2333 !important;
        margin: 0 !important;
        padding: 0 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
      }

      .page {
        width: 1060px !important;
        max-width: 1060px !important;
        min-width: 1060px !important;
        margin: 0 auto !important;
        padding: 0 !important;
        background: #ffffff !important;
        box-shadow: none !important;
        border-radius: 8px !important;
      }

      .top-actions {
        display: none !important;
      }

      /* Pertahankan Grid Desktop 100% Utuh */
      .grid-top {
        display: grid !important;
        grid-template-columns: 280px 1fr !important;
        gap: 20px !important;
        padding: 24px 30px 0 !important;
      }

      .row-2 {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 16px !important;
      }

      .bottom-grid {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 20px !important;
        padding: 24px 30px !important;
      }

      .driver-row {
        display: grid !important;
        grid-template-columns: 46px 1fr !important;
        gap: 12px !important;
        padding: 12px 0 !important;
      }

      .section-wrap {
        padding: 0 30px 24px !important;
      }

      .dynamix-grid {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 16px !important;
      }

      .synergy-quote-row {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 14px !important;
      }

      .synergy-grid {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 14px !important;
      }

      .footer {
        display: grid !important;
        grid-template-columns: 120px 1fr 1fr 1fr 1fr !important;
        gap: 16px !important;
      }
    }
  </style>
</head>

<body>
  @php
    // Inisial Peserta
    $participantName = $assessment->participant_name ?? $assessment->name ?? 'Peserta';
    $nameParts = preg_split('/\s+/', trim($participantName));
    $initials = '';
    foreach (array_slice($nameParts, 0, 2) as $part) {
        $initials .= strtoupper(substr($part, 0, 1));
    }
    if (empty($initials)) $initials = 'IMT';

    $firstName = $nameParts[0] ?? 'PESERTA';
    $lastName = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : '';

    // Skor 5 Drivers
    $scoreSec = (float) $assessment->security_score;
    $scoreSig = (float) $assessment->significance_score;
    $scoreCon = (float) $assessment->connection_score;
    $scoreGro = (float) $assessment->growth_score;
    $scoreCtr = (float) $assessment->contribution_score;

    // Perhitungan Koordinat Polygon Radar SVG Secara Matematis
    $maxR = 190.0;
    $rSec = ($scoreSec / 100.0) * $maxR;
    $rSig = ($scoreSig / 100.0) * $maxR;
    $rCon = ($scoreCon / 100.0) * $maxR;
    $rGro = ($scoreGro / 100.0) * $maxR;
    $rCtr = ($scoreCtr / 100.0) * $maxR;

    $pSecX = 300.0;
    $pSecY = round(260.0 - $rSec, 1);

    $pSigX = round(300.0 + $rSig * 0.9510565, 1);
    $pSigY = round(260.0 - $rSig * 0.309017, 1);

    $pConX = round(300.0 + $rCon * 0.587785, 1);
    $pConY = round(260.0 + $rCon * 0.809017, 1);

    $pGroX = round(300.0 - $rGro * 0.587785, 1);
    $pGroY = round(260.0 + $rGro * 0.809017, 1);

    $pCtrX = round(300.0 - $rCtr * 0.9510565, 1);
    $pCtrY = round(260.0 - $rCtr * 0.309017, 1);

    $polygonPoints = "{$pSecX},{$pSecY} {$pSigX},{$pSigY} {$pConX},{$pConY} {$pGroX},{$pGroY} {$pCtrX},{$pCtrY}";

    // Data Driver & Sinergi dari Knowledge Base
    $kDrivers = $knowledgeDrivers ?? config('imt_knowledge.drivers', []);
    $arch = $archetypeData ?? config('imt_knowledge.archetypes.Security_Growth');
    $primaryName = $primaryDriver ?? 'Growth';
    $secondaryName = $secondaryDriver ?? 'Security';
    $aiDriversExp = $ai_narasi['drivers_explanation'] ?? [];

    $displayStrengths = !empty($ai_narasi['strengths_in_action']) && is_array($ai_narasi['strengths_in_action'])
      ? $ai_narasi['strengths_in_action']
      : ($arch['strengths'] ?? []);

    $displayBlindspots = !empty($ai_narasi['growth_opportunities']) && is_array($ai_narasi['growth_opportunities'])
      ? $ai_narasi['growth_opportunities']
      : ($arch['blindspots'] ?? []);
  @endphp

  <div class="page">

    <div class="top-actions">
      <button class="btn-print" onclick="window.print()">
        🖨️ Cetak / Simpan PDF
      </button>
    </div>

    <div class="grid-top">
      <!-- LEFT COLUMN -->
      <div>
        <div class="logo-block">
          <span class="star">☆</span>
          <span class="brand">IMT</span>
        </div>
        <div class="logo-sub">INNER MOTIVATION TRANSFORMATION<br><b>DISCOVER YOUR DRIVER</b></div>

        <div class="report-title">
          IMT DISCOVERY™
          <h2>LAPORAN PERSONAL</h2>
        </div>

        <div class="profile">
          <div class="avatar">{{ $initials }}</div>
          <div class="name">{{ strtoupper($firstName) }}<br>{{ strtoupper($lastName) }}</div>
        </div>

        <div class="info-list">
          <div><span class="label">📅 Tanggal Tes</span><span class="val">: {{ $assessment->created_at ? $assessment->created_at->format('d M Y') : date('d M Y') }}</span></div>
          <div><span class="label">🆔 ID Laporan</span><span class="val">: IMT-D-{{ $assessment->created_at ? $assessment->created_at->format('ymd') : date('ymd') }}-{{ str_pad($assessment->id, 3, '0', STR_PAD_LEFT) }}</span></div>
          <div><span class="label">🎯 Instrumen</span><span class="val">: 5 Human Drivers Profiling</span></div>
        </div>

        <div class="about-box">
          <h3>TENTANG IMT DISCOVERY™</h3>
          IMT Discovery membantu Anda memahami apa yang benar-benar mendorong Anda,
          bagaimana Anda mengambil keputusan, dan apa yang memberi energi setiap hari.
          Ini adalah langkah pertama menuju hidup dan memimpin yang lebih jelas, bermakna, dan berdampak.
          <blockquote>Ketika Anda memahami apa yang paling penting bagi Anda, Anda dapat membuat pilihan yang lebih baik
            dan menciptakan kehidupan yang lebih baik.</blockquote>
        </div>
      </div>

      <!-- RIGHT COLUMN -->
      <div class="right-col">
        <div class="section-navy-header" style="border-radius:8px;">YOUR INNER DRIVER, YOUR INNER TRANSFORMATION</div>
        <p style="font-size:12.5px; color:var(--muted); margin:-6px 0 0; line-height:1.6;">
          IMT Discovery mengidentifikasi 5 Human Drivers™ yang menjadi sumber motivasi,
          membentuk keputusan, dan memengaruhi perilaku Anda setiap hari.
        </p>

        <div class="row-2">
          <!-- ARCHETYPE HERO BOX -->
          <div class="archetype-box">
            <div class="tag">ARKETIPE ANDA</div>
            <h2>{{ strtoupper($arch['name'] ?? $assessment->archetype_name) }}</h2>
            <div class="archetype-icon">🧭</div>
            <p>
              {!! nl2br(e($ai_narasi['archetype_box_desc'] ?? ($arch['description'] ?? 'Perpaduan sinergis antara dorongan ' . $primaryName . ' dan ' . $secondaryName . '.'))) !!}
            </p>
          </div>

          <!-- RADAR SVG BOX -->
          <div class="radar-box">
            <h3>PROFIL IMT ANDA</h3>
            <svg viewBox="0 0 600 480" width="100%">
              <!-- Grid Levels -->
              <polygon points="300.0,70.0 480.7,201.3 411.7,413.7 188.3,413.7 119.3,201.3" fill="none" stroke="#dfe3ef"
                stroke-width="1" />
              <polygon points="300.0,117.5 435.5,216.0 383.8,375.3 216.2,375.3 164.5,216.0" fill="none" stroke="#dfe3ef"
                stroke-width="1" />
              <polygon points="300.0,165.0 390.4,230.6 355.8,336.9 244.2,336.9 209.6,230.6" fill="none" stroke="#dfe3ef"
                stroke-width="1" />
              <polygon points="300.0,212.5 345.2,245.3 327.9,298.4 272.1,298.4 254.8,245.3" fill="none" stroke="#dfe3ef"
                stroke-width="1" />
              <line x1="300" y1="260" x2="300" y2="70" stroke="#dfe3ef" />
              <line x1="300" y1="260" x2="480.7" y2="201.3" stroke="#dfe3ef" />
              <line x1="300" y1="260" x2="411.7" y2="413.7" stroke="#dfe3ef" />
              <line x1="300" y1="260" x2="188.3" y2="413.7" stroke="#dfe3ef" />
              <line x1="300" y1="260" x2="119.3" y2="201.3" stroke="#dfe3ef" />

              <!-- Dynamic Filled Radar Polygon -->
              <polygon points="{{ $polygonPoints }}" fill="rgba(47,111,237,0.18)"
                stroke="#2f6fed" stroke-width="2.5" />
              <circle cx="{{ $pSecX }}" cy="{{ $pSecY }}" r="5" fill="#2f6fed" />
              <circle cx="{{ $pSigX }}" cy="{{ $pSigY }}" r="5" fill="#e8862e" />
              <circle cx="{{ $pConX }}" cy="{{ $pConY }}" r="5" fill="#3aa65a" />
              <circle cx="{{ $pGroX }}" cy="{{ $pGroY }}" r="5" fill="#7a5cc7" />
              <circle cx="{{ $pCtrX }}" cy="{{ $pCtrY }}" r="5" fill="#1f8a6e" />

              <!-- Axis Labels & Dynamic Scores -->
              <text x="300" y="35" text-anchor="middle" font-size="13" font-weight="700" fill="#2f6fed">SECURITY</text>
              <text x="300" y="52" text-anchor="middle" font-size="18" font-weight="800" fill="#2f6fed">{{ round($scoreSec) }}</text>

              <text x="530" y="185" text-anchor="middle" font-size="13" font-weight="700"
                fill="#e8862e">SIGNIFICANCE</text>
              <text x="530" y="203" text-anchor="middle" font-size="18" font-weight="800" fill="#e8862e">{{ round($scoreSig) }}</text>

              <text x="445" y="450" text-anchor="middle" font-size="13" font-weight="700"
                fill="#3aa65a">CONNECTION</text>
              <text x="445" y="468" text-anchor="middle" font-size="18" font-weight="800" fill="#3aa65a">{{ round($scoreCon) }}</text>

              <text x="160" y="450" text-anchor="middle" font-size="13" font-weight="700" fill="#7a5cc7">GROWTH</text>
              <text x="160" y="468" text-anchor="middle" font-size="18" font-weight="800" fill="#7a5cc7">{{ round($scoreGro) }}</text>

              <text x="70" y="185" text-anchor="middle" font-size="13" font-weight="700"
                fill="#1f8a6e">CONTRIBUTION</text>
              <text x="70" y="203" text-anchor="middle" font-size="18" font-weight="800" fill="#1f8a6e">{{ round($scoreCtr) }}</text>

              <text x="300" y="264" text-anchor="middle" font-size="14" font-weight="800" fill="var(--navy)">IMT</text>
              <text x="300" y="280" text-anchor="middle" font-size="10" font-weight="700"
                fill="var(--navy)">DISCOVERY™</text>
            </svg>
          </div>
        </div>

        <!-- APA ARTINYA (BERBASIS KNOWLEDGE BASE + AI) -->
        <div class="apa-artinya">
          <h3>APA ARTINYA</h3>
          <p>
            {{ $ai_narasi['apa_artinya'] ?? 'Memuat narasi analisis psikologi...' }}
          </p>
          <div class="legend-bands">
            <div class="b1">0 – 25</div>
            <div class="b2">26 – 50</div>
            <div class="b3">51 – 75</div>
            <div class="b4">76 – 100</div>
          </div>
          <div class="legend-sub">
            <div>Sangat Rendah</div>
            <div>Rendah</div>
            <div>Sedang</div>
            <div>Tinggi</div>
          </div>
        </div>
      </div>
    </div>

    <!-- BOTTOM GRID -->
    <div class="bottom-grid">

      <!-- LEFT: 5 Human Drivers Breakdown (From Word Knowledge Base + AI Personalized Formulation) -->
      <div>
        <div class="section-navy-header">MEMAHAMI 5 HUMAN DRIVERS™ ANDA</div>
        <div class="section-body">

          <!-- 1. Security -->
          @php 
            $secLvl = $driverLevels['security']['level_info'] ?? null; 
            $secLvlNum = $driverLevels['security']['level_number'] ?? 3;
          @endphp
          <div class="driver-row">
            <div class="driver-icon" style="background:#2f6fed;">🛡️</div>
            <div>
              <span class="driver-score" style="color:#2f6fed;">{{ round($scoreSec) }}</span>
              <span class="driver-name">SECURITY — {{ $secLvl['name'] ?? 'The Balancer™' }} (Level {{ $secLvlNum }})</span>
              <p class="driver-desc">
                {{ $aiDriversExp['security'] ?? ($secLvl['desc'] ?? ($kDrivers['security']['description'] ?? '')) }}
              </p>
              <div class="tags">
                <span class="label">Karakter</span>
                @foreach(array_slice($kDrivers['security']['positive_traits'] ?? ['Konsisten', 'Rasional', 'Terstruktur'], 0, 3) as $trait)
                  <span>{{ $trait }}</span>
                @endforeach
              </div>
            </div>
          </div>

          <!-- 2. Significance -->
          @php 
            $sigLvl = $driverLevels['significance']['level_info'] ?? null; 
            $sigLvlNum = $driverLevels['significance']['level_number'] ?? 3;
          @endphp
          <div class="driver-row">
            <div class="driver-icon" style="background:#e8862e;">🏅</div>
            <div>
              <span class="driver-score" style="color:#e8862e;">{{ round($scoreSig) }}</span>
              <span class="driver-name">SIGNIFICANCE — {{ $sigLvl['name'] ?? 'The Builder™' }} (Level {{ $sigLvlNum }})</span>
              <p class="driver-desc">
                {{ $aiDriversExp['significance'] ?? ($sigLvl['desc'] ?? ($kDrivers['significance']['description'] ?? '')) }}
              </p>
              <div class="tags">
                <span class="label">Karakter</span>
                @foreach(array_slice($kDrivers['significance']['positive_traits'] ?? ['Ambisi Sehat', 'Standar Tinggi', 'Fokus Hasil'], 0, 3) as $trait)
                  <span>{{ $trait }}</span>
                @endforeach
              </div>
            </div>
          </div>

          <!-- 3. Connection -->
          @php 
            $conLvl = $driverLevels['connection']['level_info'] ?? null; 
            $conLvlNum = $driverLevels['connection']['level_number'] ?? 3;
          @endphp
          <div class="driver-row">
            <div class="driver-icon" style="background:#3aa65a;">💚</div>
            <div>
              <span class="driver-score" style="color:#3aa65a;">{{ round($scoreCon) }}</span>
              <span class="driver-name">CONNECTION — {{ $conLvl['name'] ?? 'The Relationship Builder™' }} (Level {{ $conLvlNum }})</span>
              <p class="driver-desc">
                {{ $aiDriversExp['connection'] ?? ($conLvl['desc'] ?? ($kDrivers['connection']['description'] ?? '')) }}
              </p>
              <div class="tags">
                <span class="label">Karakter</span>
                @foreach(array_slice($kDrivers['connection']['positive_traits'] ?? ['Empatik', 'Dapat Dipercaya', 'Kolaboratif'], 0, 3) as $trait)
                  <span>{{ $trait }}</span>
                @endforeach
              </div>
            </div>
          </div>

          <!-- 4. Growth -->
          @php 
            $groLvl = $driverLevels['growth']['level_info'] ?? null; 
            $groLvlNum = $driverLevels['growth']['level_number'] ?? 3;
          @endphp
          <div class="driver-row">
            <div class="driver-icon" style="background:#7a5cc7;">🌱</div>
            <div>
              <span class="driver-score" style="color:#7a5cc7;">{{ round($scoreGro) }}</span>
              <span class="driver-name">GROWTH — {{ $groLvl['name'] ?? 'The Learner™' }} (Level {{ $groLvlNum }})</span>
              <p class="driver-desc">
                {{ $aiDriversExp['growth'] ?? ($groLvl['desc'] ?? ($kDrivers['growth']['description'] ?? '')) }}
              </p>
              <div class="tags">
                <span class="label">Karakter</span>
                @foreach(array_slice($kDrivers['growth']['positive_traits'] ?? ['Inovatif', 'Cepat Belajar', 'Adaptif'], 0, 3) as $trait)
                  <span>{{ $trait }}</span>
                @endforeach
              </div>
            </div>
          </div>

          <!-- 5. Contribution -->
          @php 
            $ctrLvl = $driverLevels['contribution']['level_info'] ?? null; 
            $ctrLvlNum = $driverLevels['contribution']['level_number'] ?? 3;
          @endphp
          <div class="driver-row">
            <div class="driver-icon" style="background:#1f8a6e;">🤝</div>
            <div>
              <span class="driver-score" style="color:#1f8a6e;">{{ round($scoreCtr) }}</span>
              <span class="driver-name">CONTRIBUTION — {{ $ctrLvl['name'] ?? 'The Balanced Giver™' }} (Level {{ $ctrLvlNum }})</span>
              <p class="driver-desc">
                {{ $aiDriversExp['contribution'] ?? ($ctrLvl['desc'] ?? ($kDrivers['contribution']['description'] ?? '')) }}
              </p>
              <div class="tags">
                <span class="label">Karakter</span>
                @foreach(array_slice($kDrivers['contribution']['positive_traits'] ?? ['Tanggung Jawab', 'Peduli Sesama', 'Tulus Melayani'], 0, 3) as $trait)
                  <span>{{ $trait }}</span>
                @endforeach
              </div>
            </div>
          </div>

        </div>

        <!-- WAWASAN UTAMA BOX -->
        <div class="insight-box">
          <h4>💡 WAWASAN UTAMA</h4>
          <p>{{ $ai_narasi['wawasan_utama'] ?? ($arch['growth_path'] ?? 'Memuat wawasan pengembangan diri...') }}</p>
        </div>
      </div>

      <!-- RIGHT: Strengths / Growth / Actions / Energy (From Word Knowledge Base + AI Formulation) -->
      <div>
        <div class="section-navy-header">KEKUATAN ANDA DALAM TINDAKAN</div>
        <div class="section-body">
          <ul class="check-list">
            @if(!empty($displayStrengths))
              @foreach(array_slice($displayStrengths, 0, 4) as $str)
                <li><b>{{ $str['title'] ?? '' }}</b> — {{ $str['desc'] ?? '' }}</li>
              @endforeach
            @else
              <li>Mencari cara untuk menjadi lebih baik secara berkelanjutan (Continuous Improvement™).</li>
              <li>Mampu beradaptasi terhadap perubahan tanpa kehilangan arah (Calculated Adaptability™).</li>
            @endif
          </ul>

          <h4 style="color:var(--navy); font-size:12.5px; margin:14px 0 6px;">PELUANG UNTUK BERTUMBUH (BLIND SPOTS)</h4>
          <ul class="check-list growth">
            @if(!empty($displayBlindspots))
              @foreach(array_slice($displayBlindspots, 0, 4) as $bsp)
                <li><b>{{ $bsp['title'] ?? '' }}</b> — {{ $bsp['desc'] ?? '' }}</li>
              @endforeach
            @else
              <li>Waspadai kecenderungan terlalu banyak berpikir sebelum bertindak (Analysis Paralysis™).</li>
              <li>Sesekali beri ruang untuk spontanitas dalam menghadapi peluang baru.</li>
            @endif
          </ul>
        </div>

        <div class="action-box" style="margin-top:16px;">
          <h4>🎯 APA YANG MENDORONG ANDA (WHAT DRIVES YOU)</h4>
          <ul class="check-list">
            @if(!empty($arch['what_drives']))
              @foreach($arch['what_drives'] as $wd)
                <li>{{ $wd }}</li>
              @endforeach
            @else
              <li>Memiliki kesempatan belajar hal baru</li>
              <li>Melihat kemajuan nyata dan terukur dalam hidup</li>
            @endif
          </ul>
        </div>

        <div class="energy-box">
          <h4>⚡ ENERGI ANDA MENURUN KETIKA (WHAT DRAINS YOU)...</h4>
          <p>
            @if(!empty($arch['what_drains']))
              {{ implode(', ', $arch['what_drains']) }}.
            @else
              Terjebak dalam rutinitas yang monoton atau dipaksa berubah tanpa persiapan yang cukup.
            @endif
          </p>
        </div>
      </div>

    </div>

    <!-- ================= DRIVER DYNAMIX SECTION (From Word Knowledge Base) ================= -->
    <div class="section-wrap">
      <div class="section-navy-header">DRIVER DYNAMIX™ — HEALTHY STATE VS SHADOW STATE</div>
      <div class="section-body">
        <p style="font-size:12px; color:var(--muted); margin:0 0 12px; line-height:1.6;">
          Setiap Human Driver™ memiliki dua sisi: kondisi sehat (Healthy State™) ketika driver
          bekerja secara seimbang, dan kondisi bayangan (Shadow State™) ketika driver tersebut
          terlalu ditekan atau dipaksakan. Memahami kedua sisi ini membantu Anda mengenali kapan
          motivasi Anda sedang bekerja untuk Anda, dan kapan mulai bekerja melawan Anda.
        </p>
        @if(!empty($ai_narasi['dynamix_reflection']))
          <div style="background:rgba(47,111,237,0.06); border-left:3px solid var(--navy); border-radius:6px; padding:10px 14px; font-size:12px; line-height:1.6; color:var(--text); margin-bottom:14px;">
            <b style="color:var(--navy); display:block; margin-bottom:3px; font-size:11px; letter-spacing:0.5px;">🔍 REFLEKSI DINAMIKA PERSONAL ANDA:</b>
            {{ $ai_narasi['dynamix_reflection'] }}
          </div>
        @endif
        <div class="dynamix-grid">

          @foreach(['security', 'significance', 'connection', 'growth', 'contribution'] as $dKey)
            @php $dData = $kDrivers[$dKey] ?? []; @endphp
            <div class="dynamix-card">
              <div class="dynamix-head" style="background: {{ $dData['color'] ?? '#2f6fed' }};">
                {{ strtoupper($dData['name'] ?? $dKey) }}™<br>
                <span style="font-weight:400; font-size:10px;">{{ $dData['tagline'] ?? 'Human Driver™' }}</span>
              </div>
              <div class="dynamix-body">
                <div class="block">
                  <div class="state-label healthy">✔ Healthy State™</div>
                  <p class="quote">"{{ $dData['healthy_state']['quote'] ?? '' }}"</p>
                  {{ $dData['healthy_state']['desc'] ?? '' }}
                </div>
                <div class="block">
                  <div class="state-label shadow">⚠ Shadow State™</div>
                  <p class="quote">"{{ $dData['shadow_state']['quote'] ?? '' }}"</p>
                  {{ $dData['shadow_state']['desc'] ?? '' }}
                </div>
                <div class="challenge">
                  <b>Core Challenge:</b> {{ $dData['core_challenge'] ?? '' }}
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </div>
    </div>

    <!-- ================= SYNERGY MATRIX SECTION (From Word Knowledge Base) ================= -->
    <div class="section-wrap">
      <div class="section-navy-header">SYNERGY MATRIX™ — {{ strtoupper($arch['combination'] ?? ($primaryName . ' + ' . $secondaryName)) }}</div>
      <div class="section-body">

        <div class="synergy-hero">
          <div class="tag">DUAL DOMINANT DRIVERS</div>
          <h2>{{ $arch['name'] ?? $assessment->archetype_name }}</h2>
          <p>
            {{ $arch['description'] ?? '' }}
          </p>
          <div class="synergy-quote-row">
            <div class="synergy-quote">
              <b>Core Desire</b>
              "{{ $arch['core_desire'] ?? 'Saya ingin terus berkembang dan berinovasi tanpa kehilangan stabilitas yang telah dibangun.' }}"
            </div>
            <div class="synergy-quote">
              <b>Core Fear</b>
              "{{ $arch['core_fear'] ?? 'Terjebak dalam stagnasi atau mengambil langkah yang terlalu berisiko.' }}"
            </div>
          </div>
        </div>

        <div class="synergy-grid">

          <!-- Natural Strengths -->
          <div class="synergy-panel">
            <h4>💪 NATURAL STRENGTHS</h4>
            @if(!empty($arch['strengths']))
              @foreach($arch['strengths'] as $st)
                <div class="strength-item"><b>{{ $st['title'] }}</b> — {{ $st['desc'] }}</div>
              @endforeach
            @endif
          </div>

          <!-- Blind Spots -->
          <div class="synergy-panel">
            <h4>🕳️ BLIND SPOTS</h4>
            @if(!empty($arch['blindspots']))
              @foreach($arch['blindspots'] as $bs)
                <div class="strength-item"><b>{{ $bs['title'] }}</b> — {{ $bs['desc'] }}</div>
              @endforeach
            @endif
          </div>

          <!-- What Drives Them -->
          <div class="synergy-panel">
            <h4>⚡ WHAT DRIVES THEM</h4>
            <ul>
              @if(!empty($arch['what_drives']))
                @foreach($arch['what_drives'] as $item)
                  <li>{{ $item }}</li>
                @endforeach
              @endif
            </ul>
          </div>

          <!-- What Drains Them -->
          <div class="synergy-panel">
            <h4>🪫 WHAT DRAINS THEM</h4>
            <ul>
              @if(!empty($arch['what_drains']))
                @foreach($arch['what_drains'] as $item)
                  <li>{{ $item }}</li>
                @endforeach
              @endif
            </ul>
          </div>

          <!-- Leadership Style -->
          <div class="synergy-panel">
            <h4>🧭 LEADERSHIP STYLE™ — {{ $arch['leadership_style']['title'] ?? 'The Progressive Stabilizer™' }}</h4>
            <p>{{ $arch['leadership_style']['desc'] ?? '' }}</p>
          </div>

          <!-- Communication Style -->
          <div class="synergy-panel">
            <h4>💬 COMMUNICATION STYLE™ — {{ $arch['communication_style']['title'] ?? 'Thoughtful & Structured' }}</h4>
            <p>{{ $arch['communication_style']['desc'] ?? '' }}</p>
          </div>

          <!-- Growth Path -->
          <div class="synergy-panel synergy-full-wide">
            <h4>🌱 GROWTH PATH™</h4>
            <p>{{ $arch['growth_path'] ?? '' }}</p>
          </div>

          <!-- Synergy Summary -->
          <div class="synergy-panel synergy-full-wide">
            <h4>📌 SYNERGY SUMMARY™</h4>
            <p>{{ $arch['synergy_summary'] ?? $arch['description'] ?? '' }}</p>
          </div>

        </div>

        <!-- Key Question -->
        <div class="key-question-box">
          <b>KEY QUESTION™</b>
          <p>"{{ $arch['key_question'] ?? 'Apakah saya sedang mempersiapkan diri untuk berkembang, atau menggunakan persiapan sebagai alasan untuk tidak bergerak?' }}"</p>
        </div>

      </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
      <div class="flogo">☆ IMT</div>
      <div class="fitem"><b>🔬 BERBASIS SAINS</b><span>Dibangun berdasarkan penelitian psikometri modern dan prinsip ilmiah.</span></div>
      <div class="fitem"><b>🎯 AKURAT &amp; TERPERCAYA</b><span>Model psikometri dengan standar yang tinggi.</span></div>
      <div class="fitem"><b>💬 MUDAH DIPAHAMI</b><span>Bahasa sederhana, wawasan bermakna.</span></div>
      <div class="fitem"><b>📈 WAWASAN YANG DAPAT DITINDAKLANJUTI</b><span>Panduan praktis untuk perbaikan nyata.</span></div>
    </div>

  </div>
</body>

</html>
