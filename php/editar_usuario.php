<?php
include 'conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $rol = mysqli_real_escape_string($conexion, $_POST['rol']);

    // Actualizar el registro en la base de datos
    $query = "UPDATE usuarios SET nombre = ?, apellido = ?, correo = ?, telefono = ?, id_roles = ? WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("sssssi", $nombre, $apellido, $correo, $telefono, $rol, $id);
    if ($stmt->execute()) {
        echo "Usuario actualizado con éxito.";
    } else {
        echo "Error al actualizar el Usuario: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Solicitud no válida.";
}

$conexion->close();
?>
