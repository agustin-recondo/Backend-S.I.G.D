<?php
class LoginController
{

    function __construct()
    {
    }

    function login($email, $password)
    {
        if ($_SESSION["is_logged"] == true) {
            $arrayReturn = array(
                'error' => 'Ya hay un usuario logueado',
                'status' => 404
            );
            return json_encode($arrayReturn);
        }

        if ($password == null || $email == null) {
            $arrayReturn = array(
                'error' => 'El correo o la contraseñas son nulos',
                'status' => 404
            );
            return json_encode($arrayReturn);
        }

        //Validacion email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $arrayReturn = array(
                'error' => 'El correo electronico no es valido',
                'status' => 404
            );
            return json_encode($arrayReturn);
        }

        ////Validacion contraseña
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $arrayReturn = array(
                'error' => 'La contraseña debe contener al menos 8 caracteres, una mayuscula, un numero y un caracter especial',
                'status' => 404
            );
            return json_encode($arrayReturn);
        }

        $usuario = new UsuarioModel();
        $sqlUsuario = $usuario->getUser($email);

        if(isset($sqlUsuario['error'])){
            $arrayReturn = array(
                'error' => $sqlUsuario['message'],
                'status' => 404
            );
            return json_encode($arrayReturn); 
        }

        if (!isset($sqlUsuario)) {
            $arrayReturn = array(
                'error' => 'El correo no existe en la bd',
                'status' => 404
            );
            return json_encode($arrayReturn);
        }

        if ($sqlUsuario['Email'] != $email || $sqlUsuario['Password'] != $password) {
            $arrayReturn = array(
                'error' => 'El correo o la contraseña no son correctos',
                'status' => 404
            );
            return json_encode($arrayReturn);
        }

        $rol = $sqlUsuario["Rol"];

        $_SESSION["is_logged"] = true;

        $_SESSION["user"] = $email;

        $_SESSION["rol"] = $rol;

        $arrayReturn = array(
            'status' => 200
        );
        return json_encode($arrayReturn);
    }



    function logout()
    {
        session_destroy();
        $arrayReturn = array(
            'mensaje' => "Se cerro sesion con exito",
            'status' => 200
        );
        return json_encode($arrayReturn);
    }
}
