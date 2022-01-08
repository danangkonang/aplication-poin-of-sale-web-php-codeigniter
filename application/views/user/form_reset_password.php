<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>kasir</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <title>ecomerce</title>
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
                    <h1 class="h4 text-gray-900 mb-4">Reset password</h1>
                  </div>
                  <form class="user" action="<?php echo site_url('reset');?>" method="post" id="form-forgot">
                  <?php echo $this->session->flashdata('forgot'); ?>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" value="<?php echo set_value('email') ?>" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Your Email...">
                      <?php echo"<span class='text-danger'>".form_error('email')."</span>"; ?>
                      <?php echo"<span class='text-danger'>".$this->session->flashdata('error_email')."</span>"; ?>
                      <div class="invalid-feedback"></div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Kirim
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?php echo site_url('forgot');?>">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?php echo site_url('registrasi');?>">Create an Account!</a>
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

    $( "#form-forgot" ).validate({
      rules: {
        email: {
          required: true,
          email: true,
        }
      },
      messages: {
        email: {
          email: "email tidak valid",
          required: "Alamat email harus diisi"
        }
      }
    });
  </script>

</body>

</html>
