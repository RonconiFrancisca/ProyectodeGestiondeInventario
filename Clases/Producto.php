<?php

class Producto {
    public int $codigo;
    public string $nombre;
    public string $descripcion;
    public float $precio;
    public ?int $id_marca;
    public ?int $id_categoria;
    public ?int $id_proveedor;

    public function __construct($codigo, $nombre, $descripcion, $precio, $id_marca = null, $id_categoria = null, $id_proveedor = null) {
        $this->codigo = (int)$codigo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = (float)$precio;
        $this->id_marca = $id_marca !== null ? (int)$id_marca : null;
        $this->id_categoria = $id_categoria !== null ? (int)$id_categoria : null;
        $this->id_proveedor = $id_proveedor !== null ? (int)$id_proveedor : null; 
    }

    public static function subirProducto($bd, $codigo, $nombre, $descripcion, $precio, $id_marca, $id_categoria, $id_proveedor) { // Nuevo parámetro
        $sql = "INSERT INTO producto (codigo, nombre, descripcion, precio, id_marca, id_categoria, id_proveedor)
                VALUES (:codigo, :nombre, :descripcion, :precio, :id_marca, :id_categoria, :id_proveedor)"; // Nuevo placeholder
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":id_marca", $id_marca, PDO::PARAM_INT);
        $stmt->bindParam(":id_categoria", $id_categoria, PDO::PARAM_INT);
        $stmt->bindParam(":id_proveedor", $id_proveedor, PDO::PARAM_INT);
        $stmt->execute();
    }

    public static function editarProducto($bd, $id_producto, $codigo_nuevo, $nombre_nuevo, $descripcion_nuevo, $precio_nuevo, $id_marca_nueva, $id_categoria_nueva, $id_proveedor_nuevo) { // Nuevo parámetro
        $sql = "UPDATE producto 
                SET codigo = :codigo, nombre = :nombre, descripcion = :descripcion, 
                    precio = :precio, id_marca = :id_marca, id_categoria = :id_categoria, id_proveedor = :id_proveedor 
                WHERE id_producto = :id_producto";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':codigo', $codigo_nuevo, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre_nuevo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion_nuevo, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio_nuevo);
        $stmt->bindParam(':id_marca', $id_marca_nueva, PDO::PARAM_INT);
        $stmt->bindParam(':id_categoria', $id_categoria_nueva, PDO::PARAM_INT);
        $stmt->bindParam(':id_proveedor', $id_proveedor_nuevo, PDO::PARAM_INT); 
        $stmt->execute();
    }

    public static function obtenerProducto($bd) {
        $sql = "SELECT * FROM producto";
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerProductosConProveedor($bd) {
        $sql = "SELECT p.codigo, p.nombre, m.nombre AS marca_nombre, prov.nombre AS proveedor_nombre
                FROM producto p
                LEFT JOIN marca m ON p.id_marca = m.id_marca
                LEFT JOIN proveedor prov ON p.id_proveedor = prov.id_proveedor
                ORDER BY p.codigo";
        $stmt = $bd->query($sql);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public static function obtenerProductosConDetalles($bd) {
        $sql = "SELECT p.*,  m.nombre AS marca_nombre, c.nombre AS categoria_nombre 
                FROM producto p
                LEFT JOIN marca m ON p.id_marca = m.id_marca
                LEFT JOIN categoria c ON p.id_categoria = c.id_categoria";
        $stmt = $bd->query($sql);
        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public static function buscarProducto($bd, $id_producto) {
        $sql = "SELECT * FROM producto WHERE id_producto = :id_producto";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function eliminarProducto($bd, $id_producto) {
        $sql = "DELETE FROM producto WHERE id_producto = :id_producto";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();

        
        $bd->exec("SET @count = 0");
        $bd->exec("UPDATE producto SET id_producto = @count := @count + 1");
        $bd->exec("ALTER TABLE producto AUTO_INCREMENT = 1");
    }

    public static function verificarProducto($bd, $codigo) {
        $sql = "SELECT * FROM producto WHERE codigo = :codigo";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
