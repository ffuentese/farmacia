<?php
	
    class Detalle_Receta {
                public $id_receta;
                public $id_farmaco;
		public $cantidad;
		public $sub_total;
		
		function __construct(){
                        $this->id_receta = 0;
			$this->id_farmaco = 0;
			$this->cantidad = 0;
			$this->sub_total = 0;
		}
		
	
		
		function __destruct(){
		unset($this);
	}
    }
?>