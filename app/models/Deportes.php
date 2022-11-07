<?php
class DeportesModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function getUltimoDeporte(){
        $sql = "select MAX(IdDeporte) from deporte;";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }

    public function getDeporte($nombre){
        $sql = "select deporte.iddeporte, deporte.nomdeporte, deporte.convocables, deporte.titulares from deporte where nomdeporte = '$nombre';";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }

    public function getDeportes(){
        $sql = "select nomdeporte from deporte";
        $resultado = $this->db->query($sql);

        $array = [];

        while ($fila = $resultado->fetch_assoc()) {
            array_push($array, $fila);
        }
        return $array;
    }


    public function createDeporte($id, $nombre, $convocables, $titulares){
        $sql = "insert into deporte(iddeporte, nomdeporte, convocables, titulares) VALUES ($id, '$nombre', '$convocables', '$titulares');";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    public function updateDeporte($id, $nombre, $convocables, $titulares){
        $sql = "UPDATE `deporte` SET `nomdeporte` = '$nombre', `convocables` = '$convocables', `titulares` = '$titulares' WHERE `deporte`.`iddeporte` = $id;";
        $resultado = $this->db->query($sql);
        return $resultado;
    }
}