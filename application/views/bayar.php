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
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/sweetalert-master/dist/sweetalert.css">
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/sweetalert-master/dist/sweetalert.min.js"></script>
	

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
  	 $('#tanggal').datepicker({
        format: "dd-mm-yyyy",
        autoclose:true,
        maxDate: "now",
        startDate: "+1d"
    });  	


  	 $("#topup").click(function(){
  	 	var jumlahtransfer = $("#jumlahtransfer").val();
  	 	var namarekening = $("#namarekening").val();
  	 	var tanggal = $("#tanggal").val();

  	 	jumlahtransfer = jumlahtransfer.toString();
  	 	namarekening = namarekening.toString();
  	 	tanggal = tanggal.toString();
  	 	
  	 	
  	 	/*$.ajax({ 
	  			type:'post',
	  			dataType:'json',
	  			url:"<?php echo base_url('utama/proses_top_up_saldo')  ?>",
				data:{jumlahtransfer:jumlahtransfer,namarekening:namarekening,tanggal:tanggal},
				success:function(html)
				{
					console.log("asd");
				}
	  		});*/
  	 })
  
  	
    /*$('.combobox').combobox();*/
    	
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
    			<div class="row menu-kiri " style="padding-bottom:20px;padding-top:20px;">
					<div class="col-md-12 text-center " >Pesanan</div>
				</div>
    		</a>
    		<a href="<?php echo base_url('utama/pelanggan_data_diri'); ?> ">
    			<div class="row menu-kiri " style="padding-bottom:20px;padding-top:20px;">
					<div class="col-md-12 text-center " >Data diri</div>
				</div>
    		</a>
    		<a href="<?php echo base_url('utama/top_up_saldo'); ?> ">
    			<div class="row menu-kiri menu-active " style="padding-bottom:20px;padding-top:20px;">
					<div class="col-md-12 text-center " >Pembayaran</div>
				</div>
    		</a>
		</div>
		<div class="col-md-9"  >
			<div class="row" style="background-color:white;margin-bottom:25px;border-radius:5px;">
				<div class="col-md-12">
					<h3>Saldo DompetResto</h3>
					<hr/>
					<div class="col-md-12 content_panel " style="min-height: 100%;">
						<div class="col-md-12">
							<div class="row">
								<ul class="nav nav-tabs">
								    <li class="active"><a data-toggle="tab" href="#about">Top up saldo</a></li>
								    <li class=""><a data-toggle="tab" href="#history">History Top Up</a></li>
								</ul>
							  	<div class="tab-content">
									    <div id="about" class="tab-pane fade in active">
									    	<?php echo form_open_multipart(base_url("utama/proses_top_up_saldo"), 'method="POST"') ?>
							  				<h3 style="margin-bottom:15px;">Konfirmasi Top Up Saldo</h3>
									        <div class="row">
									        	<div class="col-md-2"> Nama Email</div>
										        <div class="col-md-4">
										        	<div class="form-group">
										        		<?php echo $this->session->userdata('email'); ?>
										        	</div>
										        </div>
									        </div>
									        <div class="row">
									        	<div class="col-md-2"> Jumlah Transfer</div>
										        <div class="col-md-3">
										        	<div class="form-group">
										        		<input type="text" class="form-control" placeholder="Jumlah yang ditransfer"  name="jumlahtransfer" maxlength="35" value=""/>
										        	</div>
										        </div>
									        </div>
									        <div class="row">
									        	<div class="col-md-2"> Nama Rekening</div>
										        <div class="col-md-6">
										        	<div class="form-group">
										        		<input type="text" class="form-control" placeholder="Nama pemilik rekening"  name="namarekening" maxlength="35" />
										        	</div>
										        </div>
									        </div>
									        <div class="row">
									        	<div class="col-md-2"> Tanggal Transfer</div>
										        <div class="col-md-4">
											        <div class="form-group has-feedback">
														<input type="text" class="form-control"  id="tanggal" name="tanggal" placeholder="Tanggal" maxlength="20"  />
													</div>
										        </div>
									        </div>
									        <div class="row">
									        	<div class="col-md-2"></div>
									        	<div class="col-md-2 ">
									        		<button class="btn btn-large btn btn-success center  " type="submit" id="topup"  style='margin-bottom:20px;'>Verifikasi</button>
									        	</div>
									        </div>
									        <?php echo form_close(); ?>
										</div>
							  		
							  		<div id="history" class="tab-pane fade">
								      <h3>History Top up</h3>
								      <div class="table-responsive">
							    		<table class="table">
							    			<thead>
							    				<tr>
							    					<th>Jumlah Top Up</th>
							    					<th>Nama Rekening</th>
							    					<th>Tanggal Transfer</th>
							    					<th>Keterangan</th>
							    				</tr>	
							    			</thead>
							    			<tbody>
							    			<?php if(!empty($record)): ?>
							    					<?php foreach ($record as $row):?>
									    				<tr>
									    					<td><?php echo $row->jumlah_top_up_saldo; ?></td>
									    					<td><?php echo $row->nama_rekening; ?></td>
									    					<td><?php echo $row->tanggal_transfer; ?></td>
									    					<?php if($row->status_transaksi=="belum konfirmasi admin"){ ?>
									    					<td ><a href="#" class="btn btn-info btn-xs disabled" style="width:100px;"><span class="glyphicon glyphicon-refresh"></span> Proses</a></td>
									    					<?php }elseif($row->status_transaksi=="sudah konfirmasi admin") {?>
									    					<td ><a href="#" class="btn btn-success btn-xs disabled" style="width:100px;"><span class="glyphicon glyphicon-ok"></span> Selesai</a></td>
									    					<?php } ?>
									    					
									    				</tr>
							    					<?php endforeach; ?>
							    				<?php endif; ?>
							    			</tbody>

							    		</table>
							    	</div>
								    </div> 
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="background-color:white;margin-bottom:25px;border-radius:5px;">
				<div class="col-md-12">
					<h3>Peraturan dan ketentuan transfer via ATM</h3>
					<hr/>
					<P> - Harus memiliki Rekening BANK dan masih berlaku.</p>
					<p> - Lakukan pembayaran HANYA ke nomor rekening yang tercantum dibawah ini, PASTIKAN DENGAN BENAR</p>
					<p class="text-center"><b>DOMPETRESTO.COM</b></p>
					<p class="text-center"><b>No Rekening : 000-000-0000</b></p>
					<p class="text-center"><b>Atas Nama : Taufan Erlangga</b></p>
					<p class="text-center"><b>(KCP Gunung Sari)</b></p>
					<p> - Minimal nominal untuk Topup via ATM adalah sebesar Rp 10.000,- dan maksimal Rp 3.000.000</p>
					<p> - Lakukan konfirmasi di website resto.com dan pastikan data yang anda masukan sesuai dengan transakasi yang telah anda lakukan &nbsp;	sebelumnya.</p>
					<p> - Setelah melakukan konfirmasi, data anda akan kami proses paling lambat 1 x 24 jam.</p>
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