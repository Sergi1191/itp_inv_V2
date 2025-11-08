<?php
$usuario = $_POST['nombre'];
$password = $_POST['password'];
session_start();
$_SESSION['nombre'] = $usuario;

include '../includes/DBConfig.php';

$consulta = "SELECT * FROM usuarios WHERE nombre = '$usuario' AND password = '$password'";
$resultado = mysqli_query($conexion, $consulta);

$filas = mysqli_num_rows($resultado);

if ($filas) {
     $_SESSION['logged_in'] = true;
    header("location:../pages/home.php");
    exit();
} else {
    echo "Error en la autentificacion";
}
