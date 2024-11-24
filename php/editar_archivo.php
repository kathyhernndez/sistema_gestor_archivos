<?php
include 'conexion_be.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nuevoNombre = $_POST['nombre_archivo'];

    // Actualizar el nombre del archivo en la base de datos
    $query = "UPDATE archivos SET nombre_archivo = ? WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("si", $nuevoNombre, $id);
    if ($stmt->execute()) {
        echo "Nombre del archivo actualizado con éxito.";
    } else {
        echo "Error al actualizar el nombre del archivo: " . $stmt->error;
    }
    $stmt->close();
}

$conexion->close();
?>
