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
    $idPemilih = filter_input(INPUT_POST, 'idPemilih', FILTER_SANITIZE_STRING);

    // Validasi data jika diperlukan


    // Buat query SQL untuk menambahkan pemilih baru
    $query = "DELETE FROM pemilih WHERE idPemilih = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $idPemilih);

    if ($stmt->execute()) {
        // Pengguna berhasil ditambahkan, arahkan ke halaman sukses atau daftar pemilih
        header("Location: ../pemilih.php?success=hpemilih"); // Ganti dengan halaman yang sesuai
        exit();
    } else {
        // Gagal menambahkan pemilih, tampilkan pesan kesalahan
        header("Location: ../pemilih.php?error=ghpemilih");
        exit();
    }

}
?>
