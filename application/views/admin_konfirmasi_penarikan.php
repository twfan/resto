<html>
<head>
	<title></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datatables/css/jquery.datatables.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.css" media="screen">

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/datatables/js/datatables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/datatables/js/jquery.datatables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.js"></script>

<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/popup-image/source/jquery.fancybox.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		 $(function () {
		 	$(".perbesar").fancybox();
	            $("#lookup").dataTable();
	        });
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
		<div class="col-md-10  " > <h3 > <a href="<?= base_url('admin/home') ?>">Dashboard Admin </a></h3></div>
		<a href="log_out"> <div class="col-md-2 sign-out"><h5>Sign Out  <span class="glyphicon glyphicon-log-out" ></span></h5></div></a>
	</div>
	<div class="row middle" style="background-color:#DADFE1;">
		<div class="col-md-2 panel_kiri " style="min-height: 100%;">
			<div class="row">
				<a href="<?= base_url('admin/home')?>"><div class="col-md-12 menu"><li >Top Up Saldo</li></div></a>
				<a href="<?= base_url('admin/pembayaran')?>"><div class="col-md-12 menu"><li >Pembayaran Pesanan</li></div></a>
				<a href="<?= base_url('admin/penarikan')?>"><div class="col-md-12 menu"><li >Penarikan Saldo</li></div></a>
			</div>
		</div>
		<div class="col-md-10 content_panel " style="min-height: 100%;">
			<div class="col-md-12">
				<h3 class="row" style="margin-bottom:15px;">Penarikan Saldo</h3>
				<div class="row">
					<div class="table-responsive">
			    		<table id="lookup" class="table table-bordered table-hover table-striped">
			    			<thead>
			    				<tr>
			    					
			    					<th>Id</th>
			    					<th>id Resto</th>
			    					<th>jumlah penarikan</th>
			    					<th>Bank</th>
			    					<th>Rekening</th>
			    					<th>Tanggal Request</th>
			    					<th>Aksi</th>
			    				</tr>	
			    			</thead>
			    			<tbody>
			    				<?php $no=1; ?>
			    			<?php if(!empty($record)){ ?>
								<?php foreach ($record as $row){?>
				    				<tr>
				    					<td><?php echo $row->id; ?></td>
				    					<td><?php echo $row->id_resto; ?></td>
				    					<td><?php echo $row->jumlah_penarikan; ?></td>
				    					<td><?php echo $row->bank; ?></td>
				    					<td><?php echo $row->rekening;?></td>
				    					<td><?php echo $row->tanggal_request;?></td>
				    					<td>
				    						<?php if($row->status==0){ ?>
				    							<a href="<?php echo base_url('admin/konfirmasi_penarikan/'. $row->id) ?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-ok"></span>Kirim sms ke user</a><br><br>
				    						<?php }else{ ?>
				    						<a href="<?php echo base_url('admin/konfirmasi/'. $row->id) ?>" class="btn btn-success btn-xs disabled"><span class="glyphicon glyphicon-ok"></span> Transaksi Selesai</a>
				    						<?php } ?>
				    					</td>
				    				</tr>
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