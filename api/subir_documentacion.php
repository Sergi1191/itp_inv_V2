<?php
include '../includes/DBConfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_inventario = intval($_POST['no_inventario'] ?? 0);
    $tipo_documento = trim($_POST['tipo_documento'] ?? '');
    $observaciones = trim($_POST['observaciones'] ?? '');
    $subido_por = intval($_POST['subido_por_usuario_id'] ?? 0);

    // Manejar archivo
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $archivo_nombre = $_FILES['archivo']['name'];
        $archivo_temporal = $_FILES['archivo']['tmp_name'];
        
        // Crear directorio si no existe
        $directorio_docs = '../docs/';
        if (!is_dir($directorio_docs)) {
            mkdir($directorio_docs, 0755, true);
        }
        
        // Generar nombre único
        $extension = pathinfo($archivo_nombre, PATHINFO_EXTENSION);
        $nombre_archivo_final = 'doc_' . $no_inventario . '_' . time() . '.' . $extension;
        $ruta_archivo = $directorio_docs . $nombre_archivo_final;
        
        // Mover archivo
        if (move_uploaded_file($archivo_temporal, $ruta_archivo)) {
            // Insertar en base de datos
            $stmt = $conexion->prepare(
                "INSERT INTO Documentacion 
                (no_inventario, tipo_documento, archivo, subido_por_usuario_id) 
                VALUES (?, ?, ?, ?)"
            );
            $stmt->bind_param("issi", $no_inventario, $tipo_documento, $nombre_archivo_final, $subido_por);
            
            if ($stmt->execute()) {
                header("Location: ../pages/form_DocumentacionActivo.php?success=1");
                exit;
            } else {
                echo "Error al guardar en base de datos: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error al subir archivo.";
        }
    } else {
        echo "Error en el archivo: " . $_FILES['archivo']['error'];
    }
}
?>