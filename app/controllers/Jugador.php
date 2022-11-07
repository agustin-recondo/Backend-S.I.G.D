<?php
$ruta = getcwd();

require_once($ruta . '\app\models\Deportes.php');
require_once($ruta . '\app\models\Jugador.php');
require_once($ruta . '\app\models\Posiciones.php');
require_once($ruta . '/app/helpers/helpers.php');



class JugadorController
{

    function getJugador($ci){
        $jugador = new JugadorModel();
        $buscarJugador = $jugador->getJugador($ci);


        if(!$buscarJugador){
            $respuesta = array(
                'success' => 0,
                'mensaje' => "No se encontro el jugador",
            );
            return $respuesta;
        }

        $respuesta = array(
            'success' => 1,
            'mensaje' => "Se encontro el jugador",
            'data' => $buscarJugador,
        );
        return $respuesta;
    }
    function createJugador(){
        if (!isset($_POST['nombre']) || !$_POST['nombre']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un nombre",
            );
            return $respuesta;
        }
        $nombre = $_POST['nombre'];

        if (!isset($_POST['apellido']) || !$_POST['apellido']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un apellido",
            );
            return $respuesta;
        }
        $apellido = $_POST['apellido'];

        if (!isset($_POST['ci']) || !$_POST['ci']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar una CI",
            );
            return $respuesta;
        }
        $ci = $_POST['ci'];

        if (!isset($_POST['dorsal']) || !$_POST['dorsal']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar el dorsal",
            );
            return $respuesta;
        }
        $dorsal = $_POST['dorsal'];

        if (!isset($_POST['altura']) || !$_POST['altura']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar la altura",
            );
            return $respuesta;
        }
        $altura = $_POST['altura'];

        if (!isset($_POST['peso']) || !$_POST['peso']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar el peso",
            );
            return $respuesta;
        }
        $peso = $_POST['peso'];

        if (!isset($_POST['nac']) || !$_POST['nac']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar una fecha de nacimiento",
            );
            return $respuesta;
        }
        $nac = $_POST['nac'];
        $idposicion = $_POST['idposicion'];
        $iddeporte= $_POST['iddeporte'];

        $jugador = new JugadorModel();
        $jugador->createJugador($ci, $nombre, $apellido, $nac, $peso, $altura, $dorsal);

        $jugador->crearPosicionJugador($iddeporte, $idposicion, $ci);


        $respuesta = array(
            'success' => 1,
            'mensaje' => "Jugador creado correctamente",
        );
        return $respuesta;

    }

    function updateJugador(){
        if (!isset($_POST['nombre']) || !$_POST['nombre']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un nombre",
            );
            return $respuesta;
        }
        $nombre = $_POST['nombre'];

        if (!isset($_POST['apellido']) || !$_POST['apellido']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un apellido",
            );
            return $respuesta;
        }
        $apellido = $_POST['apellido'];

        if (!isset($_POST['ci']) || !$_POST['ci']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar una CI",
            );
            return $respuesta;
        }
        $ci = $_POST['ci'];

        if (!isset($_POST['dorsal']) || !$_POST['dorsal']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar el dorsal",
            );
            return $respuesta;
        }
        $dorsal = $_POST['dorsal'];

        if (!isset($_POST['altura']) || !$_POST['altura']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar la altura",
            );
            return $respuesta;
        }
        $altura = $_POST['altura'];

        if (!isset($_POST['peso']) || !$_POST['peso']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar el peso",
            );
            return $respuesta;
        }
        $peso = $_POST['peso'];

        if (!isset($_POST['nac']) || !$_POST['nac']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar una fecha de nacimiento",
            );
            return $respuesta;
        }
        $nac = $_POST['nac'];
        $idposicion = $_POST['idposicion'];
        $iddeporte= $_POST['iddeporte'];

        $ciAntigua = $_POST['ciAntiguo'];

        $jugador = new JugadorModel();
        $jugador->updateJugador($ci, $ciAntigua, $nombre, $apellido, $nac, $peso, $altura, $dorsal);

        $jugador->updatePosicionJugador($iddeporte, $idposicion, $ci, $ciAntigua);

        $respuesta = array(
            'success' => 1,
            'mensaje' => "Jugador actualizado correctamente",
        );
        return $respuesta;
    }

}