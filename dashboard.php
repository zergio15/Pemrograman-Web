<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION["nama_pengguna"])) {
    header("Location: login.php");
    exit;
}

// Ambil nama dan email dari session
$nama = $_SESSION["nama_pengguna"];
$email = $_SESSION["email"] ?? "";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Roda Care</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Navigasi -->
    <header class="dashboard-header">
        <a class="brand" href="index.html">
            <span class="brand-icon" aria-hidden="true">⚙</span>
            <span class="brand-name">Roda<span>Care</span></span>
        </a>

        <nav>
            <a href="index.html">Beranda</a>
            <a href="#layanan">Layanan</a>
            <a href="#kendaraan">Kendaraan</a>
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </nav>
    </header>

    <!-- Konten utama -->
    <main class="dashboard-container">

        <!-- Sapaan pengguna -->
        <section class="dashboard-welcome">
            <span class="eyebrow">DASHBOARD PENGGUNA</span>

            <h1>
                Selamat datang,
                <?php echo htmlspecialchars($nama, ENT_QUOTES, "UTF-8"); ?>!
            </h1>

            <p>
                Senang melihatmu kembali di Roda Care.
                Yuk, pastikan kendaraanmu selalu dalam kondisi prima.
            </p>

            <?php if ($email !== ""): ?>
                <p>
                    Email akun:
                    <?php echo htmlspecialchars($email, ENT_QUOTES, "UTF-8"); ?>
                </p>
            <?php endif; ?>
        </section>

        <!-- Ringkasan -->
        <section class="dashboard-summary">
            <h2>Ringkasan</h2>

            <div class="dashboard-cards">

                <article class="dashboard-card">
                    <div class="dashboard-icon">🚘</div>
                    <h3>Kendaraan Saya</h3>
                    <p>Kelola informasi kendaraanmu.</p>
                    <a href="#kendaraan">Lihat kendaraan</a>
                </article>

                <article class="dashboard-card">
                    <div class="dashboard-icon">🔧</div>
                    <h3>Layanan Servis</h3>
                    <p>Temukan layanan perawatan kendaraan.</p>
                    <a href="#layanan">Lihat layanan</a>
                </article>

                <article class="dashboard-card">
                    <div class="dashboard-icon">📅</div>
                    <h3>Jadwal Servis</h3>
                    <p>Rencanakan perawatan kendaraanmu.</p>
                    <a href="#jadwal">Lihat jadwal</a>
                    <article class="dashboard-card">
    <div class="dashboard-icon">🛒</div>
    <h3>Pemesanan Produk</h3>
    <p>Lakukan pemesanan produk dan hitung total pembayaran.</p>
    <a href="pemesanan.php">Pesan Sekarang</a>
                </article>

            </div>
        </section>

        <!-- Kendaraan -->
        <section class="dashboard-section" id="kendaraan">
            <h2>Kendaraan Saya</h2>

            <div class="dashboard-info">
                <p>
                    Belum ada data kendaraan yang ditambahkan.
                </p>

                <p>
                    Fitur pengelolaan kendaraan dapat dikembangkan
                    lebih lanjut menggunakan form dan database.
                </p>
            </div>
        </section>

        <!-- Layanan -->
        <section class="dashboard-section" id="layanan">
            <h2>Layanan Roda Care</h2>

            <div class="dashboard-cards">

                <article class="dashboard-card">
                    <div class="dashboard-icon">🛢️</div>
                    <h3>Ganti Oli</h3>
                    <p>Perawatan oli untuk membantu menjaga performa mesin.</p>
                </article>

                <article class="dashboard-card">
                    <div class="dashboard-icon">🛞</div>
                    <h3>Pemeriksaan Ban</h3>
                    <p>Pemeriksaan kondisi dan tekanan ban kendaraan.</p>
                </article>

                <article class="dashboard-card">
                    <div class="dashboard-icon">🧰</div>
                    <h3>Servis Berkala</h3>
                    <p>Pemeriksaan rutin untuk menjaga kondisi kendaraan.</p>
                </article>

            </div>
        </section>

        <!-- Jadwal -->
        <section class="dashboard-section" id="jadwal">
            <h2>Jadwal Servis</h2>

            <div class="dashboard-info">
                <p>Belum ada jadwal servis yang tercatat.</p>
                <p>
                    Jadwal servis belum disimpan ke database pada
                    versi praktikum ini.
                </p>
            </div>
        </section>

        <!-- Informasi akun dan logout -->
        <section class="dashboard-account">
            <h2>Informasi Akun</h2>

            <p>
                Nama:
                <?php echo htmlspecialchars($nama, ENT_QUOTES, "UTF-8"); ?>
            </p>

            <p>
                Email:
                <?php echo htmlspecialchars($email, ENT_QUOTES, "UTF-8"); ?>
            </p>

            <a href="logout.php" class="btn btn-primary">
                Keluar dari akun
            </a>
        </section>

    </main>

    <!-- Footer -->
    <footer class="dashboard-footer">
        <p>&copy; <?php echo date("Y"); ?> Roda Care. Semua hak dilindungi.</p>
    </footer>

</body>
</html>
