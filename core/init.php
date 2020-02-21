<?php 

session_start();
error_reporting(E_ALL ^ E_DEPRECATED);

require 'dbConnect.php';

require 'functions/general.php';

require 'functions/users.php';

if(loggedIn()) {
	$userData   = userData($_SESSION['user_id'], 'user_id', 'email', 'password', 'username', 'first_name', 'last_name', 'tlp', 'address', 'img', 'type', 'saldo');

	if(!userActive($userData['email'])) {
		session_destroy();
		header('Location: logout.php');
		exit();
	}
}

$alert = array();
$currentFile = explode('/', $_SERVER['SCRIPT_NAME']);
$currentFile = end($currentFile);
date_default_timezone_set("Asia/Bangkok");
$dateMax = date('Y-m-d', strtotime("+7 days"));
$dateMin = date('Y-m-d');