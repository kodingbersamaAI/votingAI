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
    $fotoPilihan = filter_input(INPUT_POST, 'fotoPilihan', FILTER_SANITIZE_STRING);
    $namaPilihan = filter_input(INPUT_POST, 'namaPilihan', FILTER_SANITIZE_STRING);
    $kelaminPilihan = filter_input(INPUT_POST, 'kelaminPilihan', FILTER_SANITIZE_STRING);
    $lahirPilihan = filter_input(INPUT_POST, 'lahirPilihan', FILTER_SANITIZE_STRING);
    $visiPilihan = filter_input(INPUT_POST, 'visiPilihan', FILTER_SANITIZE_STRING);
    $misiPilihan = filter_input(INPUT_POST, 'misiPilihan', FILTER_SANITIZE_STRING);

    // Validasi data jika diperlukan

    // Cek apakah ID Pilihan sudah ada dalam database
    $checkQuery = "SELECT idPilihan FROM pilihan WHERE idPilihan = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $idPilihan);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        // ID Pilihan sudah ada, arahkan dengan pesan kesalahan
        header("Location: ../pilihan.php?error=idpilihan");
        exit();
    }

    // Buat query SQL untuk menambahkan data pilihan baru
    $query = "INSERT INTO pilihan (idPilihan, fotoPilihan, namaPilihan, kelaminPilihan, lahirPilihan, visiPilihan, misiPilihan) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $idPilihan, $fotoPilihan, $namaPilihan, $kelaminPilihan, $lahirPilihan, $visiPilihan, $misiPilihan);

    if ($stmt->execute()) {
        // Pilihan berhasil ditambahkan, arahkan ke halaman sukses atau daftar pilihan
        header("Location: ../pilihan.php?success=tpilihan");
        exit();
    } else {
        // Gagal menambahkan pilihan, tampilkan pesan kesalahan
        header("Location: ../pilihan.php?error=gpilihan");
        exit();
    }
}
?>
