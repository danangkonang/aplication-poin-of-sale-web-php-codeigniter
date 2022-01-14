<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>kasir</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url() ?>assets/bootstrap-4.1.3/css/bootstrap-4.1.3.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
  <title>kasir</title>
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
            
            <div class="col-5 p-2 font-weight-bold text-dark">
              Nama
            </div>
            <div class="col-7 p-2" id="nama_toko">
              : <?= $akun['user_name'] ?>
            </div>
            
            <div class="col-5 p-2 font-weight-bold text-dark">
              Email
            </div>
            <div class="col-7 p-2" id="alamat_toko">
              : <?= $akun['email'] ?>
            </div>
            
            <div class="col-5 p-2 font-weight-bold text-dark">
              Telephon
            </div>
            <div class="col-7 p-2" id="telephon_toko">
              : <?= $akun['telephone'] ?>
            </div>
            
            <div class="col-5 p-2 font-weight-bold text-dark">
              Jenis Kelamin
            </div>
            <div class="col-7 p-2" id="moto_toko">
              : <?= $akun['gender'] ?>
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
  <script>
    $(document).ready(function(){
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
    });
    function edit_profil(){
      $.ajax({
        url : "<?= site_url('profile/edit_profil') ?>",
        type: "GET",
        dataType: "JSON",
        success: function(data){
          $('[name="nama"]').val(data.user_name);
          $('[name="email"]').val(data.email);
          $('[name="telephon"]').val(data.telephone);
          $('[name="jenis kelamin"]').val(data.gender);
          $('#modalProfil').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown){
          alert('Jaringan eror');
        }
      });
    }
  </script>

  <!-- Modal -->
  <div class="modal fade" id="modalProfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				
			  <div class="modal-header">
				 <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  </div>
			
			  <div class="modal-body" id="isiModal">
				
          <form id="form">
            <div class="form-group">
              <label for="nama" class="col-form-label">Nama</label>
              <input type="text" class="form-control " name="nama" >
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="form-group">
              <label for="email" class="col-form-label">Email</label>
              <input type="text" class="form-control " name="email" >
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="form-group">
              <label for="telephon" class="col-form-label">Telephon</label>
              <input type="number" class="form-control " name="telephon" >
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="form-group">
              <label for="jenis_kelamin" class="col-form-label">Jenis kelamin</label>
              <select class="form-control" name="jenis_kelamin" >
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>
              </select>
            </div>

            <div class="form-group">
              <label for="foto" class="col-form-label">foto</label>
              <input type="file" class="form-control-file " name="foto" >
              <div class="invalid-feedback"></div>
            </div>
          </form>
				
			  </div>
			
			  <div class="modal-footer">
          <button type="button" class="btn btn-success" OnClick="simpan()">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

</body>

</html>
