<?php
include_once __DIR__ . '/../DataBase.php';
include_once __DIR__ . '/../Clases/Categoria.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['eliminar'])) {
        $id_categoria = $_POST['eliminar'];
        Categoria::eliminarCategoria($bd, $id_categoria);
    }

    if (isset($_POST['editar_guardar'])) {
        $id_categoria = $_POST['id_categoria'];
        $nuevo_nombre = $_POST['nuevo_nombre'];
        Categoria::editarCategoria($bd, $id_categoria, $nuevo_nombre);
    }

    if (isset($_POST['crear_guardar'])) {
        $categoria = new Categoria($_POST['nueva_categoria']);
        $categoria->subirCategoria($bd);
    }
}

$categorias = Categoria::obtenerCategoria($bd);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="stylesheet" href="../CSS/categoria.css">
    <link rel="stylesheet" href="../CSS/editarCategoria.css">
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
            <h1>Categorías</h1>
            <div id="contenido">
                <div class="contenedor-acciones">
                    <div class="acciones">
                        <div class="accion-box">
                            <button type="button" class="crear" onclick="abrirVentanaCrear()">Agregar Categoría</button>
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
                    if ($categorias) {
                        foreach ($categorias as $c) {
                            echo '
                                    <tr>
                                        <td>' . $c["id_categoria"] . '</td>
                                        <td>' . $c["nombre"] . '</td>
                                        <td><form action="crudCategoria.php" method="post">
                                            <button name="eliminar" type="submit" value="' . $c["id_categoria"] . '" class="eliminar">Eliminar</button>
                                        </form></td>
                                        <td>
                                            <button type="button" data-id="' . $c["id_categoria"] . '" data-nombre="' . $c["nombre"] . '" 
                                                class="editar" onclick="abrirVentana(this)">Editar</button>
                                        </td>
                                    </tr>
                                ';
                        }
                    } else {
                        echo '<p>No hay categorías registradas</p>';
                    }
                    ?>
                </table>
            </div>
        </div>

        <div id="ventanaEditar" class="ventana">
            <div class="ventana_contenido">
                <h2>Editar Categoría</h2>
                <form method="post" action="crudCategoria.php">
                    <input type="hidden" name="id_categoria" id="id_categoria">
                    <input type="text" name="nuevo_nombre" id="nuevo_nombre" placeholder="Nuevo nombre">
                    <button type="submit" name="editar_guardar">Guardar</button>
                    <button type="button" name="cancelar"  onclick="cerrarVentana()">Cancelar</button>
                </form>
            </div>
        </div>

        <div id="ventanaCrear" class="ventana">
            <div class="ventana_contenido">
                <h2>Crear Categoría</h2>
                <form method="post" action="crudCategoria.php">
                    <input type="text" name="nueva_categoria" id="nueva_categoria" placeholder="Nueva categoría">
                    <button type="submit" name="crear_guardar">Guardar</button>
                    <button type="button" name="cancelar"  onclick="cerrarVentanaCrear()">Cancelar</button>
                </form>
            </div>
        </div>

    </div>

    <script src="../JS/editarCategoria.js"></script>
</body>
</html>
