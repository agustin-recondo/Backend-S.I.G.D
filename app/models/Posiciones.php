<?php
class PosicionesModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function getUltimaPosicion(){
        $sql = "select MAX(idposicion) from posicion;";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }

    public function getPosiciones($iddeporte){
        $sql = "select * from posicion where iddeporte = $iddeporte;";
        $resultado = $this->db->query($sql);

        $array = [];

        while ($fila = $resultado->fetch_assoc()) {
            $posicion = array(
                'idposicion' =>$fila['idposicion'],
                'nombre' => $fila['nomposicion'],
            );

            array_push($array, $posicion);
        }

        return $array;
    }

    public function createPosicion($idDeporte,$idPosicion, $nombres){
        $values = '';
        foreach ($nombres as $nombre) {
            $value = "($idDeporte, $idPosicion, '$nombre'),";
            $values .= $value;
            $idPosicion++;
        }

        $valuesSinUltimaComa = substr($values, 0, -1);
        $sql = "insert into posicion(iddeporte, idposicion, nomposicion) VALUES $valuesSinUltimaComa;";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    public function deletePosiciones($id){
        $sql = "delete from posicion where iddeporte = $id";
        $resultado = $this->db->query($sql);
        return $resultado;
    }
}