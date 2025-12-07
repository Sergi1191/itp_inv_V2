<?php
include '../includes/DBConfig.php';

$resultado = $conexion->query(
    "SELECT*
    FROM
    Tipos_activo
    ORDER BY CAST(SUBSTRING(id_tipo, -4) AS UNSIGNED) ASC;"
);
if ($resultado === false) {
    echo "Error en la consulta: " . $conexion->error;
    exit;
}