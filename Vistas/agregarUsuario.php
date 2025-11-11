<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Usuario.php';
include_once __DIR__.'/../Clases/Rol.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="../CSS/sistema.css">
</head>
<body>
    <div class="acciones">
    <div class="accion-box">
        <div class="volverinicio"><a href="../inicio/paginaInicio.php">Volver a Inicio</a></div>
    </div></div> 

    <div class="main-container">
    <div class="form-box">
        <h2>Agregar Usuario</h2>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST['email'];
                $clave = $_POST['clave'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $id_rol = $_POST['id_rol'];

                $usuario = new Usuario($email, $clave, $nombre, $apellido);
                $existe = $usuario->verificarUsuario($bd);

                if ($existe) {
                    echo "El email ya está registrado. Intenta con otro.";
                } else {
                    $usuario->subirUsuario($bd, $id_rol);
                    echo "Usuario agregado con éxito.";
                }
            }

            $rol = new Rol();
            $roles = $rol->obtenerRol($bd);
        ?>
        <form action="agregarUsuario.php" method="post">
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="apellido">Apellido:</label><br>
            <input type="text" id="apellido" name="apellido" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="clave">Clave:</label><br>
            <input type="password" id="clave" name="clave" required><br><br>

            <label for="rol">Rol:</label><br>
            
            <select id="rol" name="id_rol" required>
                <option disabled selected>Seleccione un rol</option>
                <?php
                        if ($roles) {
                            foreach ($roles as $r) {
                                echo '<option value="'.$r["id_rol"].'">'.$r["nombre"].'</option>';
                            }
                        }else {
                            echo '<option disabled>No hay roles registrados</option>';
                        }
                ?>
            </select><br><br>
                <input type="submit" value="Agregar">
        </form>

    </div></div>
</body>
</html>
