<?php 

include 'core/init.php';

// //$row = mysql_fetch_assoc(mysql_query("SELECT i_time, (o_time - i_time) as durasi FROM booking ORDER BY i_time"));

// $book = mysql_query("SELECT i_time, (o_time - i_time) as durasi FROM booking ORDER BY i_time");

// while($row = mysql_fetch_assoc($book)){
// 	$a[] = $row['i_time'];
// 	$b[] = $row['durasi'];
// }

// // var_dump($a);
// // exit;

// for($i=10; $i<22; $i++) {

	
// 	if(!in_array($i, $a)) echo $i."<br>";
		
// }
// $i=1;
// do {
// 	echo $i."<br>";
// 	$i++;
// } while ($i <= 10); 

		// include 'core/init.php';

		// $book = mysql_fetch_assoc(mysql_query("SELECT (o_time - i_time) as durasi FROM booking WHERE i_time=13 AND book_date='2015-11-13' ORDER BY i_time"));
		// echo $book['durasi'];

// $date="2015-11-20";
// echo $namahari = date('l', strtotime($date));

// echo date('Y-m-d', strtotime("-7 days"));
//echo date('Y-m-d');
// echo getNota();

// $today_dt = new DateTime(date('Y-m-d'));
// $expire_dt = new DateTime('2015-11-30');

// if ($expire_dt > $today_dt) { echo "masih berlaku";}

// echo md5(uniqid());

	$unik = 'RISKYMUAJISETYAPRANA18101993';
	$i = 0;
	$code="";
	while ($i < 4) { 
	$code .= substr($unik, mt_rand(0, strlen($unik)-1), 1);
	$i++;
	}
	$date 	= date('dmy');
	$nota  = $date.$code;
	echo $nota;

 ?>
 <!-- <input type="date" name="hha" id=""> -->
