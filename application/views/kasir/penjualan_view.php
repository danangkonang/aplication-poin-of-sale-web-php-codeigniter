<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/Responsive-2.2.2/css/responsive.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet">
  <title>kasir</title>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  <?php $this->load->view('component/sidebar')?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <?php $this->load->view('component/header')?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            
			
			<table id="tabelBarang" class="table table-striped table-bordered nowrap" style="width:100%">
				<thead>
					<tr>
						<th>no</th>
						<th>Id</th>
						<th>Nama</th>
						<th>Qty</th>
						<th>Kasir</th>
						<th>Harga satuan</th>
            <th>Jumlah Bayar</th>
						<!--th>satuan</th-->
						<!--th>S P</th-->
						<th>Tanggal</th>
						<!--th>Jam</th-->
					</tr>
				</thead>
				<tbody>
        </tbody>
        <!-- <tfoot>
          <tr>
            <th colspan="5" style="text-align:right">Total:</th>
            <th></th>
          </tr>
        </tfoot> -->
			</table>
        </div>
        <!-- /.container-fluid -->

      </div>
      <?php $this->load->view('component/footer')?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="<?= base_url() ?>assets/jquery/jquery-3.2.1.min.js"></script>
  <script src="<?= base_url() ?>assets/bootstrap-4.1.3/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/sb-admin-2.js"></script>
  <script src="<?= base_url() ?>assets/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/Responsive-2.2.2/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/Responsive-2.2.2/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?= base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script>
    let table;
    $(document).ready(function(){
      table = $('#tabelBarang').DataTable({
        "columnDefs": [
          {
            "targets": [1,3,4,5 ],
            "orderable": false,
          },
        ],
        "order": [],
        "serverSide": true, 
        "ajax": {
          "url": "http://localhost:8080/option/get_penjualan",
          "type": "POST"
          },
        "lengthChange": false,
        "responsive": true,
      });
    });
    
    function reload_table(){
      table.ajax.reload(null,false);
    }
  </script>
</body>

</html>
