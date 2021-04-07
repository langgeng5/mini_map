<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Koperasi Bayu Dana Mandiri</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='<?php echo base_url();?>assets/iconkoperasi.png' rel='SHORTCUT ICON'/>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte304/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte304/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte304/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte304/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte304/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte304/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte304/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte304/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<!-- jQuery -->
<script src="<?php echo base_url();?>assets/adminlte304/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/adminlte304/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/adminlte304/dist/js/adminlte.min.js"></script>  
	</head>

<style>
  .bg{
background: url('<?= base_url('assets/back01.jpg') ?>') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;}
</style>

<body class="bg hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
<div class="login-logo"><img src="<?php echo base_url();?>assets/logobdmlogin.png" width="300px"></div>


	<form id="loginForm" method="post">
        <div class="input-group mb-3">
           <input id="userku" type="text" name="userku" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="passku" type="password" name="passku" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block">MASUK</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
	  <p class="text-center small">
	  <br><a href="https://api.whatsapp.com/send?phone=6285237983639">support : ITM Bali</a>
	  </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

</body>
</html>
<script>
      $("#loginForm").submit(function(event) {
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('auth/do_auth_operator/'); ?>",
            // dataType: 'json',
            data: {
              userku: $('#userku').val(),
              passku: $('#passku').val()
            },
            success: function(data) {
              console.log(data);
              if(data.status == false){
                  alert('USER TIDAK DITEMUKAN');
              }else{
                window.location = "<?php echo site_url('anggota'); ?>";
              }
            },
            // error: function () {
            //     alert('** KONEKSI DATABASE BERMASALAH **');
            // }
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                alert(msg);
            },
            
          }
        );
      });

    </script>