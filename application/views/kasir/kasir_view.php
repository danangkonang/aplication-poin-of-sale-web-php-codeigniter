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
  <link href="<?= base_url() ?>assets/css/sb-admin-2.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  
  <link href="<?= base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
  <title>kasir</title>
  <style>
      @media print{
          #wrapper {
              display:none;
              }
          
          .modal-footer, .modal-header {
              display:none;
              }

          title{
            display: none;
          }
          }
  </style>
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
      <li class="nav-item active">
        <a class="nav-link" href="<?= site_url() ?>">
          <i class="fas fa-fw fa-cash-register"></i>
          <span>Kasir</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Tables pembelian -->
      <li class="nav-item">
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

          <div class="h3 ml-auto">kasir</div>

         
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
                <a class="dropdown-item" href="<?= base_url() ?>option/akun">
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
          
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12 col-md-6 ">

                        <form class="form-horizontal" id="form_transaksi" role="form">

                            <div class="form-group row">
                              <label class="col-md-3 col-form-label">id/nama (f2)</label>
                                <div class="col-md-9">
                                  <input class="form-control reset" id="pencarian"  name="id" type="text" placeholder="id / nama" >
                                </div>
                            </div>
                            
                            <div class="form-group row">
                              <label class="col-md-3 col-form-label"> nama</label>
                                <div class="col-md-9">
                                  <input class="form-control reset" type="text" id="nama_barang" name="nama" readonly="" placeholder="nama" >
                                </div>
                            </div>
                            
                            <div class="form-group row">
                              <label class="col-md-3 col-form-label"> harga</label>
                                <div class="col-md-9">
                                  <input class="form-control reset" type="text" name="harga" id="harga"  readonly="" placeholder="0"value="">
                                </div>
                            </div>
							
                              <input type="hidden" class="reset" id="jenis_promo" name="jenis_promo">
                              <input type="hidden" class="reset" id="potongan" name="potongan">
                              <input type="hidden" class="reset" id="harga_potongan" name="harga_potongan">
                                
                            <div class="form-group row">
                              <label class="col-md-3 col-form-label">qty</label>
                                <div class="col-md-9">
                                  <input class="form-control reset" type="number" readonly="readonly" onkeyup="subTotal(this.value)" id="qty" min="0" name="qty" placeholder="qty">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                              <label class="col-md-3 col-form-label">sub total</label>
                                <div class="col-md-9">
                                  <input class="form-control reset" type="text" name="sub_total" id="sub_total"  readonly="" placeholder="0" value="">
                                </div>
                            </div>
                        </form>

                        <button type="button" class="btn btn-md btn-primary" id="tambah" disabled="disabled" onclick="addbarang()"><i class="fa fa-shopping-cart"></i> input</button>
                    </div>

                    <div class="col-sm-12 col-md-6 ">

                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">total</label>
                            <div class="col-md-9">
                              <input class="form-control form-control-lg res" type="text" readonly="" name="total" id="total" value="<?= number_format( 
                                  $this->cart->total(), 0 , '' , '.' ); ?>" >
                            </div>
                        </div>
						
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">bayar</label>
                            <div class="col-md-9">
                              <input class="form-control form-control-lg res" type="number" id="bayar" name="bayar" onkeyup="showKembali(this.value)"  placeholder="0">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label">kembali</label>
                            <div class="col-md-9">
                              <input class="form-control form-control-lg res" type="text" id="kembali" readonly="" name="kembali"  >
                            </div>
                        </div>
						
                    </div>
                </div>
            </div>
			
              <table id="tabelBarang" class="table table-striped table-bordered nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>no</th>
                    <th>Nama</th>
                    <th>jns</th>
                    <th>ptg</th>
                    <th>hrg ptg</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Sub total</th>
                    <th>opsi</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
			      <button type="button" class="btn btn-md btn-primary" id="selesai" disabled="disabled" >selesai </button>
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

  <script src="<?= base_url() ?>assets/jquery/jquery-3.2.1.min.js"></script>
  <script src="<?= base_url() ?>assets/bootstrap-4.1.3/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/sb-admin-2.js"></script>
  <script src="<?= base_url() ?>assets/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script>
      var table;
      $(document).ready(function(){
          table = $('#tabelBarang').DataTable({
              paging: false,
              "info": false,
              "searching": false,
              "ajax": {
                  "url": "http://localhost/penjualan/option/list_transaksi",
                  "type": "POST"
                  },
              "columnDefs": [
              {
                  "targets": [ 2,3,4,5,6,7,8 ],
                  "orderable": false,
              },
              ],
              });
           
           $('#pencarian').focus();
       });
       
       function reload_table(){
           table.ajax.reload(null,false);
       }
       
      function subTotal(qty){
          var harga = $('#harga').val().replace(".", "").replace(".", "");
          var promo = $('#jenis_promo').val();
          var potongan = $('#potongan').val();
          var hrg_potong = $('#harga_potongan').val();
          if(promo == 'minimal'){
              var induk = Math.floor(qty / potongan);
              var sisa = qty% potongan;
              var sub = (induk*hrg_potong)+(harga*sisa);
              $('#sub_total').val(convertToRupiah(sub));
              $('#tambah').removeAttr("disabled");
          }else{
              var diskon = harga - (harga*potongan/100);
              $('#sub_total').val(convertToRupiah(diskon*qty));
              $('#tambah').removeAttr("disabled");
          }
          
      }
      
      function addbarang(){
          var id = $('#id').val();
          var qty = $('#qty').val();
          $.ajax({
              url : "http://localhost/penjualan/option/add_keranjang",
              type: "POST",
              data: $('#form_transaksi').serialize(),
              dataType: "JSON",
              success: function(data){
                  reload_table();
                  $('#tambah').attr("disabled","disabled");
                  $('#qty').attr("readonly","readonly");
                  $('#bayar').focus();
              },
              error: function (jqXHR, textStatus, errorThrown){
                  alert('Error adding data');
              }
          });
          showTotal();
          showKembali($('#bayar').val());
          $('.reset').val('');
      }
      
      document.onkeydown = function(e){
        var q = $('#qty').val();
        var byr = $('#bayar').val();
        if(q !==''){
          switch(e.keyCode){
          case 13:
          addbarang();
          break;
        }
        }

        if(byr !==''){
          switch(e.keyCode){
          case 13:
          selesai();
          break;
        }
        }
      // 113 f2
      // 37 kiri 38 atas 39 kanan 40 bawah
      switch(e.keyCode){
        case 113:
        $('#pencarian').focus();
        break;
      }
      };
      
      function showTotal(){
          var total = $('#total').val().replace(".", "").replace(".", "");
          var sub_total = $('#sub_total').val().replace(".", "").replace(".", "");
          $('#total').val(convertToRupiah((Number(total)+Number(sub_total))));
      }
      
      function showKembali(str)
      {
          var total = $('#total').val().replace(".", "").replace(".", "");
          var bayar = str.replace(".", "").replace(".", "");
          var kembali = bayar-total;
          $('#kembali').val(convertToRupiah(kembali));
          if (kembali >= 0)
          {
              $('#selesai').removeAttr("disabled");
          }
          else
          {
              $('#selesai').attr("disabled","disabled");
          }
          if (total == 0)
          {
              $('#selesai').attr("disabled","disabled");
          }
  	}
    	
      function convertToRupiah(angka)
      {
          var rupiah = '';
          var angkarev = angka.toString().split('').reverse().join('');
          for(var i = 0; i < angkarev.length; i++)
          if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
          return rupiah.split('',rupiah.length-1).reverse().join('');
      }
       
       $(function(){
            $("#pencarian").autocomplete({
                minLength: 1,
                delay : 400,
                source: function(request, response) { 

                    jQuery.ajax({
                        url:      "http://localhost/penjualan/option/cari_barang",
                        data: {
                          keyword : request.term
                        },
                        dataType: "json",
                        success: function(data){
                          response(data);
                        }   
                    })
                },
                select:  function(e, ui){
                    var nama = ui.item.nama_barang;
                    var code = ui.item.id_barang;
                    $("#pencarian").val(code);
                    $("#nama_barang").val(nama);
                    $("#harga").val(convertToRupiah(ui.item.harga_jual));
                    $("#jenis_promo").val(ui.item.jenis_promo);
                    $("#potongan").val(ui.item.potongan);
                    $("#harga_potongan").val(ui.item.harga_ahir);
                    $('#qty').removeAttr("readonly");
                    $('#qty').focus();
                    return false;
                }
            })
            .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
               return $( "<li>" )
               .append( "<a>" + item.id_barang + " " + item.nama_barang + "</a>" )
               .appendTo( ul );
            };
        });
        
        $('#selesai').click(function(){
            var bayar=$('#bayar').val();
            var kembali=$('#kembali').val();
            $.ajax({
                url:"http://localhost/penjualan/option/cetak_nota/",
                data:{bayar:bayar,kembali:kembali},
                method:"POST",
                success:function(data){
                    $('#modalNota').modal('show');
                    $('#isiModal').html(data);
                    }
                });
        });

        function selesai()
        {
          var bayar=$('#bayar').val();
            var kembali=$('#kembali').val();
            $.ajax({
                url:"http://localhost/penjualan/option/cetak_nota/",
                data:{bayar:bayar,kembali:kembali},
                method:"POST",
                success:function(data){
                    $('#modalNota').modal('show');
                    $('#isiModal').html(data);
                    }
                });
        }
		
		function print_nota(){
			window.print();
			cetak_struk();
		}
		
		function cetak_struk()
		{
			$.ajax({
				url : "http://localhost/penjualan/option/shoping/",
				type: "post",
				dataType:"json",
				success:function(result){
					if(result.status == true){
						$('#modalNota').modal('hide');
						reload_table();
						$('.res').val('');
            $('#pencarian').focus();
					}else{
            alert('gagal melakukan transaksi')
          }
				},
				error: function(err){
					alert('error transaksi')
				}
			});
		}
		
		function deletebarang(id,sub_total)
		{
			$.ajax({
				url : "<?= site_url('option/deletebarang')?>/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data){
					reload_table();
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Gagal hapus barang');
				}
			});
			var ttl = $('#total').val().replace(".", "");
			$('#total').val(convertToRupiah(ttl-sub_total));
			showKembali($('#bayar').val());
		}
  </script>
  
  <!-- Modal -->
		<div class="modal fade" id="modalNota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content">
				
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			  </div>
			
			  <div class="modal-body" id="isiModal">
				
			  </div>
			
			  <div class="modal-footer">
				<button type="button" class="btn btn-success" OnClick="print_nota()"><span class="fa fa-print"></span>  Cetak</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span>  Tutup</button>
				</div>
			</div>
		  </div>
		</div>
	<!-- akhir kode modal dialog -->
  
      
</body>

</html>
