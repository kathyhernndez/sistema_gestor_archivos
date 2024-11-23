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



<body class="body_dashboard">
  <style>
    .body_dashboard {
    background-image: url(../assets/image/photo_5033033224133127559_y.jpg);
    background-attachment: fixed;
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat;
  }
  </style>
    <div class="container">
      <div class="card">
        <figure>
          <img src="/assets/image/photo_5033033224133127557_m.jpg">
        </figure>
        <div class="contenido">
          <h3> Algo </h3>
          <p> Quiero vacaviones ya </p>
          <a href="#"> Leer más </a>
        </div>
      </div>
      <div class="card">
        <figure>
          <img src="/assets/image/photo_5033033224133127558_x.jpg">
        </figure>
        <div class="contenido">
          <h3> Algo 1</h3>
          <p> Quiero vacaviones ya </p>
          <a href="#"> Leer más </a>
        </div>
      </div>
      <div class="card">
        <figure>
          <img src="/assets/image/photo_5033033224133127559_y.jpg">
        </figure>
        <div class="contenido">
          <h3> Algo 2</h3>
          <p> Quiero vacaviones ya </p>
          <a href="#"> Leer más </a>
        </div>
      </div>
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
        <a href="gestion_usuarios.php">Usuarios</a>
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
          <a href="#"> Fotos</a>
          <a href="#"> Videos</a>
          <a href="#"> Documentos</a>
          <a href="#"> Audios</a>
          
        
        </nav>

        <label for="btn-menu">✖️</label>
        
      </div>
    
    
  </body>

  
    

    

