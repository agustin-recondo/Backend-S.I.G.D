<?php
header("Access-Control-Allow-Origin: http://sigd-frontend.localhost");
header("Access-Control-Allow-Headers: Authorization");
header('Access-Control-Allow-Methods: GET, POST, DELETE');
$ruta = getcwd();
require_once($ruta . '/vendor/autoload.php');
require_once ($ruta . '/conexion.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();




use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\RouteParser;
//Excepciones
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;
use Phroute\Phroute\Exception\InvalidTokenException;

$router = new RouteCollector(new RouteParser);

require_once ($ruta . '/routes/web.php');

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
catch(InvalidTokenException $e){
    echo 'prueba filter token';
    die();
}

echo($response);

?>

