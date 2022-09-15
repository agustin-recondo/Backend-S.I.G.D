<?php
$ruta = getcwd();

require_once($ruta . '/app/controllers/Usuarios.php');
require_once($ruta . '/app/controllers/auth/login.php');

$router->post('Backend/login', function(){
   $login = new LoginController();
   $respuesta = $login->login();
   return $respuesta;
});

$router->group(['prefix' => 'Backend/admin'], function($router){

   $router->post('delete/{id}', function($id){
    $usuario = new UsuarioController();
    $respuesta = $usuario->deleteUser($id);
       return $respuesta;
   });

});

