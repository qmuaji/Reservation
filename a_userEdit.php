<?php
require 'core/init.php';
protectPage();
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$userData = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE user_id=$id"));
	$email 		= $userData['email'];
	$first_name = $userData['first_name'];
	$last_name 	= $userData['last_name'];
	$tlp 		= $userData['tlp'];
	$username 	= $userData['username'];
	$address 	= $userData['address'];

	if(!empty($_POST)) {
		$requiredFields = array('email', 'username', 'first_name', 'tlp');
		foreach($_POST as $key=>$value) {
			if(empty($value) && in_array($key, $requiredFields)){
				$alert[] = "Silahkan isi bagian yang ditandai * <i class='icon fa-smile-o'></i>";
				break 1;
			}
		}

		if(empty($alert)) {
			$username 	= trim($_POST['username']);
			$email 		= trim($_POST['email']);
			$first_name = trim($_POST['first_name']);
			$last_name 	= trim($_POST['last_name']);
			$tlp 		= trim($_POST['tlp']);
			$address 	= trim($_POST['address']);
			
			if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) < 6 || strlen($email) > 50) {
				$alert[] = "Oops.. Email tidak valid!";
			} elseif(emailExists($email) && $email !== $userData['email']) {
				$alert[] = "Maaf, email '{$email}' sudah digunakan.";
			} elseif(strlen($username) < 3 || strlen($username) > 16) {
				$alert[] = "Username minimal 3 dan maksimal 16 karakter";
			} elseif(preg_match("/[^a-zA-Z|0-9]/", $username)) {	
				$alert[] = "Username hanya huruf, angka dan tidak memakai spasi!";
			} elseif(usernameExists($username) && $username !== $userData['username']) {
				$alert[] = "Maaf, username '{$username}'' sudah di gunakan.";
			} elseif(!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
				$alert[] = "Nama depan hanya huruf dan spasi!";
			} elseif(strlen($first_name) < 3 || strlen($first_name) > 32 || strlen($last_name) > 32) {
				$alert[] = "Nama minimal 3 dan maksimal 32 karakter.";
			} elseif(strlen($tlp) > 16) {
				$alert[] = "No. telepon maksimal 16 karakter.";
			} elseif(strlen($address) > 225) {
				$alert[] = "Alamat maksimal 225 karakter.";
			} elseif(strlen($tlp) > 16 || !is_numeric($tlp)) {
				$alert[] = "No. tlp tidak valid!";
			} else {
				if(empty($alert)) {
					$updateData = array(
						'username' 	=> strtolower($username),
						'email' 	=> $email,
						'first_name'=> ucwords(strtolower($first_name)),
						'last_name' => ucwords(strtolower($last_name)),
						'tlp'		=> $tlp,
						'address' 	=> $address
					);

					if(updateUser2($updateData, $id)) {
						$alert[] = "Informasi akun berhasil di simpan <i class='icon fa-smile-o'></i>";
					} else {
						$alert[] = "Informasi akun gagal di simpan! <i class='icon fa-frown-o'></i>";
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
<!-- 			<div class="4u 12u(mobile)">
				<div class="box special">							
					<ul class="alt">
					<li><h3 class="icon fa-cog"> Pengaturan</h3></li>
						<li><h4><a href="userSettings.php" class="icon fa-user"> Informasi Akun</a></h4></li>
						<li><h4><a href="gantiPass.php" class="icon fa-lock"> Ganti Password</a></h4></li>
					</ul>
				</div>					
			</div> -->
				
			<div class="12u 12u(mobile)">
				<div class="box">
					<h3 class="icon fa-edit"> Data Pelanggan</h3>
					<form action="" method="post" autocomplete="off">			
						<div class="row">
							<div class="6u 12u">	
								Email* &nbsp;<b class="icon fa-envelope-o"></b>
								<input type="email" name="email" placeholder="Email" value="<?php echo $email ?>" required maxlength="50">
								No telepon* &nbsp;<b class="icon fa-phone"></b>
								<input type="text" name="tlp" placeholder="Telepon"  value="<?php echo $tlp ?>" maxlength="16">
								Nama depan*
								<input type="text" name="first_name" placeholder="Nama depan" value="<?php echo $first_name ?>" required minlength="3" maxlength="32">
								Nama belakang
								<input type="text" name="last_name" placeholder="Nama belakang" value="<?php echo $last_name ?>" maxlength="32">	
							</div>	
							<div class="6u 12u">	
								Username* &nbsp;<b class="icon fa-user"></b>		
								<input type="text" name="username" placeholder="Username" value="<?php echo $username ?>" required maxlength="16">
								Alamat &nbsp;<b class="icon fa-road"></b>
								<textarea name="address" placeholder="Alamat" cols="30" rows="6" maxlength="225"><?php echo $address ?></textarea>
								<input type="submit" value="Simpan" class="fit special">				
								<a href="a_usersData.php" class="button fit default">Kembali</a>				
							</div>
						</div>		
					</form>
				</div>		
			</div>
		</div>
	</div>

<?php 
}
include 'includes/_footer.php';