<?php
include_once __DIR__ . '/../DataBase.php';
include_once __DIR__ . '/../Clases/Rol.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['eliminar'])) {
        $id_rol = $_POST['eliminar'];
        Rol::eliminarRol($bd, $id_rol);
    }

    if (isset($_POST['editar_guardar'])) {
        $id_rol = $_POST['id_rol'];
        $nuevo_nombre = $_POST['nuevo_nombre'];
        Rol::editarRol($bd, $id_rol, $nuevo_nombre);
    }

    if (isset($_POST['crear_guardar'])) {
        $nuevo_rol = $_POST['nuevo_rol'];
        $rol = new Rol($nuevo_rol);
        $rol->subirRol($bd);
    }
}

$roles = Rol::obtenerRol($bd);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
    <link rel="stylesheet" href="../CSS/rol.css">
    <link rel="stylesheet" href="../CSS/editarRol.css">
</head>
<body>
    <div class="contenedor-general">
        <nav class="barra-lateral"> 
            <h2>Menú</h2>
            <ul>
                <li><a href="../Vistas/paginaInicio.php">Inicio</a></li>
                <li><a href="../Vistas/crudProducto.php">Productos</a></li>
                <li><a href="../Vistas/crudMarca.php">Marcas</a></li>
                <li><a href="../Vistas/crudCategoria.php">Categorías</a></li>
                <li><a href="../Vistas/crudRol.php">Roles</a></li>
                <li><a href="../Vistas/crudUsuario.php">Usuarios</a></li>
                <li><a href="../Vistas/crudProveedor.php">Proveedores</a></li>
                <li><a href="../Vistas/historialMovimientos.php">Historial de Movimientos</a></li>
                <li><a href="../Vistas/registroStock.php">Stock de productos</a></li>
                <li><a href="../Vistas/registroEntrada.php">Entradas</a></li>
                <li><a href="../Vistas/registroSalida.php">Salidas</a></li>
            </ul>
            <a href="../index.php" class="cerrar-btn">Cerrar sesión</a>
        </nav>

        <div class="contenido-principal">
            <h1>Roles</h1>
            <div id="contenido">
                <div class="contenedor-acciones">
                    <div class="acciones">
                        <div class="accion-box">
                            <button type="button" class="crear" onclick="abrirVentanaCrear()">Agregar Rol</button>
                        </div>
                    </div>
                </div>
       
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                    <?php
                    if ($roles) {
                        foreach ($roles as $r) {
                            echo '<form action="crudRol.php" method="post">
                                    <tr>
                                        <td>' . $r["id_rol"] . '</td>
                                        <td>' . $r["nombre"] . '</td>
                                        <td>
                                            <button name="eliminar" type="submit" value="' . $r["id_rol"] . '" class="eliminar">Eliminar</button>
                                        </td>
                                        <td>
                                            <button type="button" data-id="' . $r["id_rol"] . '" data-nombre="' . $r["nombre"] . '" 
                                                class="editar" onclick="abrirVentana(this)">Editar</button>
                                        </td>
                                    </tr>
                                </form>';
                        }
                    } else {
                        echo '<p>No hay roles registrados</p>';
                    }
                    ?>
                </table>
            </div>
        </div>

        <div id="ventanaEditar" class="ventana">
            <div class="ventana_contenido">
                <h2>Editar Rol</h2>
                <form method="post" action="crudRol.php">
                    <input type="hidden" name="id_rol" id="id_rol">
                    <input type="text" name="nuevo_nombre" id="nuevo_nombre" placeholder="Nuevo nombre">
                    <button type="submit" name="editar_guardar">Guardar</button>
                    <button type="button" name="cancelar"  onclick="cerrarVentana()">Cancelar</button>
                </form>
            </div>
        </div>

        <div id="ventanaCrear" class="ventana">
            <div class="ventana_contenido">
                <h2>Crear Rol</h2>
                <form method="post" action="crudRol.php">
                    <input type="text" name="nuevo_rol" id="nuevo_rol" placeholder="Nuevo rol">
                    <button type="submit" name="crear_guardar">Guardar</button>
                    <button type="button" name="cancelar"  onclick="cerrarVentanaCrear()">Cancelar</button>
                </form>
            </div>
        </div>
    </div>

<script src="../JS/editarRol.js"></script>
</body>
</html>
