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
        format: "yyyy-mm-dd",
        autoclose:true,
        maxDate: "now"
    });  	
  } );
</script>
<div class="container ">
	<div class="col-md-6 col-md-offset-3">
			<h1 class="text-center"><a href="home">RESTO</a></h1>
			<h3 class="text-center" ><strong>Awali sukses restauran mu dengan Resto</strong></h3>
			<p class="text-center"> Kita senang berbincang-bincang dengan para kustomer tentang bisnis unik mereka, telpon kami di <a href="">031-8381400</a>, kirim email ke <a href="">marketing@resto.com</a> atau deskripsikan restauranmu di bawah ini.</p>
			<form action="http://localhost/resto/utama/registerpelanggan/kirim" method="POST">
			<hr>
			<div class="row">
				<div class="col-md-6">
					<input type="text" class="form-control" placeholder="Nama depan"  name="nama" maxlength="35"/>
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" placeholder="Nama belakang"  name="nama" maxlength="35"/>
				</div>
			</div>
			<div class="row" style="margin-top:10px;">
				<div class="col-md-6">
					<input type="text" class="form-control" placeholder="Nomor telpon"  name="nama" maxlength="35"/>
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" placeholder="Alamat Email"  name="nama" maxlength="35"/>
				</div>
			</div>
			<div class="row" style="margin-top:10px;">
				<div class="col-md-6">
					<input type="text" class="form-control" placeholder="Nama Restaurant"  name="nama" maxlength="35"/>
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" placeholder="Alamat Restaurant"  name="nama" maxlength="35"/>
				</div>
			</div>
			<div class="row" style="margin-top:10px;">
				<div class="col-md-4">
					<input type="text" class="form-control" placeholder="Kode pos"  name="nama" maxlength="35"/>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control" placeholder="Kota"  name="nama" maxlength="35"/>
				</div>
				<div class="col-md-4">
					<input type="text" class="form-control" placeholder="provinsi"  name="nama" maxlength="35"/>
				</div>
			</div>
			
			<div class="row" style="margin-top:10px;">
				<div class="col-md-12">
					<textarea class="form-control" rows="4" cols="74" placeholder="Ketikan beberapa pendapat atau pertanyaan apabila ada"></textarea>
				</div>
				
			</div>
			<!-- <div class="row">
				<div class="form-group has-feedback register">
				    <input type="text" class="form-control" placeholder="Nama Lengkap"  name="nama" maxlength="35"/>
				    <i class="glyphicon glyphicon-user form-control-feedback"></i>
				</div>
			</div>
			<div class="row">
					<div class="form-group has-feedback register">
					    <input type="text" class="form-control" placeholder="Nomor Handphone" name="nohp" maxlength="25"/>
					    <i class="glyphicon glyphicon-phone form-control-feedback"></i>
					</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback register">
				    <input type="text" class="form-control" placeholder="Alamat Email" name="email" maxlength="30"/>
				    <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback register">
				    <input type="text" class="form-control" placeholder="Nama restaurant" name="nama_resto" maxlength="35"/>
				    <i class="glyphicon glyphicon-cutlery form-control-feedback"></i>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback register">
				    <input type="text" class="form-control" placeholder="Provinsi" name="nama_resto" maxlength="35"/>
				    <i class="glyphicon glyphicon-cutlery form-control-feedback"></i>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback register">
				    <input type="text" class="form-control" placeholder="Nama restaurant" name="nama_resto" maxlength="35"/>
				    <i class="glyphicon glyphicon-cutlery form-control-feedback"></i>
				</div>
			</div> -->
			
			<h6>Dengan mendaftarkan akun ini, saya menyatakan setuju dengan <a href="">peraturan</a> dan <a href="">kebijakan keamanan</a> dari blabla.com</h6>
			<div class="row"><button class="btn btn-large btn-block btn-success paling bawah" type="submit" name="daftar">DAFTAR</button></div>
		</div>
	</form>
</div>
</body>
</html>