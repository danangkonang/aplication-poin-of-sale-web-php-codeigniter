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
  <link href="<?= base_url() ?>/assets/css/sb-admin-2.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet">
  <title>kasir</title>
</head>

<body id="page-top">

  <div id="wrapper">

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
          <?= $this->session->userdata('role') ?>
        </div>
      </a>
      <hr class="sidebar-divider my-0">

      <li class="nav-item ">
        <a class="nav-link" href="<?= site_url() ?>">
          <i class="fas fa-fw fa-cash-register"></i>
          <span>Kasir</span></a>
      </li>
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link" href="<?= site_url() ?>option/data_barang">
          <i class="fas fa-fw fa-cubes"></i>
          <span>Data barang</span></a>
      </li>
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link" href="<?= site_url() ?>option/data_penjualan">
        <i class="far fa-handshake"></i>
          <span>Data penjualan</span></a>
      </li>
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-money-bill-wave"></i>
          <span>Keuntungan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= site_url() ?>option/laba_tabel"><i class="fas fa-table"></i> Tabel</a>
            <a class="collapse-item" href="<?= site_url() ?>option/laba_diagram"><i class="far fa-chart-bar"></i> Diagram</a>
        </div>
      </li>
      <hr class="sidebar-divider">

      <?php if($this->session->userdata('role')== 'admin'){ ?>

        <li class="nav-item">
          <a class="nav-link" href="<?= site_url() ?>option/data_user">
          <i class="far fa-user"></i>
            <span>Data user</span></a>
        </li>
        <hr class="sidebar-divider">

        <li class="nav-item">
          <a class="nav-link" href="<?= site_url() ?>option/pengunjung">
            <i class="fas fa-fw fa-globe-americas"></i>
            <span>Pengunjung</span></a>
        </li>
        <hr class="sidebar-divider">

        <li class="nav-item active">
          <a class="nav-link" href="<?= site_url() ?>option/data_toko">
          <i class="fas fa-store"></i>
            <span>Toko</span></a>
        </li>
        <hr class="sidebar-divider">

      <?php } ?>


      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    
    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <div class="h3 ml-auto">kasir</div>

         
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('username') ?></span>
                <img class="img-profile rounded-circle" src="<?= site_url() ?>assets/images/p.jpeg">
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="tes">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url() ?>option/logout">
                  <i class="fas fa-power-off fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        
        <div class="container-fluid">
            
            <div class="row h3">
                <div class="col-8">
                    
                </div>
                <div class="col-4">
                    <a href="javascript:void(0)" onClick="edit_toko()"><i class="far fa-2x fa-edit"></i></a>
                </div>
                
                <div class="col-5">
                    nama
                </div>
                <div class="col-7" id="store_name">
                    nama
                </div>
                
                <div class="col-5">
                    alamat
                </div>
                <div class="col-7" id="store_address">
                    alamat
                </div>
                
                <div class="col-5">
                    telp
                </div>
                <div class="col-7" id="store_phone">
                    phone
                </div>
                
                <div class="col-5">
                    moto
                </div>
                <div class="col-7" id="store_description">
                    moto
                </div>
                
            </div>
        </div>

      </div>
      
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; danang 2019</span>
          </div>
        </div>
      </footer>

    </div>

  </div>
  
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="<?= base_url() ?>assets/jquery/jquery-3.2.1.min.js"></script>
  <script src="<?= base_url() ?>assets/bootstrap-4.1.3/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/sb-admin-2.js"></script>
  <script src="<?= base_url() ?>assets/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script>
    var url = "<?= site_url('option/simpan_data_toko') ?>";
    function edit_toko() {
      $.ajax({
        url : "<?= site_url('option/edit_data_toko') ?>",
        type: "GET",
        dataType: "JSON",
        success: function(data){
          $('[name="store_name"]').val(data.store_name);
          $('[name="store_address"]').val(data.store_address);
          $('[name="store_phone"]').val(data.store_phone);
          $('[name="store_description"]').val(data.store_description);
          $('#modal_store').modal('show');
          //alert(data.store_name);
        },
        error: function (jqXHR, textStatus, errorThrown){
          alert('Jaringan eror');
        }
      });
    }
    
    function simpan() {
      $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
          $("#store_name").html(data.store_name);
          $("#store_address").html(data.store_address);
          $("#store_phone").html(data.store_phone);
          $("#store_description").html(data.store_description);
          $('#modal_store').modal('hide'); 
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert('eror');
        }
      });
    }

    function find_my_shop() {
      $.ajax({
        url : "<?= site_url('option/find_store') ?>",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $("#store_name").html(data.store_name);
          $("#store_address").html(data.store_address);
          $("#store_phone").html(data.store_phone);
          $("#store_description").html(data.store_description);
          $('#modal_store').modal('hide');
          //alert(data.store_name);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert('Jaringan eror');
        }
      });
    }
    
    $(document).ready(function(){
      find_my_shop();
    });
  </script>
  
  <div class="modal fade" id="modal_store" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
      
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
    
      <div class="modal-body" id="isiModal">
      
      <form id="form">
      <div class="form-group">
        <label for="nama_barang" class="col-form-label">Nama toko</label>
        <input type="text" class="form-control " name="store_name" >
          <div class="invalid-feedback"></div>
      </div>
      
      <div class="form-group">
        <label for="nama_barang" class="col-form-label">Alamat</label>
        <input type="text" class="form-control " name="store_address" >
          <div class="invalid-feedback"></div>
      </div>
      
      <div class="form-group">
        <label for="nama_barang" class="col-form-label">Telephon</label>
        <input type="number" class="form-control " name="store_phone" >
          <div class="invalid-feedback"></div>
      </div>
      
      <div class="form-group">
        <label for="nama_barang" class="col-form-label">Moto</label>
        <input type="text" class="form-control " name="store_description" >
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
