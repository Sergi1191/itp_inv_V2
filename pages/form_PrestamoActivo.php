<?php
include '../includes/DBConfig.php';
include '../includes/header.php';

// Consultas para los dropdowns
$sql_activos = "SELECT no_inventario, marca, modelo FROM Activos WHERE estatus = 'Activo'";
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
                    <?php while ($row = $result_activos->fetch_assoc()): ?>
                        <option value="<?= $row['no_inventario'] ?>">
                            <?= htmlspecialchars($row['marca'] . ' ' . $row['modelo'] . ' (#' . $row['no_inventario'] . ')') ?>
                        </option>
                    <?php endwhile; ?>
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

            <label>Observaciones:
                <textarea name="observaciones" rows="3" placeholder="Observaciones del préstamo..."></textarea>
            </label>

            <button type="submit">Registrar Préstamo</button>
        </form>
    </section>

    <!-- Sección para ver préstamos activos -->
    <section class="contenedor">
        <h3>Préstamos Activos</h3>
        <?php
        $sql_prestamos = "SELECT p.*, a.marca, a.modelo, u.nombre as nombre_usuario 
                         FROM Prestamos_historial p 
                         JOIN Activos a ON p.no_inventario = a.no_inventario 
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
                    </tr>
                </thead>
                <tbody>
                    <?php while ($prestamo = $result_prestamos->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($prestamo['marca'] . ' ' . $prestamo['modelo']) ?></td>
                        <td><?= htmlspecialchars($prestamo['nombre_usuario']) ?></td>
                        <td><?= $prestamo['fecha_prestamo'] ?></td>
                        <td>
                            <a href="../api/devolver_prestamo.php?id_prestamo=<?= $prestamo['id_prestamo'] ?>" 
                               onclick="return confirm('¿Confirmar devolución?')">
                                Marcar como Devuelto
                            </a>
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