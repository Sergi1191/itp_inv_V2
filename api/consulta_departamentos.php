<?php
$resultado = $conexion->query(
    "SELECT*
    FROM
    Departamentos
    ORDER BY CAST(SUBSTRING(id_dep, -4) AS UNSIGNED) ASC;"
);
if ($resultado === false) {
    echo "Error en la consulta: " . $conexion->error;
    exit;
}
