<!--?php
var_dump($this->session->userdata());
die;
?-->
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
    @media print {
      #wrapper {
        display: none;
      }

      .modal-footer,
      .modal-header {
        display: none;
      }

      title {
        display: none;
      }
    }
  </style>
</head>

<body id="page-top">
  <div id="wrapper">

    <?php $this->load->view('component/sidebar') ?>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <?php $this->load->view('component/header') ?>

        <div class="container-fluid">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-12 col-md-6 ">
                <form class="form-horizontal" id="form_order" role="form">
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Cari</label>
                    <div class="col-md-9">
                      <input class="form-control reset" id="search" name="search" type="text" placeholder="Barcode atau Nama">
                    </div>
                  </div>
                  <input type="hidden" id="product_id" name="product_id">
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama</label>
                    <div class="col-md-9">
                      <input class="form-control reset" type="text" id="product_name" name="product_name" readonly="" placeholder="Nama">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Harga</label>
                    <div class="col-md-9">
                      <input class="form-control reset" type="text" name="selling_price" id="selling_price" readonly="" placeholder="0" value="">
                    </div>
                  </div>

                  <input type="hidden" class="reset" id="jenis_promo" name="jenis_promo">
                  <input type="hidden" class="reset" id="potongan" name="potongan">
                  <input type="hidden" class="reset" id="harga_potongan" name="harga_potongan">

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Qty</label>
                    <div class="col-md-9">
                      <input class="form-control reset" type="number" readonly="readonly" onkeyup="subTotal(this.value)" id="product_qty" min="0" name="product_qty" placeholder="qty">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Sub total</label>
                    <div class="col-md-9">
                      <input class="form-control reset" type="text" name="sub_total" id="sub_total" readonly="" placeholder="0" value="">
                    </div>
                  </div>
                </form>
                <button type="button" class="btn btn-md btn-primary" id="tambah" disabled="disabled" onclick="save_to_cart()"><i class="fa fa-shopping-cart"></i> input</button>
              </div>

              <div class="col-sm-12 col-md-6 ">

                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Total</label>
                  <div class="col-md-9">
                    <input class="form-control form-control-lg res" type="text" readonly="" name="total" id="total" value="<?= number_format($this->cart->total(), 0, '', '.'); ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Bayar</label>
                  <div class="col-md-9">
                    <input class="form-control form-control-lg res" type="number" id="bayar" name="bayar" onkeyup="showKembali(this.value)" placeholder="0">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-3 col-form-label">Kembali</label>
                  <div class="col-md-9">
                    <input class="form-control form-control-lg res" type="text" id="kembali" readonly="" name="kembali">
                  </div>
                </div>

              </div>
            </div>
          </div>

          <table id="shoping_cart_table" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
              <tr>
                <th>no</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Sub total</th>
                <th>opsi</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <button type="button" class="btn btn-md btn-primary" id="selesai" disabled="disabled" onclick="preview_struck()">selesai </button>
        </div>
      </div>
      <?php $this->load->view('component/footer') ?>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="<?= base_url() ?>assets/jquery/jquery-3.2.1.min.js"></script>
  <script src="<?= base_url() ?>assets/bootstrap-4.1.3/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/sb-admin-2.js"></script>
  <script src="<?= base_url() ?>assets/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?= base_url() ?>assets/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

  <script>
    let table;
    
    $(document).ready(function(){
      list_transaction();
      $('#product_name').focus();
      listening_serch_product();
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
    });

    function list_transaction() {
      table = $('#shoping_cart_table').DataTable({
        paging: false,
        "info": false,
        "searching": false,
        "ajax": {
          "url": "http://localhost:8080/option/list_shoping_cart",
          "type": "POST"
        },
        "columnDefs": [{
          "orderable": false,
        }, ],
      });
    }

    function listening_serch_product(params) {
      $("#search").autocomplete({
          minLength: 1,
          delay: 400,
          source: function(request, response) {
            jQuery.ajax({
              url: "http://localhost:8080/option/search_product",
              data: {
                keyword: request.term
              },
              dataType: "json",
              success: function(data) {
                response(data);
              }
            })
          },
          select: function(e, ui) {
            $("#search").val('');
            $("#product_id").val(ui.item.product_id);
            $("#product_name").val(ui.item.product_name);
            $("#selling_price").val(convertToRupiah(ui.item.selling_price));
            $('#product_qty').removeAttr("readonly");
            $('#product_qty').focus();
            return false;
          }
        })
        .data("ui-autocomplete")._renderItem = function(ul, item) {
          return $("<li>")
            .append("<a style='display: flex;'><div style='width: 100px;'>" + item.barcode + "</div> " + item.product_name + "</a>")
            .appendTo(ul);
        };
    }

    function reload_table() {
      table.ajax.reload(null, false);
    }

    function subTotal(qty) {
      var harga = $('#selling_price').val().replace(".", "").replace(".", "");
      var promo = $('#jenis_promo').val();
      var potongan = $('#potongan').val();
      var hrg_potong = $('#harga_potongan').val();
      if (promo == 'minimal') {
        var induk = Math.floor(qty / potongan);
        var sisa = qty % potongan;
        var sub = (induk * hrg_potong) + (harga * sisa);
        $('#sub_total').val(convertToRupiah(sub));
        $('#tambah').removeAttr("disabled");
      } else {
        var diskon = harga - (harga * potongan / 100);
        $('#sub_total').val(convertToRupiah(diskon * qty));
        $('#tambah').removeAttr("disabled");
      }
    }

    function save_to_cart() {
      $.ajax({
        url: "http://localhost:8080/option/add_keranjang",
        type: "POST",
        data: $('#form_order').serialize(),
        dataType: "JSON",
        success: function(data){
          reload_table();
          $('#tambah').attr("disabled", "disabled");
          $('#product_qty').attr("readonly", "readonly");
          $('#bayar').focus();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding data');
        }
      });
      showTotal();
      showKembali($('#bayar').val());
      $('.reset').val('');
    }

    document.onkeydown = function(e) {
      let qty = $('#product_qty').val();
      let bill = $('#bayar').val();
      if (qty !== '') {
        switch (e.keyCode) {
          case 13:
            save_to_cart();
            break;
        }
      }
      if (bill !== '') {
        switch (e.keyCode) {
          case 13:
            finish_transaction();
            break;
        }
      }
      switch (e.keyCode) {
        case 113:
          $('#product_name').focus();
          break;
      }
    };

    function showTotal() {
      var total = $('#total').val().replace(".", "").replace(".", "");
      var sub_total = $('#sub_total').val().replace(".", "").replace(".", "");
      $('#total').val(convertToRupiah((Number(total) + Number(sub_total))));
    }

    function showKembali(str) {
      let total = $('#total').val().replace(".", "").replace(".", "");
      let bayar = str.replace(".", "").replace(".", "");
      let kembali = bayar - total;
      $('#kembali').val(convertToRupiah(kembali));
      if (kembali >= 0) {
        $('#selesai').removeAttr("disabled");
      } else {
        $('#selesai').attr("disabled", "disabled");
      }
      if (total == 0) {
        $('#selesai').attr("disabled", "disabled");
      }
    }

    function convertToRupiah(angka) {
      var rupiah = '';
      var angkarev = angka.toString().split('').reverse().join('');
      for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
      return rupiah.split('', rupiah.length - 1).reverse().join('');
    }

    function preview_struck() {
      let bayar = $('#bayar').val();
      let kembali = $('#kembali').val();
      $.ajax({
        url: "http://localhost:8080/option/save_orders/",
        data: {
          bayar: bayar,
          kembali: kembali
        },
        method: "POST",
        success: function(data) {
          $('#modal_struck').modal('show');
          $('#content_struck').html(data);
        }
      });
    }

    function finish_transaction() {
      let bayar = $('#bayar').val();
      let kembali = $('#kembali').val();
      $.ajax({
        url: "http://localhost:8080/option/cetak_nota/",
        data: {
          bayar: bayar,
          kembali: kembali
        },
        method: "POST",
        success: function(data) {
          $('#modal_struck').modal('show');
          $('#content_struck').html(data);
        }
      });
    }

    function save_cart_to_order() {
      $.ajax({
        url: "http://localhost:8080/option/shoping/",
        type: "POST",
        data: {
          time_transaction: $("#time_transaction")[0].dataset.transaction,
        },
        dataType: "json",
        success: function(result) {
          //cetak_struk();
          window.print();
          $('#modal_struck').modal('hide');
          reload_table();
          $('.res').val('');
          $('#product_name').focus();
				},
				error: function(err){
					alert('error transaksi')
				}
			});
		}
		
		function delete_cart(id, sub_total) {
			$.ajax({
				url : "<?= site_url('option/delete_shoping_cart')?>/" + id,
				type: "POST",
				dataType: "JSON",
				success: function(data){
					reload_table();
          let total = $('#total').val().replace(".", "");
          $('#total').val(convertToRupiah(total - sub_total));
          showKembali($('#bayar').val());
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Gagal hapus barang');
        }
      });
    }
  </script>

  <div class="modal fade" id="modal_struck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="modal-body" id="content_struck">

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success" OnClick="save_cart_to_order()"><span class="fa fa-print"></span> Cetak</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> Tutup</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>