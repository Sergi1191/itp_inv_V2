<?php include '../includes/DBConfig.php'; 
include '../includes/header.php';
?>
<?php
$id = $_GET['id'] ?? 0;
$query = "SELECT * FROM Subdirecciones WHERE id_sub = $id";
$result = $conexion->query($query);
$subdireccion = $result->fetch_assoc();

if (!$subdireccion) {
    die("Subdireccion no encontrada");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conexion->prepare("UPDATE Subdirecciones SET nombre_sub = ? WHERE id_sub = ?");
    $stmt->execute([$_POST['nombre_sub'], $id]);
    header("Location: form_Subdirecciones.php");
}
?>
    <section class="contenedor">
        <h1>Editar Subdireccion</h1>
        <form method="post">
            Nombre de Subdireccion: <input type="text" name="nombre_sub" value="<?= $subdireccion['nombre_sub'] ?>" required><br>
            <button type="submit">Guardar</button>
        </form>
        <a href="form_Subdirecciones.php">Volver</a>
    </section>