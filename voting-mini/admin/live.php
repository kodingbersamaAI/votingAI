<?php 
include "../server/sesi.php"; 
include "../server/koneksi.php";
include "akses.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Live Perolehan Suara - VotingAI</title>

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
            Siaran ini otomatis diperbarui setiap 10 detik.<br> Keluar dari tampilan siaran live vote: <a href="hasil.php" class="btn btn-sm btn-primary">Keluar <li class="fas fa-sign-out-alt"></li></a><hr>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Pemilih</span>
                <span class="info-box-number">
                  <?php
                  // Query untuk mengambil jumlah pemilih
                  $queryJumlahPemilih = "SELECT COUNT(*) AS total_pemilih FROM pemilih";
                  $resultJumlahPemilih = $conn->query($queryJumlahPemilih);

                  if ($resultJumlahPemilih) {
                    $rowJumlahPemilih = $resultJumlahPemilih->fetch_assoc();
                    $totalPemilih = $rowJumlahPemilih['total_pemilih'];
                    echo $totalPemilih;
                  } else {
                    echo "Gagal mengambil data pemilih";
                  }
                  ?>
                  <small>Pemilih</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-plus"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Sudah Vote</span>
                <span class="info-box-number">
                  <?php
                  // Query untuk mengambil jumlah pemilih
                  $querySudahVote = "SELECT COUNT(*) AS total_pemilih FROM pemilih WHERE statusPemilih = 'Sudah Vote'";
                  $resultSudahVote = $conn->query($querySudahVote);

                  if ($resultSudahVote) {
                    $rowSudahVote = $resultSudahVote->fetch_assoc();
                    $totalPemilih = $rowSudahVote['total_pemilih'];
                    echo $totalPemilih;
                  } else {
                    echo "Gagal mengambil data pemilih";
                  }
                  ?>
                  <small>Pemilih</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-minus"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Belum Vote</span>
                <span class="info-box-number">
                  <?php
                  // Query untuk mengambil jumlah pemilih
                  $queryBelumVote = "SELECT COUNT(*) AS total_pemilih FROM pemilih WHERE statusPemilih IS NULL";
                  $resultBelumVote = $conn->query($queryBelumVote);

                  if ($resultBelumVote) {
                    $rowBelumVote = $resultBelumVote->fetch_assoc();
                    $totalPemilih = $rowBelumVote['total_pemilih'];
                    echo $totalPemilih;
                  } else {
                    echo "Gagal mengambil data pemilih";
                  }
                  ?>
                  <small>Pemilih</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <?php
          // Query untuk mengambil data dari tabel pilihan
          $queryPilihan = "SELECT * FROM pilihan";
          $resultPilihan = mysqli_query($conn, $queryPilihan);

          if ($resultPilihan->num_rows > 0) {
            echo '<div class="container">';
            echo '<div class="row justify-content-center">';
            while ($rowPilihan = $resultPilihan->fetch_assoc()) {
              echo '<div class="col-md-3 col-12">';
              echo '<div class="card">';
              echo '<div class="card-header text-center"><b>' . $rowPilihan['namaPilihan'] . '</b></div>';
              echo '<div class="card-body text-center">';
              echo '<div class="pilihan">';
              echo '<p><img src="' . $rowPilihan['fotoPilihan'] . '" style="height:250px"></p>';
              echo '</div>';

              // Query untuk mengambil data dari tabel vote sesuai dengan namaPilihan
              $namaPilihan = $rowPilihan['namaPilihan'];
              $queryVote = "SELECT COUNT(*) AS jumlah_suara FROM vote WHERE namaPilihan = '$namaPilihan'";
              $resultVote = mysqli_query($conn, $queryVote);

              if ($resultVote->num_rows > 0) {
                $rowVote = $resultVote->fetch_assoc();
                echo '<button class="btn btn-outline-primary btn-block"><h1>';
                echo '' . $rowVote['jumlah_suara'];
                echo '</h1>Jumlah Vote</button>';
              } else {
                echo '<p>Tidak ada data suara.</p>';
              }

              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
          echo '</div>';
          echo '</div>';
          } else {
            echo '<div class="container">';
            echo '<div class="row justify-content-center">';
            echo '<div class="col-md-3 col-12">';
            echo '<div class="card">';
            echo '<p>Tidak ada data pilihan.</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

          }
          ?>
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

<script>
// Fungsi untuk melakukan refresh otomatis setiap 5 detik
function refreshHalaman() {
    setTimeout(function() {
        location.reload();
    }, 10000); // 5000 milidetik = 5 detik
}

// Panggil fungsi refreshHalaman saat halaman selesai dimuat
document.addEventListener('DOMContentLoaded', function() {
    refreshHalaman();
});
</script>

<!-- /Script -->
</body>
</html>