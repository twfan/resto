<!DOCTYPE html>
<html lang="en">
<head>
	<title>RESTO</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/pgwslideshow/pgwslideshow.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/reviewblock/reviewblock.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/combobox/css/bootstrap-combobox.css"> -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/datepicker/css/datepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/sweetalert-master/dist/sweetalert.css">

	
	
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/vegas/vegas.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/jqueryui/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/pgwslideshow/pgwslideshow.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/sweetalert-master/dist/sweetalert.min.js"></script>


	<meta name="viewport" content="width=device-width, initial-scale=1">
	

	
<script type="text/javascript">
  $(document).ready(function(){

  	var tampung_kode = $(".hidden_kode").val();
  	

    /*$('.combobox').combobox();*/
   $('html, body').scrollTop($('.nama').offset().top);
   var kode_resto = $(".kode_resto").val();
    $.ajax({
    	type:"post",
    	dataType:"json",
    	url:"<?php echo base_url('utama/baca_menu') ?>",
    	data:{kode_resto:kode_resto},
    	success:function(html)
    	{
    		for (var i = 0; i < html.length; i++) {
    			let template = "<tr>" + 
    								"<td>"+html[i].nama_makanan+"</td>" +
    								"<td>"+html[i].deskripsi+"</td>" +
    								"<td class='harga'>"+html[i].harga+"</td>" +
    								"<td><img src='"+html[i].foto_makanan+"' style='width:50px;height:50px;' /></td>" +
    								"<td>" +
    									"<input type='hidden' class='harga_satuan' name='harga_satuan[]' value='"+html[i].harga+"'>" +
    									"<input type='hidden' class='sub_total_harga' name='sub_total_harga[]'>" +
    									"<input type='hidden' class='nama_makanan' name='nama_makanan[]' value='"+html[i].nama_makanan+"'>" +
    									"<button type='button' class='button_kurang' value='"+html[i].kode_menu+"'>-</button>" +
    									"<input type='number' name='qty[]' class='qty text-center' value='0' style='width:40px;' readonly>" +
    									"<button type='button' class='button_tambah' value='"+html[i].kode_menu+"'>+</button>" +
    								"</td>" +
    							"</tr>"
				let table = $(template);
				$(table).find('.qty').on('keyup', function() {
					if ($(this).val() == '') {
						$(this).val(0)
					}
					generate_total_harga()
				})
				$(table).find('.button_tambah').on('click', function() {
					// Nambah qty
					var qty = $(table).find('.qty').val()
					$(table).find('.qty').val(parseInt(qty) + 1)
					// Tambah total harga
					generate_total_harga()
					// Atur ulang sub total harga
					var harga_satuan = $(table).find('.harga_satuan').val()
					$(table).find('.sub_total_harga').val((parseInt(qty) + 1) * parseInt(harga_satuan))
				})
				$(table).find('.button_kurang').click(function(){
					var qty = $(table).find('.qty').val()
					if ((parseInt(qty) - 1) >= 0) {
					     $(table).find('.qty').val(parseInt(qty) - 1)
					}
					// Tambah total harga
					generate_total_harga()
					// Atur ulang sub total harga
					var harga_satuan = $(table).find('.harga_satuan').val()
					$(table).find('.sub_total_harga').val((parseInt(qty) + 1) * parseInt(harga_satuan))
				})
				$(".data-makanan").append(table)
			};
			
    	}
    });

    function generate_total_harga() {
    	var total_harga = 0
    	$('.data-makanan').find('tr').each(function() {
    		var qty = parseInt($(this).find('.qty').val())
    		var harga = parseInt($(this).find('.harga').html())
    		total_harga += qty * harga
    	})
    	$('.total_bayar').html(total_harga)
    }

    
    $('#tanggal').datepicker({
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
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="<?= base_url('utama/pelanggan')?>">Hi, <?php echo $this->session->userdata('user_pelanggan'); ?></a></li>
	        <li><a href="<?= base_url('utama/logout')?>">Keluar</a></li>
	        
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

<div class="container" >
	<div style="color:red;font-style:italic;margin-bottom:25px;">	<?php echo $this->session->flashdata('terima_kasih'); ?></div>
	<?php if(!empty($record_resto)): ?>
		<?php foreach ($record_resto as $row):?>
			<div class="container ">
			    <div class="fb-profile">
			        <img align="left" class="fb-image-lg" src="<?php echo $row->foto_resto ?>"  style="width:100%;height:315px;"alt="Profile image example"/>
			        <img align="left" class="fb-image-profile thumbnail" src="<?php echo $row->foto_resto ?>" alt="Profile image example"/>
			        <div class="fb-profile-text">
			            <h1 class="nama"><?php echo $row->nama_resto ?></h1>
			            <p><?php echo $row->alamat_resto ?></p>
			        </div>
			    </div>
			</div> 
		<?php endforeach; ?>
	<?php endif; ?>
	<div class="row testing" style="margin-top:25px;">
		<div class="col-md-8" style="margin-left:20px;" >
			<div class="row" style="background-color:white;border-radius:10px;">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12 pesan"><h1>Pesan makanan</h1></div>
					</div>
					<div class="">
						<?php echo $id_pesanan; ?>
						<?php echo $kode_resto; ?>
						<form method="post" action="<?php echo base_url('utama/proses_pesan_makan/'.$kode_resto.'/'.$id_pesanan); ?>">
							<table class="table table-responsive">
								<thead>
									<tr>
										<td>Nama Makanan</td>
										<td>Deskripsi</td>
										<td>Harga</td>
										<td>Foto</td>
										<td></td>
									</tr>
								</thead>
								<tbody class="data-makanan">
									
								</tbody>
							</table>
							<div class="row">
								<div class="col-md-4"><h4>Harga Total</h4></div>
								<div class=" col-md-offset-5 col-md-3 text-right"><h3>Rp <span class="total_bayar" name="total_bayar"></span></h3></div>
							</div>
							<div class="row">
								<div class="col-md-offset-10 col-md-1">
									<button class="btn btn-success" type="submit" style="margin-bottom:15px;">Pesan</button>
								</div>
							</div>
							
						</form>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="col-md-3" style="margin-left:10px;margin-bottom:25px;background-color:white;border-radius:10px;">
			<?php if(!empty($record_resto)){ ?>
				<?php foreach ($record_resto as $row) {?>
					<input type="hidden" class="kode_resto" value="<?php echo $row->kode_resto ?>"></input>
					<div class="row" style="padding-bottom:20px;padding-top:20px;">
						<div class="col-md-6">No telfon</div><div class="col-md-6"><?php echo $row->no_telfon; ?></div>
					</div>
					<div class="row" style="padding-bottom:20px;">
						<div class="col-md-6">Jadwal buka</div><div class="col-md-6"><?php echo $row->jadwal_buka; ?></div>
					</div>
					<div class="row" style="padding-bottom:20px;">
						<div class="col-md-6">Tipe Sajian</div><div class="col-md-6"><?php echo $row->tipe_sajian; ?></div>
					</div>
					<div class="row" style="padding-bottom:20px;">
						<div class="col-md-6">Kisaran harga</div><div class="col-md-6"><?php echo $row->harga_terendah; echo " - "; echo $row->harga_tertinggi?></div>
					</div>
					<div class="row" style="padding-bottom:20px;">
						<div class="col-md-6">Pembayaran</div><div class="col-md-6"><?php echo $row->metode_pembayaran; ?></div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
</div>
<!-- FOOTER -->
<div class="container-fluid" style="background-color:grey;margin-top:15px;">
	<div class="container" >
		<div class="row" >
			<div class="col-md-4 text-left"><h4>resto.com</h4></div>
			<div class="col-md-4 col-md-offset-4 text-right" ><h4>Footer</h4></div>
		</div>
	</div>
</div>
</body>
</html>











<!-- CARA PENGGUNAAN PGWSLIDESHOW -->
<!-- http://pgwjs.com/pgwslideshow/ -->
<!-- IMPORTNYA
	ditambahi echo di belakang base url;
	<script type="text/javascript" src="<?php  base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
	<script src="<?php  base_url(); ?>assets/plugin/pgwslideshow/pgwslideshow.js"></script>
	<link rel="stylesheet" href="<?php  base_url(); ?>assets/plugin/pgwslideshow/pgwslideshow.css"> -->
<!-- JAVASCRIPT -->
  <!-- 
  $(document).ready(function(){
  	$('.pgwSlideshow').pgwslideshow();
  }); 
-->
<!-- HTML -->
<!-- <ul class="pgwSlideshow">
    <li><img src="san-francisco.jpg" alt="San Francisco, USA" data-description="Golden Gate Bridge"></li>
    <li><img src="rio.jpg" alt="Rio de Janeiro, Brazil"></li>
    <li><img src="london_mini.jpg" alt="" data-large-src="london.jpg"></li>
    <li><img src="new-york.jpg" alt=""></li>
    <li><img src="new-delhi.jpg" alt=""></li>
    <li><img src="paris.jpg" alt=""></li>
    <li><img src="sydney.jpg" alt=""></li>
    <li><img src="tokyo.jpg" alt=""></li>
    <li><img src="honk-kong.jpg" alt=""></li>
    <li><img src="dakar.jpg" alt=""></li>
    <li><img src="toronto.jpg" alt=""></li>
    <li>
        <a href="http://en.wikipedia.org/wiki/Monaco" target="_blank">
            <img src="monaco.jpg" alt="Monaco">
        </a>
    </li>
</ul> -->
<!-- CARA PENGGUNAAN PGWSLIDESHOW -->