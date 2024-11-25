<?php
include 'conexion_be.php';

function registrarAccion($usuario_id, $accion, $descripcion) {
    global $conexion;
    $stmt = $conexion->prepare("INSERT INTO bitacora (usuario_id, accion, descripcion) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $usuario_id, $accion, $descripcion);
    $stmt->execute();
    $stmt->close();
}

?>
