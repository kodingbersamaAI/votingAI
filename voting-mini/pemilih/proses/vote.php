<?php
require('../../server/sesi.php');
require('../../server/koneksi.php');

// Validasi token CSRF
if (!isset($_POST['csrf_token']) || !checkCSRFToken($_POST['csrf_token'])) {
    // Token CSRF tidak valid, tindakan apa yang perlu diambil? Redirect atau tindakan lainnya.
    // Misalnya:
    header("Location: ../vote.php?error=akses"); // Ganti dengan halaman yang sesuai
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPemilih = filter_input(INPUT_POST, 'idPemilih', FILTER_SANITIZE_STRING);
    $namaPilihan = filter_input(INPUT_POST, 'namaPilihan', FILTER_SANITIZE_STRING);    

    // Validasi data jika diperlukan

    // Buat query SQL untuk menambahkan vote
    $insertQuery = "INSERT INTO vote (idPemilih, namaPilihan) VALUES (?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("ss", $idPemilih, $namaPilihan);

    // Buat query SQL untuk mengupdate statusPemilih menjadi 'Sudah Vote'
    $updateQuery = "UPDATE pemilih SET statusPemilih = 'Sudah Vote' WHERE idPemilih = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("s", $idPemilih);

    if ($insertStmt->execute()) {
        // Tugas berhasil ditambahkan, arahkan ke halaman vote.php dengan parameter success=uvote
        // Selanjutnya, lakukan update statusPemilih
        $updateStmt->execute();

        header("Location: ../vote.php?success=uvote");
        exit();
    } else {
        // Gagal menambahkan vote, arahkan ke halaman vote.php dengan parameter error=guvote
        header("Location: ../vote.php?error=guvote");
        exit();
    }
}
?>