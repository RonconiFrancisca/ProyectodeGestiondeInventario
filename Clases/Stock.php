<?php

class Stock{
    public int $cantidad;

    public function __construct($cantidad){
        $this->cantidad = $cantidad;
    }

    public function subirStock($bd) {
        $consulta_subir= "INSERT INTO stock (cantidad) VALUES (:cantidad)";
        $subir_stock=$bd->prepare($consulta_subir);
        $subir_stock->bindParam(":cantidad", $this->cantidad, PDO::PARAM_INT);
        $subir_stock->execute();
    }

    public function cambiarStock($bd,$id_stock){
        $sql = "UPDATE stock SET cantidad = :cantidad WHERE id_stock = :id_stock";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_stock', $id_stock);
        $resultado->bindParam(':cantidad', $cantidad_nueva);
        $resultado->execute();

    }

    public function eliminarStock($bd,$id_stock){
        $sql = "DELETE FROM stock WHERE id_stock = :id_stock";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_stock', $id_stock);
        $resultado->execute();
    }

}
?>
