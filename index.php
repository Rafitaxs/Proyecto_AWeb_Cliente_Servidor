<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Citas Prácticas de Manejo</title>
        <link rel="stylesheet" href="assets/css/inicioSesion.css">
    <link rel="stylesheet" href="assets/CSS/header.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body class="pagina-index">

    <a href="pags/inicio.html" class="volver-inicio">&larr; Volver al inicio</a>

    <section class="login-card">

            <form action="/Proyecto_AWeb_Cliente_Servidor/router.php?ruta=login" method="POST">
                <h2>Iniciar Sesión</h2>
                <p class="subtitulo">Ingresa tus credenciales para acceder</p>
                <div class="input-group">
                    <input type="email" id="correoUsuario" name="correo" required>
                    <label for="correoUsuario">Correo Electrónico</label>
                </div>
                <div class="input-group">
                    <input type="number" id="cedula" name="cedula" required>
                    <label for="cedula">Cédula</label>
                </div>
                <div class="remember">
                    <label><input type="checkbox" name="recordar"> Recuérdame</label>
                </div>
                <button type="submit">Entrar</button>
            </form>

        <div class="acciones">
            ¿No tienes cuenta? <a href="pags/inicioSesion.php">Regístrate aquí</a>
        </div>
    </section>
</body>

</html>