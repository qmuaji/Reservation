<?php
require 'core/init.php';
protectPage();

$saldo 		= $userData['saldo'];
$user_id 	= $userData['user_id'];
$email	 	= $userData['email'];

if(!empty($_POST)) {
	$requiredFields = array('captcha', 'add_saldo', 'trans_date');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $requiredFields)){
			$alert[] = "Silahkan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
			break 1;
		}
	}

	if(empty($alert)) {

		$add_saldo 	= $_POST['add_saldo'];
		$captcha 	= $_POST['captcha'];
		$no_rek	 	= $_POST['no_rek'];
		$trans_date	= $_POST['trans_date'];
		
		if(strlen($no_rek) > 30) {
			$alert[] = "No Rekening tidak valid!";
		} elseif($add_saldo > 10000000 || $add_saldo < 50000 || !is_numeric($add_saldo)) {
			$alert[] = "Saldo tidak valid!";
		} elseif(strcmp($_SESSION['captcha'], $_POST['captcha']) != 0){
			$alert[] = "Captcha tidak sama, Silahkan ulangi!";
		} elseif($add_saldo > 1900000 || $add_saldo < 50000){
			$alert[] = "Oops.. Jumlah Transfer tidak valid!";
		} else {

			if(empty($errors)) {

				$dataSaldo = array(
					'user_id' 	=> $user_id,
					'trans_date'=> $trans_date,
					'no_rek'	=> $no_rek,
					'user_confirm'	=> 1,
					'add_saldo'	=> $add_saldo
				);

				if(ubahData('deposit', $dataSaldo, "deposit_id", $_GET['id'])) {
					$alert[] = "Konfirmasi bayar berhasil, silahkan tunggu konfirmasi dari admin <i class='icon fa-smile-o'></i>";
					email($email, 'Isi Saldo Lans Musik Studio', "Dear {$email}, \n\nTerimakasih telah mengkonfirmasi pembayaran :) \n Silahkan tunggu konfirmasi dari admin\n\n~Lans Musik Studio");
				} else {
					$alert[] = "Konfirmasi bayar gagal! <i class='icon fa-frown-o'></i>";
				}
			}
		}
	}
} 

include 'includes/_header.php';
if(!empty($alert)) echo outputErrors($alert);

if (isset($_GET['del'])){
	$del 	 = $_GET['del'];
	$alert[] = "Yakin mau hapus? <a class='button small icon fa-check' href='?del=$del&y'> Ya</a> <a class='button small special icon fa-remove' href='?del=$del&n'> Tidak</a>";
	echo outputErrors($alert);
}

if(isset($_GET['del']) && isset($_GET['y'])) {

	if(hapusData('deposit', 'deposit_id', $del)) {
		header('Location: konfirmasi.php');
	}
} elseif(isset($_GET['del']) && isset($_GET['n'])) {
	header('Location: konfirmasi.php');
}

$showPage 	= '';
$batas		= 10;

isset($_GET['page']) ? $noPage = $_GET['page'] : $noPage = 1;

$offset		=($noPage - 1) * $batas;	
$konfirmasi = mysql_query("SELECT * FROM deposit WHERE user_id=$user_id ORDER BY deposit_id DESC LIMIT $offset, $batas");
$q 			= mysql_query("SELECT COUNT(deposit_id) from deposit WHERE user_id=$user_id");


$no = $offset+1;
?>


