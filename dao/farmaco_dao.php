<?php

require_once '../dto/farmaco.php';
require_once '../dbconnect/mysqldb.php';
require_once 'ipersistencia.php';

class FarmacoDAO implements IPersistencia {

    function __construct() {
        
    }

    function crear($obj) {
        $farmaco = new Farmaco();
        $farmaco = $obj;
        $conexion = new MySqlCon();
        $query = 'INSERT INTO `farmacos`(`descripcion`, `precio`, `unidad`,
			`id_tipoFarmaco`) VALUES (?, ?, ?, ?)';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("siii", $farmaco->descripcion, $farmaco->precio, $farmaco->unidad, $farmaco->id_tipoFarmaco);
            $sentencia->execute();
            if ($conexion->affected_rows > 0) {
                $conexion->commit();
                return TRUE;
            } else {
                $conexion->rollback();
                //echo mysql_errno($enlace) . ": " . mysql_error($enlace) . "\n";
                return FALSE;
            }
            $usuario->__destruct();
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo $e->getMessage();
        }
    }

    function actualizar($obj) {
        $farmaco = new Farmaco();
        $farmaco = $obj;
        $conexion = new MySqlCon();
        $query = 'UPDATE `farmacos` SET `descripcion`= ?, `precio`= ?, `unidad`= ?, `id_tipoFarmaco`= ?
			WHERE `id_farmaco`= ?';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("siiii", $farmaco->descripcion, $farmaco->precio, $farmaco->unidad, $farmaco->id_tipoFarmaco, $farmaco->id_farmaco);
            $sentencia->execute();
            if ($conexion->affected_rows > 0) {
                $conexion->commit();
                return TRUE;
            } else {
                $conexion->rollback();
                return FALSE;
            }
            $conexion->close();
            $usuario->__destruct();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    function eliminar($obj) {
        $farmaco = new Farmaco();
        $farmaco = $obj;
        $conexion = new MySqlCon();
        $query = 'DELETE FROM `farmacos` WHERE `id_farmaco` = ?';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("1", $farmaco->id_farmaco);
            if ($conexion->affected_rows > 0) {
                $conexion->commit();
                return TRUE;
            } else {
                $conexion->rollback();
                return FALSE;
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    function listar() {
        $lista_farmacos = null;
        $indice = 0;
        $conexion = new MySqlCon();
        $query = 'SELECT id_farmaco, descripcion, precio, unidad, id_tipoFarmaco FROM farmacos';
        try {
            $sentencia = $conexion->prepare($query);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_farmaco, $descripcion, $precio, $unidad, $id_tipoFarmaco);
                while ($sentencia->fetch()) {
                    $farmaco = new Farmaco();
                    $farmaco->id_farmaco = $id_farmaco;
                    $farmaco->descripcion = $descripcion;
                    $farmaco->precio = $precio;
                    $farmaco->unidad = $unidad;
                    $farmaco->id_tipoFarmaco = $id_tipoFarmaco;
                    $lista_farmacos[$indice]=$farmaco;
                    $indice++;
                    $farmaco->__destruct();
                }
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $lista_farmacos;
    }


      function validarCantidad($cod_farmaco) {
        $conexion = new MySqlCon();
        $query = 'SELECT unidad FROM farmacos WHERE id_farmaco = ?';
        $cantidad = -1;
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("i", $cod_farmaco);
            if ($sentencia->execute()) {
                $sentencia->bind_result($unidad);
                while ($sentencia->fetch()) {
                    $cantidad = $unidad;
                }
                
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $cantidad;
    }
    
          function leer($cod_farmaco) {
        $farmaco = null;      
        $conexion = new MySqlCon();
        $query = 'SELECT id_farmaco, descripcion, precio, unidad, id_tipoFarmaco FROM farmacos WHERE id_farmaco = ?';
        $cantidad = -1;
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("i", $cod_farmaco);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_farmaco, $descripcion, $precio, $unidad, $id_tipoFarmaco);
                while ($sentencia->fetch()) {
                    $farmaco = new Farmaco();
                    $farmaco->id_farmaco = $id_farmaco;
                    $farmaco->descripcion = $descripcion;
                    $farmaco->precio = $precio;
                    $farmaco->unidad = $unidad;
                    $farmaco->id_tipoFarmaco = $id_tipoFarmaco;
                    
                }
                
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $farmaco;
    }

    function validarUsuario($correo) {
        $conexion = new MySqlCon();
        $valido = FALSE;
        $sqlQuery = 'SELECT COUNT(*)FROM `usuarios` WHERE UPPER(TRIM(`correo_usuario`)) = UPPER(TRIM(?))';
        try {
            $sentencia = $conexion->prepare($sqlQuery);
            $sentencia->bind_param("s", $correo);
            if ($sentencia->execute()) {
                $sentencia->bind_result($cantidad);
                while ($sentencia->fetch()) {
                    if ($cantidad > 0) {
                        $valido = TRUE;
                    } else {
                        $valido = FALSE;
                    }
                }
            }
            $conexion->close();
        } catch (exception $e) {
            error_log($e);
        }
        return $valido;
    }

    function consultar($obj) {
        $farmaco = new Farmaco();
        $farmaco = $obj;
        $lista_farmacos = null;
        $conexion = new MySqlCon();
        $indice = 0;
        $query = 'SELECT id_';
        try {
            $param_busq = '%' . $usuario->nombre . '%';
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("s", $param_busq);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_usuario, $id_perfil, $nombre_perfil, $descripcion, $nombre, $email, $contrasena);
                while ($sentencia->fetch()) {
                    $farmaco = new Farmaco();
                    $farmaco->init($id_farmaco, $descripcion, $precio, $unidad, $id_tipoFarmaco);
                    $lista_farmacos[$indice]->$farmaco;
                    $indice++;
                    $farmaco->__destruct();
                }
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $lista_usuarios;
    }

    function __destruct() {
        unset($this);
    }

}

?>