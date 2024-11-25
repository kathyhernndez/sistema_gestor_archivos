<?php
include 'conexion_be.php';

if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}

// Sanitizar entradas del usuario para evitar inyecciones SQL
$nombres = mysqli_real_escape_string($conexion, $_POST['nombre']);
$apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
$correo = mysqli_real_escape_string($conexion, $_POST['correo']);
$telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
$clave = mysqli_real_escape_string($conexion, $_POST['clave']);
$rol = mysqli_real_escape_string($conexion, $_POST['rol']);

// Verificar si el correo ya está en uso
$query_verificar = "SELECT id FROM usuarios WHERE correo = '$correo'";
$resultado = mysqli_query($conexion, $query_verificar);

if (mysqli_num_rows($resultado) > 0) {
    echo '<script>alert("El correo ya está registrado. Por favor, use otro correo."); window.location = "registro.php";</script>';
} else {
    // Encriptar contraseña
    $clave_encriptada = password_hash($clave, PASSWORD_BCRYPT);

    // Insertar el nuevo usuario en la tabla usuarios
    $query_usuario = "INSERT INTO usuarios (nombre, apellido, correo, telefono, clave, estado, id_roles) 
                      VALUES ('$nombres', '$apellido', '$correo', '$telefono', '$clave_encriptada', '1', '$rol')";

    if (mysqli_query($conexion, $query_usuario)) {
        echo '<script>alert("Usuario registrado exitosamente."); window.location = "gestion_usuarios.php";</script>';
    } else {
        die('Error al registrar el usuario: ' . mysqli_error($conexion));
    }
}

mysqli_close($conexion);
?>
