<?php
require_once '../dao/tipo_farmaco_dao.php';
require_once '../dto/tipo_farmaco.php';
$tipo_farmaco_dao = new TipoFarmacoDAO();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$tipo = new TipoFarmaco();
        $tipo->id_tipo= $_POST['id_tipo'];
	$tipo->descripcion = $_POST['descripcion_tipo'];

        $valido = TRUE;
    
    if(! preg_match('/([A-Z a-z ñáéíóú-]{2,60})$/', $tipo_farmaco->descripcion)){
                $valido = $valido && FALSE;
        }

    if($valido){
        
	
	if($tipo_farmaco_dao->actualizar($tipo)){
		header('Status: 301 Moved permantly', false, 301);
		header('Location:/app/mantenedorTiposFarmacos.php');
		exit();
	}
	else {
		header('Status: 301 Moved permantly', false, 301);
		header('Location:/app/mantenedorTiposFarmacos.php');
		exit();
	}
        
    } else {
		header('Status: 301 Moved permantly', false, 301);
		header('Location:/app/mantenedorTiposFarmacos.php');
		exit();
	}

} else {
	header('Status: 301 Moved permantly', false, 301);
	header('Location:/index.php');
	exit();
}
?>