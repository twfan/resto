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
				<h3 class="row" style="margin-bottom:15px;">Upgrade Akun</h3>
				<hr>
				<div class="row">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<th>Item</th>
								<th>Harga</th>
							</thead>
							<tbody>
								
								<tr>
									<td>Fitur Iklan selama 30 hari</td>
									<td style="text-align:center;">Rp  <?php echo number_format(15000) ?></td>
								</tr>
								<tr style="background-color:#F5F5F5;">
									<td style="text-align:right;">Total</td>
									<td style="text-align:center;">Rp <?php echo number_format(15000)?></td>
								</tr>
							</tbody>
						</table>
					</div>	
				</div>	
				<div class="col-md-12">
				<div class="row">
					<ul class="nav nav-tabs">
					    <li class="active"><a data-toggle="tab" href="#transfer">Via Transfer</a></li>
					    <li><a data-toggle="tab" href="#saldo">Saldo</a></li>
					</ul>
				  	<div class="tab-content">
					    <div id="transfer" class="tab-pane fade in active">
					    		<?php
								if($this->session->flashdata('pesan')=='1'){
								?>
								<div class="alert alert-success" style="margin-top:10px;">
								  <strong>Pesanan berhasil dibayar!</strong> Pesanan anda telah berhasil dibayar. 
								</div>
								<?php
								}elseif($this->session->flashdata('pesan')=='0'){?>
								<div class="alert alert-danger" style="margin-top:10px;">
								  <strong>Bukti bayar gagal</strong> foto bukti bayar harus berdimensi kurang dari 1024x1024. 
								</div>
								<?php } ?>
					    	<?php echo form_open_multipart(base_url("owner/proses_bayar_upgrade/"), 'method="POST"') ?>
					    		<div class="row" style="margin-top:25px;">
						        	<div class="col-md-2"> Nama Rekening</div>
							        <div class="col-md-4">
							        	<div class="form-group">
							        		<input type="text" class="form-control" placeholder="Nama rekening yang digunakan"  name="namarekening" maxlength="35" value=""/>
							        	</div>
							        </div>
						        </div>
						        <div class="row">
						        	<div class="col-md-2"> Jumlah Transfer</div>
							        <div class="col-md-2">
							        	<div class="form-group">
							        		<input type="hidden" class="form-control" placeholder="Jumlah transfer"  name="jumlahtransfer" maxlength="35" value=""/>
							        		<label>Rp <?php echo number_format(15000) ?> </label>
							        		<!--  -->
							        	</div>
							        </div>
						        </div>
						        <div class="row">
						        	<div class="col-md-2">Bank yang digunakan</div>
							        <div class="col-md-2">
							        	<div class="form-group has-feedback">
											<select class="combobox form-control" name="bank" prompt="Bank">
												<option value="" disabled selected>Pilih bank</option>
												<option value="BCA">BCA</option>
												<option value="BRI">BRI</option>
												<option value="BNI">BNI</option>
												<option value="MANDIRI">MANDIRI</option>
												<option value="NIAGA">NIAGA</option>
												<option value="LAINNYA">LAINNYA</option>
											</select>
										</div>
							        </div>
						        </div>
						        <div class="row">
						        	<div class="col-md-2"> Bukti Transfer</div>
							        <div class="col-md-2">
							        	<div class="form-group">
							        		<input type="file" class="" name="userfile" size="20"/>
							        	</div>
							        </div>
						        </div>
						        <div class="row" style="margin-bottom:25px;">
						        	<div class="col-md-2"></div>
						        	<div class="col-md-2 ">
						        		<button class="btn btn-large btn btn-success center  " type="submit" name="tambahdata" >Tambahkan</button>
						        	</div>
						        </div>
					    	 <?php echo form_close(); ?>
					    	
					    </div>
					    <div id="saldo" class="tab-pane fade">
					    	<?php echo form_open_multipart(base_url("owner/bayar_upgrade_saldo/"), 'method="POST"') ?>
					    	<?php
								if($this->session->flashdata('pesan')=='saldo_kurang'){
								?>
								<div class="alert alert-danger" style="margin-top:10px;">
								  <strong>Saldo tidak mencukupi!</strong> Harap melakukan <a href="<?php echo base_url('utama/top_up_saldo') ?>">top up saldo</a> terlebih dahulu. 
								  
								</div>
								<?php
								}elseif($this->session->flashdata('pesan')=='sudah_bayar'){?>
								<div class="alert alert-warning" style="margin-top:10px;">
								  <strong>Pesanan sudah dibayar!</strong> Pesanan telah dibayar. 
								</div>
								<?php }elseif($this->session->flashdata('pesan')=='berhasil_bayar'){ ?>
									<div class="alert alert-success" style="margin-top:10px;">
								  <strong>Pesanan berhasil dibayar!</strong> Pesanan anda telah berhasil dibayar. 
								</div>
								<?php } ?>
					    		
					    		<div class="row" style="margin-top:25px;">
						        	<div class="col-md-2"> Saldo yang dimiliki</div>
							        <div class="col-md-4">
							        	<div class="form-group">
							        		<?php if(!empty($saldo)){ ?>
							        		<strong>Rp <label class="" name="" value=""><?php echo Number_format($saldo); ?><input type="hidden" name="saldo" value="<?php echo $saldo;	 ?>"></label>,00</strong>
							        		<?php }else{ ?>
							        		<strong>Rp 0,00</strong>
							        		<?php } ?>
							        		
							        	</div>
							        </div>
						        </div>
						        <div class="row" style="">
						        	<div class="col-md-2"> Total bayar</div>
							        <div class="col-md-4">
							        	<div class="form-group">
							        		<input type="hidden" class="form-control" placeholder="Jumlah transfer"  name="totalbayar" maxlength="35" value="15000"/>
							        		
							        		<label class="" name="" value="">Rp <?php echo Number_format(15000); ?>,00
							        	</div>
							        </div>
						        </div>
						        <div class="row" style="margin-bottom:25px;">
						        	<div class="col-md-2"></div>
						        	<div class="col-md-2 ">
						        		<button class="btn btn-large btn btn-success center  " type="submit" name="tambahdata" >Gunakan Saldo</button>
						        	</div>
						        </div>
						        <?php echo form_close(); ?>
					    </div>
					    <div id="menu3" class="tab-pane fade">
					      <h3>Menu 3</h3>
					      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
					    </div>    
					</div>
				</div>	
			</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>