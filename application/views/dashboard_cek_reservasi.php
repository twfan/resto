<html>
<head>
	<title></title>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datatables/css/jquery.datatables.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.css" media="screen">
	
	


 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/datatables/js/datatables.bootstrap.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/datatables/js/jquery.datatables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$(".perbesar").fancybox();
		$("#lookup").dataTable();
		
		
	});
</script>
<style type="text/css">

	.header{
		height: 60px;
		
		background-color: #ABB7B7;
		font-size: 20px;
	}
	.sign-out
	{
		font-size: 15px;
		padding-top: 10px;
		text-align: right;
	}

	.panel_kiri{
		
		background-color: #DADFE1;
	}
	.menu{
		height: 50px;
		position: relative;
		background-color:#D2D7D3;
		list-style-type: none;
		text-align: left;
		padding: 10px;
		padding-left: 25px;
		margin-right: 0px;
		padding-right: 0px;
		font-size: 18px;
		transition: all 0.3s;
		-moz-transition: all 0.3s;
		-webkit-transition: all 0.3s;
		-ms-transition: all 0.3s;
		-o-transition: all 0.3s;
	}
	.menu:hover{
		background-color: #BDC3C7 ;
	}
	a
	{
		text-decoration: none;
		font-color : black;
	}
	a:hover{
		color:white;
	}
	.content_panel{
		background-color: white;
		
		
		padding-top: 15px;
		padding-left: 15px;

		padding-right: 20px;
		padding-bottom: 20px;
	}
</style>
</head>
<body>
<div class="container-fluid wrapper" >
	<div class="row header">
		<div class="col-md-10  " > <h3 > <a href="<?= base_url('owner/dashboard_owner') ?>">Dashboard User Resto </a></h3></div>
		<a href="log_out"> <div class="col-md-2 sign-out"><h5>Sign Out  <span class="glyphicon glyphicon-log-out" ></span></h5></div></a>
	</div>
	<div class="row middle" style="background-color:#DADFE1;">
		<div class="col-md-2 panel_kiri " style="min-height: 100%;">
			<div class="row">
				<a href="<?= base_url('owner/cek_reservasi')?>"><div class="col-md-12 menu"><li >Lihat Reservasi</li></div></a>
			</div>
			<div class="row">
				<a href="<?= base_url('owner/laporan') ?>"><div class="col-md-12 menu"><li >Laporan</li></div></a>
			</div>
			<div class="row">
				<a href="<?= base_url('owner/dashboard_owner')?>"><div class="col-md-12 menu"><li >Reservation</li></div></a>
			</div>
			<div class="row">
				<a href="<?= base_url('owner/dashboard_about') ?>"><div class="col-md-12 menu"><li >About</li></div></a>
			</div>
			<div class="row">
				<a href="<?= base_url('owner/upgrade_akun') ?>"><div class="col-md-12 menu"><li >Upgrade Akun</li></div></a>
			</div>
			
			<div class="row">
				<a href="<?= base_url('owner/pemasukan') ?>"><div class="col-md-12 menu"><li >Pemasukan Resto </li></div></a>
			</div>
		</div>
		<div class="col-md-10 content_panel " style="min-height: 100%;">
			<div class="col-md-12">
				<h3 style="margin-bottom:15px;">Lihat Reservasi</h3>
				<?php echo form_open_multipart(base_url("owner/cek_reservasi"), 'method="POST"') ?>
		    		<div class="row">
			        	<div class="col-md-2"> Id Pesanan</div>
				        <div class="col-md-4">
				        	<div class="form-group">
				        		<input type="text" class="form-control" placeholder="Id pesanan"  name="idpesanan" maxlength="35" value=""/>
				        	</div>
				        </div>
			        </div>
			        <div class="row">
			        	<div class="col-md-2"></div>
			        	<div class="col-md-2 ">
			        		<button class="btn btn-large btn btn-success center  " type="submit" name="tambahdata" >Cari</button>
			        	</div>
			        </div>
			    <?php echo form_close(); ?>
				<?php if(!empty($record_pesanan_makanan)){ ?>
				<?php foreach ($record_pesanan_meja as $row) {
					$tanggal_acara = date($row->tanggal_acara);
					$jam_acara = date($row->jam_acara)+0.31;
				} ?>
				<?php date_default_timezone_set('Asia/Jakarta');
						$jam_sekarang=date("H:i:s"); ?>
				<?php $tanggal_sekarang =  date("Y-m-d"); ?>

				<?php if($tanggal_acara < $tanggal_sekarang ){ ?>
				<div class="alert alert-danger">
				  <strong>Pesanan telah kadaluarsa!</strong> Tanggal pesanan telah lewat.
				</div>
					
				<?php }else{ ?>
					<?php if($jam_sekarang < $jam_acara){ ?>
						<div class="alert alert-success">
						  <strong>Valid !</strong> Pesanan meja masih valid.
						</div>
					<?php }else{ ?>
					<div class="alert alert-warning">
					  <strong>Terlambat!</strong> Datang terlambat, mohon tunggu sebentar.
					</div>
					<?php } ?>
				<?php } ?>
				
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
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="col-md-6" style="margin-left:10px;">
				<div class="row" style="background-color:white;margin-bottom:25px;border-radius:5px;padding-left:10px;padding-right:10px;">
					<h3>Detail Pesanan makanan </h3>
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
				    					<td class="text-center"><?php echo number_format($row->sub_harga_makanan); ?></td>
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
					
				</div>
				 <div class="row">
			        	<div class="col-md-2"></div>
			        	<div class="col-md-2 ">
			        		<button class="btn btn-large btn btn-success center  " type="submit" name="tambahdata" >Cari</button>
			        	</div>
			        </div>
			</div>
		</div>
	   
	<?php echo form_close(); ?>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
</body>
</html>