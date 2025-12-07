<?php include '../includes/DBConfig.php'; 
include '../includes/header.php';
?>
<?php
$id = $_GET['id'] ?? 0;
$query = "SELECT * FROM Tipos_activo WHERE id_tipo = $id";
$result = $conexion->query($query);
$tipoActivo = $result->fetch_assoc();

if (!$tipoActivo) {
    die("Tipo de activo no encontrado");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conexion->prepare("UPDATE Tipos_activo SET nombre_tipo = ? WHERE id_tipo = ?");
    $stmt->execute([$_POST['nombre_tipo'], $id]);
    header("Location: form_TiposActivo.php");
}
?>
    <section class="contenedor">
        <h1>Editar Tipo de Activo</h1>
        <form method="post">
            Nombre de Tipo de Activo: <input type="text" name="nombre_tipo" value="<?= $tipoActivo['nombre_tipo'] ?>" required><br>
            <button type="submit">Guardar</button>
        </form>
        <a href="form_TiposActivo.php">Volver</a>
    </section>