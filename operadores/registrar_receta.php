<?php
require_once '../dao/receta_dao.php';
require_once '../dto/receta.php';
$receta_dao = new RecetaDAO();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
	$receta = new Receta();
	$receta->id_receta = $_POST['id_receta'];
        $receta->fecha_emision = $_POST['fecha_emision'];
        $receta->total_receta = 0;
        $receta->estado = $_POST['estado'];
        $receta->id_usuario = $_POST['id_usuario'];
        $valido=TRUE;
        
        if(! preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $receta->fecha_emision)){
                $valido = $valido && FALSE;
        }
        
        if(! preg_match('/([A-Z a-z ñáéíóú-]{2,60})$/', $receta->estado)){
                $valido = $valido && FALSE;
        }
        
        if($valido){
	
	if($receta_dao->crear($receta)){
                $_SESSION['num_receta'] = $receta->id_receta;
		header('Status: 301 Moved permantly', false, 301);
		header('Location:/app/detalleReceta.php');
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