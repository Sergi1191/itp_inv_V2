<?php
$resultado = $conexion->query(
    "SELECT*
    FROM
    Estatus
    ORDER BY CAST(SUBSTRING(id_estatus, -4) AS UNSIGNED) ASC;"
);
if ($resultado === false) {
    echo "Error en la consulta: " . $conexion->error;
    exit;
}
