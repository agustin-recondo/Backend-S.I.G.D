<?php
$ruta = getcwd();

require_once($ruta . '\app\models\Usuario.php');
class UsuarioController{

    function __construct()
    {
        
    }

    function deleteUser($id){
        $usuario = new UsuarioModel();
        $sqlUsuario = $usuario->deleteUser($id);
        $respuesta = array(
            'mensaje' => "Usuario eliminado correctamente",
            'data' => $sqlUsuario,
        );
        return json_encode($respuesta);
    }
}