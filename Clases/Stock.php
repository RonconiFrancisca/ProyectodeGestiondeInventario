<?php
class Stock {
    public int $id_producto;
    public int $cantidad;

    public function __construct($id_producto, $cantidad) {
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
    }

    private static function existeStock($bd, $id_producto) {
        $sql = "SELECT COUNT(*) FROM stock WHERE id_producto = :id_producto";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function registrarEntrada($bd) {
        if (self::existeStock($bd, $this->id_producto)) {
            $sql = "UPDATE stock SET cantidad = cantidad + :cantidad 
                    WHERE id_producto = :id_producto";
        } else {
            $sql = "INSERT INTO stock (id_producto, cantidad) 
                    VALUES (:id_producto, :cantidad)";
        }

        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function registrarSalida($bd) {
        if (self::existeStock($bd, $this->id_producto)) {
            $sql = "UPDATE stock SET cantidad = cantidad - :cantidad 
                    WHERE id_producto = :id_producto";
        } else {
            $sql = "INSERT INTO stock (id_producto, cantidad) 
                    VALUES (:id_producto, -:cantidad)";
        }

        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id_producto', $this->id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $this->cantidad, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function obtenerStockActual($bd) {
        $sql = "SELECT p.id_producto,p.codigo, p.nombre AS nombre_producto,
                    COALESCE(
                        (SELECT s.cantidad 
                        FROM stock s 
                        WHERE s.id_producto = p.id_producto 
                        ORDER BY s.id_stock DESC 
                        LIMIT 1),
                    0) AS cantidad
                FROM producto p
                ORDER BY p.codigo";
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
