<?php include '../includes/DBConfig.php'; ?>
<?php include '../api/actualizar_activo.php'; ?>

<?php include '../includes/header.php'; ?>

<section class="contenido">
    <h2>Editar Registro de Inventario</h2>

    <!-- Formulario de edición -->
    <div class="form-edicion">
        <h3>Editar Activo</h3>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form action="../api/actualizar_activo.php" method="post">
            <input type="hidden" name="no_inventario" value="<?= $activo_editar['no_inventario'] ?? '' ?>">

            <label>Marca:
                <input type="text" name="marca" value="<?= $activo_editar['marca'] ?? '' ?>" required>
            </label>

            <label>Modelo:
                <input type="text" name="modelo" value="<?= $activo_editar['modelo'] ?? '' ?>" required>
            </label>

            <label>Fecha de Adquisición:
                <input type="date" name="fecha_adquisicion" value="<?= $activo_editar['fecha_adquisicion'] ?? '' ?>" required>
            </label>

            <label>Estatus:
                <select name="estatus" required>
                    <option value="Activo" <?= ($activo_editar['estatus'] ?? '') == 'Activo' ? 'selected' : '' ?>>Activo</option>
                    <option value="Inactivo" <?= ($activo_editar['estatus'] ?? '') == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    <option value="Mantenimiento" <?= ($activo_editar['estatus'] ?? '') == 'Mantenimiento' ? 'selected' : '' ?>>Mantenimiento</option>
                </select>
            </label>

            <label>Tipo de Activo:
                <select name="activo_tipo_id" required>
                    <?php while ($row = $tipos_activo->fetch_assoc()): ?>
                        <option value="<?= $row['activo_id'] ?>"
                            <?= ($activo_editar['activo_tipo_id'] ?? '') == $row['activo_id'] ? 'selected' : '' ?>>
                            <?= $row['tipo'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </label>

            <label>Usuario Responsable:
                <select name="usuario_responsable_id" required>
                    <?php while ($row = $usuarios->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>"
                            <?= ($activo_editar['usuario_responsable_id'] ?? '') == $row['id'] ? 'selected' : '' ?>>
                            <?= $row['nombre'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </label>

            <label>Departamento:
                <select name="departamentos_id" required>
                    <?php while ($row = $departamentos->fetch_assoc()): ?>
                        <option value="<?= $row['departamento_id'] ?>"
                            <?= ($activo_editar['departamentos_id'] ?? '') == $row['departamento_id'] ? 'selected' : '' ?>>
                            <?= $row['nombre_departamento'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </label>

            <label>Subdirección:
                <select name="subdirecciones_id" required>
                    <?php while ($row = $subdirecciones->fetch_assoc()): ?>
                        <option value="<?= $row['subdireccion_id'] ?>"
                            <?= ($activo_editar['subdirecciones_id'] ?? '') == $row['subdireccion_id'] ? 'selected' : '' ?>>
                            <?= $row['nombre_subdireccion'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </label>

            <button type="submit">Actualizar Activo</button>
        </form>
    </div>

    <!-- Tabla de activos (con enlaces para editar) -->
    <div class="tabla-activos">
        <h3>Seleccionar Activo a Editar</h3>
        <table border="1">
            <tr>
                <th>No.Inventario</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Fecha Adquisición</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
            <?php
            $resultado = $conexion->query(
                "SELECT i.*, ta.tipo, u.nombre AS nombre_usuario, 
                        d.nombre_departamento, s.nombre_subdireccion
                 FROM inventario i
                 LEFT JOIN tipo_activo ta ON i.activo_tipo_id = ta.activo_id
                 LEFT JOIN usuarios u ON i.usuario_responsable_id = u.id
                 LEFT JOIN departamentos d ON i.departamentos_id = d.departamento_id
                 LEFT JOIN subdirecciones s ON i.subdirecciones_id = s.subdireccion_id
                 ORDER BY CAST(SUBSTRING(i.no_inventario, -4) AS UNSIGNED) ASC;"
            );
            ?>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['no_inventario'] ?></td>
                    <td><?= $row['marca'] ?></td>
                    <td><?= $row['modelo'] ?></td>
                    <td><?= $row['fecha_adquisicion'] ?></td>
                    <td><?= $row['estatus'] ?></td>
                    <td>
                        <a href="?editar=<?= $row['no_inventario'] ?>">Editar</a>
                        <a href="?eliminar<?= $row['no_inventario'] ?>">Eliminar</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</section>
<?php include '../includes/footer.php'; ?>