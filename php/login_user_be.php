<?php
session_start();

include 'conexion_be.php';
include 'registrar_accion.php';

$correo  = $_POST['correo'];
$clave = $_POST['clave'];
$clave = hash('sha512', $clave);

$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' AND clave='$clave'");

if (mysqli_num_rows($validar_login) > 0) {
    $row = mysqli_fetch_assoc($validar_login);
    $_SESSION['usuario_id'] = $row['id'];  // Almacenar el ID del usuario en la sesión
    $_SESSION['nombre_completo'] = $row['nombre'] . " " . $row['apellido'];  // Almacenar el nombre completo del usuario en la sesión
    $_SESSION['correo'] = $correo;  // Almacenar el correo del usuario en la sesión
    $_SESSION['loggedin'] = true;
    registrarAccion($_SESSION['nombre_completo'], 'inicio de sesión', 'El usuario ha iniciado sesión en el sistema.');
    header("location: principal.php");
    exit();
} else {
    echo '
    <script>
        alert("Usuario no registrado o las credenciales no coinciden.
        Por Favor Verifica e intenta Nuevamente");
        window.location = "../index.php";
    </script>
    ';
    exit();
}
?>





?>