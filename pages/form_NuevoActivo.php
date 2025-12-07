<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../includes/DBConfig.php';
include '../includes/header.php';

// Listados
$subdirecciones = $conexion->query("SELECT * FROM Subdirecciones ORDER BY nombre_sub");
$departamentos = $conexion->query("SELECT * FROM Departamentos ORDER BY nombre_dep");
$tipos_de_activo = $conexion->query("SELECT * FROM Tipos_activo ORDER BY nombre_tipo");
$marcas = $conexion->query("SELECT * FROM Marcas ORDER BY nombre_marca");
$modelos = $conexion->query("SELECT * FROM Modelos ORDER BY nombre_modelo");
$estatus = $conexion->query("SELECT * FROM Estatus ORDER BY nombre_estatus");
$responsable = $conexion->query("SELECT * FROM Usuarios ORDER BY nombre");

$mensaje = '';
$tipo_mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_tipo = $_POST['id_tipo'] ?? null;
    if (!$id_tipo) {
        $mensaje = 'Debe seleccionar un tipo de activo.';
        $tipo_mensaje = 'error';
    }

    // Obtener nombre del tipo
    $stmt = $conexion->prepare("SELECT nombre_tipo FROM Tipos_activo WHERE id_tipo = ?");
    $stmt->bind_param("i", $id_tipo);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $nombreTipo = $row ? $row['nombre_tipo'] : '';

    // Generar abreviatura (máximo 3 caracteres para el prefijo)
    $abr = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $nombreTipo), 0, 3));
    $prefijo = 'ITP' . $abr;
    
    // Verificar que el prefijo no sea demasiado largo
    if (strlen($prefijo) > 10) {
        $prefijo = substr($prefijo, 0, 10);
    }

    // Obtener último consecutivo
    $stmt = $conexion->prepare("
        SELECT COALESCE(MAX(CAST(SUBSTRING(no_inventario, 7, 4) AS UNSIGNED)), 0) as ult
        FROM Activos
        WHERE no_inventario LIKE ?
    ");
    $like = $prefijo . '%';
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();
    $ultimo = (int)$result->fetch_assoc()['ult'];
    $consec = str_pad($ultimo + 1, 4, '0', STR_PAD_LEFT);

    // Número de inventario final (asegurando máximo 10 caracteres)
    $no_inventario = substr($prefijo . $consec, 0, 10);
    
    // Depuración
    echo "Valor de no_inventario: " . $no_inventario . " (longitud: " . strlen($no_inventario) . ")\n";
    
    // Otros campos
    $no_serie = $_POST['no_serie'];
    $fecha_adquisicion = $_POST['fecha_adquisicion'];
    $id_sub = !empty($_POST['id_sub']) ? $_POST['id_sub'] : null;
    $id_dep = !empty($_POST['id_dep']) ? $_POST['id_dep'] : null;
    $id_tipo = !empty($_POST['id_tipo']) ? $_POST['id_tipo'] : null;
    $id_marca = !empty($_POST['id_marca']) ? $_POST['id_marca'] : null;
    $id_modelo = !empty($_POST['id_modelo']) ? $_POST['id_modelo'] : null;
    $id_estatus = !empty($_POST['id_estatus']) ? $_POST['id_estatus'] : null;
    $id_responsable = !empty($_POST['id_responsable']) ? $_POST['id_responsable'] : null;

    // Insertar
    $stmt = $conexion->prepare("
        INSERT INTO Activos
        (no_inventario, no_serie, fecha_adquisicion, id_sub, id_dep, id_tipo, id_marca, id_modelo, id_estatus, id_responsable)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssssiiiiii", $no_inventario, $no_serie, $fecha_adquisicion, $id_sub, $id_dep, $id_tipo, $id_marca, $id_modelo, $id_estatus, $id_responsable);
    if ($stmt->execute()) {
        $mensaje = 'Activo guardado correctamente. Número de inventario: ' . $no_inventario;
        $tipo_mensaje = 'exito';
        // Limpiar los campos del formulario
        $_POST = array();
    } else {
        $mensaje = 'Error al guardar el activo: ' . $conexion->error;
        $tipo_mensaje = 'error';
    }
}
?>

<section class="contenedor">
    <h1>Agregar Activo</h1>
    <?php if (!empty($mensaje)): ?>
        <div class="mensaje <?= $tipo_mensaje ?>">
            <?= $mensaje ?>
        </div>
    <?php endif; ?>
    <form method="post">
        Número de serie: <input type="text" name="no_serie" required><br>
        Fecha de adquisición: <input type="date" name="fecha_adquisicion" required><br>

        Subdirecciones:
        <select name="id_sub">
            <option value="">-- Seleccione una opción --</option>
            <?php while ($r = $subdirecciones->fetch_assoc()): ?>
                <option value="<?= $r['id_sub'] ?>"><?= $r['nombre_sub'] ?></option>
            <?php endwhile; ?>
        </select><br>

        Departamentos:
        <select name="id_dep">
            <option value="">-- Seleccione una opción --</option>
            <?php while ($r = $departamentos->fetch_assoc()): ?>
                <option value="<?= $r['id_dep'] ?>"><?= $r['nombre_dep'] ?></option>
            <?php endwhile; ?>
        </select><br>

        Tipo de Activo:
        <select name="id_tipo" required>
            <option value="">-- Seleccione una opción --</option>
            <?php while ($r = $tipos_de_activo->fetch_assoc()): ?>
                <option value="<?= $r['id_tipo'] ?>"><?= $r['nombre_tipo'] ?></option>
            <?php endwhile; ?>
        </select><br>

        Marca:
        <select name="id_marca">
            <option value="">-- Seleccione una opción --</option>
            <?php while ($r = $marcas->fetch_assoc()): ?>
                <option value="<?= $r['id_marca'] ?>"><?= $r['nombre_marca'] ?></option>
            <?php endwhile; ?>
        </select><br>

        Modelo:
        <select name="id_modelo">
            <option value="">-- Seleccione una opción --</option>
            <?php while ($r = $modelos->fetch_assoc()): ?>
                <option value="<?= $r['id_modelo'] ?>"><?= $r['nombre_modelo'] ?></option>
            <?php endwhile; ?>
        </select><br>

        Estatus:
        <select name="id_estatus">
            <option value="">-- Seleccione una opción --</option>
            <?php while ($r = $estatus->fetch_assoc()): ?>
                <option value="<?= $r['id_estatus'] ?>"><?= $r['nombre_estatus'] ?></option>
            <?php endwhile; ?>
        </select><br>

        Responsable:
        <select name="id_responsable">
            <option value="">-- Seleccione una opción --</option>
            <?php while ($r = $responsable->fetch_assoc()): ?>
                <option value="<?= $r['id_usuario'] ?>"><?= $r['nombre'] ?></option>
            <?php endwhile; ?>
        </select><br>

        <button type="submit" name="guardar">Guardar</button>
    </form>
</section>