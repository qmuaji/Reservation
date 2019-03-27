<?php
require 'core/init.php';
protectPage();
adminProtect();

if(isset($_GET['id'])) {

	$id 		= (int)$_GET['id'];
	$row 		= mysql_fetch_assoc(mysql_query("SELECT equips.*, studios.name as sname, studios.studio_id as s_id FROM equips, studios WHERE equips.studio_id=studios.studio_id AND eq_id = $id"));
	$eq_id 		= $row['eq_id'];
	$biaya 	= $row['biaya'];
	$tgl_beli 	= $row['tgl_beli'];
	$deskripsi 	= $row['deskripsi'];

	if(!empty($_POST)) {

		$eq_id 		= trim($_POST['eq_id']);
		$biaya 	= trim($_POST['biaya']);
		$tgl_beli 	= trim($_POST['tgl_beli']);
		$deskripsi 	= trim($_POST['deskripsi']);

		$requiredFields = array('eq_id', 'status', 'studio_id');
		foreach($_POST as $key=>$value) {
			if(empty($value) && in_array($key, $requiredFields)){
				$alert[] = "Silahkan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
				break 1;
			}
		}

		if(empty($alert)) {

			if(nameExist('equips', $name) && $name !== $row['name']) {
				$id 	 = mysql_fetch_assoc(mysql_query("SELECT eq_id from equips WHERE name = '$name'"));			
				$alert[] = "'{$name}' sudah pernah ditambahkan! <a href='a_studioEdit.php?id=$id[eq_id]'> Ubah</a>";
			} elseif(strlen($name) < 3 || strlen($name) > 50) {
				$alert[] = "Nama Alat minimal 3 dan maksimal 50 karakter";
			} else {

				if(empty($alert)) {			

					$dataAlat = array(
						'name' 		=> $name,
						'status' 	=> $status,
						'deskripsi' => $deskripsi,
						'tgl_beli'	=> $tgl_beli
					);

					if(ubahData('maintenance',$dataAlat, 'maint_id', $id)) {
						$alert[] = "Data maintenance alat berhasil diubah <i class='icon fa-smile-o'></i>";
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
					<li><h3 class="icon fa-edit"> Data Maintenance Alat</h3></li>
						<li><h4><a href="a_usersData.php" class="icon fa-user"> Data User</a></h4></li>
						<li><h4><a href="a_studios.php" class="icon fa-cube"> Data Studio</a></h4></li>
						<li><h4><a href="a_equips.php"> Data Peralatan</a></h4></li>
						<li><h4><a href="a_maintenances.php"> Maintenance</a></h4></li>
					</ul>
				</div>					
			</div>
				
			<div class="8u 12u(mobile)">
				<div class="box">
					<h3>Maintenance Alat</h3>
					<form action="" method="post" autocomplete="off" enctype="multipart/form-data">			
						<div class="row">
							<div class="6u 12u">	
								Nama Alat*
								<input type="text" name="name" placeholder="Nama Alat" value="<?php echo $name ?>" required maxlength="50">		
								Tanggal Beli (tttt-bb-hh)&nbsp;<b class="icon fa-calendar"></b>
								<input type="date" name="tgl_beli" onChange="jadwal_jam()" value="<?php echo $tgl_beli ?>" id="dates">
								Kondisi*
								<select name="status" required>
									<option value="Baik" <?php echo selected('Baik', $status) ?>>Baik</option>
									<option value="Kurang Baik" <?php echo selected('Kurang Baik', $status) ?>>Kurang Baik</option>
									<option value="Rusak" <?php echo selected('Rusak', $status) ?>>Rusak</option>
								</select>
								Posisi*
								<select name="studio_id" required>
									<?php getStudio($row['s_id']) ?>
								</select>
							</div>	
							<div class="6u 12u">
								Deskripsi*
								<textarea name="deskripsi" placeholder="Deskripsi" cols="30" rows="10" maxlength="225"><?php echo $deskripsi ?></textarea>
								<input type="submit" value="Simpan" class="fit special">		
							</div>	
						</div>		
					</form>
				</div>		
			</div>
		</div>
	</div>

	<?php include 'includes/_footer.php';

}