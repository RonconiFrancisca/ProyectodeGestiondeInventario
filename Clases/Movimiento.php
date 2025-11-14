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

public static function subirMovimiento($bd, $codigo_producto, $cantidad, $ingreso) {
    $stmt = $bd->prepare("SELECT id_producto FROM producto WHERE codigo = :codigo");
    $stmt->bindParam(":codigo", $codigo_producto);
    $stmt->execute();
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        return "El producto no existe"; 
    }

    $id_producto = $producto["id_producto"];

    $ingreso_int = $ingreso ? 1 : 0;

    $sql = "INSERT INTO movimiento (id_producto, cantidad, ingreso, fecha)
            VALUES (:id_producto, :cantidad, :ingreso, NOW())";

    $stmt = $bd->prepare($sql);
    $stmt->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
    $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
    $stmt->bindParam(":ingreso", $ingreso_int, PDO::PARAM_INT);
    $stmt->execute();

    include_once __DIR__ . '/Stock.php';
    $stock = new Stock($id_producto, $cantidad);

    if ($ingreso_int === 1) {
        $stock->registrarEntrada($bd);
    } else {
        $stock->registrarSalida($bd);
    }
}



    public static function eliminarMovimiento($bd, $id_movimiento) {
        $sql = "DELETE FROM movimiento WHERE id_movimiento = :id_movimiento";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id_movimiento', $id_movimiento);
        $stmt->execute();
    }

   public static function obtenerMovimientos($bd) {
        $sql = "SELECT  m.id_movimiento, m.cantidad, m.ingreso, m.fecha, p.codigo, p.nombre 
                AS nombre_producto,p.precio,(p.precio * m.cantidad) AS total
                FROM movimiento m
                JOIN producto p ON m.id_producto = p.id_producto
                ORDER BY m.fecha DESC";
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function obtenerMovimientosPorTipo($bd, $ingreso) {
        $sql = "SELECT m.id_movimiento, p.codigo, p.nombre AS nombre_producto, 
                       m.cantidad, m.fecha
                FROM movimiento m
                INNER JOIN producto p ON m.id_producto = p.id_producto
                WHERE m.ingreso = :ingreso
                ORDER BY m.fecha DESC";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':ingreso', $ingreso, PDO::PARAM_BOOL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
