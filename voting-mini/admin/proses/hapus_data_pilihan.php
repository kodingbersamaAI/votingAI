<?php
require('../../server/sesi.php');
require('../../server/koneksi.php');

// Validasi token CSRF
if (!isset($_POST['csrf_token']) || !checkCSRFToken($_POST['csrf_token'])) {
    // Token CSRF tidak valid, tindakan apa yang perlu diambil? Redirect atau tindakan lainnya.
    // Misalnya:
    header("Location: ../hapus.php?error=akses"); // Ganti dengan halaman yang sesuai
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameAdmin = filter_input(INPUT_POST, 'usernameAdmin', FILTER_SANITIZE_STRING);
    $passwordAdmin = filter_input(INPUT_POST, 'passwordAdmin', FILTER_SANITIZE_STRING);

    // Validasi data jika diperlukan

    // Cek apakah usernameAdmin yang dimasukkan sesuai dengan usernameAdmin di sesi
    if ($usernameAdmin === $_SESSION['username']) {
        // Cek apakah passwordAdmin yang dimasukkan sesuai dengan passwordAdmin di tabel admin
        $checkPasswordQuery = "SELECT passwordAdmin FROM admin WHERE usernameAdmin = ? LIMIT 1";
        $checkPasswordStmt = $conn->prepare($checkPasswordQuery);
        $checkPasswordStmt->bind_param("s", $usernameAdmin);
        $checkPasswordStmt->execute();
        $checkPasswordResult = $checkPasswordStmt->get_result();

        if ($checkPasswordResult->num_rows > 0) {
            $adminData = $checkPasswordResult->fetch_assoc();
            $hashedPasswordAdmin = $adminData['passwordAdmin'];

            // Verifikasi password
            if (password_verify($passwordAdmin, $hashedPasswordAdmin)) {
                // Jalankan query untuk mengosongkan data di tabel pemilih
                $queryEmptyPemilih = "TRUNCATE TABLE pilihan"; // Mengosongkan seluruh data di tabel pemilih
                $resultEmptyPemilih = $conn->query($queryEmptyPemilih);

                if ($resultEmptyPemilih) {
                    // Data berhasil dihapus, arahkan kembali ke halaman pemilih dengan pesan sukses
                    header("Location: ../hapus.php?success=emptydata");
                    exit();
                } else {
                    // Gagal mengosongkan data, arahkan kembali ke halaman pemilih dengan pesan kesalahan
                    header("Location: ../hapus.php?error=failedemptydata");
                    exit();
                }
            } else {
                // Password tidak sesuai, arahkan kembali ke halaman pemilih dengan pesan kesalahan
                header("Location: ../hapus.php?error=password");
                exit();
            }
        } else {
            // Tidak dapat menemukan data admin, arahkan kembali ke halaman pemilih dengan pesan kesalahan
            header("Location: ../hapus.php?error=adminnotfound");
            exit();
        }
    } else {
        // Username tidak sesuai dengan sesi, arahkan kembali ke halaman pemilih dengan pesan kesalahan
        header("Location: ../hapus.php?error=username");
        exit();
    }
}
?>
