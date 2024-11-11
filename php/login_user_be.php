<?php
    session_start();

    include 'conexion_be.php';

    $correo  = $_POST['correo'];
    $clave = $_POST['clave'];
    $clave = hash('sha512', $clave);

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' AND clave='$clave'");

    if(mysqli_num_rows($validar_login) > 0){
        $_SESSION['usuarios'] = $correo;
        header("location: foro.php");
        exit();
    }else{
        echo'
        <script>
            alert("Usuario no registrado. Por Favor Verifica e intenta Nuevamente");
            window.location = "../index.php";
        </script>
        ';
        exit();
    };





?>