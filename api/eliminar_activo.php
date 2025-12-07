<?php 
include '../includes/DBConfig.php';

$id = intval($_GET['id'] ?? 0);


if ($id <= 0) {
    die("ID de usuario no válido");
}

// Usar consulta preparada con MySQLi
$query = "DELETE FROM Activos WHERE id_activos = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../pages/form_TablaInventario.php");
} else {
    echo "Error al eliminar el activo: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>