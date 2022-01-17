<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <title>kasir</title>
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
                    <h1 class="h4 text-gray-900 mb-4">Registrasi</h1>
                  </div>
                  <form class="user" action="<?php echo site_url('registrasi');?>" method="post" id="form-daftar">
                    <?php echo $this->session->flashdata('message'); ?>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" id="username"  value="<?php echo set_value('username'); ?>" placeholder="User name" autofocus>
                      <?php echo "<span class='text-danger'>".form_error('username')."</span>"; ?>
                      <?php echo "<span class='text-danger'>".$this->session->flashdata('error_username')."</span>"; ?>
                      <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="email" id="email"  value="<?php echo set_value('email'); ?>" placeholder="Email Address">
                      <?php echo "<span class='text-danger'>".form_error('email')."</span>"; ?>
                      <?php echo "<span class='text-danger'>".$this->session->flashdata('error_email')."</span>"; ?>
                      <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm0">
                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                        <?php echo "<span class='text-danger'>".form_error('password')."</span>"; ?>
                        <div class="invalid-feedback"></div>
                      </div>
                      <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user" name="confirm_password" id="confirm_password" placeholder="Ulang Password">
                        <?php echo "<span class='text-danger'>".form_error('confirm_password')."</span>"; ?>
                        <div class="invalid-feedback"></div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Register
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?php echo site_url('login');?>">Sudah punya account? Login!</a>
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
    let url = "<?php echo site_url() ?>";
    jQuery.validator.setDefaults({
      highlight: function(element) {
        jQuery(element).closest('.form-control').addClass('is-invalid');
      },
      unhighlight: function(element) {
        jQuery(element).closest('.form-control').removeClass('is-invalid');
      },
      errorElement: 'div',
      errorClass: 'invalid-feedback',
      errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        } else {
          error.insertAfter(element);
        }
      }
    });

    $("#form-daftar").validate({
      rules: {
        username: {
          required: true,
          minlength: 2
        },
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 5
        },
        confirm_password: {
          required: true,
          minlength: 5,
          equalTo: "#password"
        }
      },
      messages: {
        username: {
          required: "tidak boleh kosong",
          minlength: "minimal 2 characters"
        },
        password: {
          required: "tidak boleh kosong",
          minlength: "minimal 5 characters"
        },
        confirm_password: {
          required: "tidak boleh kosong",
          minlength: "minimal 5 characters",
          equalTo: "password harus sama"
        },
        email:{
          email: "email tdk valid",
          required: "tidak boleh kosong",
          remote:"email sudah terdaftar"
        }
      },
    });

    $(function(){
      if($('.alert').show()){
        hilang();
      }
    })
      
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
