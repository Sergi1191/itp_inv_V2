<?php include '../includes/DBConfig.php'; ?>
<?php include '../includes/header.php'; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $marca  = $_POST['nombre_marca'];

    $stmt = $conexion->prepare("INSERT INTO Marcas (nombre_marca)
                           VALUES (?)");
    $stmt->execute([$marca]);
    header("Location: form_Marcas.php");
} 
?>
<!DOCTYPE html>
<html>
<head><title>Agregar Marca</title></head>
<body>
    <section class="contenedor">
        <h1>Agregar Marca</h1>
        <form method="post">
            Marca: <input type="text" name="nombre_marca" required><br>
            <button type="submit">Guardar</button>
        </form>
    </section>
</body>
</html>