<?php include '../includes/DBConfig.php'; ?>
<?php include '../includes/header.php'; ?>
<?php
$roles = $conexion->query("SELECT * FROM Roles ORDER BY nombre_rol");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre   = $_POST['nombre'];
    $usuario  = $_POST['nombre_usuario'];
    $password = $_POST['password'];
    $rol      = $_POST['rol_usuario'] ?: null;

    $stmt = $conexion->prepare("INSERT INTO Usuarios (nombre, nombre_usuario, password, rol_usuario)
                           VALUES (?, ?, ?, ?)");
    $stmt->execute([$nombre, $usuario, $password, $rol]);
    header("Location: form_Usuarios.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Agregar Usuario</title></head>
<body>
    <section class="contenedor">
        <h1>Agregar Usuario</h1>
        <form method="post">
            Nombre completo: <input type="text" name="nombre" required><br>
            Usuario: <input type="text" name="nombre_usuario" required><br>
            Password: <input type="password" name="password" required><br>
            Rol:
            <select name="rol_usuario">
                <option value="">-- Sin rol --</option>
                <?php foreach ($roles as $r): ?>
                    <option value="<?= $r['id_rol'] ?>"><?= $r['nombre_rol'] ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <button type="submit">Guardar</button>
        </form>
    </section>
</body>
</html>