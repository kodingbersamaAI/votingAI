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
  <title>Pemilih - VotingAI</title>

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
            <div class="card">
              <div class="card-header">
                Daftar Pemilih
              </div>
              <div class="card-body">
                <table id="pemilihTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>ID</th>
                      <th>L/P</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
                  // Ambil daftar pemilih dari database
                  $queryPemilih = "SELECT * FROM pemilih";
                  $resultPemilih = mysqli_query($conn, $queryPemilih);

                  if ($resultPemilih->num_rows > 0) {
                    while ($row = $resultPemilih->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row["namaPemilih"] . "</td>";
                      echo "<td>" . $row["idPemilih"] . "</td>";
                      echo "<td>" . $row["kelaminPemilih"] . "</td>";
                      echo "<td><a href='pemilih.php?id=" . $row['idPemilih'] . "' class='btn btn-sm btn-success'><li class='fas fa-edit'></li></a> <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modalDelete" . $row["idPemilih"] . "' alt='Hapus Data Pengguna'><i class='fas fa-trash'></i></button></td>";
                      echo "</tr>";
                      // Modal untuk Hapus Data Pengguna
                      echo "<div class='modal fade' tabindex='-1' role='dialog' aria-hidden='true' id='modalDelete" . $row["idPemilih"] . "'>
                      <div class='modal-dialog modal-dialog-centered'>
                        <div class='modal-content'>
                          <div class='modal-header'>
                            <div class='modal-title'>Hapus Data</div>
                          </div>
                          <div class='modal-body'>
                            <form action='proses/hapus_pemilih.php' method='POST'>
                            <div class='form-group'>
                              <input type='hidden' name='csrf_token' readonly value= '" . generateCSRFToken() . "'>
                              <input type='hidden' class='form-control' id='idPemilih' name='idPemilih' value='" . $row["idPemilih"] . "'>
                              <p>Anda akan menghapus data: <b>" . $row["namaPemilih"] . "</b><p>
                              
                            </div>
                              <button type='submit' class='btn btn-danger btn-sm'>Hapus</button>
                              <button type='button' class='btn btn-secondary btn-sm' data-dismiss='modal'>Batal</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>";
                    }
                  } else {
                      echo '<tr><td colspan="4">Tidak ada data.</td></tr>';
                  }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="card">
              <div class="card-header">
                Import Pemilih <a href="templateImportPemilih.xlsx" class="btn btn-xs btn-success"><li class="fas fa-download"></li> Unduh Template</a>
              </div>
              <div class="card-body">
                <form action="proses/import_pemilih.php" method="POST">
                  <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                  <div class="form-group">
                  <input type="file" name="importPemilih">
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary">Import Data</button>
                </form>
                <br>
                <p><b>Catatan:</b> Belum Berfungsi</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="card">
              <div class="card-header">
                Random Akun Pemilih
              </div>
              <div class="card-body">
                <form action="proses/random_pemilih.php" method="POST" target="_blank">
                  <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                  <div class="form-group">
                    <label>Jenis Kelamin Pemilih:</label>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="kelaminL" name="kelaminPemilih" value="L">
                      <label class="form-check-label" for="kelaminL">Laki-laki</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="kelaminP" name="kelaminPemilih" value="P">
                      <label class="form-check-label" for="kelaminP">Perempuan</label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary">Buat Akun</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="card">
              <div class="card-header">
                Tambah Pemilih
              </div>
              <div class="card-body">
                <form action="proses/tambah_pemilih.php" method="POST">
                  <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                  <div class="form-group">
                    <label for="idPemilih">ID Pemilih:</label>
                    <input type="text" class="form-control" id="idPemilih" name="idPemilih" required>
                  </div>
                  <div class="form-group">
                    <label for="passwordPemilih">Password Pemilih:</label>
                    <input type="text" class="form-control" id="passwordPemilih" name="passwordPemilih" required>
                  </div>
                  <div class="form-group">
                    <label for="namaPemilih">Nama Pemilih:</label>
                    <input type="text" class="form-control" id="namaPemilih" name="namaPemilih" required>
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin Pemilih:</label>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="kelaminL" name="kelaminPemilih" value="L">
                      <label class="form-check-label" for="kelaminL">Laki-laki</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="kelaminP" name="kelaminPemilih" value="P">
                      <label class="form-check-label" for="kelaminP">Perempuan</label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary">Tambah Data</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="card">
              <div class="card-header">
                Edit Pemilih
              </div>
              <div class="card-body">
                <?php
                // Periksa apakah parameter id ada pada URL
                if (isset($_GET['id'])) {
                    $idPemilih = $_GET['id'];

                    // Query untuk mengambil data pemilih berdasarkan id
                    $queryEditPemilih = "SELECT * FROM pemilih WHERE idPemilih = '$idPemilih'";
                    $resultEditPemilih = mysqli_query($conn, $queryEditPemilih);

                    // Periksa apakah data pemilih ditemukan
                    if (mysqli_num_rows($resultEditPemilih) > 0) {
                        $dataEditPemilih = mysqli_fetch_assoc($resultEditPemilih);
                ?>
                <form action="proses/edit_pemilih.php" method="POST">
                  <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                  <input type="hidden" name="id" value="<?php echo $dataEditPemilih['id']; ?>">
                  <div class="form-group">
                    <label for="idPemilih">ID Pemilih:</label>
                    <input type="text" class="form-control" id="idPemilih" name="idPemilih" value="<?php echo $dataEditPemilih['idPemilih']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="passwordPemilih">Password Pemilih:</label>
                    <input type="text" class="form-control" id="passwordPemilih" name="passwordPemilih">
                  </div>
                  <div class="form-group">
                    <label for="namaPemilih">Nama Pemilih:</label>
                    <input type="text" class="form-control" id="namaPemilih" name="namaPemilih" value="<?php echo $dataEditPemilih['namaPemilih']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin Pemilih:</label>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="EditkelaminL" name="kelaminPemilih" value="L" <?php echo ($dataEditPemilih["kelaminPemilih"] == 'L') ? 'checked' : ''; ?>>
                      <label class="form-check-label" for="EditkelaminL">Laki-laki</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="EditkelaminP" name="kelaminPemilih" value="P" <?php echo ($dataEditPemilih["kelaminPemilih"] == 'P') ? 'checked' : ''; ?>>
                      <label class="form-check-label" for="EditkelaminP">Perempuan</label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                </form>
                <?php
                  } else {
                      // Jika data pemilih tidak ditemukan
                      ?>
                      <p>Tidak ada data pemilih yang ditemukan untuk ID: <b><?php echo $idPemilih; ?></b></p>
                      <?php
                  }
              } else {
                  // Jika parameter username tidak ada
                  ?>
                  <p>Tidak ada data yang dipilih.</p>
                  <?php
              }
              ?>
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

<script>
  $(function () {
    $("#pemilihTable").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#pemilihTable_wrapper .col-md-6:eq(0)');
  });
</script>

<!-- /Script -->
</body>
</html>