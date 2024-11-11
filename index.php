<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime News | Foro</title>
    <link rel="shortcut icon" href="assets/image/favicon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css"> </head>

<body>
    <main>
        <!--Contendor de la Web Application-->
        <div class="container__all">
            <!--Cajas Traseras-->
            <div class="caja__trasera">
                <!--Caja Login-->
                <div class="caja__trasera__login">
                    <h3>Ya tienes una cuenta</h3>
                    <p>¡Mira que hay de nuevo en la comunidad!</p>
                    <button id="btn__iniciar-sesion" class="btn">Iniciar Sesion</button>
                </div>
                <!--Caja Register-->
                <div class="caja__trasera__register">
                    <h3>¿Aun no tienes una cuenta?</h3>
                    <p>¡Crea una Cuenta Para Iniciar Conversaciones Asombrosas!</p>
                    <button id="btn__registrarse" class="btn">Registrarse</button>
                </div>
            </div>
            <!--Formulario de Loggin y Registro-->
            <div class="container__login__register">
                <!--Login-->
                <form action="php/login_user_be.php" method="POST" class="formulario__login">
                    <h2>Iniciar Sesion</h2>
                    <input type="text" placeholder="Correo Electronico" name="correo" required>
                    <input type="password" placeholder="Contraseña" name="clave" required>
                    <button>Entrar</button>
                </form>
                <!--Registro-->
                <form action="php/registro_usuario_be.php" method="POST" class="formulario__register" id="registro-form">
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
            </div>
        </div>
    </main>
    <script src="assets/js/script.js"></script>
</body>

</html>