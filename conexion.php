<?php

class Conexion
{
    private $conexion = null;

    public static function conectar()
    {
        $conexion = new mysqli($_ENV['DDBB_HOST'], $_ENV['DDBB_USER'], $_ENV['DDBB_PASSWORD'], $_ENV['DDBB_NAME']);
        
        
        if ($conexion->connect_error) {
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'Error en la conexion con la base de datos',
            );
            echo json_encode($respuesta);
            die();
        }
        return $conexion;
        
    }

    function query($query)
    {

        $result = $this->conexion->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
