<?php
require 'core/init.php';
include 'includes/_header.php';

$showPage 	= '';
$batas		= 6;
if (isset($_GET['page'])) $noPage = $_GET['page'];
	else $noPage = 1;

$offset=($noPage - 1) * $batas;

if(isset($_POST['cari'])){ 
  	$cari 		= trim($_POST['cari']);  
	$studioData = mysql_query("SELECT * FROM users WHERE type=0 AND active=1 AND first_name LIKE '%$cari%' LIMIT $offset, $batas");
    $q     	  	= mysql_query("SELECT COUNT(user_id) FROM users WHERE type=0 AND active=1 AND  first_name LIKE '%$cari%'");   
	?>		<?php
}else{
	
	$studioData = mysql_query("SELECT * FROM users WHERE type=0 AND active=1 LIMIT $offset, $batas") or die (mysql_error());
	$q 			= mysql_query("SELECT COUNT(user_id) from users WHERE type=0 AND active=1 ");
} 

$no = $offset+1;
?>

<div style="margin-top:-30px" id="main" class="container">
	<h3>Member list</h3>
	<?php  
	if(mysql_num_rows($studioData) == 0) exit("<h2 align='center'><span class='icon fa-search'></span> Data Studio belum ditambahkan.</h2>");
	?>
	<div class="row">
		<?php 
		while($row = mysql_fetch_assoc($studioData)){
		?>
		<div class="4u 12u(narrower)">

			<section class="box special">
				<span class="image featured"><img src="<?php echo $row['img'] ?>"/></span>	
				<h2><?php echo $row['first_name'] ?></h2>
				<?php $row['username']==null ? $akun=$row['email'] : $akun=$row['username'];
					echo $akun
				?>
				<ul class="actions">
					<!-- <li><a href="<?php echo $akun?>" class="button icon">Detail</a></li> -->
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

			<div class="6u 12u">		
		  		<input type="text" name="cari" placeholder="Cari..">				   
			</div>

		</div>
	</form>
	<!--<hr>-->
	<!--<div class="row">-->
	<!--	<p>-->
	<!--		Lan's Musik Studio adalah rental studio musik latihan band yang dilengkapi dengan equipment terkini dan di support oleh staff yang berpengalaman dan profesional. -->
	<!--		Studio kami berukuran 6x6 dan ruang operator berukuran 2x5. Equipment yang kami gunakan adalah sebagai berikut:-->
	<!--	</p>-->
	
	<!--</div>-->
</div>
<?php include 'includes/_footer.php' ?>