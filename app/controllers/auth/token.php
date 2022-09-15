<?php
$ruta = getcwd();

use \Firebase\JWT\JWT;

class TokenController
{

    function __construct()
    {
    }

    function generarToken($datos)
    {
        $time = time();
        $time_exp = $time + (480 * 60);
        $key = "hVmYp3s6v9y\$B&E)H@McQfTjWnZr4t7w!z%C*F-JaNdRgUkXp2s5v8x/A?D(G+KbPeShVmYq3t6w9z\$B&E)H@McQfTjWnZr4u7x!A%D*F-JaNdRgUkXp2s5v8y/B?E(H+KbPeShVmYq3t6w9z\$C&F)J@NcQfTjWnZr4u7x!A%D*G-KaPdSgVkXp2s5v8y/B?E(H+MbQeThWmZq3t6w9z\$C&F)J@NcRfUjXn2r5u7x!A%D*G-KaPdSgVkYp3s6v9y/B?E(H+MbQeThWmZq4t7w!z%C&F)J@NcRfUjXn2r5u8x/A?D(G-KaPdSgVkYp3s6v9y\$B&E)H@MbQeThWmZq4t7w!z%C*F-JaNdRfUjXn2r5u8x/A?D(G+KbPeShVkYp3s6v9y\$B&E)H@McQfTjWnZq4t7w!z%C*F-JaNdRgUkXp2s5u8x/A?D(G+KbPeShVmYq3t6w9y\$B&E)H@McQfTjWnZr4u7x!A%C*F-JaNdRgUkXp2s5v8y/B?E(G+KbPe";
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
}
