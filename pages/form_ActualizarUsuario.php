<?php include '../includes/DBConfig.php'; ?>
<?php include '../includes/header.php'; ?>
<?php
$id = $_GET['id'] ?? 0;
$query = "SELECT * FROM Usuarios WHERE id_usuario = $id";
$result = $conexion->query($query);
$user = $result->fetch_assoc();

if (!$user) {
    die("Usuario no encontrado");
}

$roles = $conexion->query("SELECT * FROM Roles ORDER BY nombre_rol");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['nombre_usuario'];
    $rol = !empty($_POST['rol_usuario']) ? $_POST['rol_usuario'] : 'NULL';

    // Si se proporcionó contraseña, la actualizamos
    if (!empty($_POST['password'])) {
        $password = $conexion->real_escape_string($_POST['password']);
        $query = "UPDATE Usuarios SET 
                 nombre = '$nombre', 
                 nombre_usuario = '$usuario', 
                 password = '$password', 
                 rol_usuario = $rol 
                 WHERE id_usuario = $id";
    } else {
        $query = "UPDATE Usuarios SET 
                 nombre = '$nombre', 
                 nombre_usuario = '$usuario', 
                 rol_usuario = $rol 
                 WHERE id_usuario = $id";
    }
    
    if ($conexion->query($query)) {
        header("Location: home.php");
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
    exit();
}
?>
<section class="contenedor">
    <h1>Editar Usuario</h1>
    <form method="post">
        Nombre completo: <input type="text" name="nombre" value="<?php echo htmlspecialchars($user['nombre']); ?>" required><br>
        Usuario: <input type="text" name="nombre_usuario" value="<?php echo htmlspecialchars($user['nombre_usuario']); ?>" required><br>
        Nuevo password (solo si desea cambiar): <input type="password" name="password"><br>
        Rol:
        <select name="rol_usuario">
            <option value="">-- Sin rol --</option>
            <?php 
            if ($roles) {
                while($r = $roles->fetch_assoc()): 
            ?>
                <option value="<?php echo $r['id_rol']; ?>" <?php echo ($r['id_rol'] == $user['rol_usuario']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($r['nombre_rol']); ?>
                </option>
            <?php 
                endwhile; 
            }
            ?>
        </select><br><br>
        <button type="submit">Guardar</button>
    </form>
</section>