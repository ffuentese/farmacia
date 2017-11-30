<?php

require_once '../dao/detalle_receta_dao.php';
require_once '../dto/detalle_receta.php';
require_once '../dao/farmaco_dao.php';

$detalle_receta_dao = new Detalle_RecetaDAO();
$farmaco_dao = new FarmacoDAO();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_farmaco = $_POST['id_farmaco'];
    $id_receta = $_POST['id_receta'];

    if ($detalle_receta_dao->borrar($id_farmaco, $id_receta)) {

        header('Status: 301 Moved permantly', false, 301);
        header('Location:/app/detalleReceta.php');
        exit();
    } else {
        echo "<script>
alert('Hubo un problema al intentar eliminar el detalle');
window.location.href='/app/detalleReceta.php';
</script>";
    }
} else {

    header('Status: 301 Moved permantly', false, 301);
    header('Location:/index.php');
    exit();
}
?>