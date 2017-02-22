<?php

require_once '../dto/tipo_farmaco.php';
require_once '../dbconnect/mysqldb.php';
require_once 'ipersistencia.php';

class TipoFarmacoDAO implements IPersistencia {

    function __construct() {
        
    }

    function crear($obj) {
        $tipo = new TipoFarmaco();
        $tipo = $obj;
        $conexion = new MySqlCon();
        $query = 'INSERT INTO `tipo_farmaco`(`descripcion_tipo`) VALUES (?)';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("s", $tipo->descripcion);
            $sentencia->execute();
            if ($conexion->affected_rows > 0) {
                $conexion->commit();
                return TRUE;
            } else {
                $conexion->rollback();
                //echo mysql_errno($enlace) . ": " . mysql_error($enlace) . "\n";
                return FALSE;
            }
            $tipo->__destruct();
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo $e->getMessage();
        }
    }

    function actualizar($obj) {
        $tipo = new TipoFarmaco();
        $tipo = $obj;
        $conexion = new MySqlCon();
        $query = 'UPDATE `tipo_farmaco` SET `descripcion_tipo`= ? WHERE `id_tipo`=?';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("si", $tipo->descripcion, $tipo->id_tipo);
            $sentencia->execute();
            if ($conexion->affected_rows > 0) {
                $conexion->commit();
                return TRUE;
            } else {
                $conexion->rollback();
                return FALSE;
            }
            $conexion->close();
            $tipo->__destruct();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    function eliminar($obj) {
        $tipo = new TipoFarmaco();
        $tipo = $obj;
        $conexion = new MySqlCon();
        $query = 'DELETE FROM `tipo_farmaco` WHERE `id_tipo` = ?';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("1", $tipo->id_tipo);
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
    
       function leer($cod_tipofarmaco) {
        $tipo = null;      
        $conexion = new MySqlCon();
        $query = 'SELECT id_tipo, descripcion_tipo FROM tipo_farmaco WHERE id_tipo = ?';
        $cantidad = -1;
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("i", $cod_tipofarmaco);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_tipo, $descripcion_tipo);
                while ($sentencia->fetch()) {
                    $tipo = new TipoFarmaco();
                    $tipo->id_tipo= $id_tipo;
                    $tipo->descripcion = $descripcion_tipo;
                    
                    
                }
                
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $tipo;
    }

    function listar() {
        $lista_tipo_farmaco = null;
        $indice = 0;
        $conexion = new MySqlCon();
        $query = 'SELECT id_tipo, descripcion_tipo FROM tipo_farmaco';
        try {
            $sentencia = $conexion->prepare($query);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_tipo, $descripcion_tipo);
                while ($sentencia->fetch()) {
                    $tipo = new TipoFarmaco();
                    $tipo->id_tipo = $id_tipo;
                    $tipo->descripcion = $descripcion_tipo;
                    $lista_tipo_farmaco[$indice]=$tipo;
                    $indice++;
                    $tipo->__destruct();
                }
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $lista_tipo_farmaco;
    }



    function validarTipo($descripcion) {
        $conexion = new MySqlCon();
        $valido = FALSE;
        $sqlQuery = 'SELECT COUNT(*)FROM `tipo_farmaco` WHERE UPPER(TRIM(`descripcion_tipo`)) = UPPER(TRIM(?))';
        try {
            $sentencia = $conexion->prepare($sqlQuery);
            $sentencia->bind_param("s", $descripcion);
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
        $tipo = new Farmaco();
        $tipo = $obj;
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
                    $tipo = new Farmaco();
                    $tipo->init($id_farmaco, $descripcion, $precio, $unidad, $id_tipoFarmaco);
                    $lista_farmacos[$indice]->$tipo;
                    $indice++;
                    $tipo->__destruct();
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