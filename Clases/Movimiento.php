<?php

class Movimiento{
    public int $id_producto;
    public  int $cantidad;
    public bool $ingreso;
     public int $id_usuario;
    public int $id_proveedor;

    public function __construct($cantidad, $ingreso){  
        $this->cantidad = $cantidad;
        $this->ingreso = $ingreso;
    }

    public function subirMovimiento($bd) {
        $consulta_subir="INSERT INTO movimiento (cantidad, ingreso)
        VALUES (:cantidad, :ingreso)";
        $subir_movimiento=$bd->prepare($consulta_subir); 
        $subir_movimiento->bindParam(":cantidad", $this->cantidad, PDO::PARAM_INT);
        $subir_movimiento->bindParam(":ingreso", $this->ingreso);
        $subir_movimiento->execute();
    }

    public function eliminarmovimiento($bd,$id_movimiento){
        $sql = "DELETE FROM movimiento WHERE  id_movimiento= :id_movimiento";
        $resultado = $bd->prepare($sql);
        $resultado->bindParam(':id_movimiento', $id_movimiento);
        $resultado->execute();
    }
}
?>
