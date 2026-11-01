<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roda Care | Perawatan Kendaraan</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header class="navbar">
    <a class="brand" href="index.html"><span class="brand-icon" aria-hidden="true">⚙</span> <span class="brand-name">Roda<span>Care</span></span></a>
    <div class="nav-tools"><button id="themeToggle" class="theme-toggle" type="button" aria-label="Ubah tema" title="Ubah tema">🌙</button><button class="menu-toggle" id="menuToggle" aria-label="Buka menu" aria-expanded="false" type="button">☰</button></div>
    <nav class="nav-links">
      <a class="active" href="index.html">Beranda</a>
      <a href="#layanan">Layanan</a>
      <a href="#tentang">Tentang</a>
      <a class="btn btn-outline" href="login.html">Masuk</a>
      <a class="btn btn-primary" href="register.html">Daftar</a>
    </nav>
  </header>
  <main>
    <section class="hero">
      <div class="hero-copy">
        <span class="eyebrow">SOLUSI PERAWATAN KENDARAAN</span>
        <h1>Rawat kendaraanmu,<br><span>perjalanan lebih tenang.</span></h1>
        <p>Pesan servis kendaraan dengan mudah, pantau riwayat perawatan, dan temukan layanan bengkel yang sesuai kebutuhanmu.</p>
        <div class="hero-actions"><a class="btn btn-primary" href="register.html">Mulai Sekarang →</a><a class="btn btn-light" href="#layanan">Lihat Layanan</a></div>
        <div class="hero-points"><span>✓ Jadwal fleksibel</span><span>✓ Riwayat servis tercatat</span></div>
      </div>
      <div class="hero-visual">
        <div class="hero-circle"></div><div class="car-emoji">🚘</div>
        <div class="floating-card"><span class="status-dot"></span><div><b>Servis lebih teratur</b><small>Semua catatan dalam satu tempat</small></div></div>
      </div>
    </section>
    <section class="section" id="layanan">
      <div class="section-heading"><span class="eyebrow">LAYANAN KAMI</span><h2>Perawatan jadi lebih praktis</h2><p>Pilih layanan sesuai kondisi kendaraanmu.</p><label class="service-search-label" for="serviceSearch">Cari layanan</label><input id="serviceSearch" class="service-search" type="search" placeholder="Contoh: ganti oli" autocomplete="off"></div>
      <div class="service-grid">
        <article class="service-card"><div class="service-icon">🛢️</div><h3>Ganti Oli</h3><p>Perawatan rutin untuk menjaga performa mesin.</p></article>
        <article class="service-card"><div class="service-icon">🔧</div><h3>Servis Berkala</h3><p>Pemeriksaan kendaraan agar tetap nyaman digunakan.</p></article>
        <article class="service-card"><div class="service-icon">🛞</div><h3>Ban & Rem</h3><p>Pemeriksaan komponen penting untuk keselamatan.</p></article>
      </div>
    </section>
    <section class="cta-panel" id="tentang"><div><span class="eyebrow">RODA CARE</span><h2>Kendaraan terawat, aktivitas lancar.</h2><p>Kelola kendaraan dan catatan servis tanpa repot.</p></div><a class="btn btn-primary" href="register.html">Buat Akun Gratis →</a></section>
  </main>
  <footer class="footer"><a class="brand" href="index.html"><span class="brand-icon" aria-hidden="true">⚙</span> <span class="brand-name">Roda<span>Care</span></span></a><p>© <span id="currentYear">2026</span> Roda Care · Teman perjalananmu.</p></footer>
  <div id="toast" class="toast" role="status" aria-live="polite"></div>
  <script src="js/dom.js"></script>
</body>
</html>