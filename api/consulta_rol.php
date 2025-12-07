<?php
$resultado = $conexion->query(
    "SELECT*
    FROM
    Roles
    ORDER BY CAST(SUBSTRING(id_rol, -4) AS UNSIGNED) ASC;"
);
if ($resultado === false) {
    echo "Error en la consulta: " . $conexion->error;
    exit;
}
