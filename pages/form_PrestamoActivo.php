<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../includes/DBConfig.php';
include '../includes/header.php';

// Mostrar mensajes de éxito o error
if (isset($_GET['success'])) {
    echo '<div class="alert success">' . htmlspecialchars($_GET['success']) . '</div>';
} elseif (isset($_GET['error'])) {
    echo '<div class="alert error">' . htmlspecialchars($_GET['error']) . '</div>';
}

// Consultas para los dropdowns
$sql_activos = "SELECT a.id_activo, a.no_inventario, m.nombre_marca as marca, mo.nombre_modelo as modelo 
                FROM Activos a
                JOIN Marcas m ON a.id_marca = m.id_marca
                JOIN Modelos mo ON a.id_modelo = mo.id_modelo
                WHERE a.id_estatus = 2"; // 2 = ACTIVO
$result_activos = $conexion->query($sql_activos);

$sql_usuarios = "SELECT id_usuario, nombre FROM Usuarios";
$result_usuarios = $conexion->query($sql_usuarios);
?>

<body>
    <section class="contenedor">
        <h2>Registro de Préstamo de Activo</h2>

        <form action="../api/crear_prestamo.php" method="post">
            
            <label>Activo a Prestar:
                <select name="no_inventario" required>
                    <option value="">Seleccionar activo</option>
                    <?php if ($result_activos && $result_activos->num_rows > 0): ?>
                        <?php while ($row = $result_activos->fetch_assoc()): ?>
                            <option value="<?= htmlspecialchars($row['no_inventario']) ?>">
                                <?= htmlspecialchars($row['marca'] . ' ' . $row['modelo'] . ' (#' . $row['no_inventario'] . ')') ?>
                            </option>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <option value="">No hay activos disponibles para préstamo</option>
                    <?php endif; ?>
                </select>
            </label>

            <label>Usuario Prestatario:
                <select name="id_usuario_prestatario" required>
                    <option value="">Seleccionar usuario</option>
                    <?php while ($row = $result_usuarios->fetch_assoc()): ?>
                        <option value="<?= $row['id_usuario'] ?>">
                            <?= htmlspecialchars($row['nombre']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </label>

            <label>Fecha de Préstamo:
                <input type="date" name="fecha_prestamo" value="<?= date('Y-m-d') ?>" required>
            </label>

            <label>Fecha Estimada de Devolución:
                <input type="date" name="fecha_devolucion" required>
            </label>

            <button type="submit">Registrar Préstamo</button>
        </form>
    </section>

    <!-- Sección para ver préstamos activos -->
    <section class="contenedor">
        <h3>Préstamos Activos</h3>
        <?php
        $sql_prestamos = "SELECT p.*, 
                         a.no_inventario, 
                         m.nombre_marca as marca, 
                         mo.nombre_modelo as modelo, 
                         u.nombre as nombre_usuario 
                         FROM Prestamos_historial p 
                         JOIN Activos a ON p.id_activo = a.id_activo 
                         JOIN Marcas m ON a.id_marca = m.id_marca
                         JOIN Modelos mo ON a.id_modelo = mo.id_modelo
                         JOIN Usuarios u ON p.id_usuario_prestatario = u.id_usuario 
                         WHERE p.fecha_devolucion IS NULL 
                         ORDER BY p.fecha_prestamo DESC";
        $result_prestamos = $conexion->query($sql_prestamos);
        
        if ($result_prestamos->num_rows > 0): ?>
            <table class="tablas">
                <thead>
                    <tr>
                        <th>Activo</th>
                        <th>Usuario</th>
                        <th>Fecha Préstamo</th>
                        <th>Acciones</th>
<th>Multa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($prestamo = $result_prestamos->fetch_assoc()): ?>
                    <tr>
                        <td data-label="Activo"><?= htmlspecialchars($prestamo['marca'] . ' ' . $prestamo['modelo']) ?></td>
                        <td data-label="Usuario"><?= htmlspecialchars($prestamo['nombre_usuario']) ?></td>
                        <td data-label="Fecha Préstamo"><?= htmlspecialchars($prestamo['fecha_prestamo']) ?></td>
                        <td data-label="Acciones">
                            <a href="../api/devolver_prestamo.php?id_prestamo=<?= $prestamo['id_prestamo'] ?>" 
                               onclick="return confirm('¿Confirmar devolución?')">
                                Marcar como Devuelto
                            </a>
                        </td>
                        <td data-label="Multa">
                            <?php 
                            if (isset($prestamo['multa'])) {
                                echo '$' . number_format($prestamo['multa'], 2);
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay préstamos activos</p>
        <?php endif; ?>
    </section>
</body>
<?php
include '../includes/footer.php';
$conexion->close();
?>