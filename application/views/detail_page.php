<!DOCTYPE html>
<html lang="en">
<head>
	<title>RESTO</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/combobox/css/bootstrap-combobox.css"> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datepicker/css/datepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.css" media="screen">
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.js"></script>
	

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<style type="text/css">
		/*.menu-kiri:hover{
			background-color: yellow;
		}*/

		.menu-active{
			background-color: #EEEEEE;
		}
	</style>
<script type="text/javascript">
  $(document).ready(function(){
  	$(".perbesar").fancybox();
    /*$('.combobox').combobox();*/
    $('#tanggal').datepicker({
        format: "dd-mm-yyyy",
        autoclose:true,
        maxDate: "now",
        startDate: "+1d"
    });  	
  });
</script>

</head>

<body>


<!-- NAVBAR -->

	<nav class="navbar navbar-default" style="background-color: #D2D7D3;">
	  <div class="container">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="<?php echo base_url('utama/logged_in') ?>">Resto.com</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <!-- <ul class="nav navbar-nav">
	        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
	        <li><a href="#">Link</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Action</a></li>
	            <li><a href="#">Another action</a></li>
	            <li><a href="#">Something else here</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">Separated link</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">One more separated link</a></li>
	          </ul>
	        </li>
	      </ul> -->
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="<?= base_url('utama/pelanggan')?>">Hai, <?php echo $this->session->userdata('user_pelanggan'); ?></a></li>
	        <li><a href="<?= base_url('utama/logout')?>">Keluar</a></li>
	        
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
<div class="container-fluid" style="background-color:white;margin-bottom:20px;">
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="margin-bottom:25px;"><h1>Hai, <?php echo $this->session->userdata('user_pelanggan');  ?></h1></div>
		</div>
	</div>
</div>
<div class="container">
	<?php echo form_open_multipart(base_url("utama/bayar/".$idpesanan), 'method="POST"') ?>
		<div class="row">
			<div class="col-md-5">
				<div class="row" style="background-color:white;margin-bottom:25px;border-radius:5px;">
					<div class="col-md-12">
						
						<h3>Detail Pesanan meja dan tempat</h3>
						<hr/>
						<?php foreach ($record_pesanan_meja as $row) {?>
						<div class="row">
							<div class="col-md-4">Nama Resto</div>
							<div class="col-md-6"><?php echo $row->nama_resto; ?></div>
						</div>
						<div class="row">
							<div class="col-md-4">Jumlah Kursi</div>
							<div class="col-md-4"><?php echo $row->jumlah_kursi; ?></div>
						</div>
						<div class="row">
							<div class="col-md-4">Tanggal datang</div>
							<div class="col-md-4"><?php echo $row->tanggal_acara; ?></div>
						</div>
						<div class="row">
							<div class="col-md-4">Jam Datang</div>
							<div class="col-md-4"><?php echo $row->jam_acara; ?></div>
						</div>
						<hr />
						<div class="row">
							<div class="col-md-3">Harga</div>
							<div class="col-md-3 col-md-offset-6" style="padding-bottom:10px;"><strong><?php echo $row->total_bayar; $total1= $row->total_bayar;?></strong></div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="col-md-6" style="margin-left:10px;">
				<div class="row" style="background-color:white;margin-bottom:25px;border-radius:5px;padding-left:10px;padding-right:10px;">
					<h3>Detail Pesanan makanan (Pembayaran di resto)</h3>
					<hr/>
					<div class="table-responsive table-hover">
						<table class="table">
			    			<thead>
			    				<tr>
			    					<th>Nama Makanan</th>
			    					<th>Jumlah Makanan</th>
			    					<th>Sub Harga</th>
			    				</tr>
			    			</thead>
			    			<tbody>
							<?php if(!empty($record_pesanan_makanan)){ ?>
								<?php foreach ($record_pesanan_makanan as $row) {?>
									<tr>
				    					<td class="text-center"><?php echo $row->nama_makanan; ?></td>
				    					<td class="text-center"><?php echo $row->jumlah_makanan; ?></td>
				    					<td class="text-center"><?php echo $row->sub_harga_makanan; ?></td>
				    				</tr>
								<?php } ?>
							<?php }else{ ?>
								<tr>
									
								</tr>
							<?php } ?>
			    			</tbody>
			    		</table>
		    		<hr/>
					</div>
					<div class="row">
						<div class="col-md-3">Harga</div>
						<div class="col-md-3 col-md-offset-6" style="padding-bottom:10px;"><strong><?php echo $total; ?></strong></div>
					</div>
				</div>
			</div>
		</div>
	    <div class="row">
			<div class="col-md-12"  >
				<div class="row" style="background-color:white;margin-bottom:25px;border-radius:5px;">
					<div class="col-md-4">
						<h3>Total yang harus di bayar</h3>
					</div>
					<div class="col-md-2 col-md-offset-6">
						<h3><?php echo $total1 ?></h3>
					</div>
					<hr />
				</div>
			</div>	
	    </div>
	    <div class="row">
	    	<div class="col-md-2 col-md-offset-10"><button class="btn btn-large btn btn-success center  " type="submit" name="tambahdata" >Lanjut Bayar</button></div>
	    </div>
	<?php echo form_close(); ?>
</div>
<!-- FOOTER -->
<!-- <div class="container-fluid" style="background-color:grey;">
	<div class="container" >
		<div class="row" >
			<div class="col-md-4 text-left"><h4>resto.com</h4></div>
			<div class="col-md-4 col-md-offset-4 text-right" ><h4>Footer</h4></div>
		</div>
	</div>
</div> -->
</body>
</html>