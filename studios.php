<?php
require 'core/init.php';
include 'includes/_header.php';

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

<div style="margin-top:-30px" id="main" class="container">

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
				<span class="image featured"><img src="<?php echo $row['img'] ?>" alt="Lan's Musik" /></span>	
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
				<?php 
				(!loggedIn()) ? $red = "login.php?studio_id=$studio_id" : $red = "sewa.php?studio_id=$studio_id";
				
				?>
					<li><a href="<?php echo $red?>" class="button alt icon fa-mail-reply">Pesan</a></li>
				</ul>
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
		  		<input type="text" name="cari" placeholder="Cari nama studio..">				   
			</div>

		</div>
	</form>
	<hr>
	<div class="row">
		<p>
			Lan's Musik Studio adalah rental studio musik latihan band yang dilengkapi dengan equipment terkini. Studio kami berukuran 6x6 dan ruang operator berukuran 2x5. Equipment yang kami gunakan adalah sebagai berikut:
		</p>
		<div class="4u">
			<ul>
				<li>Allen Heath QU 24</li>
				<li>Marshall JCM900+Cab</li>
				<li>AMT SS10 + Marshall Cab</li>
				<li>Ashdown ABM 500 EVO III</li>
				<li>Ashdown Cabinet 410</li>
				<li>Rolland RD300NX</li>
			</ul>
		</div> 
		<div class="4u">
			<ul>
				<li>Jackson Guitar</li>
				<li>Ibanez Guitar</li>
				<li>Squier Bass Guitar</li>
				<li>Pearl Vision Drumset</li>
				<li>Double Pedal (Available upon request)</li>
				<li>Zildjian Cymbals</li>
			</ul>
		</div>
		<div class="4u">
			<ul>
				<li>Shure Mic</li>
			</ul>
		</div>		
	</div>
</div>
<?php include 'includes/_footer.php' ?>