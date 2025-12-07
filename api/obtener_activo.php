<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

include '../includes/DBConfig.php';

if (!isset($_GET['id_activo']) || !is_numeric($_GET['id_activo'])) {
    echo json_encode(['success' => false, 'message' => 'ID de activo inválido']);
    exit;
}

$id_activo = intval($_GET['id_activo']);

try {
    $sql = "
        SELECT 
            a.id_activo,
            a.no_inventario,
            m.nombre_marca as marca,
            mo.nombre_modelo as modelo,
            DATE_FORMAT(a.fecha_adquisicion, '%d/%m/%Y') as fecha_adquisicion,
            ta.nombre_tipo as tipo_activo,
            d.nombre_dep as departamento,
            s.nombre_sub as subdireccion,
            CONCAT(u.nombre, ' ', u.apellido) as responsable,
            e.nombre_estatus as estatus
        FROM Activos a
        LEFT JOIN Marcas m ON a.id_marca = m.id_marca
        LEFT JOIN Modelos mo ON a.id_modelo = mo.id_modelo
        LEFT JOIN Tipos_activo ta ON a.id_tipo = ta.id_tipo
        LEFT JOIN Departamentos d ON a.id_dep = d.id_dep
        LEFT JOIN Subdirecciones s ON a.id_sub = s.id_sub
        LEFT JOIN Usuarios u ON a.id_responsable = u.id_usuario
        LEFT JOIN Estatus e ON a.id_estatus = e.id_estatus
        WHERE a.id_activo = ?
    ";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('i', $id_activo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Activo no encontrado']);
        exit;
    }
    
    $activo = $result->fetch_assoc();
    
    echo json_encode([
        'success' => true,
        'activo' => $activo
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener los datos del activo: ' . $e->getMessage()
    ]);
}

$conexion->close();
?>
