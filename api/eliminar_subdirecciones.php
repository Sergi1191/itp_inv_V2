<?php 
include '../includes/DBConfig.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    die("ID de subdirecciones no válido");
}
$query = "DELETE FROM Subdirecciones WHERE id_sub = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../pages/form_Subdirecciones.php");
} else {
    echo "Error al eliminar la subdireccion: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>