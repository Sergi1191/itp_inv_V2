<?php
include '../includes/DBConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_inventario = intval($_POST['no_inventario'] ?? 0);
    $id_usuario_prestatario = intval($_POST['id_usuario_prestatario'] ?? 0);
    $fecha_prestamo = $_POST['fecha_prestamo'] ?? date('Y-m-d');
    $fecha_devolucion = $_POST['fecha_devolucion'] ?? null;
    $observaciones = trim($_POST['observaciones'] ?? '');

    // Validar que el activo existe y está activo
    $stmt = $conexion->prepare("SELECT estatus FROM Activos WHERE no_inventario = ?");
    $stmt->bind_param("i", $no_inventario);
    $stmt->execute();
    $stmt->bind_result($estatus);
    $stmt->fetch();
    $stmt->close();

    if ($estatus !== 'Activo') {
        die("Error: El activo no está disponible para préstamo.");
    }

    // Verificar que no tenga préstamos activos
    $stmt = $conexion->prepare("SELECT id_prestamo FROM Prestamos_historial WHERE no_inventario = ? AND fecha_devolucion IS NULL");
    $stmt->bind_param("i", $no_inventario);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        die("Error: El activo ya tiene un préstamo activo.");
    }
    $stmt->close();

    // Insertar préstamo
    $stmt = $conexion->prepare(
        "INSERT INTO Prestamos_historial 
        (no_inventario, fecha_prestamo, fecha_devolucion, id_usuario_prestatario) 
        VALUES (?, ?, NULL, ?)"
    );
    $stmt->bind_param("isi", $no_inventario, $fecha_prestamo, $id_usuario_prestatario);

    if ($stmt->execute()) {
        header("Location: ../pages/form_PrestamoActivo.php?success=1");
        exit;
    } else {
        echo "Error al registrar préstamo: " . $stmt->error;
    }
    $stmt->close();
}
?>