<?php include '../includes/DBConfig.php'; ?>
<?php include '../includes/header.php'; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $estatus  = $_POST['nombre_sub'];

    $stmt = $conexion->prepare("INSERT INTO Subdirecciones (nombre_sub)
                           VALUES (?)");
    $stmt->execute([$estatus]);
    header("Location: form_Subdirecciones.php");
} 
?>
    <section class="contenedor">
        <h1>Agregar Estatus</h1>
        <form method="post">
            Subdirecciones: <input type="text" name="nombre_sub" required><br>
            <button type="submit">Guardar</button>
        </form>
    </section>