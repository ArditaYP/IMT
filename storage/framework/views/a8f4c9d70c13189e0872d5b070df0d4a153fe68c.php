<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Isi Tes IMT Discovery™</title>
<meta name="robots" content="noindex">
<link rel="icon" type="image/png" href="<?php echo e(asset('assets/img/favicon.png')); ?>">
<link rel="apple-touch-icon" href="<?php echo e(asset('assets/img/apple-touch-icon.png')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/style.css')); ?>">
<style>
  .modal-overlay{ position:fixed; inset:0; background:rgba(15,23,42,.55); display:flex; align-items:center; justify-content:center; z-index:999; padding:20px; }
  .modal-box{ background:#fff; border-radius:16px; max-width:420px; width:100%; padding:32px 28px; text-align:center; box-shadow:0 20px 60px rgba(0,0,0,.25); }
</style>
</head>
<body>
<nav class="nav"><div class="nav-inner">
  <a href="<?php echo e(route('home')); ?>" class="brand"><img class="brand-icon" src="<?php echo e(asset('assets/img/logo-icon.png')); ?>" alt="IMT Discovery"> IMT DISCOVERY</a>
  <div style="font-size:13px; color:var(--muted);">Data Anda tersimpan otomatis &amp; rahasia</div>
</div></nav>

<div class="test-shell">

  <!-- INTRO -->
  <div id="intro" class="fade-in">
    <div class="section-head" style="text-align:left; max-width:none; margin-bottom:26px;">
      <div class="kicker">Sebelum Mulai</div>
      <h2 style="margin:8px 0 6px;">Lengkapi data diri Anda</h2>
      <p>Digunakan untuk mempersonalisasi laporan Anda.</p>
    </div>
    <div class="q-card" style="display:block;">
      <div class="grid grid-2" style="gap:16px;">
        <div style="grid-column: span 2;">
            <label style="font-size:12.5px; color:var(--muted); font-weight:600;">Kode Grup (Opsional)</label>
            <input id="f-group" type="text" placeholder="Masukkan kode grup jika ada" style="width:100%; padding:12px 14px; border-radius:10px; border:1.5px solid var(--border); margin-top:6px; background:#f8f9fc; font-family:monospace; text-transform:uppercase;">
            <div style="font-size:11px; color:#6b7280; margin-top:4px;">Hanya diisi jika Anda mendapat tes ini dari perusahaan/organisasi.</div>
        </div>
        <div><label style="font-size:12.5px; color:var(--muted); font-weight:600;">Nama Lengkap</label>
          <input id="f-name" type="text" placeholder="Nama Anda" style="width:100%; padding:12px 14px; border-radius:10px; border:1.5px solid var(--border); margin-top:6px;"></div>
        <div><label style="font-size:12.5px; color:var(--muted); font-weight:600;">Email</label>
          <input id="f-email" type="email" placeholder="email@contoh.com" style="width:100%; padding:12px 14px; border-radius:10px; border:1.5px solid var(--border); margin-top:6px;"></div>
        <div><label style="font-size:12.5px; color:var(--muted); font-weight:600;">Tanggal Lahir</label>
          <input id="f-dob" type="date" style="width:100%; padding:12px 14px; border-radius:10px; border:1.5px solid var(--border); margin-top:6px;"></div>
        <div><label style="font-size:12.5px; color:var(--muted); font-weight:600;">Pekerjaan</label>
          <input id="f-job" type="text" placeholder="Cth: Entrepreneur" style="width:100%; padding:12px 14px; border-radius:10px; border:1.5px solid var(--border); margin-top:6px;"></div>
      </div>
      <button id="btnStart" class="btn btn-primary btn-block" style="margin-top:24px;" onclick="startTest()">Mulai Tes Sekarang →</button>
    </div>
  </div>

  <!-- QUESTIONS -->
  <div id="quiz" style="display:none;">
    <div class="progress-wrap">
      <div class="progress-track"><div class="progress-fill" id="pfill" style="width:0%"></div></div>
      <div class="progress-label"><span id="pcount">Soal 1 dari 50</span></div>
    </div>
    <div class="q-card fade-in" id="qcard">
      <div class="q-text" id="qtext"></div>
      <div class="likert" id="likert"></div>
      <div class="likert-labels"><span>Sangat Tidak Setuju</span><span>Sangat Setuju</span></div>
    </div>
    <div class="test-nav">
      <button class="btn btn-ghost" id="btnBack" onclick="back()">← Sebelumnya</button>
      <span style="font-size:12.5px; color:var(--muted); align-self:center;">Klik salah satu angka untuk lanjut otomatis</span>
    </div>
  </div>

  <!-- DONE -->
  <div id="done" style="display:none;" class="fade-in">
    <div class="q-card" style="text-align:center;">
      <div style="font-size:50px;">✅</div>
      <h2 style="color:var(--navy); margin:14px 0 8px;">Tes selesai!</h2>
      <p style="color:var(--muted); margin-bottom:26px;">Jawaban Anda sudah tersimpan. Lanjutkan ke pembayaran untuk membuka laporan interpretasi lengkap Anda.</p>
      <a href="checkout.html" id="btn-checkout" class="btn btn-primary btn-block">Memproses Laporan...</a>
    </div>
  </div>

</div>

<!-- SPEED WARNING MODAL -->
<div id="speedModal" class="modal-overlay" style="display:none;">
  <div class="modal-box">
    <div style="font-size:40px;">⚠️</div>
    <h3 style="color:var(--navy); margin:14px 0 8px;">Mohon isi dengan benar</h3>
    <p style="color:var(--muted); margin-bottom:22px;">Kami mendeteksi beberapa jawaban dijawab sangat cepat. Luangkan waktu sejenak untuk membaca setiap pernyataan dengan cermat agar hasil tes Anda akurat.</p>
    <button class="btn btn-primary btn-block" onclick="closeSpeedWarning()">Saya Mengerti, Lanjutkan</button>
  </div>
</div>

<script src="<?php echo e(asset('assets/data.js')); ?>"></script>
<script>
  let idx = 0;
  const answers = {};
  
  // Merge data.js IMT_QUESTIONS with data from Database to preserve pairWith metadata
  const dbQuestions = <?php echo json_encode($dbQuestions, 15, 512) ?>;
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
  
  let questionOrder = IMT_QUESTIONS; // diganti dengan urutan acak + modul validitas saat tes dimulai

  // --- Deteksi kecepatan menjawab ---
  let questionShownAt = 0;
  let consecutiveFast = 0;
  let fastAnswerCount = 0;
  let totalAnswered = 0;
  const FAST_THRESHOLD_MS = 1000;
  const FAST_STREAK_LIMIT = 3;

  // Prefill group from URL if exists
  window.addEventListener('DOMContentLoaded', () => {
      const urlParams = new URLSearchParams(window.location.search);
      const groupCode = urlParams.get('group');
      if(groupCode) {
          document.getElementById('f-group').value = groupCode;
      }
  });

  async function startTest(){
    const groupCode = document.getElementById('f-group').value.trim();
    let groupId = null;

    if (groupCode) {
        const btn = document.getElementById('btnStart');
        const oldText = btn.innerHTML;
        btn.innerHTML = 'Memvalidasi Grup...';
        btn.disabled = true;

        try {
            const res = await fetch("<?php echo e(route('api.validate.group')); ?>", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>" },
                body: JSON.stringify({ code: groupCode })
            });
            const data = await res.json();
            
            btn.innerHTML = oldText;
            btn.disabled = false;

            if (!data.valid) {
                alert(data.message);
                return;
            }
            groupId = data.group.id;
        } catch (e) {
            btn.innerHTML = oldText;
            btn.disabled = false;
            alert("Gagal memvalidasi kode grup. Periksa koneksi Anda.");
            return;
        }
    }

    const profile = {
      name: document.getElementById('f-name').value || 'Peserta IMT',
      email: document.getElementById('f-email').value || '-',
      dob: document.getElementById('f-dob').value || '-',
      job: document.getElementById('f-job').value || '-',
      group_id: groupId,
      date: new Date().toISOString().slice(0,10)
    };
    localStorage.setItem('imt_profile', JSON.stringify(profile));
    questionOrder = imtShuffledQuestions().concat(imtValidityModuleQuestions());
    document.getElementById('intro').style.display = 'none';
    document.getElementById('quiz').style.display = 'block';
    renderQ();
  }

  function renderQ(){
    const q = questionOrder[idx];
    document.getElementById('pfill').style.width = ((idx)/questionOrder.length*100) + '%';
    document.getElementById('pcount').textContent = `Soal ${idx+1} dari ${questionOrder.length}`;
    document.getElementById('qtext').textContent = q.text;
    document.getElementById('btnBack').disabled = idx === 0;
    const lik = document.getElementById('likert');
    lik.innerHTML = '';
    for(let i=1;i<=7;i++){
      const b = document.createElement('button');
      b.textContent = i;
      if(answers[q.id] === i) b.classList.add('active');
      b.onclick = () => choose(q.id, i);
      lik.appendChild(b);
    }
    document.getElementById('qcard').classList.remove('fade-in');
    void document.getElementById('qcard').offsetWidth;
    document.getElementById('qcard').classList.add('fade-in');
    questionShownAt = Date.now();
  }

  function choose(qid, val){
    const elapsed = Date.now() - questionShownAt;
    answers[qid] = val;
    localStorage.setItem('imt_answers', JSON.stringify(answers));
    totalAnswered++;
    if(elapsed < FAST_THRESHOLD_MS){
      fastAnswerCount++;
      consecutiveFast++;
    } else {
      consecutiveFast = 0;
    }

    const advance = () => {
      if(idx < questionOrder.length - 1){ idx++; renderQ(); }
      else finish();
    };

    if(consecutiveFast >= FAST_STREAK_LIMIT){
      consecutiveFast = 0;
      pendingAdvance = advance;
      document.getElementById('speedModal').style.display = 'flex';
    } else {
      setTimeout(advance, 220);
    }
  }

  let pendingAdvance = null;
  function closeSpeedWarning(){
    document.getElementById('speedModal').style.display = 'none';
    const next = pendingAdvance;
    pendingAdvance = null;
    if(next) setTimeout(next, 150);
  }

  function back(){ if(idx>0){ idx--; renderQ(); } }

  async function finish(){
    document.getElementById('pfill').style.width = '100%';
    const scores = imtScore(answers);
    const meta = { fastAnswerCount, totalAnswered };
    const validity = imtValidity(answers, meta);
    
    // Save to local storage as backup
    localStorage.setItem('imt_scores', JSON.stringify(scores));
    localStorage.setItem('imt_archetype', imtArchetype(scores));
    localStorage.setItem('imt_validity', JSON.stringify(validity));
    localStorage.setItem('imt_meta', JSON.stringify(meta));
    localStorage.setItem('imt_paid', 'true');

    // Show loading state
    document.getElementById('quiz').innerHTML = '<div style="padding:40px; text-align:center;"><h2 style="color:var(--navy);">Sedang Memproses Laporan...</h2><p style="color:var(--muted);">Sistem sedang menganalisis profil dan menghasilkan ringkasan AI Anda.</p></div>';

    const profile = JSON.parse(localStorage.getItem('imt_profile') || '{"name":"Peserta IMT", "job":"-"}');
    
    try {
        const response = await fetch("<?php echo e(route('assessment.submit')); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
            },
            body: JSON.stringify({
                participant_name: profile.name,
                email: profile.email,
                dob: profile.dob,
                job: profile.job,
                group_id: profile.group_id,
                answers: answers
            })
        });
        
        if (response.ok) {
            const data = await response.json();
            // Langsung redirect ke halaman hasil (laporan)
            window.location.href = data.redirect_url;
        } else {
            console.error(await response.text());
            alert('Terjadi kesalahan saat memproses laporan.');
        }
    } catch (e) {
        console.error(e);
        alert('Gagal terhubung ke server.');
    }
  }
</script>
</body>
</html>
<?php /**PATH C:\Users\CSO KUTA 2\Documents\web\IMT\resources\views/test.blade.php ENDPATH**/ ?>