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
            'token' => $jwt
        );
        return $respuesta;
    }

    function generarTokenResetPassword($email, $password)
    {
        $time = time();
        $time_exp = $time + (1440 * 60);
        $key = $password;
        
        $token = array(
            "iat" => $time, //Tiempo en el que inicia el token
            "exp" => $time_exp, //Tiempo en el que expira el token - 24 horas
            "data" =>  [
                "email" => $email,
            ]
        );
        $jwt = JWT::encode($token, $key, 'HS256');
        return $jwt;
    }

    /***********************
     * VALIDAR TOKEN LOGIN
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
        );

        if(isset($data->data->rol)){
            $respuesta['rol'] = $data->data->rol;
        }

        return $respuesta;
    }

    /***********************
     * VALIDAR TOKEN RESET PASSWORD
     **********************/
    function validateTokenResetPassword()
    {
        $headers = getallheaders();
        $usuarioModel = new UsuarioModel;
        $usuario = $usuarioModel->getUser($_POST['email']);
        $key = $usuario['Password'];

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
                "mensaje" => 'El token ya fue utilizado o no es valido',
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
        );

        if(isset($data->data->rol)){
            $respuesta['rol'] = $data->data->rol;
        }

        return $respuesta;
    }
}
