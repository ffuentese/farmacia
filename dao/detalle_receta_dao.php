<?php

require_once '../dto/detalle_receta.php';
require_once '../dbconnect/mysqldb.php';
require_once '../dao/farmaco_dao.php';
require_once 'ipersistencia.php';

class Detalle_RecetaDAO implements IPersistencia {

    function __construct() {
        
    }

    function crear($obj) {
        $detalle = new Detalle_Receta();
        $detalle = $obj;
        $conexion = new MySqlCon();
        $query = 'INSERT INTO `detalle_receta`(`id_receta`, `id_farmaco`, `cantidad`,
			`subtotal`) VALUES (?, ?, ?, ?)';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("iiii", $detalle->id_receta, $detalle->id_farmaco, $detalle->cantidad, $detalle->sub_total);
            $sentencia->execute();
            if ($conexion->affected_rows > 0) {
                $conexion->commit();
                return TRUE;
            } else {
                $conexion->rollback();
                //echo mysql_errno($enlace) . ": " . mysql_error($enlace) . "\n";
                return FALSE;
            }
            $detalle->__destruct();
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
        $query = 'UPDATE `farmacos` SET `descripcion`=?,`precio`=?`,`unidad`=?`,`id_tipoFarmaco`=?
			WHERE `id_farmaco`=?';
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
        return 0;
    }

function listador($cod_receta) {
        $lista_detalle = null;
        $indice = 0;
        $conexion = new MySqlCon();
        $query = 'SELECT id_receta, id_farmaco, cantidad, subtotal FROM detalle_receta WHERE id_receta = ?';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("i", $cod_receta);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_receta, $id_farmaco, $cantidad, $sub_total);
                while ($sentencia->fetch()) {
                    $detalle = new Detalle_Receta();
                    $detalle->id_farmaco = $id_farmaco;
                    $detalle->id_receta = $id_receta;
                    $detalle->cantidad = $cantidad;
                    $detalle->sub_total = $sub_total;
                    $lista_detalle[$indice]=$detalle;
                    $indice++;
                    $detalle->__destruct();
                }
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $lista_detalle;
    }
    
        function borrar($id_farmaco, $id_receta) {
        
        $conexion = new MySqlCon();
        $query = 'DELETE FROM `detalle_receta` WHERE `id_farmaco` = ? AND `id_receta` = ?';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("ii", $id_farmaco, $id_receta);
            $sentencia->execute();
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
    
    function listar(){
        return 0;
    }

    function masVendido() {
        $masvendido = null;
        $farmaco_dao = new FarmacoDAO();
        $conexion = new MySqlCon();
        $query = 'SELECT `id_farmaco`, sum(cantidad) FROM `detalle_receta` group by `id_farmaco` ORDER BY sum(cantidad) DESC LIMIT 0, 1';
        try {
            $sentencia = $conexion->prepare($query);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_farmaco, $cantidad);
                while ($sentencia->fetch()) {
                    
                }
                
                $masvendido = $farmaco_dao->leer($id_farmaco);
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $masvendido;
    }
    
        function cantMasVendido($id_farmaco) {
        $masvendido = null;
        $farmaco_dao = new FarmacoDAO();
        $conexion = new MySqlCon();
        $query = 'SELECT `id_farmaco`, sum(cantidad) FROM `detalle_receta` group by `id_farmaco` ORDER BY sum(cantidad) DESC LIMIT 0, 1';
        try {
            $sentencia = $conexion->prepare($query);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_farmaco, $cantidad);
                while ($sentencia->fetch()) {
                    
                }
                
               
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $cantidad;
    }
    
        function masVecesVendido() {
        $masvecesvendido = null;
        $farmaco_dao = new FarmacoDAO();
        $conexion = new MySqlCon();
        $query = 'SELECT `id_farmaco`, count(id_farmaco) FROM `detalle_receta` group by `id_farmaco` ORDER BY count(cantidad) DESC';
        try {
            $sentencia = $conexion->prepare($query);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_farmaco, $cantidad);
                while ($sentencia->fetch()) {
                    
                }
                
                $masvecesvendido = $farmaco_dao->leer($id_farmaco);
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $masvecesvendido;
    }

    function vecesVendido($id_farmaco) {
        $cantidad = 0;
        $masvecesvendido = null;
        $farmaco_dao = new FarmacoDAO();
        $conexion = new MySqlCon();
        $query = 'SELECT count(id_farmaco) FROM `detalle_receta` WHERE `id_farmaco` = ? ';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("i", $id_farmaco);
            if ($sentencia->execute()) {
                $sentencia->bind_result($cantidad);
                while ($sentencia->fetch()) {
                    
                }
                
                
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $cantidad;
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