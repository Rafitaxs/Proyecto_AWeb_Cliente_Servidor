<?php
session_start();
require_once '../app/config/db.php';
if (!isset($_SESSION['usuario'])) {
   header("Location: ../pags/inicioSesion.php");
   exit();
}
$usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="../assets/css/miPerfil.css">
    <link rel="stylesheet" href="../assets/CSS/header.css">
</head>

<body>
    <header>
        <?php include '../componentes/header.html'; ?>
    </header>
    <main class="main">
        <h1>Mi perfil</h1>
        <p>Aquí puedes cambiar datos de tu perfil, como nombre, biografía y otros aspectos públicos.</p>

        <div class="fotoContenedor">
            <div class="foto_Pefil">
                <img src="../assets/IMG/cr7.webp" alt="Foto de perfil" height="50px" class="foto">
            </div>

            <div class="form-g">
                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre"
                    value="<?php echo htmlspecialchars($usuario['Nombre']); ?>" required>
            </div>

            <div class="form-g">
                <label for="apellido"> Apellido</label>
                <input type="text" id="apellido" name="apellido" placeholder="Tu apellido"
                    value="<?php echo htmlspecialchars($usuario['Apellido1']); ?>" required>
            </div>

            <div class="form-g">
                <label for="display-Nombre">Nombre de usuario:</label>
                <input type="text" id="display-Nombre" name="display-Nombre" placeholder="Nombre de usuario"
                    value="<?php echo htmlspecialchars($usuario['Correo']); ?>" required>
            </div>

            <div class="form-g">
                <label for="biografia">Biografía:</label>
                <textarea id="biografia" name="biografia" placeholder="Escribe algo sobre ti..." rows="4"
                    cols="50"></textarea>
                <button class="btn-guarda">Guardar cambios</button>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <p>© 2025 Citas Prácticas de Manejo - Todos los derechos reservados</p>
            <div class="footer-icons">
                <a href='https://www.facebook.com/MOPTcostarica/?ref=search#' target='_blank'>Facebook</a>
                <a href='https://www.instagram.com/mopt_cr/#' target='_blank'>Instagram</a>
                <a href='https://www.tiktok.com/@el_mopt' target='_blank'>TikTok</a>
            </div>
            <p class="footer-texto">Central Telefónica: (506)2523-2000.<br>
            </p>
        </div>
    </footer>
</body>

</html>