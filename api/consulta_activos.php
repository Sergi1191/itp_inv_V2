<?php
$resultado = $conexion->query(
    "SELECT *
FROM
    Activos 
    ORDER BY CAST(SUBSTRING(id_activo, -4) AS UNSIGNED) ASC;"
);
if ($resultado === false) {
    echo "Error en la consulta: " . $conexion->error;
    exit;
}