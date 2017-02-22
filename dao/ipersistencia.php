<?php
    interface IPersistencia{
    	
		function crear($obj);
		
		function actualizar($obj);
		
		function eliminar($obj);
		
		function listar();
		
		function consultar($obj);
		
    }
?>