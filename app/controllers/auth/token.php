<?php
$ruta = getcwd();

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class TokenController
{

    function __construct()
    {
    }

    /***********************
     * GENERAR TOKEN
     **********************/
    function generarToken($datos)
    {
        $time = time();
        $time_exp = $time + (480 * 60);
        $key = $_ENV['secret_key'];
        
        $token = array(
            "iat" => $time, //Tiempo en el que inicia el token
            "exp" => $time_exp, //Tiempo en el que expira el token - 8 horas
            "data" =>  [
                "id" => $datos['IdUsuario'],
                "nombre" => $datos['NomUsuario'],
                "apellido" => $datos['ApUsuario'],
                "email" => $datos['Email'],
                "rol" => $datos['Rol'],
            ]
        );

        $jwt = JWT::encode($token, $key, 'HS256');
        $respuesta = array(
            'token' => $jwt,
            'token_exp' => $time_exp
        );
        return $respuesta;
    }

    /***********************
     * VALIDAR TOKEN
     **********************/
    function validateToken()
    {
        $headers = getallheaders();
        $key = $_ENV['secret_key'];

        //Validar que viene el token en el header y que no es nulo
        if (!isset($headers['Authorization']) || $headers['Authorization'] == null) {
            header('HTTP/1.0 403 Forbidden', true, 403);
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'No hay token de seguridad',
            );
            return $respuesta;
        }
        
        // Desencriptar el token
        try {
            $token = isset($headers['Authorization']) ? $headers['Authorization'] : null;
            $data = JWT::decode($token, new Key($key, 'HS256'));
        }
        //Comprobar que el token no esta expirado con el exp del token
        catch (ExpiredException $e) {
            header('HTTP/1.0 403 Forbidden', true, 403);
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'El token expiro',
            );
            return $respuesta;
        }
        //Comprobar la firma del token
        catch (SignatureInvalidException $e) {
            header('HTTP/1.0 403 Forbidden', true, 403);
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'El token fue modificado o no es valido',
            );
            return $respuesta;
        }
        //Un catch por si salta otro error
        catch (Exception $e) {
            header('HTTP/1.0 403 Forbidden', true, 403);
            $respuesta = array(
                "success" => 0,
                "mensaje" => "Error en el token",
            );
            return $respuesta;
        }

        //Todo marchando

        header("HTTP/1.1 200 OK", true, 200);
        $respuesta = array(
            "success" => 1,
            "mensaje" => 'Token valido',
            "rol" => $data->data->rol,
        );
        return $respuesta;
    }
}
