<?php 
// if(eregi('init.php', $_SERVER['PHP_SELF'])) {
// 	header("Location: ./");
// 	exit();
// }
session_start();
// error_reporting(0);

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

$alert = [];
$currentFile = explode('/', $_SERVER['SCRIPT_NAME']);
$currentFile = end($currentFile);

$dateMax = date('Y-m-d', strtotime("+7 days"));
$dateMin = date('Y-m-d');