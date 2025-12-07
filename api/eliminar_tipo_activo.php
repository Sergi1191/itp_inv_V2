<?php 
include '../includes/DBConfig.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    die("ID de tipo de activo no válido");
}
$query = "DELETE FROM Tipos_activo WHERE id_tipo = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../pages/form_TiposActivo.php");
} else {
    echo "Error al eliminar el tipo de activo: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>