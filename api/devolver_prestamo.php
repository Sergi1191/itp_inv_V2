<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Incluir la configuración de la base de datos
require_once '../includes/DBConfig.php';

// Verificar si se recibió el ID del préstamo
if (!isset($_GET['id_prestamo']) || !is_numeric($_GET['id_prestamo'])) {
    die('ID de préstamo no válido');
}

$id_prestamo = intval($_GET['id_prestamo']);
$fecha_devolucion = date('Y-m-d');

// Iniciar transacción
$conexion->begin_transaction();

try {
    // 1. Obtener información del préstamo
    $sql_prestamo = "SELECT id_activo FROM Prestamos_historial WHERE id_prestamo = ? AND fecha_devolucion IS NULL";
    $stmt_prestamo = $conexion->prepare($sql_prestamo);
    $stmt_prestamo->bind_param('i', $id_prestamo);
    $stmt_prestamo->execute();
    $result_prestamo = $stmt_prestamo->get_result();
    
    if ($result_prestamo->num_rows === 0) {
        throw new Exception('Préstamo no encontrado o ya fue devuelto');
    }
    
    $prestamo = $result_prestamo->fetch_assoc();
    $id_activo = $prestamo['id_activo'];
    
    // 2. Calcular multa y actualizar la devolución
    // Obtener la fecha estimada de devolución
    $sql_fechas = "SELECT fecha_devolucion_estimada FROM Prestamos_historial WHERE id_prestamo = ?";
    $stmt_fechas = $conexion->prepare($sql_fechas);
    $stmt_fechas->bind_param('i', $id_prestamo);
    $stmt_fechas->execute();
    $result_fechas = $stmt_fechas->get_result();
    $fecha_estimada = null;
    if ($row = $result_fechas->fetch_assoc()) {
        $fecha_estimada = $row['fecha_devolucion_estimada'];
    }
    $dias_retraso = 0;
    $multa = 0;
    if ($fecha_estimada && $fecha_devolucion > $fecha_estimada) {
        $dias_retraso = (new DateTime($fecha_estimada))->diff(new DateTime($fecha_devolucion))->days;
        $multa = $dias_retraso * 10; // $10 pesos por día
    }
    $sql_update_prestamo = "UPDATE Prestamos_historial SET fecha_devolucion = ?, multa = ? WHERE id_prestamo = ?";
    $stmt_update_prestamo = $conexion->prepare($sql_update_prestamo);
    $stmt_update_prestamo->bind_param('sdi', $fecha_devolucion, $multa, $id_prestamo);
    $stmt_update_prestamo->execute();
    
    // 3. Actualizar el estado del activo a "ACTIVO" (ID 2 según tu base de datos)
    $sql_update_activo = "UPDATE Activos SET id_estatus = 2 WHERE id_activo = ?";
    $stmt_update_activo = $conexion->prepare($sql_update_activo);
    $stmt_update_activo->bind_param('i', $id_activo);
    $stmt_update_activo->execute();
    
    // Confirmar la transacción
    $conexion->commit();
    
    // Redirigir con mensaje de éxito
    header('Location: ../pages/form_PrestamoActivo.php?success=Devolución registrada exitosamente');
    exit();
    
} catch (Exception $e) {
    // En caso de error, deshacer los cambios
    $conexion->rollback();
    die('Error al registrar la devolución: ' . $e->getMessage());
}
?>
