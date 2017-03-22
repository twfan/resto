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
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.3.min.js"></script>
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
   alert(kode_resto);
    $.ajax({
    	type:"post",
    	dataType:"json",
    	url:"<?php echo base_url('utama/baca_menu') ?>",
    	data:{kode_resto:kode_resto},
    	success:function(html)
    	{
    		for (var i = 0; i < html.length; i++) {
				var table = $("<tr><td>"+html[i].nama_makanan+"</td><td>"+html[i].deskripsi+"</td><td>"+html[i].harga+"</td><td><img src='"+html[i].foto_makanan+"' style='width:50px;height:50px;' /></td><td><button class='button_kurang' value='"+html[i].kode_menu+"'>-</button><input type='text' class='jumlah_pesan text-center' value='0' style='width:30px;'></input><button class='button_tambah' value='"+html[i].kode_menu+"'>+</button></td></tr>");
				$(table).find('.button_tambah').click(function(){
					$(table).find('input').val()
					// var kode_menu = $(this).val();
					// var hidden_menu = $(".hidden_menu").val();
					// var hidden_harga = $(".hidden_harga").val();
					// var jumlah_pesan = $(".jumlah_pesan").val();
					// var count_pesan = parseInt(jumlah_pesan) + 1;
					// $(".jumlah_pesan").val(count_pesan);
					// $.ajax({
					// 	type:"post",
					// 	url:"<?php echo base_url('utama/ajax_baca_harga')  ?>",
			  //           data:{kode_menu:kode_menu},
			  //           success:function(html){
			  //           	var total_harga = parseInt(hidden_harga)+parseInt(html[0].harga);
			  //           	/*alert(total_harga);*/
			  //           	$(".hidden_harga").val(total_harga);
			  //           	$(".total_harga").text(total_harga);
			  //           }
					// });
				})
				$(table).find('.button_kurang').click(function(){
					// var kode_menu = $(this).val();
					// var hidden_menu = $(".hidden_menu").val();
					// var hidden_harga = $(".hidden_harga").val();
					// var jumlah_pesan = $(".jumlah_pesan").val();
					// var count_pesan = parseInt(jumlah_pesan) - 1;
					// $(".jumlah_pesan").val(count_pesan);
					// $.ajax({
					// 	type:"post",
					// 	url:"<?php echo base_url('utama/ajax_baca_harga')  ?>",
			  //           data:{kode_menu:kode_menu},
			  //           success:function(html){
			  //           	var total_harga = parseInt(hidden_harga)-parseInt(html[0].harga);
			  //           	/*alert(total_harga);*/
			  //           	$(".hidden_harga").val(total_harga);
			  //           	$(".total_harga").text(total_harga);
			  //           }
					// });
				})
				$(".data-makanan").append(table)
			};
			
    	}
    });

    


    /*var pgwSlideshow = $('.pgwSlideshow').pgwSlideshow();
    pgwSlideshow.reload({
	    maxHeight:400,
	    intervalDuration:5000
	});
    pgwSlideshow.startSlide();*/
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
					<div class="table-responsive">
						<table class="table">
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
						<input type="hidden" class="hidden_menu" value="">
						<input type="hidden" class="hidden_harga" value="0">
					</div>
					<div class="row">
						<div class="col-md-4"><h4>Harga Total</h4></div>
						<div class=" col-md-offset-5 col-md-3 text-right"><h3 class="total_harga">Rp 100000</h3></div>
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