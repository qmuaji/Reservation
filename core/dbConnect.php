<?php
if(eregi('dbConnect.php', $_SERVER['PHP_SELF'])) {
	header("Location: ./");
	exit();
}
$connError = 'Maaf, sistem kami sedang dalam perbaikan..';
mysql_connect('127.0.0.1', 'root', '') or die($connError);
mysql_select_db('qmusikstudio') or die($connError);

// versi idHostinger
// $connError = 'Maaf, sistem kami sedang dalam perbaikan..';
// mysql_connect('127.0.0.1', 'u426975594_lans', 'password') or die($connError);
// mysql_select_db('u426975594_lans') or die($connError);