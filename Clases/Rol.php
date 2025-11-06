<?php

class Rol{
    public string $nombre ;

    public function __construct($nombre){
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

    public static function eliminarRol($bd, $id_rol){
        $sql = "DELETE FROM rol WHERE  id_rol = :id_rol";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_rol', $id_rol);
        $resultado->execute();    
    }

}
?>
