<?php
include_once __DIR__.'/../DataBase.php';
include_once __DIR__.'/../Clases/Usuario.php';
include_once __DIR__.'/../Clases/Rol.php'; 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(isset($_POST['eliminar'])){
        $id_usuario = $_POST['eliminar'];
        Usuario::eliminarUsuario($bd, $id_usuario);
    }
    
    if(isset($_POST['editar_guardar'])){
        $id_usuario = $_POST['id_usuario'];
        $email_nuevo = $_POST['email_nuevo'];
        $nombre_nuevo = $_POST['nombre_nuevo'];
        $apellido_nuevo = $_POST['apellido_nuevo'];
        $id_rol_nuevo = $_POST['rol_nuevo'];
        $password_nuevo = $_POST['clave_nueva'] ?? null; 
        
        Usuario::editarUsuario($bd, $email_nuevo,$nombre_nuevo,$apellido_nuevo, $id_rol_nuevo,$password_nuevo,$id_usuario);
        
    }
    
    if(isset($_POST['crear_guardar'])){
        $nuevo_email = $_POST['nuevo_email'];
        $nuevo_nombre = $_POST['nuevo_nombre'];
        $nuevo_apellido = $_POST['nuevo_apellido'];
        $nuevo_rol = $_POST['nuevo_rol'];
        $clave_nueva = $_POST['clave_nueva'] ?? '';
        Usuario::subirUsuario($bd, $nuevo_email,$nuevo_nombre, $nuevo_apellido, $nuevo_rol,$clave_nueva);
    }
}

$roles = Rol::obtenerRol($bd); 
$usuario = Usuario::obtenerUsuario($bd); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../CSS/usuario.css">
</head>
<body>
    <div class="contenedor-general">
        <nav class="barra-lateral">
            <h2>Menú</h2>
            <ul>
                <li><a href="../Vistas/paginaInicio.php">Inicio</a></li>
                <li><a href="../Vistas/crudProducto.php">Productos</a></li>
                <li><a href="../Vistas/registroEntrada.php">Entradas</a></li>
                <li><a href="../Vistas/registroSalida.php">Salidas</a></li>
                <li><a href="../Vistas/crudMarca.php">Marcas</a></li>
                <li><a href="../Vistas/crudCategoria.php">Categorías</a></li>
                <li><a href="../Vistas/crudRol.php">Roles</a></li>
                <li><a href="../Vistas/crudUsuario.php">Usuarios</a></li>
                <li><a href="../Vistas/crudProveedor.php">Proveedores</a></li>
                <li><a href="../Vistas/historialMovimientos.php">Historial de Movimientos</a></li>
                <li><a href="../Vistas/registroStock.php">Stock de productos</a></li>
                <li><a href="../Vistas/producto_proveedor.php">Producto/Proveedor</a></li>
            </ul>
            <a href="../index.php" class="cerrar-btn">Cerrar sesión</a>
        </nav>

        <div class="contenido-principal">
            <h1>Usuarios</h1>
            <div id="contenido">
                <div class="contenedor-acciones">
                    <div class="acciones">
                        <div class="accion-box">
                            <button type="button" class="crear" onclick="abrirVentanaCrear()">Agregar Usuario</button>
                        </div>
                    </div>
                </div>
        
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Rol</th>
                        <th colspan="2">Acciones</th>
                    </tr>
                    <?php
                        if ($usuario && count($usuario) > 0) {
                            foreach ($usuario as $u) {
                                echo '
                                <tr>
                                    <td>'.$u["id_usuario"].'</td>
                                    <td>'.$u["email"].'</td>
                                    <td>'.$u["nombre"].'</td>
                                    <td>'.$u["apellido"].'</td>
                                    <td>'.$u["id_rol"].'</td>

                                    <td>
                                        <form method="post" action="crudUsuario.php" style="display:inline;">
                                            <button name="eliminar" type="submit" value="'.$u["id_usuario"].'" class="eliminar">Eliminar</button>
                                        </form>
                                    </td>

                                    <td>
                                        <button type="button"
                                            data-id="'.$u["id_usuario"].'"
                                            data-email="'.$u["email"].'"
                                            data-nombre="'.$u["nombre"].'"
                                            data-apellido="'.$u["apellido"].'"
                                            data-rol="'.$u["id_rol"].'"
                                            class="editar"
                                            onclick="abrirVentana(this)">
                                            Editar
                                        </button>
                                    </td>
                                </tr>';
                            }

                        } else {

                            echo '
                            <tr>
                                <td colspan="6">No hay usuarios registrados</td>
                            </tr>';

                        }
                        ?>

                </table>
            </div>
        </div>
        
        <div id="ventanaEditar" class="ventana">
            <div class="ventana_contenido">
                <h2>Editar Usuario</h2>
                <form method="post" action="crudUsuario.php">
                    <input type="hidden" name="id_usuario" id="id_usuario">
                    <input type="text" name="email_nuevo" id="email_nuevo" placeholder="Email" required>
                    <input type="text" name="nombre_nuevo" id="nombre_nuevo" placeholder="Nombre" required>
                    <input type="text" name="apellido_nuevo" id="apellido_nuevo" placeholder="Apellido" required>
                    <input type="password" name="clave_nueva" placeholder="Nueva Contraseña ">
                    
                    <select name="rol_nuevo" id="rol_nuevo" required>
                        <option value="">Seleccione Rol</option>
                        <?php foreach($roles as $r){ echo '<option value="'.$r['id_rol'].'">'.$r['nombre'].'</option>'; } ?>
                    </select>
    
                    <button type="submit" name="editar_guardar">Guardar</button>
                    <button type="button" name="cancelar"  onclick="cerrarVentana()">Cancelar</button>
                </form>
            </div>
        </div>
        
        <div id="ventanaCrear" class="ventana">
            <div class="ventana_contenido">
                <h2>Crear Usuario</h2>
                <form method="post" action="crudUsuario.php">
                    <input type="text" name="nuevo_email" placeholder="Email" required>
                    <input type="text" name="nuevo_nombre" placeholder="Nombre" required>
                    <input type="text" name="nuevo_apellido" placeholder="Apellido" required>
                    <input type="password" name="clave_nueva" placeholder="Contraseña" required>
    
                    <select name="nuevo_rol" required>
                        <option value="">Seleccione Rol</option>
                        <?php foreach($roles as $r){ echo '<option value="'.$r['id_rol'].'">'.$r['nombre'].'</option>'; } ?>
                    </select>
    
                    <button type="submit" name="crear_guardar">Guardar</button>
                    <button type="button" name="cancelar"  onclick="cerrarVentanaCrear()">Cancelar</button>
                </form>
            </div>
        </div>

    </div>

    <script src="../JS/editarUsuario.js"></script>
</body>
</html>