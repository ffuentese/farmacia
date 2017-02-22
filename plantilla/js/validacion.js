/**
 * @author Francisco
 */
var valido=true;


/* Validación de usuarios */

function validarNombre(nombre) {

var patron_de_nombre = /^([A-Z a-z ñáéíóú]{2,60})$/;
if((nombre.value.match(patron_de_nombre)) && (nombre.value!='')) {
	document.getElementById("errnombre_usuario").innerHTML='';
		valido=true;
} else{
	document.getElementById("errnombre_usuario").innerHTML='Nombre incorrecto';
	document.getElementById("nombre_usuario").focus();
	valido=valido && false;
}
}

function validarApellido(nombre) {

var patron_de_nombre = /^([A-Z a-z ñáéíóú]{2,60})$/;
if((nombre.value.match(patron_de_nombre)) && (nombre.value!='')) {
	document.getElementById("errapellido_usuario").innerHTML='';
		valido=true;
} else{
	document.getElementById("errapellido_usuario").innerHTML='Apellido incorrecto';
	document.getElementById("apellido_usuario").focus();
	valido=valido && false;
}
}

function validarCorreo(correo) {

var patron_de_nombre = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
if((correo.value.match(patron_de_nombre)) && (correo.value!='')) {
	document.getElementById("errcorreo_usuario").innerHTML='';
		valido=true;
} else{
	document.getElementById("errcorreo_usuario").innerHTML='Correo incorrecto';
	document.getElementById("correo_usuario").focus();
	valido=valido && false;
}
}

function validarFechaNacimiento(fecha) {

var patron_de_nombre = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
if((fecha.value.match(patron_de_nombre)) && (fecha.value!='')) {
	document.getElementById("errfechaNacimiento_usuario").innerHTML='';
		valido=true;
} else{
	document.getElementById("errfechaNacimiento_usuario").innerHTML='Fecha incorrecta';
	document.getElementById("fechaNacimiento_usuario").focus();
	valido=valido && false;
}
}

/* Validación de fármacos */

function validarDescripcion(nombre) {

var patron_de_nombre = /^([A-Z a-z ñáéíóú]{2,60})$/;
if((nombre.value.match(patron_de_nombre)) && (nombre.value!='')) {
	document.getElementById("errdescripcion").innerHTML='';
		valido=true;
} else{
	document.getElementById("errdescripcion").innerHTML='Nombre incorrecto';
	document.getElementById("descripcion").focus();
	valido=valido && false;
}
}



function validarPrecio(nombre) {

var patron_de_nombre = /^[0-9]+$/;
if((nombre.value.match(patron_de_nombre)) && (nombre.value!='')) {
	document.getElementById("errprecio").innerHTML='';
		valido=true;
} else{
	document.getElementById("errprecio").innerHTML='Precio incorrecto';
	document.getElementById("precio").focus();
	valido=valido && false;
}
}

function validarUnidad(nombre) {

var patron_de_nombre = /^[0-9]+$/;
if((nombre.value.match(patron_de_nombre)) && (nombre.value!='')) {
	document.getElementById("errunidad").innerHTML='';
		valido=true;
} else{
	document.getElementById("errunidad").innerHTML='Unidades incorrectas';
	document.getElementById("unidad").focus();
	valido=valido && false;
}
}

/* Validación de tipos */

function validarDescripcionTipo(nombre) {

var patron_de_nombre = /^([A-Z a-z ñáéíóú]{2,60})$/;
if((nombre.value.match(patron_de_nombre)) && (nombre.value!='')) {
	document.getElementById("errdescripcion_tipo").innerHTML='';
		valido=true;
} else{
	document.getElementById("errdescripcion_tipo").innerHTML='Nombre incorrecto';
	document.getElementById("descripcion_tipo").focus();
	valido=valido && false;
}
}

/* Validación de Receta */

function validarFechaEmision(fecha) {

var patron_de_nombre = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
if((fecha.value.match(patron_de_nombre)) && (fecha.value!='')) {
	document.getElementById("errfecha_emision").innerHTML='';
		valido=true;
} else{
	document.getElementById("errfecha_emision").innerHTML='Fecha incorrecta';
	document.getElementById("fecha_emision").focus();
	valido=valido && false;
}
}

function validarEstado(nombre) {

var patron_de_nombre = /^([A-Z a-z ñáéíóú]{2,60})$/;
if((nombre.value.match(patron_de_nombre)) && (nombre.value!='')) {
	document.getElementById("errestado").innerHTML='';
		valido=true;
} else{
	document.getElementById("errestado").innerHTML='Estado incorrecto, solo letras por favor';
	document.getElementById("estado").focus();
	valido=valido && false;
}
}

/* Validación de Detalle */

function validarCantidad(nombre) {

var patron_de_nombre = /^[0-9]+$/;
if((nombre.value.match(patron_de_nombre)) && (nombre.value!='')) {
	document.getElementById("errcantidad").innerHTML='';
		valido=true;
} else{
	document.getElementById("errcantidad").innerHTML='Cantidad incorrecta, ingrese solo números.';
	document.getElementById("cantidad").focus();
	valido=valido && false;
}
}