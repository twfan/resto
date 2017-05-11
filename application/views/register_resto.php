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
	<style type="text/css">
	.paling_bawah{
		margin-bottom: 25px;
	}
	</style>
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
		<h3 class="text-center" ><strong>Awali sukses restauranmu dengan Resto</strong></h3>
		<p class="text-center"> Kita senang berbincang-bincang dengan para kustomer tentang bisnis unik mereka, telpon kami di <a href="">031-8381400</a>, kirim email ke <a href="">marketing@resto.com</a> atau deskripsikan restauranmu di bawah ini.</p>
		<form action="<?php echo base_url('owner/register_resto') ?>" method="POST">
		<hr>
		<?php
			
			if($this->session->flashdata('pesan')!=''){
			?>
			<div class="row">
				<?php if($this->session->flashdata('pesan')=="Email sama"){ ?>
					<div class="alert alert-danger">
					  <strong>Gagal terdaftar!</strong> Email telah terdaftar, silahkan menggunakan email yang lain.
					</div>
				<?php }?>
			</div>
			<?php
			}
			?>
		
		<div class="row">
			<div class="col-md-6">
				<input type="text" class="form-control" placeholder="Nama depan"  name="nama_depan" value="<?php echo set_value('nama_depan'); ?>" maxlength="35"/>
			</div>
			<div class="col-md-6">
				<input type="text" class="form-control" placeholder="Nama belakang"  name="nama_belakang" value="<?php echo set_value('nama_belakang'); ?>" maxlength="35"/>
			</div>
		</div>
		<div class="row" style="margin-top:10px;">
			<div class="col-md-6">
				<input type="text" class="form-control" placeholder="Nomor telpon"  name="telpon" value="<?php echo set_value('telpon'); ?>" maxlength="35"/>
			</div>
			<div class="col-md-6">
				<input type="text" class="form-control" placeholder="Alamat Email"  name="email" value="<?php echo set_value('email'); ?>" maxlength="35"/>
			</div>
		</div>
		<div class="row" style="margin-top:10px;">
			<div class="col-md-6">
				<input type="password" class="form-control" placeholder="Password"  name="password"  maxlength="25"/>
			</div>
			<div class="col-md-6">
				<input type="password" class="form-control" placeholder="Ketik ulang password"  name="konf_password"  maxlength="25"/>
			</div>
		</div>
		
		
		
		
		<h6>Dengan mendaftarkan akun ini, saya menyatakan setuju dengan <a href="">peraturan</a> dan <a href="">kebijakan keamanan</a> dari resto.com</h6>
		<div class="row"><button class="btn btn-large btn-block btn-success paling_bawah" type="submit" name="daftar">Kirim ke Resto</button></div>
		</form>
	</div>
	
</div>
</body>
</html>