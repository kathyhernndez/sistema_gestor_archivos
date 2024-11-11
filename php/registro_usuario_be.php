<?php

    include 'conexion_be.php';

    $nombres = $_POST['nombre'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    //ENCRIPTAMIENTO DE CONTRASENA
    $clave = hash('sha512', $clave);

    $query = "INSERT INTO usuarios(nombre, correo, clave) VALUES ('$nombres', '$correo', '$clave')";


    ///Vericar que no se repitan los regitros
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' ");
    //$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE user='$usuario' ");

    //verificando correo
    $verificar_datos = $verificar_correo;
    if(mysqli_num_rows($verificar_datos) > 0){
        echo"
            <script>
                alert('Este correo ya esta registrado, prueba con otro diferente');
                window.location = '../index.php';
            </script>
            ";
            exit();
                }
    //Verificando Usuario
    //$verificar_user = $verificar_usuario;
    //if(mysqli_num_rows($verificar_user) > 0){
       // echo"
           // <script>
               // alert('Este usuario ya esta registrado, prueba con otro diferente');
               // window.location = '../index.php';
          //  </script>
            //";
            //exit();
               // }
    //Proceso de registro de usuario
    $ejecutar = mysqli_query($conexion, $query);
    if($ejecutar){
        echo'
        <script>
            alert("Usuario Registrado Exitosamente");
            window.location = "../index.php";
        </script>
        ';
    }else{
        echo'
        <script>
            alert("Intentalo Nuevamente, Usuario no Almacenado");
            window.location = "../index.php";
        </script>
        ';
    }
    mysqli_close($conexion);
?>