<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit;
}

$nama = trim($_POST["nama"] ?? "");
$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if (
    $nama === "" ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    strlen($password) < 6
) {
    echo "<script>
        alert('Data login tidak valid!');
        window.location.href = 'login.php';
    </script>";
    exit;
}

// Membuat session
session_regenerate_id(true);

$_SESSION["nama_pengguna"] = $nama;
$_SESSION["email"] = $email;

// Masuk dashboard
header("Location: dashboard.php");
exit;
?>