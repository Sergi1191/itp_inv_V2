<?php 
include '../includes/DBConfig.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    die("ID de estatus no válido");
}
$query = "DELETE FROM Estatus WHERE id_estatus = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../pages/form_Estatus.php");
} else {
    echo "Error al eliminar el estatus: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>