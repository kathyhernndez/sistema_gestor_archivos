<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo '
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
    <!-- Formulario de Registro -->
    <form action="registro_usuario_be.php" method="POST" id="registro-form">
        <h2>Registrarse</h2>
        <label for="">*Nombre</label>
        <input type="text" placeholder="Registra el primer nombre del usuario" name="nombre" required minlength="3" maxlength="32">
        <label for="">*Apellido</label>
        <input type="text" placeholder="Registra el primer apellido del usuario" name="apellido" required minlength="3" maxlength="32">
        <label for="telefono">* Teléfono</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Ingresa el número de teléfono del usuario" required pattern="\d{11}" maxlength="11" minlength="11">
        <label for="">*Correo Electrónico</label>
        <input type="email" placeholder="Ingresa un correo electrónico válido" name="correo" required minlength="12" maxlength="64">
        <label for="opcion">* Selecciona el nivel de acceso del usuario:</label> 
        <select id="opcion" name="rol" required>
            <option value="" disabled selected>Elige una opción</option> 
            <option value="1">Super Admin</option> 
            <option value="1">Administrador</option> 
            <option value="0">Personal</option> 
        </select>
        <br>
        <label for="">*Contraseña</label>
        <input type="password" placeholder="Ingresa la contraseña del usuario" name="clave" required minlength="10" maxlength="50" id="password">
        <button>Registrarse</button>
    </form>

    <!-- Botón para Ver Usuarios -->
    <button id="ver-usuarios-btn">Ver Usuarios</button>

    <!-- Tabla para Mostrar Usuarios -->
    <div id="usuarios-table-container" style="display:none;">
        <h2>Usuarios Registrados</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th>Nivel Acceso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="usuarios-table-body">
                <?php 
                include 'get_usuarios.php';
                ?>
            </tbody>
        </table>
    </div>

    <!-- Formulario para Editar Usuario -->
    <div id="editar-usuario-form" style="display:none;">
        <h2>Editar Usuario</h2>
        <form id="formulario-editar-usuario">
            <input type="hidden" name="id" id="edit-id">
            <label for="edit-nombre">Nombre:</label>
            <input type="text" name="nombre" id="edit-nombre" required>
            <br>
            <label for="edit-apellido">Apellido:</label>
            <input type="text" name="apellido" id="edit-apellido" required>
            <br>
            <label for="edit-correo">Correo:</label>
            <input type="email" name="correo" id="edit-correo" required>
            <br>
            <label for="edit-telefono">Teléfono:</label>
            <input type="text" name="telefono" id="edit-telefono" required>
            <br>
            <label for="edit-rol">Nivel Acceso:</label>
            <input type="text" name="rol" id="edit-rol" required>
            <br>
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>

    <script>
        document.getElementById('ver-usuarios-btn').addEventListener('click', function() {
            // Mostrar la tabla de usuarios
            document.getElementById('usuarios-table-container').style.display = 'block';
        });

        // funciones para editar y eliminar usuarios
        function eliminarUsuario(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "eliminar_usuario.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText);
                        location.reload();
                    }
                };
                xhr.send("id=" + id);
            }
        }

        function mostrarFormularioEdicion(id, nombre, apellido, correo, telefono, rol) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-nombre').value = nombre;
            document.getElementById('edit-apellido').value = apellido;
            document.getElementById('edit-correo').value = correo;
            document.getElementById('edit-telefono').value = telefono;
            document.getElementById('edit-rol').value = rol;
            document.getElementById('editar-usuario-form').style.display = 'block';
        }

        document.getElementById('formulario-editar-usuario').addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "editar_usuario.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    location.reload();
                }
            };
            xhr.send(formData);
        });
    </script>
</body>