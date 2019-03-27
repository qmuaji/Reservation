<?php 
require 'core/init.php';
protectPage();
include 'includes/_head.php';
?>
  <script type="text/javascript">
    if (window.print) {
      document.write();
    }
    setTimeout('window.print()', 1000);
    setTimeout('TO_INDEX()', 1200);
  </script>
<?php 
if(isset($_GET['code']) || isset($_SESSION['cetakNota'])){
	isset($_GET['code']) ? $book_code  = $_GET['code'] : $book_code  = $_SESSION['cetakNota'];
	$query 		= mysql_query("SELECT * FROM transactions WHERE md5(book_code)='$book_code'");
	$row 		= mysql_fetch_assoc($query);		
	$query2 	= mysql_query("SELECT i_time  FROM bookings WHERE md5(book_code)='$book_code'");		
	
?>
<div class="container" style="margin-top:-30px" id="main">
	<div class="box">
	<h2 align="center">Lan's Musik <i class="icon fa-music"></i> Studio <br> #<?php echo $row['book_code'] ?></h2>
	<table>
		<tr>
			<td>
				Kode Pesan <br>
				Tgl Pesan <br>
				Nama Studio				
			</td>
			<td>
				: <?php echo $row['book_code'] ?> <br>
				: <?php echo date('d F, Y', strtotime($row['book_date'])) ?>  <br>
				: <?php echo $row['studio_name'] ?>				
			</td>
			<td></td>
			<td >
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
			<td>Jam Latihan</td>
			<td>Harga / jam</td>
			<td>Total Bayar</td>
		</tr>
		<tr align="center">
			<td>
			<?php 
			while($row3 = mysql_fetch_array($query2)) {
				$end = $row3['i_time'] + 1;
				echo $row3['i_time'],":00 - $end:00"."<br>";
			}
			?>
			</td>
			<td>
				<?php echo rupiah($row['price']) ." X ".$row['q']?>
			</td>
			<td><?php echo rupiah($row['total'])?></td>
		</tr>
	</table>
	</div>
	<p>* Bukti pemesanan akan hangus jika tidak digunakan pada jam yang telah ditentukan!</p>
</div>

<?php
} else {
	header("Location: pemesanan.php");
}
