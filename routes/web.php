<?php
session_start();
include_once ($_SERVER["DOCUMENT_ROOT"] . '/app/controllers/Usuario.php');
include_once ($_SERVER["DOCUMENT_ROOT"] . '/app/controllers/auth/login.php');

////FILTROS
////filtro de autentificacion de logueo
$router->filter('auth', function () {

    if (!isset($_SESSION['user'])) {
        return false;
    }


});
////Filtro para rol administrativo
$router->filter('rolAdministrativo', function () {
    if ($_SESSION['rol'] != 'Administrativo') {
        echo 'El rol ' . $_SESSION['rol'] . ' no puede acceder';
        return false;
    }
});

/////LOGIN
$router->get('/login/{email}?/{password}?', function ($email = null, $password = null) {
    $loginController = new LoginController();
    return $loginController->login($email, $password);
});



/////RUTAS QUE REQUIEREN LOGIN
$router->group(['before' => 'auth'], function ($router) {

    $router->get('/logout', function () {
        $loginController = new LoginController();
        return $loginController->logout();
    });

    ////RUTAS PARA EL USUARIO ADMINISTRATIVO
    $router->group(['prefix' => 'admin', 'before' => 'rolAdministrativo'], function ($router) {
        
        $router->post('/create/{nombre}/{apellido}/{email}/{password}/{rol}', function ($nombre, $apellido, $email, $password, $rol) {
            $usuarioController = new UsuarioController();
            return $usuarioController->createUser($nombre, $apellido, $email, $password, $rol);
        });

        $router->update('/update/{id}/{nombre}/{apellido}/{email}/{password}/{rol}', function ($id, $nombre, $apellido, $email, $password, $rol) {
            $usuarioController = new UsuarioController();
            return $usuarioController->updateUser($id, $nombre, $apellido, $email, $password, $rol);
        });

        $router->delete('/delete/{id}', function ($id) {
            $usuarioController = new UsuarioController();
            return $usuarioController->deleteUser($id);
        });
    });



    ///RUTAS PARA EL USUARIO X
});
