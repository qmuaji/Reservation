<?php 
require 'core/init.php';
include 'includes/_head.php';

?>
<body class="landing">
	<header id="header" class="alt">
	<?php 
	include 'includes/_menu.php';
	if(loggedIn()) {
		if(hasAccess($_SESSION['user_id'], 1) || hasAccess($_SESSION['user_id'], 2)) {
		?>
			<section id="banner" style="margin-top:-80px">
				<div class="container">
		
		
					<div class="box special">							
						<?php include"a_graf_pel.php" ?>
					</div>					

					<div class="box special">							
						<?php include"a_graf_trans.php" ?>
					</div>					
			
			
				</div>
			</section>
		</header>	
		</body>	
			<?php

			include 'includes/_footer.php';	
			exit();
		}
	}
	?>
	
		<section id="banner">
			<h2>Lan's Musik <i class="icon fa-music"></i> Studio</h2>
	<div id="page-wrapper">

		<?php
		if(loggedIn()) {
			?>
			<h4><?php echo $userData['email']; if(!empty($userData['username'])) echo ' | ', $userData['username'] ?> </h4>
			<?php 
			if(hasAccess($_SESSION['user_id'], 0)) {
			?>
			
			<ul class="actions">
				<li><a href="<?php if(!empty($userData['username'])) echo $userData['username']; else echo $userData['email'] ?>" class="button icon fa-cube">Profil</a></li>
				<li><a href="penyewaan.php" class="button icon fa-book">Pemesanan Studio</a></li>
			</ul>
			<?php
			}
		} else {
			?>
			<h3>Gabung <i class="icon fa-angle-right"></i> Pilih <i class="icon fa-angle-right"></i> Latihan.</h3>
			<ul class="actions">
				<li><a href="signup.php" class="button special">GABUNG</a></li>
				<li><a href="login.php" class="button">Log In</a></li>
			</ul>
			<?php
		}
		?>
		</section>

		<section id="main" class="container">
<!-- 			<section class="box special">
				<header class="major">
					<h2>Let's Groove...</h2>
					<p>Gabung dan menjadi member segera!!!</p>
				</header>
			</section> -->

			<div class="row">
				<div class="6u 12u(narrower)">
					<section class="box special">
						<span class="image featured"><img src="images/2.jpg" alt="" /></span>
						<h3>Studio Latihan</h3>
						<p>Lan's Musik Studio adalah rental studio musik latihan band yang dilengkapi dengan equipment terkini dan di support oleh staff yang berpengalaman dan profesional. Studio kami berukuran 6x6 dan ruang operator berukuran 2x5.</p>
						<ul class="actions">
							<li><a href="studios.php" class="button alt">Lihat</a></li>
						</ul>
					</section>
				</div>
				<div class="6u 12u(narrower)">
					<section class="box special">
						<span class="image featured"><img src="images/theta.jpg" alt="" /></span>
						<h3>Profil Band</h3>
						<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
						<ul class="actions">
							<li><a href="profiles.php" class="button alt">Lihat</a></li>
						</ul>
					</section>
				</div>
			</div>

			<section class="box special features">
				<h2>Testimonial</h2>
				<div class="features-row">
					<section>
						<span class="icon major fa-bolt accent2"></span>
						<h3>Magna etiam</h3>
						<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
					</section>
					<section>
						<span class="icon major fa-area-chart accent3"></span>
						<h3>Ipsum dolor</h3>
						<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
					</section>
				</div>
				<div class="features-row">
					<section>
						<span class="icon major fa-cloud accent4"></span>
						<h3>Sed feugiat</h3>
						<p>Integer volutpat ante et accumsan commophasellus sed aliquam feugiat lorem aliquet ut enim rutrum phasellus iaculis accumsan dolore magna aliquam veroeros.</p>
					</section>
						
					<section>
					</section>
				</div>
			</section>

		</section>
<?php
include 'includes/_footer.php';	