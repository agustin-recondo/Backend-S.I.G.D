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
        $sql = "SELECT * FROM usuario WHERE Email = '$email'";
        $resultado = $this->db->query($sql);
        return $row = $resultado->fetch_assoc();
    }

    public function deleteUser($id){
        
        $sql = "UPDATE `usuario` SET Borrado = '1' WHERE `usuario`.`IdUsuario` = $id";
        return $this->db->query($sql);
    }

    public function updateToken($id, $token, $token_exp){
        try{
        $sql = "UPDATE `usuario` SET token = '$token', token_exp = $token_exp WHERE `usuario`.`IdUsuario` = $id";
        $resultado = $this->db->query($sql);
        return $resultado;
        }
        catch(Exception $e){
            echo $e;
            return false;
        }
    }
}