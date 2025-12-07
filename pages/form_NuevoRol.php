<?php include '../includes/DBConfig.php'; ?>
<?php include '../includes/header.php'; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rol  = $_POST['nombre_rol'];

    $stmt = $conexion->prepare("INSERT INTO Roles (nombre_rol)
                           VALUES (?)");
    $stmt->execute([$rol]);
    header("Location: form_Roles.php");
} 
?>
<!DOCTYPE html>
<html>
<head><title>Agregar Rol</title></head>
<body>
    <section class="contenedor">
        <h1>Agregar Rol</h1>
        <form method="post">
            Rol: <input type="text" name="nombre_rol" required><br>
            <button type="submit">Guardar</button>
        </form>
    </section>
</body>
</html>