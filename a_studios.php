<?php
require 'core/init.php';
protectPage();
adminProtect();
include 'includes/_header.php';

if (isset($_GET['del'])){
	$del 	 = $_GET['del'];
	$name 	 = mysql_result(mysql_query("SELECT name from studios WHERE studio_id=$del"), 0);
	$alert[] = "Yakin mau hapus '$name'? <a class='button small icon fa-check' href='?del=$del&y'> Ya</a> <a class='button small special icon fa-remove' href='?del=$del&n'> Tidak</a>";
	echo outputErrors($alert);
}

if(isset($_GET['del']) && isset($_GET['y'])) {

	if(hapusData('studios', 'studio_id', $del)) {
		header('Location: a_studios.php');
	}
} elseif(isset($_GET['del']) && isset($_GET['n'])) {
	header('Location: a_studios.php');
}

$showPage 	= '';
$batas		= 2;
if (isset($_GET['page'])) $noPage = $_GET['page'];
	else $noPage = 1;

$offset=($noPage - 1) * $batas;

if(isset($_POST['cari'])){ 
  	$cari 		= trim($_POST['cari']);  
	$studioData = mysql_query("SELECT * FROM studios WHERE name LIKE '%$cari%'");
    $q     	  	= mysql_query("SELECT COUNT(studio_id) FROM studios WHERE name LIKE '%$cari%'");   
	?>		<?php
}else{
	
	$studioData = mysql_query("SELECT * FROM studios LIMIT $offset, $batas") or die (mysql_error());
	$q 			= mysql_query("SELECT COUNT(studio_id) from studios");
} 

$no = $offset+1;
?>

<div id="main" style="margin-top:-30px" class="container">

	<div class="row">

		<div class="3u 12u(narrower)">			
			<a href="a_studioAdd.php" class="button special fit icon fa-plus-square">Tambah Studio</a>
		</div>		
		<div align="center" class="5u 12u(narrower)">	
				<form action="" method="POST">
				  	<input type="text" name="cari" placeholder="Cari nama Studio..">				   
				</form>
		</div>
		<div align="right" class="4u 12u(narrower)">				
			<!-- <a href="produk_pdf.php" class="button small icon fa-download"> PDF</a> -->
			<a href="xls/studios_xls.php" class="button small icon fa-download"> Excel</a>
		</div>
		
	</div>

	<?php  
	if(mysql_num_rows($studioData) == 0) exit("<h2 align='center'><span class='icon fa-search'></span> Data Studio belum ditambahkan.</h2>");
	?>
	<div class="row">
		<?php 
		while($row = mysql_fetch_assoc($studioData)){
			$studio_id = $row['studio_id'];
		?>
		<div class="6u 12u(narrower)">

			<section class="box special">
				<span class="image featured"><img src="<?php echo $row['img'] ?>" alt="" /></span>	
				<h2><?php echo $row['name'] ?></h2>
				<ul align="left">
				<?php 
				$equips = mysql_query("SELECT equips.* FROM equips, studios WHERE equips.studio_id=studios.studio_id AND studios.studio_id=$studio_id");
				
				while($eq=mysql_fetch_assoc($equips)) {
					echo "<li>$eq[name]</li>";
				}
				?>
				</ul>
				<?php $nams = substr($row['description'], 0, 100);
		                  $len  = strlen($nams);
		                  if($len >= 100) echo $nams."...";
		                  else echo $nams; 
		             ?>
				<h3>Rp <?php echo rupiah($row['price']); ?>/jam</h3>
				<ul class="actions">
					<li><a href="a_studioEdit.php?id=<?php echo $studio_id ?>" class="button icon fa-edit">Ubah</a></li>
					<li><a href="?del=<?php echo $studio_id ?>" class="button alt icon fa-trash">Hapus</a></li>
				</ul>
			</section>

		</div>
		<?php
		}
		?>

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