<?php
    session_start();
	if(!isset($_SESSION['usuario']) |! $_SESSION['usuario']){
		header('Status: 301 Moved Permanently', false, 301);
	    header('Location:/app/login.php');
		exit();
	} else {
		header('Status: 301 Moved Permanently', false, 301);
	    header('Location:/app/inicio.php');
		exit();
	}
?>