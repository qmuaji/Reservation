<?php if(eregi('_menu.php', $_SERVER['PHP_SELF'])) header("Location: ./") ?>
	<h1><a href="./">Lan's Musik</a> Studio</h1>
	<div class="<?php if(loggedIn()) echo 'container' ?>">
		<nav id="nav">
			<ul>
			<?php 
			if (!isset($_SESSION['user_id'])) {
				?>
				<li><a href="studios.php">Studio Latihan</a></li>
				<li><a href="profiles.php">Members</a></li>
				<li><a href="#">Pemesanan <span class="icon fa-angle-down"></span></a>
					<ul>
						<li><a href="caraPesan.php">Cara Pemesanan</a></li>		
					</ul>
				</li>
				<li> | </li>
			<?php 
			} else if(hasAccess($_SESSION['user_id'], 0)) {
				?>
				<li><a href="studios.php">Studio Latihan</a></li>
				<li><a href="profiles.php">Members</a></li>
				<li><a href="#">Pemesanan <span class="icon fa-angle-down"></span></a>
					<ul>
						<li><a href="penyewaan.php">Pemesanan Saya</a></li>		
						<li><a href="saldo.php">Isi Saldo</a></li>		
						<li><a href="konfirmasi.php">Konfirmasi Bayar</a></li>		
						<li><a href="caraPesan.php">Cara Pemesanan</a></li>		
					</ul>
				</li>
				<li> | </li>
			<?php 
			}
			if(loggedIn()) {
				if(hasAccess($_SESSION['user_id'], 1)) {
					?>
					<li><a href="a_studios.php">Data Studio</a></li>
					<li><a href="a_equips.php">Data Peralatan</a></li>
					<!-- <li><a href="a_maintenances.php">Maintenance</a></li> -->
					<li><a href="a_usersData.php">Data Pelanggan</a></li>
					<li><a href="#">Konfirmasi <span class="icon fa-angle-down"></span></a>
						<ul>
							<li><a href="a_konfirm1.php">Konfirmasi Saldo</a></li>
							<li><a href="a_konfirm2.php">Konfirmasi Pemesanan</a></li>		
						</ul>
					</li>
					<li> | </li>
					<?php
				} else if(hasAccess($_SESSION['user_id'], 2)) {
					?>
					<!-- <li><a href="profiles.php">Konfirmasi Maintenance</a></li> -->
					<li><a href="#">Laporan <span class="icon fa-angle-down"></span></a>
						<ul>
							<li><a href="a_usersData.php">Data Pelanggan</a></li>	
							<li><a href="a_studios.php">Data Studio</a></li>	
							<li><a href="a_laptrans.php">Laporan Penyewaan</a></li>
							<!-- <li><a href="caraPesan.php">Laporan Maintenance</a></li>		 -->
							<!-- <li><a href="caraPesan.php">Laporan Laba-Rugi</a></li>		 -->
						</ul>
					</li>
					<li> | </li>
					<?php
				}
				?>
				<li><a href="#" class="button"><i class="icon fa-user"></i> <?php if(hasAccess($_SESSION['user_id'], 1)) echo "Admin"; if(hasAccess($_SESSION['user_id'], 2)) echo "Pemilik"?> <span class="icon fa-angle-down"></span></a>
					<ul>
						
					<?php
					if(hasAccess($_SESSION['user_id'], 0)) {
						?>
						<li><a href="saldo.php">Saldo <b>Rp <?php echo rupiah($userData['saldo']) ?></b></a></li>
						<li><a href="<?php if(!empty($userData['username'])) echo $userData['username']; else echo $userData['email'] ?>"> &nbsp;<?php echo $userData['email'] ?></a></li>
						<li><a href="<?php if(!empty($userData['username'])) echo $userData['username']; else echo $userData['email'] ?>" class="icon fa-cube"> &nbsp;Members</a></li>
						<?php
					}
					?>
						<li><a href="userSettings.php" class="icon fa-cog"> &nbsp;Pengaturan</a></li>
						<li><a href="logout.php" class="icon fa-sign-out"> &nbsp;Log Out</a></li>
					</ul>
				</li>
				<?php 
			} else {
				?>
				<li><a href="login.php">Log In</a></li>
				<li><a href="signup.php" class="button special">GABUNG</a></li>
				<?php 
			}
			?>
			</ul>
		</nav>
	<?php if(loggedIn()) echo '</div>' ?>
</header>
