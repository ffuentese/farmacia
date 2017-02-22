<?php
require_once '../libsigma/Sigma.php';

$plantilla = & new HTML_Template_Sigma('../plantilla/');
$plantilla->loadTemplateFile('inicio.tlp.html');
session_start();
if (!isset($_SESSION['usuario']) | !$_SESSION['usuario']) {
    header('Status: 301 Moved permantly', false, 301);
    header('Location:/elmuertosano/app/login.php');
    exit();
} else {
    $tiempo = localtime(time(), 1);
    $horaactual = $tiempo["tm_hour"]+1 . ':' . $tiempo["tm_min"] . ':' . $tiempo["tm_sec"];
    $anio = $tiempo["tm_year"] + 1900;
    $mes = $tiempo["tm_mon"] + 1;
    $fechaactual = $tiempo["tm_mday"] . '/' . $mes . '/ ' . $anio;
    $usuario = $_SESSION['usuario'];
    $titulo_pagina = 'Menú de inicio: ' . $usuario;
    $contenido1 = '<h3>Bienvenido al sistema de control de recetas de El Muerto Sano</h3>'
            . '<p>Fecha: ' . $fechaactual . '</p>'
            . '<p>Hora actual: ' . $horaactual . '</p>';
}

$plantilla ->setVariable('titulo_pagina', $titulo_pagina);
$plantilla ->setVariable('contenido1', $contenido1);

$plantilla ->parse();
$plantilla ->show();


?>