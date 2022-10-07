<?php

use Phroute\Phroute\Exception\InvalidTokenException;

$ruta = getcwd();

require_once($ruta . '/app/controllers/Usuarios.php');
require_once($ruta . '/app/controllers/auth/login.php');
require_once($ruta . '/app/controllers/auth/token.php');
require_once($ruta . '/app/Middleware/authMiddleware.php');



/*****************************************
 * Rutas que no requieren token
 *****************************************/
$router->POST('/login', function () {
   $login = new LoginController();
   $respuesta = $login->login();
   return json_encode($respuesta);
});

//Solicitar cambio de contraseña
$router->GET('/requestResetPassword/{email}', function ($email) {
   $login = new LoginController($email);
   $respuesta = $login->requestResetPassword($email);
   return json_encode($respuesta);
});

$router->GET('/validateToken', function () {
   $validateToken = new TokenController;
   $respuesta = $validateToken->validateToken();
   return json_encode($respuesta);
});

/*****************************************
 * Rutas que requieren token pero no un rol
 *****************************************/
$router->group(['before' => 'auth'], function ($router) {
$router->GET('/getUser/{email}', function($email){
   $usuario = new UsuarioController();
   $respuesta = $usuario->getUser($email);
   return json_encode($respuesta);
});
});

/*****************************************
 * Rutas para el administrador
 ****************************************/
$router->group(['prefix' => '/admin', 'before' => 'authAdmin'], function ($router) {
   //Crear usuario
   $router->POST('createUser', function () {
      $usuario = new UsuarioController();
      $respuesta = $usuario->createUser();
      return json_encode($respuesta);
   });
   //Modificar usuario
   $router->POST('updateUser', function () {
      $usuario = new UsuarioController();
      $respuesta = $usuario->updateUser();
      return json_encode($respuesta);
   });
   //Borrar usuario
   $router->DELETE('deleteUser/{id}', function ($id) {
      $usuario = new UsuarioController();
      $respuesta = $usuario->deleteUser($id);
      return json_encode($respuesta);
   });
});
