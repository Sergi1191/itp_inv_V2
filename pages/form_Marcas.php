<?php
include '../includes/DBConfig.php';
include '../api/consulta_marcas.php';
?>
<?php include '../includes/header.php'; ?>
<section class="contenedor">
    <h1>MARCAS</h1>
    <a href="./form_NuevoMarcas.php">
        <button>AGREGAR MARCA</button>
    </a>
    <table class="tablas">
        <tr>
            <th>ID Marca</th>
            <th>Nombre Marca</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= ($row['id_marca']) ?></td>
                <td><?= ($row['nombre_marca']) ?></td>
                <td><a href="./form_ActualizarMarcas.php?id=<?php echo $row['id_marca']; ?>">
                            <button>Editar</button>
                        </a>
                    <a href="../api/eliminar_marcas.php?id=<?php echo $row['id_marca']; ?>"
                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                        <button>Eliminar</button>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>
<?php include '../includes/footer.php'; ?>