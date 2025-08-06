<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Citas Prácticas de Manejo</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body class="pagina-index">

    <a href="pags/inicio.html" class="volver-inicio">&larr; Volver al inicio</a>

    <section class="login-card">
        <h2>Iniciar Sesión</h2>

        <p class="subtitulo">Ingresa tus credenciales para acceder</p>

        <form class="login-form" action="/Proyecto_AWeb_Cliente_Servidor/router.php?ruta=login" method="POST">

            <label for="usuario">Correo electrónico</label>
            <div class="input-icon">
                <input type="email" id="correoUsuario" name="correo" placeholder="email@ejemplo.com" required>
            </div>

            <label for="contrasena">Cédula</label>
            <div class="input-icon">
                <input type="password" id="cedula" name="cedula" placeholder="Cédula" required>
            </div>

            <div class="opciones">
                <label><input type="checkbox" name="recordar"> Recordarme</label>
                <a href="#" class="olvide">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>

        <div class="divider">o</div>
        <div class="acciones">
            ¿No tienes cuenta? <a href="views/registro.php">Regístrate aquí</a>
        </div>
    </section>
</body>

</html>