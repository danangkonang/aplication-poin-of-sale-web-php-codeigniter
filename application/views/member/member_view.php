<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.ico">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/Responsive-2.2.2/css/responsive.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet">
  <title>Member</title>
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
              echo('<button class="btn btn-success" onclick="add_member()"><i class="glyphicon glyphicon-plus"></i>Tambah</button><br><br>');
            }
          ?>

          <table id="tabelBarang" class="table table-striped table-bordered nowrap text-center" style="width:100%">
            <thead>
              <tr>
                <th class="text-center">Ko</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Discount</th>
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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    let table;
    let save_method = '';

    $(document).ready(function(){
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
      find_member();
    });

    function find_member() {
      table = $('#tabelBarang').DataTable({
        "columnDefs": [
          {
            "targets": [1, 2, 3, 4, 5],
            "orderable": false,
          },
        ],
        "order": [],
        "serverSide": true, 
        "ajax": {
          "url": "<?= site_url('member/find_members')?>",
          "type": "POST"
        },
        "lengthChange": false,
        "responsive": true,
      });
    }
    
    function reload_table(){
      table.ajax.reload(null, false);
    }

    function add_member(){
      save_method = 'add';
      $('#form_member')[0].reset();
      $('.modal-title').text('Tambah Member');
      $('#modal_member').modal('show');
    }
    
    function edit_member(id){
      $.ajax({
        url : "<?php echo site_url('member/find_member')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          save_method = 'update';
          $("#member_id").val(data.member_id);
          $("#member_name").val(data.member_name);
          $("#member_email").val(data.member_email);
          $("#member_telephone").val(data.member_telephone);
          $("#discount").val(data.discount);
          $("#memberModalLabel").html("Edit Member");
          $('#modal_member').modal('show');
        },
        error: function (err) {
          alert('Error get data from ajax');
        }
      });
    }

    function close_modal() {
      $('#modal_member').modal('hide');
    }

    function store_member() {
      var url;
      if (save_method === 'add') {
        url = "<?= site_url('member/save_member')?>";
      } else {
        url = "<?= site_url('member/update_member')?>";
      }
      $.ajax({
        url : url,
        type: "POST",
        data: $('#form_member').serialize(),
        dataType: "JSON",
        success: function(data) {
          close_modal();
          swal("Sukses", {
            icon: "success",
          });
          reload_table();
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert('error');
        }
      });
    }
  </script>

  <div class="modal fade" id="modal_member" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="memberModalLabel"></h5>
          <button type="button" class="close" onClick="close_modal()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body form" style="position: static">
          <div class="container">
            <form id="form_member">
              <input type="hidden" class="" id="member_id" name="member_id">
              <div class="form-group">
                <label for="member_name" class="col-form-label">Nama</label>
                <input type="text" class="form-control" id="member_name" name="member_name" >
                <div class="invalid-feedback"></div>
              </div>
              <div class="form-group">
                <label for="member_email" class="col-form-label">Email</label>
                <input type="text" class="form-control" id="member_email" name="member_email" >
                <div class="invalid-feedback"></div>
              </div>
              <div class="form-group">
                <label for="member_telephone" class="col-form-label">Telephone</label>
                <input type="text" class="form-control" id="member_telephone" name="member_telephone" >
                <div class="invalid-feedback"></div>
              </div>
              <div class="form-group">
                <label for="discount" class="col-form-label">Discount</label>
                <input type="number" class="form-control" id="discount" name="discount" >
                <div class="invalid-feedback"></div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onClick="store_member()" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
