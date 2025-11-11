<?php
class Stock {
    public int $id_producto;
    public int $cantidad;

    public function __construct($id_producto, $cantidad) {
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
    }

    public function registrarEntrada($bd) {
        $sql = "INSERT INTO stock (id_producto, cantidad) VALUES (:id_producto, :cantidad)";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function registrarSalida($bd) {
        $cantidad_salida = -abs($this->cantidad);
        $sql = "INSERT INTO stock (id_producto, cantidad) VALUES (:id_producto, :cantidad)";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $cantidad_salida, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function obtenerStockActual($bd) {
        $sql = "SELECT 
                    p.id_producto,
                    p.nombre AS nombre_producto,
                    SUM(CASE WHEN m.ingreso = 1 THEN m.cantidad ELSE -m.cantidad END) AS cantidad_actual
                FROM movimiento m
                INNER JOIN producto p ON m.id_producto = p.id_producto
                GROUP BY p.id_producto, p.nombre
                ORDER BY p.id_producto";

        $stmt = $bd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function eliminarStock($bd, $id_stock) {
        $sql = "DELETE FROM stock WHERE id_stock = :id_stock";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id_stock', $id_stock, PDO::PARAM_INT);
        $stmt->execute();
    }
} 
?>
