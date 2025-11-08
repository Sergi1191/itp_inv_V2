<?php
include '../includes/DBConfig.php';
include '../api/consulta_usuarios.php';
?>
<?php include '../includes/header.php'; ?>

<section class="contenedor">
    <h1>USUARIOS</h1>
    <div>
        <a href="./form_NuevoActivo.php">
            <button>AGREGAR USUARIO</button>
        </a>
        <table class="tablas">
            <tr>
                <th>ID_Usuario</th>
                <th>Nombre</th>
                <th>Nombre Usuario</th>
                <th>Password</th>
                <th>Rol Usuario</th>
                <th>Acciones</th>
            </tr>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= ($row['id_usuario']) ?></td>
                    <td><?= ($row['nombre']) ?></td>
                    <td><?= ($row['nombre_usuario']) ?></td>
                    <td><?= ($row['password']) ?></td>
                    <td><?= ($row['rol_usuario']) ?></td>
                    <td>
                        <a href="./form_ActualizarActivo.php">
                            <button>Editar</button>
                        </a>
                    <button>Eliminar</button>
                </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</section>
<?php include '../includes/footer.php'; ?>