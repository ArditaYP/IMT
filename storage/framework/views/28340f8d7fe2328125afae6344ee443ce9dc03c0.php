<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Laporan Tim: IMT Discovery™</title>
<meta name="robots" content="noindex">
<link rel="icon" type="image/png" href="<?php echo e(asset('assets/img/favicon.png')); ?>">
<link rel="apple-touch-icon" href="<?php echo e(asset('assets/img/apple-touch-icon.png')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/style.css')); ?>">
<style>
  body{background:var(--bg);}
  .page{max-width:1100px; margin:24px auto; background:var(--card); border-radius:10px; overflow:hidden; box-shadow:0 4px 24px rgba(0,0,0,0.08);}
  .topbar{background:var(--navy); color:#fff; padding:18px 30px; display:flex; justify-content:space-between; align-items:center;}
  .topbar h1{margin:0; font-size:20px; letter-spacing:1px; color:var(--orange);}
  .grid-top{display:grid; grid-template-columns:280px 1fr; gap:20px; padding:24px 30px 0;}
  .logo-block{display:flex; align-items:center; gap:10px; margin-bottom:6px;}
  .logo-block .star{color:var(--orange); font-size:26px;}
  .logo-block .brand{font-weight:800; letter-spacing:2px; font-size:20px;}
  .logo-sub{font-size:10px; color:var(--muted); letter-spacing:1px; margin-left:36px;}
  .logo-sub b{color:var(--orange);}
  .report-title{margin-top:18px; font-size:13px; color:var(--muted); letter-spacing:1px;}
  .report-title h2{margin:2px 0 14px; color:var(--navy); font-size:18px;}
  .profile{display:flex; align-items:center; gap:14px; margin-bottom:14px;}
  .avatar{width:64px; height:64px; border-radius:14px; background:linear-gradient(135deg,#2f6fed,#0d1b3e); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:18px; flex-shrink:0;}
  .profile .name{font-size:18px; font-weight:700; color:var(--navy); line-height:1.2;}
  .info-list{font-size:12.5px; line-height:2; color:var(--text);}
  .info-list div{display:flex; gap:8px;}
  .info-list span.label{width:110px; color:var(--muted);}
  .info-list span.val{font-weight:600;}
  .about-box{background:var(--navy); color:#dde3f2; border-radius:8px; padding:16px; font-size:12px; line-height:1.6; margin:16px 0;}
  .about-box h3{color:var(--orange); font-size:12.5px; margin:0 0 8px; letter-spacing:1px;}
  .right-col{display:flex; flex-direction:column; gap:16px;}
  .row-2{display:grid; grid-template-columns:260px 1fr; gap:16px;}
  .archetype-box{background:var(--navy); color:#fff; border-radius:8px; padding:20px;}
  .archetype-box .tag{color:var(--orange); font-size:11px; letter-spacing:2px; font-weight:700;}
  .archetype-box h2{margin:6px 0 12px; font-size:20px; color:#fff;}
  .archetype-icon{width:56px; height:56px; border-radius:50%; background:rgba(232,134,46,0.15); border:2px solid var(--orange); display:flex; align-items:center; justify-content:center; font-size:26px; margin-bottom:14px; font-weight:800; color:#fff;}
  .archetype-box p{font-size:12px; line-height:1.6; color:#c7cde0; margin:0 0 10px;}
  .archetype-box .arch-divider{height:1px; background:rgba(255,255,255,.12); margin:12px 0;}
  .archetype-box .arch-label{font-size:9.5px; letter-spacing:1px; color:var(--orange); font-weight:700; margin:0 0 4px;}
  .archetype-box .arch-key-q{display:flex; gap:8px; align-items:flex-start; margin-top:14px; padding-top:12px; border-top:1px solid rgba(255,255,255,.12);}
  .archetype-box .arch-key-q span{flex-shrink:0; width:18px; height:18px; border-radius:50%; background:var(--orange); color:#0d1b3e; font-size:11px; font-weight:800; display:flex; align-items:center; justify-content:center;}
  .archetype-box .arch-key-q p{margin:0; font-size:11.5px; font-style:italic; color:#fff;}
  .right-stack{display:flex; flex-direction:column; gap:14px; min-height:100%;}
  .radar-box{background:var(--card); border:1px solid #e7e9f2; border-radius:8px; padding:16px; display:flex; flex-direction:column;}
  .radar-box svg{flex:1;}
  .radar-box h3{text-align:center; color:var(--navy); font-size:14px; letter-spacing:1px; margin:0 0 8px;}
  .apa-artinya{background:#f8f9fd; border:1px solid #e7e9f2; border-radius:8px; padding:16px;}
  .apa-artinya h3{margin:0 0 8px; color:var(--navy); font-size:13px; letter-spacing:1px;}
  .apa-artinya p{font-size:12.5px; line-height:1.7; color:var(--text); margin:0;}
  .section-navy-header{background:var(--navy); color:#fff; padding:10px 16px; border-radius:8px 8px 0 0; font-size:13px; letter-spacing:1px; font-weight:700;}
  .section-body{border:1px solid #e7e9f2; border-top:none; border-radius:0 0 8px 8px; padding:16px; background:var(--card);}
  .bottom-grid{display:grid; grid-template-columns:1fr 1fr; gap:20px; padding:24px 30px;}
  .driver-row{display:grid; grid-template-columns:46px 1fr; gap:12px; padding:12px 0; border-bottom:1px solid #eef0f7;}
  .driver-row:last-child{border-bottom:none;}
  .driver-icon{width:42px; height:42px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:18px; color:#fff; font-weight:700;}
  .driver-score{font-size:20px; font-weight:800; margin-right:8px;}
  .driver-name{font-size:11px; letter-spacing:1px; color:var(--muted); text-transform:uppercase;}
  .driver-desc{font-size:12px; line-height:1.5; color:var(--text); margin:4px 0 8px;}
  .tags span{display:inline-block; font-size:10px; background:#eef1fb; color:var(--navy); border-radius:4px; padding:2px 8px; margin-right:4px; margin-bottom:4px;}
  .tags .label{background:none; color:var(--muted); padding:2px 4px 2px 0;}
  ul.check-list{list-style:none; margin:0 0 14px; padding:0;}
  ul.check-list li{font-size:12.5px; line-height:1.6; padding:6px 0 6px 22px; position:relative;}
  ul.check-list li:before{content:"•"; position:absolute; left:4px; top:6px; color:#2fa84f; font-weight:800;}
  ul.check-list.growth li:before{color:var(--orange);}
  .action-box{background:#f8f9fd; border:1px solid #e7e9f2; border-radius:8px; padding:14px 16px; margin-bottom:14px;}
  .action-box h4{margin:0 0 8px; color:var(--navy); font-size:12.5px;}
  .energy-box{background:var(--navy); color:#fff; border-radius:8px; padding:16px;}
  .energy-box h4{color:var(--orange); font-size:12.5px; margin:0 0 8px;}
  .energy-box p{font-size:12px; line-height:1.6; color:#dde3f2; margin:0;}
  .di-box{margin:0 30px 24px; background:linear-gradient(135deg,#14265a,#0d1b3e); color:#fff; border-radius:12px; padding:22px 26px;}
  .di-box h3{color:var(--orange); font-size:13px; letter-spacing:1px; margin:0 0 12px;}
  .di-grid{display:grid; grid-template-columns:repeat(5,1fr); gap:14px;}
  .di-item{background:rgba(255,255,255,.06); border-radius:8px; padding:12px; text-align:center;}
  .di-item .n{font-size:20px; font-weight:800; color:#fff;}
  .di-item .l{font-size:10px; color:#aab2cc; letter-spacing:.5px; margin-top:4px;}
  
  .range-chart{padding:4px 2px 8px;}
  .range-row{margin-bottom:15px;}
  .range-row .rr-head{display:flex; justify-content:space-between; align-items:baseline; margin-bottom:5px;}
  .range-row .rr-name{font-size:11.5px; font-weight:800; letter-spacing:.5px;}
  .range-row .rr-avg{font-size:15px; font-weight:800; color:var(--navy);}
  .range-track{position:relative; height:14px; border-radius:7px; background:#eef1fb;}
  .range-fill{position:absolute; top:0; height:100%; border-radius:7px; opacity:.32;}
  .range-marker{position:absolute; top:-3px; width:4px; height:20px; border-radius:2px; background:var(--navy); transform:translateX(-2px);}
  .range-minmax{display:flex; justify-content:space-between; font-size:9px; color:var(--muted); margin-top:3px;}
  .range-legend{font-size:9.5px; color:var(--muted); margin-top:6px; line-height:1.5;}
  .range-legend b{color:var(--navy);}

  .team-comp{margin-top:14px;}
  .team-comp-row{display:grid; grid-template-columns:112px 1fr 74px; gap:10px; align-items:center; margin-bottom:8px;}
  .team-comp-row .tc-label{font-size:10.5px; font-weight:700; color:var(--navy);}
  .team-comp-track{position:relative; height:10px; border-radius:5px; background:#eef1fb;}
  .team-comp-fill{position:absolute; top:0; left:0; height:100%; border-radius:5px;}
  .team-comp-row .tc-val{font-size:10.5px; color:var(--muted); text-align:right;}

  .sc-highlight-grid{display:grid; grid-template-columns:1fr 1fr; gap:20px; padding:0 30px 24px;}
  .sc-highlight-card{border:1px solid #e7e9f2; border-radius:10px; overflow:hidden;}
  .sc-highlight-card .hdr{padding:10px 16px; font-weight:800; font-size:12px; letter-spacing:.5px; color:#fff;}
  .sc-highlight-card.strength .hdr{background:#2fa84f;}
  .sc-highlight-card.watch .hdr{background:#c0392b;}
  .sc-highlight-row{padding:12px 16px; border-top:1px solid #f1f2f8; background:#fff;}
  .sc-highlight-row .sc-row-head{display:flex; justify-content:space-between; align-items:baseline; margin-bottom:6px;}
  .sc-highlight-row .nm{font-weight:700; color:var(--navy); font-size:12.5px; display:block;}
  .sc-highlight-row .dr{font-size:10px; color:var(--muted); display:block; margin-top:1px; font-weight:400;}
  .sc-highlight-row .sc{font-weight:800; color:var(--navy); font-size:15px;}
  .sc-bar-track{position:relative; height:9px; border-radius:5px; background:#eef1fb;}
  .sc-bar-fill{position:absolute; top:0; left:0; height:100%; border-radius:5px;}
  .sc-bar-minmax{display:flex; justify-content:space-between; font-size:8.5px; color:var(--muted); margin-top:3px;}

  .dyn-section{margin:0 30px 24px;}
  .dyn-cards{display:grid; grid-template-columns:repeat(5,1fr); gap:12px;}
  .dyn-card{border-radius:10px; padding:14px; border:1px solid #e7e9f2;}
  .dyn-card.healthy{background:#f1faf3; border-color:#cdeed6;}
  .dyn-card.activated{background:#eef4fd; border-color:#c9ddf7;}
  .dyn-card.stress{background:#fdf2f1; border-color:#f5d3cf;}
  .dyn-card.shadow{background:#f3eef7; border-color:#ddc9ec;}
  .dyn-card.growth{background:#fff8ec; border-color:#f2dfb8;}
  .dyn-card h4{margin:0 0 4px; font-size:11px; letter-spacing:.5px;}
  .dyn-card.healthy h4{color:#1a8a4f;}
  .dyn-card.activated h4{color:#2f6fed;}
  .dyn-card.stress h4{color:#c0392b;}
  .dyn-card.shadow h4{color:#6b3fa0;}
  .dyn-card.growth h4{color:#8a5a12;}
  .dyn-card .desc{font-size:10.5px; color:var(--muted); margin-bottom:6px; line-height:1.4;}
  .dyn-card .trigger{font-size:10px; color:var(--muted); margin-bottom:6px; line-height:1.4;}
  .dyn-card ul{list-style:none; margin:0; padding:0;}
  .dyn-card li{font-size:10.8px; line-height:1.55; padding:3px 0 3px 14px; position:relative; color:var(--text);}
  .dyn-card li:before{content:"•"; position:absolute; left:0;}
  .challenge-box{margin-top:16px; background:linear-gradient(135deg,#14265a,#0d1b3e); color:#fff; border-radius:10px; padding:20px 22px;}
  .challenge-box .ctag{color:var(--orange); font-size:10px; letter-spacing:1.5px; font-weight:700; margin-bottom:6px;}
  .challenge-box h4{margin:0 0 10px; font-size:16px; color:#fff;}
  .challenge-box .lesson{font-size:13px; font-style:italic; color:#dde3f2; margin:0 0 14px; line-height:1.6; border-left:3px solid var(--orange); padding-left:12px;}

  .path-section{margin:0 30px 24px;}
  .stage-gauge{margin:22px 0 18px;}
  .stage-bar-track{position:relative; height:12px; border-radius:7px; margin:0 8px 40px; background:linear-gradient(90deg,#e2a19a 0%,#e2a19a 20%,#f2c799 20%,#f2c799 40%,#f5dd9a 40%,#f5dd9a 60%,#b7dcb0 60%,#b7dcb0 80%,#a9c3f5 80%,#a9c3f5 100%);}
  .stage-bar-fill{position:absolute; top:0; left:0; height:100%; border-radius:7px; background:var(--navy); opacity:.14;}
  .stage-pin{position:absolute; top:-32px; transform:translateX(-50%); background:var(--navy); color:#fff; font-size:11px; font-weight:800; padding:4px 10px; border-radius:6px; white-space:nowrap; box-shadow:0 2px 6px rgba(13,27,62,.25);}
  .stage-pin:after{content:""; position:absolute; bottom:-5px; left:50%; transform:translateX(-50%); border:5px solid transparent; border-top-color:var(--navy);}
  .stage-points{display:flex; justify-content:space-between; margin:0 -6px;}
  .stage-point{flex:1; text-align:center; padding:0 4px;}
  .stage-point .dot{width:26px; height:26px; line-height:26px; border-radius:50%; background:#eef1fb; color:var(--muted); font-size:11px; font-weight:800; margin:0 auto 6px; border:2px solid #fff; box-shadow:0 0 0 1px #dfe3ef;}
  .stage-point.done .dot{background:var(--green); color:#fff; box-shadow:0 0 0 1px var(--green);}
  .stage-point.current .dot{background:var(--orange); color:#fff; width:32px; height:32px; line-height:32px; font-size:13px; box-shadow:0 0 0 5px rgba(232,134,46,.18);}
  .stage-point .lbl{font-size:10.5px; font-weight:700; color:var(--muted);}
  .stage-point.done .lbl{color:#1a8a4f;}
  .stage-point.current .lbl{color:var(--navy);}
  .path-current-box{margin-top:16px; background:#f8f9fd; border:1px solid #e7e9f2; border-radius:8px; padding:14px 16px;}
  .path-current-box .focus{font-size:12px; color:var(--muted);}

  .validity-note{margin:0 30px 24px; background:#fff8ec; border:1px solid #f2dfb8; border-radius:8px; padding:14px 16px; font-size:12px; color:#5b4222; line-height:1.6;}
  .validity-note h4{margin:0 0 6px; font-size:12.5px; color:#8a5a12;}

  .training-section{margin:0 30px 24px;}
  .training-item{display:flex; gap:14px; padding:16px 0; border-bottom:1px solid #eef0f7;}
  .training-item:last-child{border-bottom:none;}
  .training-num{flex-shrink:0; width:30px; height:30px; border-radius:50%; background:var(--navy); color:#fff; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:13px;}
  .training-item .cat{font-size:9.5px; letter-spacing:1px; font-weight:700; color:var(--orange); text-transform:uppercase; margin-bottom:3px;}
  .training-item h5{margin:0 0 4px; font-size:13.5px; color:var(--navy); line-height:1.35;}
  .training-item p{margin:0; font-size:12px; line-height:1.6; color:var(--text);}
  .training-item .basis{font-size:10.5px; color:var(--orange); font-weight:700; margin-top:6px;}

  .foot{background:var(--navy); color:#fff; display:flex; justify-content:space-around; align-items:center; padding:16px 20px; font-size:11px; text-align:center; flex-wrap:wrap; gap:10px;}
  .foot .flogo{font-weight:800; color:var(--orange); font-size:14px; letter-spacing:1px;}
  .foot .fitem{max-width:180px;}
  .foot .fitem b{display:block; margin-bottom:2px;}
  .foot .fitem span{color:#aab2cc; font-size:10px;}
  @media (max-width:980px){.dyn-cards{grid-template-columns:repeat(3,1fr);}}
  @media (max-width:820px){.grid-top{grid-template-columns:1fr;} .row-2{grid-template-columns:1fr;} .bottom-grid{grid-template-columns:1fr;} .di-grid{grid-template-columns:repeat(2,1fr);} .dyn-cards{grid-template-columns:1fr;} .sc-highlight-grid{grid-template-columns:1fr;}}
</style>
</head>
<body>

<div class="no-print" style="max-width:1100px; margin:16px auto 0; padding:0 24px; display:flex; justify-content:space-between; align-items:center;">
  <a href="<?php echo e(route('admin.groups')); ?>" class="btn btn-ghost btn-sm">← Kembali ke Dashboard</a>
  <div style="display:flex; gap:10px;">
    <button class="btn btn-dark btn-sm" onclick="window.print()">Unduh sebagai PDF</button>
  </div>
</div>

<div class="page">

  <div class="grid-top">
    <div>
      <img src="<?php echo e(asset('assets/img/logo-icon.png')); ?>" alt="IMT Discovery" style="height:44px; margin-bottom:4px;">
      <div class="logo-sub">INNER MOTIVATION TRANSFORMATION<br><b>DISCOVER YOUR TEAM</b></div>
      <div class="report-title">IMT DISCOVERY™<h2>LAPORAN TIM</h2></div>
      <div class="profile"><div class="avatar"><?php echo e(strtoupper(substr($group->name, 0, 3))); ?></div><div class="name"><?php echo e($group->name); ?></div></div>
      <div class="info-list">
        <div><span class="label">Industri</span><span class="val">Agensi Digital &amp; Kreatif</span></div>
        <div><span class="label">Staf Dites</span><span class="val"><?php echo e($totalParticipants); ?> (<?php echo e($group->quota > 0 ? round(($totalParticipants / $group->quota) * 100) : 0); ?>%) dari <?php echo e($group->quota); ?> Kuota</span></div>
        <div><span class="label">Periode Tes</span><span class="val"><?php echo e($group->created_at->format('d M Y')); ?></span></div>
        <div><span class="label">ID Laporan</span><span class="val"><?php echo e($group->code); ?></span></div>
        <div><span class="label">Rata-rata Durasi</span><span class="val"><?php echo e($avgDurationFormatted ?? '-'); ?></span></div>
      </div>
      <div class="about-box">
        <h3>TENTANG LAPORAN TIM INI</h3>
        Laporan ini menggabungkan hasil tes <?php echo e($totalParticipants); ?> peserta menjadi satu gambaran kolektif. Subjeknya bukan satu orang, tapi kecenderungan Tim secara keseluruhan: pola mana yang paling banyak muncul, dan pola mana yang paling jarang muncul di antara anggota tim.
        <blockquote style="margin:12px 0 0; font-style:italic; color:#fff; border-left:3px solid var(--orange); padding-left:10px;">Tim yang memahami dorongan kolektifnya bisa merancang cara kerja yang sesuai dengan kekuatan aslinya, bukan cuma meniru cara kerja tim lain.</blockquote>
      </div>
    </div>

    <div class="right-col">
      <div class="row-2">
        <div class="archetype-box">
          <div class="tag">ARKETIPE TIM</div>
          <div class="archetype-icon">4</div>
          <h2><?php echo e($archetype['name']); ?></h2>
          <p><b>Dorongan kolektif:</b> <?php echo e($archetype['desire']); ?></p>
          <div class="arch-divider"></div>
          <p><b>Kerentanan:</b> <?php echo e($archetype['fear']); ?></p>
          <div class="arch-key-q">
            <span>?</span>
            <p><?php echo e($archetype['keyQuestion']); ?></p>
          </div>
        </div>

        <div class="right-stack">
          <div class="radar-box">
            <h3>PROFIL 5 DRIVER TIM: RATA-RATA &amp; SEBARAN</h3>
            <div class="range-chart">
              <?php
                $radarOrder = ['security', 'significance', 'connection', 'growth', 'contribution'];
              ?>
              <?php $__currentLoopData = $radarOrder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="range-row">
                <div class="rr-head"><span class="rr-name" style="color:<?php echo e(config('imt_team.drivers.'.$d.'.color')); ?>;"><?php echo e(config('imt_team.drivers.'.$d.'.label')); ?></span><span class="rr-avg"><?php echo e($avgScores[$d]); ?></span></div>
                <div class="range-track"><div class="range-fill" style="left:<?php echo e($driverStats[$d]['min']); ?>%; width:<?php echo e(max(0, $driverStats[$d]['max'] - $driverStats[$d]['min'])); ?>%; background:<?php echo e(config('imt_team.drivers.'.$d.'.color')); ?>;"></div><div class="range-marker" style="left:<?php echo e($avgScores[$d]); ?>%; background:<?php echo e(config('imt_team.drivers.'.$d.'.color')); ?>;"></div></div>
                <div class="range-minmax"><span>min <?php echo e($driverStats[$d]['min']); ?></span><span>max <?php echo e($driverStats[$d]['max']); ?></span></div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <div class="range-legend">Garis tebal <b>▍</b> menandai rata-rata tim. Area warna menunjukkan rentang skor dari anggota tim paling rendah sampai paling tinggi di driver itu, supaya sebaran tidak tersembunyi di balik satu angka rata-rata.</div>
            </div>
            
            <div class="team-comp">
              <div style="font-size:10px; letter-spacing:1px; color:var(--muted); margin-bottom:8px; font-weight:700;">KOMPOSISI TIM: DRIVER PALING MENONJOL PER ORANG</div>
              <?php
                  $orderedStats = collect($driverStats)->sortByDesc('count');
              ?>
              <?php $__currentLoopData = $orderedStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver => $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="team-comp-row"><span class="tc-label"><?php echo e(ucfirst($driver)); ?></span><div class="team-comp-track"><div class="team-comp-fill" style="width:<?php echo e($stat['percentage']); ?>%; background:<?php echo e(config('imt_team.drivers.'.$driver.'.color')); ?>;"></div></div><span class="tc-val"><?php echo e($stat['percentage']); ?>% (<?php echo e($stat['count']); ?> org)</span></div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>

          <div class="apa-artinya">
            <h3>APA ARTINYA BAGI TIM</h3>
            <p><?php echo e(config('imt_team.drivers.' . $top1 . '.team_desc')); ?> Namun, setiap kekuatan memiliki area buta. <?php echo e(config('imt_team.drivers.' . $top1 . '.team_weakness')); ?> Kekuatan utamanya adalah <?php echo e(config('imt_team.drivers.' . $top1 . '.team_strength')); ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="di-box" style="margin-top:24px;">
    <h3>DQ TIM: TEAM DRIVER QUOTIENT™ RATA-RATA</h3>
    <div style="display:flex; align-items:baseline; gap:14px; margin-bottom:16px;">
      <div style="font-size:40px; font-weight:800;"><?php echo e($avgDq); ?>%</div>
      <div style="font-size:12px; color:#c7cde0; line-height:1.6;">Rata-rata dari <?php echo e($totalParticipants); ?> peserta. DQ tim menggambarkan seberapa jauh, secara kolektif, tim ini sudah mengenali dan mengelola dorongan-dorongannya sendiri, bukan angka tetap yang tidak bisa berubah.</div>
    </div>
    <div class="di-grid">
      <div class="di-item"><div class="n"><?php echo e($diValues['awareness']); ?>%</div><div class="l">AWARENESS</div></div>
      <div class="di-item"><div class="n"><?php echo e($diValues['insight']); ?>%</div><div class="l">INSIGHT</div></div>
      <div class="di-item"><div class="n"><?php echo e($diValues['regulation']); ?>%</div><div class="l">REGULATION</div></div>
      <div class="di-item"><div class="n"><?php echo e($diValues['development']); ?>%</div><div class="l">DEVELOPMENT</div></div>
      <div class="di-item"><div class="n"><?php echo e($diValues['transformation']); ?>%</div><div class="l">TRANSFORMATION</div></div>
    </div>
  </div>

  <div style="padding:0 30px 8px;">
    <div style="font-size:13px; font-weight:800; color:var(--navy); letter-spacing:.5px; margin-bottom:14px;">SUB COMPOSITE: KEKUATAN &amp; AREA PENGEMBANGAN TIM</div>
  </div>
  <div class="sc-highlight-grid">
    <div class="sc-highlight-card strength">
      <div class="hdr">5 KEKUATAN TERATAS TIM</div>
      <?php $__currentLoopData = $top5SubComposites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="sc-highlight-row">
        <div class="sc-row-head"><span><span class="nm"><?php echo e($sc['name']); ?></span><span class="dr"><?php echo e(ucfirst($sc['driver'])); ?></span></span><span class="sc"><?php echo e($sc['score']); ?></span></div>
        <div class="sc-bar-track"><div class="sc-bar-fill" style="width:<?php echo e($sc['score']); ?>%; background:<?php echo e(config('imt_team.drivers.'.$sc['driver'].'.color')); ?>;"></div></div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="sc-highlight-card watch">
      <div class="hdr">5 AREA PENGEMBANGAN TERBESAR TIM</div>
      <?php $__currentLoopData = $bottom5SubComposites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="sc-highlight-row">
        <div class="sc-row-head"><span><span class="nm"><?php echo e($sc['name']); ?></span><span class="dr"><?php echo e(ucfirst($sc['driver'])); ?></span></span><span class="sc"><?php echo e($sc['score']); ?></span></div>
        <div class="sc-bar-track"><div class="sc-bar-fill" style="width:<?php echo e($sc['score']); ?>%; background:<?php echo e(config('imt_team.drivers.'.$sc['driver'].'.color')); ?>;"></div></div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>

  <div class="dyn-section">
    <div class="section-navy-header" style="border-radius:8px 8px 0 0;">DINAMIKA TIM: Driver Dynamics™ pada <?php echo e(ucfirst($top1)); ?> (driver dominan tim)</div>
    <div class="section-body">
      <p style="font-size:12.5px; color:var(--muted); margin:0 0 10px; line-height:1.6;">Sebuah tim bisa menunjukkan lima kondisi berbeda tergantung tekanan yang sedang dihadapi, mulai dari versi paling sehat sampai versi paling berlebihan. Berikut bagaimana <?php echo e(ucfirst($top1)); ?>, driver dominan tim ini, biasanya terekspresi secara kolektif.</p>
      <div class="dyn-cards">
        <div class="dyn-card healthy">
          <h4>1 HEALTHY</h4>
          <div class="desc"><?php echo e(config('imt_team.drivers.'.$top1.'.healthy.desc')); ?></div>
          <ul>
            <?php $__currentLoopData = config('imt_team.drivers.'.$top1.'.healthy.points'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($pt); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
        <div class="dyn-card activated">
          <h4>2 ACTIVATED</h4>
          <div class="trigger"><?php echo e(config('imt_team.drivers.'.$top1.'.activated.trigger')); ?></div>
          <ul>
            <?php $__currentLoopData = config('imt_team.drivers.'.$top1.'.activated.points'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($pt); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
        <div class="dyn-card stress">
          <h4>3 STRESS</h4>
          <div class="desc"><?php echo e(config('imt_team.drivers.'.$top1.'.stress.desc')); ?></div>
          <ul>
            <?php $__currentLoopData = config('imt_team.drivers.'.$top1.'.stress.points'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($pt); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
        <div class="dyn-card shadow">
          <h4>4 SHADOW</h4>
          <div class="desc"><?php echo e(config('imt_team.drivers.'.$top1.'.shadow.desc')); ?></div>
          <ul>
            <?php $__currentLoopData = config('imt_team.drivers.'.$top1.'.shadow.points'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($pt); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
        <div class="dyn-card growth">
          <h4>5 GROWTH</h4>
          <div class="desc"><?php echo e(config('imt_team.drivers.'.$top1.'.growth.desc')); ?></div>
          <ul>
            <?php $__currentLoopData = config('imt_team.drivers.'.$top1.'.growth.points'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($pt); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      </div>
      
      <div class="challenge-box">
        <div class="ctag">CORE DEVELOPMENT CHALLENGE</div>
        <h4><?php echo e(config('imt_team.drivers.'.$top1.'.challenge.title')); ?></h4>
        <p class="lesson"><?php echo e(config('imt_team.drivers.'.$top1.'.challenge.lesson')); ?></p>
      </div>
    </div>
  </div>

  <div class="path-section">
    <div class="section-navy-header" style="border-radius:8px 8px 0 0;">TEAM DEVELOPMENT PATH</div>
    <div class="section-body">
      <?php
          $dqStage = 'Unaware'; $dqStageIndex = 0;
          if ($avgDq >= 20) { $dqStage = 'Aware'; $dqStageIndex = 1; }
          if ($avgDq >= 40) { $dqStage = 'Understanding'; $dqStageIndex = 2; }
          if ($avgDq >= 60) { $dqStage = 'Managing'; $dqStageIndex = 3; }
          if ($avgDq >= 80) { $dqStage = 'Transforming'; $dqStageIndex = 4; }
      ?>
      <p style="font-size:12.5px; color:var(--muted); margin:0 0 10px; line-height:1.6;">DQ tim rata-rata berada di <?php echo e($avgDq); ?>%, masuk tahap <b style="color:var(--navy);"><?php echo e($dqStage); ?>™</b>. Tim berada pada fase ini terkait kemampuan kolektif mengenali dan mengelola dorongannya.</p>
      
      <div class="stage-gauge">
        <div class="stage-bar-track">
          <div class="stage-bar-fill" style="width:<?php echo e($avgDq); ?>%;"></div>
          <div class="stage-pin" style="left:<?php echo e($avgDq); ?>%;">DQ Tim <?php echo e($avgDq); ?>%</div>
        </div>
        
        <div class="stage-points">
          <div class="stage-point <?php echo e($dqStageIndex >= 0 ? ($dqStageIndex == 0 ? 'current' : 'done') : ''); ?>"><div class="dot">①</div><div class="lbl">Unaware</div></div>
          <div class="stage-point <?php echo e($dqStageIndex >= 1 ? ($dqStageIndex == 1 ? 'current' : 'done') : ''); ?>"><div class="dot">②</div><div class="lbl">Aware</div></div>
          <div class="stage-point <?php echo e($dqStageIndex >= 2 ? ($dqStageIndex == 2 ? 'current' : 'done') : ''); ?>"><div class="dot">③</div><div class="lbl">Understanding</div></div>
          <div class="stage-point <?php echo e($dqStageIndex >= 3 ? ($dqStageIndex == 3 ? 'current' : 'done') : ''); ?>"><div class="dot">④</div><div class="lbl">Managing</div></div>
          <div class="stage-point <?php echo e($dqStageIndex >= 4 ? ($dqStageIndex == 4 ? 'current' : 'done') : ''); ?>"><div class="dot">⑤</div><div class="lbl">Transforming</div></div>
        </div>
      </div>
      
    </div>
  </div>

  <div class="bottom-grid">
    <div>
      <div class="section-navy-header">PROFIL PENUH 5 DRIVER TIM</div>
      <div class="section-body" style="padding:0 20px;">
        <?php
            $orderedDrivers = ['security', 'significance', 'connection', 'growth', 'contribution'];
        ?>
        <?php $__currentLoopData = $orderedDrivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="driver-row">
          <div class="driver-icon" style="background:<?php echo e(config('imt_team.drivers.'.$d.'.color')); ?>;"><?php echo e(config('imt_team.drivers.'.$d.'.icon')); ?></div>
          <div><span class="driver-score" style="color:<?php echo e(config('imt_team.drivers.'.$d.'.color')); ?>;"><?php echo e($avgScores[$d]); ?></span><span class="driver-name"><?php echo e(config('imt_team.drivers.'.$d.'.name')); ?></span>
            <div class="driver-desc"><?php echo e(config('imt_team.drivers.'.$d.'.team_desc')); ?></div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
    
    <div>
      <div class="validity-note" style="margin:0 0 24px;">
        <h4>Catatan Kualitas Data</h4>
        Dari <?php echo e($totalParticipants); ?> peserta, data telah diagregasi sepenuhnya untuk membentuk skor tim kolektif ini. Pastikan tingkat penyelesaian grup minimal mewakili tim secara wajar untuk menghindari simpangan data.
      </div>
    </div>
  </div>

  <div class="foot">
    <div class="flogo" style="display:flex; align-items:center; gap:6px;"><img src="<?php echo e(asset('assets/img/logo-icon.png')); ?>" alt="IMT" style="height:16px;"> IMT</div>
    <div class="fitem"><b>BERBASIS SAINS</b><span>Dibangun berdasarkan penelitian psikometri modern dan kerangka Driver Intelligence (DI), diagregasi dari data individu sungguhan.</span></div>
    <div class="fitem"><b>AKURAT &amp; TERPERCAYA</b><span>Model psikometri dengan standar yang tinggi, transparan soal kualitas data di setiap laporan.</span></div>
    <div class="fitem"><b>WAWASAN YANG DAPAT DITINDAKLANJUTI</b><span>Panduan praktis untuk pengembangan tim, bukan cuma angka.</span></div>
  </div>
</div>

</body>
</html>
<?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/admin/groups/team-report.blade.php ENDPATH**/ ?>