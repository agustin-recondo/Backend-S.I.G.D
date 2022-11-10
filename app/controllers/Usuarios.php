<?php
$ruta = getcwd();

require_once($ruta . '/app/models/Usuario.php');
require_once($ruta . '/app/helpers/helpers.php');



class UsuarioController
{

    function __construct()
    {
    }

    function getUser($email)
    {
        if (!validateEmail($email)) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "El email no es valido",
            );
            return $respuesta;
        }

        $usuario = new UsuarioModel();
        $sqlUsuario = $usuario->getUser($email);

        if (!$sqlUsuario) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "El usuario no existe",
            );

            return $respuesta;
        }

        $tokenController = new TokenController();
        $jwt = $tokenController->generarToken($sqlUsuario);

        $respuesta = array(
            'success' => 1,
            'mensaje' => "Usuario encontrado",
            'data' => $jwt['token']
        );
        return $respuesta;
    }

    /******************************************
     * CREAR USUARIO
     ******************************************/
    function createUser()
    {
        // Validar nombre
        if (!isset($_POST['nombre']) || !$_POST['nombre']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un nombre",
            );
            return $respuesta;
        }
        $nombre = $_POST['nombre'];

        //Validar apellido
        if (!isset($_POST['apellido']) || !$_POST['apellido']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un apellido",
            );
            return $respuesta;
        }
        $apellido = $_POST['apellido'];

        //Validar email
        if (!isset($_POST['email']) || !$_POST['email'] || !validateEmail($_POST['email'])) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un email o el email no es valido",
            );
            return $respuesta;
        }
        $email = $_POST['email'];

        //Validar password
        if (!isset($_POST['password']) || !$_POST['password'] || !validatePassword($_POST['password'])) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar una contraseña o la contraseña no es valida",
            );
            return $respuesta;
        }
        $password = hash('sha256',$_POST['password']);

        //Validar rol
        if (!isset($_POST['rol']) || !$_POST['rol'] || !validateRol($_POST['rol'])) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un rol o el rol ingresado no es valido",
            );
            return $respuesta;
        }
        $rol = $_POST['rol'];


        $usuario = new UsuarioModel();
        $sqlUsuario = $usuario->createUser($nombre, $apellido, $email, $password, $rol);

        if (!$sqlUsuario) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "El correo electronico ya esta siendo utilizado",
            );
            return $respuesta;
        }

        $respuesta = array(
            'success' => 1,
            'mensaje' => "Usuario creado correctamente",
        );
        return ($respuesta);
    }
    /******************************************
     * MODIFICAR USUARIO
     ******************************************/
    function updateUser()
    {
        //Validar ID
        if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Hace falta el id o es un valor alterado",
            );
            return $respuesta;
        }
        $id = $_POST['id'];

        // Validar nombre
        if (!isset($_POST['nombre']) || !$_POST['nombre']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un nombre",
            );
            return $respuesta;
        }
        $nombre = $_POST['nombre'];

        //Validar apellido
        if (!isset($_POST['apellido']) || !$_POST['apellido']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un apellido",
            );
            return $respuesta;
        }
        $apellido = $_POST['apellido'];

        //Validar email
        if (!isset($_POST['email']) || !$_POST['email'] || !validateEmail($_POST['email'])) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un email o el email no es valido",
            );
            return $respuesta;
        }
        $email = $_POST['email'];

        //Validar rol
        if (!isset($_POST['rol']) || !$_POST['rol'] || !validateRol($_POST['rol'])) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un rol o el rol ingresado no es valido",
            );
            return $respuesta;
        }
        $rol = $_POST['rol'];


        $usuario = new UsuarioModel();
        $sqlUsuario = $usuario->updateUser($id, $nombre, $apellido, $email, $rol);

        if (!$sqlUsuario) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "El correo electronico ya esta siendo utilizado por otro usuario",
            );
            return $respuesta;
        }

        $respuesta = array(
            'success' => 1,
            'mensaje' => "Usuario actualizado correctamente",
        );
        return ($respuesta);
    }
    /******************************************
     * ELIMINAR USUARIO
     ******************************************/
    function deleteUser($id)
    {
        $usuario = new UsuarioModel();
        $sqlUsuario = $usuario->deleteUser($id);

        if (!$sqlUsuario) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Hubo un error al eliminar al usuario",
            );
            return ($respuesta);
        }

        $respuesta = array(
            'success' => 1,
            'mensaje' => "Usuario eliminado correctamente",
        );
        return ($respuesta);
    }

    function getArbitrosLibres(){
        $usuario = new UsuarioModel();
        $sqlUsuario = $usuario->getArbitrosLibres();

        $respuesta = array(
            'success' => 1,
            'mensaje' => "Usuario eliminado correctamente",
            'entrenadores' => $sqlUsuario,
        );
        return ($respuesta);
    }
}
