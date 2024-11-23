<?php

session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
        echo'
            <script>
            alert("Por Favor debes Iniciar Sesion");
            window.location = "../index.php";
            </script>
            ';
        session_destroy();
        die();

    header("Cache-Control: no-cache, must-revalidate"); 
        // HTTP 1.1 
    header("Pragma: no-cache"); 
        // HTTP 1.0 
    header("Expires: Wen, 12 november 2024 10:48:00 GMT");
    }


    include 'cabecera.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivos</title>
</head>
<body>
    <h1>Subir Archivos</h1>
    <form action="subir_archivo.php" method="POST" enctype="multipart/form-data">
        <label for="archivo">Seleccione un archivo:</label>
        <input type="file" id="archivo" name="archivo" required>
        <br>
        <label for="name">Escribe un nombre para el archivo:</label>
        <input type="text" id="nombre_archivo" name="nombre_archivo" required>
        <br>
        <label for="name">Añade la Categoria de la Carpeta</label>
        <input type="text" id="categoria_carpeta" name="categoria_carpeta" required>
        <br>
        <label for="name">Añade el nombre de la carpeta</label>
        <input type="text" id="nombre_carpeta" name="nombre_carpeta" required>
        <br>
        <button type="submit">Subir</button>
        <a href="prueba.php">Atrás</a>
    </form>
</body>
</html>