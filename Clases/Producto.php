<?php

class Producto{
    public string $descripcion;
    public int $precio;
    public string $nombre;
    public int $codigo;
    public int $id_marca;
    public int $id_categoria;


    public function __construct($descripcion, $precio, $nombre, $codigo){
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->nombre = $nombre;
        $this->codigo = $codigo;
        
    }

    public function subirProducto($bd) {
        $consulta_subir ="INSERT INTO producto (codigo, descripcion, precio, nombre)
        VALUES (:codigo, :descripcion, :precio, :nombre)";

        $subir_producto =$bd->prepare($consulta_subir);
        $subir_producto->bindparam(":codigo", $this->codigo, PDO:: PARAM_STR);
        $subir_producto->bindparam(":descripcion", $this->descripcion, PDO::PARAM_STR);
        $subir_producto->bindparam(":precio", $this->precio, PDO:: PARAM_STR);
        $subir_producto->bindparam(":nombre", $this->nombre, PDO:: PARAM_STR);
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

    public function editarProducto($bd){
        $sql = "UPDATE producto SET precio=:precio WHERE codigo=:codigo";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':codigo', $codigo);
        $resultado->bindParam(':precio', $precio);
        $resultado->execute();
    }

    public static function eliminarProducto($bd){
        $sql = "DELETE FROM producto WHERE  codigo = :codigo";        
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':codigo', $codigo);
        $resultado->execute();
    }
}
?>
