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
		<h1 class="text-center">Pemasangan iklan</h1>
		
		<p class="text-center"> * Iklan harus berdimensi 1500x600</p>
		<?php echo form_open_multipart(base_url("owner/about_system_iklan/"), 'method="POST"') ?>
		<div class="row">
			 <div class="row">
	        	<input type="hidden" name="koderesto" value="<?php echo $this->session->userdata['kode_resto']; ?>">
		        <div class="col-md-6 col-md-offset-4 center">
		        	<div class="form-group">
		        		<input type="file" class="" name="userfile" size="20"/>
		        	</div>
		        </div>
		    </div>
		</div>
		<div class="row"><button class="btn btn-large btn-block btn-success paling_bawah" type="submit" name="daftar">Pasang Iklan</button></div>
		<?php echo form_close(); ?>
	</div>
</div>
</body>
</html>