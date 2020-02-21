<?php
require 'core/init.php';
protectPage();


if(isset($_GET['studio_id']) && !empty($_GET['studio_id'])) {

	$email 		= $userData['email'];
	$first_name = $userData['first_name'];
	$tlp 		= $userData['tlp'];
	$studio_id 	= $_GET['studio_id'];

	$studioData = mysql_query("SELECT * FROM studios WHERE studio_id=$studio_id");
	$cek 		= mysql_num_rows($studioData);
	$row 		= mysql_fetch_assoc($studioData);	
	$time 		= isset($_POST['pesan']) ? $_POST['pesan'] : null; 
	$q 			= count($time);
	$total		= $q * (int)$row['price'];
	$balance 	= mysql_query("SELECT saldo FROM users WHERE user_id=$userData[user_id]");
	
	if($cek == 0) {
		header("Location: ./");
		exit();
	}

	if(!empty($_POST)) {
		$requiredFields = array('email', 'tlp', 'book_date', 'pesan');
		foreach($_POST as $key=>$value) {
			if(empty($value) && in_array($key, $requiredFields)){
				$alert[] = "Silakan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
				break 1;
			}
		}

		if(empty($alert)) {			
		
			$book_code 	= getNota();
			$book_date 	= trim($_POST['book_date']);
			$email 		= trim($_POST['email']);
			$tlp 		= trim($_POST['tlp']);
			$first_name = trim($_POST['first_name']);	
			
			if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 6 || strlen($email) > 50) {
				$alert[] = "Oops.. Email tidak valid!";
			} elseif(!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
				$alert[] = "Nama hanya huruf dan spasi!";
			} elseif(strlen($first_name) < 3 || strlen($first_name) > 32) {
				$alert[] = "Nama minimal 3 dan maksimal 32 karakter.";
			} elseif($total > mysql_result($balance, 0)) { // validasi balance dulu brooooo!!!
				$alert[] = "Maaf, Saldo kamu tidak cukup! <a class='button small special' href='saldo.php'>Klik disini untuk menambah saldo</a>";
			} elseif($q == 0) { // pesan!!!
				$alert[] = "Silakan pilih jam sewa.";
			} elseif(strlen($tlp) > 16 || strlen($tlp) < 6 || !is_numeric($tlp)) {
				$alert[] = "No. tlp tidak valid!";
			} else {
				foreach ($time as $i_time) {
					$cekBook 	= mysql_query("SELECT count(*) FROM bookings 
										WHERE book_date='$book_date' 
										AND studio_id=$studio_id
										AND i_time=$i_time");
					if(mysql_result($cekBook, 0) >= 1) {
						$alert[] = "Oops, Pemesanan Gagal, silakan ulangi lagi setelah beberapa saat <i class='icon fa-frown-o'></i>";
						break 1;
					}
				}
			}
			
			if(empty($alert)) {

				foreach ($time as $i_time) {
					$b = mysql_query("INSERT INTO bookings SET 
						studio_id	= $studio_id, 
						book_code	= '$book_code', 
						book_date	= '$book_date', 
						i_time		= $i_time");
				}

				$t = mysql_query("INSERT INTO transactions SET
						user_id 	= $userData[user_id],
						book_code 	= '$book_code',
						book_date 	= '$book_date',
						studio_name	= '$row[name]',
						first_name 	= '$first_name',
						email	 	= '$email',
						tlp		 	= '$tlp',
						price	 	= $row[price],
						q	 		= $q,
						total 		= '$total'");

				$s = mysql_query("UPDATE users SET saldo=(saldo-$total) WHERE user_id=$userData[user_id]");


				if($b && $t && $s) {
					$_SESSION['cetakNota'] = md5($book_code);
					email($email , 'Pemesanan Lan\'s Rooms Reservation - ' . $book_date, "Dear {$email}, \n\nTerimakasih telah melakukan pemesanan ruangan ".$row['name']." :) \nSilakan konfirmasi dengan kode pemesanan: {$book_code}\n\n~Lan's Rooms Reservation");
					header("Location: nota.php");
					exit();
				} else {
					$alert[] = "Maaf, Pemesanan Gagal. Silakan ulangi! <i class='icon fa-frown-o'></i>";
				}
			}
		} 
	}

	include 'includes/_header.php';
	
	if(!empty($alert)) echo outputErrors($alert);


	?>
	<div style="margin-top:-50px" id="main" class="container">					
		<div class="row">
			<div class="4u 12u(mobile)">
				<div class="box">							
					<span class="image featured"><img src="<?= $row['img'] ?>" alt="Lan's Reservation" /></span>	
					<h3><?= $row['name'] ?></h3>
					<h4>Rp. <?= rupiah($row['price']) ?> /jam</h4>
					<sub> <?= $row['description'] ?> </sub>
					<!-- <input type="hidden" name=""value="<?= $studio_id ?>" id="studio_id"> -->
					<!-- <input type="hidden" name=""value="<?= $row['price'] ?>" id="price"> -->
				</div>
			</div>
			
			<div class="8u 12u(mobile)">
				<div class="box">					
					<form action="" method="post" autocomplete="off">			
						<div class="row">
							<div class="6u 12u">	
								Tanggal Sewa* &nbsp;<b class="icon fa-calendar"></b>
								<input type="date" name="book_date" onChange="jadwal_jam()" max="<?= $dateMax ?>" min="<?= $dateMin ?>" value="<?= date('Y-m-d') ?>" id="dates">
								Nama*
								<input type="text" name="first_name" placeholder="Nama" value="<?= $first_name ?>" required minlength="3" maxlength="32">
								Email* &nbsp;<b class="icon fa-envelope"></b>	
								<input type="email" name="email" placeholder="Email" value="<?= $email ?>" required maxlength="30">
								Tlp* &nbsp;<b class="icon fa-phone"></b>	
								<input type="text" name="tlp" placeholder="Tlp" value="<?= $tlp ?>" required minlength="8" maxlength="16">
							<!-- 	Spesial Request	
								<textarea name="req" id="" cols="10" rows="15"></textarea> -->

								<input type="submit" value="Pesan" onclick="return confirm('Pesan ruangan <?= $row['name'] ?>?')" class="fit special">					
								<sub><blockquote>*Pastikan data pemesanan sudah sesuai, pemesanan tidak dapat dibatalkan.</blockquote></sub>
							</div>	
							<div class="6u 12u">	
							<h3>Jam Sewa</h3>
								<span id="jam"><span style='color:red'>Silakan pilih tanggalnya.</span></span>
							</div>
						</div>		
					</form>
				</div>		
			</div>
		</div>
	</div>

<?php

} include 'includes/_footer.php';

?>

<script>
	function jadwal_jam() {
		var dates=$("#dates").val();
		var studio_id=<?= $studio_id ?>;
		$.ajax({
			type:"GET",
			url:"jadwal_jam.php",
			data:"dates="+dates+"&studio_id="+studio_id,
			success: function(html) {
				$("#jam").html(html);
			}
		});
	}
	$(document).ready(function(){jadwal_jam()});
</script>
