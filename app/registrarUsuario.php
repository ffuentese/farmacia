<?php
require_once '../libsigma/Sigma.php';
require_once '../dao/perfil_dao.php';
$perfil_dao = new PerfilDAO();

$plantilla = &new HTML_Template_Sigma('../plantilla/');
$plantilla -> loadTemplateFile('inicio.tlp.html');

$titulo_pagina = 'Registrar usuario';

$datos = $perfil_dao->listar();

$contenido1 = '
	<fieldset>
							<legend>
								Registrar Usuario
							</legend>
<form method="post" class="pure-form pure-form-stacked" action="../operadores/registrar_usuario.php">
<label for="apodo">Apodo</label><input type="text" name="login_usuario" id="login_usuario">
<span id="errlogin_usuario" style="color:red"></span>
<label for="contraseña">Contraseña</label><input type="password" name="pass_usuario" id="pass_usuario">
<label for="nombre">Nombre</label><input type="text" name="nombre_usuario" id="nombre_usuario" onblur="validarNombre(this)" >
<span id="errnombre_usuario" style="color:red"></span>
<label for="apellido">Apellido</label><input type="text" name="apellido_usuario" id="apellido_usuario" onblur="validarApellido(this)">
<span id="errapellido_usuario" style="color:red"></span>
<label for="correo">Correo electrónico</label><input type="text" name="correo_usuario" id="correo_usuario" onblur="validarCorreo(this)">
<span id="errcorreo_usuario" style="color:red"></span>
<label for="fecha_nacimiento">Fecha de nacimiento</label><input type="text" name="fechaNacimiento_usuario" id="fechaNacimiento_usuario" onblur="validarFechaNacimiento(this)">
<span id="errfechaNacimiento_usuario" style="color:red"></span>
<select name="codigo_perfil">';
if(sizeof($datos)>0){		
	foreach ($datos as $perfil) {
		$contenido1 .='<option value="'.$perfil->id_perfil.'">'.$perfil->descripcion.'</option>';
	}		
	}
$contenido1 .='
</select>
<input type="submit" value="Ingresar">
</form>




<br/>

';

$plantilla -> setVariable('titulo_pagina', $titulo_pagina);
$plantilla -> setVariable('contenido1', $contenido1);
//hacemos un parse de texto plano php a html
$plantilla -> parse();
//desplegamos el contenido
$plantilla -> show();
?>