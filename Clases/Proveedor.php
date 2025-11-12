<?php

class Proveedor{
    public string $nombre;
    protected int $telefono;
    public string $direccion;
    protected ?int $cuit;


    public function __construct($nombre, $telefono, $direccion, $cuit = null){
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->cuit = $cuit !== null ? (int)$cuit : null;;

    }

    public function subirProveedor($bd) {
        $consulta_subir= "INSERT INTO proveedor (nombre, telefono, direccion, cuit)
        VALUES (:nombre, :telefono, :direccion, :cuit)";
        $subir_producto =$bd->prepare($consulta_subir);
        $subir_producto->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
        $subir_producto->bindParam(":telefono", $this->telefono, PDO::PARAM_STR);
        $subir_producto->bindParam(":direccion", $this->direccion, PDO::PARAM_STR);
        $subir_producto->bindParam(":cuit", $this->cuit, PDO::PARAM_STR);
        $subir_producto->execute();
    }

    public function buscarProveedor($bd,$id_proveedor){
        $sql = "SELECT * FROM proveedor WHERE id_proveedor = :id_proveedor";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_proveedor', $id_proveedor);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerProveedor($bd){
        $sql = "SELECT * FROM proveedor";
        $resultado = $bd->prepare($sql);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarProveedor($bd) {
        $sql = "UPDATE proveedor SET nombre = :nombre, cuit = :cuit, direccion = :direccion, 
                    telefono = :telefono WHERE id_proveedor = :id_proveedor";
        
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':nombre', $this->nombre); 
        $resultado->bindParam(':telefono', $this->telefono);
        $resultado->bindParam(':direccion', $this->direccion);
        $resultado->bindParam(':cuit', $this->cuit); 
        $resultado->bindParam(':id_proveedor', $this->id_proveedor);    
        $resultado->execute();
    }

    public static function eliminarProveedor($bd,$id_proveedor){
        $sql = "DELETE FROM proveedor WHERE id_proveedor = :id_proveedor";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_proveedor', $id_proveedor);
        return $resultado->execute();

        $bd->exec("SET @count = 0");
        $bd->exec("UPDATE proveedor SET id_proveedor = @count := @count + 1");
        $bd->exec("ALTER TABLE proveedor AUTO_INCREMENT = 1");

    }
    
    public function verificarProveedor($bd){
        $sql = "SELECT * FROM proveedor WHERE nombre = :nombre";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':nombre', $this->nombre);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }
}
?>
