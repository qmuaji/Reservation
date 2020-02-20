<?php 
require 'core/init.php';
loggedInRedirect();
require 'gabung.php';
include 'includes/_head.php';
?>
<body id="bg">

	<?php if(!empty($alert)) echo outputErrors($alert)?>

	<div id="login">
		<h3>Lan's <i class="icon fa-cube"></i> Reservation</h3>					
		<div class="box">		
			<form action="" method="post" autocomplete="off">
			<h2>Gabung</h2>
				<input type="email" name="email" id="email" placeholder="Alamat Email" required maxlength="50">
				<input type="password" name="password" id="password" placeholder="Password" required minlength="6">
				<input type="submit" value="GABUNG" class="special fit">
			</form>
			<h5>Dengan bergabung, Anda setuju dengan <a href="#">Persyaratan Layanan</a></h5>
		</div>
		Sudah punya akun? <a href="login.php">Log In</a>
	</div>
</body>