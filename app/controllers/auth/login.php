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

    function login()
    {


        $email = $_POST['email'];
        $password = $_POST['password'];

        /******************************
         * Comprobar validez del correo y contraseña
         ******************************/
        if (!validateEmail($email)) {
            return 'email invalido';
        }

        if (!validatePassword($password)) {
            return 'La contraseña debe incluir al menos 8 caracteres, una mayuscula, un numero y un caracter especial';
        }

        /******************************
         * Comprobar que el email existe en la BD
         ******************************/
        $modelo = new UsuarioModel();
        $usuario = $modelo->getUser($email);
        if (!$usuario) {
            return 'El correo no coincide con un usuario registrado';
        }

        /******************************
         * Validar que la contraseña coincida
         ******************************/
        if ($usuario['Password'] != $password) {
            return 'La contraseña no es correcta';
        }

        /******************************
         * Generar Token
         ******************************/

        $tokenController = new TokenController();
        $jwt = $tokenController->generarToken($usuario);

        $updateToken = $modelo->updateToken($usuario['IdUsuario'], $jwt['token'], $jwt['token_exp']);

        $respuesta = array(
            "success" => 1,
            "mensaje" => 'Logueo correcto',
            "token" => $jwt['token'],
            "nombre" => $usuario['NomUsuario'],
            "apellido" => $usuario['ApUsuario'],
            "email" => $usuario['Email'],
            "rol" => $usuario['Rol'],
        );

        return json_encode($respuesta);
    }
}
