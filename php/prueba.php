<?php
session_start();
include 'conexion_be.php';
include 'registrar_accion.php';

$tiempo_max_inactividad = 300; // 5 minutos = 300 segundos

if (isset($_SESSION['ultimo_acceso'])) {
    $inactivo = time() - $_SESSION['ultimo_acceso'];
    if ($inactivo >= $tiempo_max_inactividad) {
        registrarAccion($_SESSION['usuario_id'], 'sesion finalizada', 'La sesión ha expirado por inactividad.');
        session_unset();
        session_destroy();
        // Eliminar cookies 
        setcookie('PHPSESSID', '', time() - 3600, '/');
        echo '
        <script>
        alert("Tu sesión ha expirado por inactividad.");
        window.location = "../index.php";
        </script>
        ';
        exit();
    }
}

$_SESSION['ultimo_acceso'] = time();

// Establecer cookies
setcookie("ultimo_acceso", $_SESSION['ultimo_acceso'], time() + $tiempo_max_inactividad, "/");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo '
    <script>
    alert("Por Favor debes Iniciar Sesion");
    window.location = "../index.php";
    </script>
    ';
    session_destroy();
    die();
}

header("Cache-Control: no-cache, must-revalidate");
// HTTP 1.1 
header("Pragma: no-cache");
// HTTP 1.0 
header("Expires: Wen, 12 november 2024 10:48:00 GMT");

// Registrar el inicio de sesión
registrarAccion($_SESSION['usuario_id'], 'inicio de sesión', 'El usuario ha iniciado sesión en el sistema.');

include 'cabecera.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
<form id="uploadForm" enctype="multipart/form-data"> 
    <label for="nombre_archivo">Nombre del archivo:</label> 
    <input type="text" name="nombre_archivo" id="nombre_archivo" required> 
    <br> 
    <label for="archivo">Archivo:</label> 
    <input type="file" name="archivo" id="archivo" required> 
    <br> 
    <button type="submit">Subir</button> 
</form> 
<script> 
    /* Funcion subir Archivos */
    $(document).ready(function() { 
        $('#uploadForm').on('submit', function(e) { 
            e.preventDefault(); 
            var formData = new FormData(this); 
            $.ajax({ 
                url: 'subir_archivo.php', 
                // Archivo PHP que manejará la subida 
                type: 'POST', 
                data: formData, 
                contentType: false, 
                processData: false, 
                success: function(response) { 
                    alert(response); 
                    location.reload(); 
                    // Registrar la acción de subir archivo en la bitácora
                    <?php registrarAccion($_SESSION['usuario_id'], 'subir archivo', 'El usuario ha subido un archivo.'); ?>
                }, 
                error: function() { 
                    alert('Error al subir el archivo.'); 
                } 
            }); 
        }); 
    });

    /* Funcion eliminar Archivos */
    function eliminarArchivo(id) { 
        if (confirm('¿Estás seguro de que deseas eliminar este archivo?')) { 
            $.ajax({ 
                url: 'eliminar_archivo.php', 
                type: 'POST', 
                data: { id: id }, 
                success: function(response) { 
                    alert(response); 
                    location.reload(); 
                    // Registrar la acción de eliminar archivo en la bitácora
                    <?php registrarAccion($_SESSION['usuario_id'], 'eliminar archivo', 'El usuario ha eliminado un archivo.'); ?>
                }, 
                error: function() { 
                    alert('Error al eliminar el archivo.'); 
                } 
            }); 
        } 
    } 
    
    /* Funcion editar Archivos */
    function editarArchivo(id) { 
        var nuevoNombre = prompt('Introduce el nuevo nombre del archivo:'); 
        if (nuevoNombre) { 
            $.ajax({ 
                url: 'editar_archivo.php', 
                type: 'POST', 
                data: { id: id, nombre_archivo: nuevoNombre }, 
                success: function(response) { 
                    alert(response); 
                    location.reload(); 
                    // Registrar la acción de editar archivo en la bitácora
                    <?php registrarAccion($_SESSION['usuario_id'], 'editar archivo', 'El usuario ha editado el nombre de un archivo.'); ?>
                }, 
                error: function() { 
                    alert('Error al editar el archivo.'); 
                } 
            }); 
        } 
    }
</script>

<!-- consultar base de datos -->
<h1>Lista de Archivos Subidos</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de Archivo</th>
            <th>Tipo de Archivo</th>
            <th>Ruta de Archivo</th>
            <th>Fecha de Subida</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        include 'consultar_archivos.php';
        ?>
    </tbody>
</table>

<!-- tabla bitacora -->
<h1>Bitácora de Acciones del Sistema</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>ID Usuario</th>
            <th>Acción</th>
            <th>Descripción</th>
            <th>Fecha y Hora</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        include 'bitacora.php';
        ?>
    </tbody>
</table>

</body>
</html>
