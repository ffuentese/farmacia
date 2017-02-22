<?php
require_once '../libsigma/Sigma.php';
require_once '../dao/receta_dao.php';
require_once '../dto/receta.php';
require_once '../dao/usuario_dao.php';

$plantilla = & new HTML_Template_Sigma('../plantilla/');
$plantilla->loadTemplateFile('inicio.tlp.html');
session_start();
if (!isset($_SESSION['usuario']) | !$_SESSION['usuario']) {
    header('Status: 301 Moved permantly', false, 301);
    header('Location:/elmuertosano/app/login.php');
    exit();
} else {
    $usuarios = new UsuarioDAO();
    $receta_dao = new RecetaDAO();
    $lista_recetas = $receta_dao->listar();
    $datos = $usuarios->listar();
    $titulo_pagina = 'Mantenedor de recetas';
    $contenido1 = '<p>Bienvenido al sistema de control de fármacos de El Muerto Sano</p>'
            . '<fieldset><legend>Nueva Receta</legend>'
            . '<form class="pure-form pure-form-stacked" action="../operadores/registrar_receta.php" method="post">'
            . '<label for="id_receta">ID receta</label><input type="text" name="id_receta"  id="id_receta" value="'.$receta_dao->lastId().'" readonly/>  '
            . '<label for="fecha">Fecha</label><input type="text" name="fecha_emision"  id="fecha_emision" value="'.date('Y-m-d').'" onblur="validarFechaEmision(this)"/>'
            . '<span id="errfecha_emision" style="color:red"></span>'
            . '<label for="estado">Estado</label><input type="text" name="estado"  id="estado" onblur="validarEstado(this)"/>'
            . '<span id="errestado" style="color:red"></span>'            
            . '<label for="id_usuario">Usuario</label><select name="id_usuario">';
    
    if(sizeof($datos)>0){		
	foreach ($datos as $tipo) {
		$contenido1 .='<option value="'.$tipo->id_usuario.'">'.$tipo->login_usuario.'</option>';
	}		
	}
        
    $contenido1 .= '</select>'
            . '<input type="submit" value="Crear" />'
            . '</fieldset>'
            . '</form>';
    
    $contenido2 = '<table class="pure-table">'
            . '<thead>'
            . '<tr>'
            . '<th>ID Receta</th>'
            . '<th>Fecha</th>'
            . '<th>Total Receta</th>'
            . '<th>Estado</th>'
            . '<th>Usuario</th>'
            . '<th>Modificar</th>'
            . '</thead>';
   
   foreach ($lista_recetas as $result){
            $contenido2 .= '<tr>'
                    . '<td>'.$result->id_receta.'</td>'
                    . '<form action="../operadores/modificar_receta.php" method="post">'
                    . '<input type="hidden" name="id_receta" id="id_receta" value="'.$result->id_receta.'" />'
                    . '<td>'.$result->fecha_emision.'</td>'
                    . '<td>'.$result->total_receta.'</td>'
                    . '<td>'.$result->estado.'</td>'
                    . '<td>'.$result->id_usuario.'</td>'
                    . '<td><input type="submit" value="Modificar/Ver detalle" /></form></td>'
                    . '</tr>';
   }
            
            
}

$plantilla ->setVariable('titulo_pagina', $titulo_pagina);
$plantilla ->setVariable('contenido1', $contenido1);
$plantilla ->setVariable('contenido2', $contenido2);

$plantilla ->parse();
$plantilla ->show();


?>