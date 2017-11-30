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
    $farmacos = new FarmacoDAO();
    $lista_farmacos = $farmacos->listar();
    $datos = $tipos_farmacos->listar();
    $titulo_pagina = 'Control de Fármacos';
    $contenido1 = '<p>Bienvenido al sistema de control de fármacos de El Muerto Sano</p>'
            . '<fieldset><legend>Nuevo Fármaco</legend>'
            . '<form class="pure-form pure-form-stacked" action="../operadores/registrar_farmaco.php" method="post">'
            . '<label for="descripcion">Descripción</label><input type="text" name="descripcion"  id="descripcion" onblur="validarDescripcion(this)"/>'
            . '<span id="errdescripcion" style="color:red"></span>  '
            . '<label for="precio">Precio</label><input type="text" name="precio"  id="precio" onblur="validarPrecio(this)"/>'
            . '<span id="errprecio" style="color:red"></span>'
            . '<label for="unidad">Unidad</label><input type="text" name="unidad"  id="unidad" onblur="validarUnidad(this)"/>'
            . '<span id="errunidad" style="color:red"></span>'
            . '<label for="tipofarmaco">Tipo de Fármaco</label><select name="tipofarmaco">';
    
    
    
    if(sizeof($datos)>0){		
	foreach ($datos as $tipo) {
		$contenido1 .='<option value="'.$tipo->id_tipo.'">'.$tipo->descripcion.'</option>';
	}		
	}
        
    $contenido1 .= '</select>'
            . '<input type="submit" value="Guardar" />'
            . '</fieldset>'
            . '</form>';
    
    $contenido2 = '<table class="pure-table">'
            . '<thead>'
            . '<tr>'
            . '<th>ID Fármaco</th>'
            . '<th>Descripción</th>'
            . '<th>Precio</th>'
            . '<th>Unidad</th>'
            . '<th>Tipo de Fármaco</th>'
            . '<th>Modificar</th>'
            . '</thead>';
   
   foreach ($lista_farmacos as $result){
            $contenido2 .= '<tr>'
                    . '<td>'.$result->id_farmaco.'</td>'
                    . '<td>'.$result->descripcion.'</td>'
                    . '<td>'.$result->precio.'</td>'
                    . '<td>'.$result->unidad.'</td>'
                    . '<td>'.$tipos_farmacos->leer($result->id_tipoFarmaco)->descripcion.'</td>'
                    . '<form action="../operadores/modificar_farmaco.php" method="POST"><input type="hidden" name="id_farmaco" id="id_farmaco" value="'.$result->id_farmaco.'" />'
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