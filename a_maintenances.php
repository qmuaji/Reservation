<?php
require 'core/init.php';
protectPage();
adminProtect();
include 'includes/_header.php';

if (isset($_GET['del'])){
	$del 	 = $_GET['del'];
	$name 	 = mysql_result(mysql_query("SELECT * FROM maintenances WHERE maint_id=$del"), 0);
	$alert[] = "Yakin mau hapus '# $name'? <a class='button small icon fa-check' href='?del=$del&y'> Ya</a> <a class='button small special icon fa-remove' href='?del=$del&n'> Tidak</a>";
	echo outputErrors($alert);
}

if(isset($_GET['del']) && isset($_GET['y'])) {

	if(hapusData('maintenances', 'maint_id', $del)) {
		header('Location: a_maintenances.php');
	}
} elseif(isset($_GET['del']) && isset($_GET['n'])) {
	header('Location: a_maintenances.php');
}

$showPage 	= '';
$batas		= 10;
if (isset($_GET['page'])) $noPage = $_GET['page'];
	else $noPage = 1;

$offset=($noPage - 1) * $batas;

if(isset($_POST['cari'])){ 
  	$cari 		= trim($_POST['cari']);  
	$maintData = mysql_query("SELECT maintenances.*, equips.name, maintenances.status, studios.name as sname FROM equips, maintenances, studios WHERE studios.studio_id=equips.studio_id AND equips.eq_id=maintenances.eq_id AND equips.name LIKE '%$cari%'ORDER BY maintenances.tgl_maint");
    $q     	  	= mysql_query("SELECT COUNT(maint_id) from maintenances, equips WHERE maintenances.eq_id=equips.eq_id AND equips.name LIKE '%$cari%'");   
	?>		<?php
}else{
	
	$maintData = mysql_query("SELECT maintenances.*, equips.name, maintenances.status, studios.name as sname FROM equips, maintenances, studios WHERE studios.studio_id=equips.studio_id AND equips.eq_id=maintenances.eq_id ORDER BY maintenances.tgl_maint LIMIT $offset, $batas") or die (mysql_error());
	$q 			= mysql_query("SELECT COUNT(maint_id) from maintenances, equips WHERE maintenances.eq_id=equips.eq_id");
} 

$no = $offset+1;
?>

<div id="main" style="margin-top:-30px" class="container">

	<div class="row">

		<div class="3u 12u(narrower)">			
			<a href="a_maintenanceAdd.php" class="button special fit icon fa-plus-square">Maintenances</a>
		</div>		
		<div align="center" class="5u 12u(narrower)">	
				<form action="" method="POST">
				  	<input type="text" name="cari" placeholder="Cari nama alat..">				   
				</form>
		</div>
		<div align="right" class="4u 12u(narrower)">				
			<a href="produk_pdf.php" class="button small icon fa-download"> PDF</a>
			<a href="produk_xls.php" class="button small icon fa-download"> Excel</a>
		</div>
		
	</div>

	<?php  
	if(mysql_num_rows($maintData) == 0) exit("<h2 align='center'><span class='icon fa-search'></span> Data alat belum ditambahkan.</h2>");
	?>
	<div class="row">
		<table class="alt">
			<thead>
				<tr align="center">
					<td>#</td>
					<td>Tanggal Maintenance</td>
					<td>Nama Alat</td>
					<td>Posisi</td>
					<td>Biaya</td>
					<td>Konfirmasi Pemilik</td>
					<td>Status</td>
					<td>Opsi</td>
				</tr>
			</thead>
			<tbody>
		<?php 
		while($row = mysql_fetch_assoc($maintData)){
		?>
			<tr>
				<td><?php echo $row['maint_id'] ?></td>
				<td><?php $row['tgl_maint'] == 0000-00-00 ? $tgl="-" : $tgl=date('d F Y', strtotime($row['tgl_maint'])); echo $tgl ?></td>
				<td><?php $nams = substr($row['name'], 0, 30);
		                  $len  = strlen($nams);
		                  if($len >= 30) echo $nams."...";
		                  else echo $nams; 
		             ?>
		        </td>
				<td align="center"><?php echo $row['sname'] ?></td>
				<td align="right"><?php echo Rupiah($row['biaya_maint'])?></td>
				<td align="center"><?php $row['konfirm'] == 1 ? $ket="<b style='color:green'>Sudah</b>" : $ket="<b style='color:red'>Belum</b>"; echo $ket ?></td>
				<td align="center"><?php 
										if($row['status'] == 0){
											$status="<b style='color:red'>Pending</b>";
										} else if($row['status'] == 1){
											$status="<b style='color:orange'>Proses</b>";
										} else {
											$status="<b style='color:green'>Selesai</b>";
										}
										echo $status ;
									?>
				</td>
				<td align="center"><a href="a_maintenanceEdit.php?id=<?php echo $row['eq_id'] ?>" class="icon fa-edit"> | <a href="?del=<?php echo $row['maint_id'] ?>" class="icon fa-trash"></td>
				
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
			<hr>
		</div>		
	</div>
</div>
<?php include 'includes/_footer.php' ?>