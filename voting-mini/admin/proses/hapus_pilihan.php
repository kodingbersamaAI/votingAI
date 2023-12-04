<?php
require('../../server/sesi.php');
require('../../server/koneksi.php');

// Validasi token CSRF
if (!isset($_POST['csrf_token']) || !checkCSRFToken($_POST['csrf_token'])) {
    // Token CSRF tidak valid, tindakan apa yang perlu diambil? Redirect atau tindakan lainnya.
    // Misalnya:
    header("Location: ../pilihan.php?error=akses"); // Ganti dengan halaman yang sesuai
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPilihan = filter_input(INPUT_POST, 'idPilihan', FILTER_SANITIZE_STRING);

    // Validasi data jika diperlukan


    // Buat query SQL untuk menambahkan pilihan baru
    $query = "DELETE FROM pilihan WHERE idPilihan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $idPilihan);

    if ($stmt->execute()) {
        // Pengguna berhasil ditambahkan, arahkan ke halaman sukses atau daftar pilihan
        header("Location: ../pilihan.php?success=hpilihan"); // Ganti dengan halaman yang sesuai
        exit();
    } else {
        // Gagal menambahkan pilihan, tampilkan pesan kesalahan
        header("Location: ../pilihan.php?error=ghpilihan");
        exit();
    }

}
?>
