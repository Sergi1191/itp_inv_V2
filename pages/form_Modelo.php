<?php
include '../includes/DBConfig.php';
include '../api/consulta_modelo.php';
?>
<?php include '../includes/header.php'; ?>
<section class="contenedor">
    <h1>MODELO</h1>
    <a href="./form_NuevoModelo.php">
        <button>AGREGAR MODELO</button>
    </a>
    <table class="tablas">
        <tr>
            <th>ID Modelo</th>
            <th>Nombre Modelo</th>
            <th>Marca</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= ($row['id_modelo']) ?></td>
                <td><?= ($row['nombre_modelo']) ?></td>
                <td><?= ($row['id_marca']) ?></td>
                <td><a href="./form_ActualizarModelo.php?id=<?php echo $row['id_modelo']; ?>">
                            <button>Editar</button>
                        </a>
                    <a href="../api/eliminar_modelo.php?id=<?php echo $row['id_modelo']; ?>"
                        onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                        <button>Eliminar</button>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</section>
<?php include '../includes/footer.php'; ?>