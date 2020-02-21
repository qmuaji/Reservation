<?php 
date_default_timezone_set("Asia/Bangkok");

if($_GET['studio_id'] && $_GET['dates']!=""){
	$tgl = $_GET['dates'];
	$id  = $_GET['studio_id'];
	?>
		Pesan*
		<h4>
		<?php 
		
		include 'core/init.php';

		$book       = mysql_query("SELECT i_time FROM bookings WHERE book_date='$tgl' AND studio_id=$id");
		$a[]        = "";
		$currTime   = strtotime(date("Y-m-d H:i"));
		
		
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
		    
		    $jadwal = strtotime($tgl .' '. $i .':00');

			if(!in_array($i, $a) && ($jadwal > $currTime)) {
				?>
				<input type="checkbox" value="<?= $i ?>" id="<?= $i ?>" name="pesan[]">
				<label for="<?= $i ?>"><?= $i,":00 - ",$i+1,":00" ?></label>
				<?php
			} else {
				?>
				<input type="checkbox" value="" id="<?= $i ?>" name="x[]" disabled>
				<label for="<?= $i ?>" style="color:gainsboro"><?= $i,":00 - ",$i+1,":00" ?></label>
				<?php
			}			

		}
		?></h4>

	<?php
} else {
	//echo "<span style='color:gainsboro'>Pilih tanggal dulu!</span>";
}

