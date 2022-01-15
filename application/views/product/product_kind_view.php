<?php
// var_dump($this->session->userdata());
// die;
?>
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

  <div id="wrapper">
    <?php $this->load->view('component/sidebar')?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php $this->load->view('component/header')?>
        <div class="container-fluid">

          <?php
            if($this->session->userdata('create')) {
              echo('<button class="btn btn-success" onclick="add_kind()"><i class="glyphicon glyphicon-plus"></i>Tambah</button><br><br>');
            }
          ?>

          <table id="tabelBarang" class="table table-striped table-bordered nowrap text-center" style="width:100%">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th>Jenis</th>
                <th>Option</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <?php $this->load->view('component/footer')?>
    </div>
  </div>
  
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
  <script src="<?php echo base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script>
    let table;
    let save_method = '';

    $(document).ready(function(){
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
      find_kind();
    });

    function find_kind() {
      table = $('#tabelBarang').DataTable({
        "columnDefs": [
          {
            "targets": [1, 2],
            "orderable": false,
          },
        ],
        "order": [],
        "serverSide": true, 
        "ajax": {
          "url": "http://localhost:8080/product_kind/find_kinds",
          "type": "POST"
        },
        "lengthChange": false,
        "responsive": true,
      });
    }
    
    function reload_table(){
      table.ajax.reload(null, false);
    }

    function add_kind(){
      save_method = 'add';
      $('#form_kind')[0].reset();
      $('.modal-title').text('Tambah Jenis');
      $('#modal_kind').modal('show');
    }
    
    function edit_kind(id){
      $.ajax({
        url : "<?php echo site_url('product_kind/find_kind')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          save_method = 'update';
          $("#kind_id").val(data.kind_id);
          $("#kind_name").val(data.kind_name);
          $("#kindModalLabel").html("Edit Jenis");
          $('#modal_kind').modal('show');
        },
        error: function (err) {
          alert('Error get data from ajax');
        }
      });
    }

    function close_modal() {
      $('#modal_kind').modal('hide');
    }

    function store_kind() {
      var url;
      if (save_method === 'add') {
        url = "<?php echo site_url('product_kind/save_kind')?>";
      } else {
        url = "<?php echo site_url('product_kind/update_kind')?>";
      }
      $.ajax({
        url : url,
        type: "POST",
        data: $('#form_kind').serialize(),
        dataType: "JSON",
        success: function(data) {
          close_modal();
          reload_table();
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert('error');
        }
      });
    }
  </script>

  <div class="modal fade" id="modal_kind" tabindex="-1" role="dialog" aria-labelledby="kindModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="kindModalLabel"></h5>
          <button type="button" class="close" onClick="close_modal()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body form" style="position: static">
          <div class="container">
            <form id="form_kind">
              <input type="hidden" class="" id="kind_id" name="kind_id">
              <div class="form-group">
                <label for="kind_name" class="col-form-label">Jenis</label>
                <input type="text" class="form-control" id="kind_name" name="kind_name" >
                <div class="invalid-feedback"></div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onClick="store_kind()" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
