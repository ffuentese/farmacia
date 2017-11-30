<?php
require_once '../dao/usuario_dao.php';
$usuario_dao = new UsuarioDAO();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$correo = $_POST['authcorreo'];
	$password = $_POST['authpassword'];
	if ($usuario_dao -> autentificar($correo, $password)) {
		session_start();
		$_SESSION['usuario'] = $correo;
		header('Status: 301 Moved permantly', false, 301);
		header('Location:/app/inicio.php');
		exit();
	} else {
		if ($usuario_dao -> validarUsuario($correo)) {
			header('Status: 301 Moved permantly', false, 301);
			header('Location:/app/login.php');
			exit();
		} else {
			header('Status: 301 Moved permantly', false, 301);
			header('Location:/app/registrarUsuario.php');
			exit();
		}
	}

} else {
	header('Status: 301 Moved permantly', false, 301);
	header('Location:/app/login.php');
	exit();
}
?>