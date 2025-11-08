<?php
include '../includes/DBConfig.php';
include '../includes/header.php';

// Consulta de activos
$sql_activos = "SELECT no_inventario, marca, modelo FROM Activos";
$result_activos = $conexion->query($sql_activos);

// Consulta de documentos existentes
$sql_documentos = "SELECT d.*, a.marca, a.modelo, u.nombre as subido_por 
                   FROM Documentacion d 
                   JOIN Activos a ON d.no_inventario = a.no_inventario 
                   JOIN Usuarios u ON d.subido_por_usuario_id = u.id_usuario 
                   ORDER BY d.id_documento DESC";
$result_documentos = $conexion->query($sql_documentos);
?>

<body>
    <section class="contenedor">
        <h2>Documentación de Activos</h2>

        <form action="../api/subir_documentacion.php" method="post" enctype="multipart/form-data">
            
            <label>Activo:
                <select name="no_inventario" required>
                    <option value="">Seleccionar activo</option>
                    <?php while ($row = $result_activos->fetch_assoc()): ?>
                        <option value="<?= $row['no_inventario'] ?>">
                            <?= htmlspecialchars($row['marca'] . ' ' . $row['modelo'] . ' (#' . $row['no_inventario'] . ')') ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </label>

            <label>Tipo de Documento:
                <select name="tipo_documento" required>
                    <option value="Factura">Factura</option>
                    <option value="Garantia">Garantía</option>
                    <option value="Manual">Manual</option>
                    <option value="Certificado">Certificado</option>
                    <option value="Otro">Otro</option>
                </select>
            </label>

            <label>Archivo:
                <input type="file" name="archivo" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
            </label>

            <label>Observaciones:
                <textarea name="observaciones" rows="3" placeholder="Descripción del documento..."></textarea>
            </label>

            <input type="hidden" name="subido_por_usuario_id" value="1"> <!-- Cambiar por ID de sesión -->

            <button type="submit">Subir Documento</button>
        </form>
    </section>

    <!-- Lista de documentos -->
    <section class="contenedor">
        <h3>Documentos Existentes</h3>
        <?php if ($result_documentos->num_rows > 0): ?>
            <table border="1" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Activo</th>
                        <th>Tipo</th>
                        <th>Archivo</th>
                        <th>Subido por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($doc = $result_documentos->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($doc['marca'] . ' ' . $doc['modelo']) ?></td>
                        <td><?= htmlspecialchars($doc['tipo_documento']) ?></td>
                        <td><?= htmlspecialchars($doc['archivo']) ?></td>
                        <td><?= htmlspecialchars($doc['subido_por']) ?></td>
                        <td>
                            <a href="../docs/<?= $doc['archivo'] ?>" target="_blank">Ver</a> |
                            <a href="../api/eliminar_documento.php?id_documento=<?= $doc['id_documento'] ?>" 
                               onclick="return confirm('¿Eliminar documento?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay documentos registrados</p>
        <?php endif; ?>
    </section>
</body>
<?php
include '../includes/footer.php';
$conexion->close();
?>