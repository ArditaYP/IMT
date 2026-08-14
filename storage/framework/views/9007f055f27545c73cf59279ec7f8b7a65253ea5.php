<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>IMT Discovery — Pilih Jalur Tes Anda</title>
<link rel="icon" type="image/png" href="<?php echo e(asset('assets/img/favicon.png')); ?>">
<link rel="apple-touch-icon" href="<?php echo e(asset('assets/img/apple-touch-icon.png')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/style.css')); ?>">
<style>
  .select-container {
    max-width: 900px;
    margin: 100px auto;
    padding: 40px 20px;
  }
  .select-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-top: 40px;
  }
  .select-card {
    background: #fff;
    border: 2px solid var(--border);
    border-radius: 20px;
    padding: 40px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .select-card:hover {
    border-color: var(--blue);
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(11,27,84,0.08);
  }
  .select-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin-bottom: 24px;
  }
  .select-card.personal .select-icon {
    background: rgba(43,94,228,0.1);
    color: var(--blue);
  }
  .select-card.group .select-icon {
    background: rgba(22,179,152,0.1);
    color: var(--green);
  }
  .select-card h3 {
    font-size: 24px;
    color: var(--navy);
    margin: 0 0 15px;
  }
  .select-card p {
    color: var(--muted);
    font-size: 15px;
    line-height: 1.6;
    margin: 0 0 30px;
    flex-grow: 1;
  }
  .select-card .btn {
    width: 100%;
  }
  @media (max-width: 768px) {
    .select-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
</head>
<body style="background:#f4f6fb;">

<nav class="nav">
  <div class="nav-inner">
    <div class="brand"><a href="<?php echo e(route('home')); ?>" style="text-decoration:none; color:inherit; display:flex; align-items:center; gap:8px;"><img class="brand-icon" src="<?php echo e(asset('assets/img/logo-icon.png')); ?>" alt="IMT Discovery"> IMT DISCOVERY</a></div>
    <div class="nav-cta">
      <a href="<?php echo e(route('home')); ?>" class="btn btn-ghost btn-sm">Kembali ke Beranda</a>
    </div>
  </div>
</nav>

<div class="select-container">
  <div class="section-head">
    <div class="kicker">Mulai Tes IMT Discovery</div>
    <h2>Bagaimana Anda mengikuti tes ini?</h2>
    <p>Silakan pilih jalur yang sesuai dengan tujuan Anda hari ini.</p>
  </div>

  <div class="select-grid">
    <!-- Card Personal -->
    <a href="<?php echo e(route('assessment.test')); ?>?type=personal" class="select-card personal">
      <div class="select-icon">👤</div>
      <h3>Tes Personal</h3>
      <p>Kenali 5 dimensi dorongan utama (Driver) Anda dan dapatkan analisis komprehensif tentang gaya kerja Anda secara individual.</p>
      <div class="btn btn-primary">Mulai Tes Personal</div>
    </a>

    <!-- Card Grup -->
    <a href="<?php echo e(route('assessment.test')); ?>?type=group" class="select-card group">
      <div class="select-icon">🏢</div>
      <h3>Grup / Perusahaan</h3>
      <p>Masukkan kode akses dari organisasi Anda untuk ikut serta dalam pemetaan dinamika dorongan dan kultur tim.</p>
      <div class="btn btn-dark">Masukkan Kode Grup</div>
    </a>
  </div>
</div>

<footer style="text-align:center; padding:40px; color:var(--muted); font-size:13px; margin-top:40px;">
  &copy; 2026 IMT Discovery. All rights reserved.
</footer>

</body>
</html>
<?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/pilih-tes.blade.php ENDPATH**/ ?>