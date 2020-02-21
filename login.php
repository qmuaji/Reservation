<?php 
require 'core/init.php';
loggedInRedirect();
require 'gabung.php';
include 'includes/_head.php'; 
?>
<body id="bg">

	<?php if(!empty($alert)) echo outputErrors($alert) ?>

	<div id="login">
		<h3>Lan's <i class="icon fa-cube"></i> Reservation</h3>					
		<div class="box">		
			<form action="" method="post">
			<h2>Log In</h2>
				<input type="email" name="email" id="email" placeholder="Alamat Email" required maxlength="50">
				<input type="password" name="password" id="password" placeholder="Password" required minlength="6">
				<input type="submit" value="Log In" class="special fit">
			</form>
			<h5><a href="recover.php">Lupa password?</a></h5>
		</div>
		Belum punya akun? <a href="signup.php">Gabung</a>	
	</div>
</body>
