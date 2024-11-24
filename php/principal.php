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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>


<body class="body_dashboard">
  <style>
    .body_dashboard {
    background-image: url(../assets/image/photo_5033033224133127559_y.jpg);
    background-attachment: fixed;
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat;
  }
  .btn_archivos{
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Sombra del texto */
    padding: 20px;
    outline: none;
    border: none;
    font-size: 1rem;
    font-weight: 500;
    color: var(--text-dark);
    background-color: var(--primary-color);
    cursor: pointer;
    transition: all 400ms ease;
    display: block;
  }

  .btn_archivos:hover {
    background-color: var(--primary-color-dark);
    border-left: 5px solid #c7c7c7;
  }

  table {
            
            border-collapse: collapse;
            width: 100%;
            margin: 20px;
            border-radius: 6px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0px 1px 10px rgba(0,0,0,0.2);
            cursor: default;
            transition: all 400ms ease;
            margin-top: 200px;
        }
        table, th, td {
            border: 1px solid black;
            border-color: #d3892f;
        }
        th, td {
            padding: 10px;
            text-align: left;
            color: #0c0a09;
        }
        
        .tabla button{
          text-decoration: none;
          display: inline-block;
          padding: 5px;
          color: #ff9900;
          border: 1px solid #ff9900;
          border-radius: 4px;
          transition: all 400ms ease;
          margin: 5px;
        }

        .tabla button:hover{
          background: #ff9900;
          color: #fff;
        }

  </style>


    <div class="container">
      <!-- consultar base de datos -->
    <table class="tabla">
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
        <tbody id="tabla-archivos">
            <?php 
            include 'consultar_archivos.php';
            ?>
        </tbody>
    </table>
    </div>



    <header class="header">
      <div class="container">
        <div class="btn-menu">
          <label for="btn-menu">☰</label>
        </div>
        <div></div>
        <div class="logo">
          <h1>Sistema Gestor de Archivos</h1>
        </div>
    
        <nav class="menu">
        <a href="gestion_usuarios.php">Gestionar Usuarios</a>
          <a href="#">Almacenamiento</a>
          <a href="#">Perfil</a>
          <a class="btn" href="logout.php" placeholder="Cerrar Sesion">Cerrar Sesion</a>
        </nav>
      </div>
      
    </header>
    <div class="capa">
      
    </div>
    <!--Barra lateral --------------->
      
    <input type="checkbox" id="btn-menu" />
    <div class="container-menu">
      <div class="cont-menu">
        <nav>
          <button class="filter-button btn_archivos" data-filter="image/jpeg,image/png">Imagenes</button>
          <button class="filter-button btn_archivos" data-filter="application/pdf,application/msword">Documentos</button>
          <button class="filter-button btn_archivos" data-filter="video/mp4">Videos</button>
          <button class="filter-button btn_archivos" data-filter="audio/mp3">Audios</button>
          <button class="filter-button btn_archivos" data-filter="all">Todos los archivos</button>
          
          <button type="button" class="btn_archivos"><a href="prueba.php">Subir Nuevo Archivo</a></button>
          <button type="button" class="btn_archivos">Cargar Archivo</button>

          
        
        </nav>

        <label for="btn-menu">✖️</label>
        
      </div>
    
    <script>

/* Funcion subir Archivos */

$(document).ready(function() { 
        $('#uploadForm').on('submit', function(e) { e.preventDefault(); 
            var formData = new FormData(this); 
            $.ajax({ url: 'subir_archivo.php', 
                // Archivo PHP que manejará la subida 
                type: 'POST', 
                data: formData, 
                contentType: false, 
                processData: false, 
                success: function(response) { 
                    alert(response); 
                    location.reload(); }, 
                    error: function() { 
                        alert('Error al subir el archivo.'); 
                        } 
                        }); 
                        });
                        
                         /* Funcion filtrar Archivos */
                        $('.filter-button').on('click', function() { 
                          var filter = $(this).data('filter'); 
                          $.ajax({ url: 'filtrar_archivos.php', type: 'GET', 
                            data: { filter: filter }, success: function(response) { 
                              $('#tabla-archivos').html(response); }, 
                              error: function() { alert('Error al filtrar los archivos.'); 
                              } }); });
                        });

              
                        /* Funcion eliminar Archivos */
    function eliminarArchivo(id) { 
        if (confirm('¿Estás seguro de que deseas eliminar este archivo?')) 
        { $.ajax({ url: 'eliminar_archivo.php', type: 'POST', 
            data: { id: id }, success: function(response) { alert(response); 
                location.reload(); }, 
                error: function() { alert('Error al eliminar el archivo.');
                 } }); 
                } } 
    
    /* Funcion editar Archivos */
    function editarArchivo(id) { 
        var nuevoNombre = prompt('Introduce el nuevo nombre del archivo:');
         if (nuevoNombre) { 
            $.ajax({ url: 'editar_archivo.php', 
                type: 'POST', 
                data: { id: id, nombre_archivo: nuevoNombre },
                success: function(response) { 
                    alert(response); location.reload(); }, 
                    error: function() { 
                        alert('Error al editar el archivo.'); } 
                    }); } }

    </script>
  </body>

  
    

    

