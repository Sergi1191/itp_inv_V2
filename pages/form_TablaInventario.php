<?php
include '../includes/DBConfig.php';
include '../api/consulta_activos.php';
?>
<?php include '../includes/header.php'; ?>
<section class="contenedor">
    <h1>ACTIVOS</h1>
    <a href="./form_NuevoActivo.php"><button>AGREGAR ACTIVO</button></a>
    <table class="tablas">
        <tr>
            <th>No.Inventario</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Fecha de Adquisicion</th>
            <th>Estatus</th>
            <th>Activo Tipo</th>
            <th>Usuario Responsable</th>
            <th>Nombre Departamento</th>
            <th>Nombre Subdireccion</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td data-label="No.Inventario"><?= htmlspecialchars($row['no_inventario']) ?></td>
                <td data-label="Marca"><?= htmlspecialchars($row['marca']) ?></td>
                <td data-label="Modelo"><?= htmlspecialchars($row['modelo']) ?></td>
                <td data-label="Fecha de Adquisicion"><?= htmlspecialchars($row['fecha_adquisicion']) ?></td>
                <td data-label="Estatus"><?= htmlspecialchars($row['estatus']) ?></td>
                <td data-label="Activo Tipo"><?= htmlspecialchars($row['tipo_activo']) ?></td>
                <td data-label="Usuario Responsable"><?= htmlspecialchars($row['responsable']) ?></td>
                <td data-label="Nombre Departamento"><?= htmlspecialchars($row['departamento']) ?></td>
                <td data-label="Nombre Subdireccion"><?= htmlspecialchars($row['subdireccion']) ?></td>
                <td data-label="Acciones">
                    <a href="./form_ActualizarActivo.php?id=<?= $row['id_activo']; ?>">
                        <button>Editar</button>
                    </a>
                    <a href="../api/eliminar_activo.php?id=<?= $row['id_activo']; ?>" onclick="return confirm('¿Estás seguro de eliminar este activo?')">
                        <button>Eliminar</button>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>
<?php include '../includes/footer.php'; ?>