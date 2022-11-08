<?php
$ruta = getcwd();

require_once($ruta . '\app\models\Competencias.php');
require_once($ruta . '/app/helpers/helpers.php');



class CompetenciasController
{
    function getCompetencias($deporte){

        $competenciasModel = new CompetenciasModel();
        $sqlCompetencias = $competenciasModel->getCompetencias($deporte);
        

        if(!$sqlCompetencias){
            $data = array(
                'success' => 0,
                'mensaje' => 'Error al obtener las competencias'
            );
    
            return $data;
        }
        $data = array(
            'success' => 1,
            'mensaje' => 'Competencias encontradas con exito',
            'competencias' => $sqlCompetencias
        );
        return $data;
    }

}
