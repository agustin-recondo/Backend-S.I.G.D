<?php

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

$router->filter('auth', function(){
    $validateToken = new TokenController;
    $respuesta = $validateToken->validateToken();

    if($respuesta['success'] == 0){
        die(json_encode($respuesta));
    }

 });

/*******
 * Auth de rol administrador
 *******/
$router->filter('authAdmin', function(){
    $validateToken = new TokenController;
    $respuesta = $validateToken->validateToken();

    if($respuesta['success'] == 0){
        die(json_encode($respuesta));
    }

    if($respuesta['rol'] != 'Administrativo'){
        $respuesta = array(
            "success" => 0,
            "mensaje" => 'Rol no valido para esta accion',
        );
        die(json_encode($respuesta));
    }

 });