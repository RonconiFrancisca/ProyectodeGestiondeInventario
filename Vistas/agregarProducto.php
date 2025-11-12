<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Producto.php';
include_once __DIR__.'/../Clases/Marca.php';
include_once __DIR__.'/../Clases/Categoria.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="../CSS/sistema.css">
</head>
<body>
    <div class="acciones">
    <div class="accion-box">
        <div class="volverinicio"><a href="../Vistas/paginaInicio.php">Volver a Inicio</a></div>
    </div></div> 

    <div class="main-content">
    <div class="form-box">
        <h2>Agregar Producto</h2>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $codigo = $_POST['codigo'] ?? null;
                $nombre = $_POST['nombre'] ?? null;
                $descripcion = $_POST['descripcion'] ?? null;
                $precio = $_POST['precio'] ?? null;
                $id_marca = $_POST['id_marca'] ?? null;
                $id_categoria = $_POST['id_categoria'] ?? null;

                if ($codigo && $nombre && $descripcion && $precio && $id_marca && $id_categoria) {
                    $producto = new Producto($codigo, $nombre, $descripcion, (float)$precio, (int)$id_marca, (int)$id_categoria);
                    $producto_existente = $producto->verificarProducto($bd);

                    if ($producto_existente) {
                        echo "<p style='color:red;'>El código ya está registrado. Intenta con otro.</p>";
                    } else {
                        $producto->subirProducto($bd);
                        echo "<p style='color:green;'>Producto agregado con éxito.</p>";
                    }
                } else {
                    echo "<p style='color:red;'>Por favor, complete todos los campos.</p>";
                }
            }

            // Cargar listas de marcas y categorías
            $marca = new Marca();
            $marcas = $marca->obtenerMarca($bd);

            $categoria = new Categoria();
            $categorias = $categoria->obtenerCategoria($bd);
        ?>


        <form action="agregarProducto.php" method="post">
            <label for="codigo">Código:</label><br>
            <input type="text" id="codigo" name="codigo" required><br><br>

            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="descripcion">Descripción:</label><br>
            <input type="text" id="descripcion" name="descripcion" required><br><br>

            <label for="precio">Precio:</label><br>
            <input type="number" id="precio" name="precio" step="0.01" min="0" required><br><br>

            <label for="marca">Marca:</label><br>
            <select id="marca" name="id_marca" required>
                <option disabled selected>Seleccione una marca</option>
                <?php
                    if ($marcas) {
                        foreach ($marcas as $m) {
                            echo '<option value="'.$m["id_marca"].'">'.$m["nombre"].'</option>';
                        }
                    } else {
                        echo '<option disabled>No hay marcas registradas</option>';
                    }
                ?>
            </select><br><br>

            <label for="categoria">Categoría:</label><br>
            <select id="categoria" name="id_categoria" required>
                <option disabled selected>Seleccione una categoría</option>
                <?php
                    if ($categorias) {
                        foreach ($categorias as $c) {
                            echo '<option value="'.$c["id_categoria"].'">'.$c["nombre"].'</option>';
                        }
                    } else {
                        echo '<option disabled>No hay categorías registradas</option>';
                    }
                ?>
            </select><br><br>
            <input type="submit" value="Agregar">
        </form>
    </div></div>


</body>
</html>
