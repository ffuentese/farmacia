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
    header('Location:/app/login.php');
    exit();
} else {
    $tipos_farmacos = new TipoFarmacoDAO();
    $id_tipo = $_SESSION['num_tipo'];
    $objtipo = $tipos_farmacos->leer($id_tipo);
    $datos = $tipos_farmacos->listar();
    $titulo_pagina = 'Mantenedor de Tipos de Fármacos';
    $contenido1 = '<p>Bienvenido al sistema de control de fármacos de El Muerto Sano</p>'
            . '<fieldset><legend>Modificar Tipo de Fármaco</legend>'
            . '<form class="pure-form pure-form-stacked" action="../operadores/guardar_tipo.php" method="post">'
            . '<label for="id_tipo">ID Tipo</label><input type="text" name="id_tipo"  id="id_tipo" value="'.$objtipo->id_tipo.'" readonly/>  '
            . '<label for="descripcion">Descripción</label><input type="text" name="descripcion_tipo"  id="descripcion_tipo" value="'.$objtipo->descripcion.'" onblur="validarDescripcionTipo(this)"/>  '
            . '<span id="errdescripcion_tipo" style="color:red"></span><br> '            
            . '<input type="submit" value="Guardar" />'
            . '</fieldset>'
            . '</form>';
    
    $contenido2 = '<table class="pure-table">'
            . '<thead>'
            . '<tr>'
            . '<th>ID Tipo</th>'
            . '<th>Descripción</th>'
            . '<th>Modificar</th>'
            . '</thead>';
   
   foreach ($datos as $result){
            $contenido2 .= '<tr>'
                    . '<td>'.$result->id_tipo.'</td>'
                    . '<td>'.$result->descripcion.'</td>'
                    . '<form action="../operadores/modificar_tipo.php" method="POST"><input type="hidden" name="id_tipo" id="id_tipo" value="'.$result->id_tipo.'" />'
                    . '<td><input type="submit" value="Modificar" /></td></form>'
                    . '</tr>';
   }
            
            
}

$plantilla ->setVariable('titulo_pagina', $titulo_pagina);
$plantilla ->setVariable('contenido1', $contenido1);
$plantilla ->setVariable('contenido2', $contenido2);

$plantilla ->parse();
$plantilla ->show();


?>