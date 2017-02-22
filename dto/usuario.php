<?php
	require_once '../dto/perfil.php';

    class Usuario extends Perfil {
                public $id_usuario;
		public $login_usuario;
		public $pass_usuario;
		public $nombre_usuario;
		public $apellido_usuario;
		public $correo_usuario;
		public $edad_usuario;
		public $codigo_perfil;
		public $fechaNacimiento_usuario;
		
		function __construct(){
		$id_usuario = 0;
		$login_usuario = '';
		$pass_usuario = '';
		$nombre_usuario = '';
		$apellido_usuario = '';
		$correo_usuario = '';
		$edad_usuario = 0;
		$codigo_perfil = 0;
		$fechaNacimiento_usuario = '';
		}
		
		// function init($id_perfil, $descripcion_perfil, $id_usuario, $login_usuario, $pass_usuario, $nombre_usuario, $apellido_usuario, $correo_usuario, $edad_usuario, $fechaNacimiento_usuario){
			// parent::init($id_perfil, $descripcion_perfil);
			// $this->id_usuario;
			// $this->login_usuario;
			// $this->$pass_usuario;
			// $this->$nombre_usuario;
			// $this->$apellido_usuario;
			// $this->$correo_usuario;
			// $this->$edad_usuario;
			// $this->fechaNacimiento_usuario;
		// }
		
		function __destruct(){
			unset($this);
		}
    }
?>