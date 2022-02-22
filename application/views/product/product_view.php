<?php
// var_dump($units);
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
  <link href="<?php echo base_url() ?>assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">
  <title>kasir</title>
  <style>
    #preview{
      height: auto;
      width: 100%;
      transform: scaleX(-1);
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
          <?php
            if($this->session->userdata('create')) {
              echo('<button class="btn btn-success" onclick="add_product()"><i class="glyphicon glyphicon-plus"></i> tambah</button><br><br>');
            }
          ?>
          <!-- <div id="qr-reader"></div>
          <div id="qr-reader-results"></div> -->

          <table id="tabelBarang" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
              <tr>
                <th>no</th>
                <th>Barcode</th>
                <th>Jenis</th>
                <th>Nama</th>
                <th>H beli</th>
                <th>H jual</th>
                <th>Untung</th>
                <th>Qty</th>
                <th>Opsi</th>
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
  <script type="text/javascript" src="<?= base_url() ?>assets/js/scan.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

  <script>
    let table;
    // let scanner;
    // let video;
    // $(document).ready(function(){
    //   video = document.getElementById('preview');
    //   scanner = new Instascan.Scanner({ video: video });
    //   find_all_product();
    //   setup();
    //   $("body").toggleClass("sidebar-toggled");
    //   $(".sidebar").toggleClass("toggled");
    //   $('#start_promo').datepicker();
    //   $('#end_promo').datepicker();
    // });

    // function docReady(fn) {
    //   // see if DOM is already available
    //   if (document.readyState === "complete" || document.readyState === "interactive") {
    //     // call on next available tick
    //     setTimeout(fn, 1);
    //   } else {
    //     document.addEventListener("DOMContentLoaded", fn);
    //   }
    // }

    // docReady(function () {
    //   var resultContainer = document.getElementById('qr-reader-results');
    //   var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
    //   var lastResult, countResults = 0;
    //   function onScanSuccess(decodedText, decodedResult) {
    //     if (decodedText !== lastResult) {
    //       ++countResults;
    //       lastResult = decodedText;
    //       // Handle on success condition with the decoded message.
    //       console.log(`${decodedText}`);
    //       $("#barcode").val(decodedText);
    //       // html5QrcodeScanner.stop();
    //     }
    //   }

    //   html5QrcodeScanner.render(onScanSuccess);
    // });

    $(document).ready(function(){
      find_all_product();
      setup();
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
      // $('#start_promo').datepicker();
      // $('#end_promo').datepicker();
    });

    function find_all_product() {
      table = $('#tabelBarang').DataTable({
        "columnDefs": [
          {
            "targets": [1, 4, 5, 6, 7, 8],
            "orderable": false,
          },
        ],
        "order": [],
        "serverSide": true, 
        "ajax": {
          "url": "http://localhost:8080/product/find_all_product",
          "type": "POST"
        },
        "lengthChange": false,
        "responsive": true,
      });
    }
      
    function reload_table(){
      table.ajax.reload(null,false);
    }

    function add_product(){
      save_method = 'add';
      $('#form_product')[0].reset();
      $('.modal-title').text('tambah produk');
      $('#modal_form').modal('show');
      // showScanner();
    }

    function close_modal(){
      // scanner.stop();
      // let stream = video.srcObject;
      // let tracks = stream.getTracks();
      // for (let i = 0; i < tracks.length; i++) {
      //   let track = tracks[i];
      //   track.stop();
      // }
      // video.srcObject = null;
      save_method = 'add';
      $('#form_product')[0].reset();
      $('.modal-title').text('tambah produk');
      $('#modal_form').modal('hide'); 
    }
    
    function setup(){
      $("#promo_type").change(function(){
        if($(this).val() =="minimal") {
          $("#harga_ahir").removeClass('d-none');
          $("#potongan").attr("placeholder", "minimal beli");
          $(".reset").val("");
        }
        else {
          $("#harga_ahir").addClass('d-none');
          $("#potongan").attr("placeholder", "(%)");
          $(".reset").val("");
        }
      });
      tanggal();
    }

    function save_product() {
      var url;
      if(save_method == 'add') {
        url = "<?php echo site_url('product/save_product')?>";
      }
      else {
        url = "<?php echo site_url('product/update_barang')?>";
      }
      $.ajax({
        url : url,
        type: "POST",
        data: $('#form_product').serialize(),
        dataType: "JSON",
        success: function(data) {  
          console.log('respon',data)     
          if(data.status) {
            swal("Success", "data berhasil diubah", "success");
            close_modal();
            reload_table();
          }
          else {
            swal({
              title: "Warning",
              text:data.message,
              icon: "warning",
              //buttons: true,
              dangerMode: true,
            })
            // console.log('eror',data)
            // for (var i = 0; i < data.inputerror.length; i++) {
            //   $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
            //   $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
            // }
            //alert(data.message);
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert('error');
        }
      });
    }

    function tanggal() {
      $('[data-toggle="mulai_promo"]').datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function (selected) {
          var dt = new Date(selected);
          dt.setDate(dt.getDate() + 1);
          $('[data-toggle="ahir_promo"]').datepicker("option", "minDate", dt);
        }
      });
      $('[data-toggle="ahir_promo"]').datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function (selected) {
          var dt = new Date(selected);
          dt.setDate(dt.getDate() - 1);
          $('[data-toggle="mulai_promo"]').datepicker("option", "maxDate", dt);
        }
      });
    }
    
    function delete_barang(id) {
      swal({
        title: "Hapus Produk?",
        text: "Produk akan dihapus permanen",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url : "<?php echo site_url('product/hapus_barang')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
              swal("Produk berhasil dihapus", {
                icon: "success",
              });
              reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown) {
              swal("Produk gagal dihapus", {
                icon: "success",
              });
            }
          });
        } else {
          swal("Terima kasih");
        }
      });
    }
    
    function edit_barang(id) {
      save_method = 'update';
      $('#form_product')[0].reset();
      $.ajax({
        url : "<?php echo site_url('product/edit_barang')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('[name="product_id"]').val(data.product_id);
          $('[name="barcode"]').val(data.barcode);
          $('[name="jenis"]').val(data.kind_id);
          $('[name="setatus_barang"]').val(data.setatus_barang);
          $('[name="product_name"]').val(data.product_name);
          $('[name="purchase_price"]').val(data.purchase_price);
          $('[name="selling_price"]').val(data.selling_price);
          $('[name="product_qty"]').val(data.product_qty);
          $('[name="unit"]').val(data.unit);
          $('[name="mulai_promo"]').val(data.mulai_promo);
          $('[name="ahir_promo"]').val(data.ahir_promo);
          $('[name="promo_type"]').val(data.promo_type);
          $('[name="potongan"]').val(data.potongan);
          $('[name="harga_ahir"]').val(data.harga_ahir);
          $('[name="setatus_promo"]').val(data.setatus_promo);
          $('#modal_form').modal('show');
          $('.modal-title').text('Edit barang');
          if(data.promo_type == 'minimal') {
            $("#harga_ahir").removeClass('d-none');
          }
          showScanner();
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert('Error get data from ajax');
        }
      });
    }

    function showScanner() {
      scanner.addListener('scan', function (content) {
        alert(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    }

  </script>

  <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">tambah produk</h5>
          <button type="button" class="close" onClick="close_modal()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body form" style="position: static">
          <form id="form_product">
            <input type="hidden" id="product_id" name="product_id" >

              <div id="qr-reader"></div>
              <div id="qr-reader-results"></div>

            <div class="row">
              <div class="col-sm-12 col-lg-6 col-xl-6">

                <!-- <video class="bg-success" id="preview"></video> -->
                

                <div class="form-group">
                  <label for="barcode" class="col-form-label">Barcode</label>
                  <input type="text" class="form-control" id="barcode" name="barcode" >
                  <div class="invalid-feedback"></div>
                </div>

                <div class="form-group mt-2">
                  <label for="jenis">Jenis</label>
                  <select class="form-control " name="jenis" >
                    <?php foreach ($kinds as $row) { ?>
                      <option value="<?= $row->kind_id ?>"><?= $row->kind_name ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group mt-2">
                  <label for="is_active">Status Barang</label>
                  <select class="form-control " name="is_active" >
                    <option value="1">Active</option>
                    <option value="0">Tidak Active</option>
                  </select>
                </div>
                      
                <div class="form-group">
                  <label for="product_name" class="col-form-label">Nama barang</label>
                  <input type="text" class="form-control " name="product_name" >
                  <div class="invalid-feedback"></div>
                </div>

                <div class="form-group">
                  <label for="unit">Satuan</label>
                  <select class="form-control" name="unit" >
                    <?php foreach ($units as $row) { ?>
                      <option value="<?= $row->unit ?>"><?= $row->unit ?></option>
                    <?php } ?>
                  </select>
                  <div class="invalid-feedback"></div>
                </div>
                      
                <div class="form-group">
                  <label for="purchase_price" class="col-form-label">Harga beli</label>
                  <input type="number" class="form-control" name="purchase_price" >
                  <div class="invalid-feedback"></div>
                </div>
                      
                <div class="form-group">
                  <label for="selling_price" class="col-form-label">Harga jual</label>
                  <input type="number" class="form-control " name="selling_price"  >
                  <div class="invalid-feedback"></div>
                </div>

              </div>

              <div class="col-sm-12 col-lg-6 col-xl-6">
                <div class="form-group">
                  <label for="product_qty" class="col-form-label">Stok</label>
                  <input type="number" class="form-control " name="product_qty" >
                  <div class="invalid-feedback"></div>
                </div>
                <!-- <p>
                  <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">promo</button>
                </p> -->
                <!-- <div class="collapse" id="collapseExample">
                  <div class="card card-body">
                    <div class="form-row mb-4">
                      <div class="col">
                        <label for="start_promo">awal promo</label>
                        <input type="text" class="form-control" name="start_promo" id="start_promo" data-toggle="start_promo" placeholder="Tanggal mulai">
                      </div>

                      <div class="col">
                        <label for="end_promo">ahir promo</label>
                        <input type="text" class="form-control" name="end_promo"  id="end_promo" data-toggle="end_promo" placeholder="Tanggal ahir">
                      </div>
                    </div>
                              
                    <div class="form-row mb-4">
                      <div class="col">
                        <label for="promo_type">Jenis Promo</label>
                        <select class="form-control " name="promo_type" id="promo_type" >
                          <option value="diskon">Diskon</option>
                          <option value="minimal">Minimal</option>
                        </select>
                      </div>
                      <div class="col">
                        <label for="piece">piece</label>
                        <input type="number" class="form-control reset" name="piece"  id="potongan" data-toggle="min" placeholder="(%)">
                      </div>
                    </div>
                            
                    <div class="form-group d-none reset" id="end_price">
                      <label for="diskon">Harga Ahir</label>
                      <input type="number" name="end_price" id="diskon" class="form-control" placeholder="harga ahir">
                    </div>
                            
                    <div class="form-group mt-2">
                      <label for="is_promo">Setatus Promo</label>
                      <select class="form-control " name="is_promo" >
                        <option value="0">Tidak Aktif</option>
                        <option value="1">Aktif</option>
                      </select>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </form>
          
        </div>
        <div class="modal-footer">
          <button type="button" onClick="save_product()" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-danger" onClick="close_modal()">Batal</button>
        </div>
      </div>
    </div>
  </div>
      
</body>

</html>
