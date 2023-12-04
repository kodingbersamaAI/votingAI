<?php
require('../../server/sesi.php');
require('../../server/koneksi.php');

// Validasi token CSRF
if (!isset($_POST['csrf_token']) || !checkCSRFToken($_POST['csrf_token'])) {
    // Token CSRF tidak valid, tindakan apa yang perlu diambil? Redirect atau tindakan lainnya.
    // Misalnya:
    header("Location: ../pemilih.php?error=akses"); // Ganti dengan halaman yang sesuai
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $idPemilih = filter_input(INPUT_POST, 'idPemilih', FILTER_SANITIZE_STRING);
    $passwordPemilih = filter_input(INPUT_POST, 'passwordPemilih', FILTER_SANITIZE_STRING);
    $namaPemilih = filter_input(INPUT_POST, 'namaPemilih', FILTER_SANITIZE_STRING);
    $kelaminPemilih = filter_input(INPUT_POST, 'kelaminPemilih', FILTER_SANITIZE_STRING);

    // Validasi data jika diperlukan

    // Hash password Pemilih
    $hashedPasswordPemilih = password_hash($passwordPemilih, PASSWORD_DEFAULT);

    // Buat query SQL untuk mengupdate data pemilih baru
    $query = "UPDATE pemilih SET idPemilih = ?, passwordPemilih = ?, namaPemilih = ?, kelaminPemilih = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $idPemilih, $hashedPasswordPemilih, $namaPemilih, $kelaminPemilih, $id);

    if ($stmt->execute()) {
        // Pemilih berhasil diupdate, arahkan ke halaman sukses atau daftar pemilih
        header("Location: ../pemilih.php?success=upemilih");
        exit();
    } else {
        // Gagal mengupdate pemilih, tampilkan pesan kesalahan
        header("Location: ../pemilih.php?error=gupemilih");
        exit();
    }

}
?>
