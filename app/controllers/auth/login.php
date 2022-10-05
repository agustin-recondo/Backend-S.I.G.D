<?php
$ruta = getcwd();

require_once($ruta . '/app/controllers/auth/token.php');
require_once($ruta . '/app/helpers/helpers.php');
require_once($ruta . '\app\models\Usuario.php');
class LoginController
{

    function __construct()
    {
    }

    /******************************************
     * LOGIN
     ******************************************/
    function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        /******************************
         * Comprobar validez del correo y contraseña
         ******************************/
        if (!validateEmail($email)) {
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'Correo electronico invalido',
            );
            return($respuesta);
        }

        if (!validatePassword($password)) {
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'La contraseña debe contener al menos 8 caracteres, una mayuscula, un numero y un caracter especial',
            );
            return($respuesta);
        }

        /******************************
         * Comprobar que el email existe en la BD
         ******************************/
        $modelo = new UsuarioModel();
        $usuario = $modelo->getUser($email);
        if (!$usuario) {
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'El correo no es correcto',
            );
            return($respuesta);
        }

        /******************************
         * Validar que la contraseña coincida
         ******************************/
        if ($usuario['Password'] != $password) {
            $respuesta = array(
                "success" => 0,
                "mensaje" => 'La contraseña no es correcta',
            );
            return($respuesta);
        }

        /******************************
         * Generar Token y guardarlo en BD
         ******************************/

        $tokenController = new TokenController();
        $jwt = $tokenController->generarToken($usuario);

        $updateToken = $modelo->updateToken($usuario['IdUsuario'], $jwt['token'], $jwt['token_exp']);

        $respuesta = array(
            "success" => 1,
            "mensaje" => 'Inicio de sesión exitoso',
            "token" => $jwt['token'],
        );

        return($respuesta);
    }
}
