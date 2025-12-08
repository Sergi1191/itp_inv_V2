<?php
$resultado = $conexion->query(
    "SELECT 
        a.id_activo,
        a.no_inventario,
        m.nombre_marca AS marca,
        mo.nombre_modelo AS modelo,
        a.fecha_adquisicion,
        e.nombre_estatus AS estatus,
        t.nombre_tipo AS tipo_activo,
        u.nombre AS responsable,
        d.nombre_dep AS departamento,
        s.nombre_sub AS subdireccion
    FROM Activos a
    LEFT JOIN Marcas m ON a.id_marca = m.id_marca
    LEFT JOIN Modelos mo ON a.id_modelo = mo.id_modelo
    LEFT JOIN Estatus e ON a.id_estatus = e.id_estatus
    LEFT JOIN Tipos_activo t ON a.id_tipo = t.id_tipo
    LEFT JOIN Usuarios u ON a.id_responsable = u.id_usuario
    LEFT JOIN Departamentos d ON a.id_dep = d.id_dep
    LEFT JOIN Subdirecciones s ON a.id_sub = s.id_sub
    ORDER BY CAST(SUBSTRING(a.id_activo, -4) AS UNSIGNED) ASC;"
);
if ($resultado === false) {
    echo "Error en la consulta: " . $conexion->error;
    exit;
}