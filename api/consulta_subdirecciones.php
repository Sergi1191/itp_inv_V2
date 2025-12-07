<?php
$resultado = $conexion->query(
    "SELECT*
    FROM
    Subdirecciones
    ORDER BY CAST(SUBSTRING(id_sub, -4) AS UNSIGNED) ASC;"
);
if ($resultado === false) {
    echo "Error en la consulta: " . $conexion->error;
    exit;
}