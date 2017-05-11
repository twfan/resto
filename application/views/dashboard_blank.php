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
				<a href="<?= base_url('owner/dashboard_owner')?>"><div class="col-md-12 menu"><li >Reservation</li></div></a>
			</div>
			<div class="row">
				<a href="<?= base_url('owner/dashboard_about') ?>"><div class="col-md-12 menu"><li >About</li></div></a>
			</div>
		</div>
		<div class="col-md-10 content_panel " style="min-height: 100%;">
			<div class="col-md-12">
				<h3 class="row" style="margin-bottom:15px;">Daftar pesanan yang masuk</h3>
				<div class="row">
					<div class="table-responsive">
			    		<table class="table" id="lookup">
			    			<thead>
			    				<tr>
			    					<th>Id pesanan</th>
			    					<th>Atas nama</th>
			    					<th>Jumlah kursi</th>
			    					<th>Tanggal acara</th>
			    					<th>Jam acara</th>
			    					<th>Total bayar</th>
			    					<th>Bukti pembayaran</th>
			    					<th>Status pemesanan</th>
			    					<th>Tanggal Transaksi</th>
			    					<th>Aksi</th>
			    				</tr>	
			    			</thead>
			    			<tbody>
			    			<?php if(!empty($record_pesanan)){ ?>
								<?php foreach ($record_pesanan as $row){?>
				    				<tr>
				    					<td><?php echo $row->id_pesanan; ?></td>
				    					<td><?php echo $row->nama_user; ?></td>
				    					<td><?php echo $row->jumlah_kursi; ?></td>
				    					<td><?php echo $row->tanggal_acara; ?></td>
				    					<td><?php echo $row->jam_acara; ?></td>
				    					<td><?php echo $row->total_bayar; ?></td>
				    					<td>
				    						<?php if($row->bukti_bayar==""){ ?>
				    						<a href="<?php echo base_url(); ?>uploads/default.png" class="perbesar" >
												<img src="<?php echo base_url(); ?>uploads/default.png" width="100">
											</a>
				    						<?php }elseif($row->bukti_bayar=="saldo"){ ?>
				    						<?php echo "Menggunakan Saldo" ?>
				    						<?php }else{?>
				    						<a href="<?php echo $row->bukti_bayar; ?>" class="perbesar">
				    							<img  src="<?php echo $row->bukti_bayar; ?>" style="width:100px;height:100px;">
				    						</a>
				    						<?php } ?>
				    						
				    					</td>
				    					<td><?php echo $row->status_pemesanan; ?></td>
				    					<td><?php echo $row->tanggal_transaksi; ?></td>
				    					<?php if($row->status_pemesanan=='belum disetujui'){?>
				    					<td><a href="<?php echo base_url('owner/terima_pemesanan/'.$row->id_pesanan) ?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-ok"></span> Lanjut Pembayaran</a><br/><br/>
				    					<a href="<?php echo base_url('owner/tolak_pemesanan/'.$row->id_pesanan) ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Tolak Pemesanan</a></td>
				    					<?php }elseif($row->status_pemesanan=='lanjut pembayaran') {?>
				    					<td><a href="<?php echo base_url('owner/terima_pemesanan/'.$row->id_pesanan) ?>" class="btn btn-warning btn-xs disabled"><span class="glyphicon glyphicon-usd"></span> Menunggu Pembayaran</a></td>
				    					<?php }elseif($row->status_pemesanan=='pelanggan membayar') {?>
				    					<td><?php echo "Menunggu konfirmasi admin"; ?></td>
				    					<?php }elseif($row->status_pemesanan=='selesai') { ?>
				    					<td><a href="<?php echo base_url('owner/terima_pemesanan/'.$row->id_pesanan) ?>" class="btn btn-success btn-xs disabled"><span class="glyphicon glyphicon-ok"></span> Pemesanan berhasil</a></td>
				    					<?php } ?>
								<?php } ?>
							<?php } ?>
			    			</tbody>
			    		</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>