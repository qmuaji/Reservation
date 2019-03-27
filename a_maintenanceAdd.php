<?php
require 'core/init.php';
protectPage();
adminProtect();

$eq_id 		= '';
$biaya		= '';
$keterangan = '';

function eq_idExist($table, $name) {
	$name = sanitize($name);
	return (mysql_result(mysql_query("SELECT COUNT(*) FROM $table WHERE eq_id='$name'"), 0) == 1) ? true : false;
}

if(!empty($_POST)) {

	$eq_id 		= trim($_POST['eq_id']);
	$biaya		= trim($_POST['biaya']);
	$keterangan  = trim($_POST['keterangan']);

	$requiredFields = array('eq_id', 'biaya');
	foreach($_POST as $key=>$value) {
		if(empty($value) && in_array($key, $requiredFields)){
			$alert[] = "Silahkan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
			break 1;
		}
	}

	if(empty($alert)) {

		if(eq_idExist('maintenances', $eq_id)) {
			$name 	 = mysql_fetch_assoc(mysql_query("SELECT name from equips WHERE eq_id = '$eq_id'"));			
			$alert[] = "'{$name['name']}' sedang proses maintenance! <a href='a_maintenanceEdit.php?id=$eq_id'> Ubah</a>";
		} elseif(strlen($biaya) > 8 || !is_numeric($biaya) || strlen($biaya) < 4) {
				$alert[] = "Biaya tidak valid!";
		} else {

			if(empty($alert)) {			

				$dataMaint = array(
					'eq_id' 	  => $eq_id,
					'biaya_maint' => $biaya,
					'keterangan'  => $keterangan
				);

				if(tambahData($dataMaint, 'maintenances')) {
					$alert[] 	= "Data maintenance alat berhasil ditambahkan <i class='icon fa-smile-o'></i>";
					$eq_id 		= '';
					$biaya 		= '';
					$keterangan	= '';
				} else {
					$alert[] = "Data maintenance alat gagal disimpan! <i class='icon fa-frown-o'></i>";
				}
			}
		
		}
	}
} 

include 'includes/_header.php';
if(!empty($alert)) echo outputErrors($alert);

?>
<div id="main" class="container">					
	<div class="row">
		<div class="4u 12u(mobile)">
			<div class="box special">							
				<ul class="alt">
				<li><h3 class="icon fa-plus"> Maintenance</h3></li>
					<li><h4><a href="a_usersData.php" class="icon fa-user"> Data Pelanggan</a></h4></li>
					<li><h4><a href="a_studios.php" class="icon fa-cube"> Data Studio</a></h4></li>
					<li><h4><a href="a_equips.php"> Data Peralatan</a></h4></li>
					<li><h4><a href="a_maintenances.php"> Maintenance</a></h4></li>
				</ul>
			</div>					
		</div>
			
		<div class="8u 12u(mobile)">
			<div class="box">
				<h3>+ Maintenance Alat</h3>
				<form action="" method="post" autocomplete="off" enctype="multipart/form-data">			
					<div class="row">
						<div class="6u 12u">	
							Nama Alat*
							<select name="eq_id">
								<option value="">- Pilih -</option>
								<?php 
								$maint = mysql_query("SELECT eq_id, name FROM equips WHERE status!='Baik'");
								while($nm = mysql_fetch_assoc($maint)) {
									echo "<option value='$nm[eq_id]'>$nm[name]</option>";
								}
								?>
							</select>
							Biaya Maintenance*		
							<input type="number" name="biaya" placeholder="Biaya Rp" value="<?php echo $biaya ?>" required maxlength="16">
						</div>	
						<div class="6u 12u">	
							Keterangan
							<textarea name="keterangan" placeholder="Keterangan" cols="30" rows="8" maxlength="225"><?php echo $keterangan ?></textarea>
							<input type="submit" value="Simpan" class="fit special">		
						</div>	
					</div>		
				</form>
			</div>		
		</div>
	</div>
</div>

<?php include 'includes/_footer.php';
