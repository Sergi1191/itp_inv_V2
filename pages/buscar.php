<?php
// Incluye la configuración de la base de datos y la verificación de sesión
include '../includes/DBConfig.php'; 

// // Control de sesión: redirige si el usuario NO está logueado
// if (!isset($_SESSION['logged_in'])) {
//     header("location:../login.php");
//     exit();
// }

// Establece el título de la página
$page_title = "Buscar Activo - Inventario Tecnológico";

// Incluye la cabecera (<html>, <head>, <header>)
include '../includes/header.php'; 
?>

<section class="contenedor">
    <h2>BUSCAR ACTIVO</h2>
    <p>Utilice el siguiente formulario para localizar equipos o activos específicos dentro del inventario.</p>

    <form action="" method="GET" class="search-form">
        <div class="input-group">
            <label for="termino_busqueda">Término de Búsqueda:</label>
            <input type="text" id="termino_busqueda" name="q" placeholder="Ej: No. Serie, Modelo, Área o Usuario" required>
        </div>
        
        <div class="input-group">
            <label for="filtro">Filtrar por:</label>
            <select id="filtro" name="filtro">
                <option value="todos">Todos los Campos</option>
                <option value="num_serie">Número de Serie</option>
                <option value="modelo">Modelo</option>
                <option value="area">Área/Departamento</option>
                <option value="usuario">Usuario Asignado</option>
            </select>
        </div>
        
        <button type="submit" class="btn-accion">Buscar</button>
    </form>
    
    <hr style="border-top: 1px solid rgba(255, 255, 255, 0.1); margin: 30px 0;">

    <div class="search-results">
        <h3>Resultados de Búsqueda</h3>
        <?php 
        // Lógica PHP para manejar la búsqueda e imprimir la tabla de resultados
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $query = htmlspecialchars($_GET['q']);
            echo "<p>Mostrando resultados para: <strong>" . $query . "</strong></p>";
            
            // Aquí iría la conexión a la base de datos y la consulta SQL

            /* Ejemplo de tabla de resultados (si hay resultados) */
            // if (count($resultados) > 0) { 
            ?>
                <?php 
            // } else {
            //     echo "<p style='color: #f39c12;'>No se encontraron activos que coincidan con su búsqueda.</p>";
            // }
        } else {
            echo "<p>Ingrese un término y presione el botón 'Buscar' para ver los resultados.</p>";
        }
        ?>
    </div>

</section>

<?php
// Incluye el pie de página (<footer>, </body>, </html>)
include '../includes/footer.php';
?>