<div style="margin-top:-30px" id="main" class="container">			
	<div class="row">
		<div class="4u 12u(mobile)">
			<div class="box	">							
				<ul class="alt">
				<li align="center"><h3 class="icon fa-cog"></h3></li>
					<li><h4><a href="userSettings.php" class="icon fa-user"> Informasi Akun</a></h4></li>
					<li><h4><a href="saldo.php" class="icon fa-money"> Isi Saldo</a></h4></li>
					<li><h4><a href="konfirmasi.php" class="icon fa-check"> <b>Konfirmasi Bayar</a></b></h4></li>
					<li><h4><a href="gantiPass.php" class="icon fa-lock"> Ganti Password</a></h4></li>
				</ul>
			</div>					
		</div>
			
		<div class="8u 12u(mobile)">
			<div class="box">
				<h3 class="icon fa-check"> Konfirmasi Bayar</h3>
		<?php
		if(isset($_GET['id']) && !empty($_GET['id'])) {
			$id = $_GET['id'];
			$isi= mysql_fetch_array(mysql_query("SELECT * FROM deposit WHERE user_id=$user_id AND deposit_id=$id ORDER BY deposit_id DESC"));

			$add_saldo 	= $isi['add_saldo'];
			$no_rek 	= $isi['no_rek'];
			$trans_date	= $isi['trans_date'];
		?>
			<?php echo outputErrors(array("Pastikan kamu telah mentransfer uang sebelum mengisi form ini.")) ?>
			<form action="" method="post" autocomplete="off">			
				<div class="row">
					<div class="6u 12u">	
						Jumlah Transfer* (Rp)</b>
						<input type="number" name="add_saldo" placeholder="Jumlah Transfer Rp" required max="1900000" min="50000" value="<?php echo $add_saldo ?>">
						Captcha* <a href='javascript: refreshCaptcha();'><i class="icon fa-refresh"></i></a>
						<input type="text" name="captcha" placeholder="Kode Captcha" required maxlength="8">
						<img  src="core/captcha.php?rand=<?php echo rand(); ?>" id='captchaimg' > 	
					</div>	
					<div class="6u 12u">		
						Rekening Pengirim
						<input type="text" name="no_rek" value="<?php echo $no_rek ?>" placeholder="No Rekening" maxlength="24" minlength="8">
						Tanggal Transfer* (tttt-bb-hh)
						<input type="date" name="trans_date" placeholder="Tanggal Transfer" value="<?php echo $trans_date ?>" max="<?php echo $dateMin ?>" required>
						<input type="submit" value="Konfirmasi Bayar" class="fit special">				
					</div>
				</div>		
			</form>			
			
		<?php
		} else {
			
			if(mysql_num_rows($konfirmasi) == 0) echo("<hr><a href='saldo.php' class='button special'>Klik disini untuk menambah saldo</a>");

			?>
			<table class="alt">
				<tr>
					<td>Tanggal</td>
					<td>Isi Saldo</td>
					<td align="center">Status</td>
				</tr>	
			<?php

			while($row = mysql_fetch_assoc($konfirmasi)) {

				if ($row['user_confirm'] == 0 && $row['admin_confirm'] == 0) {
					$btn = "Konfirmasi";
					$link= "?id=$row[deposit_id]";
				} elseif($row['admin_confirm'] == 0 && $row['user_confirm'] == 1) {
					$btn = "Lihat";
					$link= "?id=$row[deposit_id]";
				} elseif($row['admin_confirm']==1) {
					$btn = "Selesai";
					$link= "#";
				}
			?>				
				<tr>
					<td><?php $row['trans_date']=="0000-00-00" ? $tgl="-" : $tgl = date('d F Y', strtotime($row['trans_date'])); echo $tgl ?></td>
					<td><?php echo rupiah($row['add_saldo']) ?></td>
					<td align="right">
						<a href="<?php echo $link ?>" class="button alt small "><?php echo $btn ?></a> 
						<!-- <a href="?del=<?php echo $row['deposit_id'] ?>" class="button small alt"><span class="icon fa-trash"></span></a> -->
					</td> 
				</tr>				
			<?php
			}
			
		?>	
			</table>
			<div align="center" class="12u">
				<?php 			

			 	$jml 		= mysql_fetch_array($q);
			  	$jmlData	= $jml[0];
			  	$jmlPage	= ceil($jmlData / $batas);

			  	echo "Total Data: ".$jmlData."<br>";

				if($noPage > 1) echo "<a class='button alt small' href=$_SERVER[PHP_SELF]?page=".($noPage-1)."><span class='icon fa-chevron-left'></a>";

				  for($i=1; $i <= $jmlPage; $i++){

				    if ((($i >= $noPage - $batas) && ($i <= $noPage + $batas)) || ($i == 1)  || $i == $jmlPage){

				      if(($showPage == 1) && ($i != 2)) echo "<a class='button alt small'>...</a>";

				      if(($showPage != ($jmlPage - 1)) && ($i == $jmlPage)) echo "<a class='button alt small'>...</a>";

				      if($i==$noPage) echo "<a class='button special alt small'>$i</a>";

				      else echo "<a class='button alt small' href=".$_SERVER['PHP_SELF']."?page=".$i." > ".$i."</a>";

				      $showPage=$i;
				    }  
				}			 
				
				if ($noPage < $jmlPage) echo "<a class='button alt small' href=$_SERVER[PHP_SELF]?page=".($noPage+1)."><span class='icon fa-chevron-right'></span></a>";
				?>
			</div>
			
		<?php
		}
		?>	
		
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