<?php
include($_SERVER["DOCUMENT_ROOT"] . '/app/models/Usuario.php');
class UsuarioController{

    function __construct()
    {
        
    }

    function createUser($nombre, $apellido, $email, $password, $rol){
        $usuario = new UsuarioModel();
        $sqlUsuario = $usuario->createUser($nombre, $apellido, $email, $password, $rol);
    }


    function updateUser($id, $nombre, $apellido, $email, $password, $rol){
        $usuario = new UsuarioModel();
        $sqlUsuario = $usuario->updateUser($id, $nombre, $apellido, $email, $password, $rol);

        if ($sqlUsuario){
            echo 'El usuario se actualizo correctamente';
            exit();
        }
        else{
            echo 'Hubo un error';
            exit();
        }
    }

    function deleteUser($id){
        $usuario = new UsuarioModel();
        $sqlUsuario = $usuario->deleteUser($id);

        if ($sqlUsuario){
            echo 'El usuario se borro correctamente';
            exit();
        }
        else{
            echo 'Hubo un error';
            exit();
        }
    }
}