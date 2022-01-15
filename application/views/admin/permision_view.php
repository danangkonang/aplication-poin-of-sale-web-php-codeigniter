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
  <title>kasir</title>
</head>

<body id="page-top">

  <div id="wrapper">
    <?php $this->load->view('component/sidebar')?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php $this->load->view('component/header')?>
        <div class="container-fluid">
          <table id="tabelBarang" class="table table-striped table-bordered nowrap text-center" style="width:100%">
            <thead>
              <tr>
                <th class="text-center">no</th>
                <th>Nama</th>
                <th>Read</th>
                <th>Create</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Option</th>
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
  <script>
    var table;
    $(document).ready(function(){
      $("body").toggleClass("sidebar-toggled");
      $(".sidebar").toggleClass("toggled");
      find_user();
      // edit_permision();
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
          "url": "http://localhost:8080/permision/find_permision",
          "type": "POST"
        },
        "lengthChange": false,
        "responsive": true,
      });
    }
    
    function reload_table(){
      table.ajax.reload(null, false);
    }
    
    function edit_user(id){
      alert(id);
    }

    function edit_permision(id, user_name){
      $.ajax({
        url : "<?php echo site_url('permision/permision_by_id')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $("#permisionModalLabel").html(`Permision: ${user_name}`);
          $("#read").prop('checked', data.data.read === "1" ? true : false);
          $("#read").prop('disabled', true);
          $("#create").prop('checked', data.data.create === "1" ? true : false);
          $("#update").prop('checked', data.data.update === "1" ? true : false);
          $("#delete").prop('checked', data.data.delete === "1" ? true : false);
          $("#user_id").val(id);
          $('#modal_permision').modal('show');
        },
        error: function (err) {
          alert('Error get data from ajax');
        }
      });
    }

    function close_modal() {
      $('#modal_permision').modal('hide');
    }

    function update_permision() {
      let isCreate = document.getElementById("create");
      let isUpdate = document.getElementById("update");
      let isDelete = document.getElementById("delete");
      $.ajax({
        url : "<?php echo site_url('permision/update_permision')?>",
        type: "POST",
        dataType: "JSON",
        data: {
          user_id: $("#user_id").val(),
          create: isCreate.checked ? 1 : 0,
          update: isUpdate.checked ? 1 : 0,
          delete: isDelete.checked ? 1 : 0,
        },
        success: function(data) {
          reload_table();
          close_modal();
        },
        error: function (err) {
          alert('Error get data from ajax');
        }
      });
    }
  </script>

  <div class="modal fade" id="modal_permision" tabindex="-1" role="dialog" aria-labelledby="permisionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="permisionModalLabel">Permision</h5>
          <button type="button" class="close" onClick="close_modal()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body form" style="position: static">
          
          <div class="container">
            <input type="hidden" class="" id="user_id">
            <div class="row">
              <div class="col">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="read">
                  <label class="custom-control-label" for="read">Read</label>
                </div>
              </div>
              <div class="col">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="1" class="custom-control-input" name="create" id="create">
                  <label class="custom-control-label" for="create">Create</label>
                </div>
              </div>
              <div class="col">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="1" class="custom-control-input" name="update" id="update">
                  <label class="custom-control-label" for="update">Update</label>
                </div>
              </div>
              <div class="col">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" value="1" class="custom-control-input" name="delete" id="delete">
                  <label class="custom-control-label" for="delete">Delete</label>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" onClick="update_permision()" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
