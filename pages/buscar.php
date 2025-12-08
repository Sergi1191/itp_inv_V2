<?php
include '../includes/DBConfig.php';
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
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $query = $conexion->real_escape_string($_GET['q']);
            $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'todos';
            echo "<p>Mostrando resultados para: <strong>" . htmlspecialchars($query) . "</strong></p>";

            // Construir consulta según filtro
            $sql = "SELECT a.no_inventario AS activo, d.nombre_dep AS ubicacion, e.nombre_estatus AS estatus
                    FROM Activos a
                    LEFT JOIN Departamentos d ON a.id_dep = d.id_dep
                    LEFT JOIN Estatus e ON a.id_estatus = e.id_estatus
                    WHERE ";
            if ($filtro === 'num_serie') {
                $sql .= "a.no_serie LIKE '%$query%'";
            } elseif ($filtro === 'modelo') {
                $sql .= "a.id_modelo LIKE '%$query%'";
            } elseif ($filtro === 'area') {
                $sql .= "d.nombre_dep LIKE '%$query%'";
            } elseif ($filtro === 'usuario') {
                $sql .= "a.id_responsable LIKE '%$query%'";
            } else {
                $sql .= "(a.no_inventario LIKE '%$query%' OR a.no_serie LIKE '%$query%' OR d.nombre_dep LIKE '%$query%')";
            }
            $sql .= " ORDER BY a.no_inventario ASC";

            $result = $conexion->query($sql);
            if ($result && $result->num_rows > 0) {
                echo '<table class="tabla-resultados">';
                echo '<tr><th>Activo</th><th>Ubicación</th><th>Estatus</th></tr>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['activo']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['ubicacion']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['estatus']) . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p>No se encontraron resultados.</p>';
            }
        } else {
            echo "<p>Ingrese un término y presione el botón 'Buscar' para ver los resultados.</p>";
        }
        ?>
    </div>
</section>
<?php
include '../includes/footer.php';
?>