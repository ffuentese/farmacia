<?php
require_once '../libsigma/Sigma.php';
require_once '../dao/detalle_receta_dao.php';
require_once '../dto/detalle_receta.php';
require_once '../dao/farmaco_dao.php';
require_once '../dao/receta_dao.php';

$plantilla = & new HTML_Template_Sigma('../plantilla/');
$plantilla->loadTemplateFile('inicio.tlp.html');
session_start();
if (!isset($_SESSION['usuario']) | !$_SESSION['usuario']) {
    header('Status: 301 Moved permantly', false, 301);
    header('Location:/elmuertosano/app/login.php');
    exit();
} else {
    $cod_receta = $_SESSION['num_receta'];
    $detalle_receta_dao = new Detalle_RecetaDAO();
    $farmaco_dao = new FarmacoDAO();
    $lista_detalles = $detalle_receta_dao->listador($cod_receta);
    $lista_farmacos = $farmaco_dao->listar();
    $receta_dao = new RecetaDAO();
    $total = 0;
    $titulo_pagina = 'Detalle receta #'. $cod_receta;
    $contenido1 = '<p>Bienvenido al sistema de control de fármacos de El Muerto Sano</p>'
            . '<fieldset><legend>Nuevo item</legend>'
            . '<form class="pure-form pure-form-stacked" action="../operadores/registrar_detalle.php" method="post">'
            . '<label for="id_receta">ID receta</label><input type="text" name="id_receta"  id="id_receta" value="'.$cod_receta.'" readonly/>  '
            . '<label for="id_farmaco">Fármaco</label><select name="id_farmaco">';
    
    if(sizeof($lista_farmacos)>0){		
	foreach ($lista_farmacos as $farma) {
		$contenido1 .='<option value="'.$farma->id_farmaco.'">'.$farma->descripcion.'</option>';
	}		
	}
        
    $contenido1 .= '</select>'
            . '<label for="cantidad">Cantidad</label><input type="text" name="cantidad" id="cantidad" onblur="validarCantidad(this)" />'
            . '<span id="errcantidad" style="color:red"></span><br />'            
            . '<input type="submit" value="Agregar" />'
            . '</fieldset>'
            . '</form>';
    if(sizeof($lista_detalles)>0){	
    $contenido2 = '<table class="pure-table">'
            . '<thead>'
            . '<tr>'
            . '<th>ID Receta</th>'
            . '<th>Fármaco</th>'
            . '<th>Cantidad</th>'
            . '<th>Subtotal</th>'
            . '<th>Eliminar</th>'
            . '</thead>';
   
   foreach ($lista_detalles as $result){
            $contenido2 .= '<tr>'
                    . '<td>'.$result->id_receta.'</td>'
                    . '<td>'.$farmaco_dao->leer($result->id_farmaco)->descripcion.'</td>'
                    . '<td>'.$result->cantidad.'</td>'
                    . '<td>'.$result->sub_total.'</td>'
                    
                    . '<form action="../operadores/eliminar_detalle.php" method="POST"><input type="hidden" name="id_farmaco" id="id_farmaco" value="'.$result->id_farmaco.'" />'
                    . '<input type="hidden" name="id_receta" id="id_receta" value="'.$result->id_receta.'" />'
                    . '<td><input type="submit" value="Eliminar" /></td></form>'
                    . '</tr>';
            $total = $total + $result->sub_total;
   }
   
   $receta = $receta_dao->leer($cod_receta);
   if($total != $receta->total_receta){
   $receta->total_receta = $total;
   $receta_dao->actualizar($receta);
   }
   
   $contenido2 .= '</table>'
           . '<br/>'
           . 'Total: $' . $total
           . '<br/> <a href="ingresarReceta.php">Volver a Recetas</a>';
   
       
    } else {
        $contenido2 = '<a href="ingresarReceta.php">Volver a Recetas</a>';
    }  
            
}

$plantilla ->setVariable('titulo_pagina', $titulo_pagina);
$plantilla ->setVariable('contenido1', $contenido1);
$plantilla ->setVariable('contenido2', $contenido2);

$plantilla ->parse();
$plantilla ->show();


?>