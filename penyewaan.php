<?php
require 'core/init.php';
include 'includes/_header.php';

$showPage 	= '';
$batas		= 4;
if (isset($_GET['page'])) $noPage = $_GET['page'];
	else $noPage = 1;

$offset=($noPage - 1) * $batas;

if(isset($_POST['cari'])){ 
  	$cari 		= trim($_POST['cari']);  
	$nota 		= mysql_query("SELECT * FROM transactions WHERE user_id=$userData[user_id] AND book_code='$cari' ORDER BY book_date DESC");
    $q     	  	= mysql_query("SELECT COUNT(user_id) FROM transactions WHERE user_id=$userData[user_id] AND book_code='$cari'");   
	?>		<?php
}else{
	$nota 		= mysql_query("SELECT * FROM transactions WHERE user_id=$userData[user_id] ORDER BY book_date DESC LIMIT $offset, $batas") or die (mysql_error());
	$q 			= mysql_query("SELECT COUNT(user_id) from transactions WHERE user_id=$userData[user_id]");
} 

$no = $offset+1;

?>

<div style="margin-top:-30px" id="main" class="container">
	<h3> Pemesanan Kamu</h3>
	<?php  
		if(mysql_num_rows($nota) == 0) echo("<hr><h2 align='center'><span class='icon fa-search'></span> Data tidak ditemukan, <br><a class='icon fa-chevron-left' href='penyewaan.php'> Kembali</a></h2><hr>");

		while($row = mysql_fetch_assoc($nota)){
			$query2 	= mysql_query("SELECT i_time  FROM bookings WHERE book_code='$row[book_code]'");
		?>
	<div class="box">
		<?php 
		$today_dt = new DateTime(date('Y-m-d'));
		$expire_dt = new DateTime($row['book_date']);
		
		if ($expire_dt >= $today_dt) {
			?><a href="cetakNota.php?code=<?php echo md5($row['book_code']) ?>" class="button fit icon fa-print" target="blank">Cetak</a><?php
		} else {
			?><b style="color:green">Selesai</b> <?php
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
				: <?php echo $row['book_code'] ?> <br>
				: <?php echo date('d F, Y', strtotime($row['book_date'])) ?>  <br>
				: <?php echo $row['studio_name'] ?>
				
			</td>
			
			<td widtd="90px">
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
			<td> <?php echo rupiah($row['total'])?></td>	
		</tr>
	</table>

	</div>
		<?php
		}
		?>
	<form action="" method="POST">
		<div class="row">
			
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

			<div class="6u 12u">		
		  		<input type="text" name="cari" placeholder="Cari kode pemesanan..">				   
			</div>
		</div>
	</form>
	
</div>

	<?php include 'includes/_footer.php';

		if(mysql_num_rows($nota) == 0) echo("<hr><h2 align='center'><span class='icon fa-search'></span> Data tidak ditemukan, <br><a href='a_konfirm2.php'> Kembali</a>.</h2><hr>");
