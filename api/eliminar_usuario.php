<?php 
include '../includes/DBConfig.php';

$id = intval($_GET['id'] ?? 0);

// Verificar que el ID sea válido
if ($id <= 0) {
    die("ID de usuario no válido");
}

// Usar consulta preparada con MySQLi
$query = "DELETE FROM Usuarios WHERE id_usuario = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../pages/form_Usuarios.php");
} else {
    echo "Error al eliminar el usuario: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>