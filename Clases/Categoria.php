<?php

class Categoria{
    public ?string $nombre;

    public function __construct($nombre = null){
        $this->nombre = $nombre;
    }

    public function subirCategoria($bd) {
        $sql="INSERT INTO categoria (nombre) VALUES (:nombre)";
        $resultado=$bd->prepare($sql);
        $resultado->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
        $resultado->execute();
    }

    public function buscarCategoria($bd,$id_categoria){
        $sql = "SELECT * FROM categoria WHERE id_categoria = :id_categoria";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_categoria', $id_categoria);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerCategoria($bd){
        $sql = "SELECT * FROM categoria";
        $resultado = $bd->prepare($sql);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function editarCategoria($bd,$id_categoria,$nombre_nuevo) {
        $sql = "UPDATE categoria SET nombre = :nombre WHERE id_categoria = :id_categoria";
        
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':nombre', $nombre_nuevo);
        $resultado->bindParam(':id_categoria', $id_categoria);
        
        $resultado->execute();
    }


    public static function eliminarCategoria($bd,$id_categoria){
        $sql = "DELETE FROM categoria WHERE id_categoria=:id_categoria";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_categoria', $id_categoria);
        $resultado->execute();   

        $bd->exec("SET @count = 0");
        $bd->exec("UPDATE categoria SET id_categoria = @count := @count + 1");
        $bd->exec("ALTER TABLE categoria AUTO_INCREMENT = 1");
    }
    
    public function verificarCategoria($bd){
        $sql = "SELECT * FROM categoria WHERE nombre = :nombre";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':nombre', $this->nombre);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

}

?>