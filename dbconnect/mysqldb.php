<?php
/**
 * MiConexion es una extension local a la clase de servicio
 * mysqli.
 * Se encarga de configurar la conexion de acuerdo a nuestras
 * necesidades.
 * Si es necesario, podemos agregar metodos extra.
 *
 */
final class MySqlCon extends mysqli {

    // propiedades que representan parametros de conexion
    private static $host_bd = 'localhost';
    private static $user_bd = 'farmacia';
    private static $pass_bd = 'farmacia';
    protected $name_bd = 'muerto_sano';
    
    public function  __construct() {
    	//parent:: se utiliza para instancias metodos estaticos desde la clase madre
    	//self:: se utliza para llamar en este caso variables estaticas desde una misma clase
        parent::__construct(self::$host_bd, self::$user_bd,
                self::$pass_bd, $this->name_bd);
        if ($this->connect_error) {
            die('Connect Error (' . $this->connect_errno . ') '
                    . $this->connect_error);//el this es obligatorio usarlo
        }
        $this->set_charset("utf8");
    }
	
}
    
?>