<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Inventario Tecnológico'; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <header class="header">
        <div class="cont_img ">
            <img src="../assets/imagenes/logotec.png" alt="Logo del Inventario" class="imagen">
        </div>
        <div>
            <h1 class="titulo">Inventario Tecnológico</h1>
            <nav id="mainMenu">
                <a href="../pages/home.php">Inicio</a>
                <a href="../pages/buscar.php">Buscar</a>
                <a href="../api/logout.php">Sesión</a>
            </nav>
        </div>
    </header>

    <div class="side_bar">
        <aside>
            <h2>Inventario</h2>
            <ul>
                <li><a href="../pages/form_Usuarios.php">USUARIOS</a></li>
                <li><a href="../pages/form_TablaInventario.php">ACTIVOS</a></li>
                <li><a href="../pages/form_PrestamoActivo.php">PRESTAMOS</a></li>
                <li><a href="../pages/form_DocumentacionActivo.php">DOCUMENTACION</a></li>
            </ul>
        </aside>
    </div>
    <main class="contenido">