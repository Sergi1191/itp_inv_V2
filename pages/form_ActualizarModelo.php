<?php include '../includes/DBConfig.php'; 
include '../includes/header.php';

$id = $_GET['id'] ?? 0;
// Obtener datos del modelo
$query = "SELECT * FROM Modelos WHERE id_modelo = $id";
$result = $conexion->query($query);
$modelo = $result->fetch_assoc();

if (!$modelo) {
    die("Modelo no encontrado");
}

// Obtener todas las marcas para el select
$marcas_query = "SELECT * FROM Marcas ORDER BY nombre_marca";
$marcas_result = $conexion->query($marcas_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conexion->prepare("UPDATE Modelos SET nombre_modelo = ?, id_marca = ? WHERE id_modelo = ?");
    $stmt->execute([$_POST['nombre_modelo'], $_POST['id_marca'], $id]);
    header("Location: form_Modelo.php");
    exit();
}
?>
    <section class="contenedor">
        <h1>Editar Modelo</h1>
        <form method="post" class="form-container">
            <div class="form-group">
                <label for="nombre_modelo">Nombre de Modelo:</label>
                <input type="text" name="nombre_modelo" id="nombre_modelo" value="<?= htmlspecialchars($modelo['nombre_modelo']) ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="id_marca">Marca:</label>
                <select name="id_marca" id="id_marca" class="form-control" required>
                    <?php while($marca = $marcas_result->fetch_assoc()): ?>
                        <option value="<?= $marca['id_marca'] ?>" <?= ($marca['id_marca'] == $modelo['id_marca']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($marca['nombre_marca']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <a href="form_Modelo.php">Volver</a>
    </section>