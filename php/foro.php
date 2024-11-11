<?php

    session_start();
    if(!isset($_SESSION['usuarios'])){
        echo'
            <script>
            alert("Por Favor debes Iniciar Sesion");
            window.location = "../index.php";
            </script>
            ';
        session_destroy();
        die();
    }


    include 'foro_plantilla.php';
?>
    <body>

    <div action="logout.php" method="POST">
    <h1>BIENVENIDOS AL IMALAYA</h1>
    <a class="btn" href="logout.php" placeholder="Cerrar Sesion"> <button>Cerrar Sesion</button></a>

    </body>
