<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario Tecnologico - Iniciar Sesión</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="background-shape"></div>
        <div class="login-form">
            <h1>INVENTARIO<br>TECNOLOGICO</h1>
            <form action="./api/login.php" method="post"> 
                <div class="input-group">
                    <label for="nombre_usuario">USUARIO:</label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" required>
                </div>
                <div class="input-group">
                    <label for="password">PASSWORD:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="btn">Iniciar sesión</button>
            </form>
        </div>
        <div class="logo-container">
            <img src="./assets/imagenes/logotec.png" alt="Logo ITP">
        </div>
    </div>
</body>
</html>