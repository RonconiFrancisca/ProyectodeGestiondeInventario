<?php
class Movimiento {
    public int $id_producto;
    public int $cantidad;
    public bool $ingreso;
    public int $id_usuario;
    public ?int $id_proveedor;

    public function __construct($id_producto, $cantidad, $ingreso, $id_usuario, $id_proveedor = null) {
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
        $this->ingreso = $ingreso;
        $this->id_usuario = $id_usuario;
        $this->id_proveedor = $id_proveedor;
    }

    public function subirMovimiento($bd) {
        $consulta = "INSERT INTO movimiento (id_producto, cantidad, ingreso, id_usuario, id_proveedor, fecha)
                     VALUES (:id_producto, :cantidad, :ingreso, :id_usuario, :id_proveedor, NOW())";
        $stmt = $bd->prepare($consulta);
        $stmt->bindParam(":id_producto", $this->id_producto, PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $this->cantidad, PDO::PARAM_INT);
        $stmt->bindParam(":ingreso", $this->ingreso, PDO::PARAM_BOOL);
        $stmt->bindParam(":id_usuario", $this->id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(":id_proveedor", $this->id_proveedor, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function eliminarMovimiento($bd, $id_movimiento) {
        $sql = "DELETE FROM movimiento WHERE id_movimiento = :id_movimiento";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id_movimiento', $id_movimiento);
        $stmt->execute();
    }
    
    public static function obtenerMovimientos($bd) {
        $sql = "SELECT m.id_movimiento, p.id_producto, p.nombre AS nombre_producto,
                u.nombre AS nombre_usuario, m.cantidad, m.ingreso, m.fecha
            FROM movimiento m
            INNER JOIN producto p ON m.id_producto = p.id_producto
            INNER JOIN usuario u ON m.id_usuario = u.id_usuario
            ORDER BY m.fecha DESC";

    $stmt = $bd->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>
