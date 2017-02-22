<?php
    class TipoFarmaco{
   	public $id_tipo;
	public $descripcion;
	
	function __construct(){
		$this->id_tipo=0;
		$this->descripcion='';
	}
	
	function init($descripcion){
		
		$this->descripcion = $descripcion;
	}
        

	
	function __destruct(){
		unset($this);
	}
   }
?>