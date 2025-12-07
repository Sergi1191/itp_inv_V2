<?php include '../includes/DBConfig.php'; 
include '../includes/header.php';
?>
<?php
$id = $_GET['id'] ?? 0;
$query = "SELECT * FROM Activos WHERE id_activo = $id";
$result = $conexion->query($query);
$activo = $result->fetch_assoc();

if (!$activo) {
    die("Activo no encontrado");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conexion->prepare("UPDATE Activos SET no_inventario = ?, no_serie = ?, fecha_adquisicion = ?, id_estatus = ?, id_tipo = ?, id_marca = ?, id_modelo = ?, id_responsable = ?, id_dep = ?, id_sub = ? WHERE id_activo = ?");
    $stmt->execute([$_POST['no_inventario'], $_POST['no_serie'], $_POST['fecha_adquisicion'], $_POST['id_estatus'], $_POST['id_tipo'], $_POST['id_marca'], $_POST['id_modelo'], $_POST['id_responsable'], $_POST['id_dep'], $_POST['id_sub'], $id]);
    header("Location: form_TablaInventario.php");
}
?>
    <section class="contenedor">
        <h1>Editar Activo</h1>
        <form method="post">
            No. Inventario: <input type="text" name="no_inventario" value="<?= $activo['no_inventario'] ?>" required><br>
            No. Serie: <input type="text" name="no_serie" value="<?= $activo['no_serie'] ?>" required><br>
            Fecha de Adquisicion: <input type="text" name="fecha_adquisicion" value="<?= $activo['fecha_adquisicion'] ?>" required><br>
            Estatus: <input type="text" name="id_estatus" value="<?= $activo['id_estatus'] ?>" required><br>
            Tipo: <input type="text" name="id_tipo" value="<?= $activo['id_tipo'] ?>" required><br>
            Marca: <input type="text" name="id_marca" value="<?= $activo['id_marca'] ?>" required><br>
            Modelo: <input type="text" name="id_modelo" value="<?= $activo['id_modelo'] ?>" required><br>
            Responsable: <input type="text" name="id_responsable" value="<?= $activo['id_responsable'] ?>" required><br>
            Departamento: <input type="text" name="id_dep" value="<?= $activo['id_dep'] ?>" required><br>
            Subdireccion: <input type="text" name="id_sub" value="<?= $activo['id_sub'] ?>" required><br>
            <button type="submit">Guardar</button>
        </form>
        <a href="form_TablaInventario.php">Volver</a>
    </section>
<?php include '../includes/footer.php'; ?>