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

// Mengecek apakah file yang diunggah adalah file Excel
if ($_FILES['importPemilih']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['importPemilih']['tmp_name'])) {
    $fileName = $_FILES['importPemilih']['name'];
    $fileTmpName = $_FILES['importPemilih']['tmp_name'];
    $fileSize = $_FILES['importPemilih']['size'];
    $fileType = $_FILES['importPemilih']['type'];
    
    // Cek apakah file adalah file Excel
    $allowedExtensions = array("xls", "xlsx");
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        // Lakukan proses impor disini
        // Anda dapat menggunakan library pihak ketiga seperti PHPExcel atau PhpSpreadsheet untuk membantu proses impor Excel.
        // Pastikan untuk mengatur library ini sebelum menggunakan kode di bawah ini.

        // Contoh menggunakan PhpSpreadsheet:
        // require 'vendor/autoload.php'; // Sesuaikan dengan lokasi library

        // $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileTmpName);
        // $worksheet = $spreadsheet->getActiveSheet();
        // ...

        // Setelah berhasil diimpor, arahkan ke halaman sukses atau halaman pemilih
        header("Location: ../pemilih.php?success=pimport");
        exit();
    } else {
        // File yang diunggah bukan file Excel, arahkan dengan pesan kesalahan
        header("Location: ../pemilih.php?error=ifimport");
        exit();
    }
} else {
    // Terjadi kesalahan saat mengunggah file, arahkan dengan pesan kesalahan
    header("Location: ../pemilih.php?error=efimport");
    exit();
}
?>
