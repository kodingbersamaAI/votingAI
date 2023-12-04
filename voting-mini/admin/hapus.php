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
  <title>Hapus Data - VotingAI</title>

  <?php include "../universal/head.php" ?>

</head>
<body class="hold-transition sidebar-mini layout-footer-fixed layout-navbar-fixed layout-fixed">
<div class="wrapper">

  <?php include "navbar.php" ?>
  <?php include "sidebar.php" ?>
  

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
            <b>Perhatian:</b> Menu ini digunakan untuk menghapus data dari aplikasi votingAI. Gunakan dengan hati-hati. <hr>
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Database Pemilih</span>
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
                  <small>Data Pemilih</small><br><br>
                  <form action="proses/hapus_data_pemilih.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    <input type="hidden" name="usernameAdmin" value="<?php echo $_SESSION['username']; ?>">
                    <div class="form-group">
                      <label for="passwordAdmin">Masukkan Password:</label>
                      <input type="text" class="form-control" id="passwordAdmin" name="passwordAdmin" required>
                    </div>
                    <button type="submit" class="btn btn-sm btn-danger">Hapus Data Pemilih</button>
                  </form>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Database pilihan</span>
                <span class="info-box-number">
                  <?php
                  // Query untuk mengambil jumlah pemilih
                  $querySudahVote = "SELECT COUNT(*) AS total_pemilih FROM pilihan";
                  $resultSudahVote = $conn->query($querySudahVote);

                  if ($resultSudahVote) {
                    $rowSudahVote = $resultSudahVote->fetch_assoc();
                    $totalPemilih = $rowSudahVote['total_pemilih'];
                    echo $totalPemilih;
                  } else {
                    echo "Gagal mengambil data pemilih";
                  }
                  ?>
                  <small>Data Pilihan</small><br><br>
                  <form action="proses/hapus_data_pilihan.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    <input type="hidden" name="usernameAdmin" value="<?php echo $_SESSION['username']; ?>">
                    <div class="form-group">
                      <label for="passwordAdmin">Masukkan Password:</label>
                      <input type="text" class="form-control" id="passwordAdmin" name="passwordAdmin" required>
                    </div>
                    <button type="submit" class="btn btn-sm btn-danger">Hapus Data Pilihan</button>
                  </form>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-chart-bar"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Database Vote</span>
                <span class="info-box-number">
                  <?php
                  // Query untuk mengambil jumlah pemilih
                  $queryBelumVote = "SELECT COUNT(*) AS total_pemilih FROM vote";
                  $resultBelumVote = $conn->query($queryBelumVote);

                  if ($resultBelumVote) {
                    $rowBelumVote = $resultBelumVote->fetch_assoc();
                    $totalPemilih = $rowBelumVote['total_pemilih'];
                    echo $totalPemilih;
                  } else {
                    echo "Gagal mengambil data pemilih";
                  }
                  ?>
                  <small>Data Vote</small><br><br>
                  <form action="proses/hapus_data_vote.php" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    <input type="hidden" name="usernameAdmin" value="<?php echo $_SESSION['username']; ?>">
                    <div class="form-group">
                      <label for="passwordAdmin">Masukkan Password:</label>
                      <input type="text" class="form-control" id="passwordAdmin" name="passwordAdmin" required>
                    </div>
                    <button type="submit" class="btn btn-sm btn-danger">Hapus Data Vote</button>
                  </form>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
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