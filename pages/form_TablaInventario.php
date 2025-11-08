<?php
include '../includes/DBConfig.php';
include '../api/consulta_actvios.php';
?>
<?php include '../includes/header.php'; ?>

<section class="contenedor">
    <h1>ACTIVOS</h1>
    <div>
        <a href="./form_NuevoActivo.php">
            <button>AGREGAR PRODUCTO</button>
        </a>
        <table class="tablas">
            <tr>
                <th>No.Inventario</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>No.Serie</th>
                <th>Estatus</th>
                <th>Tipo</th>
                <th>Fecha Creacion</th>
                <th>Fecha Modificacion</th>
                <th>Nombre Responsable</th>
                <th>Nombre Dep.</th>
                <th>Nombre Sub.</th>
                <th>Nombre Tipo.</th>
                <th>Acciones</th>
            </tr>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= ($row['no_inventario']) ?></td>
                    <td><?= ($row['marca']) ?></td>
                    <td><?= ($row['modelo']) ?></td>
                    <td><?= ($row['no_serie']) ?></td>
                    <td><?= ($row['estatus']) ?></td>
                    <td><?= ($row['tipo']) ?></td>
                    <td><?= ($row['fecha_creacion']) ?></td>
                    <td><?= ($row['fecha_modificacion']) ?></td>
                    <td><?= ($row['nombre']) ?></td>
                    <td><?= ($row['nombre_dep']) ?></td>
                    <td><?= ($row['nombre_sub']) ?></td>
                    <td><?= ($row['nombre_tipo']) ?></td>
                    <td>
                        <a href="./form_ActualizarActivo.php">
                            <button>Editar</button>
                        </a>
                    <button>Eliminar</button>
                    <button>Info</button>
                </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</section>
<?php include '../includes/footer.php'; ?>