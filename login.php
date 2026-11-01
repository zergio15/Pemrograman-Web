
<?php
session_start();

// Jika sudah login, langsung menuju dashboard
if (isset($_SESSION["nama_pengguna"])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk | Roda Care</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body class="auth-page">

    <a class="brand auth-brand" href="index.html">
        <span class="brand-icon" aria-hidden="true">⚙</span>
        <span class="brand-name">Roda<span>Care</span></span>
    </a>

    <main class="auth-layout">

        <!-- Bagian informasi -->
        <section class="auth-promo">
            <span class="eyebrow">SELAMAT DATANG KEMBALI</span>

            <h1>
                Perjalanan nyaman dimulai dari kendaraan terawat.
            </h1>

            <p>
                Masuk untuk mengelola kendaraan, jadwal servis,
                dan riwayat perawatanmu.
            </p>

            <div class="promo-art">
                🚘
                <span>✓</span>
            </div>
        </section>

        <!-- Form login -->
        <section class="auth-card">

            <a class="back-link" href="index.html">
                ← Kembali ke beranda
            </a>

            <h2>Masuk ke akun</h2>

            <p class="muted">
                Masukkan nama, email, dan kata sandi kamu.
            </p>

            <form action="proses-login.php" method="POST">

    <label for="nama">Nama pengguna</label>
    <input type="text" id="nama" name="nama" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Kata sandi</label>
    <input type="password" id="password" name="password" minlength="6" required>

    <button class="btn btn-primary full" type="submit">
        Masuk
    </button>

</form>

            <p class="auth-switch">
                Belum punya akun?
                <a href="register.html">Daftar sekarang</a>
            </p>

            <p class="auth-switch">
                Login sebagai pengelola?
                <a href="admin-login.html">Masuk Admin</a>
            </p>

            <p class="demo-note">
                Login ini menggunakan session PHP dan belum terhubung
                ke database.
            </p>

        </section>
    </main>

</body>
</html>
