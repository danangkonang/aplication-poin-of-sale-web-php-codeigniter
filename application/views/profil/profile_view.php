<?php
// var_dump($akun);
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
  <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.ico">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url() ?>assets/bootstrap-4.1.3/css/bootstrap-4.1.3.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
  <title>Profile</title>
</head>

<body id="page-top">

  <div id="wrapper">
    <?php $this->load->view('component/sidebar')?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php $this->load->view('component/header')?>
        <div class="container-fluid">
          <div class="row m-5">
            <div class="col-10 p-2">
              <img class="img-profile rounded-circle" src="<?= site_url() ?>assets/images/p.jpeg">
            </div>
            <div class="col-2 p-2">
              <a href="javascript:void(0)" onClick="edit_profil()"><i class="far fa-2x fa-edit"></i></a>
            </div>
            
            <div class="h4 col-5 p-2 font-weight-bold text-dark">
              Nama
            </div>
            <div class="h4 col-7 p-2 font-weight-bold d-flex">
              <div class="pr-2">:</div>
              <div id="user_name">-</div>
            </div>
            
            <div class="h4 col-5 p-2 font-weight-bold text-dark">
              Email
            </div>
            <div class="h4 col-7 p-2 font-weight-bold d-flex">
              <div class="pr-2">:</div>
              <div id="email">-</div>
            </div>
            
            <div class="h4 col-5 p-2 font-weight-bold text-dark">
              Telephon
            </div>
            <div class="h4 col-7 p-2 font-weight-bold d-flex">
              <div class="pr-2">:</div>
              <div id="telephone">-</div>
            </div>
            
            <div class="h4 col-5 p-2 font-weight-bold text-dark">
              Jenis Kelamin
            </div>
            <div class="h4 col-7 p-2 font-weight-bold d-flex">
              <div class="pr-2">:</div>
              <div id="gender">-</div>
            </div>
          </div>
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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>
    $(document).ready(function(){
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
      my_profile();
    });

    function my_profile() {
      $.ajax({
        url : "<?= site_url('profile/my_profile') ?>",
        type: "GET",
        dataType: "JSON",
        success: function(data){
          $("#user_name").html(data.user_name);
          $("#email").html(data.email);
          $("#telephone").html(data.telephone);
          $("#gender").html(data.gender);
        },
        error: function (jqXHR, textStatus, errorThrown){
          alert('Jaringan eror');
        }
      });
    }

    function edit_profil(){
      $.ajax({
        url : "<?= site_url('profile/my_profile') ?>",
        type: "GET",
        dataType: "JSON",
        success: function(data){
          $('[name="user_name"]').val(data.user_name);
          $('[name="email"]').val(data.email);
          $('[name="telephone"]').val(data.telephone);
          $('[name="gender"]').val(data.gender);
          $('#modalProfil').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown){
          alert('Jaringan eror');
        }
      });
    }

    function update_profile() {
      $.ajax({
        url : "<?= site_url('profile/update_profil') ?>",
        type: "POST",
        data: {
          user_name: $('[name="user_name"]').val(),
			    email: $('[name="email"]').val(),
			    telephone: $('[name="telephone"]').val(),
			    gender: $('[name="gender"]').val(),
        },
        dataType: "JSON",
        success: function(res) {
          $('#modalProfil').modal('hide');
          swal("Sukses", {
            icon: "success",
          });
          my_profile();
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert('error');
        }
      });
    }
  </script>

  <div class="modal fade" id="modalProfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				
			  <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  </div>
			
			  <div class="modal-body">
				
          <form id="form">
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

            <div class="form-group">
              <label for="foto" class="col-form-label">foto</label>
              <input type="file" class="form-control-file" name="foto" id="image">
              <div class="invalid-feedback"></div>
            </div>
          </form>
				
			  </div>
			
			  <div class="modal-footer">
          <button type="button" class="btn btn-success" OnClick="update_profile()">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

</body>

</html>
