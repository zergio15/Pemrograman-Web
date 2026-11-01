
<?php
session_start();

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION["nama_pengguna"])) {
    header("Location: login.php");
    exit;
}

// Function untuk menghitung total pembayaran
function hitungTotal($jumlah, $harga, $diskonPersen) {
    $subtotal = $jumlah * $harga;
    $diskon = $subtotal * ($diskonPersen / 100);
    $total = $subtotal - $diskon;

    return [
        "subtotal" => $subtotal,
        "diskon" => $diskon,
        "total" => $total
    ];
}

// Inisialisasi variabel
$hasil = null;
$pesan = "";

$nama_pelanggan = "";
$nama_produk = "";
$jumlah = "";
$harga = "";
$diskon = "";

// Memproses form pemesanan
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_pelanggan = trim($_POST["nama_pelanggan"] ?? "");
    $nama_produk = trim($_POST["nama_produk"] ?? "");
    $jumlah = $_POST["jumlah"] ?? "";
    $harga = $_POST["harga"] ?? "";
    $diskon = $_POST["diskon"] ?? "";

    // Validasi data kosong
    if (
        $nama_pelanggan == "" ||
        $nama_produk == "" ||
        $jumlah == "" ||
        $harga == "" ||
        $diskon == ""
    ) {
        $pesan = "Semua kolom wajib diisi!";
    }

    // Validasi angka
    elseif (
        !is_numeric($jumlah) ||
        !is_numeric($harga) ||
        !is_numeric($diskon) ||
        $jumlah <= 0 ||
        $harga <= 0 ||
        $diskon < 0 ||
        $diskon > 100 ||
        floor((float)$jumlah) != (float)$jumlah
    ) {
        $pesan = "Jumlah harus bilangan bulat positif, harga harus lebih dari 0, dan diskon antara 0 sampai 100!";
    }

    // Jika semua data valid
    else {
        $hasil = hitungTotal(
            (int)$jumlah,
            (float)$harga,
            (float)$diskon
        );
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pemesanan Produk - Roda Care</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 750px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.1);
        }

        h2 {
            color: #1d3557;
            text-align: center;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #1d3557;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #457b9d;
        }

        .pesan {
            background: #ffe5e5;
            color: #b00020;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #1d3557;
            color: white;
        }

        .total {
            font-weight: bold;
            background: #e8f1fa;
        }

        .kembali {
            display: inline-block;
            margin-top: 20px;
            color: #1d3557;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Form Pemesanan Produk</h2>

    <p>
        Selamat datang,
        <b><?php echo htmlspecialchars($_SESSION["nama_pengguna"]); ?></b>
    </p>

    <?php if ($pesan != ""): ?>
        <div class="pesan">
            <?php echo htmlspecialchars($pesan); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">

        <div class="form-group">
            <label>Nama Pelanggan</label>
            <input
                type="text"
                name="nama_pelanggan"
                value="<?php echo htmlspecialchars($nama_pelanggan); ?>"
                required>
        </div>

        <div class="form-group">
            <label>Nama Produk</label>
            <input
                type="text"
                name="nama_produk"
                value="<?php echo htmlspecialchars($nama_produk); ?>"
                required>
        </div>

        <div class="form-group">
            <label>Jumlah Pesanan</label>
            <input
                type="number"
                name="jumlah"
                min="1"
                step="1"
                value="<?php echo htmlspecialchars((string)$jumlah); ?>"
                required>
        </div>

        <div class="form-group">
            <label>Harga Produk (Rp)</label>
            <input
                type="number"
                name="harga"
                min="1"
                step="any"
                value="<?php echo htmlspecialchars((string)$harga); ?>"
                required>
        </div>

        <div class="form-group">
            <label>Diskon (%)</label>
            <input
                type="number"
                name="diskon"
                min="0"
                max="100"
                step="any"
                value="<?php echo htmlspecialchars((string)$diskon); ?>"
                required>
        </div>

        <button type="submit">Hitung Pemesanan</button>

    </form>

    <?php if ($hasil !== null): ?>

        <h2>Hasil Pemesanan</h2>

        <table>
            <tr>
                <th>Keterangan</th>
                <th>Hasil</th>
            </tr>

            <tr>
                <td>Nama Pelanggan</td>
                <td><?php echo htmlspecialchars($nama_pelanggan); ?></td>
            </tr>

            <tr>
                <td>Nama Produk</td>
                <td><?php echo htmlspecialchars($nama_produk); ?></td>
            </tr>

            <tr>
                <td>Jumlah</td>
                <td><?php echo htmlspecialchars((string)$jumlah); ?></td>
            </tr>

            <tr>
                <td>Harga Satuan</td>
                <td>
                    Rp <?php echo number_format($harga, 0, ',', '.'); ?>
                </td>
            </tr>

            <tr>
                <td>Subtotal</td>
                <td>
                    Rp <?php echo number_format($hasil["subtotal"], 0, ',', '.'); ?>
                </td>
            </tr>

            <tr>
                <td>Diskon (<?php echo htmlspecialchars((string)$diskon); ?>%)</td>
                <td>
                    Rp <?php echo number_format($hasil["diskon"], 0, ',', '.'); ?>
                </td>
            </tr>

            <tr class="total">
                <td>Total Pembayaran</td>
                <td>
                    Rp <?php echo number_format($hasil["total"], 0, ',', '.'); ?>
                </td>
            </tr>
        </table>

    <?php endif; ?>

    <a href="dashboard.php" class="kembali">
        ← Kembali ke Dashboard
    </a>

</div>

</body>
</html>
