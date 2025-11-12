<?php

class Producto{
    public int $codigo;
    public string $nombre;
    public string $descripcion;
    public float $precio;
    public ?int $id_marca;
    public ?int $id_categoria;


    public function __construct($codigo, $nombre, $descripcion, $precio, $id_marca = null, $id_categoria = null) {
    $this->codigo = (int)$codigo;
    $this->nombre = $nombre;
    $this->descripcion = $descripcion;
    $this->precio = (float)$precio;
    $this->id_marca = $id_marca !== null ? (int)$id_marca : null;
    $this->id_categoria = $id_categoria !== null ? (int)$id_categoria : null;
}



    public function subirProducto($bd) {
    $consulta_subir = "INSERT INTO producto (codigo, nombre, descripcion, precio, id_marca, id_categoria)
                       VALUES (:codigo, :nombre, :descripcion, :precio, :id_marca, :id_categoria)";
    $subir_producto = $bd->prepare($consulta_subir);
    $subir_producto->bindParam(":codigo", $this->codigo, PDO::PARAM_INT);
    $subir_producto->bindParam(":nombre", $this->nombre, PDO::PARAM_STR);
    $subir_producto->bindParam(":descripcion", $this->descripcion, PDO::PARAM_STR);
    $subir_producto->bindParam(":precio", $this->precio);
    $subir_producto->bindParam(":id_marca", $this->id_marca, PDO::PARAM_INT);
    $subir_producto->bindParam(":id_categoria", $this->id_categoria, PDO::PARAM_INT);
    $subir_producto->execute();
    }


    public function buscarProducto($bd,$id_producto){
        $sql = "SELECT * FROM producto WHERE id_producto = :id_producto";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_producto', $id_producto);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerProducto($bd){
        $sql = "SELECT * FROM producto";
        $resultado = $bd->prepare($sql);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarProducto($bd) {
        $sql = "UPDATE producto SET nombre = :nombre, descripcion = :descripcion, precio = :precio WHERE codigo = :codigo";
        
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':codigo', $this->codigo);
        $resultado->bindParam(':nombre', $this->nombre);
        $resultado->bindParam(':descripcion', $this->descripcion);
        $resultado->bindParam(':precio', $this->precio);
        $resultado->execute();
    }
    
    public static function eliminarProducto($bd, $id_producto) {
        $sql = "DELETE FROM producto WHERE id_producto = :id_producto";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $resultado->execute();

        $bd->exec("SET @count = 0");
        $bd->exec("UPDATE producto SET id_producto = @count := @count + 1");
        $bd->exec("ALTER TABLE producto AUTO_INCREMENT = 1");
        
    }

    public function verificarProducto($bd){
        $sql = "SELECT * FROM producto WHERE codigo = :codigo";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':codigo', $this->codigo);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_ASSOC);
    }
}
?>
