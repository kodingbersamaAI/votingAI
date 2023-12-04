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
  <title>Pilihan - VotingAI</title>

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
                Daftar Pilihan
              </div>
              <div class="card-body">
                <table id="pilihanTable" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Foto</th>
                      <th>Nama</th>
                      <th>L/P</th>
                      <th>Tanggal Lahir</th>
                      <th>Visi & Misi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
                  // Ambil daftar pilihan dari database
                  $queryPilihan = "SELECT * FROM pilihan";
                  $resultPilihan = mysqli_query($conn, $queryPilihan);

                  if ($resultPilihan->num_rows > 0) {
                    while ($row = $resultPilihan->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row["idPilihan"] . "</td>";
                      echo "<td><img src='" . $row["fotoPilihan"] . "' alt='Foto Pilihan' style='height:200px'></td>";
                      echo "<td>" . $row["namaPilihan"] . "</td>";
                      echo "<td>" . $row["kelaminPilihan"] . "</td>";
                      echo "<td>" . date("j F Y", strtotime($row["lahirPilihan"])) . "</td>";
                      echo "<td><button type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#modalDetail" . $row["idPilihan"] . "' alt='Detail Visi & Misi'><i class='fas fa-eye'></i></button></td>";
                      echo "<td><a href='pilihan.php?id=" . $row['idPilihan'] . "' class='btn btn-sm btn-success'><li class='fas fa-edit'></li></a> <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modalDelete" . $row["idPilihan"] . "' alt='Hapus Data Pengguna'><i class='fas fa-trash'></i></button></td>";
                      echo "</tr>";
                      // Modal untuk Hapus Data Pengguna
                      echo "<div class='modal fade' tabindex='-1' role='dialog' aria-hidden='true' id='modalDelete" . $row["idPilihan"] . "'>
                        <div class='modal-dialog modal-dialog-centered'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <div class='modal-title'>Hapus Data</div>
                            </div>
                            <div class='modal-body'>
                              <form action='proses/hapus_pilihan.php' method='POST'>
                              <div class='form-group'>
                                <input type='hidden' name='csrf_token' readonly value= '" . generateCSRFToken() . "'>
                                <input type='hidden' class='form-control' id='idPilihan' name='idPilihan' value='" . $row["idPilihan"] . "'>
                                <p>Anda akan menghapus data: <b>" . $row["namaPilihan"] . "</b><p>
                                
                              </div>
                                <button type='submit' class='btn btn-danger btn-sm'>Hapus</button>
                                <button type='button' class='btn btn-secondary btn-sm' data-dismiss='modal'>Batal</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>";
                      // Modal untuk Detail Visi & Misi
                      echo "<div class='modal fade' tabindex='-1' role='dialog' aria-hidden='true' id='modalDetail" . $row["idPilihan"] . "'>
                        <div class='modal-dialog modal-dialog-centered'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <div class='modal-title'>Visi & Misi <b>" . $row["namaPilihan"] . "</b></div>
                            </div>
                            <div class='modal-body'>
                              <b>Visi:</b>
                              <p>" . nl2br($row["visiPilihan"]) . "</p>
                              <b>Misi:</b>
                              <p>" . nl2br($row["misiPilihan"]) . "</p>
                            </div>
                            <div class='modal-footer'>
                            <button type='button' class='btn btn-danger btn-sm' data-dismiss='modal'>Tutup</button>
                            </div>
                          </div>
                        </div>
                      </div>";
                    }
                  } else {
                      echo '<tr><td colspan="7">Tidak ada data.</td></tr>';
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
                Tambah Pilihan
              </div>
              <div class="card-body">
                <form action="proses/tambah_pilihan.php" method="POST">
                  <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                  <div class="form-group">
                    <label for="idPilihan">ID Pilihan:</label>
                    <input type="text" class="form-control" id="idPilihan" name="idPilihan" required>
                  </div>
                  <div class="form-group">
                    <label for="fotoPilihan">Foto Pilihan:</label>
                    <input type="text" class="form-control" id="fotoPilihan" name="fotoPilihan" required>
                  </div>
                  <div class="form-group">
                    <label for="namaPilihan">Nama Pilihan:</label>
                    <input type="text" class="form-control" id="namaPilihan" name="namaPilihan" required>
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin Pilihan:</label>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="kelaminL" name="kelaminPilihan" value="L">
                      <label class="form-check-label" for="kelaminL">Laki-laki</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="kelaminP" name="kelaminPilihan" value="P">
                      <label class="form-check-label" for="kelaminP">Perempuan</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lahirPilihan">Tanggal Lahir Pilihan:</label>
                    <input type="date" class="form-control" id="lahirPilihan" name="lahirPilihan" required>
                  </div>
                  <div class="form-group">
                    <label for="visiPilihan">Visi Pilihan:</label>
                    <textarea class="form-control" id="visiPilihan" name="visiPilihan" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="misiPilihan">Misi Pilihan:</label>
                    <textarea class="form-control" id="misiPilihan" name="misiPilihan" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary">Tambah Data</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="card">
              <div class="card-header">
                Edit Pilihan
              </div>
              <div class="card-body">
                <?php
                // Periksa apakah parameter id ada pada URL
                if (isset($_GET['id'])) {
                    $idPilihan = $_GET['id'];

                    // Query untuk mengambil data pilihan berdasarkan id
                    $queryEditPilihan = "SELECT * FROM pilihan WHERE idPilihan = '$idPilihan'";
                    $resultEditPilihan = mysqli_query($conn, $queryEditPilihan);

                    // Periksa apakah data pilihan ditemukan
                    if (mysqli_num_rows($resultEditPilihan) > 0) {
                        $dataEditPilihan = mysqli_fetch_assoc($resultEditPilihan);
                ?>
                <form action="proses/edit_pilihan.php" method="POST">
                  <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                  <input type="hidden" name="id" value="<?php echo $dataEditPilihan['id']; ?>">
                  <div class="form-group">
                    <label for="idPilihan">ID Pilihan:</label>
                    <input type="text" class="form-control" id="idPilihan" name="idPilihan" value="<?php echo $dataEditPilihan['idPilihan']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="fotoPilihan">Foto Pilihan:</label>
                    <input type="text" class="form-control" id="fotoPilihan" name="fotoPilihan" value="<?php echo $dataEditPilihan['fotoPilihan']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="namaPilihan">Nama Pilihan:</label>
                    <input type="text" class="form-control" id="namaPilihan" name="namaPilihan" value="<?php echo $dataEditPilihan['namaPilihan']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin Pilihan:</label>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="EditkelaminL" name="kelaminPilihan" value="L" <?php echo ($dataEditPilihan["kelaminPilihan"] == 'L') ? 'checked' : ''; ?>>
                      <label class="form-check-label" for="EditkelaminL">Laki-laki</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" id="EditkelaminP" name="kelaminPilihan" value="P" <?php echo ($dataEditPilihan["kelaminPilihan"] == 'P') ? 'checked' : ''; ?>>
                      <label class="form-check-label" for="EditkelaminP">Perempuan</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lahirPilihan">Nama Pilihan:</label>
                    <input type="date" class="form-control" id="lahirPilihan" name="lahirPilihan" value="<?php echo $dataEditPilihan['lahirPilihan']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="visiPilihan">Visi Pilihan:</label>
                    <textarea class="form-control" id="visiPilihan" name="visiPilihan" required><?php echo $dataEditPilihan['visiPilihan']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="misiPilihan">Misi Pilihan:</label>
                    <textarea class="form-control" id="misiPilihan" name="misiPilihan" required><?php echo $dataEditPilihan['misiPilihan']; ?></textarea>
                  </div>
                  <button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
                </form>
                <?php
                  } else {
                      // Jika data pilihan tidak ditemukan
                      ?>
                      <p>Tidak ada data pilihan yang ditemukan untuk ID: <b><?php echo $idPilihan; ?></b></p>
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
    $("#pilihanTable").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#pilihanTable_wrapper .col-md-6:eq(0)');
  });
</script>

<!-- /Script -->
</body>
</html>