<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: router.php?ruta=login");
    exit();
}



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Citas Prácticas de Manejo</title>
    <link rel="stylesheet" href="../assets/css/inicioSesion.css">
    <link rel="stylesheet" href="../assets/CSS/header.css">
</head>

<body>
    <header>
        <?php include '../componentes/header.html'; ?>
    </header>

    <div class="wrapper">
        <div class="form-wrapper sign-in">
            <form action="/Proyecto_AWeb_Cliente_Servidor/router.php?ruta=login" method="POST">
                <h2>Iniciar Sesión</h2>
                <div class="input-group">
                    <input type="email" id="correoUsuario" name="correo" placeholder="email@ejemplo.com" required>

                </div>
                <div class="input-group">
                    <input type="number" id="cedula" name="cedula" placeholder="Cédula" required>
                </div>
                <div class="remember">
                    <label><input type="checkbox" name="recordar"> Recuérdame</label>
                </div>
                <button type="submit">Entrar</button>
                <div class="signUp-link">
                    <p>¿No tienes una cuenta? <a href="#" class="signUpBtn-link">Regístrate</a></p>
                </div>
            </form>
        </div>

        <div class="form-wrapper sign-up">
            <form action="/Proyecto_AWeb_Cliente_Servidor/router.php?ruta=register" method="POST">
                <h2>Regístrate</h2>

                <div class="input-group">
                    <input type="number" id="cedula" name="cedula" required>
                    <label for="cedula">Cédula</label>
                </div>

                <div class="input-group">
                    <input type="text" id="nombre" name="nombre" required>
                    <label for="nombre">Nombre</label>
                </div>

                <div class="input-group">
                    <input type="text" id="apellido" name="apellido" required>
                    <label for="apellido">Primer Apellido</label>
                </div>

                <div class="input-group">
                    <input type="email" id="correo" name="correo" required>
                    <label for="correo">Correo Electrónico</label>
                </div>

                <div class="input-group">
                    <input type="text" id="provincia" name="provincia" required>
                    <label for="provincia">Provincia</label>
                </div>
                <label>Selecciona tu rol:</label><br>
                <input type="radio" name="rol" value="usuario" checked> Usuario
                <input type="radio" name="rol" value="admin"> Admin

                <div class="remember">
                    <label><input type="checkbox" required> Acepto los términos y condiciones</label>
                </div>

                <button type="submit">Registrarse</button>

                <div class="signUp-link">
                    <p>¿Ya tienes una cuenta? <a href="#" class="signInBtn-link">Iniciar Sesión</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        const signInBtnLink = document.querySelector('.signInBtn-link');
        const signUpBtnLink = document.querySelector('.signUpBtn-link');
        const wrapper = document.querySelector('.wrapper');

        signUpBtnLink.addEventListener('click', (e) => {
            e.preventDefault();
            wrapper.classList.add('active');
        });

        signInBtnLink.addEventListener('click', (e) => {
            e.preventDefault();
            wrapper.classList.remove('active');
        });
    </script>
</body>

</html>