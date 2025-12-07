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
                <td><?= ($row['id_activo']) ?></td>
                <td><?= ($row['no_inventario']) ?></td>
                <td><?= ($row['id_marca']) ?></td>
                <td><?= ($row['id_modelo']) ?></td>
                <td><?= ($row['fecha_adquisicion']) ?></td>
                <td><?= ($row['id_estatus']) ?></td>
                <td><?= ($row['id_tipo']) ?></td>
                <td><?= ($row['id_responsable']) ?></td>
                <td><?= ($row['id_dep']) ?></td>
                <td><?= ($row['id_sub']) ?></td>
                                    <td> 
                                    <a href="./form_ActualizarActivo.php?id=<?php echo $row['id_activo']; ?>">
                            <button>Editar</button>
                        </a>
                        <a href="../api/eliminar_activo.php?id=<?php echo $row['id_activo']; ?>"
                            onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                            <button>Eliminar</button>
                        </a>
                    </td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>
<?php include '../includes/footer.php'; ?>