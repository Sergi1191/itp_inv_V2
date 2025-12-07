<?php
$resultado = $conexion->query(
    "SELECT*
    FROM
    Marcas
    ORDER BY CAST(SUBSTRING(id_marca, -4) AS UNSIGNED) ASC;"
);
if ($resultado === false) {
    echo "Error en la consulta: " . $conexion->error;
    exit;
}
