<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMPLEJAK PPU</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/eksternal/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/eksternal/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      html, body {
        height: 100%;
      }
      .login-page { background-color: #fff; }
      .login-box { background-color: #d2d6de; height: fit-content; }
      .content { padding: 7rem 0; }
      .content .contents, .content .bg { width: 50%; }
    </style>
  </head>
  <body class="hold-transition login-page">
    <!-- <div class="content"> -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-8 hidden-xs">
            <img src="assets/img/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid">
          </div>
          <div class="col-xs-12 col-sm-6 col-md-4">

            <div class="login-box">
              <div class="login-logo">
                <b>SIMPLE JAK</b>PPU
              </div>

              <!-- /.login-logo -->
              <div class="login-box-body">
                <p class="login-box-msg">
                  Log in to start your session
                </p>

                <form action="<?php echo base_url('Auth/login'); ?>" method="post">
                  <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="auwfar" name="username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="auwfar" name="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="row">
                    <div class="col-xs-12">
                      <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                  </div>
                </form>

                <!-- <div class="social-auth-links text-center">
                  <p>- OR -</p>
                  <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                  <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                    Google+</a>
                </div> -->
                <!-- /.social-auth-links -->

                <!-- <a href="#">I forgot my password</a><br>
                <a href="register.html" class="text-center">Register a new membership</a> -->

              </div>
              <!-- /.login-box-body -->
              <?php
                echo show_err_msg($this->session->flashdata('error_msg'));
              ?>
            </div>
            <!-- /.login-box -->

          </div>
        </div>
      <!-- </div> -->
    </div>

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <!-- <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script> -->
    <!-- <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script> -->
  </body>
</html>
