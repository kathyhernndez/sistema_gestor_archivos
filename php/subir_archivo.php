<?php
include 'conexion_be.php'; // Asegúrate de que este archivo contiene la conexión correcta a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_archivo = $_POST['nombre_archivo'];
    $archivo = $_FILES['archivo'];
    $nombre_carpeta = $_POST['nombre_carpeta'];
    $categoria_carpeta = $_POST['categoria_carpeta'];

    // Verificar si el archivo fue subido sin errores
    if ($archivo['error'] === UPLOAD_ERR_OK) {
        $tipo_archivo = $archivo['type'];
        $ruta_archivo = 'uploads/' . basename($archivo['name']);

        // Crear el directorio 'uploads' si no existe
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }

        // Mover el archivo subido a la carpeta de destino
        if (move_uploaded_file($archivo['tmp_name'], $ruta_archivo)) {
            // Guardar la información del archivo en la base de datos
            $stmt = $conexion->prepare("INSERT INTO archivos (nombre_archivo, tipo_archivo, ruta_archivo) VALUES (?, ?, ?)");

            // Verificar si la consulta se preparó correctamente
            if ($stmt === false) {
                die('Error al preparar la consulta: ' . $conexion->error);
            }

            // Vincular parámetros y ejecutar la consulta
            $stmt->bind_param("sss", $nombre_archivo, $tipo_archivo, $ruta_archivo);
            if ($stmt->execute()) {
                echo "Archivo subido y registrado con éxito.";
            } else {
                echo "Error al ejecutar la consulta: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error al mover el archivo subido.";
        }
    } else {
        echo "Error al subir el archivo.";
    }
}

$conexion->close();
?>
