<?php 
require 'core/init.php';
loggedInRedirect();

if(isset($_POST['email']) && !empty($_POST['email'])) {
	$email = trim($_POST['email']);
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 6 || strlen($email) > 50) {
		$alert[] = "Oops.. Alamat email tidak valid!";
	} elseif(!emailExists($email)) {
		$alert[] = "Email kamu belum terdaftar, silakan <a href='signup.php'>bergabung</a> untuk melanjutkan <i class='icon fa-smile-o'></i>";
	} else {
		if(recover($email)) {
			$alert[] = "<i class='icon fa-send-o'></i> &nbsp;Berhasil..  Silakan periksa inbox email kamu, periksa juga spam folder. <i class='icon fa-smile-o'></i> ";
		} else {
			$alert[] =$alert[] = "Sepertinya ada kesalahan, coba lagi lain kali <i class='icon fa-frown-o'></i>";
		}
	}
} 
include 'includes/_head.php'; 
?>
<body id="bg">

	<?php if(!empty($alert)) echo outputErrors($alert) ?>

	<div id="login">
		<h3>Lan's <i class="icon fa-cube"></i> Reservation</h3>					
		<div class="box">		
			<form action="" method="post">
			<h2>Lupa password? <br> Tidak masalah..</h2>
			<h5>Silakan masukan alamat email kamu </h5>
				<input type="email" name="email" id="email" placeholder="Email" maxlength="50">
				<input type="submit" value="Kirim" class="special fit">
			</form>
		</div>
		Sudah punya akun? <a href="login.php">Log In</a><br>	
		Belum punya akun? <a href="signup.php">Gabung</a>
	</div>
</body>
