<?php include '../includes/DBConfig.php'; 
include '../includes/header.php';
?>
<?php
$id = $_GET['id'] ?? 0;
$query = "SELECT * FROM Estatus WHERE id_estatus = $id";
$result = $conexion->query($query);
$estatus = $result->fetch_assoc();

if (!$estatus) {
    die("Estatus no encontrado");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conexion->prepare("UPDATE Estatus SET nombre_estatus = ? WHERE id_estatus = ?");
    $stmt->execute([$_POST['nombre_estatus'], $id]);
    header("Location: form_Estatus.php");
}
?>
    <section class="contenedor">
        <h1>Editar Estatus</h1>
        <form method="post">
            Nombre de Estatus: <input type="text" name="nombre_estatus" value="<?= $estatus['nombre_estatus'] ?>" required><br>
            <button type="submit">Guardar</button>
        </form>
        <a href="form_Estatus.php">Volver</a>
    </section>