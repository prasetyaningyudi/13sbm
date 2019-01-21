<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<?php
		$favicon = '';		
		$app_name = '';
		$app_icon = '';		
		if(!empty($app_data)){
			foreach($app_data as $value) {
				$favicon = $value->FAVICON;
				$app_name = $value->NAME;
				$app_icon = $value->ICON;				
			}
		}		
	?>	
	
	<?php if ($favicon != ''): ?>
		<?php echo '<link rel="icon" href="'.base_url().$favicon.'" type="image/ico" />'; ?>
	<?php else: ?> 
		<link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.png" type="image/ico" />
	<?php endif; ?>		

    <title>
		<?php 
			if(isset($subtitle)){
				echo ucwords(strtolower($subtitle)).' ';
			}else{
				echo '';
			} 
			if(isset($title)){
				echo $title;
			}else{
				echo 'Untitled';
			}
		?>	
	</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CVarela+Round" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

	<!-- Owl Carousel 
	<link type="text/css" rel="stylesheet" href="css/owl.carousel.css" />
	<link type="text/css" rel="stylesheet" href="css/owl.theme.default.css" />

	Magnific Popup 
	<link type="text/css" rel="stylesheet" href="css/magnific-popup.css" /> -->

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>	
	
	<!-- Custom stlylesheet -->
	<link href="<?php echo base_url(); ?>assets/css/home_style.css" rel="stylesheet">
	
    <!-- Select2 -->
    <link href="<?php echo base_url(); ?>assets/vendors/select2/select2.min.css" rel="stylesheet">	
    <script src="<?php echo base_url(); ?>assets/vendors/select2/select2.min.js"></script>		
</head>

<body>
	<!-- Header -->
	<header id="home">
		<!-- Background Image -->
		<div class="bg-img" style="background-image: url('<?php echo base_url(); ?>assets/images/pexels-photo.jpg');">
			<div class="overlay"></div>
		</div>
		<!-- /Background Image -->

		<!-- Nav -->
		<nav id="nav" class="navbar nav-transparent">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a href="<?php echo base_url(); ?>">
							<?php if ($app_icon != ''): ?>
								<?php echo '<i class="fa fa-'.$app_icon.'"></i>'; ?>
							<?php else: ?> 
								<i class="fa fa-paw"></i> 
							<?php endif; ?>
						</a>
					</div>
					<!-- /Logo -->

					<!-- Collapse nav button -->
					<div class="nav-collapse">
						<span></span>
					</div>
					<!-- /Collapse nav button -->
				</div>

				<!--  Main navigation  -->
				<ul class="main-nav nav navbar-nav navbar-right">
					<li><a href="#home">Home</a></li>
					<li><a href="#about">About</a></li>
					<li><a href="#footer">Contact</a></li>
					<li><a href="https://yudiprasetya.com/" target="_blank">Yudi Prasetya</a></li>
				</ul>
				<!-- /Main navigation -->

			</div>
		</nav>
		<!-- /Nav -->

		<!-- home wrapper -->
		<div class="home-wrapper">
			<div class="container">
				<div class="row">

					<!-- home content -->
					<div class="col-md-10 col-md-offset-1">
						<div class="home-content">
							<h1 class="white-text">STANDAR BIAYA MASUKAN <br>TA 2019</h1>
							<p class="white-text">Berdasarkan pada Peraturan Menteri Keuangan Republik Indonesia Nomor 32 / PMK.02/2018 <br>tentang Standar Biaya Masukan Tahun Anggaran 2019.
							</p>
							<select class="select-single form-control" name="sbm" style="width: 70%;">
								<option value="0">-- Pilih Daftar SBM --</option>
								<?php foreach($result as $value): ?>
									<option value="<?php echo $value->KODE; ?>"><?php echo $value->KETERANGAN; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<!-- /home content -->

				</div>
			</div>
		</div>
		<!-- /home wrapper -->

	</header>
	<!-- /Header -->

	<!-- About -->
	<div id="about" class="section md-padding">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<!-- Section header -->
				<div class="section-header text-center">
					<h2 class="title">Tentang Aplikasi SBM 2019</h2>
				</div>
				<!-- /Section header -->

				<!-- about -->
				<div class="col-md-4">
					<div class="about">
						<i class="fa fa-book"></i>
						<h3>PMK 32 /PMK.02/2018</h3>
						<p>Aplikasi SBM 2019 ini dibuat berdasarkan pada Peraturan Menteri Keuangan Republik Indonesia Nomor 32 / PMK.02/2018
