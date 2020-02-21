<?php
require 'core/init.php';
protectPage();

$saldo 		= $userData['saldo'];
$user_id 	= $userData['user_id'];

if(!empty($_POST)) {
	$requiredFields = array('captcha', 'add_saldo');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $requiredFields)){
			$alert[] = "Silahkan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
			break 1;
		}
	}

	if(empty($alert)) {

		$add_saldo 	= trim($_POST['add_saldo']);
		$captcha 	= trim($_POST['captcha']);
		
		if(strlen($add_saldo) > 16 || strlen($add_saldo) < 5 || !is_numeric($add_saldo)) {
			$alert[] = "Saldo tidak valid!";
		} elseif(strcmp($_SESSION['captcha'], $_POST['captcha']) != 0){
			$alert[] = "Captcha tidak sama, Silahkan ulangi!";
		} else {

			if(empty($errors)) {
				$_SESSION['add_saldo'] = $add_saldo+$user_id;
			}
		}
	}

} elseif (isset($_GET['batal']) && empty($_GET['batal'])) {
	unset($_SESSION['add_saldo']);
	header("Location: saldo.php");
} elseif (isset($_GET['ok']) && empty($_GET['ok'])) {
	$insertData = array(
		'user_id' 	=> $user_id,
		'add_saldo'	=> $_SESSION['add_saldo']
	);

	if(tambahData($insertData,'deposit')) {
		header("Location: konfirmasi.php");
		unset($_SESSION['add_saldo']);
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
					<li><h4><a href="userSettings.php" class="icon fa-user"> Informasi Akun</a></h4></li>
					<li><h4><a href="saldo.php" class="icon fa-money"><b>&nbsp; Isi Saldo</b></a></h4></li>
					<li><h4><a href="konfirmasi.php" class="icon fa-check"> Konfirmasi Bayar</a></h4></li>
					<li><h4><a href="gantiPass.php" class="icon fa-lock"> Ganti Password</a></h4></li>
				</ul>
			</div>					
		</div>
			
		<div class="8u 12u(mobile)">
			<div class="box">
				<h3>Isi Saldo</h3>
			<?php 
			if(isset($_SESSION['add_saldo']) && !empty($_SESSION['add_saldo'])) {
				?>		
				<table class="alt">
					<tr align="right">
						<td>Isi Saldo </td>
						<td><?= rupiah($_SESSION['add_saldo']) ?></td>
					</tr>
					<tr align="right">
						<td>Unik Transfer </td>
						<td><?= $user_id ?></td>
					</tr>
					<tr align="right">
						<td>Total Bayar </td>
						<td><?= rupiah($_SESSION['add_saldo']) ?></td>
					</tr>
				</table>
				Total bayar untuk tambah saldo adalah: <br>
				<h2 align="center" style="color:green; margin-top:-10px; margin-bottom:-5px;"><?= rupiah($_SESSION['add_saldo']) ?></h2>
				<a href='?ok' class="button fit special">Konfirmasi</a>
				<a href='?batal' class="button fit alt">Batal</a>
				<?php 
			} else {
			 ?>	Jumlah saldo kamu
				<h3><?= rupiah($saldo) ?></h3>
				<hr>
				<form action="" method="post" autocomplete="off">			
					<div class="row">
						<div class="6u 12u">		
							Isi Saldo* &nbsp;<b class="icon fa-money"></b>
							<select name="add_saldo">
								<option value="">- Pilih -</option>
								<option value="50000">Rp 50.000</option>
								<option value="100000">Rp 100.000</option>
								<option value="300000">Rp 300.000</option>
								<option value="500000">Rp 500.000</option>
								<option value="1000000">Rp 1.000.000</option>
							</select>
							<input type="submit" value="Isi Saldo" class="fit special">				
						</div>
						<div class="6u 12u">	
							Captcha* <a href='javascript: refreshCaptcha();'><i class="icon fa-refresh"></i></a>
							<input type="text" name="captcha" placeholder="Kode Captcha" required maxlength="8">
							<img  src="core/captcha.php?rand=<?= rand(); ?>" id='captchaimg' > 							
						</div>	
					</div>		
				</form>
			<?php 
			} ?>
			</div>		
		    <p>Nomor rekening Bank Syariah:</p><br>
		    <h3 align="center" style="margin-top:-40px;margin-bottom:-10px">4455 45 2323244 • Qmuaji App</h3> 
		</div>
	</div>
</div>

<script language='JavaScript' type='text/javascript'>
	function refreshCaptcha()
	{
		var img = document.images['captchaimg'];
		img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
	}
</script>								
<?php 

include 'includes/_footer.php';