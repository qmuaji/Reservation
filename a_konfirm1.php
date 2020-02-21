<?php
require 'core/init.php';
protectPage();
adminProtect();
include 'includes/_header.php';

if (isset($_GET['k']) || isset($_GET['b'])) {
	if (isset($_GET['k'])) {
		$id 	 = $_GET['k'];
		$alert[] = "Konfirmasi? <a class='button special small icon fa-check' href='?k=$id&y'> Ya</a> <a class='button small icon fa-remove' href='?k=$id&n'> Tidak</a>";
		echo outputErrors($alert);
	}

	if (isset($_GET['b'])){
		$id 	 = $_GET['b'];
		$alert[] = "Batal Konfirmasi? <a class='button small icon fa-check' href='?b=$id&y'> Ya</a> <a class='button small special icon fa-remove' href='?b=$id&n'> Tidak</a>";
		echo outputErrors($alert);
	}
}

if(isset($_GET['k']) && isset($_GET['y'])) {
	$q = mysql_fetch_assoc(mysql_query("SELECT * from deposit WHERE deposit_id=$_GET[k]"));

	$x = mysql_query("UPDATE deposit SET admin_confirm=1 WHERE deposit_id=$_GET[k]");
	$y = mysql_query("UPDATE users SET saldo=(saldo+$q[add_saldo]) WHERE user_id=$q[user_id]");
	if($x && $y) {
		header('Location: a_konfirm1.php');
		$userData['user_id'];
	}
} elseif(isset($_GET['k']) && isset($_GET['n'])) {
	header('Location: a_konfirm1.php');
}

if(isset($_GET['b']) && isset($_GET['y'])) {
	$q = mysql_fetch_assoc(mysql_query("SELECT * from deposit WHERE deposit_id=$_GET[b]"));

	$x = mysql_query("UPDATE deposit SET admin_confirm=0 WHERE deposit_id=$_GET[b]");
	$y = mysql_query("UPDATE users SET saldo=(saldo-$q[add_saldo]) WHERE user_id=$q[user_id]");
	if($x && $y) {
		header('Location: a_konfirm1.php');
	}
} elseif(isset($_GET['b']) && isset($_GET['n'])) {
	header('Location: a_konfirm1.php');
}

$showPage 	= '';
$batas		= 10;
if (isset($_GET['page'])) $noPage = $_GET['page'];
	else $noPage = 1;

$offset=($noPage - 1) * $batas;

if(isset($_POST['cari'])){ 
  	$cari 		= trim($_POST['cari']);  
	$konfirmasi = mysql_query("SELECT * FROM deposit, users WHERE users.user_id=deposit.user_id AND no_rek LIKE '%$cari%' ORDER BY trans_date DESC LIMIT $offset, $batas ");
    $q     	  	= mysql_query("SELECT COUNT(deposit_id) FROM deposit WHERE  no_rek LIKE '%$cari%' ORDER BY trans_date DESC");   
	?>		<?php
}else{
	
	$konfirmasi = mysql_query("SELECT * FROM deposit, users WHERE users.user_id=deposit.user_id ORDER BY trans_date DESC LIMIT $offset, $batas ") or die (mysql_error());
	$q 			= mysql_query("SELECT COUNT(deposit_id) from deposit");
} 

$no = $offset+1;
?>

<div id="main" style="margin-top:-30px" class="container">

	<div class="row">

		<div class="3u 12u(narrower)">			
		<h3>Konfirmasi 	Saldo</h3>
		</div>		
		<div align="center" class="5u 12u(narrower)">	
<!-- 				<form action="" method="POST">
				  	<input type="text" name="cari" placeholder="Cari No rekening..">				   
				</form> -->
		</div>
		<div align="right" class="4u 12u(narrower)">				
			<a href="produk_pdf.php" class="button small icon fa-download"> PDF</a>
			<a href="produk_xls.php" class="button small icon fa-download"> Excel</a>
		</div>
	</div>

	<?php  
	if(mysql_num_rows($konfirmasi) == 0) exit("<h2 align='center'><span class='icon fa-search'></span> Data belum ditambahkan.</h2>");
	?>
	<div class="table wrapper">
		<table class="alt">
			<thead>
				<tr align="center">
					<td>Username</td>
					<td>Tanggal Transfer</td>
					<td>Jumlah Transfer (Rp)</td>
					<td>No Rekening</td>
					<td>Status</td>
					<td>Opsi</td>
				</tr>
			</thead>
			<tbody>
		<?php 
		while($row = mysql_fetch_assoc($konfirmasi)){
		?>
			<tr>
				<td><?php empty($row['username']) ? $p = $row['email'] : $p = $row['username']; echo $p ?></td>
				<td><?php echo date('d F Y', strtotime($row['trans_date'])) ?></td>
				<td align="right"><?php echo rupiah($row['add_saldo']) ?></td>
				<td><?php echo $row['no_rek'] ?></td>
				<td align="center"><?php $row['admin_confirm']==1 ? $k ="<b class='icon fa-check'></b>" : $k ="<b class='icon fa-close'></b>"; echo $k?></td>
				<td align="center"><?php $row['admin_confirm']==1 ? $k ="<a href='#' class='button special small'>Selesai</a>" : $k ="<a href='a_konfirm1.php?k=$row[deposit_id]' class='button alt small'>Konfirmasi</a>"; echo $k?></td>
			</tr>
		<?php
		}
		?>
			</tbody>
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
	</div>
</div>
<?php include 'includes/_footer.php' ?>