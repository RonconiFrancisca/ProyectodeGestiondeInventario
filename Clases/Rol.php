<?php

class Rol{
    public ?string $nombre ;

    public function __construct($nombre = null){
        $this->nombre = $nombre;
    }

    public function subirRol($bd) {
        $sql= "INSERT INTO rol (nombre) VALUES (:nombre)";
        $subir_rol=$bd->prepare($sql);
        $subir_rol->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
        $subir_rol->execute();
    }

    public function buscarRol($bd,$id_rol){
        $sql = "SELECT * FROM rol WHERE id_rol = :id_rol";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_rol', $id_rol);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerRol($bd){
        $sql = "SELECT * FROM rol";
        $resultado = $bd->prepare($sql);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarRol($bd) {
        $sql = "UPDATE rol SET nombre = :nombre WHERE id_rol = :id_rol";
        
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':nombre', $this->nombre);
        $resultado->bindParam(':id_rol', $this->id_rol);
        
        $resultado->execute();
    }

    public static function eliminarRol($bd, $id_rol){
        $sql = "DELETE FROM rol WHERE  id_rol = :id_rol";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_rol', $id_rol);
        $resultado->execute();   
    
        $bd->exec("SET @count = 0");
        $bd->exec("UPDATE rol SET id_rol = @count := @count + 1");
        $bd->exec("ALTER TABLE rol AUTO_INCREMENT = 1");

    }

    public function verificarRol($bd){
        $sql = "SELECT * FROM rol WHERE nombre = :nombre";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':nombre', $this->nombre);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }
}
?>
