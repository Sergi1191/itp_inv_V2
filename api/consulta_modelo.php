<?php
$resultado = $conexion->query(
    "SELECT*
    FROM
    Modelos
    ORDER BY CAST(SUBSTRING(id_modelo, -4) AS UNSIGNED) ASC;"
);
if ($resultado === false) {
    echo "Error en la consulta: " . $conexion->error;
    exit;
}
