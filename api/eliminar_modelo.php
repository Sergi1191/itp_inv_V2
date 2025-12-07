<?php 
include '../includes/DBConfig.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    die("ID de modelo no válido");
}
$query = "DELETE FROM Modelos WHERE id_modelo = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../pages/form_Modelo.php");
} else {
    echo "Error al eliminar el modelo: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>