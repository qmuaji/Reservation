<?php 
require 'core/init.php';
loggedInRedirect();
include 'includes/_head.php';
?>
<body id="bg">
	<div id="login">
	<?php
	if(isset($_GET['success']) && empty($_GET['success'])){
		require 'gabung.php';
		?>
			<h3>Aktivasi berhasil <i class="icon fa-smile-o"></i></h3>
			Selamat bergabung di Lan's Musik Studio. Silahkan Log In
			<form action="" method="post">
			<hr>
			<h3>Lan's Musik <i class="icon fa-music"></i> Studio</h3>
			<div class="box">
			<h2>Log In</h2>
				<input type="email" name="email" id="email" placeholder="Email Address" required maxlength="50">
				<input type="password" name="password" id="password" placeholder="Password" required minlength="6">
				<input type="submit" value="Log In" class="special fit">
			</form>
			<h5><a href="forgotpass.php">Lupa password?</a></h5>
			<?php
	} elseif(isset($_GET['email'], $_GET['email_code']) && !empty($_GET['email_code']) && !empty($_GET['email'])) {
		
		$email 		= sanitize($_GET['email']);
		$email_code = sanitize($_GET['email_code']);

		if(!emailExists($email)) {
			$alert[] = "Email tidak ditemukan!";
		} elseif(!activate($email, $email_code)) {
			$alert[] = "Mohon cek email kamu!";
		}

		if(!empty($alert)) {
			?>
		<h3>Lan's Musik <i class="icon fa-music"></i> Studio</h3>
		Sepertinya ada kesalahan...
		<div class="box">
			<h2 style="color:red">Oops.. <i class="icon fa-frown-o"></i></h2>
			<h3><?php echo outputErrors($alert) ?></h3>	
			<?php
		} else {
			header("Location: activate.php?success");
			exit();
		}
	} else {
		header("Location: ./");
		exit();
	}
	?>
		</div>
		Belum punya akun? <a href="signup.php">Gabung</a>
	</div>
</body>

