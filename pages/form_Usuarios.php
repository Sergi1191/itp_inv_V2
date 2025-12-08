<?php
include '../includes/DBConfig.php';

include '../api/consulta_usuarios.php';
include '../includes/header.php'; 
?>

<section class="contenedor">
    <h1>USUARIOS</h1>
    <div>
        <a href="./form_NuevoUsuario.php">
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
                    <td data-label="ID_Usuario"><?= htmlspecialchars($row['id_usuario']) ?></td>
                    <td data-label="Nombre"><?= htmlspecialchars($row['nombre']) ?></td>
                    <td data-label="Nombre Usuario"><?= htmlspecialchars($row['nombre_usuario']) ?></td>
                    <td data-label="Password"><?= htmlspecialchars($row['password']) ?></td>
                    <td data-label="Rol Usuario"><?= htmlspecialchars($row['rol_usuario']) ?></td>
                    <td data-label="Acciones"><a href="./form_ActualizarUsuario.php?id=<?= $row['id_usuario']; ?>">
                            <button>Editar</button>
                        </a>
                        <a href="../api/eliminar_usuario.php?id=<?= $row['id_usuario']; ?>"
                            onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                            <button>Eliminar</button>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</section>

<?php include '../includes/footer.php'; ?>