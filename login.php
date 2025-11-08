<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario Tecnologico - Iniciar Sesión</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="background-shape"></div>
        <div class="login-form">
            <h1>INVENTARIO<br>TECNOLOGICO</h1>
            <form action="./api/login.php" method="post"> 
                <div class="input-group">
                    <label for="usuario">USUARIO:</label>
                    <input type="text" id="usuario" name="nombre">
                </div>
                <div class="input-group">
                    <label for="password">PASSWORD:</label>
                    <input type="password" id="password" name="password">
                </div>
                <button type="submit" name="btn">Iniciar sesión</button>
            </form>
            <a href="#" class="create-user">Crear usuario</a>
        </div>
        <div class="logo-container">
            <img src="./assets/imagenes/logotec.png" alt="Logo ITP">
        </div>
    </div>
</body>
</html>