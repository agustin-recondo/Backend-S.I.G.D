<?php
$ruta = getcwd();

require_once($ruta . '/app/models/Deportes.php');
require_once($ruta . '/app/models/Posiciones.php');
require_once($ruta . '/app/models/Incidencias.php');
require_once($ruta . '/app/helpers/helpers.php');



class DeportesController
{
    function getDeporte($nombre)
    {

        $deporte = new DeportesModel();
        $sqlDeporte = $deporte->getDeporte($nombre);

        $idDeporte = $sqlDeporte['iddeporte'];

        $incidencia = new IncidenciasModel();
        $sqlIncidencias = $incidencia->getIncidencia($idDeporte);

        $posiciones = new PosicionesModel();
        $sqlPosiciones = $posiciones->getPosiciones($idDeporte);

        $data = array(
            'success' => 1,
            'deporte' => $sqlDeporte,
            'incidencias' => $sqlIncidencias,
            'posiciones' => $sqlPosiciones
        );

        return $data;
    }

    function getDeportes()
    {

        $deporte = new DeportesModel();
        $sqlDeporte = $deporte->getDeportes();

        $data = array(
            'success' => 1,
            'deportes' => $sqlDeporte,
        );

        return $data;
    }

    function createDeporte()
    {
        //Validar que vengan datos
        if (!isset($_POST['nombre']) || !$_POST['nombre']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar un nombre",
            );
            return $respuesta;
        }
        $nombre = $_POST['nombre'];

        if (!isset($_POST['convocables']) || !$_POST['convocables']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar la cantidad de jugadores convocables",
            );
            return $respuesta;
        }
        $convocables = $_POST['convocables'];

        if (!isset($_POST['titulares']) || !$_POST['titulares']) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => "Se debe ingresar la cantidad de jugadores titulares",
            );
            return $respuesta;
        }
        $titulares = $_POST['titulares'];

        $deporte = new DeportesModel();
        $ultimoDeporte = $deporte->getUltimoDeporte();
        $ultimoIDDeporte = $ultimoDeporte["MAX(IdDeporte)"] + 1;
        $crearDeporte = $deporte->createDeporte($ultimoIDDeporte, $nombre, $convocables, $titulares);

        if (!$crearDeporte) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => 'Hubo un error al crear el deporte'
            );
            return $respuesta;
        }

        if (isset($_POST['posiciones'])) {
            $posiciones = (json_decode($_POST['posiciones']));
            $posicion = new PosicionesModel();
            $ultimaPosicion = $posicion->getUltimaPosicion();
            $ultimoIDPosicion = $ultimaPosicion["MAX(idposicion)"] + 1;

            $crearPosicion = $posicion->createPosicion($ultimoIDDeporte, $ultimoIDPosicion, $posiciones);
        }

        if (!isset($_POST['incidencias'])) {
            $respuesta = array(
                'success' => 0,
                'mensaje' => 'No se cargaron incidencias'
            );
            return $respuesta;
        }

        $incidencias = (json_decode($_POST['incidencias']));
        $incidencia = new IncidenciasModel();
        $ultimaIncidencia = $incidencia->getUltimaIncidencia();
        $ultimoIDIncidencia = $ultimaIncidencia["MAX(idincidencia)"] + 1;

        $crearIncidencia = $incidencia->createIncidencia($ultimoIDDeporte, $ultimoIDIncidencia, $incidencias);


        $respuesta = array(
            'success' => 1,
            'mensaje' => 'Se creo el deporte correctamente'
        );
        return $respuesta;
    }

    function updateDeporte($id)
    {
                //Validar que vengan datos
                if (!isset($_POST['nombre']) || !$_POST['nombre']) {
                    $respuesta = array(
                        'success' => 0,
                        'mensaje' => "Se debe ingresar un nombre",
                    );
                    return $respuesta;
                }
                $nombre = $_POST['nombre'];
        
                if (!isset($_POST['convocables']) || !$_POST['convocables']) {
                    $respuesta = array(
                        'success' => 0,
                        'mensaje' => "Se debe ingresar la cantidad de jugadores convocables",
                    );
                    return $respuesta;
                }
                $convocables = $_POST['convocables'];
        
                if (!isset($_POST['titulares']) || !$_POST['titulares']) {
                    $respuesta = array(
                        'success' => 0,
                        'mensaje' => "Se debe ingresar la cantidad de jugadores titulares",
                    );
                    return $respuesta;
                }
                $titulares = $_POST['titulares'];
        
        $deporte = new DeportesModel();
        $modificarDeporte = $deporte->updateDeporte($id, $nombre, $convocables, $titulares);

        if (isset($_POST['posiciones'])) {
            $posiciones = (json_decode($_POST['posiciones']));
            $posicion = new PosicionesModel();

            $borrarPosiciones = $posicion->deletePosiciones($id);

            $ultimaPosicion = $posicion->getUltimaPosicion();
            $ultimoIDPosicion = $ultimaPosicion["MAX(idposicion)"] + 1;

            $posicion->createPosicion($id, $ultimoIDPosicion, $posiciones);
        }



        $incidencias = (json_decode($_POST['incidencias']));
        $incidencia = new IncidenciasModel();
        
        $incidencia->deleteIncidencias($id);

        $ultimaIncidencia = $incidencia->getUltimaIncidencia();
        $ultimoIDIncidencia = $ultimaIncidencia["MAX(idincidencia)"] + 1;

        $crearIncidencia = $incidencia->createIncidencia($id, $ultimoIDIncidencia, $incidencias);

        $respuesta = array(
            'success' => 1,
            'mensaje' => 'Se modifico el deporte correctamente'
        );
        return $respuesta;
    }

    function getPosicionesJoinDeporte(){
        $posicion = new PosicionesModel();

        $posicionesJoin = $posicion->getPosicionesJOIN();

        $respuesta = array(
            'success' => 1,
            'posiciones' => $posicionesJoin,
        );

        return $respuesta;
    }
}
