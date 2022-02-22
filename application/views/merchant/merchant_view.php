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

  <?php $this->load->view('component/sidebar')?>
    
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <?php $this->load->view('component/header')?>

        <div class="container-fluid">
          <div class="row h3">
            <div class="col-10">
            </div>
            <div class="col-2">
              <a href="javascript:void(0)" onClick="edit_merchant()"><i class="far fa-edit"></i></a>
            </div>
            <div class="col-5 mb-3">
              Nama
            </div>
            <div class="col-7" id="store_name">-</div>
            <div class="col-5 mb-3">
              Alamat
            </div>
            <div class="col-7" id="store_address">-</div>
            <div class="col-5 mb-3">
              Telephone
            </div>
            <div class="col-7" id="store_telephone">-</div>
            <div class="col-5 mb-3">
              Deskripsi
            </div>
            <div class="col-7" id="store_description">-</div>
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
  <script src="<?= base_url() ?>/assets/js/sb-admin-2.js"></script>
  <script src="<?= base_url() ?>assets/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script>
    function edit_merchant() {
      $.ajax({
        url : "<?= site_url('merchant/find_merchant') ?>",
        type: "GET",
        dataType: "JSON",
        success: function(data){
          $('[name="store_name"]').val(data.merchant_name);
          $('[name="store_address"]').val(data.merchant_address);
          $('[name="store_telephone"]').val(data.merchant_telephone);
          $("#textarea_store_description").val(data.merchant_description);
          $('#modal_store').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown){
          alert('Jaringan eror');
        }
      });
    }
    
    function simpan() {
      $.ajax({
        url : "<?= site_url('merchant/simpan_data_merchant') ?>",
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
          $("#store_name").html(data.merchant_name);
          $("#store_address").html(data.merchant_address);
          $("#store_telephone").html(data.merchant_telephone);
          $("#store_description").html(data.merchant_description);
          $('#modal_store').modal('hide');
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert('eror');
        }
      });
    }

    function find_my_shop() {
      $.ajax({
        url : "<?= site_url('merchant/find_merchant') ?>",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $("#store_name").html(data.merchant_name);
          $("#store_address").html(data.merchant_address);
          $("#store_telephone").html(data.merchant_telephone);
          $("#store_description").html(data.merchant_description);
          $('#modal_store').modal('hide');
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert('Jaringan eror');
        }
      });
    }
    
    $(document).ready(function(){
      find_my_shop();
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
    });
  </script>
  
  <div class="modal fade" id="modal_store" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
            <input type="number" class="form-control" name="store_telephone" >
            <div class="invalid-feedback"></div>
          </div>
          
          <div class="form-group">
            <label for="nama_barang" class="col-form-label">Moto</label>
            <!-- <input type="text" class="form-control " name="store_description" > -->
            <textarea class="form-control" name="textarea_store_description" id="textarea_store_description" rows="3"></textarea>
            <div class="invalid-feedback"></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" OnClick="simpan()">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      </div>
    </div>
    </div>
  </div>
      
</body>

</html>
