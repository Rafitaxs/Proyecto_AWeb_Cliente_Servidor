<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/inicioSesion.css">
    <link rel="stylesheet" href="../assets/CSS/header.css">
</head>

<body>
    <div class="wrapper">
        <div class="form-wrapper sign-up">
            <form action="registro.php" method="post">
                <h2>Regístrate</h2>
                <div class="input-group">
                    <input type="text" id="nuevoUsuario" name="nuevoUsuario" required>
                    <label for="nuevoUsuario">Usuario</label>
                </div>

                <div class="input-group">
                    <input type="email" id="nuevoCorreo" name="nuevoCorreo" required>
                    <label for="nuevoCorreo">Correo Electrónico</label>
                </div>

                <div class="input-group">
                    <input type="password" id="nuevaContrasena" name="nuevaContrasena" required>
                    <label for="nuevaContrasena">Contraseña</label>
                </div>

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

</body>

</html>