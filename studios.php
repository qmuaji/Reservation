<?php
require 'core/init.php';
include 'includes/_header.php';

$showPage 	= '';
$batas		= 3;
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

<div style="margin-top:-30px" id="main" class="container">

	<?php  
	if(mysql_num_rows($studioData) == 0) exit("<h2 align='center'><span class='icon fa-search'></span> Data Studio belum ditambahkan.</h2>");
	?>
	<div class="row">
		<?php 
		while($row = mysql_fetch_assoc($studioData)){
				$studio_id = $row['studio_id'];
		?>
		<div class="4u 12u(narrower)">

			<section class="box">
				<span class="image featured"><img src="<?= $row['img'] ?>" alt="Lan's Reservation" /></span>
				<h3><?= $row['name'] ?></h3>
				<ul>
				<?php 
				$equips = mysql_query("SELECT equips.* FROM equips, studios WHERE equips.studio_id=studios.studio_id AND studios.studio_id=$studio_id");
				
				while($eq=mysql_fetch_assoc($equips)) {
					echo "<li>$eq[name]</li>";
				}
				?>
				</ul>
				<h4>Rp <?= rupiah($row['price']); ?>/jam</h4>

				<?php $nams = substr($row['description'], 0, 100);
		                  $len  = strlen($nams);
		                  if($len >= 100) echo "<sub>". $nams ."...". "</sub>";
		                  else echo $nams;  
		        ?>

				<ul class="actions">
				    
				<?php 
				    (!loggedIn()) ? $red = "login.php?studio_id=$studio_id" : $red = "sewa.php?studio_id=$studio_id";
				
				?>
					
				</ul>
				<div style="text-align:center"><a href="<?= $red?>" class="button alt icon fa-mail-reply" >Pesan</a></div>
			</section>

		</div>
		<?php
		}
		?>
	</div>
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
		  		<input type="text" name="cari" placeholder="Cari..">				   
			</div>

		</div>
	</form>

</div>
<?php include 'includes/_footer.php' ?>