<?php
include '../includes/DBConfig.php';

// DEBUG - Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Consultas para el formulario
$sql = "SELECT id_tipo, nombre_tipo FROM Tipos_activo";
$result_tipo_activo = $conexion->query($sql);

$sql = "SELECT id_usuario, nombre FROM Usuarios";
$result_usuario = $conexion->query($sql);

$sql = "SELECT id_sub, nombre_sub FROM Subdirecciones";
$result_subdirecciones = $conexion->query($sql);

$sql = "SELECT id_dep, nombre_dep FROM Departamentos";
$result_departamentos = $conexion->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $tipo_activo_id = intval($_POST['activo_tipo_id'] ?? 0);
    $dep_id         = intval($_POST['departamentos_id'] ?? 0);
    $sub_id         = intval($_POST['subdirecciones_id'] ?? 0);
    $usuario_id     = intval($_POST['nombre_usuario'] ?? 0);
    
    $marca      = trim($_POST['marca'] ?? '');
    $modelo     = trim($_POST['modelo'] ?? '');
    $no_serie   = trim($_POST['no_serie'] ?? '');
    $fecha_adq  = $_POST['fecha_adquisicion'] ?? null;
    $estatus    = trim($_POST['estatus'] ?? 'Activo');

    // Validar campos requeridos
    if ($marca && $modelo && $no_serie && $tipo_activo_id && $sub_id && $dep_id && $usuario_id) {
        
        // Obtener nombre del departamento para el código
        $stmt = $conexion->prepare("SELECT nombre_dep FROM Departamentos WHERE id_dep = ?");
        $stmt->bind_param("i", $dep_id);
        $stmt->execute();
        $stmt->bind_result($nombre_dep);
        $stmt->fetch();
        $stmt->close();
 
        // Obtener nombre del tipo de activo para el código
        $stmt = $conexion->prepare("SELECT nombre_tipo FROM Tipos_activo WHERE id_tipo = ?");
        $stmt->bind_param("i", $tipo_activo_id);
        $stmt->execute();
        $stmt->bind_result($nombre_tipo);
        $stmt->fetch();
        $stmt->close();

        // Generar código de departamento (3 caracteres)
        $codigo_dep = strtoupper(preg_replace('/[^A-Z0-9]/', '', $nombre_dep));
        $codigo_dep = substr($codigo_dep, 0, 3);
        $codigo_dep = str_pad($codigo_dep, 3, 'X', STR_PAD_RIGHT);

        // Generar código de tipo (2 caracteres)
        $codigo_tipo = strtoupper(preg_replace('/[^A-Z0-9]/', '', $nombre_tipo));
        $codigo_tipo = substr($codigo_tipo, 0, 2);
        $codigo_tipo = str_pad($codigo_tipo, 2, 'X', STR_PAD_RIGHT);

        // Obtener último consecutivo
        $query_ultimo = "SELECT no_inventario FROM Activos 
                         WHERE no_inventario LIKE 'ITP{$codigo_dep}{$codigo_tipo}%'
                         ORDER BY no_inventario DESC 
                         LIMIT 1";
        $resultado_ultimo = $conexion->query($query_ultimo);

        $ultimo_consecutivo = 0;

        if ($resultado_ultimo && $resultado_ultimo->num_rows > 0) {
            $fila = $resultado_ultimo->fetch_assoc();
            $ultimo_no_invent = $fila['no_inventario'];
            
            // Extraer los últimos 4 dígitos
            $consecutivo_str = substr($ultimo_no_invent, -4);
            $ultimo_consecutivo = intval($consecutivo_str);
        }

        $nuevo_consecutivo = $ultimo_consecutivo + 1;
        $folio = str_pad($nuevo_consecutivo, 4, '0', STR_PAD_LEFT);
        
        // Generar número de inventario
        $no_invent = 'ITP' . $codigo_dep . $codigo_tipo . $folio;

        // Verificar longitud
        if (strlen($no_invent) !== 12) {
            die("Error: El número de inventario generado no tiene la longitud correcta: " . $no_invent);
        }

        // Verificar si ya existe
        $check_stmt = $conexion->prepare("SELECT COUNT(*) FROM Activos WHERE no_inventario = ?");
        $check_stmt->bind_param("s", $no_invent);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();

        if ($count > 0) {
            die("Error de concurrencia: El número de inventario generado ($no_invent) ya existe. Intenta nuevamente.");
        }

        // Insertar nuevo activo
        $stmt = $conexion->prepare(
            "INSERT INTO Activos 
            (no_inventario, marca, modelo, no_serie, fecha_adquisicion, estatus,
            id_tipo, id_responsable, id_dep, id_sub)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            "ssssssiiii",
            $no_inventario,
            $marca,
            $modelo,
            $no_serie,
            $fecha_adq,
            $estatus,
            $tipo_activo_id,
            $usuario_id,
            $dep_id,
            $sub_id
        );

        if ($stmt->execute()) {
            header("Location: ../pages/form_TablaInventario.php");
            exit;
        } else {
            echo "Error al guardar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Por favor completa todos los campos requeridos.";
        echo "<br>Campos recibidos: ";
        echo "Marca: $marca, Modelo: $modelo, Serie: $no_serie, Tipo: $tipo_activo_id, Sub: $sub_id, Dep: $dep_id, Usuario: $usuario_id";
    }
}
?>