<?php
require_once '../dao/usuario_dao.php';
require_once '../dto/usuario.php';
$usuario_dao = new UsuarioDAO();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$usuario = new Usuario();
	$usuario->login_usuario = $_POST['login_usuario'];
	$usuario->pass_usuario = $_POST['pass_usuario'];
	$usuario->nombre_usuario = $_POST['nombre_usuario'];
	$usuario->apellido_usuario = $_POST['apellido_usuario'];
	$usuario->correo_usuario = $_POST['correo_usuario'];
	$usuario->fechaNacimiento_usuario = $_POST['fechaNacimiento_usuario'];
	$usuario->codigo_perfil = $_POST['codigo_perfil'];
        $valido = TRUE;
		
        if(! preg_match('/([A-Z a-z 0-9 ñáéíóú-]{2,60})$/', $usuario->login_usuario)){
                $valido = $valido && FALSE;
        }
        
        if(! preg_match('/([A-Z a-z ñáéíóú-]{2,60})$/', $usuario->nombre_usuario)){
                $valido = $valido && FALSE;
        }
        
        if(! preg_match('/([A-Z a-z ñáéíóú-]{2,60})$/', $usuario->apellido_usuario)){
                $valido = $valido && FALSE;
        }
        
        if(! preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', $usuario->correo_usuario)){
                $valido = $valido && FALSE;
        }
        
        if(! preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $usuario->fechaNacimiento_usuario)){
                $valido = $valido && FALSE;
        }
        
        
        if($valido){
	
	if($usuario_dao->crear($usuario)){
		header('Status: 301 Moved permantly', false, 301);
		header('Location:/elmuertosano/app/login.php');
		exit();
	}
	else {
		header('Status: 301 Moved permantly', false, 301);
		header('Location:/elmuertosano/app/registrarUsuario.php');
		exit();
	}
        
        } else {
		header('Status: 301 Moved permantly', false, 301);
		header('Location:/elmuertosano/app/registrarUsuario.php');
		exit();
	}

} else {
	header('Status: 301 Moved permantly', false, 301);
	header('Location:/elmuertosano/index.php');
	exit();
}
?>