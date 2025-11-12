<?php

class Marca{
    public ?string $nombre ;

    public function __construct($nombre = null){
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

    public function editarMarca($bd) {
        $sql = "UPDATE marca SET nombre = :nombre WHERE id_marca = :id_marca";
        
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':nombre', $this->nombre);
        $resultado->bindParam(':id_marca', $this->id_marca);
        
        $resultado->execute();
    }


    public static function eliminarMarca($bd, $id_marca){
        $sql = "DELETE FROM marca WHERE  id_marca = :id_marca";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_marca', $id_marca);
        $resultado->execute();  
        
        $bd->exec("SET @count = 0");
        $bd->exec("UPDATE marca SET id_marca = @count := @count + 1");
        $bd->exec("ALTER TABLE marca AUTO_INCREMENT = 1");
        
    }

    public function verificarMarca($bd){
        $sql = "SELECT * FROM marca WHERE nombre = :nombre";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':nombre', $this->nombre);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }
}
?>
