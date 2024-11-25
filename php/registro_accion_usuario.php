<?php

include 'conexion_be.php';

// Supongamos que se acaba de subir un archivo exitosamente
$usuario_id = $_SESSION['user_id']; // ID del usuario que subió el archivo
$accion = 'Subida';
$descripcion = 'El usuario subió el archivo ' . $nombre_archivo;
registrarAccion($usuario_id, $accion, $descripcion);

?>