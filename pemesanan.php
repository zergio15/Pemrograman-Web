
<?php
// Function untuk menghitung total harga dan diskon
function hitungTotal($jumlah, $harga) {
    $subtotal = $jumlah * $harga;

    // Diskon 10% jika subtotal di atas Rp100.000
    if ($subtotal > 100000) {
        $diskon = $subtotal * 10 / 100;
    } else {
        $diskon = 0;
    }

    $total = $subtotal - $diskon;

    return [
        "subtotal" => $subtotal,
        "diskon" => $diskon,
        "total" => $total
    ];
}

// Variabel awal
$pesan = "";
$hasil = null;

// Proses form ketika tombol diklik
if (isset($_POST['pesan'])) {

    $nama = trim($_POST['nama']);
    $produk = trim($_POST['produk']);
    $jumlah = trim($_POST['jumlah']);
    $harga = trim($_POST['harga']);

    // Validasi semua field wajib diisi
    if ($nama == "" || $produk == "" || $jumlah == "" || $harga == "") {
        $pesan = "Semua field wajib diisi!";
    }
    // Validasi jumlah harus angka dan lebih dari nol
    else if (!is_numeric($jumlah) || $jumlah <= 0) {
        $pesan = "Jumlah harus berupa angka dan lebih dari nol!";
    }
    // Validasi harga harus angka dan lebih dari nol
    else if (!is_numeric($harga) || $harga <= 0) {
        $pesan = "Harga harus berupa angka dan lebih dari nol!";
    }
    else {
        $jumlah = (int) $jumlah;
        $harga = (float) $harga;

        // Memanggil function
        $hasil = hitungTotal($jumlah, $harga);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Produk</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }

        .container {
            background: white;
            width: 550px;
            max-width: 100%;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 12px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            width: 100%;
            background: #1684d8;
            color: white;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #1684d8;
            color: white;
        }

        .error {
            color: red;
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Form Pemesanan Produk</h2>

    <form method="post" action="">

        <label>Nama Pelanggan</label>
        <input type="text" name="nama"
            value="<?php echo htmlspecialchars($_POST['nama'] ?? ''); ?>">

        <label>Nama Produk</label>
        <input type="text" name="produk"
            value="<?php echo htmlspecialchars($_POST['produk'] ?? ''); ?>">

        <label>Jumlah Produk</label>
        <input type="number" name="jumlah" min="1"
            value="<?php echo htmlspecialchars($_POST['jumlah'] ?? ''); ?>">

        <label>Harga Produk (Rp)</label>
        <input type="number" name="harga" min="1" step="any"
            value="<?php echo htmlspecialchars($_POST['harga'] ?? ''); ?>">

        <button type="submit" name="pesan">Pesan Sekarang</button>

    </form>

    <?php if ($pesan != "") { ?>
        <p class="error">
            <?php echo htmlspecialchars($pesan); ?>
        </p>
    <?php } ?>

    <?php if ($hasil != null) { ?>

        <h3>Hasil Pemesanan</h3>

        <table>
            <tr>
                <th>Keterangan</th>
                <th>Hasil</th>
            </tr>

            <tr>
                <td>Nama Pelanggan</td>
                <td><?php echo htmlspecialchars($nama); ?></td>
            </tr>

            <tr>
                <td>Nama Produk</td>
                <td><?php echo htmlspecialchars($produk); ?></td>
            </tr>

            <tr>
                <td>Jumlah</td>
                <td><?php echo $jumlah; ?></td>
            </tr>

            <tr>
                <td>Harga Satuan</td>
                <td>Rp <?php echo number_format($harga, 0, ',', '.'); ?></td>
            </tr>

            <tr>
                <td>Subtotal</td>
                <td>Rp <?php echo number_format($hasil['subtotal'], 0, ',', '.'); ?></td>
            </tr>

            <tr>
                <td>Diskon (10%)</td>
                <td>Rp <?php echo number_format($hasil['diskon'], 0, ',', '.'); ?></td>
            </tr>

            <tr>
                <th>Total Pembayaran</th>
                <th>Rp <?php echo number_format($hasil['total'], 0, ',', '.'); ?></th>
            </tr>
        </table>

    <?php } ?>

</div>

</body>
</html>
