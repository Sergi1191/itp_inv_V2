<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'itp_inv';

$conexion = new mysqli($server, $user, $pass, $db);

if ($conexion->connect_errno) {
    die("Conexion Fallida: " . $conexion->connect_errno);
}
