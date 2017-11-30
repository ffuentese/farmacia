<?php

require_once '../dao/tipo_farmaco_dao.php';
require_once '../dto/tipo_farmaco.php';

$tipos_farmacos = new TipoFarmacoDAO();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    $_SESSION['num_tipo'] = $_POST['id_tipo'];
        header('Status: 301 Moved permantly', false, 301);
	header('Location:/app/modificarTipo.php');
	exit();
}    
 else {

    header('Status: 301 Moved permantly', false, 301);
    header('Location:/index.php');
    exit();
}
?>