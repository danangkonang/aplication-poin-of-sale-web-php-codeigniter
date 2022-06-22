<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/images/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <title>Login</title>
  <style>
    .alert{
      position: fixed;
      top: 100px;
      left: 50%;
      transform: translate(-50%, 0);
      z-index: 99;
    }
  </style>
</head>
<body class="bg-gradient-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form id="form-login">
                    <?php echo $this->session->flashdata('error'); ?>
                    <?php echo $this->session->flashdata('message'); ?>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" value="admin@email.com" name="email" id="email" aria-describedby="emailHelp" placeholder="Email">
                      <?php echo"<span class='text-danger'>".form_error('email')."</span>"; ?>
                      <?php echo"<span class='text-danger'>".$this->session->flashdata('error_email')."</span>"; ?>
                      <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" value="password" name="password" id="password" placeholder="Password">
                      <?php echo"<span class='text-danger'>".form_error('password')."</span>"; ?>
                      <?php echo"<span class='text-danger'>".$this->session->flashdata('error_password')."</span>"; ?>
                      <div class="invalid-feedback"></div>
                    </div>
                    <button type="button" id="btn-login" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?php echo site_url('reset');?>">Lupa Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?php echo site_url('registrasi');?>">Daftar Akun!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <script src="<?php echo base_url() ?>assets/jquery/jquery-3.2.1.min.js"></script>
  <script type="text/javascript">

    $("#btn-login").click(function(){
      let email = $("#email").val();
      let password = $("#password").val();

      $.ajax({
        url : '<?= site_url('login/loginv2') ?>',
        type: "POST",
        data:{email:email, password:password},
        dataType: "JSON",
        success: function(response) {
          if (response.status === 200){
            window.location.replace("<?= site_url() ?>");
          } else {
            alert(response.message);
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert("error", errorThrown);
        }
      });
    });

    $(function(){
      if($('.alert').show()){
        hilang();
      }
    });
      
    function hilang(){
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 4000);
    }
  </script>

</body>
</html>
