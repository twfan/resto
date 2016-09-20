<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datepicker/css/datepicker.css">
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/datepicker/js/bootstrap-datepicker.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<script>
  $( function() {
  	 $('#tanggal').datepicker({
        format: "dd-mm-yyyy",
        autoclose:true,
        maxDate: "now"
    });  	
  } );
</script>
<div class="container ">
	<h1 class="text-center"><a href="home">LOGO</a></h1>
	<h3 class="text-center"><strong>Daftarkan akunmu</strong></h3>
	<p class="text-center"> Sudah mempunyai akun? Masuk <a href="">disini</a></p>

	<div class="col-md-6 col-md-offset-3">
		<div class="row">
			<div class="form-group has-feedback register">
			    <input type="text" class="form-control" placeholder="Nama Lengkap" />
			    <i class="glyphicon glyphicon-user form-control-feedback"></i>
			</div>
		</div>
		<div class="row">
			
				<div class="form-group has-feedback register">
	                <input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal Lahir" />
	                <i class="glyphicon glyphicon-calendar form-control-feedback"></i>
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
				    <input type="text" class="form-control" placeholder="Nomor Handphone" />
				    <i class="glyphicon glyphicon-phone form-control-feedback"></i>
				</div>
		</div>
		<div class="row">
			<div class="form-group has-feedback register">
			    <input type="text" class="form-control" placeholder="Alamat Email" />
			    <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
			</div>
		</div>
		<div class="row">
			<div class="form-group has-feedback register">
			    <input type="password" class="form-control" placeholder="Password" />
			    <i class="glyphicon glyphicon-lock form-control-feedback"></i>
			</div>
		</div>
		<div class="row">
			<div class="form-group has-feedback register">
			    <input type="password" class="form-control" placeholder="Ulang Password" />
			    <i class="glyphicon glyphicon-lock form-control-feedback"></i>
			</div>
		</div>
		
		
		<h6>Dengan mendaftarkan akun ini, saya menyatakan setuju dengan <a href="">peraturan</a> dan <a href="">kebijakan keamanan</a> dari blabla.com</h6>
		<div class="row"><button class="btn btn-large btn-block btn-success paling bawah" type="button">DAFTAR</button></div>
	</div>
</div>
</body>
</html>