<?php 
require 'core/init.php';
loggedInRedirect();

if(isset($_POST['email']) && !empty($_POST['email'])) {
	$email = trim($_POST['email']);
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 6 || strlen($email) > 50) {
		$alert[] = "Oops.. Alamat email tidak valid!";
	} elseif(!emailExists($email)) {
		$alert[] = "Email kamu belum terdaftar, silahkan bergabung <i class='icon fa-smile-o'></i>";
	} else {
		if(recover($email)) {
			$alert[] = "<i class='icon fa-send-o'></i> &nbsp;Berhasil!  Periksa email kamu, periksa juga spam folder. <i class='icon fa-smile-o'></i> ";
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
		<h3>Lan's Musik <i class="icon fa-music"></i> Studio</h3>					
		<div class="box">		
			<form action="" method="post">
			<h2>Lupa password? <br> Tidak masalah.</h2>
			<h5>Silahkan masukan alamat email kamu <i class="icon fa-smile-o"></i></h5>
				<input type="email" name="email" id="email" placeholder="Alamat Email" maxlength="50">
				<input type="submit" value="Kirim" class="special fit">
			</form>
		</div>
		Sudah punya akun? <a href="login.php">Log In</a><br>	
		Belum punya akun? <a href="signup.php">Gabung</a>
	</div>
</body>
