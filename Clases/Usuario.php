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

    // 🟢 CREAR USUARIO
    public static function subirUsuario($bd, $email, $clave, $nombre, $apellido, $id_rol) {
        try {
            $hash_clave = password_hash($clave, PASSWORD_DEFAULT); 
            $sql = "INSERT INTO usuario (email, clave, nombre, apellido, id_rol)
                    VALUES (:email, :clave, :nombre, :apellido, :id_rol)";

            $resultado = $bd->prepare($sql);
            
            $resultado->bindParam(":email", $email, PDO::PARAM_STR);
            $resultado->bindParam(":clave", $hash_clave);
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindParam(":id_rol", $id_rol, PDO::PARAM_INT);
            
            return $resultado->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // 🔑 VERIFICAR CLAVE
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
    
    // 🔑 CAMBIAR CLAVE
    public static function cambiarClave($bd, $email, $clave_nueva) {
        try {
            $clave_hasheada = password_hash($clave_nueva, PASSWORD_DEFAULT); 
            $sql = "UPDATE usuario SET clave = :clave_hasheada WHERE email = :email"; 
            
            $resultado = $bd->prepare($sql);
            $resultado->bindParam(':clave_hasheada', $clave_hasheada);
            $resultado->bindParam(':email', $email);
            
            return $resultado->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function editarUsuario($bd, $id_usuario, $email_nuevo, $nombre_nuevo, $apellido_nuevo, $id_rol_nuevo, $clave_nueva = null) {
        try {
            $sql = "UPDATE usuario SET 
                    email = :email_nuevo, 
                    nombre = :nombre_nuevo, 
                    apellido = :apellido_nuevo, 
                    id_rol = :id_rol_nuevo";
            
            $params = [
                ':id_usuario' => $id_usuario,
                ':email_nuevo' => $email_nuevo,
                ':nombre_nuevo' => $nombre_nuevo,
                ':apellido_nuevo' => $apellido_nuevo,
                ':id_rol_nuevo' => $id_rol_nuevo
            ];

            if (!empty($clave_nueva)) {
                $clave_hasheada = password_hash($clave_nueva, PASSWORD_DEFAULT);
                $sql .= ", clave = :clave_hasheada";
                $params[':clave_hasheada'] = $clave_hasheada;
            }

            $sql .= " WHERE id_usuario = :id_usuario";

            $stmt = $bd->prepare($sql);
            return $stmt->execute($params);

        } catch (PDOException $e) {
            return false;
        }
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