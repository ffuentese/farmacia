<?php

require_once '../dto/receta.php';
require_once '../dbconnect/mysqldb.php';
require_once 'ipersistencia.php';

class RecetaDAO implements IPersistencia {

    function __construct() {
        
    }
    
    function lastId(){
        $conexion = new MySqlCon();
        $query = 'SELECT MAX(id_receta)+1 FROM recetas';
        $last_id = 0;
        try {
            $sentencia = $conexion->prepare($query);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id);
                while ($sentencia->fetch()) {
                    $last_id = $id;
                }
                return $last_id;
            } else {
                return $last_id;
            }
    } catch (Exception $e) {
            error_log($e->getMessage());
            echo $e->getMessage();
        }
    }
    
          function leer($cod_receta) {
        $receta = null;      
        $conexion = new MySqlCon();
        $query = 'SELECT id_receta, fecha_emision, total_receta, estado, id_usuario FROM recetas WHERE id_receta = ?';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("i", $cod_receta);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_receta, $fecha_emision, $total_receta, $estado, $id_usuario);
                while ($sentencia->fetch()) {
                    $receta = new Receta();
                    $receta->id_receta= $id_receta;
                    $receta->fecha_emision = $fecha_emision;
                    $receta->total_receta = $total_receta;
                    $receta->estado = $estado;
                    $receta->id_usuario = $id_usuario;
                    
                    
                }
                
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $receta;
    }

    function crear($obj) {
        $receta = new Receta();
        $receta = $obj;
        $conexion = new MySqlCon();
        $query = 'INSERT INTO `recetas`(`id_receta`, `fecha_emision`, `total_receta`, `estado`,
			`id_usuario`) VALUES (?, ?, ?, ?, ?)';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("isisi", $receta->id_receta, $receta->fecha_emision, $receta->total_receta, $receta->estado, $receta->id_usuario);
            $sentencia->execute();
            if ($conexion->affected_rows > 0) {
                $conexion->commit();
                return TRUE;
            } else {
                $conexion->rollback();
                //echo mysql_errno($enlace) . ": " . mysql_error($enlace) . "\n";
                return FALSE;
            }
            $receta->__destruct();
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo $e->getMessage();
        }
    }

    function actualizar($obj) {
        $receta = new Receta();
        $receta = $obj;
        $conexion = new MySqlCon();
        $query = 'UPDATE `recetas` SET `fecha_emision`=?,`total_receta`=?,`estado`=?,`id_usuario`=?
			WHERE `id_receta`=?';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("sisii", $receta->fecha_emision, $receta->total_receta, $receta->estado, $receta->id_usuario, $receta->id_receta);
            $sentencia->execute();
            if ($conexion->affected_rows > 0) {
                $conexion->commit();
                return TRUE;
            } else {
                $conexion->rollback();
                return FALSE;
            }
            $conexion->close();
            $receta->__destruct();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    function eliminar($obj) {
        $receta = new Receta();
        $receta = $obj;
        $conexion = new MySqlCon();
        $query = 'DELETE FROM `recetas` WHERE `id_receta` = ?';
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
        $lista_recetas = null;
        $indice = 0;
        $conexion = new MySqlCon();
        $query = 'SELECT id_receta, fecha_emision, total_receta, estado, id_usuario FROM recetas';
        try {
            $sentencia = $conexion->prepare($query);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_receta, $fecha_emision, $total_receta, $estado, $id_usuario);
                while ($sentencia->fetch()) {
                    $receta = new Receta();
                    $receta->id_receta = $id_receta;
                    $receta->fecha_emision = $fecha_emision;
                    $receta->total_receta = $total_receta;
                    $receta->estado = $estado;
                    $receta->id_usuario = $id_usuario;
                    $lista_recetas[$indice]=$receta;
                    $indice++;
                    $receta->__destruct();
                }
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $lista_recetas;
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