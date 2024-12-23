<?php
session_start();

$tiempo_max_inactividad = 300; // 5 minutos = 300 segundos

if (isset($_SESSION['ultimo_acceso'])) {
    $inactivo = time() - $_SESSION['ultimo_acceso'];
    if ($inactivo >= $tiempo_max_inactividad) {
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
    font-weight: 200;
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
            margin-top: 20px;
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

        .table-container { 
          max-height: 400px; /* Ajusta el tamaño según tus necesidades */ 
          overflow-y: scroll; 
          border: none; 
          margin-top: 200px;
          margin-bottom: 5px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        
  /* Estilos adicionales para dispositivos móviles */
@media (max-width: 768px) {
  .modal-content {
    width: 95%; /* Aumentamos el ancho para móviles */
    height: auto;
}
}

.modal_content h1 p{
  padding: 30px;
}

/* Estilo para el fondo de la ventana modal */
body.modal-open {
  overflow: hidden;
}

.modal_content {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
  padding: 60px 0; /* Añadimos padding para centrar el modal verticalmente */
  box-sizing: border-box; /* Asegura que el padding se incluya en el tamaño total */
}

/* Estilo para el contenido de la ventana modal */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 90%;
  max-width: 1200px;
  border-radius: 10px;
  position: relative;
}
/* Estilo para el botón de cerrar */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

  </style>


    <div class="container table-container">
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
          <button class="filter-button btn_archivos" data-filter="audio/mp3,audio/mpeg">Audios</button>
          <button class="filter-button btn_archivos" data-filter="all">Todos los archivos</button>
          <button type="button" class="btn_archivos openModalBtn" data-modal="modal1">Cargar Archivo</button>
<!-- 
          <a href="prueba.php">Pagina de Pruebas</a>
-->
          
          
        
        </nav>

        <label for="btn-menu">✖️</label>
        
      </div>
    <!--modal boton-->
    <div id="modal1" class="modal_content">
        <div class="modal-content blog-post">
          <span class="close" data-modal="modal1">&times;</span>
        
          <!--cargar archivos formulario-->
          <h3 class="intro"><strong>Cargar Nuevo Archivo</strong></h3>
          <div class="content">
          <form id="uploadForm" enctype="multipart/form-data"> 
    <label for="nombre_archivo">Nombre del archivo:</label> 
    <input type="text" name="nombre_archivo" id="nombre_archivo" required maxlength="150"> 
    <br> 
    <label for="archivo">Archivo:</label> 
    <input type="file" name="archivo" id="archivo" required> 
    <br> 
    <button type="submit">Subir</button> 
    </form> 
          </div>
          

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

          // MODALS
document.querySelectorAll('.openModalBtn').forEach(button => {
    button.onclick = function() {
        const modalId = this.getAttribute('data-modal');
        document.getElementById(modalId).style.display = "block";
    }
});

document.querySelectorAll('.close').forEach(span => {
    span.onclick = function() {
        const modalId = this.getAttribute('data-modal');
        document.getElementById(modalId).style.display = "none";
    }
});

window.onclick = function(event) {
    if (event.target.classList.contains('modal_content')) {
        event.target.style.display = "none";
    }
}

    </script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../assets/js/script.js"></script>
  </body>

</html>
  
    

    

