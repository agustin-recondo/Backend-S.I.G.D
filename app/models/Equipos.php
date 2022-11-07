<?php
class EquiposModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function getUltimoEquipo(){
        $sql = "select MAX(idequipo) from equipo;";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }


    public function createEquipo($idequipo, $nomequipo, $idusuario){
        $sql = "insert into equipo(idequipo, nomequipo, idusuario) VALUES ($idequipo, '$nomequipo',$idusuario);";
        $resultado = $this->db->query($sql);
        return $resultado;
    }
}