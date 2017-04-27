<html>
<head>
	<title></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datatables/css/jquery.datatables.css">

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/datatables/js/datatables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/datatables/js/jquery.datatables.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		 $(function () {
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
		<div class="col-md-10  " > <h3 > <a href="<?= base_url('owner/dashboard_owner') ?>">Dashboard User Resto </a></h3></div>
		<a href="log_out"> <div class="col-md-2 sign-out"><h5>Sign Out  <span class="glyphicon glyphicon-log-out" ></span></h5></div></a>
	</div>
	<div class="row middle" style="background-color:#DADFE1;">
		<div class="col-md-2 panel_kiri " style="min-height: 100%;">
			<div class="row">
				<a href="<?= base_url('admin/home')?>"><div class="col-md-12 menu"><li >Top Up Saldo</li></div></a>
				<a href="<?= base_url('admin/pembayaran')?>"><div class="col-md-12 menu"><li >Pembayaran Pesanan</li></div></a>
			</div>
		</div>
		<div class="col-md-10 content_panel " style="min-height: 100%;">
			<div class="col-md-12">
				<h3 class="row" style="margin-bottom:15px;">Top up saldo User</h3>
				<div class="row">
					<div class="table-responsive">
			    		<table id="lookup" class="table table-bordered table-hover table-striped">
			    			<thead>
			    				<tr>
			    					<th>Nomer</th>
			    					<th>Id pesanan</th>
			    					<th>nama rekening</th>
			    					<th>jumlah transfer</th>
			    					<th>bank</th>
			    					<th>bukti transfer</th>
			    					<th>Aksi</th>
			    				</tr>	
			    			</thead>
			    			<tbody>
			    				<?php $no=1; ?>
			    			<?php if(!empty($record)){ ?>
								<?php foreach ($record as $row){?>
				    				<tr>
				    					<td><?php echo $no;$no++; ?></td>
				    					<td><?php echo $row->id_pesanan; ?></td>
				    					<td><?php echo $row->nama_rekening; ?></td>
				    					<td><?php echo $row->jumlah_transfer; ?></td>
				    					<td><?php echo $row->bank; ?></td>
				    					<td><?php echo $row->bukti_transfer;?></td>
				    					<?php if($row->status=='belum konfirmasi admin'){?>
				    					<td><a href="<?php echo base_url('admin/konfirmasi/'. $row->id_top_up) ?>" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-ok"></span> Konfirmasi Top UP</a></td>
				    					<?php }elseif($row->status=='sudah konfirmasi admin') {?>
				    					<td><a href="<?php echo base_url('admin/konfirmasi/'. $row->id_top_up) ?>" class="btn btn-success btn-xs disabled"><span class="glyphicon glyphicon-ok"></span> Selesai Top Up</a></td>
				    					<?php } ?>
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