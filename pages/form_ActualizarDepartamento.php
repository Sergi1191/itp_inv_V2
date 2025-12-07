<?php include '../includes/DBConfig.php';
include '../includes/header.php';
?>
<?php
$id = $_GET['id'] ?? 0;
$query = "SELECT * FROM Departamentos WHERE id_dep = $id";
$result = $conexion->query($query);
$departamento = $result->fetch_assoc();

if (!$departamento) {
    die("Departamento no encontrado");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $coneccion->prepare("UPDATE Departamentos SET nombre_dep = ? WHERE id_dep = ?");
    $stmt->execute([$_POST['nombre_dep'], $id]);
    header("Location: form_Departamentos.php");
}
?>

<section class="contenedor">
    <h1>Editar Departamentos</h1>
    <form method="post">
        Nombre de Departamentos: <input type="text" name="nombre_dep" value="<?= $departamento['nombre_dep'] ?>" required><br>
        <button type="submit">Guardar</button>
    </form>
    <a href="form_Departamentos.php">Volver</a>
</section>