<?php 
include '../includes/DBConfig.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
    die("ID de rol no válido");
}
$query = "DELETE FROM Roles WHERE id_rol = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../pages/form_Roles.php");
} else {
    echo "Error al eliminar el rol: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>