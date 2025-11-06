<?php

class Categoria{
    public string $nombre;

    public function __construct($nombre){
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
        $sql = "SELECT * FROM categoria" ;
        $resultado = $bd->prepare($sql);
        $resultado->execute();
        return $resultado;
    }

    public static function eliminarCategoria($bd,$id_categoria){
        $sql = "DELETE FROM categoria WHERE id_categoria=:id_categoria";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_categoria', $id_categoria);
        $resultado->execute();   
    }
    

}

?>