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
  <title>Vote - VotingAI</title>

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
          <div class="col-12 text-center">
            <h4>Anda akan voting atas nama: <br><?php echo $_SESSION['nama'] ?></h4><br>
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
              echo '<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalDetail' . $rowPilihan["idPilihan"] . '" alt="Detail Visi & Misi">Visi dan Misi</button>';
              // Modal untuk Detail Visi & Misi
              echo "<div class='modal fade' tabindex='-1' role='dialog' aria-hidden='true' id='modalDetail" . $rowPilihan["idPilihan"] . "'>
                <div class='modal-dialog modal-dialog-centered'>
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <div class='modal-title'>Visi & Misi <b>" . $rowPilihan['namaPilihan'] . "</b></div>
                    </div>
                    <div class='modal-body text-justify'>
                      <b>Visi:</b>
                      <p>" . nl2br($rowPilihan["visiPilihan"]) . "</p>
                      <b>Misi:</b>
                      <p>" . nl2br($rowPilihan["misiPilihan"]) . "</p>
                    </div>
                    <div class='modal-footer'>
                    <button type='button' class='btn btn-danger btn-sm' data-dismiss='modal'>Tutup</button>
                    </div>
                  </div>
                </div>
              </div>";
              echo '<br><br>';
              echo '<form id="form-vote" action="proses/vote.php" method="POST">';
              echo '<input type="hidden" name="csrf_token" value="' . generateCSRFToken() . '">';
              echo '<input type="hidden" name="idPemilih" value="' . $_SESSION["id"] . '">';
              echo '<input type="hidden" name="namaPilihan" value="' . $rowPilihan['namaPilihan'] . '">';
              echo '<button type="button" class="btn btn-outline-primary btn-block" onclick="konfirmasiPilih()"><h2>Pilih</h2></button>';
              echo '</form>';

              echo '</form>';
              echo '</div>';
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
function konfirmasiPilih() {
    if (confirm('Apakah Anda yakin ingin memilih kandidat ini?')) {
        document.getElementById('form-vote').submit();
    } else {
        // Pilihan batal, tidak melakukan apa-apa
    }
}
</script>

<!-- /Script -->
</body>
</html>