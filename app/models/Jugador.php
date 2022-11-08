<?php
class JugadorModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function getJugador($ci){
        $sql = "SELECT jugador.cijugador, jugador.nomjugador, jugador.apjugador, jugador.fechanacjugador, jugador.peso, jugador.altura, jugador.dorsal, ocupa.idposicion, posicion.nomposicion, equipo.nomequipo
        FROM jugador 
        INNER JOIN ocupa ON ocupa.cijugador = jugador.cijugador 
        INNER JOIN posicion ON posicion.idposicion = ocupa.idposicion
        INNER JOIN realiza ON jugador.cijugador = realiza.cijugador
        INNER JOIN equipo on realiza.idequipo = equipo.idequipo
        WHERE jugador.cijugador = $ci";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }

    public function createJugador($ci, $nombre, $apellido, $nac, $peso, $altura, $dorsal){
        $sql = "INSERT INTO jugador(cijugador, nomjugador, apjugador, fechanacjugador, peso, altura, dorsal) VALUES ($ci, '$nombre', '$apellido', '$nac', $peso, $altura, $dorsal);";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    public function updateJugador($ci, $ciAntigua, $nombre, $apellido, $nac, $peso, $altura, $dorsal){
        $sql = "UPDATE jugador SET cijugador = $ci, nomjugador = '$nombre', apjugador = '$apellido', fechanacjugador = '$nac', peso = $peso, altura = $altura, dorsal = $dorsal WHERE cijugador = $ciAntigua;";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    public function crearPosicionJugador($iddeporte, $idposicion, $cijugador){
        $sql = "INSERT INTO ocupa(iddeporte, idposicion, cijugador) VALUES ($iddeporte, $idposicion, $cijugador)";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    public function updatePosicionJugador($iddeporte, $idposicion, $cijugador, $ciAntiguo){
        $sql = "UPDATE ocupa SET iddeporte = $iddeporte, idposicion = $idposicion, cijugador = $cijugador WHERE cijugador = $ciAntiguo";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    public function jugadorEquipo($jugadores, $iddeporte, $idequipo){
        $values = '';
        foreach ($jugadores as $jugador) {
            $value = "($jugador, $iddeporte, $idequipo),";
            $values .= $value;
        }

        $valuesSinUltimaComa = substr($values, 0, -1);
        $sql = "INSERT INTO realiza(cijugador, iddeporte, idequipo) VALUES $valuesSinUltimaComa";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

}