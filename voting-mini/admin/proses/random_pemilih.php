<?php
require('../../server/sesi.php');
require('../../server/koneksi.php');

// Validasi token CSRF
if (!isset($_POST['csrf_token']) || !checkCSRFToken($_POST['csrf_token'])) {
    // Token CSRF tidak valid, tindakan apa yang perlu diambil? Redirect atau tindakan lainnya.
    // Misalnya:
    header("Location: ../pemilih.php?error=akses");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil kelaminPemilih dari formulir
    $kelaminPemilih = filter_input(INPUT_POST, 'kelaminPemilih', FILTER_SANITIZE_STRING);

    // Generate ID Pemilih secara otomatis (misalnya, menggunakan timestamp)
    $idPemilih = $kelaminPemilih . time();

    // Generate Nama Pemilih sama dengan ID Pemilih
    $namaPemilih = "Pemilih-" . uniqid();

    // Generate Password Pemilih sama dengan ID Pemilih
    $passwordPemilih = $idPemilih;

    // Validasi data jika diperlukan

    // Cek apakah ID Pemilih sudah ada dalam database
    $checkQuery = "SELECT idPemilih FROM pemilih WHERE idPemilih = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $idPemilih);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // ID Pemilih sudah ada, arahkan dengan pesan kesalahan
        header("Location: ../pemilih.php?error=idpemilih");
        exit();
    }

    // Hash password Pemilih
    $hashedPasswordPemilih = password_hash($passwordPemilih, PASSWORD_DEFAULT);

    // Buat query SQL untuk menambahkan data pemilih baru
    $query = "INSERT INTO pemilih (idPemilih, passwordPemilih, namaPemilih, kelaminPemilih) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $idPemilih, $hashedPasswordPemilih, $namaPemilih, $kelaminPemilih);

    if ($stmt->execute()) {
        // Pemilih berhasil ditambahkan, arahkan ke halaman sukses atau daftar pemilih
        header("Location: cetak_pemilih.php?id={$idPemilih}");
        exit();
    } else {
        // Gagal menambahkan pemilih, tampilkan pesan kesalahan
        header("Location: ../pemilih.php?error=gpemilih");
        exit();
    }
}
?>
