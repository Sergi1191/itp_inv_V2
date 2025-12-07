<?php
include '../includes/DBConfig.php';
include '../api/consulta_rol.php';
?>
<?php include '../includes/header.php'; ?>
<section class="contenedor">
    <h1>ROLES</h1>
    <a href="./form_NuevoRol.php">
        <button>AGREGAR ROLES</button>
    </a>
    <table class="tablas">
        <tr>
            <th>ID Roles</th>
            <th>Nombre Roles</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= ($row['id_rol']) ?></td>
                <td><?= ($row['nombre_rol']) ?></td>
                <td><a href="./form_ActualizarRol.php?id=<?php echo $row['id_rol']; ?>">
                            <button>Editar</button>
                        </a>
                    <a href="../api/eliminar_rol.php?id=<?php echo $row['id_rol']; ?>"
                        onclick="return confirm('¿Estás seguro de eliminar este rol?')">
                        <button>Eliminar</button>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>
<?php include '../includes/footer.php'; ?>