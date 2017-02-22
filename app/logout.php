<?php
    session_start();
	$_SESSION = array();
	session_destroy();
	header('Status: 301 Moved permanently', false, 301);
	header('Location:/elmuertosano/app/login.php');
	exit();
?>