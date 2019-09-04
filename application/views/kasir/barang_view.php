<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">
  
  <!-- Custom styles for this page -->
  <link href="<?= base_url() ?>assets/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/Responsive-2.2.2/css/responsive.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>aassets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" >
  <link href="<?= base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet">
  <title>kasir</title>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url() ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-cash-register"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
          <?php if($this->session->userdata('level')==1)
          {
            echo 'admin';
          }else{
            echo 'kasir';
          }
          ?>
        </div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item ">
        <a class="nav-link" href="<?= site_url() ?>">
          <i class="fas fa-fw fa-cash-register"></i>
          <span>Kasir</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Tables pembelian -->
      <li class="nav-item active">
        <a class="nav-link" href="<?= site_url() ?>option/data_barang">
          <i class="fas fa-fw fa-cubes"></i>
          <span>Data barang</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url() ?>option/data_penjualan">
        <i class="far fa-handshake"></i>
          <span>Data penjualan</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
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
      <!-- Divider -->
      <hr class="sidebar-divider">

      <?php if($this->session->userdata('level')==1){ ?>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url() ?>option/data_user">
        <i class="far fa-user"></i>
          <span>Data user</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

       <!-- Nav Item - Dashboard -->
       <li class="nav-item">
        <a class="nav-link" href="<?= site_url() ?>option/pengunjung">
          <i class="fas fa-fw fa-globe-americas"></i>
          <span>Pengunjung</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url() ?>option/data_toko">
        <i class="fas fa-store"></i>
          <span>Toko</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <?php
      }
      ?>


      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <div class="h3 ml-auto">Barang</div>

         
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('username') ?></span>
                <img class="img-profile rounded-circle" src="<?= site_url() ?>assets/images/p.jpeg">
              </a>
              <!-- Dropdown - User Information -->
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
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php if($this->session->userdata('level')==1)
          {
            echo '<button class="btn btn-success" onclick="tambah_barang()"><i class="glyphicon glyphicon-plus"></i> tambah</button><br><br>';
          }
          ?>
            <table id="tabelBarang" class="table table-striped table-bordered nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>no</th>
                  <th>Nama</th>
                  <th>H beli</th>
                  <th>H jual</th>
                  <th>H ahir</th>
                  <th>Setok</th>
                  <th>Promo</th>
                  <th>Pot</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; danang 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url() ?>assets/jquery/jquery-3.2.1.min.js"></script>
  <script src="<?= base_url() ?>assets/bootstrap-4.1.3/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/aassets/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url() ?>/aassets/js/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url() ?>/assets/js/sb-admin-2.js"></script>
  
  <!-- Page level plugins -->
  <script src="<?= base_url() ?>assets/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/Responsive-2.2.2/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>assets/Responsive-2.2.2/js/responsive.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url() ?>/aassets/demo/datatables-demo.js"></script>
  
  <script src="<?php echo base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script>
      var table;
      $(document).ready(function(){
          table = $('#tabelBarang').DataTable({
              "columnDefs": [
              {
                  "targets": [ 0,2,3,4,5,6,7,8 ],
                  "orderable": false,
              },
              ],
              "order": [],
              "serverSide": true, 
              "ajax": {
                  "url": "http://localhost/penjualan/option/get_barang",
                  "type": "POST"
                  },
              "lengthChange": false,
              "responsive": true,
              });
           new $.fn.dataTable.FixedHeader( table );
       });
       
       function reload_table()
       {
           table.ajax.reload(null,false);
       }
       
      function tambah_barang ()
      {
          save_method = 'add';
          $('#form')[0].reset();
          $('.modal-title').text('Input barang');
          $('#modal_form').modal('show'); 
      }
      
      $(function(){
          $("#jenis_promo").change(function(){
              if($(this).val() =="minimal")
              {
                  $("#harga_ahir").removeClass('d-none');
                  $("#potongan").attr("placeholder", "minimal beli");
                  $(".reset").val("");
              }
              else
              {
                  $("#harga_ahir").addClass('d-none');
                  $("#potongan").attr("placeholder", "(%)");
                  $(".reset").val("");
              }
              });
          
          tanggal();
          
          
          });
          
       function save()
       {
           var url;
           if(save_method == 'add')
           {
               url = "<?php echo site_url('option/simpan_barang')?>";
           }
           else
           {
               url = "<?php echo site_url('option/update_barang')?>";
           }
           
           
           $.ajax({
               url : url,
               type: "POST",
               data: $('#form').serialize(),
               dataType: "JSON",
               success: function(data)
               {
                   if(data.status)
                   {
                       $('#modal_form').modal('hide');
                       reload_table();
                   }
                   else
                   {
                       for (var i = 0; i < data.inputerror.length; i++)
                       {
                           //$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                           $('[name="'+data.inputerror[i]+'"]').addClass('is-invalid');
                           $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                       }
                   }            
               },
               error: function (jqXHR, textStatus, errorThrown)
               {
                   alert('error');
               }
           });
       }
       
       function tanggal()
       {
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
       
       function delete_barang(id)
       {
         if(confirm('yakin ingin di hapus?')){
               $.ajax({
                   url : "<?php echo site_url('option/hapus_barang')?>/"+id,
                   type: "POST",
                   dataType: "JSON",
                   success: function(data)
                   {
                       
                       reload_table();
                   },
                   error: function (jqXHR, textStatus, errorThrown)
                   {
                       alert('Error deleting data');
                   }
              });
           
           }
       }
       
       function edit_barang(id)
       {
           save_method = 'update';
           $('#form')[0].reset();
           $.ajax({
               url : "<?php echo site_url('option/edit_barang')?>/" + id,
               type: "GET",
               dataType: "JSON",
               success: function(data)
               {
                   $('[name="id"]').val(data.id_barang);
                   $('[name="setatus_barang"]').val(data.setatus_barang);
                   $('[name="nama_barang"]').val(data.nama_barang);
                   $('[name="harga_beli"]').val(data.harga_beli);
                   $('[name="harga_jual"]').val(data.harga_jual);
                   $('[name="setok"]').val(data.setok);
                   $('[name="satuan"]').val(data.satuan);
                   $('[name="mulai_promo"]').val(data.mulai_promo);
                   $('[name="ahir_promo"]').val(data.ahir_promo);
                   $('[name="jenis_promo"]').val(data.jenis_promo);
                   $('[name="potongan"]').val(data.potongan);
                   $('[name="harga_ahir"]').val(data.harga_ahir);
                   $('[name="setatus_promo"]').val(data.setatus_promo);
                   $('#modal_form').modal('show');
                   $('.modal-title').text('Edit barang');
                   if(data.jenis_promo == 'minimal')
                   {
                       $("#harga_ahir").removeClass('d-none');
                   }
               },
               error: function (jqXHR, textStatus, errorThrown)
               {
                   alert('Error get data from ajax');
               }
               });
       }
  </script>
  
  
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">input</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
            
            <div class="modal-body form">
              <form id="form" class="form-horizontal">

                <input type="hidden" value="" name="id"/> 
                <div class="form-body">
                        
                  <div class="form-group mt-2">
                    <label for="setatus_barang">setatus barang</label>
                    <select class="form-control " name="setatus_barang" >
                      <option value="1">jual</option>
                      <option value="0">gudang</option>
                    </select>
                  </div>
                       
                  <div class="form-group">
                      <label for="nama_barang" class="col-form-label">nama barang</label>
                      <input type="text" class="form-control " name="nama_barang" >
                      <div class="invalid-feedback"></div>
                  </div>
                        
                  <div class="form-group">
                    <label for="harga_beli" class="col-form-label">harga beli</label>
                    <input type="number" class="form-control" name="harga_beli" >
                    <div class="invalid-feedback"></div>
                  </div>
                       
                  <div class="form-group">
                    <label for="harga_jual" class="col-form-label">harga jual</label>
                    <input type="number" class="form-control " name="harga_jual"  >
                    <div class="invalid-feedback"></div>
                  </div>
                       
                  <div class="form-group">
                    <label for="setok" class="col-form-label">setok</label>
                    <input type="number" class="form-control " name="setok" >
                    <div class="invalid-feedback"></div>
                  </div>

                  <div class="form-group">
                    <label for="satuan">satuan</label>
                    <select class="form-control " name="satuan" >
                      <option value=""></option>
                      <option value="pcs">pcs</option>
                      <option value="botol">botol</option>
                      <option value="liter">liter</option>
                      <option value="kg">kg</option>
                      <option value="kardus">kardus</option>
                      <option value="saset">saset</option>
                    </select>
                    <div class="invalid-feedback"></div>
                  </div>
                        
                  <p>
                    <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">promo</button>
                  </p>

                  <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                                
                      <div class="form-row mb-4">
                        <div class="col">
                          <label for="mulai_promo">awal promo</label>
                          <input type="text" class="form-control" name="mulai_promo" data-toggle="mulai_promo" placeholder="tgl mulai">
                        </div>
                        <div class="col">
                          <label for="ahir_promo">ahir promo</label>
                          <input type="text" class="form-control" name="ahir_promo"  id="ahir_promo" data-toggle="ahir_promo" placeholder="tgl ahir">
                        </div>
                      </div>
                               
                      <div class="form-row mb-4">
                        <div class="col">
                          <label for="jenis_promo">jenis promo</label>
                          <select class="form-control " name="jenis_promo" id="jenis_promo" >
                            <option value="diskon">diskon</option>
                            <option value="minimal">minimal</option>
                          </select>
                        </div>
                        <div class="col">
                          <label for="potongan">potongan</label>
                          <input type="number" class="form-control reset" name="potongan"  id="potongan" data-toggle="min" placeholder="(%)">
                        </div>
                      </div>
                              
                      <div class="form-group d-none reset" id="harga_ahir">
                        <label for="diskon">harga ahir</label>
                        <input type="number" name="harga_ahir" id="diskon" class="form-control" placeholder="harga ahir">
                      </div>
                              
                      <div class="form-group mt-2">
                        <label for="setatus_promo">setatus promo</label>
                        <select class="form-control " name="setatus_promo" >
                          <option value="0">habis</option>
                          <option value="1">aktif</option>
                        </select>
                      </div>
                              
                    </div><!--card card-body-->
                  </div><!--collapse-->
           
                </div><!--form body-->

              </form>
            </div><!--modal-body-->
            
            <div class="modal-footer">
              <button type="button" onClick="save()" class="btn btn-primary">Simpan</button>
              <!--/form-->
              <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- End Bootstrap modal -->
      
</body>

</html>
