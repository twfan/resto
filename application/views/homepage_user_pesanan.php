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
			    					<th>Total Bayar</th>
			    					<th>Bukti Bayar</th>
			    					<th>Aksi</th>
			    				</tr>	
			    			</thead>
			    			<tbody>
		    				<?php if(!empty($record_pesanan)){ ?>
								<?php foreach ($record_pesanan as $row) {?>
								<?php

									$tanggal_acara = date($row->tanggal_acara);
									$jam_acara = date($row->jam_acara)+1.01	;

									date_default_timezone_set('Asia/Jakarta');
									$jam_sekarang=date("H:i");
									$tanggal_sekarang =  date("Y-m-d");
									
								?>
									<?php if($tanggal_acara >= $tanggal_sekarang ){  ?>
										<?php if(date($jam_acara) >= date($jam_sekarang)) {?>
											<!-- tidak terlambat -->
											<tr>
						    					<td class="text-center"><strong><?php echo $row->id_pesanan; ?></strong></td>
						    					<td class="text-center"><?php echo $row->nama_resto; ?></td>
						    					<td class="text-center"><?php echo $row->jumlah_kursi; ?></td>
						    					<td class="text-center"><?php echo $row->tanggal_acara; ?></td>
						    					<td class="text-center"><?php echo $row->jam_acara; ?></td>
						    					<td class="text-center"><?php echo number_format($row->total_bayar); ?></td>
						    					<td>
						    						<?php if($row->bukti_bayar=="saldo"){ ?>

						    						<?php echo "saldo"; ?>
						    						<?php }elseif($row->bukti_bayar!=""){ ?>
						    						<a href="<?php echo $row->bukti_bayar; ?>" class="perbesar">
						    							<img  src="<?php echo $row->bukti_bayar; ?>" style="width:100px;height:100px;">
						    						</a>
						    						<?php }else{ ?>
						    						<a href="<?php echo base_url(); ?>uploads/default.png" class="perbesar" >
														<img src="<?php echo base_url(); ?>uploads/default.png" width="100">
													</a>
						    						<?php } ?>
						    					</td>
						    					<?php if($row->status_pemesanan=='belum disetujui'){ ?>
						    					<td ><a href="<?php echo base_url('utama/detail_page/'.$row->id_pesanan) ?>" class="btn btn-info btn-xs" style="width:100px;"><span class="glyphicon glyphicon-success"></span> Bayar</a></td>
						    					<?php }elseif($row->status_pemesanan=='lanjut pembayaran'){ ?>
						    					<td ><a href="<?php echo base_url('utama/bayar/'.$row->id_pesanan) ?>" class="btn btn-success btn-xs" style="width:100px;"><span class="glyphicon glyphicon-ok"></span> Bayar</a><br><br><a href="<?php echo base_url('utama/pesan_makan/'.$row->kode_resto.'/'.$row->id_pesanan) ?>" class="btn btn-info btn-xs" style="width:100px;"><span class="glyphicon glyphicon-cutlery"></span> Pesan Makan</a></td>
						    					<?php }elseif($row->status_pemesanan=='pelanggan membayar'){  ?>
						    					<td><a href="" class="btn btn-warning btn-xs disabled"><span class="glyphicon glyphicon-usd"></span> Menunggu konfirmasi</a></td>
						    					<?php }elseif($row->status_pemesanan=='selesai'){  ?>
						    					<td><a href="" class="btn btn-success btn-xs disabled"><span class="glyphicon glyphicon-ok"></span> Pemesanan Berhasil</a></td>
						    					<?php } ?>
						    				</tr>
										<?php }else{ ?>
										<!-- kalo terlambat -->
											<tr>
						    					<td class="text-center"><strong><?php echo $row->id_pesanan; ?></strong></td>
						    					<td class="text-center"><?php echo $row->nama_resto; ?></td>
						    					<td class="text-center"><?php echo $row->jumlah_kursi; ?></td>
						    					<td class="text-center"><?php echo $row->tanggal_acara; ?></td>
						    					<td class="text-center"><?php echo $row->jam_acara; ?></td>
						    					<td class="text-center"><?php echo number_format($row->total_bayar); ?></td>
						    					<td>
						    						<?php if($row->bukti_bayar=="saldo"){ ?>

						    						<?php echo "saldo"; ?>
						    						<?php }elseif($row->bukti_bayar!=""){ ?>
						    						<a href="<?php echo $row->bukti_bayar; ?>" class="perbesar">
						    							<img  src="<?php echo $row->bukti_bayar; ?>" style="width:100px;height:100px;">
						    						</a>
						    						<?php }else{ ?>
						    						<a href="<?php echo base_url(); ?>uploads/default.png" class="perbesar" >
														<img src="<?php echo base_url(); ?>uploads/default.png" width="100">
													</a>
						    						<?php } ?>
						    					</td>
						    					<?php if($row->status_pemesanan=='belum disetujui'){ ?>
						    					<td ><a href="<?php echo base_url('utama/detail_page/'.$row->id_pesanan) ?>" class="btn btn-info btn-xs" style="width:100px;"><span class="glyphicon glyphicon-ok"></span> Bayar</a></td>
						    					<?php }elseif($row->status_pemesanan=='lanjut pembayaran'){ ?>
						    					<td ><a href="<?php echo base_url('utama/bayar/'.$row->id_pesanan) ?>" class="btn btn-success btn-xs" style="width:100px;"><span class="glyphicon glyphicon-ok"></span> Bayar</a><br><br><a href="<?php echo base_url('utama/pesan_makan/'.$row->kode_resto.'/'.$row->id_pesanan) ?>" class="btn btn-info btn-xs" style="width:100px;"><span class="glyphicon glyphicon-cutlery"></span> Pesan Makan</a></td>
						    					<?php }elseif($row->status_pemesanan=='pelanggan membayar'){  ?>
						    					<td><a href="" class="btn btn-warning btn-xs disabled"><span class="glyphicon glyphicon-usd"></span> Menunggu konfirmasi</a></td>
						    					<?php }elseif($row->status_pemesanan=='selesai'){  ?>
						    					<td><a href="" class="btn btn-success btn-xs disabled"><span class="glyphicon glyphicon-ok"></span> Pemesanan Berhasil</a></td>
						    					<?php } ?>
						    				</tr>
											
										<?php } ?>
									<?php }else{?>
										<!-- kalo lewat dari tanggal -->
										
									<?php } ?>
								<?php } ?>
							<?php }else{ ?>
								<tr>
									<td></td>
								</tr>
							<?php } ?>
			    			</tbody>
			    		</table>
					</div>
				</div>
			</div>
			<?php if(!empty($record_pesanan_berhasil)){ ?>
						<div class="row" style="background-color:white;margin-bottom:25px;border-radius:5px;">
							<div class="col-md-12">
								<h3>Pesanan yang telah selesai</h3>
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
						    					<th>Total Bayar</th>
						    					<th>Bukti Bayar</th>
						    					<th>Aksi</th>
						    				</tr>	
						    			</thead>
						    			<tbody>
										<?php foreach ($record_pesanan_berhasil as $row) {?>

										<?php

											$tanggal_acara = date($row->tanggal_acara);
											$jam_acara = date($row->jam_acara)+1.01	;

											date_default_timezone_set('Asia/Jakarta');
											$jam_sekarang=date("H:i");
											$tanggal_sekarang =  date("Y-m-d");
											
										?>
											<?php if($tanggal_acara < $tanggal_sekarang ){ ?>
												<tr>
							    					<td class="text-center"><strong><?php echo $row->id_pesanan; ?></strong></td>
							    					<td class="text-center"><?php echo $row->nama_resto; ?></td>
							    					<td class="text-center"><?php echo $row->jumlah_kursi; ?></td>
							    					<td class="text-center"><?php echo $row->tanggal_acara; ?></td>
							    					<td class="text-center"><?php echo $row->jam_acara; ?></td>
							    					<td class="text-center"><?php echo number_format($row->total_bayar); ?></td>
							    					<td>
							    						<?php if($row->bukti_bayar=="saldo"){ ?>

						    						<?php echo "saldo"; ?>
						    						<?php }elseif($row->bukti_bayar!=""){ ?>
						    						<a href="<?php echo $row->bukti_bayar; ?>" class="perbesar">
						    							<img  src="<?php echo $row->bukti_bayar; ?>" style="width:100px;height:100px;">
						    						</a>
						    						<?php }else{ ?>
						    						<a href="<?php echo base_url(); ?>uploads/default.png" class="perbesar" >
														<img src="<?php echo base_url(); ?>uploads/default.png" width="100">
													</a>
						    						<?php } ?>
							    					</td>
							    					<td><a href="<?php echo base_url('utama/tulis_review/'.$row->kode_resto); ?>" class="btn btn-success btn-xs "><span class="glyphicon glyphicon-ok"></span> Tulis Review</a></td>
							    					
							    				</tr>
											<?php } ?>
											
										<?php } ?>
										</tbody>
							    		</table>
									</div>
								</div>
							</div>
					<?php }else{ ?>
						
					<?php } ?>
			
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