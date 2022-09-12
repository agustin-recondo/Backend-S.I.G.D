<?php
$ruta = getcwd();

require_once($ruta . '/app/controllers/Usuarios.php');

$router->group(['prefix' => 'Backend/admin'], function($router){

   $router->delete('delete/{id}', function($id){
    $usuario = new UsuarioController();
    $respuesta = $usuario->deleteUser($id);
       return $respuesta;
   });

});

