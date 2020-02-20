<?php
require 'core/init.php';
protectPage();
if(!empty($_POST)) {
	$requiredFields = array('oldPassword', 'newPassword', 'confirmPassword');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $requiredFields)){
			$alert[] = "Silahkan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
			break 1;
		}
	}

	if(empty($alert)) {
		$oldPassword	 	= trim($_POST['oldPassword']);
		$newPassword 		= trim($_POST['newPassword']);
		$confirmPassword 	= trim($_POST['confirmPassword']);

		if(sha1($oldPassword) !== $userData['password']) {
			$alert[] = "Oops.. Password tidak cocok! <i class='icon fa-frown-o'></i>";
		} else {

			if($newPassword !== $confirmPassword) {
				$alert[] = "Password baru kamu tidak cocok! <i class='icon fa-frown-o'></i>";
			} elseif(strlen($newPassword) < 6) {
				$alert[] = "Oops.. Password terlalu pendek! minimal 6 karakter.";
			} elseif(strlen($newPassword) > 64) {
				$alert[] = "Oops.. Password terlalu panjang! <i class='icon fa-frown-o'></i>";
			} elseif(gantiPass($_SESSION['user_id'], $newPassword)){
				$alert[] = "Password berhasil di ganti <i class='icon fa-smile-o'></i>";
			} else {
				$alert[] = "Password gagal di ganti!";
			}
		}
	}
} 

include 'includes/_header.php';
if(!empty($alert)) echo outputErrors($alert);
?>
<div style="margin-top:-30px" id="main" class="container">				
	<div class="row">
		<div class="4u 12u(mobile)">
			<div class="box	">							
				<ul class="alt">
				<li align="center"><h3 class="icon fa-cog"></h3></li>
					<li><h4><a href="userSettings.php" class="icon fa-user"> Informasi Akun</a></h4></li>
					<?php 
					if (hasAccess($_SESSION['user_id'], 0)){
						?>
					<li><h4><a href="saldo.php" class="icon fa-money">&nbsp; Isi Saldo</a></h4></li>
					<li><h4><a href="konfirmasi.php" class="icon fa-check"> Konfirmasi Bayar</a></h4></li>
						<?php
					}
					 ?>
					<li><h4><a href="gantiPass.php" class="icon fa-lock"> <b>Ganti Password</b></a></h4></li>
				</ul>
			</div>					
		</div>
			
		<div class="8u 12u(mobile)">
			<div class="box">
				<form action="" method="post" autocomplete="off">						
					<h3>Ganti Password</h3>
					Password sekarang*
					<input type="password" name="oldPassword" placeholder="Password sekarang" minlength="6">
					Password baru
					<input type="password" name="newPassword" placeholder="Password baru" minlength="6">	
					Konfirmasi password
					<input type="password" name="confirmPassword" placeholder="Konfirmasi password" minlength="6">	
					<input type="submit" value="Simpan" class="fit">	
				</form>
				<h1 align="center"><a href="recover.php">Lupa password?</a></h1>			
			</div>		
		</div>
	</div>
</div>

<?php include 'includes/_footer.php';