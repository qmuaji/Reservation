<?php

$connError = 'Maaf, sistem kami sedang dalam perbaikan..';
mysql_connect('localhost', 'root', 'rootan') or die($connError);
mysql_select_db('reservasi') or die($connError);
