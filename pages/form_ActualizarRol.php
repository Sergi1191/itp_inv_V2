<?php include '../includes/DBConfig.php'; 
include '../includes/header.php';
?>
<?php
$id = $_GET['id'] ?? 0;
$query = "SELECT * FROM Roles WHERE id_rol = $id";
$result = $conexion->query($query);
$rol = $result->fetch_assoc();

if (!$rol) {
    die("Rol no encontrado");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conexion->prepare("UPDATE Roles SET nombre_rol = ? WHERE id_rol = ?");
    $stmt->execute([$_POST['nombre_rol'], $id]);
    header("Location: form_Roles.php");
}
?>
    <section class="contenedor">
        <h1>Editar Rol</h1>
        <form method="post">
            Nombre de Rol: <input type="text" name="nombre_rol" value="<?= $rol['nombre_rol'] ?>" required><br>
            <button type="submit">Guardar</button>
        </form>
        <a href="form_Roles.php">Volver</a>
    </section>