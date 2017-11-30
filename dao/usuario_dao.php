<?php

require_once '../dto/usuario.php';
require_once '../dbconnect/mysqldb.php';
require_once 'ipersistencia.php';

class UsuarioDAO implements IPersistencia {

    function __construct() {
        
    }

    function crear($obj) {
        $usuario = new Usuario();
        $usuario = $obj;
        $conexion = new MySqlCon();
        $sal = $usuario->correo_usuario;
        $usuario->pass_usuario = sha1($sal . $usuario->pass_usuario);
        $query = 'INSERT INTO `usuarios`(`login_usuario`, `pass_usuario`, `nombre_usuario`, `apellido_usuario`,
			`correo_usuario`, `codigo_perfil`, `fechaNacimiento_usuario`) VALUES (?, ?, ?, ?, ?, ?, ?)';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("sssssis", $usuario->login_usuario, $usuario->pass_usuario, $usuario->nombre_usuario, $usuario->apellido_usuario, $usuario->correo_usuario, $usuario->codigo_perfil, $usuario->fechaNacimiento_usuario);
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
        $usuario = new Usuario();
        $usuario = $obj;
        $conexion = new MySqlCon();
        $usuario->pass_usuario = sha1($usuario -> correo_usuario . $usuario->pass_usuario);
        $query = 'UPDATE `usuarios` SET `codigo_perfil`=?,`nombre_usuario`=?`,`apellido_usuario`=?`,`correo_usuario`=?,
			`pass_usuario`=?,`fechaNacimiento_usuario`=?  WHERE `id_usuario`=?';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("isssss", $usuario->codigo_perfil, $usuario->nombre_usuario, $usuario->apellido_usuario, $usuario->correo_usuario, $usuario->pass_usuario, $usuario->fechaNacimiento_usuario);
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
        $usuario = new Usuario();
        $usuario = $obj;
        $conexion = new MySqlConnection();
        $query = 'DELETE FROM `usuarios` WHERE `id_usuario` = ?';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("1", $usuario->id_usuario);
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
        $lista_usuario = null;
        $indice = 0;
        $conexion = new MySqlCon();
        $query = 'SELECT id_usuario, login_usuario FROM usuarios '
                . 'order by login_usuario ASC';
        try {
            $sentencia = $conexion->prepare($query);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_usuario, $login_usuario);
                while ($sentencia->fetch()) {
                    $usuario = new Usuario();
                    $usuario->id_usuario = $id_usuario;
                    $usuario->login_usuario = $login_usuario;
                    $lista_usuario[$indice]=$usuario;
                    $indice++;
                    $usuario->__destruct();
                }
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return $lista_usuario;
    }

    function autentificar($correo, $password) {
        $usuario = new Usuario();
        $lista_usuarios = null;
        $conexion = new MySqlCon();
        $indice = 0;
        $query = 'SELECT id_usuario, pass_usuario FROM usuarios WHERE correo_usuario = ?';
        $pass = '';
        try {
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("s", $correo);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_usuario, $pass_hash);
                while ($sentencia->fetch()) {
                    $pass = $pass_hash;
                }

                $password_hashed = sha1($correo . $password);
                echo '<script>console.log('. $password_hashed . ')</script>';
            }
            $conexion->close();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        if ($pass_hash == $password_hashed) {
            return TRUE;
        } else {
            return FALSE;
        }
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
        $usuario = new Usuario();
        $usuario = $obj;
        $lista_usuarios = null;
        $conexion = new MySqlConnection();
        $indice = 0;
        $query = 'SELECT usu.id_usuarios, per.id_perfiles, per.nom_perfil, per.descripcion, 
			usu.nombre, usu.email, usu.password FROM perfiles per, usuarios usu 
			WHERE per.id_perfiles = usu.id_perfiles and usu.nombre like = ?';
        try {
            $param_busq = '%' . $usuario->nombre . '%';
            $sentencia = $conexion->prepare($query);
            $sentencia->bind_param("s", $param_busq);
            if ($sentencia->execute()) {
                $sentencia->bind_result($id_usuario, $id_perfil, $nombre_perfil, $descripcion, $nombre, $email, $contrasena);
                while ($sentencia->fetch()) {
                    $usuario = new Usuario();
                    $usuario->init($id_perfil, $nombre_perfil, $descripcion, $id_usuario, $nombre, $email, $contrasena);
                    $lista_usuarios[$indice]->$usuario;
                    $indice++;
                    $usuario->__destruct();
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