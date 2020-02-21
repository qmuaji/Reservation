<?php
require 'core/init.php';
protectPage();
adminProtect();
include 'includes/_header.php';

$showPage 	= '';
$batas		= 4;
if (isset($_GET['page'])) $noPage = $_GET['page'];
	else $noPage = 1;

$offset=($noPage - 1) * $batas;

if(isset($_POST['cari'])){ 
  	$cari 		= trim($_POST['cari']);  
	$nota 		= mysql_query("SELECT * FROM transactions WHERE book_code='$cari' ORDER BY book_date DESC");
    $q     	  	= mysql_query("SELECT COUNT(user_id) FROM transactions WHERE book_code='$cari'");   
	?>		<?php
}else{
	$nota 		= mysql_query("SELECT * FROM transactions ORDER BY book_date DESC LIMIT $offset, $batas") or die (mysql_error());
	$q 			= mysql_query("SELECT COUNT(user_id) from transactions");
} 

$no = $offset+1;

?>

<div style="margin-top:-30px" id="main" class="container">
	<h3> Konfirmasi Pemesanan</h3>

	<form action="" method="POST">
		<div class="row">			
			<div class="6u 12u">		
		  		<input type="text" name="cari" placeholder="Cari kode pemesanan..">				   
			</div>
			<div  align="right" class="6u 12u">
				<?php 			

			 	$jml 		= mysql_fetch_array($q);
			  	$jmlData	= $jml[0];
			  	$jmlPage	= ceil($jmlData / $batas);

				if($noPage > 1) echo "<a class='button alt small' href=$_SERVER[PHP_SELF]?page=".($noPage-1)."><span class='icon fa-chevron-left'></a>";

				  for($i=1; $i <= $jmlPage; $i++){

				    if ((($i >= $noPage - $batas) && ($i <= $noPage + $batas)) || ($i == 1)  || $i == $jmlPage){

				      if(($showPage == 1) && ($i != 2)) echo "<a class='button small'>...</a>";

				      if(($showPage != ($jmlPage - 1)) && ($i == $jmlPage)) echo "<a class='button alt small'>...</a>";

				      if($i==$noPage) echo "<a class='button special alt small'>$i</a>";

				      else echo "<a class='button alt small' href=".$_SERVER['PHP_SELF']."?page=".$i." > ".$i."</a>";

				      $showPage=$i;
				    }  
				}			 
				
				if ($noPage < $jmlPage) echo "<a class='button alt small' href=$_SERVER[PHP_SELF]?page=".($noPage+1)."><span class='icon fa-chevron-right'></span></a>";
				?>	
			</div>
		</div>
	</form>
	<?php  

		if(mysql_num_rows($nota) == 0) echo("<hr><h2 align='center'><span class='icon fa-search'></span> Data tidak ditemukan, <br><a class='icon fa-chevron-left' href='a_konfirm2.php'> Kembali</a></h2><hr>");

		while($row = mysql_fetch_assoc($nota)){
			$query2 	= mysql_query("SELECT i_time  FROM bookings WHERE book_code='$row[book_code]'");
		?>
	<div class="box">
		<?php 
		$today_dt = new DateTime(date('Y-m-d'));
		$expire_dt = new DateTime($row['book_date']);
		
		if ($expire_dt >= $today_dt) {
			?><a href="cetakNota.php?code=<?= md5($row['book_code']) ?>" class="button fit icon fa-print" target="blank"> Cetak</a><?php
		} else {
			?><b style="color:green">Selesai </b> | <a href="cetakNota.php?code=<?= md5($row['book_code']) ?>" class="icon fa-print" target="blank"> Cetak</a> <?php
		}
		?>
		<table>
		<tr>
			<td width="180px">
				Kode Pesan <br>
				Tgl Pesan <br>
				Nama Ruangan				
			</td>
			<td>
				: <?= $row['book_code'] ?> <br>
				: <?= date('d F, Y', strtotime($row['book_date'])) ?>  <br>
				: <?= $row['studio_name'] ?>
				
			</td>
			
			<td widtd="90px">
				Nama <br>
				Tlp <br>
				Email <br>				
			</td>
			<td>
				: <?= $row['first_name'] ?> <br>
				: <?= $row['tlp'] ?> <br>
				: <?= $row['email'] ?>				
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
				<?= rupiah($row['price']) ." X ".$row['q']?>
			</td>
			<td><?= rupiah($row['total'])?></td>	
		</tr>
	</table>

	</div>
		<?php
		}
		?>

	</div>
	<?php include 'includes/_footer.php';