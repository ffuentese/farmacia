<?php
require_once '../dao/receta_dao.php';
require_once '../dto/receta.php';
$receta_dao = new RecetaDAO();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

	$_SESSION['num_farmaco'] = $_POST['id_farmaco'];
        header('Status: 301 Moved permantly', false, 301);
	header('Location:/app/modificarFarmaco.php');
	exit();
        
        
	
	
    

} else {
	header('Status: 301 Moved permantly', false, 301);
	header('Location:/index.php');
	exit();
}
?>