<?php

class Usuario{
    public string $email;
    protected $clave;
    public string $nombre;
    public string $apellido;
    public int $id_rol;


    public function __construct($email,$clave, $nombre, $apellido){
        $this->email = $email;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }
    
    public static function subirUsuario($bd, $nuevo_email, $nuevo_nombre, $nuevo_apellido, $nuevo_rol, $clave_nueva) {
        try {
            $hash_clave = password_hash($clave_nueva, PASSWORD_DEFAULT); 
            
            $sql = "INSERT INTO usuario (email, clave, nombre, apellido, id_rol)
                        VALUES (:email, :clave, :nombre, :apellido, :id_rol)";

            $resultado = $bd->prepare($sql);
            
            $resultado->bindParam(":email", $nuevo_email, PDO::PARAM_STR);
            $resultado->bindParam(":clave", $hash_clave);
            $resultado->bindParam(":nombre", $nuevo_nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $nuevo_apellido, PDO::PARAM_STR);
            $resultado->bindParam(":id_rol", $nuevo_rol, PDO::PARAM_INT);
            
            return $resultado->execute();
        } catch (PDOException $e) {
            return false;
        }
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
    
    public static function editarUsuario($bd, $nuevo_email, $nuevo_nombre, $nuevo_apellido, $nuevo_rol, $clave_nueva, $id_usuario) {
        if (empty($clave_nueva)) {
            $sql = "UPDATE usuario SET email = :nuevo_email,nombre = :nuevo_nombre,
                    apellido = :nuevo_apellido,id_rol = :nuevo_rol
                    WHERE id_usuario = :id_usuario";

            $resultado = $bd->prepare($sql);

            $resultado->bindParam(':nuevo_email', $nuevo_email);
            $resultado->bindParam(':nuevo_nombre', $nuevo_nombre);
            $resultado->bindParam(':nuevo_apellido', $nuevo_apellido);
            $resultado->bindParam(':nuevo_rol', $nuevo_rol);
            $resultado->bindParam(':id_usuario', $id_usuario);

        } else {
            $nueva_clave_hasheada = password_hash($clave_nueva, PASSWORD_DEFAULT);

            $sql = "UPDATE usuario SET email = :nuevo_email, nombre = :nuevo_nombre,apellido = :nuevo_apellido,
                    id_rol = :nuevo_rol, clave = :nueva_clave_hasheada
                    WHERE id_usuario = :id_usuario";

            $resultado = $bd->prepare($sql);

            $resultado->bindParam(':nuevo_email', $nuevo_email);
            $resultado->bindParam(':nuevo_nombre', $nuevo_nombre);
            $resultado->bindParam(':nuevo_apellido', $nuevo_apellido);
            $resultado->bindParam(':nuevo_rol', $nuevo_rol);
            $resultado->bindParam(':nueva_clave_hasheada', $nueva_clave_hasheada);
            $resultado->bindParam(':id_usuario', $id_usuario);
        }
        
        return $resultado->execute();
    }

    public function buscarUsuario($bd,$email){
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':email', $email);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerUsuario($bd){
        $sql = "SELECT id_usuario, email, nombre, apellido, id_rol FROM usuario"; 
        $resultado = $bd->prepare($sql);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function eliminarUsuario($bd,$id_usuario){
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