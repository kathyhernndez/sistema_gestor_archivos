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
     <!--Registro-->
 <form action="php/registro_usuario_be.php" method="POST" class="" id="registro-form">
        <h2>Registrarse</h2>
        <label for="">*Nombre</label>
            <input type="text" placeholder="Registra el primer nombre del usuario" name="nombre" required minlength="3" maxlength="32">
        <label for="">*Apellido</label>
            <input type="text" placeholder="Registra el primer apellido del usuario" name="apellido" required minlength="3" maxlength="32">
        <label for="">*Telefono</label>
            <input type="number" placeholder="Ingresa el numero de telefono del usuario" name="telefono" required minlength="11" maxlength="11">
        <label for="">*Correo Electronico</label>
            <input type="email" placeholder="Ingresa un correo electrónico válido" name="correo" required minlength="12" maxlength="64">
        <label for="opcion">* Selecciona el nivel de acceso del usuario:</label> 
            <select id="opcion" name="nivel_acceso" required> 
            <option value="" disabled selected>Elige una opción</option> 
            <option value="Super_admin">Super Admin</option> 
            <option value="Admin">Administrador</option> 
            <option value="Personal">Personal</option> 
            </select>
            <br>
        <label for="">*Contraseña</label>
            <input type="password" placeholder="Ingresa la contraseña del usuario" name="clave" required minlength="10" maxlength="50" id="password">
        <label for="confirm_password">*Confirmar Contraseña:</label> 
            <input type="password" id="confirm_password" name="confirm_password" required placeholder="Repite tu contraseña" minlength="10" maxlength="50"><br><br>
        <button>Registrarse</button>
    </form>
</body>


