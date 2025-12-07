<?php include '../includes/DBConfig.php'; 
include '../includes/header.php';
?>
<?php
$id = $_GET['id'] ?? 0;
$query = "SELECT * FROM Marcas WHERE id_marca = $id";
$result = $conexion->query($query);
$marca = $result->fetch_assoc();

if (!$marca) {
    die("Marca no encontrada");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conexion->prepare("UPDATE Marcas SET nombre_marca = ? WHERE id_marca = ?");
    $stmt->execute([$_POST['nombre_marca'], $id]);
    header("Location: form_Marcas.php");
}
?>
    <section class="contenedor">
        <h1>Editar Marca</h1>
        <form method="post">
            Nombre de Marca: <input type="text" name="nombre_marca" value="<?= $marca['nombre_marca'] ?>" required><br>
            <button type="submit">Guardar</button>
        </form>
        <a href="form_Marcas.php">Volver</a>
    </section>