<?php
include '../includes/DBConfig.php';
include '../api/consulta_tipo_activo.php';
?>
<?php include '../includes/header.php'; ?>
<section class="contenedor">
    <h1>TIPOS DE ACTIVO</h1>
    <a href="./form_NuevoTipoActivo.php">
        <button>AGREGAR TIPO DE ACTIVO</button>
    </a>
    <table class="tablas">
        <tr>
            <th>ID Tipo de Activo</th>
            <th>Nombre Tipo de Activo</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= ($row['id_tipo']) ?></td>
                <td><?= ($row['nombre_tipo']) ?></td>
                <td><a href="./form_ActualizarTipoActivo.php?id=<?php echo $row['id_tipo']; ?>">
                            <button>Editar</button>
                        </a>
                    <a href="../api/eliminar_tipo_activo.php?id=<?php echo $row['id_tipo']; ?>"
                        onclick="return confirm('¿Estás seguro de eliminar este tipo de activo?')">
                        <button>Eliminar</button>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>
<?php include '../includes/footer.php'; ?>