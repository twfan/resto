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
			<h3 class="text-center" ><strong>Awali sukses restauranmu dengan Resto</strong></h3>
			<p class="text-center"> Kita senang berbincang-bincang dengan para kustomer tentang bisnis unik mereka, telpon kami di <a href="">031-8381400</a>, kirim email ke <a href="">marketing@resto.com</a> atau deskripsikan restauranmu di bawah ini.</p>
			<form action="http://localhost/resto/utama/register_resto" method="POST">
			<hr>
			<?php
			if($this->session->flashdata('pesan')!=''){
			?>
			<div class="row">
				<?php echo $this->session->flashdata('pesan'); ?>
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
			<div class="row" style="margin-top:10px;">
				<div class="col-md-6">
					<input type="text" class="form-control" placeholder="Nama Restaurant"  name="nama_resto" value="<?php echo set_value('nama_resto'); ?>"maxlength="35"/>
				</div>
				<div class="col-md-6">
					<input type="text" class="form-control" placeholder="Alamat Restaurant"  name="alamat_resto" value="<?php echo set_value('alamat_resto'); ?>" maxlength="35"/>
				</div>
			</div>
			<div class="row" style="margin-top:10px;">
				<div class="col-md-4">
					<input type="text" class="form-control" placeholder="Kode pos"  name="kode_pos" value="<?php echo set_value('kode_pos'); ?>" maxlength="35"/>
				</div>
				
				<div class="col-md-4">
					<select class="combobox form-control" style="height:33px;" prompt="Provinsi" name="provinsi" value="<?php echo set_value('provinsi'); ?>">
						<option value="" disabled selected>Provinsi</option>
						<option value="JATIM">Jawa Timur</option>
					</select>
				</div>
				<div class="col-md-4">
					<!-- <input type="text" class="form-control" placeholder="Kota"  name="nama" maxlength="35"/> -->
					<select class="combobox form-control" style="height:33px;" prompt="Kota" name="kota" value="<?php echo set_value('kota'); ?>">
						<option value="" disabled selected>Kota</option>
						<option value="SBY">Kota Surabaya</option>
						<option value="SDA">Kab. Sidoarjo</option>
						<option value="MLG">Kota Malang</option>
						<option value="PRO">Kota Probolinggo</option>
					</select>
				</div>
			</div>
			
			<div class="row" style="margin-top:10px;">
				<div class="col-md-12">
					<textarea class="form-control" rows="4" cols="74" name="deskripsi" value="<?php echo set_value('deskripsi'); ?>" placeholder="Ceritakan sekilas tentang restoran yang anda miliki"></textarea>
				</div>
				
			</div>
			<h6>Dengan mendaftarkan akun ini, saya menyatakan setuju dengan <a href="">peraturan</a> dan <a href="">kebijakan keamanan</a> dari resto.com</h6>
			<div class="row"><button class="btn btn-large btn-block btn-success paling bawah" type="submit" name="daftar">Kirim ke Resto</button></div>
		</div>
	</form>
</div>
</body>
</html>