<?php

$connError = 'Maaf, sistem kami sedang dalam perbaikan..';
mysql_connect('localhost', 'root', 'password2') or die($connError);
mysql_select_db('reservasi') or die($connError);
