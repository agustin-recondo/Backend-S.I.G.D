<?php

require_once ($_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php');
require_once ($_SERVER["DOCUMENT_ROOT"] . '/conexion.php');

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\RouteParser;
//Excepciones
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;

$router = new RouteCollector(new RouteParser);

require_once ($_SERVER["DOCUMENT_ROOT"] . '/routes/web.php');

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());


try{
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
}
catch(HttpRouteNotFoundException $e){
    echo $e->getMessage();
    die();
}
catch(HttpMethodNotAllowedException $e){
    echo $e->getMessage();
    die();
}

if($response){
    echo $response;
}
else {
    echo 'Hay que estar logueado o no se tiene permisos para acceder';
}


?>

