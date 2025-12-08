<?php include '../includes/DBConfig.php'; ?>
<?php include '../includes/header.php'; ?>
<?php
$marcas = $conexion->query("SELECT * FROM Marcas");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modelo  = $_POST['nombre_modelo'];
    $id_marca = $_POST['id_marca'];

    $stmt = $conexion->prepare("INSERT INTO Modelos (nombre_modelo, id_marca)
                           VALUES (?, ?)");
    $stmt->execute([$modelo, $id_marca]);
    header("Location: form_Modelo.php");
} 
?>
    <section class="contenedor">
        <h1>Agregar Modelo</h1>
        <form method="post">
            Modelo: <input type="text" name="nombre_modelo" required><br>
            Marca:
            <select name="id_marca">
                <option value="">-- Seleccione una opcion --</option>
                <?php foreach ($marcas as $r): ?>
                    <option value="<?= $r['id_marca'] ?>"><?= $r['nombre_marca'] ?></option>
                <?php endforeach; ?>
            </select><br>
            <button type="submit">Guardar</button>
        </form>
    </section>