<?php
$resultado = $conexion->query(
    "SELECT*
    FROM
    Usuarios
    ORDER BY CAST(SUBSTRING(id_usuario, -4) AS UNSIGNED) ASC;"
);
if ($resultado === false) {
    echo "Error en la consulta: " . $conexion->error;
    exit;
}
