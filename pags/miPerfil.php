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
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <header>
        <?php include '../componentes/header.html'; ?>
    </header>
    <main class="main">
        <h1>Mi perfil</h1>
        <p>Aquí puedes observar todos tus datos, como nombre y otros aspectos públicos.</p>

        <div class="fotoContenedor">
            <div class="foto_Pefil">
                <img src="../assets/IMG/cr7.webp" alt="Foto de perfil" height="50px" class="foto">
            </div>

            <div class="form-g">
                <label for="nombre">Nombre: </label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['Nombre']); ?>"
                    readonly>
            </div>

            <div class="form-g">
                <label for="apellido"> Apellido</label>
                <input type="text" id="apellido" name="apellido"
                    value="<?php echo htmlspecialchars($usuario['Apellido1']); ?>" readonly>
            </div>

            <div class="form-g">
                <label for="display-Correo">Correo:</label>
                <input type="text" id="display-Correo" name="correo"
                    value="<?php echo htmlspecialchars($usuario['Correo']); ?>" readonly>
            </div>
            <div class="form-g">
                <label for="display-Provincia">Provincia:</label>
                <input type="text" id="display-Provincia" name="provincia"
                    value="<?php echo htmlspecialchars($usuario['Provincia']); ?>" readonly>

            <div class="form-g">
                <label for="display-Rol">Rol:</label>
                <input type="text" id="display-Rol" name="rol" value="<?php echo htmlspecialchars($usuario['rol']); ?>"
                    readonly>
            </div>

            <div class="botones-perfil">
                <a class="btn-editar" href="inscripciones.php">Citas</a>
                <a href="editarPerfil.php" class="btn-editar">Editar Perfil</a>
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
            <p class="footer-texto">Central Telefónica: (506)2523-2000.<br></p>
        </div>
    </footer>
</body>

</html>