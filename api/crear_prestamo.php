<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Incluir la configuración de la base de datos
require_once '../includes/DBConfig.php';

// Verificar si se recibieron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $no_inventario = isset($_POST['no_inventario']) ? trim($_POST['no_inventario']) : '';
    $id_usuario_prestatario = isset($_POST['id_usuario_prestatario']) ? intval($_POST['id_usuario_prestatario']) : 0;
    $fecha_prestamo = isset($_POST['fecha_prestamo']) ? $_POST['fecha_prestamo'] : date('Y-m-d');
    $fecha_devolucion = isset($_POST['fecha_devolucion']) ? $_POST['fecha_devolucion'] : null;
    $observaciones = isset($_POST['observaciones']) ? trim($_POST['observaciones']) : '';

    // Validar los datos
    if (empty($no_inventario) || $id_usuario_prestatario <= 0) {
        die('Error: Datos incompletos o inválidos');
    }

    // Iniciar transacción para asegurar la integridad de los datos
    $conexion->begin_transaction();

    try {
        // 1. Obtener el ID del activo basado en el número de inventario
        $sql_activo = "SELECT id_activo, id_estatus FROM Activos WHERE no_inventario = ?";
        $stmt_activo = $conexion->prepare($sql_activo);
        $stmt_activo->bind_param('s', $no_inventario);
        $stmt_activo->execute();
        $result_activo = $stmt_activo->get_result();
        
        if ($result_activo->num_rows === 0) {
            throw new Exception('El activo no existe');
        }

        $activo = $result_activo->fetch_assoc();
        $id_activo = $activo['id_activo'];

        // 2. Verificar si el activo ya está prestado
        if ($activo['id_estatus'] != 2) { // 2 = ACTIVO (según tu base de datos)
            throw new Exception('El activo no está disponible para préstamo');
        }

        // 3. Insertar el registro de préstamo
        $sql_insert = "INSERT INTO Prestamos_historial 
                      (id_activo, fecha_prestamo, id_usuario_prestatario)
                      VALUES (?, ?, ?)";
        
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param('isi', $id_activo, $fecha_prestamo, $id_usuario_prestatario);
        $stmt_insert->execute();
        $id_prestamo = $conexion->insert_id;

        // 4. Actualizar el estado del activo a "EN PRÉSTAMO" (asumiendo que el ID 3 es para préstamo)
        $sql_update_activo = "UPDATE Activos SET id_estatus = 3 WHERE id_activo = ?";
        $stmt_update = $conexion->prepare($sql_update_activo);
        $stmt_update->bind_param('i', $id_activo);
        $stmt_update->execute();

        // Confirmar la transacción
        $conexion->commit();

        // Redireccionar con mensaje de éxito
        header('Location: ../pages/form_PrestamoActivo.php?success=Préstamo registrado exitosamente');
        exit();

    } catch (Exception $e) {
        // En caso de error, deshacer los cambios
        $conexion->rollback();
        die('Error al registrar el préstamo: ' . $e->getMessage());
    }
} else {
    // Si no es una petición POST, redirigir al formulario
    header('Location: ../pages/form_PrestamoActivo.php');
    exit();
}
?>
