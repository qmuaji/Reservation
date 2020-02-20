<?php
require 'core/init.php';
protectPage();
adminProtect();
include 'includes/_header.php';

if (isset($_GET['del'])){
	$del 	 = $_GET['del'];
	$name 	 = mysql_result(mysql_query("SELECT name from equips WHERE eq_id=$del"), 0);
	$alert[] = "Yakin mau hapus '$name'? <a class='button small icon fa-check' href='?del=$del&y'> Ya</a> <a class='button small special icon fa-remove' href='?del=$del&n'> Tidak</a>";
	echo outputErrors($alert);
}

if(isset($_GET['del']) && isset($_GET['y'])) {

	if(hapusData('equips', 'eq_id', $del)) {
		header('Location: a_equips.php');
	}
} elseif(isset($_GET['del']) && isset($_GET['n'])) {
	header('Location: a_equips.php');
}

$showPage 	= '';
$batas		= 10;
if (isset($_GET['page'])) $noPage = $_GET['page'];
	else $noPage = 1;

$offset=($noPage - 1) * $batas;

if(isset($_POST['cari'])){ 
  	$cari 		= trim($_POST['cari']);  
	$equipData = mysql_query("SELECT equips.*, studios.name as sname FROM equips, studios WHERE equips.studio_id=studios.studio_id AND equips.name LIKE '%$cari%'ORDER BY studios.studio_id ");
    $q     	  	= mysql_query("SELECT COUNT(eq_id) from equips, studios WHERE equips.studio_id=studios.studio_id AND equips.name LIKE '%$cari%'");   
	?>		<?php
}else{
	
	$equipData = mysql_query("SELECT equips.*, studios.name as sname FROM equips, studios WHERE equips.studio_id=studios.studio_id ORDER BY studios.studio_id LIMIT $offset, $batas") or die (mysql_error());
	$q 			= mysql_query("SELECT COUNT(eq_id) from equips, studios WHERE equips.studio_id=studios.studio_id");
} 

$no = $offset+1;
?>

<div id="main" style="margin-top:-30px" class="container">

	<div class="row">

		<div class="3u 12u(narrower)">			
			<a href="a_equipAdd.php" class="button special fit icon fa-plus-square">Tambah Alat</a>
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
	if(mysql_num_rows($equipData) == 0) exit("<h2 align='center'><span class='icon fa-search'></span> Data alat belum ditambahkan.</h2>");
	?>
	<div class="row">
		<table class="alt">
			<thead>
				<tr align="center">
					<td>Kode Alat</td>
					<td>Tanggal Beli</td>
					<td>Nama Alat</td>
					<td>Deskripsi</td>
					<td>Kondisi</td>
					<td>Posisi</td>
					<td>Opsi</td>
				</tr>
			</thead>
			<tbody>
		<?php 
		while($row = mysql_fetch_assoc($equipData)){
		?>
			<tr>
				<td><?php echo $row['eq_id'] ?></td>
				<td><?php echo date('d/m/Y', strtotime($row['tgl_beli'])) ?></td>
				<td><?php $nams = substr($row['name'], 0, 30);
		                  $len  = strlen($nams);
		                  if($len >= 30) echo $nams."...";
		                  else echo $nams; 
		             ?>
		        </td>
				<td><?php $desc = substr($row['deskripsi'], 0, 30);
		                  $len  = strlen($desc);
		                  if($len >= 30) echo $desc."...";
		                  else echo $desc; 
					?>
				</td>
				<td align="center"><?php echo $row['status'] ?></td>
				<td align="center"><?php echo $row['sname'] ?></td>
				<td align="center"><a href="a_equipEdit.php?id=<?php echo $row['eq_id'] ?>" class="icon fa-edit"> | <a href="?del=<?php echo $row['eq_id'] ?>" class="icon fa-trash"></td>
				
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