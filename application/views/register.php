<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register pelanggan</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.css">
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<script>
  $( function() {
  	$("#test").click(function(){
  		alert("asdasd");
  	})
  	 $('#tanggal').datepicker({
  	 	changeYear: true,
  	 	changeMonth: true,
       dateFormat: "yy-mm-dd",
	  	yearRange: "1945:2007"
    }); 
  } );
</script>
<div class="container ">
	<h1 class="text-center"><a href="home">Pesan Meja STTS</a></h1>
	<h3 class="text-center"><strong>Daftarkan akunmu</strong></h3>
	<p class="text-center"> Sudah mempunyai akun? Masuk <a href="login">disini</a></p>
	<form action="<?php echo base_url('utama/registerpelanggan') ?>" method="POST">
		<div class="col-md-4 col-md-offset-4">
			<?php
			if($this->session->flashdata('pesan')=='email_kembar'){
			?>
			<div class="row">
				<div class="alert alert-danger">
				  <strong>Email sama!</strong> Email telah digunakan, silahkan gunakan email lain.
				</div>
			</div>
			<?php
			}
			?>
			
			
			
			<div class="row">
				<div class="form-group has-feedback register">
				    <input type="text" class="form-control" placeholder="Alamat Email" name="email" maxlength="30" value="<?php echo set_value('email'); ?>"/>
				    <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback register">
				    <input type="text" class="form-control" placeholder="Nama User" name="namauser" maxlength="150" value="<?php echo set_value('namauser'); ?>"/>
				    <i class="glyphicon glyphicon-user form-control-feedback"></i>
				</div>
			</div>
			<div class="row">
					<div class="form-group has-feedback register">
					    <input type="number" class="form-control" placeholder="Nomor Handphone" name="nohp" maxlength="25" value="<?php echo set_value('nohp'); ?>"/>
					    <i class="glyphicon glyphicon-phone form-control-feedback"></i>
					</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback register">
	                <input id="tanggal" readonly type="text" class="form-control " name="tanggal"  placeholder="Tanggal Lahir" maxlength="10" name="tanggal" value="<?php echo set_value('tanggal'); ?>"/>
	                <i  id="test" class=" glyphicon glyphicon-calendar form-control-feedback"></i>        	
	            </div>
			</div>
			<div class="row">
				<div class="form-group has-feedback register">
					<label class="radio-inline"> <input type="radio" name="gender" value="Pria">Pria</input></label>
					<label class="radio-inline" > <input type="radio" name="gender" value="Wanita">Wanita</input></label>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback register">
				    <input type="password" class="form-control" placeholder="Password" name="password" maxlength="25" />
				    <i class="glyphicon glyphicon-lock form-control-feedback"></i>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback register">
				    <input type="password" class="form-control" placeholder="Ulang Password" name="konfpassword"/>
				    <i class="glyphicon glyphicon-lock form-control-feedback"></i>
				</div>
			</div>
			<div class="row">
				<h6 style="text-align:center;">Dengan mendaftarkan akun ini, saya menyatakan setuju dengan <a href="">peraturan</a> dan <a href="">kebijakan keamanan</a> dari resto.com</h6>
			</div>
			
			<div class="row"><button class="btn btn-large btn-block btn-success paling bawah" type="submit" name="daftar">DAFTAR</button></div>
		</div>
	</form>
</div>
</body>
</html>