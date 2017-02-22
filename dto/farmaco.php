<?php
    
    class Farmaco {
                public $id_farmaco;
		public $descripcion;
		public $precio;
		public $unidad;
		public $id_tipoFarmaco;
		
		function __construct(){
			$this->id_farmaco = 0;
			$this->descripcion = '';
			$this->precio = 0;
			$this->unidad = 0;
			$this->id_tipoFarmaco = 0;
		}
		
		
		function init($descripcion, $precio, $unidad, $id_tipoFarmaco){
			$this->descripcion = $descripcion;
			$this->precio = $precio;
			$this->unidad = $unidad;
			$this->id_tipoFarmaco = $id_tipoFarmaco;
		}
		
		function __destruct(){
			unset($this);
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
    }
?>