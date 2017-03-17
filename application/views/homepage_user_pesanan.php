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
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/datepicker/js/bootstrap-datepicker.js"></script>
	

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
    <div class="row">
    	<div class="col-md-2" style="margin-bottom:25px; margin-right:20px;">
			<a href="<?php echo base_url('utama/pelanggan'); ?>">
    			<div class="row menu-kiri menu-active" style="padding-bottom:20px;padding-top:20px;">
					<div class="col-md-12 text-center " >Pesanan</div>
				</div>
    		</a>
    		<a href="<?php echo base_url('utama/pelanggan_data_diri'); ?> ">
    			<div class="row menu-kiri " style="padding-bottom:20px;padding-top:20px;">
					<div class="col-md-12 text-center " >Data diri</div>
				</div>
    		</a>
    		<a href="<?php echo base_url('utama/top_up_saldo'); ?> ">
    			<div class="row menu-kiri  " style="padding-bottom:20px;padding-top:20px;">
					<div class="col-md-12 text-center " >Pembayaran</div>
				</div>
    		</a>
		</div>
		<div class="col-md-9"  >
			<div class="row" style="background-color:white;margin-bottom:25px;border-radius:5px;">
				<div class="col-md-12">
					<h3>Pesanan yang sedang berlangsung</h3>
					<hr/>
					<div class="table-responsive">
			    		<table class="table">
			    			<thead>
			    				<tr>
			    					<th>Kode Pesanan</th>
			    					<th>Nama Resto</th>
			    					<th>Jumlah Kursi</th>
			    					<th>Tanggal acara</th>
			    					<th>Jam Acara</th>
			    					<th>Bukti Bayar</th>
			    					<th>Aksi</th>
			    				</tr>	
			    			</thead>
			    			<tbody>
		    				<?php if(!empty($record_pesanan)){ ?>
								<?php foreach ($record_pesanan as $row) {?>
									<tr>
				    					<td class="text-center"><?php echo $row->id_pesanan; ?></td>
				    					<td class="text-center"><?php echo $row->nama_resto; ?></td>
				    					<td class="text-center"><?php echo $row->jumlah_kursi; ?></td>
				    					<td class="text-center"><?php echo $row->tanggal_acara; ?></td>
				    					<td class="text-center"><?php echo $row->jam_acara; ?></td>
				    					<td><img src="<?php echo $row->bukti_bayar; ?>" style="width:100px;height:100px;"></td>
				    					<?php if($row->status_pemesanan=='belum disetujui'){ ?>
				    					<td ><a href="#" class="btn btn-info btn-xs" style="width:100px;"><span class="glyphicon glyphicon-remove"></span> Remove</a></td>
				    					<?php }elseif($row->status_pemesanan=='lanjut pembayaran'){ ?>
				    					<td ><a href="<?php echo base_url('utama/bayar_pesanan/'.$row->id_pesanan) ?>" class="btn btn-success btn-xs" style="width:100px;"><span class="glyphicon glyphicon-ok"></span> Bayar</a><br><br><a href="#" class="btn btn-info btn-xs" style="width:100px;"><span class="glyphicon glyphicon-remove"></span> Remove</a></td>
				    					<?php } ?>
				    					<!-- <td ><a href="#" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-remove"></span> Remove</a></td> -->
				    				</tr>
								<?php } ?>
							<?php }else{ ?>
								<tr>
									<td></td>
								</tr>
							<?php } ?>
			    			</tbody>
			    		</table>
					</div>
					<?php if(!empty($record_pesanan)){ ?>
						<?php foreach ($record_pesanan as $row) {?>
							
						<?php } ?>
					<?php }else{ ?>
						
					<?php } ?>
				</div>
			</div>
			<div class="row" style="background-color:white;margin-bottom:25px;border-radius:5px;">
				<div class="col-md-12">
					<h3>Pesanan yang telah selesai</h3>
					<hr/>
				</div>
			</div>
		</div>	
    </div>
</div>
<!-- FOOTER -->
<div class="container-fluid" style="background-color:grey;">
	<div class="container" >
		<div class="row" >
			<div class="col-md-4 text-left"><h4>resto.com</h4></div>
			<div class="col-md-4 col-md-offset-4 text-right" ><h4>Footer</h4></div>
		</div>
	</div>
</div>
</body>
</html>