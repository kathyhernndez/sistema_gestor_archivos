<?php
include 'conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Eliminar el registro de la base de datos
    $query = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Usuario eliminado con éxito.";
    } else {
        echo "Error al eliminar el Usuario: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Solicitud no válida.";
}

$conexion->close();
?>
