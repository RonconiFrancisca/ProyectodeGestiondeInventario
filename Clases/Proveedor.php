<?php

class Proveedor {

    public string $nombre;
    protected string $telefono;
    public string $direccion;
    protected ?int $cuit;

    public function __construct($nombre, $telefono, $direccion, $cuit = null) {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->cuit = $cuit !== null ? (int)$cuit : null;
    }

    public static function subirProveedor($bd, $nuevo_nombre, $nuevo_telefono, $nueva_direccion, $nuevo_cuit) {

        $sql = "INSERT INTO proveedor (nombre, telefono, direccion, cuit)
                VALUES (:nombre, :telefono, :direccion, :cuit)";

        $query = $bd->prepare($sql);

        $query->bindParam(":nombre", $nuevo_nombre, PDO::PARAM_STR);
        $query->bindParam(":telefono", $nuevo_telefono, PDO::PARAM_STR);
        $query->bindParam(":direccion", $nueva_direccion, PDO::PARAM_STR);
        $query->bindParam(":cuit", $nuevo_cuit, PDO::PARAM_STR);

        return $query->execute(); 
    }

    public function buscarProveedor($bd, $id_proveedor) {
        $sql = "SELECT * FROM proveedor WHERE id_proveedor = :id_proveedor";
        $query = $bd->prepare($sql);
        $query->bindParam(':id_proveedor', $id_proveedor);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerProveedor($bd) {
        $sql = "SELECT * FROM proveedor";
        $query = $bd->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function editarProveedor($bd, $id_proveedor, $nombre_nuevo, $telefono_nuevo, $direccion_nueva) {

        $sql = "UPDATE proveedor 
                SET nombre = :nombre,
                    telefono = :telefono,
                    direccion = :direccion
                WHERE id_proveedor = :id_proveedor";

        $query = $bd->prepare($sql);

        $query->bindParam(':nombre', $nombre_nuevo);
        $query->bindParam(':telefono', $telefono_nuevo);
        $query->bindParam(':direccion', $direccion_nueva);
        $query->bindParam(':id_proveedor', $id_proveedor);

        return $query->execute();
    }

    public static function eliminarProveedor($bd, $id_proveedor) {
        $sql = "DELETE FROM proveedor WHERE id_proveedor = :id_proveedor";
        $query = $bd->prepare($sql);
        $query->bindParam(':id_proveedor', $id_proveedor);
        return $query->execute();
    }

    public function verificarProveedor($bd) {
        $sql = "SELECT * FROM proveedor WHERE nombre = :nombre";
        $query = $bd->prepare($sql);
        $query->bindParam(':nombre', $this->nombre);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>
