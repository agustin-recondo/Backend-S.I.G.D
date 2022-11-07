<?php
class UsuarioModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function getUser($email){
        $sql = "SELECT * FROM usuario WHERE email = '$email' AND borrado = 0";
        $resultado = $this->db->query($sql);
        if(!$resultado){
            return $resultado;
        }
        return $resultado->fetch_assoc();
    }

    public function createUser($nombre, $apellido, $email, $password, $rol){
        $sql = "insert into usuario(nomusuario, apusuario, email, password, rol) VALUES ('$nombre', '$apellido', '$email', '$password', '$rol');";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    public function updateUser($id, $nombre, $apellido, $email, $rol){
        $sql = "UPDATE `usuario` SET `nomusuario` = '$nombre', `apusuario` = '$apellido', `email` = '$email', `rol` = '$rol' WHERE `usuario`.`idusuario` = $id;";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    public function resetPassword($email, $password){
        $sql = "UPDATE `usuario` SET Password = '$password' WHERE `usuario`.`email` = '$email'";
        $resultado = $this->db->query($sql);
        return $resultado;
    }

    public function deleteUser($id){
        $sql = "UPDATE `usuario` SET borrado = 1 WHERE `usuario`.`idusuario` = '$id'";
        $resultado = $this->db->query($sql);
        return $this->db->query($resultado);
    }

    public function getArbitrosLibres(){
        $sql = "SELECT usuario.idusuario, usuario.nomusuario, usuario.apusuario
         FROM equipo 
         RIGHT JOIN usuario ON usuario.idusuario = equipo.idusuario 
         WHERE equipo.idusuario IS NULL && rol = 'entrenador';";

         $resultado = $this->db->query($sql);

         $array = [];

        while ($fila = $resultado->fetch_assoc()) {
            $arbitro = array(
                'id' =>$fila['idusuario'],
                'nombre' => $fila['nomusuario'],
                'apellido' => $fila['apusuario']
            );

            array_push($array, $arbitro);
        }

         return $array;
    }
}