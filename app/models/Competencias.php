<?php
class CompetenciasModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function getCompetencias($deporte){
        $sql = "SELECT competencia.idcompetencia, competencia.nomcompetencia FROM competencia
        INNER JOIN compone ON compone.idcompetencia = competencia.idcompetencia
        INNER JOIN deporte ON compone.iddeporte = deporte.iddeporte
        WHERE deporte.nomdeporte = '$deporte';";
        $resultado = $this->db->query($sql);

        $array = [];

        while ($fila = $resultado->fetch_assoc()) {
            $competencia = array(
                'idcompetencia' =>$fila['idcompetencia'],
                'nombre' => $fila['nomcompetencia'],
            );

            array_push($array, $competencia);
        }
        return $array;
    }
}