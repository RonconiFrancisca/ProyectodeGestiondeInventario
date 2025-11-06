<?php

class Proveedor{
    public string $nombre;
    protected int $telefono;
    public string $direccion;
    protected int $cuit;


    public function __construct($nombre, $telefono, $direccion, $cuit){
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->cuit = $cuit;

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

    public function editarTelefonoProveedor($bd){
        $sql = "UPDATE proveedor SET telefono=:telefono WHERE cuit=:cuit";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':cuit', $cuit);
        $resultado->bindParam(':telefono', $telefono);
        $resultado->execute();
    }

    public function editarDireccionProveedor($bd){
        $sql = "UPDATE proveedor SET direccion=:direccion  WHERE cuit=:cuit";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':cuit', $cuit);
        $resultado->bindParam(':direccion', $direccion);
        return $resultado->execute();
    }

    public static function eliminarProveedor($bd,$id_proveedor){
        $sql = "DELETE FROM proveedor WHERE id_proveedor = :id_proveedor";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_proveedor', $id_proveedor);
        return $resultado->execute();
    }
    
}
?>
