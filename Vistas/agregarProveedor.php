<?php
include_once __DIR__ . '/../DataBase.php';
include_once __DIR__ . '/../Clases/Proveedor.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proveedor</title>
    <link rel="stylesheet" href="../CSS/sistema.css">
</head>
<body>
    <div class="acciones">
    <div class="accion-box">
        <div class="volverinicio"><a href="../Vistas/paginaInicio.php">Volver a Inicio</a></div>
    </div></div> 

    <div class="main-content">
    <div class="form-box">
        <p>Agregar Proveedor</p>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                $nombre = $_POST['nombre'] ?? '';
                $telefono = $_POST['telefono'] ?? '';
                $direccion = $_POST['direccion'] ?? '';
                $cuit = $_POST['cuit'] ?? null;

                $proveedor = new Proveedor($nombre,$telefono,$direccion,$cuit);
                $proveedor_existente = $proveedor->verificarProveedor($bd);

                if ($proveedor_existente) {
                    echo "El proveedor ya está registrado. Intenta con otro nombre.";
                } else {
                    $proveedor->subirProveedor($bd);
                    echo "Proveedor registrado con éxito.";   
                }
            }
        ?>

        <form action="agregarProveedor.php" method="post">
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono" required><br><br>

            <label for="direccion">Dirección:</label><br>
            <input type="text" id="direccion" name="direccion" required><br><br>

            <label for="cuit">CUIT:</label>
            <input type="number" id="cuit" name="cuit" required>
    
            <input type="submit" value="Agregar">
        </form>
    </div></div>
</body>
</html>
