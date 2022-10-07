<?php
class UsuarioModel
{
    private $db;

    public function __construct()
    {
        
        $this->db = Conexion::conectar();
        $this->usuarios = array();
    }

    public function getUser($email){
        $sql = "SELECT * FROM usuario WHERE Email = '$email' AND Borrado = 0";
        $resultado = $this->db->query($sql);
        $this->db->close();
        return $resultado->fetch_assoc();
    }

    public function createUser($nombre, $apellido, $email, $password, $rol){
        $sql = "insert into usuario(NomUsuario, ApUsuario, Email, Password, Rol) VALUES ('$nombre', '$apellido', '$email', '$password', '$rol');";
        $resultado = $this->db->query($sql);
        $this->db->close();
        return $resultado;
    }

    public function updateUser($id, $nombre, $apellido, $email, $rol){
        $sql = "UPDATE `usuario` SET `NomUsuario` = '$nombre', `ApUsuario` = '$apellido', `Email` = '$email', `Rol` = '$rol' WHERE `usuario`.`IdUsuario` = $id;";
        $resultado = $this->db->query($sql);
        $this->db->close();
        return $resultado;
    }

    public function deleteUser($id){
        
        $sql = "UPDATE `usuario` SET Borrado = 1 WHERE `usuario`.`IdUsuario` = '$id'";
        $this->db->close();
        return $this->db->query($sql);
    }
}