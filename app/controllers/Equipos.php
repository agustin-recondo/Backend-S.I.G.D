<?php
$ruta = getcwd();

require_once($ruta . '/app/models/Deportes.php');
require_once($ruta . '/app/models/Posiciones.php');
require_once($ruta . '/app/models/Incidencias.php');
require_once($ruta . '/app/models/Equipos.php');
require_once($ruta . '/app/helpers/helpers.php');



class EquipoController
{

    function getEquipos($nombre){
        $equipo = new EquiposModel();
        $sqlEquipos = $equipo->getEquipos($nombre);

        if(!$sqlEquipos){
            $data = array(
                'success' => 0,
                'mensaje' => 'Error al buscar equipos'
            );
            return $data;
        }
        
        $data = array(
            'success' => 1,
            'mensaje' => 'Equipos encontrados',
            'equipos' => $sqlEquipos,
        );
        return $data;
    }
    function createEquipo(){

        if (!isset($_POST['nombre']) || !$_POST['nombre']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un nombre",
            );
            return $respuesta;
        }
        $nombre = $_POST['nombre'];

        if (!isset($_POST['jugadores']) || !$_POST['jugadores']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar jugadores",
            );
            return $respuesta;
        }
        $jugadores = json_decode($_POST['jugadores']);

        if (!isset($_POST['identrenador']) || !$_POST['identrenador']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un entrenador",
            );
            return $respuesta;
        }
        $identrenador = (int) $_POST['identrenador'];


        
        $equipo = new EquiposModel();
        $ultimoIDString = $equipo->getUltimoEquipo();

        $ultimoID = (int) $ultimoIDString["MAX(idequipo)"]+1;
        $sqlEquipo = $equipo->createEquipo($ultimoID, $nombre, $identrenador);

        $jugador = new JugadorModel();

        $deportenombre = $_POST['deporte'];
        $deporteModel = new DeportesModel();
        $sqlDeporte = $deporteModel->getDeporte($deportenombre);
        $ultimoIDString = $equipo->getUltimoEquipo();
        
        $sqlJugadores = $jugador->jugadorEquipo($jugadores, $sqlDeporte['iddeporte'], $ultimoID);

        if(!$sqlEquipo){
            $data = array(
                'success' => 0,
                'mensaje' => 'Error al crear el equipo'
            );
    
            return $data;
        }
        $data = array(
            'success' => 1,
            'mensaje' => 'Equipo creado correctamente'
        );

        return $data;
    }

}
