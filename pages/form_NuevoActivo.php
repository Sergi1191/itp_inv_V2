<?php
include '../includes/DBConfig.php';
include '../includes/header.php';
include '../api/crear_activos.php'

// // Consultas para los dropdowns
// $sql = "SELECT id_tipo, nombre_tipo FROM Tipos_activo";
// $result_tipo_activo = $conexion->query($sql);

// $sql = "SELECT id, nombre FROM Usuarios";
// $result_usuario = $conexion->query($sql);

// $sql = "SELECT id_sub, nombre_sub FROM Subdirecciones";
// $result_subdirecciones = $conexion->query($sql);

// $sql = "SELECT id_dep, nombre_dep FROM Departamentos";
// $result_departamentos = $conexion->query($sql);
?>
<body>
    <section class="contenedor">
        <h2>Alta de Nuevo Activo</h2>

        <form action="../api/crear_activos.php" method="post">

            <label>Marca:
                <input type="text" name="marca" required>
            </label>

            <label>Modelo:
                <input type="text" name="modelo" required>
            </label>

            <label>Número de Serie:
                <input type="text" name="no_serie" required>
            </label>

            <label>Estatus:
                <select name="estatus" required>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                    <option value="Mantenimiento">Mantenimiento</option>
                </select>
            </label>

            <label>Fecha de Adquisición:
                <input type="date" name="fecha_adquisicion" required>
            </label>

            <label>Tipo de Activo:
                <select name="activo_tipo_id" required>
                    <option value="">Seleccionar tipo</option>
                    <?php while ($row = $result_tipo_activo->fetch_assoc()): ?>
                        <option value="<?= $row['id_tipo'] ?>">
                            <?= htmlspecialchars($row['nombre_tipo']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </label>

            <label>Subdirección:
                <select name="subdirecciones_id" required>
                    <option value="">Seleccionar subdirección</option>
                    <?php while ($row = $result_subdirecciones->fetch_assoc()): ?>
                        <option value="<?= $row['id_sub'] ?>">
                            <?= htmlspecialchars($row['nombre_sub']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </label>

            <label>Departamento:
                <select name="departamentos_id" required>
                    <option value="">Seleccionar departamento</option>
                    <?php while ($row = $result_departamentos->fetch_assoc()): ?>
                        <option value="<?= $row['id_dep'] ?>">
                            <?= htmlspecialchars($row['nombre_dep']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </label>

            <label>Responsable:
                <select name="nombre_usuario" required>
                    <option value="">Seleccionar responsable</option>
                    <?php while ($row = $result_usuario->fetch_assoc()): ?>
                        <option value="<?= $row['id_usuario'] ?>">
                            <?= htmlspecialchars($row['nombre']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </label>

            <button type="submit">Guardar Activo</button>
        </form>
    </section>
</body>
<?php
include '../includes/footer.php';
$conexion->close();
?>