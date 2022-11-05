<?php

use Phroute\Phroute\Exception\InvalidTokenException;

$ruta = getcwd();

require_once($ruta . '/app/controllers/Usuarios.php');
require_once($ruta . '/app/controllers/Deportes.php');
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
   $login = new LoginController();
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

$router->GET('/getDeporte/{nombre}', function($nombre){
   $deporte= new DeportesController();
   $respuesta = $deporte->getDeporte($nombre);
   return json_encode($respuesta);
});


});

/*****************************************
 * Ruta para cambiar contraseña
 ****************************************/
$router->group(['before' => 'authResetPassword'], function ($router) {
$router->POST('/resetPassword', function () {
   $login = new LoginController();
   $respuesta = $login->resetPassword();
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
   $router->DELETE('deleteUser/{id:i}', function ($id) {
      $usuario = new UsuarioController();
      $respuesta = $usuario->deleteUser($id);
      return json_encode($respuesta);
   });

   //Crear deporte
   $router->POST('createDeporte', function(){
      $deporte = new DeportesController();
      $respuesta = $deporte->createDeporte();
      return json_encode($respuesta);
   });

   //Modificar deporte
   $router->POST('updateDeporte/{id}', function($id){
      $deporte = new DeportesController();
      $respuesta = $deporte->updateDeporte($id);
      return json_encode($respuesta);
   });
});
