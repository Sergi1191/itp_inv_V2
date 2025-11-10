<?php
// DBConfig.php debe estar en la carpeta 'includes'
include '../includes/DBConfig.php'; 

// // Control de sesión: redirige si el usuario NO está logueado
// if (!isset($_SESSION['logged_in'])) {
//     header("location:../login.php");
//     exit();
// }

include '../includes/header.php'; 
?>

<section class="contenedor">
    
    <p>Bienvenido al Sistema de Inventario del Tecnológico de Pachuca.</p>
    </section>

<?php
include '../includes/footer.php';
?>


