<?php
require 'core/init.php';
include 'includes/_header.php';
if(isset($_GET['username']) && !empty($_GET['username'])) {
	$username = sanitize($_GET['username']);
	
	if(usernameExists($username) || emailExists($username)) {
		$user_id  	= user_id($username);
		$dataProfil = userData($user_id, 'first_name', 'last_name', 'email', 'tlp', 'img', 'username');
		?>
		<section id="main" class="container">
			<header>
				<h2><?php echo $dataProfil['first_name'], ' ', $dataProfil['last_name'] ?></h2>
				<p>Instrumental Rock</p>
			</header>
			<div class="box">
			<?php 
			if(isset($_SESSION['user_id']) && $_SESSION['user_id']==$user_id){
			?>
				<form action="" method="post" enctype="multipart/form-data">
					<input type="file" name="img" accept="image/*">
					<input type="submit" value="Upload">
				</form>
			<?php 
			} ?>
				<span class="image featured">
				<?php 
				if(isset($_FILES['img'])) {

					if(empty($_FILES['img']['name'])){
						echo "Silahkan pilih gambar!";
					} else {
						$tipeFile = array('jpeg', 'jpg', 'png', 'gif');

						$fileName = $_FILES['img']['name'];
						$fileExtn = strtolower(end(explode('.', $fileName)));
						$fileTmp  = $_FILES['img']['tmp_name'];

						if(in_array($fileExtn, $tipeFile)) {
							gantiSampulProfil($user_id, $fileTmp, $fileExtn);
							
							if(!empty($dataProfil['username'])) {
								$currentFile = $dataProfil['username'];
							} else {
								$currentFile = $dataProfil['email'];
							}
							header("Location: $currentFile");
						} else {
							echo "Tipe file yang di perbolehkan: ", implode(', ', $tipeFile);
						}
					}
				}

				$img = $dataProfil['img'];
				if(!empty($img)) {
					?>
					<img src="<?php echo $img ?>" alt="x img" />
					<?php
				}
				?>	
				</span>
				<h3>Biografi</h3>
				<p>Cep risus aliquam gravida cep ut lacus amet. Adipiscing faucibus nunc placerat. Tempus adipiscing turpis non blandit accumsan eget lacinia nunc integer interdum amet aliquam ut orci non col ut ut praesent. Semper amet interdum mi. Phasellus enim laoreet ac ac commodo faucibus faucibus. Curae ante vestibulum ante. Blandit. Ante accumsan nisi eu placerat gravida placerat adipiscing in risus fusce vitae ac mi accumsan nunc in accumsan tempor blandit aliquet aliquet lobortis. Ultricies blandit lobortis praesent turpis. Adipiscing accumsan adipiscing adipiscing ac lacinia cep. Orci blandit a iaculis adipiscing ac. Vivamus ornare laoreet odio vis praesent nunc lorem mi. Erat. Tempus sem faucibus ac id. Vis in blandit. Nascetur ultricies blandit ac. Arcu aliquam. Accumsan mi eget adipiscing nulla. Non vestibulum ac interdum condimentum semper commodo massa arcu.</p>
				<div class="row">
					<div class="6u 12u(mobilep)">
						<h3>Personil</h3>
						<p>Adipiscing faucibus nunc placerat. Tempus adipiscing turpis non blandit accumsan eget lacinia nunc integer interdum amet aliquam ut orci non col ut ut praesent. Semper amet interdum mi. Phasellus enim laoreet ac ac commodo faucibus faucibus. Curae lorem ipsum adipiscing ac. Vivamus ornare laoreet odio vis praesent.</p>
					</div>
					<div class="6u 12u(mobilep)">
						<h3>asd</h3>
						<p>Adipiscing faucibus nunc placerat. Tempus adipiscing turpis non blandit accumsan eget lacinia nunc integer interdum amet aliquam ut orci non col ut ut praesent. Semper amet interdum mi. Phasellus enim laoreet ac ac commodo faucibus faucibus. Curae lorem ipsum adipiscing ac. Vivamus ornare laoreet odio vis praesent.</p>
					</div>
				</div>
			</div>
		</section>
		<?php
	} else {
		echo "<br><hr><h2 align='center'>Sorry.. Halaman tidak ditemukan!<br><a href='./' class='icon fa-arrow-left'> Kembali</a></h2><hr>";
	}
} else {
	header("Location: ./");
	exit();
}


include 'includes/_footer.php' ?>
