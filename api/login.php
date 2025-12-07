<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../includes/DBConfig.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['nombre_usuario'];
    $password = $_POST['password'];

    $stmt = $conexion->prepare("SELECT id_usuario, nombre, rol_usuario FROM Usuarios WHERE nombre_usuario = ? AND password = ?");
    $stmt->bind_param("ss", $usuario, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['logged_in'] = true;
        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['rol_usuario'] = $user['rol_usuario'];
        header("Location: ../pages/home.php");
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}
?>