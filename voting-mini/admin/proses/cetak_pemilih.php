<?php
require('../../server/sesi.php');
require('../../server/koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Pemilih - VotingAI</title>
</head>

<body onload="window.print()">

<?php
// Ambil ID Pemilih dari parameter URL
$idPemilih = $_GET['id'];

// Query untuk mengambil data pemilih berdasarkan ID
$query = "SELECT * FROM pemilih WHERE idPemilih = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $idPemilih);
$stmt->execute();
$result = $stmt->get_result();

// Cetak atau tampilkan data sesuai kebutuhan di sini
while ($row = $result->fetch_assoc()) {
    echo "<p><b>Username:</b> " . $row['idPemilih'] . "<br></p>";
    echo "<p><b>Password:</b> " . $row['idPemilih'] . "<br></p>";
    // Tambahkan informasi lain sesuai kebutuhan
}

?>

</body>
</html>