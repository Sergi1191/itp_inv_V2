<?php include '../includes/DBConfig.php'; ?>
<?php include '../includes/header.php'; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $estatus  = $_POST['nombre_estatus'];

    $stmt = $conexion->prepare("INSERT INTO Estatus (nombre_estatus)
                           VALUES (?)");
    $stmt->execute([$estatus]);
    header("Location: form_Estatus.php");
} 
?>
    <section class="contenedor">
        <h1>Agregar Estatus</h1>
        <form method="post">
            Estatus: <input type="text" name="nombre_estatus" required><br>
            <button type="submit">Guardar</button>
        </form>
    </section>