<?php
session_start();
require_once '../app/config/db.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../pags/inicioSesion.php");
    exit();
}

$usuario = $_SESSION['usuario']; 
$conn = Database::connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre    = trim($_POST['nombre'] ?? '');
    $apellido  = trim($_POST['apellido'] ?? '');
    $correo    = trim($_POST['correo'] ?? '');
    $provincia = trim($_POST['provincia'] ?? '');
    $cedula    = $usuario['Cedula'];

    if ($nombre && $apellido && $correo && $provincia) {
        $stmt = $conn->prepare("UPDATE usuario SET Nombre = ?, Apellido1 = ?, Correo = ?, Provincia = ? WHERE Cedula = ?");
        $stmt->bind_param("sssss", $nombre, $apellido, $correo, $provincia, $cedula);

        if ($stmt->execute()) {
            $_SESSION['usuario']['Nombre']    = $nombre;
            $_SESSION['usuario']['Apellido1'] = $apellido;
            $_SESSION['usuario']['Correo']    = $correo;
            $_SESSION['usuario']['Provincia'] = $provincia;

            header("Location: miPerfil.php");
            exit();
        } else {
            $error = "Error al actualizar el perfil.";
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../assets/css/miPerfil.css">
    <link rel="stylesheet" href="../assets/css/editarPerfil.css">
</head>
<body>
    <main class="main">
        <h1>Editar Perfil</h1>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="POST">
            <div class="form-g">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['Nombre']); ?>" required>
            </div>

            <div class="form-g">
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" value="<?php echo htmlspecialchars($usuario['Apellido1']); ?>" required>
            </div>

            <div class="form-g">
                <label for="correo">Correo:</label>
                <input type="email" name="correo" value="<?php echo htmlspecialchars($usuario['Correo']); ?>" required>
            </div>

            <div class="form-g">
                <label for="provincia">Provincia:</label>
                <input type="text" name="provincia" value="<?php echo htmlspecialchars($usuario['Provincia']); ?>" required>
            </div>

            <button type="submit" class="btn-guardar">Guardar Cambios</button>
            <a href="miPerfil.php" class="btn-cancelar">Cancelar</a>
        </form>
    </main>
</body>
</html>
