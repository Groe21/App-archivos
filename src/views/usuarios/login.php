<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/app_archivos/public/assets/css/login.css">
    <link rel="stylesheet" href="/app_archivos/public/assets/css/loader.css">

    <link rel="icon" href="/app_archivos/public/assets/img/Logotipo.ico" type="image/png">
</head>

<body>
    <div class="background-image"></div>
    
    <div class="form-wrapper">
        <!-- Formulario de Inicio de Sesión -->
        <form class="form_container fade-in show" id="loginForm" action="/app_archivos/src/views/usuarios/autenticar.php" method="POST">
            <div class="logo_container"></div>
            <div class="title_container">
                <p class="title">Iniciar Sesión</p>
                <span class="subtitle">Comienza con nuestra aplicación, solo crea una cuenta y disfruta de la experiencia.</span>
            </div>
            <br>
            <div class="input_container">
                <label class="input_label" for="username_field">Usuario</label>
                <input placeholder="Usuario" title="Usuario" name="username" type="text" class="input_field" id="username_field" required>
            </div>
            <div class="input_container">
                <label class="input_label" for="password_field">Contraseña</label>
                <input placeholder="Contraseña" title="Contraseña" name="password" type="password" class="input_field" id="password_field" required>
            </div>
            <button title="Ingresar" type="submit" class="sign-in_btn">
                <span>Ingresar</span>
            </button>
            <p>¿No tienes cuenta? <a href="#" id="showRegister">Regístrate</a></p>
        </form>

        <!-- Formulario de Registro -->
        <form class="form_container fade-in hidden" id="registerForm" action="/app_archivos/src/views/usuarios/crearUsuario.php" method="POST">
            <div class="logo_container"></div>
            <div class="title_container">
                <p class="title">Crear Cuenta</p>
                <span class="subtitle">Únete a nosotros y disfruta de todos los beneficios.</span>
            </div>
            <br>
            <div class="input_container">
                <label class="input_label" for="register_username_field">Usuario</label>
                <input placeholder="Usuario" title="Usuario" name="username" type="text" class="input_field" id="register_username_field" required>
            </div>
            <div class="input_container">
                <label class="input_label" for="register_email_field">Correo Electrónico</label>
                <input placeholder="Correo Electrónico" title="Correo Electrónico" name="email" type="email" class="input_field" id="register_email_field" required>
            </div>
            <div class="input_container">
                <label class="input_label" for="register_password_field">Contraseña</label>
                <input placeholder="Contraseña" title="Contraseña" name="password" type="password" class="input_field" id="register_password_field" required>
            </div>
            <button title="Registrarse" type="submit" class="sign-in_btn">
                <span>Registrarse</span>
            </button>
            <p>¿Ya tienes cuenta? <a href="#" id="showLogin">Inicia sesión</a></p>
        </form>
    </div>

    <div id="loader" class="loader" style="display: none;"></div>
    <div id="overlay" class="overlay" style="display: none;"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form"); // Asumiendo que tienes un formulario envolviendo los campos de usuario y contraseña
            const loader = document.getElementById("loader");
            const overlay = document.getElementById("overlay");

            form.addEventListener("submit", function(event) {
                overlay.style.display = "block"; // Mostrar la superposición blanca
                loader.style.display = "block"; // Mostrar el loader
            });
        });
    </script>


    <script>
        document.getElementById('showRegister').addEventListener('click', function() {
            document.getElementById('loginForm').classList.remove('show');
            document.getElementById('registerForm').classList.add('show');
        });

        document.getElementById('showLogin').addEventListener('click', function() {
            document.getElementById('registerForm').classList.remove('show');
            document.getElementById('loginForm').classList.add('show');
        });

        form.addEventListener("submit", function(event) {
            loader.style.display = "block"; // Mostrar el loader
            console.log("Loader should be visible now.");
        });
    </script>
</body>

</html>
