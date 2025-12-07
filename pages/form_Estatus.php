<?php
include '../includes/DBConfig.php';
include '../api/consulta_estatus.php';
?>
<?php include '../includes/header.php'; ?>
<section class="contenedor">
    <h1>ESTATUS</h1>
    <a href="./form_NuevoEstatus.php">
        <button>AGREGAR ESTATUS</button>
    </a>
    <table class="tablas">
        <tr>
            <th>ID Estatus</th>
            <th>Nombre Estatus</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= ($row['id_estatus']) ?></td>
                <td><?= ($row['nombre_estatus']) ?></td>
                <td><a href="./form_ActualizarEstatus.php?id=<?php echo $row['id_estatus']; ?>">
                            <button>Editar</button>
                        </a>
                    <a href="../api/eliminar_estatus.php?id=<?php echo $row['id_estatus']; ?>"
                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                        <button>Eliminar</button>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>
<?php include '../includes/footer.php'; ?>