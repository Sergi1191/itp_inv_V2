<?php
include '../includes/DBConfig.php';

// Obtener datos para los dropdowns (siempre cargarlos primero)
$usuarios = $conexion->query("SELECT id, nombre FROM usuarios");
$departamentos = $conexion->query("SELECT departamento_id, nombre_departamento FROM departamentos");
$subdirecciones = $conexion->query("SELECT subdireccion_id, nombre_subdireccion FROM subdirecciones");
$tipos_activo = $conexion->query("SELECT activo_id, tipo FROM tipo_activo");

// Cargar datos del activo a editar si se solicita
if (isset($_GET['editar'])) {
    $no_inventario = $_GET['editar'];
    $stmt = $conexion->prepare("SELECT * FROM inventario WHERE no_inventario = ?");
    $stmt->bind_param("s", $no_inventario);
    $stmt->execute();
    $result = $stmt->get_result();
    $activo_editar = $result->fetch_assoc();
    $stmt->close();
}

if (isset($_GET['eliminar'])) {
    $no_inventario = $_GET['eliminar'];
    $stmt = $conexion->prepare("DELETE FROM inventario WHERE no_inventario = ?");
    $stmt->bind_param("s", $no_inventario);
    $stmt->execute();
    $result = $stmt->get_result();
    $activo_editar = $result->fetch_assoc();
    $stmt->close();
}

// Procesar actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_inventario = $_POST['no_inventario'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $fecha_adquisicion = $_POST['fecha_adquisicion'];
    $estatus = $_POST['estatus'];
    $activo_tipo_id = $_POST['activo_tipo_id'];
    $usuario_responsable_id = $_POST['usuario_responsable_id'];
    $departamentos_id = $_POST['departamentos_id'];
    $subdirecciones_id = $_POST['subdirecciones_id'];

    $query = "UPDATE inventario SET 
              mar   ca = ?, modelo = ?, fecha_adquisicion = ?, estatus = ?, 
              activo_tipo_id = ?, usuario_responsable_id = ?, 
              departamentos_id = ?, subdirecciones_id = ? 
              WHERE no_inventario = ?";

    $stmt = $conexion->prepare($query);
    $stmt->bind_param(
        "ssssiiiis",
        $marca,
        $modelo,
        $fecha_adquisicion,
        $estatus,
        $activo_tipo_id,
        $usuario_responsable_id,
        $departamentos_id,
        $subdirecciones_id,
        $no_inventario
    );

    if ($stmt->execute()) {
        header("Location: ../pages/form_TablaInventario.php?success=1");
        exit;
    } else {
        $error = "Error al actualizar: " . $conexion->error;
    }
    $stmt->close();
}
