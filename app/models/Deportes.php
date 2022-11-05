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

    // public function updateUser($id, $nombre, $apellido, $email, $rol){
    //     $sql = "UPDATE `usuario` SET `NomUsuario` = '$nombre', `ApUsuario` = '$apellido', `Email` = '$email', `Rol` = '$rol' WHERE `usuario`.`IdUsuario` = $id;";
    //     $resultado = $this->db->query($sql);
    //     return $resultado;
    // }

    // public function deleteUser($id){
    //     $sql = "UPDATE `usuario` SET Borrado = 1 WHERE `usuario`.`IdUsuario` = '$id'";
    //     $resultado = $this->db->query($sql);
    //     return $this->db->query($resultado);
    // }
}