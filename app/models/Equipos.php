<?php
class EquiposModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function getUltimoEquipo()
    {
        $sql = "select MAX(idequipo) from equipo;";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }

    public function getEquipos($texto)
    {
        $sql = "SELECT DISTINCT(equipo.idequipo), equipo.nomequipo, deporte.nomdeporte FROM equipo
        INNER JOIN realiza ON realiza.idequipo = equipo.idequipo
        INNER JOIN deporte ON deporte.iddeporte = realiza.iddeporte
        WHERE nomequipo LIKE '%$texto%';";

        $resultado = $this->db->query($sql);

        $array = [];

        while ($fila = $resultado->fetch_assoc()) {
            $equipo = array(
                'idequipo' => $fila['idequipo'],
                'nombre' => $fila['nomequipo'],
                'nomdeporte' => $fila['nomdeporte']
            );

            array_push($array, $equipo);
        }
        return $array;
    }


    public function createEquipo($idequipo, $nomequipo, $idusuario)
    {
        $sql = "insert into equipo(idequipo, nomequipo, idusuario) VALUES ($idequipo, '$nomequipo',$idusuario);";
        $resultado = $this->db->query($sql);
        return $resultado;
    }
}
