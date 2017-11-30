<?php
require_once '../libsigma/Sigma.php';
require_once '../dao/tipo_farmaco_dao.php';
require_once '../dto/tipo_farmaco.php';
require_once '../dao/farmaco_dao.php';
require_once '../dao/detalle_receta_dao.php';

$plantilla = & new HTML_Template_Sigma('../plantilla/');
$plantilla->loadTemplateFile('inicio.tlp.html');
session_start();
if (!isset($_SESSION['usuario']) | !$_SESSION['usuario']) {
    header('Status: 301 Moved permantly', false, 301);
    header('Location:/app/login.php');
    exit();
} else {
    $detalle_receta_dao = new Detalle_RecetaDAO();
    $tipo_farmaco_dao = new TipoFarmacoDAO();
    $masvendido = $detalle_receta_dao->masVendido();
    $masvecesvendido = $detalle_receta_dao->masVecesVendido();
    $titulo_pagina = 'Consultas';
    $contenido1 = '<h3>Fármaco más vendido</h3>'
            . '<table class="pure-table">'
            . '<thead>'
            . '<tr>'
            . '<th>ID Fármaco</th>'
            . '<th>Descripción</th>'
            . '<th>Precio</th>'
            . '<th>Unidad</th>'
            . '<th>Tipo de Fármaco</th>'
            . '<th>Cantidad Vendida</th>'
            . '</thead>'
            . '<tr>'
            . '<td>'.$masvendido->id_farmaco.'</td>'
            . '<td>'.$masvendido->descripcion.'</td>'
            . '<td>'.$masvendido->precio.'</td>'
            . '<td>'.$masvendido->unidad.'</td>'            
            . '<td>'.$tipo_farmaco_dao->leer($masvendido->id_tipoFarmaco)->descripcion.'</td>'
            . '<td>'.$detalle_receta_dao->cantMasVendido($masvendido->id_farmaco) .'</td>'
            . '</tr>'
            . '</table>';

        $contenido2 = '<h3>Fármaco más vendido en más ocasiones</h3>'
            . '<table class="pure-table">'
            . '<thead>'
            . '<tr>'
            . '<th>ID Fármaco</th>'
            . '<th>Descripción</th>'
            . '<th>Precio</th>'
            . '<th>Unidad</th>'
            . '<th>Tipo de Fármaco</th>'
            . '<th>Cantidad de ventas</th>'
            . '</thead>'
            . '<tr>'
            . '<td>'.$masvecesvendido->id_farmaco.'</td>'
            . '<td>'.$masvecesvendido->descripcion.'</td>'
            . '<td>'.$masvecesvendido->precio.'</td>'
            . '<td>'.$masvecesvendido->unidad.'</td>'            
            . '<td>'.$tipo_farmaco_dao->leer($masvecesvendido->id_tipoFarmaco)->descripcion.'</td>'
            . '<td>'.$detalle_receta_dao->vecesVendido($masvendido->id_farmaco).'</td>'                
            . '</tr>'
            . '</table>';        
            
}

$plantilla ->setVariable('titulo_pagina', $titulo_pagina);
$plantilla ->setVariable('contenido1', $contenido1);
$plantilla ->setVariable('contenido2', $contenido2);

$plantilla ->parse();
$plantilla ->show();


?>