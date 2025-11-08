<?php
include '../includes/DBConfig.php';

if (isset($_GET['id_documento'])) {
    $id_documento = intval($_GET['id_documento']);
    
    // Obtener nombre del archivo
    $stmt = $conexion->prepare("SELECT archivo FROM Documentacion WHERE id_documento = ?");
    $stmt->bind_param("i", $id_documento);
    $stmt->execute();
    $stmt->bind_result($archivo);
    $stmt->fetch();
    $stmt->close();
    
    // Eliminar de base de datos
    $stmt = $conexion->prepare("DELETE FROM Documentacion WHERE id_documento = ?");
    $stmt->bind_param("i", $id_documento);
    
    if ($stmt->execute()) {
        // Eliminar archivo físico
        $ruta_archivo = '../docs/' . $archivo;
        if (file_exists($ruta_archivo)) {
            unlink($ruta_archivo);
        }
        header("Location: ../pages/form_DocumentacionActivo.php?eliminado=1");
    } else {
        echo "Error al eliminar documento: " . $stmt->error;
    }
    $stmt->close();
    exit;
}
?>