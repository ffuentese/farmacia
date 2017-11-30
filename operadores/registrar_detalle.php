<?php

require_once '../dao/detalle_receta_dao.php';
require_once '../dto/detalle_receta.php';
require_once '../dao/farmaco_dao.php';

$detalle_receta_dao = new Detalle_RecetaDAO();
$farmaco_dao = new FarmacoDAO();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $detalle = new Detalle_Receta();
    $detalle->id_receta = $_POST['id_receta'];
    $detalle->id_farmaco = $_POST['id_farmaco'];
    $detalle->cantidad = $_POST['cantidad'];
    $valido = TRUE;
    
    if(! preg_match('/^[0-9]+$/', $detalle->cantidad)){
                $valido = $valido && FALSE;
        }
    
    if($valido) {

    if ($farmaco_dao->validarCantidad($detalle->id_farmaco) >= $detalle->cantidad) {
        $med = $farmaco_dao->leer($detalle->id_farmaco);
        $val_unit = $med->precio;
        $detalle->sub_total = $val_unit * $detalle->cantidad;


        if ($detalle_receta_dao->crear($detalle)) {
            $med->unidad = $med->unidad - $detalle->cantidad;
            $farmaco_dao->actualizar($med);
            header('Status: 301 Moved permantly', false, 301);
            header('Location:/app/detalleReceta.php');
            exit();
        } else {
            echo "<script>
alert('Hubo un problema al intentar guardar el detalle');
window.location.href='/app/detalleReceta.php';
</script>";
        }
    } else {
        echo "<script>
alert('No hay stock suficiente para satisfacer la solicitud');
window.location.href='/app/detalleReceta.php';
</script>";
    }
    
    }
    
    else {
            header('Status: 301 Moved permantly', false, 301);
            header('Location:/app/detalleReceta.php');
            exit();
    }
} 
else {
    header('Status: 301 Moved permantly', false, 301);
    header('Location:/index.php');
    exit();
}
?>