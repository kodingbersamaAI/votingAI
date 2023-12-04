<?php 
include "../server/sesi.php"; 
include "../server/koneksi.php";
include "akses.php";

if (isset($_SESSION['id'])) {
  $idPemilih = $_SESSION['id'];

  // Query untuk mengecek statusPemilih dari tabel pemilih
  $query = "SELECT statusPemilih FROM pemilih WHERE idPemilih = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $idPemilih);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $statusPemilih = $row['statusPemilih'];

    // Periksa statusPemilih, jika sudah vote tampilkan alert dan redirect
    if ($statusPemilih == 'Sudah Vote') {
      echo '<script>alert("Terima Kasih, Anda sudah melakukan vote.");</script>';
      echo '<script>window.location.href = "../server/logout.php";</script>';
      exit();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Konfirmasi Vote - VotingAI</title>

  <?php include "../universal/head.php" ?>

</head>
<body class="hold-transition layout-top-nav layout-fixed">
<div class="wrapper">  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h2>Selamat Datang, <?php echo $_SESSION['nama'] ?></h2>
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                Petunjuk Vote
              </div>
              <div class="card-body">
                <p>1. Pastikan nama yang tertera di atas adalah nama Anda.</p>
                <p>2. Pilih kandidat yang Anda dukung dari daftar yang disediakan.</p>
                <p>3. Setelah memilih, periksa kembali pilihan Anda sebelum mengirim vote.</p>
                <p>4. Klik tombol "Kirim Vote" untuk mengirimkan suara Anda.</p>
                <p>5. Hasil voting sementara dapat Anda lihat setelah mengirimkan vote.</p>
                <p>6. Hasil voting akhir / final akan ditampilkan oleh panitia.</p>
              </div>
              <div class="card-body text-center">
                <a href="vote.php" class="btn btn-primary">Mulai Vote!</a>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Footer -->

  <?php include "../universal/footer.php" ?>

  <!-- /Footer -->

</div>
<!-- ./wrapper -->

<!-- Script -->

<?php include "../universal/script.php" ?>

<!-- /Script -->
</body>
</html>