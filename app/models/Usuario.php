<?php
class UsuarioModel
{
    private $db;

    public function __construct()
    {
        
        $this->db = Conexion::conectar();
        $this->usuarios = array();
    }

    public function deleteUser($id){
        $sql = "DELETE FROM Usuario WHERE `Usuario`.`IdUsuario` = $id";
        return $this->db->query($sql);
    }
}