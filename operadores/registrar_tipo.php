<?php

require_once '../dao/tipo_farmaco_dao.php';
require_once '../dto/tipo_farmaco.php';

$tipos_farmacos = new TipoFarmacoDAO();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descripcion_tipo = $_POST['descripcion_tipo'];
    $tipo_farmaco = new TipoFarmaco();
    $tipo_farmaco->descripcion = $descripcion_tipo;
    $valido = TRUE;
    
    if(! preg_match('/([A-Z a-z ñáéíóú-]{2,60})$/', $tipo_farmaco->descripcion)){
                $valido = $valido && FALSE;
        }

    if($valido){
        
    if (!$tipos_farmacos->validarTipo($descripcion_tipo)) {

        if ($tipos_farmacos->crear($tipo_farmaco)) {

            header('Status: 301 Moved permantly', false, 301);
            header('Location:/elmuertosano/app/mantenedorTiposFarmacos.php');
            exit();
        } else {
            echo "<script>
alert('Hubo un problema al guardar el tipo de fármaco');
window.location.href='/elmuertosano/app/mantenedorTiposFarmacos.php';
</script>";
        }
    } else {
        echo "<script>
alert('Ya existe un tipo de fármaco con ese nombre');
window.location.href='/elmuertosano/app/mantenedorTiposFarmacos.php';
</script>";
    }
    } else {
            header('Status: 301 Moved permantly', false, 301);
            header('Location:/elmuertosano/app/mantenedorTiposFarmacos.php');
            exit();
    }
} else {

    header('Status: 301 Moved permantly', false, 301);
    header('Location:/elmuertosano/index.php');
    exit();
}
?>