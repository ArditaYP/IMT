<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Laporan IMT Discovery™</title>
<meta name="robots" content="noindex">
<link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
<link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
<link rel="stylesheet" href="{{ asset('assets/style.css') }}">
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
  .avatar{width:64px; height:64px; border-radius:50%; background:linear-gradient(135deg,#8a6a4a,#3d2b1f); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:20px; flex-shrink:0;}
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
  .archetype-icon{width:56px; height:56px; border-radius:50%; background:rgba(232,134,46,0.15); border:2px solid var(--orange); display:flex; align-items:center; justify-content:center; font-size:26px; margin-bottom:14px;}
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
  .legend-bands{display:flex; gap:0; margin-top:10px; border-radius:6px; overflow:hidden; font-size:10px; text-align:center;}
  .legend-bands div{padding:6px 0; color:#fff; flex:1;}
  .legend-bands .b1{background:#d1493a;} .legend-bands .b2{background:#e8862e;} .legend-bands .b3{background:#5aab52;} .legend-bands .b4{background:#2f6fed;}
  .legend-sub{display:flex; font-size:10px; color:var(--muted); text-align:center; margin-top:2px;}
  .legend-sub div{flex:1;}
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
  ul.check-list li{font-size:12.5px; line-height:1.6; padding:6px 0 6px 26px; position:relative;}
  ul.check-list li:before{content:"✓"; position:absolute; left:0; top:6px; color:#2fa84f; font-weight:800;}
  ul.check-list.growth li:before{content:"➤"; color:var(--orange);}
  .insight-box{background:#fff8ec; border:1px solid #f2dfb8; border-radius:8px; padding:14px 16px; margin-top:10px;}
  .insight-box h4{margin:0 0 6px; color:#8a5a12; font-size:12.5px;}
  .insight-box p{margin:0; font-size:12px; line-height:1.6; color:#5b4222;}
  .action-box{background:#f8f9fd; border:1px solid #e7e9f2; border-radius:8px; padding:14px 16px; margin-bottom:14px;}
  .action-box h4{margin:0 0 8px; color:var(--navy); font-size:12.5px; display:flex; align-items:center; gap:6px;}
  .energy-box{background:var(--navy); color:#fff; border-radius:8px; padding:16px;}
  .energy-box h4{color:var(--orange); font-size:12.5px; margin:0 0 8px;}
  .energy-box p{font-size:12px; line-height:1.6; color:#dde3f2; margin:0;}
  .di-box{margin:0 30px 24px; background:linear-gradient(135deg,#14265a,#0d1b3e); color:#fff; border-radius:12px; padding:22px 26px;}
  .di-box h3{color:var(--orange); font-size:13px; letter-spacing:1px; margin:0 0 12px;}
  .di-grid{display:grid; grid-template-columns:repeat(5,1fr); gap:14px;}
  .di-item{background:rgba(255,255,255,.06); border-radius:8px; padding:12px; text-align:center;}
  .di-item .n{font-size:20px; font-weight:800; color:#fff;}
  .di-item .l{font-size:10px; color:#aab2cc; letter-spacing:.5px; margin-top:4px;}
  .di-detail{margin-top:16px; display:grid; grid-template-columns:repeat(5,1fr); gap:14px;}
  .di-detail-item{border-top:1px solid rgba(255,255,255,.14); padding-top:10px;}
  .di-detail-item .d{font-size:10.5px; line-height:1.5; color:#c7cde0;}

  .spotlight-box{margin:0 30px 24px; background:#fff; border:1px solid #e7e9f2; border-radius:10px; padding:20px 24px; display:flex; gap:18px; align-items:flex-start;}
  .spotlight-box .sp-icon{flex-shrink:0; width:46px; height:46px; border-radius:50%; background:#eef1fb; color:var(--navy); display:flex; align-items:center; justify-content:center; font-size:20px; font-weight:800;}
  .spotlight-box .sp-tag{font-size:10px; letter-spacing:1.5px; color:var(--orange); font-weight:700; margin-bottom:4px;}
  .spotlight-box h4{margin:0 0 6px; font-size:15px; color:var(--navy);}
  .spotlight-box p{margin:0; font-size:12.5px; line-height:1.65; color:var(--text);}

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
  .challenge-box ul{list-style:none; margin:0 0 14px; padding:0;}
  .challenge-box li{font-size:12px; line-height:1.6; padding:4px 0 4px 20px; position:relative; color:#c7cde0;}
  .challenge-box li:before{content:"→"; position:absolute; left:0; color:var(--orange);}
  .challenge-box .cq{font-size:12.5px; font-style:italic; color:#fff; margin:0; padding-top:12px; border-top:1px solid rgba(255,255,255,.14);}

  .path-section{margin:0 30px 24px;}
  .stage-gauge{margin:22px 0 18px;}
  .stage-bar-track{position:relative; height:12px; border-radius:7px; margin:0 8px 40px; background:linear-gradient(90deg,#e2a19a 0%,#e2a19a 20%,#f2c799 20%,#f2c799 40%,#f5dd9a 40%,#f5dd9a 60%,#b7dcb0 60%,#b7dcb0 80%,#a9c3f5 80%,#a9c3f5 100%);}
  .stage-bar-fill{position:absolute; top:0; left:0; height:100%; border-radius:7px; background:var(--navy); opacity:.14;}
  .stage-pin{position:absolute; top:-32px; transform:translateX(-50%); background:var(--navy); color:#fff; font-size:11px; font-weight:800; padding:4px 10px; border-radius:6px; white-space:nowrap; box-shadow:0 2px 6px rgba(13,27,62,.25);}
  .stage-pin:after{content:""; position:absolute; bottom:-5px; left:50%; transform:translateX(-50%); border:5px solid transparent; border-top-color:var(--navy);}
  .stage-points{display:flex; justify-content:space-between; margin:0 -6px;}
  .stage-point{flex:1; text-align:center; padding:0 4px;}
  .stage-point .dot{width:26px; height:26px; line-height:26px; border-radius:50%; background:#eef1fb; color:var(--muted); font-size:11px; font-weight:800; margin:0 auto 6px; border:2px solid #fff; box-shadow:0 0 0 1px #dfe3ef; transition:all .2s;}
  .stage-point.done .dot{background:var(--green); color:#fff; box-shadow:0 0 0 1px var(--green);}
  .stage-point.current .dot{background:var(--orange); color:#fff; width:32px; height:32px; line-height:32px; font-size:13px; box-shadow:0 0 0 5px rgba(232,134,46,.18);}
  .stage-point .lbl{font-size:10.5px; font-weight:700; color:var(--muted);}
  .stage-point.done .lbl{color:#1a8a4f;}
  .stage-point.current .lbl{color:var(--navy);}
  .path-current-box{margin-top:16px; background:#f8f9fd; border:1px solid #e7e9f2; border-radius:8px; padding:14px 16px;}
  .path-current-box .focus{font-size:12px; color:var(--muted);}
  .formula-row{display:flex; align-items:center; justify-content:center; flex-wrap:wrap; gap:10px; margin-top:18px; padding:16px; background:#f8f9fd; border:1px solid #e7e9f2; border-radius:8px;}
  .formula-row .fchip{background:#fff; border:1px solid #dde1f0; border-radius:6px; padding:8px 14px; font-size:12px; font-weight:700; color:var(--navy);}
  .formula-row .fplus{color:var(--muted); font-size:14px;}
  .formula-row .farrow{color:var(--orange); font-size:16px; font-weight:800;}
  .formula-row .fresult{background:var(--navy); color:#fff; border-radius:6px; padding:8px 16px; font-size:12px; font-weight:800;}
  .path-grid-2{display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:14px;}
  .path-mini-box{border:1px solid #e7e9f2; border-radius:8px; padding:14px 16px;}
  .path-mini-box.q{background:#f8f9fd;}
  .path-mini-box.c{background:#fff8ec; border-color:#f2dfb8;}
  .path-mini-box h5{margin:0 0 6px; font-size:11px; letter-spacing:.5px; color:var(--navy);}
  .path-mini-box.c h5{color:#8a5a12;}
  .path-mini-box p{margin:0; font-size:12px; line-height:1.6; color:var(--text);}
  .path-subhead{font-size:11px; letter-spacing:1.5px; font-weight:700; color:var(--orange); border-bottom:2px solid #f2dfb8; padding-bottom:6px; margin-bottom:12px;}
  .path-purpose-box{background:#eef1fb; border-radius:8px; padding:14px 16px;}
  .path-purpose-box p{margin:0; font-size:12.5px; line-height:1.65; color:var(--navy);}
  .path-signs-box{margin-top:14px; background:#f1faf3; border:1px solid #cdeed6; border-radius:8px; padding:14px 16px;}
  .path-signs-box h5{margin:0 0 8px; font-size:11px; letter-spacing:.5px; color:#1a8a4f;}
  .path-signs-box ul{list-style:none; margin:0; padding:0;}
  .path-signs-box li{font-size:12px; line-height:1.6; padding:4px 0 4px 20px; position:relative; color:var(--text);}
  .path-signs-box li:before{content:"✓"; position:absolute; left:0; color:#2fa84f; font-weight:800;}

  .validity-bar{margin:0 30px 20px; display:flex; align-items:center; gap:10px; font-size:11.5px; color:var(--muted);}
  .validity-pill{display:inline-flex; align-items:center; gap:6px; padding:5px 12px; border-radius:999px; font-weight:700; font-size:11px;}
  .validity-pill.ok{background:#e5f7ec; color:#1a8a4f;}
  .validity-pill.warn{background:#fdf2f1; color:#c0392b;}
  .validity-note{margin:0 30px 24px; background:#fdf2f1; border:1px solid #f5d3cf; border-radius:8px; padding:14px 16px; font-size:12px; color:#7a2b23; line-height:1.6;}
  .validity-note h4{margin:0 0 6px; font-size:12.5px; color:#c0392b;}

  .foot{background:var(--navy); color:#fff; display:flex; justify-content:space-around; align-items:center; padding:16px 20px; font-size:11px; text-align:center; flex-wrap:wrap; gap:10px;}
  .foot .flogo{font-weight:800; color:var(--orange); font-size:14px; letter-spacing:1px;}
  .foot .fitem{max-width:180px;}
  .foot .fitem b{display:block; margin-bottom:2px;}
  .foot .fitem span{color:#aab2cc; font-size:10px;}
  @media (max-width:980px){.dyn-cards{grid-template-columns:repeat(3,1fr);}}
  @media (max-width:820px){.grid-top{grid-template-columns:1fr;} .row-2{grid-template-columns:1fr;} .bottom-grid{grid-template-columns:1fr;} .di-grid,.di-detail{grid-template-columns:repeat(2,1fr);} .dyn-cards{grid-template-columns:1fr;}}

  /* ===== Halaman Overview (page 1): ringkasan skor gaya "composite score
     sheet", terinspirasi format assessment psikometri komersial tapi
     dengan skala 0-100 milik sendiri (bukan skala ternorma 70-130 yang
     mengasumsikan data populasi yang kita tidak punya), warna driver
     existing, dan tanpa tick-axis population-range. ===== */
  .ov-header{display:flex; justify-content:space-between; align-items:flex-start; padding:24px 30px 6px; flex-wrap:wrap; gap:14px;}
  .ov-header .ov-brand{display:flex; align-items:center; gap:10px;}
  .ov-header .ov-brand img{height:36px;}
  .ov-header .ov-brand .t{font-weight:800; letter-spacing:1px; color:var(--navy); font-size:15px;}
  .ov-header .ov-brand .t span{color:var(--orange);}
  .ov-header .ov-meta{text-align:right; font-size:11.5px; color:var(--muted); line-height:1.7;}
  .ov-header .ov-meta b{color:var(--navy);}
  .ov-title{padding:6px 30px 18px; border-bottom:1px solid #eef0f7; margin:0 30px;}
  .ov-title h1{margin:0 0 2px; font-size:20px; color:var(--navy);}
  .ov-title p{margin:0; font-size:12px; color:var(--muted);}

  .ov-total{margin:22px 30px; background:#f8f9fd; border:1px solid #e7e9f2; border-radius:10px; padding:18px 22px;}
  .ov-total-row{display:flex; align-items:center; gap:18px;}
  .ov-total .ov-label{font-size:11px; letter-spacing:1.5px; font-weight:800; color:var(--navy); min-width:160px;}
  .ov-total .ov-score{font-size:26px; font-weight:800; color:var(--navy); min-width:56px; text-align:right;}
  .ov-bar-track{position:relative; flex:1; height:16px; border-radius:8px; background:#e3e7f4; overflow:visible;}
  .ov-bar-fill{position:absolute; top:0; left:0; height:100%; border-radius:8px; background:var(--navy);}
  .ov-bar-div{position:absolute; top:-3px; bottom:-3px; width:1px; background:rgba(13,27,62,.12);}
  .ov-scale-wrap{margin-top:10px; padding-left:178px;}
  .ov-scale-wrap .legend-bands{margin-top:0; font-size:9.5px;}
  .ov-scale-wrap .legend-sub{font-size:9.5px;}
  .ov-scale-caption{margin:8px 0 0; font-size:10.5px; color:var(--muted); font-style:italic; line-height:1.5;}

  .ov-groups{padding:0 30px 8px;}
  .ov-group{margin-bottom:16px; border:1px solid #e7e9f2; border-radius:10px; overflow:hidden;}
  .ov-group-header{display:flex; align-items:center; justify-content:space-between; padding:12px 16px; color:#fff; font-weight:800; font-size:13px; letter-spacing:.5px; box-shadow:0 3px 8px rgba(13,27,62,.22), inset 0 1px 0 rgba(255,255,255,.3), inset 0 -6px 10px rgba(0,0,0,.12); text-shadow:0 1px 2px rgba(0,0,0,.2);}
  .ov-group-header .ov-gscore{font-size:16px;}
  .ov-sub-list{background:#fff; padding-top:4px;}
  .ov-sub-row{display:grid; grid-template-columns:170px 1fr 44px 74px; gap:12px; align-items:center; padding:8px 16px; border-top:1px solid #f1f2f8;}
  .ov-sub-row .ov-sub-name{font-size:11.5px; font-weight:700; color:var(--navy);}
  .ov-sub-row .ov-sub-name .mark{color:var(--orange); font-weight:800; margin-left:2px;}
  .ov-sub-row .ov-sub-tagline{font-size:9.5px; color:var(--muted); margin-top:1px;}
  .ov-sub-row .ov-mini-bar-track{position:relative; height:9px; border-radius:5px; background:#eef1fb;}
  .ov-sub-row .ov-mini-bar-fill{position:absolute; top:0; left:0; height:100%; border-radius:5px;}
  .ov-sub-row .ov-sub-score{font-size:12.5px; font-weight:800; text-align:right; color:var(--navy);}
  .ov-band-pill{font-size:8.5px; font-weight:700; text-align:center; padding:3px 4px; border-radius:10px; color:#fff; white-space:nowrap; letter-spacing:.2px;}

  .ov-footnote{margin:6px 30px 24px; font-size:10.5px; color:var(--muted); line-height:1.6; padding:12px 14px; background:#fff8ec; border:1px solid #f2dfb8; border-radius:8px;}
  .ov-footnote b{color:#8a5a12;}
  .ov-nextpage-hint{margin:0 30px 26px; text-align:center; font-size:11px; color:var(--muted); letter-spacing:.5px;}

  @media print{
    .ov-page{page-break-after:always;}
  }
  @media (max-width:820px){
    .ov-sub-row{grid-template-columns:1fr; row-gap:4px;}
    .ov-band-pill{justify-self:start;}
    .ov-scale-wrap{padding-left:0;}
  }
</style>
</head>
<body>

<div class="no-print" style="max-width:1100px; margin:16px auto 0; padding:0 24px; display:flex; justify-content:space-between; align-items:center;">
  <a href="{{ route('dashboard') }}" class="btn btn-ghost" style="flex:1;">Tutup</a>
  <button class="btn btn-primary" style="flex:1;" onclick="shareReport()">Bagikan Hasil</button>
</div>

<div id="lockedView" style="max-width:640px; margin:80px auto; text-align:center; display:none;">
  <div class="q-card">
    <h2 style="color:var(--navy); margin:14px 0 8px;">Laporan Terkunci</h2>
    <p style="color:var(--muted); margin-bottom:22px;">Selesaikan tes dan pembayaran terlebih dahulu untuk membuka laporan interpretasi lengkap Anda.</p>
    <a href="{{ route('assessment.test') }}" class="btn btn-primary">Mulai / Lanjutkan Tes</a>
  </div>
</div>

<div class="page ov-page" id="overviewPage" style="display:none;">
  <div class="ov-header">
    <div class="ov-brand">
      <img src="{{ asset('assets/img/logo-icon.png') }}" alt="IMT Discovery">
      <div class="t">IMT <span>DISCOVERY™</span></div>
    </div>
    <div class="ov-meta">
      <div><b id="ovName">-</b></div>
      <div id="ovJob">-</div>
      <div id="ovDate">-</div>
    </div>
  </div>
  <div class="ov-title">
    <h1>Overview: Ringkasan Skor</h1>
    <p>Peta cepat semua skor Anda dalam satu halaman: Total DQ, 5 Driver utama, dan 25 Sub Composite di baliknya. Penjelasan lengkap tiap bagian ada di halaman berikutnya.</p>
  </div>

  <div class="ov-total">
    <div class="ov-total-row">
      <div class="ov-label">TOTAL DQ</div>
      <div class="ov-bar-track" id="ovTotalTrack">
        <div class="ov-bar-fill" id="ovTotalFill"></div>
      </div>
      <div class="ov-score" id="ovTotalScore">-</div>
    </div>
    <div class="ov-scale-wrap">
      <div class="legend-bands"><div class="b1">0–25</div><div class="b2">26–50</div><div class="b3">51–75</div><div class="b4">76–100</div></div>
      <div class="legend-sub"><div>Sangat Rendah</div><div>Rendah</div><div>Sedang</div><div>Tinggi</div></div>
    </div>
    <p class="ov-scale-caption">Skala 0 sampai 100 ini berlaku untuk semua bar di halaman ini. Semakin ke kanan bar terisi, semakin tinggi kecenderungannya, dari Total DQ, 5 Driver, sampai Sub Composite di bawahnya.</p>
  </div>

  <div class="ov-groups" id="ovGroups"></div>

  <div class="ov-footnote">
    <b>Catatan cara baca:</b> skor 5 Driver utama (Security, Significance, Connection, Growth, Contribution) dihitung dari 8 pernyataan inti per driver, jadi presisinya sama seperti laporan utama. Sub Composite bertanda <b>•</b> bersifat <b>indikatif</b>, dihitung dari 1 pernyataan saja (bukan 2), jadi baca sebagai sinyal awal, bukan ukuran setepat yang lain. Tidak ada skor di halaman ini yang direka-reka, semuanya dihitung langsung dari jawaban Anda.
  </div>
  <div class="ov-nextpage-hint">↓ Penjelasan lengkap arketipe, DQ, dan jalur perkembangan Anda ada di halaman berikutnya ↓</div>
</div>

<div class="page" id="reportView" style="display:none;">

  <div class="grid-top">
    <div>
      <img src="{{ asset('assets/img/logo-icon.png') }}" alt="IMT Discovery" style="height:44px; margin-bottom:4px;">
      <div class="logo-sub">INNER MOTIVATION TRANSFORMATION<br><b>DISCOVER YOUR DRIVER</b></div>
      <div class="report-title">IMT DISCOVERY™<h2>LAPORAN PERSONAL</h2></div>
      <div class="profile"><div class="avatar" id="avatar">--</div><div class="name" id="pname">-</div></div>
      <div class="info-list">
        <div><span class="label">Tanggal Lahir</span><span class="val" id="pdob">-</span></div>
        <div><span class="label">Pekerjaan</span><span class="val" id="pjob">-</span></div>
        <div><span class="label">Tanggal Tes</span><span class="val" id="pdate">-</span></div>
        <div><span class="label">ID Laporan</span><span class="val" id="pid">-</span></div>
        <div><span class="label">Durasi Tes</span><span class="val" id="pduration">-</span></div>
      </div>
      <div class="about-box">
        <h3>TENTANG IMT DISCOVERY™</h3>
        IMT Discovery membantu Anda memahami apa yang benar-benar mendorong Anda, bagaimana Anda mengambil keputusan, dan apa yang memberi energi setiap hari.
        <blockquote style="margin:12px 0 0; font-style:italic; color:#fff; border-left:3px solid var(--orange); padding-left:10px;">Ketika Anda memahami apa yang paling penting bagi Anda, Anda dapat membuat pilihan yang lebih baik.</blockquote>
      </div>
    </div>

    <div class="right-col">
      <div class="section-navy-header" style="border-radius:8px;">YOUR INNER DRIVER, YOUR INNER TRANSFORMATION</div>
      <p style="font-size:12.5px; color:var(--muted); margin:-6px 0 0; line-height:1.6;">IMT Discovery mengidentifikasi 5 Human Drivers™ yang menjadi sumber motivasi, membentuk keputusan, dan memengaruhi perilaku Anda setiap hari.</p>
      <div class="row-2">
        <div class="archetype-box">
          <div class="tag">ARKETIPE ANDA</div>
          <h2 id="archName">-</h2>
          <div class="archetype-icon" id="archIcon">-</div>
          <p id="archDesire">-</p>
          <div class="arch-divider"></div>
          <p class="arch-label">YANG PALING ANDA HINDARI</p>
          <p id="archFear">-</p>
          <p class="arch-label">KEKUATAN ANDA</p>
          <p id="archStrengths">-</p>
          <p class="arch-label">TITIK BUTA</p>
          <p id="archBlindSpot">-</p>
          <div class="arch-key-q"><span>?</span><p id="archKeyQ">-</p></div>
        </div>
        <div class="right-stack">
          <div class="radar-box">
            <h3>PROFIL IMT ANDA</h3>
            <svg id="radar" viewBox="0 0 600 480" width="100%"></svg>
          </div>
          <div class="apa-artinya">
            <h3>APA ARTINYA</h3>
            <p id="apaArtinya">-</p>
            <div class="legend-bands"><div class="b1">0–25</div><div class="b2">26–50</div><div class="b3">51–75</div><div class="b4">76–100</div></div>
            <div class="legend-sub"><div>Sangat Rendah</div><div>Rendah</div><div>Sedang</div><div>Tinggi</div></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="validity-bar">
    <span>Konsistensi Jawaban:</span>
    <span class="validity-pill" id="validityPill">-</span>
  </div>
  <div class="validity-note" id="validityNote" style="display:none;"></div>

  <div class="di-box">
    <div style="display:flex; align-items:center; justify-content:space-between; gap:20px; margin-bottom:14px; flex-wrap:wrap;">
      <div>
        <h3 style="margin:0 0 4px;">DQ: DRIVER QUOTIENT</h3>
        <div style="font-size:11px; color:#aab2cc; letter-spacing:.5px; max-width:520px; line-height:1.6;">DQ mengukur seberapa jauh Anda mampu mengenali, memahami, mengelola, mengembangkan, dan mengarahkan driver Anda sendiri. Lima kemampuan di bawah ini bisa terus tumbuh seiring waktu, bukan angka tetap sejak lahir.</div>
      </div>
      <div style="text-align:center; flex-shrink:0;">
        <div style="font-size:38px; font-weight:800; color:#fff;" id="dqScore">-</div>
        <div style="font-size:10px; letter-spacing:1px; color:var(--orange); font-weight:700;">DQ SCORE</div>
      </div>
    </div>
    <div class="di-grid" id="diGrid"></div>
    <div class="di-detail" id="diDetail"></div>
  </div>

  <div class="spotlight-box">
    <div class="sp-icon" id="spotlightIcon">-</div>
    <div>
      <div class="sp-tag">KUALITAS TERSEMBUNYI ANDA · SUB COMPOSITE</div>
      <h4 id="spotlightName">-</h4>
      <p id="spotlightBlurb">-</p>
    </div>
  </div>

  <div class="dyn-section">
    <div class="section-navy-header" style="border-radius:8px 8px 0 0;">DINAMIKA DRIVER ANDA: Driver Dynamics™</div>
    <div class="section-body" style="border-radius:0 0 8px 8px;">
      <p style="font-size:12.5px; color:var(--muted); margin:0 0 10px; line-height:1.6;">Setiap Driver bisa muncul dalam lima kondisi berbeda tergantung situasi yang Anda hadapi, mulai dari versi paling sehat sampai versi paling berlebihan. Berikut cara Driver dominan Anda, <b id="dynDriverName" style="color:var(--navy);">-</b>, biasanya terekspresi, dan apa pelajaran inti yang bisa Anda ambil darinya.</p>
      <p id="dynScene" style="font-size:13px; color:var(--text); margin:0 0 16px; line-height:1.65; font-style:italic;">-</p>
      <div class="dyn-cards" id="dynCards"></div>
      <div class="challenge-box" id="challengeBox">
        <div class="ctag">INTI TANTANGAN PERKEMBANGAN ANDA</div>
        <h4 id="challengeTitle">-</h4>
        <p class="lesson" id="challengeLesson">-</p>
        <ul id="challengePoints"></ul>
        <p class="cq" id="challengeQuestion">-</p>
      </div>
    </div>
  </div>

  <div class="path-section">
    <div class="section-navy-header" style="border-radius:8px 8px 0 0;">JALUR PERKEMBANGAN ANDA: Driver Development Path™</div>
    <div class="section-body" style="border-radius:0 0 8px 8px;">
      <p style="font-size:12.5px; color:var(--muted); margin:0 0 14px; line-height:1.65;">Bagian ini punya dua lapis. <b style="color:var(--navy);">Pertama</b>, seberapa jauh Anda sudah mengenali &amp; mengelola driver Anda secara umum (dihitung dari skor DQ Anda). <b style="color:var(--navy);">Kedua</b>, jalur pengembangan yang spesifik untuk driver dominan Anda, <b id="pathDriverName" style="color:var(--navy);">-</b>, lengkap dengan tujuan, pertanyaan refleksi, dan tantangan nyata untuk mulai bertumbuh.</p>

      <div class="path-subhead">TAHAP KESADARAN ANDA SAAT INI</div>
      <div class="stage-gauge">
        <div class="stage-bar-track">
          <div class="stage-bar-fill" id="stageBarFill"></div>
          <div class="stage-pin" id="stagePin"><span id="stagePinScore">-</span></div>
        </div>
        <div class="stage-points" id="stagePoints"></div>
      </div>
      <div class="path-current-box">
        <div class="focus" id="pathFocus" style="margin-bottom:6px;">-</div>
        <p id="pathMeaning" style="margin:6px 0 0; font-size:12px; line-height:1.6; color:var(--text);">-</p>
      </div>

      <div class="path-subhead" style="margin-top:22px;">JALUR PENGEMBANGAN <span id="pathSubheadDriver">-</span> ANDA</div>
      <div class="path-purpose-box">
        <p id="pathPurpose">-</p>
      </div>
      <p style="font-size:11.5px; color:var(--muted); margin:14px 0 6px; line-height:1.6;">Tiga hal ini, kalau tumbuh bersamaan, yang membawa Anda ke bentuk tertinggi driver ini:</p>
      <div class="formula-row" id="formulaRow"></div>
      <div class="path-grid-2">
        <div class="path-mini-box q">
          <h5>PERTANYAAN REFLEKSI</h5>
          <p id="pathQuestion">-</p>
        </div>
        <div class="path-mini-box c">
          <h5>TANTANGAN MINGGU INI</h5>
          <p id="pathChallenge">-</p>
        </div>
      </div>
      <div class="path-signs-box">
        <h5>TANDA ANDA SUDAH MULAI BERKEMBANG</h5>
        <ul id="pathSigns"></ul>
      </div>
    </div>
  </div>

  <div class="bottom-grid">
    <div>
      <div class="section-navy-header">MEMAHAMI 5 HUMAN DRIVERS™ ANDA</div>
      <div class="section-body" id="driverRows"></div>
      <div class="insight-box"><h4>WAWASAN UTAMA</h4><p id="insightText">-</p></div>
    </div>
    <div>
      <div class="section-navy-header">KEKUATAN ANDA DALAM TINDAKAN</div>
      <div class="section-body">
        <ul class="check-list" id="strengthsList"></ul>
        <h4 style="color:var(--navy); font-size:12.5px; margin:14px 0 6px;">PELUANG UNTUK BERTUMBUH</h4>
        <ul class="check-list growth" id="growthList"></ul>
      </div>
      <div class="action-box" style="margin-top:16px;"><h4>LANGKAH PRAKTIS UNTUK ANDA</h4><ul class="check-list" id="actionList"></ul></div>
      <div class="energy-box"><h4>ENERGI ANDA PALING TINGGI KETIKA...</h4><p id="energyText">-</p></div>
    </div>
  </div>

  <div class="foot">
    <div class="flogo" style="display:flex; align-items:center; gap:6px;"><img src="{{ asset('assets/img/logo-icon.png') }}" alt="IMT" style="height:16px;"> IMT</div>
    <div class="fitem"><b>BERBASIS SAINS</b><span>Dibangun berdasarkan penelitian psikometri modern dan kerangka Driver Intelligence (DI).</span></div>
    <div class="fitem"><b>AKURAT & TERPERCAYA</b><span>Model psikometri dengan standar yang tinggi.</span></div>
    <div class="fitem"><b>WAWASAN YANG DAPAT DITINDAKLANJUTI</b><span>Panduan praktis untuk perbaikan nyata.</span></div>
  </div>
</div>

<script src="{{ asset('assets/data.js') }}"></script>
<script>
  const paid = localStorage.getItem('imt_paid') === 'true';
  const scores = @json($scores);
  const profile = JSON.parse(localStorage.getItem('imt_profile') || 'null');
  const answers = JSON.parse(localStorage.getItem('imt_answers') || '{}');

  const dbQuestions = @json($dbQuestions);
  const oldPairWith = {};
  IMT_QUESTIONS.forEach(q => { oldPairWith[q.id] = q.pairWith; });
  
  IMT_QUESTIONS = dbQuestions.map(dbq => ({
      id: dbq.id,
      driver: dbq.driver,
      type: dbq.type,
      subComposite: dbq.subComposite,
      pairWith: oldPairWith[dbq.id] || null,
      text: dbq.text
  }));

  const isGroupReport = @json($isGroupReport ?? false);
  const totalParticipants = @json($totalParticipants ?? 0);
  const backendAnswers = @json($answers ?? null);
  const assessmentDuration = @json($assessment->duration_seconds ?? null);
  const isAdmin = @json($isAdmin ?? false);
  
  // Jika load dari backend, bypass cek profile/bayar lokal
  let isPaid = paid;
  let activeProfile = profile;

  if (isGroupReport) {
      if (backendAnswers) Object.assign(answers, backendAnswers);
      const mockName = @json($assessment->name ?? 'Grup');
      activeProfile = { name: mockName, job: '-', dob: '-', date: new Date().toISOString() };
      isPaid = true;
  } else if (backendAnswers || isAdmin) {
      if (backendAnswers) Object.assign(answers, backendAnswers);
      activeProfile = { 
          name: @json($assessment->name ?? '-'), 
          job: @json($assessment->job ?? '-'), 
          dob: @json($assessment->dob ?? '-'), 
          date: @json($assessment->created_at ? $assessment->created_at->toISOString() : now()->toISOString()) 
      };
      isPaid = true;
  }

  // segera di bawah, sebelum baris kode lain di bawahnya sempat berjalan.
  const OV_BAND_COLOR = { low: '#d1493a', mid: '#e8862e', high: '#5aab52', vhigh: '#2f6fed' };

  if(!isPaid || !scores || !activeProfile){
    document.getElementById('lockedView').style.display = 'block';
  } else {
    document.getElementById('overviewPage').style.display = 'block';
    document.getElementById('reportView').style.display = 'block';
    renderOverview();
    renderReport();
  }

  /**
   * Menggeser terang/gelap warna hex sebesar `percent` (-255..255).
   * Dipakai untuk membangun gradasi metalik dari satu warna driver.
   */
  function ovShade(hex, percent){
    const num = parseInt(hex.replace('#',''), 16);
    let r = (num >> 16) + percent, g = ((num >> 8) & 0x00FF) + percent, b = (num & 0x0000FF) + percent;
    r = Math.max(0, Math.min(255, r)); g = Math.max(0, Math.min(255, g)); b = Math.max(0, Math.min(255, b));
    return '#' + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
  }

  /**
   * Gradasi "metallic glossy" dari warna driver, dipakai khusus untuk
   * header 5 Driver di halaman Overview supaya jelas lebih menonjol
   * dibanding bar Sub Composite di bawahnya yang sengaja dibiarkan flat.
   */
  function ovGlossyGradient(hex){
    const light = ovShade(hex, 45), dark = ovShade(hex, -40);
    return `linear-gradient(270deg, rgba(255,255,255,0) 0%, rgba(255,255,255,.4) 78%, rgba(255,255,255,0) 100%), linear-gradient(270deg, ${dark} 0%, ${hex} 50%, ${light} 100%)`;
  }

  function renderOverview(){
    const order = ['security','significance','connection','growth','contribution'];
    document.getElementById('ovName').textContent = activeProfile.name.toUpperCase();
    document.getElementById('ovJob').textContent = activeProfile.job;
    document.getElementById('ovDate').textContent = new Date(activeProfile.date).toLocaleDateString('id-ID',{day:'2-digit',month:'short',year:'numeric'});

    // Total DQ: pakai formula identik dengan yang dipakai di halaman report
    // (rata-rata 5 dimensi DI, lihat renderReport() di bawah untuk definisi lengkap).
    const diValuesOv = {
      awareness: Math.round((scores[order.slice().sort((a,b)=>scores[b]-scores[a])[0]]+scores.growth)/2),
      insight: Math.round((scores.significance+scores.connection)/2),
      regulation: Math.round((scores.security+scores.growth)/2),
      development: scores.growth,
      transformation: Math.round(Object.values(scores).reduce((a,b)=>a+b,0)/5),
    };
    const clampOv = v => Math.max(0, Math.min(100, v));
    const dqTotal = Math.round(IMT_DI_DIMENSIONS.reduce((a,dim)=>a+clampOv(diValuesOv[dim.key]),0)/IMT_DI_DIMENSIONS.length);
    document.getElementById('ovTotalScore').textContent = dqTotal;
    document.getElementById('ovTotalFill').style.width = dqTotal + '%';

    const subScores = imtSubCompositeScores(answers);
    const groupsEl = document.getElementById('ovGroups');
    groupsEl.innerHTML = order.map(d => {
      const dd = IMT_DRIVERS[d];
      const subRows = subScores[d].map(sc => {
        const mark = sc.reliability === 'indicative' ? '<span class="mark">•</span>' : '';
        const band = imtBandFor(sc.score);
        return `<div class="ov-sub-row">
          <div><div class="ov-sub-name">${sc.name}${mark}</div><div class="ov-sub-tagline">${sc.tagline}</div></div>
          <div class="ov-mini-bar-track"><div class="ov-mini-bar-fill" style="width:${sc.score}%; background:${dd.color};"></div></div>
          <div class="ov-sub-score">${sc.score}</div>
          <div class="ov-band-pill" style="background:${OV_BAND_COLOR[band.key]};">${band.label}</div>
        </div>`;
      }).join('');
      return `<div class="ov-group">
        <div class="ov-group-header" style="background:${ovGlossyGradient(dd.color)};">
          <span>${dd.icon} ${dd.label}</span>
          <span class="ov-gscore">${scores[d]}</span>
        </div>
        <div class="ov-sub-list">${subRows}</div>
      </div>`;
    }).join('');
  }

  function renderReport(){
    const order = ['security','significance','connection','growth','contribution'];
    const sortedDrivers = order.slice().sort((a,b)=>scores[b]-scores[a]);
    const topDriver = sortedDrivers[0];
    const secondDriver = sortedDrivers[1];
    const arch = imtSynergyFor(topDriver, secondDriver);

    if (isGroupReport) {
        document.getElementById('pname').textContent = "GRUP: " + activeProfile.name.toUpperCase();
        document.getElementById('avatar').textContent = "GR";
        
        // Ganti label kolom untuk grup
        document.getElementById('pdob').parentElement.innerHTML = 'Total Peserta <b id="pdob" style="color:var(--navy); font-weight:800;">: ' + totalParticipants + ' Orang</b>';
        document.getElementById('pjob').parentElement.style.display = 'none'; // Sembunyikan Pekerjaan
        
        document.getElementById('pdate').textContent = ': ' + new Date().toLocaleDateString('id-ID',{day:'2-digit',month:'short',year:'numeric'});
        document.getElementById('pid').textContent = ': GRP-' + String(Math.floor(Math.random()*9000)+1000);
        
        if (assessmentDuration !== null) {
            document.getElementById('pduration').textContent = ': ' + Math.floor(assessmentDuration/60) + 'm ' + (assessmentDuration%60) + 's';
        } else {
            document.getElementById('pduration').parentElement.style.display = 'none';
        }
    } else {
        document.getElementById('pname').textContent = activeProfile.name.toUpperCase();
        document.getElementById('avatar').textContent = activeProfile.name.split(' ').map(w=>w[0]).slice(0,2).join('').toUpperCase();
        
        if (activeProfile.dob && activeProfile.dob !== '-') {
            document.getElementById('pdob').textContent = ': ' + new Date(activeProfile.dob).toLocaleDateString('id-ID',{day:'2-digit',month:'short',year:'numeric'});
        } else {
            document.getElementById('pdob').parentElement.style.display = 'none';
        }

        if (activeProfile.job && activeProfile.job !== '-') {
            document.getElementById('pjob').textContent = ': ' + activeProfile.job;
        } else {
            document.getElementById('pjob').parentElement.style.display = 'none';
        }

        document.getElementById('pdate').textContent = ': ' + new Date(activeProfile.date).toLocaleDateString('id-ID',{day:'2-digit',month:'short',year:'numeric'});
        
        let datePart = activeProfile.date.split('T')[0];
        document.getElementById('pid').textContent = ': IMT-D-' + datePart.replace(/-/g,'').slice(2) + '-' + @json($assessment->id ?? String(Math.floor(Math.random()*900)+100));
        
        if (assessmentDuration !== null) {
            document.getElementById('pduration').textContent = ': ' + Math.floor(assessmentDuration/60) + 'm ' + (assessmentDuration%60) + 's';
        } else {
            document.getElementById('pduration').textContent = ': -';
        }
    }

    document.getElementById('archName').innerHTML = arch.name.replace('™','').trim().toUpperCase();
    document.getElementById('archIcon').textContent = IMT_DRIVERS[topDriver].icon;
    document.getElementById('archDesire').textContent = arch.desire;
    document.getElementById('archFear').textContent = arch.fear;
    document.getElementById('archStrengths').textContent = arch.strengths;
    document.getElementById('archBlindSpot').textContent = arch.blindSpot;
    document.getElementById('archKeyQ').textContent = arch.keyQuestion;

    const thirdEssence = IMT_DRIVER_ESSENCE[sortedDrivers[2]];
    document.getElementById('apaArtinya').textContent = `${imtComboNarrative(sortedDrivers[0], sortedDrivers[1])} Sedikit di belakang keduanya, ada juga dorongan untuk ${thirdEssence}, yang sesekali muncul dan ikut mewarnai cara Anda mengambil keputusan sehari-hari.`;

    // Radar
    const cx=300, cy=260, R=190;
    const svg = document.getElementById('radar');
    let html = '';
    for(let ring=1; ring<=4; ring++){
      const rr = R*ring/4;
      let pts = order.map((d,i)=>{
        const ang = (-90 + i*72) * Math.PI/180;
        return (cx+rr*Math.cos(ang)).toFixed(1)+','+(cy+rr*Math.sin(ang)).toFixed(1);
      }).join(' ');
      html += `<polygon points="${pts}" fill="none" stroke="#dfe3ef" stroke-width="1"/>`;
    }
    order.forEach((d,i)=>{
      const ang = (-90+i*72)*Math.PI/180;
      const x = cx+R*Math.cos(ang), y = cy+R*Math.sin(ang);
      html += `<line x1="${cx}" y1="${cy}" x2="${x.toFixed(1)}" y2="${y.toFixed(1)}" stroke="#dfe3ef"/>`;
    });
    let poly = order.map((d,i)=>{
      const ang = (-90+i*72)*Math.PI/180;
      const r = Math.max(0,Math.min(100,scores[d]))/100*R;
      return (cx+r*Math.cos(ang)).toFixed(1)+','+(cy+r*Math.sin(ang)).toFixed(1);
    }).join(' ');
    html += `<polygon points="${poly}" fill="rgba(47,111,237,0.18)" stroke="#2f6fed" stroke-width="2.5"/>`;
    order.forEach((d,i)=>{
      const ang = (-90+i*72)*Math.PI/180;
      const r = Math.max(0,Math.min(100,scores[d]))/100*R;
      const x = cx+r*Math.cos(ang), y = cy+r*Math.sin(ang);
      html += `<circle cx="${x.toFixed(1)}" cy="${y.toFixed(1)}" r="5" fill="${IMT_DRIVERS[d].color}"/>`;
    });
    const labelPos = [[300,35],[530,185],[445,450],[160,450],[70,185]];
    const scorePos = [[300,52],[530,203],[445,468],[160,468],[70,203]];
    order.forEach((d,i)=>{
      html += `<text x="${labelPos[i][0]}" y="${labelPos[i][1]}" text-anchor="middle" font-size="13" font-weight="700" fill="${IMT_DRIVERS[d].color}">${IMT_DRIVERS[d].label}</text>`;
      html += `<text x="${scorePos[i][0]}" y="${scorePos[i][1]}" text-anchor="middle" font-size="18" font-weight="800" fill="${IMT_DRIVERS[d].color}">${scores[d]}</text>`;
    });
    html += `<text x="300" y="264" text-anchor="middle" font-size="14" font-weight="800" fill="#0d1b3e">IMT</text>`;
    html += `<text x="300" y="280" text-anchor="middle" font-size="10" font-weight="700" fill="#0d1b3e">DISCOVERY™</text>`;
    svg.innerHTML = html;

    // Driver rows
    const rowsEl = document.getElementById('driverRows');
    order.forEach(d=>{
      const dd = IMT_DRIVERS[d];
      const band = imtBandFor(scores[d]);
      const bd = dd.bands[band.key];
      rowsEl.innerHTML += `<div class="driver-row">
        <div class="driver-icon" style="background:${dd.color};">${dd.icon}</div>
        <div>
          <span class="driver-score" style="color:${dd.color};">${scores[d]}</span>
          <span class="driver-name">${dd.label}</span>
          <p class="driver-desc">${bd.desc}</p>
          <div class="tags"><span class="label">Kekuatan Anda</span>${bd.tags.map(t=>`<span>${t}</span>`).join('')}</div>
        </div>
      </div>`;
    });

    // Insight
    document.getElementById('insightText').textContent = `${IMT_DRIVERS[topDriver].name} adalah jalur berkembang Anda yang paling kuat. ${IMT_DRIVERS[topDriver].coreNeed}`;

    // Strengths / growth / actions: driven by top driver band + the specific top/low combination
    const topBand = imtBandFor(scores[topDriver]);
    const topBd = IMT_DRIVERS[topDriver].bands[topBand.key];
    document.getElementById('strengthsList').innerHTML = topBd.tags.map(t=>`<li>Anda menunjukkan kekuatan sebagai pribadi yang ${t.toLowerCase()}.</li>`).join('');
    const lowDriver = sortedDrivers[sortedDrivers.length - 1];
    document.getElementById('growthList').innerHTML = `
      <li>${IMT_DRIVERS[lowDriver].name} adalah sisi yang masih punya ruang untuk Anda kembangkan lebih jauh. ${IMT_DRIVERS[lowDriver].coreNeed}</li>
      <li>Kenali pemicu ketegangan Anda: ${IMT_DRIVERS[topDriver].coreFear}</li>
      <li>Gunakan kekuatan ${IMT_DRIVERS[topDriver].name} untuk membantu area yang masih berkembang.</li>`;
    document.getElementById('actionList').innerHTML = `
      <li>${IMT_GROWTH_ACTIONS[lowDriver]}</li>
      <li>Diskusikan hasil ini dengan mentor/atasan untuk mendapat perspektif tambahan.</li>
      <li>Tinjau kembali laporan ini setiap 6 bulan untuk melihat perkembangan Anda.</li>`;
    document.getElementById('energyText').textContent = `Anda berada di titik energi tertinggi ketika lingkungan Anda mendukung ${IMT_DRIVERS[topDriver].name}, yaitu ${IMT_DRIVERS[topDriver].tagline}.`;

    // DQ (Driver Quotient): public-facing score, powered by the 5 Dimensions of Driver Intelligence
    const diValues = {
      awareness: Math.round((scores[topDriver]+scores.growth)/2),
      insight: Math.round((scores.significance+scores.connection)/2),
      regulation: Math.round((scores.security+scores.growth)/2),
      development: scores.growth,
      transformation: Math.round(Object.values(scores).reduce((a,b)=>a+b,0)/5),
    };
    const clamp = v => Math.max(0, Math.min(100, v));
    const diGrid = document.getElementById('diGrid');
    const diDetail = document.getElementById('diDetail');
    diGrid.innerHTML = IMT_DI_DIMENSIONS.map(dim =>
      `<div class="di-item"><div class="n">${clamp(diValues[dim.key])}%</div><div class="l">${dim.label}</div></div>`
    ).join('');
    diDetail.innerHTML = IMT_DI_DIMENSIONS.map(dim =>
      `<div class="di-detail-item"><div class="d">${imtDiInterpret(dim.key, clamp(diValues[dim.key]), IMT_DRIVERS[topDriver].name)}</div></div>`
    ).join('');
    const dqScore = Math.round(IMT_DI_DIMENSIONS.reduce((a,dim)=>a+clamp(diValues[dim.key]),0)/IMT_DI_DIMENSIONS.length);
    document.getElementById('dqScore').textContent = dqScore + '%';

    // Sub Composite™ spotlight: dipilih dari driver dominan, diposisikan oleh driver #2
    const spotlight = imtSubCompositeSpotlight(topDriver, secondDriver);
    document.getElementById('spotlightIcon').textContent = IMT_DRIVERS[topDriver].icon;
    document.getElementById('spotlightName').textContent = spotlight.name;
    document.getElementById('spotlightBlurb').textContent = spotlight.blurb;

    // Driver Dynamics™: Healthy / Activated / Stress / Shadow / Growth state
    // of the dominant driver, plus its Core Development Challenge.
    const dyn = IMT_DRIVER_DYNAMICS[topDriver];
    document.getElementById('dynDriverName').textContent = IMT_DRIVERS[topDriver].name;
    document.getElementById('dynScene').textContent = IMT_DRIVER_SCENES[topDriver];
    const dynCard = (cls, icon, label, state) => `
      <div class="dyn-card ${cls}">
        <h4>${icon} ${label}</h4>
        <div class="desc">${state.desc}</div>
        ${state.trigger ? `<div class="trigger">${state.trigger}</div>` : ''}
        <ul>${state.points.map(x=>`<li>${x}</li>`).join('')}</ul>
      </div>`;
    document.getElementById('dynCards').innerHTML =
      dynCard('healthy', '1', 'HEALTHY', dyn.healthy) +
      dynCard('activated', '2', 'ACTIVATED', dyn.activated) +
      dynCard('stress', '3', 'STRESS', dyn.stress) +
      dynCard('shadow', '4', 'SHADOW', dyn.shadow) +
      dynCard('growth', '5', 'GROWTH', dyn.growth);
    document.getElementById('challengeTitle').textContent = dyn.challenge.title;
    document.getElementById('challengeLesson').textContent = dyn.challenge.lesson;
    document.getElementById('challengePoints').innerHTML = dyn.challenge.points.map(p=>`<li>${p}</li>`).join('');
    document.getElementById('challengeQuestion').textContent = `"${dyn.challenge.question}"`;

    // Driver Development Path™: 5-stage journey positioned by DQ score,
    // ditampilkan sebagai gauge kontinu (posisi skor persis) + 5 milestone.
    const currentStage = imtStageFor(dqScore);
    const currentIdx = IMT_DEV_STAGES.findIndex(s => s.key === currentStage.key);
    document.getElementById('stageBarFill').style.width = dqScore + '%';
    const pin = document.getElementById('stagePin');
    pin.style.left = dqScore + '%';
    document.getElementById('stagePinScore').textContent = 'DQ ' + dqScore;
    document.getElementById('stagePoints').innerHTML = IMT_DEV_STAGES.map((s,i)=>{
      const cls = i === currentIdx ? 'current' : (i < currentIdx ? 'done' : '');
      return `<div class="stage-point ${cls}"><div class="dot">${s.icon}</div><div class="lbl">${s.name.replace('™','')}</div></div>`;
    }).join('');
    document.getElementById('pathFocus').textContent = `Fokus pengembangan Anda saat ini: ${currentStage.focus}`;
    document.getElementById('pathMeaning').textContent = currentStage.meaning;

    // Development Path™ per-driver: tujuan, rumus pertumbuhan, pertanyaan refleksi, tantangan, tanda progres
    const devPath = IMT_DEV_PATH[topDriver];
    document.getElementById('pathDriverName').textContent = IMT_DRIVERS[topDriver].name;
    document.getElementById('pathSubheadDriver').textContent = IMT_DRIVERS[topDriver].name.toUpperCase();
    document.getElementById('pathPurpose').textContent = devPath.purpose;
    document.getElementById('formulaRow').innerHTML = devPath.formula.parts.map((p,i) =>
      `<span class="fchip">${p}</span>${i < devPath.formula.parts.length - 1 ? '<span class="fplus">+</span>' : ''}`
    ).join('') + `<span class="farrow">→</span><span class="fresult">${devPath.formula.result}</span>`;
    document.getElementById('pathQuestion').textContent = devPath.question;
    document.getElementById('pathChallenge').textContent = devPath.challenge;
    document.getElementById('pathSigns').innerHTML = devPath.signs.map(s => `<li>${s}</li>`).join('');

    // Validity / Consistency Check: deteksi straight-lining & extreme responding
    const validity = JSON.parse(localStorage.getItem('imt_validity') || 'null') || imtValidity(JSON.parse(localStorage.getItem('imt_answers') || '{}'));
    const pill = document.getElementById('validityPill');
    pill.textContent = validity.label;
    pill.className = 'validity-pill ' + (validity.flag ? 'warn' : 'ok');
    const note = document.getElementById('validityNote');
    if (validity.flag) {
      note.style.display = 'block';
      note.innerHTML = `<h4>Catatan Konsistensi Jawaban</h4>
        Pola jawaban pada tes ini menunjukkan indikasi berikut: ${validity.reasons.join(' ')}
        Skor pada laporan ini tetap dihitung apa adanya dari jawaban yang diberikan, namun disarankan untuk mengisi ulang tes dengan lebih cermat agar hasil interpretasi lebih akurat.`;
    } else {
      note.style.display = 'none';
    }
  }
</script>
</body>
</html>
