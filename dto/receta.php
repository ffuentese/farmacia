<?php
	

    class Receta{
                public $id_receta;
		public $fecha_emision;
		public $total_receta;
		public $estado;
                public $id_usuario;
	
	function __construct(){
		$this->id_receta = 0;
		$this->fecha_emision = '';
		$this->total_receta  = 0;
		$this->estado = '';
                $this->id_usuario = 0;
	}
	

	
	function __destruct(){
		unset($this);
	}
	
	
	
	
	
	
	
	
	
	
	
    }
?>