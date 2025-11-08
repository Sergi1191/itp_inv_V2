<?php
$resultado = $conexion->query(
    "SELECT
    i.no_inventario,
    i.marca,
    i.modelo,
    i.no_serie,
    i.estatus,
    i.fecha_creacion,
    i.fecha_modificacion,
    u.nombre AS nombre_usuario,
    d.nombre_dep,
    s.nombre_sub,
    a.nombre_tipo
FROM
    Activos i
    LEFT JOIN Usuarios u ON i.id_responsable = u.nombre_usuario
    LEFT JOIN Departamentos d ON i.id_dep = d.id_dep
    LEFT JOIN Subdirecciones s ON i.id_sub = s.id_sub
    LEFT JOIN Tipos_activo a ON i.id_tipo = a.id_tipo
    ORDER BY CAST(SUBSTRING(i.no_inventario, -4) AS UNSIGNED) ASC;"
);
if ($resultado === false) {
    echo "Error en la consulta: " . $conexion->error;
    exit;
}