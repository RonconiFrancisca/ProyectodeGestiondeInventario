<?php

class Usuario{
    public string $email;
    protected $clave;
    public string $nombre;
    public string $apellido;
    public int $id_rol;


    public function __construct($email,$clave,  $nombre, $apellido){
        $this->email = $email;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->apellido = $apellido;

    }

    public function subirUsuario($bd,$id_rol) {
        $hash_clave = password_hash($this->clave, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuario (email,clave,nombre, apellido, id_rol)
        VALUES (:email,:clave, :nombre, :apellido, :id_rol)";

        $resultado = $bd->prepare($sql);
        $resultado->bindParam(":email", $this->email, PDO::PARAM_STR);
        $resultado->bindParam(":clave", $hash_clave);
        $resultado->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
        $resultado->bindParam(":apellido", $this->apellido, PDO::PARAM_STR);
        $resultado->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
        $resultado->execute();
    }

    public function verificarClave($bd,$email,$clave){
        $sql="SELECT * FROM usuario WHERE email=:email";
        $verificar_clave=$bd->prepare($sql);
        $verificar_clave->bindParam(':email',$email);
        $verificar_clave->execute();
        $row=$verificar_clave->fetch(PDO::FETCH_ASSOC);

        if($row){
            if(password_verify($clave,$row['clave'])) {
                return $row;
            } else{
                return false;
            }
        }
    }
    
    public static function cambiarClave($bd,$email,$clave_nueva){
        $clave_nueva = password_hash($clave_nueva, PASSWORD_BCRYPT);
        $sql = "UPDATE usuario SET clave=:clave WHERE email=:email";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':clave', $clave_nueva);
        $resultado->bindParam(':email', $email);
        $resultado->execute();
    }

    public function buscarUsuario($bd,$email){
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':email', $email);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerUsuario($bd){
        $sql = "SELECT * FROM usuario";
        $resultado = $bd->prepare($sql);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarUsuario($bd,$id_usuario){
        $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_usuario', $id_usuario);
        $resultado->execute();

        $bd->exec("SET @count = 0");
        $bd->exec("UPDATE usuario SET id_usuario = @count := @count + 1");
        $bd->exec("ALTER TABLE usuario AUTO_INCREMENT = 1");

    }

    public function verificarUsuario($bd){
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':email', $this->email);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }
}
?>
