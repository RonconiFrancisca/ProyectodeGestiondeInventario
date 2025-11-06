<?php

class Marca{
    public string $nombre ;

    public function __construct($nombre){
        $this->nombre = $nombre;
    }

    public function subirMarca($bd) {
        $sql= "INSERT INTO marca (nombre) VALUES (:nombre)";
        $resultado= $bd->prepare($sql);
        $resultado->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
        $resultado->execute();
    }

    public function buscarMarca($bd,$id_marca){
        $sql = "SELECT * FROM marca WHERE id_marca = :id_marca";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_marca', $id_marca);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerMarca($bd){
        $sql = "SELECT * FROM marca";
        $resultado = $bd->prepare($sql);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function eliminarMarca($bd, $id_marca){
        $sql = "DELETE FROM marca WHERE  id_marca = :id_marca";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_marca', $id_marca);
        $resultado->execute();    
    }
}
?>
