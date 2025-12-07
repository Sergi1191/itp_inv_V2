<?php include '../includes/DBConfig.php'; 
include '../includes/header.php';
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipoActivo  = $_POST['nombre_tipo'];

    $stmt = $conexion->prepare("INSERT INTO Tipos_activo (nombre_tipo)
                           VALUES (?)");
    $stmt->execute([$tipoActivo]);
    header("Location: form_TiposActivo.php");
} 
?>
    <section class="contenedor">
        <h1>Crear Tipo de Activo</h1>
        <form method="post">
            Nombre de Tipo de Activo: <input type="text" name="nombre_tipo" required><br>
            <button type="submit">Guardar</button>
        </form>
        <a href="form_TiposActivo.php">Volver</a>
    </section>