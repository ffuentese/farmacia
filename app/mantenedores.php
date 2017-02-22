<?php
require_once '../libsigma/Sigma.php';
require_once '../dao/tipo_farmaco_dao.php';
require_once '../dto/tipo_farmaco.php';
require_once '../dao/farmaco_dao.php';

$plantilla = & new HTML_Template_Sigma('../plantilla/');
$plantilla->loadTemplateFile('inicio.tlp.html');
session_start();
if (!isset($_SESSION['usuario']) | !$_SESSION['usuario']) {
    header('Status: 301 Moved permantly', false, 301);
    header('Location:/elmuertosano/app/login.php');
    exit();
} else {
    
    $titulo_pagina = 'Mantenedores de información';
    $contenido1 = '<p>Bienvenido al sistema de control de fármacos de El Muerto Sano</p>'
            . '<ul>'
            . '<li><a  href="ingresarReceta.php">Mantenedor de Recetas</a></li>'
            . '<li><a  href="mantenedorFarmacos.php">Mantenedor de Fármacos</a></li>'
            . '<li><a  href="mantenedorTiposFarmacos.php">Mantenedor de Tipos de Fármacos</a></li>'
            . '</ul>'
            ;
    

            
            
}

$plantilla ->setVariable('titulo_pagina', $titulo_pagina);
$plantilla ->setVariable('contenido1', $contenido1);
//$plantilla ->setVariable('contenido2', $contenido2);

$plantilla ->parse();
$plantilla ->show();


?>