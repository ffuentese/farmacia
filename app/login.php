<?php
require_once '../libsigma/Sigma.php';


$plantilla = &new HTML_Template_Sigma('../plantilla/');
$plantilla -> loadTemplateFile('inicio.tlp.html');

$titulo_pagina = 'Iniciar Sesión';

$contenido1 = '<p><img src="../plantilla/img/logo-farmacia1.gif" alt="farmacia"></p>
	<fieldset>
							<legend>
								Iniciar Sesión
							</legend>
<form method="post" class="pure-form pure-form-stacked" action="../operadores/autentificar.php">
<label for="correo">Correo</label><input type="text" name="authcorreo" id="authcorreo">
<label for="contraseña">Contraseña</label><input type="password" name="authpassword" id="authpassword">
<input type="submit" value="Ingresar">
</fieldset>
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