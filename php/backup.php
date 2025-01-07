<?php
date_default_timezone_set('America/Caracas');
session_start();
include 'conexion_be.php';
include 'registrar_accion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Nombre del archivo de respaldo de la base de datos
    $backupFile = 'respaldo_db_' . date('Y-m-d_H-i') . '.sql';

    // Comando para crear el respaldo de la base de datos
    $command = "mysqldump --host=localhost --user=root --password='' gestor_archivos > {$backupFile}";
    system($command);

    // Directorio donde se encuentran los archivos subidos
    $uploadsDir = 'uploads/';

    // Nombre del archivo ZIP
    $zipFile = 'respaldo_completo_' . date('Y-m-d_H-i') . '.zip';

    // Crear una nueva instancia de ZipArchive
    $zip = new ZipArchive();
    if ($zip->open($zipFile, ZipArchive::CREATE) !== TRUE) {
        exit("No se puede abrir el archivo ZIP\n");
    }

    // Añadir el archivo de respaldo de la base de datos al ZIP
    $zip->addFile($backupFile);

    // Función para añadir archivos a un archivo ZIP
    function addFilesToZip($dir, $zip, $pathInZip) {
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                if (is_dir($dir . $file)) {
                    addFilesToZip($dir . $file . '/', $zip, $pathInZip . $file . '/');
                } else {
                    $zip->addFile($dir . $file, $pathInZip . $file);
                }
            }
        }
    }

    // Añadir archivos subidos al ZIP
    addFilesToZip($uploadsDir, $zip, 'uploads/');

    // Cerrar el archivo ZIP
    $zip->close();

    // Eliminar el archivo de respaldo de la base de datos temporal
    unlink($backupFile);

    // Enviar el archivo ZIP al navegador para descarga
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . basename($zipFile) . '"');
    header('Content-Length: ' . filesize($zipFile));
    readfile($zipFile);

    // Eliminar el archivo ZIP del servidor después de la descarga
    unlink($zipFile);

    // Verificar si se debe vaciar la carpeta de uploads
    if (isset($_POST['vaciar_uploads']) && $_POST['vaciar_uploads'] == '1') {
        // Eliminar los archivos en la carpeta de uploads
        $files = scandir($uploadsDir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                if (is_dir($uploadsDir . $file)) {
                    rmdir($uploadsDir . $file);
                } else {
                    unlink($uploadsDir . $file);
                }
            }
        }
        // Eliminar los registros en la tabla 'archivos'
        mysqli_query($conexion, "DELETE FROM archivos");
    }

    echo "Respaldo completo creado con éxito.\n";

    // Registrar la acción de respaldo
    if (isset($_SESSION['nombre_completo'])) {
        registrarAccion($_SESSION['nombre_completo'], 'respaldo de archivos', 'El usuario ha hecho un Backup de los archivos del sistema.');
    }
} else {
    // Mostrar el formulario de confirmación
    echo '
    <form method="post" action="">
        <p>¿Deseas vaciar la carpeta de archivos subidos antes de hacer el backup?</p>
        <input type="radio" id="si" name="vaciar_uploads" value="1">
        <label for="si">Sí</label><br>
        <input type="radio" id="no" name="vaciar_uploads" value="0">
        <label for="no">No</label><br><br>
        <input type="submit" value="Hacer Backup">
    </form>
    ';
}
?>
