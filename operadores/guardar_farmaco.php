<?php
require_once '../dao/farmaco_dao.php';
require_once '../dto/farmaco.php';
$farmaco_dao = new FarmacoDAO();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$farmaco = new Farmaco();
        $farmaco->id_farmaco = $_POST['id_farmaco'];
	$farmaco->descripcion = $_POST['descripcion'];
        $farmaco->precio = $_POST['precio'];
        $farmaco->unidad = $_POST['unidad'];
        $farmaco->id_tipoFarmaco = $_POST['tipofarmaco'];
        
        $valido=TRUE;
        
        if(! preg_match('/([A-Z a-z ñáéíóú-]{2,60})$/', $farmaco->descripcion)){
                $valido = $valido && FALSE;
        }
        
        if(! preg_match('/^[0-9]+$/', $farmaco->precio)){
                $valido = $valido && FALSE;
        }
        
        if(! preg_match('/^[0-9]+$/', $farmaco->unidad)){
                $valido = $valido && FALSE;
        }
        
        if($valido) {
	
	if($farmaco_dao->actualizar($farmaco)){
		header('Status: 301 Moved permantly', false, 301);
		header('Location:/app/mantenedorFarmacos.php');
		exit();
	}
	else {
		header('Status: 301 Moved permantly', false, 301);
		header('Location:/app/mantenedorFarmacos.php');
		exit();
	}
        
        } else {
            header('Status: 301 Moved permantly', false, 301);
		header('Location:/app/mantenedorFarmacos.php');
		exit();
        }

} else {
	header('Status: 301 Moved permantly', false, 301);
	header('Location:/index.php');
	exit();
}
?>