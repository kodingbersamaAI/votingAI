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
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $idPilihan = filter_input(INPUT_POST, 'idPilihan', FILTER_SANITIZE_STRING);
    $fotoPilihan = filter_input(INPUT_POST, 'fotoPilihan', FILTER_SANITIZE_STRING);
    $namaPilihan = filter_input(INPUT_POST, 'namaPilihan', FILTER_SANITIZE_STRING);
    $kelaminPilihan = filter_input(INPUT_POST, 'kelaminPilihan', FILTER_SANITIZE_STRING);
    $lahirPilihan = filter_input(INPUT_POST, 'lahirPilihan', FILTER_SANITIZE_STRING);
    $visiPilihan = filter_input(INPUT_POST, 'visiPilihan', FILTER_SANITIZE_STRING);
    $misiPilihan = filter_input(INPUT_POST, 'misiPilihan', FILTER_SANITIZE_STRING);

    // Validasi data jika diperlukan

    // Buat query SQL untuk mengupdate data pilihan
    $query = "UPDATE pilihan SET idPilihan = ?, fotoPilihan = ?, namaPilihan = ?, kelaminPilihan = ?, lahirPilihan = ?, visiPilihan = ?, misiPilihan = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssi", $idPilihan, $fotoPilihan, $namaPilihan, $kelaminPilihan, $lahirPilihan, $visiPilihan, $misiPilihan, $id);

    if ($stmt->execute()) {
        // Pilihan berhasil diupdate, arahkan ke halaman sukses atau daftar pilihan
        header("Location: ../pilihan.php?success=upilihan");
        exit();
    } else {
        // Gagal mengupdate pilihan, tampilkan pesan kesalahan
        header("Location: ../pilihan.php?error=gupilihan");
        exit();
    }
}
?>
