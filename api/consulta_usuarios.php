<?php
$resultado = $conexion->query(
    "SELECT
    id_usuario,
    nombre,
    nombre_usuario,
    password,
    last_login,
    rol_usuario
FROM
    Usuarios
    ORDER BY CAST(SUBSTRING(id_usuario, -4) AS UNSIGNED) ASC;"
);
if ($resultado === false) {
    echo "Error en la consulta: " . $conexion->error;
    exit;
}