<?php
    require_once '../dto/perfil.php';
	require_once '../dbconnect/mysqldb.php';
	require_once 'ipersistencia.php';
	class PerfilDAO implements IPersistencia{
    	
		function __construct(){
			
		}
		
		function crear($obj){}
		
		function actualizar($obj){}
		
		function eliminar($obj){}
		
		function listar(){
			$lista_perfil = null;
			$indice=0;
			$conexion = new MySqlCon();
			$query='SELECT `id_perfil`, `descripcion_perfil` FROM `perfil`';
			try{
				$sentencia = $conexion->prepare($query);
				if($sentencia->execute()){
					$sentencia->bind_result($id_perfil,$descripcion);
					while($sentencia->fetch()){
						$perfil = new Perfil();
						$perfil->init($id_perfil, $descripcion);
						$lista_perfil[$indice]=$perfil;
						$indice++;
						$perfil->__destruct();
					}
				}	
				$conexion->close();
				
			}catch(Exception $e){
				error_log($e->getMessage());
			}
			return $lista_perfil;
		}
		
		function consultar($obj){}
		
		function __destruct(){
			unset($this);
		}
    }
?>