tentang Standar Biaya Masukan Tahun Anggaran 2019.<br><br><br></p>
					</div>
				</div>
				<!-- /about -->

				<!-- about -->
				<div class="col-md-4">
					<div class="about">
						<i class="fa fa-magic"></i>
						<h3>SBM TA 2019</h3>
						<p>adalah satuan biaya berupa harga satuan, tarif, dan indeks yang ditetapkan untuk menghasilkan biaya komponen keluaran dalam penyusunan rencana kerja dan anggaran kementerian negara/lembaga Tahun Anggaran 2019.<br><br></p>
					</div>
				</div>
				<!-- /about -->

				<!-- about -->
				<div class="col-md-4">
					<div class="about">
						<i class="fa fa-exclamation-triangle"></i>
						<h3>Disclaimer</h3>
						<p>Aplikasi ini tidak dapat dijadikan acuan terkait penentuan SBM TA 2019. Karena kami tidak memberikan jaminan kebenaran data yang dimunculkan pada aplikasi ini. Penentuan SBM TA 2019 tetap harus mengacu pada PMK 32 /PMK.02/2018. <a href="http://www.jdih.kemenkeu.go.id/fullText/2018/32~PMK.02~2018Per.pdf" target="_blank">Download Disini</a></p>
					</div>
				</div>
				<!-- /about -->

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /About -->

	<!-- Footer -->
	<footer id="footer" class="sm-padding bg-dark">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<div class="col-md-12">

					<!-- footer logo -->
					<div class="footer-logo">
						<?php if ($app_icon != ''): ?>
							<?php echo '<i class="fa fa-'.$app_icon.'"></i>'; ?>
						<?php else: ?> 
							<i class="fa fa-paw"></i> 
						<?php endif; ?>
					</div>
					<!-- /footer logo -->

					<!-- footer follow -->
					<div class="footer-follow">
						<p>Salam kenal. Saya Yudi Prasetya founder dari aplikasi SBM ini. Saya berharap semoga aplikasi ini dapat bermanfaat bagi teman-teman semua. 
						<br>Terkait kritik, saran, maupun masukan teman-teman dapat menghubungi saya di email <span style="color:yellow">prasetyaningyudi@gmail.com</span><br>
						..---------------------------------------------..</p>
					</div>
					<!-- /footer follow -->

					<!-- footer copyright -->
					<div class="footer-copyright">
						<p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All Rights Reserved. <br>
					<?php if ($app_name != ''): ?>
						<?php echo $app_name; ?>  
					<?php else: ?> 
						Utakata 2.0
					<?php endif; ?>
					
					Created with <i class="fa fa-heart" aria-hidden="true" style="color:red"></i> by <a href="https://yudiprasetya.com/" title="yudiprasetya.com" target="_blank">Yudi Prasetya</a>.
				  <br>Template by <a target="_blank" href="https://colorlib.com">Colorlib</a></p>
					</div>
					<!-- /footer copyright -->

				</div>

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</footer>
	<!-- /Footer -->

	<!-- Back to top -->
	<div id="back-to-top"><i class="fas fa-arrow-up"></i></div>
	<!-- /Back to top -->

	<!-- Preloader -->
	<div id="preloader">
		<div class="preloader">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<!-- /Preloader -->

<script src="<?php echo base_url(); ?>assets/js/home_main.js"></script>
<script>
$(document).ready(function() {
	$('.select-single').select2();
	$(".select-single").on('change', function(){
		$( ".select-single option:selected" ).each(function() {
			var baseurl="<?php echo base_url(); ?>";
			if($(this).val() !== '0'){
				console.log($( this ).val().toLowerCase());
				window.location.replace(baseurl+$(this).val().toLowerCase());
			}
		});
	});
});
</script>	

</body>

</html>
