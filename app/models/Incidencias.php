<?php
class IncidenciasModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function getUltimaIncidencia(){
        $sql = "select MAX(idincidencia) from incidencia;";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }

    public function getIncidencia($iddeporte){
        $sql = "select * from incidencia where iddeporte = $iddeporte;";
        $resultado = $this->db->query($sql);

        $array = [];

        while ($fila = $resultado->fetch_assoc()) {
            $incidencia = array(
                'idincidencia' =>$fila['idincidencia'],
                'nombre' => $fila['nomincidencia'],
            );

            array_push($array, $incidencia);
        }
        

        return $array;
    }

    public function createIncidencia($idDeporte,$idIncidencia, $nombres){
        $values = '';
        foreach ($nombres as $nombre) {
            $value = "($idIncidencia, '$nombre', $idDeporte),";
            $values .= $value;
            $idIncidencia++;
        }

        $valuesSinUltimaComa = substr($values, 0, -1);
        $sql = "insert into incidencia(idincidencia, nomincidencia, iddeporte) VALUES $valuesSinUltimaComa;";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    public function deleteIncidencias($id){
        $sql = "delete from incidencia where iddeporte = $id";
        $resultado = $this->db->query($sql);
        return $resultado;
    }
}