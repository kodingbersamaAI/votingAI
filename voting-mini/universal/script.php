<!-- jQuery -->
<script src="../../adminlte/plugins/jquery/jquery.min.js"></script>
<script src="../../adminlte/plugins/jquery/jquery.link.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../adminlte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../adminlte/plugins/moment/moment.min.js"></script>
<script src="../../adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../adminlte/js/adminlte.js"></script>
<!-- SweetAlert2 -->
<script src="../../adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
  $(document).ready(function() {
    var successMessages = {
      'tpemilih': 'Data Pemilih berhasil ditambahkan.',
      'upemilih': 'Data Pemilih berhasil diperbarui.',
      'hpemilih': 'Data Pemilih berhasil dihapus.',
      'tpilihan': 'Data Pilihan berhasil ditambahkan.',
      'upilihan': 'Data Pilihan berhasil diperbarui.',
      'hpilihan': 'Data Pilihan berhasil dihapus.',
      'pimport': 'Data Pemilih berhasil diimport.',
      'emptydata': 'Data berhasil dikosongkan.'
    };

    var errorMessages = {
      'peran': 'Peran tidak ditemukan.',
      'password': 'Password Anda salah',
      'username': 'Username Anda salah.',
      'akses': 'Anda tidak memiliki akses.',
      'gpemilih': 'Data Pemilih gagal ditambahkan.',
      'gupemilih': 'Data Pemilih gagal diperbarui.',
      'ghpemilih': 'Data Pemilih gagal dihapus.',
      'idpemilih': 'ID Pemilih sudah terdaftar.',
      'gpilihan': 'Data Pilihan gagal ditambahkan.',
      'gupilihan': 'Data Pilihan gagal diperbarui.',
      'ghpilihan': 'Data Pilihan gagal dihapus.',
      'idpilihan': 'ID Pilihan sudah terdaftar.',
      'efimport': 'Data gagal diimport.',
      'ifimport': 'Tipe file ditolak.',
      'failedemptydata': 'Data gagal dikosongkan.',
      'adminnotfound': 'Admin tidak ditemukan.'

    };

    var successParam = new URLSearchParams(window.location.search).get('success');
    var errorParam = new URLSearchParams(window.location.search).get('error');

    // Menampilkan pesan sukses jika ada
    if (successParam && successMessages[successParam]) {
      Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: successMessages[successParam]
      });
    }

    // Menampilkan pesan kesalahan jika ada
    if (errorParam && errorMessages[errorParam]) {
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: errorMessages[errorParam]
      });
    }
  });
</script>
<!-- DataTables  & Plugins -->
<script src="../../adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../adminlte/plugins/jszip/jszip.min.js"></script>
<script src="../../adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<link rel="stylesheet" href="../../adminlte/plugins/select2/js/select2.min.js">