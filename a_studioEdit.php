<?php
require 'core/init.php';
protectPage();
adminProtect();

if(isset($_GET['id'])) {

	$id 		 = (int)$_GET['id'];
	$row 		 = mysql_fetch_assoc(mysql_query("SELECT * FROM studios WHERE studio_id = $id"));
	$name 		 = $row['name'];
	$price 		 = $row['price'];
	$description = $row['description'];

	if(!empty($_POST)) {

		$name 		 = trim($_POST['name']);
		$price 		 = trim($_POST['price']);
		$description = trim($_POST['description']);

		$requiredFields = array('name', 'price', 'description');
		foreach($_POST as $key=>$value) {
			if(empty($value) && in_array($key, $requiredFields)){
				$alert[] = "Silahkan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
				break 1;
			}
		}

		if(empty($alert)) {

			if(nameExist('studios', $name) && $name !== $row['name']) {
				$id 	 = mysql_fetch_assoc(mysql_query("SELECT studio_id from studios WHERE name = '$name'"));			
				$alert[] = "Nama studio '{$name}' sudah pernah ditambahkan! <a href='a_studioEdit.php?id=$id[studio_id]'> Ubah</a>";
			} elseif(strlen($name) < 3 || strlen($name) > 50) {
				$alert[] = "Nama Studio minimal 3 dan maksimal 50 karakter";
			} elseif(strlen($price) > 8 || !is_numeric($price) || strlen($price) < 5) {
					$alert[] = "Harga tidak valid!";	
			} else {

				if(empty($alert)) {			

					if(!empty($_FILES['img']['name'])) {
						
						$tipeFile = array('jpeg', 'jpg', 'png', 'gif');
						$fileName = $_FILES['img']['name'];
						$fileExtn = strtolower(end(explode('.', $fileName)));
						$fileTmp  = $_FILES['img']['tmp_name'];
						$img 	  = sanitize('images/studios/'.substr(date('d_m_y-').(time()), 0). '.' .$fileExtn);

						if(in_array($fileExtn, $tipeFile)) {
							move_uploaded_file($fileTmp, $img);
						} else {
							$alert[] = "Tipe file yang di perbolehkan: ". implode(', ', $tipeFile);
						}			
											
					} else {
						$img = $row['img'];
					}

					$dataStudio = array(
						'name' 		  => $name,
						'price' 	  => $price,
						'description' => $description,
						'img'	 	  => $img
					);

					if(ubahData('studios',$dataStudio, 'studio_id', $id)) {
						$alert[] = "Informasi ubah studio berhasil di simpan <i class='icon fa-smile-o'></i>";
					} else {
						$alert[] = "Informasi ubah studio gagal di simpan! <i class='icon fa-frown-o'></i>";
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
					<li><h3 class="icon fa-edit"> Ubah Studio</h3></li>
						<li><h4><a href="a_usersData.php" class="icon fa-user"> Data User</a></h4></li>
						<li><h4><a href="a_studios.php" class="icon fa-cube"> Data Studio</a></h4></li>
						<li><h4><a href="a_equips.php"> Data Peralatan</a></h4></li>
					</ul>
				</div>					
			</div>
				
			<div class="8u 12u(mobile)">
				<div class="box">
					<h3>Informasi Studio</h3>
					<form action="" method="post" autocomplete="off" enctype="multipart/form-data">			
						<div class="row">
							<div class="6u 12u">	
								Nama Studio* &nbsp;<b class="icon fa-cube"></b>
								<input type="text" name="name" placeholder="Nama Studio" value="<?php echo $name ?>" required maxlength="50">
								Harga/jam*		
								<input type="number" name="price" placeholder="Harga Rp" value="<?php echo $price ?>" required min="10000" max="1000000">
								Pilih Gambar
								<input type="file" name="img" accept="image/*">
							<span class="image fit" style="margin-top:2px">
							<?php 
							$img = $row['img'];
							if(!empty($img)) {
								?>
								<img src="<?php echo $img ?>"/>
								<?php
							}
							?>	
							</span>
							</div>	
							<div class="6u 12u">	
								Deskripsi*
								<textarea name="description" placeholder="Deskripsi" cols="30" rows="12box" maxlength="225"><?php echo $description ?></textarea>
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