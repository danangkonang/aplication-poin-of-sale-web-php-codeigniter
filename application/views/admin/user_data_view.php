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
  <title>Users</title>
  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
  </style>
</head>

<body id="page-top">

  <div id="wrapper">
    <?php $this->load->view('component/sidebar')?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php $this->load->view('component/header')?>
        <div class="container-fluid">
          <table id="tabelBarang" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
              <tr>
                <th>no</th>
                <th>Nama</th>
                <th>Email</th>
                <th>jenis kelamin</th>
                <th>no hp</th>
                <th>aktif</th>
                <th>opsi</th>
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
    var table;
    $(document).ready(function(){
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
      find_user();
    });

    function find_user() {
      table = $('#tabelBarang').DataTable({
        "columnDefs": [
          {
            "targets": [1, 3, 4, 5],
            "orderable": false,
          },
        ],
        "order": [],
        "serverSide": true, 
        "ajax": {
          "url": "<?= site_url('user/get_data_user') ?>",
          "type": "POST"
        },
        "lengthChange": false,
        "responsive": true,
      });
    }
    
    function reload_table(){
      table.ajax.reload(null,false);
    }
    
    function edit_user(id){
      $.ajax({
        url : "<?= site_url('user/find_user_by_id/') ?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
          $('[name="user_id"]').val(data.user_id);
          $('[name="user_name"]').val(data.user_name);
          $('[name="email"]').val(data.email);
          $('[name="telephone"]').val(data.telephone);
          $('[name="gender"]').val(data.gender);
          $('[name="is_active"]').prop('checked', data.is_active === "1" ? true : false);
          $('#modal_user').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown){
          alert('Jaringan eror');
        }
      });
    }

    function update_user(id) {
      let isActive = document.getElementsByName("is_active");
      $.ajax({
        url : "<?= site_url('user/update_user_by_id') ?>",
        type: "POST",
        data: {
          user_id: $('[name="user_id"]').val(),
          user_name: $('[name="user_name"]').val(),
			    email: $('[name="email"]').val(),
			    telephone: $('[name="telephone"]').val(),
			    gender: $('[name="gender"]').val(),
          is_active: isActive.checked ? 1 : 0,
        },
        dataType: "JSON",
        success: function(res) {
          $('#modalProfil').modal('hide');
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
  <div class="modal fade" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				
			  <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  </div>
			
			  <div class="modal-body">
				
          <form id="form">
            <input type="hidden" name="user_id">

            <div class="form-group">
              <label class="switch">
                <input type="checkbox" name="is_active">
                <span class="slider round"></span>
              </label>
            </div>

            <div class="form-group">
              <label for="nama" class="col-form-label">Nama</label>
              <input type="text" class="form-control" name="user_name">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="form-group">
              <label for="email" class="col-form-label">Email</label>
              <input type="text" class="form-control" name="email">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="form-group">
              <label for="telephone" class="col-form-label">Telephon</label>
              <input type="number" class="form-control" name="telephone">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="form-group">
              <label for="gender" class="col-form-label">Jenis kelamin</label>
              <select class="form-control" name="gender">
                <option value=""></option>
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>
              </select>
            </div>

          </form>
				
			  </div>
			
			  <div class="modal-footer">
          <button type="button" class="btn btn-success" OnClick="update_user()">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
