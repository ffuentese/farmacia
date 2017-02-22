<?php
    class Perfil{
   	public $id_perfil;
	public $descripcion;
	
	function __construct(){
		$this->id_perfil=0;
		$this->descripcion='';
	}
	
	function init($id_perfil,$descripcion){
		$this->id_perfil = $id_perfil;
		$this->descripcion = $descripcion;
	}
	
	function __destruct(){
		unset($this);
	}
   }
?>