<?php

$connError = 'Maaf, sistem kami sedang dalam perbaikan..';
mysql_connect('localhost', 'qmuajico_root', 'Muaji*19#') or die($connError);
mysql_select_db('qmuajico_reservasi') or die($connError);

// versi idHostinger
// $connError = 'Maaf, sistem kami sedang dalam perbaikan..';
// mysql_connect('127.0.0.1', 'u426975594_lans', 'password') or die($connError);
// mysql_select_db('u426975594_lans') or die($connError);
