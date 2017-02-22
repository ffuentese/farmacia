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
    $tipos_farmacos = new TipoFarmacoDAO();
    $farmaco_mod = new FarmacoDAO();
    $lista_farmacos = $farmaco_mod->listar();
    $datos = $tipos_farmacos->listar();
    $farmacomod = $_SESSION['num_farmaco'];
    $farmaco = $farmaco_mod->leer($farmacomod);
    $titulo_pagina = 'Control de Fármacos';
    $contenido1 = '<p>Bienvenido al sistema de control de fármacos de El Muerto Sano</p>'
            . '<fieldset><legend>Modificar Fármaco</legend>'
            . '<form class="pure-form pure-form-stacked" action="../operadores/guardar_farmaco.php" method="post">'
            . '<label for="id_farmaco">ID Fármaco</label><input type="text" name="id_farmaco"  id="id_farmaco" value="'.$farmaco->id_farmaco.'" readonly/>  '
            . '<label for="descripcion">Descripción</label><input type="text" name="descripcion"  id="descripcion" value="'.$farmaco->descripcion.'" onblur="validarDescripcion(this)"/>  '
            . '<span id="errdescripcion" style="color:red"></span>  '            
            . '<label for="precio">Precio</label><input type="text" name="precio"  id="precio" value="'.$farmaco->precio.'" onblur="validarPrecio(this)"/>'
            . '<span id="errprecio" style="color:red"></span>'            
            . '<label for="unidad">Unidad</label><input type="text" name="unidad"  id="unidad" value="'.$farmaco->unidad.'" onblur="validarUnidad(this)"/>'
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
    
   
            
            
}

$plantilla ->setVariable('titulo_pagina', $titulo_pagina);
$plantilla ->setVariable('contenido1', $contenido1);
//$plantilla ->setVariable('contenido2', $contenido2);

$plantilla ->parse();
$plantilla ->show();


?>