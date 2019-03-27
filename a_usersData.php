<?php
require 'core/init.php';
protectPage();
adminProtect();
?>

<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css" />

<?php include 'includes/_header.php' ?>

<div id="main" style="margin-top:-30px" class="container">

	<div class="row">
		<div class="3u 12u(narrower)">			
			<!-- <a href="a_userAdd.php" class="button fit special icon fa-plus-square">Tambah User</a> -->
		</div>		
		<div align="center" class="5u 12u(narrower)">	
				<form action="" method="POST">
				  	<input type="text" name="cari" placeholder="Cari emai user..">				   
				</form>
		</div>
		<div  class="4u 12u(narrower)">				
			<!-- <a href="produk_pdf.php" class="button small icon fa-download"> PDF</a> -->
			<a href="xls/pelanggan_xls.php" class="button small icon fa-download"> Excel</a>
		</div>
		
	</div>

	<div class="row">
		<div class="12u">
			<section class="box">
				<h3>Data Pelanggan</h3>
				
					<table id="users">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Email</th>
								<th>Saldo (Rp)</th>
								<th>Opsi</th>
							</tr>
						</thead>

						<tbody>
						<?php 
						$usersData = mysql_query("SELECT * FROM users WHERE type=0 AND active=1");

						if(mysql_num_rows($usersData) == 0) echo "<h3><span class='icon fa-search'></span> Data Studio masih kosong.</h3><p> Silahkan tambahkan terlebih dahulu</p>";
						while($row = mysql_fetch_assoc($usersData)){
							?>
							<tr>
								<td><?php echo $row['first_name'] ?></td>
								<td><?php echo $row['email'] ?></td>
								<td align="right"><?php echo rupiah($row['saldo']) ?></td>
								<td><a href="a_userEdit.php?id=<?php echo $row['user_id'] ?>" class="icon fa-edit"> | <a href="#" class="icon fa-trash"></td>
							</tr>
							<?php
							$tSaldo = $row['saldo']+$row['saldo'];
						}
						?>
						</tbody>
						<tr>
							<td colspan="2" align="center"><b>Total Saldo</b></td>
							<td align="right">
								<b> <?php echo rupiah($tSaldo) ?></b>
							</td>
							<td></td>
						</tr>
					</table>
			</section>

		</div>
	</div>

</div>

<?php include 'includes/_footer.php' ?>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
    	$('#users').DataTable();
	} );
</script>