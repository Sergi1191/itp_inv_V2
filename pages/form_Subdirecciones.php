<?php
include '../includes/DBConfig.php';
include '../api/consulta_subdirecciones.php';
?>
<?php include '../includes/header.php'; ?>
<section class="contenedor">
    <h1>ESTATUS</h1>
    <a href="./form_NuevoSubdirecciones.php">
        <button>AGREGAR SUBDIRECCIONES</button>
    </a>
    <table class="tablas">
        <tr>
            <th>ID Subdirecciones</th>
            <th>Nombre Subdirecciones</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= ($row['id_sub']) ?></td>
                <td><?= ($row['nombre_sub']) ?></td>
                <td><a href="./form_ActualizarSubdirecciones.php?id=<?php echo $row['id_sub']; ?>">
                            <button>Editar</button>
                        </a>
                    <a href="../api/eliminar_subdirecciones.php?id=<?php echo $row['id_sub']; ?>"
                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                        <button>Eliminar</button>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>