<?php include '../includes/DBConfig.php'; ?>
<?php include '../includes/header.php'; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_dep = $_POST['nombre_dep'] ?: null;

    $stmt = $conexion->prepare("INSERT INTO Departamentos (nombre_dep)
                           VALUES (?)");
    $stmt->execute([$nombre_dep]);
    header("Location: form_Departamentos.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Agregar Departamentos</title>
</head>

<body>
    <section class="contenedor">
        <h1>Agregar Departamentos</h1>
        <form method="post">
            Nombre de Departamento: <input type="text" name="nombre_dep" required><br><br>
            <button type="submit">Guardar</button>
        </form>
    </section>
</body>

</html>