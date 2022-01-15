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

          <div id="qr-reader" class="mb-5"></div>
          <div id="qr-reader-results"></div>

          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-12 col-md-4">
                <form class="form-horizontal" id="form_order" role="form">
                  <div id="qr-reader" style="width:300px"></div>
                  <div id="qr-reader-results"></div>

                  <div class="form-group row">
                    <div class="col">
                      <input class="form-control reset border-primary" id="search" name="search" type="text" placeholder="Cari Barcode atau Nama">
                    </div>
                  </div>

                  <input type="hidden" class="reset" id="product_id" name="product_id">
                  <input type="hidden" class="reset" id="val_selling_price" name="selling_price">
                  <input type="hidden" class="reset" id="val_product_name" name="product_name">
                  <input type="hidden" class="reset" id="val_product_qty" name="stock_product_qty">

                  <input type="hidden" class="reset" id="jenis_promo" name="jenis_promo">
                  <input type="hidden" class="reset" id="potongan" name="potongan">
                  <input type="hidden" class="reset" id="harga_potongan" name="harga_potongan">
                  <input type="hidden" class="reset" name="total" id="val_total" value="<?= $this->cart->total() ?>">
                  <input type="hidden" class="reset" id="kembali" readonly="" name="kembali">

                </form>


                <div class="form-group row">
                  <div class="col">
                    <label class="col-form-label">Bayar</label>
                    <input class="form-control form-control-lg border-danger" type="number" id="bayar" name="bayar" oninput="showKembali(this.value)" placeholder="0">
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-8">
                <h1 class="">
                  <div class="d-flex justify-content-between">
                    <div class="">Total : </div>
                    <div class="d-flex">
                      <div class="">Rp. </div>
                      <div class="text-danger" id="total_belanja">
                        <?= number_format($this->cart->total(), 0, '', '.') ?>
                      </div>
                    </div>
                  </div>
                </h1>
                <h1 class="">
                  <div class="d-flex justify-content-between">
                    <div class="">Bayar : </div>
                    <div class="d-flex">
                      <div class="">Rp. </div>
                      <div class="text-danger" id="total_bayar">0</div>
                    </div>
                  </div>
                </h1>
                <h1 class="">
                  <div class="d-flex justify-content-between">
                    <div class="">Kembali : </div>
                    <div class="d-flex">
                      <div class="">Rp. </div>
                      <div class="text-danger" id="total_kembali">0</div>
                    </div>
                  </div>
                </h1>
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
                <button type="button" class="btn btn-md btn-primary" id="selesai" disabled="disabled" onclick="preview_struck()">Selesai Transaksi</button>
              </div>
            </div>
          </div>

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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  <script>
    let table;

    $(document).ready(function() {
      list_transaction();
      $('#product_name').focus();
      listening_serch_product();
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
    });

    function docReady(fn) {
      // see if DOM is already available
      if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
      } else {
        document.addEventListener("DOMContentLoaded", fn);
      }
    }

    docReady(function() {
      var resultContainer = document.getElementById('qr-reader-results');
      var lastResult, countResults = 0;

      function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {
          ++countResults;
          lastResult = decodedText;
          // Handle on success condition with the decoded message.
          console.log(`Scan result ${decodedText}`, decodedResult);
          findProductByBarcode(decodedText);
        }
      }

      var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
        fps: 10,
        qrbox: 250
      });
      html5QrcodeScanner.render(onScanSuccess);
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

    function findProductByBarcode(barcode) {
      $.ajax({
        url: "http://localhost:8080/product/find_by_barcode/" + barcode,
        type: "GET",
        success: function(data) {
          let item = JSON.parse(data);
          $("#search").val('');
          $("#product_name").text(item.product_name);
          $("#product_stock").text(item.product_qty);
          $("#selling_price").text(convertToRupiah(item.selling_price));
          $("#product_id").val(item.product_id);
          $("#val_selling_price").val(item.selling_price);
          $("#val_product_name").val(item.product_name);
          $("#val_product_qty").val(item.product_qty);
          save_to_cartv2(item.product_id, item.product_name, item.selling_price)
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding data');
        }
      });
    }

    function listening_serch_product(params) {
      $("#search").autocomplete({
          minLength: 1,
          delay: 100,
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
            $("#product_name").text(ui.item.product_name);
            $("#product_stock").text(ui.item.product_qty);
            $("#selling_price").text(convertToRupiah(ui.item.selling_price));
            $("#product_id").val(ui.item.product_id);
            $("#val_selling_price").val(ui.item.selling_price);
            $("#val_product_name").val(ui.item.product_name);
            $("#val_product_qty").val(ui.item.product_qty);
            save_to_cartv2(ui.item.product_id, ui.item.product_name, ui.item.selling_price)
            return false;
          }
        })
        .data("ui-autocomplete")._renderItem = function(ul, item) {
          return $("<li>")
            .append("<a style='display: flex;'><div style='width: 150px;'>" + item.barcode + "</div> " + item.product_name + "</a>")
            .appendTo(ul);
        };
    }

    function reload_table() {
      table.ajax.reload(null, false);
    }

    function subTotal(qty) {
      if (qty > $("#val_product_qty").val()) {
        swal({
          title: "Ups?",
          text: "Qty Melebihi Stok",
          dangerMode: true,
        });
      }
      let harga = $('#val_selling_price').val();
      let promo = $('#jenis_promo').val();
      let potongan = $('#potongan').val();
      let hrg_potong = $('#harga_potongan').val();
      if (promo == 'minimal') {
        let induk = Math.floor(qty / potongan);
        let sisa = qty % potongan;
        let sub = (induk * hrg_potong) + (harga * sisa);
        $('#sub_total').val(convertToRupiah(sub));
        $('#tambah').removeAttr("disabled");
      } else {
        let diskon = harga - (harga * potongan / 100);
        $('#sub_total').text(convertToRupiah(diskon * qty));
        $('#tambah').removeAttr("disabled");
      }
    }

    function save_to_cart() {
      $.ajax({
        url: "http://localhost:8080/option/add_keranjang",
        type: "POST",
        dataType: "JSON",
        data: $('#form_order').serialize(),
        success: function(data) {
          $("#total_belanja").text(convertToRupiah(data.total));
          reload_table();
          $('#val_total').val(data.total);
          $("#product_name").text('');
          $("#product_stock").text('');
          $("#selling_price").text('');
          $('#sub_total').text('');
          $('#tambah').attr("disabled", "disabled");
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding data');
        }
      });
      $('.reset').val('');
    }

    function save_to_cartv2(id, name, price) {
      $.ajax({
        url: "http://localhost:8080/option/add_keranjang",
        type: "POST",
        dataType: "JSON",
        data: {
          product_id: id,
          product_name: name,
          selling_price: price,
          product_qty: 1,
        },
        success: function(data) {
          $("#total_belanja").text(convertToRupiah(data.total));
          reload_table();
          $('#val_total').val(data.total);
          $("#product_name").text('');
          $("#product_stock").text('');
          $("#selling_price").text('');
          $('#sub_total').text('');
          $('#tambah').attr("disabled", "disabled");
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding data');
        }
      });
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

    function showKembali(bayar) {
      if (bayar === '') {
        $("#total_bayar").text(0);
        $("#total_kembali").text(0);
        $('#selesai').attr("disabled", "disabled");
      } else {
        let total = $('#val_total').val();
        let kembalian = bayar - total
        $("#total_bayar").text(convertToRupiah(bayar));
        $("#total_kembali").text(convertToRupiah(kembalian));
        if (kembalian >= 0) {
          $('#selesai').removeAttr("disabled");
        } else {
          $('#selesai').attr("disabled", "disabled");
        }
      }
    }

    function convertToRupiah(angka) {
      let rupiah = '';
      let angkarev = angka.toString().split('').reverse().join('');
      for (let i = 0; i < angkarev.length; i++) {
        if (i % 3 == 0) {
          rupiah += angkarev.substr(i, 3) + '.';
        }
      }
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

    // function finish_transaction() {
    //   let bayar = $('#bayar').val();
    //   let kembali = $('#kembali').val();
    //   $.ajax({
    //     url:"http://localhost:8080/option/cetak_nota/",
    //     data:{
    //       bayar: bayar,
    //       kembali: kembali
    //     },
    //     method:"POST",
    //     success:function(data){
    //       $('#modal_struck').modal('show');
    //       $('#content_struck').html(data);
    //     }
    //   });
    // }
    function print_transaction() {
      document.title = new Date();
      window.print();
      save_transaction();
    }

    function save_transaction() {
      const d = new Date();
      let year = d.getFullYear();
      let day = d.getDate();
      let month = d.getMonth();
      $.ajax({
        url: "http://localhost:8080/transaction/create_transaction/",
        type: "POST",
        data: {
          code_transaction: `TR${year}${day}${month}${"<?= $this->session->userdata('user_id') ?>"}`,
        },
        dataType: "json",
        success: function(result) {
          $('#modal_struck').modal('hide');
          reload_table();
          $('#bayar').val(0);
          $("#total_bayar").text(0);
          $("#total_kembali").text(0);
          $("#total_belanja").text(0);
          $('#search').focus();
        },
        error: function(err) {
          alert('error transaksi')
        }
      });
    }

    function delete_cart(rowid) {
      $.ajax({
        url: "<?= site_url('option/delete_shoping_cart') ?>/" + rowid,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          $("#total_belanja").text(convertToRupiah(data.total));
          reload_table();
          $('#val_total').val(data.total);
          showKembali($('#bayar').val());
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Gagal hapus barang');
        }
      });
    }

    function plus_cart(id, name, price) {
      $.ajax({
        url: "http://localhost:8080/option/add_keranjang",
        type: "POST",
        data: {
          product_id: id,
          product_name: name,
          selling_price: price,
          product_qty: 1,
        },
        dataType: "JSON",
        success: function(data) {
          $("#total_belanja").text(convertToRupiah(data.total));
          reload_table();
          $('#val_total').val(data.total);
          $('#sub_total').text('');
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('Error adding data');
        }
      });
    }

    function minus_cart(id, name, price, qty, rowid) {
      if (qty < 2) {
        delete_cart(rowid);
      } else {
        $.ajax({
          url: "http://localhost:8080/option/add_keranjang",
          type: "POST",
          data: {
            product_id: id,
            product_name: name,
            selling_price: price,
            product_qty: -1,
          },
          dataType: "JSON",
          success: function(data) {
            $("#total_belanja").text(convertToRupiah(data.total));
            reload_table();
            $('#val_total').val(data.total);
            $('#sub_total').text('');
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error adding data');
          }
        });
      }
    }
  </script>

  <div class="modal fade" id="modal_struck" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div class="modal-body" id="content_struck"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" OnClick="save_transaction()"><span class="fa fa-print"></span>Simpan</button>
          <button type="button" class="btn btn-success" OnClick="print_transaction()"><span class="fa fa-print"></span>Cetak dan Simpan</button>
        </div>
      </div>
    </div>

</body>

</html>