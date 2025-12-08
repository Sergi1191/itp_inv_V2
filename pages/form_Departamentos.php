<?php
include '../includes/DBConfig.php'; include '../api/consulta_departamentos.php';?>
<?php include '../includes/header.php'; ?>
<section class="contenedor">
    <h1>DEPARTAMENTOS</h1>
    <div>
        <a href="./form_NuevoDepartamentos.php">
            <button>AGREGAR DEPARTAMENTO</button>
        </a>
        <table class="tablas">
            <tr>                                                
                <th>ID_Departamento</th>
                <th>Nombre del Departamento</th>
                <th>Acciones</th>
            </tr>
            <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= ($row['id_dep']) ?></td>
                    <td><?= ($row['nombre_dep']) ?></td>
                    <td><a href="./form_ActualizarDepartamento.php?id=<?php echo $row['id_dep']; ?>">
                            <button>Editar</button>
                        </a>
                        <a href="../api/eliminar_departamento.php?id=<?php echo $row['id_dep']; ?>"
                            onclick="return confirm('¿Estás seguro de eliminar este departamento?')">
                            <button>Eliminar</button>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</section>
<?php include '../includes/footer.php'; ?>