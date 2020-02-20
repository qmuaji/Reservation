<?php 
require 'core/init.php';
protectPage();
include 'includes/_header.php';
?>

<?php 
if(isset($_SESSION['cetakNota'])){
	$book_code 	= $_SESSION['cetakNota'];
	$query 		= mysql_query("SELECT * FROM transactions WHERE md5(book_code)='$book_code'");
	$row 		= mysql_fetch_assoc($query);		
	$query2 	= mysql_query("SELECT i_time  FROM bookings WHERE md5(book_code)='$book_code'");
	
?>
<div class="alert">Terimakasih, pemesanan kamu berhasil <i class="icon fa-smile-o"></i> periksa kembali detail pemesanan kamu di bawah ini!</div>
<div class="container" style="margin-top:-80px" id="main">
	<div class="box">
		<h2 align="center" style="margin-top:-40px">Lan's <i class="icon fa-cube"></i> Reservation <br> #<?php echo $row['book_code'] ?></h2>
	<table>
		<tr>
			<td width="180px">
				Kode Pesan <br>
				Tgl Pesan <br>
				Nama Ruangan				
			</td>
			<td>
				: <?php echo $row['book_code'] ?> <br>
				: <?php echo date('d F, Y', strtotime($row['book_date'])) ?>  <br>
				: <?php echo $row['studio_name'] ?>				
			</td>
			
			<td width="90px">
				Nama <br>
				Tlp <br>
				Email <br>				
			</td>
			<td>
				: <?php echo $row['first_name'] ?> <br>
				: <?php echo $row['tlp'] ?> <br>
				: <?php echo $row['email'] ?>				
			</td>
		</tr>
	</table>

	<table class="alt" style="margin-top:-25px">
		<tr align="center">
			<td>Jam Sewa</td>
			<td>Harga / jam (Rp)</td>
			<td>Total Bayar (Rp)</td>
		</tr>
		<tr align="center">
			<td>
			<?php 
			while($row2 = mysql_fetch_assoc($query2)) {
				$end = $row2['i_time'] + 1;
				echo $row2['i_time'],":00 - $end:00"."<br>";
			}
			?>
			</td>
			<td>
				<?php echo rupiah($row['price']) ." X ".$row['q']?>
			</td>
			<td><?php echo rupiah($row['total'])?></td>
		</tr>
	</table>
	<a href="cetakNota.php" class="button fit icon fa-print" target="blank">Cetak</a>
	<sub>*Bukti pemesanan akan hangus jika tidak digunakan pada jam yang telah ditentukan!</sub>
	</div>
</div>
<?php
} else {
	header("Location: pemesanan.php");
}
include 'includes/_footer.php';

