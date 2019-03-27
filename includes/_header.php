<?php 
if(eregi('_header.php', $_SERVER['PHP_SELF'])) header("Location: ./");
include '_head.php'
?>
<body>
	<div id="page-wrapper">
		<header id="header">
		<?php include '_menu.php';
