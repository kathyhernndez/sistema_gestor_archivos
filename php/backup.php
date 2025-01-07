<?php
date_default_timezone_set('America/Caracas');
include 'conexion_be.php';

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

echo "Respaldo completo creado con éxito.\n";
?>
