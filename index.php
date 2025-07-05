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
        <form class="login-form" action="sesion.php" method="post">
            <label for="usuario">Correo electrónico</label>
            <div class="input-icon">
                <input type="email" id="usuario" name="usuario" placeholder="email@ejemplo.com" required>
            </div>
            <label for="contrasena">Contraseña</label>
            <div class="input-icon">
                <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
            </div>
            <div class="opciones">
                <label><input type="checkbox" name="recordar"> Recordarme</label>
                <a href="#" class="olvide">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <div class="divider">o</div>
        <div class="acciones">
            ¿No tienes cuenta? <a href="pags/registrarse.html">Regístrate aquí</a>
        </div>
    </section>
</body>

</html>