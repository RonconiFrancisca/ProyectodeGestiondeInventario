<?php
session_start();
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Stock.php';
include_once __DIR__.'/../Clases/Movimiento.php';

// Verificar sesión iniciada
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login/login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
$id_usuario = $usuario['id'];
$nombre_completo = $usuario['nombre'] . ' ' . $usuario['apellido'];

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_producto = $_POST['codigo_producto'];
    $cantidad = $_POST['cantidad'];

    $id_proveedor = null;

    if ($codigo_producto && $cantidad) {
        $salida = new Stock($codigo_producto, $cantidad);
        $salida->registrarSalida($bd); 

        $movimiento = new Movimiento($codigo_producto, $cantidad, false, $id_usuario, $id_proveedor);
        $movimiento->subirMovimiento($bd);

        $mensaje = "Salida registrada correctamente por el usuario: " . $nombre_completo;
    } else {
        $mensaje = "<span style='color:red;'>Error: Debes completar todos los campos.</span>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Salida</title>
    <link rel="stylesheet" href="../CSS/sistema.css">
</head>
<body>
<div class="volverinicio"><a href="../inicio/paginaInicio.php">Volver a Inicio</a></div>

<div class="main-content">
    <div class="form-box">
        <p>Registrar Salida de Stock</p>

        <?php
        if ($mensaje != '') {
            echo '<p>'.$mensaje.'</p>';
        }
        ?>

        <form action="registroSalida.php" method="post">
            <label for="codigo_producto">Código del Producto:</label><br>
            <input type="text" id="codigo_producto" name="codigo_producto" required><br><br>

            <label for="cantidad">Cantidad a retirar:</label><br>
            <input type="number" id="cantidad" name="cantidad" required><br><br>

            <input type="submit" value="Registrar Salida">
        </form>
    </div>
</div>
</body>
</html>
