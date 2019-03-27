<?php 
if($_GET['studio_id'] && $_GET['dates']!=""){
	$tgl = $_GET['dates'];
	$id  = $_GET['studio_id'];
	?>
		Pesan*
		<h4>
		<?php 
		include 'core/init.php';

		$book = mysql_query("SELECT i_time FROM bookings WHERE book_date='$tgl' AND studio_id=$id");
		$a[]="";			
		while($row2 = mysql_fetch_assoc($book)){
			$a[] = $row2['i_time'];
		}

		$namahari = date('l', strtotime($tgl));
		if ($namahari=="Thursday" || $namahari=="Kamis") {
			$j = 18;
		} elseif ($namahari=="Sunday" || $namahari=="Minggu") {
			$j = 23;
		} else {
			$j = 22;
		}

		for($i=10; $i<$j; $i++) {

			if(!in_array($i, $a)) {
				?>
				<input type="checkbox" value="<?php echo $i ?>" id="<?php echo $i ?>" name="pesan[]">
				<label for="<?php echo $i ?>"><?php echo $i,":00 - ",$i+1,":00" ?></label>
				<?php
			} else {
				?>
				<input type="checkbox" value="" id="<?php echo $i ?>" name="x[]" disabled>
				<label for="<?php echo $i ?>" style="color:red"><?php echo $i,":00 - ",$i+1,":00" ?></label>
				<?php
			}			

		}
		?></h4>

	<?php
} else {
	//echo "<span style='color:red'>Pilih tanggal dulu!</span>";
}

