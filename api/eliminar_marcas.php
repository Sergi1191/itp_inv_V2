<?php 
include '../includes/DBConfig.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    die("ID de marcas no válido");
}
$query = "DELETE FROM Marcas WHERE id_marca = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../pages/form_Marcas.php");
} else {
    echo "Error al eliminar el marcas: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>